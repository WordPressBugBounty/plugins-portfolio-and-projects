<?php
/**
 * 'pap_portfolio' Shortcode
 *
 * @package  Portfolio and Projects
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function pap_portfolio_projects_shortcode( $atts, $content = '' ) {

	global $post;

	extract(shortcode_atts(array(
							'limit'		=> 20,
							'grid'		=> 3,
							'category'	=> '',
							'order'		=> 'DESC',
							'orderby'	=> 'date',
							'link'		=> 'true',
	), $atts, 'pap_portfolio' ));

	$posts_per_page	= wp_pap_clean_number( $limit, 20, 'number' );
	$grid			= wp_pap_clean_number( $grid, 3 );
	$cat			= ! empty( $category )				? wp_pap_clean( explode( ',', $category ) )	: '';
	$order			= ( strtolower( $order ) == 'asc' )	? 'ASC'										: 'DESC';
	$orderby		= ! empty( $orderby )				? wp_pap_clean( $orderby )					: 'date';
	$link			= ( $link == 'true' )				? 1											: 0;

	// Taking some variables
	$prefix			= WP_PAP_META_PREFIX;
	$thumb_conf		= compact( 'grid' );

	// Enqueue Required Script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wp-pap-portfolio-js' );
	wp_enqueue_script( 'wp-pap-public-js' );

	$args = array (
		'post_type'			=> WP_PAP_POST_TYPE,
		'orderby'			=> $orderby, 
		'order'				=> $order,
		'posts_per_page'	=> $posts_per_page,
	);

	if( ! empty( $cat ) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy'	=> WP_PAP_CAT,
									'field'		=> 'term_id',
									'terms'		=> $cat
								));

	}

	$query			= new WP_Query( $args );
	$unique_main	= wp_pap_get_unique_main_thumb();

	ob_start(); ?>

	<div class="wppap-main-wrapper wpapap-clearfix">
		<ul id="thumbs-<?php echo esc_attr( $unique_main ); ?>" class="wppap-thumbs" data-conf="<?php echo htmlspecialchars(json_encode( $thumb_conf )); ?>"><?php

			while ($query->have_posts()) : $query->the_post();

				$unique		= wp_pap_get_unique();
				$url		= wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>

				<li class="thum-list">
					<a data-mfp-src="#thumb<?php echo esc_attr( $unique ); ?>" href="#" class="wppap-thumbnail" style="background-image: url('<?php echo esc_url( $url ); ?>')">
						<span class="wppap-description"><?php echo get_the_title(); ?></span>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>

		<div class="wppap-portfolio-content">

			<?php while ( $query->have_posts() ) : $query->the_post();

				$unique_thumb	= wp_pap_get_unique_thumbs();
				$wp_pap_title	= get_the_title();
				$wp_pap_desc	= get_the_content();
				$gallery_imgs	= get_post_meta( $post->ID, $prefix.'gallery_id', true );
				$arrows			= get_post_meta( $post->ID, $prefix.'arrow_slider', true );
				$arrows			= ( $arrows == 'false' )	? 'false' : 'true' ;
				$dots			= get_post_meta( $post->ID, $prefix.'pagination_slider', true );
				$dots			= ( $dots == 'false' )		? 'false' : 'true' ;
				$effect			= get_post_meta( $post->ID, $prefix.'animation_slider', true );
				$effect			= ( $effect == 'fade' )		? 'fade' : 'slide' ;
				$project_url	= get_post_meta( $post->ID, $prefix.'project_url', true );
				$medium_class	= ! empty( $gallery_imgs )	? 'wppap-medium-6' : 'wppap-medium-12';

				// Slider configuration
				$slider_conf = compact( 'dots', 'arrows','effect' );
			?>

				<div id="thumb<?php echo esc_attr( $unique_thumb ); ?>">

					<?php if( ! empty( $gallery_imgs ) ) { ?>
					<div class="<?php echo esc_attr( $medium_class ); ?> wppap-columns wppap-left-column">
						<div class="wppap-slider-wrapper">
							<div id="wppap-slider-<?php echo esc_attr( $unique_thumb ); ?>" class="wpapap-portfolio-img-slider thumb<?php echo esc_attr( $unique ); ?>" data-conf="<?php echo htmlspecialchars( json_encode( $slider_conf ) ); ?>"><?php 

								foreach ( $gallery_imgs as $img_key => $img_data ) {

									$gallery_img_src	= wp_pap_get_image_src( $img_data, 'full' );
									$img_alt_text		= get_post_meta( $img_data, '_wp_attachment_image_alt', true ); ?>
									<div class="portfolio-slide">
										<img src="<?php echo esc_url( $gallery_img_src ); ?>" alt="<?php echo esc_attr( $img_alt_text ); ?>" />
									</div><?php
								} // End of for each ?>
							</div>
						</div>
					</div>
					<?php }

					if( $wp_pap_title || $wp_pap_desc || $project_url ) { ?>
					<div class="<?php echo esc_attr( $medium_class ); ?> wppap-columns wppap-right-column">
						<div class="wppap-right-content">
							<?php if( $wp_pap_title ) { ?>
								<div class="wppap-title"><?php echo wp_kses_post( $wp_pap_title ); ?></div>
							<?php }

							if( $wp_pap_desc ) { ?>
								<div class="wppap-content"><?php echo wp_kses_post( wpautop( wptexturize( $wp_pap_desc ) ) ); ?></div>
							<?php }

							if( $project_url && $link ) { ?>
								<a href="<?php echo esc_url( $project_url ); ?>" class="wppap-project-url-btn" target="_blank"><?php esc_html_e( 'View Project', 'portfolio-and-projects' ); ?></a>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>
			 <?php endwhile; ?>
		</div>
	</div>
	<?php

	wp_reset_postdata(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// Portfolio Grid Shortcode
add_shortcode( 'pap_portfolio', 'pap_portfolio_projects_shortcode' );