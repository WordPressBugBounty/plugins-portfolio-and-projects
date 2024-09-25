<?php
/**
 * Image Data Popup
 *
 * @package Portfolio and Projects
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="wp-pap-img-data-wrp wp-pap-hide">
	<div class="wp-pap-img-data-cnt">

		<div class="wp-pap-img-cnt-block">
			<div class="wp-pap-popup-close wp-pap-popup-close-wrp"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/close.png" alt="<?php esc_attr_e( 'Close', 'portfolio-and-projects' ); ?>" title="<?php esc_attr_e( 'Close', 'portfolio-and-projects' ); ?>" /></div>

			<div class="wp-pap-popup-body-wrp">
			</div><!-- end .wp-pap-popup-body-wrp -->

			<div class="wp-pap-img-loader"><?php esc_html_e( 'Please Wait', 'portfolio-and-projects' ); ?> <span class="spinner"></span></div>

		</div><!-- end .wp-pap-img-cnt-block -->

	</div><!-- end .wp-pap-img-data-cnt -->
</div><!-- end .wp-pap-img-data-wrp -->
<div class="wp-pap-popup-overlay"></div>