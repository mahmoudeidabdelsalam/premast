{{--
  Template Name: Template elementor blank
--}}

@extends('layouts.app-blank')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
  @endwhile
@endsection
