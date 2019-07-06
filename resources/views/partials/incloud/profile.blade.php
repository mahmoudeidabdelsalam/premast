@php 
  global $wp;

@endphp


@if ( is_user_logged_in() ) 
  @php 
    global $current_user;
    wp_get_current_user();
    $user = wp_get_current_user();
    $allowed_roles = array('vendor', 'administrator');
  @endphp
  <ul class="link-dropdown">
    <li class="item-dropdown"><a class="border-0" href="{{ get_author_posts_url( $current_user->ID) }}">{!! $current_user->display_name !!}</a></li>
    <li class="item-dropdown"><a class="border-0" href="{{ the_field('admin_dashborad_page','option') }}">{{ _e('admin Dashborad', 'premast') }}</a></li>
    <li class="item-dropdown"><a class="border-0" href="{{ the_field('dashborad_page','option') }}">{{ _e('Dashborad', 'premast') }}</a></li>
    <li class="item-dropdown"><a class="border-0" href="{{ the_field('download_page','option') }}">{{ _e('Downloads', 'premast') }}</a></li>
    
    @if (array_intersect($allowed_roles, $user->roles))
      <hr class="m-0">
        <li class="item-dropdown"><a class="border-0" href="{{ the_field('link_add_new','option') }}">{{ _e('Add Item', 'premast') }}</a></li>
      <hr class="m-0">
    @endif
    
    <li class="item-dropdown"><a class="border-0" href="{{ home_url('/') }}/faq">{{ _e('Support', 'premast') }}</a></li>
    <li class="item-dropdown" class="border-0">{{ wp_loginout() }}</li>

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


<style>
ul.link-dropdown hr {
    border-color: rgba(151, 151, 151, 0.24);
}
</style>