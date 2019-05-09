<?php
 /**
 * Load all custome fields folder
 * Load all page templates
 */

 $files = array_merge(
   glob(__DIR__.'/utilities/*.php'),
   glob(__DIR__.'/hooks/*.php'),
   glob(__DIR__.'/custom-fields/*.php'),
   glob(__DIR__.'/post-type/*.php'),
   glob(__DIR__.'/taxonomies/*.php'),
   glob(__DIR__.'/backend/*.php'),
   glob(__DIR__.'/ajax/*.php'),
   glob(__DIR__.'/widgets/*.php')
 );
 
 foreach ($files as $filename)
 {
   include $filename;
 }

 if ( (isset($_GET['action']) && $_GET['action'] != 'logout') || (isset($_POST['login_location']) && !empty($_POST['login_location'])) ) {
    add_filter('login_redirect', 'my_login_redirect', 10, 3);
    function my_login_redirect() {
        $location = $_SERVER['HTTP_REFERER'];
        wp_safe_redirect($location);
        exit();
    }
}