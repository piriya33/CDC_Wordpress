<?php

global $wp_roles;
$list = array(
    array('title' => __("Global", "gd-bbpress-toolbox"), 
          'values' => array('all' => __("Everyone", "gd-bbpress-toolbox"), 'visitor' => __("Only Visitors", "gd-bbpress-toolbox"), 'user' => __("All Users", "gd-bbpress-toolbox"))),
    array('title' => __("User Roles", "gd-bbpress-toolbox"), 
          'values' => array())
);

foreach ($wp_roles->role_names as $role => $title) {
    $list[1]['values']['role:'.$role] = $title;
}

?>

<h4><?php _e("Visibility", "gd-bbpress-toolbox"); ?></h4>
<table>
    <tbody>
        <tr>
            <td class="cell-left">
                <label for="<?php echo $this->get_field_id('_display'); ?>"><?php _e("Display To", "gd-bbpress-toolbox"); ?>:</label>
                <?php d4p_render_grouped_select($list, array('id' => $this->get_field_id('_display'), 'class' => 'widefat', 'name' => $this->get_field_name('_display'), 'selected' => $instance['_display'])); ?>
            </td>
            <td class="cell-right">
                <label for="<?php echo $this->get_field_id('_hook'); ?>"><?php _e("Visibility Hook", "gd-bbpress-toolbox"); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id('_hook'); ?>" name="<?php echo $this->get_field_name('_hook'); ?>" type="text" value="<?php echo esc_attr($instance['_hook']); ?>" />
            </td>
        </tr>
        <tr>
            <td class="cell-singular" colspan="2">
                <label for="<?php echo $this->get_field_id('_class'); ?>"><?php _e("Additional CSS Class", "gd-bbpress-toolbox"); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id('_class'); ?>" name="<?php echo $this->get_field_name('_class'); ?>" type="text" value="<?php echo esc_attr($instance['_class']); ?>" />
            </td>
        </tr>
    </tbody>
</table>
