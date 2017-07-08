<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Report {
    private $location = 'header';

    public function __construct() {
        $this->location = gdbbx()->get('location', 'report');

        $this->add_content_filters();

        add_filter('gdbbx_script_values', array($this, 'script_values'));
        add_action('bbp_template_after_single_topic', array($this, 'embed_form'));
        add_action('bbp_template_after_single_reply', array($this, 'embed_form'));

        if (gdbbx()->get('show_report_status', 'report')) {
            add_action('bbp_theme_after_topic_content', array($this, 'report_status'), 200);
            add_action('bbp_theme_after_reply_content', array($this, 'report_status'), 200);
        }
    }

    public function script_values($values) {
        $values['run_report'] = true;
        $values['report_alert'] = __("Report message is required.", "gd-bbpress-toolbox");
        $values['report_after'] = __("Reported", "gd-bbpress-toolbox");
        $values['report_confirm'] = __("Are you sure you want to report this post?", "gd-bbpress-toolbox");
        $values['report_scroll'] = gdbbx()->get('scroll_form', 'report');
        $values['report_mode'] = gdbbx()->get('report_mode', 'report');
        $values['report_min'] = 4;

        return $values;
    }

    public function report_status() {
        $post_id = bbp_get_reply_id();

        if ($post_id == 0) {
            $post_id = bbp_get_topic_id();
        }

        if (gdbbx_db()->reported($post_id)) {
            $message = bbp_is_topic($post_id) ? 
                    __("This topic has been reported.", "gd-bbpress-toolbox") : 
                    __("This reply has been reported.", "gd-bbpress-toolbox");

            $notice = '<div class="gdbbx-report-notice bbp-template-notice error">'.$message.'</div>';

            echo apply_filters('gdbbx_report_status_display', $notice, $message, $post_id);
        }
    }

    public function add_content_filters() {
        if ($this->location == 'header') {
            add_filter('bbp_topic_admin_links', array($this, 'report_link'), 50, 2);
            add_filter('bbp_reply_admin_links', array($this, 'report_link'), 50, 2);
        } else if ($this->location == 'footer') {
            add_filter('gdbbx_topic_footer_links', array($this, 'report_link'), 50, 2);
            add_filter('gdbbx_reply_footer_links', array($this, 'report_link'), 50, 2);
        }
    }

    public function report_link($links, $id) {
        $reported = gdbbx_db()->report_given($id, bbp_get_current_user_id());

        if (!$reported) {
            $nonce = wp_create_nonce('gdbbx-report-'.$id);
            $type = bbp_is_reply($id) ? 'reply' : 'topic';
            $post_type = bbp_is_reply($id) ? bbp_get_reply_post_type() : bbp_get_topic_post_type();

            $links['gdbbx_report'] = '<a role="button" href="#" data-nonce="'.$nonce.'" data-type="'.$type.'" data-post-type="'.$post_type.'" data-id="'.$id.'" class="d4p-bbt-report-link d4p-bbt-report-link-'.$id.'">'.__("Report", "gd-bbpress-toolbox").'</a>';
        } else {
            $links['gdbbx_report'] = '<span>'.__("Reported", "gd-bbpress-toolbox").'</span>';
        }

        return $links;
    }

    public function embed_form() {
        $path = gdbbx_get_template_part('gdbbx-form-report-post.php');
        $form = apply_filters('gdbbx_report_form_file', $path);

        include_once($form);
    }

    public function notify($user_id, $post_id, $report = '') {
        if (gdbbx()->get('notify_active', 'report')) {
            $start_content = gdbbx()->get('notify_content', 'report');
            $start_subject = gdbbx()->get('notify_subject', 'report');

            $_title = bbp_is_reply($post_id) ? bbp_get_reply_title($post_id) : bbp_get_topic_title($post_id);
            $_url = bbp_is_reply($post_id) ? bbp_get_reply_url($post_id) : get_permalink($post_id);
            $_forum = bbp_is_reply($post_id) ? bbp_get_reply_forum_id($post_id) : bbp_get_topic_forum_id($post_id);

            $tags_content = array(
                'BLOG_NAME' => wp_specialchars_decode(get_option('blogname'), ENT_QUOTES),
                'REPORT_AUTHOR' => bbp_get_user_nicename($user_id),
                'REPORT_TITLE' => wp_kses($_title, array()),
                'REPORT_LINK' => $_url,
                'REPORT_CONTENT' => $report,
                'REPORTS_LIST' => admin_url('admin.php?page=gd-bbpress-toolbox-reported-posts'),
                'FORUM_TITLE' => strip_tags(bbp_get_forum_title($_forum))
            );

            $tags_subject = array(
                'BLOG_NAME' => wp_specialchars_decode(get_option('blogname'), ENT_QUOTES),
                'REPORT_TITLE' => wp_kses($_title, array()),
            );

            if (gdbbx()->get('notify_shortcodes', 'report')) {
                $start_content = do_shortcode($start_content);
            }

            $content = d4p_replace_tags_in_content($start_content, $tags_content);
            $subject = d4p_replace_tags_in_content($start_subject, $tags_subject);

            $users = array();

            if (gdbbx()->get('notify_keymasters', 'report')) {
                $users = array_merge($users, get_users(array('role' => bbp_get_keymaster_role())));
            }

            if (gdbbx()->get('notify_moderators', 'report')) {
                $users = array_merge($users, get_users(array('role' => bbp_get_moderator_role())));
            }

            $users = apply_filters('gdrts_report_notification_emails', $users, $user_id, $post_id, $report);

            foreach ($users as $user) {
                wp_mail($user->user_email, $subject, $content);
            }
        }
    }
}

/** @return gdbbxMod_Report */
function gdbbx_module_report() {
    return gdbbx_loader()->modules['report'];
}
