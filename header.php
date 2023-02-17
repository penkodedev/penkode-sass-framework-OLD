<div class="nav-overlay"></div>
<head>
  <?php load_theme_textdomain('foo'); ?>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
  <meta name="author" content="<?php bloginfo('name'); ?>">
  <meta name="theme-color" content="#ffffff">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">

  <meta property="og:type" content="article">
  <meta property="og:title" content="<?php the_title(); ?>">
  <meta property="og:description" content="<?php the_excerpt(); ?>">
  <meta property="og:url" content="<?php the_permalink(); ?>">
  <meta property="og:image" content="<?php the_post_thumbnail_url(); ?>">

  <!-- LIBRARIES CSS BEGIN -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css" media="screen" title="style (screen)" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/aos.css" media="screen" title="style (screen)" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flickity.css" media="screen" title="style (screen)" />
  <!-- LIBRARIES CSS END -->


  <!-- LIBRARIES JS BEGIN -->
  <script>
    AOS.init({
      useClassNames: true
    });
  </script>
  
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/aos.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/flickity.pkgd.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/prognroll.js"></script>
  <!-- LIBRARIES JS END -->

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