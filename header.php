<div class="nav-overlay"></div>
<head>
  <?php load_theme_textdomain('foo'); ?>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
  <meta name="author" content="<?php bloginfo('name'); ?>">
  <meta name="theme-color" content="#ffffff">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">

  <!-- LIBRARIES CSS BEGIN -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" title="style (screen)" />
  <link rel="stylesheet" type="text/css" href="<?= get_bloginfo("template_url"); ?>/animations/aos.css" media="screen" title="style (screen)" />
  <link rel="stylesheet" type="text/css" href="<?= get_bloginfo("template_url"); ?>/animate/aos.css" media="screen" title="style (screen)" />
  <link rel="stylesheet" type="text/css" href="<?= get_bloginfo("template_url"); ?>/css/flickity.css" media="screen" title="style (screen)" />
  <!-- LIBRARIES CSS END -->

  <!-- JS LIBRARIES BEGIN -->
  <script>
    AOS.init({
      useClassNames: true
    });
  </script>
  <script src="<?php bloginfo("template_url"); ?>/js/flickity.pkgd.min.js"></script>
  <script src="<?= get_bloginfo("template_url"); ?>/js/aos.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/prognroll.js"></script>
  <!-- JS LIBRARIES END -->

  <title>
    <?php wp_title(''); ?>
  </title>
  <?php wp_head(); ?>

  <!-- Google Analytics BEGIN -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-00000000-0"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', '000000000'); /*CHANGE NUMBER*/
  </script>
  <!-- Google Analytics END -->

</head>

<body <?php body_class($class); ?>>
  <header class="grid-header" id="header-container">
    <?php if (is_front_page()) {
      get_template_part('/template-parts/logo-container-home');
    } else {
      get_template_part('/template-parts/logo-container');
    }
    ?>

    <nav role="navigation">
      <?php wp_nav_menu(array(
        'theme_location' => 'mainnav',
        'menu_class' => 'main-nav',
        'fallback_cb'    => false
      )); ?>
    </nav>


    <!-- Cookies BEGIN -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
      window.addEventListener("load", function() {
        window.cookieconsent.initialise({
          "palette": {
            "popup": {
              "background": "#000000",
              "text": "#ffffff"
            },
            "button": {
              "background": "#ffbc51",
              "text": "#000"
            }
          },
          "content": {
            "message": "<?php _e('Utilizamos cookies propias y de terceros para mejorar nuestros servicios. Si continua navegando, consideramos que acepta su uso.', 'panambi'); ?>",
            "dismiss": "Acepto",
            "link": "Ver más",
            "href": "https://www.google.com" // change to your privacy URL //
          }
        })
      });
    </script>
    <!-- Cookies END -->
  </header>

  <?php if (is_front_page()) {
    get_template_part('/template-parts/home-slider');
  } else {
  }
  ?>

  <!-- Float Nav BEGIN -->
  <div id="nav-float">
    <div id="logo-float-container"><?php get_template_part('/template-parts/logo-float'); ?></div>
    <?php wp_nav_menu(array(
      'menu' => 'floatnav',
      'theme_location' => 'floatnav',
      'menu_class' => 'float-nav',
    )); ?>
  </div>

  <script type="text/javascript">
    var zxcFadePanel = {

      init: function(o) {
        var ms = o.FadeDuration,
          show = o.ShowAt,
          obj = {
            obj: document.getElementById(o.ID),
            show: typeof(show) == 'number' ? show : 0,
            ms: typeof(ms) == 'number' ? ms : 10,
            now: 0,
            to: 100
          }
        this.addevt(window, 'scroll', 'scroll', obj);
        this.scroll(obj);
      },

      scroll: function(o) {
        var top = document.body.scrollTop,
          to;
        if (window.innerHeight) {
          top = window.pageYOffset;
        } else if (document.documentElement.clientHeight) {
          top = document.documentElement.scrollTop;
        }
        to = top < o.show ? 0 : 100;
        if (to != o.to) {
          o.to = to;
          clearTimeout(o.dly);
          o.obj.style.visibility = 'visible';
          this.animate(o, o.now, to, new Date(), o.ms * Math.abs((to - o.now) / 100));
        }
      },

      animate: function(o, f, t, srt, mS) {
        var oop = this,
          ms = new Date().getTime() - srt,
          now = (t - f) / mS * ms + f;
        if (isFinite(now)) {
          o.now = now;
          o.obj.style.filter = 'alpha(opacity=' + now + ')';
          o.obj.style.opacity = o.obj.style.MozOpacity = o.obj.style.WebkitOpacity = o.obj.style.KhtmlOpacity = now / 100 - 0.1; //opacity
        }
        if (ms < mS) {
          o['dly'] = setTimeout(function() {
            oop.animate(o, f, t, srt, mS);
          }, 10);
        } else {
          o.now = t;
          o.obj.style.visibility = t == 100 ? 'visible' : 'hidden';
        }
      },

      addevt: function(o, t, f, p) {
        var oop = this;
        if (o.addEventListener) o.addEventListener(t, function(e) {
          return oop[f](p);
        }, false);
        else if (o.attachEvent) o.attachEvent('on' + t, function(e) {
          return oop[f](p);
        });
      }

    }

    zxcFadePanel.init({
      ID: 'nav-float',
      ShowAt: 100,
      FadeDuration: 500
    });
  </script>
  <!-- Float Nav END -->


  <!-- Time Reading Bar BEGIN -->
  <script>
    $(function() {
      $("body").prognroll({
        height: 5, //Progress bar height in pixels
        color: "red", //Progress bar background color
      });
    });
  </script>
  <!-- Time Reading Bar END -->


  <!-- Megamenu Overlay BEGIN -->
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('li.has-mega-menu').hover(function() {
          $('body').addClass('nav-focus');
        },
        function() {
          $('body').removeClass('nav-focus');
        });
    });
  </script>
  <!-- Megamenu Overlay END -->