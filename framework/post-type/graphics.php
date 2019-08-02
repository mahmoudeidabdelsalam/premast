<?php
// Register Careers custom Post Type
function graphics_post_type() {
    $labels = array(
        'name' => __('Graphics', 'Post Type General Name', 'post-type'),
        'singular_name' => _x('Graphics', 'Post Type Singular Name', 'post-type'),
        'menu_name' => __('Graphics', 'post-type'),
        'parent_item_colon' => __('Parent Graphics:', 'post-type'),
        'all_items' => __('All', 'post-type'),
        'view_item' => __('View Graphic', 'post-type'),
        'add_new_item' => __('Add New Graphic', 'post-type'),
        'add_new' => __('Add New', 'post-type'),
        'edit_item' => __('Edit Graphic', 'post-type'),
        'update_item' => __('Update Graphic', 'post-type'),
        'search_items' => __('Search Graphic', 'post-type'),
        'not_found' => __('Not found', 'post-type'),
        'not_found_in_trash' => __('Not found in Trash', 'post-type'),
    );
    $args = array(
        'labels' => $labels,
        'supports' => array('title','revisions','editor','thumbnail',),
        //'taxonomies' => array('category'),
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
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'show_in_rest' => true,


    );
    register_post_type('graphics', $args);
}

// Hook into the 'init' action
add_action('init', 'graphics_post_type', 0);


//register taxonomy for custom post tags
register_taxonomy( 
'graphics-tag', //taxonomy 
'graphics', //post-type
array( 
    'hierarchical'  => false, 
    'label'         => __( 'graphics Tags','taxonomy general name'), 
    'singular_name' => __( 'Tag', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true 
));