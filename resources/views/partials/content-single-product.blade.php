@extends('layouts.app-items')

@section('content')


   @while (have_posts())
      @php the_post() @endphp
      @php
         $more = isset($_GET['more']) ? $_GET['more'] : '0';
         $test = isset($_GET['test']) ? $_GET['test'] : '0';
         
         do_action('woocommerce_before_single_product');
         if (post_password_required()) {
             echo get_the_password_form(); // WPCS: XSS ok.
             return;
         }
         
         global $product;
         
         $link = get_the_permalink();
      @endphp


      @if ($more == 'fullScreen')
         <div class="container mt-md-5 relative">
            <div class="row pt-md-5">
               <a class="BackToSingle" href="{{ $link }}"><i class="fa fa-times"
                     aria-hidden="true"></i></a>
               @php
                  $attachment_ids = $product->get_gallery_image_ids();
               @endphp
               @if ($attachment_ids)
                  @foreach ($attachment_ids as $attachment_id)
                     @php $large = wp_get_attachment_image_url( $attachment_id, 'full' );@endphp
                     <div class="carousel-img">
                        <img src="<?= $large ?>" class="d-block w-100 lazyload" alt="slide">
                     </div>
                  @endforeach
               @endif
            </div>
         </div>

         <style>
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
         </style>
      @else
         @php
            global $current_user;
            wp_get_current_user();
            $limit = somdn_has_user_reached_limit(get_the_ID(), $current_user->ID);
            $limit_membership = wc_memberships_get_user_active_memberships($current_user->ID);
            $author = get_the_author_meta('ID');
            $price = get_post_meta(get_the_ID(), '_regular_price', true);
            $sale = get_post_meta(get_the_ID(), '_sale_price', true);
            $symbol = get_woocommerce_currency_symbol();
            global $product;
            $product_id = $product->get_id();
            $downloads = WC()->customer->get_downloadable_products();
            $has_downloads = (bool) $downloads;
            $product_ids = [];
            foreach ($downloads as $download) {
                $ids = $download['product_id'];
                $product_ids[] = $ids;
            }
            $in_cart = false;
            foreach (WC()->cart->get_cart() as $cart_item) {
                $product_in_cart = $cart_item['product_id'];
                if ($product_in_cart === $product_id) {
                    $in_cart = true;
                }
            }
            $membership_user = $current_user->ID;
            $count_download = somdn_get_user_downloads_count($membership_user);
            $download_limits = somdn_get_user_limits($membership_user);
            $limits_amount = $download_limits['amount'];
            $time = get_the_time('Y-m-d');
            
            $excerpt = get_the_excerpt();
            
            $followers = get_user_meta($author, 'follow_authors', true);
            
         @endphp



         <div id="product-{{ the_ID() }}" {!! wc_product_class() !!}>
            <div class="container custom-container mt-md-5 mb-5 pt-md-5">
               <div class="row justify-content-center m-0">
                  <?php dynamic_sidebar('single_product_top'); ?>
                  <div class="col-12">
                     <?php woocommerce_breadcrumb(); ?>
                     <br>
                     <h1 class="product-title">{{ the_title() }}</h1>
                  </div>

                  <div class="col-md-8 col-12">

                     <div class="row mb-5">
                        <div class="col-12">
                           @php
                              do_action('woocommerce_before_single_product_summary');
                           @endphp
                           @php
                              $attachment_ids = $product->get_gallery_image_ids();
                           @endphp
                           @if ($attachment_ids)
                              <div id="carouselExampleIndicators" class="carousel slide"
                                   data-ride="carousel">
                                 <div class="carousel-inner">
                                    @php $counter = 0; @endphp
                                    @foreach ($attachment_ids as $attachment_id)
                                       @php
                                          $large = wp_get_attachment_image_url($attachment_id, 'medium_large');
                                          $counter++;
                                       @endphp
                                       <div
                                            class="carousel-item @if ($counter == 1) active @endif">
                                          <a href="{{ $link }}/?more=fullScreen">
                                             <img src="<?= $large ?>" class="d-block w-100 lazyload"
                                                  alt="slide">
                                          </a>
                                       </div>
                                    @endforeach
                                 </div>

                                 <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                    role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                 </a>
                                 <a class="carousel-control-next" href="#carouselExampleIndicators"
                                    role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                 </a>

                                 <ol class="carousel-indicators">
                                    @php $counter = -1; @endphp
                                    @foreach ($attachment_ids as $attachment_id)
                                       @php
                                          $counter++;
                                          $thumb = wp_get_attachment_image_url($attachment_id, 'thumbnail');
                                       @endphp
                                       @if ($counter <= 5)
                                          <li data-target="#carouselExampleIndicators"
                                              data-slide-to="<?= $counter ?>"
                                              class="@if ($counter == 1)
active
@endif">
                                             <img src="<?= $thumb ?>" class="d-block w-100 lazyload"
                                                  alt="slide">
                                          </li>
                                       @endif
                                    @endforeach
                                    <li class="showMoreImg">
                                       <a
                                          href="{{ $link }}/?more=fullScreen">{{ _e('Show More', 'premast') }}</a>
                                    </li>
                                 </ol>
                              </div>
                           @else
                              <img src="{{ Utilities::global_thumbnails(get_the_ID(), 'full') }}"
                                   class="card-img-top" alt="{{ the_title() }}">
                           @endif

                           @if (!wp_is_mobile())
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
                     @if (!wp_is_mobile())
                        @include('partials/incloud/comments')
                     @endif
                  </div>

                  <div class="summary entry-summary col-md-4 col-12 sidebar-shop">

                     @include('partials/incloud/price-item')


                     @if (get_field('ads_image'))
                        <div class="ads-block">
                           <a href="{{ the_field('ads_link') }}"><img
                                   src="{{ the_field('ads_image') }}"
                                   alt="{{ _e('Ads Block', 'premast') }}"></a>
                        </div>
                     @endif
                     {{-- //SECTION - custom design request widget --}}
                     <custom-design></custom-design>

                     @php dynamic_sidebar('sidebar-shop') @endphp

                     @include('partials/incloud/sharemeta')




                     @if (wp_is_mobile())
                        @if (get_field('slide_gallery'))
                           <div class="embed-container">
                              {{ the_field('slide_gallery') }}
                           </div>
                        @endif

                        <div class="product-infomation">
                           <h3>{{ _e('Description', 'premast') }}</h3>
                           <div id="tab-description">{{ the_content() }}</div>
                        </div>
                     @endif

                     <div class="box-author box-counter">

                        <h3>{{ _e('published by', 'premast') }}</h3>

                        @php
                           $avatar = get_field('owner_picture', 'user_' . $author);
                           $user_post_count = count_user_posts($author, 'product');
                        @endphp
                        <div class="media author-media">
                           @if ($avatar)
                              <div class="avatar align-self-center mr-3">
                                 <img src="{{ $avatar['url'] }}" alt="{!! get_the_author_meta('display_name', $author) !!}">
                              </div>
                           @else
                              {!! get_avatar(get_the_author_meta('ID', $author), '94', null, null, [
                                  'class' => ['align-self-start', 'mr-3'],
                              ]) !!}
                           @endif
                           <div class="media-body pt-3">
                              <h5 class="mt-0 text-black">
                                 <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php the_author(); ?></a>
                              </h5>
                              <p>{{ _e('Total uploads:', 'premast') }} {{ $user_post_count }}</p>
                           </div>
                           @if (is_user_logged_in())
                              @if ($followers && in_array($current_user->ID, $followers))
                                 <a class="follow unfollow" href="javascript:void(0)"
                                    data-event="unfollow" data-user="<?= $current_user->ID ?>"
                                    data-author="<?= get_the_author_meta('ID') ?>"><span
                                          class="fo-text">{{ _e('unfollow', 'premast') }}</span> <span
                                          id="fo-loader" style="display:none;"><i
                                          class="fa fa-spinner fa-spin"
                                          aria-hidden="true"></i></span></a>
                              @else
                                 <a class="follow" href="javascript:void(0)" data-event="follow"
                                    data-user="<?= $current_user->ID ?>"
                                    data-author="<?= get_the_author_meta('ID') ?>"><span
                                          class="fo-text">{{ _e('follow', 'premast') }}</span> <span
                                          id="fo-loader" style="display:none;"><i
                                          class="fa fa-spinner fa-spin"
                                          aria-hidden="true"></i></span></a>
                              @endif
                           @else
                              <a class="login follow" href="#" data-toggle="modal"
                                 data-target="#LoginUser">Login for follow</a>
                           @endif
                        </div>
                     </div>

                     @if (wp_is_mobile())
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
            @if ($related->have_posts())
               <div class="container">
                  <h3>{{ _e('related Items', 'premast') }}</h3>
                  <div class="item-columns row m-0 col-12 p-0">
                     @while ($related->have_posts())
                        @php $related->the_post(); @endphp
                        @include('partials/incloud/card-user')
                     @endwhile
                     @php wp_reset_postdata(); @endphp
                  </div>
               </div>
            @endif
            @if ($related_author->have_posts())
               <div class="container">
                  <h3>{{ _e('More from the same author', 'premast') }}</h3>
                  <div class="item-columns row m-0 col-12 p-0">
                     @while ($related_author->have_posts())
                        @php $related_author->the_post() @endphp
                        @include('partials/incloud/card-user')
                     @endwhile
                     @php wp_reset_postdata(); @endphp
                  </div>
               </div>
            @endif
         </section>

         @php
            $download_limit = somdn_get_user_limits($current_user->ID)['amount'];
            $download_count = somdn_get_user_downloads_count($current_user->ID);
            $item_id = get_the_ID();
            $user_reach_limit = somdn_has_user_reached_limit($item_id, $current_user->ID, false);
            // get woocmerce product
            $product = wc_get_product($item_id);
         @endphp

         <section class="download-footer">
            <div class="container">
               <div class="bottom-download-container">
                  <div class="item-details-container">
                     <img class="item-thumbnail"
                          src="{{ Utilities::global_thumbnails(get_the_ID(), 'thumbnail') }}"
                          alt="{{ the_title() }}">
                     <div class="item-details">
                        <h5 class="mt-0">{{ the_title() }}</h5>
                        <p class="text-description">{!! $excerpt !!}</p>
                     </div>
                  </div>
                  <div class="download-container">
                     <button class="pmst-download-button">
                        <a href="https://app.premast.com/template/{{ $product->get_slug() }}"
                           target="_blank">Download Now</a>
                     </button>

                  </div>
               </div>
            </div>
         </section>



         <script type="text/javascript">
            jQuery(function($) {

               $('.click-downloads').click(function() {
                  $('.woocommerce div.product form.cart .button').click();
               });

               $('.click-downloads').click(function() {
                  $('button#somdn-form-submit-button').click();
               });



               $("body").on("click", ".follow", function() {
                  var user_id = $('.follow').data('user');
                  var author_id = $('.follow').data('author');
                  var event = $('.follow').data('event');

                  $.ajax({
                     url: "<?= admin_url('admin-ajax.php') ?>",
                     type: 'post',
                     data: {
                        action: "get_author_follower",
                        user_id: user_id,
                        author_id: author_id,
                        event: event,
                     },
                     beforeSend: function() {
                        $('#fo-loader').show();
                     },
                     success: function(response) {
                        $('#fo-loader').hide();

                        if (response == 'follow') {
                           $('.follow .fo-text').text('unfollow');
                           $('.follow').addClass('unfollow');
                           $('.follow').attr("data-event", "unfollow");
                           event = 'unfollow';
                        } else if (response == 'unfollow') {
                           $('.follow .fo-text').text('follow');
                           $('.follow').removeClass('unfollow');
                           $('.follow').attr("data-event", "follow");
                           event = 'follow';
                        }
                     },
                  });
               });

            });
         </script>

         <style>
            .download-footer {
               background: #EEEDF5 !important;
               padding: 20px 0 !important;
            }

            .bottom-download-container {
               display: flex;
               justify-content: space-between;
               align-items: center;
            }

            .bottom-download-container .pmst-download-button {
               background-color: #1F75EE !important;
               color: #fff !important;
               border: none !important;
               padding: 10px 20px !important;
               border-radius: 50px !important;
               font-size: 16px !important;
               font-weight: 500 !important;
               cursor: pointer !important;
               font-family: 'Roboto', sans-serif !important;
            }

            .pmst-download-button a {
               color: #fff !important;
            }


            .item-details-container {
               display: flex;
               flex-direction: row;
               justify-content: space-between;
               align-items: center;
               gap: 20px;
            }

            .download-container {
               min-width: fit-content;
            }

            .item-thumbnail {
               width: 80px;
               height: 80px;
               object-fit: cover;
               border-radius: 8px;
            }




            /* Old style */

            .unfollow {
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
               0% {
                  background-position: -468px 0;
               }

               100% {
                  background-position: 468px 0;
               }
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
               height: 20px;
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

            .background-masker.content-one {
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
               font-weight: 700;
               font-family: 'Roboto', sans-serif;
            }

            .single .woocommerce-notices-wrapper {
               display: none;
            }

            .slide .carousel-indicators {
               position: relative;
               width: 100%;
               margin: 0;
               height: auto;
               bottom: auto;
               top: auto;
               left: auto;
               right: auto;
               overflow: hidden;
               white-space: nowrap;
               margin-top: 20px;
            }

            .slide .carousel-indicators li {
               width: auto;
               height: 85px;
               padding: 5px;
               border: 1px solid #e5e5e5;
               border-radius: 2px;
               flex: 0 0 auto;
               text-indent: 0;
            }

            .slide .carousel-indicators li img {
               height: 100%;
               width: auto !important;
            }

            .carousel-item {
               border: 1px solid #E3E3E3;
               border-radius: 8px;
               padding: 5px;
            }

            .carousel-item img {
               border-radius: 8px;
            }

            .slide .carousel-indicators li a {
               font-size: 12px !important;
               display: flex;
               position: relative;
               width: auto;
               color: #595959;
               padding: 10px;
               height: 100%;
               justify-content: center;
               align-items: center;
               border-radius: 2px;
               font-weight: 400;
            }

            li.showMoreImg {
               opacity: 1;
            }

            @media (max-width: 779px) {
               .slide .carousel-indicators li {
                  display: none;
               }

               .slide .carousel-indicators li[data-slide-to="0"],
               .slide .carousel-indicators li[data-slide-to="1"],
               .slide .carousel-indicators li.showMoreImg {
                  display: block;
               }
            }

            /* Mom'em custom styles */
            .follow {
               float: right;
               background: #1e6dfb;
               border-radius: 25px;
               font-weight: 400;
               font-size: 15px;
               line-height: 18px;
               letter-spacing: .132987px;
               text-transform: capitalize;
               color: #fff;
               padding: 5px 20px;
               position: relative;
               margin-top: 5px;
               min-width: fit-content;
            }

            h5.mt-0.text-black {
               font-size: 16px;
               font-weight: 400;
               font-style: unset;
               font-weight: 400;
            }

            .media-body p {
               font-size: 14px;
               font-weight: 400;
               font-family: 'Roboto';
            }

            .avatar.align-self-center.mr-3 {
               min-width: 44px;
               height: auto;
               margin-right: 10px !important;
               border: unset;
            }

            .media-body.pt-3 {
               display: flex;
               flex-direction: column;
               min-width: fit-content;
               padding: 0px !important;
            }

            .media.author-media {
               gap: 4px;
               display: flex;
               flex-wrap: wrap;
               justify-content: center;
               align-items: center;
            }

            .box-author.box-counter {
               padding: 20px;
            }

            .single-product-top {
               margin-bottom: 20px;
               width: 100%;
            }

            .download-product {
               margin-bottom: 20px;
            }
         </style>
      @endif
   @endwhile
@endsection
