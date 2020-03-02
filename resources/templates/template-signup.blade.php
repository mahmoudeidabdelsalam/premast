{{--
  Template Name: Sign Up
--}}


@php 
  $refer   = isset($_GET['refer']) ? $_GET['refer'] : '';
  $credit = get_user_meta( $refer, 'ref_credit', true);
  $array_ip = get_user_meta( $refer, 'follow_ip', true);
  $friends = get_user_meta( $refer, 'friends', true);
  $ip = get_the_user_ip();
@endphp

@extends('layouts.app-dark')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="custom-style-template">

      <div class="container-fluid">
        <div class="row justify-content-center">
          @if ( !is_user_logged_in() )
            <div class="col-md-5 col-12 custom-padding bg-sections">
                <h3 class="text-white">Welcome! You’ve been invited to join premast</h3>
                <p class="text-white mb-5">* Join us and enjoy these benefits:</p>
                <ul class="text-white">
                  <li>Recieve a 20% off discount in your E-mail</li>
                  <li>Downloads hundreds of powerpoint templates and graphics.</li>
                  <li>Discover amazing new products daily</li>
                </ul>

                <a href="#" class="text-white mt-5">{{ _e('Know more about us', 'permast') }} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-md-7 col-12 bg-light custom-padding">
              <div class="show-header text-left">
                <h2 class="modal-title" id="LoginUserLabel">{{ _e('Create a New Premast Account', 'premast') }}</h2>
                <img class="img-fluid" src="{{ get_theme_file_uri().'/dist/images/logos.png' }}" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
              </div>
              <div class="modal-body">
                <p class="register-message m-0" style="display:none"></p>
                <form action="#" method="POST" name="register-form" class="register-form register-user">
                  <p class="form-row">
                    <label for="">First Name</label>
                    <input class="form-control" type="text"  name="first_name" placeholder="First Name" id="firstname">
                  </p>
                  <p class="form-row">
                    <label for="">Last Name</label>
                    <input type="text" name="last_name" placeholder="Last Name" id="lastname">
                  </p>
                  <p class="form-row">
                    <label for="">email</label>
                    <input type="email" name="user_email" placeholder="Email" id="useremail">
                  </p>
                  <p class="form-row">
                    <label for="">password</label>
                    <input type="password" name="user_password" placeholder="Password" id="password">
                  </p>
                  <p class="form-row">
                    <input type="password" name="re-pwd" placeholder="Confirm Password" id="confirm_password">
                    <span id="message"></span>
                  </p>  
                  <p class="Conditions">
                    <input type="checkbox" id="Conditions"> <label class="d-inline-block mb-0 label-Conditions" for="Conditions">{{ _e('Accept our Terms&Conditions', 'premast') }}</label>
                  </p>

                  <input hidden  id="ref" type="text" value="<?= $refer; ?>"  name="refer" readonly="readonly"/>
                  <input hidden id="follow_ip" type="text" value="<?= $ip; ?>"  name="follow_ip" readonly="readonly"/>

                  <button type="submit" id="register-button" class="woocommerce-Button button m-auto d-block" name="register" value="Register">{{ _e('sign up', 'premast') }}</button>
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
                      var refer = $('#ref').val();
                      var follow_ip = $('#follow_ip').val();
                      $.ajax({
                        type:"POST",
                        url:"<?php echo admin_url('admin-ajax.php'); ?>",
                        data: {
                          action: "register_user_front_end",
                          first_name : firstname,
                          last_name : lastname,
                          user_email : useremail,
                          user_password : password,
                          refer : refer,
                          follow_ip : follow_ip
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

<style>
.modal-show {
    background: #EFF6FA;
    box-shadow: 0px 3px 2px rgba(0, 0, 0, 0.269107);
    border-radius: 14px;
    padding: 60px 100px 20px !important;
}
.modal-show .login-username label, .modal-show .login-password label {
    display: none !important;
}
.modal-show h5.modal-title {
    font-weight: normal;
    font-size: 20px;
    line-height: 23px;
    text-align: center;
    letter-spacing: 0.0438698px;
    color: #3D4552;
    mix-blend-mode: normal;
    opacity: 0.82;
    margin-bottom: 40px;
    margin-top: 10px;
}
.modal-show  input[type="text"], input[type="password"] {
    background: #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.15);
    box-sizing: border-box;
    border-radius: 8px !important;
    height: 40px !important;
}
.modal-show .modal-body {
    padding: 40px 0;
}
.modal-show  p.login-submit {
    text-align: center;
}
.modal-show span.switch-to-lost {
    position: absolute;
    bottom: 146px;
    width: auto !important;
    right: 0;
}
section.section-template span.switch-link {
  text-align: center !important;
}
.modal-show  p.woocommerce-form-row.form-row {
    align-items: center;
}
</style>