<?php
/**
 * Block Name: Block about

 * This is the template that displays the Banner.
 */

// create id attribute for specific styling
$id = 'features' . $block['id'];
?>

<blockquote id="<?php echo $id ?>" class="features">
  <section class="block-features">
    <img class="img-fluid" src="<?php echo get_theme_file_uri().'/resources/assets/images/blocks/features.png'; ?>"/>
  </section>
</blockquote>
