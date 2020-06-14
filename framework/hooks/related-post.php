<?php 

function related_posts() {
  global $post;

  //TODO related cat after complate
  $tags = wp_get_post_terms( $post->ID, 'product_tag' );
  $categories = get_the_terms( $post->ID, 'product_cat' );

  
    $category_ids = [];
    foreach ( $categories as $category ) {
      $category_ids[] = $category->term_id;
    }

    // dd($category_ids);
    
    $tag_ids = [];
    foreach ( $tags as $tag) {
      $tag_ids[] = $tag->term_id;
    }

    $related_args = array(
      'post_type'      => array('product'),
      'post_status'    => 'publish',
      'posts_per_page' => 8,
      'post__not_in'   => array($post->ID), 
      'tax_query'      => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $category_ids,
        ),
      ),
    );


    $query = new \WP_Query( $related_args );

    // dd($query);

  return new \WP_Query( $related_args );
}