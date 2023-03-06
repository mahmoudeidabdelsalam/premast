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


// [paddle-button product="123123" text="Subscribe"]
add_shortcode( 'paddle-button', 'paddle_button' );
function paddle_button( $atts ) {
  extract( shortcode_atts( array(
  'product' => 'product',
  'text' => 'text',
  ), $atts ) );

  if ( !is_user_logged_in() ) {
    return '<a class="mx-2 login text-gray-dark" href="#" data-toggle="modal" data-target="#LoginUser">Login</a>';
  } else {

    global $current_user;
    wp_get_current_user();
    $user_info = get_userdata($current_user->ID);

    return '<a href="#" class="paddle_button" data-email="'.$user_info->user_email.'" data-success="/thanks-subscription/" data-product="'.esc_attr($product).'" data-passthrough="'.$current_user->ID.'">'.esc_attr($text).'</a>';
  }

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
