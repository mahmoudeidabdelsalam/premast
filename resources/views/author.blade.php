@extends('layouts.template-custom')

@section('content')

@php 
  global $current_user;
  wp_get_current_user();
  
  $author = get_user_by( 'slug', get_query_var( 'author_name' ) );

  if( ( ($author->ID != $current_user->ID) || !is_super_admin()):
    $news_link = get_field('link_page_login', 'option');
      wp_redirect( $news_link);
    die();
  endif;


  
  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
  
  // Top Products 
  $top = array(
    'post_type'       => array('product'),
    'author'          =>  $author->ID,
    'posts_per_page'  => 4,
  );
  $top_posts = new WP_Query( $top );

  // All Products
  $args = array(
    'post_type'       => array('product'),
    'author'          =>  $author->ID,
    'post_status'     => 'any',
    'posts_per_page' => 20,
    'paged' => $paged,
  );
  $all = new WP_Query( $args );

  // All Drafts
  $drafts = array(
    'post_type'       => array('product'),
    'author'          =>  $author->ID,
    'post_status'     => 'draft',
    'posts_per_page'  => -1,
  );
  $all_drafts = new WP_Query( $drafts );

  // All Pending
  $pending = array(
    'post_type'       => array('product'),
    'author'          =>  $author->ID,
    'post_status'     => 'pending',
    'posts_per_page'  => -1,
  );
  $all_pending = new WP_Query( $pending );

  // All Live
  $live = array(
    'post_type'       => array('product'),
    'author'          =>  $author->ID,
    'post_status'     => 'publish',
    'posts_per_page'  => -1,
  );
  $all_live = new WP_Query( $live );

  // All rejected
  $rejected = array(
    'post_type'       => array('product'),
    'author'          =>  $author->ID,
    'post_status'     => 'rejected',
    'posts_per_page'  => -1,
  );
  $all_rejected = new WP_Query( $rejected );

  $dashboard   = isset($_GET['dashboard']) ? $_GET['dashboard'] : 'true';
  $items   = isset($_GET['items']) ? $_GET['items'] : 'false';
  $statistics   = isset($_GET['statistics']) ? $_GET['statistics'] : 'false';
  $support   = isset($_GET['support']) ? $_GET['support'] : 'false';






  // vandor Products
  $vandor = array(
    'post_type'       => array('product'),
    'author'          =>  $author->ID,
    'post_status'     => 'publish',
    'posts_per_page'  => -1,
  );
  $vandors = new WP_Query( $vandor );

    $views = [];
    $downloads = [];
    

    if($vandors->have_posts()):
      while ( $vandors->have_posts() ): $vandors->the_post();
        $view = get_post_meta( get_the_ID(), 'c95_post_views_count', true);
        $download = get_post_meta( get_the_ID(), 'counterdownload', true);

        $views[] = $view;
        $downloads[] = $download;


      endwhile;
    endif;



@endphp

<section class="bg-gray-dark nav-vandor">
  <div class="container-fiuld woocommerce">
    <div class="row">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link @if($dashboard == 'true' && $items != 'true' && $statistics != 'true' && $support != 'true') active @endif" id="dashboard-tab" data-tab="dashboard" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">{{ _e('dashboard', 'premast') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if($items == 'true') active @endif" id="myitems-tab" data-tab="items" data-toggle="tab" href="#myitems" role="tab" aria-controls="myitems" aria-selected="false">{{ _e('my items', 'premast') }}</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link @if($statistics == 'true') active @endif" id="statistics-tab" data-tab="statistics" data-toggle="tab" href="#statistics" role="tab" aria-controls="statistics" aria-selected="false">{{ _e('statistics', 'premast') }}</a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link @if($support == 'true') active @endif" id="support-tab" data-tab="support" data-toggle="tab" href="#support" role="tab" aria-controls="support" aria-selected="false">{{ _e('guides and support', 'premast') }}</a>
        </li> -->
      </ul>
    </div>
  </div>    
</section>


<div class="tab-content" id="myTabContent">
  
  <!-- Items -->
  <div class="tab-pane fade @if($dashboard == 'true' && $items != 'true' && $statistics != 'true' && $support != 'true') show active @endif" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="container-fiuld woocommerce">

      <div class="row justify-content-center m-0">
        <div class="col-12 p-4">
          <h2 class="overview-head">analytics overview</h2>
        </div>

        <div class="status-card col-md-3 col-sm-4 col-sx-6 col-12 pl-4 pr-4">
          <div class="card">
            <img src="{{ get_theme_file_uri().'/dist/images/dollar.svg' }}" alt="{{ _e('earnings', 'premast') }}">
            <h4 class="lg-head">{{ _e('soon', 'premast') }}</h4>
            <h3 class="line-head">{{ _e('earnings', 'premast') }}</h3>
            <time>{{ _e('Last month: soon', 'premast') }}</time>
          </div>
        </div>

        <div class="status-card col-md-3 col-sm-4 col-sx-6 col-12 pl-4 pr-4">
          <div class="card">
            <img src="{{ get_theme_file_uri().'/dist/images/downloads.svg' }}" alt="{{ _e('earnings', 'premast') }}">
            <h4 class="lg-head">{{ array_sum($downloads) }}</h4>
            <h3 class="line-head">{{ _e('downloads', 'premast') }}</h3>
            <time>{{ _e('Last month:', 'premast') }} {{ array_sum($downloads) }}</time>
          </div>
        </div>

        <div class="status-card col-md-3 col-sm-4 col-sx-6 col-12 pl-4 pr-4">
          <div class="card">
            <img src="{{ get_theme_file_uri().'/dist/images/likes.svg' }}" alt="{{ _e('earnings', 'premast') }}">
            <h4 class="lg-head">{{ _e('soon', 'premast') }}</h4>
            <h3 class="line-head">{{ _e('likes', 'premast') }}</h3>
            <time>{{ _e('Last month: soon', 'premast') }}</time>
          </div>
        </div>

        <div class="status-card col-md-3 col-sm-4 col-sx-6 col-12 pl-4 pr-4">
          <div class="card">
            <img src="{{ get_theme_file_uri().'/dist/images/views.svg' }}" alt="{{ _e('earnings', 'premast') }}">
            <h4 class="lg-head">{{ array_sum($views) }}</h4>
            <h3 class="line-head">{{ _e('views', 'premast') }}</h3>
            <time>{{ _e('Last month:', 'premast') }} {{ array_sum($views) }}</time>
          </div>
        </div>

        <div class="col-12 p-4">
          <h2 class="overview-head">top items</h2>
        </div>
          @if($top_posts->have_posts() ) 
            <div class="item-columns row m-0 col-12">        
              
              @while ( $top_posts->have_posts() ) @php($top_posts->the_post())
                @include('partials/incloud/item-card')
              @endwhile
              @php (wp_reset_postdata())
            </div>
            @else
              <div class="alert alert-warning">
                {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
              </div>
            @endif
          </div>

    </div>
  </div>


  
  <div class="tab-pane fade @if($items == 'true') show active @endif" id="myitems" role="tabpanel" aria-labelledby="myitems-tab">
    <div class="container-fiuld woocommerce">
      <div class="row justify-content-center m-0">
        <div class="col-md-12 col-sm-12">
         
        <div class="mt-4 mb-4 col-12">
          <ul class="nav nav-tabs" id="myshow" role="tablist">
            <li class="nav-item">
              <span>show</span>
            </li>
            @if($all->have_posts())
            <li class="nav-item">
              <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">{{ _e('all', 'premast') }}</a>
            </li>
            @endif
            @if($all_drafts->have_posts())
              <li class="nav-item">
                <a class="nav-link drafts" id="drafts-tab" data-toggle="tab" href="#drafts" role="tab" aria-controls="drafts" aria-selected="false">{{ _e('drafts', 'premast') }}</a>
              </li>
            @endif
            @if($all_pending->have_posts())
              <li class="nav-item">
                <a class="nav-link pending" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">{{ _e('pending', 'premast') }}</a>
              </li>
            @endif
            @if($all_live->have_posts())
              <li class="nav-item">
                <a class="nav-link live" id="live-tab" data-toggle="tab" href="#live" role="tab" aria-controls="live" aria-selected="false">{{ _e('live', 'premast') }}</a>
              </li>
            @endif
            @if($all_rejected->have_posts())
              <li class="nav-item">
                <a class="nav-link rejected" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">{{ _e('rejected', 'premast') }}</a>
              </li> 
            @endif           
          </ul>
        </div>


        <div class="tab-content col-12 p-0" id="myTabitems">
          <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="item-columns row m-0 col-12 p-0"> 
              @while($all->have_posts() ) @php($all->the_post())
                @include('partials/incloud/item-card')
              @endwhile
              <div class="col-12">
                <nav aria-label="Page navigation example">{{ premast_base_pagination(array(), $all) }}</nav>
              </div>
              @php (wp_reset_postdata())
            </div>
          </div>

          <div class="tab-pane fade" id="drafts" role="tabpanel" aria-labelledby="drafts-tab">
            <div class="item-columns row m-0 col-12 p-0"> 
              @while($all_drafts->have_posts() ) @php($all_drafts->the_post())
                @include('partials/incloud/item-card')
              @endwhile
              @php (wp_reset_postdata()) 
            </div>           
          </div>

          <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
            <div class="item-columns row m-0 col-12 p-0"> 
              @while($all_pending->have_posts() ) @php($all_pending->the_post())
                @include('partials/incloud/item-card')
              @endwhile
              @php (wp_reset_postdata()) 
            </div>           
          </div>

          <div class="tab-pane fade" id="live" role="tabpanel" aria-labelledby="live-tab">
            <div class="item-columns row m-0 col-12 p-0"> 
              @while($all_live->have_posts() ) @php($all_live->the_post())
                @include('partials/incloud/item-card')
              @endwhile
              @php (wp_reset_postdata()) 
            </div>           
          </div>

          <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
            <div class="item-columns row m-0 col-12 p-0"> 
              @while($all_rejected->have_posts() ) @php($all_rejected->the_post())
                @include('partials/incloud/item-card')
              @endwhile
              @php (wp_reset_postdata())    
            </div>        
          </div>
        </div>

        </div>
      </div>
    </div>
  </div>

  <div class="tab-pane fade @if($statistics == 'true') show active @endif" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">...</div>
  <div class="tab-pane fade @if($support == 'true') show active @endif" id="support" role="tabpanel" aria-labelledby="support-tab">...</div>

</div>


<script>
  jQuery(function($) {
    $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var $current_tab = $(e.target);
      var tab = $current_tab.attr('data-tab');
      var $location = location.origin + location.pathname;
      var new_url = $location + "?" +tab+"=true" ;
      history.pushState(null, null, new_url); // = "?type=" + type + "&tab=";
    });
  });
</script>

@endsection
