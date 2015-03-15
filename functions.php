<?php
namespace backbonedemo;
/**
 * The main template file
 *
 * @package backbonedemo
 * @since 0.1.0
 */

const VERSION = 0.1;

function bbdemo_include_scripts() {

	/**
	 * If the URL matches '/demo1' include Demo1 code
	 */
	if ( false !== strpos( stripslashes( $_SERVER['REQUEST_URI'] ), '/demo1' ) ) {

		/**
		 * Enqueue the demo1 JavaScript.
		 */
		wp_enqueue_script(
			'backbonedemo',                                        /* Script handle */
			get_template_directory_uri() . '/js/backbonedemo1.js', /* Script path */
			array( 'wp-backbone' ),                                /* Require WP Backbone */
			VERSION,                                               /* Version caching */
			false                                                  /* Leave in header */
		);

		/**
		 * Bootstrap data for our application using wp_localize_script
		 */
		$demodata = array(
				'apiurl' => get_json_url(), /* Pass the WP REST API url */
			);

		wp_localize_script(
			'backbonedemo', /* The script handle */
			'demodata',     /* The localized variable name */
			$demodata       /* The data to pass */
		);
	}
}


add_action( 'wp_enqueue_scripts', 'backbonedemo\bbdemo_include_scripts' );
	/**
	 * If the URL matches '/demo1' include Demo1
	 */
	add_filter( 'the_content', function() {
			if ( false !== strpos( stripslashes( $_SERVER['REQUEST_URI'] ), '/demo1' ) ) {
				include 'demo1/demo1.php';
			}
		} );
