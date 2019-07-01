{{--
  Template Name: User Customer Download
--}}

@extends('layouts.template-custom')

@section('content')

@if(!is_user_logged_in())
  <div class="container">
    <div class="row justify-content-center m-0">
      <div class="user-not-login">
        <h2>{{ _e('See what’s happening in the world right now', 'premast') }}</h2>
        <p>{{ _e('Join Twitter today.', 'premast') }}</p>
        <a class="mt-2 login btn btn-blue" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a>
      </div>
    </div>
  </div>
@else
  <section class="header-users">
    <div class="container">
      <div class="row justify-content-between">
        <h2 class="headline">{{ _e('My Account', 'premast') }}</h2>
        @if (has_nav_menu('user_navigation'))
          {!! wp_nav_menu(['theme_location' => 'user_navigation', 'container' => false, 'menu_class' => 'nav nav-pills flex-column flex-sm-row col-12', 'walker' => new NavWalker()]) !!}
        @endif
      </div>
    </div>        
  </section>

  <section class="template-users">
        <?php
        $sort   = isset($_GET['sort']) ? $_GET['sort'] : 'DESC';
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
            'meta_key' => 'somdn_user_id',
            'meta_value' => get_current_user_id(),
          )
        );

        $somdn_download_ids = array();
        foreach( $somdn_download_history as $somdn_history ) {
          $somdn_product = get_post_meta( $somdn_history, 'somdn_product_id', true);
          if ( ! in_array( $somdn_product, $somdn_download_ids ) ) {
            $somdn_download_ids[] = $somdn_product;
          }
        }

        $all_ids = array_merge($somdn_download_ids, $product_ids);
        $All = array(
          'post_type' => 'product',
          'posts_per_page' => -1,
          'post__in' => $all_ids,
          'order'   => $sort,
        );

        $Free = array(
          'post_type' => 'product',
          'posts_per_page' => -1,
          'post__in' => $somdn_download_ids,
          'order'   => $sort,
        );

        $Paid = array(
          'post_type' => 'product',
          'posts_per_page' => -1,
          'post__in' => $product_ids,
          'order'   => $sort,
        );


        $loop_all = new WP_Query( $All );
        $loop_free = new WP_Query( $Free );
        $loop_paid = new WP_Query( $Paid );
        
        ?>

        @if($loop_all->have_posts())

          <div class="container-fiuld woocommerce customer-download">
            <div class="row justify-content-center m-0 pt-5 pb-5">
              <div class="col-md-12 col-sm-12">
             
                <div class="row justify-content-between">
                  <ul class="nav-downloads mb-5 list-inline nav nav-tabs border-0" id="myTab" role="tablist">
                    <li class="show-tabs list-inline-item">{{ _e('Show', 'premast') }}</li>
                    <li class="nav-item list-inline-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All</a>
                    </li>
                    @if($loop_free->have_posts())
                      <li class="nav-item list-inline-item">
                        <a class="nav-link" id="free-tab" data-toggle="tab" href="#free" role="tab" aria-controls="free" aria-selected="false">Free</a>
                      </li>
                    @endif
                    @if($loop_paid->have_posts())
                      <li class="nav-item list-inline-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Paid</a>
                      </li>
                    @endif
                  </ul>
                  
                  @while(have_posts()) @php(the_post())
                    <div class="dropdown mr-1">
                      <button type="button" class="dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                        @if ($sort == 'DESC') {{ _e('Newest to oldest', 'premast')}} @else {{ _e('oldest to Newest', 'premast')}} @endif
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" href="{{ the_permalink() }}?sort=DESC">Newest to oldest</a>
                        <a class="dropdown-item" href="{{ the_permalink() }}?sort=ASC">oldest to Newest</a>
                      </div>
                    </div>
                  @endwhile
                </div>

                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="item-columns row m-0">
                      @if($loop_all->have_posts())
                        @while($loop_all->have_posts()) @php($loop_all->the_post())
                          <div class="item-card col-md-2 col-sm-3 col-sx-6 col-12 grid-item">
                            <div class="card">
                              <div class="bg-white bg-images" style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(),'full')}}');height:204px;">
                                <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="card-img-top" alt="{{ the_title() }}">
                              </div>
                              <div class="card-body pt-2 pl-0 pr-0">
                                <a class="card-link" href="{{ the_permalink() }}">
                                  <h5 class="card-title font-weight-400">{{ wp_trim_words(get_the_title(), '5', ' ...') }}</h5>
                                </a>
                                <div class="review-and-download">
                                  <div class="review">
                                    <a class="card-link" href="{{ the_permalink() }}">
                                      <i class="fa fa-star" aria-hidden="true"></i>
                                      <span itemprop="reviewCount">{{ _e('Rate it', 'premast') }}</span>
                                    </a>
                                  </div>
                                  <div class="download">
                                    <a class="card-link" href="{{ the_permalink() }}">
                                      {{ _e('Download', 'premast') }}
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>              
                          </div>
                        @endwhile
                        @php (wp_reset_postdata())
                      @endif
                    </div>
                  </div>
                  @if($loop_free->have_posts())
                    <div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">
                      <div class="item-columns row m-0">
                        @while($loop_free->have_posts()) @php($loop_free->the_post())
                          <div class="item-card col-md-2 col-sm-3 col-sx-6 col-12 grid-item">
                            <div class="card">
                              <div class="bg-white bg-images" style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(),'full')}}');height:204px;">
                                <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="card-img-top" alt="{{ the_title() }}">
                              </div>
                              <div class="card-body pt-2 pl-0 pr-0">
                                <a class="card-link" href="{{ the_permalink() }}">
                                  <h5 class="card-title font-weight-400">{{ wp_trim_words(get_the_title(), '5', ' ...') }}</h5>
                                </a>
                                <div class="review-and-download">
                                  <div class="review">
                                    <a class="card-link" href="{{ the_permalink() }}">
                                      <i class="fa fa-star" aria-hidden="true"></i>
                                      <span itemprop="reviewCount">{{ _e('Rate it', 'premast') }}</span>
                                    </a>
                                  </div>
                                  <div class="download">
                                    <a class="card-link" href="{{ the_permalink() }}">
                                      {{ _e('Download', 'premast') }}
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>              
                          </div>
                        @endwhile
                        @php (wp_reset_postdata())
                      </div>                
                    </div>
                  @endif
                  @if($has_downloads)
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                      <div class="item-columns row m-0">
                        @while($loop_paid->have_posts()) @php($loop_paid->the_post())
                          <div class="item-card col-md-2 col-sm-3 col-sx-6 col-12 grid-item">
                            <div class="card">
                              <div class="bg-white bg-images" style="background-image:url('{{ Utilities::global_thumbnails(get_the_ID(),'full')}}');height:204px;">
                                <img src="{{ Utilities::global_thumbnails(get_the_ID(),'full')}}" class="card-img-top" alt="{{ the_title() }}">
                              </div>
                              <div class="card-body pt-2 pl-0 pr-0">
                                <a class="card-link" href="{{ the_permalink() }}">
                                  <h5 class="card-title font-weight-400">{{ wp_trim_words(get_the_title(), '5', ' ...') }}</h5>
                                </a>
                                <div class="review-and-download">
                                  <div class="review">
                                    <a class="card-link" href="{{ the_permalink() }}">
                                      <i class="fa fa-star" aria-hidden="true"></i>
                                      <span itemprop="reviewCount">{{ _e('Rate it', 'premast') }}</span>
                                    </a>
                                  </div>
                                  <div class="download">
                                    <a class="card-link" href="{{ the_permalink() }}">
                                      {{ _e('Download', 'premast') }}
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>              
                          </div>
                        @endwhile
                        @php (wp_reset_postdata())
                      </div>                  
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @else
          <div class="container">
            <div class="row">
              <div class="woocommerce-Message woocommerce-Message--info woocommerce-info col-12 pt-5 pb-5 mb-5 mt-5">
                <a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                  <?php esc_html_e( 'Go shop', 'woocommerce' ); ?>
                </a>
                <?php esc_html_e( 'No downloads available yet.', 'woocommerce' ); ?>
              </div>
            </div>
          </div>
        @endif
  </section>

  @endif
@endsection