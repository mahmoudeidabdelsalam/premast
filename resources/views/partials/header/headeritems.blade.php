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
            @if(get_field('link_pricing', 'option'))
          <div class="button-pricing">
            <a class="button-green" href="{{ the_field('link_pricing', 'option') }}">{{ _e('pricing', 'premast') }}</a>
          </div>
        @endif
    @if (has_nav_menu('items_navigation'))
      {!! wp_nav_menu(['theme_location' => 'items_navigation', 'container' => false, 'menu_class' => 'navbar-item navbar-nav ml-4 mr-auto', 'walker' => new Nav_Item_Walker()]) !!}
    @endif
  </nav>



  <nav id="menu_user" style="display: none;">
    @include('partials/incloud/profile')
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
          <a class="navbar-brand p-0 align-self-center col" href="{{ the_field('link_page_login','option') }}" title="{{ get_bloginfo('name') }}">
            <img class="img-fluid" src="@if(get_field('templates_logo', 'option')) {{ the_field('templates_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/premast-templates.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
            <span class="sr-only"> {{ get_bloginfo('name') }} </span>
          </a>
        </h2>
        @if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
        @php 
          $count = WC()->cart->cart_contents_count; 
        @endphp
          <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
            @if ( $count > 0 )
            <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
            @endif
          </a>
        @endif
        <div class="usermenu">
          @if( is_user_logged_in() ) 
            <a href="#" class="menu-toggle">
              <i class="fa fa-user-circle fa-lg text-gray-dark" aria-hidden="true"></i>
              <i class="fa fa-times fa-lg text-gray-dark" aria-hidden="true"></i>
            </a>
          @else 
            <a class="mx-2 login text-gray-dark" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Login', 'premast') }}</a>
          @endif
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

  @if ( !is_singular('product') ) 
    @php 
      $count = $taxonomy_query->count;
    @endphp
    @if(is_tax( 'product_cat' ))
      @php 
        $term = get_queried_object();
        $image = get_field('images_cat', $term);
        $heading = get_field('heading_cat', $term);
        $description = get_field('description_cat', $term);
        $calculation = get_field('number_slide', $term);
        $text_total = get_field('text_total', $term);
        $color_one = get_field('gradient_color_one_cat', $term);
        $color_two = get_field('gradient_color_two_cat', $term);
      @endphp
        @if ($heading)
          <section class="banner-items" style="background: linear-gradient(105deg, {{ $color_one }} 0.7%, {{ $color_two }} 100%);">
            <div class="elementor-background-overlay-items" style="background-image: url('{{ $image }}');"></div>
            <div class="container-fluid">
              <div class="row align-items-center text-left">
                <h1 class="col-12 text-black"><span class="font-weight-600">{{ $heading }}</span></h1>
                <p class="col-md-5 col-12 text-black font-weight-300">{{ $description }}</p>
              </div>
            </div>
          </section>
        @else
          @if($taxonomy_query->parent)
            @php 
              $term = get_term_by( 'id', $taxonomy_query->parent, 'product_cat' );
              $image = get_field('images_cat', $term);
              $heading = get_field('heading_cat', $term);
              $description = get_field('description_cat', $term);
              $calculation = get_field('number_slide', $term);
              $text_total = get_field('text_total', $term);
              $color_one = get_field('gradient_color_one_cat', $term);
              $color_two = get_field('gradient_color_two_cat', $term);
            @endphp
            <section class="banner-items" style="background: linear-gradient(105deg, {{ $color_one }} 0.7%, {{ $color_two }} 100%);">
              <div class="elementor-background-overlay-items" style="background-image: url('{{ $image }}');"></div>
              <div class="container-fluid">
                <div class="row align-items-center text-left">
                  <h1 class="col-12 text-black"><span class="font-weight-600">{{ $heading }}</span></h1>
                  <p class="col-md-5 col-12 text-black font-weight-300">{{ $description }}</p>
                </div>
              </div>
            </section>
          @else
            <section class="banner-items" style="background: linear-gradient(105deg, {{ the_field('gradient_color_one_cat','option') }} 0.7%, {{ the_field('gradient_color_two_cat','option') }} 100%);">
              <div class="elementor-background-overlay-items" style="background-image: url('{{ the_field('banner_background_overlay_cat','option') }}');"></div>
              <div class="container-fluid">
                <div class="row align-items-center text-left">
                  <h2 class="col-12 text-black"><strong class="font-weight-600">{{ _e('Discover', 'premast') }} +{{  ($calculation)? $calculation*$count:$count }}</strong> <span class="font-weight-300">{{ the_field('banner_items_headline','option') }}</span></h2>
                  <p class="col-md-5 col-12 text-black font-weight-300">{{ the_field('banner_items_sub_headline','option') }}</p>
                </div>
              </div>
            </section>
          @endif
        @endif
    @else
      @if (get_field('banner_items_headline', 'option'))
      <section class="banner-items" style="background: linear-gradient(105deg, {{ the_field('gradient_color_one_cat','option') }} 0.7%, {{ the_field('gradient_color_two_cat','option') }} 100%);">
        <div class="elementor-background-overlay-items" style="background-image: url('{{ the_field('banner_background_overlay_cat','option') }}');"></div>
        <div class="container-fluid">
          <div class="row align-items-center text-left">
            <h2 class="col-12 text-black"><strong class="font-weight-600">{{ _e('Discover', 'premast') }} +{{  ($calculation)? $calculation*$count:$count }}</strong> <span class="font-weight-300">{{ the_field('banner_items_headline','option') }}</span></h2>
            <p class="col-md-5 col-12 text-black font-weight-300">{{ the_field('banner_items_sub_headline','option') }}</p>
          </div>
        </div>
      </section>
      @endif
    @endif

    <div class="total-slide mb-5">
      <strong class="font-weight-600">{{ ($calculation)? $calculation*$count:$count }}</strong> <span></span>{{ ($text_total)? $text_total:_e('total slides', 'premast') }}
    </div>
  @endif

@endif


<style>
  @media (max-width: 579px) {
    section.banner-items {
      margin-top: 0;
    }
    header.banner,
    .admin-bar header.bg-light.banner {
      position: relative !important;
      top: 0 !important;
    }
    ul#menu-footer-menu {
      padding: 0;
    }
    nav#menu .navbar-nav li a {
      text-align: left;
      color: #fff !important;
    }
    nav#menu .navbar-nav li a {
      color: #fff !important;
      text-align: left;
    }
    nav#menu .navbar-nav li ul.sub {
      position: relative;
      background: transparent;
      overflow: hidden;
      white-space: normal;
      border: none;
      padding: 0 30px;
    }
    nav#menu .navbar-nav li ul.sub li {
      width: 100%;
    }
    ul.sub .item-current a:after {
      display: none;
    }
    nav#menu .navbar-nav li ul.sub li a {
      font-size: 14px;
      margin: 0 20px !important;
    }
    ul#menu-category-product-menu {
      margin: 20px 0 !important;
    }
    nav#menu .button-pricing {
        margin: 30px auto 0;
        display: block;
    }
    nav#menu .button-pricing {
      margin: 30px auto 0;
      display: block;
    }

    label a {
      pointer-events: none;
    }

    label:hover:after {
      display: none;
    } 

    .item-card .card .bg-white {
      min-height: 1px;
    }
    .col-offer a {
      display: block;
      margin-top: 12px;
    }
    #CloseBanner {
      margin: -1px 0;
    }
    #CloseBanner .fa-times {
      display: inline-block;
    }
    .col-offer + .slideout-menu {
      top: 190px;
    }
    li.item-menu.star .sub li {
      border: none;
      height: auto;
      padding: 6px;
    }
    li.item-menu.star .sub li a img {
      display: none;
    }
  }
</style>