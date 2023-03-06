<?php

/**
 * General wp-admin settings 
 */


/*
* SECTION add slug to page list   
*/
add_filter('manage_pages_columns', 'add_slug_column');
function add_slug_column($columns)
{
   $columns['slug'] = 'Slug';
   // change column width
   echo '<style type="text/css">.column-slug { 
      width: 10% !important;
      overflow: hidden !important;
    }</style>';
   return $columns;
}
add_action('manage_pages_custom_column', 'add_slug_value', 10, 2);
function add_slug_value($column_name, $post_id)
{
   if ('slug' === $column_name) {
      $post = get_post($post_id);
      $slug = $post->post_name;
      echo $slug;
   }
}

/**
 * SECTION display subapge under parent page
 */
add_filter('page_row_actions', 'add_subpage_link', 10, 2);
function add_subpage_link($actions, $post)
{
   if ($post->post_parent) {
      $parent = get_post($post->post_parent);
      $actions['parent'] = '<a href="' . get_edit_post_link($parent->ID) . '">' . __('Parent: ') . $parent->post_title . '</a>';
   }
   return $actions;
}
// show only parent page in page list filter option to show 
add_filter('page_attributes_dropdown_pages_args', 'show_only_parent_pages', 10, 1);
function show_only_parent_pages($dropdown_args)
{
   $dropdown_args['post_status'] = 'publish';
   $dropdown_args['post_type'] = 'page';
   return $dropdown_args;
}

// option to show subpages in page list 
add_filter('manage_pages_columns', 'add_subpage_column');
function add_subpage_column($columns)
{
   $columns['subpage'] = 'Subpage';
   return $columns;
}
add_action('manage_pages_custom_column', 'add_subpage_value', 10, 2);
function add_subpage_value($column_name, $post_id)
{
   if ('subpage' === $column_name) {
      $post = get_post($post_id);
      $subpage = get_pages(array(
         'child_of' => $post->ID,
         'parent' => $post->ID,
         'sort_column' => 'menu_order',
         'sort_order' => 'asc'
      ));
      if ($subpage) {
         $output = '<ul>';
         foreach ($subpage as $page) {
            $output .= '<a href="' . get_edit_post_link($page->ID) . '">' . $page->post_title . '</a><br>';
         }
         echo $output;
      }
   }
}
