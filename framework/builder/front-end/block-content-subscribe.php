<?php
/**
 * Block Name: features
*/


$headline_subscribe = get_field('headline_page_subscribe');
$field_subscribe = get_field('headline_field_subscribe');
$shortcode_subscribe = get_field('shortcode_subscribe');
$button_link = get_field('link_button_call_of_action');
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
        <p class="mb-0"><a class="btn-primary py-2 px-3 d-inline-block" href="#" data-toggle="modal" data-target="#example<?= $id; ?>"><?= _e('We hear you!', 'premast'); ?></a></p>
      </div>
    </div>
  </div>
</section>


<!-- Modal -->
<div class="modal fade" id="example<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal<?= $id; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= _e('We hear you!', 'premast'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo do_shortcode( '[gravityform id="'.$button_link['id'].'" name="false" title="false" description="false" ajax="true" ]' ); ?>
      </div>
    </div>
  </div>
</div>

<style>
.gform_wrapper legend.gfield_label, .gform_wrapper label.gfield_label {
  display: none !important;
}

.gform_wrapper .field_sublabel_below .ginput_complex.ginput_container label, .gform_wrapper .field_sublabel_below div[class*="gfield_time_"].ginput_container label {
  display: none !important;
}
</style>
