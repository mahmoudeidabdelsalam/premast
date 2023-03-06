@php
   $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
   $Name = isset($_GET['refine']) ? $_GET['refine'] : '0';
   $sort = isset($_GET['sort']) ? $_GET['sort'] : '0';
   $old = isset($_GET['old']) ? $_GET['old'] : false;
   $test = isset($_GET['test']) ? $_GET['test'] : false;
   
   $taxonomy_query = get_queried_object();
@endphp


@extends('layouts.app-dark')
@section('content')
   @php
      global $current_user;
      wp_get_current_user();
   @endphp

   @if (!$old)
      <script>
         console.log('tag')
         console.log('{{ $taxonomy_query->slug }}')
      </script>
      <pmst-items params='{ "tags": "{{ single_tag_title() }}",  "page":{{ $paged = get_query_var('paged') ? get_query_var('paged') : 1 }} , "per_page": 24 }'
                  nonce='{{ wp_create_nonce('wp_rest') }}'
                  headline="Templates related to {{ single_tag_title() }} tag"
                  subHeadline='Download your preferred design from huge collection of professionally, creative designed templates for all your needs.'>
      </pmst-items>
   @endif



   @if ($old)
      @php
         $nonce = wp_create_nonce('simple-likes-nonce'); // Security global $current_user; wp_get_current_user();
         $current_user = wp_get_current_user();
         
         $my_query = new \WP_Query([
             'post_type' => 'product',
             'posts_per_page' => 19,
             'paged' => $paged,
             'tax_query' => $taxonomy_query,
         ]);
         while ($my_query->have_posts()):
             $my_query->the_post();
             $product = wc_get_product(get_the_ID());
             $items_data[] = [
                 'id' => get_the_ID(),
                 'title' => str_replace('&amp;', '&', $product->get_name()),
                 'slug' => $product->get_slug(),
                 'link' => get_permalink(),
                 'image' => [
                     'thumbnail' => get_the_post_thumbnail_url(null, 'thumbnail'),
                     'medium' => get_the_post_thumbnail_url(null, 'medium'),
                     'large' => get_the_post_thumbnail_url(null, 'large'),
                 ],
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
                 'test' => get_queried_object(),
             ];
         endwhile;
      @endphp

      @if (get_field('images_tags', 'option'))
         <section class="banner-items mb-5 mt-5"
                  style="background-image: linear-gradient(150deg, {{ the_field('gradient_color_one_tags', 'option') }} 0%, {{ the_field('gradient_color_two_tags', 'option') }} 100%);">
            <div class="elementor-background-overlay"
                 style="background-image: url('{{ the_field('images_tags', 'option') }}');"></div>
            <div class="container">
               <div class="row justify-content-center align-items-center text-center">
                  <h1 class="col-12" style="color:{{ the_field('font_color_tags', 'option') }}"><strong
                             class="font-weight-600">{{ _e('Discover Best', 'premast') }}
                        {{ single_tag_title() }} </strong> <span
                           class="font-weight-300">{{ _e('templates', 'premast') }}</span></h1>
                  <p class="col-md-5 col-12 font-weight-300"
                     style="color:{{ the_field('font_color_tags', 'option') }}">
                     {{ _e('Download your preferred design from huge collection of professionally, creative designed', 'premast') }}
                     {{ single_tag_title() }} {{ _e('templates for all your needs.', 'premast') }}
                  </p>
               </div>
            </div>
         </section>
      @else
         <section class="banner-items mb-5 mt-5"
                  style="background-image: linear-gradient(150deg, {{ the_field('gradient_color_one_tags', 'option') }} 0%, {{ the_field('gradient_color_two_tags', 'option') }} 100%);">
            <div class="elementor-background-overlay"
                 style="background-image: url('{{ the_field('images_tags', 'option') }}');"></div>
            <div class="container">
               <div class="row justify-content-center align-items-center text-center">
                  <h1 class="col-12" style="color:{{ the_field('font_color_tags', 'option') }}">
                     <strong class="font-weight-600">{{ _e('Discover Best', 'premast') }}
                        {{ single_tag_title() }} </strong> <span
                           class="font-weight-300">{{ _e('templates', 'premast') }}</span>
                  </h1>
                  <p class="col-md-5 col-12 font-weight-300"
                     style="color:{{ the_field('font_color_tags', 'option') }}">
                     {{ _e('Download your preferred design from huge collection of professionally, creative designed', 'premast') }}
                     {{ single_tag_title() }} {{ _e('templates for all your needs.', 'premast') }}
                  </p>
               </div>
            </div>
         </section>
      @endif
      <div class="container-fiuld mt-5">
         <div class="row justify-content-center m-0">
            <div class="col-md-12 col-sm-12">
               <div class="item-columns container-ajax item-card grid grid-custom row">

                  <div id="main">
                     <div id="items_wrapper">
                        @if (get_field('show_card_pricing', 'option'))
                           <pmst-item-card image={{ the_field('images_card_pricing', 'option') }}
                                           link={{ the_field('lik_card_pricing', 'option') }}
                                           title='{{ get_field('heading_card_pricing', 'option') }}'>
                           </pmst-item-card>
                        @endif
                     </div>
                  </div>
                  <script>
                     let items = {!! json_encode($items_data) !!};
                     console.log(items)
                     let itemsWrapper = document.getElementById('items_wrapper');
                     items.forEach(item => {
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
                        itemsWrapper.appendChild(itemCard);
                     })
                     for (let i = 0; i < 4; i++) {
                        let hiddenFlex = document.createElement('div');
                        hiddenFlex.classList.add('hidden-flex');
                        itemsWrapper.appendChild(hiddenFlex);
                     }
                  </script>
                  @php(wp_reset_postdata())
               </div>



               <div class="col-12 pt-5 pb-5">
                  <nav aria-label="Page navigation example">
                     {{ premast_base_pagination([], $my_query) }}</nav>
               </div>

            </div>

         </div>
      </div>

      <style>
         pmst-item-card {
            min-width: 200px;
            width: 23%;
            height: auto;
            flex: 1 0 23%;
         }

         #items_wrapper {
            margin-bottom: 30px !important;
            max-height: fit-content;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 32px
         }

         .hidden-flex {
            width: 23%;
            height: 0;
            flex: 1 0 23%;
         }

         #main {
            width: 100%;
            margin: 16px;
         }
      </style>
   @endif

@endsection
