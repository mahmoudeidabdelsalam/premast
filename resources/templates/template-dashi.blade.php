{{--
  Template Name: Dashi Template
--}}

@extends('layouts.app-blank')
@section('content')
  @while(have_posts()) @php the_post() @endphp
        <link rel="stylesheet" href="<?= get_theme_file_uri() . '/framework/assets/dashi.css'; ?>">
        <header style= "background-image:linear-gradient(90deg, #000000 14.32%, rgba(0, 0, 0, 0.25) 123.61%), url('{{ the_field('background_mac') }}') ">
            <div class="conatiner">
                <div id="navs" class="row">
                    <div class="col-md-8">
                        <div id="navbar">
                            <?php if( get_field('logo_premast') ): ?>
                        <img style=" margin-top: 39px; margin-bottom: -39px;padding-left:60px;" src="<?php the_field('logo_premast'); ?>" />
                            <?php endif; ?>
                            <nav></nav>
                            <?php
                            $link = get_field('pricing_btn');
                                if( $link ): ?>
                                <a style="box-shadow: none!important;" id="nav-btn" class="btn btn-danger " href="<?php echo esc_url( $link ); ?>">Purchase Now for $25</a>
                                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="conatiner" style="width:100%;">
                <div clas="row">
                    <div class="col-12">
                        <a href="">
                            <img src="<?php the_field('logo_premast'); ?>" style="padding: 60px;" />
                        </a>
                        <div class="row">
                            <div class="col-md-6" style="padding: 60px;">
                                <img src="<?php the_field('dashi_logo'); ?>" />
                            <h3 class="dashi-text">
                                <?php the_field('f_heading'); ?>
                                </h3>
                                <p class="subtext" style=" background-image: url(' {{ the_field ('line_img') }}')">
                                    <?php the_field('f_sub_heading'); ?>
                                </p>
                                <p class="pricing"><?php the_field('pricing_text'); ?></p>
                                <?php
                                $link = get_field('pricing_btn');
                                if( $link ): ?>
                                <a style="box-shadow: none!important;" class="btn btn-primary " href="<?php echo esc_url( $link ); ?>">Purchase Now </a>
                                    <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <!-- container that contain animations and counter -->
        <section >
            <div class="conatiner">
                <div class="row">
                    <div col-md-8>
                        <img class="img-fluid aos-init aos-animate" data-aos="fade-up" data-duration="1000" src="<?php the_field('ani_img'); ?>"/>
                    </div>
                    <div class="col-md-4 pt-5">
                        <p class="text"><?php the_field('side_text'); ?></p>
                        <div class="counter">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="themes">
                                            <p data-count="35" class="counter-count counting">0</p>
                                            <p class="themes-p">Color Theme</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="icons">
                                            <p data-count="3000"class="counter-count counting">0</p>
                                            <p class="icons-p">Vector Icons</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="characters">
                                            <p data-count="100" class="counter-count counting">0</p>
                                            <p class="characters-p">Vector Characters</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- the full access container -->
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <div class="access">
                            <p class="full"><?php the_field('sec_heading'); ?>
                            </p>
                            <p class="subline"><?php the_field('sec_sub_heading'); ?></p>
                            <div class="badges">
                                <div class="first">
                                    <img src="<?php the_field('light_badge'); ?>">
                                </div>
                                <div class="second">
                                    <img src="<?php the_field('update_badge'); ?>">
                                </div>
                                <div class="third">
                                    <img src="<?php the_field('support_badge'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <img style="width:100%;" class="simpleParallax" data-aos="fade-left" data-duration="1000"
                            src="<?php the_field('sec_ani_img'); ?>" />
                    </div>
                </div>

            </div>
            </div>
        </section>

        <!-- image bar that should be animated  -->

        <section>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="headline">
                        <p>Save countless hours by <br> using these templates</p>
                    </div>
                    <div class="slides">
                      <img style="width:130%;" class="ImageParallax" src="<?php the_field('slide_image'); ?>" />
                    </div>
                </div>
                <!-- dashboard slide  -->
                <div class="row justify-content-center">
                    <div class="category">
                        <p class="c-text">Dashboard Categories included</p>
                        <p class="c-sub">Track, analyze and display your data using Dashi bundle for magnificent results
                        </p>
                    </div>
                </div>

                <div class="row justify-content-center" style="padding-bottom: 90px;">
                    <div class="slider">
                        <?php
                        $dashboard_categories = get_field('dashboard_categories');
                        foreach ($dashboard_categories as  $value):
                        $slide_number = get_field('slide_colors', $value->ID );
                        ?>
                        <div class="col-md-2">
                            <img src="<?= Utilities::global_thumbnails($value->ID,'full'); ?>">
                            <p class="models"><a class="text-white" href="<?= get_permalink($value->ID); ?>"><?= get_the_title($value->ID); ?></a></p>
                            <p class="slidesnum"><?= $slide_number; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- customize sections  -->
        <section style="background: #202020;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="custom">
                        <p class="custom-head"><?php the_field('cust_headline'); ?></p>
                        <p class="custom-sub"><?php the_field('cust_sub'); ?></p>
                    </div>
                </div>
                <div class="row" style="padding-bottom:90px;">
                    <div class="col-md-3 ">
                        <img  src="<?php the_field('cust_icon'); ?>">
                    </div>
                    <div class="col-md-3 ">
                        <img  src="<?php the_field('cust_charts'); ?>">
                    </div>
                    <div id="cc" class="col-md-3 ">
                        <img src="<?php the_field('cust_setting'); ?>">
                    </div>
                    <div class="col-md-3 ">
                        <img src="<?php the_field('cust_colors'); ?>">
                    </div>
                </div>
            </div>
        </section>
        <!-- carousel and testmonials  -->
        <!-- carousel and testmonials  -->
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="customers">
                        <p class="head-count"><?php the_field('test_headline'); ?></p>
                        <p class="sub-test"><?php the_field('test_sub'); ?></p>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 col-10 offset-1 mt-5">
                            <ol class="carousel-indicators">
                                <?php
                                $counter =  -1;
                                if( have_rows('customers') ):
                                    while( have_rows('customers') ): the_row();
                                    $counter++;
                                ?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $counter; ?>" class="<?= ($counter == 0)? 'active':''; ?>"></li>
                                <?php
                                    endwhile;
                                endif; ?>
                            </ol>
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner mt-4">
                                                        <?php
                                $counter = -1;
                                if( have_rows('customers') ):
                                    while( have_rows('customers') ): the_row();
                                    $counter++;
                                ?>
                                    <div class="carousel-item text-center <?= ($counter == 0)? 'active':''; ?>">
                                        <div class="rating-box">
                                            <span class="rating-star full-star"></span>
                                            <span class="rating-star full-star"></span>
                                            <span class="rating-star full-star"></span>
                                            <span class="rating-star full-star"></span>
                                            <span class="rating-star half-star"></span>
                                        </div>
                                        <p class="cr-text"><?= the_sub_field('customer_content'); ?></p>
                                        <p class="cust"><?= the_sub_field('customers_name'); ?></p>
                                    </div>
                                <?php
                                    endwhile;
                                endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>

        <!-- bundle update section -->
        <section style="background: linear-gradient(247.87deg, #00A3FF -15.32%, rgba(7, 62, 255, 0.8) 87.3%);">
            <div class="container">
                <div class="row justify-content-center pt-5">
                    <div class="bundels">
                        <p class="bd-head"><?= the_field('timeline_headline'); ?></p>
                        <p class="bd-sub"><?= the_field('timeline_subheadline'); ?></p>
                    </div>

                    <div class="col-12 timeline">
                        <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                          <?php
                          $counter = -1;
                          if( have_rows('timelines') ):
                            while( have_rows('timelines') ): the_row();
                              $counter++;
                          ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($counter == 0)? 'active':''; ?>" id="home<?= $counter; ?>-item-tab" data-toggle="tab" href="#<?= $counter; ?>-item" role="tab"
                                    aria-controls="home<?= $counter; ?>" aria-selected="true"><?= the_sub_field('headline_item'); ?> <span><?= the_sub_field('date_item'); ?></span></a>
                            </li>
                          <?php
                            endwhile;
                          endif; ?>                            
                        </ul>

                        <div class="tab-content" id="myTabContent">
                          <?php
                          $counter = -1;
                          if( have_rows('timelines') ):
                            while( have_rows('timelines') ): the_row();
                              $counter++;
                          ?>
                            <div class="tab-pane fade <?= ($counter == 0)? 'show active':''; ?>" id="home<?= $counter; ?>-item" role="tabpanel" aria-labelledby="<?= $counter; ?>-item-tab">
                              <div class="col-md-6 col-12 col-content">
                                <h3><?= the_sub_field('headline_item_content'); ?></h3>
                                <p><?= the_sub_field('description_item_content'); ?></p>
                              </div>
                            </div>
                          <?php
                            endwhile;
                          endif; ?>                               
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- pricing section -->
        <section
            style="background-repeat: no-repeat; align-items:center; background-color:#000000; background-image: url('bg.png'); background-size: contain; width:100%; ">
            <div class="container">
                <div class="row justify-content-center pt-5">
                    <div class="full-ac text-center">
                        <p class="full-head"><?php the_field('headline_text'); ?></p>
                        <p class="full-sub"><?php the_field('sub_text'); ?>
                        <div class="btn-pr">
                            <?php
                            $link = get_field('pricing_button');
                            if( $link ): ?>
                            <a  class="btn btn-primary" style="box-shadow: none!important;"  href="<?php echo esc_url( $link ); ?>">Purchase Now </a>
                                <?php endif; ?>
                        </div>

                    </div>
                </div>
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

        
        <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.3.0/dist/simpleParallax.js"></script>

        <script>
            // When the user scrolls down 20px from the top of the document, slide down the navbar
            window.onscroll = function () {
                scrollFunction()
            };

            var image = document.getElementsByClassName('ImageParallax');
            new simpleParallax(image, {
              orientation: 'left'
            });


            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("navbar").style.top = "0";
                } else {
                    document.getElementById("navbar").style.top = "-60px";
                }
            }
            jQuery(function($) {
            var top = $('.counter').offset().top;
            console.log(top);
            $(window).on('scroll', function () {
                if ($(window).scrollTop() >= top - 300) {
                $('.counting').each(function () {
                    var $this = $(this),
                    countTo = $this.attr('data-count');
                    $({
                    countNum: $this.text()
                    }).animate({
                    countNum: countTo
                    },
                    {
                    duration: 1000,
                    easing: 'linear',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                    }
                    });
                });
                }
            });
            });
        </script>
        <style>
        ul#myTab li a:after {
            border-top: 1px dashed rgba(255, 255, 255, 0.6);
            content: "";
            width: 100%;
            height: 1px;
            position: absolute;
            top: -2px;
            left: 70px;
            z-index: 9;
        }

        ul#myTab li {
            position: relative;
            font-weight: bold;
            font-size: 18px;
            line-height: 21px;
            text-align: center;
            text-transform: capitalize;
            color: #FFFFFF;
        }

        ul#myTab li a:before {
            content: "";
            width: 12px;
            height: 12px;
            top: -7px;
            background: #fff;
            display: inline-block;
            border-radius: 100%;
            position: absolute;
            margin-left: -6px;
            z-index: 99;
            left: 47%;
        }

        ul#myTab li a {
            font-weight: bold;
            font-size: 18px;
            line-height: 21px;
            text-align: center;
            text-transform: capitalize;
            color: #FFFFFF;
            padding-top: 20px;
        }

        ul#myTab li a.active {
            background: transparent;
        }

        ul#myTab li a span {
            display: block;
            font-style: normal;
            font-weight: normal;
            font-size: 12px;
            line-height: 14px;
            text-align: center;
            text-transform: capitalize;
            color: #FFFFFF;
            opacity: 0.7;
            margin-top: 10px;
        }

        ul#myTab li a.active:before {
            background: rgba(255, 255, 255, 0.8);
            content: "";
        }

        .col-content h3,
        .col-content p {
            font-style: normal;
            font-weight: bold;
            font-size: 14px;
            line-height: 16px;
            text-transform: capitalize;
            color: #FFFFFF;
        }

        .col-content p {
            font-weight: 400;
        }

        .col-content {
            padding: 35px 60px;
        }

        .timeline .nav {
            margin-top: 80px;
        }

        .slider img {
          max-width: 100%;
        }
        </style>

  @endwhile
@endsection
