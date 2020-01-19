<?php
/**
 * Block Name: Block Header

 * This is the template that displays the Header.
 */

// create id attribute for specific styling
$id = 'header' . $block['id'];
?>

<blockquote id="<?php echo $id ?>" class="header">
  <section class="block-header">
    <img class="img-fluid" src="<?php echo get_theme_file_uri().'/resources/assets/images/blocks/header.png'; ?>"/>
  </section>
</blockquote>
