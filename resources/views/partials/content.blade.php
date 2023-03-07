{{-- bootstrap article card --}}

<div class="card mb-3">
    <img class="card-img-top" src="{{ the_post_thumbnail_url('large') }}"
        alt="{{ get_the_title() }}">
    <div class="card-body">
        <h5 class="card-title text-truncate-title">
            {{ html_entity_decode(get_the_title()) }}
        </h5>
        <p class="card-text text-truncate-body">
            {{ html_entity_decode(get_the_excerpt()) }}
        </p>
    </div>
</div>

<style>
    .text-truncate-title {
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        display: -webkit-box;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .text-truncate-body {
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        display: -webkit-box;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
