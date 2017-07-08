<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Integrate {
    public $context = array(
        'topic' => array(), 
        'reply' => array()
    );

    function __construct() {
        $this->init_content_args();
        $this->init_users_stats();
        $this->init_various_tweaks();

        add_action('bbp_theme_before_topic_title', array($this, 'show_icon_marks'), 25);

        add_action('bbp_theme_after_topic_content', array($this, 'footer_topic_links'), 100);
        add_action('bbp_theme_after_reply_content', array($this, 'footer_reply_links'), 100);
    }

    public function init_content_args() {
        $this->context['topic'] = gdbbx()->prefix_get('editor_topic_', 'tools');
        $this->context['reply'] = gdbbx()->prefix_get('editor_reply_', 'tools');

        if ($this->context['topic']['active'] || $this->context['reply']['active']) {
            add_filter('bbp_after_get_the_content_parse_args', array($this, 'control'));
        }

        if (gdbbx()->get('forum_list_topic_thumbnail', 'bbpress')) {
            add_action('bbp_theme_before_topic_title', array($this, 'show_thumbnail'));
        }
    }

    public function init_users_stats() {
        if (gdbbx()->get('users_stats_active', 'tools') && gdbbx()->allowed('users_stats', 'tools', true)) {
            add_action('bbp_theme_after_topic_author_details', array($this, 'user_stats'));
            add_action('bbp_theme_after_reply_author_details', array($this, 'user_stats'));
        }
    }

    public function init_various_tweaks() {
        if (gdbbx()->get('enable_lead_topic', 'bbpress')) {
            add_filter('bbp_show_lead_topic', '__return_true', 10000);
        }

        if (gdbbx()->get('disable_bbpress_breadcrumbs', 'bbpress')) {
            add_filter('bbp_no_breadcrumb', '__return_true');
        }

        if (gdbbx()->get('enable_topic_reversed_replies', 'bbpress')) {
            add_filter('bbp_before_has_replies_parse_args', array($this, 'change_replies_order'));
        }
    }

    public function welcome_index() {
        include(gdbbx_get_template_part('gdbbx-forums-welcome.php'));
    }

    public function forum_index() {
        include(gdbbx_get_template_part('gdbbx-forums-statistics.php'));
    }

    public function get_thumbnail() {
        $topic = bbp_get_topic_id();

        $thumb_size = apply_filters('gdbbx_topic_thumbnail_size', 'thumbnail', $topic);

        $img = d4p_get_thumbnail_url($topic, $thumb_size);

        if ($img == '') {
            $post = get_post();

            $matches = array();
            $match = array();

            if (preg_match_all("/<img(.+?)>/", $post->post_content, $matches)) {
                foreach ($matches[1] as $image) {
                    if (preg_match('/src=(["\'])(.*?)\1/', $image, $match)) {
                        return $match[2];
                    }
                }
            }

            return '';
        }

        return $img;
    }

    public function show_thumbnail() {
        $img = $this->get_thumbnail();

        if ($img != '') {
            echo '<div class="gdbbx-topic-thumbnail"><a href="'.bbp_get_topic_permalink().'"><img src="'.$img.'" alt="'.bbp_get_topic_title().'" /></a></div>';
        }
    }

    public function footer_topic_links() {
        $links = gdbbx_get_topic_footer_links();

        if ($links != '') {
            echo '<div class="gdbbx-footer-meta">';
            echo $links;
            echo '</div>';
        }
    }

    public function footer_reply_links() {
        $links = gdbbx_get_reply_footer_links();

        if ($links != '') {
            echo '<div class="gdbbx-footer-meta">';
            echo $links;
            echo '</div>';
        }
    }

    public function change_replies_order($r) {
        $r['order'] = 'DESC';

        return $r;
    }

    public function control($args) {
        $context = $args['context'];

        if (isset($this->context[$context]) && $this->context[$context]['active']) {
            foreach ($this->context[$context] as $key => $val) {
                if ($key != 'active') {
                    $args[$key] = $val;
                }
            }
        }

        return $args;
    }

    public function user_stats() {
        if (bbp_is_reply_anonymous()) {
            return;
        }

        gdbbx_enqueue_files_force();

        $author = bbp_get_reply_author_id();

        $list = array();

        if (gdbbx()->get('users_stats_show_registration_date', 'tools')) {
            $user = get_user_by('id', $author);
            $date = $user->user_registered;
            $format = apply_filters('gdbbx_user_stats_registered_date_format', get_option('date_format'));

            $item = apply_filters('gdbbx_user_stats_registered_on', 
                    '<span class="bbp-label">'.__("Registered On", "gd-bbpress-toolbox").':</span> <span class="bbp-value">'.mysql2date($format, $date).'</span>', $date, $format);

            $list['registered'] = $item;
        }

        if (gdbbx()->get('users_stats_show_topics', 'tools')) {
            $topics = bbp_get_user_topic_count_raw($author);

            $item = apply_filters('gdbbx_user_stats_topics_count', 
                    '<span class="bbp-label">'.__("Topics", "gd-bbpress-toolbox").':</span> <span class="bbp-value">'.$topics.'</span>', $topics);

            $list['topics'] = $item;
        }

        if (gdbbx()->get('users_stats_show_replies', 'tools')) {
            $replies = bbp_get_user_reply_count_raw($author);

            $item = apply_filters('gdbbx_user_stats_replies_count', 
                    '<span class="bbp-label">'.__("Replies", "gd-bbpress-toolbox").':</span> <span class="bbp-value">'.$replies.'</span>', $replies);

            $list['replies'] = $item;
        }

        if (gdbbx()->get('users_stats_show_thanks_given', 'tools')) {
            $thanks_given = gdbbx_db()->count_all_thanks_given($author);

            $item = apply_filters('gdbbx_user_stats_thanks_given_count', 
                    '<span class="bbp-label">'.__("Has thanked", "gd-bbpress-toolbox").':</span> <span class="bbp-value">'.$thanks_given.' '._n("time", "times", $thanks_given, "gd-bbpress-toolbox").'</span>', $thanks_given);

            $list['thanks_given'] = $item;
        }

        if (gdbbx()->get('users_stats_show_thanks_received', 'tools')) {
            $thanks_received = gdbbx_db()->count_all_thanks_received($author);

            $item = apply_filters('gdbbx_user_stats_thanks_received_count', 
                    '<span class="bbp-label">'.__("Been thanked", "gd-bbpress-toolbox").':</span> <span class="bbp-value">'.$thanks_received.' '._n("time", "times", $thanks_received, "gd-bbpress-toolbox").'</span>', $thanks_received);

            $list['thanks_received'] = $item;
        }

        $list = apply_filters('gdbbx_user_stats_items', $list, $author);

        echo '<div class="bbp-user-stats">'.join("<br/>", $list).'</div>';
    }

    public function show_icon_marks() {
        $topic_id = bbp_get_topic_id();

        if (gdbbx()->get('forum_mark_lock', 'bbpress') && gdbbx_module_lock()->is_topic_temp_locked($topic_id)) {
            echo gdbbx_obj_icons()->locked_topic();
        }

        if (gdbbx()->get('forum_mark_stick', 'bbpress') && bbp_is_topic_sticky($topic_id)) {
            echo gdbbx_obj_icons()->sticky_topic();
        }

        if (gdbbx()->get('forum_mark_replied', 'bbpress') && gdbbx_check_if_user_replied_to_topic($topic_id)) {
            echo gdbbx_obj_icons()->replied_to_topic();
        }
    }
}
