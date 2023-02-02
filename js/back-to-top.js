/************* BACK TO TOP ********************/
jQuery(document).ready(function () {
    var offset = 500;
    var duration = 600;
    
  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > offset) {
      jQuery(".back-to-top").fadeIn(duration);
    } else {
      jQuery(".back-to-top").fadeOut(duration);
    }
  });

  jQuery(".back-to-top").click(function (event) {
    event.preventDefault();
    jQuery("html, body").animate({ scrollTop: 0 }, duration);
    return false;
  });
});