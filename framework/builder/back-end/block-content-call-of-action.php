<?php
/**
 * Block Name: Block call of action

 * This is the template that displays the Banner.
 */

// create id attribute for specific styling
$id = 'call_of_action' . $block['id'];
?>

<blockquote id="<?php echo $id ?>" class="call-of-action">
  <section class="block-action">
    <img class="img-fluid" src="<?php echo get_theme_file_uri().'/resources/assets/images/blocks/action.png'; ?>"/>
  </section>
</blockquote>
