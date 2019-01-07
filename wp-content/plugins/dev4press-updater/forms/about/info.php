<?php if (!defined('ABSPATH')) exit; ?>

<div class="d4p-group d4p-group-import d4p-group-about">
    <h3>Dev4Press Updater</h3>
    <div class="d4p-group-inner">
        <ul>
            <li><?php _e("Version", "dev4press-updater"); ?>: <span><?php echo d4pupd_settings()->info_version; ?></span></li>
            <li><?php _e("Status", "dev4press-updater"); ?>: <span><?php echo ucfirst(d4pupd_settings()->info_status); ?></span></li>
            <li><?php _e("Build", "dev4press-updater"); ?>: <span><?php echo d4pupd_settings()->info_build; ?></span></li>
            <li><?php _e("Date", "dev4press-updater"); ?>: <span><?php echo d4pupd_settings()->info_updated; ?></span></li>
        </ul>
        <hr style="margin: 1em 0 .7em; border-top: 1px solid #eee"/>
        <ul>
            <li><?php _e("First released", "dev4press-updater"); ?>: <span><?php echo d4pupd_settings()->info_released; ?></span></li>
        </ul>
    </div>
</div>

<div class="d4p-group d4p-group-import d4p-group-about">
    <h3><?php _e("Important Links", "dev4press-updater"); ?></h3>
    <div class="d4p-group-inner">
        <ul>
            <li><?php _e("Home Page", "dev4press-updater"); ?>: <span><a href="https://plugins.dev4press.com/dev4press-updater/" target="_blank">plugins.dev4press.com/dev4press-updater</a></span></li>
        </ul>
    </div>
</div>

<div class="d4p-group d4p-group-changelog">
    <h3><?php _e("Translations", "dev4press-updater"); ?></h3>
    <div class="d4p-group-inner">
        <h4>de_DE [Deutsch - German]</h4>
        <ul>
            <li><?php _e("Version", "dev4press-updater"); ?>: <span>4.0</span></li>
        </ul>

        <h4>es_ES [Español - Spanish]</h4>
        <ul>
            <li><?php _e("Version", "dev4press-updater"); ?>: <span>4.0</span></li>
        </ul>

        <h4>fr_FR [Français - French]</h4>
        <ul>
            <li><?php _e("Version", "dev4press-updater"); ?>: <span>4.0</span></li>
        </ul>

        <h4>it_IT [Italiano - Italian]</h4>
        <ul>
            <li><?php _e("Version", "dev4press-updater"); ?>: <span>4.0</span></li>
        </ul>

        <h4>nl_NL [Nederlands - Dutch]</h4>
        <ul>
            <li><?php _e("Version", "dev4press-updater"); ?>: <span>4.0</span></li>
        </ul>

        <h4>sr_RS [Српски - Serbian]</h4>
        <ul>
            <li><?php _e("Version", "dev4press-updater"); ?>: <span>4.0</span></li>
        </ul>

        <h4>ja (日本語 - Japanese)</h4>
        <ul>
            <li><?php _e("Version", "dev4press-updater"); ?>: <span>3.9</span></li>
            <li><?php _e("Translator", "dev4press-updater"); ?>: <span>Shinsaku IKEDA</span></li>
            <li><?php _e("URL", "dev4press-updater"); ?>: <span><a target="_blank" href="https://def.cafe">https://def.cafe</a></span></li>
        </ul>
    </div>
</div>
