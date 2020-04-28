<?php
/**
 * Create admin Page to list unsubscribed emails.
 */
 // Hook for adding admin menus
 add_action('admin_menu', 'paddle_add_pages');
 
 // action function for above hook
 
/**
 * Adds a new top-level page to the administration menu.
 */
function paddle_add_pages() {
  add_menu_page( 'Paddle ship List', 'Paddle Log', 'manage_options', 'paddle-csutom', 'paddle_page_callback', '', 1 );
}