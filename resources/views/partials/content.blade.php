@if (
    !function_exists('elementor_theme_do_location') ||
        !elementor_theme_do_location('archive'))
    <article @php post_class() @endphp>
        <header>
            <h2 class="entry-title"><a
                    href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
            @include('partials/entry-meta')
        </header>
        <div class="entry-summary">
            @php the_excerpt() @endphp
        </div>
    </article>
@endif
