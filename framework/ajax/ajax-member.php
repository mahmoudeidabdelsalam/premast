<?php 
// ajax function change status user membership gift
function membership_gift() {

  $active_id = $_POST['post_id'];

  $end_date = date('Y-m-d H:i:s', strtotime('+1 months'));
  $start_date = date('Y-m-d H:i:s');

  if($active_id) {
    wp_update_post(array(
      'ID'    =>  $active_id,
      'post_type' => 'wc_user_membership',
      'post_status'   =>  'wcm-active',
    ));

    update_post_meta($active_id, '_end_date', $end_date);
    update_post_meta($active_id, '_start_date', $start_date);
    do_action('wp_update_post', 'wp_update_post');
  }
}
add_action('wp_ajax_get_active', 'membership_gift');
add_action('wp_ajax_nopriv_get_active', 'membership_gift');