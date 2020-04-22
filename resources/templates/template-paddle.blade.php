{{--
  Template Name: Paddle Template
--}}

@extends('layouts.app-dark')

@section('content')
  @while(have_posts()) @php the_post() @endphp

  @if ( !is_user_logged_in() )

  @php $login   = isset($_GET['login']) ? $_GET['login'] : '0'; @endphp


    <section class="section-template position-relative" style="background-image: linear-gradient(150deg, {{ the_field('gradient_color_one','option') }} 0%, {{ the_field('gradient_color_two','option') }} 100%);">
      <div class="elementor-background-overlay" style="background-image: url('{{ the_field('banner_background_overlay','option') }}');"></div>
      <div class="container">
        <div class="row justify-content-center">
        

        @if($login == 'failed')
          <h5 class="alert alert-danger col-12">The username and password you entered did not match our records. Please double-check and try again.</h5>
        @endif


          <div class="col-md-7 col-12 modal-show">
            <div class="show-header text-center">
              <a class="navbar-brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name') }}">
                <img class="img-fluid" src="@if(get_field('website_logo', 'option')) {{ the_field('website_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/logo-en.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
                <span class="sr-only"> {{ get_bloginfo('name') }} </span>
              </a>
              <br>
              <h5 class="modal-title" id="LoginUserLabel">{{ _e('One account for all our services', 'premast') }}</h5>

              <img class="img-fluid" src="{{ get_theme_file_uri().'/dist/images/logos.png' }}" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
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
                <div class="text-center">
                  {{ _e('Dont have an account?', 'premast') }} <a class="signup text-primary" href="{{ the_field('link_signup', 'option') }}">{{ _e('Sign Up', 'premast') }}</a>
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
                $('.tab-content .tab-pane').removeClass('show');
                $('.tab-content .tab-pane').removeClass('active');
                $("#"+tab_id).addClass('active');
                $("#"+tab_id).addClass('show');
              });

            });
          </script>
        
        </div>
      </div>
    </section>
@else 
  @php 
    global $current_user;
    wp_get_current_user();
  @endphp
  <section class="banner" style="background-image: linear-gradient(150deg, {{ the_field('gradient_color_one','option') }} 0%, {{ the_field('gradient_color_two','option') }} 100%);">
    <div class="elementor-background-overlay" style="background-image: url('{{ the_field('banner_background_overlay','option') }}');"></div>
    <div class="container">
      <div class="row align-items-center text-center justify-content-center">
        <div class="col-md-7 col-sm-12 col-12">
          <h2>{{ the_field('headline_paddle') }}</h2>
          <p>{{ the_field('content_paddle') }}</p>
        </div>
      </div>
    </div>
  </section>

  <div id="generic_price_table">
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="price-heading clearfix">
                <h1>{{ the_field('price_heading') }}</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
        <?php 
        if( have_rows('pricing_table') ): 
          while ( have_rows('pricing_table') ) : the_row();
          ?>
          <div class="col-md-4 p-0">
            <div class="generic_content clearfix <?= (get_row_index() == 2)? 'active':'' ; ?>">
              <div class="generic_head_price clearfix">
                <div class="generic_head_content clearfix">
                  <div class="head_bg"></div>
                  <div class="head">
                    <span><?= the_sub_field('head_price'); ?></span>
                  </div>
                </div>
                <div class="generic_price_tag clearfix">
                  <span class="price">
                    <span class="sign">$</span>
                    <span class="currency"><?= the_sub_field('tag_currency'); ?></span>
                    <span class="month">/<?= the_sub_field('tag_month'); ?></span>
                  </span>
                </div>
              </div>
              <div class="generic_feature_list">
                <ul>
                  <?php 
                  if( have_rows('feature_list') ): 
                    while ( have_rows('feature_list') ) : the_row();
                    ?>
                    <li><?= the_sub_field('heading_feature_list'); ?></li>
                  <?php
                    endwhile;
                  endif; 
                  ?>
                </ul>
              </div>
              <div class="generic_price_btn clearfix">
                <a href="#" class="paddle_button" data-product="<?= the_sub_field('id_plan_subscribe'); ?>" data-passthrough="<?= $current_user->ID; ?>">Subscribe</a>
              </div>
            </div>
          </div>
        <?php
          endwhile;
        endif; 
        ?>

          
        </div>
      </div>
    </section>
  </div>

  <style>
    body {
        background-color: rgba(61, 69, 82, 0.01);
    }

    #generic_price_table {
        background-color: rgba(61, 69, 82, 0.01);
    }

    /*PRICE COLOR CODE START*/
    #generic_price_table .generic_content {
        background-color: #fff;
        box-shadow: 0 0 3px 0 #ccc;
        border-radius: 10px;        
    }

    #generic_price_table .generic_content.active {
        box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.39);
        transform: scale3d(1.1, 1.1, 1.1);
    }

    #generic_price_table .generic_content:not(.active) {
        z-index: 1;
    }

    #generic_price_table .generic_content.active {
        z-index: 2;
        margin-bottom: 10px;
        position: relative;
        top: -20px;
    }

    #generic_price_table .generic_content .generic_head_price {
        background-color: #f6f6f6;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg {
        border-color: #e4e4e4 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #e4e4e4;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content .head span {
        color: #525252;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .sign {
        color: #414141;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .currency {
        color: #414141;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .cent {
        color: #414141;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .month {
        color: #414141;
    }

    #generic_price_table .generic_content .generic_feature_list ul li {
        color: #a7a7a7;
    }

    #generic_price_table .generic_content .generic_feature_list ul li span {
        color: #414141;
    }

    #generic_price_table .generic_content .generic_feature_list ul li:hover {
        background-color: #E4E4E4;
        border-left: 5px solid #1e6cfd;
    }

    #generic_price_table .generic_content .generic_price_btn a {
        border: 1px solid #2ECC71;
        color: #2ECC71;
    }

    #generic_price_table .generic_content.active .generic_head_price .generic_head_content .head_bg,
    #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg {
        border-color: #1d6dfa rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #1d6dfa;
        color: #fff;
    }

    #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head span,
    #generic_price_table .generic_content.active .generic_head_price .generic_head_content .head span {
        color: #fff;
    }

    #generic_price_table .generic_content:hover .generic_price_btn a,
    #generic_price_table .generic_content.active .generic_price_btn a {
        background-color: #1e6cfd;
        color: #fff;
    }

    #generic_price_table {
        margin: 50px 0 50px 0;
    }

    .row .table {
        padding: 28px 0;
    }

    #generic_price_table .generic_content {
        overflow: hidden;
        position: relative;
        text-align: center;
    }

    #generic_price_table .generic_content .generic_head_price {
        margin: 0 0 20px 0;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content {
        margin: 0 0 50px 0;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg {
        border-style: solid;
        border-width: 90px 1411px 23px 399px;
        position: absolute;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content .head {
        padding-top: 40px;
        position: relative;
        z-index: 1;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content .head span {
        font-size: 28px;
        font-weight: 400;
        letter-spacing: 2px;
        margin: 0;
        padding: 0;
        text-transform: uppercase;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag {
        padding: 0 0 20px;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price {
        display: block;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .sign {
        display: inline-block;
        font-size: 28px;
        font-weight: 400;
        vertical-align: middle;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .currency {
        font-size: 60px;
        font-weight: 300;
        letter-spacing: -2px;
        line-height: 60px;
        padding: 0;
        vertical-align: middle;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .cent {
        display: inline-block;
        font-size: 24px;
        font-weight: 400;
        vertical-align: bottom;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .month {
        font-size: 18px;
        font-weight: 400;
        letter-spacing: 3px;
        vertical-align: bottom;
    }

    #generic_price_table .generic_content .generic_feature_list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #generic_price_table .generic_content .generic_feature_list ul li {
        font-size: 18px;
        padding: 15px 0;
        transition: all 0.3s ease-in-out 0s;
        text-align: left;
        padding-left: 25px;
    }

    #generic_price_table .generic_content .generic_feature_list ul li:hover {
        transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        -ms-transition: all 0.3s ease-in-out 0s;
        -o-transition: all 0.3s ease-in-out 0s;
        -webkit-transition: all 0.3s ease-in-out 0s;

    }

    #generic_price_table .generic_content .generic_feature_list ul li .fa {
        padding: 0 10px;
    }

    #generic_price_table .generic_content .generic_price_btn {
        margin: 20px 0 32px;
    }

    #generic_price_table .generic_content .generic_price_btn a {
        border-radius: 50px;
        display: inline-block;
        font-size: 18px;
        outline: medium none;
        padding: 12px 30px;
        text-decoration: none;
        text-transform: uppercase;
    }

    #generic_price_table .generic_content,
    #generic_price_table .generic_content:hover,
    #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg,
    #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg,
    #generic_price_table .generic_content .generic_head_price .generic_head_content .head h2,
    #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head h2,
    #generic_price_table .generic_content .price,
    #generic_price_table .generic_content:hover .price,
    #generic_price_table .generic_content .generic_price_btn a,
    #generic_price_table .generic_content:hover .generic_price_btn a {
        transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        -ms-transition: all 0.3s ease-in-out 0s;
        -o-transition: all 0.3s ease-in-out 0s;
        -webkit-transition: all 0.3s ease-in-out 0s;
    }

    @media (max-width: 320px) {}

    @media (max-width: 767px) {
        #generic_price_table .generic_content {
            margin-bottom: 75px;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        #generic_price_table .col-md-3 {
            float: left;
            width: 50%;
        }

        #generic_price_table .col-md-4 {
            float: left;
            width: 50%;
        }

        #generic_price_table .generic_content {
            margin-bottom: 75px;
        }
    }

    @media (min-width: 992px) and (max-width: 1199px) {}

    @media (min-width: 1200px) {}

    .text-center h1,
    .text-center h1 a {
        color: #7885CB;
        font-size: 30px;
        font-weight: 300;
        text-decoration: none;
    }

    .demo-pic {
        margin: 0 auto;
    }

    .demo-pic:hover {
        opacity: 0.7;
    }

    #generic_price_table_home ul {
        margin: 0 auto;
        padding: 0;
        list-style: none;
        display: table;
    }

    #generic_price_table_home li {
        float: left;
    }

    #generic_price_table_home li+li {
        margin-left: 10px;
        padding-bottom: 10px;
    }

    #generic_price_table_home li a {
        display: block;
        width: 50px;
        height: 50px;
        font-size: 0px;
    }

    #generic_price_table_home .blue {
        background: #3498DB;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .emerald {
        background: #1e6cfd;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .grey {
        background: #7F8C8D;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .midnight {
        background: #34495E;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .orange {
        background: #E67E22;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .purple {
        background: #9B59B6;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .red {
        background: #E74C3C;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .turquoise {
        background: #1ABC9C;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .blue:hover,
    #generic_price_table_home .emerald:hover,
    #generic_price_table_home .grey:hover,
    #generic_price_table_home .midnight:hover,
    #generic_price_table_home .orange:hover,
    #generic_price_table_home .purple:hover,
    #generic_price_table_home .red:hover,
    #generic_price_table_home .turquoise:hover {
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
        border-top-left-radius: 50px;
        border-top-right-radius: 50px;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .divider {
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        padding: 20px;
    }

    #generic_price_table_home .divider span {
        width: 100%;
        display: table;
        height: 2px;
        background: #ddd;
        margin: 50px auto;
        line-height: 2px;
    }

    #generic_price_table_home .itemname {
        text-align: center;
        font-size: 50px;
        padding: 50px 0 20px;
        border-bottom: 1px solid #ddd;
        margin-bottom: 40px;
        text-decoration: none;
        font-weight: 300;
    }

    #generic_price_table_home .itemnametext {
        text-align: center;
        font-size: 20px;
        padding-top: 5px;
        text-transform: uppercase;
        display: inline-block;
    }

    #generic_price_table_home .footer {
        padding: 40px 0;
    }

    .price-heading {
        text-align: center;
        margin-bottom: 70px;        
    }

    .price-heading h1 {
        color: #666;
        margin: 0;
        padding: 0 0 50px 0;
    }

    .demo-button {
        background-color: #333333;
        color: #ffffff;
        display: table;
        font-size: 20px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 20px;
        margin-bottom: 50px;
        outline-color: -moz-use-text-color;
        outline-style: none;
        outline-width: medium;
        padding: 10px;
        text-align: center;
        text-transform: uppercase;
    }

    .bottom_btn {
        background-color: #333333;
        color: #ffffff;
        display: table;
        font-size: 28px;
        margin: 60px auto 20px;
        padding: 10px 25px;
        text-align: center;
        text-transform: uppercase;
    }

    .demo-button:hover {
        background-color: #666;
        color: #FFF;
        text-decoration: none;

    }

    .bottom_btn:hover {
        background-color: #666;
        color: #FFF;
        text-decoration: none;
    }

  </style>
 @endif
  @endwhile
@endsection