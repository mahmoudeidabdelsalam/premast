{{--
Template Name: Template Home Item copy
--}}

@extends('layouts.app-dark') @section('content')
   @php
      $nonce = wp_create_nonce('simple-likes-nonce'); // Security global $current_user; wp_get_current_user();
      function get_items($query)
      {
          $current_user = wp_get_current_user();
          if ($query == 'popular') {
              $my_query = new WP_Query([
                  'post_type' => 'product',
                  'posts_per_page' => 4,
                  'post__in' => $ids,
                  'orderby' => 'post__in',
              ]); // return array of items data
          } elseif ($query == 'follow') {
              $authors = get_user_meta($current_user->ID, 'following_user', true);
              $my_query = new WP_Query([
                  'post_type' => ['product'],
                  'author' => $authors,
                  'post_status' => 'publish',
                  'posts_per_page' => 4,
              ]); // return array of items data
          }
          while ($my_query->have_posts()):
              $my_query->the_post();
              global $product;
              $price = get_post_meta(get_the_ID(), '_regular_price', true);
              $sale = get_post_meta(get_the_ID(), '_sale_price', true);
              // convert price and sale to number
      
              $items[] = [
                  'id' => $product->get_id(),
                  'title' => html_entity_decode(get_the_title()),
                  'slug' => $product->get_slug(),
                  'link' => get_permalink(),
                  'image' => ['thumbnail' => get_the_post_thumbnail_url(null, 'thumbnail'), 'medium' => get_the_post_thumbnail_url(null, 'medium'), 'large' => get_the_post_thumbnail_url(null, 'large')],
                  'price' => get_post_meta(get_the_ID(), '_regular_price', true),
                  'sale_price' => get_post_meta(get_the_ID(), '_sale_price', true),
                  'rating' => get_post_meta(get_the_ID(), '_wc_average_rating', true),
                  'downloads' => get_post_meta(get_the_ID(), 'somdn_dlcount', true),
                  'likes' => get_post_meta(get_the_ID(), '_post_like_count', true),
                  'categories' => get_the_terms(get_the_ID(), 'product_cat'),
                  'tags' => get_the_terms(get_the_ID(), 'product_tag'),
                  'isLiked' => already_liked(get_the_ID(), 0),
                  'edit_permission' => $current_user->allcaps['edit_product'],
                  'edit_link' => get_field('link_edit_item', 'option') . '?post_id' . get_the_ID(),
              ];
          endwhile;
          wp_reset_query();
          return $items;
      }
   @endphp

   <div id="main">
      <div id="popular_items_wrapper"></div>
   </div>

   <script id="main-js">
      function loadItemList(type, container) {
         let items = {!! json_encode(get_items('popular')) !!};
         console.log(items)
         items.forEach(item => {
            console.log(+item.price)
            console.log(item.sale_price === '')
            console.log(+item.price === 0 || +item.sale_price === 0)
            let itemCard = document.createElement('pmst-item-card');
            itemCard.image = item.image.large;
            itemCard.title = item.title;
            itemCard.editPermission = item.edit_permission;
            itemCard.rating = item.rating
            itemCard.downloads = item.downloads
            itemCard.likes = item.likes
            itemCard.link = item.link
            itemCard.isLiked = item.isLiked
            // check if item is premium 
            if (+item.price === 0) {
               itemCard.premium = false
            } else {
               if (item.sale_price !== '') {
                  console.log('sale is', item.sale_price) +
                     itemCard.sale_price === 0 ? itemCard.premium = false : itemCard.premium =
                     true
               } else {
                  itemCard.premium = true
               }
            }
            itemCard.addEventListener('like', (e) => {
               jQuery.ajax({
                  type: 'POST',
                  url: "<?php echo admin_url('admin-ajax.php'); ?>",
                  data: {
                     action: 'process_simple_like',
                     post_id: item.id,
                     is_comment: 0,
                     nonce: '<?php echo $nonce; ?>'
                  },
                  success: function(
                     data) {},
                  error: function(
                     data) {}
               });
            })
            itemCard.addEventListener('edit', (e) => {
               window.location.href = item.edit_link;
            })
            container.appendChild(itemCard);
         })
      }

      let popualrItems = document.getElementById('popular_items_wrapper');
      loadItemList('follow', popualrItems)
   </script>

   <style>
      #popular_items_wrapper {
         display: flex;
         flex-wrap: wrap;
         justify-content: space-between;
      }

      pmst-item-card {
         margin: 10px;
         max-width: 450px;
         min-width: 200px;
         width: 20%;
      }
   </style>

   <section class="popular-items">
      <div class="container-fluid mb-4">
         <div class="row">
            <div class="col-md-6 col-12">
               <div class="content">
                  <h1 class="heading">
                     <?= the_field('headline_popular_items') ?>
                  </h1>
                  <h5 class="sub-heading">
                     <?= the_field('sub_headline_popular_items') ?>
                  </h5>
               </div>
            </div>
            <div class="col-md-6 col-12 pb-1">
               <div class="see-link">
                  <?php
                        $link = get_field('link_popular_items');
                        if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                     ?>
                  <a class="go" href="<?php echo esc_url($link_url); ?>"
                     target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>
                     <i class="fa fa-angle-right"></i></a>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </section>


   <?php
   $authors = get_user_meta($current_user->ID, 'following_user', true);
   $follow = ['post_type' => ['product'], 'author' => $authors, 'post_status' => 'publish', 'posts_per_page' => 4];
   $follows = new WP_Query($follow); ?> @if ($follows->have_posts() && $authors)
      <section class="popular-items">
         <div class="container-fluid mb-4">
            <div class="row">
               <div class="col-md-6 col-12">
                  <div class="content">
                     <h1 class="heading">
                        {{ _e('Items from people you follow', 'premst') }}
                     </h1>
                     <h5 class="sub-heading">
                        {{ _e('You can check our different packages and pick a one that suits you and go premium. <br />We are always here to support!', 'premast') }}
                     </h5>
                  </div>
               </div>
               <div class="col-md-6 col-12 pb-3">
                  <div class="see-link">
                     <?php
$link = get_field('link_follow_items');
if( $link ):
$link_url = $link['url'];
$link_title = $link['title'];
$link_target = $link['target'] ? $link['target'] : '_self';
?>
                     <a class="go" href="<?php echo esc_url($link_url); ?>"
                        target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>
                        <i class="fa fa-angle-right"></i></a>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>

         <div class="container-fluid woocommerce">
            <div class="row item-columns container-ajax items-categories item-card grid grid-custom">
               @if ($follows->have_posts())
                  @while ($follows->have_posts())
                     @php
                     $follows->the_post(); @endphp @php $sale = get_post_meta(get_the_ID(), '_sale_price', true); @endphp
                     <div class="col-md-3 col-12 grid-item">
                        <div class="card">
                           <div class="bg-white">
                              <?php
                              $attachment_id = get_post_thumbnail_id(get_the_ID());
                              $img_src = wp_get_attachment_image_url($attachment_id, 'medium');
                              $img_srcset = wp_get_attachment_image_srcset($attachment_id, 'medium');
                              ?>

                              <img src="<?php echo esc_url($img_src); ?>" srcset="<?php echo esc_attr($img_srcset); ?>"
                                   sizes="<?php echo wp_get_attachment_image_sizes($attachment_id, 'medium'); ?>" class="card-img-top"
                                   alt="{{ the_title() }}" />
                              <div class="card-overlay">
                                 <a class="the_permalink" href="{{ the_permalink() }}"></a>
                              </div>
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
                                       $price = get_post_meta(get_the_ID(), '_regular_price', true); ?>
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
                                            alt="Download" />
                                       {{ $counter_download ? $counter_download : '0' }}</span>
                                    @if ((current_user_can('edit_post', get_the_ID()) &&
                                        get_the_author_meta('ID') == $current_user->ID) ||
                                        is_super_admin())
                                       <span class="icon-download icon-meta">
                                          <img class="img-meta"
                                               src="{{ get_theme_file_uri() . '/dist/images/icon-view.svg' }}"
                                               alt="Download" />
                                          {{ $counter_view ? $counter_view : '0' }}</span>
                                    @endif
                                    <span class="icon-download icon-meta">
                                       <img class="img-meta"
                                            src="{{ get_theme_file_uri() . '/dist/images/like.png' }}"
                                            alt="like" />
                                       {{ $like ? $like : '0' }}</span>
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
               @php wp_reset_postdata() @endphp
            </div>
         </div>
      </section>
   @endif

   <section class="recent-items">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-6 col-12">
               <div class="content">
                  <h1 class="heading">
                     <?= the_field('headline_recent_items') ?>
                  </h1>
                  <h5 class="sub-heading">
                     <?= the_field('sub_headline_recent_items') ?>
                  </h5>
               </div>
            </div>
         </div>
      </div>
      <?php
$terms_products = get_field('select_category_products');
if( $terms_products ):
?>
      <?php foreach( $terms_products as $term ): ?>
      <pmst-item-card></pmst-item-card>
      <div class="container-fluid mt-5">
         <div class="row">
            <div class="col-md-6 col-12">
               <div class="headline">
                  <h3 class="headline">
                     <?php echo esc_html($term->name); ?>
                  </h3>
               </div>
            </div>
            <div class="col-md-6 col-12 pb-3">
               <div class="see-link">
                  <a class="go" href="<?php echo esc_url(get_term_link($term)); ?>">See all
                     items <i class="fa fa-angle-right"></i></a>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid woocommerce">
         <div class="row item-columns container-ajax items-categories item-card grid grid-custom">
            <?php
            $query = new WP_Query([
                'post_type' => 'product',
                'posts_per_page' => 4,
                'tax_query' => [
                    [
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => $term->term_id,
                    ],
                ],
            ]); ?> @if ($query->have_posts())
               @while ($query->have_posts())
                  @php $query->the_post() @endphp @php
                  $sale = get_post_meta(get_the_ID(), '_sale_price', true); @endphp
                  <div class="col-md-3 col-12 grid-item">
                     <div class="card">
                        <div class="bg-white">
                           <?php
                           $attachment_id = get_post_thumbnail_id(get_the_ID());
                           $img_src = wp_get_attachment_image_url($attachment_id, 'medium');
                           $img_srcset = wp_get_attachment_image_srcset($attachment_id, 'medium');
                           ?>

                           <img src="<?php echo esc_url($img_src); ?>" srcset="<?php echo esc_attr($img_srcset); ?>"
                                sizes="<?php echo wp_get_attachment_image_sizes($attachment_id, 'medium'); ?>" class="card-img-top"
                                alt="{{ the_title() }}" />

                           <div class="card-overlay">
                              <a class="the_permalink" href="{{ the_permalink() }}"></a>
                           </div>
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
                                    $price = get_post_meta(get_the_ID(), '_regular_price', true); ?>
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
                                         alt="Download" />
                                    {{ $counter_download ? $counter_download : '0' }}</span>
                                 @if ((current_user_can('edit_post', get_the_ID()) &&
                                     get_the_author_meta('ID') == $current_user->ID) ||
                                     is_super_admin())
                                    <span class="icon-download icon-meta">
                                       <img class="img-meta"
                                            src="{{ get_theme_file_uri() . '/dist/images/icon-view.svg' }}"
                                            alt="Download" />
                                       {{ $counter_view ? $counter_view : '0' }}</span>
                                 @endif
                                 <span class="icon-download icon-meta">
                                    <img class="img-meta"
                                         src="{{ get_theme_file_uri() . '/dist/images/like.png' }}"
                                         alt="like" />
                                    {{ $like ? $like : '0' }}</span>
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
            @endif @php wp_reset_postdata() @endphp
         </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>
   </section>

   <section class="popular-items">
      <div class="container">
         <div class="row justify-content-center">
            <div class="mid-headline">
               <h1 class="headterm">
                  <?= the_field('headline_free_items') ?>
               </h1>
               <h5 class="subhead">
                  <?= the_field('sub_headline_free_items') ?>
               </h5>
            </div>
         </div>
      </div>

      <div class="container-fluid woocommerce">
         <div class="row item-columns container-ajax items-categories item-card grid grid-custom">
            <?php
            $free = get_field('free_items', false, false);
            $free_query = new WP_Query([
                'post_type' => 'product',
                'posts_per_page' => 4,
                'post__in' => $free,
                'orderby' => 'post__in',
            ]); ?> @if ($free_query->have_posts())
               @while ($free_query->have_posts())
                  @php
                     $free_query->the_post();
                  $sale = get_post_meta(get_the_ID(), '_sale_price', true); @endphp
                  <div class="col-md-3 col-12 grid-item">
                     <div class="card">
                        <div class="bg-white">
                           <?php
                           $attachment_id = get_post_thumbnail_id(get_the_ID());
                           $img_src = wp_get_attachment_image_url($attachment_id, 'medium');
                           $img_srcset = wp_get_attachment_image_srcset($attachment_id, 'medium');
                           ?>

                           <img src="<?php echo esc_url($img_src); ?>" srcset="<?php echo esc_attr($img_srcset); ?>"
                                sizes="<?php echo wp_get_attachment_image_sizes($attachment_id, 'medium'); ?>" class="card-img-top"
                                alt="{{ the_title() }}" />

                           <div class="card-overlay">
                              <a class="the_permalink" href="{{ the_permalink() }}"></a>
                           </div>
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
                                    $price = get_post_meta(get_the_ID(), '_regular_price', true); ?>
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
                                         alt="Download" />
                                    {{ $counter_download ? $counter_download : '0' }}</span>
                                 @if ((current_user_can('edit_post', get_the_ID()) &&
                                     get_the_author_meta('ID') == $current_user->ID) ||
                                     is_super_admin())
                                    <span class="icon-download icon-meta">
                                       <img class="img-meta"
                                            src="{{ get_theme_file_uri() . '/dist/images/icon-view.svg' }}"
                                            alt="Download" />
                                       {{ $counter_view ? $counter_view : '0' }}</span>
                                 @endif
                                 <span class="icon-download icon-meta">
                                    <img class="img-meta"
                                         src="{{ get_theme_file_uri() . '/dist/images/like.png' }}"
                                         alt="like" />
                                    {{ $like ? $like : '0' }}</span>
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
            @endif @php wp_reset_postdata() @endphp
         </div>
      </div>
      <div class="button">
         <?php
$link = get_field('link_free_items');
if( $link ):
$link_url = $link['url'];
$link_title = $link['title'];
$link_target = $link['target'] ? $link['target'] : '_self';
?>
         <a class="btn btn-primary" href="<?php echo esc_url($link_url); ?>"
            target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>
            <i class="fa fa-angle-right"></i></a>
         <?php endif; ?>
      </div>
   </section>

   <section class="blog-items">
      <div class="container pt-5">
         <div class="row justify-content-center">
            <div class="col-md-8 col-12">
               <div class="mid-headline">
                  <h1 class="headterm">
                     <?= the_field('headline_blog_items') ?>
                  </h1>
                  <h5 class="subhead">
                     <?= the_field('sub_headline_blog_items') ?>
                  </h5>
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid">
         <div class="col-md-12 col-sm-12 p-3">
            <div class="item-columns grid row m-0 container-ajax">
               <?php
               // $blog_ids = get_field('blog_items', false, false);
               $blog_query = new WP_Query([
                   'post_type' => 'post',
                   'posts_per_page' => 3,
               ]); ?>
               @if ($blog_query->have_posts())
                  @while ($blog_query->have_posts())
                     @php $blog_query->the_post() @endphp
                     <div
                          class="item-blog col-md-4 col-sm-4 col-sx-6 col-12 grid-item pl-4 pr-4 post-ajax">
                        <div class="card p-0">
                           <div class="bg-images"
                                style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(), 'medium') }}');border-radius: 8px;height: 208px; min-height: 208px; width:370px;">
                              <img src="{{ Utilities::global_thumbnails(get_the_ID(), 'medium') }}"
                                   class="card-img-top" alt="{{ the_title() }}" />
                              <div class="card-overlay">
                                 <a class="the_permalink" href="{{ the_permalink() }}"></a>
                              </div>
                           </div>
                           <div class="card-body pt-2 pl-0 pr-0 pb-0">
                              <p class="label mb-0">
                                 <time class="text-dark">{{ the_date('d M, Y') }}</time>
                              </p>
                              <a class="card-link" href="{{ the_permalink() }}">
                                 <h5 class="card-title">
                                    {{ the_title() }}
                                 </h5>
                              </a>
                              <p class="card-text">
                                 {!! wp_trim_words(get_the_content(get_the_ID()), 15, ' ...') !!}
                              </p>
                           </div>
                        </div>
                     </div>
                  @endwhile
               @else
                  <div class="col-12">
                     {{ __('Sorry, no results were found.', 'sage') }}
                  </div>
               @endif
               @php wp_reset_postdata() @endphp
            </div>
         </div>
      </div>

      <div class="button">
         <?php
$link = get_field('link_blog_items');
if( $link ):
$link_url = $link['url'];
$link_title = $link['title'];
$link_target = $link['target'] ? $link['target'] : '_self';
?>
         <a class="btn btn-primary" href="<?php echo esc_url($link_url); ?>"
            target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
         <?php endif; ?>
      </div>
   </section>

   <script>
      jQuery(function($) {
         $(function() {
            $("ul.fader li").hide();
            $("ul.fader li").css("position",
               "absolute");
            $("ul.fader li").css("top", "0px");
            $("ul.fader li").css("left",
               "0px");
            var max = $("ul.fader li").length;

            function showSlider() {
               if (localStorage.slider) {
                  $(".fader")
                     .find("li:nth(" +
                        localStorage
                        .slider +
                        ")")
                     .fadeIn();
                  localStorage.slider =
                     parseInt(localStorage
                        .slider, 10) + 1;
                  if (localStorage.slider >=
                     max) localStorage
                     .slider = 0;
               } else {
                  $(".fader").find(
                        "li:nth(0)")
                     .fadeIn();
                  localStorage.slider = 1;
               }
            }
            showSlider();
         });
      });
   </script>

   <style>
      .page-template-template-home-item section.popular-items {
         margin: 30px;
      }

      section.recent-items {
         padding: 20px 30px;
      }

      ul.fader {
         width: 100%;
         position: relative;
         margin: 0;
         list-style: none;
      }

      ul.fader li {
         padding: 0px;
         max-height: 300px;
         position: relative !important;
      }

      ul.fader li img {
         max-height: 300px;
         width: 528px;
      }

      ul.fader {
         margin: -47px;

      }

      ul.fader li img {
         max-height: 300px;

      }

      .page-template-template-home-item .search-items form input {
         background: transparent;
         border: none;
         width: 90%;
         font-weight: 300;
      }

      .item-blog .card p.label time {
         color: #646464;
          !important;
      }

      .item-blog .card p.card-text {
         color: #646464;
          !important;
         opacity: inherit;
      }

      .profile-dropdown .link-dropdown {
         width: 214px;
      }

      @media screen and (max-width: 600px) {
         .page-template-template-home-item section.popular-items {
            margin: 0 15px;
         }

         ul.fader {
            margin: 0;

         }

         section.recent-items {
            margin: 0 15px;
         }

         .page-template-template-home-item .go {
            padding: 0 !important;
            margin-top: -40px;
         }

         .grid .grid-item {
            padding: 0 !important;
         }

         ul.fader li {
            padding: 0px;
            max-height: 300px;
            position: relative;
         }


      }

      //   new edits
      main.main {
         background: #ffff;
      }

      .page-template-template-home-item a.go {
         padding-bottom: 0px;
         padding-top: 99px;
      }

      .page-template-template-home-item section.recent-items {
         padding-top: 20px;
         background: #F9F9F9;
      }

      .item-blog .card p.label time {
         color: #646464;
         font-weight: 500;
         opacity: inherit;
      }

      body.page-template-template-home-item {
         background: #fff !important;
      }

      a.btn.btn-primary {
         background: linear-gradient(134.71deg, #6B73FF -0.5%, #000DFF 100%);
         border-radius: 30px;
         box-shadow: none;
      }

      .page-template-template-home-item section.banner-home-template {
         height: 450px;
      }

      i.fa.fa-angle-right {
         padding-left: 9px;

      }

      .button-green {
         font-family: 'Roboto', sans-serif;
         font-weight: 500;
      }

      .item-card .card {
         padding: 7px;
      }

      .item-card .card h5.card-title {
         padding-top: 8px;
      }

      .grid .grid-item .card .card-body {
         margin: -7px -7px;
      }

      .page-template-template-home-item section.recent-items {
         padding-top: 80px;
      }

      .page-template-template-home-item .trand-now {
         margin-left: 30px;
      }

      .search-items {
         margin: 21px;
      }

      p.text-white {
         margin: 2px 0px 0px 28px;
      }

      h2.text-white {
         margin: -39px 0px 0px 27px;
      }

      .page-template-template-home-item section.popular-items {
         padding-top: 10px;
      }

      .page-template-template-home-item .popular-items .button {
         margin: 30px
      }

      /* new edit mobile version */
      header.banner .logos {
         max-width: 223px !important;
      }

      .page-template-template-home-item .search-items form {
         padding: 5px 19px;
      }

      .page-template-template-home-item .trand-now ul {
         margin-left: -10px;
      }

      .page-template-template-home-item .trand-now ul a {
         margin: 10px 5px;
      }

      .page-template-template-home-item .go {
         padding-top: 0 !important;
         position: relative;
         top: 20px;
      }

      form#itemsSearch {
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      form#itemsSearch button {
         padding: 0;
         top: 2px;
         position: relative;
      }

      .see-link {
         height: 100%;
         display: flex;
      }

      .see-link .go {
         margin-left: auto;
         margin-top: auto;
         margin-bottom: 15px;
      }

      @media screen and (max-width: 600px) {
         .item-blog .card .bg-images {
            width: 100% !important;
            max-width: 100% !important;
            background-size: contain;
            background-repeat: no-repeat;
            height: 120px !important;
            min-height: 1px !important;
         }

         .page-template-template-home-item section.banner-home-template {
            height: auto !important;
            padding: 90px 0 30px;
         }

         .page-template-template-home-item .go {
            margin: 0 !important;
         }

         .page-template-template-home-item section.banner-home-template img {
            margin-left: -24px;
         }

         .bg-images.lazyloaded {
            padding: 0;
            margin-left: -10px;
         }

      }

      /*

                                                                                                                                                                                ul.meta-buttons li i {
                                                                                                                                                                                    font-size: 14px;
                                                                                                                                                                                    margin: 2px 4px;
                                                                                                                                                                                    position: relativ;
                                                                                                                                                                                    top: 1px;}


                                                                                                                                                                                    ul.meta-buttons li.likes-button:hover {
                                                                                                                                                                                    width: 65px;
                                                                                                                                                                                    -webkit-transition: width .2s ease;
                                                                                                                                                                                    -o-transition: width .2s ease;
                                                                                                                                                                                    transition: width .2s ease;
                                                                                                                                                                                }
                                                                                                                                                                                 */
   </style>
@endsection
