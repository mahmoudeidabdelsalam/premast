{{-- 
  Template Name: premast main blank
--}}

@extends('layouts.premast-main')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
  @endwhile
@endsection
