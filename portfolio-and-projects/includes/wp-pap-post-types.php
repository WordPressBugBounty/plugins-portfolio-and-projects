<?php
/**
 * Register Post type functionality
 *
 * @package Portfolio and Projects
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to register post type
 * 
 * @since 1.0.0
 */
function wp_pap_register_post_type() {

	$wp_pap_post_lbls = apply_filters( 'wp_pap_post_labels', array(
								'name'					=> __( 'Portfolios & Projects', 'portfolio-and-projects' ),
								'singular_name'			=> __( 'Portfolio', 'portfolio-and-projects' ),
								'all_items'				=> __( 'All Portfolios', 'portfolio-and-projects' ),
								'add_new'				=> __( 'Add Portfolio', 'portfolio-and-projects' ),
								'add_new_item'			=> __( 'Add New Portfolio', 'portfolio-and-projects' ),
								'edit_item'				=> __( 'Edit Portfolio', 'portfolio-and-projects' ),
								'new_item'				=> __( 'New Portfolio', 'portfolio-and-projects' ),
								'view_item'				=> __( 'View Portfolio', 'portfolio-and-projects' ),
								'search_items'			=> __( 'Search Portfolio', 'portfolio-and-projects' ),
								'not_found'				=> __( 'No Portfolio found', 'portfolio-and-projects' ),
								'not_found_in_trash'	=> __( 'No Portfolio found in Trash', 'portfolio-and-projects' ),
								'menu_name'				=> __( 'Portfolio', 'portfolio-and-projects' ),
								'featured_image'		=> __( 'Portfolio Cover Image', 'portfolio-and-projects' ),
								'set_featured_image'	=> __( 'Set Portfolio Cover Image', 'portfolio-and-projects' ),
								'remove_featured_image'	=> __( 'Remove Portfolio Cover Image', 'portfolio-and-projects' ),
								'use_featured_image'	=> __( 'Use as Portfolio Cover Image', 'portfolio-and-projects' ),
							));

	$wp_pap_slider_args = array(
		'labels'			=> $wp_pap_post_lbls,
		'public'			=> true,
		'show_ui'			=> true,
		'query_var'			=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'menu_icon'			=> 'dashicons-portfolio',
		'rewrite'			=> array( 
									'slug'			=> 'wp-portfolio',
									'with_front'	=> false
								),
		'supports'			=> array( 'title', 'editor', 'thumbnail', 'publicize' )
	);

	// Register slick slider post type
	register_post_type( WP_PAP_POST_TYPE, apply_filters( 'wp_pap_registered_post_type_args', $wp_pap_slider_args ) );
}

// Action to register plugin post type
add_action( 'init', 'wp_pap_register_post_type' );

/**
 * Function to regoster category for portfolio
 * 
 * @since 1.0.0
 */

function wppap_register_taxonomies() {

	$cat_labels = apply_filters( 'wppap_cat_labels', array(
		'name'				=> __( 'Portfolio Categories', 'portfolio-and-projects' ),
		'singular_name'		=> __( 'Category', 'portfolio-and-projects' ),
		'search_items'		=> __( 'Search Portfolio Category', 'portfolio-and-projects' ),
		'all_items'			=> __( 'All Category', 'portfolio-and-projects' ),
		'parent_item'		=> __( 'Parent Category', 'portfolio-and-projects' ),
		'parent_item_colon' => __( 'Parent Category:', 'portfolio-and-projects' ),
		'edit_item'			=> __( 'Edit Portfolio Category', 'portfolio-and-projects' ),
		'update_item'		=> __( 'Update Portfolio Category', 'portfolio-and-projects' ),
		'add_new_item'		=> __( 'Add New Portfolio Category', 'portfolio-and-projects' ),
		'new_item_name'		=> __( 'New Category Name', 'portfolio-and-projects' ),
		'menu_name'			=> __( 'Category', 'portfolio-and-projects' ),
	));

	$cat_args = array(
		'labels'			=> $cat_labels,
		'public'			=> true,
		'hierarchical'		=> true,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'query_var'			=> true,
		'rewrite'			=> array(
									'slug'			=> 'portfolio-category',
									'with_front'	=> false,
								),
	);

	// Register Logo Showcase category
	register_taxonomy( WP_PAP_CAT, array( WP_PAP_POST_TYPE ), apply_filters( 'wp_pap_portfolio_cat_args', $cat_args ) );
}

/* Register Taxonomy */
add_action( 'init', 'wppap_register_taxonomies' );

/**
 * Function to update post message for portfolio
 * 
 * @since 1.0.0
 */
function wp_pap_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[WP_PAP_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Image Gallery updated.', 'portfolio-and-projects' ) ),
		2 => __( 'Custom field updated.', 'portfolio-and-projects' ),
		3 => __( 'Custom field deleted.', 'portfolio-and-projects' ),
		4 => __( 'Image Gallery updated.', 'portfolio-and-projects' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Image Gallery restored to revision from %s', 'portfolio-and-projects' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Image Gallery published.', 'portfolio-and-projects' ) ),
		7 => __( 'Image Gallery saved.', 'portfolio-and-projects' ),
		8 => sprintf( __( 'Image Gallery submitted.', 'portfolio-and-projects' ) ),
		9 => sprintf( __( 'Image Gallery scheduled for: <strong>%1$s</strong>.', 'portfolio-and-projects' ),
			date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Image Gallery draft updated.', 'portfolio-and-projects' ) ),
	);

	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'wp_pap_post_updated_messages' );