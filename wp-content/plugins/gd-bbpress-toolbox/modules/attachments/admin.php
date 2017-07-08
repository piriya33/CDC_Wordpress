<?php

if (!defined('ABSPATH')) exit;

class gdbbxAttachments_Admin {
    function __construct() {
        add_action('gdbbx_core', array($this, 'load'));
    }

    public function load() {
        add_action('admin_menu', array($this, 'admin_meta'));
        add_action('admin_head', array($this, 'admin_head'));

        if (gdbbx()->get('topic_columns_attachments', 'tools')) {
            add_action('manage_topic_posts_columns', array($this, 'admin_post_columns'), 1000);
            add_action('manage_topic_posts_custom_column', array($this, 'admin_columns_data'), 1000, 2);
        }

        if (gdbbx()->get('reply_columns_attachments', 'tools')) {
            add_action('manage_reply_posts_columns', array($this, 'admin_post_columns'), 1000);
            add_action('manage_reply_posts_custom_column', array($this, 'admin_columns_data'), 1000, 2);
        }
    }

    public function admin_head() { ?>
        <style type="text/css">
            /*<![CDATA[*/
            .wp-list-table.posts th.column-bbp-attachments-count, 
            .wp-list-table.posts td.column-bbp-attachments-count { width: 30px; text-align: center; }

            .wp-list-table.posts th.column-bbp-attachments-count div { font-size: 18px; }
            /*]]>*/
        </style><?php
    }

    public function admin_post_columns($columns) {
        $columns['bbp-attachments-count'] = '<div class="dashicons dashicons-admin-media" title="'.__("Attachments", "gd-bbpress-toolbox").'"></div>';

        return $columns;
    }

    public function admin_columns_data($column, $id) {
        if ($column == 'bbp-attachments-count') {
            $attachments = gdbbx_get_post_attachments($id);

            echo count($attachments);
        }
    }

    public function admin_meta() {
        if (current_user_can(GDBBX_CAP)) {
            add_meta_box('gdbbattach-meta-files', __("Attachments List", "gd-bbpress-toolbox"), array($this, 'metabox_files'), bbp_get_topic_post_type(), 'side', 'high');
            add_meta_box('gdbbattach-meta-files', __("Attachments List", "gd-bbpress-toolbox"), array($this, 'metabox_files'), bbp_get_reply_post_type(), 'side', 'high');
        }
    }

    public function metabox_files() {
        global $post_ID, $user_ID;

        $post = get_post($post_ID);
        $author_id = $post->post_author;

        include(GDBBX_PATH.'forms/meta/attachments.list.php');
    }
}
