@extends('layouts.app')
@section('content')
    @if (
        !function_exists('elementor_theme_do_location') ||
            !elementor_theme_do_location('single'))
        @include('partials.content-single-' . get_post_type())
    @endif
    @include('partials.comments')
@endsection
