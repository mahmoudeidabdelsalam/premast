<div class="summary entry-summary col-md-4 col-12 sidebar-shop">

  @include('partials/incloud/price-item')



  @if(get_field('ads_image'))
    <div class="ads-block">
      <a href="{{ the_field('ads_link') }}"><img src="{{ the_field('ads_image') }}" alt="{{ _e('Ads Block', 'premast') }}"></a>
    </div>
  @endif

  @php dynamic_sidebar('sidebar-shop') @endphp






  @if ( wp_is_mobile() )
    @if (get_field('slide_gallery'))
      <div class="embed-container">
        {{ the_field('slide_gallery') }}
      </div>
    @endif

    <div class="product-infomation">
      <h3>{{ _e('Description', 'premast') }}</h3>
      <div id="tab-description">{!! get_the_content() !!}</div>
    </div>
  @endif

  <div class="box-author box-counter">

    <h3>{{ _e('published by', 'premast') }}</h3>

    @php
      $avatar = get_field('owner_picture', 'user_'. $author );
      $user_post_count = count_user_posts( $author , 'product' );
    @endphp
    <div class="media author-media">
      @if($avatar)
        <div class="avatar align-self-center mr-3">
          <img src="{{ $avatar['url'] }}" alt="{!! get_the_author_meta('display_name', $author) !!}">
        </div>
      @else
        {!! get_avatar( get_the_author_meta('ID', $author), '94', null, null, array( 'class' => array( 'align-self-start', 'mr-3' ) ) ) !!}
      @endif
      <div class="media-body pt-3">
        <h5 class="mt-0 text-black">
          <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>

          @if (is_user_logged_in())

            @if ($followers && in_array( $current_user->ID, $followers ))
              <a class="follow unfollow" href="javascript:void(0)" data-event="unfollow" data-user="<?= $current_user->ID; ?>" data-author="<?= get_the_author_meta( 'ID' ); ?>"><span class="fo-text">{{ _e('unfollow', 'premast') }}</span> <span id="fo-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></a>
            @else
              <a class="follow" href="javascript:void(0)" data-event="follow" data-user="<?= $current_user->ID; ?>" data-author="<?= get_the_author_meta( 'ID' ); ?>"><span class="fo-text">{{ _e('follow', 'premast') }}</span> <span id="fo-loader" style="display:none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></a>
            @endif
          @else
            <a class="login follow" href="#" data-toggle="modal" data-target="#LoginUser">Login for follow</a>
          @endif
        </h5>
        <p>{{ _e('Total uploads:', 'premast') }} {{ $user_post_count }}</p>
      </div>
    </div>
  </div>

    @if ( wp_is_mobile() )
      @include('partials/incloud/comments')
    @endif
</div>
