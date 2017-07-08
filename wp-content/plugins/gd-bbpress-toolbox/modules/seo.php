<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_SEO {
    public $id = 0;

    public $forum = false;
    public $topic = false;
    public $reply = false;
    public $topic_private = false;
    public $reply_private = false;

    function __construct() {
        add_action('bbp_head', array($this, 'head'));

        if (gdbbx()->get('override_forum_title_replace', 'seo')) {
            add_filter('bbp_before_title_parse_args', array($this, 'title_forum'));
        }

        if (gdbbx()->get('override_topic_title_replace', 'seo')) {
            add_filter('bbp_before_title_parse_args', array($this, 'title_topic'));
        }

        if (gdbbx()->get('override_reply_title_replace', 'seo')) {
            add_filter('bbp_before_title_parse_args', array($this, 'title_reply'));
        }

        if (gdbbx()->get('override_topic_excerpt', 'seo')) {
            add_filter('get_the_excerpt', array($this, 'excerpt_topic'), 1);
        }

        if (gdbbx()->get('override_reply_excerpt', 'seo')) {
            add_filter('get_the_excerpt', array($this, 'excerpt_reply'), 1);
        }

        if (gdbbx()->get('rich_snippet_breadcrumbs', 'seo')) {
            add_filter('bbp_breadcrumbs', array($this, 'rich_snippet_crumbs'));
            add_filter('bbp_get_breadcrumb', array($this, 'rich_snippet_trail'));
        }
    }

    public function head() {
        $post = get_post();

        if (isset($post->ID) && $post->ID > 0) {
            $this->id = $post->ID;

            if (bbp_is_forum($this->id)) {
                $this->forum = true;

                if (gdbbx()->get('meta_description_forum', 'seo')) {
                    $this->meta_description();
                }
            }

            if (bbp_is_topic($this->id)) {
                $this->topic = true;
                $this->topic_private = gdbbx_is_topic_private();

                if (gdbbx()->get('meta_description_topic', 'seo')) {
                    $this->meta_description();
                }

                if ($this->topic_private && gdbbx()->get('noindex_private_topic', 'seo')) {
                    wp_no_robots();
                }
            }

            if (bbp_is_reply($this->id)) {
                $this->reply = true;
                $this->reply_private = gdbbx_is_reply_private();

                if (gdbbx()->get('meta_description_reply', 'seo')) {
                    $this->meta_description();
                }

                if ($this->reply_private && gdbbx()->get('noindex_private_reply', 'seo')) {
                    wp_no_robots();
                }
            }
        }

        if (apply_filters('gdbbx_plugin_meta_generator', true)) {
            echo '<meta name="generator" content="GD bbPress Toolbox Pro '.gdbbx()->info_version.', Build '.gdbbx()->info_build.'" />'.D4P_EOL;
        }
    }

    public function title_forum($title) {
        if (bbp_is_single_forum() && !bbp_is_forum_edit()) {
            $title = array('text' => d4p_replace_tags_in_content(gdbbx()->get('override_forum_title_text', 'seo'), array(
                'FORUM_TITLE' => bbp_get_forum_title()
            )), 'format' => '%s');
        }

        return $title;
    }

    public function title_topic($title) {
        if (bbp_is_single_topic() && !bbp_is_topic_edit()) {
            $title = array('text' => d4p_replace_tags_in_content(gdbbx()->get('override_topic_title_text', 'seo'), array(
                'TOPIC_TITLE' => bbp_get_topic_title(),
                'FORUM_TITLE' => bbp_get_forum_title()
            )), 'format' => '%s');
        }

        return $title;
    }

    public function title_reply($title) {
        if (bbp_is_single_reply() && !bbp_is_reply_edit()) {
            $title = array('text' => d4p_replace_tags_in_content(gdbbx()->get('override_reply_title_text', 'seo'), array(
                'REPLY_TITLE' => bbp_get_reply_title(),
                'TOPIC_TITLE' => bbp_get_topic_title(),
                'FORUM_TITLE' => bbp_get_forum_title()
            )), 'format' => '%s');
        }

        return $title;
    }

    public function excerpt_topic($excerpt) {
        $post = get_post();

        if ($excerpt == '' && isset($post->post_type) && $post->post_type == bbp_get_topic_post_type()) {
            gdbbx_signature_display_disable();
            gdbbx_attachments_display_disable();

            if (gdbbx_is_topic_private($post->ID) && gdbbx()->get('private_topic_excerpt_replace', 'seo')) {
                $excerpt = d4p_replace_tags_in_content(gdbbx()->get('private_topic_excerpt_text', 'seo'), array(
                    'TOPIC_TITLE' => bbp_get_topic_title($post->ID)
                ));
            } else {
                $excerpt = bbp_get_topic_excerpt(0, gdbbx()->get('override_topic_length', 'seo'));
            }

            gdbbx_attachments_display_enable();
            gdbbx_signature_display_enable();
        }

        return $excerpt;
    }

    public function excerpt_reply($excerpt) {
        $post = get_post();

        if ($excerpt == '' && isset($post->post_type) && $post->post_type == bbp_get_reply_post_type()) {
            gdbbx_signature_display_disable();
            gdbbx_attachments_display_disable();

            if (gdbbx_is_reply_private($post->ID) && gdbbx()->get('private_reply_excerpt_replace', 'seo')) {
                $excerpt = d4p_replace_tags_in_content(gdbbx()->get('private_reply_excerpt_text', 'seo'), array(
                    'TOPIC_TITLE' => bbp_get_topic_title($post->ID)
                ));
            } else {
                $excerpt = bbp_get_reply_excerpt(0, gdbbx()->get('override_reply_length', 'seo'));
            }

            gdbbx_attachments_display_enable();
            gdbbx_signature_display_enable();
        }

        return $excerpt;
    }

    public function meta_description() {
        $excerpt = get_the_excerpt();
        $excerpt = str_replace(array("\r", "\n", "  "), ' ', $excerpt);
        $excerpt = str_replace(array("&hellip;", "&#8230;"), '', $excerpt);
        $excerpt = d4p_text_length_limit(trim($excerpt), 150);

        echo '<meta name="description" content="'.$excerpt.'">'.D4P_EOL;
    }

    public function rich_snippet_crumbs($crumbs) {
        for ($i = 0; $i < count($crumbs); $i++) {
            if (strpos($crumbs[$i], '<a') > -1) {
                $crumbs[$i] = '<span typeof="v:Breadcrumb">'.
                              str_replace('<a', '<a rel="v:url" property="v:title"', $crumbs[$i]).
                              '</span>';
            }
        }

        return $crumbs;
    }

    public function rich_snippet_trail($trail) {
        return str_replace('<div', '<div xmlns:v="http://rdf.data-vocabulary.org/#"', $trail);
    }
}
