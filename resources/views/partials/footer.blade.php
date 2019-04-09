<footer class="content-info bg-gray-dark">
  <div class="container-fluid pt-5 pb-5">
    <div class="row">
      <div class="col-md-8 col-sm-12">
        <div class="navbar-footer">
          <h3 class="sr-only">{{ _e('Footer navigation', 'premast') }}</h3>
          @if (has_nav_menu('footer_navigation'))
            {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'container' => false, 'menu_class' => 'navbar', 'walker' => new NavWalker()]) !!}
          @endif
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        @php dynamic_sidebar('sidebar-footer') @endphp
      </div>
    </div>
  </div>
</footer>

<section class="copyright bg-gray">
  <h3 class="sr-only">{{ _e('Copyright © 2018 Premast-powerpoint design solutions. All rights reserved.', 'premast') }}</h3>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        {{ _e('Copyright © 2018 Premast-powerpoint design solutions. All rights reserved.', 'premast') }}
      </div>
      <div class="col-md-6">
        <ul class="social-icons-ql list-inline mb-0 text-right">
          <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-reddit"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-stumbleupon"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
