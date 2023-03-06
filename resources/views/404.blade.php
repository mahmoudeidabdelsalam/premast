@extends('layouts.app-404')

@section('content')
   <div class="page-404">
      <div class="container">
         <img class="img-404" src="{{ get_theme_file_uri() . '/resources/assets/images/404.svg' }}"
              alt="404">

         <p>Seems like the page your looking for is no longer available..</p>
         <a class="btn btn-primary" href="{{ get_bloginfo('url') }}">Go to Homepage</a>
      </div>

   </div>

   <style>
      .page-404 {
         background-image: url("{{ get_theme_file_uri() . '/resources/assets/images/bg-404.svg' }}");
         background-repeat: no-repeat;
         background-position: top center;
         background-size: 100%;
         padding: 15px;
         min-height: 100vh;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: baseline;
      }

      header.banner-404 {
         margin-bottom: 120px;
      }

      img.img-404 {
         margin: auto;
         display: block;
         max-width: 100%;
      }

      .page-404 p,
      .page-404 .btn {
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
