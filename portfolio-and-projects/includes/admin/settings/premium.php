<?php
/**
 * Plugin Premium Offer Page
 *
 * @package Portfolio and Projects
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="wrap">

	<h2 style="text-align: center;"><?php esc_html_e( 'Portfolio and Projects with ', 'portfolio-and-projects' ); ?><span class="wpos-epb"><?php esc_html_e( 'Essential Plugin Bundle', 'portfolio-and-projects' ); ?></span></h2><br />

	<style>
		.wpos-plugin-pricing-table thead th h2{font-weight: 400; font-size: 2.4em; line-height:normal; margin:0px; color: #2ECC71;}
		.wpos-plugin-pricing-table thead th h2 + p{font-size: 1.25em; line-height: 1.4; color: #999; margin:5px 0 5px 0;}

		table.wpos-plugin-pricing-table{width:100%; text-align: left; border-spacing: 0; border-collapse: collapse; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}

		.wpos-plugin-pricing-table th, .wpos-plugin-pricing-table td{font-size:14px; line-height:normal; color:#444; vertical-align:middle; padding:12px;}

		.wpos-plugin-pricing-table colgroup:nth-child(1) { width: 31%; border: 0 none; }
		.wpos-plugin-pricing-table colgroup:nth-child(2) { width: 22%; border: 1px solid #ccc; }
		.wpos-plugin-pricing-table colgroup:nth-child(3) { width: 25%; border: 10px solid #2ECC71; }

		/* Tablehead */
		.wpos-plugin-pricing-table thead th {background-color: #fff; background:linear-gradient(to bottom, #ffffff 0%, #ffffff 100%); text-align: center; position: relative; border-bottom: 1px solid #ccc; padding: 1em 0 1em; font-weight:400; color:#999;}
		.wpos-plugin-pricing-table thead th:nth-child(1) {background: transparent;}
		.wpos-plugin-pricing-table thead th:nth-child(3) p{color:#000;}	
		.wpos-plugin-pricing-table thead th p.promo {font-size: 14px; color: #fff; position: absolute; bottom:0; left: -17px; z-index: 1000; width: 100%; margin: 0; padding: .625em 17px .75em; background-color: #ca4a1f; box-shadow: 0 2px 4px rgba(0,0,0,.25); border-bottom: 1px solid #ca4a1f;}
		.wpos-plugin-pricing-table thead th p.promo:before {content: ""; position: absolute; display: block; width: 0px; height: 0px; border-style: solid; border-width: 0 7px 7px 0; border-color: transparent #900 transparent transparent; bottom: -7px; left: 0;}
		.wpos-plugin-pricing-table thead th p.promo:after {content: ""; position: absolute; display: block; width: 0px; height: 0px; border-style: solid; border-width: 7px 7px 0 0; border-color: #900 transparent transparent transparent; bottom: -7px; right: 0;}

		/* Tablebody */
		.wpos-plugin-pricing-table tbody th{background: #fff; border-left: 1px solid #ccc; font-weight: 600;}
		.wpos-plugin-pricing-table tbody th span{font-weight: normal; font-size: 87.5%; color: #999; display: block;}

		.wpos-plugin-pricing-table tbody td{background: #fff; text-align: center;}
		.wpos-plugin-pricing-table tbody td .dashicons{height: auto; width: auto; font-size:30px;}
		.wpos-plugin-pricing-table tbody td .dashicons-no-alt{color: #ff2700;}
		.wpos-plugin-pricing-table tbody td .dashicons-yes{color: #2ECC71;}

		.wpos-plugin-pricing-table tbody tr:nth-child(even) th,
		.wpos-plugin-pricing-table tbody tr:nth-child(even) td { background: #f5f5f5; border: 1px solid #ccc; border-width: 1px 0 1px 1px; }
		.wpos-plugin-pricing-table tbody tr:last-child td {border-bottom: 0 none;}

		/* Table Footer */
		.wpos-plugin-pricing-table tfoot th, .wpos-plugin-pricing-table tfoot td{text-align: center; border-top: 1px solid #ccc;}
		.wpos-plugin-pricing-table tfoot a, .wpos-plugin-pricing-table thead a{font-weight: 600; color: #fff; text-decoration: none; text-transform: uppercase; display: inline-block; padding: 1em 2em; background: #ff2700; border-radius: .2em;}

		.wpos-epb{color:#ff2700 !important;}

		/* welcome-screen-css start -M */
		.wp-pap-sf-btn{display: inline-block; font-size: 18px; padding: 10px 25px; border-radius: 100px;  background-color: #ff5d52; border-color: #ff5d52; color: #fff !important; font-weight: 600; text-decoration: none;}
		.wp-pap-sf-btn:hover,
		.wp-pap-sf-btn:focus{background-color: #ff5d52; border-color: #ff5d52;}
		.wp-pap-inner-Bonus-class{background: #46b450;
		  border-radius: 20px;
		  font-weight: 700;
		  padding: 5px 10px;
		  color: #fff;
		    line-height: 1;
		  font-size: 12px;}

		.wp-pap-black-friday-feature{padding: 30px 40px;
		  background: #fafafa;
		  border-radius: 20px 20px 0 0;
		  gap: 60px;
		  align-items: center;
		  flex-direction: row;
		  display: flex;}
		.wp-pap-black-friday-feature .wp-pap-inner-deal-class{flex-direction: column;
		  gap: 15px;
		  display: flex;
		  align-items: flex-start;}
		.wp-pap-black-friday-feature ul li{text-align: left;}
		.wp-pap-black-friday-feature .wp-pap-inner-list-class {
		  display: grid;
		  grid-template-columns: repeat(4,1fr);
		  gap: 10px;
		}
		.wp-pap-black-friday-feature .wp-pap-list-img-class {
		  min-height: 95px;
		  display: flex;
		  align-items: center;
		  background: #fff;
		  border-radius: 20px;
		  flex-direction: column;
		  gap: 10px;
		  justify-content: center;
		  padding: 10px;color: #000;
		  font-size: 12px;
		}
		.wp-pap-black-friday-banner-wrp .wp-pap-list-img-class img {
		  width: 100%;
		  flex: 0 0 40px;
		  font-size: 20px;
		  height: 40px;
		  width: 40px;
		  box-shadow: inset 0px 0px 15px 2px #c4f2ac;
		  border-radius: 14px;
		  display: flex;
		  justify-content: center;
		  align-items: center;
		  padding: 10px;
		}

		.wp-pap-main-feature-item{background: #fafafa;
		  padding: 20px 15px 40px;
		  border-radius: 0 0 20px 20px;margin-bottom: 40px;}
		.wp-pap-inner-feature-item{display: flex;
		  gap: 30px;
		  padding: 0 15px;}
		.wp-pap-list-feature-item {
		  border: 1px solid #ddd;
		  padding: 10px 15px;
		  border-radius: 8px;text-align: left;
		}
		.wp-pap-list-feature-item img {
		  width: 36px !important;
		  padding: 5px;
		  border: 1px solid #ccc;
		  border-radius: 50%;margin-bottom: 5px;
		}
		.wp-pap-list-feature-item h5{margin: 0;
		  font-weight: bold;font-size: 16px;
		  text-decoration: underline;
		  text-underline-position: under;
		  color: #000;}
		.wp-pap-list-feature-item p {
		  color: #505050;
		  font-size: 12px;
		  margin-bottom: 0;
		}

		/* welcome-screen-css end -M */

		/* SideBar */
		.wpos-sidebar .wpos-epb-wrap{background:#0055fb; color:#fff; padding:15px;}
		.wpos-sidebar .wpos-epb-wrap  h2{font-size:24px !important; color:#fff; margin:0 0 15px 0; padding:0px !important;}
		.wpos-sidebar .wpos-epb-wrap  h2 span{font-size:20px !important; color:#ffff00 !important;}
		.wpos-sidebar .wpos-epb-wrap ul li{font-size:16px; margin-bottom:8px;}
		.wpos-sidebar .wpos-epb-wrap ul li span{color:#ffff00 !important;}
		.wpos-sidebar .wpos-epb-wrap ul{list-style: decimal inside none;}
		.wpos-sidebar .wpos-epb-wrap b{font-weight:bold !important;}
		.wpos-sidebar .wpos-epb-wrap p{font-size:16px;}
		.wpos-sidebar .wpos-epb-wrap .button-yellow{font-weight: 600;color: #000; text-align:center;text-decoration: none;display:block;padding: 1em 2em;background: #ffff00;border-radius: .2em;}
		.wpos-sidebar .wpos-epb-wrap .button-orange{font-weight: 600;color: #fff; text-align:center;text-decoration: none;display:block;padding: 1em 2em;background: #ff2700;border-radius: .2em;}
		.wpos-new-feature{ font-size: 10px; color: #fff; font-weight: bold; background-color: #03aa29; padding:1px 4px; font-style: normal; }
	</style>

	<!-- <div class="wp-pap-black-friday-banner-wrp">
		<a href="<?php //echo esc_url( WP_PAP_PLUGIN_LINK_UPGRADE ); ?>" target="_blank"><img style="width: 100%;" src="<?php // echo esc_url( WP_PAP_URL ); ?>assets/images/black-friday-banner.png" alt="black-friday-banner" /></a>
	</div> -->

	<div class="wp-pap-black-friday-banner-wrp" style="background:#e1ecc8;padding: 20px 20px 40px; border-radius:5px; text-align:center;margin-bottom: 40px;">
		<h2 style="font-size:30px; margin-bottom:10px;"><span style="color:#0055fb;">Portfolio and Projects</span> is included in <span style="color:#0055fb;">Essential Plugin Bundle</span> </h2> 
		<h4 style="font-size: 18px;margin-top: 0px;color: #ff5d52;margin-bottom: 24px;">Now get Designs, Optimization, Security, Backup, Migration Solutions @ one stop. </h4>

		<div class="wp-pap-black-friday-feature">

			<div class="wp-pap-inner-deal-class" style="width:40%;">
				<div class="wp-pap-inner-Bonus-class">Bonus</div>
				<div class="wp-pap-image-logo" style="font-weight: bold;font-size: 26px;color: #222;"><img style="width: 34px; height:34px;vertical-align: middle;margin-right: 5px;" class="wp-pap-img-logo" src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/essential-logo-small.png" alt="essential-logo" /><span class="wp-pap-esstial-name" style="color:#0055fb;">Essential </span>Plugin</div>
				<div class="wp-pap-sub-heading" style="font-size: 16px;text-align: left;font-weight: bold;color: #222;margin-bottom: 10px;">Includes All premium plugins at no extra cost.</div>
				<a class="wp-pap-sf-btn" href="<?php echo esc_url( WP_PAP_PLUGIN_LINK_UPGRADE ); ?>" target="_blank">Grab The Deal</a>
			</div>

			<div class="wp-pap-main-list-class" style="width:60%;">
				<div class="wp-pap-inner-list-class">
					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/img-slider.png" alt="essential-logo" /> Image Slider</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/advertising.png" alt="essential-logo" /> Publication</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/marketing.png" alt="essential-logo" /> Marketing</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/photo-album.png" alt="essential-logo" /> Photo album</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/showcase.png" alt="essential-logo" /> Showcase</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/shopping-bag.png" alt="essential-logo" /> WooCommerce</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/performance.png" alt="essential-logo" /> Performance</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/security.png" alt="essential-logo" /> Security</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/forms.png" alt="essential-logo" /> Pro Forms</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/seo.png" alt="essential-logo" /> SEO</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/backup.png" alt="essential-logo" /> Backups</li></div>

					<div class="wp-pap-list-img-class"><img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/White-labeling.png" alt="essential-logo" /> Migration</li></div>
				</div>
			</div>
		</div>
		<div class="wp-pap-main-feature-item">
			<div class="wp-pap-inner-feature-item">
				<div class="wp-pap-list-feature-item">
					<img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/layers.png" alt="layer" />
					<h5>Site management</h5>
					<p>Manage, update, secure & optimize unlimited sites.</p>
				</div>
				<div class="wp-pap-list-feature-item">
					<img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/risk.png" alt="backup" />
					<h5>Backup storage</h5>
					<p>Secure sites with auto backups and easy restore.</p>
				</div>
				<div class="wp-pap-list-feature-item">
					<img src="<?php echo esc_url( WP_PAP_URL ); ?>assets/images/logo-image/support.png" alt="support" />
					<h5>Support</h5>
					<p>Get answers on everything WordPress at anytime.</p>
				</div>
			</div>
		</div>
		<a class="wp-pap-sf-btn" href="<?php echo esc_url( WP_PAP_PLUGIN_LINK_UPGRADE ); ?>" target="_blank">Grab The Deal</a>
	</div>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder">
			<div id="post-body-content">
				<table class="wpos-plugin-pricing-table">
					<colgroup></colgroup>
					<colgroup></colgroup>
					<colgroup></colgroup>
					<thead>
						<tr>
							<th></th>
							<th>
								<h2>Free</h2>
							</th>
							<th>
								<h2 class="wpos-epb">Premium</h2>
								<p>Gain access to <strong>Portfolio and Projects</strong> included in <br /><strong class="wpos-epb">Essential Plugin Bundle</strong></p>
								<a href="<?php echo esc_url(WP_PAP_PLUGIN_LINK_UPGRADE); ?>" target="_blank">Upgrade To PRO</a>
							</th>
						</tr>
					</thead>

					<tfoot>
						<tr>
							<th></th>
							<td></td>
							<td><p>Gain access to <strong>Portfolio and Projects</strong> included in <strong>Essential Plugin Bundle</strong></p>
							<a href="<?php echo esc_url(WP_PAP_PLUGIN_LINK_UPGRADE); ?>" class="wpos-button" target="_blank">Upgrade To PRO</a></td>
						</tr>
					</tfoot>

					<tbody>
						<tr>
							<th>Designs <span class="subtext">Designs that make your website better.</span></th>
							<td>1</td>
							<td>15+</td>
						</tr>

						<tr>
							<th>Shortcodes <span class="subtext">Shortcode provide output to the front-end side.</span></th>
							<td>1</td>
							<td>2</td>
						</tr>

						<tr>
							<th>Portfolio Detail View Styles <span class="subtext">Display Portfolio detail view. </span></th>
							<td>Inline</td>
							<td>Inline and Popup</td>
						</tr>

						<tr>
							<th>Portfolio Filtration <span class="subtext">You can display category wise filter.</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Pagination<span class="subtext">Pagination option </span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Pagination Style<span class="subtext">You can set diffrent type of pagination.</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td>Numeric and Previous-Next</td>
						</tr>

						<tr>
							<th>Shortcode Parameters <span class="subtext">Add extra power to the shortcode.</span></th>
							<td>5</td>
							<td>20+</td>
						</tr>

						<tr>
							<th>Shortcode Generator <span class="subtext">Play with all shortcode parameters with preview panel. No documentation required!!</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>WP Templating Features <span class="subtext">You can modify plugin html/designs in your current theme.</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Gutenberg Block Supports <span>Use this plugin with Gutenberg easily</span></th>
							<td><i class="dashicons dashicons-no-alt"></i></td>
							<td><i class="dashicons dashicons-yes"></i></td>
						</tr>

						<tr>
							<th>Elementor Page Builder Support <em class="wpos-new-feature">New</em> <span>Use this plugin with Elementor easily</span></th>
							<td><i class="dashicons dashicons-no-alt"></i></td>
							<td><i class="dashicons dashicons-yes"></i></td>
						</tr>

						<tr>
							<th>Beaver Builder Support <em class="wpos-new-feature">New</em> <span>Use this plugin with Beaver Builder easily</span></th>
							<td><i class="dashicons dashicons-no-alt"></i></td>
							<td><i class="dashicons dashicons-yes"></i></td>
						</tr>

						<tr>
							<th>SiteOrigin Page Builder Support <em class="wpos-new-feature">New</em> <span>Use this plugin with SiteOrigin easily</span></th>
							<td><i class="dashicons dashicons-no-alt"></i></td>
							<td><i class="dashicons dashicons-yes"></i></td>
						</tr>

						<tr>
							<th>Divi Page Builder Native Support <em class="wpos-new-feature">New</em> <span>Use this plugin with Divi Builder easily</span></th>
							<td><i class="dashicons dashicons-no-alt"></i></td>
							<td><i class="dashicons dashicons-yes"></i></td>
						</tr>

						<tr>
							<th>WPBakery Page Builder Support <span>Use this plugin with WPBakery Page Builder easily</span></th>
							<td><i class="dashicons dashicons-no-alt"></i></td>
							<td><i class="dashicons dashicons-yes"></i></td>
						</tr>

						<tr>
							<th>Query Offset<span class="subtext">You can set query offset.</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Image Size<span class="subtext">Choose image size that you want to display</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Image Fit<span class="subtext">Set image fit to box or not.</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Extra Class<span class="subtext">You can add extra class for custom design.</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Link<span class="subtext">Option to enable/disable portfolio item link.</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Target Link<span class="subtext">Open link in same window OR in new tab.</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Drag &amp; Drop Slide Order Change <span class="subtext">Arrange your desired Portfolio with your desired order and display.</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Display Portfolio for Particular Categories <span class="subtext">Display only the Portfolio with particular category.</span></th>
							<td><i class="dashicons dashicons-yes"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Exclude Some Portfolio items <span class="subtext">Exclude Portfolio items by their ids that you do not want to display.</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Exclude Some Categories <span class="subtext">Do not display the Portfolio from particular categories</span></th>
							<td><i class="dashicons dashicons-no-alt"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Portfolio Order / Order By Parameters <span class="subtext">Display Portfolio according to date, title and etc</span></th>
							<td><i class="dashicons dashicons-yes"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>100% Multi language<span>Supports 100% Multi language</span></th>
							<td><i class="dashicons dashicons-no-alt"></i></td>
							<td><i class="dashicons dashicons-yes"></i></td>
						</tr>

						<tr>
							<th>Responsive<span>Design fully responsive</span></th>
							<td><i class="dashicons dashicons-yes"></i></td>
							<td><i class="dashicons dashicons-yes"></i></td>
						</tr>

						<tr>
							<th>Portfolio RTL Support <span class="subtext">Slider supports for RTL website</span></th>
							<td><i class="dashicons dashicons-yes"> </i></td>
							<td><i class="dashicons dashicons-yes"> </i></td>
						</tr>

						<tr>
							<th>Automatic Update <span>Get automatic  plugin updates </span></th>
							<td>Lifetime</td>
							<td>Lifetime</td>
						</tr>

						<tr>
							<th>Support <span class="subtext">Get support for plugin</span></th>
							<td>Limited</td>
							<td>1 Year</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>