<?php
// Register Careers custom Post Type
function paddles_post_type() {
    $labels = array(
        'name' => __('Paddle', 'Post Type General Name', 'post-type'),
        'singular_name' => _x('Paddle', 'Post Type Singular Name', 'post-type'),
        'menu_name' => __('Paddle', 'post-type'),
        'parent_item_colon' => __('Parent Paddle:', 'post-type'),
        'all_items' => __('All', 'post-type'),
        'view_item' => __('View Paddle', 'post-type'),
        'add_new_item' => __('Add New Paddle', 'post-type'),
        'add_new' => __('Add New', 'post-type'),
        'edit_item' => __('Edit Paddle', 'post-type'),
        'update_item' => __('Update Paddle', 'post-type'),
        'search_items' => __('Search Paddle', 'post-type'),
        'not_found' => __('Not found', 'post-type'),
        'not_found_in_trash' => __('Not found in Trash', 'post-type'),
    );
    $args = array(
        'labels' => $labels,
        'supports' => array('title',),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-widgets-menus',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'show_in_rest' => true,
    );
    register_post_type('paddles', $args);
}

// Hook into the 'init' action
add_action('init', 'paddles_post_type', 0);

