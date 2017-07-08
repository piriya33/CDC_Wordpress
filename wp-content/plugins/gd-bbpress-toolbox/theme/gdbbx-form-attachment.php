<fieldset class="bbp-form">
    <legend><?php _e("Attachments", "gd-bbpress-toolbox"); ?>:</label></legend>
    <div>
        <?php do_action('gdbbx_attachments_form_notices'); ?>

        <div class="bbp-attachments-form">
            <div class="bbp-attachments-input">
                <div role="button" class="bbp-attachment-preview"><span aria-hidden="true"><?php _e("Select File", "gd-bbpress-toolbox"); ?></span></div>
                <label>
                    <input type="file" size="40" name="d4p_attachment[]" />
                    <span class="bbp-accessibility-show-for-sr"><?php _e("Select File", "gd-bbpress-toolbox"); ?></span>
                </label>
                <div class="bbp-attachment-control"></div>
            </div>
            <a role="button" class="d4p-attachment-addfile" href="#"><?php _e("Add another file", "gd-bbpress-toolbox"); ?></a>
        </div>
    </div>
</fieldset>