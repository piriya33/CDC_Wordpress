<?php

if (!defined('ABSPATH')) exit;

function gdbbx_notify_reply_subscribers_on_edit($reply_id) {
    if (!bbp_is_subscriptions_active()) {
        return false;
    }

    $reply_id = bbp_get_reply_id($reply_id);
    $topic_id = bbp_get_reply_topic_id($reply_id);

    if (!bbp_is_topic_published($topic_id)) {
        return false;
    }

    $_send_to_author = isset($_POST['gdbbx_notify_on_edit_author']) && $_POST['gdbbx_notify_on_edit_author'] == 1;
    $_send_to_subscribers = isset($_POST['gdbbx_notify_on_edit_subscribers']) && $_POST['gdbbx_notify_on_edit_subscribers'] == 1;

    if ($_send_to_author === false && $_send_to_subscribers === false) {
        return false;
    }

    $reply_editor_name = gdbbx_get_user_display_name();

    remove_all_filters('bbp_get_topic_content');
    remove_all_filters('bbp_get_topic_title');
    remove_all_filters('bbp_get_reply_content');
    remove_all_filters('bbp_get_reply_title');

    $reply_title = strip_tags(bbp_get_reply_title($reply_id));
    $reply_content = strip_tags(bbp_get_reply_content($reply_id));
    $reply_url = bbp_get_reply_url($reply_id);
    $blog_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    // For plugins to filter messages per reply/topic/user
    $message = sprintf('%1$s edited reply:

%2$s

Reply Link: %3$s

-----------

You are receiving this email because you subscribed to a forum topic.

Login and visit the topic to unsubscribe from these emails.',
        $reply_editor_name,
        $reply_content,
        $reply_url
    );

    $message = apply_filters('bbp_reply_edit_subscription_mail_message', $message, $reply_id);
    if (empty($message)) {
        return;
    }

    $subject = sprintf(__("[%s] Reply edited: %s", "gd-bbpress-toolbox"), $blog_name, $reply_title);
    $subject = apply_filters('bbp_reply_edit_subscription_mail_title', $subject, $reply_id);
    if (empty($subject)) {
        return;
    }

    $no_reply = bbp_get_do_not_reply_address();
    $from_email = apply_filters('bbp_reply_edit_subscription_from_email', $no_reply);
    $headers = array('From: '.get_bloginfo('name').' <'.$from_email.'>');

    $user_ids = array();

    if ($_send_to_author) {
        $user_ids[] = bbp_get_reply_author_id($reply_id);
    }

    if ($_send_to_subscribers) {
        $user_ids = array_merge($user_ids, bbp_get_topic_subscribers($topic_id, true));
    }

    $user_ids = apply_filters('bbp_reply_edit_subscription_user_ids', $user_ids);
    if (empty($user_ids)) {
        return false;
    }

    $user_ids = array_unique($user_ids);
    $user_ids = array_filter($user_ids);

    foreach ((array)$user_ids as $user_id) {
        if ((int)$user_id === (int)get_current_user_id() || $user_id == 0) {
            continue;
        }

        $user = get_userdata($user_id);

        if ($user) {
            $headers[] = 'Bcc: '.get_userdata($user_id)->user_email;
        }
    }

    $headers  = apply_filters('bbp_reply_edit_subscription_mail_headers', $headers);
    $to_email = apply_filters('bbp_reply_edit_subscription_to_email', $no_reply);

    do_action('bbp_pre_notify_reply_edit_subscribers', $reply_id, $user_ids);

    wp_mail($to_email, $subject, $message, $headers);

    do_action('bbp_post_notify_reply_edit_subscribers', $reply_id, $user_ids);

    return true;
}

function gdbbx_notify_topic_subscribers_on_edit($topic_id) {
    if (!bbp_is_subscriptions_active()) {
        return false;
    }

    $topic_id = bbp_get_topic_id($topic_id);

    if (!bbp_is_topic_published($topic_id)) {
        return false;
    }

    $_send_to_author = isset($_POST['gdbbx_notify_on_edit_author']) && $_POST['gdbbx_notify_on_edit_author'] == 1;
    $_send_to_subscribers = isset($_POST['gdbbx_notify_on_edit_subscribers']) && $_POST['gdbbx_notify_on_edit_subscribers'] == 1;

    if ($_send_to_author === false && $_send_to_subscribers === false) {
        return false;
    }

    $topic_editor_name = gdbbx_get_user_display_name();

    remove_all_filters('bbp_get_topic_content');
    remove_all_filters('bbp_get_topic_title');

    $topic_title = strip_tags(bbp_get_topic_title($topic_id));
    $topic_content = strip_tags(bbp_get_topic_content($topic_id));
    $topic_url = bbp_get_topic_permalink($topic_id);
    $blog_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    // For plugins to filter messages per reply/topic/user
    $message = sprintf('%1$s edited topic:

%2$s

Post Link: %3$s

-----------

You are receiving this email because you subscribed to a forum topic.

Login and visit the topic to unsubscribe from these emails.',
        $topic_editor_name,
        $topic_content,
        $topic_url
    );

    $message = apply_filters('bbp_topic_edit_subscription_mail_message', $message, $topic_id);
    if (empty($message)) {
        return;
    }

    $subject = sprintf(__("[%s] Topic edited: %s", "gd-bbpress-toolbox"), $blog_name, $topic_title);
    $subject = apply_filters('bbp_topic_edit_subscription_mail_title', $subject, $topic_id);
    if (empty($subject)) {
        return;
    }

    $no_reply = bbp_get_do_not_reply_address();
    $from_email = apply_filters('bbp_topic_edit_subscription_from_email', $no_reply);
    $headers = array('From: '.get_bloginfo('name').' <'.$from_email.'>');

    $user_ids = array();

    if ($_send_to_author) {
        $user_ids[] = bbp_get_topic_author_id($topic_id);
    }

    if ($_send_to_subscribers) {
        $user_ids = array_merge($user_ids, bbp_get_topic_subscribers($topic_id, true));
    }

    $user_ids = apply_filters('bbp_topic_edit_subscription_user_ids', $user_ids);
    if (empty($user_ids)) {
        return false;
    }

    $user_ids = array_unique($user_ids);
    $user_ids = array_filter($user_ids);

    foreach ((array)$user_ids as $user_id) {
        if ((int)$user_id === (int)get_current_user_id() || $user_id == 0) {
            continue;
        }

        $user = get_userdata($user_id);

        if ($user) {
            $headers[] = 'Bcc: '.get_userdata($user_id)->user_email;
        }
    }

    $headers  = apply_filters('bbp_topic_edit_subscription_mail_headers', $headers);
    $to_email = apply_filters('bbp_topic_edit_subscription_to_email', $no_reply);

    do_action('bbp_pre_notify_topic_edit_subscribers', $topic_id, $user_ids);

    wp_mail($to_email, $subject, $message, $headers);

    do_action('bbp_post_notify_topic_edit_subscribers', $topic_id, $user_ids);

    return true;
}

function gdbbx_notify_moderators_on_new_topic($topic_id = 0, $forum_id = 0) {
    if (!bbp_is_subscriptions_active()) {
        return false;
    }

    $topic_id = bbp_get_topic_id($topic_id);
    $forum_id = bbp_get_forum_id($forum_id);

    if (!bbp_is_topic_published($topic_id)) {
        return false;
    }

    $topic_author_id = bbp_get_topic_author_id($topic_id);
    $topic_author_name = bbp_get_topic_author_display_name($topic_id);

    remove_all_filters('bbp_get_topic_content');
    remove_all_filters('bbp_get_topic_title');

    $topic_title = strip_tags(bbp_get_topic_title($topic_id));
    $topic_content = strip_tags(bbp_get_topic_content($topic_id));
    $topic_url = bbp_get_topic_permalink($topic_id);
    $blog_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    // For plugins to filter messages per reply/topic/user
    $message = sprintf('%1$s posted new topic:

%2$s

Post Link: %3$s

-----------

This email is sent to keymasters and moderators when new topic is created.',
        $topic_author_name,
        $topic_content,
        $topic_url
    );

    $message = apply_filters('bbp_new_topic_moderators_mail_message', $message, $topic_id, $forum_id);
    if (empty($message)) {
        return;
    }

    $subject = sprintf(__("[%s] New topic posted: %s", "gd-bbpress-toolbox"), $blog_name, $topic_title);
    $subject = apply_filters('bbp_new_topic_moderators_mail_title', $subject, $topic_id, $forum_id);
    if (empty($subject)) {
        return;
    }

    $no_reply = bbp_get_do_not_reply_address();
    $from_email = apply_filters('bbp_new_topic_moderators_from_email', $no_reply);
    $headers = array('From: '.get_bloginfo('name').' <'.$from_email.'>');

    $send_to_users = array();
    $users_lists = array();
    $subscribers = bbp_get_forum_subscribers($forum_id, true);

    if (gdbbx()->get('new_topic_notification_keymaster', 'bbpress')) {
        $users_lists = array_merge($users_lists, gdbbx_get_keymasters());
    }

    if (gdbbx()->get('new_topic_notification_moderator', 'bbpress')) {
        $users_lists = array_merge($users_lists, gdbbx_get_moderators());
    }

    foreach ($users_lists as $user) {
        if ((is_array($subscribers) && in_array($user->ID, $subscribers)) || $user->ID == $topic_author_id) {
            continue;
        }

        $send_to_users[] = $user->user_email;
    }

    $send_to_users = array_unique($send_to_users);
    $send_to_users = array_filter($send_to_users);

    $send_to_users = apply_filters('bbp_new_topic_moderators_emails', $send_to_users);

    if (!empty($send_to_users)) {
        foreach ($send_to_users as $email) {
            $headers[] = 'Bcc: '.$email;
        }
    }

    $headers  = apply_filters('bbp_new_topic_moderators_mail_headers', $headers);
    $to_email = apply_filters('bbp_new_topic_moderators_to_email', $no_reply);

    do_action('bbp_pre_notify_new_topic_moderators', $topic_id, $send_to_users);

    wp_mail($to_email, $subject, $message, $headers);

    do_action('bbp_post_notify_new_topic_moderators', $topic_id, $send_to_users);

    return true;
}
