{{--
  Template Name: Checkout Template
--}}

@extends('layouts.app-dark')

@section('content')

@php
  $order_pay   = isset($_GET['key']) ? $_GET['key'] : '0';
  $to_cart   = isset($_GET['add-to-cart']) ? $_GET['add-to-cart'] : '0';

  // var_dump($to_cart);

  if($to_cart) {
    wp_redirect( wc_get_checkout_url() );
    exit();
  }
  if($order_pay):
@endphp


@while(have_posts()) @php the_post() @endphp
  <div class="checkout-custom-header">
    @include('partials.page-header')
  </div>

  <div class="container mt-5 mb-5">
    <div class="row">
      <?php echo do_shortcode( '[woocommerce_checkout]' ); ?>
    </div>            
  </div>
@endwhile

@php
  else:

  if ( ! defined( 'ABSPATH' ) ) {
    exit;
  }
  $checkout = WC()->checkout;

  global $current_user;
  wp_get_current_user();
  $user = wp_get_current_user();
@endphp

@while(have_posts()) @php the_post() @endphp
    <div class="checkout-custom-header">
      @include('partials.page-header')
    </div>
  

    <div class="container-fluid mt-5 mb-5">
      <div class="row">
        

        <div class="col-md-7 col-12 billing-custom">
          <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
            <!-- Custom billing -->
            <div class="woocommerce-billing-custom">
              <div class="woocommerce-billing-fields">
              
              <?php if ( ! is_user_logged_in()) : ?>
                <?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
                  <h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?> <span class="login-checkout"><?php _e('Already Have account', 'premast'); ?> <a class="mt-2 login text-primary" href="#" data-toggle="modal" data-target="#LoginUser">log in <i class="fa fa-angle-right"></i></a></span></h3>
                <?php else : ?>
                  <h3><?php esc_html_e( 'Billing details', 'woocommerce' ); ?> <span class="login-checkout"><?php _e('Already Have account', 'premast'); ?> <a class="mt-2 login text-primary" href="#" data-toggle="modal" data-target="#LoginUser">log in <i class="fa fa-angle-right"></i> </a></span></h3>
                <?php endif; ?>
              <?php else : ?>
                <?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
                  <h3>
                    <?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?> 
                    <a class="btn-edit login-checkout" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      <?php _e('edit billing details', 'premast'); ?>
                    </a>  
                  </h3>
                <?php else : ?>
                  <h3>
                    <?php esc_html_e( 'Billing details', 'woocommerce' ); ?>
                    <a class="btn-edit login-checkout" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      <?php _e('edit billing details', 'premast'); ?>
                    </a>  
                  </h3>
                <?php endif; ?>
              <?php endif; ?>


              <?php if ( ! is_user_logged_in()) : ?>
                <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
                <div class="woocommerce-billing-fields__field-wrapper">
                  <?php
                  $fields = $checkout->get_checkout_fields( 'billing' );
                  foreach ( $fields as $key => $field ) {
                    woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                  }
                  ?>
                </div>
                <?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
                <?php else: ?>
                  <div class="save-data">
                    <?php echo mwe_get_formatted_shipping_name_and_address($current_user->ID); ?>
                  </div>
                  <div class="collapse" id="collapseExample">
                    <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
                    <div class="woocommerce-billing-fields__field-wrapper">
                      <?php
                      $fields = $checkout->get_checkout_fields( 'billing' );
                      foreach ( $fields as $key => $field ) {
                        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                      }
                      ?>
                    </div>
                    <?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
                  </div>
                <?php endif; ?>
              </div>
              <?php if ( ! is_user_logged_in()) : ?>
                <div class="woocommerce-account-fields">
                  <?php if ( ! $checkout->is_registration_required() ) : ?>
                    <p class="form-row form-row-wide create-account">
                      <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
                      </label>
                    </p>
                  <?php endif; ?>
                  <?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>
                  <?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>
                    <div class="create-account">
                      <h4><?php _e('Account password', 'premast'); ?></h4>
                      <?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
                        <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                      <?php endforeach; ?>
                      <div class="clear"></div>
                    </div>
                  <?php endif; ?>

                  <?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
                </div>
              <?php endif; ?>
            
                
                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
                <div id="order_review" class="woocommerce-checkout-review-order mt-0">
                  <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>
                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

            </div>
          </form>
        </div>

        

        <div class="col-md-5">
            <?php
              defined( 'ABSPATH' ) || exit;
              if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
                return;
              }
            ?>

          <div class="col-12 bg-white box-cart mb-5 summary-custom mt-0">
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

          <!-- Custom summary -->
          <div class="col-12 summary-custom">
            <h3><?php _e('order summary', 'premast'); ?></h3>
            <table class="shop_table woocommerce-checkout-review-order-table">
              <thead>
                <tr>
                  <th class="product-name"><?php esc_html_e( 'item', 'woocommerce' ); ?></th>
                  <th class="product-total"><?php esc_html_e( 'price', 'woocommerce' ); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                do_action( 'woocommerce_review_order_before_cart_contents' );
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                  $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                  $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                  if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    ?>
                    <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                      <td class="product-name">
                        <?php
                          $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                          if ( ! $product_permalink ) {
                            echo $thumbnail; // PHPCS: XSS ok.
                          } else {
                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                          }
                        ?>
                        <?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
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
                      <td class="product-total">
                        <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
                do_action( 'woocommerce_review_order_after_cart_contents' );
                ?>
              </tbody>
              <tfoot>
                <tr class="cart-subtotal">
                  <th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                  <td><?php wc_cart_totals_subtotal_html(); ?></td>
                </tr>
                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                  <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                    <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                  </tr>
                <?php endforeach; ?>
                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                  <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
                  <?php wc_cart_totals_shipping_html(); ?>
                  <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
                <?php endif; ?>
                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                  <tr class="fee">
                    <th><?php echo esc_html( $fee->name ); ?></th>
                    <td><?php wc_cart_totals_fee_html( $fee ); ?></td>
                  </tr>
                <?php endforeach; ?>
                <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                  <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                    <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
                      <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <th><?php echo esc_html( $tax->label ); ?></th>
                        <td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr class="tax-total">
                      <th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                      <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                    </tr>
                  <?php endif; ?>
                <?php endif; ?>
                <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
                <tr class="order-total">
                  <th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                  <td><?php wc_cart_totals_order_total_html(); ?></td>
                </tr>
                <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
              </tfoot>
            </table>
          </div>

          @if(get_field('donation_text', 'option') || get_field('donation_link', 'option'))
            <div class="col-12 custom-banner" style="background-image:url('{{ the_field('donation_background_image', 'option') }}'); background-color:{{ the_field('donation_background_color', 'option') }};">
              <div class="media">
                <img src="{{ the_field('donation_icon', 'option') }}" class="mr-3" alt="{{ the_field('donation_text', 'option') }}">
                <div class="media-body">
                  <p>{{ the_field('donation_text', 'option') }}</p>
                  <a href="{{ the_field('donation_link', 'option') }}" class="overlay-link"></a>
                </div>
              </div>
            </div>
          @endif

          <div class="checout-secure"><span class="footer-secure-payment">{{ _e('Secure Payment by', 'permast') }}</span> <img src="{{ get_theme_file_uri().'/dist/images/2checkout-2.png' }}" alt="2Checkout"></div>
        </div>
      </div>
    </div>
 


  <script type = "text/javascript">
    jQuery(function($) {
      if($('#billing_first_name').val() === "" || $('#billing_last_name').val() === "" || $('#select2-billing_country-container').val() === "" || $('#billing_address_1').val() === "" || $('#billing_city').val() === "" || $('#billing_email').val() === "" || $('#account_password').val() === ""  ){ 
        $('.btn-next').addClass('hidden');
      } else {
        $('.btn-next').removeClass('hidden');
      }
      $(".woocommerce-billing-custom .form-row input").blur(function() { 
        if($(this).val() == ''){ 
          $('.btn-next').addClass('hidden');
        } else {
          $('.btn-next').removeClass('hidden');
        }
      });
    });
  </script>

  

  @endwhile
  <?php endif; ?>
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
    background: #E8E8E8;
    border-radius: 30px;
    border: none;
    font-weight: normal;
    font-size: 16px;
    line-height: 24px;
    text-align: center;
    letter-spacing: 0.04px;
    text-transform: capitalize;
    color: #A6A6A6;
    flex: none;
    order: 0;
    align-self: center;
    margin: 10px 0px;
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

.woocommerce-privacy-policy-text {
    display: none;
}

.woocommerce-billing-fields input, .woocommerce-billing-fields select {
    background: #FFFFFF;
    border: 1px solid #E3E3E3 !important;
    box-sizing: border-box !important;
    border-radius: 8px;
    height: 50px !important;
    align-items: center;
    letter-spacing: 0.04px;
    color: #3F4A59 !important;
    font-size: 16px !important;
    opacity: 1 !important;
}

span.login-checkout a {
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 19px;
    letter-spacing: 0.132987px;
    text-transform: capitalize;
    color: #1e6dfb;
    border-radius: 4px;
    margin: 0 10px !important;
    display: flex;
    float: right;
    justify-content: space-between;
    align-items: center;
    width: 57px;
}

.save-data p {
    font-size: 16px !important;
    line-height: 24px !important;
    letter-spacing: 0.04px !important;
    color: #3F4A59 !important;
    text-transform: lowercase !important;
    margin-bottom: 10px !important;
}

.btn-edit {
    font-size: 15px;
    line-height: 18px;
    letter-spacing: 0.0329024px;
    text-transform: capitalize;
    color: #1E6DFB;
    position: absolute;
    right: 40px;
}

.summary-custom td.product-name a.remove {
    color: red;
    overflow: visible;
    margin: 0 0 0 30px;
    font-size: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>