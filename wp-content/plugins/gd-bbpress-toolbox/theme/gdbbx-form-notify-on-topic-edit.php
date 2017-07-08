<fieldset class="bbp-form">
    <legend><label><?php _e("On edit notifications", "gd-bbpress-toolbox"); ?>:</label></legend>
    <?php if (bbp_get_topic_author_id() != bbp_get_current_user_id()) { ?>
    <p>
        <input name="gdbbx_notify_on_edit_author" id="gdbbx_notify_on_edit_author" type="checkbox" value="1" tabindex="<?php bbp_tab_index(); ?>" /> 
        <label for="gdbbx_notify_on_edit_author"><?php _e("Notify topic author", "gd-bbpress-toolbox"); ?></label>
    </p>
    <?php } ?>
    <p>
        <input name="gdbbx_notify_on_edit_subscribers" id="gdbbx_notify_on_edit_subscribers" type="checkbox" value="1" tabindex="<?php bbp_tab_index(); ?>" /> 
        <label for="gdbbx_notify_on_edit_subscribers"><?php _e("Notify topic subscribers", "gd-bbpress-toolbox"); ?></label>
    </p>
</fieldset>