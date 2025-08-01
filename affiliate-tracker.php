<?php
/*
Plugin Name: Affiliate Tracker
Plugin URI: https://example.com/
Description: Track affiliate links coming from Pretty Link plugin.
Version: 1.0
Author: Your Name
Author URI: https://example.com/
License: GPL2
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Include the admin page for the plugin
require_once plugin_dir_path(__FILE__) . 'includes/admin-page.php';
require_once plugin_dir_path(__FILE__) . 'includes/settings-page.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode-template.php';


// Add the Affiliate Tracker menu and Settings submenu to the WordPress admin sidebar
add_action('admin_menu', 'affiliate_tracker_add_admin_menu');

/**
 * Register the Affiliate Tracker top-level menu and Settings submenu
 */
function affiliate_tracker_add_admin_menu() {
    add_menu_page(
        'Affiliate Tracker', // Page title
        'Affiliate Tracker', // Menu title
        'manage_options',    // Capability required
        'affiliate-tracker', // Menu slug
        'affiliate_tracker_options_page', // Callback to display the page
        'dashicons-chart-line', // Menu icon
        2 // Position (top-level)
    );

    add_submenu_page(
        'affiliate-tracker', // Parent slug
        'Settings',          // Page title
        'Settings',          // Submenu title
        'manage_options',    // Capability
        'affiliate-tracker-settings', // Menu slug
        'affiliate_tracker_settings_page' // Callback function
    );

    add_submenu_page(
        'affiliate-tracker', // Parent slug
        'Casino Info',       // Page title
        'Casino Info',       // Submenu title
        'manage_options',    // Capability
        'affiliate-tracker-casino-info', // Menu slug
        'affiliate_tracker_casino_info_page' // Callback function
    );
}


/**
 * Register plugin settings and sections for the options page
 */
add_action('admin_init', 'affiliate_tracker_settings_init');
function affiliate_tracker_settings_init() {
    // Register a sample setting for demonstration
    register_setting('affiliate_tracker_options_group', 'affiliate_tracker_text');
    // Add a main section to the options page (currently unused)
    add_settings_section(
        'affiliate_tracker_main_section',
        '',
        null,
        'affiliate-tracker'
    );
}
add_action('admin_init', function() {
    register_setting('affiliate_tracker_options_group', 'affiliate_tracker_casino_cpt');
});



/**
 * Handle saving custom values for each affiliate link
 * This runs on every POST request to the admin page
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    global $wpdb;
    // Get all affiliate link IDs from Pretty Link table
    $links = $wpdb->get_results("SELECT id FROM {$wpdb->prefix}prli_links");
    if ($links) {
        foreach ($links as $link) {
            $field = 'affiliate_tracker_custom_' . $link->id;
            // If a custom value was submitted for this link, save it as an option
            if (isset($_POST[$field])) {
                update_option($field, sanitize_text_field($_POST[$field]));
            }
        }
    }
}

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        $casino_cpt = get_option('affiliate_tracker_casino_cpt', '');
        if (!empty($casino_cpt)) {
            $posts = get_posts(array(
                'post_type' => $casino_cpt,
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'fields' => 'ids'
            ));
            if ($posts) {
                foreach ($posts as $post_id) {
                    $field = 'affiliate_tracker_custom_title_' . $post_id;
                    if (isset($_POST[$field])) {
                        update_option($field, sanitize_text_field($_POST[$field]));
                    }
                }
            }
        }
    }