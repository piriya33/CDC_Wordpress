<?php
/**
 * `wp_ticker` Shortcode
 * 
 * @package Ticker Ultimate
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wptu_ticker( $atts, $content = null ) {

	// SiteOrigin Page Builder Gutenberg Block Tweak - Do not Display Preview
	if( isset( $_POST['action'] ) && ( $_POST['action'] == 'so_panels_layout_block_preview' || $_POST['action'] == 'so_panels_builder_content_json' ) ) {
		return '[wp_ticker]';
	}

	// Divi Frontend Builder - Do not Display Preview
	if( function_exists( 'et_core_is_fb_enabled' ) && isset( $_POST['is_fb_preview'] ) && isset( $_POST['shortcode'] ) ) {
		return '<div class="wptu-builder-shrt-prev">
					<div class="wptu-builder-shrt-title"><span>'.esc_html__('Ticker - Shortcode', 'ticker-ultimate').'</span></div>
					wp_ticker
				</div>';
	}

	// Fusion Builder Live Editor - Do not Display Preview
	if( class_exists( 'FusionBuilder' ) && (( isset( $_GET['builder'] ) && $_GET['builder'] == 'true' ) || ( isset( $_POST['action'] ) && $_POST['action'] == 'get_shortcode_render' )) ) {
		return '<div class="wptu-builder-shrt-prev">
					<div class="wptu-builder-shrt-title"><span>'.esc_html__('Ticker - Shortcode', 'ticker-ultimate').'</span></div>
					wp_ticker
				</div>';
	}

	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> -1,
		'category' 				=> '',
		'ticker_title'			=> __('Latest News','ticker-ultimate'),
		'posts'					=> array(),
		'color'					=> '#000',
		'background_color'		=> '#2096CD',
		'effect'				=> 'fade',
		'fontstyle'				=> 'normal',
		'autoplay'				=> 'true',
		'timer'					=> 4000,
		'title_color'			=> '#fff',
		'border'				=> 'true',
		'post_type'				=> '',
		'post_cat'				=> '',
		'link'					=> 'true',
		'link_target'			=> 'self',
		'className'				=> '',
		'align'					=> '',
		'extra_class'			=> '',
	), $atts));

	$effect_arr			= array('fade', 'typography', 'slide-up');
    $posts_per_page		= ! empty( $limit )						? $limit 					: -1;
    $cat    			= ! empty( $category )					? explode(',',$category) 	: '';
    $color 				= ! empty( $color )						? $color 					: '#000';
	$background_color   = ! empty( $background_color )			? $background_color 		: '#2096CD';
	$effect 			= ( in_array( $effect, $effect_arr ) )	? $effect 					: 'fade';
	$fontstyle 			= ! empty( $fontstyle )					? $fontstyle 				: 'normal';
	$autoplay           = ! empty( $autoplay )					? $autoplay 				: 'true';
	$timer				= ! empty( $timer )						? $timer 					: 4000;
	$title_color		= ! empty( $title_color )				? $title_color 				: '#fff';
	$border				= ( $border == 'true' )					? 1 						: 0;
	$posts 				= ! empty( $posts )						? explode(',', $posts) 		: array();
	$post_type 			= ! empty( $post_type )					? $post_type 				: WPTU_POST_TYPE;
	$post_cat 			= ! empty( $post_cat )					? $post_cat 				: WPTU_CAT;
	$link				= ( $link == 'false' )					? false 					: true;
	$link_target 		= ( $link_target == 'blank' )			? '_blank' 					: '_self';
	$align				= ! empty( $align )						? 'align'.$align			: '';
	$extra_class		= $extra_class .' '. $align .' '. $className;
	$extra_class		= wptu_sanitize_html_classes( $extra_class );
	$wrap_cls 			= empty( $border ) ? 'wpos-bordernone ' : '';
	$wrap_cls 			.= $extra_class;

	// Enqueue required script
	wp_enqueue_script('wptu-ticker-script');
	wp_enqueue_script('wptu-public-js');

	// Taking some globals
	global $post;

	// Taking some defaults
	$unique = wptu_get_unique();

	// Ticker Cinfiguration
	$ticker_conf = compact( 'effect' ,'fontstyle', 'autoplay', 'timer', 'border');

	// Query Parameter
	$args = array (
		'post_type'     	 	=> $post_type,
		'post_status'			=> array( 'publish' ),
		'posts_per_page' 		=> $posts_per_page,
		'post__in'				=> $posts,
		'ignore_sticky_posts'	=> true,
	);

	// Category Parameter
	if( !empty($cat) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy'	=> $post_cat,
									'field'		=> 'term_id',
									'terms'		=> $cat,
							));
	}

	// WP Query
	$query = new WP_Query($args);

	ob_start();

	// If post is there
	if ( $query->have_posts() ) {
	?>

	<style type="text/css">
		#wptu-ticker-style-<?php echo $unique; ?> {border-color: <?php echo $background_color; ?>;}
		#wptu-ticker-style-<?php echo $unique; ?> .wptu-style-label {background-color: <?php echo $background_color; ?>;}
		#wptu-ticker-style-<?php echo $unique; ?> .wptu-style-label-title {color: <?php echo $title_color; ?>;}
		#wptu-ticker-style-<?php echo $unique; ?> .wptu-style-label > span {border-color: transparent transparent transparent <?php echo $background_color; ?>;}
		#wptu-ticker-style-<?php echo $unique; ?>.wpos-direction-rtl .wptu-style-label > span {border-color: transparent <?php echo $background_color; ?> transparent transparent;}
		#wptu-ticker-style-<?php echo $unique; ?> .wptu-style-news a:hover {color: <?php echo $background_color; ?>;}
		#wptu-ticker-style-<?php echo $unique; ?> .wptu-style-news a {color: <?php echo $color; ?>;}
	</style>

	<div class="wptu-ticker-wrp wptu-news-ticker wpos-news-ticker wptu-clearfix <?php echo $wrap_cls; ?>" id="wptu-ticker-style-<?php echo $unique; ?>" data-conf="<?php echo htmlspecialchars( json_encode( $ticker_conf ) ); ?>">

		<?php if( $ticker_title ) { ?>
			<div class="wpos-label wptu-style-label">
				<div class="wptu-style-label-title"><?php echo $ticker_title; ?></div>
				<span></span>
			</div>
		<?php } ?>

		<div class="wpos-controls wptu-style-controls">
			<div class="wpos-icons wptu-arrows">
				<span class="wpos-arrow wpos-prev"></span>
			</div>
			<div class="wpos-icons wptu-arrows">
				<span class="wpos-arrow wpos-next"></span>
			</div>
		</div>

		<div class="wpos-news wptu-style-news">
			<ul>
				<?php while ( $query->have_posts() ) : $query->the_post();	
						$post_link = wptu_get_post_link( $post->ID );
					?>
					<li>
						<?php if( $link && $post_link) { ?>
							<a class="wptu-ticker-news wpos-ticker-news" href="<?php echo esc_url( $post_link ); ?>" target="<?php echo $link_target; ?>"><?php the_title_attribute(); ?></a>
						<?php } else { ?>
							<a href="javascript:void(0)" class="wptu-ticker-news wpos-ticker-news"><?php the_title_attribute(); ?></a>
						<?php } ?>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>

	<?php } // End of have_post()

	wp_reset_postdata(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'wp_ticker' shortcode
add_shortcode('wp_ticker', 'wptu_ticker');