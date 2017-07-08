<?php

if (!defined('ABSPATH')) exit;

class gdbbx_core_early {
    public function __construct() { }

    public function features() {
        $_forums = gdbbx()->get('add_forum_features', 'tools');
        if (!empty($_forums)) {
            add_filter('bbp_get_forum_post_type_supports', array($this, 'bbp_supports_forum'));
        }

        $_topics = gdbbx()->get('add_topic_features', 'tools');
        if (!empty($_topics)) {
            add_filter('bbp_get_topic_post_type_supports', array($this, 'bbp_supports_topic'));
        }

        $_replies = gdbbx()->get('add_reply_features', 'tools');
        if (!empty($_replies)) {
            add_filter('bbp_get_reply_post_type_supports', array($this, 'bbp_supports_reply'));
        }
    }

    public function bbp_supports_forum($supports) {
        $supports = array_merge($supports, gdbbx()->get('add_forum_features', 'tools'));

        return $supports;
    }

    public function bbp_supports_topic($supports) {
        $supports = array_merge($supports, gdbbx()->get('add_topic_features', 'tools'));

        return $supports;
    }

    public function bbp_supports_reply($supports) {
        $supports = array_merge($supports, gdbbx()->get('add_reply_features', 'tools'));

        return $supports;
    }
}
