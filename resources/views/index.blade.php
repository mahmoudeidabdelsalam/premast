@extends('layouts.app')

@section('content')

@if ($welcome_home)
<section>
  <div class="welcome background-center" style="background-image:url('{{$welcome_home['background']}}');">
    <div class="background-overlay"></div>
    <div class="container">
      <div class="row align-items-center height-vh-80">
        <div class="col-md-6 col-sm-12 wow bounceInUp"  data-wow-duration="1s" data-wow-delay=".5s">
          <h2 class="text-large text-white">{{$welcome_home['headline']}}</h2>
          <p class="text-white text-medium">{{$welcome_home['description']}}</p>
          <a class="btn btn-green text-small" href="{{$welcome_home['link']}}">{{ _e('Get started', 'premast') }} <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
        </div>
        <div class="col-md-6 col-sm-12 wow bounceInUp"  data-wow-duration="1s" data-wow-delay="1s">
          <img src="{{$welcome_home['image']}}" alt="{{ get_bloginfo('name') }}" title="{{ get_bloginfo('name') }}">
        </div>
      </div>
    </div>
  </div>
</section>
@endif


@endsection
