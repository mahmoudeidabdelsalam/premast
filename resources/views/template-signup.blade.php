{{--
  Template Name: Template Sign Up
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
                <h4 class="text-white title-description">{{ _e('Welcome to premast', 'premast') }}</h4>
                <p class="text-white text-description mb-3">{{ _e('Join us and enjoy with this benefits', 'premast') }}</p> 
                <p class="text-white min-description">{{ _e('* Recieve a 20% off discount in your E-mail', 'premast') }}</p>
                <p class="text-white min-description">{{ _e('* Downloads hunderds of powerpoint slides and graphics for free', 'premast') }}</p>
                <p class="text-white min-description">{{ _e('* Discover amazing new products daily', 'premast') }}</p>
              </div>
            </div>
            <div class="col-md-7 col-12">
              <div class="modal-header">
                <a class="navbar-brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name') }}">
                  <img class="img-fluid" src="@if(get_field('website_logo', 'option')) {{ the_field('website_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/logo-en.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
                  <span class="sr-only"> {{ get_bloginfo('name') }} </span>
                </a>
                <h5 class="modal-title" id="SignupUserLabel">{{ _e('Create a New Premast Account', 'premast') }}</h5>
              </div>
              <div class="modal-body">
                <p class="register-message m-0" style="display:none"></p>
                <form action="#" method="POST" name="register-form" class="register-form register-user">
                  <p class="form-row form-row-first">
                    <input class="form-control" type="text"  name="first_name" placeholder="First Name" id="firstname">
                  </p>
                  <p class="form-row form-row-last">
                    <input type="text" name="last_name" placeholder="Last Name" id="lastname">
                  </p>
                  <p>
                    <input type="email" name="user_email" placeholder="Email" id="useremail">
                  </p>
                  <p>
                    <input type="password" name="user_password" placeholder="Password" id="password">
                  </p>
                  <p>
                    <input type="password" name="re-pwd" placeholder="Confirm Password" id="confirm_password">
                    <span id="message"></span>
                  </p>  
                  <p class="Conditions">
                    <input type="checkbox" id="Conditions"> <label class="d-inline-block mb-0 label-Conditions" for="Conditions">{{ _e('Accept our Terms&Conditions', 'premast') }}</label>
                  </p>
                  <button type="submit" id="register-button" class="woocommerce-Button button" name="register" value="Register">{{ _e('Register', 'premast') }}</button>
                  <span id="sl-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>
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
                      var firstname = $('#firstname').val();
                      var useremail = $('#useremail').val();
                      var password = $('#password').val();
                      var lastname = $('#lastname').val();
                      $.ajax({
                        type:"POST",
                        url:"<?php echo admin_url('admin-ajax.php'); ?>",
                        data: {
                          action: "register_user_front_end",
                          first_name : firstname,
                          last_name : lastname,
                          user_email : useremail,
                          user_password : password
                        },
                        beforeSend: function(results) {
                          $('#sl-loader').show();
                        },
                        success: function(results){
                          $('.register-message').html(results).show();
                          $('#sl-loader').hide();
                        },
                        error: function(results) {
                          $('.register-message').html('plz try again later').show();
                          $('#sl-loader').hide();
                        }
                      });
                    });
                  });
                </script>

                <?php // echo do_shortcode('[wc_reg_form_bbloomer]') ?>
              </div>
              <div class="modal-footer">
                {{ _e('You have an account?', 'premast') }} <a class="login" href="#" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#LoginUser">{{ _e('Sign in', 'premast') }}</a>
              </div>
            </div>
          

          @endif



        </div>
      </div>
    </section>
  @endwhile
@endsection
