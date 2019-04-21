@php 
  $refine   = isset($_GET['refine']) ? $_GET['refine'] : '0';
  $sort   = isset($_GET['sort']) ? $_GET['sort'] : '0';
  $taxonomy_query = get_queried_object();
  global $wp;
@endphp

<header class="bg-gray banner">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-gray">
      <h2 class="logos">
        <a class="navbar-brand p-0 align-self-center col" href="{{ home_url('/') }}" title="{{ get_bloginfo('name') }}">
            <img class="img-fluid" src="@if(get_field('templates_logo', 'option')) {{ the_field('templates_logo','option') }} @else {{ get_theme_file_uri().'/dist/images/premast-templates.png' }} @endif" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
            <span class="sr-only"> {{ get_bloginfo('name') }} </span>
        </a>
      </h2>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <h2 class="sr-only">{{ _e('Breadcrumb navigation', 'premast') }}</h2>
        @if (has_nav_menu('templates_navigation'))
          {!! wp_nav_menu(['theme_location' => 'templates_navigation', 'container' => false, 'menu_class' => 'navbar-nav ml-auto', 'walker' => new NavWalker()]) !!}
        @endif
      </div>
    </nav>
  </div>
</header>

<section class="fixed-top-header bg-gray border-top border-secondary">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-6 col-sm-12 col-12">
        @php 
          $product_terms = get_terms( 'product_cat', array(
              'hide_empty' =>  1,
              'parent' =>0
          ) );
        @endphp
        <ul class="list-inline m-0 product-term">
          <li class="list-inline-item">
            <a class="text-term" href="{{ the_field('link_page_items', 'option') }}">{{ _e('All', 'premast') }}</a>
          </li>
          @foreach($product_terms as $product_term) 
          @php 
            $term_link = get_term_link( $product_term );
            if ( is_wp_error( $term_link ) ) {
                continue;
            }
          @endphp
            <li class="list-inline-item">
              <a class="text-term @if($product_term->term_id == $taxonomy_query->term_id) active @endif" href="{{ $term_link }}">{{ $product_term->name }}</a>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="col-md-3 col-sm-12 col-12 m-0 row justify-content-end align-items-center">
        <ul class="list-inline m-0 product-term">
          <li class="list-inline-item"><a class="product-grid text-silver" href="javascript:void(0);"></a></li>
          <li class="list-inline-item"><a class="product-list text-silver" href="javascript:void(0);"> </a></li>
        </ul>
        <div class="dropdown ml-4 mr-2">
          <a class="dropdown-sort text-silver" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if ($sort != '0')
              <i class="fa fa-angle-down" aria-hidden="true"></i> {{ _e('Sort by', 'premast') }} {{ $sort }}
            @else
              <i class="fa fa-angle-down" aria-hidden="true"></i> {{ _e('Sort by featured', 'premast') }}
            @endif
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{ home_url( $wp->request ) }}?sort=featured">{{ _e('featured', 'premast') }}</a>
            <a class="dropdown-item" href="{{ home_url( $wp->request ) }}?sort=view">{{ _e('view', 'premast') }}</a>
            <a class="dropdown-item" href="{{ home_url( $wp->request ) }}?sort=date">{{ _e('date', 'premast') }}</a>
            <a class="dropdown-item" href="{{ home_url( $wp->request ) }}?sort=download">{{ _e('Download', 'premast') }}</a>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-12 col-12">
        <form role="search" method="get" id="searchform" action="{{ home_url( $wp->request ) }}">
          <input id="autoblogs" class="form-control w-100" type="search" value="@if($refine != '0') {!! $refine !!} @endif" name="refine" autocomplete="on" autocorrect="off" autocapitalize="on" spellcheck="false" placeholder="{{ _e('Search items', 'premast') }}" aria-label="Search">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </div>
  </div>
</section>

@if (get_field('banner_items_headline', 'option'))
<section class="banner-items pt-5 pb-4 mb-5" style="background-image: linear-gradient(150deg, {{ the_field('gradient_color_one','option') }} 0%, {{ the_field('gradient_color_two','option') }} 100%);">
  <div class="elementor-background-overlay" style="background-image: url('{{ the_field('banner_background_overlay','option') }}');"></div>
  <div class="container">
    <div class="row justify-content-center align-items-center text-center">
      <h2 class="col-12 text-white"><strong class="font-weight-600">{{ _e('Discover +97', 'premast') }}</strong> <span class="font-weight-300">{{ the_field('banner_items_headline','option') }}</span></h2>
      <p class="col-12 text-white font-weight-300">{{ the_field('banner_items_sub_headline','option') }}</p>
    </div>
  </div>
</section>
@endif

<script>
  jQuery(function($) {
    $('.product-grid').click(function(){
      $('.item-card').show(300);
      $('.item-card .bg-white').css("height", "300px");
      $('.item-card .bg-white').addClass('bg-images');

      $('.grid').masonry({
        itemSelector: '.grid-item',
      });
    });

    $('.product-list').click(function(){
      $('.item-card').show(300);
      $('.item-card .bg-white').css("height", "auto");
      $('.item-card .bg-white').removeClass('bg-images');

      $('.grid').masonry({
        itemSelector: '.grid-item',
      });
    });
  });
</script>