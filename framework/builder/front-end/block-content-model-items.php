<?php
/**
 * Block Name: Models
*/

$headline = get_field('headline_block_models');
?>
<section class="block-models">
  <div class="container">
    <div class="row justify-content-center align-items-center m-0">
      <div class="col-md-6 col-12">
        <h2 class="headline-block" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000"><?= $headline; ?></h2>
      </div>
      <div class="col-md-10 col-12 models-item">
        <?php
        if( have_rows('models_block') ):
          while ( have_rows('models_block') ) : the_row(); ?>
          <div class="row">
            <div class="col-md-12">
              <?php if(get_sub_field('headline_or_image') == 'headline'): ?>
                <h2><?= the_sub_field('headline_model'); ?></h2>
              <?php endif; ?>
              <?php if(get_sub_field('headline_or_image') == 'image'): ?>
                <img src="<?= the_sub_field('headline_image_model'); ?>" alt="headline" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
              <?php endif; ?>
            </div>
            <div class="col-md-6 col-12 one" data-aos="fade" data-aos-duration="500">
              <img src="<?= the_sub_field('image_block_model'); ?>" alt="">
            </div>
            <div class="col-md-6 col-12 two" data-aos="fade" data-aos-duration="500">
              <?= the_sub_field('content_block_model'); ?>
            </div>
          </div>
        <?php
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </div>
</section>
