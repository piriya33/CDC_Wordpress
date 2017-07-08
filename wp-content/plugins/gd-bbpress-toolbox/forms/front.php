<?php

if (!defined('ABSPATH')) exit;

$panels = array();

include(GDBBX_PATH.'forms/shared/top.php');

$pages = gdbbx_admin()->menu_items;

unset($pages['front']);

if (gdbbx_is_module_loaded('canned')) {
    $pages = array_merge(array_slice($pages, 0, 1), 
                         array('canned' => array('title' => __("Canned Replies", "gd-bbpress-toolbox"), 'icon' => 'reply')),
                         array_slice($pages, 1));
}

include(GDBBX_PATH.'forms/shared/notices.php');

?>

<div class="d4p-front-left">
    <div class="d4p-front-title" style="height: auto;">
        <h1 style="font-size: 95px; line-height: 0.95; letter-spacing: -4px; text-align: right;">
            <span style="font-size: 89px">GD bbPRESS</span><span>TOOLBOX</span>
            <span style="font-weight: 100; font-size:44px; letter-spacing: -2px; line-height: 1.4">
                <em style="font-weight: 700; font-style: normal;">5th</em> Birthday Anniversary
            </span>
            <span style="font-size: 48px; letter-spacing: 1px">
                PRO 
                <em style="font-weight: 100; font-style: normal;"><?php _e("Edition", "gd-bbpress-toolbox"); ?></em>
            </span>
        </h1>
        <h5>
            <?php 

            _e("Version", "gd-bbpress-toolbox");
            echo': <strong>'.gdbbx()->info->version.'</strong>';

            if (gdbbx()->info->status != 'stable') {
                echo ' - <span style="color: red; font-weight: bold;">'.strtoupper(gdbbx()->info->status).'</span>';
            }

            echo ', '.gdbbx()->info->updated;
            
            ?>
        </h5>
    </div>
    <div class="d4p-front-title" style="height: auto; margin-top: 15px; text-align: center; font-size: 18px; font-weight: bold;">
        <?php _e("Knowledge Base and Support Forums", "gd-bbpress-toolbox"); ?>
        <p style="font-size: 15px; font-weight: normal; margin: 10px 0 0;">
            <?php echo sprintf(__("To learn more about the plugin, check out plugin %s articles and FAQ. To get additional help, you can use %s.", "gd-bbpress-toolbox"),
                '<a target="_blank" href="https://support.dev4press.com/kb/product/gd-bbpress-toolbox/">'.__("knowledge base", "gd-bbpress-toolbox").'</a>',
                '<a target="_blank" href="https://support.dev4press.com/forums/forum/plugins/gd-bbpress-toolbox/">'.__("support forum", "gd-bbpress-toolbox").'</a>'); ?>
        </p>
    </div>
    <div class="d4p-front-title" style="height: auto; margin-top: 15px; text-align: center; font-size: 18px; font-weight: bold;">
        <?php _e("GD Topic Polls Pro", "gd-bbpress-toolbox"); echo ' &amp; '; _e("GD Topic Prefix Pro", "gd-bbpress-toolbox"); ?>
        <p style="font-size: 15px; font-weight: normal; margin: 10px 0 0;">
            <?php echo sprintf(__("Expand bbPress powered forums with polls attached to topics, and prefixes assigned to topics. Learn more: %s and %s.", "gd-bbpress-toolbox"),
                '<a target="_blank" href="https://plugins.dev4press.com/gd-topic-polls/">'.__("GD Topic Polls Pro", "gd-bbpress-toolbox").'</a>',
                '<a target="_blank" href="https://plugins.dev4press.com/gd-topic-prefix/">'.__("GD Topic Prefix Pro", "gd-bbpress-toolbox").'</a>'); ?>
        </p>
    </div>
    <div class="d4p-front-dev4press">
        &copy; 2008 - 2017. Dev4Press &middot; <a target="_blank" href="https://www.dev4press.com/">www.dev4press.com</a> &middot; 
                                        <a target="_blank" href="https://plugins.dev4press.com/gd-bbpress-toolbox/">plugins.dev4press.com/gd-bbpress-toolbox</a>
    </div>
</div>
<div class="d4p-front-right">
    <?php

    $caps = gdbbx()->get('roles_gdbbx_moderation', 'bbpress');

    foreach ($pages as $page => $obj) {
        $cap = GDBBX_CAP;

        if ($caps && isset($obj['cap'])) {
            $cap = $obj['cap'];
        }

        if (!current_user_can($cap)) {
            continue;
        }

        $url = 'admin.php?page=gd-bbpress-toolbox-'.$page;

        if ($page == 'canned') {
            $url = 'edit.php?post_type=bbx_canned_reply';
        }

        ?>

            <div class="d4p-options-panel">
                <i aria-hidden="true" class="fa fa-<?php echo $obj['icon']; ?>"></i>
                <h5><?php echo $obj['title']; ?></h5>
                <div>
                    <a class="button-primary" href="<?php echo $url; ?>"><?php _e("Open", "gd-bbpress-toolbox"); ?></a>
                </div>
            </div>

        <?php
    }

    ?>
</div>

<?php 

include(GDBBX_PATH.'forms/shared/bottom.php');
