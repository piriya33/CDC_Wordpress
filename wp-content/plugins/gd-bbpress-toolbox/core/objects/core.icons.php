<?php

if (!defined('ABSPATH')) exit;

class gdbbx_core_icons {
    public $mode = '';

    public function __construct() {
        $this->mode = gdbbx()->get('icons_mode', 'attachments');
    }

    public function new_replies() {
        $render = '';

        if (gdbbx()->get('icons_mode', 'attachments') == 'images') {
            $render = '<span class="bbp-image-mark bbp-image-arrow" title="'.__("First new reply", "gd-bbpress-toolbox").'"></span>';
        } else if (gdbbx()->get('icons_mode', 'attachments') == 'font') {
            $render = '<i class="bbp-icon-mark fa fa-chevron-circle-right" title="'.__("First new reply", "gd-bbpress-toolbox").'"></i> ';
        }

        return apply_filters('gdbbx_icon_for_new_replies', $render, $this->mode);
    }

    public function private_topic() {
        $render = '';

        if (gdbbx()->get('icons_mode', 'attachments') == 'images') {
            $render = '<span class="bbp-image-mark bbp-image-private" title="'.__("Private Topic", "gd-bbpress-toolbox").'"></span>';
        } else if (gdbbx()->get('icons_mode', 'attachments') == 'font') {
            $render = '<i class="bbp-icon-mark fa fa-eye-slash" title="'.__("Private Topic", "gd-bbpress-toolbox").'"></i> ';
        }

        return apply_filters('gdbbx_icon_for_private_topic', $render, $this->mode);
    }

    public function replied_to_topic() {
        $render = '';

        if (gdbbx()->get('icons_mode', 'attachments') == 'images') {
            $render = '<span class="bbp-image-mark bbp-image-reply" title="'.__("Replied to this topic", "gd-bbpress-toolbox").'"></span>';
        } else if (gdbbx()->get('icons_mode', 'attachments') == 'font') {
            $render = '<i class="bbp-icon-mark fa fa-comments-o" title="'.__("Replied to this topic", "gd-bbpress-toolbox").'"></i> ';
        }

        return apply_filters('gdbbx_icon_for_replied_to_topic', $render, $this->mode);
    }

    public function sticky_topic() {
        $render = '';

        if (gdbbx()->get('icons_mode', 'attachments') == 'images') {
            $render = '<span class="bbp-image-mark bbp-image-stick" title="'.__("This is sticky topic", "gd-bbpress-toolbox").'"></span>';
        } else if (gdbbx()->get('icons_mode', 'attachments') == 'font') {
            $render = '<i class="bbp-icon-mark fa fa-thumb-tack" title="'.__("This is sticky topic", "gd-bbpress-toolbox").'"></i> ';
        }

        return apply_filters('gdbbx_icon_for_sticky_topic', $render, $this->mode);
    }

    public function locked_topic() {
        $render = '';

        if (gdbbx()->get('icons_mode', 'attachments') == 'images') {
            $render = '<span class="bbp-image-mark bbp-image-lock" title="'.__("Locked Topic", "gd-bbpress-toolbox").'"></span>';
        } else if (gdbbx()->get('icons_mode', 'attachments') == 'font') {
            $render = '<i class="bbp-icon-mark fa fa-lock" title="'.__("Locked Topic", "gd-bbpress-toolbox").'"></i> ';
        }

        return apply_filters('gdbbx_icon_for_locked_topic', $render, $this->mode);
    }

    public function attachments($count) {
        $render = '';

        if (gdbbx()->get('icons_mode', 'attachments') == 'images') {
            $render = '<span class="bbp-image-mark bbp-image-paperclip" title="'.$count.' '._n("attachment", "attachments", $count, "gd-bbpress-toolbox").'"></span>';
        } else if (gdbbx()->get('icons_mode', 'attachments') == 'font') {
            $render = '<i class="bbp-icon-mark fa fa-paperclip" title="'.$count.' '._n("attachment", "attachments", $count, "gd-bbpress-toolbox").'"></i> ';
        }

        return apply_filters('gdbbx_icon_for_attachments', $render, $count, $this->mode);
    }
}

/** @return gdbbx_core_icons  */
function gdbbx_obj_icons() {
    return gdbbx_loader()->objects['icons'];
}
