{{--
  Template Name: Sign in
--}}

@extends('layouts.app-dark')

@section('content')
  @while(have_posts()) @php the_post() @endphp



@php $login   = isset($_GET['login']) ? $_GET['login'] : '0'; @endphp

@if ( !is_user_logged_in() )




<div class="container mt-md-5 pt-md-5">
  <div class="row">
    @if($login == 'failed')
      <h5 class="alert alert-danger col-12 text-center">The username and password you entered did not match our records. Please double-check and try again.</h5>
    @endif
  </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-left">
      <div class="col-md-5 p-0">
        <div class="background-img">
          <div class="WelcomeText">
            <h2 class="HeadLineWelcome text-left">Welcome Back to Premast</h2>
            <h5 class="SubHeadLineWelcome text-left">Download your preferred design from huge collection <br>of professionally, creative designed powerpoint <br> templates for all your needs.</h5>
          </div>
        </div>
      </div>


      <div class="col-md-7 " style="padding:5.5rem;">
        <h2 class="access">Access your account</h2>
        <div class="sign-in">
          <div class="formLogin tab-switch active " id="LoginForm">
            @php
                $args = array(
                'echo'           => true,
                'remember'       => true,
                'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
                'form_id'        => 'loginform',
                'id_username'    => 'user_login',
                'id_password'    => 'user_pass',
                'id_submit'      => 'wp-submit',
                'label_username' => __( 'Email' ),
                'label_password' => __( 'Password' ),
                'label_log_in'   => __( 'Sign in' ),
                'value_username' => '',
                'value_remember' => false
                );
            @endphp

            {{ wp_login_form($args) }}

            <a href="#" class="switch-link" data-tab="LostPassword">Lost your password?</a>
          </div>

          <div class="formLogin tab-switch" id="LostPassword">
            <?php
            defined( 'ABSPATH' ) || exit;
            do_action( 'woocommerce_before_lost_password_form' );
            ?>
            <form method="post" class="woocommerce-ResetPassword lost_reset_password">
              <p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
              <p class="woocommerce-form-row woocommerce-form-row--first form-row">
                <label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
              </p>
              <div class="clear"></div>
              <?php do_action( 'woocommerce_lostpassword_form' ); ?>
              <p class="woocommerce-form-row form-row">
                <input type="hidden" name="wc_reset_password" value="true" />
                <button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
              </p>
              <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
            </form>
            <?php do_action( 'woocommerce_after_lost_password_form' ); ?>

            <a href="#" class="switch-link" data-tab="LoginForm" style="display:none;">Login</a>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
    jQuery(function($) {
      // placeholder Login
      $('input#user_login').attr('placeholder', 'Email');
      $('input#user_pass').attr('placeholder', 'Password');

      // Tabs Custom
      $('.switch-link').click(function(){
        var tab_id = $(this).attr('data-tab');
        $('.tab-switch').removeClass('active');
        $("#"+tab_id).addClass('active');
      });

    });
  </script>
@endif




  @endwhile
@endsection


<style>
.background-img {
    height: 100%;
    width: auto;
    background-repeat: no-repeat;
    background-size: cover;
}

h2.HeadLineWelcome {
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 30px;
    line-height: 36px;
    color: #F9FAFB;
}

h5.SubHeadLineWelcome {
    font-family: 'Roboto'sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 24px;
    letter-spacing: 0.04px;
    color: #FFFFFF;
    text-align: center;
    align-items: center;

}

.WelcomeText {
  display: flex;
      padding-left: 20%;
  justify-content: center;
  flex-flow: column;
  height: 100%;
}

h2.access {
    font-family: 'Roboto';
    font-style: normal;
    font-weight: bold;
    font-size: 30px;
    line-height: 36px;
    color: #282F39;
    opacity: 0.82;
}

.sign-in {
    padding-top: 30px;
}

.form-control {
    border-radius: 8px !important;
    background: #FFFFFF;
    border: 1px solid #E3E3E3 !important;
    box-sizing: border-box;
    padding: 1.2rem .95rem !important;

}

label {
    font-family: 'Roboto'sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 21px;
    align-items: center;
    letter-spacing: 0.04px;
    color: #646464;
}

small#forgotpassword {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 21px;
    text-align: right;
    letter-spacing: 0.04px;
    color: #1E6DFB !important;
    opacity: 0.88;
    padding-top: 15px;
}

.btn.btn-primary {
    background: linear-gradient(134.71deg, #6B73FF -0.5%, #000DFF 100%);
    border-radius: 30px;
    padding: 8px 100px 8px 100px;
    border-color: none !important;
    margin-top: 15px;
}
.btn.btn-primary:hover {
    background: linear-gradient(134.71deg, #000DFF -0.5%, #6B73FF 100%)!important;
    opacity: .65;
}
.btn.btn-outline-dark {
    padding: 8px 60px 8px 60px;
    border-radius: 30px;
    margin: 15px 0px 0px 15px;
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 19px;
    letter-spacing: 0.116946px;
    text-transform: capitalize;
    color: #3F4A59;
}
.btn.btn-outline-dark:hover {
    color: #FFFFFF;
}

.btn.btn-outline-dark::before {
    font-family: 'fontawesome';
    font-weight: 500;
    content: "\f1a0";
    padding-right: 7px;
    font-size: 16px;
}

.tab-switch {
  display: none;
}

.tab-switch.active {
    display: block;
}
input#user_pass {
    width: 100%;
    height: 44px;
    background: #FFFFFF;
    border: 1px solid #E3E3E3;
    box-sizing: border-box;
    border-radius: 8px;
    padding: 10px;
}
input#user_login {
    width: 100%;
    height: 44px;
    border: 1px solid #E3E3E3;
    background: #ffffff;
    box-sizing: border-box;
    border-radius: 8px;
    padding: 10px;
    }
    input#wp-submit {
    background: linear-gradient(134.71deg, #6B73FF -0.5%, #000DFF 100%);border-radius: 30px;border: none;padding: 6px 97px 6px 97px;
    color:#ffffff;
    font-family: 'Roboto' , sans-serif;
    }
    input#wp-submit:hover {
    background: linear-gradient(134.71deg, #000DFF 100%,#6B73FF -0.5%,);
    opacity:0.95;
    }
    div#nsl-custom-login-form-1 {
    position: absolute;
    bottom: -9px;
    right: 145px;
   }

   form#loginform {
    position: relative;
   }
   a.switch-link {
    right: 93px;
    position: absolute;
    bottom: 170px;
    color: #1E6DFB;
    opacity: 0.88;
}
   @media only screen and (max-width: 600px) {
  a.btn.btn-outline-dark {
        padding: 8px;
        width: 100%;
        margin: 15px 0px 0px 0px;
    }

    a.btn.btn-primary {
        padding: 8px;
        width: 100%;
    }
    div#nsl-custom-login-form-1 {
      position: absolute;
      bottom: -60px;
      right: -23px;
}
a.switch-link {
    right: 92px;
    position: absolute;
    bottom: 190px;
    color: #1E6DFB;
    opacity: 0.88;
    font-size: 14px;


    }
    p.login-remember {
    padding-top: 17px;
   }
}
button.woocommerce-Button.button {
    background: linear-gradient(134.71deg, #6B73FF -0.5%, #000DFF 100%);
    border-radius: 30px;
    border: none;
    width: width;
    width: 100%;
    heigth: 251px;
    height: auto;
    padding: 10px 0 10px 0;
    color: #ffffff;
    align-items: center;
    text-align: center;
}


p.woocommerce-form-row.form-row {
    padding-top: 14px;
}



</style>
