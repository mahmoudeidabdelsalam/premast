<?php

/**
 * Elementor Custom Widgets
 */

namespace PMST\Elementor;

class widgets_loader
{

   private static $_instance = null;

   public static function instance()
   {
      if (is_null(self::$_instance)) {
         self::$_instance = new self();
      }
      return self::$_instance;
   }

   public function init_widgets()
   {
      // Include Widget files
      require_once(__DIR__ . '/widgets/templates-showcase/templates-showcase.php');

      // Register widget
      \Elementor\Plugin::instance()->widgets_manager->register(new Widgets\templates_showcase());
   }

   public function __construct()
   {
      add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
   }
}

// Instantiate the class
widgets_loader::instance();
