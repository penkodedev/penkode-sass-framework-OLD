
<?php

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
