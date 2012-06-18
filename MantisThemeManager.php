<?php

class MantisThemeManagerPlugin extends MantisPlugin {

    function register() {
        $this->name        = 'MantisBT Theme Manager';
        $this->description = 'Manage themes in MantisBT.';

        $this->page = 'config';

        $this->version     = '0.0.1';
        $this->requires    = array(
                'MantisCore'       => '1.2.0',
        );

        $this->author      = 'Tim Pietrusky';
        $this->contact     = 'timpietrusky@googlemail.com';
        $this->url         = 'http://tim-pietrusky.de';
    }

    function init() {
        plugin_event_hook('EVENT_CORE_READY', 'loadTheme');
    }

    /**
     * Configuration.
     *
     * @return array
     */
    function config() {
        return array (
            'active_theme' => 'default'
        );
    }

    /**
     * Load the theme file
     */
    function loadTheme() {
        global $g_css_include_file;

        $themes = getcwd() . "/css/themes/";
        $active_theme = plugin_config_get('active_theme');

        if (file_exists($themes . $active_theme)) {
            $g_css_include_file = "/css/themes/" . $active_theme . "/default.css";
        }
    }
}
