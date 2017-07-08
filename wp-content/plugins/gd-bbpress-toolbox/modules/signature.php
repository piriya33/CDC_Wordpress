<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_Signature {
    public $enabled = false;

    public $allowed = false;
    public $edit = false;

    public $max_length;
    public $enhanced;
    public $bbcodes = false;
    public $html = false;
    public $editor = 'textarea';
    public $tinymce = false;

    function __construct() {
        $this->allowed = gdbbx()->allowed('signature', 'tools');
        $this->edit = gdbbx()->allowed('signature_edit', 'tools');

        $this->max_length = gdbbx()->get('signature_length', 'tools');

        $method = gdbbx()->get('signature_enhanced_method', 'tools');
        $this->enhanced = gdbbx()->get('signature_enhanced_active', 'tools') && gdbbx()->allowed('signature_enhanced', 'tools');

        if ($this->enhanced) {
            $this->editor = gdbbx()->get('signature_editor', 'tools');
            $this->tinymce = $this->editor == 'tinymce' || $this->editor == 'tinymce_compact';

            if ($method == 'bbcode' || $method == 'full' || $this->editor == 'bbcodes') {
                $this->bbcodes = true;
            }

            if ($method == 'html' || $method == 'full' || $this->tinymce) {
                $this->html = true;
            }
        }

        if ($this->tinymce && $this->edit) {
            add_action('gdbbx_modules_enqueue', array($this, 'tinymce_override'));
        }

        add_action('gdbbx_init', array($this, 'init'));
    }

    public function tinymce_override() {
        $load = bbp_is_user_home_edit() || bbp_is_single_user_edit() || 
                (gdbbx_loader()->buddypress && bp_is_user_profile_edit());

        if ($load) {
            gdbbx_loader()->tinymce_enqueue();
        }
    }

    public function init() {
        $this->add_content_filters();

        if ($this->allowed && $this->edit) {
            $this->attach_edit();
        }
    }

    public function attach_edit() {
        add_action('show_user_profile', array($this, 'editor_form_profile'));
        add_action('edit_user_profile', array($this, 'editor_form_profile'));
        add_action('edit_user_profile_update', array($this, 'editor_save'));
        add_action('personal_options_update', array($this, 'editor_save'));

        add_action('bbp_user_edit_after', array($this, 'editor_form_bbpress'));
        add_action('gdbbx_user_edit_signature_info', array($this, 'signature_info'));
    }

    public function add_content_filters() {
        if (!$this->enabled) {
            $this->enabled = true;

            add_filter('bbp_get_topic_content', array($this, 'reply_content'), 98, 2);
            add_filter('bbp_get_reply_content', array($this, 'reply_content'), 98, 2);
        }
    }

    public function remove_content_filters() {
        $this->enabled = false;

        remove_filter('bbp_get_topic_content', array($this, 'reply_content'), 98, 2);
        remove_filter('bbp_get_reply_content', array($this, 'reply_content'), 98, 2);
    }

    public function editor_form_profile() {
        if (!is_admin()) {
            return;
        }

        global $profileuser;

        $old_filter = $profileuser->filter;
        $profileuser->filter = 'display';

        $_signature = gdbbx_update_shorthand_bbcodes($profileuser->signature);

        $profileuser->filter = $old_filter;

        $path = GDBBX_PATH.'forms/profile/signature.php';
        $form = apply_filters('gdbbx_signature_profile_editor_file', $path);

        include_once($form);
    }

    public function editor_form_generic($user_id = 0, $form_template = '') {
        if ($user_id == 0) {
            $user_id = get_current_user_id();
        }

        if ($form_template == '') {
            $form_template = 'gdbbx-form-signature-generic.php';
        }

        $user = get_user_by('id', $user_id);

        $old_filter = $user->filter;
        $user->filter = 'display';

        $_signature = gdbbx_update_shorthand_bbcodes($user->signature);

        $user->filter = $old_filter;

        $path = gdbbx_get_template_part($form_template);
        $form = apply_filters('gdbbx_signature_generic_editor_file', $path);

        include_once($form);
    }

    public function editor_form_bbpress() {
        $_signature = gdbbx_update_shorthand_bbcodes(bbp_get_displayed_user_field('signature'));

        $path = gdbbx_get_template_part('gdbbx-form-signature-bbpress.php');
        $form = apply_filters('gdbbx_signature_bbpress_editor_file', $path);

        include_once($form);
    }

    public function signature_info() {
        $message = array();

        if (!$this->html && !$this->bbcodes) {
            $message[] = __("You can use only plain text. HTML and BBCodes will be stripped.", "gd-bbpress-toolbox");
        } else {
            if ($this->html) {
                $message[] = __("You can use HTML.", "gd-bbpress-toolbox");
            }

            if ($this->bbcodes) {
                $message[] = __("You can use BBCodes.", "gd-bbpress-toolbox");
            }

            if (!$this->html) {
                $message[] = __("HTML will be stripped.", "gd-bbpress-toolbox");
            }

            if (!$this->bbcodes) {
                $message[] = __("BBCodes will be stripped.", "gd-bbpress-toolbox");
            }
        }
        
        echo join(' ', $message);
    }

    public function format_signature($sig) {
        if (!$this->html) {
            $sig = strip_tags($sig);
        }

        if (!$this->bbcodes) {
            $sig = strip_shortcodes($sig);
        }

        if (!current_user_can('unfiltered_html')) {
            $sig = stripslashes(wp_filter_post_kses(addslashes($sig)));
        }

        if (strlen($sig) > $this->max_length) {
            $sig = substr($sig, 0, $this->max_length);
        }

        return trim($sig);
    }

    public function editor_save($user_id) {
        if (isset($_POST['signature'])) {
            $sig = $this->format_signature($_POST['signature']);

            update_user_meta($user_id, 'signature', $sig);
        }
    }

    public function reply_content($content, $reply_id = 0) {
        if (gdbbx_is_feed()) {
            return $content;
        }

        if ($reply_id == 0) {
            global $post;

            $user_id = $post->post_author;
        } else {
            $user_id = bbp_get_reply_author_id($reply_id);
        }

        $sig = gdbbx_user_signature($user_id, array('echo' => false));

        if ($sig != '') {
            $content.= $sig;
        }

        return $content;
    }

    public function textarea_class() {
        $class = 'gdbbx-signature';

        if (gdbbx()->get('signature_limiter', 'tools')) {
            $class.= ' gdbbx-limiter-enabled';
        }

        return $class;
    }

    public function textarea_data() {
        $data = '';

        if (gdbbx()->get('signature_limiter', 'tools')) {
            $limit = gdbbx()->get('signature_length', 'tools');
            $data = ' data-chars="'.$limit.'" data-warning="'.floor($limit * .9).'"';
        }

        return $data;
    }

    public function generate_editor($content) {
        if ($this->editor == 'textarea') {
            echo '<textarea'.$this->textarea_data().' class="'.$this->textarea_class().'" name="signature" id="signature" rows="5" cols="30">'.esc_attr($content).'</textarea>';

            gdbbx_loader()->toolbar_enqueue();
        } else if ($this->editor == 'bbcodes') {
            require_once(GDBBX_PATH.'modules/bbcodes/toolbar.php');

            $toolbar = new gdbbxMod_BBCodesToolbar_Render();
            $toolbar->display();

            echo '<textarea'.$this->textarea_data().' class="'.$this->textarea_class().'" name="signature" id="signature" rows="5" cols="30">'.esc_attr($content).'</textarea>';
        } else if ($this->tinymce) {
            $settings = array(
                'textarea_rows' => 5,
                'teeny' => $this->editor == 'tinymce_compact'
            );

            wp_editor($content, 'signature', $settings);
        }
    }
}

/** @return gdbbxMod_Signature  */
function gdbbx_module_signature() {
    return gdbbx_loader()->modules['signature'];
}

function gdbbx_display_signature_editor_form($user_id, $form_template = '') {
    gdbbx_module_signature()->editor_form_generic($user_id, $form_template);
}

function gdbbx_save_signature_from_post($user_id) {
    gdbbx_module_signature()->editor_save($user_id);
}
