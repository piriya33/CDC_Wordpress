<?php

$attachments = gdbbx_get_post_attachments($post_ID);

if (empty($attachments)) {
    _e("No attachments here.", "gd-bbpress-toolbox");
} else {
    echo '<ul style="list-style: decimal outside; margin-left: 1.5em;">';
    foreach ($attachments as $attachment) {
        $file = get_attached_file($attachment->ID);
        $filename = pathinfo($file, PATHINFO_BASENAME);

        echo '<li>'.$filename;
        echo ' - <a href="'.admin_url('media.php?action=edit&attachment_id='.$attachment->ID).'">'.__("edit", "gd-bbpress-toolbox").'</a>';
        echo '</li>';
    }
    echo '</ul>';
}

if ((gdbbx()->get('errors_visible_to_author', 'attachments') == 1 && $author_id == $user_ID) || (gdbbx()->get('errors_visible_to_admins', 'attachments') == 1 && d4p_is_current_user_admin()) || (gdbbx()->get('errors_visible_to_moderators', 'attachments') == 1 && gdbbx_is_current_user_bbp_moderator())) {
    $errors = get_post_meta($post_ID, "_bbp_attachment_upload_error");

    if (!empty($errors)) {
        echo '<h4>'.__("Upload Errors", "gd-bbpress-toolbox").':</h4>';
        echo '<ul style="list-style: decimal outside; margin-left: 1.5em;">';
        foreach ($errors as $error) {
            echo '<li><strong>'.$error["file"].'</strong>:<br/>'.__($error["message"], "gd-bbpress-attachments").'</li>';
        }
        echo '</ul>';
    }
}

