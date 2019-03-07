=== Ticker Ultimate ===
Contributors: wponlinesupport, anoopranawat, pratik-jain
Tags: wponlinesupport, ticker, news ticker, blog ticker, post ticker, ticker slider, ticker vertical slider, ticker horizontal slider
Requires at least: 4.0
Tested up to: 5.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A quick, easy way to add and display Tickers to your site. Also work with Gutenberg shortcode block.

== Description ==
A very simple plugin to add and display News Tickers in horizontal slider, vertical slider that work with WordPress posts and Custom Post Type with the help of shortcode.

Ticker Ultimate Plugin enables you to create and display posts in fade, vertical and horizontal slider effect.

View [DEMO](https://www.wponlinesupport.com/wp-plugin/ticker-ultimate/) | [PRO DEMO and Features](https://www.wponlinesupport.com/wp-plugin/ticker-ultimate/) for additional information.

Also work with Gutenberg shortcode block.

**This plugin contain one shortcode**

= Here is the shortcode example =
- Ticker Ultimate Shortcode: 

<code>[wp_ticker]</code>  

Where you can display your recent post as headline.

= Available Features : =
* Work with Custom Post Type
* Custom Color Change of the Title
* Custom Background Color Change of the Title
* Ticker Slider Effect
* Ticker Slider Timer
* Default Wordpress Posts Support
* Strong shortcode parameters
* 100% Multilanguage
* Also work with Gutenberg shortcode block.

= Complete shortcode with all parameters =
Ticker Ultimate Shortcode:

<code>[wp_ticker category="5" ticker_title="News Tickers" color="#000" background_color="#2096CD" effect="fade" fontstyle="normal" autoplay="false" timer="4000" title_color="#000" border="false" post_type="post" post_cat="category"]</code>
 
= Use Following parameters with shortcode =
<code>[wp_ticker]</code>

* **Category:** [wp_ticker category="5"] (Ticker id for which you want to display posts.)
* **Ticker Title:** [wp_ticker ticker_title="News Tickers"] (Title of the Ticker you want to display.)
* **Color:** [wp_ticker color="#000"] (To change the post content color)
* **Title Color:** [wp_ticker title_color="#000"] (To change the Ticker Title color.)
* **Background Color:** [wp_ticker background_color="#2096CD"] (To change the News Ticker title background color.)
* **Effect:** [wp_ticker effect="fade"] (You can change the content effect. default effect is fade effect. values are "slide-h", "slide-v", "fade".)
* **Font Style:** [wp_ticker fontstyle="normal"] (You can change the Font Style of the content. Values are "normal", "bold", "italic".)
* **Border:** [wp_ticker border="true"] (Display Border to the Tickers. Values are "true" OR "false".)
* **Autoplay:** [wp_ticker autoplay="true"] (Start tickers automatically. Values are "true" OR "false".)
* **Timer:** [wp_ticker timer="3000"] (Control speed of ticker slider.)
* **Post Type:** [wp_ticker post_type="post"] (You can view the Default wordpress posts with ticker plugin.)
* **Post Category:** [wp_ticker post_cat="category"] (You can apply the Default wordpress category with ticker plugin..)


= Template code is =
<code><?php echo do_shortcode('[wp_ticker]'); ?></code>

= Privacy & Policy =
* We have also opt-in e-mail selection , once you download the plugin , so that we can inform you and nurture you about products and its features.
 
== Installation ==

1. Upload the 'Ticker Ultimate' folder to the '/wp-content/plugins/' directory.
2. Activate the "Ticker Ultimate" list plugin through the 'Plugins' menu in WordPress.
3. Add a new page and add desired short code in that.

== Screenshots ==

1. All design options
2. Output


== Changelog ==

= 1.2.2 (14, Feb 2019) =
* [*] Minor change in Opt-in flow.

= 1.2.1 (31, Dec 2018) =
* [*] Update Opt-in flow.

= 1.2 (08, Dec 2018) =
* [*] Tested with WordPress 5.0 and Gutenberg.

= 1.1 (14, June 2018) =
* [*] Follow some WordPress Detailed Plugin Guidelines.

= 1.0.1 (25, Jan 2018) =
* [*] Fixed the issue with the ticker if link is not added (if user user use custom post type)

= 1.0 =
* Initial release.