<?php

add_action( 'init', 'process_user_roles' );

function process_user_roles(){
  global $wp_roles;

  if( is_admin() && !empty( $_GET['page'] ) && $_GET['page'] == 'activate_roles') {
     $current_user = wp_get_current_user();
     $roles = $current_user->roles;
     if(!in_array('administrator', $roles)) return;

      $roles = ['administrator'];
      foreach ($roles as $role) {
          $role = get_role($role);
      }

      remove_role('wcfm_vendor');
      remove_role('disable_vendor');
      remove_role('vendor_staff');
      remove_role('wpseo_editor');
      remove_role('wpseo_manager');
      remove_role('suspended');
      remove_role('pending_user');
      remove_role('css_js_designer');
      remove_role('project_client');
      remove_role('project_collaborator');
      remove_role('project_editor');
      remove_role('project_admin');
      remove_role('shop_worker');
      remove_role('shop_accountant');
      remove_role('manage_schema_options');
      remove_role('seller');
      remove_role('shop_vendor');
      remove_role('shop_manager');


     /************************* products **************************/
     remove_role('vendor');
     add_role('vendor', __('Vendor','premast'), []);
     $roles = ['vendor', 'administrator'];
     foreach ($roles as $role) {
        $role = get_role($role);
        $role->add_cap('read');
        $role->add_cap( 'manage_woocommerce_products' );
        $role->add_cap( 'manage_woocommerce_taxonomies' );
        $role->add_cap( 'manage_woocommerce_orders' );
        $role->add_cap( 'manage_woocommerce_coupons' );
        $role->add_cap( 'edit_product' );
        $role->add_cap( 'read_product' );
        $role->add_cap( 'delete_product' );
        $role->add_cap( 'edit_products' );
        $role->add_cap( 'publish_products' );
        $role->add_cap( 'read_private_products' );
        $role->add_cap( 'delete_products' );
        $role->add_cap( 'delete_private_products' );
        $role->add_cap( 'delete_published_products' );
        $role->add_cap( 'edit_private_products' );
        $role->add_cap( 'edit_published_products' );
        $role->add_cap( 'edit_products' );
        $role->add_cap( 'manage_woocommerce_taxonomies' );
        $role->add_cap( 'manage_woocommerce_orders' );
        $role->add_cap( 'manage_woocommerce' );
        $role->add_cap( 'view_woocommerce_reports' );
        $role->add_cap( 'manage_product_terms' );
        $role->add_cap( 'edit_product_terms' );
        $role->add_cap( 'delete_product_terms' );
        $role->add_cap( 'assign_product_terms' );
        $role->add_cap( 'manage_categories' );
      }

      // Assign the Pages post type and Media to all roles
      $roles = $wp_roles->role_names;
      foreach ($roles as $role => $role_name) {
        $role = get_role($role);
        $role->add_cap('edit_others_pages');
        $role->add_cap('edit_pages');
        $role->add_cap('edit_private_pages');
        $role->add_cap('edit_published_pages');
        $role->add_cap('publish_pages');
        $role->add_cap('read_private_pages');
        $role->add_cap('upload_files');
      }

      $role = get_role( 'author' );
      // This only works, because it accesses the class instance.
      // would allow the author to edit others' posts for current theme only
      $role->add_cap( 'manage_categories' ); 

    echo "Roles Proceed Succesfully";
    die();
    return;
  }
}


$user = wp_get_current_user();
$allowed_roles = array('vendor');
if( array_intersect($allowed_roles, $user->roles ) ) {  
  function remove_menus() {
    remove_menu_page( 'index.php' );                  //Dashboard                 //Jetpack* 
    remove_menu_page( 'edit.php' );                   //Posts
    remove_menu_page( 'upload.php' );                 //Media
    remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page( 'edit-comments.php' );          //Comments
    remove_menu_page( 'themes.php' );                 //Appearance
    remove_menu_page( 'plugins.php' );                //Plugins
    remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Tools
    remove_menu_page( 'options-general.php' );        //Settings
    remove_menu_page( 'edit-tags.php?taxonomy=category' );        //Settings
    remove_menu_page( 'edit-tags.php?taxonomy=post_tag' );        //Settings
    remove_menu_page('woocommerce');  
  }
  add_action( 'admin_menu', 'remove_menus' );
 }
