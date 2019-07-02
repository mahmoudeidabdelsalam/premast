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
  $user = wp_get_current_user();
  $allowed_roles = array('vendor', 'administrator');
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
          <p>{{ _e('Join Pre Vendor today.', 'premast') }}</p>
          <a class="mt-2 login btn btn-blue" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a>
        </div>
      </div>
    </div>
  @elseif (array_intersect($allowed_roles, $user->roles))
    @php
      if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $short_description = $_POST["short_description"];
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
          'post_excerpt' => $short_description,
          'post_status' => 'pending',
          'post_author' => $current_user->ID,
          'tax_input' => array( 'product_cat' => $cat )
        ));
        $image_id = cvf_upload_thumbnail();
        $attach_id = cvf_upload_files();
        $gallery_id = cvf_upload_gallery();
        $file_url = wp_get_attachment_url($attach_id);
        $downloads[] = array(
            'name' => $title,
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
          wp_set_object_terms($product, array($tags), 'product_tag');
          update_post_meta($product, '_regular_price', $prices);
          update_post_meta($product, '_price', $prices);
          update_post_meta($product, '_downloadable', 'yes');
          update_post_meta($product, '_downloadable_files', $downloads);
          update_post_meta( $product, '_product_image_gallery', implode(',',$gallery_id));
          set_post_thumbnail($product, $image_id);
          update_post_meta($product, '_stock_status', 'instock', true);
          update_post_meta($product, '_visibility', 'visible', true);
          $link = get_permalink($product);
          wp_redirect($link);
        }
      } 
    do_action('wp_insert_post', 'wp_insert_post');
    @endphp

    <form id="publish_product" name="new_post" method="post" action="" enctype="multipart/form-data">
      <div class="row justify-content-center m-0">
        
        <div class="col-md-8 col-12">
          <?php woocommerce_breadcrumb(); ?>
          <div class="input-group mb-5 mt-2 arrows right">
            <input type="text" name="title" class="form-control"  placeholder="Enter headline" required>
          </div>

          <div class="row ml-0 mr-0 mb-5 content-single pl-0 pr-0 pt-3">
            <div class="col-12">
              
              <label for="upload_img" class="label-upload arrows right">
                <img class="profile-pic" src="{{ get_theme_file_uri().'/dist/images/upload-image.png' }}">
                <span>{{ _e('upload your cover image here', 'premast') }}</span>
                <span>{{ _e('1104 × 944 pixels', 'premast') }}</span>
              </label>
              <div class="upload-form">
                <div class="upload-response"></div>
                  <div class="form-group">
                    <input type="file" id="upload_img"  name="thumbnail[]" accept="image/*" class="files-thumbnail form-control" multiple />
                  </div>
              </div> 

              <div class="upload-gallery mt-5 mb-0 arrows right">
                <span>{{ _e('upload your gallery images here', 'premast') }}</span>
                <input type="button" value="Remove All Image" class="remove">
                <div class="input-group mb-3 mt-3">
                  <label class="label-gallery" for="file-input">
                    <img class="profile-gallery" src="{{ get_theme_file_uri().'/dist/images/upload-gallery.png' }}">
                  </label>
                  <div id="thumb-output"></div>   
                  <div class="custom-file">
                    <input type="file" class="custom-file-input files-gallery" name="gallery[]" accept="image/*" id="file-input" multiple />
                  </div>
                </div>    
              </div> 

              <div class="input-group mb-3">
                <input type="text" class="form-control" name="slide_gallery" placeholder="Embed Youtube or Slideshare URL">
              </div>

              <div class="product-infomation">
                <div id="tab-description">
                  <textarea class="form-control" name="description" placeholder="Add description" rows="5"></textarea>
                </div>
              </div> 
                                                               
            </div>
          </div>
        </div>



        <div class="summary entry-summary col-md-4 col-12 sidebar-shop">
          
          <div class="download-product price-input arrows left">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{ _e('Price', 'premast') }}</span>
              </div>
              <input type="number" name="prices" class="form-control" placeholder="$ 00.00">
              <div class="input-group-prepend">
                <span class="input-group-text">{{ _e('$', 'premast') }}</span>
              </div>
            </div>
            <textarea class="form-control" name="short_description" placeholder="Short description" rows="3"></textarea>
          </div>



            <div class="input-group mb-3 mt-3">
              <label class="custom-download-label arrows left" for="upload_file">
                <img class="profile-download" src="{{ get_theme_file_uri().'/dist/images/upload.png' }}">
                <span class="name-files">{{ _e('upload your download file here', 'premast') }}</span>
                <span>{{ _e('Max size 1GB') }}</span>
              </label>
              <div class="custom-file d-none">
                <input type="file" id="upload_file" class="custom-file-input files-download"  name="files[]"  multiple required/>                
              </div>
            </div>
          

            <div class="box-taxonomy arrows left">
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

              <div class="input-group mb-3 mt-3 slide-info arrows left">
                <input type="text" name="tags" class="form-control" placeholder="Type tags and press enter">
              </div>
            </div> 

          <div class="box-information mt-5">
            <label for="">{{ _e('Other Information', 'premast') }}</label>

            <div class="input-group mb-3 slide-info">
              <input type="text" name="slide_type" class="form-control" placeholder="Enter no of slides">
            </div>
            <div class="input-group mb-3 slide-info">
              <input type="text" name="slide_format" class="form-control" placeholder="Enter Format of Slides">
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="slide_colors" placeholder="Enter Unique of Slides">
            </div>
            <div class="input-group mb-3">
              <select name="slide_number" id="">
                <option value="0" selected="selected">Animation</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <select name="slide_pages" id="">
                <option value="0" selected="selected">Vector</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <select name="slide_date" id="">
                <option value="0" selected="selected">Icons</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
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
  @else 
    <div class="row justify-content-center m-0">
      <div class="publish">
        <div class="user-not-login">
          <h2>{{ _e('See what’s happening in the world right now', 'premast') }}</h2>
          <p>{{ _e('Join Pre Vendor today.', 'premast') }}</p>
          <a class="mt-2 login btn btn-blue" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a>
        </div>
      </div>
    </div>
  @endif
</div>

@if (array_intersect($allowed_roles, $user->roles))
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
      // Add New File Download
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
      // Add New Gallery
      $('body').on('click', '#submit', function(e){
          e.preventDefault;
          var fd = new FormData();
          var files_data = $('.files-gallery'); // The <input type="file" /> field
          // Loop through each data and create an array file[] containing our files data.
          $.each($(files_data), function(i, obj) {
              $.each(obj.files,function(j,file){
                  fd.append('gallery[' + j + ']', file);
              })
          });
          fd.append('action', 'cvf_upload_gallery');  
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
      var fileURL = function(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('.name-files').html('success upload File');
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#upload_file").on('change', function(){
        fileURL(this);
      });
      $('#file-input').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
          var data = $(this)[0].files; //this file data
          $.each(data, function(index, file){ //loop though each file
            if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
              var fRead = new FileReader(); //new filereader
                fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                    $('#thumb-output').append(img); //append image to output element
                  };
                })(file);
              fRead.readAsDataURL(file); //URL representing the file's data.
            }
          });
              
        } else {
          alert("Your browser doesn't support File API!"); //if File API is absent
        }
      });
      $(".remove").click(function (e) {
        e.preventDefault();
        $('#file-input').val('');
        $('#thumb-output img').remove();
      });
    });               
  </script>
@endif

@endsection
