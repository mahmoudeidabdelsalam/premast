<?php
/**
 * Bootstrap Compitable Pagination Function
 * @uses paginate_links
 * @since 1.0
 */

function premast_ajax_pagination($args = array(), $query_object = 'wp_query') {
    if ($query_object == 'wp_query') {
        global $wp_query;
        $main_query = $wp_query;
    } else {
        $main_query = $query_object;
    }

    $big = 999999999999999999; 

    $paged = (isset($_POST['paged']))? $_POST['paged'] : 1;

    $current_page = max(1, get_query_var('paged'));

    $pages_count = $main_query->max_num_pages;

    $default_args = array(
        'current' => $current_page,
        'total' => $pages_count,
        'mid_size' => 99999,
        'prev_next' => false,
        'type' => 'array'
    );
    $args = wp_parse_args($args, $default_args);
    $paginate_links = paginate_links($args);
    if ($paginate_links) {
      ?>

        <ul class="pagination col-12 row justify-content-center ml-0 mr-0 mt-5 mb-5">
            <?php 
            $counter = 0;
              foreach ($paginate_links as $link): 
                $counter++;
              ?>
                <li class="page-item <?= ($counter == $paged)? ' active':''; ?>"><a href="JavaScript:void(0);" data-page="<?php echo $counter; ?>" class="page-numbers<?= ($counter == $paged)? ' current':''; ?>"><?php echo $counter; ?></a></li>
            <?php endforeach; ?>
        </ul>

      <?php
    }
}

