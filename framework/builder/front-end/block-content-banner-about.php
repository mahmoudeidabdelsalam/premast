<?php
/**
 * Block Name: Banner
*/

$bg_banner = get_field('background_banner_about');
$banner_about = get_field('images_banner_about');
$headline = get_field('headline_banner_about');
$editor = get_field('content_banner_about');
?>
<section class="block-about">
  <div class="container-fluid p-0">
    <div class="row m-0">
      <div class="col-md-5 col-12 relative">
        <div class="layer-0 background background-about">
          <img src="<?= $bg_banner; ?>" alt="<?= $headline; ?>">
        </div>
        <div class="planet layer-3" data-aos="fade-right" data-aos-duration="1000">
          <img src="<?= $banner_about; ?>" alt="<?= $headline; ?>">
        </div>
      </div>
      <div class="col-md-6 col-12 content-about">
        <h2><?= $headline; ?></h2>
        <div class="content-editor"><?= $editor; ?></div>
        <div class="status-icon">
          <?php
          if( have_rows('icon_status_about') ):
            while ( have_rows('icon_status_about') ) : the_row(); ?>
            <div class="statusitems">
              <img src="<?= the_sub_field('icon_status'); ?>" alt="status" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
              <span><?= the_sub_field('content_status'); ?></span>
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