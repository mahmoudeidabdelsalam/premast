<?php
/**
 * Create admin Page to list unsubscribed emails.
 */
 // Hook for adding admin menus
 add_action('admin_menu', 'paddle_add_pages');
 
 // action function for above hook
 
/**
 * Adds a new top-level page to the administration menu.
 */
function paddle_add_pages() {
  add_menu_page( 'Paddle ship List', 'Paddle Log', 'manage_options', 'paddle-csutom', 'paddle_page_callback', '', 1 );
}



if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5ea883b707237',
	'title' => 'Paddle plan',
	'fields' => array(
		array(
			'key' => 'field_5ea883cdacf20',
			'label' => 'subscription Plan Paddle One',
			'name' => 'subscription_plan_paddle_one',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_5ea88437acf21',
			'label' => 'Member Ship Plan One',
			'name' => 'member_ship_plan_one',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'wc_membership_plan',
			),
			'taxonomy' => '',
			'allow_null' => 0,
			'multiple' => 0,
			'return_format' => 'id',
			'ui' => 1,
		),
		array(
			'key' => 'field_5ea88473acf22',
			'label' => 'subscription Plan Paddle Two',
			'name' => 'subscription_plan_paddle_two',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_5ea8847eacf24',
			'label' => 'Member Ship Plan Two',
			'name' => 'member_ship_plan_two',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'wc_membership_plan',
			),
			'taxonomy' => '',
			'allow_null' => 0,
			'multiple' => 0,
			'return_format' => 'id',
			'ui' => 1,
		),
		array(
			'key' => 'field_5ea88476acf23',
			'label' => 'subscription Plan Paddle Three',
			'name' => 'subscription_plan_paddle_three',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_5ea884a9acf25',
			'label' => 'Member Ship Plan Three',
			'name' => 'member_ship_plan_three',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'wc_membership_plan',
			),
			'taxonomy' => '',
			'allow_null' => 0,
			'multiple' => 0,
			'return_format' => 'id',
			'ui' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'paddle-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;