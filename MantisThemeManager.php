<?php
/* Edited by Samunosuke to support Mantis 2.x */
class MantisThemeManagerPlugin extends MantisPlugin {

    function register() {
        $this->name        = 'MantisBT Theme Manager';
        $this->description = 'Manage themes in MantisBT.';

        $this->page = 'config';

        $this->version     = '0.0.2';
        $this->requires    = array(
                'MantisCore'       => '2.0.0',
        );
        
        $this->author      = 'Tim Pietrusky';
        $this->contact     = 'timpietrusky@googlemail.com';
        $this->url         = 'http://tim-pietrusky.de';
    }

    function hooks() {
        return array(
            'EVENT_CORE_READY' => 'loadTheme',
            'EVENT_LAYOUT_RESOURCES' => 'loadTheme',
        	'EVENT_LAYOUT_PAGE_FOOTER' => 'addStyleScript'
        );
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
     * Add custom code to the page which may be required to force style changes
     * @since 0.0.2
     */
    function addStyleScript( $p_event ) {
        $_script_include_file;

        $themes = getcwd() . "/css/themes/";
        $active_theme = plugin_config_get('active_theme');

        if (file_exists($themes . 'style.cs')) {
            $_script_include_file = "/mantis/css/themes/" . $active_theme . "/style.js";
            echo '<script type="text/javascript" src="'. $_script_include_file .'"> overrideStyles(); </script>';
        }
    }

    /**
     * Load the theme file
     */
    function loadTheme( $p_event ) {
        global $g_css_include_file;
				global $g_active_theme;
        $themes = getcwd() . "/css/themes/";
        $g_active_theme = plugin_config_get('active_theme');

        if (file_exists($themes . $active_theme)) {
            $g_css_include_file = "/css/themes/" . $g_active_theme . "/default.css";
        }
    }
}
