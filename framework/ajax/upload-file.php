<?php
add_action('wp_ajax_cvf_upload_files', 'cvf_upload_files');
add_action('wp_ajax_nopriv_cvf_upload_files', 'cvf_upload_files'); // Allow front-end submission 

function cvf_upload_files(){
    
    $parent_post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;  // The parent ID of our attachments
    $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "svg", "pdf", "pptx", "ppt"); // Supported file types
    $max_file_size = 102400 * 50000; // in kb
    $max_image_upload = 1000000; // Define how many images can be uploaded to the current post
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['path'] . '/';
    $count = 0;

    $attachments = get_posts( array(
        'post_type'         => 'attachment',
        'posts_per_page'    => -1,
        'post_parent'       => $parent_post_id,
        'exclude'           => get_post_thumbnail_id() // Exclude post thumbnail to the attachment count
    ) );

    // Image upload handler
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
        
        // Check if user is trying to upload more than the allowed number of images for the current post
        if( ( count( $attachments ) + count( $_FILES['files']['name'] ) ) > $max_image_upload ) {
            $upload_message[] = "Sorry you can only upload " . $max_image_upload . " images for each Ad";
        } else {
            
            foreach ( $_FILES['files']['name'] as $f => $name ) {
                $extension = pathinfo( $name, PATHINFO_EXTENSION );
                // Generate a randon code for each file name
                $new_filename = cvf_td_generate_random_code( 20 )  . '.' . $extension;
                
                if ( $_FILES['files']['error'][$f] == 4 ) {
                    continue; 
                }
                
                if ( $_FILES['files']['error'][$f] == 0 ) {
                    // Check if image size is larger than the allowed file size
                    if ( $_FILES['files']['size'][$f] > $max_file_size ) {
                        $upload_message[] = "$name is too large!.";
                        continue;
                    
                    // Check if the file being uploaded is in the allowed file types
                    } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
                        $upload_message[] = "$name is not a valid format";
                        continue; 
                    
                    } else{ 
                        // If no errors, upload the file...
                        if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$new_filename ) ) {
                            
                            $count++; 

                            $filename = $path.$new_filename;
                            $filetype = wp_check_filetype( basename( $filename ), null );
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                                'post_mime_type' => $filetype['type'],
                                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                                'post_content'   => '',
                                'post_status'    => 'inherit'
                            );
                            // Insert attachment to the database
                            $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                            
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename ); 
                            wp_update_attachment_metadata( $attach_id, $attach_data );
                            
                            return $attach_id;
                        }
                    }
                }
            }
        }
    }
    // Loop through each error then output it to the screen
    if ( isset( $upload_message ) ) :
        foreach ( $upload_message as $msg ){        
            printf( __('<p class="bg-danger">%s</p>', 'wp-trade'), $msg );
        }
    endif;
    
    // If no error, show success message
    if( $count != 0 ){
        printf( __('<p class = "bg-success">%d files added successfully!</p>', 'wp-trade'), $count );   
    }
    
    // exit();
}


add_action('wp_ajax_cvf_upload_thumbnail', 'cvf_upload_thumbnail');
add_action('wp_ajax_nopriv_cvf_upload_thumbnail', 'cvf_upload_thumbnail'); // Allow front-end submission 

function cvf_upload_thumbnail(){
    
    $parent_post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;  // The parent ID of our attachments
    $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "svg", "pdf", "pptx", "ppt"); // Supported file types
    $max_file_size = 102400 * 50000; // in kb
    $max_image_upload = 1000000; // Define how many images can be uploaded to the current post
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['path'] . '/';
    $count = 0;

    $attachments = get_posts( array(
        'post_type'         => 'attachment',
        'posts_per_page'    => -1,
        'post_parent'       => $parent_post_id,
        'exclude'           => get_post_thumbnail_id() // Exclude post thumbnail to the attachment count
    ) );

    // Image upload handler
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
        
        // Check if user is trying to upload more than the allowed number of images for the current post
        if( ( count( $attachments ) + count( $_FILES['thumbnail']['name'] ) ) > $max_image_upload ) {
            $upload_message[] = "Sorry you can only upload " . $max_image_upload . " images for each Ad";
        } else {
            
            foreach ( $_FILES['thumbnail']['name'] as $f => $name ) {
                $extension = pathinfo( $name, PATHINFO_EXTENSION );
                // Generate a randon code for each file name
                $new_filename = cvf_td_generate_random_code( 20 )  . '.' . $extension;
                
                if ( $_FILES['thumbnail']['error'][$f] == 4 ) {
                    continue; 
                }
                
                if ( $_FILES['thumbnail']['error'][$f] == 0 ) {
                    // Check if image size is larger than the allowed file size
                    if ( $_FILES['thumbnail']['size'][$f] > $max_file_size ) {
                        $upload_message[] = "$name is too large!.";
                        continue;
                    
                    // Check if the file being uploaded is in the allowed file types
                    } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
                        $upload_message[] = "$name is not a valid format";
                        continue; 
                    
                    } else{ 
                        // If no errors, upload the file...
                        if( move_uploaded_file( $_FILES["thumbnail"]["tmp_name"][$f], $path.$new_filename ) ) {
                            
                            $count++; 

                            $filename = $path.$new_filename;
                            $filetype = wp_check_filetype( basename( $filename ), null );
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                                'post_mime_type' => $filetype['type'],
                                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                                'post_content'   => '',
                                'post_status'    => 'inherit'
                            );
                            // Insert attachment to the database
                            $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                            
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename ); 
                            wp_update_attachment_metadata( $attach_id, $attach_data );
                            
                            return $attach_id;
                        }
                    }
                }
            }
        }
    }
    // Loop through each error then output it to the screen
    if ( isset( $upload_message ) ) :
        foreach ( $upload_message as $msg ){        
            printf( __('<p class="bg-danger">%s</p>', 'wp-trade'), $msg );
        }
    endif;
    
    // If no error, show success message
    if( $count != 0 ){
        printf( __('<p class = "bg-success">%d files added successfully!</p>', 'wp-trade'), $count );   
    }
    
    // exit();
}


add_action('wp_ajax_cvf_upload_gallery', 'cvf_upload_gallery');
add_action('wp_ajax_nopriv_cvf_upload_gallery', 'cvf_upload_gallery'); // Allow front-end submission 

function cvf_upload_gallery(){
    
    $parent_post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;  // The parent ID of our attachments
    $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "svg", "pdf", "pptx", "ppt"); // Supported file types
    $max_file_size = 102400 * 50000; // in kb
    $max_image_upload = 1000000; // Define how many images can be uploaded to the current post
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['path'] . '/';
    $count = 0;

    $attachments = get_posts( array(
        'post_type'         => 'attachment',
        'posts_per_page'    => -1,
        'post_parent'       => $parent_post_id,
        'exclude'           => get_post_thumbnail_id() // Exclude post thumbnail to the attachment count
    ) );

    // Image upload handler
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
        
        // Check if user is trying to upload more than the allowed number of images for the current post
        if( ( count( $attachments ) + count( $_FILES['gallery']['name'] ) ) > $max_image_upload ) {
            $upload_message[] = "Sorry you can only upload " . $max_image_upload . " images for each Ad";
        } else {
            
          $attach_ids = [];

            foreach ( $_FILES['gallery']['name'] as $f => $name ) {
                $extension = pathinfo( $name, PATHINFO_EXTENSION );
                // Generate a randon code for each file name
                $new_filename = cvf_td_generate_random_code( 20 )  . '.' . $extension;
                
                if ( $_FILES['gallery']['error'][$f] == 4 ) {
                    continue; 
                }
                
                if ( $_FILES['gallery']['error'][$f] == 0 ) {
                    // Check if image size is larger than the allowed file size
                    if ( $_FILES['gallery']['size'][$f] > $max_file_size ) {
                        $upload_message[] = "$name is too large!.";
                        continue;
                    
                    // Check if the file being uploaded is in the allowed file types
                    } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
                        $upload_message[] = "$name is not a valid format";
                        continue; 
                    
                    } else{ 
                        // If no errors, upload the file...
                        if( move_uploaded_file( $_FILES["gallery"]["tmp_name"][$f], $path.$new_filename ) ) {
                            
                            $count++; 

                            $filename = $path.$new_filename;
                            $filetype = wp_check_filetype( basename( $filename ), null );
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                                'post_mime_type' => $filetype['type'],
                                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                                'post_content'   => '',
                                'post_status'    => 'inherit'
                            );
                            // Insert attachment to the database
                            $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                            
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename ); 
                            wp_update_attachment_metadata( $attach_id, $attach_data );
                            
                            $attach_ids[] = $attach_id;
                            
                        }
                    }
                }
            }

            return $attach_ids;
        }
    }
    // Loop through each error then output it to the screen
    if ( isset( $upload_message ) ) :
        foreach ( $upload_message as $msg ){        
            printf( __('<p class="bg-danger">%s</p>', 'wp-trade'), $msg );
        }
    endif;
    
    // If no error, show success message
    if( $count != 0 ){
        printf( __('<p class = "bg-success">%d files added successfully!</p>', 'wp-trade'), $count );   
    }
    
    // exit();
}


// Random code generator used for file names.
function cvf_td_generate_random_code($length=10) {
   $string = '';
   $characters = "23456789ABCDEFHJKLMNPRTVWXYZabcdefghijklmnopqrstuvwxyz";
   for ($p = 0; $p < $length; $p++) {
       $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
   return $string;
}


function custom_remove_all_quantity_fields( $return, $product ) {return true;}
add_filter( 'woocommerce_is_sold_individually','custom_remove_all_quantity_fields', 10, 2 );

add_filter( 'add_to_cart_text', 'woo_custom_single_add_to_cart_text' );                // < 2.1
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );  // 2.1 +
  
function woo_custom_single_add_to_cart_text() {
  
    return __( 'Buy', 'woocommerce' );
}

/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function wpcodex_add_excerpt_support_for_pages() {
	add_post_type_support( 'product', 'author' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_pages' );