@extends('layouts.app-items')

@section('content')


  @while(have_posts()) @php the_post() @endphp
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
      $limit = somdn_has_user_reached_limit(get_the_ID(), $current_user->ID);
      $limit_membership = wc_memberships_get_user_active_memberships($current_user->ID);
      $author = get_the_author_meta('ID');
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

      $excerpt = get_the_excerpt();


      $followers = get_user_meta( $author, 'follow_authors' , true );
      // dd($follow_authors);
    @endphp



    <div id="product-{{ the_ID() }}" {!! wc_product_class() !!}>
      <div class="container custom-container mt-5 mb-5 pt-5">
        <div class="row justify-content-center m-0">
          <div class="col-12">
            <?php woocommerce_breadcrumb(); ?>
            <br>
            <h1 class="product-title">{{ the_title() }}</h1>
          </div>

          <div class="col-md-8 col-12">

            <div class="row mb-5">
              <div class="col-12">
                @php
                  do_action( 'woocommerce_before_single_product_summary' );
                @endphp
                @php
                  $attachment_ids = $product->get_gallery_image_ids();
                @endphp
                @if ($attachment_ids)
                  <ul id="imageGallery" class="cS-hidden">
                    @foreach( $attachment_ids as $attachment_id )
                      @php
                        $large = wp_get_attachment_image_url( $attachment_id, 'medium_large' );
                        $thumb = wp_get_attachment_image_url( $attachment_id, 'thumbnail' );
                      @endphp
                      <li data-thumb="{{ $thumb }}" data-src="{{ wp_get_attachment_url( $attachment_id ) }}">
                        <img src="{{ $large }}" alt="{{ the_title() }}">
                      </li>
                    @endforeach
                  </ul>
                @else
                  <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="card-img-top" alt="{{ the_title() }}">
                @endif
                @if ( !wp_is_mobile() )
                  @if (get_field('slide_gallery'))
                    <div class="embed-container">
                      {{ the_field('slide_gallery') }}
                    </div>
                  @endif

                  <div class="product-infomation">
                    <h3>{{ _e('Description', 'premast') }}</h3>
                    <div id="tab-description"> @php the_content() @endphp</div>
                  </div>
                @endif
              </div>
            </div>
            @if ( !wp_is_mobile() )
              @include('partials/incloud/comments')
            @endif
          </div>

          <div class="summary entry-summary col-md-4 col-12 sidebar-shop">

            @include('partials/incloud/price-item')



            @if(get_field('ads_image'))
              <div class="ads-block">
                <a href="{{ the_field('ads_link') }}"><img src="{{ the_field('ads_image') }}" alt="{{ _e('Ads Block', 'premast') }}"></a>
              </div>
            @endif

            @php dynamic_sidebar('sidebar-shop') @endphp

            @include('partials/incloud/sharemeta')




            @if ( wp_is_mobile() )
              @if (get_field('slide_gallery'))
                <div class="embed-container">
                  {{ the_field('slide_gallery') }}
                </div>
              @endif

              <div class="product-infomation">
                <h3>{{ _e('Description', 'premast') }}</h3>
                <div id="tab-description">{!! get_the_content() !!}</div>
              </div>
            @endif

            <div class="box-author box-counter">

              <h3>{{ _e('published by', 'premast') }}</h3>

              @php
                $avatar = get_field('owner_picture', 'user_'. $author );
                $user_post_count = count_user_posts( $author , 'product' );
              @endphp
              <div class="media author-media">
                @if($avatar)
                  <div class="avatar align-self-center mr-3">
                    <img src="{{ $avatar['url'] }}" alt="{!! get_the_author_meta('display_name', $author) !!}">
                  </div>
                @else
                  {!! get_avatar( get_the_author_meta('ID', $author), '94', null, null, array( 'class' => array( 'align-self-start', 'mr-3' ) ) ) !!}
                @endif
                <div class="media-body pt-3">
                  <h5 class="mt-0 text-black">
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>

                    @if (in_array( $current_user->ID, $followers ))
                      <a class="follow unfollow" href="javascript:void(0)" data-event="unfollow" data-user="<?= $current_user->ID; ?>" data-author="<?= get_the_author_meta( 'ID' ); ?>"><span class="fo-text">{{ _e('unfollow', 'premast') }}</span> <span id="fo-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></a>
                    @else
                      <a class="follow" href="javascript:void(0)" data-event="follow" data-user="<?= $current_user->ID; ?>" data-author="<?= get_the_author_meta( 'ID' ); ?>"><span class="fo-text">{{ _e('follow', 'premast') }}</span> <span id="fo-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></a>
                    @endif
                  </h5>
                  <p>{{ _e('Total uploads:', 'premast') }} {{ $user_post_count }}</p>
                </div>
              </div>
            </div>

              @if ( wp_is_mobile() )
                @include('partials/incloud/comments')
              @endif
          </div>
        </div>
      </div>
    </div>

    @php
      $related = related_posts();
      $related_author = related_author();
    @endphp

    <section class="pb-5 pt-5 related">
      @if($related->have_posts())
        <div class="container">
          <h3>{{ _e('related Items', 'premast') }}</h3>
          <div class="item-columns row m-0 col-12 p-0">
            @while($related->have_posts() ) @php($related->the_post())
              @include('partials/incloud/card-user')
            @endwhile
            @php (wp_reset_postdata())
          </div>
        </div>
      @endif
      @if($related_author->have_posts())
        <div class="container">
          <h3>{{ _e('More from the same author', 'premast') }}</h3>
          <div class="item-columns row m-0 col-12 p-0">
            @while($related_author->have_posts() ) @php($related_author->the_post())
              @include('partials/incloud/card-user')
            @endwhile
            @php (wp_reset_postdata())
          </div>
        </div>
      @endif
    </section>

    <section class="download-footer">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-12">
            <div class="media">
              <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="align-self-center mr-3" alt="{{ the_title() }}">
              <div class="media-body pt-4">
                <h5 class="mt-0">{{ the_title() }}</h5>
                <p class="text-description">{!! $excerpt !!}</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-12 d-flex">
            <div class="bottom-summary col align-self-center">
              @if(in_array($product_id, $product_ids))
                <a class="click-downloads" href="#"><span class="price">{{ _e('Download Now', 'premast') }}</span></a>
              @else
                @if ( !is_user_logged_in() && $price == 0)
                  <a class="login" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Login to Download Now', 'premast') }}</a>
                @else
                <a class="click-downloads" href="#">
                  @if($sale)
                    {{ _e('buy Now for', 'premast') }}
                    <span class="price">
                      <del>
                        <span class="woocommerce-Price-amount amount">{{ $price }}<span class="woocommerce-Price-currencySymbol">{!! $symbol !!}</span></span>
                      </del>
                      <span>
                        <span class="woocommerce-Price-amount amount">{{ $sale }}<span class="woocommerce-Price-currencySymbol">{!! $symbol !!}</span></span>
                      </span>
                    </span>
                  @elseif($price)
                    {{ _e('buy Now for', 'premast') }}
                    <span class="price">
                      <span>
                        <span class="woocommerce-Price-amount amount">{{ $price }}<span class="woocommerce-Price-currencySymbol">{!! $symbol !!}</span></span>
                      </span>
                    </span>
                  @else
                    <span class="price">{{ _e('Download Now', 'premast') }}</span>
                  @endif
                </a>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>

    <script type="text/javascript">
      jQuery(function($) {

        $('.click-downloads').click(function () {
          $('.woocommerce div.product form.cart .button').click();
        });

        $('.click-downloads').click(function () {
          $('button#somdn-form-submit-button').click();
        });



        $("body").on("click", ".follow", function () {
          var user_id = $('.follow').data('user');
          var author_id = $('.follow').data('author');
          var event = $('.follow').data('event');


          $.ajax({
            url: "<?= admin_url( 'admin-ajax.php' ); ?>",
            type: 'post',
            data: {
              action: "get_author_follower",
              user_id: user_id,
              author_id: author_id,
              event: event,
            },
            beforeSend: function () {
              $('#fo-loader').show();
            },
            success: function (response) {
              $('#fo-loader').hide();

              if(response == 'follow') {
                $('.follow .fo-text').text('unfollow');
                $('.follow').addClass('unfollow');
                $('.follow').attr("data-event","unfollow");
                event = 'unfollow';
              } else if(response == 'unfollow') {
                $('.follow .fo-text').text('follow');
                $('.follow').removeClass('unfollow');
                $('.follow').attr("data-event","follow");
                event = 'follow';
              }
            },
          });
        });

      });
    </script>

    <style>
      .author-media h5 .unfollow {
        background-color: #ec0000;
      }

      .timeline-item {
        background-color: #fff;
        border: 1px solid rgb(227, 227, 227);
        box-sizing: border-box;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 12px;
        margin: 0 auto;
        max-width: 100%;
        min-height: 690px;
        padding-top: 75px;
      }

      @keyframes placeHolderShimmer {
        0%{ background-position: -468px 0; }
        100%{ background-position: 468px 0; }
      }

      .animated-background {
        animation-duration: 1.5s;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
        animation-name: placeHolderShimmer;
        background: #f6f7f8;
        background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
        background-size: 800px 104px;
        height: 690px;
        position: relative;
      }

      .background-masker {
        background: #fff;
        position: absolute;
      }

      /* Every thing below this is just positioning */
      .background-masker.content-top {
        top: 85%;
        left: 0;
        right: 0;
        height: 20px;
      }

      .background-masker.content-top {
        height:20px;
      }

      .background-masker.content-one,
      .background-masker.content-two,
      .background-masker.content-three,
      .background-masker.content-four,
      .background-masker.content-five {
        width: 4px;
        height: 85px;
        top: 88%;
      }

      .background-masker.content-one  {
        left: 110px;
      }

      .background-masker.content-two {
        left: 220px;
      }

      .background-masker.content-three {
        left: 330px;
      }

      .background-masker.content-four {
        left: 440px;
      }

      .background-masker.content-five {
        left: 550px;
      }
      .download-product p.price {
        font-weight:700;
        font-family:'Roboto' , sans-serif;
      }
    </style>
  @endwhile
@endsection
