<?php
if( function_exists('acf_add_options_page') ) {
	acf_add_options_sub_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'General Settings',
		'menu_slug' 	=> 'general-settings',
		'parent_slug'	=> 'index.php',
		'icon_url' 		=> 'dashicons-welcome-widgets-menus',
		'position' => 1,
		'redirect'		=> false
	));
}

if( function_exists('acf_add_local_field_group') ):
	acf_add_local_field_group(array (
		'key' => 'group_584e713b4c10f',
		'title' => 'General Settings',
		'fields' => array (

			array(
				'key' => 'field_5a925d2d30880',
				'label' => 'Header',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),

			array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584e7155a3f1a',
				'label' => 'Main Website Logo',
				'name' => 'website_logo',
				'type' => 'image',
				'instructions' => 'this image we will used it in all website',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584fd6f054958',
				'label' => 'icon',
				'name' => 'favicon',
				'type' => 'image',
				'instructions' => 'icon menu  used Header Fixed top',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'default_value' => '',
				'new_lines' => '',
				'maxlength' => '',
				'placeholder' => '',
				'rows' => '',
				'key' => 'field_584fd7f8e09d5',
				'label' => 'Header Scripts',
				'name' => 'header_scripts',
				'type' => 'textarea',
				'instructions' => 'Add any script you need show it in website header',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
			),

      array (
				'message' => 'You can from here mange you login screen options like background color or images',
				'esc_html' => 0,
				'new_lines' => '',
				'key' => 'field_58adas4242344344e73ad29048',
				'label' => 'Logo Templates and Stuido',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
      ),
      array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584e325009adsksad7155a3f1a',
				'label' => 'Main Templates Logo',
				'name' => 'templates_logo',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
      ),
      array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584e71asf53523535355a3f1a',
				'label' => 'Main Stuido Logo',
				'name' => 'stuido_logo',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
      ),
      
			array(
				'key' => 'field_5a8bdbe963211048163',
				'label' => 'Admin Dashborad page',
				'name' => 'admin_dashborad_page',
				'type' => 'page_link',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'allow_archives' => 0,
				'multiple' => 0,
			),
			array(
				'key' => 'field_5a8bdbe9631021048163',
				'label' => 'Dashborad Page',
				'name' => 'dashborad_page',
				'type' => 'page_link',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'allow_archives' => 0,
				'multiple' => 0,
			),
			array(
				'key' => 'field_5a8bdbe9102f211048163',
				'label' => 'Download Page',
				'name' => 'download_page',
				'type' => 'page_link',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'allow_archives' => 0,
				'multiple' => 0,
			),
      array(
        'key' => 'field_5cbaeads9231434324324f7e6af47',
        'label' => 'link Page items',
        'name' => 'link_page_login',
        'type' => 'page_link',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'page',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'allow_archives' => 1,
        'multiple' => 0,
      ),

      array(
        'key' => 'field_5cbaeads92314343rqwrwrqwrqwrqwr24324f7e6af47',
        'label' => 'link Page Confirm',
        'name' => 'confirm_page',
        'type' => 'page_link',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'page',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'allow_archives' => 1,
        'multiple' => 0,
      ),

      array(
        'key' => 'field_5cbaeads9231434324wqeiusadn2323324f7e6af47',
        'label' => 'link Add New ',
        'name' => 'link_add_new',
        'type' => 'page_link',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'page',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'allow_archives' => 1,
        'multiple' => 0,
      ),

      array(
        'key' => 'field_5cbaeweqqwewewqef7e6af47',
        'label' => 'link Edit item ',
        'name' => 'link_edit_item',
        'type' => 'page_link',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'page',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'allow_archives' => 1,
        'multiple' => 0,
      ),

      array(
        'key' => 'field_5d17d1d0cf372',
        'label' => 'froms problem with download',
        'name' => 'froms_problem_with_download',
        'type' => 'gravity_forms_field',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'allow_null' => 0,
        'allow_multiple' => 0,
      ),


      array(
        'key' => 'field_5c23444657657f47',
        'label' => 'link Sing In Page',
        'name' => 'link_signin',
        'type' => 'page_link',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'page',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'allow_archives' => 1,
        'multiple' => 0,
      ),


      array(
        'key' => 'field_532r234ds23e6af47',
        'label' => 'link Sing up Page ',
        'name' => 'link_signup',
        'type' => 'page_link',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'page',
        ),
        'taxonomy' => '',
        'allow_null' => 0,
        'allow_archives' => 1,
        'multiple' => 0,
      ),

		  array(
				'key' => 'field_fdsfsdfwererwe5a931c668284d',
				'label' => 'Welcome',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),

			array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584fwerwasdasd123sf43434',
				'label' => 'Welcome Banner',
				'name' => 'image_welcome_banner',
				'type' => 'image',
				'instructions' => 'we can used for welcome image background ( 600px * 400px ) png',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),

      array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584fwerwasdasd00ewksdaerew123sf43434',
				'label' => 'Welcome background',
				'name' => 'image_welcome_background',
				'type' => 'image',
				'instructions' => 'we can used for welcome image background ( 1440px * 735px ) png',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
      ),
      
			array (
				'key' => 'field_58ad83ssefasfe7qwewqeqweqweqwbds8d7b',
				'label' => 'Headline Welcome banner',
				'name' => 'headline_welcome_banner',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
			),

			array (
				'key' => 'field_58ad83ssefwrewrewrvvvasfe7qwewqeqweqweqwbds8d7b',
				'label' => 'Sub title Welcome banner',
				'name' => 'sub_headline_welcome_banner',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
			),

			array (
				'key' => 'field_58adsafasfasfasf83ssefasfe7bds8d7b',
				'label' => '@link Welcome banner',
				'name' => 'link_welcome_banner',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
      ),
      

      array(
				'key' => 'field_5a9254343asddsd2fafasfad30880',
				'label' => 'Others',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array (
				'message' => 'You can from here mange you login screen options like background color or images',
				'esc_html' => 0,
				'new_lines' => '',
				'key' => 'field_584e73ad29048',
				'label' => 'Login Screen Settings',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'layout' => 'horizontal',
				'choices' => array (
					'background-image' => 'Background Image',
					'background-color' => 'Background Color',
				),
				'default_value' => '',
				'other_choice' => 0,
				'save_other_choice' => 0,
				'allow_null' => 0,
				'return_format' => 'value',
				'key' => 'field_584e740496708',
				'label' => 'Select you design',
				'name' => 'select_you_design',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'default_value' => '#999999',
				'key' => 'field_584e7481838ad',
				'label' => 'Select you Color',
				'name' => 'select_you_color',
				'type' => 'color_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_584e740496708',
							'operator' => '==',
							'value' => 'background-color',
						),
					),
				),
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584e74b7838ae',
				'label' => 'Upload you Image',
				'name' => 'upload_you_image',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_584e740496708',
							'operator' => '==',
							'value' => 'background-image',
						),
					),
				),
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),

			array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584fd68654956',
				'label' => 'Default Image',
				'name' => 'default_image',
				'type' => 'image',
				'instructions' => 'we can used this Default Image for the any pics didn\'t load or empty images',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
      ),
      
      array(
				'key' => 'field_5aewqe3449254343asddsd2fafasfad30880',
				'label' => 'Sections',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
      ),
      
      array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584fd6sadsadsads8654956',
				'label' => 'Header Section Image',
				'name' => 'header_section_image',
				'type' => 'image',
				'instructions' => 'we can used this Image for the any Header pages',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
      ),


		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'general-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;
