<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Portfolio and Projects
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wp_Pap_Admin {

	function __construct() {

		// Action to register plugin settings
		add_action ( 'admin_init', array( $this, 'wp_pap_admin_processes' ) );

		// Action to add admin menu
		add_action( 'admin_menu', array( $this, 'wp_pap_register_menu' ) );

		// Action to add metabox
		add_action( 'add_meta_boxes', array( $this, 'wp_pap_post_sett_metabox' ) );

		// Action to save metabox
		add_action( 'save_post_'.WP_PAP_POST_TYPE, array( $this, 'wp_pap_save_metabox_value' ) );

		// Action to add custom column to Gallery listing
		add_filter( 'manage_'.WP_PAP_POST_TYPE.'_posts_columns', array($this, 'wp_pap_posts_columns' ) );

		// Action to add custom column data to Gallery listing
		add_action( 'manage_'.WP_PAP_POST_TYPE.'_posts_custom_column', array( $this, 'wp_pap_post_columns_data' ), 10, 2 );

		// Action to add Attachment Popup HTML
		add_action( 'admin_footer', array( $this,'wp_pap_image_update_popup_html' ) );

		// Ajax call to get attachment edit form
		add_action( 'wp_ajax_wp_pap_get_attachment_edit_form', array( $this, 'wp_pap_get_attachment_edit_form' ) );

		// Ajax call to save attachment data
		add_action( 'wp_ajax_wp_pap_save_attachment_data', array( $this, 'wp_pap_save_attachment_data' ) );
	}

	/**
	 * Function register setings
	 * 
	 * @since 1.3
	 */
	function wp_pap_admin_processes() {

		// If plugin notice is dismissed
		if( isset( $_GET['message'] ) && 'wp-pap-plugin-notice' == $_GET['message'] ) {
			set_transient( 'wp_pap_install_notice', true, 604800 );
		}
	}

	/**
	 * Function to add menu
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_register_menu() {

		// How It Work Page
		add_submenu_page( 'edit.php?post_type='.WP_PAP_POST_TYPE, __( 'How it works, our plugins and offers', 'portfolio-and-projects' ), __( 'How It Works', 'portfolio-and-projects' ), 'manage_options', 'pap-designs', array( $this, 'wp_pap_designs_page' ) );

		// Register plugin premium page
		add_submenu_page( 'edit.php?post_type='.WP_PAP_POST_TYPE, __( 'Upgrade To Premium - Portfolio and Projects', 'portfolio-and-projects' ), '<span style="color:#2ECC71">'.__( 'Upgrade To PRO', 'portfolio-and-projects' ).'</span>', 'manage_options', 'wp-pap-premium', array( $this, 'wp_pap_premium_page' ) );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_designs_page() {
		include_once( WP_PAP_DIR . '/includes/admin/pap-how-it-work.php' );
	}

	/**
	 * Premium Page Html
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_premium_page() {
		include_once( WP_PAP_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_post_sett_metabox() {

		// Getting all post types
		$all_post_types = array( WP_PAP_POST_TYPE );

		add_meta_box( 'wp-pap-post-sett', __( 'Portfolio and Projects - Settings', 'portfolio-and-projects' ), array( $this, 'wp_pap_post_sett_mb_content' ), $all_post_types, 'normal', 'high' );

		add_meta_box( 'wp-pap-post-metabox-pro', __('More Premium - Settings', 'portfolio-and-projects'), array( $this, 'wp_pap_post_sett_box_callback_pro' ), $all_post_types, 'normal', 'default' );
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_post_sett_mb_content() {
		include_once( WP_PAP_DIR .'/includes/admin/metabox/wp-pap-sett-metabox.php');
	}

	/**
	 * Function to handle 'premium ' metabox HTML
	 * 
	 * @since 1.2.1
	 */
	function wp_pap_post_sett_box_callback_pro(){
		include_once( WP_PAP_DIR .'/includes/admin/metabox/wp-pap-post-setting-metabox-pro.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_save_metabox_value( $post_id ) {

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )							// Check Autosave
		|| ( empty( $_POST['post_ID'] ) || absint( $_POST['post_ID'] ) != $post_id )	// Check Revision
		|| ( ! current_user_can('edit_post', $post_id) ) )								// Check if user can edit the post.
		{
			return $post_id;
		}

		$prefix = WP_PAP_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$gallery_imgs = isset( $_POST['wp_pap_img'] ) ? wp_pap_clean( $_POST['wp_pap_img'] ) : '';

		// Getting Slider Variables
		$project_link		= isset( $_POST[$prefix.'project_url'] )			? wp_pap_clean_url( $_POST[$prefix.'project_url'] )		: '';
		$arrow_slider		= ! empty( $_POST[$prefix.'arrow_slider'] )			? 'true'		: 'false';
		$pagination_slider	= ! empty( $_POST[$prefix.'pagination_slider'] )	? 'true'		: 'false';
		$animation_slider	= isset( $_POST[$prefix.'animation_slider'] )		? wp_pap_clean( $_POST[$prefix.'animation_slider'] )	: 'slide';

		// Updating Slider settings
		update_post_meta( $post_id, $prefix.'gallery_id', $gallery_imgs );
		update_post_meta( $post_id, $prefix.'arrow_slider', $arrow_slider );
		update_post_meta( $post_id, $prefix.'pagination_slider', $pagination_slider );
		update_post_meta( $post_id, $prefix.'animation_slider', $animation_slider );
		update_post_meta( $post_id, $prefix.'project_url', $project_link );
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_posts_columns( $columns ) {

		$new_columns['wp_pap_photos'] = esc_html__( 'Number of Photos', 'portfolio-and-projects' );

		$columns = wp_pap_add_array( $columns, $new_columns, 1, true );

		return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_post_columns_data( $column, $post_id ) {

		// Taking some variables
		$prefix = WP_PAP_META_PREFIX;

		switch ( $column ) {

			case 'wp_pap_photos':

				$total_photos = get_post_meta( $post_id, $prefix.'gallery_id', true );

				echo ! empty( $total_photos ) ? esc_html( count( $total_photos ) ) : '--';
				break;
		}
	}

	/**
	 * Image data popup HTML
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_image_update_popup_html() {

		global $post_type;

		$registered_posts = array( WP_PAP_POST_TYPE ); // Getting registered post types

		if( in_array( $post_type, $registered_posts ) ) {
			include_once( WP_PAP_DIR .'/includes/admin/settings/wp-pap-img-popup.php');
		}
	}

	/**
	 * Get attachment edit form
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_get_attachment_edit_form() {

		// Taking some defaults
		$result				= array();
		$result['success']	= 0;
		$result['msg']		= esc_js ( __( 'Sorry, Something happened wrong.', 'portfolio-and-projects' ) );
		$attachment_id		= ! empty( $_POST['attachment_id'] )	? wp_pap_clean_number( $_POST['attachment_id'] )	: '';
		$nonce				= ! empty( $_POST['nonce'] )			? wp_pap_clean( $_POST['nonce'] )					: '';

		// Capability check
		if ( ! current_user_can( 'upload_files' ) ) {
			wp_send_json( $result );
		}

		// Verify nonce
		if ( empty( $attachment_id ) || ! wp_verify_nonce( $nonce, 'wp-pap-edit-attachment-data' ) ) {
			wp_send_json( $result );
		}

		// Verify user can edit this attachment
		if ( ! current_user_can( 'edit_post', $attachment_id ) ) {
			wp_send_json( $result );
		}
		
		$attachment_post = get_post( $attachment_id );


		if ( ! empty( $attachment_post ) ) {
			ob_start();
			include( WP_PAP_DIR . '/includes/admin/settings/wp-pap-img-popup-data.php' ); // Popup Data File
			$attachment_data = ob_get_clean();

			wp_send_json( array(
				'success' => 1,
				'msg'     => __( 'Attachment Found.', 'portfolio-and-projects' ),
				'data'    => $attachment_data,
			) );
		}

		wp_send_json( $result );
	}

	/**
	 * Get attachment edit form
	 * 
	 * @since 1.0.0
	 */
	function wp_pap_save_attachment_data() {

		$prefix				= WP_PAP_META_PREFIX;
		$result				= array();
		$result['success']	= 0;
		$result['msg']		= esc_js( __( 'Sorry, Something happened wrong.', 'portfolio-and-projects' ) );
		$attachment_id		= ! empty( $_POST['attachment_id'] )	? wp_pap_clean_number( $_POST['attachment_id'] ) : '';
		$nonce				= ! empty( $_POST['nonce'] )			? wp_pap_clean( $_POST['nonce'] )	: '';
		$form_data			= parse_str( $_POST['form_data'], $form_data_arr );

		if( ! empty( $attachment_id ) && ! empty( $form_data_arr ) && wp_verify_nonce( $nonce, "wp-pap-save-attachment-data-{$attachment_id}" ) ) {

			// Getting attachment post
			$wp_pap_attachment_post = get_post( $attachment_id );

			// If post type is attachment
			if( isset( $wp_pap_attachment_post->post_type ) && 'attachment' == $wp_pap_attachment_post->post_type ) {

				$post_args = array(
									'ID'			=> $attachment_id,
									'post_title'	=> ! empty( $form_data_arr['wp_pap_attachment_title'] ) ? wp_pap_clean_html( $form_data_arr['wp_pap_attachment_title'] ) : $wp_pap_attachment_post->post_name,
								);
				$update = wp_update_post( $post_args );

				if( ! is_wp_error( $update ) ) {

					update_post_meta( $attachment_id, '_wp_attachment_image_alt', wp_pap_clean( $form_data_arr['wp_pap_attachment_alt'] ) );

					$result['success']	= 1;
					$result['msg']		= esc_js( __( 'Your changes saved successfully.', 'portfolio-and-projects' ) );
				}
			}
		}

		wp_send_json( $result );
	}
}

$wp_pap_admin = new Wp_Pap_Admin();