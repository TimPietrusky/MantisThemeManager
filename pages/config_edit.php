<?php

auth_reauthenticate();
access_ensure_global_level(config_get('manage_plugin_threshold'));

$string = gpc_get_string('active_theme');

if (!empty($string)) {
    plugin_config_set('active_theme', $string);
}

print_successful_redirect(plugin_page('config', true));

