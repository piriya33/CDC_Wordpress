<?php

if (!defined('ABSPATH')) exit;

class d4pbbpWidget_topicinfo extends d4p_widget_core {
    public $widget_base = 'd4p_bbw_topicinfo';
    public $widget_domain = 'd4pbbw_widgets';
    public $cache_prefix = 'd4pbbw';

    public $cache_active = false;

    public $defaults = array(
        'title' => 'Topic Information',
        '_display' => 'all',
        '_hook' => '',
        '_cached' => 0,
        '_class' => '',
        '_tab' => 'global',
        'before' => '',
        'after' => '',
        'show_forum' => true,
        'show_author' => true,
        'show_post_date' => true,
        'show_last_activity' => true,
        'show_status' => true,
        'show_count_replies' => true,
        'show_count_voices' => true,
        'show_participants' => true
    );

    public function __construct($id_base = false, $name = '', $widget_options = array(), $control_options = array()) {
        $this->widget_description = __("Information about current topic.", "gd-bbpress-toolbox");
        $this->widget_name = 'GD bbPress Toolbox: '.__("Topic Information", "gd-bbpress-toolbox");

        parent::__construct($this->widget_base, $this->widget_name, array(), array('width' => 500));
    }

    public function form($instance) {
        $instance = wp_parse_args((array)$instance, $this->get_defaults());

        $_tabs = array(
            'global' => array('name' => __("Global", "gd-bbpress-toolbox"), 'include' => array('shared-global', 'shared-display')),
            'content' => array('name' => __("Content", "gd-bbpress-toolbox"), 'include' => array('topicinfo-content')),
            'extra' => array('name' => __("Extra", "gd-bbpress-toolbox"), 'include' => array('shared-wrapper'))
        );

        include(GDBBX_PATH.'forms/widgets/shared-loader.php');
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = d4p_sanitize_basic($new_instance['title']);
        $instance['_display'] = d4p_sanitize_basic($new_instance['_display']);
        $instance['_cached'] = absint($new_instance['_cached']);
        $instance['_class'] = d4p_sanitize_basic($new_instance['_class']);
        $instance['_tab'] = d4p_sanitize_basic($new_instance['_tab']);
        $instance['_hook'] = d4p_sanitize_key_expanded($new_instance['_hook']);

        $instance['show_forum'] = isset($new_instance['show_forum']);
        $instance['show_author'] = isset($new_instance['show_author']);
        $instance['show_post_date'] = isset($new_instance['show_post_date']);
        $instance['show_last_activity'] = isset($new_instance['show_last_activity']);
        $instance['show_status'] = isset($new_instance['show_status']);
        $instance['show_count_replies'] = isset($new_instance['show_count_replies']);
        $instance['show_count_voices'] = isset($new_instance['show_count_voices']);
        $instance['show_participants'] = isset($new_instance['show_participants']);

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
        return bbp_is_single_topic();
    }

    public function results($instance) {
        $instance = wp_parse_args((array)$instance, $this->get_defaults());

        $topic_id = bbp_get_topic_id();

        $list = array();

        if ($instance['show_forum']) {
            $forum_id = bbp_get_topic_forum_id();

            $list['show_forum'] = array(
                'label' => __("Forum", "gd-bbpress-toolbox"),
                'value' => '<a href="'.bbp_get_forum_permalink($forum_id).'">'.bbp_get_forum_title($forum_id).'</a>'
            );
        }

        if ($instance['show_author']) {
            $list['show_author'] = array(
                'label' => __("Author", "gd-bbpress-toolbox"),
                'value' => bbp_get_topic_author_link(array('type' => 'name'))
            );
        }

        if ($instance['show_post_date']) {
            $post_date = get_post_field('post_date', $topic_id);

            $list['show_post_date'] = array(
                'label' => __("Posted", "gd-bbpress-toolbox"),
                'value' => bbp_get_time_since(bbp_convert_date($post_date))
            );
        }

        if ($instance['show_last_activity']) {
            $list['show_last_activity'] = array(
                'label' => __("Last Activity", "gd-bbpress-toolbox"),
                'value' => bbp_get_topic_last_active_time($topic_id)
            );
        }

        if ($instance['show_status']) {
            $list['show_status'] = array(
                'label' => __("Status", "gd-bbpress-toolbox"),
                'value' => bbp_is_topic_open($topic_id) ? __("Open", "gd-bbpress-toolbox") : __("Closed", "gd-bbpress-toolbox")
            );
        }

        if ($instance['show_count_replies']) {
            $list['show_count_replies'] = array(
                'label' => __("Replies", "gd-bbpress-toolbox"),
                'value' => bbp_get_topic_reply_count($topic_id)
            );
        }

        if ($instance['show_count_voices']) {
            $list['show_count_voices'] = array(
                'label' => __("Voices", "gd-bbpress-toolbox"),
                'value' => bbp_get_topic_voice_count($topic_id)
            );
        }

        if ($instance['show_participants'] && bbp_get_topic_voice_count($topic_id) > 1) {
            $users = gdbbx_db()->get_topic_participants($topic_id);

            $participants = array();
            foreach ($users as $id) {
                if (get_userdata($id) !== false) {
                    $participants[] = bbp_get_user_profile_link($id);
                }
            }

            $list['show_participants'] = array(
                'label' => __("Participants", "gd-bbpress-toolbox"),
                'value' => join('<br/>', $participants)
            );
        }

        return $list;
    }

    public function render($results, $instance) {
        $instance = wp_parse_args((array)$instance, $this->get_defaults());
        
        gdbbx_widget_render_header($instance, 'bbx-topicinfo');

        include(gdbbx_get_template_part('gdbbx-widget-topicinfo.php'));
        
        gdbbx_widget_render_footer($instance);
    }
}
