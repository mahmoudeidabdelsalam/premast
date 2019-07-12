
@php
do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
};
global $product;
@endphp

@php 
  global $current_user;
  wp_get_current_user();
@endphp

<div id="product-{{ the_ID() }}" {!! wc_product_class() !!}>
  <div class="container custom-container mt-5 mb-5">
    <div class="row justify-content-center m-0">
      <div class="col-12">
        <?php woocommerce_breadcrumb(); ?>
        <h2 class="product-title">{{ the_title() }}</h2>
      </div>

      <div class="col-md-8 col-12">
        
        <div class="row ml-0 mr-0 mb-5 content-single">
          <div class="col-12">
            @php
              do_action( 'woocommerce_before_single_product_summary' );
            @endphp
             @php  
              $attachment_ids = $product->get_gallery_image_ids();
            @endphp                         
            @if ($attachment_ids)
            <ul id="imageGallery">
              @foreach( $attachment_ids as $attachment_id ) 
                <li data-thumb="{{ wp_get_attachment_url( $attachment_id ) }}" data-src="{{ wp_get_attachment_url( $attachment_id ) }}">
                  <img src="{{ wp_get_attachment_url( $attachment_id )}}" />
                </li>
              @endforeach
            </ul>
            @else 
              <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="card-img-top" alt="{{ the_title() }}"> 
            @endif
            @if (get_field('slide_gallery'))
              <div class="embed-container">
                {{ the_field('slide_gallery') }}
              </div>
            @endif

            <div class="product-infomation">
              <h3>{{ _e('Description', 'premast') }}</h3>
              <div id="tab-description">{{ the_content() }}</div>
            </div>
          </div>
          @include('partials/incloud/comments')
        </div>
      </div>
      
      <div class="summary entry-summary col-md-4 col-12 sidebar-shop">
        <div class="download-product">

          @php  
            do_action( 'woocommerce_single_product_summary' );
          @endphp
        
          @if(current_user_can( 'edit_post', get_the_ID() ) && (get_the_author_meta('ID') == $current_user->ID) || is_super_admin())
            <p class="mb-0 mb-0 border border-primary text-primary text-center p-2"><a href="{{ the_field('link_edit_item', 'option') }}?post_id={{ the_ID() }}">{{ _e('edit Product') }}</a></p>
          @endif

          @if ( !is_user_logged_in() )
            <a class="mt-2 login" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Login', 'premast') }}</a>
          @endif

          @php $form_id = get_field('froms_problem_with_download', 'option' );@endphp
          @if($form_id)
            <p class="form-probelm">{{ _e('there is a problem with download', 'premast') }} <a class="modal-forms" data-toggle="modal" data-target="#exampleModalCenter">{{ _e('click here', 'premast') }}</a></p>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>                  
                      {!! do_shortcode( '[gravityform id="'.$form_id['id'].'" name="" title="false" description="false" ajax="true" ]' ) !!}
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
        @include('partials/incloud/sharemeta')
        @php dynamic_sidebar('sidebar-shop') @endphp
      </div>
      <div class="col-12">
          @php
            do_action( 'woocommerce_after_single_product_summary' );
          @endphp
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    jQuery(function($) {
        $('#imageGallery').lightSlider({
          gallery: true,
          item: 1,
          loop: true,
          thumbItem: 6,
          slideMargin: 0,
          enableDrag: false,
          currentPagerPosition: 'left',
          onSliderLoad: function (el) {
            $('.lightSlider').removeClass('cS-hidden');
            el.lightGallery({
              selector: '[rel="lightSliderGallery"] .lslide',
            });
          },
          responsive: [{
            breakpoint: 480,
            settings: {
              enableDrag: true,
              controls: false,
              thumbItem: 4,
            },
          }],
        });
    });
</script>