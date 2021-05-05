<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Script Class
 *
 * function for shortcode
 *
 * @package Video gallery and Player
 * @since 2.5
 */
function sp_html5video_shortcode( $atts, $content = null ) {

	// extract shortcode parameter
	extract(shortcode_atts(array(
				"limit"    		=> -1,
				"grid"     		=> 1,
				"category" 		=> '',
				"post"     		=> '',
				"popup_fix"		=> 'false',
				'extra_class'	=> '',
				'className'		=> '',
				'align'			=> '',
	), $atts, 'sp_html5video' ));

	$limit 			= wp_html5vp_clean_number( $limit, -1, 'number' );
	$grid 			= wp_html5vp_clean_number( $grid, 1 );
	$cat			= ! empty( $category )			? explode( ',', $category ) : '';
	$post_in 		= ! empty( $post )				? explode( ',', $post ) 	: array();
	$popup_fix 		= ( $popup_fix == 'true' ) 		? 'true' 					: 'false';
	$align			= ! empty( $align )				? 'align'.$align			: '';
	$extra_class	= $extra_class .' '. $align .' '. $className;
	$extra_class	= wp_html5vp_get_sanitize_html_classes( $extra_class );
	$video_grid 	= wp_html5vp_grid_column( $grid );

	// Popup Configuration
	$popup_conf = compact('popup_fix');

	// Enqueue Script
	wp_enqueue_script( 'wpos-magnific-popup-jquery' );
	wp_enqueue_script( 'wp-html5video-public-js' );

	// Create the Query
	$unique 	= wp_html5vp_get_unique();
	$post_type 	= 'sp_html5video';
	$orderby 	= 'post_date';
	$order 		= 'DESC';

	// Post Type Argument 
	$args = array ( 
				'post_type'      => $post_type,
				'posts_per_page' => $limit,
				'orderby'        => $orderby, 
				'order'          => $order,
				'post__in'       => $post_in,
				'no_found_rows'  => 1
			) ;

	// Tax Query
	if( $cat != "" ){
		$args['tax_query'] = array( 
			array( 
				'taxonomy' => 'video-category', 
				'field' => 'tearm_id', 
				'terms' => $cat
			) 
		);
	}

	ob_start();

	//Get post type count
	$query		= new WP_Query($args);
	$post_count	= $query->post_count;
	$count 		= 1;
	$i			= 1;

	global $post; ?>

	<div class="wp-html5vp-video-row video-row video-row-clearfix <?php echo $extra_class; ?>" id="wp-html5vp-<?php echo $unique; ?>">
	<?php
	// Displays Custom post info
	if( $post_count > 0 ) :

		// Loop
		while ($query->have_posts()) : $query->the_post();

		$feat_image			= wp_get_attachment_url( get_post_thumbnail_id() );
		$css_wrap			= ( $count % $grid == 1 )	? ' wp-html5vp-first'	: '';
		$wpvideo_video_mp4	= get_post_meta( $post->ID, '_wpvideo_video_mp4', true );
		$wpvideo_video_wbbm	= get_post_meta( $post->ID, '_wpvideo_video_wbbm', true );
		$wpvideo_video_ogg	= get_post_meta( $post->ID, '_wpvideo_video_ogg', true );
		$youtube_link		= get_post_meta( $post->ID, '_wpvideo_video_yt', true );
		$vimeo_link			= get_post_meta( $post->ID, '_wpvideo_video_vm', true );
		$video_link			= '';

		if( $youtube_link != '' ) {
			$video_link = $youtube_link;
		} else {
			$video_link = $vimeo_link;
		} ?>

		<div class="video-wrap html5video-medium-<?php echo $video_grid; ?> html5video-columns <?php echo $css_wrap; ?>">
			<div class="video_frame">
				<div class="video_image_frame">
					<?php if( $video_link != '' ) { ?>
						<a href="<?php echo esc_url( $video_link ); ?>" class="popup-youtube">
							<?php if( $feat_image ) { ?>
								<img src="<?php echo esc_url( $feat_image ); ?>" alt="<?php the_title(); ?>" />
							<?php } ?>
							<span class="video_icon"></span>
						</a>
					<?php } else { ?>
						<a href="#video-modal-<?php echo $unique.'-'.$i; ?>" class="popup-modal">
							<?php if( $feat_image ) { ?>
								<img src="<?php echo esc_url( $feat_image ); ?>" alt="<?php the_title(); ?>" />
							<?php } ?>
							<span class="video_icon"></span>
						</a>
					<?php } ?>
					<div id="video-modal-<?php echo $unique.'-'.$i; ?>" class="mfp-hide white-popup-block wp-html5vp-popup-wrp">
						<video id="video_<?php echo get_the_ID(); ?>" class="wp-hvgp-video-frame video-js vjs-default-skin" controls preload="none" width="100%" poster="<?php echo esc_url($feat_image); ?>" data-setup="{}">
							<source src="<?php echo esc_url($wpvideo_video_mp4); ?>" type='video/mp4' />
							<source src="<?php echo esc_url($wpvideo_video_wbbm); ?>" type='video/webm' />
							<source src="<?php echo esc_url($wpvideo_video_ogg); ?>" type='video/ogg' />
						</video>
					</div>
				</div>
				<div class="video_title"><?php the_title(); ?></div>
			</div>
		</div>
		<?php
		$count++;
		$i++;
		endwhile;
	endif; ?>
		<div class="wp-html5vp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div><!-- end of-popup-conf -->
	</div>
	<?php

	// Reset query to prevent conflicts
	wp_reset_postdata();
	return ob_get_clean();
}

// Add shortcode `sp_html5video`
add_shortcode("sp_html5video", "sp_html5video_shortcode");