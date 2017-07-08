<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_bbPress {
    function __construct() {
        add_action('gdbbx_template', array($this, 'loader'));

        if (gdbbx()->get('reply_titles', 'bbpress')) {
            add_action('bbp_theme_before_reply_form_content', array($this, 'reply_titles_form_field'));
            add_action('bbp_theme_before_reply_content', array($this, 'reply_titles_print_title'));
        }

        if (gdbbx()->get('revisions_reply_protection_active', 'bbpress')) {
            remove_filter('bbp_get_topic_content', 'bbp_topic_content_append_revisions', 99, 2);
            remove_filter('bbp_get_reply_content', 'bbp_reply_content_append_revisions', 99, 2);

            add_filter('bbp_get_topic_content', array($this, 'reply_content_append_revisions'), 99, 2);
            add_filter('bbp_get_reply_content', array($this, 'reply_content_append_revisions'), 99, 2);
        }

        if (gdbbx()->get('title_length_value', 'bbpress')) {
            add_filter('bbp_get_title_max_length', array($this, 'custom_title_length'));
        }

        if (gdbbx()->get('reply_close_topic_checkbox_active', 'bbpress')) {
            if (gdbbx()->allowed('reply_close_topic_checkbox', 'bbpress')) {
                add_action(gdbbx()->get('reply_close_topic_checkbox_form_position', 'bbpress'), array($this, 'close_topic_checkbox'), 9);

                add_action('bbp_new_reply',  array($this, 'close_topic_save'), 1, 2);
                add_action('bbp_edit_reply',  array($this, 'close_topic_save'), 1, 2);
            }
        }

        $custom_mime_types = gdbbx()->get('extra_mime_types', 'tools');
        if (!empty($custom_mime_types)) {
            add_filter('upload_mimes', array($this, 'upload_mimes'));
        }

        if (gdbbx()->get('new_topic_minmax_active', 'bbpress')) {
            add_filter('bbp_new_topic_pre_title', array($this, 'new_topic_title'));
            add_filter('bbp_new_topic_pre_content', array($this, 'new_topic_content'));
        }

        if (gdbbx()->get('new_reply_minmax_active', 'bbpress')) {
            add_filter('bbp_new_reply_pre_title', array($this, 'new_reply_title'));
            add_filter('bbp_new_reply_pre_content', array($this, 'new_reply_content'));
        }

        add_filter('bbp_get_template_stack', array($this, 'add_plugin_stack'));

        add_filter('bbp_kses_allowed_tags', array($this, 'allowed_tags'), 10000);

        if (gdbbx()->get('tags_in_reply_form_only_for_author', 'bbpress')) {
            add_action('bbp_theme_before_reply_form', array($this, 'theme_before_reply_form'));
        }

        $this->filters();
    }

    public function loader() {
        add_filter('bbp_topic_admin_links', array($this, 'topic_admin_links'));
        add_filter('bbp_reply_admin_links', array($this, 'reply_admin_links'));

        add_filter('gdbbx_topic_footer_links', array($this, 'topic_footer_links'), 10, 2);
        add_filter('gdbbx_reply_footer_links', array($this, 'reply_footer_links'), 10, 2);

        if (gdbbx_current_user_can_moderate() && gdbbx()->get('topic_single_copy_active', 'bbpress')) {
            add_action('bbp_get_request_dupe_topic', array($this, 'process_duplicate_topic'));

            if (gdbbx()->get('topic_single_copy_location', 'bbpress') == 'header') {
                add_filter('bbp_topic_admin_links', array($this, 'duplicate_topic_link'), 20, 2);
            }

            if (gdbbx()->get('topic_single_copy_location', 'bbpress') == 'footer') {
                add_filter('gdbbx_topic_footer_links', array($this, 'duplicate_topic_link'), 20, 2);
            }
        }
    }

    public function theme_before_reply_form() {
        $topic_id = bbp_get_topic_id();

        if (get_current_user_id() != bbp_get_topic_author_id($topic_id)) {
            add_filter('bbp_allow_topic_tags', '__return_false', 10000);
        }
    }

    public function process_duplicate_topic() {
        $post_id = intval($_GET['id']);

        if (!gdbbx_current_user_can_moderate()) {
            bbp_add_error('bgdbx_lock_not_moderator', __("<strong>ERROR</strong>: You can't duplicate topics.", "gd-bbpress-toolbox"));
        }

        if (!bbp_verify_nonce_request('gdbbx_dupe_topic_'.$post_id)) {
            bbp_add_error('bgdbx_lock_nonce', __("<strong>ERROR</strong>: Are you sure you wanted to do that?", "gd-bbpress-toolbox"));
        }

        if (bbp_has_errors()) {
            return;
        }

        require_once(GDBBX_PATH.'core/objects/core.duplicate.php');

        $dupe = new gdbbx_core_duplicate();
        $id = $dupe->duplicate_topic($post_id);

        wp_redirect(get_permalink($id));
        exit;
    }

    public function duplicate_topic_link($links, $id) {
        $url = bbp_get_topic_permalink($id);
        $url = add_query_arg('id', $id, $url);
        $url = add_query_arg('_wpnonce', wp_create_nonce('gdbbx_dupe_topic_'.$id), $url);
        $url = add_query_arg('action', 'dupe_topic', $url);

        $links['gdbbx_dupe_topic'] = '<a href="'.$url.'" class="d4p-bbt-dupe-topic-link">'.__("Duplicate Topic", "gd-bbpress-toolbox").'</a>';

        return $links;
    }

    public function filters() {
        if (!gdbbx()->get('nofollow_topic_content', 'bbpress')) {
            remove_filter('bbp_get_topic_content', 'bbp_rel_nofollow', 50);
        }

        if (!gdbbx()->get('nofollow_reply_content', 'bbpress')) {
            remove_filter('bbp_get_reply_content', 'bbp_rel_nofollow', 50);
        }

        if (!gdbbx()->get('nofollow_topic_author', 'bbpress')) {
            remove_filter('bbp_get_topic_author_link', 'bbp_rel_nofollow');
        }

        if (!gdbbx()->get('nofollow_reply_author', 'bbpress')) {
            remove_filter('bbp_get_reply_author_link', 'bbp_rel_nofollow');
        }

        if (gdbbx()->get('disable_make_clickable_topic', 'bbpress')) {
            add_filter('bbp_get_topic_content', 'bbp_make_clickable', 4);
        }

        if (gdbbx()->get('disable_make_clickable_reply', 'bbpress')) {
            add_filter('bbp_get_reply_content', 'bbp_make_clickable', 4);
        }

        if (gdbbx()->get('disable_mention_filter_topic', 'bbpress')) {
            add_filter('bbp_get_topic_content', 'bbp_mention_filter', 5);
        }

        if (gdbbx()->get('disable_mention_filter_reply', 'bbpress')) {
            add_filter('bbp_get_reply_content', 'bbp_mention_filter', 5);
        }
    }

    public function new_topic_title($title) {
        $length = strlen($title);

        $check = gdbbx()->prefix_get('new_topic_', 'bbpress');

        if ($check['min_title_length'] > 0) {
            if ($length < $check['min_title_length']) {
                bbp_add_error('bbp_topic_title', __("<strong>ERROR</strong>: Your topic title is too short.", "gd-bbpress-toolbox"));
            }
        }

        if ($check['max_title_length'] > 0) {
            if ($length > $check['max_title_length']) {
                bbp_add_error('bbp_topic_title', __("<strong>ERROR</strong>: Your topic title is too long.", "gd-bbpress-toolbox"));
            }
        }

        return $title;
    }

    public function new_topic_content($content) {
        $length = strlen($content);

        $check = gdbbx()->prefix_get('new_topic_', 'bbpress');

        if ($check['min_content_length'] > 0) {
            if ($length < $check['min_content_length']) {
                bbp_add_error('bbp_topic_content', __("<strong>ERROR</strong>: Your topic is too short.", "gd-bbpress-toolbox"));
            }
        }

        if ($check['max_content_length'] > 0) {
            if ($length > $check['max_content_length']) {
                bbp_add_error('bbp_topic_content', __("<strong>ERROR</strong>: Your topic is too long.", "gd-bbpress-toolbox"));
            }
        }

        return $content;
    }

    public function new_reply_title($title) {
        $length = strlen($title);

        $check = gdbbx()->prefix_get('new_reply_', 'bbpress');

        if ($check['min_title_length'] > 0) {
            if ($length < $check['min_title_length']) {
                bbp_add_error('bbp_reply_title', __("<strong>ERROR</strong>: Your reply title is too short.", "gd-bbpress-toolbox"));
            }
        }

        if ($check['max_title_length'] > 0) {
            if ($length > $check['max_title_length']) {
                bbp_add_error('bbp_reply_title', __("<strong>ERROR</strong>: Your reply title is too long.", "gd-bbpress-toolbox"));
            }
        }

        return $title;
    }

    public function new_reply_content($content) {
        $length = strlen($content);

        $check = gdbbx()->prefix_get('new_reply_', 'bbpress');

        if ($check['min_content_length'] > 0) {
            if ($length < $check['min_content_length']) {
                bbp_add_error('bbp_reply_content', __("<strong>ERROR</strong>: Your reply is too short.", "gd-bbpress-toolbox"));
            }
        }

        if ($check['max_content_length'] > 0) {
            if ($length > $check['max_content_length']) {
                bbp_add_error('bbp_reply_content', __("<strong>ERROR</strong>: Your reply is too long.", "gd-bbpress-toolbox"));
            }
        }

        return $content;
    }

    public function close_topic_checkbox() {
        ?>

        <p>
            <input name="gdbbx_close_topic" id="gdbbx_close_topic" type="checkbox" value="close" tabindex="<?php bbp_tab_index(); ?>" /> 
            <label for="gdbbx_close_topic"><?php _e("Close this topic", "gd-bbpress-toolbox"); ?></label>
        </p>

        <?php 
    }

    public function close_topic_save($reply_id = 0, $topic_id = 0) {
        if (isset($_POST['gdbbx_close_topic']) && $_POST['gdbbx_close_topic'] == 'close') {
            bbp_close_topic($topic_id);
        }
    }

    public function topic_admin_links($links) {
        if (gdbbx()->get('topic_links_remove_merge', 'bbpress')) {
            if (isset($links['merge'])) {
                unset($links['merge']);
            }
        }

        if (gdbbx()->get('topic_links_edit_footer', 'bbpress')) {
            if (isset($links['edit'])) {
                unset($links['edit']);
            }
        }

        if (gdbbx()->get('topic_links_reply_footer', 'bbpress')) {
            if (isset($links['reply'])) {
                unset($links['reply']);
            }
        }

        return $links;
    }

    public function reply_admin_links($links) {
        if (gdbbx()->get('reply_links_remove_split', 'bbpress')) {
            if (isset($links['split'])) {
                unset($links['split']);
            }
        }

        if (gdbbx()->get('reply_links_edit_footer', 'bbpress')) {
            if (isset($links['edit'])) {
                unset($links['edit']);
            }
        }

        if (gdbbx()->get('reply_links_reply_footer', 'bbpress')) {
            if (isset($links['reply'])) {
                unset($links['reply']);
            }
        }

        return $links;
    }

    public function topic_footer_links($links, $id) {
        if (gdbbx()->get('topic_links_edit_footer', 'bbpress')) {
            $edit = bbp_get_topic_edit_link(array('id' => $id));

            if (!empty($edit)) {
                $links['edit'] = $edit;
            }
        }

        if (gdbbx()->get('topic_links_reply_footer', 'bbpress')) {
            $reply = bbp_get_topic_reply_link(array('id' => $id));

            if (!empty($reply)) {
                $links['reply'] = $reply;
            }
        }

        return $links;
    }

    public function reply_footer_links($links, $id) {
        if (gdbbx()->get('reply_links_edit_footer', 'bbpress')) {
            $edit = bbp_get_reply_edit_link(array('id' => $id));

            if (!empty($edit)) {
                $links['edit'] = $edit;
            }
        }

        if (gdbbx()->get('reply_links_reply_footer', 'bbpress')) {
            $reply = bbp_get_reply_to_link(array('id' => $id));

            if (!empty($reply)) {
                $links['reply'] = $reply;
            }
        }

        return $links;
    }

    public function reply_content_append_revisions($content = '', $id = 0) {
        $is_topic = bbp_is_topic($id);
        $is_reply = bbp_is_reply($id);

        $author = $is_topic ? bbp_get_topic_author_id($id) : bbp_get_reply_author_id($id);
        $author_topic = $is_reply ? bbp_get_topic_author_id(bbp_get_reply_topic_id($id)) : $author;

        $user = bbp_get_current_user_id();

        $allowed = false;
        if ($user == $author && gdbbx()->get('revisions_reply_protection_author', 'bbpress')) {
            $allowed = true;
        }

        if (!$allowed && $is_reply && $user == $author_topic && gdbbx()->get('revisions_reply_protection_topic_author', 'bbpress')) {
            $allowed = true;
        }

        if (!$allowed) {
            $allowed = gdbbx()->allowed('revisions_reply_protection', 'bbpress', true);
        }

        if ($allowed) {
            if ($is_topic) {
                $content = apply_filters('bbp_topic_append_revisions', $content.bbp_get_topic_revision_log($id), $content, $id);
            } else {
                $content = apply_filters('bbp_reply_append_revisions', $content.bbp_get_reply_revision_log($id), $content, $id);
            }
        }

        return $content;
    }

    public function custom_title_length($value) {
        $custom = (int)gdbbx()->get('title_length_value', 'bbpress');

        if ($custom > 0) {
            $value = $custom;
        }

        return $value;
    }
    
    public function reply_titles_print_title() {
        remove_filter('the_title', 'bbp_get_reply_title_fallback', 2, 2);

        $topic_title = bbp_get_reply_title();

        add_filter('the_title', 'bbp_get_reply_title_fallback', 2, 2);

	if ($topic_title && $topic_title !== bbp_get_topic_title()) {
            echo '<h4 class="bbp-reply-title">'.$topic_title.'</h4>';
	}
    }

    public function reply_titles_form_field() {
        ?>

        <p>
            <label for="bbp_reply_title"><?php printf(__("Reply Title (Maximum Length: %d):", "gd-bbpress-toolbox"), bbp_get_title_max_length()); ?></label><br />
            <input type="text" id="bbp_topic_title" value="<?php bbp_form_reply_title(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_reply_title" maxlength="<?php bbp_title_max_length(); ?>" />
        </p>

        <?php
    }

    public function upload_mimes($mimes) {
        $custom = gdbbx()->get('extra_mime_types', 'tools');

        return array_merge($mimes, $custom);
    }

    public function allowed_tags($list) {
        $tags = gdbbx()->get('kses_allowed_override', 'bbpress');

        if ($tags == 'bbpress') {
            if (gdbbx()->get('allowed_tags_div', 'bbpress')) {
                $list['div'] = array('class' => true, 'title' => true);
            }

            if (gdbbx()->get('kses_img_class', 'bbpress')) {
                $list['img']['class'] = true;
            }
        } else if ($tags == 'post') {
            $list = wp_kses_allowed_html('post');
        } else if ($tags == 'expanded') {
            $list = d4p_kses_expanded_list_of_tags();
        }

        return $list;
    }

    public function add_plugin_stack($stack) {
        $stack[] = GDBBX_PATH.'theme';

        return $stack;
    }
}
