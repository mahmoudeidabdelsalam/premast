{{--
  Template Name: Template with out header 
--}}

@extends('layouts.app-elementor')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
  @endwhile
@endsection
