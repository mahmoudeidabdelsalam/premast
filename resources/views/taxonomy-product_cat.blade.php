{{--
  Template Name: Items Template
--}}

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
    <div class="col-md-2 col-sm-12">
      <div class="product-child">
        <h2>{{ _e('Select design type', 'premast') }}</h2>
        @php 
          $product_child= get_terms( 'product_cat', array(
              'hide_empty' =>  1,
              'parent' => 0
          ) );
        @endphp

        <ul class="list-group m-0 product-term">
          @foreach($product_child as $product_term) 
          @php 
            $terms = get_terms( 'product_cat', array( 'parent' => $product_term->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
          @endphp
            @foreach ( $terms as $term )
            @php
                $term_link = get_term_link( $term );
                if ( is_wp_error( $term_link ) ) {
                    continue;
                }
              @endphp
              <li class="list-group-item">
                <a class="text-term @if($term->term_id == $taxonomy_query->term_id) active @endif" href="{{ $term_link }}">{{ $term->name }}</a>
              </li>
            @endforeach
          @endforeach
        </ul>
      </div>
    </div>

    <div class="col-md-10 col-sm-12">
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

            <div class="item-card col-md-3 col-sm-12 grid-item p-2">
              <div class="card">
                <div class="bg-white" style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(),'full')}})">
                  <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="card-img-top" alt="{{ the_title() }}">
                </div>
                <div class="card-body">
                  <a class="card-link" href="{{ the_permalink() }}">
                    <p>{{ _e('Download', 'premast') }}</p>
                    <h5 class="card-title font-weight-bold text-white">{{ the_title() }}</h5>
                  </a>
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
