<?php
/**
 * The main template file
 *
 * @package backbonedemo
 * @since 0.1.0
 */

get_header();

/**
 * Include demo code based on URL.
 */
$request_uri = stripslashes( $_SERVER['REQUEST_URI'] );
if ( false !== strpos( $request_uri, '/demo1' ) ) {
	include 'demo1/demo1.php';
}
if ( false !== strpos( $request_uri, '/demo2' ) ) {
	include 'demo2/demo2.php';
}

wp_footer();
?>
</body>


