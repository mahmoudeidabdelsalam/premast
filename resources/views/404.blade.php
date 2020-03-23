<?php 
$reset   = isset($_GET['show-reset-form']) ? $_GET['show-reset-form'] : '0';

if($reset == true) {
  wp_redirect( home_url() );
  exit();
}
?>
@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
  @while(have_posts()) @php the_post() @endphp
    <div class="alert alert-warning">
      {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endwhile
  @endif
@endsection
