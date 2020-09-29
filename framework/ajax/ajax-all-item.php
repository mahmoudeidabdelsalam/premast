<?php 
add_action('wp_ajax_get_sort_items', 'get_sort_items', 0);
add_action('wp_ajax_nopriv_get_sort_items', 'get_sort_items');

function get_sort_items() {

  $sort     = isset($_POST['sort']) ? $_POST['sort'] : '0';
  $paged    = isset($_POST['paged']) ? $_POST['paged'] : '0';
  $term_id  = isset($_POST['term_id']) ? $_POST['term_id'] : '0';
  $checked  = isset($_POST['checked']) ? $_POST['checked'] : 'false';
  $following  = isset($_POST['following']) ? $_POST['following'] : '0';

  if ($checked != "false" && $following) {

    $args = array(
      'post_type' => 'product',
      'posts_per_page' => 20,
      'paged' => $paged,
      'author__in'       => $following,
      'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field' => 'term_id',
          'terms' => $term_id
        )
      )
    );

    $my_query = new\ WP_Query($args);
  } else {
    if ( $sort == 'date' ):
      $orderby = 'date';
      $order = 'DESC';
      $meta_key = '';
    elseif( $sort == 'view') :
      $orderby = 'meta_value_num';
      $order = 'DESC';
      $meta_key = 'c95_post_views_count';
    elseif ( $sort == 'download' ):
      $orderby = 'meta_value_num';
      $order = 'DESC';
      $meta_key = 'counterdownload';
    else :
      $orderby = 'date';
      $order = 'DESC';
      $meta_key = '';
    endif;

    if ($sort != '0') {
        $second_ids = get_posts(array(
            'post_type' => 'product',
            'posts_per_page' => 19,
            'fields' => 'ids',
            'paged' => $paged,
            'meta_key' => $meta_key,
            'orderby' => $orderby,
            'order' => $order,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $term_id
                )
            )
        ));
        $per_page = 20 - count($second_ids);
    } else {
        $second_ids = [];
        $per_page = 19;
    }
    $orders = array(
        'post_type' => 'product',
        'posts_per_page' => 18,
        'paged' => $paged,
        'meta_key' => $meta_key,
        'orderby' => $orderby,
        'order' => $order,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    );
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $per_page,
        'post__not_in' => $second_ids,
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    );
    if ($Name != '0') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_tag',
                'field' => 'name',
                'terms' => $Name,
            ),
        );
    }

    if ($sort == 'featured') {
        $orders['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product_visibility',
                'field' => 'name',
                'terms' => 'featured',
            ),
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $term_id
            )
        );
    }
    $my_query = new\ WP_Query($args);
    if ($sort != '0') {
        $more_query = new\ WP_Query($orders);
        $my_query->posts = array_merge($more_query->posts, $my_query->posts);
        $my_query->post_count = count($my_query->posts);
    }
  }



    ?>
    <div class="container-fluid">
      <div class="row">
        <?php 
        if($my_query->have_posts()): ?>
          
          <?php         
          while($my_query->have_posts()): $my_query->the_post(); ?>
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
                  <a href="<?= the_permalink(); ?>">
                    <img src="<?= Utilities::global_thumbnails(get_the_ID(),'medium'); ?>" class="card-img-top" alt="<?= the_title(); ?>">
                  </a>
                </div>
                <div class="card-body pt-3 pl-1 pr-1">
                  <a class="card-link" href="<?= the_permalink(); ?>">
                    <h5 class="card-title font-weight-400"><?= html_entity_decode(wp_trim_words(get_the_title(), '4', ' ...')); ?></h5>
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
          <?php if ($sort != '0' && $checked == "false"): ?>
            <nav aria-label="Page navigation example"><?= premast_ajax_pagination(array(), $more_query); ?></nav>
          <?php else: ?>
            <nav aria-label="Page navigation example"><?= premast_ajax_pagination(array(), $my_query); ?></nav>
          <?php endif; ?>
          </div>
      </div>
    </div>
  <?php 
  die;
}