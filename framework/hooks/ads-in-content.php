<?php

add_filter( 'the_content', 'tbn_ads_inside_content' );
function tbn_ads_inside_content( $content ) {
  if ( is_single() && in_the_loop() && is_main_query() ) {
    $link_ads = get_field('link_ads', 'option');
    $banner_ads = get_field('banner_ads', 'option');
    
      if ($banner_ads) {
        $ads = "<p class='banner-custom'><a href='".$link_ads ."'><img src='".$banner_ads ."' /></a></p>";
      } else {
        $ads = "";
      }
      
      $p_array = explode('</p>', $content );
      $p_count = 1;
      if( !empty( $p_array ) ){
        array_splice( $p_array, $p_count, 0, $ads );
        $content = '';
        foreach( $p_array as $key=>$value ){
          $content .= $value;
        }
      }
    
    return $content;
  }

  return $content;
}