{{--
  Template Name: edit Template
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
          <h2>{{ _e('See what’s happening in the Premast right now', 'premast') }}</h2>
          <p>{{ _e('Join Pre Vendors today.', 'premast') }}</p>
          <a class="mt-2 login btn btn-blue" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a>
        </div>
      </div>
    </div>
  @elseif (array_intersect($allowed_roles, $user->roles))
    @php
      
      $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : 'false';

      if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "update_post" && $post_id != 'false') {
        
        $title = $_POST["title"];
        $description = $_POST["description"];
        $short_description = $_POST["short_description"];
        $slide_gallery = $_POST["slide_gallery"];
        $prices = $_POST["prices"];
        $slide_type = $_POST["slide_type"];
        $slide_format = $_POST["slide_format"];
        $tags = $_POST['tags'];
        $cat = $_POST["cat"];
        $slide_colors = $_POST["slide_colors"];
        $slide_number = $_POST["slide_number"];
        $slide_pages = $_POST["slide_pages"];
        $slide_date = $_POST["slide_date"];

        $product = wp_update_post(array (
          'ID'           => $post_id,
          'post_type' => 'product',
          'post_title' => $title,
          'post_content' => $description,
          'post_excerpt' => $short_description,
          'post_status' => 'pending',
          'post_author' => $current_user->ID,
          'tax_input' => array( 'product_cat' => $cat )
        ));

        $image_id = $_POST["thumbnail"];
        
        $gallery_id = $_POST["galler"];

        $file_url = $_POST["file_url"];
        $file_name = $_POST["file_name"];
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
    do_action('wp_update_post', 'wp_update_post');

    $post = get_post($post_id);
      
      // Data Products
      $gallery_images = get_post_meta( $post->ID, '_product_image_gallery', true);
      $price = get_post_meta( $post->ID, '_regular_price', true);
      $downloadable = get_post_meta( $post->ID, '_downloadable_files', true);

      $download = [];
      if($downloadable) {
        foreach($downloadable as $download) {
          $download = [
            "file" => $download["file"],
            "name" => $download["name"],
          ];
        }
      }

      // ACF
      $youtube = get_post_meta( $post->ID, 'slide_gallery', false, false);
      $slide_colors = get_post_meta( $post->ID, 'slide_colors', true );
      $slide_number = get_post_meta( $post->ID, 'slide_number', true );
      $slide_pages = get_post_meta( $post->ID, 'slide_pages', true );
      $slide_date = get_post_meta( $post->ID, 'slide_date', true );
      $slide_type = get_post_meta( $post->ID, 'slide_type', true );
      $slide_format = get_post_meta( $post->ID, 'slide_format', true );

    @endphp

    <form id="publish_product" name="update_post" method="post" action="" enctype="multipart/form-data">
      <div class="row justify-content-center m-0">
        <div class="col-md-8 col-12">
          <?php woocommerce_breadcrumb(); ?>
          <div class="input-group mb-5 mt-2 arrows right">
            <input type="text" name="title" class="form-control" value="{{ get_the_title($post->ID) }}" placeholder="Enter headline" required>
          </div>
          <div class="row ml-0 mr-0 mb-5 content-single pl-0 pr-0 pt-3">
            <div class="col-12">
              <label for="frontend-button" class="label-upload arrows right">
                <span class="images-files"></span>
                <img class="profile-pic" src="{{ Utilities::global_thumbnails($post->ID,'full') }}">
                <span>{{ _e('upload your cover image here', 'premast') }}</span>
                <span>{{ _e('1104 × 944 pixels', 'premast') }}</span>
              </label>
              <div class="upload-form">
                <div class="form-group">
                  <input type="file" id="frontend-button"  class="files-thumbnail form-control"/>
                  <input name="thumbnail" value="{{ get_post_thumbnail_id($post->ID) }}" id="thumbnails" hidden required/>
                </div>
              </div>
              <div class="upload-gallery mt-5 mb-0">                
                <span>{{ _e('upload your gallery images here', 'premast') }}</span>
                <input type="button" value="Remove All Image" class="remove">
                <div class="input-group mb-3 mt-3">
                  <label class="frontend-gallery" for="frontend-gallery">
                    <img class="profile-gallery" src="{{ get_theme_file_uri().'/dist/images/upload-gallery.png' }}">
                  </label>
                  <div id="thumb-output">
                    @php 
                      $ids_gallery =  explode( ',', $gallery_images );
                    @endphp
                    @foreach ( $ids_gallery as $id_gallery)
                      {!! wp_get_attachment_image( $id_gallery, array('150', '150'), "", array( "class" => "thumb" ) ) !!}
                    @endforeach
                  </div>  
                  <span class="gallery-files d-block"></span> 
                  <div class="custom-file">
                    <input type="text" id="frontend-gallery" hidden>
                    <input name="galler" value="{{ $gallery_images }}" id="gallers" hidden/>
                  </div>
                </div>                    
              </div> 
              <div class="input-group mb-3">
                <input type="text" value="{{ $youtube['0'] }}" class="form-control" name="slide_gallery" placeholder="Embed Youtube or Slideshare URL">
              </div>
              <div class="product-infomation">
                <div id="tab-description">
                  <textarea class="form-control" name="description" placeholder="Add description" rows="5">{{ $post->post_content }}</textarea>
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
              <input type="number" value="{{ $price }}" name="prices" class="form-control" placeholder="$ 00.00">
              <div class="input-group-prepend">
                <span class="input-group-text">{{ _e('$', 'premast') }}</span>
              </div>
            </div>
            <textarea class="form-control" name="short_description" placeholder="Short description" rows="3" required>{{ $post->post_excerpt }}</textarea>
          </div>

          <div class="input-group mb-4 mt-4">
            <label class="custom-download-label arrows left mb-0" for="upload_file">
              <div class="upload-response"></div>
              <img class="profile-download" src="{{ get_theme_file_uri().'/dist/images/upload.png' }}">
              <span class="name-files">{{ $download['name'] }}</span>
              <span>{{ _e('Max size 1GB') }}</span>
            </label>
            <div class="custom-file d-none">
              <input type="file" id="upload_file" class="custom-file-input files-download"/>                
              <input name="file_url" id="upload_files" value="{{ $download['file'] }}" id="files_url" hidden required/>
              <input name="file_name" value="{{ $download['name'] }}" id="files_name" hidden required/>
            </div>
          </div>
        

          <div class="box-taxonomy arrows left">
            <?php 
              $terms = get_the_terms( $post->ID, 'product_cat' );
              if ( $terms && ! is_wp_error( $terms ) ) : 
                $draught_terms= array();
                foreach ( $terms as $term ) {
                    $draught_terms[] = $term->term_id;
                }
                $on_term = join( ", ", $draught_terms );
              endif;
            $args = array(
              'taxonomy'           => 'product_cat',
              'selected'           => (int) $on_term,
              'id'                 => 'cat',
              'required'           => true,
              'hide_if_empty'      => false,
            ); ?>
            <?php wp_dropdown_categories( $args ); ?>


            <div class="input-group mb-3 mt-3 slide-info arrows left">
              @php 
                $tags = wp_get_post_terms( $post->ID, 'product_tag' );
                $draught_tags = array();
                if ( $tags && ! is_wp_error( $tags ) ) : 
                  foreach ( $tags as $tag ) {
                      $draught_tags[] = $tag->name;
                  }
                endif;
                $on_tag = join( ", ", $draught_tags );
              @endphp
              <input id="tags" size="50" value="{{ $on_tag }}" type="text" name="tags" class="form-control" id="autotags" autocomplete="on" autocorrect="off" autocapitalize="on" spellcheck="false"  placeholder="Type tags and press enter" required>
            </div>
          </div> 

          <div class="box-information mt-5">
            <label for="">{{ _e('Other Information', 'premast') }}</label>

            <div class="input-group mb-3 slide-info">
              <input value="{{ $slide_type }}" type="text" name="slide_type" class="form-control" placeholder="Enter no of slides">
            </div>
            <div class="input-group mb-3 slide-info">
              <input value="{{ $slide_format }}" type="text" name="slide_format" class="form-control" placeholder="Enter Format of Slides">
            </div>
            <div class="input-group mb-3">
              <input value="{{ $slide_colors }}" type="text" class="form-control" name="slide_colors" placeholder="Enter Unique of Slides">
            </div>
            <div class="input-group mb-3">
              <select name="slide_number" id="">
                <option value="{{ $slide_number }}" selected="selected">Animation</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <select name="slide_pages" id="">
                <option value="{{ $slide_pages }}" selected="selected">Vector</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <select name="slide_date" id="">
                <option value="{{ $slide_date }}" selected="selected">Icons</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>                                
          </div>


          <p class="mt-t col-12">
            <input type="submit" value="Update" tabindex="6" id="submit" name="submit" />
          </p>

          <p class="error-field">
            <span id="error-headline" class="alert alert-danger" style="display:none;">{{ _e('Alert headline field input required (kindly check!)', 'premast') }}</span>
            <span id="error-thumb" class="alert alert-danger" style="display:none;">{{ _e('Alert image field input required (kindly check!)', 'premast') }}</span>
            <span id="error-description" class="alert alert-danger" style="display:none;">{{ _e('Alert description field input required (kindly check!)', 'premast') }}</span>
            <span id="error-file" class="alert alert-danger" style="display:none;">{{ _e('Alert file field input required (kindly check!)', 'premast') }}</span>
            <span id="error-category" class="alert alert-danger" style="display:none;">{{ _e('Alert category field input required (kindly check!)', 'premast') }}</span>
            <span id="error-tags" class="alert alert-danger" style="display:none;">{{ _e('Alert tags field input required (kindly check!)', 'premast') }}</span>
          </p>

        </div><!-- End Sidebar -->
      </div>  <!-- End row -->
		  <input type="hidden" name="action" value="update_post" />
      <?php wp_nonce_field( 'new-post' ); ?>
    </form>
  @else 
    <div class="row justify-content-center m-0">
      <div class="publish">
        <div class="user-not-login">
          <h2>{{ _e('See what’s happening in the Premast right now', 'premast') }}</h2>
          <p>{{ _e('Join Pre Vendors today.', 'premast') }}</p>
          <a class="mt-2 login btn btn-blue" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a>
        </div>
      </div>
    </div>
  @endif
</div>

@if (array_intersect($allowed_roles, $user->roles))
  <script type = "text/javascript">
    jQuery(function($) {
      // Errors
      $('#submit').on('click', function(){
        if($('input[name="title"]').val() === ""){
          $("#error-headline").show();
        } else {
          $("#error-headline").hide();
        }
        if($('#thumbnails').val() === ""){
          $("#error-thumb").show();
        } else {
          $("#error-thumb").hide();
        }
        if($('textarea[name="short_description"]').val() === ""){
          $("#error-description").show();
        } else {
          $("#error-description").hide();
        }
        if($('#upload_files').val() === ""){
          $("#error-file").show();
        } else {
          $("#error-file").hide();
        }
        if($('#cat').val() === ""){
          $("#error-category").show();
        } else {
          $("#error-category").hide();
        }
        if($('input[name="tags"]').val() === ""){
          $("#error-tags").show();
        } else {
          $("#error-tags").hide();
        }                                     
      }); 

      $(".remove").click(function (e) {
        e.preventDefault();
        $('#gallers').val('');
        $('#thumb-output img').remove();
      });
    });  


    <?php 
      $terms = get_terms( 'product_tag', array('orderby' => 'slug', 'hide_empty' => false ) ); 
      $titles = array();
      foreach( $terms as $result )
        $titles[] = $result->name;
      if(count($titles) == 0 ){
        $titles[] =  __('No results found - Please change keyword ', 'premast');
      }
    ?>
    jQuery(function($) {
      $( function() {
        var availableTags = [
          "<?= implode('", "', $titles); ?>"
        ];
        function split( val ) {
          return val.split( /,\s*/ );
        }
        function extractLast( term ) {
          return split( term ).pop();
        }

      $( "#tags" )
        // don't navigate away from the field on tab when selecting an item
        .on( "keydown", function( event ) {
          if ( event.keyCode === $.ui.keyCode.TAB &&
              $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
          }
        })
        .autocomplete({
          minLength: 0,
          source: function( request, response ) {
            // delegate back to autocomplete, but extract the last term
            response( $.ui.autocomplete.filter(
              availableTags, extractLast( request.term ) ) );
          },
          focus: function() {
            // prevent value inserted on focus
            return false;
          },
          select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( ", " );
            return false;
          }
        });
      });
    });
  </script>
@endif

@endsection
