{{--
  Template Name: publishing Template
--}}

@php acf_form_head() @endphp

@extends('layouts.template-custom')
@section('content')

@php 
  $args = array(
    'post_type' => 'product',
  );

  $loop = new WP_Query( $args );
  $count = $loop->found_posts;
@endphp

@if (get_field('banner_items_headline', 'option'))
<section class="banner-items mb-5" style="background-image: linear-gradient(150deg, {{ the_field('gradient_color_one','option') }} 0%, {{ the_field('gradient_color_two','option') }} 100%);">
  <div class="elementor-background-overlay" style="background-image: url('{{ the_field('banner_background_overlay','option') }}');"></div>
  <div class="container">
    <div class="row justify-content-center align-items-center text-center">
      <h2 class="col-12 text-white"><strong class="font-weight-600">{{ _e('Discover', 'premast') }} +{{  $count }}</strong> <span class="font-weight-300">{{ the_field('banner_items_headline','option') }}</span></h2>
      <p class="col-md-5 col-12 text-white font-weight-300">{{ the_field('banner_items_sub_headline','option') }}</p>
    </div>
  </div>
</section>
@endif



<div class="container single-product">
  @if(!is_user_logged_in())
    <div class="row justify-content-center m-0">
      <div class="publish">
        <div class="user-not-login">
          <h2>{{ _e('See what’s happening in the world right now', 'premast') }}</h2>
          <p>{{ _e('Join Twitter today.', 'premast') }}</p>
          <a class="mt-2 login btn btn-blue" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a>
        </div>
      </div>
    </div>
  @else


    <form id="new_post" name="new_post" method="get" action="">
      <div class="row justify-content-center m-0">
        <div class="col-md-8 col-12">
          <div class="row ml-0 mr-0 mb-5 content-single">
            <div class="col-12">
              <?php woocommerce_breadcrumb(); ?>
              <input type="text" name="title" class="form-control"  placeholder="Enter Headline">
            </div>
          </div>
        </div>

        <div class="summary entry-summary col-md-4 col-12 sidebar-shop">
          <div class="download-product">
          </div>
        </div>
      </div>  
      
      
		<p><input type="submit" value="publish" tabindex="6" id="submit" name="submit" /></p>
		
		<input type="hidden" name="post_type" id="post_type" value="product" />
		<input type="hidden" name="action" value="get" />


    </form>



  @endif
</div>
@endsection

