{{--
  Template Name: paddle Template
--}}

@extends('layouts.app-dark')



@php 
  $variable = $_POST['alert_name'];
  dd($variable);
@endphp

@section('content')
  @while(have_posts()) @php the_post() @endphp

@php 
  global $current_user;
  wp_get_current_user();
@endphp
<section class="banner" style="background-image: linear-gradient(150deg, {{ the_field('gradient_color_one','option') }} 0%, {{ the_field('gradient_color_two','option') }} 100%);">
  <div class="elementor-background-overlay" style="background-image: url('{{ the_field('banner_background_overlay','option') }}');"></div>
  <div class="container">
    <div class="row align-items-center text-center justify-content-center">
      <div class="col-md-7 col-sm-12 col-12">
        <h2>Get Full Access to <br> +80k Slides  For Only $6 </h2>
        <p>Save hours of work and stand out from the crowd. Join thousands of people and companies worldwide who trust us with their presentations.</p>
        <p class="time-back"><span>15 day</span> {{ _e('money back guarantee', 'premast') }}</p>
      </div>
    </div>
  </div>
</section>
<div id="generic_price_table">
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="price-heading clearfix">
              <h1>We offer money back guarantee according to your package choice, in case you don’t like it</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
          <div class="col-md-4 p-0">
          <div class="generic_content clearfix">
            <div class="generic_head_price clearfix">
              <div class="generic_head_content clearfix">
                <div class="head_bg"></div>
                <div class="head">
                  <span>Plus</span>
                </div>
              </div>
              <div class="generic_price_tag clearfix">
                <span class="price">
                  <span class="sign">$</span>
                  <span class="currency">143</span>
                  <span class="cent">.99</span>
                  <span class="month">/Unlimited Downloads Other Benefits</span>
                </span>
              </div>
            </div>
            <div class="generic_feature_list">
              <ul>
                <li><span>1.</span> Access to all Free & Premium items</li>
                <li><span>2.</span> Support 24/7</li>
                <li><span>3.</span> Commercial license</li>
              </ul>
            </div>
            <div class="generic_price_btn clearfix">
              <a href="#">Subscribe!</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="generic_content active clearfix">
            <div class="generic_head_price clearfix">
              <div class="generic_head_content clearfix">
                <div class="head_bg"></div>
                <div class="head">
                  <span>Mega</span>
                </div>
              </div>
              <div class="generic_price_tag clearfix">
                <span class="price">
                  <span class="sign">$</span>
                  <span class="currency">143</span>
                  <span class="cent">.99</span>
                  <span class="month">/Unlimited Downloads Other Benefits</span>
                </span>
              </div>
            </div>
            <div class="generic_feature_list">
              <ul>
                <li><span>1.</span> Access to all Free & Premium items</li>
                <li><span>2.</span> Support 24/7</li>
                <li><span>3.</span> Commercial license</li>
              </ul>
            </div>
            <div class="generic_price_btn clearfix">
              <a href="#">Subscribe!</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 p-0">
          <div class="generic_content clearfix">
            <div class="generic_head_price clearfix">
              <div class="generic_head_content clearfix">
                <div class="head_bg"></div>
                <div class="head">
                  <span>Advanced</span>
                </div>
              </div>
              <div class="generic_price_tag clearfix">
                <span class="price">
                  <span class="sign">$</span>
                  <span class="currency">143</span>
                  <span class="cent">.99</span>
                  <span class="month">/Unlimited Downloads Other Benefits</span>
                </span>
              </div>
            </div>
            <div class="generic_feature_list">
              <ul>
                <li><span>1.</span> Access to all Free & Premium items</li>
                <li><span>2.</span> Support 24/7</li>
                <li><span>3.</span> Commercial license</li>
              </ul>
            </div>
            <div class="generic_price_btn clearfix">
              <a href="#" class="paddle_button" data-product="590810" data-success="/paddel/" data-email="<?= $current_user->email; ?>" data-passthrough="<?= $current_user->ID; ?>">Subscribe</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

  <style>
    body {
        background-color: rgba(61, 69, 82, 0.01);
    }

    #generic_price_table {
        background-color: rgba(61, 69, 82, 0.01);
    }

    /*PRICE COLOR CODE START*/
    #generic_price_table .generic_content {
        background-color: #fff;
        box-shadow: 0 0 3px 0 #ccc;
        border-radius: 10px;        
    }

    #generic_price_table .generic_content.active {
        box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.39);
        transform: scale3d(1.1, 1.1, 1.1);
    }

    #generic_price_table .generic_content:not(.active) {
        z-index: 1;
    }

    #generic_price_table .generic_content.active {
        z-index: 2;
        margin-bottom: 10px;
        position: relative;
        top: -20px;
    }

    #generic_price_table .generic_content .generic_head_price {
        background-color: #f6f6f6;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg {
        border-color: #e4e4e4 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #e4e4e4;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content .head span {
        color: #525252;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .sign {
        color: #414141;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .currency {
        color: #414141;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .cent {
        color: #414141;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .month {
        color: #414141;
    }

    #generic_price_table .generic_content .generic_feature_list ul li {
        color: #a7a7a7;
    }

    #generic_price_table .generic_content .generic_feature_list ul li span {
        color: #414141;
    }

    #generic_price_table .generic_content .generic_feature_list ul li:hover {
        background-color: #E4E4E4;
        border-left: 5px solid #1e6cfd;
    }

    #generic_price_table .generic_content .generic_price_btn a {
        border: 1px solid #2ECC71;
        color: #2ECC71;
    }

    #generic_price_table .generic_content.active .generic_head_price .generic_head_content .head_bg,
    #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg {
        border-color: #1d6dfa rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #1d6dfa;
        color: #fff;
    }

    #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head span,
    #generic_price_table .generic_content.active .generic_head_price .generic_head_content .head span {
        color: #fff;
    }

    #generic_price_table .generic_content:hover .generic_price_btn a,
    #generic_price_table .generic_content.active .generic_price_btn a {
        background-color: #1e6cfd;
        color: #fff;
    }

    #generic_price_table {
        margin: 50px 0 50px 0;
    }

    .row .table {
        padding: 28px 0;
    }

    #generic_price_table .generic_content {
        overflow: hidden;
        position: relative;
        text-align: center;
    }

    #generic_price_table .generic_content .generic_head_price {
        margin: 0 0 20px 0;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content {
        margin: 0 0 50px 0;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg {
        border-style: solid;
        border-width: 90px 1411px 23px 399px;
        position: absolute;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content .head {
        padding-top: 40px;
        position: relative;
        z-index: 1;
    }

    #generic_price_table .generic_content .generic_head_price .generic_head_content .head span {
        font-size: 28px;
        font-weight: 400;
        letter-spacing: 2px;
        margin: 0;
        padding: 0;
        text-transform: uppercase;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag {
        padding: 0 0 20px;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price {
        display: block;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .sign {
        display: inline-block;
        font-size: 28px;
        font-weight: 400;
        vertical-align: middle;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .currency {
        font-size: 60px;
        font-weight: 300;
        letter-spacing: -2px;
        line-height: 60px;
        padding: 0;
        vertical-align: middle;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .cent {
        display: inline-block;
        font-size: 24px;
        font-weight: 400;
        vertical-align: bottom;
    }

    #generic_price_table .generic_content .generic_head_price .generic_price_tag .month {
        font-size: 18px;
        font-weight: 400;
        letter-spacing: 3px;
        vertical-align: bottom;
    }

    #generic_price_table .generic_content .generic_feature_list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #generic_price_table .generic_content .generic_feature_list ul li {
        font-size: 18px;
        padding: 15px 0;
        transition: all 0.3s ease-in-out 0s;
        text-align: left;
        padding-left: 25px;
    }

    #generic_price_table .generic_content .generic_feature_list ul li:hover {
        transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        -ms-transition: all 0.3s ease-in-out 0s;
        -o-transition: all 0.3s ease-in-out 0s;
        -webkit-transition: all 0.3s ease-in-out 0s;

    }

    #generic_price_table .generic_content .generic_feature_list ul li .fa {
        padding: 0 10px;
    }

    #generic_price_table .generic_content .generic_price_btn {
        margin: 20px 0 32px;
    }

    #generic_price_table .generic_content .generic_price_btn a {
        border-radius: 50px;
        display: inline-block;
        font-size: 18px;
        outline: medium none;
        padding: 12px 30px;
        text-decoration: none;
        text-transform: uppercase;
    }

    #generic_price_table .generic_content,
    #generic_price_table .generic_content:hover,
    #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg,
    #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg,
    #generic_price_table .generic_content .generic_head_price .generic_head_content .head h2,
    #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head h2,
    #generic_price_table .generic_content .price,
    #generic_price_table .generic_content:hover .price,
    #generic_price_table .generic_content .generic_price_btn a,
    #generic_price_table .generic_content:hover .generic_price_btn a {
        transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        -ms-transition: all 0.3s ease-in-out 0s;
        -o-transition: all 0.3s ease-in-out 0s;
        -webkit-transition: all 0.3s ease-in-out 0s;
    }

    @media (max-width: 320px) {}

    @media (max-width: 767px) {
        #generic_price_table .generic_content {
            margin-bottom: 75px;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        #generic_price_table .col-md-3 {
            float: left;
            width: 50%;
        }

        #generic_price_table .col-md-4 {
            float: left;
            width: 50%;
        }

        #generic_price_table .generic_content {
            margin-bottom: 75px;
        }
    }

    @media (min-width: 992px) and (max-width: 1199px) {}

    @media (min-width: 1200px) {}

    .text-center h1,
    .text-center h1 a {
        color: #7885CB;
        font-size: 30px;
        font-weight: 300;
        text-decoration: none;
    }

    .demo-pic {
        margin: 0 auto;
    }

    .demo-pic:hover {
        opacity: 0.7;
    }

    #generic_price_table_home ul {
        margin: 0 auto;
        padding: 0;
        list-style: none;
        display: table;
    }

    #generic_price_table_home li {
        float: left;
    }

    #generic_price_table_home li+li {
        margin-left: 10px;
        padding-bottom: 10px;
    }

    #generic_price_table_home li a {
        display: block;
        width: 50px;
        height: 50px;
        font-size: 0px;
    }

    #generic_price_table_home .blue {
        background: #3498DB;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .emerald {
        background: #1e6cfd;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .grey {
        background: #7F8C8D;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .midnight {
        background: #34495E;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .orange {
        background: #E67E22;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .purple {
        background: #9B59B6;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .red {
        background: #E74C3C;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .turquoise {
        background: #1ABC9C;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .blue:hover,
    #generic_price_table_home .emerald:hover,
    #generic_price_table_home .grey:hover,
    #generic_price_table_home .midnight:hover,
    #generic_price_table_home .orange:hover,
    #generic_price_table_home .purple:hover,
    #generic_price_table_home .red:hover,
    #generic_price_table_home .turquoise:hover {
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
        border-top-left-radius: 50px;
        border-top-right-radius: 50px;
        transition: all 0.3s ease-in-out 0s;
    }

    #generic_price_table_home .divider {
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        padding: 20px;
    }

    #generic_price_table_home .divider span {
        width: 100%;
        display: table;
        height: 2px;
        background: #ddd;
        margin: 50px auto;
        line-height: 2px;
    }

    #generic_price_table_home .itemname {
        text-align: center;
        font-size: 50px;
        padding: 50px 0 20px;
        border-bottom: 1px solid #ddd;
        margin-bottom: 40px;
        text-decoration: none;
        font-weight: 300;
    }

    #generic_price_table_home .itemnametext {
        text-align: center;
        font-size: 20px;
        padding-top: 5px;
        text-transform: uppercase;
        display: inline-block;
    }

    #generic_price_table_home .footer {
        padding: 40px 0;
    }

    .price-heading {
        text-align: center;
        margin-bottom: 70px;        
    }

    .price-heading h1 {
        color: #666;
        margin: 0;
        padding: 0 0 50px 0;
    }

    .demo-button {
        background-color: #333333;
        color: #ffffff;
        display: table;
        font-size: 20px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 20px;
        margin-bottom: 50px;
        outline-color: -moz-use-text-color;
        outline-style: none;
        outline-width: medium;
        padding: 10px;
        text-align: center;
        text-transform: uppercase;
    }

    .bottom_btn {
        background-color: #333333;
        color: #ffffff;
        display: table;
        font-size: 28px;
        margin: 60px auto 20px;
        padding: 10px 25px;
        text-align: center;
        text-transform: uppercase;
    }

    .demo-button:hover {
        background-color: #666;
        color: #FFF;
        text-decoration: none;

    }

    .bottom_btn:hover {
        background-color: #666;
        color: #FFF;
        text-decoration: none;
    }

  </style>
  @endwhile
@endsection
