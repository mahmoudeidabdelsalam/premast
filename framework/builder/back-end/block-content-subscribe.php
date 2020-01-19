<?php
/**
 * Block Name: Block subscribe

 * This is the template that displays the Banner.
 */

// create id attribute for specific styling
$id = 'subscribe' . $block['id'];
?>

<blockquote id="<?php echo $id ?>" class="subscribe">
  <section class="block-subscribe">
    <img class="img-fluid" src="<?php echo get_theme_file_uri().'/resources/assets/images/blocks/subscribe.png'; ?>"/>
  </section>
</blockquote>
