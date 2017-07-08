<?php

if (!defined('ABSPATH')) exit;

class GDBBX_XProfile_Field_Type_Signature_Text_Area extends BP_XProfile_Field_Type {
    public function __construct() {
        parent::__construct();

        $this->category = __("GD bbPress Toolbox Pro", "gd-bbpress-toolbox");
        $this->name = __("Signature Text Area", "gd-bbpress-toolbox");
        $this->supports_richtext = true;

        $this->set_format('/^.*$/m', 'replace');

        do_action('bp_xprofile_field_type_signature', $this);
    }

    public function edit_field_html(array $raw_properties = array()) {
        ?>

        <label for="<?php bp_the_profile_field_input_name(); ?>">
            <?php bp_the_profile_field_name(); ?>
            <?php bp_the_profile_field_required_label(); ?>
        </label>

        <?php

        if (!gdbbx_is_module_loaded('signature')) {
            _e("Signatures module is disabled.", "gd-bbpress-toolbox");

            return;
        } else if (!gdbbx()->get('xprofile_support', 'buddypress')) {
            _e("This field is disabled.", "gd-bbpress-toolbox");

            return;
        }

        $user_id = isset($raw_properties['user_id']) ? absint($raw_properties['user_id']) : bp_displayed_user_id();

        if ($user_id > 0) {
            $signature = get_user_meta($user_id, 'signature', true);
        } else {
            $signature = bp_get_the_profile_field_edit_value();
        }

        $_editor = gdbbx_module_signature()->editor; ?>

        <div class="<?php echo gdbbx_signature_editor_class('gdbbx-buddypress-xprofile'); ?>">

        <?php

        do_action(bp_get_the_profile_field_errors_action());

        if ($_editor == 'textarea') {
            $r = wp_parse_args($raw_properties, array(
                'cols' => 40,
                'rows' => 5,
            ));

            gdbbx_loader()->toolbar_enqueue();

            ?>

            <textarea<?php echo gdbbx_module_signature()->textarea_data(); ?> class="<?php echo gdbbx_module_signature()->textarea_class(); ?>" <?php echo $this->get_edit_field_html_elements($r); ?>><?php echo esc_textarea($signature); ?></textarea>

            <?php

        } else if ($_editor == 'bbcodes') {
            require_once(GDBBX_PATH.'modules/bbcodes/toolbar.php');

            $toolbar = new gdbbxMod_BBCodesToolbar_Render();
            $toolbar->display();

            $r = wp_parse_args($raw_properties, array(
                'cols' => 40,
                'rows' => 5,
            ));

            ?>

            <textarea<?php echo gdbbx_module_signature()->textarea_data(); ?> class="<?php echo gdbbx_module_signature()->textarea_class(); ?>" <?php echo $this->get_edit_field_html_elements($r); ?>><?php echo esc_textarea($signature); ?></textarea>

            <?php
            
        } else if ($_editor == 'tinymce' || $_editor == 'tinymce_compact') {
            $settings = array(
                'textarea_rows' => 5,
                'teeny' => $_editor == 'tinymce_compact'
            );

            wp_editor($signature, bp_get_the_profile_field_input_name(), $settings);
        }

        ?></div><?php

    }

    public function admin_field_html(array $raw_properties = array()) {
        if (!gdbbx_is_module_loaded('signature')) {
            _e("Signatures module is disabled. If you don't use this field, remove it from the Extended Profiles.", "gd-bbpress-toolbox");

            return;
        } else if (!gdbbx()->get('xprofile_support', 'buddypress')) {
            _e("Extended Profiles support in GD bbPress Toolbox Pro is disabled. You should remove this field.", "gd-bbpress-toolbox");

            return;
        }

        $_editor = gdbbx_module_signature()->editor;

        ?><div class="<?php echo gdbbx_signature_editor_class('gdbbx-buddypress-xprofile'); ?>"><?php 

        if ($_editor == 'textarea') {
            $r = wp_parse_args($raw_properties, array(
                'cols' => 40,
                'rows' => 5,
            ));

            ?>

            <textarea <?php echo $this->get_edit_field_html_elements($r); ?>></textarea>

            <?php

        } else if ($_editor == 'bbcodes') {
            require_once(GDBBX_PATH.'modules/bbcodes/toolbar.php');

            $toolbar = new gdbbxMod_BBCodesToolbar_Render();
            $toolbar->display();

            $r = wp_parse_args($raw_properties, array(
                'cols' => 40,
                'rows' => 5,
            ));

            ?>

            <textarea <?php echo $this->get_edit_field_html_elements($r); ?>></textarea>

            <?php
            
        } else if ($_editor == 'tinymce' || $_editor == 'tinymce_compact') {
            $settings = array(
                'textarea_rows' => 5,
                'teeny' => $_editor == 'tinymce_compact'
            );

            wp_editor('', bp_get_the_profile_field_input_name(), $settings);
        }

        ?></div><?php

    }

    public function admin_new_field_html(BP_XProfile_Field $current_field, $control_type = '') {}

    public static function pre_validate_filter($field_value, $field_id = '') {
        if (!gdbbx_is_module_loaded('signature')) {
            return $field_value;
        } else {
            return gdbbx_module_signature()->format_signature($field_value);
        }
    }
}
