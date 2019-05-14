@php 
  global $wp;

  $account_id = get_option( 'woocommerce_myaccount_page_id' );
  $link_login = get_field('link_page_login', 'option');

  if ( $account_id ) {
    $account_url = get_permalink( $account_id );
    $logout_url = wp_logout_url( home_url('/') );
  }
@endphp


@if ( is_user_logged_in() ) 
  @php 
    global $current_user;
    wp_get_current_user();
  @endphp
  <ul class="link-dropdown">
    <li class="item-dropdown"><span class="item-user mt-2">{!! $current_user->display_name !!}</span></li>
    <li class="item-dropdown"><a href="{{ $account_url }}">{{ _e('admin Dashborad', 'premast') }}</a></li>
    <li class="item-dropdown"><a href="{{ $account_url }}">{{ _e('Dashborad', 'premast') }}</a></li>
    <li class="item-dropdown"><a href="{{ $account_url }}/downloads">{{ _e('Downloads', 'premast') }}</a></li>
    <li class="item-dropdown"><a href="{{ home_url('/') }}/faq">{{ _e('Support', 'premast') }}</a></li>
    <li class="item-dropdown"><a href="{{ $logout_url }}">{{ _e('Logout', 'premast') }}</a></li>

    <div class="premast-social-icons"> 
      <a class="premast-icon icon-facebook" href="http://facebook.com/premast.co/" target="_blank" rel="nofollow"> <span class="sr-only">Facebook</span> <i class="fa fa-facebook"></i> </a> 
      <a class="premast-icon icon-twitter" href="https://twitter.com/Premast_co" target="_blank" rel="nofollow"> <span class="sr-only">Twitter</span> <i class="fa fa-twitter"></i> </a> 
      <a class="premast-icon icon-behance" href="http://behance.net/Premast" target="_blank" rel="nofollow"> <span class="sr-only">Behance</span> <i class="fa fa-behance"></i> </a> 
      <a class="premast-icon icon-youtube" href="https://www.youtube.com/channel/UCuf7-34ihJgEzC47NybyvfQ" target="_blank" rel="nofollow"> <span class="sr-only">Youtube</span> <i class="fa fa-youtube"></i> </a>
    </div>
  </ul>
@else 
  <ul class="link-dropdown">
    <li class="item-dropdown"><a class="mt-2" href="#" data-toggle="modal" data-target="#LoginUser">{{ _e('Log In', 'premast') }}</a></li>
    <div class="premast-social-icons"> 
      <a class="premast-icon icon-facebook" href="http://facebook.com/premast.co/" target="_blank" rel="nofollow"> <span class="sr-only">Facebook</span> <i class="fa fa-facebook"></i> </a> 
      <a class="premast-icon icon-twitter" href="https://twitter.com/Premast_co" target="_blank" rel="nofollow"> <span class="sr-only">Twitter</span> <i class="fa fa-twitter"></i> </a> 
      <a class="premast-icon icon-behance" href="http://behance.net/Premast" target="_blank" rel="nofollow"> <span class="sr-only">Behance</span> <i class="fa fa-behance"></i> </a> 
      <a class="premast-icon icon-youtube" href="https://www.youtube.com/channel/UCuf7-34ihJgEzC47NybyvfQ" target="_blank" rel="nofollow"> <span class="sr-only">Youtube</span> <i class="fa fa-youtube"></i> </a>
    </div>
  </ul>
@endif
