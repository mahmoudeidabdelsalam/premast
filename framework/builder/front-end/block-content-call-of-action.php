<?php
/**
 * Block Name: call of action
*/

$background_call = get_field('background_call_of_action');
$headline = get_field('headline_call_of_action');
$editor = get_field('content_call_of_action');
$button_text = get_field('text_button_call_of_action');
$button_link = get_field('link_button_call_of_action_2');
$id = 'call' . $block['id'];
?>
<section class="block-call" style="background-image:url('<?= $background_call; ?>');">
  <div class="container">
    <div class="row m-0">
      <div class="col-md-12 col-12">
        <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"><?= $headline; ?></h2>
        <div class="content-call" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom"><?= $editor; ?></div>
        <a class="btn-push" href="<?= $button_link; ?>"><?= $button_text; ?></a>
      </div>
    </div>
  </div>
</section>

