@extends('layouts.app-dark')

@section('content')

@php 
  global $current_user;
  wp_get_current_user();
  $user = wp_get_current_user();
  $administrator = array('administrator');
  $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
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
  if ( array_intersect($administrator, $user->roles)) {
  // All Pending
    $pending = array(
      'post_type'       => array('product'),
      'post_status'     => 'pending',
      'posts_per_page'  => -1,
    );
    $all_pending = new WP_Query( $pending );
  } else {
  // All Pending
    $pending = array(
      'post_type'       => array('product'),
      'author'          =>  $author->ID,
      'post_status'     => 'pending',
      'posts_per_page'  => -1,
    );
    $all_pending = new WP_Query( $pending );
  }
  // All Live
  $live = array(
    'post_type'       => array('product'),
    'author'          =>  $author->ID,
    'post_status'     => 'publish',
    'posts_per_page'  => 20,
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

@if (($author->ID == $current_user->ID))

  <section class="bg-gray-dark nav-vandor">
    <div class="container-fiuld woocommerce">
      <div class="row">
        <ul class="nav nav-tabs" id="myTabUser" role="tablist">
          <li class="nav-item">
            <a class="nav-link @if($dashboard == 'true' && $items != 'true' && $statistics != 'true' && $support != 'true') active @endif" id="dashboard-tab" data-tab="dashboard" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">{{ _e('dashboard', 'premast') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if($items == 'true') active @endif" id="myitems-tab" data-tab="items" data-toggle="tab" href="#myitems" role="tab" aria-controls="myitems" aria-selected="false">{{ _e('my items', 'premast') }}</a>
          </li>
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
      $('#myTabUser a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var $current_tab = $(e.target);
        var tab = $current_tab.attr('data-tab');
        var $location = location.origin + location.pathname;
        var new_url = $location + "?" +tab+"=true" ;
        history.pushState(null, null, new_url); // = "?type=" + type + "&tab=";
      });
    });
  </script>

@else 

  <section class="card-author">
    <div class="container-fluid woocommerce">
      <div class="row">
        <div class="col-md-3 col-12 side-menu-user">
          <?php 
            $avatar = get_field('owner_picture', 'user_'. $author->ID );
            $user_post_count = count_user_posts( $author->ID , 'product' );
            $followers = get_user_meta( $author->ID, 'follow_authors' , true );
            if ($followers) {
              $counter_followers = count($followers);
            } else {
              $counter_followers = 0;
            }
            
  
            $following = get_user_meta( $author->ID, 'following_user' , true );
            if ($following) {
              $counter_following = count($following);
            } else {
              $counter_following = 0;
            }
          ?>
          <div class="media">
            @if($avatar)
              <img class="avatar align-self-center" src="{{ $avatar['url'] }}" alt="{!! get_the_author_meta('display_name', $author->ID) !!}">
            @else 
              <img class="avatar align-self-center" src="{{ get_theme_file_uri().'/resources/assets/images' }}/avatar.svg" alt="{!! get_the_author_meta('display_name', $author->ID) !!}">
            @endif
            <div class="media-body pt-3">         
              <h5 class="mt-0 text-black">
                <span class="is-roles"><?= get_author_role($author->ID); ?></span>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
              </h5>
            </div>
          </div>

          <div class="counter">
            <li><?= $counter_followers; ?> Followers</li>
            <li>|</li>
            <li><?= $counter_following; ?> Following</li>
          </div>

          <span class="contents">
            {{ _e('Premast is a store for premium high quality powerpoint presentations that fits all your business needs.', 'premast') }}
          </span>

          @if (in_array( $current_user->ID, $followers )) 
            <a class="follow unfollow" href="javascript:void(0)" data-event="unfollow" data-user="<?= $current_user->ID; ?>" data-author="<?= get_the_author_meta( 'ID' ); ?>"><span class="fo-text">{{ _e('unfollow', 'premast') }}</span> <span id="fo-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></a>
          @else 
            <a class="follow" href="javascript:void(0)" data-event="follow" data-user="<?= $current_user->ID; ?>" data-author="<?= get_the_author_meta( 'ID' ); ?>"><span class="fo-text">{{ _e('follow', 'premast') }}</span> <span id="fo-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></a>
          @endif

          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-file-o" aria-hidden="true"></i> item</a>
            @if ($followers)
              <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-heart-o" aria-hidden="true"></i> Followers</a>
            @endif
            @if ($following)
              <a class="nav-link" id="v-pills-following-tab" data-toggle="pill" href="#v-pills-following" role="tab" aria-controls="v-pills-following" aria-selected="false"><i class="fa fa-heart" aria-hidden="true"></i> following</a>
            @endif
          </div>
        </div>
        <div class="col-md-9 col-12">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <p class="counter"><strong>{{ _e('Items', 'premast') }}</strong> ({{ $user_post_count }})</p>
              <div class="item-columns row m-0 col-12 p-0"> 
                @while($all_live->have_posts() ) @php($all_live->the_post())
                  @include('partials/incloud/card-user')
                @endwhile
                <div class="col-12">
                  <nav aria-label="Page navigation example">{{ premast_base_pagination(array(), $all_live) }}</nav>
                </div>
                @php (wp_reset_postdata())
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <p class="counter"><strong>{{ _e('Followers', 'premast') }}</strong> ({{ $counter_followers }})</p>
              <div class="container-fluid">
                <div class="row">
                  
                  @foreach ($followers as $followr)
                    <?php  
                      $avatar = get_field('owner_picture', 'user_'. $followr );
                    ?>
                    <div class="col-md-3 col-12">
                      <div class="card-follow">
                        @if($avatar)
                          <img class="avatar align-self-center" src="{{ $avatar['url'] }}" alt="{!! get_the_author_meta('display_name', $followr) !!}">
                        @else 
                          <img class="avatar align-self-center" src="{{ get_theme_file_uri().'/resources/assets/images' }}/avatar.svg" alt="{!! get_the_author_meta('display_name', $followr) !!}">
                        @endif
                        <h5 class="mt-0 text-black">                        
                          <a href="#">{!! get_the_author_meta('display_name', $followr) !!}</a>
                        </h5>
                      </div>
                    </div>
                  @endforeach
                  
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-following" role="tabpanel" aria-labelledby="v-pills-following-tab">
              <p class="counter"><strong>{{ _e('following', 'premast') }}</strong> ({{ $counter_following }})</p>
              <div class="container-fluid">
                <div class="row">
                  
                    @foreach ($following as $followr)
                    <?php  
                      $avatar = get_field('owner_picture', 'user_'. $followr );
                    ?>
                      <div class="col-md-3 col-12">
                        <div class="card-follow">
                          @if($avatar)
                            <img class="avatar align-self-center" src="{{ $avatar['url'] }}" alt="{!! get_the_author_meta('display_name', $followr) !!}">
                          @else 
                            <img class="avatar align-self-center" src="{{ get_theme_file_uri().'/resources/assets/images' }}/avatar.svg" alt="{!! get_the_author_meta('display_name', $followr) !!}">
                          @endif
                          <h5 class="mt-0 text-black">                        
                            <a href="#">{!! get_the_author_meta('display_name', $followr) !!}</a>
                          </h5>
                        </div>
                      </div>                      
                    @endforeach
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
    section.card-author {
      margin-top: 55px;
      padding-top: 45px;
      min-height: 600px;
      background-color: #fff;
    }

    .card-follow {
        background: #FFFFFF;
        border: 1px solid #E3E3E3;
        box-sizing: border-box;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    section.card-author .row {
        min-height: 600px;
    }
    .author .item-card .card .bg-white {
      min-height: 155px !important;
      max-height: 155px !important;
    }

    .author .item-card .card {
      margin-bottom: 40px !important;
    }

    p.counter {
      font-size: 18px;
      line-height: 27px;
      color: #282F39;
    }

    p.counter strong {
      font-weight: bold;
    }

    .side-menu-user {
      margin-top: -100px;
      padding-top: 100px;
    }

    .side-menu-user .media {
      margin-bottom: 30px;
    }

    .side-menu-user .media .avatar {
      width: 70px;
      margin-right: 2rem;
    }

    .side-menu-user .media .is-roles {
      font-style: normal;
      font-weight: 500;
      font-size: 11px;
      line-height: 16px;
      letter-spacing: 0.04px;
      color: #FFFFFF;
      padding: 2px 5px;
      background: linear-gradient(162.28deg, #1ADB72 -2.47%, #12B754 118.96%);
      border-radius: 25px;
    }

    .side-menu-user .media h5 a {
      display: block;
    }

    .side-menu-user .follow {
      background: linear-gradient(172.36deg, #6B73FF -0.5%, #000DFF 100%);
      border-radius: 30px;
      width: 100%;
      display: block;
      padding: 10px 20px;
      margin-bottom: 20px;
      font-size: 14px;
      line-height: 21px;
      text-align: center;
      letter-spacing: 0.04px;
      color: #FFFFFF;
    }

    .side-menu-user .nav-link.active {
      font-weight: bold;
      font-size: 16px;
      line-height: 24px;
      letter-spacing: 0.04px;
      color: #1E6DFB !important;
      margin: 10px 0px;
      background: transparent !important;
    }

    .side-menu-user .nav-link i {
      margin-right: 10px;
    }

    .side-menu-user .follow.unfollow {
      background: transparent;
      color: #333;
      border: 1px solid;
    }

    .card-follow .avatar {
        width: 70px;
        margin-bottom: 10px;
    } 

    .card-follow {
      background: #FFFFFF;
      border: 1px solid #E3E3E3;
      box-sizing: border-box;
      box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      padding: 25px;
      text-align: center;
    } 

    .card-follow .is-roles {
      font-style: normal;
      font-weight: 500;
      font-size: 11px;
      line-height: 16px;
      letter-spacing: 0.04px;
      color: #FFFFFF;
      padding: 2px 5px;
      background: linear-gradient(162.28deg, #1ADB72 -2.47%, #12B754 118.96%);
      border-radius: 25px;
    }
    .counter {
        display: flex;
        list-style: none;
    }

    .counter li {
        margin: 0 10px;
    }

    .side-menu-user span.contents {
        font-style: normal;
        font-weight: 500;
        line-height: 16px;
        letter-spacing: 0.04px;
        color: #646464;
        padding: 15px;
        display: inline-block;
    }
  </style>

  <script type="text/javascript">
    jQuery(function($) {

      $("body").on("click", ".follow", function () {
        var user_id = $('.follow').data('user');
        var author_id = $('.follow').data('author');
        var event = $('.follow').data('event');

        
        $.ajax({
          url: "<?= admin_url( 'admin-ajax.php' ); ?>",
          type: 'post',
          data: {
            action: "get_author_follower",
            user_id: user_id,
            author_id: author_id,
            event: event,
          },
          beforeSend: function () {
            $('#fo-loader').show();
          },
          success: function (response) {
            $('#fo-loader').hide();
            
            if(response == 'follow') {
              $('.follow .fo-text').text('unfollow');
              $('.follow').addClass('unfollow');
              $('.follow').attr("data-event","unfollow");
              event = 'unfollow';
            } else if(response == 'unfollow') {
              $('.follow .fo-text').text('follow');
              $('.follow').removeClass('unfollow');
              $('.follow').attr("data-event","follow");
              event = 'follow';
            }
          },
        });
      });

    });
  </script>
@endif

@endsection
