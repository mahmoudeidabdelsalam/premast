<?php

/* Get user info. */
global $current_user, $wp_roles;

$current_user = wp_get_current_user();
//get_currentuserinfo(); //deprecated since 3.1

/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
$error = array();

/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

  /* Update user password. */
  if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
    if ( $_POST['pass1'] == $_POST['pass2'] )
    wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
    else
    $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
  }

  /* Update user information. */
  if ( !empty( $_POST['url'] ) )
  wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
  if ( !empty( $_POST['email'] ) ){
    if (!is_email(esc_attr( $_POST['email'] )))
    $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
    elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
    $error[] = __('This email is already used by another user.  try a different one.', 'profile');
    else{
      wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
    }
  }

  if ( !empty( $_POST['first-name'] ) )
  update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
  if ( !empty( $_POST['last-name'] ) )
  update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
  if ( !empty( $_POST['description'] ) )
  update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );



  // ACF updates
  if ( !empty( $_POST['acf']['field_5a9ba9912563267c8b1'] ) )
  update_user_meta( $current_user->ID, 'owner_city', esc_attr( $_POST['acf']['field_5a9ba9963267c8b1'] ) );
  if ( !empty( $_POST['acf']['field_5a9fb97bf63963d5'] ) )
  update_user_meta( $current_user->ID, 'owner_phone', esc_attr( $_POST['acf']['field_5a9fb97bf63963d5'] ) );
  if ( !empty( $_POST['acf']['field_5a632631202544365aa'] ) )
  update_user_meta( $current_user->ID, 'owner_picture', esc_attr( $_POST['acf']['field_5a632631202544365aa'] ) );



  /* Redirect so the page will show updated info.*/
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
  if ( count($error) == 0 ) {
    //action hook for plugins and extra fields saving
    do_action('edit_user_profile_update', $current_user->ID);
    //do_action('edit_user_profile', $current_user->ID);
    wp_redirect( get_permalink() );
    //exit;
  }
}



function wooc_extra_register_fields() {
  ?>
    <p class="form-row form-row-first">
      <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
      <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
    <p class="form-row form-row-last">
      <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
      <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
    <div class="clear"></div>
  <?php
 }
 add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

/**
 * @snippet       WooCommerce User Registration Shortcode
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.6.2
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
// THIS WILL CREATE A NEW SHORTCODE: [wc_reg_form_bbloomer]
  
add_shortcode( 'wc_reg_form_bbloomer', 'bbloomer_separate_registration_form' );
    
function bbloomer_separate_registration_form() {
if ( is_admin() ) return;
ob_start();
if ( is_user_logged_in() ) {
   wc_add_notice( sprintf( __( 'You are currently logged in. If you wish to register with a different account please <a href="%s">log out</a> first', 'bbloomer' ), wc_logout_url() ) );
   wc_print_notices();
} else {
     
// NOTE: THE FOLLOWING <FORM> IS COPIED FROM woocommerce\templates\myaccount\form-login.php
// IF WOOCOMMERCE RELEASES AN UPDATE TO THAT TEMPLATE, YOU MUST CHANGE THIS ACCORDINGLY
?>
        
<form method="post" class="woocommerce-form woocommerce-form-register register" action="#registra" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
  
  <?php do_action( 'woocommerce_register_form_start' ); ?>

  <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
    <p>
      <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
      <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
    </p>
  <?php endif; ?>
    <p>
      <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
      <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
    </p>
  <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
    <p>
      <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
      <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
    </p>
  <?php endif; ?>
  <?php do_action( 'woocommerce_register_form' ); ?>
    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
    <button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
  <?php do_action( 'woocommerce_register_form_end' ); ?>
  </form>
<?php
    }
  return ob_get_clean();
}

