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

add_action('after_setup_theme', 'set_jakarta_timezone');

function set_jakarta_timezone()
{
    date_default_timezone_set('Asia/Jakarta');
}


// include plugin-options.php
require_once plugin_dir_path(__FILE__) . 'fmw-plugin-options.php';
require_once plugin_dir_path(__FILE__) . 'fmw-show-whatsapp.php';

function fmw_load_scripts()
{
    // load fontawesome from cdn
    wp_enqueue_style('fmw-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    wp_enqueue_style('fmw-style', plugin_dir_url(__FILE__) . 'fmw.css');
    wp_enqueue_script('fmw-script', plugin_dir_url(__FILE__) . 'fmw.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'fmw_load_scripts');

function fmw_load_admin_scripts()
{
    wp_enqueue_style('fmw-admin-style', plugin_dir_url(__FILE__) . 'fmw-admin.css');
}
add_action('admin_enqueue_scripts', 'fmw_load_admin_scripts');








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
