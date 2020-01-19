<?php
/**
 * Block Name: features
*/

$sub_headline = get_field('sub_headline_subscribe');
$headline_subscribe = get_field('headline_subscribe');
$field_subscribe = get_field('headline_field_subscribe');
$shortcode_subscribe = get_field('shortcode_subscribe');
?>
<section class="block-subscribe">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-12">
        <div class="row">
         <div class="col-md-7 col-12 one-subscribe">
            <h3><?= $sub_headline; ?></h3>
            <h2><?= $headline_subscribe; ?></h2>
         </div>
         <div class="col-md-5 col-12 two-subscribe">
           <p><?= $field_subscribe; ?></p>
           <?= do_shortcode( $shortcode_subscribe ); ?>
         </div>
        </div>
      </div>
    </div>
  </div>
</section>
