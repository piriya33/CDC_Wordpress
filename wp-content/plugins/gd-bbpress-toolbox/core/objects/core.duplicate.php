<?php

if (!defined('ABSPATH')) exit;

class gdbbx_core_duplicate {
    public function __construct() { }

    public function duplicate_topic($id) {
        $topic = get_post($id);
        $terms = wp_get_post_terms($id, bbp_get_topic_tag_tax_id(), array('fields' => 'ids'));

        $topic_data = apply_filters('gdbbx_dupe_topic_pre_insert', array(
            'post_author'    => $topic->post_author,
            'post_title'     => __("Copy of", "gd-bbpress-toolbox").' '.$topic->post_title,
            'post_content'   => $topic->post_content,
            'post_status'    => $topic->post_status,
            'post_parent'    => $topic->post_parent,
            'post_type'      => bbp_get_topic_post_type(),
            'tax_input'      => array(bbp_get_topic_tag_tax_id() => $terms),
            'comment_status' => 'closed'
	), $topic);

        $topic_id = wp_insert_post( $topic_data );

	if (!empty($topic_id) && !is_wp_error($topic_id)) {
            do_action('bbp_new_topic', $topic_id, $topic->post_parent, 0, $topic->post_author);
            do_action('bbp_new_topic_post_extras', $topic_id);
        }

        return $topic_id;
    }
}
