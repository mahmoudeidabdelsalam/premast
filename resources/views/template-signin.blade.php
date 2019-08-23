{{--
  Template Name: Template Sign in
--}}

@extends('layouts.dark-app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="section-template">
      <div class="container">
        <div class="row">
        @if ( !is_user_logged_in() )
          <div class="col-md-5 col-12 row m-0 align-items-center"  style="background-image: linear-gradient(150deg, #56ecf2 0%, #4242e3 100%);">
            <div class="elementor-background-overlay" style="background-image: url('{{ the_field('header_section_image', 'option') }}');"></div>
            <div class="col-12 description">
              <h4 class="text-white title-description">{{ _e('Welcome Back to premast', 'premast') }}</h4>
              <p class="text-white text-description">{{ _e('Download your preferred design from huge collection of professionally, creative designed powerpoint templates for all your needs.', 'premast') }}</p>
            </div>
          </div>
          <div class="col-md-7 col-12">
            <div class="modal-header">
              <a class="navbar-brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name') }}">
                <img class="img-fluid" src="@if(get_field('website_logo', 'option')) {{ the_field('website_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/logo-en.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
                <span class="sr-only"> {{ get_bloginfo('name') }} </span>
              </a>
              <h5 class="modal-title" id="LoginUserLabel">{{ _e('Sign Into Your Account', 'premast') }}</h5>
            </div>
            <div class="modal-body">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="WP_login">
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
                  <span class="switch-link switch-to-lost" data-tab="lost_password">{{ _e('Lost your password?', 'premast') }}</span>
                </div>

                <div class="tab-pane fade" id="lost_password">
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
                    
                    <span class="switch-link switch-to-login" data-tab="WP_login">{{ _e('Sign in', 'premast') }}</span>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              {{ _e('Dont have an account?', 'premast') }} <a class="signup" href="{{ the_field('link_signup', 'option') }}">{{ _e('Sign Up', 'premast') }}</a>
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
                $('.tab-content .tab-pane').removeClass('show');
                $('.tab-content .tab-pane').removeClass('active');
                $("#"+tab_id).addClass('active');
                $("#"+tab_id).addClass('show');
              });

            });
          </script>
        @endif
        </div>
      </div>
    </section>
  @endwhile
@endsection
