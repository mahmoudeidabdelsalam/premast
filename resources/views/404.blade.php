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
