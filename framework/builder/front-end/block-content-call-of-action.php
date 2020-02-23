<?php
/**
 * Block Name: call of action
*/

$background_call = get_field('background_call_of_action');
$headline = get_field('headline_call_of_action');
$editor = get_field('content_call_of_action');
$button_text = get_field('text_button_call_of_action');
$button_link = get_field('link_button_call_of_action');
$id = 'call' . $block['id'];
?>
<section class="block-call" style="background-image:url('<?= $background_call; ?>');">
  <div class="container">
    <div class="row m-0">
      <div class="col-md-12 col-12">
        <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"><?= $headline; ?></h2>
        <div class="content-call" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"><?= $editor; ?></div>
        <a class="btn-push" href="#" data-toggle="modal" data-target="#example<?= $id; ?>"><?= $button_text; ?></a>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="example<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal<?= $id; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $button_text; ?></h5>
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
