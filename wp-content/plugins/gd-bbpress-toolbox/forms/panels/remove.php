<div class="d4p-group d4p-group-reset d4p-group-important">
    <h3><?php _e("Important", "gd-bbpress-toolbox"); ?></h3>
    <div class="d4p-group-inner">
        <?php _e("This tool can remove plugin settings saved in the WordPress options table, individual settings for forums related to this plugin and individual settings for users related to this plugin (tracking and signature).", "gd-bbpress-toolbox"); ?><br/><br/>
        <?php _e("Deletion operations are not reversible, and it is highly recommended to create database backup before proceeding with this tool.", "gd-bbpress-toolbox"); ?> 
        <?php _e("If you choose to remove plugin settings, that will also reinitialize all plugin settings to default values.", "gd-bbpress-toolbox"); ?>
    </div>
</div>
<div class="d4p-group d4p-group-tools d4p-group-reset">
    <h3><?php _e("Choose what you want to delete", "gd-bbpress-toolbox"); ?></h3>
    <div class="d4p-group-inner">
        <label>
            <input type="checkbox" class="widefat" name="gdbbxtools[remove][settings]" value="on" /> <?php _e("All Plugin Settings", "gd-bbpress-toolbox"); ?>
        </label>
        <label>
            <input type="checkbox" class="widefat" name="gdbbxtools[remove][forums]" value="on" /> <?php _e("All Forums Meta Settings", "gd-bbpress-toolbox"); ?>
        </label>
        <label>
            <input type="checkbox" class="widefat" name="gdbbxtools[remove][tracking]" value="on" /> <?php _e("All Users Tracking Data", "gd-bbpress-toolbox"); ?>
        </label>
        <label>
            <input type="checkbox" class="widefat" name="gdbbxtools[remove][signature]" value="on" /> <?php _e("All Users Signatures", "gd-bbpress-toolbox"); ?>
        </label>
    </div>
</div>