{{--
  Template Name: Blogs
--}}

@extends('layouts.app')

@section('content')

@while(have_posts()) @php the_post() @endphp
  @php $thumbnal = get_the_post_thumbnail_url(get_the_ID(), 'full') @endphp
  <div class="custom-header">
    <div class="container blogs">
      <div class="row">
        <div class="elementor-background-overlay" style="background-image:url('{{ the_field('header_section_image', 'option') }}')"></div>
        <div class="col-12 p-0">
          <h1 class="text-left">{{ the_title() }}</h1>
        </div>        
        <div class="col-md-6 col-12 p-0 text-white">
          @php the_content() @endphp
        </div>
        <div class=" position-relative col-12">
          <div class="bg-blogs" style="background-image:url(@if($thumbnal) {{ $thumbnal }} @else {{ get_theme_file_uri().'/dist/images/bg-blog.png' }} @endif)"></div>    
        </div>        
      </div>
    </div>
  </div>
@endwhile

  <div class="container blogs">
    <div class="row">

      @php
      $posts = App::post_loop('post', '3', 'full', '1', '15');
      @endphp

        
      <div class="col-12">
        <h2>{{ _e('Latest on the blog', 'premast') }}</h2>
      </div>

     <div class="col-md-12 col-sm-12">
        <div class="item-columns grid row m-0 container-ajax">
          @foreach($posts as $blog)
            @php
              $terms = wp_get_object_terms($blog['id'], 'category', array('parent'=>'0'));
              foreach($terms as $term) {
                $link = get_term_link($term->term_id);
              }
            @endphp

            <div class="item-blog col-md-4 col-sm-4 col-sx-6 col-12 grid-item pl-4 pr-4 post-ajax">
              <div class="card p-0">
                <div class="bg-images" style="background-image:url('{{ $blog['image'] }}');border-radius: 9px;height: 208px; min-height: 208px;">
                  <img src="{{ $blog['image'] }}" class="card-img-top" alt="{{ $blog['title'] }}">
                  <div class="card-overlay"><a class="the_permalink" href="{{ $blog['url'] }}"></a></div>
                </div>
                <div class="card-body pt-2 pl-0 pr-0 pb-0">
                  <p class="label mb-0">
                    @if ($terms)
                      @foreach ($terms as $category)
                      <small class="text-primary">
                        {{ $category->name }}
                      </small>
                      @endforeach
                    @endif
                    <time class="text-dark"> - {{ $blog['date'] }}</time>
                  </p>
                  <a class="card-link" href="{{ $blog['url'] }}">
                    <h5 class="card-title">{{ $blog['title']}}</h5>
                  </a>
                  <p class="card-text">
                    {!! $blog['excerpt'] !!}
                  </p>
                </div>
              </div>              
            </div>
            @endforeach
          @php (wp_reset_postdata())
        </div>
      </div>



      <div class="col-12">
        <h2>{{ _e('Blog articles', 'premast') }}</h2>
      </div>
      <div class="col-md-12 col-sm-12">
        <div class="item-columns grid row m-0 container-ajax">
          @if($blogs_loop->have_posts())
            @while($blogs_loop->have_posts()) @php($blogs_loop->the_post())
            @php ($categories = wp_get_post_terms(get_the_ID(), 'category', 'hide_empty=0'))
              <div class="item-blog col-md-4 col-sm-4 col-sx-6 col-12 grid-item pl-4 pr-4 post-ajax">
                <div class="card p-0">
                  <div class="bg-images" style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(),'full')}}');border-radius: 9px;height: 208px; min-height: 208px;">
                    <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="card-img-top" alt="{{ the_title() }}">
                    <div class="card-overlay"><a class="the_permalink" href="{{ the_permalink() }}"></a></div>
                  </div>
                  <div class="card-body pt-2 pl-0 pr-0 pb-0">
                    <p class="label mb-0">
                      @if ($categories)
                        @foreach ($categories as $category)
                        <small class="text-primary">
                          {{ $category->name }}
                        </small>
                        @endforeach
                      @endif
                      <time class="text-dark"> - {{ the_time('d M, Y') }}</time>
                    </p>
                    <a class="card-link" href="{{ the_permalink() }}">
                      <h5 class="card-title">{{ the_title() }}</h5>
                    </a>
                    <p class="card-text">
                      {!! wp_trim_words(get_the_content(), 15, ' ...') !!}
                    </p>
                  </div>
                </div>              
              </div>
            @endwhile
          @else
            <div class="col-12">
              {{ __('Sorry, no results were found.', 'sage') }}
            </div>
          @endif
          @php (wp_reset_postdata())
        </div>

        <div class="col-12 pt-5 pb-5">
          <nav aria-label="Page navigation example">{{ premast_base_pagination(array(), $blogs_loop) }}</nav>
        </div>
      </div>      
    </div>
  </div>

<style>
body.template-blog {
  background: #EFF6FA;
}
.item-blog .card {
  background: transparent !important;
  border: none;
  box-shadow: none !important;
}
.item-blog .card  p.label time {
  font-size: 13px;
  line-height: 15px;
  letter-spacing: 0.132987px;
  text-transform: capitalize;
  color: #000000;
  opacity: 0.5;
}
.item-blog .card h5.card-title {
  font-weight: bold;
  font-size: 18px;
  line-height: 21px;
  letter-spacing: 0.132987px;
  text-transform: capitalize;
  color: #282F39;
  margin: 8px 0;
}
.item-blog .card  p.card-text {
  font-size: 14px;
  line-height: 129.19%;
  letter-spacing: 0.132987px;
  color: #000000;
  opacity: 0.5;
}
.bg-blogs {
  position: absolute;
  right: 0;
  width: 390px;
  height: 332px;
  top: -150px;
}
body.template-blog .custom-header {
  margin-bottom: 150px;
}
body.template-blog h2 {
  font-weight: bold;
  font-size: 40px;
  line-height: 47px;
  letter-spacing: 0.132987px;
  color: #3D4552;
  padding: 0 30px 20px;
}
</style>
@endsection
