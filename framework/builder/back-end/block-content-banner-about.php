<?php
/**
 * Block Name: Block about

 * This is the template that displays the Banner.
 */

// create id attribute for specific styling
$id = 'about' . $block['id'];
?>

<blockquote id="<?php echo $id ?>" class="banner-about">
  <section class="block-banner-about">
    <img class="img-fluid" src="<?php echo get_theme_file_uri().'/resources/assets/images/blocks/about.png'; ?>"/>
  </section>
</blockquote>
