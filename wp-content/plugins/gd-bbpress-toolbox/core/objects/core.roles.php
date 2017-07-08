<?php

if (!defined('ABSPATH')) exit;

class gdbbx_core_roles {
    public $cap = 'activate_plugins';

    public function __construct() {
        add_filter('init', array($this, 'init_capabilities'));
        add_filter('bbp_get_caps_for_role', array($this, 'get_caps_for_role'), 10, 2);
        add_action('gdbbx_plugin_settings_loaded', array($this, 'settings_loaded'));
    }

    public function get_caps_for_role($caps, $role) {
        if ($role == bbp_get_keymaster_role()) {
            $caps['gdbbx_standard'] = true;
        }

        switch ($role) {
            case bbp_get_keymaster_role():
            case bbp_get_moderator_role():
                $caps['gdbbx_moderation'] = true;
                $caps['gdbbx_moderation_users'] = true;
                $caps['gdbbx_moderation_report'] = true;
                $caps['gdbbx_moderation_attachments'] = true;
                break;
        }

        return $caps;
    }

    public function settings_loaded() {
        if (gdbbx()->get('participant_media_library_upload', 'bbpress')) {
            add_action('bbp_after_setup_theme', array($this, 'dynamic_roles_media_upload'));
            add_filter('user_has_cap', array($this, 'user_has_cap_media_upload'), 10, 4);
        }
    }

    public function dynamic_roles_media_upload() {
        $_use_db = wp_roles()->use_db;
        wp_roles()->use_db = false;

        $moderator = get_role(bbp_get_moderator_role());
        $moderator->add_cap('upload_files');

        $participant = get_role(bbp_get_participant_role());
        $participant->add_cap('upload_files');

        wp_roles()->use_db = $_use_db;
    }

    public function user_has_cap_media_upload($allcaps, $caps, $args, $user) {
        if (defined('D4P_ASYNC_UPLOAD') && D4P_ASYNC_UPLOAD) {
            if ($caps[0] == 'edit_others_forums' && $args[0] == 'edit_post') {
                if ($user->has_cap(bbp_get_participant_role()) || $user->has_cap(bbp_get_moderator_role())) {
                    $allcaps['edit_others_forums'] = true;
                }
            }
        }

        return $allcaps;
    }

    public function init_capabilities() {
        $role = get_role('administrator');

        if (!is_null($role)) {
            $role->add_cap('gdbbx_standard');
            $role->add_cap('gdbbx_moderation');
            $role->add_cap('gdbbx_moderation_users');
            $role->add_cap('gdbbx_moderation_report');
            $role->add_cap('gdbbx_moderation_attachments');
        }

        define('GDBBX_CAP', $this->cap);
    }
}
