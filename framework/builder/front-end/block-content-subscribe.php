<?php
/**
 * Block Name: features
*/

$link_page = get_field('link_page_subscribe');
$link_url = $link_page['url'];
$link_title = $link_page['title'];
$link_target = $link_page['target'] ? $link['target'] : '_self';

$headline_subscribe = get_field('headline_page_subscribe');
$field_subscribe = get_field('headline_field_subscribe');
$shortcode_subscribe = get_field('shortcode_subscribe');
?>
<section class="block-subscribe">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-12 two-subscribe">
        <p><?= $field_subscribe; ?></p>
        <?= do_shortcode( $shortcode_subscribe ); ?>
        </div>
      <div class="col-md-6 col-12 two-subscribe">
        <p class="text-white"><?= $headline_subscribe; ?></p>
        <p class="mb-0"><a class="btn-primary py-2 px-3 d-inline-block" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></p>
      </div>
    </div>
  </div>
</section>
