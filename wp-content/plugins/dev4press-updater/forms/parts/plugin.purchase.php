<?php

if (!defined('ABSPATH')) exit;

$licenses = d4pupd_updater()->has_licenses($data->code);

$price_personal = $data->code == 'gd-dev4press-plugins' ? $data->licenses['lic_plugin_personal_pack'] : $data->licenses['lic_plugin_personal'];
$price_business = $data->code == 'gd-dev4press-plugins' ? $data->licenses['lic_plugin_business_pack'] : $data->licenses['lic_plugin_business'];
$price_developer = $data->code == 'gd-dev4press-plugins' ? $data->licenses['lic_plugin_developer_pack'] : $data->licenses['lic_plugin_developer'];

?>

<div class="plugin-card d4pupd-single-plugin">
    <div class="corner-ribbon ribbon-<?php echo $ribbon; ?>"><?php echo $ribbon; ?></div>
    <div class="plugin-card-top">
        <a class="plugin-icon"><img alt="<?php echo $data->name; ?>" src="<?php echo d4pupd_updater()->cdn; ?>products/<?php echo $data->category; ?>/<?php echo $data->code; ?>_128.png" /></a>
        <div class="name column-name">
            <h4><?php echo $data->name; ?></h4>
        </div>
        <div class="desc column-description">
            <p><?php echo $data->description; ?></p>
            <p class="authors">
                <cite>
                    <a href="<?php echo $data->url; ?>"><?php _e("Home", "dev4press-updater"); ?></a>
                    <?php if ($data->code != 'gd-dev4press-plugins') { ?>
                     &middot; 
                    <a href="https://support.dev4press.com/forums/forum/plugins/<?php echo $data->code; ?>/"><?php _e("Support Forum", "dev4press-updater"); ?></a> &middot; 
                    <a href="https://support.dev4press.com/kb/product/<?php echo $data->code; ?>/"><?php _e("Documentation", "dev4press-updater"); ?></a>
                    <?php } ?>
                </cite>
            </p>
        </div>
    </div>
    <div class="plugin-card-bottom">
        <div class="column-rating">
            <a target="_blank" class="button-primary button-red" href="<?php echo $data->url_buy; ?>"><?php _e("Buy Now", "dev4press-updater"); ?></a>

            <?php if ($licenses !== false) { $lics = count($licenses); ?>
            <div class="dev4press-licenses"><i aria-hidden="true" class="fa fa-check-square"></i> 
                <?php echo sprintf(__("You have %s active %s for this plugin", "dev4press-updater"), $lics, _n("license", "licenses", $lics, "dev4press-updater")); ?>
            </div>
            <?php } ?>
        </div>
        <div class="column-updated">
            <div class="dev4press-price">
                <strong><?php _e("Personal", "dev4press-updater"); ?></strong> &middot; <em><?php _e("1 website", "dev4press-updater"); ?></em> <span>$<?php echo $price_personal->price; ?></span>
            </div>
            <div class="dev4press-price">
                <strong><?php _e("Business", "dev4press-updater"); ?></strong> &middot; <em><?php _e("5 websites", "dev4press-updater"); ?></em> <span>$<?php echo $price_business->price; ?></span>
            </div>
            <div class="dev4press-price">
                <strong><?php _e("Developer", "dev4press-updater"); ?></strong> &middot; <em><?php _e("50 websites", "dev4press-updater"); ?></em> <span>$<?php echo $price_developer->price; ?></span>
            </div>
        </div>
    </div>
</div>