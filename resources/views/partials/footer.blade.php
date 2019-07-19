<footer class="content-info bg-gray-dark">
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col-md-8 col-sm-12">
        <div class="navbar-footer">
          <h3 class="sr-only">{{ _e('Footer navigation', 'premast') }}</h3>
          @if (has_nav_menu('footer_navigation'))
            {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'container' => false, 'menu_class' => 'navbar', 'walker' => new NavWalker()]) !!}
          @endif
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        @php dynamic_sidebar('sidebar-footer') @endphp
      </div>
    </div>
  </div>
</footer>

<section class="copyright">
  <h3 class="sr-only">{{ _e('Copyright © 2018 Premast-powerpoint design solutions. All rights reserved.', 'premast') }}</h3>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        {{ _e('Copyright © 2018 Premast-powerpoint design solutions. All rights reserved.', 'premast') }}
      </div>
      <div class="col-md-6">
        <ul class="social-icons-ql list-inline mb-0 text-right">
          <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-reddit"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-stumbleupon"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>

@if ( !is_user_logged_in() )

  <!-- Modal -->
  <div class="modal fade" id="LoginUser" tabindex="-1" role="dialog" aria-labelledby="LoginUserLabel" aria-hidden="true" style="background-image: linear-gradient(150deg, #56ecf2 0%, #4242e3 100%);">
    <div class="elementor-background-overlay" style="background-image: url('{{ the_field('header_section_image', 'option') }}');"></div>
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="LoginUserLabel">{{ _e('Your Accounts', 'premast') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="WP_login" role="tabpanel" aria-labelledby="WP_login-tab">
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
                  'label_log_in'   => __( 'Login' ),
                  'value_username' => '',
                  'value_remember' => false
                ); 
              @endphp
              
              {{ wp_login_form($args) }}
            </div>

            <div class="tab-pane fade" id="lost_password" role="tabpanel" aria-labelledby="lost_password-tab">
              <?php
                defined( 'ABSPATH' ) || exit;
                do_action( 'woocommerce_before_lost_password_form' );
                ?>

                <form method="post" class="woocommerce-ResetPassword lost_reset_password">

                  <p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

                  <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
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
              <?php
                do_action( 'woocommerce_after_lost_password_form' );
                ?>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="WP_login-tab" data-toggle="tab" href="#WP_login" role="tab" aria-controls="WP_login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="lost_password-tab" data-toggle="tab" href="#lost_password" role="tab" aria-controls="lost_password" aria-selected="false">lost password</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="SignupUser" tabindex="-1" role="dialog" aria-labelledby="SignupUserLabel" aria-hidden="true" style="background-image: linear-gradient(150deg, #56ecf2 0%, #4242e3 100%);">
    <div class="elementor-background-overlay" style="background-image: url('{{ the_field('header_section_image', 'option') }}');"></div>
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="SignupUserLabel">{{ _e('Your Accounts', 'premast') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="registration" role="tabpanel" aria-labelledby="registration-tab">
              <?php echo do_shortcode('[wc_reg_form_bbloomer]') ?>
            </div>

            <div class="tab-pane fade" id="lost_password_2" role="tabpanel" aria-labelledby="lost_password_2-tab">
              <?php
                defined( 'ABSPATH' ) || exit;
                do_action( 'woocommerce_before_lost_password_form' );
                ?>

                <form method="post" class="woocommerce-ResetPassword lost_reset_password">

                  <p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

                  <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
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
              <?php
                do_action( 'woocommerce_after_lost_password_form' );
                ?>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="registration-tab" data-toggle="tab" href="#registration" role="tab" aria-controls="registration" aria-selected="false">Registration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="lost_password_2-tab" data-toggle="tab" href="#lost_password_2" role="tab" aria-controls="lost_password_2" aria-selected="false">lost password</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
@endif