{{--
  Template Name: Dashi Template
--}}

@extends('layouts.app-blank')
@section('content')
  @while(have_posts()) @php the_post() @endphp

  <link rel="stylesheet" href="<?= get_theme_file_uri() . '/framework/assets/dashi.css'; ?>">
<header>
    <div class="conatiner">
        <div id="navs" class="row">
            <div class="col-md-8">
                <div id="navbar">
                    <a href="#home">
                        <img src="Logo.png" alt="Premast" style="padding-left:60px;">
                    </a>
                    <nav></nav>
                    <a id="nav-btn" class="btn btn-danger" href="#">Purchase Now for $25</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="conatiner" style="width:100%;">
        <div clas="row">
            <div class="col-12">
                <a href="">
                    <img src="Logo.png" style="padding: 60px;" />
                </a>
                <div class="row">
                    <div class="col-md-6" style="padding: 60px;">
                        <img src="dashi.png" />
                        <h3 class="dashi-text">
                            All-in-one Dashboard Presentation Package
                        </h3>
                        <p class="subtext">
                            With 90 slides in one package, no need for another search!
                        </p>
                        <p class="pricing">Only $15</p>
                        <a class="btn btn-primary" href="#">purchase now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- container that contain animations and counter -->
<section>
    <div class="conatiner">
        <div class="row">
            <div col-md-8>
                <img class="img-fluid aos-init aos-animate" data-aos="fade-up" data-duration="1000" src="Group0.png" />
            </div>
            <div class="col-md-4 pt-5">
                <p class="text">Multiple options in one package</p>
                <div class="counter">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="themes">
                                    <p class="counter-count">35</p>
                                    <p class="themes-p">Color Theme</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="icons">
                                    <p class="counter-count">3000</p>
                                    <p class="icons-p">Vector Icons</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="characters">
                                    <p class="counter-count">100</p>
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
                    <p class="full">Full Access to +90 premium slides instantly
                    </p>
                    <p class="subline">All types of dashboards needed to deliver a perfect presentation. Track, Analyze
                        and display your data.</p>
                    <div class="badges">
                        <div class="first">
                            <img src="Group2.png">

                        </div>
                        <div class="second">
                            <img src="Group3.png">
                        </div>
                        <div class="third">
                            <img src="Group4.png">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <img class="img-fluid aos-init aos-animate" data-aos="fade-left" data-duration="1000"
                    src="Preview.png" />
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
                <div class="col-md-2">
                    <img src="img1.png">
                    <p class="models">Dashi Marketing</p>
                    <p class="slidesnum">10 slides</p>
                </div>
                <div class="col-md-2">
                    <img src="img2.png">
                    <p class="models">SEO Dashboard</p>
                    <p class="slidesnum">10 slides</p>
                </div>
                <div class="col-md-2">
                    <img src="img3.png">
                    <p class="models">Financial Dashboard</p>
                    <p class="slidesnum">10 slides</p>

                </div>
                <div class="col-md-2">
                    <img src="img4.png">
                    <p class="models">2020 Calender </p>
                    <p class="slidesnum">10 slides</p>

                </div>
                <div class="col-md-2">
                    <img src="img5.png">
                    <p class="models">Social Media Report</p>
                    <p class="slidesnum">10 slides</p>

                </div>

            </div>
        </div>
    </div>
</section>
<!-- customize sections  -->
<section style="background: #202020;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="custom">
                <p class="custom-head">Customize Everything</p>
                <p class="custom-sub">Easily create your own version of dashboards through the following features.</p>
            </div>
        </div>
        <div class="row" style="padding-bottom:90px;">
            <div class="col-md-3 ">
                <img src="custom1.png" alt="">
            </div>
            <div class="col-md-3 ">
                <img src="custom2.png" alt="">
            </div>
            <div id="cc" class="col-md-3 ">
                <img src="custom3.png" alt="">
            </div>
            <div class="col-md-3 ">
                <img src="custom4.png" alt="">
            </div>
        </div>
    </div>
</section>
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
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                    </ol>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner mt-4">
                            <div class="carousel-item text-center active">

                                <div class="rating-box">
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star half-star"></span>
                                </div>
                                <p class="cr-text">This is such an exhaustive and compelete set of designs and slides.
                                    Thank<br> you for all your hard work </p>
                                <p class="cust">John Barhorst</p>
                            </div>
                            <div class="carousel-item text-center">

                                <div class="rating-box">
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star half-star"></span>
                                </div>
                                <p class="cr-text">Premast Team was great! They did a great job on the slide designs i
                                    needed <br>
                                    and were a pleasure to work with. I look forward to working with them on future
                                    projects </p>
                                <p class="cust">Sarah Press</p>
                            </div>
                            <div class="carousel-item text-center">
                                <div class="rating-box">
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star half-star"></span>
                                </div>
                                <p class="cr-text"> I love premast work. Talent - creativity and professionalism in
                                    reporting <br>
                                    work. For sure i will work with them again</p>
                                <p class="cust">Alxtel Inc</p>
                            </div>
                            <div class="carousel-item text-center">
                                <div class="rating-box">
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star half-star"></span>
                                </div>
                                <p class="cr-text"> very good put up, i definitly love this website, keep on it </p>
                                <p class="cust">Ernest Rinheimer</p>


                            </div>
                            <div class="carousel-item text-center">
                                <div class="rating-box">
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star half-star"></span>
                                </div>
                                <p class="cr-text">Amazing work! Highly recommend</p>
                                <p class="cust">Dane Shelford</p>
                            </div>
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
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="profile" aria-selected="true">release 2 <span>27 may 2018</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="contact" aria-selected="true">release 2 <span>27 may 2018</span></a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3></h3>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
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
      var scrollPositionToAnimate = 300;
      var positionToAnimateTo = 200;
      $(window).scroll(function() {
        if ($(window).scrollTop() > scrollPositionToAnimate) {
          if ($('.slides').position().left < positionToAnimateTo) {
            $('.slides').clearQueue().animate({
              left: positionToAnimateTo
            });
          }
        } else {
          if ($('.slides').position().left > 0) {
            $('.slides').clearQueue().animate({
              left: 0
            });
          }
        }
      });
    });
</script>


  @endwhile
@endsection
