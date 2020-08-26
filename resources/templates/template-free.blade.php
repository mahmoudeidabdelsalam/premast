{{--
  Template Name: Free items Template
--}}

@extends('layouts.app-dark')

@section('content')
  
  <section id="banner" style="background:linear-gradient(141.33deg, #1FA2FF -4.21%, #274FDB 135.73%);">
    <div class="container">
      <div class="row align-items-center text-center justify-content-center">
        <div class="col-md-8 col-sm-12 col-12 contentBanner">
          <h2>{{ _e('Download 500+ free items', 'premast') }}</h2>
          <p>{{ _e('We offer a wide range of free items to our premast users in every category.', 'premast') }}</p>
        </div>
      </div>
    </div>

    <select class="selectCat">
      @php 
        $ids_to_exclude = array();
        $get_terms_to_exclude =  get_terms(
          array(
            'fields'  => 'ids',
            'slug'    => array( 'plans', 'bundles' ),
            'taxonomy' => 'product_cat',
          )
        );
        if( !is_wp_error( $get_terms_to_exclude ) && count($get_terms_to_exclude) > 0){
            $ids_to_exclude = $get_terms_to_exclude; 
        }
        $terms = get_terms( 'product_cat', array(
            'hide_empty' =>  1,
            'exclude' => $ids_to_exclude,
            'parent' =>0
        ));
      @endphp  
      @foreach($terms as $term) 
        <option value="{{ $term->term_id }}">{{ $term->name }}</option>
      @endforeach
    </select>
  </section>

  <div class="loading" style="display:none;">
    <div class="spinner">
      <div class="rect1"></div>
      <div class="rect2"></div>
      <div class="rect3"></div>
      <div class="rect4"></div>
      <div class="rect5"></div>
    </div>
  </div>

  <section id="freeItems" class="woocommerce mt-5">
      <?php
      if ( ! defined( 'ABSPATH' ) ) {
        exit;
      }
      $downloads     = WC()->customer->get_downloadable_products();
      $has_downloads = (bool) $downloads;

      $product_ids = [];
      foreach ($downloads as $download) {
        $ids = $download['product_id'];
        $product_ids[] = $ids;
      }

      $somdn_download_history = get_posts(
        array(
          'fields' => 'ids',
          'posts_per_page' => -1,
          'post_type' => 'somdn_tracked',
        )
      );

      $somdn_download_ids = array();
      foreach( $somdn_download_history as $somdn_history ) {
        $somdn_product = get_post_meta( $somdn_history, 'somdn_product_id', true);
        if ( ! in_array( $somdn_product, $somdn_download_ids ) ) {
          $somdn_download_ids[] = $somdn_product;
        }
      }

      $args = array(
        'post_type' => 'product',
        'posts_per_page' => 20,
        'post__in' => $somdn_download_ids,
      );

      $loop = new WP_Query( $args );
      ?>
      <div class="container-fluid">
        <div class="row">
          @while($loop->have_posts()) @php($loop->the_post())
            @include('partials/incloud/card')
          @endwhile  
        </div>
      </div>
  </section>
  <section class="page">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 pt-5 pb-5">
          <nav aria-label="Page navigation example">{{ premast_base_pagination(array(), $loop) }}</nav>
        </div>
      </div>
    </div>
  </section>

<script>
  jQuery(function($) {
    $('.selectCat').on('change', function() {
      var term = this.value;

      $.ajax({
        url: "<?php echo admin_url('admin-ajax.php'); ?>", // in backend you should pass the ajax url using this variable
        type: 'POST',
        data: { 
          action : 'get_free_terms', 
          term_id: term,
        },
        beforeSend: function () {
          $('.loading').show();
        },
        success: function(data){
          $('#freeItems').html(data);
          $('.loading').hide();
        }
      });
    });
  });
</script>
  
  <style>
    #banner .contentBanner {
      padding-top: 100px;
      padding-bottom: 10px;
    }

    #banner .contentBanner p,
    #banner .contentBanner h2 {
      color: #fff;
    }

    .bg-thumbnail {
      position: relative;
      overflow: hidden;
    }

    .bg-thumbnail:before {
      padding-top: 72%;
      content: "";
      display: inline-block;
    }

    .bg-thumbnail img {
      position: absolute;
    }

    .item-card .card {
      padding: 10px;
    }

    .item-card .card .card-body {
      padding: 10px 0 0 !important;
    }

    .item-card .card h5.card-title {
      min-height: 1px;
    }

    .item-card {
      margin-bottom: 30px;
    }

    select.selectCat {
      background: #FFFFFF;
      border: 1px solid #E3E3E3;
      box-sizing: border-box;
      border-radius: 8px;
      height: 40px;
      min-width: 200px;
      margin: 0 15px -10px;
    }  

    .loading {
      width: 100%;
      position: relative;
      margin-top: -20px;
    }

    .spinner {
      margin: 0 auto;
      width: 50px;
      height: 50px;
      text-align: center;
      font-size: 10px;
      background: transparent;
    }

    .spinner>div {
      background-color: #0c5bce;
      height: 100%;
      width: 4px;
      display: inline-block;
      -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
      animation: sk-stretchdelay 1.2s infinite ease-in-out;
      margin: 1px;
    }

    .spinner .rect2 {
      -webkit-animation-delay: -1.1s;
      animation-delay: -1.1s;
    }

    .spinner .rect3 {
      -webkit-animation-delay: -1.0s;
      animation-delay: -1.0s;
    }

    .spinner .rect4 {
      -webkit-animation-delay: -0.9s;
      animation-delay: -0.9s;
    }

    .spinner .rect5 {
      -webkit-animation-delay: -0.8s;
      animation-delay: -0.8s;
    }

    @-webkit-keyframes sk-stretchdelay {
      0%,
      40%,
      100% {
        -webkit-transform: scaleY(0.4)
      }
      20% {
        -webkit-transform: scaleY(1.0)
      }
    }

    @keyframes sk-stretchdelay {
      0%,
      40%,
      100% {
        transform: scaleY(0.4);
        -webkit-transform: scaleY(0.4);
      }
      20% {
        transform: scaleY(1.0);
        -webkit-transform: scaleY(1.0);
      }
    }
  </style>
@endsection