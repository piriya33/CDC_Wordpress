<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package WP Featured Content and Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Action to add menu
add_action('admin_menu', 'wpfcasm_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package WP Featured Content and Slider
 * @since 1.0.0
 */
function wpfcasm_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.WPFCAS_POST_TYPE, __('How it works, our plugins and offers', 'wp-featured-content-and-slider'), __('How It Works', 'wp-featured-content-and-slider'), 'manage_options', 'wpfcasm-designs', 'wpfcasm_howitwork_page' );
}

/**
 * Function to get 'How It Works' HTML
 *
 * @package WP Featured Content and Slider
 * @since 1.0.0
 */
function wpfcasm_howitwork_page() { ?>

<div class="wrap wpfcasm-wrap">
<h2><?php _e( 'How It Works', 'wp-featured-content-and-slider' ); ?></h2>
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box.postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.wpfcasm-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.wpfcasm-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
		.upgrade-to-pro{font-size:18px; text-align:center; margin-bottom:15px;}
		.wpos-copy-clipboard{-webkit-touch-callout: all; -webkit-user-select: all; -khtml-user-select: all; -moz-user-select: all; -ms-user-select: all; user-select: all;}
		.wpos-new-feature{ font-size: 10px; margin-left:2px; color: #fff; font-weight: bold; background-color: #03aa29; padding:1px 4px; font-style: normal; }
	</style>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">

			<!--How it workd HTML -->
			<div id="post-body-content">
				<div class="meta-box-sortables">
					<div class="postbox">

						<div class="postbox-header">
							<h2 class="hndle">
								<span><?php _e( 'How It Works - Display and Shortcode', 'wtpsw' ); ?></span>
							</h2>
						</div>

						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th>
											<label><?php _e('Getting Started', 'wp-featured-content-and-slider'); ?>:</label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Go to "Featured Content --> Add conetnt tab".', 'wp-featured-content-and-slider'); ?></li>
												<li><?php _e('Step-2. Add Title, description and image as a featured image OR Add Font Awesome (If not adding Featured Image).', 'wp-featured-content-and-slider'); ?></li>
												<li><?php _e('Step-3. To display multiple, Create category under "Featured Content -->category" and add Featured Content to respective categories.', 'wp-featured-content-and-slider'); ?></li>
												<li><?php _e('Step-4. Use category shortcode under "Featured Content -->category"', 'wp-featured-content-and-slider'); ?></li>
												<li><?php _e('Step-5. Plugin alos work with custom post type', 'wp-featured-content-and-slider'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('How Shortcode Works', 'wp-featured-content-and-slider'); ?>:</label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Create a page like Featured Content OR add the shortcode in a page.', 'wp-featured-content-and-slider'); ?></li>
												<li><?php _e('Step-2. Put below shortcode as per your need.', 'wp-featured-content-and-slider'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('All Shortcodes', 'wp-featured-content-and-slider'); ?>:</label>
										</th>
										<td>
											<span class="wpos-copy-clipboard wpfcasm-shortcode-preview">[featured-content]</span> – <?php _e('Featured Content Grid Shortcode', 'wp-featured-content-and-slider'); ?><br />
											<span class="wpos-copy-clipboard wpfcasm-shortcode-preview">[featured-content-slider]</span> – <?php _e('Featured Content Slider Shortcode', 'wp-featured-content-and-slider'); ?><br />
											<span class="wpos-copy-clipboard wpfcasm-shortcode-preview">[featured-content grid="2" design="design-1"]</span> – <?php _e('Design and grid parameters', 'wp-featured-content-and-slider'); ?><br />
											<span class="wpos-copy-clipboard wpfcasm-shortcode-preview">[featured-content post_type="featured_post"]</span> & <span class="wpos-copy-clipboard wpfcasm-shortcode-preview">[featured-content-slider post_type="featured_post"]</span> – <?php _e('Shortcode also work with custom post type', 'wp-featured-content-and-slider'); ?>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- .inside -->
					</div><!-- #general -->

					<div class="postbox">
						<div class="postbox-header">
							<h2 class="hndle">
								<span><?php _e( 'Need Support?', 'wp-featured-content-and-slider' ); ?></span>
							</h2>
						</div>
						<div class="inside">
							<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'wp-featured-content-and-slider'); ?></p> <br/>
							<a class="button button-primary" href="https://docs.wponlinesupport.com/wp-featured-content-and-slider/" target="_blank"><?php _e('Documentation', 'wp-featured-content-and-slider'); ?></a>
							<a class="button button-primary" href="https://demo.wponlinesupport.com/featured-content-and-slider-demo/" target="_blank"><?php _e('Demo for Designs', 'wp-featured-content-and-slider'); ?></a>
						</div><!-- .inside -->
					</div><!-- #general -->

					<div class="postbox">
						<div class="postbox-header">
							<h3 class="hndle">
								<span><?php _e( 'Help to improve this plugin!', 'wp-featured-content-and-slider' ); ?></span>
							</h3>
						</div>
						<div class="inside">
							<p>Enjoyed this plugin? You can help by rate this plugin <a href="https://wordpress.org/support/plugin/wp-featured-content-and-slider/reviews/" target="_blank">5 stars!</a></p>
						</div><!-- .inside -->
					</div><!-- #general -->

				</div><!-- .meta-box-sortables -->
			</div><!-- #post-body-content -->

			<!--Upgrad to Pro HTML -->
			<div id="postbox-container-1" class="postbox-container">
				<div class="meta-box-sortables">
					<div class="postbox wpos-pro-box" style="">

						<h3 class="hndle">
							<span><?php _e( 'Upgrate to Pro', 'wp-featured-content-and-slider' ); ?></span>
						</h3>
						<div class="inside">
							<ul class="wpos-list">
								<li>35+ Designs</li>
								<li>Display category wise</li>
								<li>3 Shortcodes</li>
								<li>WP Templating Features.</li>
								<li>Gutenberg Block Supports.</li>
								<li>Visual Composer/WPBakery Page Builder Supports.</li>
								<li>Elementor, Beaver and SiteOrigin Page Builder Support. <span class="wpos-new-feature">New</span></li>
								<li>Divi Page Builder Native Support. <span class="wpos-new-feature">New</span></li>
								<li>Fusion Page Builder (Avada) native support.<span class="wpos-new-feature">New</span></li>
								<li>Drag & Drop order change</li>
								<li>Custom read more button and link</li>
								<li>Custom css</li>
								<li>Slider RTL support</li>
								<li>Fully responsive</li>
								<li>100% Multi language</li>
							</ul>
							<div class="upgrade-to-pro">Gain access to <strong>WP Featured Content and Slider</strong> included in <br /><strong>Essential Plugin Bundle</div>
							<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/wp-plugin/wp-featured-content-and-slider/?ref=WposPratik&utm_source=WP&utm_medium=Featured-Content&utm_campaign=Upgrade-PRO" target="_blank"><?php _e('Go Premium ', 'wp-featured-content-and-slider'); ?></a>
							<p><a class="button button-primary wpos-button-full" href="https://demo.wponlinesupport.com/prodemo/pro-wp-featured-content-and-slider/" target="_blank"><?php _e('View PRO Demo ', 'wp-featured-content-and-slider'); ?></a></p>
						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-container-1 -->

		</div><!-- #post-body -->
	</div><!-- #poststuff -->

</div>
<?php }