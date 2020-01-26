<?php
/**
 * Block Name: Header
 */

 $logo = get_field('logo_header_block');
 $link = get_field('link_header_block');
 if($logo):
?>
<header class="header-block">
  <div class="container">
    <div class="row m-0">
      <a href="<?= $link; ?>"><img src="<?= $logo; ?>" alt="logo premast"></a>
    </div>
  </div>
</header>
<?php endif; ?>
