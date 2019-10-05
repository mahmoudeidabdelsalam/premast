@extends('layouts.app')

@section('content')

  @while(have_posts()) @php the_post() @endphp
  @php 
    $categories = wp_get_post_terms(get_the_ID(), 'category', 'hide_empty=0');
    $user_name = get_the_author_meta('display_name');
    $author_id = get_the_author_meta('ID');

    $author_description = get_the_author_meta('description');

    $author_photo = get_field('user_photo', 'user_'. $author_id);
    $author_facebook = get_field('facebook_user', 'user_'. $author_id);
    $author_twitter = get_field('twitter_user', 'user_'. $author_id);
    $author_linkedin = get_field('linkedin_user', 'user_'. $author_id);
  @endphp


    <section class="theme-fixed blogs mt-5 pt-5">

      <div class="header-single">
        <div class="container">
          <div class="row">
            <!-- Head Information -->
            <div class="col-md-12 col-12 row m-0">
              <div class="head col-md-6 col-12 p-0">
                <p class="label label-term mb-0">
                  @if ($categories)
                    @foreach ($categories as $category)
                      {{ $category->name }}
                    @endforeach
                  @endif
                  @if(get_field('time_read_article'))<time class="text-light">| {{ the_field('time_read_article') }}</time>@endif
                </p>
                <h1 class="mt-2">{{ the_title() }}</h1>
              </div>
              <div class="user-info col-12 p-0">
                @if($user_name)
                  <i class="fa fa-pencil" aria-hidden="true"></i> {{ _e('By:', 'premast') }} {{ $user_name }}
                @endif
              </div>
              <div class="date-info col-12 p-0">
                <time>{{ the_time('d M, Y') }}  </time> @if(get_field('time_read_blog'))<time> - {{ the_field('time_read_blog') }}</time>@endif
              </div>
            </div>


            <!-- img Information -->
            <div class="col-md-8 col-12">
              <div class="elements-share">
                @include('partials/share-meta')
              </div>

              @php
                $thumb_id = get_post_thumbnail_id();
                $thumb_array = wp_get_attachment_image_src($thumb_id, 'full');
                $thumb_url = $thumb_array[0];
              @endphp
              @if(!empty($thumb_url))
                <img src="{{ $thumb_url }}" alt="{{ the_title() }}" class="img-fluid img-post wp-post-thumbnail">
              @endif

              <div class="description">  
                {{ the_content() }}
              </div>

              @include('partials/comments')
            </div>

            <div class="col-md-4 col-12">
              @if($related_post->have_posts())
                <div class="related-single">
                  <h3 class="headline-related col-12">{{ _e('related Posts', 'premast') }}</h3>
                  <ul class="list-unstyled">
                  @while($related_post->have_posts()) @php $related_post->the_post() @endphp
                    <li class="media">
                      <img src="{{ Utilities::global_thumbnails(get_the_ID(),'thumbnail')}}" class="mr-3" alt="{!! get_the_title() !!}<">
                      <div class="media-body">
                        <a class="card-link" href="{{ the_permalink() }}">
                          <h5 class="card-title">{!! get_the_title() !!}</h5>
                        </a>
                        {!! wp_trim_words(get_the_content(), 8, ' ...') !!}
                      </div>
                    </li>
                  @endwhile
                  @php(wp_reset_postdata())
                  </ul>
                </div>
              @endif
            </div>


          </div>
        </div>
      </div>
    </section>
  @endwhile
@endsection


<style>
  body.single-post {
  background: #EFF6FA;
}
.user-info {
    font-size: 16px;
    line-height: 125.19%;
    letter-spacing: 0.132987px;
    text-transform: capitalize;
    color: #1E6DFB;
    padding: -0;
    margin-bottom: 20px;
}
.label-term {
    font-size: 16px;
    line-height: 125.19%;
    letter-spacing: 0.132987px;
    text-transform: capitalize;
    color: #1E6DFB;
}
.head h1 {
    font-weight: bold;
    font-size: 40px;
    line-height: 50px;
    letter-spacing: 0.132987px;
    text-transform: capitalize;
    color: #3D4552;
}
.date-info time {
    font-size: 16px;
    line-height: 125.19%;
    letter-spacing: 0.132987px;
    text-transform: capitalize;
    color: rgba(0, 0, 0, 0.4);
}
.wp-post-thumbnail {
    border-radius: 8px;
    margin: 40px 0 24px !important;
}

#wpcomm .wc-field-textarea .wpdiscuz-textarea-wrap {
    background: #fff;
    border: none;
}
#wpcomm .avatar {
    border-radius: 100% !important;
}
#wpcomm .wc-comment .wc-comment-right {
    background: #FFFFFF;
    box-shadow: 0px 2px 4px #D5EDFA;
    border-radius: 8px;
}
#wpcomm .wc-comment-header {
    border: none;
}
.related-single .media img {
    border-radius: 5px;
    width: 100px;
}

.related-single .media {
    background-color: #fff;
    margin-bottom: 10px;
    box-shadow: 0px 2px 4px #D5EDFA;
    border-radius: 8px;
    padding: 10px;
}
.related-single li.media .card-title {
    font-size: 16px;
    line-height: 136.69%;
    letter-spacing: 0.132987px;
    text-transform: capitalize;
    color: #3D4552 !important;
}

h3.headline-related {
    font-weight: bold;
    font-size: 24px;
    line-height: 125.19%;
    letter-spacing: 0.132987px;
    text-transform: capitalize;
    color: #3D4552;
    padding: 0;
}
.elements-share p {
    font-size: 13px;
    line-height: 125.19%;
    letter-spacing: 0.132987px;
    text-transform: capitalize;
    color: rgba(0, 0, 0, 0.4);
}

.elements-share {
    position: absolute;
    left: -100px;
    text-align: center;
}

.elements-share .sharing-buttons {
    background: #FFFFFF;
    box-shadow: 0px 2px 4px #D5EDFA;
    width: 40px;
    height: 40px;
    border-radius: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 10px;
    color: #1E6DFB;
}
</style>