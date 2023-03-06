<?php 
add_action('wp_ajax_get_galleries_product', 'galleries_product');
add_action('wp_ajax_nopriv_get_galleries_product', 'galleries_product');
function galleries_product() {

    
    
    $product_id = $_POST['product_id'];

    $product = new WC_product($product_id);
    $attachment_ids = $product->get_gallery_image_ids();

    $output .= '<ul id="imageGallery" class="cS-hidden">';
      foreach( $attachment_ids as $attachment_id ):
        $large = wp_get_attachment_image_url( $attachment_id, 'medium_large' );
        $thumb = wp_get_attachment_image_url( $attachment_id, 'thumbnail' );
        $output .= '<li data-thumb=" '.$thumb.' " data-src=" '. wp_get_attachment_url( $attachment_id ) .' ">';
          $output .= '<img src="'.$large.'" alt="'.the_title().'">';
        $output .= '</li>';
      endforeach;
    $output .= '</ul>';

    echo $output;

  	die;
}
