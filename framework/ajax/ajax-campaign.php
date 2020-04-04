<?php 

add_action('wp_ajax_front_end_campaign', 'front_end_campaign', 0);
add_action('wp_ajax_nopriv_front_end_campaign', 'front_end_campaign');
function front_end_campaign() {

    $paged = $_POST["page"];
    $term = $_POST["term"];
    $page_id = $_POST["page_id"];

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
        $content = $post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
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
            <div class="modal-header border-0 pt-5">
              <h6 class="modal-title" id="exampleModalLabel"><?= html_entity_decode(get_the_title($post->ID)); ?></h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-8 col-12">
                  <?php  
                    $product = new WC_product($post->ID);
                    $attachment_ids = $product->get_gallery_image_ids();
                  ?>                         
                  <?php if ($attachment_ids): ?>
                  <ul id="galleryPro<?= $post->ID; ?>" class="galleryPro cS-hidden">
                    <?php foreach( $attachment_ids as $attachment_id ): ?>
                    <?php 
                      $thumbnail = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                    ?>
                    <li data-thumb="<?= $thumbnail[0]; ?>" data-src="<?= wp_get_attachment_url( $attachment_id ); ?>">
                      <img src="<?= wp_get_attachment_url( $attachment_id ); ?>" alt="gallery">
                    </li>                            
                  <?php endforeach; ?>
                  </ul>
                  <script>
                    jQuery(function ($) {
                      $('#Modal<?= $post->ID; ?>').on('shown.bs.modal', function (e) {
                        $('#galleryPro<?= $post->ID; ?>').lightSlider({
                          gallery: true,
                          item: 1,
                          loop: true,
                          thumbItem: 6,
                          slideMargin: 0,
                          enableDrag: false,
                          currentPagerPosition: 'left',
                          onSliderLoad: function (el) {
                            $('.lightSlider').removeClass('cS-hidden');
                            el.lightGallery({
                              selector: '#imageGallery .lslide',
                            });
                          },
                          responsive: [{
                            breakpoint: 480,
                            settings: {
                              enableDrag: true,
                              controls: false,
                              thumbItem: 4,
                            },
                          }],
                        });
                      });
                    });
                  </script>
                <?php else: ?>
                  <img src="<?= Utilities::global_thumbnails($post->ID,'full'); ?>" class="card-img-top" alt="<?= get_the_title($post->ID); ?>"> 
                <?php endif; ?>
                </div>
                <div class="col-md-4 col-12">
                  <div class="sideModal">
                    <h5><?= _e('Subscribe to download this item, and also get :', 'premast'); ?></h5>
                    <ul>
                      <li><img src="<?= get_theme_file_uri() . '/framework/assets/img/';?>download.svg" alt="Unlimted Download"> Unlimted Download </li>
                      <li><img src="<?= get_theme_file_uri() . '/framework/assets/img/';?>style.svg" alt="Multiple fields and styles"> Multiple fields and styles  </li>
                      <li><img src="<?= get_theme_file_uri() . '/framework/assets/img/';?>daily.svg" alt="Daily content uploads"> Daily content uploads  </li>
                      <li><img src="<?= get_theme_file_uri() . '/framework/assets/img/';?>commercial.svg" alt="Commercial license"> Commercial license </li>
                    </ul>

                    <?php
                      $link = get_field('button_offer_go', $page_id);
                      if( $link ):
                      $link_url = $link['url'];
                      $link_title = $link['title'];
                      $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                      <a class="button button-green" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?= _e('Subscribe to download', 'premast'); ?></a>
                    <?php endif; ?>

                    <h4><?php _e('APRIL SALE 50% OFF', 'premast'); ?></h4>
                    <p>Get unlimited downloads for just</p>
                    <p class="font-blod">15$/Month</p>
                  </div>
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