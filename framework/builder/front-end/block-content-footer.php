<?php
/**
 * Block Name: footer
 */

 $logo = get_field('footer_logo_block');
 $menus = get_field('footer_menu_link');
?>
<section class="footer">
  <div class="container">
    <div class="row align-items-center">
      <a href="<?= home_url('/'); ?>"><img src="<?= $logo; ?>" alt="logo footer"></a>

      <?php if( $menus ): ?>
        <ul class="footer-links">
          <?php 
          foreach( $menus as $menu ): 
            $parts = explode("/", $menu);
            $title = get_the_title(get_page_by_path($parts['3']));
          ?>
          <li>
            <a href="<?php echo esc_url( $menu ); ?>"><?= $title; ?></a>
          </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <ul class="footer-menu p-0 list-inline">
        <li><?= _e('follow us', 'theme'); ?></li>
        <?php
        if( have_rows('follow_us') ):
          while ( have_rows('follow_us') ) : the_row(); ?>
            <li><a href="<?= the_sub_field('links_social_media'); ?>"><?= the_sub_field('icon_image'); ?></a></li>
        <?php
          endwhile;
        endif;
        ?>
      </ul>
    </div>
  </div>
</section>
