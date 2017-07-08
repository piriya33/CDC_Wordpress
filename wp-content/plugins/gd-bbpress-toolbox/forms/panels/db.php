<h3 style="margin-top: 0;"><?php _e("Additional database tables", "gd-bbpress-toolbox"); ?></h3>
<?php

    require_once(GDBBX_PATH.'core/admin/install.php');

    $list_db = gdbbx_install_database();

    if (!empty($list_db)) {
        echo '<h4>'.__("Database Upgrade Notices", "gd-bbpress-toolbox").'</h4>';
        echo join('<br/>', $list_db);
    }

    echo '<h4>'.__("Database Tables Check", "gd-bbpress-toolbox").'</h4>';
    $check = gdbbx_check_database();

    $msg = array();
    foreach ($check as $table => $data) {
        if ($data['status'] == 'error') {
            $_proceed = false;
            $_error_db = true;
            $msg[] = '<span class="gdpc-error">['.__("ERROR", "gd-bbpress-toolbox").'] - <strong>'.$table.'</strong>: '.$data['msg'].'</span>';
        } else {
            $msg[] = '<span class="gdpc-ok">['.__("OK", "gd-bbpress-toolbox").'] - <strong>'.$table.'</strong></span>';
        }
    }

    echo join('<br/>', $msg);

?>

<h3><?php _e("Individual forum settings", "gd-bbpress-toolbox"); ?></h3>
<?php

    $info = gdbbx_convert_forum_settings();

    if ($info['forums'] > 0) {
        _e("Converted forum settings for", "gd-bbpress-toolbox");

        echo ': '.sprintf(_n("%s forum", "%s forums", $info['forums'], "gd-bbpress-toolbox"), $info['forums']).'.';
    } else {
        _e("Nothing to convert.", "gd-bbpress-toolbox");
    }
