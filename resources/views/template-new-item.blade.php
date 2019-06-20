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

  global $current_user;
  wp_get_current_user();

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

<?php

  if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {

    $title = $_POST["title"];
    $description = $_POST["description"];
    $file_name = $_POST["file_name"];


    $slide_gallery = $_POST["slide_gallery"];
    $prices = $_POST["prices"];
    $slide_type = $_POST["slide_type"];
    $slide_format = $_POST["slide_format"];
    $tags = $_POST["tags"];
    $cat = $_POST["cat"];
    $slide_colors = $_POST["slide_colors"];
    $slide_number = $_POST["slide_number"];
    $slide_pages = $_POST["slide_pages"];
    $slide_date = $_POST["slide_date"];
    


    $product = wp_insert_post(array (
      'post_type' => 'product',
      'post_title' => $title,
      'post_content' => $description,
      'post_status' => 'pending',
      'comment_status' => 'closed',
      'ping_status' => 'closed',
      'post_author' => $current_user->ID,
      'tax_input' => array( 'product_cat' => $cat )
    ));

    $image_id = cvf_upload_thumbnail();
    $attach_id = cvf_upload_files();
    $file_url = wp_get_attachment_url($attach_id);

    $downloads[] = array(
        'name' => $file_name,
        'file' => $file_url
    );
    
    if ($product) {
      
      update_field( 'field_5cr243sfsfcca58d1e19b', $slide_type, $product );
      update_field( 'field_5cr24wqtwe434343sfsfcca58d1e19b', $slide_format, $product );
      update_field( 'field_5ccca58d1e19b', $slide_gallery, $product );
      update_field( 'field_5ccca59b1e19c', $slide_colors, $product );
      update_field( 'field_5ccca5a81e19d', $slide_number, $product );
      update_field( 'field_5ccca5b61e19e', $slide_pages, $product );
      update_field( 'field_5ccca5b81e19f', $slide_date, $product );


      if ( isset( $tags) && is_object_in_taxonomy( $post_type, 'product_tag' ) ) {
          wp_set_post_tags( $post_ID, $tags );
      }
      update_post_meta($product, '_regular_price', $prices);
      update_post_meta($product, '_downloadable', 'yes');
      update_post_meta($product, '_downloadable_files', $downloads);
      set_post_thumbnail($product, $image_id);

      $link = get_permalink($product);
      wp_redirect($link);
    }
  } 

 do_action('wp_insert_post', 'wp_insert_post');
?>




    <form id="publish_product" name="new_post" method="post" action="" enctype="multipart/form-data">
      
      <div class="row justify-content-center m-0">
        <div class="col-md-8 col-12">
          <div class="row ml-0 mr-0 mb-5 content-single">
            <div class="col-12">
              <?php woocommerce_breadcrumb(); ?>
              
              <h2 class="product-title mt-3">{{ _e('Headline', 'premast') }}</h2>
              <div class="input-group mb-3">
                <input type="text" name="title" class="form-control"  placeholder="Enter Headline" required>
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2">premast powerpoint templates</span>
                </div>
              </div>
              <label for="upload_img" class="label-upload">
                <img class="profile-pic" src="{{ get_theme_file_uri().'/dist/images/upload-file.gif' }}">
                <i class="fa fa-cloud-upload upload-button"></i>
              </label>
              <div class="upload-form">
                <div class="upload-response"></div>
                  <div class="form-group">
                    <input type="file" id="upload_img"  name="thumbnail[]" accept="image/*" class="files-thumbnail form-control" multiple />
                  </div>
              </div>  
              <label for="basic-url">Your Slid Or Video URL</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon3">http://youtube.com/video</span>
                </div>
                <input type="text" class="form-control" name="slide_gallery" id="basic-url" aria-describedby="basic-addon3">
              </div>
              <div class="product-infomation">
                <h3>Description</h3>
                <div id="tab-description">
                  <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
              </div>                                                                
            </div>
          </div>
        </div>

        <div class="summary entry-summary col-md-4 col-12 sidebar-shop">
          <div class="download-product">
            <p class="price">Files Download</p>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Enter title File</span>
              </div>
              <input type="text" name="file_name" class="form-control"  placeholder="" required>
            </div>
            
            
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
              </div>
              <div class="custom-file">
                <input type="file" id="upload_file" class="custom-file-input files-download"  name="files[]"  multiple required/>
                <label class="custom-file-label" for="upload_file">Choose file</label>
              </div>
            </div>
            
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
                <span class="input-group-text">0.00</span>
              </div>
              <input type="number" name="prices" class="form-control" placeholder="$ 00.00">
            </div>
          </div>

          <div class="box-counter">
            <div class="input-group mb-3 slide-info">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">#</span>
              </div>
              <input type="text" name="slide_type" class="form-control" placeholder="Type Slide">
            </div>
            <div class="input-group mb-3 slide-info">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">#</span>
              </div>
              <input type="text" name="slide_format" class="form-control" placeholder="Format Slide">
            </div>
            <div class="input-group mb-3 slide-info">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">#</span>
              </div>
              <input type="text" name="tags" class="form-control" placeholder="Tags, tag, premast">
            </div>

            <?php $args = array(
              'show_option_all'    => 'All Catagories',
              'show_option_none'   => '',
              'orderby'            => 'ID',
              'order'              => 'ASC',
              'show_count'         => 1,
              'hide_empty'         => 0,
              'child_of'           => 0,
              'exclude'            => '1,5',
              'echo'               => 1,
              'selected'           => 0,
              'hierarchical'       => 0,
              'name'               => 'cat',
              'id'                 => '',
              'class'              => 'postform',
              'depth'              => 1,
              'tab_index'          => 0,
              'taxonomy'           => 'product_cat',
              'hide_if_empty'      => false,
            ); ?>
            <?php wp_dropdown_categories( $args ); ?>

          </div> 

          <div class="box-counter">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">#</span>
              </div>
              <input type="text" class="form-control" name="slide_colors" placeholder="Unique Slides">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">#</span>
              </div>
              <input type="text" class="form-control" name="slide_number" placeholder="Animation">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">#</span>
              </div>
              <input type="text" class="form-control" name="slide_pages" placeholder="Vector">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">#</span>
              </div>
              <input type="text" class="form-control" name="slide_date" placeholder="Icons">
            </div>                                
          </div>



          <p class="mt-t col-12">
            <input type="submit" value="publish" tabindex="6" id="submit" name="submit" />
          </p>
        </div><!-- End Sidebar -->

      </div>  <!-- End row -->
      
      
		  
		  <input type="hidden" name="action" value="new_post" />
      
      <?php wp_nonce_field( 'new-post' ); ?>

    </form>


  @endif
</div>

<script type = "text/javascript">
  jQuery(function($) {
    
    // Add New Images
    $('body').on('click', '#submit', function(e){
        e.preventDefault;
        var fd = new FormData();
        var files_data = $('.files-thumbnail'); // The <input type="file" /> field
        // Loop through each data and create an array file[] containing our files data.
        $.each($(files_data), function(i, obj) {
            $.each(obj.files,function(j,file){
                fd.append('thumbnail[' + j + ']', file);
            })
        });
        fd.append('action', 'cvf_upload_thumbnail');  
        fd.append('post_id', <?php echo $post->ID; ?>); 
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              $('.upload-response').html(response); // Append Server Response
            }
        });
    });

    // When the Upload button is clicked...
    $('body').on('click', '#submit', function(e){
        e.preventDefault;
        var fd = new FormData();
        var files_data = $('.files-download'); // The <input type="file" /> field
        // Loop through each data and create an array file[] containing our files data.
        $.each($(files_data), function(i, obj) {
            $.each(obj.files,function(j,file){
                fd.append('files[' + j + ']', file);
            })
        });
        fd.append('action', 'cvf_upload_files');  
        fd.append('post_id', <?php echo $post->ID; ?>); 
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              $('.upload-response').html(response); // Append Server Response
            }
        });
    });


  });  
  
  jQuery(function($) {
    var readURL = function(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    
    $("#upload_img").on('change', function(){
      readURL(this);
    });

    $(".upload-button").on('click', function() {
        $("#").click();
    });
  });               
</script>

@endsection




