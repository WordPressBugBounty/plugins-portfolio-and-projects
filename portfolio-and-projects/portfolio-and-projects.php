<?php
/**
 * Plugin Name: Portfolio and Projects
 * Plugin URI: https://www.essentialplugin.com/wordpress-plugin/portfolio-and-projects/
 * Description: Display Portfolio OR Projects in a grid view. Also work with Gutenberg shortcode block.
 * Author: WP OnlineSupport, Essential Plugin
 * Text Domain: portfolio-and-projects
 * Domain Path: /languages/
 * Version: 1.5.1
 * Author URI: https://www.essentialplugin.com/wordpress-plugin/portfolio-and-projects/
 *
 * @package Portfolio and Projects
 * @author Essential Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! defined( 'WP_PAP_VERSION' ) ) {
	define( 'WP_PAP_VERSION', '1.5.1' ); // Version of plugin
}

if( ! defined( 'WP_PAP_DIR' ) ) {
	define( 'WP_PAP_DIR', dirname( __FILE__ ) ); // Plugin dir
}

if( ! defined( 'WP_PAP_URL' ) ) {
	define( 'WP_PAP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}

if( ! defined( 'WP_PAP_POST_TYPE' ) ) {
	define( 'WP_PAP_POST_TYPE', 'wpos_portfolio' ); // Plugin post type
}

if( ! defined( 'WP_PAP_CAT' ) ) {
	define( 'WP_PAP_CAT', 'wppap_portfolio_cat' ); // Plugin post type
}

if( ! defined( 'WP_PAP_META_PREFIX' ) ) {
	define( 'WP_PAP_META_PREFIX', '_wp_pap_' ); // Plugin metabox prefix
}

// if( ! defined( 'WP_PAP_PLUGIN_LINK_UNLOCK' ) ) {
// 	define('WP_PAP_PLUGIN_LINK_UNLOCK','https://www.essentialplugin.com/essential-plugin-bundle-pricing/?utm_source=WP&utm_medium=Portfolio-and-Projects&utm_campaign=Features-PRO'); // Plugin link
// }

// if( ! defined( 'WP_PAP_PLUGIN_LINK_UPGRADE' ) ) {
// 	define('WP_PAP_PLUGIN_LINK_UPGRADE','https://www.essentialplugin.com/pricing/?utm_source=WP&utm_medium=Portfolio-and-Projects&utm_campaign=Upgrade-PRO'); // Plugin Check link
// }

if( ! defined( 'WP_PAP_PLUGIN_LINK_UPGRADE' ) ) {
	define('WP_PAP_PLUGIN_LINK_UPGRADE', 'https://www.wponlinesupport.com/checkout/?edd_action=add_to_cart&download_id=14791&edd_options[price_id]=7&wpos_cart_flush=1&utm_source=WP&utm_medium=Portfolio-and-Projects&utm_campaign=Upgrade-PRO'); // Plugin link
}

if( ! defined( 'WP_PAP_PLUGIN_LINK_UNLOCK' ) ) {
	define('WP_PAP_PLUGIN_LINK_UNLOCK', 'https://www.wponlinesupport.com/checkout/?edd_action=add_to_cart&download_id=14791&edd_options[price_id]=7&wpos_cart_flush=1&utm_source=WP&utm_medium=RecentPostSlider&utm_campaign=Features-PRO'); // Plugin link
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @since 1.0.0
 */
function wp_pap_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory
	$wp_pap_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wp_pap_lang_dir = apply_filters( 'wp_pap_languages_directory', $wp_pap_lang_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'portfolio-and-projects' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'portfolio-and-projects', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WP_PAP_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'portfolio-and-projects', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'portfolio-and-projects', false, $wp_pap_lang_dir );
	}
}
add_action( 'plugins_loaded', 'wp_pap_load_textdomain' );

/**
 * Activation Hook
 * Register plugin activation hook.
 * 
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wp_pap_install' );

/**
 * Deactivation Hook
 * Register plugin deactivation hook.
 * 
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wp_pap_uninstall');

/**
 * Plugin Setup On Activation
 * Does the initial setup, set default values for the plugin options.
 * 
 * @since 1.0.0
 */
function wp_pap_install() {

	// Register post type function
	wp_pap_register_post_type();

	// Register Taxonomies
	wppap_register_taxonomies();

	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();

	// Deactivate free version
	if( is_plugin_active('portfolio-and-projects-pro/portfolio-and-projects.php') ) {
		add_action('update_option_active_plugins', 'wp_pap_deactivate_pro_version');
	}
}

/**
 * Plugin On Deactivation
 * Delete plugin options and etc.
 * 
 * @since 1.0.0
 */
function wp_pap_uninstall() {

	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();
}

/**
 * Deactivate free plugin
 * 
 * @since 1.0
 */
function wp_pap_deactivate_pro_version() {
	deactivate_plugins('portfolio-and-projects-pro/portfolio-and-projects.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @since 1.0
 */
function wp_pap_admin_notice() {

	global $pagenow;

	// If not plugin screen
	if( 'plugins.php' != $pagenow ) {
		return;
	}

	// Check Lite Version
	$dir = plugin_dir_path( __DIR__ ) . 'portfolio-and-projects-pro/portfolio-and-projects.php';

	if( ! file_exists( $dir ) ) {
		return;
	}

	$notice_link		= add_query_arg( array('message' => 'wp-pap-plugin-notice'), admin_url('plugins.php') );
	$notice_transient	= get_transient( 'wp_pap_install_notice' );

	// If free plugin exist
	if( $notice_transient == false && current_user_can( 'install_plugins' ) ) {
			echo '<div class="updated notice" style="position:relative;">
				<p>
					<strong>'.esc_html__('Thank you for activating Portfolio and Projects', 'portfolio-and-projects').'</strong>.<br/>
					'.esc_html__('It looks like you had PRO version Portfolio and Projects Pro of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'portfolio-and-projects').'
				</p>
				<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
			</div>';
	}
}
add_action( 'admin_notices', 'wp_pap_admin_notice');

// Functions File
require_once( WP_PAP_DIR . '/includes/wp-pap-functions.php' );

// Plugin Post Type File
require_once( WP_PAP_DIR . '/includes/wp-pap-post-types.php' );

// Script File
require_once( WP_PAP_DIR . '/includes/class-wp-pap-script.php' );

// Admin Class File
require_once( WP_PAP_DIR . '/includes/admin/class-wp-pap-admin.php' );

// Shortcode File
require_once( WP_PAP_DIR . '/includes/shortcode/wp-pap-gallery-slider.php' );

/* Recommended Plugins Starts */
if ( is_admin() ) {
	require_once( WP_PAP_DIR . '/wpos-plugins/wpos-recommendation.php' );

	wpos_espbw_init_module( array(
							'prefix'	=> 'wp_pap',
							'menu'		=> 'edit.php?post_type='.WP_PAP_POST_TYPE,
							'position'	=> 4,
						));
}
/* Recommended Plugins Ends */

/* Plugin Analytics Data */
if( ! function_exists( 'wp_pap_analytics_load' ) ) {
	function wp_pap_analytics_load() {

		require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

		$wpos_analytics =  wpos_anylc_init_module( array(
								'id'			=> 65,
								'file'			=> plugin_basename( __FILE__ ),
								'name'			=> 'Portfolio and Projects',
								'slug'			=> 'portfolio-and-projects',
								'type'			=> 'plugin',
								'menu'			=> 'edit.php?post_type=wpos_portfolio',
								'text_domain'	=> 'portfolio-and-projects',
							));

		return $wpos_analytics;
	}

	// Init Analytics
	wp_pap_analytics_load();
}
/* Plugin Analytics Data Ends */