<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="manifest"
         href="{{ get_theme_file_uri() . '/resources/assets/images/favicons' }}/manifest.json">
   <meta name="msapplication-TileColor" content="#1E6CFC">
   <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
   <meta name="theme-color" content="#1E6CFC">
   <meta name="robots" content="index, follow" />

   <script src="<?= get_theme_file_uri() . '/framework/assets/hello-bubble-app.umd.js?v63' ?>"
           defer=""></script>


   @php wp_head() @endphp


   <!-- Head Scripts -->
   @if (get_field('header_scripts', 'option'))
      {{ the_field('header_scripts', 'option') }}
   @else
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-103603396-1"></script>

      <!-- Hotjar Tracking Code for http://premast.com/ -->
      <!--
    <script>
       (function(h, o, t, j, a, r) {
          h.hj = h.hj || function() {
             (h.hj.q = h.hj.q || []).push(arguments)
          };
          h._hjSettings = {
             hjid: 1386544,
             hjsv: 6
          };
          a = o.getElementsByTagName('head')[0];
          r = o.createElement('script');
          r.async = 1;
          r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
          a.appendChild(r);
       })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    -->



      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-103603396-1"></script>
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


      <!-- Matomo -->
      <!-- <script type="text/javascript">
         var _paq = window._paq || [];
         /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
         _paq.push(['trackPageView']);
         _paq.push(['enableLinkTracking']);
         (function() {
            var u = "https://premast.matomo.cloud/";
            _paq.push(['setTrackerUrl', u + 'matomo.php']);
            _paq.push(['setSiteId', '1']);
            var d = document,
               g = d.createElement('script'),
               s = d.getElementsByTagName('script')[0];
            g.type = 'text/javascript';
            g.async = true;
            g.defer = true;
            g.src = '//cdn.matomo.cloud/premast.matomo.cloud/matomo.js';
            s.parentNode.insertBefore(g, s);
         })();
      </script>
    -->
      <!-- End Matomo Code -->

      <!-- mailchaimp -->
      <script id="mcjs">
         ! function(c, h, i, m, p) {
            m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode
               .insertBefore(m, p)
         }(document, "script",
            "https://chimpstatic.com/mcjs-connected/js/users/022c13d7ed1b3a7bffe94a937/79c0d2d42087e7c1fd89249af.js"
         );
      </script>

      <!-- Begin Inspectlet Asynchronous Code -->
      <!--
    <script type="text/javascript">
       (function() {
          window.__insp = window.__insp || [];
          __insp.push(['wid', 839776136]);
          var ldinsp = function() {
             if (typeof window.__inspld != "undefined") return;
             window.__inspld = 1;
             var insp = document.createElement('script');
             insp.type = 'text/javascript';
             insp.async = true;
             insp.id = "inspsync";
             insp.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://cdn.inspectlet.com/inspectlet.js?wid=839776136&r=' + Math.floor(new Date()
                   .getTime() / 3600000);
             var x = document.getElementsByTagName('script')[0];
             x.parentNode.insertBefore(insp, x);
          };
          setTimeout(ldinsp, 0);
       })();
    </script>
    -->
      <!-- End Inspectlet Asynchronous Code -->
   @endif







</head>
