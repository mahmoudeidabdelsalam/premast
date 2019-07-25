
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
              <div id="tab-description">{!! get_the_content() !!}</div>
            </div>
          </div>
        </div>

        @include('partials/incloud/comments')
      </div>
      
      <div class="summary entry-summary col-md-4 col-12 sidebar-shop">
        <div class="download-product">

          @php 
            $price = get_post_meta( get_the_ID(), '_regular_price', true);
            $sale = get_post_meta( get_the_ID(), '_sale_price', true);
            $symbol = get_woocommerce_currency_symbol();
            $excerpt = get_the_excerpt();
          @endphp

          @if($sale)
            <p class="price">
              <del>
                <span class="woocommerce-Price-amount amount">{{ $price }}<span class="woocommerce-Price-currencySymbol">{!! $symbol !!}</span></span>
              </del> 
              <span>
                <span class="woocommerce-Price-amount amount">{{ $sale }}<span class="woocommerce-Price-currencySymbol">{!! $symbol !!}</span></span>
              </span>
            </p>
          @elseif($price)
            <p class="price">
              <span>
                <span class="woocommerce-Price-amount amount">{{ $price }}<span class="woocommerce-Price-currencySymbol">{!! $symbol !!}</span></span>
              </span> 
            </p>
          @else 
            <p class="price">{{ _e('Free version', 'premast') }}</p>
          @endif

          <div class="short-description">
            <p class="text-description">{!! $excerpt !!}</p>
          </div>

          {!! get_simple_likes_button( get_the_ID() ) !!}

          <div class="custom-summary">
            @php  
              do_action( 'woocommerce_single_product_summary' );
            @endphp
          </div>

          @if(current_user_can( 'edit_post', get_the_ID() ) && (get_the_author_meta('ID') == $current_user->ID) || is_super_admin())
            <p class="mb-0 mb-0 text-primary text-center p-2 bottun-edit"><a href="{{ the_field('link_edit_item', 'option') }}?post_id={{ the_ID() }}">{{ _e('edit Product') }}</a></p>
          @endif

          @if ( !is_user_logged_in() && $price == 0)
            <a class="mt-2 login" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Login', 'premast') }}</a>
          @endif

          @if($price != 0)
            <div class="row secure-payment">
              <div class="col-md-6 col-12 p-0"><p>Secure Payment by</p></div>
              <div class="col-md-6 col-12"><img src="{{ get_theme_file_uri().'/dist/images/2checkout-1.png' }}" alt="2Checkout"></div>
              <div class="col-md-12 col-12 text-center"><img src="{{ get_theme_file_uri().'/dist/images/2checkout-2.png' }}" alt="2Checkout"></div>
            </div>
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

        @if(get_field('ads_image'))
          <div class="ads-block">
            <a href="{{ the_field('ads_link') }}"><img src="{{ the_field('ads_image') }}" alt="{{ _e('Ads Block', 'premast') }}"></a>
          </div>
        @endif

        @php dynamic_sidebar('sidebar-shop') @endphp

        @include('partials/incloud/sharemeta')
      </div>
    </div>
  </div>
</div>

<section class="bg-white pt-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        @php
          do_action( 'woocommerce_after_single_product_summary' );
        @endphp
      </div>
    </div>
  </div>
</section>


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
              selector: '#imageGallery .lslide',
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