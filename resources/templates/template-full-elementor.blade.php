{{--
  Template Name: elementor Template
--}}

@extends('layouts.app-dark')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
  @endwhile
@endsection
