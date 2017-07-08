<?php global $_meta; ?>

<input type="hidden" name="gdbbatt_forum_meta" value="edit" />

<h4><?php _e("Attachments Status", "gd-bbpress-toolbox"); ?>:</h4>
<p>
    <label for="gdbbx_settings_attachments_status"><?php _e("Enable Attachments", "gd-bbpress-toolbox"); ?></label>
    <?php d4p_render_select(gdbbx_select_forum_settings(), array('id' => 'gdbbx_settings_attachments_status', 'name' => 'gdbbx_settings[attachments_status]', 'class' => 'widefat', 'selected' => $_meta['attachments_status'])); ?>
</p>

<p>
    <label for="gdbbx_settings_attachments_hide_from_visitors"><?php _e("Hide uploaded files from visitors", "gd-bbpress-toolbox"); ?></label>
    <?php d4p_render_select(gdbbx_select_forum_settings(), array('id' => 'gdbbx_settings_attachments_hide_from_visitors', 'name' => 'gdbbx_settings[attachments_hide_from_visitors]', 'class' => 'widefat', 'selected' => $_meta['attachments_hide_from_visitors'])); ?>
</p>

<h4><?php _e("Allowed size", "gd-bbpress-toolbox"); ?>:</h4>
<p>
    <?php d4p_render_select(gdbbx_select_forum_override(), array('id' => 'gdbbx_settings_attachments_max_file_size_override', 'name' => 'gdbbx_settings[attachments_max_file_size_override]', 'class' => 'widefat gdbbx-override', 'selected' => $_meta['attachments_max_file_size_override'])); ?>
</p>
<div style="display: <?php echo $_meta['attachments_max_file_size_override'] == 'yes' ? 'block' : 'none'; ?>;">
    <label for="gdbbx_settings_attachments_max_file_size"><?php _e("Maximum file size allowed", "gd-bbpress-toolbox"); ?></label>
    <input type="number" class="widefat" value="<?php echo $_meta['attachments_max_file_size']; ?>" name="gdbbx_settings[attachments_max_file_size]" id="gdbbx_settings_attachments_max_file_size" min="1" step="1" max="<?php echo gdbbx_attachments()->max_server_allowed(); ?>" />
</div>

<h4><?php _e("Number of files", "gd-bbpress-toolbox"); ?>:</h4>
<p>
    <?php d4p_render_select(gdbbx_select_forum_override(), array('id' => 'gdbbx_settings_attachments_max_to_upload_override', 'name' => 'gdbbx_settings[attachments_max_to_upload_override]', 'class' => 'widefat gdbbx-override', 'selected' => $_meta['attachments_max_to_upload_override'])); ?>
</p>
<div style="display: <?php echo $_meta['attachments_max_to_upload_override'] == 'yes' ? 'block' : 'none'; ?>;">
    <label for="gdbbx_settings_attachments_max_to_upload"><?php _e("Maximum files to upload", "gd-bbpress-toolbox"); ?></label>
    <input type="number" class="widefat" value="<?php echo $_meta['attachments_max_to_upload']; ?>" name="gdbbx_settings[attachments_max_to_upload]" id="gdbbx_settings_attachments_max_to_upload" min="1" step="1" />
</div>

<h4><?php _e("Allowed MIME types", "gd-bbpress-toolbox"); ?>:</h4>
<p>
    <?php d4p_render_select(gdbbx_select_forum_override(), array('id' => 'gdbbx_settings_attachments_mime_types_list_override', 'name' => 'gdbbx_settings[attachments_mime_types_list_override]', 'class' => 'widefat gdbbx-override', 'selected' => $_meta['attachments_mime_types_list_override'])); ?>
</p>
<div class="d4plib-metabox-checkboxes" style="display: <?php echo $_meta['attachments_mime_types_list_override'] == 'yes' ? 'block' : 'none'; ?>;">
    <div class="d4plib-metabox-check-uncheck">
        <a href="#checkall"><?php _e("Check All", "gd-bbpress-toolbox"); ?></a>
         | <a href="#uncheckall"><?php _e("Uncheck All", "gd-bbpress-toolbox"); ?></a>
    </div>

    <?php

    $mime_types = gdbbx_mime_types_list();

    $name_base = 'gdbbx_settings[attachments_mime_types_list][]';
    $value = $_meta['attachments_mime_types_list'];
    $value = is_null($value) || (is_array($value) && empty($value)) ? array_keys($mime_types) : (array)$value;

    foreach ($mime_types as $mime => $label) {
        $sel = in_array($mime, $value) ? ' checked="checked"' : '';

        echo sprintf('<label><input type="checkbox" value="%s" name="%s"%s class="widefat" />%s</label>', 
                $mime, $name_base, $sel, $label);
    }

    ?>
</div>