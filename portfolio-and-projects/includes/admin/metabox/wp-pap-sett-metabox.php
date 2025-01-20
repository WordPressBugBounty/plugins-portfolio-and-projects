<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package Portfolio and Projects
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$prefix				= WP_PAP_META_PREFIX; // Metabox prefix
$project_url		= get_post_meta( $post->ID, $prefix.'project_url', true );
$gallery_imgs		= get_post_meta( $post->ID, $prefix.'gallery_id', true );
$animation_slider	= get_post_meta( $post->ID, $prefix.'animation_slider', true );
$arrow_slider 		= get_post_meta( $post->ID, $prefix.'arrow_slider', true );
$pagination_slider	= get_post_meta( $post->ID, $prefix.'pagination_slider', true );

$no_img_cls			= ! empty( $gallery_imgs ) ? 'wp-pap-hide' : '';
$arrow_slider		= ( $arrow_slider == 'false' ) ? 'false' : 'true';
$pagination_slider	= ( $pagination_slider == 'false' ) ? 'false' : 'true';
?>

<table class="form-table wp-pap-post-sett-table">
	<tbody>
		<tr>
			<th>
				<label for="wp-pap-project-link"><?php esc_html_e('Portfolio Link', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="text" id="wp-pap-project-link" class="large-text wp-pap-project-link" name="<?php echo esc_attr( $prefix ) ?>project_url" value="<?php echo esc_url( $project_url ); ?>"><br/>
				<span class="description"><?php esc_html_e( 'Enter portfolio link.', 'portfolio-and-projects' ); ?></span>
			</td>
		</tr>

		<tr>
			<th>
				<label for="wp-pap-gallery-imgs"><?php esc_html_e('Choose Portfolio Gallery Images', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<button type="button" class="button button-secondary wp-pap-img-uploader" id="wp-pap-gallery-imgs" data-multiple="true" data-button-text="<?php esc_attr_e('Add to Gallery', 'portfolio-and-projects'); ?>" data-title="<?php esc_attr_e('Add Images to Gallery', 'portfolio-and-projects'); ?>"><i class="dashicons dashicons-format-gallery"></i> <?php esc_html_e('Gallery Images', 'portfolio-and-projects'); ?></button>
				<button type="button" class="button button-secondary wp-pap-del-gallery-imgs"><i class="dashicons dashicons-trash"></i> <?php esc_html_e('Remove Gallery Images', 'portfolio-and-projects'); ?></button><br/>

				<div class="wp-pap-gallery-imgs-prev wp-pap-imgs-preview wp-pap-gallery-imgs-wrp" data-nonce="<?php echo esc_attr( wp_create_nonce("wp-pap-edit-attachment-data") ); ?>">
					<?php if( ! empty( $gallery_imgs ) ) {
						foreach ($gallery_imgs as $img_key => $img_data) {

							$attachment_url			= wp_get_attachment_thumb_url( $img_data );
							$attachment_edit_link	= get_edit_post_link( $img_data );
					?>
							<div class="wp-pap-img-wrp">
								<div class="wp-pap-img-tools wp-pap-hide">
									<span class="wp-pap-tool-icon wp-pap-edit-img dashicons dashicons-edit" title="<?php esc_attr_e( 'Edit Image in Popup', 'portfolio-and-projects' ); ?>"></span>
									<a href="<?php echo esc_url( $attachment_edit_link ); ?>" target="_blank" title="<?php esc_attr_e( 'Edit Image', 'portfolio-and-projects' ); ?>"><span class="wp-pap-tool-icon wp-pap-edit-attachment dashicons dashicons-visibility"></span></a>
									<span class="wp-pap-tool-icon wp-pap-del-tool wp-pap-del-img dashicons dashicons-no" title="<?php esc_attr_e( 'Remove Image', 'portfolio-and-projects' ); ?>"></span>
								</div>
								<img class="wp-pap-img" src="<?php echo esc_url( $attachment_url ); ?>" alt="" />
								<input type="hidden" class="wp-pap-attachment-no" name="wp_pap_img[]" value="<?php echo esc_attr( $img_data ); ?>" />
							</div>
					<?php }
					} ?>

					<p class="wp-pap-img-placeholder <?php echo esc_attr( $no_img_cls ); ?>"><?php esc_html_e( 'No Gallery Images', 'portfolio-and-projects' ); ?></p>
				</div><!-- end .wp-pap-imgs-preview -->
				<span class="description"><?php esc_html_e('Choose your desired images for gallery. Hold Ctrl key to select multiple images at a time.', 'portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr>
			<th colspan="2">
				<div class="wp-pap-sett-title"><?php esc_html_e('Portfolio Gallery Slider Settings', 'portfolio-and-projects'); ?></div>
			</th>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-slider-arrow"><?php esc_html_e('Slider Arrow', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="checkbox" value="true" name="<?php echo esc_attr( $prefix ); ?>arrow_slider" id="wp-pap-slider-arrow" class="wp-pap-slider-arrow" <?php checked( 'true', $arrow_slider ); ?> /><br/>
				<span class="description"><?php esc_html_e('Check this box to enable gallery slider arrow.', 'portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-slider-pagination"><?php esc_html_e('Slider Pagination Dots', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="checkbox" name="<?php echo esc_attr( $prefix ); ?>pagination_slider" value="true" id="wp-pap-slider-pagination" class="wp-pap-slider-pagination" <?php checked( 'true', $pagination_slider ); ?> /><br/>
				<span class="description"><?php esc_html_e('Check this box to enable gallery slider pagination dots.','portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-slider-effect"><?php esc_html_e('Effect', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<select name="<?php echo esc_attr( $prefix ); ?>animation_slider" id="wp-pap-slider-effect" class="wp-pap-slider-effect">
					<option value="slide" <?php if($animation_slider == 'slide'){ echo 'selected'; } ?>><?php esc_html_e('Slide', 'portfolio-and-projects'); ?></option>
					<option value="fade" <?php if($animation_slider == 'fade'){ echo 'selected'; } ?>><?php esc_html_e('Fade', 'portfolio-and-projects'); ?></option>
				</select><br/>
				<span class="description"><?php esc_html_e('Select slider effect.', 'portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<label><?php esc_html_e( 'Slider Autoplay ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
				</label>
			</th>
			<td>
				<input type="checkbox" name="<?php echo esc_attr( $prefix ); ?>autoplay_slider" value="1" disabled="" /><br/>
				<span class="description"><?php esc_html_e('Check this box to enable slider auto play.', 'portfolio-and-projects'); ?></span> 
				<strong style="color:#2ECC71; font-weight: 700;"><?php echo sprintf( __( ' <a href="%s" target="_blank" style="color:#2ECC71;">Upgrade To Pro</a> and Get Designs, Optimization, Security, Backup, Migration Solutions @ one stop.', 'portfolio-and-projects'), WP_PAP_PLUGIN_LINK_UNLOCK); ?></strong>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<label><?php esc_html_e( 'Slider Loop ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
				</label>
			</th>
			<td>
				<input type="checkbox" name="<?php echo esc_attr( $prefix ); ?>autoplay_slider" value="1" disabled="" /><br/>
				<span class="description"><?php esc_html_e( 'Check this box to run slider continuously.', 'portfolio-and-projects' ); ?></span> 
				<strong style="color:#2ECC71; font-weight: 700;"><?php echo sprintf( __( ' <a href="%s" target="_blank" style="color:#2ECC71;">Upgrade To Pro</a> and Get Designs, Optimization, Security, Backup, Migration Solutions @ one stop.', 'portfolio-and-projects'), WP_PAP_PLUGIN_LINK_UNLOCK); ?></strong>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<label><?php esc_html_e('Slide to Show ', 'portfolio-and-projects'); ?><span class="wp-pap-tag"><?php esc_html_e('PRO','portfolio-and-projects');?></span>
				</label>
			</th>
			<td>
				<input type="text" name="<?php echo esc_attr( $prefix ); ?>slide_to_show_slider" class="medium-text" disabled="" /><br/>
				<span class="description"><?php esc_html_e('Enter number of slides to show at a time.', 'portfolio-and-projects'); ?></span> 
				<strong style="color:#2ECC71; font-weight: 700;"><?php echo sprintf( __( ' <a href="%s" target="_blank" style="color:#2ECC71;">Upgrade To Pro</a> and Get Designs, Optimization, Security, Backup, Migration Solutions @ one stop.', 'portfolio-and-projects'), WP_PAP_PLUGIN_LINK_UNLOCK); ?></strong>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<label><?php esc_html_e('Autoplay Interval ', 'portfolio-and-projects'); ?><span class="wp-pap-tag"><?php esc_html_e('PRO','portfolio-and-projects');?></span>
				</label>
			</th>
			<td>
				<input type="text" name="<?php echo esc_attr( $prefix ); ?>autoplayspeed_slider" class="medium-text" disabled="" /><br/>
				<span class="description"><?php esc_html_e('Enter number of slider auto play interval.', 'portfolio-and-projects'); ?></span> 
				<strong style="color:#2ECC71; font-weight: 700;"><?php echo sprintf( __( ' <a href="%s" target="_blank" style="color:#2ECC71;">Upgrade To Pro</a> and Get Designs, Optimization, Security, Backup, Migration Solutions @ one stop.', 'portfolio-and-projects'), WP_PAP_PLUGIN_LINK_UNLOCK); ?></strong>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<label><?php esc_html_e( 'Speed ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
				</label>
			</th>
			<td>
				<input type="text" name="<?php echo esc_attr( $prefix ); ?>speed_slider" class="medium-text" disabled="" /><br/>
				<span class="description"><?php esc_html_e('Enter number of slider speed.', 'portfolio-and-projects'); ?></span> 
				<strong style="color:#2ECC71; font-weight: 700;"><?php echo sprintf( __( ' <a href="%s" target="_blank" style="color:#2ECC71;">Upgrade To Pro</a> and Get Designs, Optimization, Security, Backup, Migration Solutions @ one stop.', 'portfolio-and-projects'), WP_PAP_PLUGIN_LINK_UNLOCK); ?></strong>
			</td>
		</tr>
	</tbody>
</table><!-- end .wp-pap-post-sett-table -->