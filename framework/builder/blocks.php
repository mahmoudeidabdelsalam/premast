<?php

$files = array_merge(
	glob(__DIR__.'/acf-blocks/*.php')
);
foreach ($files as $filename)
{
	include $filename;
}

add_filter( 'block_categories', function( $categories, $post ) {
	return array_merge(
			$categories,
			array(
					array(
							'slug'  => 'builder',
							'title' => 'Builder',
					),
			)
	);
}, 10, 2 );

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	// check function exists
	if( function_exists('acf_register_block') ) {

    // register Feature News
		acf_register_block(array(
			'name'				      => 'header',
      'title'				      => __('Header'),
      'description'		    => __('Image logo with & call to action.'),
      'render_callback'	  => 'my_acf_block_render_callback',
			'category'			    => 'builder',
			'icon'				      => 'schedule',
    ));
    
		// register Feature News
		acf_register_block(array(
			'name'				      => 'banner',
      'title'				      => __('banner top'),
      'description'		    => __('here insert Images animtions and background with content and call to action.'),
			'render_callback'	  => 'my_acf_block_render_callback',
			'category'			    => 'builder',
			'icon'				      => 'images-alt2',
    ));
    
		// register Feature News
		acf_register_block(array(
			'name'				      => 'banner-about',
      'title'				      => __('content & icon'),
      'description'		    => __('here insert Images animtions and icons with content.'),
			'render_callback'	  => 'my_acf_block_render_callback',
			'category'			    => 'builder',
			'icon'				      => 'images-alt2',
    ));
    
		// register Feature News
		acf_register_block(array(
			'name'				      => 'features',
      'title'				      => __('features'),
      'description'		    => __('here insert features item content.'),
			'render_callback'	  => 'my_acf_block_render_callback',
			'category'			    => 'builder',
			'icon'				      => 'paperclip',
    ));

    // register Feature News
		acf_register_block(array(
			'name'				      => 'model-items',
      'title'				      => __('model items'),
      'description'		    => __('here insert model items content & image.'),
			'render_callback'	  => 'my_acf_block_render_callback',
			'category'			    => 'builder',
			'icon'				      => 'align-right',
    ));
    
    // register Feature News
		acf_register_block(array(
			'name'				      => 'subscribe',
      'title'				      => __('subscribe'),
      'description'		    => __('here insert subscribe'),
			'render_callback'	  => 'my_acf_block_render_callback',
			'category'			    => 'builder',
			'icon'				      => 'email',
    ));
    
    // register Feature News
		acf_register_block(array(
			'name'				      => 'call-of-action',
      'title'				      => __('call of action'),
      'description'		    => __('here insert Content and buttons'),
			'render_callback'	  => 'my_acf_block_render_callback',
			'category'			    => 'builder',
			'icon'				      => 'microphone',
    ));
    
    // register Feature News
		acf_register_block(array(
			'name'				      => 'footer',
      'title'				      => __('footer'),
      'description'		    => __('Image logo with & call to action.'),
			'render_callback'	  => 'my_acf_block_render_callback',
			'category'			    => 'builder',
			'icon'				      => 'schedule',
    ));

  }
}

function my_acf_block_render_callback( $block ) {
  // convert name ("acf/testimonial") into path friendly slug ("testimonial")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from within the "template-parts/block" folder
  if ( is_admin() ) {
    if( file_exists( get_theme_file_path() . "/framework/builder/back-end/block-content-{$slug}.php") )  {
      include( get_theme_file_path() . "/framework/builder/back-end/block-content-{$slug}.php") ;
    }
  }else{
    if( file_exists( get_theme_file_path() . "/framework/builder/front-end/block-content-{$slug}.php" ) ) {
      include( get_theme_file_path() . "/framework/builder/front-end/block-content-{$slug}.php" );
    }
  }
}


function custom_styles_admin() {
  ?>
  <style>
  .c95_admin_bar_stage{
    background: #ffa5001c !important ;
  }
  .c95_admin_bar_stage a{
    text-transform: capitalize !important ;
  }
  .acf-field-message, .acf-field-object-message{
    background-color : #f1f1f1 ;
  }
  .count_shortcodes, .id_of_textbox_user_typed_in{
    height: 30px;
    border-radius: 5px;
    margin: 0;
  }
  #button_clicked{
    float :right;
  }
  .text-center{
    text-align: center;
  }
  .text-or{
    background-color: #fff;
    width: 10%;
    margin: -19px auto;
  }
  .span-dashicons{
    margin-top: 3px;
  }
  .pre-dd{
    direction: ltr;
    background-color: rgba(128, 128, 128, 0.27);
    padding: 20px 50px;
  }
  .img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
  }
  .taxonomy-category [data-name="category_colors"] ul.acf-radio-list li{
    background: #f9f9f9;
    padding: 10px;
    width: 43%;
    float: left;
    margin: 2% 0.5%;
    box-shadow: 1px 1px 1px #ddd;
  }
  .taxonomy-category.term-php [data-name="category_colors"] ul.acf-radio-list li{
    width: 15%;
  }
  .taxonomy-category [data-name="category_colors"] ul.acf-radio-list li{
    border-bottom: 3px solid;
  }
  /* fix ACF 2select*/
  html[dir="rtl"] .select2-search-choice-close {
    right: auto;
    left: 24px;
  }
  /* fix large image preview of tax meta class */
  .simplePanelImagePreview img {
    max-width: 50%;
  }
  /* notification style */
  .wp-ui-notification.c95-badge {
    display: inline;
    padding: 1px 4px !important;
    border-radius: 50%;
    color: #fff;
  }
  body.block-editor-page {
    background: #e7e7e7;
  }
  .wp-block {
    width: 100% !important;
    max-width: 100%;
    background-color: #fff;
    padding: 15px;
    margin: 20px 0 !important;
  }
  .acf-gallery .acf-gallery-main  ul.acf-hl {
    display: flex;
    flex-flow: column;
  }
  .acf-gallery .acf-gallery-main ul.acf-hl li, .acf-gallery .acf-gallery-main ul.acf-hl li a {
    width: 100%;
    text-align: center;
  }
  .acf-gallery .acf-gallery-main ul.acf-hl li {
    margin: 10px 0;
  }  
  label[for="acf-field_5dad8f6e56cc4"] {
    display: none !important;
  }
  .edit-post-visual-editor .block-editor-block-list__block .block-editor-block-list__block-edit {
    margin: 28px 0;
  }
  .error.wpml-admin-notice{
     display: none;
  }
  .block-editor__container {
    background-color: #23282d;
    border: none !important;
    box-shadow: none !important;
  }
  .edit-post-layout__metaboxes:not(:empty) {
    background-color: #fff;
    padding: 20px !important;
  }
  </style>
    
  <?php
}
add_action('admin_head', 'custom_styles_admin');

function gutenbergtheme_editor_styles() {
    wp_enqueue_style( 'gutenbergtheme-blocks-style', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
}
add_action( 'enqueue_block_editor_assets', 'gutenbergtheme_editor_styles' );
