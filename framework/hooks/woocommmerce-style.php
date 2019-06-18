<?php
function woocommmerce_style() {
   wp_enqueue_style('woocommerce_stylesheet', WP_PLUGIN_URL. '/woocommerce/assets/css/woocommerce.css',false,'1.0',"all");
}
add_action( 'wp_head', 'woocommmerce_style' );


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );


/**
 * Display "FREE" instead of $0 if the item is free.
 *
 * @param string $price The current price label.
 * @param object $product The product object.
 * @return string
 */
function thenga_price_override( $price, $product ) {
   if ( empty( $product->get_price() ) ) {
      /*
       * Replace the word "Free" with whatever text you would like. Also
       * remember to update the textdomain for translation if required.
       */
      $price = __( 'Free version', 'premast' );
   }
 
   return $price;
}
add_filter( 'woocommerce_get_price_html', 'thenga_price_override', 100, 2 );

function remove_gallery_and_product_images() {
if ( is_product() ) {
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
    }
}
add_action('loop_start', 'remove_gallery_and_product_images');

add_filter('acf/update_value/name=featured_image', function ($value, $post_id, $field) {
if ($value != '') {
    update_post_meta($post_id, '_thumbnail_id', $value);
} else {
    delete_post_thumbnail($post_id);
}

return $value;
}, 10, 3);