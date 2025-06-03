<?php

/*
Plugin Name: Advanced Custom Fields: JSON
Plugin URI: ttps://rozklad.dev
Description: JSON field for Advanced Custom Fields.
Version: 0.4.0
Author: rozklad
Author URI: ttps://rozklad.dev
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


add_action('plugins_loaded', function () {
    // Try to load composer autoloader first
    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        include __DIR__ . '/vendor/autoload.php';
    }

    // Initialize plugin after potential autoloader is loaded
    acf_field_type_json();
});

function acf_field_type_json() {
    // Check if the class exists (either from autoloader or already loaded)
    if (!class_exists('AcfFieldTypeJson\AcfPluginJson')) {
        // Manually include the class file
        if (file_exists(__DIR__ . '/src/AcfPluginJson.php')) {
            require_once __DIR__ . '/src/AcfPluginJson.php';
        } else {
            // Log error if class file doesn't exist
            error_log('ACF JSON Plugin Error: AcfPluginJson.php not found in src directory');
            return;
        }
    }

    // Instantiate the plugin class
    if (class_exists('AcfFieldTypeJson\AcfPluginJson')) {
        new AcfFieldTypeJson\AcfPluginJson();
    } else {
        error_log('ACF JSON Plugin Error: AcfPluginJson class could not be loaded');
    }
}
