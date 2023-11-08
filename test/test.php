<?php

/**
 * Ensures that the module init file can't be accessed directly, only within the application.
 */
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Test Perfex CRM Module
Description: Test module description.
Version: 2.3.0
Requires at least: 2.3.*
*/


define('TEST_MODULE', 'test');
define('TEST_MODULE_VERSION', '2.3');

hooks()->add_action('admin_init', 'test_init_menu_items');
hooks()->add_action('customers_navigation_end', 'customers_navigation_test');

// hooks()->add_action('app_admin_head', 'test_load_css');
// hooks()->add_action('app_admin_footer', 'test_load_js');

register_activation_hook(TEST_MODULE, 'test_activation_hook');

function test_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

/**
 * Register language files, must be registered if the module is using languages
 */
register_language_files(TEST_MODULE, [TEST_MODULE]);


/**
 * Init backup module menu items in setup in admin_init hook
 * @return null
 */
function test_init_menu_items()
{
    /**
     * If the logged in user is administrator, add custom menu in Setup
     */
    if (is_admin()) {
        $CI = &get_instance();

        $CI->app_menu->add_sidebar_menu_item('test', [
            'name'     => 'Test Parent', // The name if the item
            'collapse' => true, // Indicates that this item will have submitems
            'position' => 10, // The menu position
            'icon'     => 'fa fa-home', // Font awesome icon
        ]);

        // The first paremeter is the parent menu ID/Slug
        $CI->app_menu->add_sidebar_children_item('test', [
            'slug'     => 'child-to-custom-menu-item2', // Required ID/slug UNIQUE for the child menu
            'name'     => 'Test Sub Menu', // The name if the item
            'href'     => admin_url('test'), // URL of the item
            'position' => 5, // The menu position
            'icon'     => 'fa fa-arrow-right', // Font awesome icon
        ]);
    }
}

function customers_navigation_test()
{
    echo '<li><a href="' . admin_url('test/test_client') . '">' . _l('test') . '</a></li>';
}
