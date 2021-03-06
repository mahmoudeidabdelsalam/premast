<?php 
add_shortcode( 'products-counter', 'products_counter' );
function products_counter( $atts ) {
    $atts = shortcode_atts( [
        'category' => '',
    ], $atts );

    $taxonomy = 'product_cat';
    if ( is_numeric( $atts['category'] ) ) {
        $cat = get_term( $atts['category'], $taxonomy );
    } else {
        $cat = get_term_by( 'slug', $atts['category'], $taxonomy );
    }

    if ( $cat && ! is_wp_error( $cat ) ) {
        return $cat->count;
    }
    return '';
}


// [product_count] shortcode
function product_count_shortcode( ) {
	$count_posts = wp_count_posts( 'product' );
	return $count_posts->publish;
}
add_shortcode( 'product_count', 'product_count_shortcode' );


function show_number_of_downloads() {
    $posts = get_posts( array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'fields'         => 'ids',
    ));

    $counter = [];
    foreach ($posts as $post) {
      if(get_post_meta( $post, 'counterdownload', true )) {
        $counter[] = get_post_meta( $post, 'counterdownload', true );
      }      
    }


    // dd($counter);

    if ( ! empty( $counter ) ) {
        echo '<p><strong>' . array_sum($counter) . '</strong> ' . __( 'Total Downloads' ) . '</p>';
    }
}

function show_number_users(){
  $total_users = count_users();
  echo $total_users['total_users'];
}