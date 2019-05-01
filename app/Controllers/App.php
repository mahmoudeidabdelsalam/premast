<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    /**
    * Function Name: Welcome Home()
    * This Function is used to return background, Headline, Subtitle and link For Welcome Section
    * @return array | the value of url image, text and link ACF
    * This function is called in home/section-welcome file
    */
    public function WelcomeHome() {
      $welcome_res = array(
        'image'          => get_field('image_welcome_banner', 'option'),
        'background'     => get_field('image_welcome_background', 'option'),
        'headline'       => get_field('headline_welcome_banner', 'option'),
        'description'    => get_field('sub_headline_welcome_banner', 'option'),
        'link'           => get_field('link_welcome_banner', 'option'),
      );
      return  $welcome_res;
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }
}
