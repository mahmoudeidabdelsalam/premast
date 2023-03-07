@extends('layouts.app')
@section('content')
    @if (
        !function_exists('elementor_theme_do_location') ||
            !elementor_theme_do_location('archive'))
        {{-- body container --}}
        <div class="container-xxl py-5 px-2 px-md-5 px-sm-3 bg-white">
            {{-- posts grid --}}
            @if (!have_posts())
                <div class="alert alert-warning">
                    {{ __('Sorry, no results were found.', 'sage') }}
                </div>
                {!! get_search_form(false) !!}
            @endif

            {{-- posts grid --}}
            <div class="row">
                @while (have_posts())
                    @php the_post() @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        @include('partials.content-' . get_post_type())
                    </div>
                @endwhile
            </div>

            {{-- pagination --}}
            <div class="d-flex justify-content-center">
                {!! the_posts_pagination() !!}
            </div>
        </div>
    @endif
@endsection
