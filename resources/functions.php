<?php

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__ . '/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__) . '/config/assets.php',
            'theme' => require dirname(__DIR__) . '/config/theme.php',
            'view' => require dirname(__DIR__) . '/config/view.php',
            'framework' => require dirname(__DIR__) . '/framework/index.php',
        ]);
    }, true);


add_action('wp_enqueue_scripts', 'the_dramatist_enqueue_scripts');
add_filter('ajax_query_attachments_args', 'the_dramatist_filter_media');
add_shortcode('the_dramatist_front_upload', 'the_dramatist_front_upload');


/**
 * Call wp_enqueue_media() to load up all the scripts we need for media uploader
 */


if (!is_singular('product')) {
    function the_dramatist_enqueue_scripts()
    {
        if (!is_tax('product_cat')) {
            wp_enqueue_media();
            wp_enqueue_script(
                'some-script',
                get_theme_file_uri() . '/framework/assets/media-uploader.js',
                array('jquery'),
                null
            );
        }
    }
}

/**
 * This filter insures users only see their own media
 */
function the_dramatist_filter_media($query)
{
    // admins get to see everything
    if (!current_user_can('manage_options'))
        $query['author'] = get_current_user_id();
    return $query;
}



function custom_rewrite_basic()
{
    add_rewrite_rule('product$', 'index.php?product=true', 'top');
    add_rewrite_rule('product/page/?([0-9]{1,})/?$', 'index.php?product=true&paged=$matches[1]', 'top');
    add_rewrite_rule('product/feed/(feed|rdf|rss|rss2|atom)/?$', 'index.php?product=true&feed=$matches[1]', 'top');
    add_rewrite_rule('product/(feed|rdf|rss|rss2|atom)/?$', 'index.php?product=true&feed=$matches[1]', 'top');
}

add_action('init', 'custom_rewrite_basic');


// Register Elmenetor theme location
function theme_prefix_register_elementor_locations($elementor_theme_manager)
{
    $elementor_theme_manager->register_location('header');
    $elementor_theme_manager->register_location('footer');
    $elementor_theme_manager->register_location('single');
    $elementor_theme_manager->register_location('archive');
}
add_action('elementor/theme/register_locations', 'theme_prefix_register_elementor_locations');



// override woocommerce.css
add_filter('woocommerce_enqueue_styles', '__return_empty_array');
