<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="manifest"
        href="{{ get_theme_file_uri() . '/resources/assets/images/favicons' }}/manifest.json">
    <meta name="msapplication-TileColor" content="#1E6CFC">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#1E6CFC">
    <meta name="robots" content="index, follow" />
    @php wp_head() @endphp

    <!--custom Head Scripts -->
    @if (get_field('header_scripts', 'option'))
        {{ the_field('header_scripts', 'option') }}
    @else
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-103603396-1">
        </script>


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-103603396-1">
        </script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-103603396-1', {
                'optimize_id': 'GTM-PSBHXMP'
            });
        </script>
    @endif
</head>
