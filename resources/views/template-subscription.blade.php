{{--
  Template Name: User Subscription
--}}

@extends('layouts.dark-app')

@section('content')

@if(!is_user_logged_in())
  <div class="container">
    <div class="row justify-content-center m-0">
      <div class="user-not-login">
        <h2>{{ _e('See what’s happening in the world right now', 'premast') }}</h2>
        <p>{{ _e('Join Twitter today.', 'premast') }}</p>
        <a class="mt-2 login btn btn-blue" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a>
      </div>
    </div>
  </div>
@else

@php 
global $current_user;
wp_get_current_user();

$membership  = sv_wc_memberships_my_memberships_shortcode();
@endphp

  <section class="header-users" style="background-image: linear-gradient(150deg, {{ the_field('gradient_color_one','option') }} 0%, {{ the_field('gradient_color_two','option') }} 100%);">
    <div class="elementor-background-overlay" style="background-image: url('{{ the_field('banner_background_overlay','option') }}');"></div>
    <div class="container">
      <div class="row justify-content-between">
          <h2 class="headline">{{ _e('My Account', 'premast') }}</h2>
          
          @if (has_nav_menu('user_navigation'))
            {!! wp_nav_menu(['theme_location' => 'user_navigation', 'container' => false, 'menu_class' => 'nav nav-pills flex-column flex-sm-row col-12', 'walker' => new NavWalker()]) !!}
          @endif

      </div>
    </div>        
  </section>
  <section class="template-users my-membership">
    <div class="container">
      <div class="row justify-content-center pt-5 pb-5">
        <div class="col-md-8 col-12 p-0 mb-5">
          @if ($membership)
           {!! $membership !!}
          @endif
        </div>
      </div>
    </div>
  </section>

  @endif
@endsection