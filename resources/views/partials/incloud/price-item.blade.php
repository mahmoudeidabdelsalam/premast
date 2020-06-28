<div class="download-product">
  @php 
    $price = get_post_meta( get_the_ID(), '_regular_price', true);
    $sale = get_post_meta( get_the_ID(), '_sale_price', true);
    $symbol = get_woocommerce_currency_symbol();
    global $product;
    $product_id = $product->get_id();
    $downloads     = WC()->customer->get_downloadable_products();
    $has_downloads = (bool) $downloads;
    $product_ids = [];
    foreach ($downloads as $download) {
      $ids = $download['product_id'];
      $product_ids[] = $ids;
    }
    $in_cart = false;
    foreach( WC()->cart->get_cart() as $cart_item ) {
      $product_in_cart = $cart_item['product_id'];
      if ( $product_in_cart === $product_id ) $in_cart = true;
    }
    $membership_user = $current_user->ID;
    $count_download = somdn_get_user_downloads_count( $membership_user );
    $download_limits = somdn_get_user_limits( $membership_user );
    $limits_amount = $download_limits['amount'];
    $time = get_the_time('Y-m-d');
    $categories = get_the_terms( $product_id, 'product_cat' );
    $parents = get_top_parents('product_cat');
    $price_custom = get_field('show_custom_price', $parents[0]);
  @endphp

  @if($price_custom)
    @if ($limit && !$limit_membership && !$sale && !$price || $count_download == $limits_amount && !$sale && !$price) 
      <p class="price">{{ _e('Premium', 'premast') }}</p>
      {!! get_simple_likes_button( get_the_ID() ) !!}
      <div class="custom-summary">
        @if(get_field('link_limit', 'option'))
          <div class="bottom-summary col-12 mt-4 mb-4 w-100">
            <a class="btn-limit" href="{{ get_field('link_limit', 'option') }}" id="somdn-form-submit-button">{{ _e('Upgrade to download', 'premast') }}</a>  
          </div>
        @endif
      </div>
    @else
      @if($price == 0) 
        <p class="price">{{ _e('Free Template', 'premast') }}</p>
        {!! get_simple_likes_button( get_the_ID() ) !!}
        <div class="custom-summary">
          <div class="free">
            @php  
              do_action( 'woocommerce_single_product_summary' );
            @endphp
          </div>
        </div>
      @endif
    @endif

    @if(current_user_can( 'edit_post', get_the_ID() ) && (get_the_author_meta('ID') == $current_user->ID) || is_super_admin())
      <p class="mb-0 mb-0 text-primary text-center p-2 bottun-edit"><a href="{{ the_field('link_edit_item', 'option') }}?post_id={{ the_ID() }}">{{ _e('edit Product') }}</a></p>
    @endif

    @if ( !is_user_logged_in() && $price == 0)
      <a class="mt-3 login" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Login to Download Now', 'premast') }}</a>
    @endif


    <div class="row secure-payment">
      <div class="col-md-12 col-12 text-center"><img src="{{ get_theme_file_uri().'/dist/images/2checkout-3.png' }}" alt="2Checkout"></div>
    </div>
    @php $form_id = get_field('froms_problem_with_download', 'option' );@endphp
    @if($form_id)
      <p class="form-probelm">{{ _e('there is a problem with download', 'premast') }} <a class="modal-forms" data-toggle="modal" data-target="#ReportAProblem">{{ _e('click here', 'premast') }}</a></p>
      <!-- Modal -->
      <div class="modal fade" id="ReportAProblem" tabindex="-1" role="dialog" aria-labelledby="ReportAProblemTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4>{{ _e('Report a problem', 'premast') }}</h4>
            </div>
            <div class="modal-body">              
                {!! do_shortcode( '[gravityform id="'.$form_id['id'].'" name="" title="false" description="false" ajax="true" ]' ) !!}
                <button type="button" class="cancel" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">{{ _e('cancel', 'premast') }}</span>
                </button>    
            </div>
          </div>
        </div>
      </div>
    @endif

  @else
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
      <p class="price">{{ _e('Free Template', 'premast') }}</p>
    @endif

    {!! get_simple_likes_button( get_the_ID() ) !!}

    <div class="custom-summary">            
      @if ($limit && !$limit_membership && !$sale && !$price || $count_download == $limits_amount && !$sale && !$price) 
        @if(get_field('link_limit', 'option'))
          <div class="bottom-summary col-12 mt-4 mb-4 w-100">
            <a class="btn-limit" href="{{ get_field('link_limit', 'option') }}" id="somdn-form-submit-button">{{ _e('Upgrade to download', 'premast') }}</a>  
          </div>
          @if($time > $_COOKIE['lastview'])
            <div class="modal" tabindex="-1" role="dialog" id="LimitDownload" >
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <img src="{{ get_theme_file_uri().'/resources/assets/images' }}/laptop.png" alt="Upgrade Your Plan">
                    <h3>{{ _e('You have reached your download limit for today!', 'premast') }}</h3>
                    <h5 class="modal-title">{{ _e('you can come back tomorrow to enjoy 2 more downloads, or upgrade plan for unlimited downloads!', 'premast') }}</h5>
                    <p><a class="btn-limit" href="{{ get_field('link_pricing', 'option') }}">{{ _e('Upgrade Your Plan', 'premast') }}</a></p>
                    <p><a class="btn-referral" href="{{ the_field('link_page_referral', 'option')}}"><i class="fa fa-users" aria-hidden="true"></i> {{ _e('Or Invite a friend and get a Free month', 'premast') }}</a></p>
                    <p><a class="cancel" href="#" class="close" data-dismiss="modal" aria-label="Close">{{ _e('cancel', 'premast') }}</a></p>
                  </div>
                </div>
              </div>
            </div>
            <script>
              jQuery(function($) {
                $('#LimitDownload').modal('show')
              });
            </script>
          @endif
        @endif
      @else 
        @if ($in_cart) 
        @php $link = wc_get_cart_url(); @endphp
          <p class="full-access">
            <a href="{{ $link }}">{{ _e('view cart', 'premast') }}</a>
          </p>
        @else
          @if($price == 0) 
            <div class="free">
              @php  
                do_action( 'woocommerce_single_product_summary' );
              @endphp
            </div>
          @else
            @php  
              do_action( 'woocommerce_single_product_summary' );
            @endphp
          @endif
        @endif
        @if($price != 0)
          <p class="full-access">
            <span>{{ _e('OR', 'premast') }}</span>
            <a href="{{ the_field('link_pricing', 'option') }}">{{ the_field('link_text_pricing', 'option') }}</a>
          </p>
        @endif
      @endif
    </div>
    @if(current_user_can( 'edit_post', get_the_ID() ) && (get_the_author_meta('ID') == $current_user->ID) || is_super_admin())
      <p class="mb-0 mb-0 text-primary text-center p-2 bottun-edit"><a href="{{ the_field('link_edit_item', 'option') }}?post_id={{ the_ID() }}">{{ _e('edit Product') }}</a></p>
    @endif
    @if ( !is_user_logged_in() && $price == 0)
      <a class="mt-3 login" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Login to Download Now', 'premast') }}</a>
    @endif
    @if($price != 0)
      <div class="row secure-payment">
        <div class="col-md-12 col-12 text-center"><img src="{{ get_theme_file_uri().'/dist/images/2checkout-3.png' }}" alt="2Checkout"></div>
      </div>
    @endif
    @php $form_id = get_field('froms_problem_with_download', 'option' );@endphp
    @if($form_id)
      <p class="form-probelm">{{ _e('there is a problem with download', 'premast') }} <a class="modal-forms" data-toggle="modal" data-target="#ReportAProblem">{{ _e('click here', 'premast') }}</a></p>
      <!-- Modal -->
      <div class="modal fade" id="ReportAProblem" tabindex="-1" role="dialog" aria-labelledby="ReportAProblemTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4>{{ _e('Report a problem', 'premast') }}</h4>
            </div>
            <div class="modal-body">              
                {!! do_shortcode( '[gravityform id="'.$form_id['id'].'" name="" title="false" description="false" ajax="true" ]' ) !!}
                <button type="button" class="cancel" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">{{ _e('cancel', 'premast') }}</span>
                </button>    
            </div>
          </div>
        </div>
      </div>
    @endif
  @endif
</div>

<style>
  .custom-summary .free button#somdn-form-submit-button:after {
    content: "Download For Free";
    font-weight: 500;
    font-size: 18px;
    line-height: 21px;
  }
  .download-product .free button#somdn-form-submit-button {
    font-size: 0;
  }
</style>