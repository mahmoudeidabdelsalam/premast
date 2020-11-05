@extends('layouts.app-items')
@section('content')
  @while(have_posts()) @php the_post() @endphp

  <div id="product-{{ the_ID() }}" {!! wc_product_class() !!}>
    @php
      $more   = isset($_GET['more']) ? $_GET['more'] : '0';
      $permalink = get_permalink();
      $title = get_the_title();
      $counter = get_post_meta( 'counter', true );
      $counter_download = get_post_meta('counterdownload', true );

      do_action( 'woocommerce_before_single_product' );
      if ( post_password_required() ) {
        echo get_the_password_form(); // WPCS: XSS ok.
        return;
      };

      global $product;

      $link = get_the_permalink();
      $tags = wp_get_post_terms( get_the_id(), 'product_tag' );

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

      $tags = wp_get_post_terms( get_the_id(), 'product_tag' );
    @endphp



    <!-- Shareing -->
    <div class="sharing-posts">
      <ul class="list-inline social-sharer m-0 p-1 pull-left">
        <li class="list-inline-item">
          <span class="counters"> <number id="counter" class="namber-share">{{ empty($counter) ? 0 : $counter}}</number> <small>{{ _e('share', 'premast')}}</small></span>
        </li>
        <li class="list-inline-item">
          <a class="counter linkedin"  data-network="linkedin" data-url="{{ $permalink}}" data-title="{{ $title}}"   data-action="counter" data-event="counter" data-id="{{ get_the_ID()}}"  data-url="{{ get_the_permalink()}}" href="#"> <i class="fa fa-linkedin"></i></a>
        </li>
        <li class="list-inline-item">
          <a class="counter twitter"   data-network="twitter"  data-url="{{ $permalink}}" data-title="{{ $title}}"   data-action="counter" data-event="counter" data-id="{{ get_the_ID()}}"  data-url="{{ get_the_permalink()}}" href="#"> <i class="fa fa-twitter"></i></a>
        </li>
        <li class="list-inline-item">
          <a class="counter facebook"  data-network="facebook" data-url="{{ $permalink}}" data-title="{{ $title}}"   data-action="counter" data-event="counter" data-id="{{ get_the_ID()}}"  data-url="{{ get_the_permalink()}}" href="#"> <i class="fa fa-facebook"></i></a>
        </li>
        <li class="list-inline-item hidden-sm-down">
          <a class="item-share" href="mailto:?subject={{ $title }}&body=I would like to share the attached article from the forum. {{ $permalink }}" target="_top"><i class="fa fa-envelope-o"></i></a>
        </li>
        <li class="list-inline-item hidden-sm-down">
          <a class="item-share" href="#" onclick="window.print()"><i class="fa fa-print"></i></a>
        </li>
      </ul>
    </div>

    @if($more == 'fullScreen')
      <div class="container mt-md-5 relative">
        <div class="row pt-md-5">
          <a class="BackToSingle" href="{{ $link }}"><i class="fa fa-times" aria-hidden="true"></i></a>
          @php
            $attachment_ids = $product->get_gallery_image_ids();
          @endphp
          @if ($attachment_ids)
              @foreach( $attachment_ids as $attachment_id )
                @php $large = wp_get_attachment_image_url( $attachment_id, 'full' );@endphp
                <div class="carousel-img">
                  <img src="<?= $large; ?>" class="d-block w-100 lazyload" alt="slide">
                </div>
              @endforeach
          @endif
        </div>
      </div>
    @else


      <!-- Main Content -->
      <div class="container mt-md-5 mb-5 p-5">
        <div class="row">
          <div class="col-md-12 col-12">
            <?php woocommerce_breadcrumb(); ?> / {{ the_title() }}
            <br>
            <h1 class="product-title">{{ the_title() }}</h1>
          </div>

          <!-- Gallery & Content -->
          <div class="col-md-8 col-12">



            @php
              do_action( 'woocommerce_before_single_product_summary' );
            @endphp
            @php
              $attachment_ids = $product->get_gallery_image_ids();
            @endphp
            @if ($attachment_ids)
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  @php $counter = 0; @endphp
                  @foreach( $attachment_ids as $attachment_id )
                    @php $large = wp_get_attachment_image_url( $attachment_id, 'medium_large' ); $counter++; @endphp
                    <div class="carousel-item @if($counter == 1) active @endif">
                      <a href="{{ $link }}/?more=fullScreen">
                        <img src="<?= $large; ?>" class="d-block w-100 lazyload" alt="slide">
                      </a>
                    </div>
                  @endforeach
                </div>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>

                <ol class="carousel-indicators">
                  @php $counter = -1; @endphp
                  @foreach( $attachment_ids as $attachment_id )
                    @php $counter++; $thumb = wp_get_attachment_image_url( $attachment_id, 'thumbnail' );@endphp
                    @if($counter <= 5)
                      <li data-target="#carouselExampleIndicators" data-slide-to="<?= $counter; ?>" class="@if($counter == 1) active @endif"><img src="<?= $thumb; ?>" class="d-block w-100 lazyload" alt="slide"></li>
                    @endif
                  @endforeach
                  <li class="showMoreImg">
                    <a href="{{ $link }}/?more=fullScreen">{{ _e('Show More', 'premast') }}</a>
                  </li>
                </ol>
              </div>
            @else
              <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="card-img-top" alt="{{ the_title() }}">
            @endif






            <div class="product-infomation">
              <h3>{{ _e('Description', 'premast') }}</h3>
              <div id="tab-description"> @php the_content() @endphp</div>
            </div>




            @if ($tags)
              <div class="tag-post">
              {{ _e('Tags', 'premast') }}
                <ul class="list-inline">
                  @foreach( $tags as $tag )
                    @php
                      $term_link = get_term_link( $tag );
                      if ( is_wp_error( $term_link ) ) {
                          continue;
                      }
                    @endphp
                    <li class="list-inline-item"><a href="{{ $term_link  }}">{{ $tag->name }}</a></li>
                  @endforeach
                </ul>
              </div>
            @endif



            @include('partials/incloud/comments')


          </div> <!-- End Col-8 Content -->


          <!-- sideBar Content -->
          <div class="summary entry-summary col-md-4 col-12 sidebar-shop">

            @include('partials/incloud/price-item')

            @if(get_field('ads_image'))
              <div class="ads-block">
                <a href="{{ the_field('ads_link') }}"><img src="{{ the_field('ads_image') }}" alt="{{ _e('Ads Block', 'premast') }}"></a>
              </div>
            @endif

            @php dynamic_sidebar('sidebar-shop') @endphp

            <div class="box-author box-counter">
              <div class="downloader">
                @if ($rating_count > 0)
                  <div class="rating-item"> {!! wc_get_rating_html($average, $rating_count) !!} <span itemprop="reviewCount">{{ $review_count }} {{ _e('review', 'premast') }}</span></div>
                @else
                  {!! wc_get_rating_html('1', '5') !!}
                  <div class="rating-item"><span itemprop="reviewCount">{{ _e('0', 'premast') }}</span></div>
                @endif
                <div class="downloader-item"><span class="counter-download"><strong>{{ empty($counter_download) ? 0 : $counter_download}}</strong> {{ _e('Download', 'premast') }}</span></div>
              </div>


              <div class="box-counter m-0">
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

                    @if (is_user_logged_in())

                      @if ($followers && in_array( $current_user->ID, $followers ))
                        <a class="follow unfollow" href="javascript:void(0)" data-event="unfollow" data-user="<?= $current_user->ID; ?>" data-author="<?= get_the_author_meta( 'ID' ); ?>"><span class="fo-text">{{ _e('unfollow', 'premast') }}</span> <span id="fo-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></a>
                      @else
                        <a class="follow" href="javascript:void(0)" data-event="follow" data-user="<?= $current_user->ID; ?>" data-author="<?= get_the_author_meta( 'ID' ); ?>"><span class="fo-text">{{ _e('follow', 'premast') }}</span> <span id="fo-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></a>
                      @endif
                    @else
                      <a class="login follow" href="#" data-toggle="modal" data-target="#LoginUser">Login for follow</a>
                    @endif
                  </h5>
                  <p>{{ _e('Total uploads:', 'premast') }} {{ $user_post_count }}</p>
                </div>
              </div>
            </div>





          </div><!-- End Col-4 sideBar -->

        </div>
      </div>

    @endif
  </div>


































          {{-- styleing the sharemeta --}}
<style>
  .social-sharer {
    position: fixed;
    flex-flow: column;
    left: 0;
    width: auto;
}

.sharing-posts {
    left: 0;
    position: fixed;
}
.social-sharer li .counter, .social-sharer li .item-share {
    color: #1E6DFB;
    height: 35px;
    width: 35px;
    border-radius: 2px;
    background-color: transparent;
    display: inline-block;
    text-align: center;
    padding-top: 6px;
    border: 1px solid #E3E3E3;
    margin-top: 9px;
    border-radius: 20px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    text-align:center;
    align-items: center;
}
.social-sharer li {
    font-size: 16px;
    margin-right: 8px !important;
}
.social-sharer li .counter.linkedin, .social-sharer li .item-share.linkedin  {
    background-color: transparent;
}
.social-sharer li .counter.facebook, .social-sharer li .item-share.facebook {
    background-color:transparent;
}
.social-sharer li .counter.twitter, .social-sharer li .item-share.twitter {
     background-color:transparent;
}
/* sider */
.carousel-img {
          width: 100%;
          border: 1px solid #f5f5f5;
          padding: 10px;
          margin: 20px 0;
          border-radius: 8px;
        }

        .carousel-img img {
          border-radius: 8px;
        }

        .BackToSingle {
          position: absolute;
          right: 5%;
          top: 120px;
          border: 1px solid #f00;
          width: 30px;
          height: 30px;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 100%;
          color: #f00;
          font-size: 18px;
        }

        .carousel-img {
          width: 100%;
          border: 1px solid #f5f5f5;
          padding: 10px;
          margin: 20px 0;
          border-radius: 8px;
        }

        .carousel-img img {
          border-radius: 8px;
        }

        .BackToSingle {
          position: absolute;
          right: 5%;
          top: 120px;
          border: 1px solid #f00;
          width: 30px;
          height: 30px;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 100%;
          color: #f00;
          font-size: 18px;
  }
  .tag-post li.list-inline-item {
    border: 1px solid #E3E3E3;
    border-radius: 19px;
    font-family: 'Roboto';
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 21px;
    letter-spacing: 0.04px;
    color: #1E6DFB !important;
    background:#F9F9F9;
    padding: 4px 10px 4px 10px;
}
.tag-post {
  font-family:'Roboto';
    font-style: normal;
    font-weight: bold;
    font-size: 18px;
    line-height: 27px;
    color: #000000;
    display:flex;
}
ul.list-inline {
    padding-left: 9px;
}
.tag-post ul.list-inline li.list-inline-item a {
    color: #1E6DFB;

}
.box-counter {
  border : none;
  box-shadow:none;
}
.star-rating {
  width:17.5em!important;
}
.box-author.box-counter {
 border: 1px solid #E3E3E3;
 box-sizing: border-box;
 box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
 border-radius: 8px;
padding: 15px;
}

.box-counter {
    padding: 3px;
}
.box-author h3 {
  padding-top:12px;
}
.rating-item span {
    font-weight: 400;
}

.media-body.pt-3 {
  padding-right:10px;
}
a.login.follow {
  margin-top:11px;
}
a.follow {
  background:transparent!important;
  color:#3F4A59!important;
  border:1px solid #3F4A59;
}

.box-counter h3 {
  font-weight:700;
  color: #000000;
  font-size:18px;
}

span.counter-download {
    font-weight: 700;
}

</style>

  @endwhile
  @endsection


