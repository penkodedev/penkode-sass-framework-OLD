<?php

/**
 * Custom Gutenberg Functions
 */

 function penkode_gutenberg_default_colors ()
{

	add_theme_support(
		'editor-color-pallete',
		
		array(
			array (
			'name' => 'Super Block',
			'slug' => 'slug',
			'color' => '#efefef'

		)
	)
 );
}

add_action('init', 'penkode_gutenberg_default_colors' );