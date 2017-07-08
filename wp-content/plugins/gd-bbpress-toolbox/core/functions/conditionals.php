<?php

if (!defined('ABSPATH')) exit;

function gdbbx_is_module_loaded($module) {
    return isset(gdbbx_loader()->modules[$module]);
}

function gdbbx_is_topic_locked($topic_id = 0) {
    return gdbbx_module_lock()->is_topic_locked($topic_id);
}

function gdbbx_is_reply_locked($topic_id = 0) {
    return gdbbx_module_lock()->is_reply_locked($topic_id);
}

function gdbbx_is_topic_private($topic_id = 0, $forced_check = false) {
    return gdbbx_loader()->modules['private']->is_topic_private($topic_id, $forced_check);
}

function gdbbx_is_reply_private($reply_id = 0, $forced_check = false) {
    return gdbbx_loader()->modules['private']->is_reply_private($reply_id, $forced_check);
}

function gdbbx_is_user_allowed_to_topic($topic_id = 0, $user_id = 0) {
    return gdbbx_loader()->modules['private']->is_user_allowed_to_topic($topic_id, $user_id);
}

function gdbbx_is_user_allowed_to_reply($reply_id = 0, $user_id = 0) {
    return gdbbx_loader()->modules['private']->is_user_allowed_to_reply($reply_id, $user_id);
}
