<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Quote {
    private $allowed = null;

    private $location = 'header';
    private $method = 'quote';

    function __construct() {
        $this->location = gdbbx()->get('quote_location', 'tools');
        $this->method = gdbbx()->get('quote_method', 'tools');

        $this->add_content_filters();

        add_filter('gdbbx_script_values', array($this, 'script_values'));
    }

    public function script_values($values) {
        $values['quote_method'] = $this->method;
        $values['quote_wrote'] = __("wrote", "gd-bbpress-toolbox");

        return $values;
    }

    public function check_if_allowed() {
        if (is_null($this->allowed)) {
            $this->allowed = bbp_current_user_can_access_create_reply_form();
        }

        return $this->allowed;
    }

    private function _quote($id) {
        $is_reply = bbp_is_reply($id);

        $allowed = false;

        if ($is_reply) {
            $allowed = gdbbx_is_user_allowed_to_reply($id);
        } else {
            $allowed = gdbbx_is_user_allowed_to_topic($id);
        }

        if ($allowed) {
            if (gdbbx()->get('quote_method', 'tools') == 'html') {
                $url = ''; 
                $ath = '';

                if ($is_reply) {
                    $url = bbp_get_reply_permalink($id);
                    $ath = bbp_get_reply_author_display_name($id);
                } else {
                    $url = bbp_get_topic_permalink($id);
                    $ath = bbp_get_topic_author_display_name($id);
                }

                return '<a role="button" href="#" data-id="'.$id.'" data-url="'.$url.'" data-author="'.$ath.'" class="d4p-bbt-quote-link">'.__("Quote", "gd-bbpress-toolbox").'</a>';
            } else {
                return '<a role="button" href="#" data-id="'.$id.'" class="d4p-bbt-quote-link">'.__("Quote", "gd-bbpress-toolbox").'</a>';
            }
        } else {
            return false;
        }
    }

    public function add_content_filters() {
        add_filter('bbp_get_reply_content', array($this, 'quote_reply_content'), 90);
        add_filter('bbp_get_topic_content', array($this, 'quote_topic_content'), 90);

        if ($this->location == 'header' || $this->location == 'both') {
            add_filter('bbp_topic_admin_links', array($this, 'quote_link'), 40, 2);
            add_filter('bbp_reply_admin_links', array($this, 'quote_link'), 40, 2);
        }

        if ($this->location == 'footer' || $this->location == 'content') {
            add_filter('gdbbx_topic_footer_links', array($this, 'quote_link'), 40, 2);
            add_filter('gdbbx_reply_footer_links', array($this, 'quote_link'), 40, 2);
        }
    }

    public function quote_link($links, $id) {
        if ($this->check_if_allowed()) {
            $_link = $this->_quote($id);

            if ($_link !== false) {
                $links['gdbbx_quote'] = $_link;
            }
        }

        return $links;
    }

    public function quote_reply_content($content) {
        if (gdbbx_is_feed()) {
            return $content;
        }

        gdbbx_enqueue_files_force();

        if ($this->check_if_allowed()) {
            return '<div id="d4p-bbp-quote-'.bbp_get_reply_id().'">'.$content.'</div>';
        } else {
            return $content;
        }
    }

    public function quote_topic_content($content) {
        gdbbx_enqueue_files_force();

        if ($this->check_if_allowed()) {
            return '<div id="d4p-bbp-quote-'.bbp_get_topic_id().'">'.$content.'</div>';
        } else {
            return $content;
        }
    }
}
