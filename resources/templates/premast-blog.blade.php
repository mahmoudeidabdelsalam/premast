{{--
  Template Name: premast blog
  Template Post Type: post
--}}

@extends('layouts.premast-main')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
  @endwhile
@endsection