<?php
// setup ajax 
add_action('wp_ajax_nopriv_get_data', 'pmst_get_header_data');
add_action('wp_ajax_get_data', 'pmst_get_header_data');
function pmst_test_issue()
{
   $data = array(
      'test' => 'test'
   );
   return ($data);
}
function pmst_get_header_data()
{

   // get current user data 
   $current_user = wp_get_current_user();
   $logo = get_field('templates_logo', 'option');
   $user_is_login = is_user_logged_in();

   if ($user_is_login) {
      $data = array(
         'user_name' => get_the_author_meta('display_name', get_current_user_id()),
         'user_id' => get_current_user_id(),
         'logo' => $logo,
         'user_login' => $user_is_login,
         'user_avatar' => getUserAvatar(),
         'nav' => pmst_get_nav(),
         'user_menu' => pmst_get_nav_user_dropdown(),
         'logout' => esc_html(wp_logout_url(home_url())),
         'premium' => getUserMembership() ? true : false,
         'upgrade_link' => get_field('link_pricing', 'option'),
      );
   } else {
      $data = array(
         'user_name' => 'Guest',
         'logo' => $logo,
         'user_login' => $user_is_login,
         'nav' => pmst_get_nav(),
         'upgrade_link' => get_field('link_pricing', 'option'),
      );
   }


   // echo json_encode($data);
   return ($data);
   die();
}
function pmst_get_nav()
{
   $nav = wp_get_nav_menu_items(4628);
   $navData = array();
   foreach ($nav as $item) {
      $navData[] = array(
         'name' => $item->title,
         'link' => $item->url,
         'children' => $item->children,
      );
   }
   return $navData;
}

function pmst_get_nav_user_dropdown()
{
   $limit_membership = wc_memberships_get_user_active_memberships(wp_get_current_user()->ID);
   $user_roles = wp_get_current_user()->roles;
   $user_is_admin = in_array('administrator', $user_roles);
   $user_is_vendor = in_array('vendor', $user_roles);

   $nav = [];
   $nav[] = array(
      'name' => 'My Profile',
      'link' => get_field('admin_dashborad_page', 'option'),
   );
   $nav[] = array(
      'name' => 'My Downloads',
      'link' => get_field('download_page', 'option'),
   );
   if ($limit_membership) {
      $nav[] = array(
         'name' => 'My Subscription',
         'link' => get_field('link_subscription', 'option'),
      );
   }
   $nav[] = array(
      'name' => 'My Favourite',
      'link' => get_field('link_like_page', 'option'),
   );
   if ($user_is_admin || $user_is_vendor) {
      $nav[] = array(
         'name' => 'Dashboard',
         'link' => get_author_posts_url(wp_get_current_user()->ID) . '?dashboard=true',
      );
      $nav[] = array(
         'name' => 'My Products',
         'link' => get_author_posts_url(wp_get_current_user()->ID) . '?items=true',
      );
      $nav[] = array(
         'name' => 'Add item',
         'link' => get_field('link_add_new', 'option'),
      );
   }
   $nav[] = array(
      'name' => 'Help Center',
      'link' => 'https://premast.com/help-center/',
   );
   return $nav;
}
