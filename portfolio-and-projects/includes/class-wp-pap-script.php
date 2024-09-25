<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Portfolio and Projects
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WP_pap_Script {

	function __construct() {

		// Action to add style and script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_pap_front_style_script' ) );

		// Action to add style and script in backend
		add_action( 'admin_enqueue_scripts', array( $this, 'wp_pap_admin_style_script' ) );
	}

	/**
	 * Function to add style and script at front side
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_front_style_script() {

		/* Style */
		// Registring and enqueing slick css
		if( ! wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WP_PAP_URL.'assets/css/slick.css', array(), WP_PAP_VERSION );
		}

		// Registring and enqueing public css
		wp_register_style( 'wp-pap-public-css', WP_PAP_URL.'assets/css/wp-pap-public.css', null, WP_PAP_VERSION );

		wp_enqueue_style( 'wpos-slick-style');
		wp_enqueue_style( 'wp-pap-public-css' );

		/* Script */
		// Registring slick slider script
		if( ! wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WP_PAP_URL. 'assets/js/slick.min.js', array('jquery'), WP_PAP_VERSION, true);
		}

		// Registring public script
		wp_register_script( 'wp-pap-portfolio-js', WP_PAP_URL.'assets/js/wp-pap-portfolio.js', array('jquery'), WP_PAP_VERSION, true );

		// Registring public script
		wp_register_script( 'wp-pap-public-js', WP_PAP_URL.'assets/js/wp-pap-public.js', array('jquery'), WP_PAP_VERSION, true );
		wp_localize_script( 'wp-pap-public-js', 'WpPap', array(
															'is_mobile'	=>	(wp_is_mobile()) ? 1 : 0,
															'is_rtl'	=>	(is_rtl()) ? 1 : 0,
														));
	}

	/**
	 * Enqueue admin style and script
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_admin_style_script( $hook ) {

		global $post_type;

		$registered_posts = array( WP_PAP_POST_TYPE ); // Getting registered post types

		/* Style */
		// If page is plugin setting page then enqueue script
		if( in_array( $post_type, $registered_posts ) ) {

			// Registring admin script
			wp_register_style( 'wp-pap-admin-style', WP_PAP_URL.'assets/css/wp-pap-admin.css', null, WP_PAP_VERSION );
			wp_enqueue_style( 'wp-pap-admin-style' );
		}

		/* Script */
		// Registring admin script
		wp_register_script( 'wp-pap-admin-script', WP_PAP_URL.'assets/js/wp-pap-admin.js', array('jquery'), WP_PAP_VERSION, true );
		wp_localize_script( 'wp-pap-admin-script', 'WppapAdmin', array(
																'img_edit_popup_text'	=> esc_js( __( 'Edit Image in Popup', 'portfolio-and-projects' ) ),
																'attachment_edit_text'	=> esc_js( __( 'Edit Image', 'portfolio-and-projects' ) ),
																'img_delete_text'		=> esc_js( __( 'Remove Image', 'portfolio-and-projects' ) ),
															));

		if( in_array( $post_type, $registered_posts ) ) {

			// Enqueue required inbuilt sctipt
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'wp-pap-admin-script' );
			wp_enqueue_media(); // For media uploader
		}

		// How It Work Page
		if( $hook == WP_PAP_POST_TYPE.'_page_pap-designs' ) {
			wp_enqueue_script( 'wp-pap-admin-script' );
		}
	}
}

$wp_pap_script = new WP_pap_Script();