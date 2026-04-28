<?php
/**
 * Plugin Name: Compare Assignment
 * Description: Displays a product table from DummyJSON API
 * Version: 1.0
 * Author: Moran
 */

if (!defined('ABSPATH')) {
    exit;
}

define('CA_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CA_PLUGIN_URL', plugins_url('', __FILE__));

require_once CA_PLUGIN_DIR . 'includes/api.php';
require_once CA_PLUGIN_DIR . 'templates/table.php';

function ca_activate() {
    $page = array(
        'post_title'   => 'Compare Assignment',
        'post_content' => '[product_table]',
        'post_status'  => 'publish',
        'post_type'    => 'page',
    );

    $existing = get_page_by_title('Compare Assignment');
    if (!$existing) {
        wp_insert_post($page);
    }
}

register_activation_hook(__FILE__, 'ca_activate');


function ca_enqueue_assets() {
    wp_enqueue_style(
        'ca-style',
        CA_PLUGIN_URL . '/assets/style.css',
        array(),
        '1.0'
    );

    wp_enqueue_script(
        'ca-gallery',
        CA_PLUGIN_URL . '/assets/main.js',
        array(),
        '1.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'ca_enqueue_assets');

function ca_product_table_shortcode() {
    return ca_render_table();
}

add_shortcode('product_table', 'ca_product_table_shortcode');

