<?php
/**
 * Block Name: Block Header

 * This is the template that displays the Header.
 */

// create id attribute for specific styling
$id = 'footer' . $block['id'];
?>

<blockquote id="<?php echo $id ?>" class="footer">
  <section class="block-footer">
    <img class="img-fluid" src="<?php echo get_theme_file_uri().'/resources/assets/images/blocks/footer.png'; ?>"/>
  </section>
</blockquote>
