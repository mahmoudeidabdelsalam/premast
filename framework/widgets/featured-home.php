<?php
use Roots\Sage\Assets;
class FeaturedSlider extends WP_Widget {

  function __construct() {
    $widget_options = array();
    $widget_options['description'] = "FeaturedSlider";
    parent::__construct(false, ' Featured Slider', $widget_options);
  }

  function form($instance) { ?>
    <p>
      <img src='<?= Assets\asset_path('images/widgets/FeaturedSlider.png'); ?>' class="img-responsive" >
    </p>
    <?php

  }

  function update($new_instance, $old_imstance) {
    $instance = $old_imstance;
    return $instance;
  }

  function widget($args, $instance) {
    ?>


    <?php
  }
}
register_widget('FeaturedSlider');
