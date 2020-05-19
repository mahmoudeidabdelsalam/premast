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
          <img src="<?= the_field('image_banner_background_template'); ?>" alt="<?= the_field('headline_banner_template'); ?>">
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
                  <img src="{{ Utilities::global_thumbnails(get_the_ID(),'medium')}}" class="card-img-top" alt="{{ the_title() }}">
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
    </div>
  </section>

  <section class="recent-items" style="background: #F9F9F9;">
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
                      <img src="{{ Utilities::global_thumbnails(get_the_ID(),'medium')}}" class="card-img-top" alt="{{ the_title() }}">
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
    </div>
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
                  <img src="{{ Utilities::global_thumbnails(get_the_ID(),'medium')}}" class="card-img-top" alt="{{ the_title() }}">
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
      <div class="col-md-12 col-sm-12">
        <div class="item-columns grid row m-0 container-ajax">
        <?php 
        $blog_ids = get_field('blog_items', false, false);
        $blog_query = new WP_Query(array(
          'post_type'      	=> 'post',
          'posts_per_page'	=> 3,
          'post__in'			=> $blog_ids,
          'orderby'        	=> 'post__in',
        ));
        ?>
        @if($blog_query->have_posts())
          @while($blog_query->have_posts()) @php($blog_query->the_post())
            <div class="item-blog col-md-4 col-sm-4 col-sx-6 col-12 grid-item pl-4 pr-4 post-ajax">
              <div class="card p-0">
                <div class="bg-images" style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(),'medium')}}');border-radius: 9px;height: 208px; min-height: 208px;">
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

   <style>
    section.blog-items {
        border: 1px solid rgba(0, 0, 0, 0.08);
    }     
    .heading {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: 500;
        font-size: 40px;
        line-height: 47px;
        text-transform: capitalize;
        color: #282F39;
    }

    .sub-heading {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        line-height: 24px;
        letter-spacing: 0.04px;
        color: #646464;
    }

    a.go {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        line-height: 19px;
        letter-spacing: 0.132987px;
        text-transform: capitalize;
        color: #1E6DFB;
        padding-top: 60px;
        padding-bottom: 30px;
        float: right;
    }

    .card-title h6 {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: bold;
        font-size: 15px;
        line-height: 18px;
        letter-spacing: 0.151985px;
        text-transform: capitalize;
        color: #3F4A59;
    }

    img.card-img-top {
        padding: 7px;
    }

    .items {
        display: flex;
    }

    .rate:before {
        content: "\f005";
        font-family: "FontAwesome";
        color: #ED8A19;
        padding-right: 4px;

    }

    .download:before {
        content: "\f01a";
        font-family: "FontAwesome";
        color: #1E6DFB;
        padding-right: 4px;
        padding-left: 13px;
    }

    .like:before {
        content: "\f08a";
        font-family: "FontAwesome";
        color: #1E6DFB;
        padding-right: 4px;
        padding-left: 13px;

    }

    .intro {
        padding-top: 90px;
        padding-left: 21px;
    }

    a.go-link {
        margin-top: 13rem;
        float: right;
        padding-right: 25px;
    }

    h3.headline {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: normal;
        font-size: 24px;
        line-height: 32px;
        color: #1E6DFB;
        margin-bottom: 20px;
    }

    h3.sec-headline {
        margin-top: 120px;
        margin-left: 25px;
        font-family: 'Roboto';
        font-style: normal;
        font-weight: normal;
        font-size: 24px;
        line-height: 32px;
        color: #1E6DFB;
    }

    h1.headterm {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: 500;
        font-size: 40px;
        line-height: 47px;
        text-align: center;
        text-transform: capitalize;
        color: #282F39;
    }

    h5.subhead {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        line-height: 24px;
        text-align: center;
        letter-spacing: 0.04px;
        color: #646464;
    }

    .mid-headline {
        margin: 32px;
    }

    .blog-items .button, 
    .popular-items .button {
        text-align: center;
        margin: 77px;
    }

    a.btn.btn-primary {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        line-height: 24px;
        text-align: center;
        letter-spacing: 0.04px;
        text-transform: capitalize;
        color: #FFFFFF;
        border: none;
        border-radius: 90px;
        padding-top: 8px
    }

    .btn-primary {
        width: 237px;
        height: 40px;
        background: linear-gradient(170.33deg, #6B73FF -0.5%, #000DFF 100%);
        border-color: transparent;
    }

    .btn-primary:hover {
        background: linear-gradient(170.33deg, #6B73FF -0.5%, #000DFF 100%);
        opacity: 0.9;
    }

    section.banner-home-template {
        height: 500px;
        position: relative;
        padding-top: 150px;
    }

    .overlay-banner {
        position: absolute;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: top center;
        top: 0;
    }

    section.banner-home-template h2 {
        font-style: normal;
        font-weight: 500;
        font-size: 40px;
        line-height: 47px;
        color: #FFFFFF;
    }

    section.banner-home-template p {
        font-style: normal;
        font-weight: normal;
        font-size: 30px;
        line-height: 36px;
        color: #FFFFFF;
    }

    section.banner-home-template h2 {
        font-style: normal;
        font-weight: 500;
        font-size: 40px;
        line-height: 47px;
        color: #FFFFFF;
    }

    .search-items form {
        background: #FFFFFF;
        border: 1px solid rgba(30, 109, 251, 0.2);
        box-sizing: border-box;
        border-radius: 40px;
        max-width: 500px;
        padding: 5px 10px;
    }

    .search-items form input {
        background: transparent;
        border: none;
        width: 90%;
    }

    .search-items form button {
        background: transparent;
        border: none;
        float: right;
        color: #1f6cfd;
    }

    .trand-now {
        margin-top: 50px;
    }

    .trand-now h3 {
        font-weight: 500;
        font-size: 14px;
        line-height: 16px;
        letter-spacing: 0.132987px;
        text-transform: capitalize;
        color: #FFFFFF;
    }

    .trand-now ul {
        padding: 0;
    }

    .trand-now ul a {
        background: #90C1F9;
        border-radius: 40px;
        padding: 6px 20px;
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 16px;
        letter-spacing: 0.132987px;
        text-transform: capitalize;
        color: #282F39;
        margin: 18px 10px;
        display: inline-block;
    }

    section.popular-items {
        padding-top: 55px;
    }

    .items-categories {
        height: auto;
        min-height: 1px;
    }

    section.recent-items {
        padding-top: 80px;
    }

    @media (max-width: 575.98px) {
      section.banner-home-template {
        height: auto;
        padding: 30px 15px;
      }
      section.banner-home-template img {
        width: 100%;
      }
      .go {
        padding: 0;
      }
      section.recent-items {
        padding-top: 10px;
      }      
    }

    @media (max-width: 575.98px){
      section.banner-home-template {
          height: auto;
          padding: 30px 0px;
      }
      .trand-now ul a {
          margin: 5px 2px;
      }
      .trand-now {
          margin-bottom: 50px;
      }
      section.banner-home-template h2 {
          font-size: 29px;
      }
      section.banner-home-template p {
          font-size: 20px;
          line-height: 30px;
          font-weight: 300;
      }
      h1.heading {
          font-size: 20px;
      }

      .blog-items .button, 
      .popular-items .button {
          margin: 20px 0px 50px 0px;
      }
    }
   </style>
@endsection