<?php

namespace PMST\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

use function App\asset_path;

// for security - if someone tries to access this file directly, exit
if (!defined('ABSPATH')) {
   exit;
}

wp_register_style('elementor-custom', get_theme_file_uri() . '/framework/elementor/widgets/templates-showcase/templates-showcase.css', [], null);
wp_enqueue_style('elementor-custom');

class Templates_showcase extends Widget_Base
{


   public function get_name()
   {
      return 'templates_showcase';
   }

   public function get_title()
   {
      return 'Templates Showcase';
   }

   public function get_icon()
   {
      return 'fa fa-code';
   }

   public function get_categories()
   {
      return ['general'];
   }

   public function _register_controls()
   {
      $this->start_controls_section(
         'content_section',
         [
            'label' => 'Layout',
         ]
      );

      $this->add_control(
         'columns',
         [
            'label' => 'Columns',
            'type' => Controls_Manager::SELECT,
            'default' => '3',
            'options' => [
               '1' => '1',
               '2' => '2',
               '3' => '3',
               '4' => '4',
               '5' => '5',
               '6' => '6',
            ],
         ]
      );
      $this->add_control(
         'posts_per_page',
         [
            'label' => 'Posts per page',
            'type' => Controls_Manager::NUMBER,
            'default' => '6',
         ]
      );
      $this->end_controls_section();
   }

   // PHP Render function
   protected function render()
   {
      $settings = $this->get_settings_for_display();
      $templates = get_posts([
         'post_type' => 'product',
         'posts_per_page' => $settings['posts_per_page'],
         'orderby' => 'date',
         'order' => 'DESC',
         'tax_query' => [
            [
               'taxonomy' => 'product_cat',
               'field' => 'slug',
               'terms' => 'presentation',
            ],
         ],
         'meta_query' => [
            [
               'key' => 'slide_gallery',
               'compare' => 'EXISTS',
            ],
         ],
      ]);
      $columns = $settings['columns'];
      $column_class = 'col-md-' . (12 / $columns);

      echo '<div class="row">';

      foreach ($templates as $template) {
         $template_id = $template->ID;
         $template_title = $template->post_title;
         $template_link = get_permalink($template_id);
         $product = wc_get_product($template_id);
         $template_images = $product->get_gallery_image_ids();
         $image_one = wp_get_attachment_image_src($template_images[0], 'large');
         $image_two = wp_get_attachment_image_src($template_images[1], 'medium');
         $slides_gallery = get_field('slide_gallery', $template_id);
         if ($slides_gallery) {
            $image_one = wp_get_attachment_image_src($slides_gallery[0]['ID'], 'large');
            $image_two = wp_get_attachment_image_src($slides_gallery[1]['ID'], 'medium');
         }






         echo /*html*/ "

         <div class='$column_class'>
            <div class='template-card'>
               <a href='$template_link' target='_blank'>
               <div class='template-card__images'>
                  <img src='$image_one[0]' alt='$template_title' class='template-card__image--one' />
                  <img src='$image_two[0]' alt='$template_title' class='template-card__image--two' />
               </div>
                  <div class='template-card__content mt-4'>
                     <h6 class='text-truncate'>$template_title</h6>
                  </div>
               </a>
            </div>
         </div>
         ";
      }

      echo '</div>';
   }

   // JS Render function
   protected function _content_template()
   {
   }


   // Load widget styles
   public function get_style_depends()
   {
      return ['templates-showcase'];
   }
}
