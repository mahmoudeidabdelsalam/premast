{{--
  Template Name: Cart Template
--}}

@extends('layouts.app-dark')

@section('content')
@php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */
defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_before_cart' );
@endphp



  @while(have_posts()) @php the_post() @endphp
    <?php
    $count = WC()->cart->cart_contents_count;
    if (  $count == 0 ): ?>
      <div class="container-fluid pt-5 pb-5 form-cart-woocommerce mt-5 empty-cart-woo">
        <div class="row justify-content-center">
          <div class="col-12">
            <img src="{{ get_theme_file_uri().'/resources/assets/images/bag.svg' }}" alt="bag empty cart">
            <h2>{{ _e('Your cart is missing items', 'premast') }}</h2>
            <h5>{{ _e('How about you take another look around?', 'premast') }}</h5>
            <p class="return-to-shop">
              <a class="button wc-backward btn mt-5 text-white" href="{{ the_field('link_page_login','option') }}">
                <?php esc_html_e( 'continue shopping', 'woocommerce' ); ?>
              </a>
            </p>
          </div>
        </div>
      </div>

      <style>
        .empty-cart-woo {
            text-align: center;
        }

        .empty-cart-woo h2 {
            font-style: normal;
            font-weight: bold;
            font-size: 30px;
            line-height: 36px;
            text-align: center;
            color: #282F39;
            margin-top: 50px;
            margin-bottom: 25px;
        }

        h5 {
            font-weight: normal;
            font-size: 16px;
            line-height: 24px;
            text-align: center;
            letter-spacing: 0.04px;
            color: #646464;
        }

        p.return-to-shop .bitton {
            margin: 0;
        }

        .return-to-shop .button {
            margin: 30px 0 0 !important;
            background: linear-gradient(134.71deg, #1ADB72 -0.5%, #10B151 100%);
            border-radius: 30px;
            box-shadow: none !important;
            border: none !important;
            padding: 10px 24px !important;
        }

      </style>
    <?php else: ?>
    <div class="checkout-custom-header">
      @include('partials.page-header')
    </div>
    <div class="container-fluid pt-5 pb-5 form-cart-woocommerce mt-5">
      <div class="row justify-content-center">
        <div class="col-md-7 col-12">


          <h3>{{ _e('cart Items', 'premast') }}</h3>

          <div class="col-12 bg-white box-cart">
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
              <?php do_action( 'woocommerce_before_cart_table' ); ?>
              <table class="shop_table shop_table_responsive cart woocommerce-cart" cellspacing="0">
                <thead>
                  <tr>
                    <th class="product-name"><?php esc_html_e( 'item', 'woocommerce' ); ?></th>
				            <th class="product-remove">&nbsp;</th>
                    <th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                    <th class="product-thumbnail">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php do_action( 'woocommerce_before_cart_contents' ); ?>
                  <?php
                  foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                      $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                      ?>
                      <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                        <td class="product-thumbnail">
                        <?php
                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                        if ( ! $product_permalink ) {
                          echo $thumbnail; // PHPCS: XSS ok.
                        } else {
                          printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                        }
                        ?>
                        </td>

                        <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                        <?php
                        if ( ! $product_permalink ) {
                          echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                        } else {
                          echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                        }
                        do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                        // Meta data.
                        echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
                        // Backorder notification.
                        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                          echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                        }
                        ?>
                        </td>

                        <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                          <?php
                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                          ?>
                        </td>
                        <td class="product-remove">
                          <?php
                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                              'woocommerce_cart_item_remove_link',
                              sprintf(
                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                esc_html__( 'Remove this item', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                              ),
                              $cart_item_key
                            );
                          ?>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                  ?>
                  <?php do_action( 'woocommerce_cart_contents' ); ?>
                  <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                </tbody>
              </table>
              <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </form>
          </div>
        </div>

        <div class="col-md-4 col-12">
          <h3>{{ _e('cart total', 'premast') }}</h3>

          <div class="col-12 bg-white box-cart mb-5">
            <div class="box-coupon">
              <p><img class="img-fluid" src="{{ get_theme_file_uri().'/dist/images/coupon.png' }}" alt="{{ _e('coupon', 'premast') }}" title="{{ _e('coupon', 'premast') }}"/> <?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></p>
              <form class="checkout_coupon woocommerce-form-coupon" method="post" style="">
                <?php if ( wc_coupons_enabled() ) { ?>
                  <div class="coupon">
                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                  </div>
                <?php } ?>
                <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                <?php do_action( 'woocommerce_cart_actions' ); ?>
                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
              </form>
            </div>
          </div>


          <div class="col-12 bg-white box-cart">

            <div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">
              <?php do_action( 'woocommerce_before_cart_totals' ); ?>
              <table cellspacing="0" class="shop_table shop_table_responsive">
                <tr class="cart-subtotal">
                  <th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                  <td data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
                </tr>
                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                  <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                    <td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                  </tr>
                <?php endforeach; ?>
                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                  <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
                  <?php wc_cart_totals_shipping_html(); ?>
                  <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
                <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
                  <tr class="shipping">
                    <th><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
                    <td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
                  </tr>
                <?php endif; ?>
                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                  <tr class="fee">
                    <th><?php echo esc_html( $fee->name ); ?></th>
                    <td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
                  </tr>
                <?php endforeach; ?>
                <?php
                if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
                  $taxable_address = WC()->customer->get_taxable_address();
                  $estimated_text  = '';
                  if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                    /* translators: %s location. */
                    $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
                  }
                  if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
                    foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
                      ?>
                      <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <th><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
                        <td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                      </tr>
                      <?php
                    }
                  } else {
                    ?>
                    <tr class="tax-total">
                      <th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
                      <td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
                    </tr>
                    <?php
                  }
                }
                ?>


                <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
                <tr class="order-total">
                  <th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                  <td data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
                </tr>
                <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
              </table>

              <div class="wc-proceed-to-checkout">
                <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
              </div>
              <div class="checout-secure"><span class="footer-secure-payment">{{ _e('Secure Payment by', 'permast') }}</span> <img src="{{ get_theme_file_uri().'/dist/images/2checkout-2.png' }}" alt="2Checkout"></div>
              <?php do_action( 'woocommerce_after_cart_totals' ); ?>
            </div>


          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  @endwhile
@endsection


<style>
.checkout-custom-header {
    margin-top: 50px;
    height: 100px;
    position: relative;
    background: linear-gradient(176.82deg, #1FA2FF -4.21%, #274FDB 135.73%);
    display: flex;
    justify-content: center;
    align-items: center;
}

.checkout-custom-header h1 {
    font-style: normal;
    font-weight: 500;
    font-size: 40px;
    line-height: 47px;
    text-align: center;
    letter-spacing: 0.04px;
    text-transform: capitalize;
    color: #FFFFFF;
}

.box-coupon {
    padding: 20px 20px 0;
    font-weight: bold;
    font-size: 14px;
    line-height: 21px;
    letter-spacing: 0.04px;
    color: #282F39;
    opacity: 0.9;
}

.coupon input {
    border: 1px solid #E3E3E3;
    border-radius: 8px;
    height: 40px;
    width: 70%;
    padding: 10px;
}

.coupon button {
    background: linear-gradient(155.59deg, #6B73FF -0.5%, #000DFF 100%);
    border-radius: 30px;
    border: none;
    height: 40px;
    color: #fff;
}

.checout-secure img {
    width: 190px;
}

.checout-secure {
    display: flex;
    align-items: center;
    justify-content: center;
}

.wc-proceed-to-checkout a {
    box-shadow: none !important;
    height: 40px !important;
    display: inline-block !important;
}

.wc-proceed-to-checkout {
    text-align: center;
}
@media (max-width: 579px) {
  .container-fluid.pt-5.pb-5.form-cart-woocommerce.mt-5 {
      margin: 0 !important;
      padding: 20px 10px  !important;
  }

  .container-fluid.pt-5.pb-5.form-cart-woocommerce.mt-5 h3 {
      text-align: center;
      font-size: 16px;
      line-height: 24px;
      letter-spacing: 0.04px;
      color: #282F39;
  }

  .woocommerce table.shop_table_responsive tr td, .woocommerce-page table.shop_table_responsive tr td {
      border: none !important;
  }

  .form-cart-woocommerce .box-cart thead tr th {
      border: none !important;
  }

  form.woocommerce-cart-form {
      padding-bottom: 0 !important;
      margin: 0;
  }

}
button.button {
    width: 107px;
}
</style>

