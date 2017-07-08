<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_BBCodes {
    /** @var gdbbxMod_BBCodesSCode */
    public $code;

    private $shortcodes = array();

    private $active_shortcodes = array();

    private $list_deactivated = array();
    private $list_advanced = array();
    private $list_restricted = array();

    private $list_to_strip = array();

    private $remove_advanced = false;
    private $remove_restricted = true;

    private $removal = 'info';
    private $notice = true;
    private $force_enqueue = false;
    private $bbpress_only = false;

    function __construct() {
        $this->bbpress_only = gdbbx()->get('bbcodes_bbpress_only', 'tools');

        $this->remove_advanced = !gdbbx()->allowed('bbcodes_special', 'tools', true);
        $this->remove_restricted = !(gdbbx()->get('bbcodes_restricted_super_admin', 'tools') && is_super_admin()) || (gdbbx()->get('bbcodes_restricted_administrator', 'tools') && d4p_is_current_user_admin());

        $this->list_deactivated = gdbbx()->get('bbcodes_deactivated', 'tools');

        $this->notice = gdbbx()->get('bbcodes_notice', 'tools');
        $this->removal = gdbbx()->get('bbcodes_special_action', 'tools');

        $this->_init();

        $list = array_keys($this->shortcodes);
        foreach ($list as $shortcode) {
            if (isset($this->shortcodes[$shortcode]['class'])) {
                $_list = 'list_'.$this->shortcodes[$shortcode]['class'];

                $this->{$_list}[] = $shortcode;
                $this->{$_list}[] = strtoupper($shortcode);
            }

            $deactivate = in_array($shortcode, $this->list_deactivated);

            $to_remove = apply_filters('gdbbx_bbcode_remove_'.$shortcode, $deactivate);
            $to_remove = apply_filters('gdbbx_bbcode_remove', $to_remove, $shortcode);

            if (!$to_remove) {
                add_shortcode($shortcode, array($this, 'shortcode_'.$shortcode));
                add_shortcode(strtoupper($shortcode), array($this, 'shortcode_'.$shortcode));

                $this->active_shortcodes[] = $shortcode;
            }

            $to_strip = apply_filters('gdbbx_bbcode_strip_'.$shortcode, false, $to_remove);
            $to_strip = apply_filters('gdbbx_bbcode_strip', $to_strip, $shortcode, $to_remove);

            if ($to_strip) {
                $this->list_to_strip[] = $shortcode;
                $this->list_to_strip[] = strtoupper($shortcode);
            }
        }

        if ($this->notice) {
            add_action('bbp_theme_before_reply_form_notices', array($this, 'show_notice'));
            add_action('bbp_theme_before_topic_form_notices', array($this, 'show_notice'));
        }

        $_filters = array(
            'bbp_new_reply_pre_insert', 
            'bbp_new_topic_pre_insert', 
            'bbp_edit_reply_pre_insert', 
            'bbp_edit_topic_pre_insert');

        if ($this->remove_advanced) {
            d4p_add_filter($_filters, array($this, 'content_strip_advanced'));
        }

        if ($this->remove_restricted) {
            d4p_add_filter($_filters, array($this, 'content_strip_restricted'));
        }

        if (!empty($this->list_to_strip)) {
            d4p_add_filter($_filters, array($this, 'content_strip_listed'));
        }

        add_filter('bbp_get_reply_content', 'do_shortcode');
        add_filter('bbp_get_topic_content', 'do_shortcode');

        add_action('gdbbx_template', array($this, 'load'));
    }

    public function load() {
        add_filter('gdbbx_script_values', array($this, 'script_values'));

        if (!in_array('scode', $this->list_deactivated)) {
            require_once(GDBBX_PATH.'modules/bbcodes/scode.php');

            $this->code = new gdbbxMod_BBCodesSCode();
        }
    }

    public function script_values($values) {
        $values['run_bbcodes'] = true;

        return $values;
    }

    public function get_available_bbcodes() {
        $list = array_diff($this->active_shortcodes, $this->list_deactivated);

        if ($this->remove_advanced) {
            $list = array_diff($list, $this->list_advanced);
        }

        if ($this->remove_restricted) {
            $list = array_diff($list, $this->list_restricted);
        }

        return array_values($list);
    }

    private function _init() {
        $this->shortcodes = array(
            'b' => array(
                'name' => __("Bold", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'i' => array(
                'name' => __("Italic", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'u' => array(
                'name' => __("Underline", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0),
                'args' => array('style' => 'text-decoration: underline;')
            ),
            's' => array(
                'name' => __("Strikethrough", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'center' => array(
                'name' => __("Align Center", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0),
                'args' => array('style' => 'text-align: center;')
            ),
            'right' => array(
                'name' => __("Align Right", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0),
                'args' => array('style' => 'text-align: right;')
            ),
            'left' => array(
                'name' => __("Align Left", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0),
                'args' => array('style' => 'text-align: left;')
            ),
            'justify' => array(
                'name' => __("Align Justify", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0),
                'args' => array('style' => 'text-align: justify;')
            ),
            'sub' => array(
                'name' => __("Subscript", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'sup' => array(
                'name' => __("Superscript", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'pre' => array(
                'name' => __("Preformatted", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 1)
            ),
            'scode' => array(
                'name' => __("Source Code", "gd-bbpress-toolbox"),
                'atts' => array('raw' => 0, 'lang' => 'text', 'line' => 1, 'gutter' => true, 'collapse' => true, 'class' => '', 'highlight' => '')
            ),
            'reverse' => array(
                'name' => __("Reverse", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0),
                'args' => array('dir' => 'rtl')
            ),
            'list' => array(
                'name' => __("List", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'ol' => array(
                'name' => __("List: Ordered", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'ul' => array(
                'name' => __("List: Unordered", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'li' => array(
                'name' => __("List: Item", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'blockquote' => array(
                'name' => __("Blockquote", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'area' => array(
                'name' => __("Area", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'border' => array(
                'name' => __("Border", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'div' => array(
                'name' => __("Block", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'br' => array(
                'name' => __("Line Break", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '')
            ),
            'hr' => array(
                'name' => __("Horizontal Line", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '')
            ),
            'anchor' => array(
                'name' => __("Anchor", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '')
            ),
            'size' => array(
                'name' => __("Font Size", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'color' => array(
                'name' => __("Font Color", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'quote' => array(
                'name' => __("Quote", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'hide' => array(
                'name' => __("Hide", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'spoiler' => array(
                'name' => __("Spoiler", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'color' => '', 'hover' => '', 'raw' => 0)
            ),
            'highlight' => array(
                'name' => __("Highlight", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'color' => '', 'background' => '', 'raw' => 0)
            ),
            'heading' => array(
                'name' => __("Heading", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'size' => '', 'raw' => 0)
            ),
            'topic' => array(
                'name' => __("Link Topic", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'reply' => array(
                'name' => __("Link Reply", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0)
            ),
            'url' => array(
                'name' => __("URL", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'target' => '_blank', 'rel' => '', 'raw' => 0),
                'class' => 'advanced'
            ),
            'email' => array(
                'name' => __("eMail", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'raw' => 0),
                'class' => 'advanced'
            ),
            'nfo' => array(
                'name' => __("NFO", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'title' => ''),
                'class' => 'advanced'
            ),
            'embed' => array(
                'name' => __("Embed", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'width' => '', 'height' => ''),
                'class' => 'advanced'
            ),
            'google' => array(
                'name' => __("Google Search", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'target' => '_blank', 'rel' => '', 'raw' => 0),
                'class' => 'advanced'
            ),
            'img' => array(
                'name' => __("Image", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'alt' => '', 'title' => '', 'width' => '', 'height' => ''),
                'class' => 'advanced'
            ),
            'attachment' => array(
                'name' => __("Attachment", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'target' => '_blank', 'rel' => '', 'alt' => '', 'title' => '', 'file' => '', 'width' => '', 'height' => ''),
                'class' => 'advanced'
            ),
            'webshot' => array(
                'name' => __("Webshot", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'alt' => '', 'title' => '', 'width' => ''),
                'class' => 'advanced'
            ),
            'youtube' => array(
                'name' => __("YouTube Video", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'width' => '', 'height' => ''),
                'class' => 'advanced'
            ),
            'vimeo' => array(
                'name' => __("Vimeo Video", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'width' => '', 'height' => ''),
                'class' => 'advanced'
            ),
            'note' => array(
                'name' => __("Note", "gd-bbpress-toolbox"),
                'atts' => array('raw' => 0),
                'class' => 'restricted'
            ),
            'iframe' => array(
                'name' => __("iframe", "gd-bbpress-toolbox"),
                'atts' => array('style' => '', 'class' => '', 'width' => '', 'height' => '', 'frameborder' => 0),
                'class' => 'restricted'
            )
        );
    }

    private function _args($code) {
        return isset($this->shortcodes[$code]['args']) ? $this->shortcodes[$code]['args'] : array();
    }

    private function _atts($code, $atts = array()) {
        if (isset($atts[0])) {
            $atts[$code] = substr($atts[0], 1);
            unset($atts[0]);
        }

        $default = $this->shortcodes[$code]['atts'];
        $default[$code] = '';

        if ($code == 'spoiler') {
            $default['color'] = gdbbx()->get('bbcodes_spoiler_color', 'tools');
            $default['hover'] = gdbbx()->get('bbcodes_spoiler_hover', 'tools');
        } else if ($code == 'highlight') {
            $default['color'] = gdbbx()->get('bbcodes_highlight_color', 'tools');
            $default['background'] = gdbbx()->get('bbcodes_highlight_background', 'tools');
        } else if ($code == 'heading') {
            $default['size'] = gdbbx()->get('bbcodes_heading_size', 'tools');
        }

        $atts = shortcode_atts($default, $atts);

        return $atts;
    }

    private function _merge($atts, $args, $attributes = array()) {
        foreach ($atts as $key => $value) {
            if (isset($attributes[$key]) && ($key == 'class' || $key == 'style')) {
                $attributes[$key].= ' '.$value;
            } else {
                $attributes[$key] = $value;
            }
        }

        foreach ($args as $key => $value) {
            if (isset($attributes[$key]) && ($key == 'class' || $key == 'style')) {
                $attributes[$key].= ' '.$value;
            } else {
                $attributes[$key] = $value;
            }
        }

        return $attributes;
    }

    private function _content($content, $raw = false) {
        if ($raw) {
            return $content;
        } else {
            return do_shortcode($content);
        }
    }

    private function _tag($tag, $name, $content = null, $atts = array(), $args = array(), $no_class = false) {
        $standard = $no_class ? array() : array('class' => 'd4pbbc-'.$name);
        $attributes = $this->_merge($atts, $args, $standard);

        $render = '<'.$tag;

        foreach ($attributes as $key => $value) {
            if (trim($value) != '' && $key != 'raw' && $key != $name) {
                $render.= ' '.$key.'="'.trim($value).'"';
            }
        }

        if (is_null($content)) {
            $render.= ' />';
        } else {
            $raw = isset($atts['raw']) && $atts['raw'] == 1;

            $render.= '>';
            $render.= $this->_content($content, $raw);
            $render.= '</'.$tag.'>';
        }

        if (!$this->force_enqueue) {
            gdbbx_enqueue_files_force();
        }

        return $render;
    }

    private function _simple($code, $tag, $name, $atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts($code, $atts);
        $args = $this->_args($code);

        return $this->_tag($tag, $name, $content, $atts, $args);
    }

    private function _regex($list) {
	$tagregexp = join('|', $list);

	return    '\\['
		. '(\\[?)'
		. "($tagregexp)"
		. '\\b'
		. '('
		.     '[^\\]\\/]*'
		.     '(?:'
		.         '\\/(?!\\])'
		.         '[^\\]\\/]*'
		.     ')*?'
		. ')'
		. '(?:'
		.     '(\\/)'
		.     '\\]'
		. '|'
		.     '\\]'
		.     '(?:'
		.         '('
		.             '[^\\[]*+'
		.             '(?:'
		.                 '\\[(?!\\/\\2\\])'
		.                 '[^\\[]*+'
		.             ')*+'
		.         ')'
		.         '\\[\\/\\2\\]'
		.     ')?'
		. ')'
		. '(\\]?)';

    }

    private function _strip($m) {
        if ($this->removal == 'info') {
            return '[blockquote]'.__("BBCode you used is not allowed.", "gd-bbpress-toolbox").'[/blockquote]';
        } else {
            return '';
        }
    }

    private function _webshot($url, $width = 0) {
        $_url = is_ssl() ? 'https' : 'http';
        $_url.= '://s.wordpress.com/mshots/v1/'.urlencode($url);

        if ($width > 0) {
            $_url.= '?w='.$width;
        }

        return $_url;
    }

    public function get_active_bbcodes() {
        return $this->active_shortcodes;
    }

    public function strip_advanced($content) {
        $pattern = $this->_regex(apply_filters('gdbbx_bbcodes_advanced_list', $this->list_advanced));
        return preg_replace_callback("/$pattern/s", array($this, '_strip'), $content);
    }

    public function strip_restricted($content) {
        $pattern = $this->_regex(apply_filters('gdbbx_bbcodes_restricted_list', $this->list_restricted));
        return preg_replace_callback("/$pattern/s", array($this, '_strip'), $content);
    }

    public function strip_listed($content) {
        $pattern = $this->_regex(apply_filters('gdbbx_bbcodes_stripped_list', $this->list_to_strip));
        return preg_replace_callback("/$pattern/s", array($this, '_strip'), $content);
    }

    public function content_strip_advanced($reply_data) {
        $reply_data['post_content'] = $this->strip_advanced($reply_data['post_content']);
        return $reply_data;
    }

    public function content_strip_restricted($reply_data) {
        $reply_data['post_content'] = $this->strip_restricted($reply_data['post_content']);
        return $reply_data;
    }

    public function content_strip_listed($reply_data) {
        $reply_data['post_content'] = $this->strip_listed($reply_data['post_content']);
        return $reply_data;
    }

    public function show_notice() {
        echo '<div class="bbp-template-notice"><p>';
        echo __("You can use BBCodes to format your content.", "gd-bbpress-toolbox");

        if ($this->remove_advanced) {
            echo '<br/>'.__("Your account can't use Advanced BBCodes, they will be stripped before saving.", "gd-bbpress-toolbox");
        }

        do_action('gdbbx_bbcodes_notice');
        echo '</p></div>';
    }

    public function shortcode_b($atts, $content = null) {
        return $this->_simple('b', 'strong', 'bold', $atts, $content);
    }

    public function shortcode_i($atts, $content = null) {
        return $this->_simple('i', 'em', 'italic', $atts, $content);
    }

    public function shortcode_u($atts, $content = null) {
        return $this->_simple('u', 'span', 'underline', $atts, $content);
    }

    public function shortcode_s($atts, $content = null) {
        return $this->_simple('s', 'del', 'strikethrough', $atts, $content);
    }

    public function shortcode_right($atts, $content = null) {
        return $this->_simple('right', 'div', 'align-right', $atts, $content);
    }

    public function shortcode_center($atts, $content = null) {
        return $this->_simple('center', 'div', 'align-center', $atts, $content);
    }

    public function shortcode_left($atts, $content = null) {
        return $this->_simple('left', 'div', 'align-left', $atts, $content);
    }

    public function shortcode_justify($atts, $content = null) {
        return $this->_simple('justify', 'div', 'align-justify', $atts, $content);
    }

    public function shortcode_sub($atts, $content = null) {
        return $this->_simple('sub', 'sub', 'sub', $atts, $content);
    }

    public function shortcode_sup($atts, $content = null) {
        return $this->_simple('sup', 'sup', 'sup', $atts, $content);
    }

    public function shortcode_scode($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $args = array('class' => array(), 'raw' => 1);

        $atts = $this->_atts('scode', $atts);
        $atts['class'] = trim('d4pbbc-scode '.$atts['class']);

        $lang = strtolower($atts['lang']);

        if (isset($this->code) && is_object($this->code)) {
            $this->code->enqueue();

            if (!$this->code->is_brush_valid($lang)) {
                $lang = 'text';
            }
        }

        $args['class'][] = "brush: ".$lang;
        $args['class'][] = "first-line: ".intval($atts['line']);
        $args['class'][] = "gutter: ".($atts['gutter'] == 'true' ? 'true' : 'false');
        $args['class'][] = "class-name: '".d4p_sanitize_html_classes($atts['class'])."'";

        if (!empty($atts['highlight'])) {
            $highlight = explode(',', $atts['highlight']);
            $highlight = array_map('trim', $highlight);
            $highlight = array_map('intval', $highlight);
            $highlight = array_filter($highlight);

            if (!empty($highlight)) {
                $args['class'][] = 'highlight: ['.join(',', $highlight).']';
            }
        }

        $args['class'] = join('; ', $args['class']);

        return $this->_tag('pre', 'pre', $content, $args, array(), true);
    }

    public function shortcode_pre($atts, $content = null) {
        return $this->_simple('pre', 'pre', 'pre', $atts, $content);
    }

    public function shortcode_border($atts, $content = null) {
        return $this->_simple('border', 'fieldset', 'border', $atts, $content);
    }

    public function shortcode_reverse($atts, $content = null) {
        return $this->_simple('reverse', 'bdo', 'reverse', $atts, $content);
    }

    public function shortcode_blockquote($atts, $content = null) {
        return $this->_simple('blockquote', 'blockquote', 'blockquote', $atts, $content);
    }

    public function shortcode_heading($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('heading', $atts);
        $size = intval($atts['size']);

        if ($size < 1 || $size > 6) {
            $size = 3;
        }

        $tag = 'h'.$size;

        unset($atts['size']);

        return $this->_tag($tag, 'heading', $content, $atts);
    }

    public function shortcode_highlight($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('highlight', $atts);
        $args = array('style' => 'color: '.$atts['color'].'; background: '.$atts['background']);

        unset($atts['color']);
        unset($atts['background']);

        return $this->_tag('span', 'highlight', $content, $atts, $args);
    }

    public function shortcode_spoiler($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('spoiler', $atts);
        $args = array('style' => 'color: '.$atts['color'].'; background: '.$atts['color'], 'data-color' => $atts['color'], 'data-hover' => $atts['hover']);

        unset($atts['color']);
        unset($atts['hover']);

        return $this->_tag('span', 'spoiler', $content, $atts, $args);
    }

    public function shortcode_list($atts, $content = null) {
        return $this->_simple('list', 'ol', 'ol', $atts, $content);
    }

    public function shortcode_ol($atts, $content = null) {
        return $this->_simple('ol', 'ol', 'ol', $atts, $content);
    }

    public function shortcode_ul($atts, $content = null) {
        return $this->_simple('ul', 'ul', 'ul', $atts, $content);
    }

    public function shortcode_li($atts, $content = null) {
        return $this->_simple('li', 'li', 'li', $atts, $content);
    }

    public function shortcode_div($atts, $content = null) {
        return $this->_simple('div', 'div', 'div', $atts, $content);
    }

    public function shortcode_size($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('size', $atts);
        $args = isset($this->shortcodes['size']['args']) ? $this->shortcodes['size']['args'] : array();

        if ($atts['size'] != '') {
            $args['style'] = 'font-size: '.$atts['size'];

            if (is_numeric($atts['size'])) {
                $args['style'].= 'px';
            }

            unset($atts['size']);
        }

        return $this->_tag('span', 'font-size', $content, $atts, $args);
    }

    public function shortcode_color($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('color', $atts);
        $args = isset($this->shortcodes['color']['args']) ? $this->shortcodes['color']['args'] : array();

        if ($atts['color'] != '') {
            $args['style'] = 'color: '.$atts['color'];

            unset($atts['color']);
        }

        return $this->_tag('span', 'font-color', $content, $atts, $args);
    }

    public function shortcode_area($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('area', $atts);
        $args = $this->_args('area');

        if ($atts['area'] != '') {
            $content = '<legend>'.$atts['area'].'</legend>'.$content;
        }

        return $this->_tag('fieldset', 'area', $content, $atts, $args);
    }

    public function shortcode_anchor($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('anchor', $atts);
        $args = $this->_args('anchor');

        if ($atts['anchor'] != '') {
            $args['name'] = $atts['anchor'];
        }

        return $this->_tag('a', 'anchor', $content, $atts, $args);
    }

    public function shortcode_br($atts) {
        $atts = $this->_atts('br', $atts);

        return $this->_tag('br', 'br', null, $atts);
    }

    public function shortcode_hr($atts) {
        $atts = $this->_atts('hr', $atts);

        return $this->_tag('hr', 'hr', null, $atts);
    }

    public function shortcode_quote($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('quote', $atts);

        $title = '';
        if ($atts['quote'] != '') {
            $id = intval($atts['quote']);
            $url = bbp_get_reply_url($id);
            $ath = bbp_get_reply_author_display_name($id);
            $title = '<div class="d4p-bbt-quote-title"><a href="'.$url.'">'.$ath.' '.__("wrote", "gd-bbpress-toolbox").':</a></div>';
        }

        return $this->_tag('blockquote', 'quote', $title.$content, $atts);
    }

    public function shortcode_nfo($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('nfo', $atts);
        $title = $atts['title'] == '' ? 'NFO' : $atts['title'];
        
        $render = '<table class="d4pbbc-nfo '.$atts['class'].'" style="'.$atts['style'].'"><tbody><tr><td class="d4p-bbt-title">'.$title.':</td></tr>';
        $render.= '<tr><td class="d4p-bbt-content"><pre>'.$content.'</pre></td></tr></tbody></table>';

        return $render;
    }

    public function shortcode_reply($atts, $content = null) {
        $atts = $this->_atts('reply', $atts);

        $id = 0; $label = '';
        if ($atts['reply'] != '') {
            $id = intval($atts['reply']);

            if (is_string($content)) {
                $label = $content;
            }
        } else {
            $id = $content;
        }

        $atts['href'] = get_permalink($id);

        if ($label == '') {
            $label = $atts['href'];
        }

        return $this->_tag('a', 'reply-link', $label, $atts);
    }

    public function shortcode_topic($atts, $content = null) {
        $atts = $this->_atts('topic', $atts);

        $id = 0; $label = '';
        if ($atts['topic'] != '') {
            $id = intval($atts['topic']);

            if (is_string($content)) {
                $label = $content;
            }
        } else {
            $id = $content;
        }

        $atts['href'] = get_permalink($id);

        if ($label == '') {
            $label = $atts['href'];
        }

        return $this->_tag('a', 'topic-link', $label, $atts);
    }

    public function shortcode_hide($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('hide', $atts);

        $count = 0;
        if ($atts['hide'] != '') {
            if ($atts['hide'] == 'reply') {
                $count = -1;
            } else if ($atts['hide'] == 'thanks') {
                $count = -2;
            } else {
                $count = abs(intval($atts['hide']));
            }
        }

        $template = '';
        $to_hide = false;

        $topic = bbp_get_topic_id();
        $user = bbp_get_current_user_id();

        if (bbp_is_user_keymaster()) {
            $to_hide = false;
        } else if ($user == bbp_get_topic_author_id()) {
            $to_hide = false;
        } else if ($count == -2) {
            $template = gdbbx()->get('bbcodes_hide_content_thanks', 'tools');

            $to_hide = !gdbbx_check_if_user_said_thanks_to_topic($topic, $user);
        } else if ($count == -1) {
            $template = gdbbx()->get('bbcodes_hide_content_reply', 'tools');

            $to_hide = !gdbbx_check_if_user_replied_to_topic($topic, $user);
        } else if ($count > 0) {
            $total = bbp_get_user_reply_count_raw(bbp_get_current_user_id()) + 
                     bbp_get_user_topic_count_raw(bbp_get_current_user_id());

            $to_hide = $count > $total;

            if ($to_hide) {
                $_tpl = gdbbx()->get('bbcodes_hide_content_count', 'tools');
                $template = str_replace('%post_count%', $count, $_tpl);
            }
        } else {
            $template = gdbbx()->get('bbcodes_hide_content_normal', 'tools');

            $to_hide = !is_user_logged_in();
        }

        $render = '<div class="d4pbbc-hide d4phide-'.($to_hide ? 'hidden' : 'visible').'">';
        $render.= '<div class="d4phide-title">'.gdbbx()->get('bbcodes_hide_title', 'tools').'</div>';
        $render.= '<div class="d4phide-content">';

        if ($to_hide) {
            $render.= do_shortcode($template);
        } else {
            $render.= do_shortcode($content);
        }

        $render.= '</div></div>';

        return $render;
    }

    public function shortcode_embed($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('embed', $atts);

        if ($atts['embed'] != '') {
            $parts = explode('x', $atts['embed'], 2);

            if (count($parts) == 2) {
                $args['width'] = intval($parts[0]);
                $args['height'] = intval($parts[1]);
            }
        }

        $data = array();
        if ($atts['width'] > 0) {
            $data['width'] = $atts['width'];
        }

        if ($atts['height'] > 0) {
            $data['height'] = $atts['height'];
        }

        global $wp_embed;
        return $wp_embed->shortcode($data, $content);
    }

    public function shortcode_url($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('url', $atts);
        $args = $this->_args('url');

        if ($atts['url'] != '') {
            $args['href'] = str_replace(array('"', "'"), '', $atts['url']);
        } else {
            $args['href'] = $content;
        }

        return $this->_tag('a', 'url', $content, $atts, $args);
    }

    public function shortcode_email($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('email', $atts);
        $args = $this->_args('email');

        if ($atts['email'] != '') {
            $args['href'] = $atts['email'];
        } else {
            $args['href'] = $content;
            $content = antispambot($content);
        }

        $args['href'] = 'mailto:'.antispambot($args['href'], 1);

        return $this->_tag('a', 'url', $content, $atts, $args);
    }

    public function shortcode_webshot($atts, $content = null) {
        if (is_null($content) || $content == '') {
            return '';
        }

        $atts = $this->_atts('webshot', $atts);
        $args = $this->_args('webshot');
        $args['src'] = $this->_webshot($content, $args['width']);

        $image = $this->_tag('img', 'image', null, $atts, $args);
        return $this->_tag('a', 'url', $image, $atts, array('href' => $args['src']));
    }

    public function shortcode_attachment($atts, $content = null) {
        $atts = $this->_atts('attachment', $atts);

        $attachment = gdbbx_get_attachment($atts['file']);

        if ($attachment > 0) {
            $_image_types = apply_filters('gdbbx_attachment_image_extensions', array('png', 'gif', 'jpg', 'jpeg', 'jpe', 'bmp'));

            $file = get_attached_file($attachment);
            $ext = pathinfo($file, PATHINFO_EXTENSION);

            if ($atts['title'] == '') {
                $atts['title'] = get_the_title($attachment);
            }

            if ($atts['alt'] == '') {
                $atts['alt'] = get_the_title($attachment);
            }

            $atts_a = shortcode_atts(array('target' => '_blank', 'rel' => '', 'style' => '', 'class' => '', 'title' => ''), $atts);

            if (in_array($ext, $_image_types)) {
                $defaults = apply_filters('gdbbx_attachment_image_defaults', array(
                    'a' => array('target' => '_blank', 'rel' => '', 'style' => '', 'class' => '', 'title' => ''),
                    'img' => array('width' => '', 'height' => '', 'alt' => ''),
                    'thumb' => 'full'
                ), $attachment);
                
                $atts_a = shortcode_atts($defaults['a'], $atts);
                $atts_img = shortcode_atts($defaults['img'], $atts);
                $atts_a['href'] = wp_get_attachment_url($attachment);
                $atts_img['src'] = $atts_a['href'];

                $image = wp_get_attachment_image_src($attachment, $defaults['thumb']);
                if ($image) {
                    $atts_img['src'] = $image[0];
                }
    
                return $this->_tag('a', 'attachment', $this->_tag('img', 'attachment-image', null, $atts_img), $atts_a);
            } else {
                $defaults = apply_filters('gdbbx_attachment_file_defaults', array('target' => '_blank', 'rel' => '', 'style' => '', 'class' => '', 'title' => ''), $attachment);

                $atts_a['href'] = wp_get_attachment_url($attachment);

                return $this->_tag('a', 'attachment', get_the_title($attachment), $atts_a);
            }
        }

        return '';
    }

    public function shortcode_img($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('img', $atts);
        $args = $this->_args('img');
        $args['src'] = $content;

        if ($atts['img'] != '') {
            $parts = explode('x', $atts['img'], 2);

            if (count($parts) == 2) {
                $args['width'] = intval($parts[0]);
                $args['height'] = intval($parts[1]);
            }
        }

        return $this->_tag('img', 'image', null, $atts, $args);
    }

    public function shortcode_google($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('google', $atts);
        $args = isset($this->shortcodes['google']['args']) ? $this->shortcodes['google']['args'] : array();

        $protocol = is_ssl() ? 'https' : 'http';
        $link = $protocol.'://www.google.';

        if ($atts['google'] != '') {
            $link.= $atts['google'];
        } else {
            $link.= 'com';
        }

        $link.= '/search?q='.urlencode($content);

        $args['href'] = $link;

        return $this->_tag('a', 'google', $content, $atts, $args);
    }

    public function shortcode_youtube($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('youtube', $atts);

        if (strpos($content, 'youtube.com') === false && strpos($content, 'youtu.be') === false) {
            $protocol = is_ssl() ? 'https' : 'http';
            $url = $protocol.'://www.youtube.com/watch?v='.$content;
        } else {
            $url = $content;

            if (is_ssl() && substr($url, 0, 5) != 'https') {
                $url = 'https'.substr($url, 4);
            }
        }

        if ($atts['youtube'] != '') {
            $parts = explode('x', $atts['youtube'], 2);

            if (count($parts) == 2) {
                $args['width'] = intval($parts[0]);
                $args['height'] = intval($parts[1]);
            }
        }

        $data = array();
        if ($atts['width'] > 0) {
            $data['width'] = $atts['width'];
        }

        if ($atts['height'] > 0) {
            $data['height'] = $atts['height'];
        }

        global $wp_embed;
        return $wp_embed->shortcode($data, $url);
    }

    public function shortcode_vimeo($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('vimeo', $atts);

        if (strpos($content, 'vimeo.com') === false) {
            $protocol = is_ssl() ? 'https' : 'http';
            $url = $protocol.'://www.vimeo.com/'.$content;
        } else {
            $url = $content;

            if (is_ssl() && substr($url, 0, 5) != 'https') {
                $url = 'https'.substr($url, 4);
            }
        }

        if ($atts['vimeo'] != '') {
            $parts = explode('x', $atts['vimeo'], 2);

            if (count($parts) == 2) {
                $args['width'] = intval($parts[0]);
                $args['height'] = intval($parts[1]);
            }
        }

        $data = array();
        if ($atts['width'] > 0) {
            $data['width'] = $atts['width'];
        }

        if ($atts['height'] > 0) {
            $data['height'] = $atts['height'];
        }

        global $wp_embed;
        return $wp_embed->shortcode($data, $url);
    }

    public function shortcode_note($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        return '<!-- '.$this->_content($content).' -->';
    }

    public function shortcode_iframe($atts, $content = null) {
        if (is_null($content)) {
            return '';
        }

        $atts = $this->_atts('iframe', $atts);

        return '<iframe src="'.$content.'" width="'.$atts['width'].'" height="'.$atts['height'].'" frameborder="'.$atts['frameborder'].'"></iframe>';
    }
}
