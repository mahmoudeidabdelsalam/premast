@php 
  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
  $Name   = isset($_GET['refine']) ? $_GET['refine'] : '0';
  $sort   = isset($_GET['sort']) ? $_GET['sort'] : '0';
  
  if ( $sort == 'date' ):
    $orderby = 'date';
    $order = 'DESC';
    $meta_key = '';
  elseif( $sort == 'view') :
    $orderby = 'meta_value_num';
    $order = 'DESC';
    $meta_key = 'c95_post_views_count';
  elseif ( $sort == 'download' ):
    $orderby = 'meta_value';
    $order = 'DESC';
    $meta_key = '';
  else :
    $orderby = 'date';
    $order = 'DESC';
    $meta_key = '';
  endif;
  
  $taxonomy_query = get_queried_object();

@endphp

@extends('layouts.template-items')

@section('content')


<div class="container-fiuld">
  <div class="row justify-content-center m-0">
    
    <div class="col-md-3 col-sm-12">
      <div class="product-child">
        <h2><i class="fa fa-align-right" aria-hidden="true"></i> {{ _e('Category', 'premast') }}</h2>

        <ul class="list-group product-term">
          <li class="list-group-item">
            <a class="text-term text-white" href="#">{{ _e('All Categories', 'premast') }} <span class="count-term">{{ $taxonomy_query->count }}</span></a>
          </li>

          @php 
            $terms = get_terms( 'product_cat', array( 'parent' => $taxonomy_query->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
          @endphp
          @foreach ( $terms as $term )
            @php
              $term_link = get_term_link( $term );
              if ( is_wp_error( $term_link ) ) {
                  continue;
              }
            @endphp
            <li class="list-group-item">
              <a class="text-term @if($term->term_id == $taxonomy_query->term_id) active @endif" href="{{ $term_link }}">{{ $term->name }} <span class="count-term">{{ $term->count }}</span></a>
            </li>
          @endforeach

        </ul>
      </div>
    </div>

    <div class="col-md-9 col-sm-12">
      <div class="item-columns grid row m-0">
        @php
          $args = array(
            'post_type' => 'product',
            'posts_per_page' => 20,
            'paged' => $paged,
            'meta_key' => $meta_key,
            'orderby' => $orderby,
            'order' => $order,
            'tax_query' => array(
              array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $taxonomy_query->term_id
              )
            )
          );

          if($Name != '0') {
            $args['s'] = $Name;
          }
          
          $loop = new WP_Query( $args );

        @endphp

        @if($loop->have_posts())
          @while($loop->have_posts()) @php($loop->the_post())

            <div class="item-card col-md-4 col-sm-4 col-sx-6 col-12 grid-item pl-4 pr-4">
              <div class="card">
                <div class="bg-white bg-images" style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(),'full')}}'); height: 300px;">
                  <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="card-img-top" alt="{{ the_title() }}">
                  <div class="card-overlay">
                    <a class="card-link" href="{{ the_permalink() }}">
                      <p>{{ _e('Download Now', 'premast') }}</p>
                    </a>
                  </div>
                </div>
                <div class="card-body pt-2 pl-0 pr-0">
                  <a class="card-link" href="{{ the_permalink() }}">
                    <h5 class="card-title font-weight-400">{{ wp_trim_words(get_the_title(), '4', ' ...') }}</h5>
                  </a>
                  <div class="review-and-download">
                    <div class="review">
                      @if (get_option('woocommerce_enable_review_rating' ) == 'yes') 
                        <?php 
                          global $product;
                          $rating_count = method_exists($product, 'get_rating_count')   ? $product->get_rating_count()   : 1;
                          $review_count = method_exists($product, 'get_review_count')   ? $product->get_review_count()   : 1;
                          $average      = method_exists($product, 'get_average_rating') ? $product->get_average_rating() : 0;
                        ?>
                        @if ($rating_count > 0)
                          {!! wc_get_rating_html($average, $rating_count) !!}
                          <span itemprop="reviewCount">{{ $review_count }} {{ _e('review', 'premast') }}</span>
                        @else 
                          {!! wc_get_rating_html('1', '5') !!}
                          <span itemprop="reviewCount">{{ _e('0 review', 'premast') }}</span>
                        @endif
                      @endif
                    </div>
                    <div class="download">
                      <span>{{ _e('Downloads', 'premast') }}</span>
                    </div>
                  </div>
                </div>
              </div>              
            </div>
          @endwhile
        @endif
        @php (wp_reset_postdata())

      </div>

      <div class="col-12">
        <nav aria-label="Page navigation example">{{ premast_base_pagination(array(), $loop) }}</nav>
      </div>

    </div>

  </div>
</div>

@endsection
