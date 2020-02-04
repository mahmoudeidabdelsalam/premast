{{--
  Template Name: Custom Header
--}}


@extends('layouts.app-custom')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
  @endwhile
@endsection
