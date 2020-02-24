{{--
  Template Name: Eargo Template
--}}

@extends('layouts.app-blank')

<link rel="stylesheet" href="<?= get_theme_file_uri() . '/framework/assets/nicepage.css'; ?>">
<link rel="stylesheet" href="<?= get_theme_file_uri() . '/framework/assets/eargo.css'; ?>">
<script src="<?= get_theme_file_uri() . '/framework/assets/jquery.js'; ?>" defer=""></script>
<script src="<?= get_theme_file_uri() . '/framework/assets/eargo.js'; ?>" defer=""></script>



@section('content')
  @while(have_posts()) @php the_post() @endphp
        <header class="u-clearfix u-header u-header" id="sec-8398"><div class="u-clearfix u-sheet u-sheet-1">
            <a href="{{ the_field('logo_image_eargo') }}" class="u-image u-logo u-image-1">
              <img src="{{ the_field('logo_image_eargo') }}" class="u-logo-image u-logo-image-1" data-image-width="223">
            </a>
            <img src="{{the_field('pp_logo') }}" alt="" class="u-image u-image-default u-image-2" data-image-width="232" data-image-height="41">
          </div>
        </header>
        <section class="u-align-center u-clearfix u-image u-section-1" id="sec-2d01" data-image-width="1384" data-image-height="574" style="background-image:url('{{ the_field('background_banner') }}')">
          <div class="u-clearfix u-sheet u-sheet-1">
            <?php if( get_field('eargo_logo') ): ?>
                <img src="<?php the_field('eargo_logo'); ?>" />
            <?php endif; ?>
            <h3 class="line-height u-text u-text-1"><?php the_field('subhead_banner'); ?></h3>
            <?php
             $link = get_field('button_banner');
                if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
                <a class="button u-border-radius-30 u-btn u-btn-round u-button-style u-custom-font u-font-roboto u-gradient u-none u-text-white u-btn-1" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            <?php endif; ?>
                <p class="u-align-center u-custom-font u-heading-font u-text u-text-custom-color-1 u-text-default u-text-2" ><?php the_field('price_eargo'); ?><br></p>
          </div>
        </section>


        <section class="u-align-center u-clearfix u-custom-color-4 u-section-2" id="sec-bc6d">
          <div class="u-clearfix u-sheet u-sheet-1">
            <div class="u-border-1 u-border-grey-dark-1 u-line u-line-vertical u-opacity u-opacity-55 u-line-1"></div>
            <img src="{{the_field('banner_img') }}" alt="" class="u-image u-image-default u-image-1" data-image-width="1435" data-image-height="696" data-animation-name="flipIn" data-animation-duration="1000" data-animation-delay="0" data-animation-direction="X">
            <p class="u-custom-font u-heading-font u-text u-text-custom-color-1 u-text-1">{{the_field('header_ss') }}</p>
            <div class="u-clearfix u-gutter-0 u-layout-wrap u-layout-wrap-1">
              <div class="u-layout">
                <div class="u-layout-row">
                <?php
                $counter = -1;
                if( have_rows('counters') ):
                    while ( have_rows('counters') ) : the_row();
                    $counter++;
                ?>
                  <div class="u-container-style u-layout-cell u-left-cell u-size-20 u-white u-layout-cell-1">
                    <div class="u-container-layout u-container-layout-1">
                      <p class="u-align-center u-text u-text-custom-color-1 u-text-2"><?= the_sub_field('text_counter'); ?></p>
                      <h1 class="u-align-center u-text u-text-custom-color-1 u-title u-text-3" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">+<?= the_sub_field('number_counter'); ?></h1>
                    </div>
                  </div>
                <?php
                    endwhile;
                endif;
                ?>
                </div>
              </div>
            </div>
            <img src="{{the_field('counter_img') }}" alt="" class="u-image u-image-default u-image-2" data-image-width="1400" data-image-height="606">
            <h3 class="u-text u-text-default u-text-8">{{the_sub_field('feat_text')}}</h3>
            <p class="u-custom-font u-heading-font u-text u-text-custom-color-5 u-text-default u-text-9">{{the_field(('feat_subtext')) }}</p>
            <div class="u-clearfix u-gutter-0 u-layout-wrap u-layout-wrap-2">
              <div class="u-layout">
                <div class="u-layout-col">
                  <div class="u-size-30">
                    <div class="u-layout-row">
                    <?php if( have_rows('infographics_items') ): ?>
                        <?php while( have_rows('infographics_items') ): the_row(); ?>
                        <div class="u-container-style u-layout-cell u-left-cell u-size-20 u-layout-cell-7">
                            <div class="u-container-layout u-container-layout-7">
                                <img src="<?= the_sub_field('image_infographics_item'); ?>" alt="" class="u-image u-image-default u-image-3" data-image-width="42" data-image-height="43">
                                <p class="u-custom-font u-heading-font u-text u-text-custom-color-5 u-text-10"><?php the_sub_field('text_infographics_item'); ?>
                            </div>
                        </div>
                      <?php endwhile; ?>
                    <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="u-align-left u-border-1 u-border-palette-5-base u-clearfix u-section-3" id="sec-428e">
          <div class="container py-5">
              <div class="row">
                    <h3 class="u-text u-text-1 col-12 mb-5">{{the_field('heading_fields')}}</h3>
                    <div class="list-item-fields col-md-6 col-12 align-self-center">
                        <p class="u-custom-font">{{the_field('subheading')}}</p>
                        <?php
                        if( have_rows('fields_items') ):
                            while( have_rows('fields_items') ): the_row();
                        ?>
                        <span><?php the_sub_field('text_fileds_item'); ?></span>
                        <?php
                        endwhile;
                    endif; ?>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="embed-container">
                        <?= the_field('video_fields'); ?>
                        </div>
                    </div>
                </div>
          </div>
        </section>

        <section class="u-align-left u-border-1 u-border-palette-5-base u-clearfix u-section-3" id="sec-b672" >
            <div class="container-fluid pt-5 pb-5" style="background-color:#E9F3FF;">
                <div class="row">
                    <div class="col-md-1 col-l12 align-self-center">
                      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php
                        $counter = 0;
                        if( have_rows('tabs') ):
                            while( have_rows('tabs') ): the_row();
                            $counter++;
                            ?>
                            <a class="items-list-icon <?= ($counter == 1)? 'active':''; ?>" id="pills-<?= $counter; ?>-tab" data-toggle="pill" href="#v-pills-<?= $counter; ?>" role="tab" aria-controls="v-pills-<?= $counter; ?>" aria-selected="true">
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            </a>
                        <?php
                            endwhile;
                        endif; ?>
                      </div>
                    </div>
                     <div class="col-md-11 col-12">
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php
                            $counter = 0;
                            if( have_rows('tabs') ):
                                while( have_rows('tabs') ): the_row();
                                $counter++;
                                ?>
                            <div class="tab-pane fade <?= ($counter == 1)? 'active show':''; ?>" id="v-pills-<?= $counter; ?>" role="tabpanel" aria-labelledby="pills-<?= $counter; ?>-tab">
                                <div class="row">
                                    <div class="col-md-6 col-12 align-self-center">
                                        <h5><?php the_sub_field('headline_tbs'); ?></h5>
                                        <p><?php the_sub_field('content_tabs'); ?></p>
                                    </div>
                                    <div class="col-md-6 col-12 align-self-center">
                                        <img src="<?= the_sub_field('images_tabs'); ?>"/>
                                    </div>
                                </div>
                            </div>
                            <?php
                                endwhile;
                            endif; ?>
                        </div>
                    </div>
            </div>
        </section>

        <section class="u-carousel u-carousel-duration-750 u-slide u-block-b0a8-1" id="carousel_bfd6" data-interval="1250" data-u-ride="carousel" style="">
          <ol class="u-absolute-hcenter u-carousel-indicators u-opacity u-opacity-80 u-block-b0a8-2">
            <?php
            $counter = -1;
            if( have_rows('trusted_eargo') ):
                while ( have_rows('trusted_eargo') ) : the_row();
                $counter++;
                ?>
                <li data-u-target="#carousel_bfd6" class="u-grey-30" data-u-slide-to="<?= $counter; ?>"></li>
                    <?php
                endwhile;
            endif;
            ?>
          </ol>
          <div class="u-carousel-inner" role="listbox">
            <?php
            $counter = 0;
            if( have_rows('trusted_eargo') ):
                while ( have_rows('trusted_eargo') ) : the_row();
                $counter++;
                ?>
                <div class="u-align-center u-carousel-item u-clearfix u-image <?= ($counter == 1)? 'u-active':''; ?> u-section-5-<?= $counter; ?>">
                <div class="u-clearfix u-sheet u-sheet-1">
                    <h3 class="u-text u-text-default u-text-1"><?= the_sub_field('headline_trusted'); ?></h3>
                    <p class="u-custom-font u-heading-font u-text u-text-2"><?= the_sub_field('subheadline_trusted_eargo'); ?></p>
                    <div class="u-border-2 u-border-custom-color-4 u-border-radius-8 u-container-style u-custom-color-4 u-group u-shape-round u-group-1">
                    <div class="u-container-layout u-container-layout-1">

                        <span class="u-icon u-icon-circle u-text-custom-color-6 u-icon-1">
                        <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 -10 511.99143 511" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-2a9f"></use></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -10 511.99143 511" id="svg-2a9f" class="u-svg-content"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"></path></svg>
                        </span>
                        <span class="u-icon u-icon-circle u-text-custom-color-6 u-icon-2">
                        <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 -10 511.99143 511" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-7657"></use></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -10 511.99143 511" id="svg-7657" class="u-svg-content"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"></path></svg>
                        </span>
                        <span class="u-icon u-icon-circle u-text-custom-color-6 u-icon-3">
                        <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 -10 511.99143 511" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-1289"></use></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -10 511.99143 511" id="svg-1289" class="u-svg-content"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"></path></svg>
                        </span>
                        <span class="u-icon u-icon-circle u-text-custom-color-6 u-icon-4">
                        <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 -10 511.99143 511" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-6a36"></use></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -10 511.99143 511" id="svg-6a36" class="u-svg-content"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"></path></svg>
                        </span>
                        <span class="u-icon u-icon-circle u-text-custom-color-6 u-icon-5">
                        <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 -10 511.99143 511" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-e546"></use></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -10 511.99143 511" id="svg-e546" class="u-svg-content"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"></path></svg>
                        </span>
                        <p class="u-align-center u-text u-text-3">
                            <?= the_sub_field('content_trusted_eargo'); ?>
                        </p>
                        <h5 class="u-align-center u-text u-text-5"><?= the_sub_field('name_client_trusted'); ?></h5>
                    </div>
                    </div>
                </div>
                </div>
                <?php
                endwhile;
            endif;
            ?>
          </div>
        </section>

        <section class="u-align-center u-clearfix u-custom-color-4 u-section-6 pt-5" id="sec-e902">
            <div class="row justify-content-center pt-5 pb-5">
                <div class="u-clearfix u-sheet u-sheet-1 col-md-7 col-12">
                    <?php if( get_field('updates_eargo') ): ?>
                        <img src="<?php the_field('updates_eargo'); ?>" />
                    <?php endif; ?>
                    <h3 class="u-text u-text-default u-text-1"><?php the_field('heading_eargo'); ?></h3>
                    <p class="u-text u-text-default u-text-2" ><?php the_field('subhead_eargo'); ?></p>
                    <?php
                    $link = get_field('button_second');
                    if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a class="button u-border-radius-30 u-btn u-btn-round u-button-style u-custom-font u-font-roboto u-gradient u-none u-text-white u-btn-1" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>


        <section class="footer">
            <div class="container">
              <div class="row align-items-center m-0">
                <a href="<?= home_url('/'); ?>"><img src="{{the_field('logo_footer')}}" alt="logo footer"></a>
                  <ul class="footer-links">
                    <?php
                    $post_objects = get_field('footer_menu_eargo');
                    if($post_objects) :
                        foreach( $post_objects as $post):
                        setup_postdata($post); ?>
                    <li>
                      <a href="<?= get_the_permalink($post->ID); ?>"><?=  get_the_title($post->ID); ?></a>
                    </li>
                    <?php
                     endforeach;
                        wp_reset_postdata();
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



  @endwhile
@endsection
