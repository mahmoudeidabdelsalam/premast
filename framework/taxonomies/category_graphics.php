<?php

// Register Custom Taxonomy
function graphics_categories() {

    $labels = array(
        'name' => 'graphics Categories',
        'singular_name' => 'graphics',
        'menu_name' => 'graphics Categories',
        'all_items' => 'All graphics Categories',
        'parent_item' => 'Parent graphics Category',
        'parent_item_colon' => 'Parent graphics Category:',
        'new_item_name' => 'New Item graphics Category',
        'add_new_item' => 'Add New graphics Category',
        'edit_item' => 'Edit graphics Category',
        'update_item' => 'Update graphics Category',
        'separate_items_with_commas' => 'Separate items with commas',
        'search_items' => 'Search graphics Categories',
        'add_or_remove_items' => 'Add or remove graphics Categories',
        'choose_from_most_used' => 'Choose from the most used graphics Categories',
        'not_found' => 'Not Found',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('graphics-category', array('graphics'), $args);
}

// Hook into the 'init' action
add_action('init', 'graphics_categories', 0);
