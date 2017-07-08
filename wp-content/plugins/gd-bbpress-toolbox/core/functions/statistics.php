<?php

if (!defined('ABSPATH')) exit;

function gdbbx_get_statistics() {
    $statistics = get_transient('gdbbx_forum_statistics');

    if ($statistics === false) {
        $user_count = gdbbx_db()->get_total_users_count();
        $forum_count = wp_count_posts(bbp_get_forum_post_type())->publish;
        $topic_count_hidden = 0;
        $reply_count_hidden = 0;
        $empty_topic_tag_count = 0;

        $private = bbp_get_private_status_id();
        $spam = bbp_get_spam_status_id();
        $trash = bbp_get_trash_status_id();
        $closed = bbp_get_closed_status_id();

        $all_topics  = wp_count_posts(bbp_get_topic_post_type());

        $topic_count = $all_topics->publish + $all_topics->{$closed};
        $topic_count_open = $all_topics->publish;
        $topic_count_closed = $all_topics->{$closed};

        if (current_user_can('read_private_topics') || current_user_can('edit_others_topics') || current_user_can('view_trash')) {
            $topics['private'] = current_user_can('read_private_topics') ? (int)$all_topics->{$private} : 0;
            $topics['spammed'] = current_user_can('edit_others_topics') ? (int)$all_topics->{$spam} : 0;
            $topics['trashed'] = current_user_can('view_trash') ? (int)$all_topics->{$trash} : 0;

            $topic_count_hidden = $topics['private'] + $topics['spammed'] + $topics['trashed'];
        }

        $all_replies = wp_count_posts( bbp_get_reply_post_type() );

        $reply_count = $all_replies->publish;

        if (current_user_can('read_private_replies') || current_user_can('edit_others_replies') || current_user_can('view_trash')) {
            $replies['private'] = current_user_can('read_private_replies') ? (int) $all_replies->{$private} : 0;
            $replies['spammed'] = current_user_can('edit_others_replies') ? (int) $all_replies->{$spam} : 0;
            $replies['trashed'] = current_user_can('view_trash') ? (int) $all_replies->{$trash} : 0;

            $reply_count_hidden = $replies['private'] + $replies['spammed'] + $replies['trashed'];
        }

        $topic_tag_count = wp_count_terms(bbp_get_topic_tag_tax_id(), array('hide_empty' => true));

        if (current_user_can('edit_topic_tags')) {
            $empty_topic_tag_count = wp_count_terms(bbp_get_topic_tag_tax_id()) - $topic_tag_count;
        }

        $post_count = $topic_count + $reply_count;

        $statistics = array_map('number_format_i18n', array_map('absint', compact(
            'user_count',
            'forum_count',
            'topic_count',
            'topic_count_open',
            'topic_count_hidden',
            'topic_count_closed',
            'post_count',
            'reply_count',
            'reply_count_hidden',
            'topic_tag_count',
            'empty_topic_tag_count'
        )));

        $expire = apply_filters('gdbbx_forum_statistics_expiration', 7200);

        set_transient('gdbbx_forum_statistics', $statistics, $expire);
    }

    return apply_filters('gdbbx_get_statistics', $statistics);
}
