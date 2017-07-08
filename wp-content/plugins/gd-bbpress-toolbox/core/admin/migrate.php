<?php

if (!defined('ABSPATH')) exit;

function gdbbx_settings_migration() {
    // buddypress //
    if (isset(gdbbx_settings()->temp['bbpress']['disable_buddypress_profile_override'])) {
        gdbbx_settings()->set('disable_profile_override', gdbbx_settings()->temp['bbpress']['disable_buddypress_profile_override'], 'buddypress');
        gdbbx_settings()->set('disable_favorites_override', gdbbx_settings()->temp['bbpress']['disable_buddypress_favorites_override'], 'buddypress');
        gdbbx_settings()->set('disable_subscriptions_override', gdbbx_settings()->temp['bbpress']['disable_buddypress_subscriptions_override'], 'buddypress');

        gdbbx_settings()->save('buddypress');
    }
}
