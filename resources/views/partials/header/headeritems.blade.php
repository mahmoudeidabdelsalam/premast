@if(get_field('offer_head_text', 'option'))
<div class="col-offer" style="background-color:{{ the_field('head_background_color', 'option') }}">
  <div class="container">
    <div class="row justify-content-center align-content-center p-3">
      <p class="text-center m-0">{{ the_field('offer_head_text', 'option') }} <a href="{{ the_field('head_offer_link', 'option') }}">{{ the_field('head_link_text', 'option') }}</a></p>
    </div>
  </div>
</div>
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
    <hr>
    @php 
      $ids_to_exclude = array();
      $get_terms_to_exclude =  get_terms(
        array(
          'fields'  => 'ids',
          'slug'    => array( 'plans' ),
          'taxonomy' => 'product_cat',
        )
      );
      if( !is_wp_error( $get_terms_to_exclude ) && count($get_terms_to_exclude) > 0){
          $ids_to_exclude = $get_terms_to_exclude; 
      }
      $product_terms = get_terms( 'product_cat', array(
          'hide_empty' =>  1,
          'exclude' => $ids_to_exclude,
          'parent' =>0
      ) );
    @endphp
    <ul class="navbar-nav">
      @foreach($product_terms as $product_term) 
      @php 
        $term_link = get_term_link( $product_term );
        if ( is_wp_error( $term_link ) ) {
            continue;
        }
      @endphp
        <li class="list-inline-item">
          <a class="text-term @if($product_term->term_id == $taxonomy_query->term_id) active @endif" href="{{ $term_link }}">{{ $product_term->name }}</a>
        </li>
      @endforeach
    </ul>
    <hr>
    @if (has_nav_menu('templates_navigation'))
      {!! wp_nav_menu(['theme_location' => 'templates_navigation', 'container' => false, 'menu_class' => 'navbar-nav', 'walker' => new NavWalker()]) !!}
    @endif
  </nav>

  <nav id="menu_user" style="display: none;">
    @include('partials/incloud/profile')
  </nav>

  <header class="banner">
    <div class="container p-0">
      <nav class="navbar navbar-expand-lg navbar-light bg-light px-0">
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
        <div class="usermenu ml-4 mt-1">
          @if( is_user_logged_in() ) 
            <a href="#" class="menu-toggle">
              <i class="fa fa-user-circle fa-lg text-gray-dark" aria-hidden="true"></i>
              <i class="fa fa-times fa-lg text-gray-dark" aria-hidden="true"></i>
            </a>
          @else 
            <a class="mt-2 signup btn-primary" href="#" data-toggle="modal" data-target="#SignupUser">{{ _e('Sign Up', 'premast') }}</a>
          @endif
        </div>
      </nav>
    </div>
  </header>
@else
<header class="bg-light banner">
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
        <h2 class="sr-only">{{ _e('Breadcrumb navigation', 'premast') }}</h2>
        @if (has_nav_menu('templates_navigation'))
          {!! wp_nav_menu(['theme_location' => 'templates_navigation', 'container' => false, 'menu_class' => 'navbar-nav ml-4 mr-auto', 'walker' => new NavWalker()]) !!}
        @endif
      </div>
      <form action="" autocomplete="on" id="search">
        <input id="search" name="search" type="text" placeholder="search.."><input id="search_submit" value="Rechercher" type="submit">
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
        <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
          @if ( $count > 0 )
          <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
          @endif
        </a>
      @endif
      <div class="notification mx-3">
        <a href="#"><i class="fa fa-bell-o text-gray-dark fa-lg" aria-hidden="true"></i> <span class="notification-counter"></span></a>
      </div>
      <div class="half">
        @if( is_user_logged_in() ) 
          @php 
            $limit_membership = wc_memberships_get_user_active_memberships($current_user->ID);
          @endphp
          <label for="profile" class="profile-dropdown">
            <input type="checkbox" id="profile">
            <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
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



@php 
  $args = array(
    'post_type' => 'product',
  );
  $loop = new WP_Query( $args );
  $count = $loop->found_posts;
@endphp
@if(is_tax( 'product_cat' ))
  @php 
    $term = get_queried_object();
    $image = get_field('images_cat', $term);
    $heading = get_field('heading_cat', $term);
    $description = get_field('description_cat', $term);
  @endphp
    @if ($heading)
      <section class="banner-items mb-5" style="background: linear-gradient(105deg, {{ the_field('gradient_color_one','option') }} 0.7%, {{ the_field('gradient_color_two','option') }} 100%);">
        <div class="elementor-background-overlay" style="background-image: url('{{ $image }}');"></div>
        <div class="container-fluid">
          <div class="row align-items-center text-left">
            <h2 class="col-12 text-black"><span class="font-weight-300">{{ $heading }}</span></h2>
            <p class="col-md-5 col-12 text-black font-weight-300">{{ $description }}</p>
          </div>
        </div>
      </section>
    @else
      <section class="banner-items mb-5" style="background: linear-gradient(105deg, {{ the_field('gradient_color_one','option') }} 0.7%, {{ the_field('gradient_color_two','option') }} 100%);">
        <div class="elementor-background-overlay" style="background-image: url('{{ the_field('banner_background_overlay','option') }}');"></div>
        <div class="container-fluid">
          <div class="row align-items-center text-left">
            <h2 class="col-12 text-black"><strong class="font-weight-600">{{ _e('Discover', 'premast') }} +{{  $count }}</strong> <span class="font-weight-300">{{ the_field('banner_items_headline','option') }}</span></h2>
            <p class="col-md-5 col-12 text-black font-weight-300">{{ the_field('banner_items_sub_headline','option') }}</p>
          </div>
        </div>
      </section>
    @endif
@else
  @if (get_field('banner_items_headline', 'option'))
  <section class="banner-items mb-5" style="background: linear-gradient(105deg, {{ the_field('gradient_color_one','option') }} 0.7%, {{ the_field('gradient_color_two','option') }} 100%);">
    <div class="elementor-background-overlay" style="background-image: url('{{ the_field('banner_background_overlay','option') }}');"></div>
    <div class="container-fluid">
      <div class="row align-items-center text-left">
        <h2 class="col-12 text-black"><strong class="font-weight-600">{{ _e('Discover', 'premast') }} +{{  $count }}</strong> <span class="font-weight-300">{{ the_field('banner_items_headline','option') }}</span></h2>
        <p class="col-md-5 col-12 text-black font-weight-300">{{ the_field('banner_items_sub_headline','option') }}</p>
      </div>
    </div>
  </section>
  @endif
@endif


@endif

<style>
#search {
    position: relative;
    display: inline-block;
    height: 40px;
}
#search input[type="text"] {
  height: 40px;
  font-size: 14px;
  line-height: 16px;
  letter-spacing: 0.116946px;
  text-transform: capitalize;
  outline: none;
  color: #555;
  padding-right: 20px;
  width: 0;
  position: absolute;
  top: 0;
  right: 0;
  background: none;
  z-index: 3;
  transition: width .5s cubic-bezier(0.000, 0.795, 0.000, 1.000);
  cursor: pointer;
  border: 1px solid #E3E3E3;
  padding-left: 20px;
  border-radius: 54px;
}
#search input[type="text"]:focus {
  width: 300px;
  z-index: 1;
  cursor: text;
  background-color: #f8f9fa;
}
#search input[type="submit"] {
  height: 40px;
  width: 40px;
  display: inline-block;
  background: url('https://www.premast.test/app/themes/premast/dist/images/search.svg') center center no-repeat;
  text-indent: -10000px;
  border: none;
  position: absolute;
  top: 0;
  right: 0;
  z-index: 2;
  cursor: pointer;
  transition: opacity .4s ease;
}

#search input[type="submit"]:hover {
  opacity: 0.8;
}

.notification {
    position: relative;
    top: 2px;
    right: -7px;
}
.notification:hover i {
  animation: swingClapper 0.7s 0.04s cubic-bezier(0.455, 0.03, 0.515, 0.955);
}
span.notification-counter {
  background-color: #1E6DFB;
  width: 7px;
  height: 7px;
  border-radius: 100%;
  position: absolute;
  right: 3px;
  top: 1px;
  box-shadow: 0 0 1px 0px #333;
  animation: swingClapper 0.7s 0.04s cubic-bezier(0.455, 0.03, 0.515, 0.955);
}
@keyframes swingClapper {
  5% {
    transform: rotate(0deg) scale3d(1, 1, 1);
  }
  30% {
    transform: rotate(-8deg) scale3d(1.5, 1.5, 1.5);
  }
  80% {
    transform: rotate(8deg) scale3d(.9, .9, .9);
  }
}
</style>