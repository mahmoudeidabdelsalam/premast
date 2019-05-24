{{--
  Template Name: User Customer Download
--}}

@extends('layouts.template-custom')

@section('content')

@if(!is_user_logged_in())
  <div class="container">
    <div class="row justify-content-center m-0">
      <div class="user-not-login">
        <h2>{{ _e('See what’s happening in the world right now', 'premast') }}</h2>
        <p>{{ _e('Join Twitter today.', 'premast') }}</p>
        <a class="mt-2 login btn btn-blue" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a>
      </div>
    </div>
  </div>
@else
  <section class="header-users">
    <div class="container">
      <div class="row justify-content-between">
          <h2 class="headline">{{ _e('My Account', 'premast') }}</h2>
          
          @if (has_nav_menu('user_navigation'))
            {!! wp_nav_menu(['theme_location' => 'user_navigation', 'container' => false, 'menu_class' => 'nav nav-pills flex-column flex-sm-row col-12', 'walker' => new NavWalker()]) !!}
          @endif

      </div>
    </div>        
  </section>

  <section class="template-users">
        <?php
        if ( ! defined( 'ABSPATH' ) ) {
          exit;
        }
        $downloads     = WC()->customer->get_downloadable_products();
        $has_downloads = (bool) $downloads;

        $product_ids = [];

        foreach ($downloads as $download) {
          $ids = $download['product_id'];
          $product_ids[] = $ids;
        }
        
        

        $args = array(
          'post_type' => 'product',
          'posts_per_page' => 20,
          'post__in' => $product_ids,
        );
        
        $loop = new WP_Query( $args );

        do_action( 'woocommerce_before_account_downloads', $has_downloads ); ?>

        <?php if ( $has_downloads ) : ?>

          <div class="container-fiuld woocommerce customer-download">
            <div class="row justify-content-center m-0 pt-5 pb-5">
              <div class="col-md-12 col-sm-12">
                <div class="item-columns grid row m-0">
                  @if($loop->have_posts())
                    @while($loop->have_posts()) @php($loop->the_post())
                      <div class="item-card col-md-2 col-sm-3 col-sx-6 col-12 grid-item pl-4 pr-4">
                        <div class="card">
                          <div class="bg-white bg-images" style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(),'full')}}');height:204px;">
                            <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="card-img-top" alt="{{ the_title() }}">
                          </div>
                          <div class="card-body pt-2 pl-0 pr-0">
                            <a class="card-link" href="{{ the_permalink() }}">
                              <h5 class="card-title font-weight-400">{{ wp_trim_words(get_the_title(), '5', ' ...') }}</h5>
                            </a>
                            <div class="review-and-download">
                              <div class="review">
                                <a class="card-link" href="{{ the_permalink() }}">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <span itemprop="reviewCount">{{ _e('Rate it', 'premast') }}</span>
                                </a>
                              </div>
                              <div class="download">
                                <a class="card-link" href="{{ the_permalink() }}">
                                  {{ _e('Download', 'premast') }}
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>              
                      </div>
                    @endwhile
                    @php (wp_reset_postdata())
                  @endif
                </div>

                <div class="col-12">
                  <nav aria-label="Page navigation example">{{ premast_base_pagination(array(), $loop_items) }}</nav>
                </div>

              </div>

            </div>
          </div>
        <?php else : ?>
          <div class="container">
            <div class="row">
              <div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
                <a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                  <?php esc_html_e( 'Go shop', 'woocommerce' ); ?>
                </a>
                <?php esc_html_e( 'No downloads available yet.', 'woocommerce' ); ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php do_action( 'woocommerce_after_account_downloads', $has_downloads ); ?>

  </section>

  @endif
@endsection