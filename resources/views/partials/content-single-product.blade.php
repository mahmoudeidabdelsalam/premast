
@php
do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
};
global $product;
@endphp

<div id="product-{{ the_ID() }}" {!! wc_product_class() !!}>
  <div class="container custom-container mt-5 mb-5">
    <div class="row justify-content-center m-0">
      
      <div class="col-md-8 col-12">
        <div class="row ml-0 mr-0 mb-5 content-single">
          <div class="col-12">
            <?php woocommerce_breadcrumb(); ?>
            <h2 class="product-title">{{ the_title() }}</h2>
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