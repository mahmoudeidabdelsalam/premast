<?php 

add_action('wp_ajax_get_free_terms', 'get_free_terms', 0);
add_action('wp_ajax_nopriv_get_free_terms', 'get_free_terms');

function get_free_terms() {

    $term = $_POST["term_id"];


    if ( ! defined( 'ABSPATH' ) ) {
      exit;
    }
    $downloads     = WC()->customer->get_downloadable_products();
    $has_downloads = (bool) $downloads;

    $product_ids = [];
    foreach ($downloads as $download) {
      $ids = $download['product_id'];
      $product_ids[] = $ids;
    }

    $somdn_download_history = get_posts(
      array(
        'fields' => 'ids',
        'posts_per_page' => -1,
        'post_type' => 'somdn_tracked',
      )
    );

    $somdn_download_ids = array();
    foreach( $somdn_download_history as $somdn_history ) {
      $somdn_product = get_post_meta( $somdn_history, 'somdn_product_id', true);
      if ( ! in_array( $somdn_product, $somdn_download_ids ) ) {
        $somdn_download_ids[] = $somdn_product;
      }
    }

    $args = array(
      'post_type' => 'product',
      'posts_per_page' => 20,
      'post__in' => $somdn_download_ids,
      'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field' => 'term_id',
          'terms' => $term
        )
      )
    );

    $loop = new WP_Query( $args );
    ?>
    <div class="container-fluid">
      <div class="row">
        <?php 
        if($loop->have_posts()): ?>
          
          <?php         
          while($loop->have_posts()): $loop->the_post(); ?>
            <div class="item-card col-md-3 col-sm-4 col-sx-6 col-12">
              <div class="card">
                <ul class="meta-buttons">
                  <li class="likes-button">
                    <?= get_simple_likes_button( get_the_ID() ); ?>
                  </li>
                  <li class="pinterest-share button-share">
                    <a target="_blank" href="http://pinterest.com/pin/create/button/?url<?= the_permalink(); ?>=&media=<?= Utilities::global_thumbnails(get_the_ID(),'medium'); ?>&description=<?= get_the_title(); ?>" class="pin-it-button" count-layout="horizontal">
                      <small>Pin it</small> <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul>

                <div class="bg-thumbnail">
                  <img src="<?= Utilities::global_thumbnails(get_the_ID(),'full'); ?>" class="card-img-top" alt="<?= the_title(); ?>">
                </div>
                <div class="card-body pt-3 pl-1 pr-1">
                  <a class="card-link" href="<?= the_permalink(); ?>">
                    <h5 class="card-title font-weight-400"><?= wp_trim_words(get_the_title(), '4', ' ...'); ?></h5>
                  </a>
                  <div class="review-and-download">
                    <div class="review">
                      <?php 
                      if (get_option('woocommerce_enable_review_rating' ) == 'yes'):  
                          global $product;
                          $rating_count = method_exists($product, 'get_rating_count')   ? $product->get_rating_count()   : 1;
                          $review_count = method_exists($product, 'get_review_count')   ? $product->get_review_count()   : 1;
                          $average      = method_exists($product, 'get_average_rating') ? $product->get_average_rating() : 0;
                          $counter_download = get_post_meta( get_the_ID(), 'counterdownload', true );
                          $counter_view = get_post_meta( get_the_ID(), 'c95_post_views_count', true );
                          $price = get_post_meta( get_the_ID(), '_regular_price', true);
                      ?>
                        <?php if ($rating_count > 0): ?>
                          <?= wc_get_rating_html($average, $rating_count); ?>
                          <span class="icon-review icon-meta" itemprop="reviewCount"><?= $average; ?></span>
                        <?php else: ?>
                          <?= wc_get_rating_html('1', '5'); ?>
                          <span class="icon-review icon-meta" itemprop="reviewCount"><?= _e('0', 'premast'); ?></span>
                        <?php endif; ?>
                      <?php endif; ?>

                      <span class="icon-download icon-meta"> <img class="img-meta" src="<?= get_theme_file_uri().'/dist/images/icon-download.svg'; ?>" alt="Download"> <?= ($counter_download)? $counter_download:'0'; ?></span>
                      <span class="icon-download icon-meta"> <img class="img-meta" src="<?= get_theme_file_uri().'/dist/images/icon-view.svg'; ?>" alt="Download"> <?= ($counter_view)? $counter_view:'0'; ?></span>
                    </div>
                  </div>
                </div>
              </div>              
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="col-12">
              <?= __('Sorry, no results were found.', 'sage'); ?>
          </div>
        <?php endif; ?>

        <div class="col-12 pt-5 pb-5">
          <nav aria-label="Page navigation example"><?= premast_base_pagination(array(), $loop); ?></nav>
        </div>
      </div>
    </div>
  <?php 
  die;
}