<?php
/**
 * Block Name: Block Banner

 * This is the template that displays the Banner.
 */

// create id attribute for specific styling
$id = 'banner' . $block['id'];
?>

<blockquote id="<?php echo $id ?>" class="banner">
  <section class="block-banner">
    <img class="img-fluid" src="<?php echo get_theme_file_uri().'/resources/assets/images/blocks/banner.png'; ?>"/>
  </section>
</blockquote>
