<?php

//************************* Enable or Disable WOOCOMMERCE custom features (comment it if needed) **************************
//include_once( get_stylesheet_directory() .'/woocommerce/woo-functions.php');

//************************* DECLARE WOOCOMERCE ON THEME ********************
/*function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
*/

//******************** Create CPT SHORTCODE **************************
function custom_portfolio_shortcode()
{
  $args = array(
    'post_type' => 'news',
    'post_status' => 'publish'
  );
  $loop = new WP_Query($args); ?>
  <div class="testimonial-slider-wrap owl-carousel">
    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
      <div class="post_column">
        <div class="post-thumbnail">
          <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
        </div>
        <div class="title">
          <h4><?php echo the_title(); ?></h4>
        </div>
        <div class="content">
          <?php the_content(); ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php
  wp_reset_postdata();
}
add_shortcode('news', 'custom_portfolio_shortcode'); // given the CPT shortcode name


//******************** Add HTML5 theme support **************************
add_theme_support('html5', array('search-form'));


//******************** Add PAGE SLUG for body class **************************
function add_slug_body_class($classes)
{
  global $post;
  if (isset($post)) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter('body_class', 'add_slug_body_class');


//******************** Add Class to submenu MEGAMENU **************************
function change_ul_item_classes_in_nav($classes, $args, $depth)
{

  if (0 == $depth) {
    $classes[] = 'level-sub1';
    $classes[] = 'megamenu-container';
    $classes[] = 'animate';
    $classes[] = 'fadeIn'; // AOS anmimation
  }
  if (1 == $depth) { // change sub-menu depth
    $classes[] = 'level-sub2';
  }
  if (2 == $depth) { // change sub-menu depth
    $classes[] = 'mega-menu-column';
  }

  return $classes;
}
add_filter('nav_menu_submenu_css_class', 'change_ul_item_classes_in_nav', 10, 3);


//******************** Add Post Type & Post Name to Body Class **************************
add_filter('body_class', 'add_post_class');
function add_post_class($classes)
{
  global $post;
  if (isset($post)) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}


//******************** Lock DASHBOARD to certain roles **************************
function wpse23007_redirect()
{
  if (is_admin() && !defined('DOING_AJAX') && (current_user_can('subscriber') || current_user_can('contributor'))) {
    wp_redirect(home_url());
    exit;
  }
}
add_action('init', 'wpse23007_redirect');


//************************* DISABLE dashboard full screen mode **************************
if (is_admin()) {
  function jba_disable_editor_fullscreen_by_default()
  {
    $script = "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
    wp_add_inline_script('wp-blocks', $script);
  }
  add_action('enqueue_block_editor_assets', 'jba_disable_editor_fullscreen_by_default');
}

//************************* WPML current link language class *****************************
function custom_language_selector()
{
  $languages = icl_get_languages('skip_missing=0&orderby=custom&order=desc');
  if (1 < count($languages)) {
    foreach ($languages as $l) {
      //adds the class "current_language" if the language that is being viewed.
      $current = $l['active'] ? ' class="current_language"' : '';
      $langs[] = '<a' . $current . ' href="' . $l['url'] . '">' . $l['native_name'] . '</a>';
    }
    echo join(' / ', $langs);
  }
}

//*************************YOUTUBE/VIMEO 100% WIDTH ********************
add_theme_support('responsive-embeds');

//************** REMOVE WORD "Category:" from category pages titles ******************
function prefix_category_title($title)
{
  if (is_category()) {
    $title = single_cat_title('', false);
  }
  return $title;
}
add_filter('get_the_archive_title', 'prefix_category_title');


//************** REMOVE WORD "Archive:" from archive pages titles ******************
add_filter('get_the_archive_title', 'archive_title_remove_prefix');
function archive_title_remove_prefix($title)
{
  if (is_post_type_archive()) {
    $title = post_type_archive_title('', false);
  }
  return $title;
}

//**************** LIST CHILD PAGES ([wpb_childpages]) ***********
function list_child_pages()
{
  global $post;

  if (is_page() && $post->post_parent)
    $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0');
  else
    $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0');

  if ($childpages) {

    $string = '<div class="child-pages-section">' . $childpages . '</div>'; //CONTAINER DIV
  }
  return $string;
}

add_shortcode('wpb_childpages', 'list_child_pages'); //USAGE SHORTCODES


//******REMOVE PLUGINS UPDATE ***********
function remove_update_notifications($value)
{

  if (isset($value) && is_object($value)) {
    unset($value->response['smart-slider-3/nextend-smart-slider3-pro.php']);
    unset($value->response['akismet/akismet.php']);
  }

  return $value;
}
add_filter('site_transient_update_plugins', 'remove_update_notifications');

//************************* INCLUDE JS FUNCTIONS **************************************
add_action('wp_enqueue_scripts', 'add_my_script');
function add_my_script()
{

  wp_enqueue_script(
    'slicknav',
    get_template_directory_uri() . '/js/back-to-top.js',
    'jquery', // jquery dependency
    1.0,
    true // false load on header, true load on footer
  ); 

  wp_enqueue_script(
    'menu-float-top',
    get_template_directory_uri() . '/js/float-menu.js',
    'jquery',
    1.0,
    true
  );

  wp_enqueue_script(
    'json_api',
    get_template_directory_uri() . '/js/json-api.js',
    null, // no dependency (null)
    1.0,
    true
  ); 

}
//************************* REMOVE WP EMOJI **************************************
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');


//************************* LINE AWESOME support **************************************
function enqueue_stylesheets()
{
  wp_enqueue_style('line-awesome', get_stylesheet_directory_uri() . '/fonts/_line-awesome/css/line-awesome.css');
}
add_action('wp_enqueue_scripts', 'enqueue_stylesheets');


//************************* FONTAWESOME support **************************************
function enqueue_our_required_stylesheets()
{
  wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/fonts/_fontawesome/css/font-awesome.css');
}
add_action('wp_enqueue_scripts', 'enqueue_our_required_stylesheets');


//************************* remove recent comments **************************************
function remove_recent_comments_style()
{
  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'remove_recent_comments_style');


//************************* REMOVE admin menu items **************************************
function remove_menus()
{

  /*remove_menu_page( 'index.php' ); //Dashboard*/
  /*remove_menu_page( 'edit.php' );*/
  /**/
  remove_menu_page('edit.php?post_type=portfolio');
  /**/
  remove_menu_page('edit.php?post_type=tribe_events');
  /*remove_menu_page( 'edit.php?post_type=page' ); //Pages*/
  /**/
  remove_menu_page('edit-comments.php'); //Comments
  /**/
  remove_menu_page('edit.php?post_type=essential_grid');
  /*remove_menu_page( 'themes.php' ); //Appearance*/
  /*remove_menu_page( 'plugins.php' ); //Plugins*/
  /*remove_menu_page( 'users.php' ); //Users*/
  /*remove_menu_page( 'tools.php' ); //Tools*/
  /*remove_menu_page( 'options-general.php' ); //Settings*/
}
add_action('admin_menu', 'remove_menus');

function wpse28782_remove_plugin_admin_menu()
{
  if (!current_user_can('administrator')) :
    remove_menu_page('portfolio');
  endif;
}
add_action('admin_menu', 'wpse28782_remove_plugin_admin_menu', 9999);

//************************* FIRST & LAST MENU ITEMS **************************************
function add_first_and_last($items)
{
  $items[1]->classes[] = 'first-item';
  $items[count($items)]->classes[] = 'last-item';
  return $items;
}
add_filter('wp_nav_menu_objects', 'add_first_and_last');


//************************* SELECT POST TYPES TO FEED **************************************
function myfeed_request($qv)
{
  if (isset($qv['feed']) && !isset($qv['post_type']))
    $qv['post_type'] = array('post type', '');
  return $qv;
}
add_filter('request', 'myfeed_request');


//*************************** NUMBER OF SEARCH RESULTS ****************************************

function change_wp_search_size($query)
{
  if ($query->is_search)
    $query->query_vars['posts_per_page'] = 10;

  return $query;
}
add_filter('pre_get_posts', 'change_wp_search_size');


//******************************* add post thumbnails support ************************************************

if (function_exists('add_theme_support')) {
  add_theme_support('post-thumbnails');
}

//if ( function_exists( 'add_image_size' ) ) {
//	add_image_size( 'thumb-250', 250, 250, true );
//}

//******************************* CUSTOM multiple excerpt lengths *************************************************

function excerpt($limit)
{
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt) >= $limit) {
    array_pop($excerpt);
    $excerpt = implode(" ", $excerpt) . '...';
  } else {
    $excerpt = implode(" ", $excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
  return $excerpt;
}

//******************************* register MENUS ***********************************************

add_theme_support('menus');

if (function_exists('register_nav_menu')) {
  register_nav_menu('mainnav', 'Main Menu');
}

if (function_exists('register_nav_menu')) {
  register_nav_menu('floatnav', 'Float Menu');
}

if (function_exists('register_nav_menu')) {
  register_nav_menu('mobilenav', 'Mobile Nav');
}

if (function_exists('register_nav_menu')) {
  register_nav_menu('footernav', 'Footer Menu');
}

//******************************* register WIDGETS ************************************************

function widget_registration($name, $id, $description, $beforeWidget, $afterWidget, $beforeTitle, $afterTitle)
{
  register_sidebar(array(
    'name' => $name,
    'id' => $id,
    'description' => $description,
    'before_widget' => $beforeWidget,
    'after_widget' => $afterWidget,
    'before_title' => $beforeTitle,
    'after_title' => $afterTitle,
  ));
}

function multiple_widget_init()
{
  widget_registration('Sidebar 01',           'sidebar-1',     '', '<div class="sidebox">', '</div>', '', '');
  widget_registration('Contenido Pie',        'footer-1',      '', '<div class="footerbox">', '</div>', '', '');
}

add_action('widgets_init', 'multiple_widget_init');