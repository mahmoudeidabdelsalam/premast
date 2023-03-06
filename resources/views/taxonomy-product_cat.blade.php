@php
   // get url parameters
   $test_users_ids = [1, 2226, 3625, 3210, 2804, 2269, 217, 1010];
   $follow = isset($_GET['follow']) ? $_GET['follow'] : false;
   $refine = isset($_GET['refine']) ? $_GET['refine'] : '';
   $old = isset($_GET['old']) ? $_GET['old'] : false;
   // get variables
   $taxonomy_query = get_queried_object();
   $terms = get_terms('product_cat', ['parent' => $taxonomy_query->term_id, 'orderby' => 'slug', 'hide_empty' => false]);
   $current_user = wp_get_current_user();
   $following = get_user_meta($current_user->ID, 'following_user', true);
   $user_token = $results = [
       'current_user' => $current_user,
       'taxonomy_query' => $taxonomy_query,
       'following' => $following,
       'terms' => $terms,
       'user_token' => $user_token,
       'headline' => get_field('description_cat', $taxonomy_query),
   ];
   // check if current category has parent
   if ($taxonomy_query->parent == 0) {
       $parent = $taxonomy_query;
       $child = false;
   } else {
       // get the most top parent
       $parent = get_term($taxonomy_query->parent, 'product_cat');
       while ($parent->parent != 0) {
           $parent = get_term($parent->parent, 'product_cat');
       }
   }
   
@endphp


@extends('layouts.app-items')
@section('content')


   {{-- Test new items components --}}
   {{-- check if current user id included in $test_ids --}}
   {{-- @if ($current_user->ID === 1) --}}
   @if (!$old)
      <script>
         console.log('user roles', {!! json_encode($current_user->roles) !!})

         var user_token = {!! json_encode($user_token) !!};
         console.log('user is admin //////// ');
         console.log(user_token)
      </script>
      <pmst-items parentCategoryId="{{ $parent->term_id }}"
                  parentCategoryLink="{{ get_term_link($parent) }}"
                  params='{ "category": {{ $taxonomy_query->term_id }}, "page":{{ $paged = get_query_var('paged') ? get_query_var('paged') : 1 }} , "per_page": 24 , "search": "{{ $refine }}" }'
                  nonce='{{ wp_create_nonce('wp_rest') }}'
                  headline='{{ get_field('heading_cat', $taxonomy_query) }}'
                  subHeadline='{{ get_field('description_cat', $taxonomy_query) }}'>
      </pmst-items>
   @endif

   {{-- Test new items components --}}

   @if ($old === 'true')
      {{-- @if ($current_user->ID !== 1) --}}
      <div class="SwitchButtons">
         <div class="container-fluid">
            <div class="col-12">
               <a href="javascript:void(0);">
                  {{ _e('Show Filters', 'premast') }}
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                       xmlns="http://www.w3.org/2000/svg">
                     <path d="M14 6H8V0H6V6H0V8H6V14H8V8H14V6Z" fill="black" />
                  </svg>
               </a>
            </div>
         </div>
      </div>


      @php
         $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
         global $current_user;
         wp_get_current_user();
         global $wp;
         $taxonomy_query = get_queried_object();
         $terms = get_terms('product_cat', ['parent' => $taxonomy_query->term_id, 'orderby' => 'slug', 'hide_empty' => false]);
         
         $following = get_user_meta($current_user->ID, 'following_user', true);
         
         $follow = isset($_GET['follow']) ? $_GET['follow'] : false;
      @endphp
      <div class="container-fluid">
         <div class="row m-0">
            <div class="col-side" id="FilterSide" style="width: 0;">
               <h3>Show items</h3>

               @if (is_user_logged_in())
                  <div class="form-group form-check authors">
                     <input type="checkbox" class="form-check-input" id="CheckFollow"
                            {{ $follow ? 'checked' : '' }}>
                     <label class="form-check-label" for="CheckFollow">from authors you
                        follow</label>
                  </div>
               @endif

               <div class="ColSide sort">
                  <h3>sort by <strong>date</strong></h3>
                  <ul>
                     <li><a class="active" data-sort="date" data-name="date"
                           href="javascript:void(0);">date</a></li>
                     <li><a data-sort="featured" data-name="featured"
                           href="javascript:void(0);">featured</a></li>
                     <li><a data-sort="view" data-name="Popular" href="javascript:void(0);">Popular</a>
                     </li>
                     <li><a data-sort="date" data-name="Recent" href="javascript:void(0);">Recent</a>
                     </li>
                     <li><a data-sort="download" data-name="Downloaded"
                           href="javascript:void(0);">Downloaded</a></li>
                  </ul>
               </div>

               <div class="ColSide sort">
                  <h3>filter by</h3>
                  <ul>
                     @if ($taxonomy_query->parent)
                        @php
                           $term_parent = get_term_parents_list($taxonomy_query->parent, 'product_cat');
                           $term_link = get_term_link($taxonomy_query);
                           $termchildren = get_term_children($taxonomy_query->term_id, 'product_cat');
                        @endphp
                        <li class="list-item term-parent">
                           {!! rtrim($term_parent, '/') !!}
                        </li>
                        <li class="list-item">
                           <a class="text-term active"
                              href="{{ $term_link }}">{{ $taxonomy_query->name }} <span
                                    class="count-term">{{ $taxonomy_query->count }}</span></a>
                        </li>
                        @if ($termchildren)
                           @foreach ($termchildren as $child)
                              @php
                                 $term = get_term_by('id', $child, 'product_cat');
                              @endphp
                              <li class="list-item">
                                 <a class="text-term"
                                    href="{{ get_term_link($term) }}">{{ $term->name }} <span
                                          class="count-term">{{ $term->count }}</span></a>
                              </li>
                           @endforeach
                        @endif
                     @else
                        <li class="list-item">
                           <a class="text-term active"
                              href="#">{{ _e('All Categories', 'premast') }} <span
                                    class="count-term">{{ $taxonomy_query->count }}</span></a>
                        </li>
                        @php
                           $terms = get_terms('product_cat', ['parent' => $taxonomy_query->term_id, 'orderby' => 'slug', 'hide_empty' => false]);
                        @endphp
                        @foreach ($terms as $term)
                           @php
                              $term_link = get_term_link($term);
                              if (is_wp_error($term_link)) {
                                  continue;
                              }
                           @endphp
                           <li class="list-item">
                              <a class="text-term @if ($term->term_id == $taxonomy_query->term_id) active @endif"
                                 href="{{ $term_link }}">{{ $term->name }} <span
                                       class="count-term">{{ $term->count }}</span></a>
                           </li>
                        @endforeach
                     @endif

                     {{-- @foreach ($terms as $term)
          @php
            $term_link = get_term_link( $term );
            if ( is_wp_error( $term_link ) ) {
            continue;
            }
          @endphp
            <li><a href="{{ $term_link }}">{{ $term->name }}</a></li>
          @endforeach --}}
                  </ul>
               </div>
            </div>

            <div class="col-main" id="FilterMain">
               <div class="item-columns container-ajax item-card grid grid-custom row" id="freeItems">
                  @if (get_field('show_card_pricing', 'option'))
                     <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-12 grid-item">
                        <div class="card">
                           <div class="bg-featureImage featureImage">
                              <img src="{{ the_field('images_card_pricing', 'option') }}"
                                   class="card-img-top"
                                   alt="{{ the_field('heading_card_pricing', 'option') }}">
                              <div class="card-overlay"><a class="the_permalink"
                                    href="{{ the_field('lik_card_pricing', 'option') }}"></a>
                              </div>
                           </div>
                           <div class="card-body pt-2 pl-0 pr-0 pb-0">
                              <a class="card-link"
                                 href="{{ the_field('lik_card_pricing', 'option') }}">
                                 <h5 class="card-title font-weight-400">
                                    {{ the_field('heading_card_pricing', 'option') }}</h5>
                              </a>
                              <div class="review-and-download">
                                 {{ the_field('description_card_pricing', 'option') }}
                                 <span class="premium"><i class="fa fa-star"></i></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endif
                  @if (have_posts())
                     @while (have_posts())
                        @php the_post(); @endphp
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-12 grid-item">
                           <div class="card">

                              <ul class="meta-buttons">
                                 <li class="likes-button">
                                    {!! get_simple_likes_button(get_the_ID()) !!}
                                 </li>
                                 <li class="pinterest-share button-share">
                                    <a target="_blank"
                                       href="http://pinterest.com/pin/create/button/?url{{ the_permalink() }}=&media={{ Utilities::global_thumbnails(get_the_ID(), 'medium') }}&description={{ get_the_title() }}"
                                       class="pin-it-button" count-layout="horizontal">
                                       <small>Pin it</small> <i class="fa fa-pinterest-p"
                                          aria-hidden="true"></i>
                                    </a>
                                 </li>
                                 @if ((current_user_can('edit_post', get_the_ID()) &&
                                     get_the_author_meta('ID') == $current_user->ID) ||
                                     is_super_admin())
                                    <li class="edit-post button-share">
                                       <a class="post-edit-link"
                                          href="{{ the_field('link_edit_item', 'option') }}?post_id={{ the_ID() }}"><small>Edit</small>
                                          <i class="fa fa-pencil" aria-hidden="true"></a></i>
                                    </li>
                                 @endif
                              </ul>


                              <div class="bg-featureImage featureImage">
                                 @php
                                    $attachment_id = get_post_thumbnail_id(get_the_ID());
                                    $img_src = wp_get_attachment_image_url($attachment_id, 'medium');
                                    $img_srcset = wp_get_attachment_image_srcset($attachment_id, 'medium');
                                 @endphp
                                 {{-- <img src="{{ esc_url($img_src) }}" srcset="{{ esc_attr( $img_srcset ) }}" sizes="300px" class="card-img-top" alt="{{ the_title() }}"> --}}
                                 <img src="{{ esc_url($img_src) }}" class="card-img-top"
                                      alt="{{ the_title() }}">
                                 <div class="card-overlay"><a class="the_permalink"
                                       href="{{ the_permalink() }}"></a></div>
                              </div>


                              <div class="card-body pt-2 pl-0 pr-0 pb-0">
                                 <a class="card-link" href="{{ the_permalink() }}">
                                    <h5 class="card-title font-weight-400">
                                       {{ html_entity_decode(wp_trim_words(get_the_title(), '4', ' ...')) }}
                                    </h5>
                                 </a>
                                 <div class="review-and-download">
                                    <div class="review">
                                       @if (get_option('woocommerce_enable_review_rating') == 'yes')
                                          @php
                                             global $product;
                                             $rating_count = method_exists($product, 'get_rating_count') ? $product->get_rating_count() : 1;
                                             $review_count = method_exists($product, 'get_review_count') ? $product->get_review_count() : 1;
                                             $average = method_exists($product, 'get_average_rating') ? $product->get_average_rating() : 0;
                                             $counter_download = get_post_meta(get_the_ID(), 'counterdownload', true);
                                             $counter_view = get_post_meta(get_the_ID(), 'c95_post_views_count', true);
                                             $like = get_post_meta(get_the_ID(), '_post_like_count', true);
                                             $price = get_post_meta(get_the_ID(), '_regular_price', true);
                                          @endphp
                                          @if ($rating_count > 0)
                                             {!! wc_get_rating_html($average, $rating_count) !!}
                                             <span class="icon-review icon-meta"
                                                   itemprop="reviewCount">{{ $average }}</span>
                                          @else
                                             {!! wc_get_rating_html('1', '5') !!}
                                             <span class="icon-review icon-meta"
                                                   itemprop="reviewCount">{{ _e('0', 'premast') }}</span>
                                          @endif
                                       @endif

                                       <span class="icon-download icon-meta">
                                          <img class="img-meta"
                                               src="{{ get_theme_file_uri() . '/dist/images/icon-download.svg' }}"
                                               alt="Download">
                                          {{ $counter_download ? $counter_download : '0' }}
                                       </span>

                                       @if ((current_user_can('edit_post', get_the_ID()) &&
                                           get_the_author_meta('ID') == $current_user->ID) ||
                                           is_super_admin())
                                          <span class="icon-download icon-meta">
                                             <img class="img-meta"
                                                  src="{{ get_theme_file_uri() . '/dist/images/icon-view.svg' }}"
                                                  alt="Download">
                                             {{ $counter_view ? $counter_view : '0' }}
                                          </span>
                                       @endif

                                       <span class="icon-download icon-meta">
                                          <img class="img-meta"
                                               src="{{ get_theme_file_uri() . '/dist/images/like.png' }}"
                                               alt="like">
                                          {{ $like ? $like : '0' }}
                                       </span>
                                    </div>

                                    @if ($price)
                                       <span class="premium"><i class="fa fa-star"></i></span>
                                    @endif

                                 </div>
                              </div>
                           </div>
                        </div>
                     @endwhile
                  @else
                     <div class="col-12">
                        {{ __('Sorry, no results were found.', 'sage') }}
                     </div>
                  @endif

                  <div class="col-12 pt-5 pb-5">
                     <nav aria-label="Page navigation example">{{ premast_base_pagination([]) }}
                     </nav>
                  </div>
               </div>
   @endif


   <div class="loading" style="display:none;">
      <div class="loader4"></div>
   </div>
   </div>
   </div>
   </div>




   <style>
      body {
         background: white !important;
      }

      section.banner-items {
         min-height: 150px !important;
         padding-top: 40px !important;
         padding-bottom: 30px !important;
         margin-bottom: 50px !important;
      }

      section.banner-items h1 {
         font-style: normal;
         font-weight: bold;
         font-size: 30px;
         line-height: 35px;
         text-align: center;
         letter-spacing: 0.132987px;
         text-transform: capitalize;
         color: #282F39;
      }


      section.banner-items p {
         font-style: normal;
         font-weight: normal;
         font-size: 16px;
         line-height: 24px;
         text-align: center;
         letter-spacing: 0.04px;
      }

      section.banner-items .elementor-background-overlay-items {
         display: none;
      }

      .grid .grid-item .card {
         padding: 10px;
      }

      .grid .grid-item .card .card-body {
         padding: 10px 10px 0 10px !important;
         margin: 0 -10px -10px !important;
      }

      .SwitchButtons {
         position: absolute;
         top: -70px;
         left: 0;
      }

      .SwitchButtons a {
         background: #FFFFFF;
         border: 1px solid #E3E3E3;
         box-sizing: border-box;
         border-radius: 8px;
         width: 203px;
         height: 40px;
         display: flex;
         justify-content: space-between;
         align-items: center;
         padding: 0 20px 0 15px;
         font-style: normal;
         font-weight: normal;
         font-size: 14px;
         line-height: 21px;
         letter-spacing: 0.04px;
         color: #282F39;
      }

      div#panel {
         position: relative;
      }

      div#FilterSide {
         left: -300px;
         top: 0;
         transition: all 0.3s;
         opacity: 0;
         position: absolute;
         padding: 0 15px;
      }

      .is-open div#FilterSide {
         left: 0;
         position: relative;
         width: 20% !important;
         opacity: 1;
      }

      .is-open div#FilterMain {
         width: 80%;
      }

      .is-open .SwitchButtons a svg {
         transform: rotate(45deg);
      }

      .SwitchButtons a svg {
         transition: all 0.3s;
      }

      .is-open .SwitchButtons a {
         color: #1e6dfb;
      }

      div#FilterSide h3 {
         font-family: Roboto;
         font-style: normal;
         font-weight: normal;
         font-size: 14px;
         line-height: 16px;
         text-transform: capitalize;
         color: #282F39;
      }

      .authors {
         padding: 0 !important;
      }

      .authors input {
         display: none;
      }

      .authors label::after {
         content: "";
         height: 20px;
         width: 20px;
         border: 2px solid #A6A6A6;
         box-sizing: border-box;
         border-radius: 2px;
         display: inline-block;
         float: left;
         margin-right: 10px;
      }

      .authors input:checked+label::after {
         background: #13ba57;
         border: 2px solid #333;
      }

      .authors label {
         cursor: pointer;
         font-family: Roboto;
         font-style: normal;
         font-weight: normal;
         font-size: 14px;
         line-height: 21px;
         letter-spacing: 0.04px;
         color: #646464;
      }

      .ColSide {
         background: #F9F9F9;
         border: 1px solid #E3E3E3;
         box-sizing: border-box;
         border-radius: 8px;
         padding: 12px 15px 0;
         margin-bottom: 25px;
      }

      .ColSide h3,
      .ColSide ul li {
         font-style: normal;
         font-weight: normal;
         font-size: 14px;
         line-height: 16px;
         text-transform: capitalize;
         color: #282F39;
         border-bottom: 1px solid rgba(0, 0, 0, 0.25);
         padding: 12px 0;
      }

      .ColSide ul {
         padding: 0;
         list-style: none;
      }

      .ColSide ul li:last-child {
         border: none;
         padding-bottom: 0;
      }

      .ColSide ul li a.active {
         font-weight: bold;
         font-size: 14px;
         line-height: 16px;
         text-transform: capitalize;
         color: #282F39;
      }

      li.term-parent a {
         font-weight: 900 !important;
      }

      li.term-parent+li {
         padding-left: 5px;
      }

      span.count-term {
         display: none;
      }

      .text-term.active {
         font-weight: 900 !important;
      }

      .loader4 {
         width: 45px;
         height: 45px;
         display: inline-block;
         padding: 0px;
         border-radius: 100%;
         border: 5px solid;
         border-top-color: rgb(31, 108, 251);
         border-bottom-color: rgba(255, 255, 255, 0.3);
         border-left-color: rgb(74, 120, 206);
         border-right-color: rgba(255, 255, 255, 0.3);
         -webkit-animation: loader4 1s ease-in-out infinite;
         animation: loader4 1s ease-in-out infinite;
      }

      @keyframes loader4 {
         from {
            transform: rotate(0deg);
         }

         to {
            transform: rotate(360deg);
         }
      }

      @-webkit-keyframes loader4 {
         from {
            -webkit-transform: rotate(0deg);
         }

         to {
            -webkit-transform: rotate(360deg);
         }
      }

      div#FilterMain {
         position: relative;
         width: 100%;
      }

      .loading {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         text-align: center;
         background-color: rgba(255, 255, 255, 0.66);
         height: 100%;
         padding-top: 30px;
         border-radius: 8px;
      }


      .col-offer+.banner+.banner-items {
         margin-top: 115px !important;
      }

      @media (max-width: 579px) {
         section.banner-items {
            padding: 40px 15px !important;
         }

         .SwitchButtons,
         .SwitchButtons a {
            width: 100%;
         }

         div#FilterSide {
            left: 0 !important;
            width: 100% !important;
            height: 0;
         }

         .is-open div#FilterSide {
            width: 100% !important;
            height: auto;
         }

         div#FilterMain {
            width: 100% !important;
            transition: all .3s;
         }

         .ColSide ul {
            display: inline-block;
            width: 100%;
            overflow-x: scroll;
            overflow-y: hidden;
            position: static;
            padding-right: 20px;
            white-space: nowrap;
         }

         .ColSide ul li {
            margin: 0 8px;
            border: none;
         }

         .ColSide ul:after {
            content: "";
            width: 35px;
            height: 100%;
            position: absolute;
            background: linear-gradient(105deg, rgba(249, 249, 249, 0.55) 0.7%, #f9f9f9 100%);
            right: 0;
            top: 0;
            border-radius: 0 8px 8px 0;
         }

         .ColSide.sort {
            position: relative;
         }

         .ColSide ul li {
            float: none;
            display: inline-block;
         }
      }
   </style>


   <script>
      jQuery(function($) {
         var OpenSide = localStorage.getItem("OpenSide");

         if (OpenSide && OpenSide === "yes") {
            $('body').addClass('is-open');
         }

         $('.SwitchButtons').click(function() {
            $('body').toggleClass('is-open');
            var toggle = $('body').hasClass('is-open') ? 'yes' : 'no';
            localStorage.setItem('OpenSide', toggle);
         });

         $('#CheckFollow').on('change', function() {
            var checked = $('#CheckFollow').is(':checked');
            var arrayFromPHP = <?= json_encode($following) ?>;
            if (checked === false) {
               var sort = $('.sort').find('.active').data('sort');
               console.log(sort);
            }
            $.ajax({
               url: '<?php echo admin_url('admin-ajax.php'); ?>', // in backend you should pass the ajax url using this variable
               type: 'POST',
               data: {
                  action: 'get_sort_items',
                  checked: checked,
                  sort: sort,
                  term_id: '<?= $taxonomy_query->term_id ?>',
                  following: arrayFromPHP
               },
               beforeSend: function() {
                  $('.loading').show();
                  // $('body').removeClass('is-open');
               },
               success: function(data) {
                  $('#freeItems').html(data);
                  $('.loading').hide();
               }
            });
         });


         <?php if($follow): ?>
         var checked = true;
         var arrayFromPHP = <?= json_encode($following) ?>;
         if (checked === false) {
            var sort = $('.sort').find('.active').data('sort');
            console.log(sort);
         }
         $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>', // in backend you should pass the ajax url using this variable
            type: 'POST',
            data: {
               action: 'get_sort_items',
               checked: checked,
               sort: sort,
               term_id: '<?= $taxonomy_query->term_id ?>',
               following: arrayFromPHP
            },
            beforeSend: function() {
               $('.loading').show();
               // $('body').removeClass('is-open');
            },
            success: function(data) {
               $('#freeItems').html(data);
               $('.loading').hide();
            }
         });
         <?php endif; ?>

         $('body').on('click', '.page-item a', function() {
            var page = $(this).data('page');
            var sort = $('.sort').find('.active').data('sort');;

            var checked = $('#CheckFollow').is(':checked');
            var arrayFromPHP = <?= json_encode($following) ?>;

            $.ajax({
               url: '<?php echo admin_url('admin-ajax.php'); ?>', // in backend you should pass the ajax url using this variable
               type: 'POST',
               data: {
                  action: 'get_sort_items',
                  sort: sort,
                  paged: page,
                  checked: checked,
                  following: arrayFromPHP,
                  term_id: '<?= $taxonomy_query->term_id ?>'
               },
               beforeSend: function() {
                  $('.loading').show();
                  $('html, body').animate({
                     scrollTop: 0
                  }, 'slow');
               },
               success: function(data) {
                  $('#freeItems').html(data);
                  $('.loading').hide();
               }
            });
         });

         $('body').on('click', '.sort a', function() {
            var sort = $(this).data('sort');
            var name = $(this).data('name');

            $('#CheckFollow').prop('checked', false);

            $('.sort a').removeClass('active');
            $(this).addClass('active');

            $('div#FilterSide h3 strong').html(name);

            $.ajax({
               url: '<?php echo admin_url('admin-ajax.php'); ?>', // in backend you should pass the ajax url using this variable
               type: 'POST',
               data: {
                  action: 'get_sort_items',
                  sort: sort,
                  paged: '<?= $paged ?>',
                  term_id: '<?= $taxonomy_query->term_id ?>'
               },
               beforeSend: function() {
                  $('.loading').show();
               },
               success: function(data) {
                  $('#freeItems').html(data);
                  $('.loading').hide();
               }
            });
         });
      });
   </script>
   <style>
      ul.meta-buttons li i {
         font-size: 14px;
         margin: 2px 4px;
         position: relativ;
         top: 1px;
      }


      ul.meta-buttons li.likes-button:hover {
         width: 65px;
         -webkit-transition: width .2s ease;
         -o-transition: width .2s ease;
         transition: width .2s ease;
      }

      li.likes-button {
         background: transparent;
         opacity: 0;
      }

      .item-card .card:hover ul.meta-buttons li.likes-button {
         display: block;
         opacity: 1;
      }

      ul.meta-buttons {
         right: 7px;
      }

      ul.meta-buttons li {
         padding: 3px;
      }

      @media screen and (max-width: 600px) {
         .item-card .card:hover ul.meta-buttons li.likes-button {
            display: block;

         }

         li.likes-button {
            background: #000;
            opacity: 0;
         }

      }
   </style>
@endsection
