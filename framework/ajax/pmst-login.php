<?php

add_action('wp_ajax_nopriv_pmst_login', 'pmst_f_login');
add_action('wp_ajax_pmst_login', 'pmst_f_login');
add_action('wp_ajax_nopriv_pmst_signup', 'pmst_f_signup');
add_action('wp_ajax_pmst_signup', 'pmst_f_signup');

function pmst_f_login()
{
   $info = array();
   $info['user_login'] = $_POST['email'];
   $info['user_password'] = $_POST['password'];
   $info['remember'] = true;
   $user = get_user_by('email', $info['user_login']);
   if (!$user) {
      echo json_encode(array(
         'success' => false,
         'message' => 'User not found',
      ));
      die();
   }
   $user_pass = wp_check_password($info['user_password'], $user->data->user_pass, $user->ID);
   if (!$user_pass) {
      echo json_encode(array(
         'success' => false,
         'message' => 'Password is wrong',
      ));
      die();
   }
   $user_signon = wp_signon($info, false);
   if (!is_wp_error($user_signon)) {
      echo json_encode(array(
         'success' => true,
         'message' => 'Login successful',
      ));
      die();
   }
}


function pmst_f_signup()
{
   $info = array();
   $info['user_login'] = $_POST['email'];
   $info['user_email'] = $_POST['email'];
   $info['user_pass'] = $_POST['password'];
   $info['first_name'] = $_POST['name'];
   $info['last_name'] = $_POST['last_name'];
   $user = get_user_by('email', $info['user_login']);
   if ($user) {
      echo json_encode(array(
         'success' => false,
         'message' => 'User already exists',
      ));
      die();
   }
   $user_id = wp_insert_user($info);
   if (!is_wp_error($user_id)) {
      $user = get_user_by('email', $info['user_login']);
      // sign in this user
      wp_set_current_user($user_id);
      wp_set_auth_cookie($user_id);
      do_action('wp_login', $info['user_login'], $user);
      echo json_encode(array(
         'success' => true,
         'message' => 'Signup successful',
      ));
      die();
   }
}
