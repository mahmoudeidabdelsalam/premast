{{--
  Template Name: Items landing
--}}

@extends('layouts.app-dark')

@section('content')

   @php
      global $current_user;
      wp_get_current_user();
      $counter = $loop_item->found_posts;
      $refine = isset($_GET['refine']) ? $_GET['refine'] : '0';
   @endphp

   <script>
      console.log('loop', {!! json_encode($loop_item) !!})
   </script>

   <section class="banner-items "
            style="background: linear-gradient(105deg, {{ the_field('gradient_color_one_cat', 'option') }} 0.7%, {{ the_field('gradient_color_two_cat', 'option') }} 100%);">
      <div class="container-fluid">
         <div class="row align-items-center text-center justify-content-center">
            <h2 class="col-12 text-black"><strong
                       class="font-weight-600">{{ _e('Results for', 'premast') }} "{{ $refine }}"
            </h2>
            <p class="col-md-8 col-12 m-auto">{{ _e('You found', 'premast') }} {{ $counter }}
               {{ $refine }} {{ _e('templates, slides & graphics', 'premast') }}</p>
         </div>
      </div>
   </section>

   <div class="container-fiuld woocommerce">
      <div class="row justify-content-center m-0">
         <div class="col-md-12 col-sm-12">
            <div class="item-columns container-ajax items-categories item-card grid grid-custom row"
                 style="min-height:1px;">
               @if ($loop_items->have_posts())
                  @while ($loop_items->have_posts())
                     @php $loop_items->the_post() @endphp
                     @php $sale = get_post_meta( get_the_ID(), '_sale_price', true) @endphp
                     <div class="col-md-3 col-12 grid-item">
                        <div class="card">
                           @if ($sale)
                              <span class="custom-onsale">
                                 {{ _e('on Sale', 'premast') }}
                              </span>
                           @endif
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
                           <div class="bg-white"
                                style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(), 'medium') }}');height:auto;min-height:180px;">
                              <img src="{{ Utilities::global_thumbnails(get_the_ID(), 'medium') }}"
                                   class="card-img-top" alt="{{ the_title() }}">
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
                                       <?php
                                       global $product;
                                       $rating_count = method_exists($product, 'get_rating_count') ? $product->get_rating_count() : 1;
                                       $review_count = method_exists($product, 'get_review_count') ? $product->get_review_count() : 1;
                                       $average = method_exists($product, 'get_average_rating') ? $product->get_average_rating() : 0;
                                       $counter_download = get_post_meta(get_the_ID(), 'counterdownload', true);
                                       $counter_view = get_post_meta(get_the_ID(), 'c95_post_views_count', true);
                                       $like = get_post_meta(get_the_ID(), '_post_like_count', true);
                                       $price = get_post_meta(get_the_ID(), '_regular_price', true);
                                       ?>
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
                                    <span class="icon-download icon-meta"> <img class="img-meta"
                                            src="{{ get_theme_file_uri() . '/dist/images/icon-download.svg' }}"
                                            alt="Download">
                                       {{ $counter_download ? $counter_download : '0' }}</span>
                                    @if ((current_user_can('edit_post', get_the_ID()) &&
                                        get_the_author_meta('ID') == $current_user->ID) ||
                                        is_super_admin())
                                       <span class="icon-download icon-meta"> <img class="img-meta"
                                               src="{{ get_theme_file_uri() . '/dist/images/icon-view.svg' }}"
                                               alt="Download">
                                          {{ $counter_view ? $counter_view : '0' }}</span>
                                    @endif
                                    <span class="icon-download icon-meta"> <img class="img-meta"
                                            src="{{ get_theme_file_uri() . '/dist/images/like.png' }}"
                                            alt="like"> {{ $like ? $like : '0' }}</span>
                                 </div>
                                 @if ($price)
                                    <span class="premium"><i class="fa fa-star"></i></span>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  @endwhile
                  @php wp_reset_postdata() @endphp
               @else
                  <div class="col-12 col-md-6 m-auto pt-5 pb-5 text-center">
                     <div class="alert alert-danger" role="alert">
                        {{ __('Sorry, no results were found.', 'sage') }}</div>
                  </div>
               @endif
            </div>
            <div class="col-12 pt-5 pb-5">
               <nav aria-label="Page navigation example">
                  {{ premast_base_pagination([], $loop_items) }}</nav>
            </div>
         </div>
      </div>
   </div>


   <style>
      section.banner-items {
         margin-top: 60px;
         min-height: 1px !important;
         padding: 50px 0;
         margin-bottom: 50px;
      }
   </style>

@endsection
