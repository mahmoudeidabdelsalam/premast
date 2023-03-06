@extends('layouts.app-404')

@section('content')
<div class="page-404">
  <header class="banner-404">
    <div class="container p-0">
      <h2 class="logos mr-auto">
        <a class="navbar-brand p-0 align-self-center col" href="{{ the_field('link_page_login','option') }}" title="{{ get_bloginfo('name') }}">
          <img class="img-fluid" src="@if(get_field('templates_logo', 'option')) {{ the_field('templates_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/premast-templates.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}" />
          <span class="sr-only"> {{ get_bloginfo('url') }} </span>
        </a>
      </h2>
    </div>
  </header>

  <img class="img-404" src="{{ get_theme_file_uri().'/resources/assets/images/404.svg' }}" alt="404">

  <p>Seems like the page your looking for is no longer available..</p>
  <a class="btn btn-primary" href="{{ get_bloginfo('url') }}">Go to Homepage</a>

</div>

<style>
  .page-404 {
    background-image: url("{{ get_theme_file_uri().'/resources/assets/images/bg-404.svg' }}");
    background-repeat: no-repeat;
    background-position: top center;
    padding: 15px;
  }

  header.banner-404 {
    margin-bottom: 120px;
  }
  
  img.img-404 {
    margin: auto;
    display: block;
    max-width: 100%;
  }

  .page-404 p, .page-404 .btn {
    margin: 40px auto;
    display: block;
    text-align: center;
  }

  .page-404 .btn {
    width: 200px;
    box-shadow: none;
  }  
</style>
@endsection
