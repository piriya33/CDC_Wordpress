<?php

$pages = gdbbx_admin()->menu_items;
$_page = gdbbx_admin()->page;
$_panel = gdbbx_admin()->panel;

if (gdbbx_is_module_loaded('canned')) {
    $pages = array_merge(array_slice($pages, 0, 1), 
                         array('canned' => array('title' => __("Canned Replies", "gd-bbpress-toolbox"), 'icon' => 'reply')),
                         array_slice($pages, 1));
}

if (!empty($panels) && $_panel === false) {
    $_panel = 'index';
}

$_classes = array('d4p-wrap', 'wpv-'.GDBBX_WPV, 'd4p-page-'.$_page);

if ($_panel !== false) {
    $_classes[] = 'd4p-panel';
    $_classes[] = 'd4p-panel-'.$_panel;
}

$_message = '';

if (isset($_GET['message']) && $_GET['message'] != '') {
    switch ($_GET['message']) {
        case 'wp44update':
            $count = isset($_GET['count']) ? intval($_GET['count']) : 0;

            $_message = __("Database updated.", "gd-bbpress-toolbox");
            $_message.= ' '.sprintf(__("Total of %s posts are updated.", "gd-bbpress-toolbox"), $count);
            break;
        case 'free-disabled':
            $_message = __("Free plugins are now disabled.", "gd-bbpress-toolbox");
            break;
        case 'saved':
            $_message = __("Settings are saved.", "gd-bbpress-toolbox");
            break;
        case 'removed':
            $_message = __("Removal operation completed.", "gd-bbpress-toolbox");
            break;
        case 'imported':
            $_message = __("Import operation completed.", "gd-bbpress-toolbox");
            break;
        case 'nothing':
            $_message = __("Nothing done.", "gd-bbpress-toolbox");
            break;
        case 'closed':
            $topics = intval($_GET['topics']);
            $_message = sprintf(__("Total %s topics closed.", "gd-bbpress-toolbox"), $topics);
            break;
        case 'attachments-unattach':
            $_message = __("Selected attachments are now unattached.", "gd-bbpress-toolbox");
            break;
        case 'attachment-unattach':
            $_message = __("Attachment is now unattached.", "gd-bbpress-toolbox");
            break;
        case 'attachments-delete':
            $_message = __("Selected attachments deleted from media library.", "gd-bbpress-toolbox");
            break;
        case 'attachment-delete':
            $_message = __("Attachment deleted from media library.", "gd-bbpress-toolbox");
            break;
        case 'errors-deleted':
            $_message = __("Selected errors records deleted from database.", "gd-bbpress-toolbox");
            break;
        case 'error-deleted':
            $_message = __("Error record deleted from database.", "gd-bbpress-toolbox");
            break;
    }
}

?>
<div class="<?php echo join(' ', $_classes); ?>">
    <div class="d4p-header">
        <div class="d4p-navigator">
            <ul>
                <li class="d4p-nav-button">
                    <a href="#"><i aria-hidden="true" class="<?php echo d4p_icon_class($pages[$_page]['icon']); ?>"></i> <?php echo $pages[$_page]['title']; ?></a>
                    <ul>
                        <?php

                        foreach ($pages as $page => $obj) {
                            $url = 'admin.php?page=gd-bbpress-toolbox-'.$page;

                            if ($page == 'canned') {
                                $url = 'edit.php?post_type=bbx_canned_reply';
                            }

                            if ($page != $_page) {
                                echo '<li><a href="'.$url.'"><i aria-hidden="true" class="'.(d4p_icon_class($obj['icon'], 'fw')).'"></i> '.$obj['title'].'</a></li>';
                            } else {
                                echo '<li class="d4p-nav-current"><i aria-hidden="true" class="'.(d4p_icon_class($obj['icon'], 'fw')).'"></i> '.$obj['title'].'</li>';
                            }
                        }

                        ?>
                    </ul>
                </li>
                <?php if (!empty($panels)) { ?>
                <li class="d4p-nav-button">
                    <a href="#"><i aria-hidden="true" class="<?php echo d4p_icon_class($panels[$_panel]['icon']); ?>"></i> <?php echo $panels[$_panel]['title']; ?></a>
                    <ul>
                        <?php

                        foreach ($panels as $panel => $obj) {
                            if ($panel != $_panel) {
                                echo '<li><a href="admin.php?page=gd-bbpress-toolbox-'.$_page.'&panel='.$panel.'"><i aria-hidden="true" class="'.(d4p_icon_class($obj['icon'], 'fw')).'"></i> '.$obj['title'].'</a></li>';
                            } else {
                                echo '<li class="d4p-nav-current"><i aria-hidden="true" class="'.(d4p_icon_class($obj['icon'], 'fw')).'"></i> '.$obj['title'].'</li>';
                            }
                        }

                        ?>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="d4p-plugin">
            GD bbPress Toolbox Pro
        </div>
    </div>
    <?php

    if ($_message != '') {
        echo '<div class="updated">'.$_message.'</div>';
    }

    ?>
    <div class="d4p-content">
