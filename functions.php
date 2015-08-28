<?php
namespace backbonedemo;
/**
 * The main template file
 *
 * @package backbonedemo
 * @since 0.1.0
 */

const VERSION = 0.1;

function get_json_url() {
	return '/wp-json/wp/v2';
}

function bbdemo_include_scripts() {
	$request_uri = stripslashes( $_SERVER['REQUEST_URI'] );

	/**
	 * If the URL matches '/demo1' include Demo1 code
	 */
	if ( false !== strpos( $request_uri, '/demo1' ) ) {
		$scriptname = 'backbonedemo1.js';
		$demodata = array(
			'apiurl' => trailingslashit( get_json_url() ), /* Pass the WP REST API url */
		);
		/**
		 * Add some style.
		 */
		$stylesheet        = get_template_directory_uri() . '/css/demo1.css';
		$stylesheet_handle = 'demo1-styles';
	} elseif ( false !== strpos( $request_uri, '/demo2' ) )  {
		$scriptname = 'backbonedemo2.js';
		$post_data  = get_posts( array(
				'posts_per_page' => 10,
				'no_count_posts' => true,
			) );
		$demodata   = array(
			'apiurl' => trailingslashit( get_json_url() ), /* Pass the WP REST API url */
			'posts'  => $post_data,
		);

		/**
		 * Add some style.
		 */
		$stylesheet        = get_template_directory_uri() . '/css/demo2.css';
		$stylesheet_handle = 'demo2-styles';

	} elseif ( false !== strpos( $request_uri, '/demo3' ) )  {
		$scriptname = 'backbonedemo3.js';
		$post_data  = get_posts( array(
				'posts_per_page' => 10,
				'no_count_posts' => true,
			) );
		$demodata   = array(
			'apiurl' => get_json_url(), /* Pass the WP REST API url */
			'posts'  => $post_data,
			'nonce'  => wp_create_nonce( 'wp_rest' ),
		);

		/**
		 * Add some style.
		 */
		$stylesheet        = get_template_directory_uri() . '/css/demo3.css';
		$stylesheet_handle = 'demo3-styles';

	}

	if ( isset( $scriptname ) ) {
		/**
		 * Enqueue the demo JavaScript.
		 */
		wp_enqueue_script(
			'backbonedemo',                                        /* Script handle */
			get_template_directory_uri() . '/js/' . $scriptname,   /* Script path */
			array( 'wp-backbone' ),                                /* Require WP Backbone */
			VERSION,                                               /* Version caching */
			true                                                   /* Script in footer */
		);

		/**
		 * Bootstrap data for our application using wp_localize_script
		 */
		wp_localize_script(
			'backbonedemo', /* The script handle */
			'demodata',     /* The localized variable name */
			$demodata       /* The data to pass */
		);

		/**
		 * Add a stylesheet if set.
		 */
		if ( isset( $stylesheet ) ){
			wp_enqueue_style( $stylesheet_handle, /* The script handle */
				$stylesheet,                      /* The script url */
				'',                               /* Dependencies */
				VERSION                          /* Version caching */
			);
		}
	}
}


add_action( 'wp_enqueue_scripts', 'backbonedemo\bbdemo_include_scripts' );
