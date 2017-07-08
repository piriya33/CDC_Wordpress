<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Thanks {
    public $allowed = true;
    public $settings = array();

    public function __construct() {
        $this->settings = gdbbx()->group_get('thanks');
        $this->allowed = gdbbx()->allowed('allowed', 'thanks');

        add_action('bbp_theme_after_topic_content', array($this, 'thanks_display'), 40);
        add_action('bbp_theme_after_reply_content', array($this, 'thanks_display'), 40);

        add_action('bbp_get_request_thanks', array($this, 'process_thanks'));
        add_action('bbp_get_request_unthanks', array($this, 'process_thanks'));

        if ($this->settings['location'] == 'header') {
            add_filter('bbp_reply_admin_links', array($this, 'thanks_link'), 30, 2);
            add_filter('bbp_topic_admin_links', array($this, 'thanks_link'), 30, 2);
        }

        if ($this->settings['location'] == 'footer') {
            add_filter('gdbbx_topic_footer_links', array($this, 'thanks_link'), 30, 2);
            add_filter('gdbbx_reply_footer_links', array($this, 'thanks_link'), 30, 2);
        }

        add_filter('gdbbx_script_values', array($this, 'script_values'));
    }

    private function _thanks($id) {
        $is_reply = bbp_is_reply($id);
        $user_id = bbp_get_current_user_id();
        $author_id = $is_reply ? bbp_get_reply_author_id($id) : bbp_get_topic_author_id($id);
        $type = $is_reply ? 'reply' : 'topic';

        if ($author_id == $user_id) {
            return false;
        }

        if ($this->settings[$type] && $this->allowed) {
            $thanked = gdbbx_db()->thanks_given($id, $user_id);
            $nonce = wp_create_nonce('gdbbx-thanks-'.$id);

            $url = '';
            $data = array(
                'data-thanks-id="'.$id.'"',
                'data-thanks-nonce="'.$nonce.'"'
            );

            if ($is_reply) {
                $url = bbp_get_reply_url($id);
            } else {
                $url = bbp_get_topic_permalink($id);
            }

            $url = add_query_arg('id', $id, $url);
            $url = add_query_arg('_wpnonce', $nonce, $url);

            if ($thanked) {
                if ($this->settings['removal']) {
                    $url = add_query_arg('action', 'unthanks', $url);
                    $data[] = 'data-thanks-action="unthanks"';

                    return '<a role="button" '.join(' ', $data).' href="'.$url.'" class="d4p-bbt-unthanks-link">'.$this->_string('remove').'</a>';
                } else {
                    return false;
                }
            } else {
                $url = add_query_arg('action', 'thanks', $url);
                $data[] = 'data-thanks-action="thanks"';

                return '<a role="button" '.join(' ', $data).' href="'.$url.'" class="d4p-bbt-thanks-link">'.$this->_string('thanks').'</a>';
            }
        } else {
            return false;
        }
    }

    public function save_thanks($action, $post_id, $user_id) {
        if ($action == 'thanks') {
            do_action('gdbbx_user_said_thanks', $post_id, $user_id);

            gdbbx_db()->thanks_add($post_id, $user_id);

            $this->thanks_notify($post_id, $user_id);

            do_action('gdbbx_say_thanks_saved', $post_id, $user_id);
        } else if ($action == 'unthanks') {
            do_action('gdbbx_user_removed_thanks', $post_id, $user_id);

            gdbbx_db()->thanks_remove($post_id, $user_id);

            do_action('gdbbx_say_thanks_removed', $post_id, $user_id);
        }
    }

    public function process_thanks() {
        $post_id = intval($_GET['id']);
        $user_id = bbp_get_current_user_id();
        $action = $_GET['action'];

        if (!bbp_verify_nonce_request('gdbbx-thanks-'.$post_id)) {
            bbp_add_error('bgdbx_thanks_nonce', __("<strong>ERROR</strong>: Are you sure you wanted to do that?", "gd-bbpress-toolbox"));
        }

        if (bbp_has_errors()) {
            return;
        }

        $this->save_thanks($action, $post_id, $user_id);

        $url = remove_query_arg(array('_wpnonce', 'id', 'action'));

        wp_redirect($url);
        exit;
    }

    public function script_values($values) {
        $values['run_thanks'] = $this->allowed;
        $values['thanks_thanks'] = $this->_string('thanks');
        $values['thanks_unthanks'] = $this->_string('remove');
        $values['thanks_saved'] = $this->_string('saved');
        $values['thanks_removal'] = $this->settings['removal'];

        return $values;
    }

    public function thanks_link($links, $id) {
        $_link = $this->_thanks($id);

        if ($_link !== false) {
            $links['gdbbx_thanks'] = $_link;
        }

        return $links;
    }

    public function thanks_display() {
        $id = bbp_get_reply_id();

        if ($id == 0) {
            $id = bbp_get_topic_id();
        }

        $type = bbp_is_reply($id) ? 'reply' : 'topic';

        if ($this->settings[$type]) {
            $this->display($id, $type);
        }
    }

    public function thanks_notify($post_id, $user_id) {
        $active = apply_filters('gdbbx_thanks_send_user_notification', $this->settings['notify_active'], $post_id, $user_id);

        if ($active) {
            $start_content = $this->settings['notify_content'];
            $start_subject = $this->settings['notify_subject'];

            $_title = bbp_is_reply($post_id) ? bbp_get_reply_title($post_id) : bbp_get_topic_title($post_id);
            $_url = bbp_is_reply($post_id) ? bbp_get_reply_url($post_id) : get_permalink($post_id);
            $_forum = bbp_is_reply($post_id) ? bbp_get_reply_forum_id($post_id) : bbp_get_topic_forum_id($post_id);
            $_author = bbp_is_reply($post_id) ? bbp_get_reply_author_id($post_id) : bbp_get_topic_author_id($post_id);

            $tags_content = array(
                'BLOG_NAME' => wp_specialchars_decode(get_option('blogname'), ENT_QUOTES),
                'THANKS_AUTHOR' => bbp_get_user_nicename($user_id),
                'POST_TITLE' => wp_kses($_title, array()),
                'POST_LINK' => $_url,
                'FORUM_TITLE' => strip_tags(bbp_get_forum_title($_forum))
            );

            $tags_subject = $tags_content;

            if ($this->settings['notify_shortcodes']) {
                $start_content = do_shortcode($start_content);
            }

            $content = d4p_replace_tags_in_content($start_content, $tags_content);
            $subject = d4p_replace_tags_in_content($start_subject, $tags_subject);

            $user = get_user_by('id', $_author);

            if ($user) {
                wp_mail($user->user_email, $subject, $content);
            }
        }
    }

    public function display($post_id, $post_type = 'topic') {
        echo '<div class="gdbbx-thanks-wrapper gdbbx-thanks-type-'.$post_type.'" gdbbx-thanks-post-'.$post_id.'">';

        $thanks_list = gdbbx_db()->thanks_list($post_id, $this->settings['limit_display']);

        if ($thanks_list['total'] > 0) {
            include(gdbbx_get_template_part('gdbbx-thanks-list.php'));
        } else {
            include(gdbbx_get_template_part('gdbbx-thanks-none.php'));
        }

        echo '</div>';
    }

    public function display_ajax($post_id, $post_type = 'topic') {
        ob_start();

        $this->display($post_id, $post_type);

        return ob_get_clean();
    }

    private function _string($name) {
        switch ($name) {
            default:
            case 'thanks':
                return apply_filters('gdbbx_thanks_string_thanks', __("Thanks", "gd-bbpress-toolbox"));
            case 'remove':
                return apply_filters('gdbbx_thanks_string_remove', __("Remove Thanks", "gd-bbpress-toolbox"));
            case 'saved':
                return apply_filters('gdbbx_thanks_string_saved', __("Thanks Saved", "gd-bbpress-toolbox"));
        }
    }
}

/** @return gdbbxMod_Thanks  */
function gdbbx_module_thanks() {
    return gdbbx_loader()->modules['thanks'];
}
