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

          <div class="container woocommerce customer-download">
            <div class="row justify-content-center m-0 pt-5 pb-5">
              <div class="col-md-12 col-sm-12">
                <table class="woocommerce-MyAccount-downloads shop_table shop_table_responsive"> 
                  <thead> 
                      <tr> 
                        <th><span class="nobr">{{ _e('Product', 'premast') }}</span></th> 
                        <th><span class="nobr">{{ _e('File', 'premast') }}</span></th> 
                      </tr> 
                  </thead> 
                  <?php foreach ( $downloads as $download ) : ?> 
                    <tr> 
                      <td>
                        <a href="<?php echo esc_url( get_permalink( $download['product_id'] ) ); ?>"> <?php echo esc_html( $download['product_name'] ); ?> </a> 
                      </td>
                      <td>
                        <a href="<?php echo esc_url( $download['download_url'] ); ?>" class="woocommerce-MyAccount-downloads-file"> <?php echo esc_html( $download['file']['name'] ); ?> </a> 
                      </td>
                    </tr> 
                  <?php endforeach; ?> 
                </table> 
              </div>
            </div>
          </div>
        <?php else : ?>
          <div class="container">
            <div class="row">
              <div class="woocommerce-Message woocommerce-Message--info woocommerce-info col-12 pt-5 pb-5 mb-5 mt-5">
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