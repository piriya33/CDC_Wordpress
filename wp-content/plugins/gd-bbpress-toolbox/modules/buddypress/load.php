<?php

if (!defined('ABSPATH')) exit;

class gdbbxMod_BuddyPress {
    public function __construct() {
        add_action('bp_init', array($this, 'init'));
        add_action('xprofile_data_after_save', array($this, 'xprofile_data_after_save'));
        add_filter('bp_xprofile_get_field_types', array($this, 'get_field_types'));

        $this->_override_urls();
    }

    public function xprofile_enabled() {
        return bp_is_active('xprofile') && gdbbx()->get('xprofile_support', 'buddypress');
    }

    public function init() {
        if ($this->xprofile_enabled() && gdbbx()->get('xprofile_signature_field_add', 'buddypress')) {
            add_action('admin_head', array($this, 'create_signature_field'));
        }
    }

    public function xprofile_data_after_save($field) {
        if ($this->xprofile_enabled() && $field->field_id == gdbbx()->get('xprofile_signature_field_id', 'buddypress')) {
            if (gdbbx_is_module_loaded('signature')) {
                $user_id = $field->user_id;
                $signature = $field->value;

                update_user_meta($user_id, 'signature', $signature);
            }
        }
    }

    public function get_field_types($types) {
        require_once(GDBBX_PATH.'modules/buddypress/signature.php');

        $types['signature_textarea'] = 'GDBBX_XProfile_Field_Type_Signature_Text_Area';

        return $types;
    }

    public function has_signature_field() {
        if (!bp_is_active('xprofile')) {
            return false;
        }

        $field_id = gdbbx()->get('xprofile_signature_field_id', 'buddypress');
        $field = xprofile_get_field($field_id);

        $missing = is_null($field) || $field->id !== $field_id;

        return !$missing;
    }

    public function create_signature_field() {
        if (!bp_is_active('xprofile')) {
            return false;
        }

        if (!$this->has_signature_field()) {
            $field_id = xprofile_insert_field(array(
                'field_group_id' => $this->first_group_id(),
                'name' => __("Forum Signature", "gd-bbpress-toolbox"),
                'is_required' => false,
                'type' => 'signature_textarea',
                'can_delete' => true
            ));

            gdbbx_settings()->set('xprofile_signature_field_id', $field_id, 'buddypress');
        }

        gdbbx_settings()->set('xprofile_signature_field_add', false, 'buddypress', true);
    }

    public function profile_groups() {
        $list = array();

        $raw = BP_XProfile_Group::get(array('fetch_fields' => false));

        foreach ($raw as $group) {
            $list[$group->id] = $group->name;
        }

        return $list;
    }

    public function first_group_id() {
        $list = $this->profile_groups();
        $groups = array_keys($list);

        return $groups[0];
    }

    private function _override_urls() {
        if (gdbbx()->get('disable_profile_override', 'buddypress')) {
            remove_filter('bbp_pre_get_user_profile_url', array(bbpress()->extend->buddypress, 'user_profile_url'));
        }

        if (gdbbx()->get('disable_favorites_override', 'buddypress')) {
            remove_filter('bbp_get_favorites_permalink', array(bbpress()->extend->buddypress, 'get_favorites_permalink'), 10, 2);
        }

        if (gdbbx()->get('disable_subscriptions_override', 'buddypress')) {
            remove_filter('bbp_get_subscriptions_permalink', array(bbpress()->extend->buddypress, 'get_subscriptions_permalink'), 10, 2);
        }
    }
}

/** @return gdbbxMod_BuddyPress */
function gdbbx_module_buddypress() {
    return gdbbx_loader()->modules['buddypress'];
}
