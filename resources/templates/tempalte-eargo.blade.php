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
            <h3 class="line-height u-text u-text-1">The Hugest Growing Set of Infographics In One Package
              <br>
            </h3>
            <?php
             $link = get_field('button_banner');
             if( $link ):
             $link_url = $link['url'];
             $link_title = $link['title'];
             $link_target = $link['target'] ? $link['target'] : '_self';
             ?>
             <a class="button u-border-radius-30 u-btn u-btn-round u-button-style u-custom-font u-font-roboto u-gradient u-none u-text-white u-btn-1" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            <?php endif; ?>


            <p class="u-align-center u-custom-font u-heading-font u-text u-text-custom-color-1 u-text-default u-text-2" ><?php the_field('subhead_banner'); ?>
              <br>
            </p>
          </div>
        </section>
        <section class="u-align-center u-clearfix u-custom-color-4 u-section-2" id="sec-bc6d">
          <div class="u-clearfix u-sheet u-sheet-1">
            <div class="u-border-1 u-border-grey-dark-1 u-line u-line-vertical u-opacity u-opacity-55 u-line-1"></div>
          <img src="{{the_field('banner_img') }}" alt="" class="u-image u-image-default u-image-1" data-image-width="1435" data-image-height="696" data-animation-name="flipIn" data-animation-duration="1000" data-animation-delay="0" data-animation-direction="X">
            <p class="u-custom-font u-heading-font u-text u-text-custom-color-1 u-text-1">{{the_field('header_ss') }}
            </p>
            <div class="u-clearfix u-gutter-0 u-layout-wrap u-layout-wrap-1">
              <div class="u-layout">
                <div class="u-layout-row">
                  <div class="u-container-style u-layout-cell u-left-cell u-size-20 u-white u-layout-cell-1">
                    <div class="u-container-layout u-container-layout-1">
                      <p class="u-align-center u-text u-text-custom-color-1 u-text-2">Unique Slides</p>
                      <h1 class="u-align-center u-text u-text-custom-color-1 u-title u-text-3" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">+600</h1>
                    </div>
                  </div>
                  <div class="u-container-style u-layout-cell u-size-20 u-white u-layout-cell-2">
                    <div class="u-container-layout u-container-layout-2">
                      <p class="u-align-center u-text u-text-custom-color-1 u-text-4">Categories</p>
                      <h1 class="u-align-center u-text u-text-custom-color-1 u-title u-text-5" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">15</h1>
                      <div class="u-border-1 u-border-grey-dark-1 u-line u-line-vertical u-opacity u-opacity-55 u-line-2"></div>
                    </div>
                  </div>
                  <div class="u-container-style u-layout-cell u-right-cell u-size-20 u-white u-layout-cell-3">
                    <div class="u-container-layout u-container-layout-3">
                      <p class="u-align-center u-text u-text-custom-color-1 u-text-6">Icons
                        <br>
                      </p>
                      <div class="u-border-1 u-border-grey-dark-1 u-line u-line-vertical u-opacity u-opacity-55 u-line-3"></div>
                      <h1 class="u-align-center u-text u-text-custom-color-1 u-title u-text-7" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">2000</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <img src="{{the_field('counter_img') }}" alt="" class="u-image u-image-default u-image-2" data-image-width="1400" data-image-height="606">
            <h3 class="u-text u-text-default u-text-8">{{the_field('feat_text')}}
              <br>
              <br>
            </h3>
            <p class="u-custom-font u-heading-font u-text u-text-custom-color-5 u-text-default u-text-9">{{the_field(('feat_subtext')) }}
            </p>
            <div class="u-clearfix u-gutter-0 u-layout-wrap u-layout-wrap-2">
              <div class="u-layout">
                <div class="u-layout-col">
                  <div class="u-size-30">
                    <div class="u-layout-row">
                      <div class="u-container-style u-layout-cell u-left-cell u-size-20-lg u-size-20-xl u-size-21-sm u-size-21-xs u-size-60-md u-layout-cell-4">
                        <div class="u-container-layout u-container-layout-4">
                          <img src="{{the_field('icon_1')}}" alt="" class="u-image u-image-default u-image-3" data-image-width="42" data-image-height="43">
                          <p class="u-custom-font u-heading-font u-text u-text-custom-color-5 u-text-10">{{the_field('slides_icon')}}
                            <br>
                          </p>
                        </div>
                      </div>
                      <div class="u-container-style u-layout-cell u-size-19-sm u-size-19-xs u-size-20-lg u-size-20-xl u-size-60-md u-layout-cell-5">
                        <div class="u-container-layout u-container-layout-5">
                          <img src="{{the_field('icon_2')}}" alt="" class="u-image u-image-default u-image-4" data-image-width="45" data-image-height="42">
                          <p class="u-align-center u-custom-font u-heading-font u-text u-text-11">{{the_field('collections_icon')}}

                          </p>
                        </div>
                      </div>
                      <div class="u-container-style u-layout-cell u-right-cell u-size-20 u-size-60-md u-layout-cell-6">
                        <div class="u-container-layout u-container-layout-6">
                          <img src="{{the_field('icon_3')}}" alt="" class="u-image u-image-default u-image-5" data-image-width="49" data-image-height="39">
                          <p class="u-align-center u-custom-font u-heading-font u-text u-text-12">{{the_field(('color_icon'))}}


                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="u-size-30">
                    <div class="u-layout-row">
                      <div class="u-container-style u-layout-cell u-left-cell u-size-20 u-layout-cell-7">
                        <div class="u-container-layout u-container-layout-7">
                          <img src="{{the_field('icon_4')}}" alt="" class="u-image u-image-default u-image-6" data-image-width="44" data-image-height="43">
                          <p class="u-custom-font u-heading-font u-text u-text-13">{{the_field('edit_icon')}}</p>
                        </div>
                      </div>
                      <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-8">
                        <div class="u-container-layout u-container-layout-8">
                          <img src="{{the_field('icon_5')}}" alt="" class="u-image u-image-default u-image-7" data-image-width="43" data-image-height="43">
                          <p class="u-align-center u-custom-font u-heading-font u-text u-text-default u-text-14">{{the_field('google_icon')}}

                          </p>
                        </div>
                      </div>
                      <div class="u-align-left u-container-style u-layout-cell u-right-cell u-size-20 u-layout-cell-9">
                        <div class="u-container-layout u-container-layout-9">
                          <img src="{{the_field('icon_6')}}" alt="" class="u-image u-image-default u-image-8" data-image-width="42" data-image-height="35">
                          <p class="u-custom-font u-heading-font u-text u-text-default u-text-15">{{the_field('support_icon')}}

                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="u-align-left u-border-1 u-border-palette-5-base u-clearfix u-section-3" id="sec-428e">
          <div class="u-clearfix u-sheet u-sheet-1">
            <h3 class="u-text u-text-1">{{the_field('heading_fields')}}</h3>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-1"></div>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-2"></div>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-3"></div>
            <div class="u-video u-video-contain u-video-1">
              <div style="position: absolute;" class="embed-responsive">
                <iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;" class="embed-responsive-item" src="https://www.youtube.com/embed/Qr98RS8_Qa4?mute=0&amp;showinfo=0&amp;controls=1&amp;start=0" frameborder="0" allowfullscreen=""></iframe>
              </div>
            </div>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-4"></div>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-5"></div>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-6"></div>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-7"></div>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-8"></div>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-9"></div>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-10"></div>
            <div class="u-border-1 u-border-palette-5-light-1 u-border-radius-15 u-shape u-shape-round u-shape-11"></div>
            <div class="u-border-2 u-border-palette-5-light-3 u-border-radius-28 u-shape u-shape-round u-shape-12"></div>
            <p class="u-custom-font u-heading-font u-text u-text-default u-text-2">{{the_field('subheading')}}
              <br>
            </p>
            <p class="u-custom-font u-heading-font u-text u-text-default u-text-3">Business</p>
            <p class="u-text u-text-default u-text-4">Education
              <br>
            </p>
            <p class="u-text u-text-default u-text-5">Medical
              <br>
            </p>
            <p class="u-text u-text-default u-text-6">Media
              <br>
            </p>
            <p class="u-text u-text-default u-text-7">Marketing
              <br>
            </p>
            <p class="u-text u-text-default u-text-8">Growth Hacking
              <br>
              <br>
            </p>
            <p class="u-text u-text-default u-text-9">Research
              <br>
            </p>
            <p class="u-text u-text-default u-text-10">Tech
              <br>
            </p>
            <p class="u-text u-text-11">Advertising
              <br>
            </p>
            <p class="u-text u-text-default u-text-12">Pitching
              <br>
            </p>
            <p class="u-text u-text-default u-text-13">Blockchain
              <br>
            </p>
            <p class="u-text u-text-default u-text-14">And more
              <br>
            </p>
          </div>
        </section>
        <section class="u-align-left u-clearfix u-custom-color-4 u-section-4" id="sec-b672">
          <div class="u-clearfix u-sheet u-sheet-1">
            <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
              <div class="u-layout">
                <div class="u-layout-col">
                  <div class="u-size-60">
                    <div class="u-layout-row">
                      <div class="u-container-style u-layout-cell u-left-cell u-size-30 u-layout-cell-1" data-animation-name="rubberBand" data-animation-duration="1000" data-animation-delay="0" data-animation-direction="">
                        <div class="u-container-layout u-container-layout-1">
                          <img src="images/Rectangle90.png" alt="" class="u-image u-image-default u-image-1" data-image-width="316" data-image-height="204">
                        </div>
                      </div>
                      <div class="u-container-style u-layout-cell u-right-cell u-size-30 u-layout-cell-2">
                        <div class="u-container-layout u-container-layout-2">
                          <img src="images/Rectangle901.png" alt="" class="u-image u-image-default u-image-2" data-image-width="316" data-image-height="204">
                          <img src="images/Rectangle93.png" alt="" class="u-image u-image-default u-image-3" data-image-width="316" data-image-height="204">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>




        <section class="u-carousel u-carousel-duration-750 u-slide u-block-b0a8-1" id="carousel_bfd6" data-interval="1250" data-u-ride="carousel">
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

        <section class="u-align-center u-clearfix u-custom-color-4 u-section-6" id="sec-e902">
          <div class="u-clearfix u-sheet u-sheet-1">
            <?php if( get_field('updates_eargo') ): ?>
            <img src="<?php the_field('updates_eargo'); ?>" />
        <?php endif; ?>


            <h3 class="u-text u-text-default u-text-1"><?php the_field('heading_eargo'); ?>
            </h3>
            <p class="u-text u-text-default u-text-2" > "<?php the_field('subhead_eargo'); ?>"
            </p>
            <?php
             $link = get_field('button_second');
             if( $link ):
             $link_url = $link['url'];
             $link_title = $link['title'];
             $link_target = $link['target'] ? $link['target'] : '_self';
             ?>
            <a class="button u-border-radius-30 u-btn u-btn-round u-button-style u-custom-font u-font-roboto u-gradient u-none u-text-white u-btn-1" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?>

            </a>
            <?php endif; ?>
          </div>
        </section>


    <footer class="u-clearfix u-footer u-white" id="sec-8eba"><div class="u-clearfix u-sheet u-sheet-1">
            <img src="{{the_field('logo_footer')}}" alt="" class="u-image u-image-default u-image-1" data-image-width="223" data-image-height="24">
            <a href="#" class="u-active-none u-btn u-btn-rectangle u-button-style u-hover-none u-none u-btn-1">
              <br>Bundels
            </a>
            <div class="u-align-left u-social-icons u-spacing-21 u-social-icons-1">
              <a class="u-social-url" target="_blank" href="">
                <span class="u-icon u-icon-circle u-social-facebook u-social-type-fill u-icon-1">
                  <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-b78c"></use></svg>
                  <svg x="0px" y="0px" viewBox="0 0 112 112" id="svg-b78c" class="u-svg-content"><path d="M56.1,0C25.1,0,0,25.1,0,56.1c0,31,25.1,56.1,56.1,56.1c31,0,56.1-25.1,56.1-56.1C112.2,25.1,87.1,0,56.1,0z M71.6,34.3h-8.2c-1.3,0-3.2,0.7-3.2,3.5v7.6h11.3l-1.3,12.9h-10V95H45V58.3h-7.2V45.4H45v-8.3c0-6,2.8-15.3,15.3-15.3l11.2,0V34.3z "></path></svg>
                </span>
              </a>
              <a class="u-social-url" target="_blank" href="#">
                <span class="u-icon u-icon-circle u-social-behance u-social-type-fill u-icon-2">
                  <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-722e"></use></svg>
                  <svg x="0px" y="0px" viewBox="0 0 112 112" id="svg-722e" class="u-svg-content"><path d="M47.9,47.5c0-4.4-3-4.4-3-4.4H32.6v9.4h11.5C46.1,52.5,47.9,51.9,47.9,47.5z"></path><path d="M56.1,0C25.1,0,0,25.1,0,56.1c0,31,25.1,56.1,56.1,56.1c31,0,56.1-25.1,56.1-56.1C112.2,25.1,87.1,0,56.1,0z M67.1,38.1h17.4v5.2H67.1V38.1z M58.3,65.4c0,12.9-13.4,12.5-13.4,12.5h-22V35.6h22c6.7,0,11.9,3.7,11.9,11.2c0,7.6-6.4,8-6.4,8 C58.9,54.9,58.3,65.4,58.3,65.4z M90.9,64.7H69c0,7.8,7.4,7.3,7.4,7.3c7,0,6.8-4.5,6.8-4.5h7.4c0,12.1-14.5,11.2-14.5,11.2 C58.9,78.7,60,62.6,60,62.6c0-0.1,0-16.2,16.2-16.2C93.3,46.3,90.9,64.7,90.9,64.7z"></path><path d="M44.9,59H32.6v11.3h11.7c1.7,0,5.1-0.6,5.1-5.5C49.4,59,44.9,59,44.9,59z"></path><path d="M76.4,52.5C69.9,52.5,69,59,69,59h13.9C82.8,59,82.9,52.5,76.4,52.5z"></path></svg>
                </span>
              </a>
              <a class="u-social-url" target="_blank" href="#">
                <span class="u-icon u-icon-circle u-social-dribbble u-social-type-fill u-icon-3">
                  <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-2de1"></use></svg>
                  <svg x="0px" y="0px" viewBox="0 0 112 112" id="svg-2de1" class="u-svg-content"><path d="M54.2,46.1c-4.8-8.5-10-15.7-11-17.2c-8.3,4-14.5,11.6-16.5,20.8h0.3C29.7,49.8,41.2,49.5,54.2,46.1z"></path><path d="M58.2,56.2c0.3-0.1,0.7-0.2,1-0.3c-0.7-1.6-1.5-3.2-2.3-4.8c-13.4,4-26.4,4.3-30.1,4.3c-0.3,0-0.6,0-0.8,0 c0,0.2,0,0.5,0,0.7c0,7.6,2.9,14.6,7.6,19.9C34.8,74,43.1,61.1,58.2,56.2z"></path><path d="M76,33.5C70.6,28.9,63.7,26,56.1,26c-2.3,0-4.6,0.3-6.8,0.8c1.2,1.7,6.4,8.8,11.1,17.4 C70.6,40.4,75.1,34.7,76,33.5z"></path><path d="M61.3,61.3C44.8,67,38.6,78.3,37.7,80c5.1,3.9,11.5,6.3,18.4,6.3c4.1,0,8.1-0.8,11.6-2.3 C67.3,81.1,65.5,72.1,61.3,61.3C61.4,61.3,61.3,61.3,61.3,61.3z"></path><path d="M56.1,0C25.1,0,0,25.1,0,56.1c0,31,25.1,56.1,56.1,56.1c31,0,56.1-25.1,56.1-56.1C112.2,25.1,87.1,0,56.1,0z M56.1,91.7c-19.7,0-35.7-16-35.7-35.6c0-19.6,16-35.6,35.7-35.6c19.7,0,35.7,16,35.7,35.6C91.8,75.7,75.8,91.7,56.1,91.7z"></path><path d="M67.4,59.8c3.7,10.3,5.4,18.8,5.8,21.1c6.6-4.5,11.3-11.7,12.7-19.9c-1.1-0.4-6.1-1.7-12.4-1.7 C71.5,59.3,69.5,59.5,67.4,59.8z"></path><path d="M62.9,49c0.7,1.4,1.3,2.8,1.9,4.2c0.2,0.5,0.4,1,0.6,1.4c2.3-0.3,4.7-0.4,6.9-0.4c6.9,0,12.6,1.1,13.9,1.3 c-0.1-6.9-2.6-13.3-6.7-18.4C78.5,38.7,73.4,44.7,62.9,49z"></path></svg>
                </span>
              </a>
            </div>

            <p class="u-custom-font u-heading-font u-text u-text-1">Follow Us&nbsp;</p>
            <?php
                $post_objects = get_field('footer_menu_eargo');
                if($post_objects) :
                foreach( $post_objects as $post):
                   setup_postdata($post); ?>
                    <a class="u-active-none u-btn u-btn-rectangle u-button-style u-hover-none u-none u-btn-3" href="<?= get_the_permalink($post->ID); ?>"><?= get_the_title($post->ID); ?></a>
                    <?php
                    // Reset $post so the rest of the page works
                    endforeach;
                    wp_reset_postdata();
                     endif;
                ?>
          </div></footer>




  @endwhile
@endsection
