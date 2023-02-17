<?php

//************************* INCLUDE JS FUNCTIONS **************************************
function enqueue_scripts() {
  
    wp_enqueue_script(
      'back-to-top-js',
      get_template_directory_uri() . '/js/back-to-top.js',
      array(),
      '',
      true
    );
  
    wp_enqueue_script(
      'float_menu-js',
      get_template_directory_uri() . '/js/float-menu.js',
      array(),
      'jquery',
      true
    );
  
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

  //************************* INCLUDE REACT **************************************
  function enqueue_react_scripts() {
    wp_enqueue_script( 'react', get_stylesheet_directory_uri() . '/js/react/react.development.js ', array(), '16.0.0', true );
    wp_enqueue_script( 'react-dom', get_stylesheet_directory_uri() . '/js/react/react-dom.production.min.js', array(), '16.0.0', true );
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_react_scripts' );