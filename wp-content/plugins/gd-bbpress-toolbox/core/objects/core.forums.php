<?php

if (!defined('ABSPATH')) exit;

class gdbbx_core_forums {
    private $keys = array(
        'attachments_status', 
        'attachments_hide_from_visitors', 
        'attachments_max_file_size_override', 
        'attachments_max_to_upload_override', 
        'attachments_mime_types_list_override', 
        'privacy_lock_topic_form', 
        'privacy_lock_reply_form', 
        'privacy_enable_topic_private', 
        'privacy_enable_reply_private');
    private $keys_connected = array(
        'attachments_max_file_size_override' => array('attachments_max_file_size'),
        'attachments_max_to_upload_override' => array('attachments_max_to_upload'),
        'attachments_mime_types_list_override' => array('attachments_mime_types_list'));

    public $_current = '';
    public $_forum = 0;

    public $forums = array();

    public function __construct() { }

    public function init($id) {
        if (!isset($this->forums[$id])) {
            $meta = get_post_meta($id, '_gdbbx_settings', true);
            $this->forums[$id] = wp_parse_args($meta, gdbbx_default_forum_settings());

            $list = get_post_ancestors($id);

            foreach ($list as $anc) {
                $meta = get_post_meta($anc, '_gdbbx_settings', true);
                $this->forums[$anc] = wp_parse_args($meta, gdbbx_default_forum_settings());
            }

            foreach ($this->forums[$id] as $key => &$value) {
                if ($value == 'inherit') {
                    if (!empty($list)) {
                        foreach ($list as $anc) {
                            if ($this->forums[$anc][$key] != 'inherit') {
                                $value = $this->forums[$anc][$key];

                                if ($value == 'yes' && isset($this->keys_connected[$key])) {
                                    foreach ($this->keys_connected[$key] as $sub) {
                                        $this->forums[$id][$sub] = $this->forums[$anc][$sub];
                                    }
                                }

                                break;
                            }
                        }
                    }
                }

                if ($value == 'inherit') {
                    $value = 'default';
                }
            }
        }
    }

    public function forum($forum_id = 0) {
        $this->_forum = $forum_id == 0 ? bbp_get_forum_id() : $forum_id;

        $this->init($this->_forum);

        return $this;
    }

    public function attachments() {
        $this->_current = 'attachments';

        return $this;
    }

    public function privacy() {
        $this->_current = 'privacy';

        return $this;
    }

    public function get($name, $submeta = '') {
        $submeta = $submeta == '' ? $this->_current : $submeta;

        return $this->forums[$this->_forum][$submeta.'_'.$name];
    }

    public function id() {
        return $this->_current;
    }
}

/** @return gdbbx_core_forums  */
function gdbbx_obj_forums() {
    return gdbbx_loader()->objects['forums'];
}
