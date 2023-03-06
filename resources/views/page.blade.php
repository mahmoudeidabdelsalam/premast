@extends('layouts.app')
<h1>page.blade.php</h1>

@section('content')
    @while (have_posts())
        @php the_post() @endphp
        @include('partials.content-page')
    @endwhile
@endsection
