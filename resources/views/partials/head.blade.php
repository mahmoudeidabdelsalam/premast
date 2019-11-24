<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/favicon-16x16.png">
  <link rel="manifest" href="{{ get_theme_file_uri().'/resources/assets/images/favicons' }}/manifest.json">
  <meta name="msapplication-TileColor" content="#1E6CFC">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#1E6CFC">
  <meta name="robots" content="index, follow" />
    
  <script src="https://apis.google.com/js/platform.js" async defer></script>

  <meta name="google-signin-client_id" content="655629051006-gva2steha9rjuctdljglqaceb4gnpd6q.apps.googleusercontent.com">
  <meta name="google-signin-client_secret" content="NiHuq5vsn_1c_9CuDpaxaf-p">

  <!-- Head Scripts -->
  @if(get_field('header_scripts', 'option'))
    {{ the_field('header_scripts', 'option') }}
  @endif

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

  @php wp_head() @endphp
 
</head>
