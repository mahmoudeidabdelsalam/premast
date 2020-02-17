{{--
  Template Name: Refer a friend
--}}


@extends('layouts.app-dark')
@section('content')

  <section class="banner-hero" style="background-image:url('{{ the_field('background_banner_hero') }}');">
    <div class="container-fluid">
      <div class="row text-center">
        <h2 class="col-12">{{ the_field('headline_banner_hero') }}</h2>
        <h4 class="col-12">{{ the_field('tag_banner_hero_copy') }}</h4>
        <div class="col-12">
          <img class="img-fluid" data-aos="fade-up" data-aos-duration="1000" src="{{ the_field('image_banner_hero') }}" alt="{{ the_field('headline_banner_hero') }}">
        </div>        
      </div>
    </div>
  </section>

  <section class="banner-more-about">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-12">
          <img class="img-fluid" data-aos="fade-right" data-aos-duration="1000"" src="{{ the_field('icon_block_more_about') }}" alt="{{ the_field('headline_block_more_about') }}">
          <h3 class="the-headline-border">{{ the_field('headline_block_more_about') }}</h3>
          <div class="the-content">{{ the_field('content_block_more_about') }}</div>
          @php 
            $link = get_field('link_page_block_more_about');
          @endphp
          @if( $link )
          @php 
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
          @endphp
            <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
          @endif
        </div>
        <div class="col-md-6 col-12 the-future">
          @if( have_rows('list_future_block_more_about') )
            @while ( have_rows('list_future_block_more_about') )  @php the_row() @endphp
              <div class="list-future" data-aos="fade-up" data-aos-duration="{{ get_row_index() }}000">
                <h3><span>{{ get_row_index() }}</span> {{ the_sub_field('headline_future') }}</h3>
                <p>{{ the_sub_field('content_future') }}</p>
              </div>
            @endwhile
          @endif
        </div>
      </div>
    </div>
  </section>

  <div class="space-union"></div>


  <section class="banner-share">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-md-6">
          <h3>{{ _e('Ready to share? ', 'premast') }}</h3>
          <p>{{ _e('Have up to 6 months free premium subscription by inviting your friends to sign up at Premast. For each friend you bring you will have a 1 month free premium subscription.', 'premast') }}</p>
          @if( !is_user_logged_in() ) 
            <div class="custom-login">
              <a class="mx-2 login" href="#" data-toggle="modal" data-target="#LoginUser">log in</a>
              <a class="mx-2 signup btn-primary" href="#" data-toggle="modal" data-target="#SignupUser">create an account</a>            
            </div>
          @else
            <div class="custom-share">
              <h4>{{ _e('Invite through mail', 'premast') }}</h4>
              <form class="form-inline">
                <div class="form-group mb-2">
                  <label for="inputPassword2" class="sr-only">write an email</label>
                  <input type="email" class="form-control" id="emailInput" placeholder="write an email">
                </div>
                <button type="submit" class="btn btn-primary mb-2 shadow-none py-2 px-4">{{ _e('Send Invite', 'premast') }}</button>
              </form>

                @php 
                  global $current_user;
                  wp_get_current_user();

                  $link = home_url('/').'?id='.$current_user->ID.'&token='.get_the_date('c').'';
                @endphp

                <ul class="list-inline social-sharer">
                  <li class="head"><span>{{ _e('Share your link', 'premast') }}</span></li>
                  <li class="list-inline-item">
                    <a class="item" data-network="linkedin" data-url="{{ home_url('/') }}" data-title="{{ $link}}" href="#"> <i class="fa fa-linkedin"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a class="item" data-network="twitter"  data-url="{{ home_url('/') }}" data-title="{{ $link}}" href="#"> <i class="fa fa-twitter"></i></a>      
                  </li>
                  <li class="list-inline-item">
                    <a class="item" data-network="facebook" data-url="{{ home_url('/') }}" data-title="{{ $link}}" href="#"> <i class="fa fa-facebook"></i></a>      
                  </li>
                  <li class="list-inline-item">
                    <a class="item" data-network="addtoany" data-url="{{ $link }}" data-title="{{ $link }}" href="#"> <i class="fa fa-ellipsis-v"></i></a>      
                  </li>
                </ul>

                <div id="inviteCode" class="invite-page">
                  <input id="link" value="{{ $link }}" readonly>
                  <div id="copy">
                    <i data-copytarget="#link">{{ _e('Copy Link', 'premast') }}</i>
                  </div>
                </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
<script>
  jQuery(function($) {
    
    $('#copy').on('click', function(event) {
      console.log(event);
      copyToClipboard(event);
    });
    
    function copyToClipboard(e) {
      var
        t = e.target, 
        c = t.dataset.copytarget,
        inp = (c ? document.querySelector(c) : null);
      console.log(inp);
      if (inp && inp.select) {
        inp.select();
        try {
          document.execCommand('copy');
          inp.blur();
          t.classList.add('copied');
          setTimeout(function() {
            t.classList.remove('copied');
          }, 1500);
        } catch (err) {
          alert('please press Ctrl/Cmd+C to copy');
        }
      }
    }
  });
</script>
@endsection

<style>
section.banner-hero {
  height: 460px;
  margin-bottom: 236px;
  padding-top: 87px;
}
section.banner-hero h2 {
  font-weight: bold;
  font-size: 30px;
  line-height: 36px;
  text-align: center;
  letter-spacing: 0.04px;
  color: #F9F9F9;
}
section.banner-hero h4 {
  font-weight: 500;
  font-size: 40px;
  line-height: 47px;
  letter-spacing: 0.04px;
  text-transform: capitalize;
  color: #282F39;
}
section.banner-hero img {
  margin-top: -70px;
}
section.banner-more-about {
    padding-bottom: 116px;
}
section.banner-more-about .button {
  letter-spacing: 0.04px;
  color: #1E6DFB;
}
.list-future {
    margin-bottom: 40px;
}
.list-future h3 span {
  background: linear-gradient(96.83deg, #145DE9 -15.92%, #A04AF9 101.46%);
  width: 30px;
  height: 30px;
  display: flex;
  font-style: normal;
  font-weight: normal;
  font-size: 16px;
  letter-spacing: 0.04px;
  color: #FFFFFF;
  border-radius: 100%;
  float: left;
  margin-right: 10px;
  justify-content: center;
  align-items: center;
}
.list-future h3 span {
  background: linear-gradient(96.83deg, #145DE9 -15.92%, #A04AF9 101.46%);
  width: 30px;
  height: 30px;
  display: flex;
  font-style: normal;
  font-weight: normal;
  font-size: 16px;
  letter-spacing: 0.04px;
  color: #FFFFFF;
  border-radius: 100%;
  float: left;
  margin-right: 10px;
  justify-content: center;
  align-items: center;
  -webkit-text-fill-color: #fff;
}
.list-future h3 {
  font-style: normal;
  font-weight: normal;
  font-size: 24px;
  line-height: 27px;
  letter-spacing: 0.04px;
  background: -webkit-linear-gradient(124.84deg, #145DE9 -15.92%, #A04AF9 101.46%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.list-future p {
  font-style: normal;
  font-weight: normal;
  font-size: 16px;
  line-height: 24px;
  letter-spacing: 0.04px;
  color: #282F39;
}
.space-union {
  height: 160px;
  background-repeat: no-repeat;
  position: relative;
  z-index: 99;
}
.custom-login {
    margin-top: 50px;
}
section.banner-share {
  background-color: #F0F5FF;
  padding-top: 70px;
  margin-top: -25px;
  position: relative;
  z-index: 9;
  text-align: center;
  padding-bottom: 68px;
}
section.banner-share h3 {
  font-weight: bold;
  font-size: 30px;
  line-height: 36px;
  letter-spacing: 0.04px;
  color: #282F39;
}
section.banner-share p {
  font-style: normal;
  font-weight: normal;
  font-size: 16px;
  line-height: 24px;
  text-align: center;
  letter-spacing: 0.04px;
  color: #282F39;
}
.custom-login .login {
  font-weight: normal;
  font-size: 16px;
  line-height: 19px;
  text-align: center;
  letter-spacing: 0.116946px;
  text-transform: capitalize;
  color: #3F4A59;
  width: 85px;
  height: 40px;
  border: 1px solid #3F4A59;
  border-radius: 30px;
  display: inline-block;
  padding-top: 8px;
  vertical-align: middle;
}
.custom-login .signup {
  font-weight: normal;
  font-size: 16px;
  line-height: 19px;
  text-align: center;
  letter-spacing: 0.116946px;
  text-transform: capitalize;
  color: #3F4A59;
  width: 180px;
  height: 40px;
  border: 1px solid #3F4A59;
  display: inline-block;
  vertical-align: middle;
  background: linear-gradient(167.48deg, #6B73FF -0.5%, #000DFF 100%);
  border-radius: 30px;
  padding-top: 8px;
}
.custom-share {
  padding: 30px 60px;
  border-radius: 8px;
  background: #fff;
}
input#emailInput {
  border: 1px solid #E3E3E3;
  border-radius: 8px;
  min-width: 400px;
  font-style: normal;
  font-weight: normal;
  font-size: 16px;
  line-height: 24px;
  letter-spacing: 0.04px;
  color: #A6A6A6;  
}
.custom-share form.form-inline {
  justify-content: space-between;
}
.custom-share h4 {
  font-weight: bold;
  font-size: 16px;
  line-height: 24px;
  text-align: left;
  letter-spacing: 0.04px;
  color: #282F39;
}

div#copy {
    position: relative;
}

#inviteCode.invite-page #copy i::before {
  display: block;
  width: 15px;
  margin: 0 auto;
}
#inviteCode.invite-page #copy i.copied::after {
  position: absolute;
  top: 5px;
  right: 105%;
  height: 30px;
  line-height: 25px;
  display: block;
  content: "copied";
  font-size: 16px;
  padding: 2px 10px;
  color: #fff;
  background-color: #1e6cfd;
  border-radius: 3px;
  opacity: 1;
  will-change: opacity, transform;
  animation: showcopied 1.5s ease;
  font-weight: 200;
}
.container #inviteCode.invite-page #copy:hover {
  cursor: pointer;
  background-color: #dfdfdf;
  -webkit-transition: background-color .3s ease-in;
  transition: background-color .3s ease-in;
}

@-webkit-keyframes showcopied {
  0% {
    opacity: 0;
    -webkit-transform: translateX(100%);
            transform: translateX(100%);
  }
  70% {
    opacity: 1;
    -webkit-transform: translateX(0);
            transform: translateX(0);
  }
  100% {
    opacity: 0;
  }
}

@keyframes showcopied {
  0% {
    opacity: 0;
    -webkit-transform: translateX(100%);
            transform: translateX(100%);
  }
  70% {
    opacity: 1;
    -webkit-transform: translateX(0);
            transform: translateX(0);
  }
  100% {
    opacity: 0;
  }
}
div#inviteCode {
  display: flex;
  width: 100%;
}

div#inviteCode input {
  width: 80%;
  border: 1px solid #E3E3E3;
  box-sizing: border-box;
  border-radius: 2px;
  height: 40px;
  font-style: normal;
  font-weight: normal;
  font-size: 16px;
  line-height: 24px;
  letter-spacing: 0.04px;
  color: #3F4A59;
  padding: 0 10px;
}

div#copy i {
  margin: 10px;
  display: inline-block;
  font-style: normal;
  font-weight: normal;
  font-size: 16px;
  line-height: 24px;
  text-align: center;
  letter-spacing: 0.04px;
  color: #1E6DFB;
  cursor: pointer;
}
.custom-share .item {
  border: 1px solid #282F39;
  box-sizing: border-box;
  border-radius: 30px;
  width: 32px;
  height: 32px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 15px;
}
li.head {
  font-style: normal;
  font-weight: bold;
  font-size: 16px;
  line-height: 24px;
  text-align: center;
  letter-spacing: 0.04px;
  color: #282F39;
}
.social-sharer {
  justify-content: end !important;
}
</style>