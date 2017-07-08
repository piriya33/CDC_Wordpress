<?php

if (!defined('ABSPATH')) exit;

function gdbbx_get_forum_from_wp_query() {
    global $wp_query;

    $forum_id = 0;

    if (is_404() && isset($wp_query->query['name'])) {
        $post = get_page_by_path($wp_query->query['name'], OBJECT, bbp_get_forum_post_type());

        if ($post) {
            $forum_id = $post->ID;
        }
    } else {
        switch ($wp_query->get('post_type')) {
            case bbp_get_forum_post_type() :
                $forum_id = bbp_get_forum_id($wp_query->post->ID);
                break;
            case bbp_get_topic_post_type() :
                $forum_id = bbp_get_topic_forum_id($wp_query->post->ID);
                break;
            case bbp_get_reply_post_type() :
                $forum_id = bbp_get_reply_forum_id($wp_query->post->ID);
                break;
        }
    }

    return $forum_id;
}

function gdbbx_forum_enforce_hidden() {
    if (bbp_is_user_keymaster() || current_user_can('read_hidden_forums')) {
        return;
    }

    $forum_id = gdbbx_get_forum_from_wp_query();

    if (!empty($forum_id) && bbp_is_forum_hidden($forum_id) && !current_user_can('read_hidden_forums')) {
        gdbbx_module_lock()->redirect_to_key('redirect_hidden_forums_url');
    }
}

function gdbbx_forum_enforce_private() {
    if (bbp_is_user_keymaster() || current_user_can('read_private_forums')) {
        return;
    }

    $forum_id = gdbbx_get_forum_from_wp_query();

    if (!empty($forum_id) && bbp_is_forum_private($forum_id) && !current_user_can('read_private_forums')) {
        gdbbx_module_lock()->redirect_to_key('redirect_private_forums_url');
    }
}

function gdbbx_forum_enforce_blocked() {
    if (!is_user_logged_in() || bbp_is_user_keymaster()) {
        return;
    }

    if (is_bbpress() && !current_user_can('spectate')) {
        gdbbx_module_lock()->redirect_to_key('redirect_blocked_users_url');
    }
}
