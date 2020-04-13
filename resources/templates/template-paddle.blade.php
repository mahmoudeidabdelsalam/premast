{{--
  Template Name: paddle Template
--}}

@extends('layouts.app-blank')

@section('content')
  @while(have_posts()) @php the_post() @endphp
  
  
  
  @endwhile
@endsection
