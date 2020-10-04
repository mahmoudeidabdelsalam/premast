{{--
  Template Name: Template Home Item
--}}

@extends('layouts.app-dark')
@section('content')

@php
  global $current_user;
  wp_get_current_user();
@endphp

  <section class="banner-home-template" style="<?= the_field('banner_background_color_template'); ?>">
    <div class="overlay-banner" style="background-image: url(<?= the_field('banner_background_image_template'); ?>)"></div>
    <div class="container-fluid">
      <div class="row align-content-center">
        <div class="col-md-7 col-12">
          <h2 class="text-white"><?= the_field('headline_banner_template'); ?></h2>
          <p class="text-white"><?= the_field('sub_headline_banner_template'); ?></p>
          <div class="search-items">
            <form action="{{ bloginfo('url') }}/items" id="itemsSearch">
              <input id="autoblogsinputs" class="search-inputs"  name="refine"  value="{{ get_search_query() }}" type="text" placeholder="{{ _e('type something..','premast') }}">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
          <div class="trand-now">
            <?php
            $terms = get_field('trending_now_template');
            if( $terms ): ?>
            <h3>TRENDING NOW</h3>
                <ul>
                <?php foreach( $terms as $term ): ?>
                    <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-md-5 col-12">
          <ul class="fader">
          <?php
          $counter = 0;
            if( have_rows('banner_slider_show') ):
              while ( have_rows('banner_slider_show') ) : the_row();
              $counter++;
          ?>
            <li style="display:none;" data-id="<?= $counter; ?>">
              <a href="<?= the_sub_field('link_banner_background_template') ?>"><img src="<?= the_sub_field('image_banner_background_template'); ?>" alt="<?= the_field('headline_banner_template'); ?>"></a>
            </li>
          <?php
              endwhile;
            endif;
          ?>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="popular-items">
    <div class="container-fluid mb-4">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="content">
            <h1 class="heading"><?= the_field('headline_popular_items'); ?></h1>
            <h5 class="sub-heading"><?= the_field('sub_headline_popular_items'); ?></h5>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="see-link">
            <?php
            $link = get_field('link_popular_items');
            if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="go" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?> <i class="fa fa-angle-right"></i></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid woocommerce">
      <div class="row item-columns container-ajax items-categories item-card grid grid-custom">
        <?php
        $ids = get_field('popular_items', false, false);
        $my_query = new WP_Query(array(
          'post_type'      	=> 'product',
          'posts_per_page'	=> 4,
          'post__in'			=> $ids,
          'orderby'        	=> 'post__in',
        ));
        ?>
      @if($my_query->have_posts())
        @while($my_query->have_posts()) @php($my_query->the_post())
        @php ($sale = get_post_meta( get_the_ID(), '_sale_price', true))
          <div class="col-md-3 col-12 grid-item">
            <div class="card">
              <div class="bg-white">
                <?php
                  $attachment_id = get_post_thumbnail_id(get_the_ID());
                  $img_src = wp_get_attachment_image_url( $attachment_id, 'medium' );
                  $img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'medium' );
                ?>

                <img src="<?php echo esc_url( $img_src ); ?>" srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="<?php echo wp_get_attachment_image_sizes( $attachment_id, 'medium' ) ?>" class="card-img-top" alt="{{ the_title() }}">
                <div class="card-overlay"><a class="the_permalink" href="{{ the_permalink() }}"></a></div>
              </div>
              <div class="card-body pt-2 pl-0 pr-0 pb-0">
                <a class="card-link" href="{{ the_permalink() }}">
                  <h5 class="card-title font-weight-400">{{ html_entity_decode(wp_trim_words(get_the_title(), '4', ' ...')) }}</h5>
                </a>
                <div class="review-and-download">
                  <div class="review">
                    @if (get_option('woocommerce_enable_review_rating' ) == 'yes')
                      <?php
                        global $product;
                        $rating_count = method_exists($product, 'get_rating_count')   ? $product->get_rating_count()   : 1;
                        $review_count = method_exists($product, 'get_review_count')   ? $product->get_review_count()   : 1;
                        $average      = method_exists($product, 'get_average_rating') ? $product->get_average_rating() : 0;
                        $counter_download = get_post_meta( get_the_ID(), 'counterdownload', true );
                        $counter_view = get_post_meta( get_the_ID(), 'c95_post_views_count', true );
                        $like = get_post_meta(get_the_ID(), '_post_like_count', true);
                        $price = get_post_meta( get_the_ID(), '_regular_price', true);
                      ?>
                      @if ($rating_count > 0)
                        {!! wc_get_rating_html($average, $rating_count) !!}
                        <span class="icon-review icon-meta" itemprop="reviewCount">{{ $average }}</span>
                      @else
                        {!! wc_get_rating_html('1', '5') !!}
                        <span class="icon-review icon-meta" itemprop="reviewCount">{{ _e('0', 'premast') }}</span>
                      @endif
                    @endif

                    <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/icon-download.svg' }}" alt="Download"> {{ ($counter_download)? $counter_download:'0' }}</span>
                    @if(current_user_can( 'edit_post', get_the_ID() ) && (get_the_author_meta('ID') == $current_user->ID) || is_super_admin())
                      <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/icon-view.svg' }}" alt="Download"> {{ ($counter_view)? $counter_view:'0' }}</span>
                    @endif
                    <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/like.png' }}" alt="like"> {{ ($like)? $like:'0' }}</span>
                  </div>
                  @if($price)
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
      @php (wp_reset_postdata())
      </div>
    </div>

  </section>

<?php
  $authors = get_user_meta( $current_user->ID, 'following_user' , true );

  $follow = array(
    'post_type'       => array('product'),
    'author'          =>  $authors,
    'post_status'     => 'publish',
    'posts_per_page'  => 4,
  );
  $follows = new WP_Query( $follow );
?>

@if($follows->have_posts() && $authors)

  <section class="popular-items">
    <div class="container-fluid mb-4">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="content">
          <h1 class="heading">{{ _e('Items from people you follow', 'premst') }}</h1>
          <h5 class="sub-heading">{{ _e('You can check our different packages and pick a one that suits you and go premium. <br> We are always here to support!', 'premast') }}</h5>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid woocommerce">
      <div class="row item-columns container-ajax items-categories item-card grid grid-custom">

      @if($follows->have_posts())
        @while($follows->have_posts()) @php($follows->the_post())
        @php ($sale = get_post_meta( get_the_ID(), '_sale_price', true))
          <div class="col-md-3 col-12 grid-item">
            <div class="card">
              <div class="bg-white">
                <?php
                  $attachment_id = get_post_thumbnail_id(get_the_ID());
                  $img_src = wp_get_attachment_image_url( $attachment_id, 'medium' );
                  $img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'medium' );
                ?>

                <img src="<?php echo esc_url( $img_src ); ?>" srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="<?php echo wp_get_attachment_image_sizes( $attachment_id, 'medium' ) ?>" class="card-img-top" alt="{{ the_title() }}">
                <div class="card-overlay"><a class="the_permalink" href="{{ the_permalink() }}"></a></div>
              </div>
              <div class="card-body pt-2 pl-0 pr-0 pb-0">
                <a class="card-link" href="{{ the_permalink() }}">
                  <h5 class="card-title font-weight-400">{{ html_entity_decode(wp_trim_words(get_the_title(), '4', ' ...')) }}</h5>
                </a>
                <div class="review-and-download">
                  <div class="review">
                    @if (get_option('woocommerce_enable_review_rating' ) == 'yes')
                      <?php
                        global $product;
                        $rating_count = method_exists($product, 'get_rating_count')   ? $product->get_rating_count()   : 1;
                        $review_count = method_exists($product, 'get_review_count')   ? $product->get_review_count()   : 1;
                        $average      = method_exists($product, 'get_average_rating') ? $product->get_average_rating() : 0;
                        $counter_download = get_post_meta( get_the_ID(), 'counterdownload', true );
                        $counter_view = get_post_meta( get_the_ID(), 'c95_post_views_count', true );
                        $like = get_post_meta(get_the_ID(), '_post_like_count', true);
                        $price = get_post_meta( get_the_ID(), '_regular_price', true);
                      ?>
                      @if ($rating_count > 0)
                        {!! wc_get_rating_html($average, $rating_count) !!}
                        <span class="icon-review icon-meta" itemprop="reviewCount">{{ $average }}</span>
                      @else
                        {!! wc_get_rating_html('1', '5') !!}
                        <span class="icon-review icon-meta" itemprop="reviewCount">{{ _e('0', 'premast') }}</span>
                      @endif
                    @endif

                    <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/icon-download.svg' }}" alt="Download"> {{ ($counter_download)? $counter_download:'0' }}</span>
                    @if(current_user_can( 'edit_post', get_the_ID() ) && (get_the_author_meta('ID') == $current_user->ID) || is_super_admin())
                      <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/icon-view.svg' }}" alt="Download"> {{ ($counter_view)? $counter_view:'0' }}</span>
                    @endif
                    <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/like.png' }}" alt="like"> {{ ($like)? $like:'0' }}</span>
                  </div>
                  @if($price)
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
      @php (wp_reset_postdata())
      </div>
    </div>

  </section>

@endif



  <section class="recent-items">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="content">
            <h1 class="heading"><?= the_field('headline_recent_items'); ?></h1>
            <h5 class="sub-heading"><?= the_field('sub_headline_recent_items'); ?></h5>
          </div>
        </div>
      </div>
    </div>
    <?php
      $terms_products = get_field('select_category_products');
      if( $terms_products ):
      ?>
      <?php foreach( $terms_products as $term ): ?>
        <div class="container-fluid mt-5">
          <div class="row">
            <div class="col-md-6 col-12">
              <div class="headline">
                <h3 class="headline"><?php echo esc_html( $term->name ); ?></h3>
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="see-link">
                <a class="go p-0" href="<?php echo esc_url( get_term_link( $term ) ); ?>">See all items <i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid woocommerce">
          <div class="row item-columns container-ajax items-categories item-card grid grid-custom">
          <?php
          $query = new WP_Query(array(
            'post_type'      	=> 'product',
            'posts_per_page'	=> 4,
            'tax_query' => array(
              array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $term->term_id
              )
            )
          ));
          ?>
          @if($query->have_posts())
            @while($query->have_posts()) @php($query->the_post())
            @php ($sale = get_post_meta( get_the_ID(), '_sale_price', true))
              <div class="col-md-3 col-12 grid-item">
                <div class="card">
                  <div class="bg-white">
                    <?php
                      $attachment_id = get_post_thumbnail_id(get_the_ID());
                      $img_src = wp_get_attachment_image_url( $attachment_id, 'medium' );
                      $img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'medium' );
                    ?>

                    <img src="<?php echo esc_url( $img_src ); ?>" srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="<?php echo wp_get_attachment_image_sizes( $attachment_id, 'medium' ) ?>" class="card-img-top" alt="{{ the_title() }}">

                    <div class="card-overlay"><a class="the_permalink" href="{{ the_permalink() }}"></a></div>
                  </div>
                  <div class="card-body pt-2 pl-0 pr-0 pb-0">
                    <a class="card-link" href="{{ the_permalink() }}">
                      <h5 class="card-title font-weight-400">{{ html_entity_decode(wp_trim_words(get_the_title(), '4', ' ...')) }}</h5>
                    </a>
                    <div class="review-and-download">
                      <div class="review">
                        @if (get_option('woocommerce_enable_review_rating' ) == 'yes')
                          <?php
                            global $product;
                            $rating_count = method_exists($product, 'get_rating_count')   ? $product->get_rating_count()   : 1;
                            $review_count = method_exists($product, 'get_review_count')   ? $product->get_review_count()   : 1;
                            $average      = method_exists($product, 'get_average_rating') ? $product->get_average_rating() : 0;
                            $counter_download = get_post_meta( get_the_ID(), 'counterdownload', true );
                            $counter_view = get_post_meta( get_the_ID(), 'c95_post_views_count', true );
                            $like = get_post_meta(get_the_ID(), '_post_like_count', true);
                            $price = get_post_meta( get_the_ID(), '_regular_price', true);
                          ?>
                          @if ($rating_count > 0)
                            {!! wc_get_rating_html($average, $rating_count) !!}
                            <span class="icon-review icon-meta" itemprop="reviewCount">{{ $average }}</span>
                          @else
                            {!! wc_get_rating_html('1', '5') !!}
                            <span class="icon-review icon-meta" itemprop="reviewCount">{{ _e('0', 'premast') }}</span>
                          @endif
                        @endif
                        <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/icon-download.svg' }}" alt="Download"> {{ ($counter_download)? $counter_download:'0' }}</span>
                        @if(current_user_can( 'edit_post', get_the_ID() ) && (get_the_author_meta('ID') == $current_user->ID) || is_super_admin())
                          <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/icon-view.svg' }}" alt="Download"> {{ ($counter_view)? $counter_view:'0' }}</span>
                        @endif
                        <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/like.png' }}" alt="like"> {{ ($like)? $like:'0' }}</span>
                      </div>
                      @if($price)
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
          @php (wp_reset_postdata())
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>


  <section class="popular-items">
    <div class="container">
      <div class="row justify-content-center">
        <div class="mid-headline">
          <h1 class="headterm"><?= the_field('headline_free_items'); ?></h1>
          <h5 class="subhead"><?= the_field('sub_headline_free_items'); ?></h5>
        </div>
      </div>
    </div>

    <div class="container-fluid woocommerce">
      <div class="row item-columns container-ajax items-categories item-card grid grid-custom">
      <?php
      $free = get_field('free_items', false, false);
      $free_query = new WP_Query(array(
        'post_type'      	=> 'product',
        'posts_per_page'	=> 4,
        'post__in'			=> $free,
        'orderby'        	=> 'post__in',
      ));
      ?>
      @if($free_query->have_posts())
        @while($free_query->have_posts()) @php($free_query->the_post())
        @php ($sale = get_post_meta( get_the_ID(), '_sale_price', true))
          <div class="col-md-3 col-12 grid-item">
            <div class="card">
              <div class="bg-white">
                  <?php
                    $attachment_id = get_post_thumbnail_id(get_the_ID());
                    $img_src = wp_get_attachment_image_url( $attachment_id, 'medium' );
                    $img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'medium' );
                  ?>

                  <img src="<?php echo esc_url( $img_src ); ?>" srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="<?php echo wp_get_attachment_image_sizes( $attachment_id, 'medium' ) ?>" class="card-img-top" alt="{{ the_title() }}">

                <div class="card-overlay"><a class="the_permalink" href="{{ the_permalink() }}"></a></div>
              </div>
              <div class="card-body pt-2 pl-0 pr-0 pb-0">
                <a class="card-link" href="{{ the_permalink() }}">
                  <h5 class="card-title font-weight-400">{{ html_entity_decode(wp_trim_words(get_the_title(), '4', ' ...')) }}</h5>
                </a>
                <div class="review-and-download">
                  <div class="review">
                    @if (get_option('woocommerce_enable_review_rating' ) == 'yes')
                      <?php
                        global $product;
                        $rating_count = method_exists($product, 'get_rating_count')   ? $product->get_rating_count()   : 1;
                        $review_count = method_exists($product, 'get_review_count')   ? $product->get_review_count()   : 1;
                        $average      = method_exists($product, 'get_average_rating') ? $product->get_average_rating() : 0;
                        $counter_download = get_post_meta( get_the_ID(), 'counterdownload', true );
                        $counter_view = get_post_meta( get_the_ID(), 'c95_post_views_count', true );
                        $like = get_post_meta(get_the_ID(), '_post_like_count', true);
                        $price = get_post_meta( get_the_ID(), '_regular_price', true);
                      ?>
                      @if ($rating_count > 0)
                        {!! wc_get_rating_html($average, $rating_count) !!}
                        <span class="icon-review icon-meta" itemprop="reviewCount">{{ $average }}</span>
                      @else
                        {!! wc_get_rating_html('1', '5') !!}
                        <span class="icon-review icon-meta" itemprop="reviewCount">{{ _e('0', 'premast') }}</span>
                      @endif
                    @endif

                    <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/icon-download.svg' }}" alt="Download"> {{ ($counter_download)? $counter_download:'0' }}</span>
                    @if(current_user_can( 'edit_post', get_the_ID() ) && (get_the_author_meta('ID') == $current_user->ID) || is_super_admin())
                      <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/icon-view.svg' }}" alt="Download"> {{ ($counter_view)? $counter_view:'0' }}</span>
                    @endif
                    <span class="icon-download icon-meta"> <img class="img-meta" src="{{ get_theme_file_uri().'/dist/images/like.png' }}" alt="like"> {{ ($like)? $like:'0' }}</span>
                  </div>
                  @if($price)
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
      @php (wp_reset_postdata())
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
          <a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?> <i class="fa fa-angle-right"></i></a>
      <?php endif; ?>
    </div>
  </section>

  <section class="blog-items">
    <div class="container pt-5">
      <div class="row justify-content-center">
        <div class="col-md-8 col-12">
          <div class="mid-headline">
            <h1 class="headterm"><?= the_field('headline_blog_items'); ?></h1>
            <h5 class="subhead"><?= the_field('sub_headline_blog_items'); ?></h5>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="col-md-12 col-sm-12 p-5">
        <div class="item-columns grid row m-0 container-ajax">
        <?php
        // $blog_ids = get_field('blog_items', false, false);
        $blog_query = new WP_Query(array(
          'post_type'      	=> 'post',
          'posts_per_page'	=> 3,
        ));
        ?>
        @if($blog_query->have_posts())
          @while($blog_query->have_posts()) @php($blog_query->the_post())
            <div class="item-blog col-md-4 col-sm-4 col-sx-6 col-12 grid-item pl-4 pr-4 post-ajax">
              <div class="card p-0">
                <div class="bg-images" style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(),'medium')}}');border-radius: 8px;height: 208px; min-height: 208px; width:370px;">
                  <img src="{{ Utilities::global_thumbnails(get_the_ID(),'medium')}}" class="card-img-top" alt="{{ the_title() }}">
                  <div class="card-overlay"><a class="the_permalink" href="{{ the_permalink() }}"></a></div>
                </div>
                <div class="card-body pt-2 pl-0 pr-0 pb-0">
                  <p class="label mb-0">
                    <time class="text-dark">{{ the_date('d M, Y') }}</time>
                  </p>
                  <a class="card-link" href="{{ the_permalink() }}">
                    <h5 class="card-title">{{ the_title() }}</h5>
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
          @php (wp_reset_postdata())
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
          <a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
      <?php endif; ?>
    </div>
  </section>

<script>
  jQuery(function($) {
    $(function() {
      $('ul.fader li').hide();
      $('ul.fader li').css('position', 'absolute');
      $('ul.fader li').css('top', '0px');
      $('ul.fader li').css('left', '0px');
      var max = $('ul.fader li').length;
      function showSlider() {
        if(localStorage.slider) {
          $('.fader').find('li:nth('+localStorage.slider+')').fadeIn();
          localStorage.slider = parseInt(localStorage.slider,10) + 1;
          if(localStorage.slider >= max) localStorage.slider = 0;
        } else{
          $('.fader').find('li:nth(0)').fadeIn();
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
    color:#646464;!important;
}
.item-blog .card p.card-text {
    color:#646464;!important;
    opacity: inherit;
}
.profile-dropdown .link-dropdown {
    width:214px;
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
    padding-bottom:0px;
    padding-top:99px;
}
.page-template-template-home-item section.recent-items {
    padding-top:20px;
    background:#F9F9F9;
}
.item-blog .card p.label time {
    color:#646464;
    font-weight:500;
    opacity:inherit;
}
body.page-template-template-home-item {
    background: #fff !important;
}
a.btn.btn-primary{
    background:linear-gradient(134.71deg, #6B73FF -0.5%, #000DFF 100%);
    border-radius: 30px;
    box-shadow:none;
}
.page-template-template-home-item section.banner-home-template {
  height:450px;
 }
i.fa.fa-angle-right {
  padding-left:9px;

}
</style>
@endsection
