@php 
  $refine   = isset($_GET['refine']) ? $_GET['refine'] : '0';
  $sort   = isset($_GET['sort']) ? $_GET['sort'] : '0';
  $taxonomy_query = get_queried_object();
  global $wp;

  $account_id = get_option( 'woocommerce_myaccount_page_id' );
  $link_login = get_field('link_page_login', 'option');

  if ( $account_id ) {
    $account_url = get_permalink( $account_id );
    $logout_url = wp_logout_url( home_url() );
  }

@endphp

<header class="bg-gray-dark banner">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-gray-dark">
      <h2 class="logos">
        <a class="navbar-brand p-0 align-self-center col" href="{{ home_url('/') }}" title="{{ get_bloginfo('name') }}">
            <img class="img-fluid" src="@if(get_field('website_logo', 'option')) {{ the_field('website_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/premast-templates.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
            <span class="sr-only"> {{ get_bloginfo('name') }} </span>
        </a>
      </h2>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <h2 class="sr-only">{{ _e('Breadcrumb navigation', 'premast') }}</h2>
        @if (has_nav_menu('templates_navigation'))
          {!! wp_nav_menu(['theme_location' => 'templates_navigation', 'container' => false, 'menu_class' => 'navbar-nav ml-auto', 'walker' => new NavWalker()]) !!}
        @endif
      </div>
      <div class="half">
        <label for="profile" class="profile-dropdown">
          <input type="checkbox" id="profile">
          <i class="fa fa-user-circle-o text-white" aria-hidden="true"></i>
          @if ( is_user_logged_in() ) 
            <ul class="link-dropdown">
              <li class="item-dropdown"><a href="{{ $account_url }}"><i class="fa fa-tachometer"></i>{{ _e('Dashborad', 'premast') }}</a></li>
              <li class="item-dropdown"><a href="{{ $account_url }}/orders"><i class="fa fa-shopping-basket"></i>{{ _e('Orders', 'premast') }}</a></li>
              <li class="item-dropdown"><a href="{{ $account_url }}/downloads"><i class="fa fa-file-archive-o"></i>{{ _e('Downloads', 'premast') }}</a></li>
              <li class="item-dropdown"><a href="{{ $account_url }}/edit-address"><i class="fa fa-home"></i>{{ _e('Address', 'premast') }}</a></li>
              <li class="item-dropdown"><a href="{{ $account_url }}/edit-account"><i class="fa fa-user"></i>{{ _e('Account', 'premast') }}</a></li>
              <li class="item-dropdown"><a href="{{ $logout_url }}"><i class="fa fa-sign-out"></i>{{ _e('Logout', 'premast') }}</a></li>
            </ul>
          @else 
            <ul class="link-dropdown">
              <li class="item-dropdown"><a href="{{ $link_login }}"><i class="fa fa-tachometer"></i>{{ _e('Log In', 'premast') }}</a></li>
            </ul>
          @endif
        </label>
      </div>
    </nav>
  </div>
</header>
