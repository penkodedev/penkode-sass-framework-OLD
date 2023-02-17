<?php
require_once get_template_directory() . '/inc/woo-functions.php'; // Declare WooCommerce on theme and call its functions
require_once get_template_directory() . '/inc/gutenberg.php';
require_once get_template_directory() . '/inc/dashboard.php';
require_once get_template_directory() . '/inc/include-js.php';
require_once get_template_directory() . '/inc/custom-widgets.php';
require_once get_template_directory() . '/inc/custom-nav-menus.php';
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/custom-taxonomies.php';


//******************** Add Theme Support **************************
function penkode_theme_setup() {
  add_theme_support( 'title-tag' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'html5', array( 'search-form' ) );
  add_theme_support( 'post-formats', array( 'aside', 'image', 'video' ) );
  add_theme_support( 'post-thumbnails' );
  //if ( function_exists( 'add_image_size' ) ) {
  //  add_image_size( 'thumb-250', 250, 250, true );
  }

add_action( 'after_setup_theme', 'penkode_theme_setup' );


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

add_shortcode('wpb_childpages', 'list_child_pages'); //USAGE SHORTCODES [wpb_childpages]


//************************* REMOVE WP EMOJI **************************************
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');


//************************* remove recent comments **************************************
function remove_recent_comments_style()
{
  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'remove_recent_comments_style');


//************************* FIRST & LAST MENU ITEMS **************************************
function add_first_and_last($items)
{
  $items[1]->classes[] = 'first-item';
  $items[count($items)]->classes[] = 'last-item';
  return $items;
}
add_filter('wp_nav_menu_objects', 'add_first_and_last');


//*************************** NUMBER OF SEARCH RESULTS ****************************************

function change_wp_search_size($query)
{
  if ($query->is_search)
    $query->query_vars['posts_per_page'] = 10;

  return $query;
}
add_filter('pre_get_posts', 'change_wp_search_size');

//******************************* Excerpt lengths *************************************************

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