@if(get_field('offer_head_text', 'option'))
@php
$time = get_the_time('Y-m-d')
@endphp
  @if($time > isset($_COOKIE['the_last_view']))
    <div class="col-offer" style="background-color:{{ the_field('head_background_color', 'option') }}">
      <div class="container">
        <div class="row justify-content-center align-content-center p-3">
          <p class="text-center m-0">{{ the_field('offer_head_text', 'option') }} <a href="{{ the_field('head_offer_link', 'option') }}">{{ the_field('head_link_text', 'option') }}</a></p>
        </div>
      </div>
      <a href="javascript:void(0)" class="closeBanner" id="CloseBanner"><i class="fa fa-times" aria-hidden="true"></i></a>
    </div>
  @endif
@endif

@include('partials.header.pmst-template')




@php
  $taxonomy_query = get_queried_object();
@endphp
  @if ( !is_singular('product') )
    @php
      $count = $taxonomy_query->count;
    @endphp
    @if(is_tax( 'product_cat' ))
      @php
        $term = get_queried_object();
        $image = get_field('images_cat', $term);
        $heading = get_field('heading_cat', $term);
        $description = get_field('description_cat', $term);
        $calculation = get_field('number_slide', $term);
        $text_total = get_field('text_total', $term);
        $color_one = get_field('gradient_color_one_cat', $term);
        $color_two = get_field('gradient_color_two_cat', $term);
      @endphp
        @if ($heading)
          <section class="banner-items" style="background: linear-gradient(105deg, {{ $color_one }} 0.7%, {{ $color_two }} 100%);">
            <div class="elementor-background-overlay-items" style="background-image: url('{{ $image }}');"></div>
            <div class="container-fluid">
              <div class="row align-items-center text-center justify-content-center">
                <h1 class="col-12 text-black">{{ $heading }}</h1>
                <p class="col-md-8 col-12 text-black font-weight-300">{{ $description }}</p>
              </div>
            </div>
          </section>
        @else
          @if($taxonomy_query->parent)
            @php
              $term = get_term_by( 'id', $taxonomy_query->parent, 'product_cat' );
              $image = get_field('images_cat', $term);
              $heading = get_field('heading_cat', $term);
              $description = get_field('description_cat', $term);
              $calculation = get_field('number_slide', $term);
              $text_total = get_field('text_total', $term);
              $color_one = get_field('gradient_color_one_cat', $term);
              $color_two = get_field('gradient_color_two_cat', $term);
            @endphp
            <section class="banner-items" style="background: linear-gradient(105deg, {{ $color_one }} 0.7%, {{ $color_two }} 100%);">
              <div class="elementor-background-overlay-items" style="background-image: url('{{ $image }}');"></div>
              <div class="container-fluid">
                <div class="row align-items-center text-center justify-content-center">
                  <h1 class="col-12 text-black">{{ $heading }}</h1>
                  <p class="col-md-8 col-12 text-black font-weight-300">{{ $description }}</p>
                </div>
              </div>
            </section>
          @else
            <section class="banner-items" style="background: linear-gradient(105deg, {{ the_field('gradient_color_one_cat','option') }} 0.7%, {{ the_field('gradient_color_two_cat','option') }} 100%);">
              <div class="elementor-background-overlay-items" style="background-image: url('{{ the_field('banner_background_overlay_cat','option') }}');"></div>
              <div class="container-fluid">
                <div class="row align-items-center text-center justify-content-center">
                  <h2 class="col-12 text-black"><strong class="font-weight-600">{{ _e('Discover', 'premast') }} +{{  ($calculation)? $calculation*$count:$count }}</strong> <span class="font-weight-300">{{ the_field('banner_items_headline','option') }}</span></h2>
                  <p class="col-md-8 col-12 text-black font-weight-300">{{ the_field('banner_items_sub_headline','option') }}</p>
                </div>
              </div>
            </section>
          @endif
        @endif
    @else
      @if (get_field('banner_items_headline', 'option'))
      <section class="banner-items" style="background: linear-gradient(105deg, {{ the_field('gradient_color_one_cat','option') }} 0.7%, {{ the_field('gradient_color_two_cat','option') }} 100%);">
        <div class="elementor-background-overlay-items" style="background-image: url('{{ the_field('banner_background_overlay_cat','option') }}');"></div>
        <div class="container-fluid">
          <div class="row align-items-center text-center justify-content-center">
            <h2 class="col-12 text-black"><strong class="font-weight-600">{{ _e('Discover', 'premast') }} +{{  ($calculation)? $calculation*$count:$count }}</strong> <span class="font-weight-300">{{ the_field('banner_items_headline','option') }}</span></h2>
            <p class="col-md-8 col-12 text-black font-weight-300">{{ the_field('banner_items_sub_headline','option') }}</p>
          </div>
        </div>
      </section>
      @endif
    @endif

  @endif




<div id="ProgressBar"></div>


<style>
  div#ProgressBar {
    position: fixed;
    top: -6px;
    z-index: 999999999;
    width: 100%;
    height: 14px;
    overflow: hidden;
  }
  .admin-bar div#ProgressBar {
    top: 24px;
  }
    profile-dropdown .link-dropdown .item-dropdown a, .profile-dropdown .link-dropdown .item-dropdown .item-user {
    font-family:'Roboto' , sans-serif;
  }
  .premast-social-icons {
    background-color:#282F39;
  }
  section.banner-items {
    margin: unset;
}

</style>
