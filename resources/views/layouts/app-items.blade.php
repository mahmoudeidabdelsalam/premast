<!doctype html>
<html {!! get_language_attributes() !!}>
@include('partials.head')
@php
   $test_users_ids = [1, 2226, 3625, 3210, 2804, 2269, 217, 1010];
   $old = isset($_GET['old']) ? $_GET['old'] : false;
@endphp

<body @php body_class() @endphp>
   @if (get_field('body_scripts', 'option'))
      {{ the_field('body_scripts', 'option') }}
   @endif

   @php do_action('get_header') @endphp
   @if (!$old)
      @include('partials.header.pmst-template')
   @endif

   @if ($old === 'true')
      @include('partials/header/headeritemscopy')
   @endif

   <div class="wrap" role="document" id="panel">
      <div class="content">
         <main class="main">
            @yield('content')
         </main>
         @if (App\display_sidebar())
            <aside class="sidebar">
               @include('partials.sidebar')
            </aside>
         @endif
      </div>
   </div>
   @php do_action('get_footer') @endphp
   @include('partials.footer')
   @php wp_footer() @endphp
</body>

</html>
