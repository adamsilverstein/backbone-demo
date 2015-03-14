<?php
namespace backbonedemo;
/**
 * The main template file
 *
 * @package backbonedemo
 * @since 0.1.0
 */

const VERSION = 0.1;


	if ( false !== strpos( stripslashes( $_SERVER['REQUEST_URI'] ), '/demo1' ) ) {
		wp_enqueue_script(
			'backbonedemo',
			get_theme_root_uri( 'js/backbonedemo.js' ),
			array( 'backbone' ),
			VERSION,
			true
		);
		include 'demo1/demo1.php';
	}
