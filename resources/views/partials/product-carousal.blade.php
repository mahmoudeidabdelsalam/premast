@php
    do_action('woocommerce_before_single_product_summary');
    $attachment_ids = $product->get_gallery_image_ids();
@endphp
@if ($attachment_ids)
    <div id="carouselExampleIndicators" class="carousel slide"
        data-ride="carousel">
        <div class="carousel-inner">
            @php $counter = 0; @endphp
            @foreach ($attachment_ids as $attachment_id)
                @php
                    $large = wp_get_attachment_image_url($attachment_id, 'medium_large');
                    $counter++;
                @endphp
                <div
                    class="carousel-item @if ($counter == 1) active @endif">
                    <a href="{{ $link }}/?more=fullScreen">
                        <img src="<?= $large ?>" class="d-block w-100 lazyload"
                            alt="slide">
                    </a>
                </div>
            @endforeach
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators"
            role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators"
            role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

        <ol class="carousel-indicators">
            @php $counter = -1; @endphp
            @foreach ($attachment_ids as $attachment_id)
                @php
                    $counter++;
                    $thumb = wp_get_attachment_image_url($attachment_id, 'thumbnail');
                @endphp
                @if ($counter <= 5)
                    <li data-target="#carouselExampleIndicators"
                        data-slide-to="<?= $counter ?>"
                        class="@if ($counter == 0)
active
@endif">
                        <img src="<?= $thumb ?>" class="d-block w-100 lazyload"
                            alt="slide">
                    </li>
                @endif
            @endforeach
            <li class="showMoreImg">
                <a
                    href="{{ $link }}/?more=fullScreen">{{ _e('Show More', 'premast') }}</a>
            </li>
        </ol>
    </div>
@else
    <img src="{{ Utilities::global_thumbnails(get_the_ID(), 'full') }}"
        class="card-img-top" alt="{{ the_title() }}">
@endif
@if (!wp_is_mobile())
    @if (get_field('slide_gallery'))
        <div class="embed-container">
            {{ the_field('slide_gallery') }}
        </div>
    @endif

    <div class="product-infomation">
        <h3>{{ _e('Description', 'premast') }}
        </h3>
        <div id="tab-description">
            @php the_content() @endphp</div>
    </div>
@endif
