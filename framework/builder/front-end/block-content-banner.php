<?php
/**
 * Block Name: Banner
*/

$bg_banner = get_field('background_block_banner');
$bg_image = get_field('background_column_image');
$banner_column = get_field('banner_column_image');
$headline = get_field('headline_column_content');
$editor = get_field('editor_column_content');
$button_text = get_field('button_column_content_text');
$button_link = get_field('button_column_content_link');
?>
<section class="block-banner" style="background-image:url('<?= $bg_banner; ?>');">
  <div class="container-fluid container-padding">
    <div class="row m-0">
      <div class="col-md-4 col-12 content-banner p-0">
        <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000"><?= $headline; ?></h2>
        <div class="mt-4 mb-5" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000"><?= $editor; ?></div>
        <a class="btn-push" href="<?= $button_link; ?>" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000"><?= $button_text; ?></a>
      </div>
      <div class="col-md-8 col-12 relative container-banner">
        <div id="background" class="layer-0 background">
          <img src="<?= $bg_image; ?>" alt="<?= $headline; ?>">
        </div>
        <div id="planet" class="planet layer-1" data-aos="fade-left" data-aos-duration="1000">
          <img src="<?= $banner_column; ?>" alt="<?= $headline; ?>">
        </div>
      </div>
    </div>
  </div>
</section>
