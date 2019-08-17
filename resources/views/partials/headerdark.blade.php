@php 
  $refine   = isset($_GET['refine']) ? $_GET['refine'] : '0';
  $sort   = isset($_GET['sort']) ? $_GET['sort'] : '0';
  $taxonomy_query = get_queried_object();
  global $current_user;
  wp_get_current_user();
@endphp

<header class="bg-gray-dark banner">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-gray-dark">
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
          {!! wp_nav_menu(['theme_location' => 'templates_navigation', 'container' => false, 'menu_class' => 'navbar-nav ml-auto', 'walker' => new NavWalker()]) !!}
        @endif
      </div>
      <?php 
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
          $count = WC()->cart->cart_contents_count;
          ?>
            <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
          <?php if ( $count > 0 ) { ?>
            <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>    
          <?php } ?></a>
      <?php } ?>
      <div class="half">
        @if( is_user_logged_in() ) 
          <label for="profile" class="profile-dropdown">
            <input type="checkbox" id="profile">
            <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
            {!! get_the_author_meta('display_name', $current_user->ID) !!}
            <i class="fa fa-chevron-down text-primary" aria-hidden="true"></i>
            @include('partials/incloud/profile')
          </label>
        @else 
          <a class="mt-2 login text-primary" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a>
          <a class="mt-2 signup btn-primary" href="#" data-toggle="modal" data-target="#SignupUser">{{ _e('Sign Up', 'premast') }}</a>
        @endif
      </div>
    </nav>
  </div>
</header>