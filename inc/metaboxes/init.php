<?php 
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category Laf Framework
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/* Theme Options */

function admin_enqueue_styles() {
	// styles
    // wp_enqueue_style( 'font-awesome-style', get_stylesheet_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css', array(), '4.5.0' );
    // scripts
	wp_enqueue_script( 'jquery-masked-input-script', get_stylesheet_directory_uri() . '/inc/jquery-masked-input/jquery.maskedinput.min.js', array('jquery'), '1.4.1', true );
	wp_enqueue_script( 'jquery-masked-input-masks', get_stylesheet_directory_uri() . '/inc/jquery-masked-input/masks.js', array('jquery'), null, true );
} 
add_action( 'admin_enqueue_scripts', 'admin_enqueue_styles' );

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function laf_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

require_once 'theme-options.php';
require_once 'seo.php';