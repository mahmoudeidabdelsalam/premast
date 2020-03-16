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
                   <img style="padding-left:60px;" src="<?php the_field('logo_premast'); ?>" />
                    <?php endif; ?>
                    <nav></nav>
                    <?php
                    $link = get_field('pricing_btn');
                          if( $link ): ?>
                           <a  id="nav-btn" class="btn btn-danger " href="<?php echo esc_url( $link ); ?>">Purchase Now for $25</a>
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
                           <a class="btn btn-primary " href="<?php echo esc_url( $link ); ?>">Purchase Now </a>
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
                <img class="img-fluid aos-init aos-animate" data-aos="fade-left" data-duration="1000"
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
                <img src="slides.png" style="width:100%;">
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
                  $dashboard_categories = get_field(‘dashboard_categories’);
                  foreach ($dashboard_categories as  $value):
                  $slide_number = get_field(‘slide_colors’, $value->ID );
                ?>
                  <div class="col-md-2">
                      <img src="<?= Utilities::global_thumbnails($value->ID,‘full’); ?>">
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
                <p class="head-count">+1000 Customers</p>
                <p class="sub-test">Who trusted Dashi and use it to improve their presentation designs</p>
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
                                <p class="cr-text"><?= the_sub_field('customers_content'); ?></p>
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
        <div class="row justify-content-center p-5">
            <div class="bundels">
                <p class="bd-head">Bundle Update</p>
                <p class="bd-sub">We would like you to join along</p>
            </div>

            <div class="col-12 timeline">
                <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">release 1 <span>27 may 2018</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="true">release 2 <span>27 may 2018</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="true">release 2 <span>27 may 2018</span></a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3>Easily create your own version of dashboards through the following features. 1</h3>
                        <p>Easily create your own version of dashboards through the following features.</p>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h3>Easily create your own version of dashboards through the following features. 2</h3>
                        <p>Easily create your own version of dashboards through the following features.</p>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <h3>Easily create your own version of dashboards through the following features. 3</h3>
                        <p>Easily create your own version of dashboards through the following features.</p>
                    </div>
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
                <p class="full-head">Get Full Access For $15</p>
                <p class="full-sub">If you purchase the budle at any time all future releases will be emailed
                    straight<br>
                    to your inbox for free once released.</p>
                <div class="btn-pr">
                    <a class="btn btn-primary" href="#">purchase now</a>
                </div>

            </div>
        </div>
    </div>

    </div>
</section>

<footer style="background: #000000;
      box-shadow: 0px -2px 2px rgba(222, 222, 222, 0.25);">
    bdjdbbdjbdbdjbdjbdjbdj

</footer>

<script>
    // When the user scrolls down 20px from the top of the document, slide down the navbar
    window.onscroll = function () {
        scrollFunction()
    };
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
        if ($(window).scrollTop() >= top - 400) {
          $('.counting').each(function () {
            var $this = $(this),
              countTo = $this.attr('data-count');
            $({
              countNum: $this.text()
            }).animate({
              countNum: countTo
            },
            {
              duration: 3000,
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
  .simpleParallax {
    width: 130%;
  }
</style>

  @endwhile
@endsection
