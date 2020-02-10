<?php
/**
 * Block Name: Header
 */

 $logo = get_field('logo_header_block');
 $link = get_field('link_header_block');
 $purchase_link = get_field('link_button_action');
 $purchase_text = get_field('text_button_action');
 $logo_icon = get_field('logo_icon_block');
 if($logo):
?>
<header class="header-block">
  <div class="container-fluid container-padding">
    <div class="row m-0">
      <a href="<?= $link; ?>"><img src="<?= $logo; ?>" alt="logo premast"></a>
      <div class="col-action ml-auto">
        <a href="<?=  $link; ?>"><img src="<?=  $logo_icon; ?>" alt="<?=  $purchase_text; ?>"></a>
        <a class="button-green" href="<?=  $purchase_link; ?>"><?=  $purchase_text; ?></a>
      </div>
    </div>
  </div>
</header>
<?php endif; ?>
