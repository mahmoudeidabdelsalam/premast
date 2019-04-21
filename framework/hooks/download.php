<?php 
function show_number_of_downloads() {
    global $wpdb, $product;

    $product_id = ( is_object( $product ) && is_callable( array( $product, 'get_id' ) ) ) ? $product->get_id() : 0;

    if ( empty( $product_id ) ) return;

    $product_type = ( is_object( $product ) && is_callable( array( $product, 'get_type' ) ) ) ? $product->get_type() : 'simple';

    if ( 'variable' === $product_type ) {
        $product_ids = $product->get_children();
    } else {
        $product_ids = array( $product_id );
    }

    $how_many_product_ids = count( $product_ids );
    $id_placeholder       = array_fill( 0, $how_many_product_ids, '%d' );

    $count = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT SUM( download_count ) AS count
                FROM {$wpdb->prefix}woocommerce_downloadable_product_permissions
                WHERE product_id IN (".implode( ',', $id_placeholder ).")",
            $product_ids
        )
    );
    if ( ! empty( $count ) ) {
        echo '<strong>' . esc_html__( 'Total downloads' ) . '</strong>: ' . $count;
    }
}
add_action( 'woocommerce_single_product_summary', 'show_number_of_downloads' );