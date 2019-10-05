<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateBlog extends Controller
{

  public function BlogsLoop() {

    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 0;

      global $wp_query;

      $query= $wp_query->query_vars;

      $args = array(
        'post_type' => 'post',
        'paged' => $paged,
        'suppress_filters' => 0,
        'posts_per_page' => 15,
        'offset' => 3,
      );

      $blogs = new \WP_Query($args);

      return $blogs;
  }
}
