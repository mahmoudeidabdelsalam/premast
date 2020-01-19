<?php
/**
 * Block Name: Block Model

 * This is the template that displays the Banner.
 */

// create id attribute for specific styling
$id = 'model' . $block['id'];
?>

<blockquote id="<?php echo $id ?>" class="models">
  <section class="block-models">
    <img class="img-fluid" src="<?php echo get_theme_file_uri().'/resources/assets/images/blocks/models.png'; ?>"/>
  </section>
</blockquote>
