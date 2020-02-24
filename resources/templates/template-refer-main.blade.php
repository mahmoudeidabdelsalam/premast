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

                  $link = get_field('link_signup', 'option').'?refer='.$current_user->ID.'&token='.get_the_date('U').'';
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