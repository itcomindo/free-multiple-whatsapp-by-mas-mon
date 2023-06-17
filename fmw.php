<?php
defined('ABSPATH') || exit;

/**
 *=========================
 *Plugin Name: Free Multiple Whatsapp By Mas Mon
 *Plugin URI: https://wp.budiharyono.com
 *Description: Free Multiple Whatsapp By Mas Mon
 *Version: 1.0
 *Author: Budi Haryono
 *Author URI: https://budiharyono.com
 *=========================
 */


// First, check if the function 'carbon_fields_boot_plugin' exists
// if (!function_exists('carbon_fields_boot_plugin')) {
//     // If the function does not exist, display an error message and deactivate the plugin
//     add_action('admin_notices', 'my_plugin_activation_error');

//     function my_plugin_activation_error()
//     {
//         echo '<div class="error"><p>You need to install and Activate the Carbon Fields Plugins First</p></div>';
//         deactivate_plugins(plugin_basename(__FILE__));
//     }
// }

// kode diatas working //////////////

// Add hook to handle plugin activation
// add_action('plugins_loaded', 'fmw_plugin_loaded');

// function fmw_plugin_loaded()
// {
//     // Check if Carbon Fields plugin is active
//     if (!function_exists('carbon_fields_boot_plugin')) {
//         // If Carbon Fields is not active, deactivate your plugin
//         add_action('admin_init', 'fmw_deactivate_plugin');
//     }
// }

// function fmw_deactivate_plugin()
// {
//     // Deactivate your plugin
//     deactivate_plugins(plugin_basename(__FILE__));
// }


// kode diatas working //////////////

// Add hook to handle plugin activation
add_action('plugins_loaded', 'fmw_plugin_loaded');

function fmw_plugin_loaded()
{
    // Check if Carbon Fields plugin is active
    if (!function_exists('carbon_fields_boot_plugin')) {
        // If Carbon Fields is not active, deactivate your plugin and display an error message
        add_action('admin_notices', 'fmw_plugin_activation_error');
        add_action('admin_init', 'fmw_deactivate_plugin');
    }
}

function fmw_plugin_activation_error()
{
    echo '<div class="error"><p>You need to install and activate the Carbon Fields plugin first.</p></div>';
}

function fmw_deactivate_plugin()
{
    // Deactivate your plugin
    deactivate_plugins(plugin_basename(__FILE__));
}

// Add hook to handle Carbon Fields deactivation
add_action('admin_init', 'fmw_check_carbon_fields_deactivation');

function fmw_check_carbon_fields_deactivation()
{
    // Check if Carbon Fields plugin is active
    if (!function_exists('carbon_fields_boot_plugin')) {
        // If Carbon Fields is deactivated, deactivate your plugin
        deactivate_plugins(plugin_basename(__FILE__));
    }
}
