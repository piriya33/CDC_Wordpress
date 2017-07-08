<?php

$url = $post['type'] == 'topic' ? bbp_get_topic_permalink($post['id']) : bbp_get_reply_url($post['id']);
$title = $post['type'] == 'topic' ? bbp_get_topic_title($post['id']) : bbp_get_reply_title($post['id']);

echo '<li>'.D4P_EOL;
echo '<a class="bbp-topic-title" href="'.$url.'" title="'.esc_attr($title).'">'.$title.'</a>'.D4P_EOL;

if ($show_date) {
    echo '<em class="bbp-last-active">'.$post['activity'].'</em>'.D4P_EOL;
}

if ($show_author) {
    $type = $show_avatar ? 'both' : 'name';
    $author = bbp_get_author_link(array('post_id' => $post['id'], 'size' => 20, 'type' => $type));

    echo '<em class="bbp-author">'.__("by", "gd-bbpress-toolbox").' '.$author.'</em>'.D4P_EOL;
}

echo '</li>'.D4P_EOL;
                
