<footer class="content-info bg-gray-dark">
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col-md-9 col-sm-12 col-12">
        <div class="navbar-footer">
          <h3 class="sr-only">{{ _e('Footer navigation', 'premast') }}</h3>
          @if (has_nav_menu('footer_navigation'))
            {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'container' => false, 'menu_class' => 'navbar', 'walker' => new NavWalker()]) !!}
          @endif
        </div>
      </div>
      <div class="col-md-3 col-sm-12 col-12 p-0">
        @if(is_home() || is_front_page())
          <a class="navbar-brand mt-2 mb-4" href="{{ home_url('/') }}" title="{{ get_bloginfo('name') }}">
            <img class="img-fluid" src="@if(get_field('website_logo', 'option')) {{ the_field('website_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/logo-en.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
            <span class="sr-only"> {{ get_bloginfo('name') }} </span>
          </a>
        @else
          <a class="navbar-brand mt-2 mb-4" href="{{ home_url('/') }}" title="{{ get_bloginfo('name') }}">
            <img class="img-fluid" src="@if(get_field('website_logo_light', 'option')) {{ the_field('website_logo_light','option') }} @else {{ get_theme_file_uri().'/dist/images/logo-en.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
            <span class="sr-only"> {{ get_bloginfo('name') }} </span>
          </a>
        @endif
        <div class="more-informtion">
          <div class="mores">{{ show_number_of_downloads() }}</div>
          <div class="mores"><p><strong>{{ show_number_users() }} </strong> {{ _e('Registered user', 'premast') }}</p></div>
        </div>
        <div class="footer-secure"><span class="footer-secure-payment">{{ _e('Secure Payment by', 'permast') }}</span> <img src="{{ get_theme_file_uri().'/dist/images/2checkout-2.png' }}" alt="2Checkout"></div>
      </div>
    </div>
  </div>
</footer>


<section class="copyright">
  <h3 class="sr-only">{{ _e('Copyright © 2018 Premast-powerpoint design solutions. All rights reserved.', 'premast') }}</h3>
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-md-5 col-12">
        @if (has_nav_menu('copyright_navigation'))
          {!! wp_nav_menu(['theme_location' => 'copyright_navigation', 'container' => false, 'menu_class' => 'copyright', 'walker' => new NavWalker()]) !!}
        @endif
      </div>
      <div class="col-md-4 text-left">
        {{ _e('© 2020 Premast Company. All rights reserved.', 'premast') }}
      </div>
      <div class="col-md-3 col-12">
        @if( have_rows('social_networks', 'option') )
          <ul class="list-inline text-right m-0 social-btns">
            <li class="head">{{ _e('Follow Us', 'premast') }}</li>
            @while ( have_rows('social_networks', 'option') ) @php the_row(); @endphp
              <li class="list-inline-item"><a class="network" href="{{ the_sub_field('network_link', 'option') }}"><i class="fa {{ the_sub_field('network_icon', 'option') }}"></i></a></li>
            @endwhile
          </ul>
        @endif
      </div>
    </div>
  </div>
</section>



<style>
.more-informtion .mores p {
  font-weight: normal;
  font-size: 12px;
  line-height: 16px;
  letter-spacing: 0.04px;
  color: #BEC6D2;
}

.more-informtion .mores p strong {
  display: block;
  font-weight: bold !important;
  font-size: 18px;
  line-height: 27px;
  letter-spacing: 0.04px;
  color: #FFFFFF;
}

.more-informtion {
  display: flex;
}

.more-informtion .mores {
  width: 50%;
}

.footer-secure {
  font-style: normal;
  font-weight: normal;
  font-size: 12px;
  line-height: 16px;
  letter-spacing: 0.04px;
  color: #F9F9F9;
  display: flex;
  align-items: center;
}

.footer-secure img {
  max-width: 190px;
  margin-left: 10px;
}

.social-btns .network,
.social-btns .network:before,
.social-btns .network .fa {
  -webkit-transition: all 0.35s;
  transition: all 0.35s;
  -webkit-transition-timing-function: cubic-bezier(0.31, -0.105, 0.43, 1.59);
  transition-timing-function: cubic-bezier(0.31, -0.105, 0.43, 1.59);
}

.social-btns .network:before {
  top: 90%;
  left: -110%;
}

.social-btns .network .fa {
  -webkit-transform: scale(0.8);
  transform: scale(0.8);
}

.social-btns .network:focus:before,
.social-btns .network:hover:before {
  top: -10%;
  left: -10%;
  background-color: #1d6dfa;
}

.social-btns .network:focus .fa,
.social-btns .network:hover .fa {
  color: #fff;
  -webkit-transform: scale(1);
  transform: scale(1);
}

.social-btns {
  display: flex;
  white-space: nowrap;
  align-items: center;
  padding-top: 10px;
  padding-bottom: 10px;
}

.social-btns .network {
  width: 30px;
  height: 30px;
  background: #DFE3E8;
  border-radius: 8px;
  margin: 0 5px;
  text-align: center;
  position: relative;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

.social-btns .network:before {
  content: '';
  width: 120%;
  height: 120%;
  position: absolute;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
}

.social-btns .network .fa {
  font-size: 22px;
  vertical-align: middle;
}

.social-btns li.head {
  font-style: normal;
  font-weight: bold;
  font-size: 14px;
  line-height: 21px;
  letter-spacing: 0.04px;
  color: #FFFFFF;
  mix-blend-mode: normal;
  margin-right: 20px;
}

.social-btns .list-inline-item {
  margin: 0 !important;
}
footer .navbar-footer .navbar .menu-item-has-children {
    width: 22%;
}

ul.copyright {
    white-space: nowrap;
    margin: 0;
}

ul.copyright li {
    margin: 0 !important;
}

ul.copyright a {
    font-weight: bold;
    font-size: 14px;
    line-height: 21px;
    letter-spacing: 0.04px;
    color: #FFFFFF;
}
</style>


@if ( !is_user_logged_in() && !is_page_template( 'templates/template-signup.blade.php' ) && !is_page_template( 'templates/template-signin.blade.php' ) )

  <!-- Modal Login -->
  <div class="modal fade" id="LoginUser" tabindex="-1" role="dialog" aria-labelledby="LoginUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="row m-0">
          <div class="col-md-5 col-12 row m-0 align-items-center"  style="background-image: linear-gradient(150deg, #56ecf2 0%, #4242e3 100%);">
            <div class="elementor-background-overlay" style="background-image: url('{{ the_field('header_section_image', 'option') }}');"></div>
            <div class="col-12 description">
              <h4 class="text-white title-description">{{ _e('Welcome Back to premast', 'premast') }}</h4>
              <p class="text-white text-description">{{ _e('Download your preferred design from huge collection of professionally, creative designed powerpoint templates for all your needs.', 'premast') }}</p>
            </div>
          </div>
          <div class="col-md-7 col-12" style="background:#f9f9f9;">
            <div class="modal-header">
              <a class="navbar-brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name') }}">
                <img class="img-fluid" src="@if(get_field('website_logo', 'option')) {{ the_field('website_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/logo-en.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
                <span class="sr-only"> {{ get_bloginfo('name') }} </span>
              </a>
              <h5 class="modal-title" id="LoginUserLabel">{{ _e('Sign Into Your Account', 'premast') }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="modal-footer">
                {{ _e('Dont have an account?', 'premast') }} <a class="signup" href="#" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#SignupUser">{{ _e('Sign Up', 'premast') }}</a>
              </div>
            </div>
            <div class="modal-body">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="WP_login">
                  <span id="login-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>

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

                  <span class="switch-link switch-to-lost position-relative" data-tab="lost_password" style=" bottom: 0; margin: 24px auto; display: block; text-align: center; width: 100%; right: 0; ">{{ _e('Lost your password?', 'premast') }}</span>

                </div>


                <div class="tab-pane fade" id="lost_password">
                  <?php
                    defined( 'ABSPATH' ) || exit;
                    do_action( 'woocommerce_before_lost_password_form' );
                    ?>
                    <form method="post" class="woocommerce-ResetPassword lost_reset_password">
                      <p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
                      <p class="woocommerce-form-row woocommerce-form-row--first form-row">
                        <label for="user_login_reset"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login_reset" autocomplete="username" />
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


          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="SignupUser" tabindex="-1" role="dialog" aria-labelledby="SignupUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="row m-0">
          <div class="col-md-5 col-12 row m-0 align-items-center"  style="background-image: linear-gradient(150deg, #56ecf2 0%, #4242e3 100%);">
            <div class="elementor-background-overlay" style="background-image: url('{{ the_field('header_section_image', 'option') }}');"></div>
            <div class="col-12 description">
              <div class="content-description">
                <h4 class="text-white title-description">{{ _e('Welcome to premast', 'premast') }}</h4>
                <p class="text-white text-description mb-3">{{ _e('Join us and enjoy with this benefits', 'premast') }}</p>
                <p class="text-white min-description">{{ _e('* Recieve a 20% off discount in your E-mail', 'premast') }}</p>
                <p class="text-white min-description">{{ _e('* Downloads hunderds of powerpoint slides and graphics for free', 'premast') }}</p>
                <p class="text-white min-description">{{ _e('* Discover amazing new products daily', 'premast') }}</p>
              </div>

            </div>
          </div>
          <div class="col-md-7 col-12 " style="background:#f9f9f9;!important">
            <div class="modal-header">
              <a class="navbar-brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name') }}">
                <img class="img-fluid" src="@if(get_field('website_logo', 'option')) {{ the_field('website_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/logo-en.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
                <span class="sr-only"> {{ get_bloginfo('name') }} </span>
              </a>
              <h5 class="modal-title" id="SignupUserLabel">{{ _e('Create a New Premast Account', 'premast') }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="modal-footer">
                {{ _e('You have an account?', 'premast') }} <a class="login" href="#" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#LoginUser">{{ _e('Sign in', 'premast') }}</a>
              </div>
            </div>
            <div class="modal-body">
              <p class="register-message m-0" style="display:none"></p>
              <form action="#" method="POST" name="register-form" class="register-form register-user">
                <p class="form">
                  <label  class="star">Name</label>
                  <input type="text" name="name" placeholder="" id="username">
                </p>
                <p>
                  <label  class="star">Email</label>
                  <input type="email" name="user_email" placeholder="" id="useremail">
                </p>
                <p>
                  <label  class="star">Password</label>
                  <input type="password" name="user_password" placeholder="" id="password">
                </p>
                <p>
                  <label  class="star">Confirm Password</label>
                  <input type="password" name="re-pwd" placeholder="" id="confirm_password">
                  <span id="message"></span>
                </p>
                <p class="Conditions">
                  <input type="checkbox" id="Conditions"> <label class="d-inline-block mb-0 label-Conditions" for="Conditions">{{ _e('Accept our Terms&Conditions', 'premast') }}</label>
                </p>
                <button type="submit" id="register-button" class="woocommerce-Button button" name="register" value="Register">{{ _e('Register', 'premast') }}</button>
                <span id="register-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>
              </form>


              <script type="text/javascript">
                jQuery(function($) {
                  $('#password, #confirm_password').on('keyup', function () {
                    if ($('#password').val() == $('#confirm_password').val()) {
                      $('#message').html('Matching').css('color', 'green');
                    } else
                      $('#message').html('Not Matching').css('color', 'red');
                  });



                  $('#register-button').on('click',function(e){
                    e.preventDefault();

                    var fullname = $('#username').val();
                    var useremail = $('#useremail').val();
                    var password = $('#password').val();
                    // var lastname = $('#lastname').val();


                    $.ajax({
                      type:"POST",
                      url:"<?php echo admin_url('admin-ajax.php'); ?>",
                      data: {
                        action: "register_user_front_end",
                        fullname : fullname,
                        // last_name : lastname,
                        user_email : useremail,
                        user_password : password
                      },
                      beforeSend: function(results) {
                        $('#register-loader').show();
                      },

                      success: function(results){
                        $('.register-message').html(results).show();
                        $('#register-loader').hide();
                      },
                      error: function(results) {
                        $('.register-message').html('something wrong please enter a valid fields').show();
                        $('#register-loader').hide();
                      }
                    });



                  });

                  $('#wp-submit').on('click',function(e){
                    $('#login-loader').show();
                  });

                });
              </script>

              <?php // echo do_shortcode('[wc_reg_form_bbloomer]') ?>
              <div class="galogin">
                {!! do_shortcode( '[nextend_social_login provider="google"]' ) !!}
              </div>
            </div>

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


      $('.nsl-container-buttons a').each(function(){ 
          var oldUrl = $(this).attr("href"); // Get current url
          $(this).attr("href", oldUrl + '?login=true'); // Set herf value
      });

      $('input#wp-submit').addClass('disabled');

      $('input#user_login').blur(function() {
        if(!$(this).val() ) {
          $('input#wp-submit').addClass('disabled');
        } else {
          $('input#wp-submit').removeClass('disabled');
        }
      });

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

  <style>
    div#LoginUser label,
    div#SignupUser label {
      display: block;
    }

    label.star::after {
      content: " *";
    }

    label.star {
      font-family: 'Roboto';
      font-style: normal;
      font-weight: normal;
      font-size: 14px;
      line-height: 21px;
      letter-spacing: 0.04px;
      color: #646464;
    }

    form.register-form.register-user {
      width: 90%;
      margin-left: 15px;
    }

    .content-description {
      text-align: start;
      padding: 5px;
    }

    p.text-white.text-description.mb-3 {
      margin: 0;
    }

    p.text-white.min-description {
      font-size: 16px;
      line-height: 24px;
      letter-spacing: 0.04px;
    }

    div#LoginUser .modal-footer,
    div#SignupUser .modal-footer {
      margin: -25px;
    }

    div.nsl-container[data-align="left"] {
      text-align: center;
      align-items: center;

    }

    button#register-button {
      border: none;
    }

    span.nsl-button-svg-container {
      padding-left: 40px !important;
    }

    input#username,
    input#useremail,
    input#password,
    input#confirm_password {
      border-radius: 8px !important;
    }

    button#register-button {

      height: 40px !important;
      box-shadow: none;
      min-width: 285px !important;
      box-shadow: none !important;
    }

    p.Conditions {
      padding-bottom: 16px !important;
    }

    .modal-header {
      margin-top: 35px !important;
      padding: 0 !important;


    }

    .modal-body {
      padding: 0 !important;
    }

    .nsl-container.nsl-container-block {
      margin-top: -23px;
    }

    div.nsl-container .nsl-container-buttons {
      padding: 15px 0;
    }
    input#username {
    font-weight: 400!important;
    }
    input#useremail {
    font-weight: 400!important;
}

    /* login popup */
    input#wp-submit {
      border: none !important;
      min-width: 263px !important;
      box-shadow: none !important;
      height: 40px !important;


    }
    input#user_login {
      font-weight: 400!important;
      font-size:14px;
    }


    #LoginUser p.text-white.text-description {
      margin: 0;
    }
    .modal-footer {
      font-size:16px!important;
    }
    button#register-button:hover {
      background:linear-gradient(165.74deg, #6b73ff -0.5%, #000dff 100%);
      opacity:.95;

    }

    @media screen and (max-width: 600px) {
      div.nsl-container[data-align="left"] {
        margin: 0;
      }

      button#register-button {
        min-width: 232px !important;
      }

      button#register-button {
        min-width: 254px !important;
      }

      .galogin a {
        max-width: 285px !important;
        width: 100%;
      }

      div.nsl-container[data-align="left"] {
        margin: 0 !important;
      }

      form.register-form.register-user {
        width: 100%;
        margin: 0;
      }
    }

    input#wp-submit.disabled {
      opacity: .5;
      pointer-events: none;
    }
  </style>

@endif
