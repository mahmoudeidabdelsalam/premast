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
  <div class="modal fade" id="LoginUser" tabindex="-1" role="dialog" aria-labelledby="LoginUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="LoginUserLabel">{{ _e('Login', 'premast') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

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
        <div class="modal-footer">
          <a href="{{ home_url('/') }}registration/">{{ _e('Register', 'premast') }}</a>
          <a href="{{ home_url('/') }}reset-password/">{{ _e('Lost your password?', 'premast') }}</a>
        </div>
      </div>
    </div>
  </div>

@endif