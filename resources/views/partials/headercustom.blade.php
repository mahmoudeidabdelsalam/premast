@php 
  $refine   = isset($_GET['refine']) ? $_GET['refine'] : '0';
  $sort   = isset($_GET['sort']) ? $_GET['sort'] : '0';
  $taxonomy_query = get_queried_object();
@endphp

<header class="bg-gray-dark banner">
  <div class="container-fluid">
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
          @include('partials/incloud/profile')
        </label>
      </div>
    </nav>
  </div>
</header>
