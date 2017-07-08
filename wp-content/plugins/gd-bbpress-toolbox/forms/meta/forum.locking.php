<?php global $_meta; ?>

<h4><?php _e("Lock forum for posting", "gd-bbpress-toolbox"); ?>:</h4>
<p>
    <label for="gdbbx_settings_privacy_lock_topic_form"><?php _e("Lock topic form", "gd-bbpress-toolbox"); ?></label>
    <?php d4p_render_select(gdbbx_select_forum_settings(), array('id' => 'gdbbx_settings_privacy_lock_topic_form', 'name' => 'gdbbx_settings[privacy_lock_topic_form]', 'class' => 'widefat', 'selected' => $_meta['privacy_lock_topic_form'])); ?>
</p>
<p>
    <label for="gdbbx_settings_privacy_lock_reply_form"><?php _e("Lock reply form", "gd-bbpress-toolbox"); ?></label>
    <?php d4p_render_select(gdbbx_select_forum_settings(), array('id' => 'gdbbx_settings_privacy_lock_reply_form', 'name' => 'gdbbx_settings[privacy_lock_reply_form]', 'class' => 'widefat', 'selected' => $_meta['privacy_lock_reply_form'])); ?>
</p>
