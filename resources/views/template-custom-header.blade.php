{{--
  Template Name: With Header Template
--}}


@extends('layouts.template-custom')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
  @endwhile
@endsection
