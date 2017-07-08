<h4><?php _e("Before and After Content", "gd-bbpress-toolbox"); ?></h4>
<table>
    <tbody>
        <tr>
            <td class="cell-singular">
                <label for="<?php echo $this->get_field_id('before'); ?>"><?php _e("Before", "gd-bbpress-toolbox"); ?>:</label>
                <textarea class="widefat half-height" id="<?php echo $this->get_field_id('before'); ?>" name="<?php echo $this->get_field_name('before'); ?>"><?php echo esc_textarea($instance['before']); ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="cell-singular">
                <label for="<?php echo $this->get_field_id('after'); ?>"><?php _e("After", "gd-bbpress-toolbox"); ?>:</label>
                <textarea class="widefat half-height" id="<?php echo $this->get_field_id('after'); ?>" name="<?php echo $this->get_field_name('after'); ?>"><?php echo esc_textarea($instance['after']); ?></textarea>
            </td>
        </tr>
    </tbody>
</table>
