<?php
/**
 * Block Name: footer
 */

 $logo = get_field('footer_logo_block');
?>
<section class="footer">
  <div class="container">
    <div class="row align-items-center m-0">
      <a href="<?= the_field('link_logo_footer'); ?>"><img src="<?= $logo; ?>" alt="logo footer"></a>

      <ul class="footer-links">
        <?php
        if( have_rows('mune_footer') ):
          while ( have_rows('mune_footer') ) : the_row();
        ?>
        <?php 
        $link = get_sub_field('link_mune_footer');
        if( $link ): 
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
        <li>
          <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        </li>
        <?php endif; ?>
        <?php
          endwhile;
        endif;
        ?>
      </ul>

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
