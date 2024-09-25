<?php
/**
 * Plugin generic functions file
 *
 * @package Portfolio and Projects
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @since 1.3.5
 */
function wp_pap_clean( $var ) {

	if ( is_array( $var ) ) {
		return array_map( 'wp_pap_clean', $var );
	} else {

		$data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		return wp_unslash( $data );
	}
}

/**
 * Sanitize URL
 * 
 * @since 1.3.5
 */
function wp_pap_clean_url( $url ) {
	return esc_url_raw( trim( $url ) );
}

/**
 * Sanitize number value and return fallback value if it is blank
 * 
 * @since 1.3.5
 */
function wp_pap_clean_number( $var, $fallback = null, $type = 'int' ) {

	$var = trim( $var );
	$var = is_numeric( $var ) ? $var : 0;

	if ( $type == 'number' ) {
		$data = intval( $var );
	} else if ( $type == 'abs' ) {
		$data = abs( $var );
	} else if ( $type == 'float' ) {
		$data = (float)$var;
	} else {
		$data = absint( $var );
	}

	return ( empty( $data ) && isset( $fallback ) ) ? $fallback : $data;
}

/**
 * Allow Valid Html Tags
 * It will sanitize HTML (strip script and style tags)
 *
 * @since 1.3.5
 */
function wp_pap_clean_html( $data = array() ) {

	if ( is_array( $data ) ) {

		$data = array_map( 'wp_pap_clean_html', $data );

	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_post_kses( $data );
	}

	return $data;
}

/**
 * Function to unique number value
 * 
 * @since 1.0.0
 */
function wp_pap_get_unique() {

	static $unique = 0;
	$unique++;

	// For Elementor & Beaver Builder
	if( ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_POST['action'] ) && $_POST['action'] == 'elementor_ajax' )
	|| ( class_exists('FLBuilderModel') && ! empty( $_POST['fl_builder_data']['action'] ) )
	|| ( function_exists('vc_is_inline') && vc_is_inline() ) ) {
		$unique = current_time('timestamp') . '-' . rand();
	}

	return $unique;
}

/**
 * Function to unique number value
 * 
 * @since 1.0.0
 */
function wp_pap_get_unique_thumbs() {

	static $unique1 = 0;
	$unique1++;

	// For Elementor & Beaver Builder
	if( ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_POST['action'] ) && $_POST['action'] == 'elementor_ajax' )
	|| ( class_exists('FLBuilderModel') && ! empty( $_POST['fl_builder_data']['action'] ) )
	|| ( function_exists('vc_is_inline') && vc_is_inline() ) ) {
		$unique1 = current_time('timestamp') . '-' . rand();
	}

	return $unique1;
}

/**
 * Function to unique number value
 * 
 * @since 1.0.0
 */
function wp_pap_get_unique_main_thumb() {

	static $unique2 = 0;
	$unique2++;

	// For Elementor & Beaver Builder
	if( ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_POST['action'] ) && $_POST['action'] == 'elementor_ajax' )
	|| ( class_exists('FLBuilderModel') && ! empty( $_POST['fl_builder_data']['action'] ) )
	|| ( function_exists('vc_is_inline') && vc_is_inline() ) ) {
		$unique2 = current_time('timestamp') . '-' . rand();
	}

	return $unique2;
}

/**
 * Function to add array after specific key
 * 
 * @since 1.0.0
 */
function wp_pap_add_array( &$array, $value, $index, $from_last = false ) {

	if( is_array( $array ) && is_array( $value ) ) {

		if( $from_last ) {
			$total_count	= count( $array );
			$index			= ( ! empty( $total_count ) && ( $total_count > $index ) ) ? ( $total_count-$index ): $index;
		}

		$split_arr	= array_splice( $array, max( 0, $index ) );
		$array		= array_merge( $array, $value, $split_arr );
	}
	
	return $array;
}

/**
 * Function to get post featured image
 * 
 * @since 1.0.0
 */
function wp_pap_get_image_src( $post_id = '', $size = 'full' ) {

	$size	= ! empty( $size ) ? $size : 'full';
	$image	= wp_get_attachment_image_src( $post_id, $size );

	if( ! empty( $image ) ) {
		$image = isset( $image[0] ) ? $image[0] : '';
	}

	return $image;
}