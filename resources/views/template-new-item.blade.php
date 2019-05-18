{{--
  Template Name: publishing Template
--}}

@php acf_form_head() @endphp

@extends('layouts.app')
@section('content')
<div class="container">
  <div class="publish">
  @if(!is_user_logged_in())
    @php
      wp_redirect(get_field('signin_page','option') );
    @endphp
  @else
    <h2 class="py-2 pt-4 mt-1">{{ _e('Add New Product ','automotive') }}</h2>
    @php
    acf_form(array(
      'post_id'		=> 'new_post',
      'post_title'	=> true,
      'post_content'	=> true,
      'fields' => [
          'field_5cr243sfsfcca58d1e19b', 
          'field_5a632634sadsda365aa', //Phone Namber
          'field_5a0c28e00a704', // gallery
          'field_5a8adc9637558137', //brand
          'field_5a8ae27c6963906d', //Model
          'field_5a8ae298699636e', //year
          'field_5a01c5b0e172c', //Price
          'field_5a01c3335b0e172c', //Currency
          'field_5a01c5b0235e172c', // kilometers
          'field_5a01c5c2e172d', //CC
          'field_5a01c5d4e172e', // Pattern
          'field_5a01c7c8e172f', //Transmission 
          'field_5a01c8abe1730', //Cylinders
          'field_5a01c8bee1731', //car_horsepower
          'field_5a01c8e1e1732', //Engine Power
          'field_5a01c8fee1733', //Gland size
          'field_5a01c92de1734', //Fuel tank
          'field_5a01c948e1735', //Fuel consumption
          'field_5aa0f4a4233b5b4', // air condition
          'field_5aa0f4125933b5b4', // Parking Sensor
          'field_5aa0f4a7413b5b4', // Radio
          'field_5aa0f4127565b4', // Electric Windows
          'field_5aa0f4127419565b4', // Central Lock
          'field_5aa0f412744920565b4', // Power Steering
          'field_5a01c95ee1736', //Accessories
          'field_5a772223c223f22e613', // status
          'field_5a781222d817f9fc', // owner
        ],
      'post_taxonomy' => true,
      'new_post'		=> array(
        'post_type'		=> 'product',
        'post_status'	=> 'pending'
      ),
      'return'		=> get_field('confirm_page', 'option'),
      'submit_value'	=>  __('Submit product','automotive')
    ));
    @endphp
    
  @endif

  </div>
</div>

@endsection

<?php
function my_acf_save_post( $post_id ) {
  // get the post object
  $the_post = get_post($post_id);
  // check if custom post type
  if( $the_post->post_type == 'product' ) {
    // add the term. Change 'true' to 'false' if you want to override it
    wp_set_object_terms( $post_id, 'product_cat', true );
  }
}

// run after ACF saves the $_POST['acf'] data
add_action('acf/save_post', 'my_acf_save_post', 20); ?>
