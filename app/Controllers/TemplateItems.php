<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateItems extends Controller
{

  /**
    * Function Name: Welcome Home()
    * This Function is used to return background, Headline, Subtitle and link For Welcome Section
    * @return array | the value of url image, text and link ACF
    * This function is called in home/section-welcome file
  */
  public function loopItems() {

  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
  $Name   = isset($_GET['refine']) ? $_GET['refine'] : '0';
  $sort   = isset($_GET['sort']) ? $_GET['sort'] : '0';
  
  if ( $sort == 'date' ):
    $orderby = 'date';
    $order = 'DESC';
    $meta_key = '';
  elseif( $sort == 'view') :
    $orderby = 'meta_value_num';
    $order = 'DESC';
    $meta_key = 'c95_post_views_count';
  elseif( $sort == 'download') :
    $orderby = 'meta_value_num';
    $order = 'DESC';
    $meta_key = 'counterdownload';
  else :
    $orderby = 'date';
    $order = 'DESC';
    $meta_key = '';
  endif;


    $args = array(
      'post_type' => 'product',
      'posts_per_page' => 20,
      'paged' => $paged,
      'meta_key' => $meta_key,
      'orderby' => $orderby,
      'order' => $order,
    );

    if($Name != '0') {
      $args['s'] = $Name;
    }
    
    if( $sort == 'featured') {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'product_visibility',
          'field'    => 'name',
          'terms'    => 'featured',
        ),
      );
    }

    $loop = new \WP_Query( $args );
        
    return  $loop;
  }

}
