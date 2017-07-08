<h4><?php _e("Information to Show", "gd-bbpress-toolbox"); ?></h4>
<table>
    <tbody>
        <tr>
            <td class="cell-left">
                <div class="d4plib-checkbox-list">
                    <label for="<?php echo $this->get_field_id('show_forum'); ?>">
                        <input class="widefat" <?php echo $instance['show_forum'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('show_forum'); ?>" name="<?php echo $this->get_field_name('show_forum'); ?>" />
                        <?php _e("Show forum", "gd-bbpress-toolbox"); ?></label><br/>

                    <label for="<?php echo $this->get_field_id('show_author'); ?>">
                        <input class="widefat" <?php echo $instance['show_author'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('show_author'); ?>" name="<?php echo $this->get_field_name('show_author'); ?>" />
                        <?php _e("Show author", "gd-bbpress-toolbox"); ?></label><br/>

                    <label for="<?php echo $this->get_field_id('show_post_date'); ?>">
                        <input class="widefat" <?php echo $instance['show_post_date'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('show_post_date'); ?>" name="<?php echo $this->get_field_name('show_post_date'); ?>" />
                        <?php _e("Show post date", "gd-bbpress-toolbox"); ?></label><br/>

                    <label for="<?php echo $this->get_field_id('show_last_activity'); ?>">
                        <input class="widefat" <?php echo $instance['show_last_activity'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('show_last_activity'); ?>" name="<?php echo $this->get_field_name('show_last_activity'); ?>" />
                        <?php _e("Show last activity", "gd-bbpress-toolbox"); ?></label>
                </div>
            </td>
            <td class="cell-right">
                <div class="d4plib-checkbox-list">
                    <label for="<?php echo $this->get_field_id('show_status'); ?>">
                        <input class="widefat" <?php echo $instance['show_status'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('show_status'); ?>" name="<?php echo $this->get_field_name('show_status'); ?>" />
                        <?php _e("Show status", "gd-bbpress-toolbox"); ?></label><br/>

                    <label for="<?php echo $this->get_field_id('show_count_replies'); ?>">
                        <input class="widefat" <?php echo $instance['show_count_replies'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('show_count_replies'); ?>" name="<?php echo $this->get_field_name('show_count_replies'); ?>" />
                        <?php _e("Show replies count", "gd-bbpress-toolbox"); ?></label><br/>

                    <label for="<?php echo $this->get_field_id('show_count_voices'); ?>">
                        <input class="widefat" <?php echo $instance['show_count_voices'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('show_count_voices'); ?>" name="<?php echo $this->get_field_name('show_count_voices'); ?>" />
                        <?php _e("Show voices count", "gd-bbpress-toolbox"); ?></label><br/>

                    <label for="<?php echo $this->get_field_id('show_participants'); ?>">
                        <input class="widefat" <?php echo $instance['show_participants'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('show_participants'); ?>" name="<?php echo $this->get_field_name('show_participants'); ?>" />
                        <?php _e("Show participants", "gd-bbpress-toolbox"); ?></label>
                </div>
            </td>
        </tr>
    </tbody>
</table>
