<div class="<?php echo gdbbx_signature_editor_class(); ?>">
    <label for="signature"><?php _e("Forum Signature", "gd-bbpress-toolbox"); ?></label>

    <?php gdbbx_render_signature_editor($_signature); ?>

    <br/>
    <span class="description">
        <?php echo sprintf(__("Signature length is limited to %s characters.", "gd-bbpress-toolbox"), $this->max_length); ?><br/>
        <?php do_action('gdbbx_user_edit_signature_info'); ?>
    </span>
</div>
