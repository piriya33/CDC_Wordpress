<?php

if (!defined('ABSPATH')) exit;

if (!d4p_has_plugin('gd-topic-prefix') && gdbbx_settings()->get('notice_gdtox_hide', 'core') === false) {
    $web = parse_url(get_bloginfo('url'), PHP_URL_HOST);

    $url = 'https://plugins.dev4press.com/gd-topic-prefix/';
    $url = add_query_arg('utm_source', $web, $url);
    $url = add_query_arg('utm_medium', 'plugin-gd-bbpress-toolbox', $url);
    $url = add_query_arg('utm_campaign', 'front-panel', $url);

    ?>

<div class="gdbbx-notice-info">
    Please, take a few minutes to check out Dev4Press plugin for bbPress: <strong>GD Topic Prefix Pro</strong>:<br/>
    <blockquote>Implements topic prefixes system, with support for styling customization, forum specific prefix groups with use of user roles, default prefixes, filtering of topics by prefix and more.</blockquote>
    <a target="_blank" href="<?php echo $url; ?>" class="button-primary">Plugin Home Page</a>
    <a href="<?php echo gdbbx_admin()->current_url(false); ?>&action=dismiss-topic-prefix" class="button-secondary">Do not show this notice anymore</a>
</div>

    <?php
} else if (!d4p_has_plugin('gd-topic-polls') && gdbbx_settings()->get('notice_gdpol_hide', 'core') === false) {
    $web = parse_url(get_bloginfo('url'), PHP_URL_HOST);

    $url = 'https://plugins.dev4press.com/gd-topic-polls/';
    $url = add_query_arg('utm_source', $web, $url);
    $url = add_query_arg('utm_medium', 'plugin-gd-bbpress-toolbox', $url);
    $url = add_query_arg('utm_campaign', 'front-panel', $url);

    ?>

<div class="d4p-notice-info">
    Please, take a few minutes to check out Dev4Press plugin for bbPress: <strong>GD Topic Polls Pro</strong>:<br/>
    <blockquote>Implements topic prefixes system, with support for styling customization, forum specific prefix groups with use of user roles, default prefixes, filtering of topics by prefix and more.</blockquote>
    <a target="_blank" href="<?php echo $url; ?>" class="button-primary">Plugin Home Page</a>
    <a href="<?php echo gdbbx_admin()->current_url(false); ?>&action=dismiss-topic-polls" class="button-secondary">Do not show this notice anymore</a>
</div>

    <?php

}
