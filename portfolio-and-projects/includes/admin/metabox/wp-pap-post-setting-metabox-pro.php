<?php
/**
 * Function Custom meta box for Premium
 * 
 * @package Portfolio and Projects
 * @since 1.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<!-- <div class="wp-pap-black-friday-banner-wrp">
		<a href="<?php // echo esc_url( WP_PAP_PLUGIN_LINK_UNLOCK ); ?>" target="_blank"><img style="width: 100%;" src="<?php // echo esc_url( WP_PAP_URL ); ?>assets/images/black-friday-banner.png" alt="black-friday-banner" /></a>
	</div> -->

<strong style="color:#2ECC71; font-weight: 700;"><?php echo sprintf( __( ' <a href="%s" target="_blank" style="color:#2ECC71;">Upgrade To Pro</a> and Get Designs, Optimization, Security, Backup, Migration Solutions @ one stop.', 'portfolio-and-projects'), WP_PAP_PLUGIN_LINK_UNLOCK); ?></strong>

<table class="form-table wp-pap-metabox-table">
	<tbody>
		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'Layouts ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' ); ?></span>
			</th>
			<td>
				<span class="description"><strong><?php esc_html_e( '2 (Grid, Filter). In lite version only 1 layout.', 'portfolio-and-projects' ); ?></strong></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'Designs ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
			</th>
			<td>
				<span class="description"><strong>15+</strong><?php esc_html_e(' In lite version only one design.', 'portfolio-and-projects' ); ?></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'Portfolio Detail View Styles ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
			</th>
			<td>
				<span class="description"><strong><?php esc_html_e( 'Display inline and popup style in lite version only inline style', 'portfolio-and-projects' ); ?></strong></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'Pagination ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
			</th>
			<td>
				<span class="description"><?php esc_html_e( 'Display pagination.', 'portfolio-and-projects' ); ?></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'Query Offset ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' ); ?></span>
			</th>
			<td>
				<span class="description"><?php esc_html_e( 'You can set query offset.', 'portfolio-and-projects' ); ?></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'Link and Link Target ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
			</th>
			<td>
				<span class="description"><?php esc_html_e( 'Option to enable/disable portfolio item link and Open link in same window OR in new tab.', 'portfolio-and-projects' ); ?></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'WP Templating Features ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
			</th>
			<td>
				<span class="description"><?php esc_html_e( 'You can modify plugin html/designs in your current theme.', 'portfolio-and-projects' ); ?></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'Shortcode Generator ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
			</th>
			<td>
				<span class="description"><?php esc_html_e( 'Play with all shortcode parameters with preview panel. No documentation required.' , 'portfolio-and-projects' ); ?></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'Drag & Drop Slide Order Change ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
			</th>
			<td>
				<span class="description"><?php esc_html_e( 'Arrange your desired slides with your desired order and display.' , 'portfolio-and-projects' ); ?></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'Page Builder Support ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
			</th>
			<td>
				<span class="description"><strong><?php esc_html_e( 'Gutenberg Block, Elementor, Beaver Builder, SiteOrigin, Divi, Visual Composer and Fusion Page Builder Support', 'portfolio-and-projects' ); ?></strong></span>
			</td>
		</tr>

		<tr class="wp-pap-feature">
			<th>
				<?php esc_html_e( 'Exclude Protfolio Slider Post and Exclude Some Categories ', 'portfolio-and-projects' ); ?><span class="wp-pap-tag"><?php esc_html_e( 'PRO','portfolio-and-projects' );?></span>
			</th>
			<td>
				<span class="description"><strong><?php esc_html_e( 'Do not display the portfolio & Do not display the portfolio for particular categories.', 'portfolio-and-projects' ); ?></strong></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .wp-pap-metabox-table -->