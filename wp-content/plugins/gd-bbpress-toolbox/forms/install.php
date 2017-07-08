<?php

if (!defined('ABSPATH')) exit;

$_classes = array('d4p-wrap', 'wpv-'.GDBBX_WPV, 'd4p-page-install');

?>
<div class="<?php echo join(' ', $_classes); ?>">
    <div class="d4p-header">
        <div class="d4p-plugin">
            GD bbPress Toolbox Pro
        </div>
    </div>
    <div class="d4p-content">
        <div class="d4p-content-left">
            <div class="d4p-panel-title">
                <i aria-hidden="true" class="fa fa-magic"></i>
                <h3><?php _e("Installation", "gd-bbpress-toolbox"); ?></h3>
            </div>
            <div class="d4p-panel-info">
                <?php _e("Before you continue, make sure plugin installation was successful.", "gd-bbpress-toolbox"); ?>
            </div>
        </div>
        <div class="d4p-content-right">
            <div class="d4p-update-info">
                <?php include(GDBBX_PATH.'forms/panels/db.php'); ?>

                <h3><?php _e("Previous Plugin Version", "gd-bbpress-toolbox"); ?></h3>
                <?php

                $found = false;

                $list = array('gd-bbpress-attachments', 'gd-bbpress-bbpress', 'gd-bbpress-settings', 'gd-bbpress-tools', 'gd-bbpress-widgets');

                foreach ($list as $name) {
                    $data = get_option($name);
                    $group = substr($name, 11);

                    if (is_array($data) && !empty($data)) {
                        $found = true;

                        $imported = 0;
                        foreach ($data as $key => $value) {
                            if (gdbbx()->exists($key, $group)) {
                                gdbbx()->set($key, $value, $group);
                                $imported++;
                            }
                        }

                        gdbbx()->save($group);

                        echo sprintf(__("Import from <strong>%s</strong> completed, %s records imported.", "gd-bbpress-toolbox"), $name, $imported);
                        echo '<br/>';
                    }
                }

                if (!$found) {
                    _e("Older version settings not found.", "gd-bbpress-toolbox");
                }

                ?>

                <h3><?php _e("All Done", "gd-bbpress-toolbox"); ?></h3>
                <?php

                    gdbbx()->set('install', false, 'info');
                    gdbbx()->set('update', false, 'info', true);

                    _e("Installation completed.", "gd-bbpress-toolbox");

                ?>
                <br/><br/><a class="button-primary" href="<?php echo d4p_current_url(); ?>"><?php _e("Click here to continue.", "gd-bbpress-toolbox"); ?></a>
            </div>
            <?php echo gdbbx_plugin()->recommend('install'); ?>
        </div>
    </div>
</div>