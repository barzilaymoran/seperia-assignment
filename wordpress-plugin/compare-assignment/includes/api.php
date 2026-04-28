<?php
if (!defined('ABSPATH')) {
    exit;
}

define('CA_BASE_URL', 'https://dummyjson.com');
define('CA_PAGE_SIZE', 30);

function ca_get_products($search = '', $page = 1) {
    $skip = ($page - 1) * CA_PAGE_SIZE;

    if (!empty($search)) {
        $url = CA_BASE_URL . '/products/search';
    } else {
        $url = CA_BASE_URL . '/products';
    }

    $full_url = add_query_arg(array(
        'q'     => $search,
        'limit' => CA_PAGE_SIZE,
        'skip'  => $skip,
    ), $url);

    $response = wp_remote_get($full_url);

    if (is_wp_error($response)) {
        return array('error' => $response->get_error_message());
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    $total_pages = (int) ceil($data['total'] / CA_PAGE_SIZE);

    return array(
        'products'     => $data['products'],
        'total'        => $data['total'],
        'current_page' => $page,
        'total_pages'  => $total_pages,
        'search'       => $search,
    );
}

function ca_get_field($product, $field, $default = '') {
    return isset($product[$field]) ? $product[$field] : $default;
}