<?php
/**
 * Block Name: features
*/

$headline = get_field('headline_block');
?>
<section class="block-features">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-12">
        <h2 class="border-lines" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000"><?= $headline; ?></h2>
      </div>
      <div class="col-md-9 col-12">
        <div class="row">
          <?php
          if( have_rows('features') ):
            while ( have_rows('features') ) : the_row(); ?>
            <div class="col-md-4 col-12 features-item" data-aos="fade" data-aos-duration="500">
              <p><?= the_sub_field('headline_features'); ?></p>
              <span><?= the_sub_field('content_features'); ?></span>
            </div>
          <?php
            endwhile;
          endif;
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
