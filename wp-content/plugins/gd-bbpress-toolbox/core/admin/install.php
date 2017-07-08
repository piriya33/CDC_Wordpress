<?php

if (!defined('ABSPATH')) exit;

function gdbbx_install_database() {
    global $wpdb;

    $charset_collate = '';

    if (!empty($wpdb->charset)) {
        $charset_collate = "default CHARACTER SET $wpdb->charset";
    }

    if (!empty($wpdb->collate)) {
        $charset_collate.= " COLLATE $wpdb->collate";
    }

    $tables = array(
        'actions' => $wpdb->prefix.'gdbbx_actions',
        'actionmeta' => $wpdb->prefix.'gdbbx_actionmeta',
        'tracker' => $wpdb->prefix.'gdbbx_tracker'
    );

    $query = "CREATE TABLE ".$tables['actionmeta']." (
meta_id bigint(20) unsigned NOT NULL auto_increment,
action_id bigint(20) unsigned NOT NULL default '0',
meta_key varchar(255) NULL default NULL,
meta_value longtext NULL,
PRIMARY KEY  (meta_id),
KEY action_id (action_id),
KEY meta_key (meta_key)) ".$charset_collate.";

CREATE TABLE ".$tables['actions']." (
action_id bigint(20) unsigned NOT NULL auto_increment,
user_id bigint(20) unsigned NOT NULL default '0',
post_id bigint(20) unsigned NOT NULL default '0',
logged datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'gmt',
action varchar(128) NOT NULL default '',
reference_id bigint(20) unsigned NOT NULL default '0',
PRIMARY KEY  (action_id),
KEY user_id (user_id),
KEY post_id (post_id),
KEY action (action),
KEY reference_id (reference_id)
) ".$charset_collate.";

CREATE TABLE ".$tables['tracker']." (
user_id bigint(20) unsigned NOT NULL,
topic_id bigint(20) unsigned NOT NULL,
forum_id bigint(20) unsigned NOT NULL,
reply_id bigint(20) unsigned NOT NULL,
latest datetime NOT NULL,
PRIMARY KEY  (user_id,topic_id),
KEY forum_id (forum_id)
) ".$charset_collate.";";

    require_once(ABSPATH.'wp-admin/includes/upgrade.php');

    return dbDelta($query);
}

function gdbbx_check_database() {
    global $wpdb;

    $result = array();
    $tables = array(
        $wpdb->prefix.'gdbbx_actionmeta' => 4,
        $wpdb->prefix.'gdbbx_actions' => 6,
        $wpdb->prefix.'gdbbx_tracker' => 5
    );

    foreach ($tables as $table => $count) {
        if ($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table) {
            $columns = $wpdb->get_results("SHOW COLUMNS FROM $table");

            if ($count != count($columns)) {
                $result[$table] = array("status" => "error", "msg" => __("Some columns are missing.", "gd-bbpress-toolbox"));
            } else {
                $result[$table] = array("status" => "ok");
            }
        } else {
            $result[$table] = array("status" => "error", "msg" => __("Table missing.", "gd-bbpress-toolbox"));
        }
    }

    return $result;
}

function gdbbx_convert_forum_settings() {
    global $wpdb;

    $sql = "select * from ".$wpdb->postmeta." where meta_key in ('_gdbbatt_settings', '_gdbbx_privacy_settings') order by post_id";
    $raw = $wpdb->get_results($sql);

    $result = array('forums' => 0);
    $posts = array();

    foreach ($raw as $row) {
        $posts[$row->post_id][$row->meta_key] = maybe_unserialize($row->meta_value);
    }

    foreach ($posts as $post_id => $data) {
        $settings = gdbbx_default_forum_settings();

        foreach ($data as $meta_key => $obj) {
            if (is_array($obj) && !empty($obj)) {
                if ($meta_key == '_gdbbx_privacy_settings') {
                    if ($obj['disable_topic_private'] == 1) {
                        $settings['privacy_enable_topic_private'] = 'no';
                    }

                    if ($obj['disable_reply_private'] == 1) {
                        $settings['privacy_enable_reply_private'] = 'no';
                    }
                }

                if ($meta_key == '_gdbbatt_settings') {
                    if ($obj['disable'] == 1) {
                        $settings['attachments_status'] = 'no';
                    }

                    if ($obj['to_override'] == 1) {
                        $settings['attachments_max_file_size_override'] = 'yes';
                        $settings['attachments_max_to_upload_override'] = 'yes';
                        $settings['attachments_hide_from_visitors'] = $obj['hide_from_visitors'] == 1 ? 'yes' : 'no';

                        $settings['attachments_max_file_size'] = $obj['max_file_size'];
                        $settings['attachments_max_to_upload'] = $obj['max_to_upload'];
                    }
                }
            }
        }

        update_post_meta($post_id, '_gdbbx_settings', $settings);
        delete_post_meta($post_id, '_gdbbatt_settings');
        delete_post_meta($post_id, '_gdbbx_privacy_settings');

        $result['forums']++;
    }

    return $result;
}
