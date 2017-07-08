<h3><?php IS_PROFILE_PAGE ? _e("Your Forum Signature", "gd-bbpress-toolbox") : _e("User Forum Signature", "gd-bbpress-toolbox"); ?></h3>
<table class="form-table">
    <tr>
	<th><label for="signature"><?php _e("Signature", "gd-bbpress-toolbox"); ?></label></th>
	<td>
            <div class="<?php echo gdbbx_signature_editor_class(); ?>">
                <?php gdbbx_render_signature_editor($_signature); ?>
            </div>
        </td>
    </tr>
</table>
