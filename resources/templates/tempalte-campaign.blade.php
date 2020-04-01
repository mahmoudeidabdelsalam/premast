{{--
  Template Name: Campaign Template
--}}

@extends('layouts.app-blank')
<link rel="stylesheet" href="<?= get_theme_file_uri() . '/framework/assets/campaign.css'; ?>">
<script src="<?= get_theme_file_uri() . '/framework/assets/campaign.js'; ?>" defer=""></script>
<script src="<?= get_theme_file_uri() . '/framework/assets/jquery.countdown.min.js'; ?>" defer=""></script>


@section('content')
  @while(have_posts()) @php the_post() @endphp

  <header class="header-block">
    <div class="container-fluid">
      <div class="row m-0 align-content-center">
        <a class="logo-template" href="<?= the_field('link_page_login'); ?>"><img src="<?= the_field('logo_template'); ?>" alt="logo"></a>
        <div class="col-action ml-auto">
          <span>{{ _e('sale ends in', 'premast') }}</span>
          <div id="time" class="countdown"></div>
        </div>
      </div>
    </div>
  </header>

  <section class="banner-background vh-100" style="background-image: url({{ the_field('background_banner') }});">
    <div class="container-fluid vh-100">
      <div class="row align-content-center justify-content-center vh-100">
        <h2>{{ the_field('headline_banner') }}</h2>
        <div class="col-12 text-center instructions-offer">
          {{ the_field('instructions_offer') }}
        </div>
        <div class="col-12 text-center">
          @php
            $link = get_field('button_offer_go');
            if( $link ):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
          @endphp
            <a class="button button-green" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
           @endif
        </div>
        <div class="col-12 text-center bottom-offer">
          {{ the_field('instructions_offer_bottom') }}
        </div>
      </div>
    </div>
  </section>


  <section class="banner-slide pb-5">
   <div class="container">
      <div class="rev_slider">
        <?php
        if( have_rows('slider_3d') ):
          while ( have_rows('slider_3d') ) : the_row(); ?>
          <div class="rev_slide"><a href="<?= the_sub_field('slide_url'); ?>" style="background-image:url('<?= the_sub_field('slide_image'); ?>');"></a></div>
        <?php
          endwhile;
        endif;
        ?>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6 col-12 instructions">
          {{ the_field('instructions_slide') }}
        </div>
        <div class="col-md-6 col-12 instructions-list">
          <ul class="list-inline">
            <?php
            if( have_rows('instructions_slide_list') ):
              while ( have_rows('instructions_slide_list') ) : the_row(); ?>
                <li class="list-inline-item">
                  <img src="<?= the_sub_field('list_icon'); ?>" alt="<?= the_sub_field('list_text'); ?>"> <span><?= the_sub_field('list_text'); ?></span>
                </li>
            <?php
              endwhile;
            endif;
            ?>
          </ul>
        </div>
      </div>
    </div>      
  </section>


  <section class="templateList" style="background:#F3F3F3;">
    <h3>{{ _e('Wide range of Unique Designed template', 'premast') }}</h3>
    <div class="container-fluid">
      <div class="row">
        <?php 
        $terms = get_field('products');
        // dd($terms);
        if( $terms ): ?>
            <ul class="nav-products nav nav-tabs col-12" id="TabProducts" role="tablist">
            <?php 
            $counter = 0;
              foreach( $terms as $term ): 
              $product_term = get_term_by('id', $term, 'product_cat');
              $counter++;
            ?>
              <li class="nav-item">
                <a class="nav-link <?= ($counter == 1)? 'active':''; ?>" id="<?php echo esc_html( $product_term->slug ); ?>-tab" data-toggle="tab" href="#<?php echo esc_html( $product_term->slug ); ?>" role="tab" aria-controls="<?php echo esc_html( $product_term->slug ); ?>" aria-selected="true"><?php echo esc_html( $product_term->name ); ?></a>
              </li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
        <div class="tab-content col-12" id="myTabContent">
           <?php 
            $counter = 0;
              foreach( $terms as $term ): 
              $product_term = get_term_by('id', $term, 'product_cat');
              $counter++;

              $args = array(
                'post_type' => 'product',
                'posts_per_page' => 12,
                'tax_query' => array(
                  array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $product_term->term_id
                  )
                )
              );
              $posts = get_posts($args);
            ?>
            <div class="tab-pane fade <?= ($counter == 1)? 'show active':''; ?> " id="<?php echo esc_html( $product_term->slug ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_html( $product_term->slug ); ?>-tab">
              <div class="row">
                <?php 
                if($posts):
                  foreach ($posts as $post):
                  setup_postdata( $post ); 
                ?>
                  <div class="col-md-3 col-sm-6 col-12">
                    <div class="card">
                      <a class="img-modal" href="#" data-toggle="modal" data-target="#Modal<?= $post->ID; ?>">
                        <img src="{{ Utilities::global_thumbnails($post->ID,'medium')}}" class="card-img-top" alt="{{ get_the_title($post->ID) }}">
                      </a>
                      
                      <div class="card-body">
                        <h5 class="card-title"><a href="#" data-toggle="modal" data-target="#Modal<?= $post->ID; ?>">{{ html_entity_decode(wp_trim_words(get_the_title($post->ID), '4', ' ...')) }}</a></h5>
                      </div>
                    </div>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="Modal<?= $post->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?= $post->ID; ?>Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">{{ html_entity_decode(get_the_title($post->ID)) }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6 col-12">
                              <div class="product-description">
                                <h3 class="text-left mb-5">{{ _e('Description', 'premast') }}</h3>
                                <div id="tab-description"><?= get_the_content($post->ID); ?></div>
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <h3 class="text-left mb-5">{{ _e('Gallery', 'premast') }}</h3>
                              @php  
                                $product = new WC_product($post->ID);
                                $attachment_ids = $product->get_gallery_image_ids();
                              @endphp                         
                              @if ($attachment_ids)
                              <div id="galleryPro<?= $post->ID; ?>" class="galleryPro">
                                @foreach( $attachment_ids as $attachment_id ) 
                                  <a href="{{ wp_get_attachment_url( $attachment_id ) }}">
                                    <img src="{{ wp_get_attachment_url( $attachment_id ) }}" />
                                  </a>
                                @endforeach
                              </div>
                              @else 
                                <img src="{{ Utilities::global_thumbnails($post->ID,'full')}}" class="card-img-top" alt="{{ get_the_title($post->ID) }}"> 
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php 
                  endforeach;
                  wp_reset_postdata(); 
                endif;
                ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="Why-use" style="background: linear-gradient(18.08deg, #BEDBFD 3.57%, rgba(190, 219, 253, 0.4) 76.69%);">
    <h3 class="mb-5">{{ the_field('headline_why_use') }}</h3>
      <div class="container">
        <div class="row justify-content-center align-content-center">
          <?php
            if( have_rows('list_why_use') ):
              while ( have_rows('list_why_use') ) : the_row(); ?>
                <div class="col-md-2 col-sm-4 col-12 item-why">
                  <img src="<?= the_sub_field('icon_list_why_use'); ?>" alt="<?= the_sub_field('headline_list_why_use'); ?>"> 
                  <p><?= the_sub_field('headline_list_why_use'); ?></p>
                  <span><?= the_sub_field('text_list_why_use'); ?></span>
                </div>
            <?php
              endwhile;
            endif;
            ?>
        </div>
      </div>          
  </section>

  <section class="design" style="background:#F3F3F3;">
    <img class="m-auto d-block" src="{{ the_field('icon_design') }}" alt="{{ the_field('headline_design') }}">
    <h3 class="mb-5">{{ the_field('headline_design') }}</h3>
      <div class="container">
        <div class="row justify-content-center align-content-center">
          <img src="{{ the_field('background_design') }}" alt="{{ the_field('headline_design') }}">
        </div>
      </div>          
  </section>

  <section class="footer bg-white" style="box-shadow: 0px -2px 2px rgba(192, 192, 192, 0.25);">
    <div class="container-fluid">
      <div class="row align-items-center m-0">
        <a href="<?= home_url('/'); ?>"><img src="{{the_field('logo_footer')}}" alt="logo footer"></a>
          <ul class="footer-links">
            <?php
            $post_objects = get_field('footer_menu_eargo');
            if($post_objects) :
                foreach( $post_objects as $post):
                setup_postdata($post); ?>
            <li>
              <a href="<?= get_the_permalink($post->ID); ?>"><?=  get_the_title($post->ID); ?></a>
            </li>
            <?php
              endforeach;
                wp_reset_postdata();
            endif;
              ?>
          </ul>
        <ul class="footer-menu p-0 list-inline">
          <li><?= _e('follow us', 'theme'); ?></li>
          <?php
          if( have_rows('follow_us') ):
            while ( have_rows('follow_us') ) : the_row(); ?>
              <li><a href="<?= the_sub_field('links_social_media'); ?>"><?= the_sub_field('icon_image'); ?></a></li>
          <?php
            endwhile;
          endif;
          ?>
        </ul>
      </div>
    </div>
  </section>






  <script>
    jQuery(function($) {
      $('#time').countdown('<?= the_field("date_campaign"); ?>').on('update.countdown', function(event) {
      var $this = $(this).html(event.strftime(''
        + '<span>%D d</span> : '
        + '<span>%H hr</span> : '
        + '<span>%M min</span>'));
      });
    });
  </script>
  @endwhile
@endsection
