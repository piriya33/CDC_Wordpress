<?php

if (!defined('ABSPATH')) exit;

class d4pbbpWidget_userprofile extends d4p_widget_core {
    public $widget_base = 'd4p_bbw_userprofile';
    public $widget_domain = 'd4pbbw_widgets';
    public $cache_prefix = 'd4pbbw';

    public $defaults = array(
        'title' => 'My Profile',
        '_display' => 'all',
        '_hook' => '',
        '_cached' => 0,
        '_tab' => 'global',
        '_class' => '',
        'show_login' => true,
        'show_profile' => true,
        'show_stats' => true,
        'show_role' => true,
        'show_topics' => true,
        'show_replies' => true,
        'show_favorites' => true,
        'show_subsciptions' => true,
        'show_edit' => true,
        'show_logout' => true,
        'avatar_size' => 96,
        'before' => '',
        'after' => ''
    );

    public function __construct($id_base = false, $name = '', $widget_options = array(), $control_options = array()) {
        $this->widget_description = __("Logged in user profile and links.", "gd-bbpress-toolbox");
        $this->widget_name = 'GD bbPress Toolbox: '.__("User Profile", "gd-bbpress-toolbox");

        parent::__construct($this->widget_base, $this->widget_name, array(), array('width' => 500));
    }

    public function form($instance) {
        $instance = wp_parse_args((array)$instance, $this->get_defaults());

        $_tabs = array(
            'global' => array('name' => __("Global", "gd-bbpress-toolbox"), 'include' => array('shared-global', 'shared-display')),
            'content' => array('name' => __("Content", "gd-bbpress-toolbox"), 'include' => array('userprofile-content')),
            'extra' => array('name' => __("Extra", "gd-bbpress-toolbox"), 'include' => array('shared-wrapper'))
        );

        include(GDBBX_PATH.'forms/widgets/shared-loader.php');
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = d4p_sanitize_basic($new_instance['title']);
        $instance['_display'] = d4p_sanitize_basic($new_instance['_display']);
        $instance['_class'] = d4p_sanitize_basic($new_instance['_class']);
        $instance['_tab'] = d4p_sanitize_basic($new_instance['_tab']);
        $instance['_hook'] = d4p_sanitize_key_expanded($new_instance['_hook']);

        $instance['show_profile'] = isset($new_instance['show_profile']);
        $instance['show_stats'] = isset($new_instance['show_stats']);
        $instance['show_role'] = isset($new_instance['show_role']);
        $instance['show_topics'] = isset($new_instance['show_topics']);
        $instance['show_replies'] = isset($new_instance['show_replies']);
        $instance['show_favorites'] = isset($new_instance['show_favorites']);
        $instance['show_subsciptions'] = isset($new_instance['show_subsciptions']);
        $instance['show_edit'] = isset($new_instance['show_edit']);
        $instance['show_logout'] = isset($new_instance['show_logout']);
        $instance['show_login'] = isset($new_instance['show_login']);
        $instance['avatar_size'] = absint($new_instance['avatar_size']);

        if (current_user_can('unfiltered_html')) {
            $instance['before'] = $new_instance['before'];
            $instance['after'] = $new_instance['after'];
        } else {
            $instance['before'] = d4p_sanitize_html($new_instance['before']);
            $instance['after'] = d4p_sanitize_html($new_instance['after']);
        }

        return $instance;
    }

    public function is_visible($instance) {
        return (is_user_logged_in() && bbp_user_has_profile()) || $instance['show_login'];
    }

    public function render($results, $instance) {
        $instance = wp_parse_args((array)$instance, $this->get_defaults());

        gdbbx_widget_render_header($instance, 'bbx-userprofile');

        include(gdbbx_get_template_part('gdbbx-widget-userprofile.php'));

        gdbbx_widget_render_footer($instance);
    }
}
