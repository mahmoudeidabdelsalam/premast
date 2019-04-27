
@php
do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
@endphp

<div id="product-{{ the_ID() }}" {!! wc_product_class() !!}>
  <div class="container mt-5 mb-5">
    <div class="row justify-content-center m-0">
      
      <div class="col-md-8 col-12">
        <div class="row ml-0 mr-0 mb-5 content-single">
          <div class="col-12">
            <?php woocommerce_breadcrumb(); ?>
            <h2 class="product-title">{{ the_title() }}</h2>
            
            @php
              do_action( 'woocommerce_before_single_product_summary' );
            @endphp
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
