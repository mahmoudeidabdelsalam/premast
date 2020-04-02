<?php 

add_action('wp_ajax_front_end_campaign', 'front_end_campaign', 0);
add_action('wp_ajax_nopriv_front_end_campaign', 'front_end_campaign');
function front_end_campaign() {

 

    $paged = $_POST["page"];
    $term = $_POST["term"];

    $args = array(
      'post_type' => 'product',
      'posts_per_page' => 12,
      'paged' => $paged,
      'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field' => 'term_id',
          'terms' => $term
        )
      )
    );
    $posts = get_posts($args);

    if($posts):
      foreach ($posts as $post):
      setup_postdata( $post ); 
    ?>
      <div class="col-md-3 col-sm-6 col-12">
        <div class="card">
          <a class="img-modal" href="#" data-toggle="modal" data-target="#Modal<?= $post->ID; ?>">
            <img src="<?= Utilities::global_thumbnails($post->ID,'medium'); ?>" class="card-img-top" alt="<?= get_the_title($post->ID); ?>">
          </a>
          
          <div class="card-body">
            <h5 class="card-title"><a href="#" data-toggle="modal" data-target="#Modal<?= $post->ID; ?>"><?= html_entity_decode(wp_trim_words(get_the_title($post->ID), '4', ' ...')); ?></a></h5>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="Modal<?= $post->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?= $post->ID; ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?= html_entity_decode(get_the_title($post->ID)); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="product-description">
                    <h3 class="text-left mb-5"><?= _e('Description', 'premast'); ?></h3>
                    <div id="tab-description"><?= get_the_content($post->ID); ?></div>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <h3 class="text-left mb-5"><?= _e('Gallery', 'premast'); ?></h3>
                  <?php  
                    $product = new WC_product($post->ID);
                    $attachment_ids = $product->get_gallery_image_ids();
                    if ($attachment_ids):
                  ?>
                  <div id="galleryPro<?= $post->ID; ?>" class="galleryPro">
                    <?php foreach( $attachment_ids as $attachment_id ): ?>
                      <a href="<?= wp_get_attachment_url( $attachment_id ); ?>">
                        <?= wp_get_attachment_image($attachment_id, 'thumbnail'); ?>
                      </a>
                    <?php endforeach; ?>
                  </div>
                  <?php else : ?>
                    <img src="<?= Utilities::global_thumbnails($post->ID,'full'); ?>" class="card-img-top" alt="<?= get_the_title($post->ID); ?>"> 
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php 
      endforeach;
      wp_reset_postdata(); 
    else:
      echo "No tempalte More";
    endif;

	die;
}