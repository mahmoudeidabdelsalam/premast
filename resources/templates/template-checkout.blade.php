{{--
  Template Name: Checkout Template
--}}

@extends('layouts.app-dark')

@section('content')

@php global $wp; @endphp

@if ( is_checkout() && !empty( $wp->query_vars['order-received'] ) ) 



  @php 
    $send = (isset($_GET['send']))? $_GET['send']:'';
    global $current_user;
    wp_get_current_user();
  @endphp

  @if($send == 'true')
    <!-- Modal -->
    <div class="modal" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content" style="background-image:url('{{ the_field('background_banner_hero') }}');">
          <div class="modal-header border-0">
            <h5 class="modal-title text-white" id="exampleModalLongTitle">Dear <?= $current_user->display_name; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-white">
            <h2 class="text-white">Thank you,</h2> the invitation has been sent to your friend
          </div>
        </div>
      </div>
    </div>
    <script>
      jQuery(function($) {
        $('#exampleModalLong').modal('show')
      });
    </script>
  @endif

    <div class="checkout-custom-header">
      <h1>{{ _e('Thanks for your purchase!', 'premast') }}</h1>
      <p>We hope you like your experience with premast, check your downloads in profile to download the item you just purchased</p>
      @php 
        $like_download = get_field('download_page','option') . '?tabs=paid';
      @endphp 

      <div class="bottom-summary pr-4 pl-4">
        <a href="{{ $like_download }}">{{ _e("Go to your downloads now", 'premast') }}</a>
      </div>
    </div>


  <section class="banner-share">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-md-6 text-left">
          <h3>Psssst! Wanna get a month of premium subscription for free?</h3>
          <p class="text-left">Have up to 6 months free premium subscription by inviting your friends to sign up at Premast. For each friend you bring you will have a 1 month free premium subscription.</p>
        </div>
        <div class="col-12 col-md-6">
          <div class="custom-share">
            <h4>{{ _e('Invite through mail', 'premast') }}</h4>
            <?php
              $form = get_field('forms_referral', 'option');
              $inputs = get_all_form_fields($form['id']);
              $link = get_field('link_signup', 'option').'?refer='.$current_user->ID.'&token='.get_the_date('U').'';
            ?>

            <form class="form-inline" role="" method="post" id="gform_<?= $form['id']; ?>" action="<?= the_permalink(); ?>?send='true'">
              <?php foreach ($inputs as $input): ?>
                <?php if($input["type"] == "email"): ?>
                  <div class="form-group mb-2">
                    <input type="email" name="input_<?= $input["id"]; ?>" class="form-control" id="emailInput" placeholder="write an email">
                  </div>
                <?php elseif($input["type"] == "hidden"): ?>
                  <input type="text" name="input_<?= $input["id"]; ?>" class="form-control" hidden value="<?= $current_user->display_name; ?>">
                <?php else: ?>
                  <input type="text" name="input_<?= $input["id"]; ?>" class="form-control" hidden value="<?= $link; ?>">
                <?php endif; ?>
              <?php endforeach; ?>
              <button id="gform_submit_button_<?= $form['id']; ?>" class="btn btn-primary mb-2 shadow-none py-2 px-4"><span>{{ _e('Send Invite', 'premast') }}</span></button>
              <input type="hidden" class="gform_hidden" name="is_submit_<?= $form['id']; ?>" value="1">
              <input type="hidden" class="gform_hidden" name="gform_submit" value="<?= $form['id']; ?>">
              <input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
              <input type="hidden" class="gform_hidden" name="state_<?= $form['id']; ?>" value="WyJbXSIsImU5YjY1MWMyNzBhYjc5MDI0ZjlmYzlkZjVhMzVmMTZmIl0=">
              <input type="hidden" class="gform_hidden" name="gform_target_page_number_<?= $form['id']; ?>" id="gform_target_page_number_<?= $form['id']; ?>" value="0">
              <input type="hidden" class="gform_hidden" name="gform_source_page_number_<?= $form['id']; ?>" id="gform_source_page_number_<?= $form['id']; ?>" value="1">
              <input type="hidden" name="gform_field_values" value="">
            </form>

            <ul class="list-inline social-sharer">
              <li class="head"><span>{{ _e('Share your link', 'premast') }}</span></li>
              <li class="list-inline-item">
                <a class="item" data-network="linkedin" data-url="{{ home_url('/') }}" data-title="{{ $link}}" href="#"> <i class="fa fa-linkedin"></i></a>
              </li>
              <li class="list-inline-item">
                <a class="item" data-network="twitter"  data-url="{{ home_url('/') }}" data-title="{{ $link}}" href="#"> <i class="fa fa-twitter"></i></a>      
              </li>
              <li class="list-inline-item">
                <a class="item" data-network="facebook" data-url="{{ home_url('/') }}" data-title="{{ $link}}" href="#"> <i class="fa fa-facebook"></i></a>      
              </li>
              <li class="list-inline-item">
                <a class="item" data-network="addtoany" data-url="{{ $link }}" data-title="{{ $link }}" href="#"> <i class="fa fa-ellipsis-v"></i></a>      
              </li>
            </ul>

            <div id="inviteCode" class="invite-page">
              <input id="link" value="{{ $link }}" readonly>
              <div id="copy">
                <i data-copytarget="#link">{{ _e('Copy Link', 'premast') }}</i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <script>
    jQuery(function($) {
      
      $('#copy').on('click', function(event) {
        console.log(event);
        copyToClipboard(event);
      });
      
      function copyToClipboard(e) {
        var
          t = e.target, 
          c = t.dataset.copytarget,
          inp = (c ? document.querySelector(c) : null);
        console.log(inp);
        if (inp && inp.select) {
          inp.select();
          try {
            document.execCommand('copy');
            inp.blur();
            t.classList.add('copied');
            setTimeout(function() {
              t.classList.remove('copied');
            }, 1500);
          } catch (err) {
            alert('please press Ctrl/Cmd+C to copy');
          }
        }
      }
    });
  </script>




  <style>
  .checkout-custom-header {
      margin-top: 50px;
      height: 300px;
      position: relative;
      background: linear-gradient(176.82deg, #1FA2FF -4.21%, #274FDB 135.73%);
      display: flex;
      justify-content: center;
      align-items: center;
      flex-flow: column;
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

  .checkout-custom-header p {
      font-style: normal;
      font-weight: normal;
      font-size: 16px;
      line-height: 24px;
      text-align: center;
      letter-spacing: 0.04px;
      color: #FFFFFF;
      width: 50%;
  }

  .checkout-custom-header .bottom-summary {
      box-shadow: none !important;
  }
  </style>

@else

  @php
    $order_pay   = isset($_GET['key']) ? $_GET['key'] : '0';
    $to_cart   = isset($_GET['add-to-cart']) ? $_GET['add-to-cart'] : '0';

    // dd($to_cart);

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

          

          <div class="col-md-5 custom-d-flax-mobile">
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
            <div class="col-12 summary-custom summary-order-custom-mobile">
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



@endif

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

@media (max-width: 579px) {
  .summary-order-custom-mobile {
      order: 1 !important;
      padding: 0 !important;
      margin-bottom: 20px;
  }
  .custom-d-flax {
      display: flex;
      flex-flow: wrap;
  }
  .custom-d-flax .col-12,
  .custom-d-flax .checout-secure {
      order: 2;
  }
  .summary-order-custom-mobile h3 {
      border-bottom: 1px solid rgba(0, 0, 0, 0.4);
      padding: 10px;
  }
  .summary-custom td.product-name a img {
      height: 50px !important;
      max-width: 50px !important;
  }
  .summary-order-custom-mobile h3 {
      border-bottom: 1px solid rgba(0, 0, 0, 0.4);
      padding: 10px;
  }
  .summary-custom .shop_table td,
  .summary-custom .shop_table th {
      border: none !important;
  }
  .summary-custom .shop_table tbody {
      padding: 10px !important;
      border-bottom: 1px solid rgba(0, 0, 0, 0.4);
  }
  td.product-name {
    font-weight: bold !important;
    font-size: 14px;
    line-height: 21px;
    letter-spacing: 0.04px;
    color: #282F39;
  }  
  tfoot tr th, tfoot tr td {
    padding: 10px !important;
    font-size: 14px !important;
    font-weight: bold !important;
  }  
  .custom-banner .media {
    flex-flow: column;
  }
  .custom-banner {
    margin: 0;
  }
  .checout-secure {
    display: none;
  }
  .custom-d-flax-mobile .col-12 {
    order: 2;
  }
  .custom-d-flax-mobile {
    display: flex;
    flex-wrap: wrap;
  }
}
</style>
