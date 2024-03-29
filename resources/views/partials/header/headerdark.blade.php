@if(get_field('offer_head_text', 'option'))
@php
$time = get_the_time('Y-m-d')
@endphp
  @if($time > isset($_COOKIE['the_last_view']))
    <div class="col-offer" style="background-color:{{ the_field('head_background_color', 'option') }}">
      <div class="container">
        <div class="row justify-content-center align-content-center p-3">
          <p class="text-center m-0">{{ the_field('offer_head_text', 'option') }} <a href="{{ the_field('head_offer_link', 'option') }}">{{ the_field('head_link_text', 'option') }}</a></p>
        </div>
      </div>
      <a href="javascript:void(0)" class="closeBanner" id="CloseBanner"><i class="fa fa-times" aria-hidden="true"></i></a>
    </div>
  @endif
@endif


@php
  $refine   = isset($_GET['refine']) ? $_GET['refine'] : '0';
  $sort   = isset($_GET['sort']) ? $_GET['sort'] : '0';
  $taxonomy_query = get_queried_object();
  global $current_user;
  wp_get_current_user();
  global $wp;
@endphp


@if ( wp_is_mobile() )
  <nav id="menu">
    @if (has_nav_menu('items_navigation'))
      {!! wp_nav_menu(['theme_location' => 'items_navigation', 'container' => false, 'menu_class' => 'navbar-item navbar-nav ml-4 mr-auto', 'walker' => new Nav_Item_Walker()]) !!}
    @endif
  </nav>
  <nav id="menu_user" style="display: none;">
    @if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
    @php
      $count = WC()->cart->cart_contents_count;
    @endphp
    <div class="cart-div">
      <span>{{ _e('cart', 'premast') }}</span>
       <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
        @if ( $count > 0 )
        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
        @endif
      </a>
    </div>
    @endif
    @if( is_user_logged_in() )
      @include('partials/incloud/profile')
    @else
      <a class="login link-item-mobile" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Sign in to your account', 'premast') }}</a>
      <a class="signup link-item-mobile" href="#" data-toggle="modal" data-target="#SignupUser">{{ _e('Sign Up', 'premast') }}</a>
      <a class="link-item-mobile" href="{{ home_url('/') }}/contact-us/">{{ _e('Contact US', 'premast') }}</a>
      <a class="link-item-mobile" href="{{ home_url('/') }}/faq">{{ _e('Help Center', 'premast') }}</a>
      <div class="premast-social-icons">
        <a class="premast-icon icon-facebook" href="http://facebook.com/premast.co/" target="_blank" rel="nofollow"> <span class="sr-only">Facebook</span> <i class="fa fa-facebook-square"></i> </a>
        <a class="premast-icon icon-twitter" href="https://twitter.com/Premast_co" target="_blank" rel="nofollow"> <span class="sr-only">Twitter</span> <i class="fa fa-twitter-square"></i> </a>
        <a class="premast-icon icon-instagram" href="https://www.instagram.com/premast.co/" target="_blank" rel="nofollow"> <span class="sr-only">instagram</span> <i class="fa fa-instagram"></i> </a>
        <a class="premast-icon icon-behance" href="http://behance.net/Premast" target="_blank" rel="nofollow"> <span class="sr-only">Behance</span> <i class="fa fa-behance-square"></i> </a>
      </div>
    @endif
  </nav>

  <header class="banner">
    <div class="container p-0">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="toggle-menu toggle-button text-gray-dark" href="#">
          <i></i>
          <i></i>
          <i></i>
        </a>
        <h2 class="logos mr-auto">
          <a class="navbar-brand p-0 align-self-center" href="{{ the_field('link_page_login','option') }}" title="{{ get_bloginfo('name') }}">
            <img class="img-fluid" src="@if(get_field('templates_logo', 'option')) {{ the_field('templates_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/premast-templates.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
            <span class="sr-only"> {{ get_bloginfo('name') }} </span>
          </a>
        </h2>
        @if(get_field('link_pricing', 'option'))
          <div class="button-pricing">
            <a class="button-green" href="{{ the_field('link_pricing', 'option') }}">{{ _e('pricing', 'premast') }}</a>
          </div>
        @endif
        <div class="search-items-mobile">
          <form action="{{ bloginfo('url') }}/items" autocomplete="on" id="search">
            <input id="autoblogs" class="search-inputs"  name="refine"  value="{{ get_search_query() }}" type="text" placeholder="{{ _e('type something','premast') }}" autocomplete="off" spellcheck="false" maxlength="100"">
            <input id="search_submit" value="Rechercher" type="submit">
            <i class="button-close"></i>
          </form>
        </div>
        <div class="usermenu">
          <a href="#" class="menu-toggle">
            <i class="fa fa-user-circle fa-lg text-gray-dark" aria-hidden="true"></i>
            <i class="fa fa-times fa-lg text-gray-dark" aria-hidden="true"></i>
          </a>
        </div>
      </nav>
    </div>
  </header>

@else

@php
  $taxonomy_query = get_queried_object();
@endphp
  <header class="bg-light banner navbar-banner-items">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h2 class="logos">
          <a class="navbar-brand p-0 align-self-center col" href="{{ the_field('link_page_login','option') }}" title="{{ get_bloginfo('name') }}">
            <img class="img-fluid" src="@if(get_field('templates_logo', 'option')) {{ the_field('templates_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/premast-templates.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
            <span class="sr-only"> {{ get_bloginfo('name') }} </span>
          </a>
        </h2>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <h5 class="sr-only">{{ _e('Breadcrumb navigation', 'premast') }}</h5>

          @if (has_nav_menu('items_navigation'))
            {!! wp_nav_menu(['theme_location' => 'items_navigation', 'container' => false, 'menu_class' => 'navbar-item navbar-nav ml-4 mr-auto', 'walker' => new Nav_Item_Walker()]) !!}
          @endif
        </div>

        <form action="{{ bloginfo('url') }}/items" autocomplete="on" id="search">
          <input id="autoblogs" class="search-inputs"  name="refine"  value="{{ get_search_query() }}" type="text" placeholder="{{ _e('search...','premast') }}" autocomplete="off" spellcheck="false" maxlength="100"">
          <input id="search_submit" value="Rechercher" type="submit">
          <i class="button-close"></i>
        </form>

        @if(get_field('link_pricing', 'option'))
          <div class="button-pricing">
            <a class="button-green" href="{{ the_field('link_pricing', 'option') }}">{{ _e('pricing', 'premast') }}</a>
          </div>
        @endif
        @if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
        @php
          $count = WC()->cart->cart_contents_count;
        @endphp
          <a class="cart-contents ml-4" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
            @if ( $count > 0 )
            <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
            @endif
          </a>
        @endif
        @if( is_user_logged_in() )
          <div class="notification mx-4">
            <a href="#"><i class="fa premast-bell-" aria-hidden="true"></i> <span class="notification-counter"></span></a>
          </div>
        @endif
        <div class="half">
          @if( is_user_logged_in() )
            @php
              $limit_membership = wc_memberships_get_user_active_memberships($current_user->ID);
              $author = get_the_author_meta($current_user->ID);
              // dd($current_user->ID);
              $avatar = get_field('owner_picture', 'user_'. $current_user->ID );
            @endphp
            <label for="profile" class="profile-dropdown">
              <input type="checkbox" id="profile">
              @if($avatar)
                <img class="avatar" src="{{ $avatar['url'] }}" alt="{!! get_the_author_meta('display_name', $current_user->ID) !!}">
              @else
                <img class="avatar" src="{{ get_theme_file_uri().'/resources/assets/images' }}/avatar.svg" alt="{!! get_the_author_meta('display_name', $current_user->ID) !!}">
              @endif
              {!! get_the_author_meta('display_name', $current_user->ID) !!}
              <i class="fa fa-chevron-down" aria-hidden="true"></i>
              @if ($limit_membership)
                <i class="fa fa-star user-star" aria-hidden="true"></i>
              @endif
              @include('partials/incloud/profile')
            </label>
          @else
            <a class="mx-2 signup text-primary" href="#" data-toggle="modal" data-target="#SignupUser">{{ _e('Sign Up', 'premast') }}</a>
            <a class="mx-2 login text-gray-dark" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Login', 'premast') }}</a>
          @endif
        </div>
      </nav>
    </div>
  </header>
@endif



<div id="ProgressBar"></div>


<style>
  div#ProgressBar {
    position: fixed;
    top: -6px;
    z-index: 999999999;
    width: 100%;
    height: 14px;
    overflow: hidden;
  }
  .admin-bar div#ProgressBar {
    top: 24px;
  }
  header.banner .cart-contents {
    margin-left: 8px !important;
}
</style>
