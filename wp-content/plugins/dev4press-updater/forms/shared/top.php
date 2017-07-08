<?php

if (!defined('ABSPATH')) exit;

$pages = d4pupd_admin()->menu_items;
$_page = d4pupd_admin()->page;
$_panel = d4pupd_admin()->panel;

if (!empty($panels) && $_panel === false) {
    $_panel = 'index';
}

$_classes = array('d4p-wrap', 'wpv-'.D4PUPD_WPV, 'd4p-page-'.$_page);

if ($_panel !== false) {
    $_classes[] = 'd4p-panel';
    $_classes[] = 'd4p-panel-'.$_panel;
}

$_message = '';

if (isset($_GET['message']) && $_GET['message'] != '') {
    switch ($_GET['message']) {
        case 'saved':
            $_message = __("Settings are saved.", "dev4press-updater");
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
                            if ($page != $_page) {
                                echo '<li><a href="admin.php?page=dev4press-updater-'.$page.'"><i aria-hidden="true" class="'.d4p_icon_class($obj['icon'], 'fw').'"></i> '.$obj['title'].'</a></li>';
                            } else {
                                echo '<li class="d4p-nav-current"><i aria-hidden="true" class="'.d4p_icon_class($obj['icon'], 'fw').'"></i> '.$obj['title'].'</li>';
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
                                echo '<li><a href="admin.php?page=dev4press-updater-'.$_page.'&panel='.$panel.'"><i aria-hidden="true" class="'.(d4p_icon_class($obj['icon'], 'fw')).'"></i> '.$obj['title'].'</a></li>';
                            } else {
                                echo '<li class="d4p-nav-current"><i aria-hidden="true" class="'.d4p_icon_class($obj['icon'], 'fw').'"></i> '.$obj['title'].'</li>';
                            }
                        }

                        ?>
                    </ul>
                </li>
                <?php } ?>

                <?php if (!d4pupd_settings()->update_one_year_expired()) { ?>
                <li class="d4p-check-button"><a class="button d4pupd-update-recheck" href="<?php echo d4pupd_check_update_url(); ?>"><i aria-hidden="true" class="fa fa-refresh fa-fw"></i> <?php _e("Check for updates", "dev4press-updater"); ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="d4p-plugin">
            Dev4Press Updater
        </div>
    </div>
    <?php

    if ($_message != '') {
        echo '<div class="updated">'.$_message.'</div>';
    }

    ?>
    <div class="d4p-content">
