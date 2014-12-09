<?php

/*

@name 			    Judge Type
@package		    GPanel WordPress Framework
@since			    3.0.0
@author 		    Pavel RICHTER <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

/*
====================================================================================================
Post Type Register
====================================================================================================
*/

if (!function_exists('gp_register_judge')) {

	function gp_register_judge() {
		
		register_post_type('judge',
			array (
				'labels' => array(
					'name'					=> __('Judge', 'gp'),
					'menu_name'				=> __('Judges', 'gp'),
					'singular_name'			=> __('Judge', 'gp'),
					'all_items'				=> __('All Judges', 'gp'),
					'add_new'				=> __('Add New Judge', 'gp'),
					'add_new_item'			=> __('Add New Judge', 'gp'),
					'edit_item'				=> __('Edit Judge', 'gp'),
					'new_item'				=> __('New Judge', 'gp'),
					'view_item'				=> __('View Judge', 'gp'),
					'search_items'			=> __('Search Judge', 'gp'),
					'not_found'				=> __('No Judge', 'gp'),
					'not_found_in_trash'	=> __('No Judge Found in Trash', 'gp')
				),
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_nav_menus' 	=> false,
				'show_in_admin_bar' 	=> true,
				'capability_type'		=> 'post',
				'hierarchical'			=> true,
				'exclude_from_search'	=> false,
				'publicly_queryable'	=> true,
				'query_var'				=> true,
				'rewrite'				=> array(
					'slug'					=> 'judge',
					'with_front'			=> true
				),
				'menu_position'			=> 46,
				'menu_icon'				=> 'dashicons-gpicons-judge',
				'supports'				=> array(
					'title',
					'editor',
					'thumbnail',
					'comments',
					'revisions'
				)
			)
		);

	}
	
	add_action('init', 'gp_register_judge');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_judge')) {

	function gp_register_metabox_judge() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Award Options
		--------------------------------------------------
		*/
		
		$current_date = date('Y/m/d');
		
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-judge-options',
			'title'				=> __('Award Options', 'gp'),
			'pages'				=> array('judge'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Judge Name', 'gp'),
					'desc'				=> __('Name of the judge.', 'gp'),
					'id'				=> GP_SHORTNAME . '_judge_name',
					'type'				=> 'input'
				),
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_judge');
	
}

/*
====================================================================================================
Post Type Custom Columns
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Edit
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_judge')) {

	function gp_edit_columns_judge($columns) {
		
		$columns = array(
			'cb'				=> "<input type=\"checkbox\" />",
			'title'				=> __('Judge Title', 'gp'),
			'judge_name'		=> __('Judge name', 'gp'),
			'author'			=> __('Author', 'gp'),
			'date'				=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-judge_columns', 'gp_edit_columns_judge');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Orderby
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_orderby_judge')) {

	function gp_edit_columns_orderby_judge($query) {
		  
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('judge_name' == $orderby) {
			$query->set('meta_key', 'gp_judge_name');
			$query->set('orderby', 'meta_value');
		}
       
	}
	
	add_action('pre_get_posts', 'gp_edit_columns_orderby_judge');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_sorting_judge')) {

	function gp_edit_columns_sorting_judge($column) {
		
		return array(
			'title'				=> 'title',
			'judge_name'		=> 'judge_name',
			'author'			=> 'author',
			'date'				=> 'date'
		);
		
	}
	
	add_filter('manage_edit-judge_sortable_columns', 'gp_edit_columns_sorting_judge');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_judge')) {

	function gp_messages_judge($messages) {
		global $post, $post_ID;
		
		$messages['judge'] = array(
			0		=> '',
			1		=> sprintf(__('Judge updated. <a href="%s">View judge &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Judge updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Award restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Judge published. <a href="%s">View judge &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Judge saved.', 'gp'),
			8		=> sprintf(__('Judge submitted. <a target="_blank" href="%s">Preview judge &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Judge scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview judge &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Judge draft updated. <a target="_blank" href="%s">Preview judge &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_judge');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_judge')) {

	function gp_title_placeholder_judge($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'judge') {
			$title = __('Award judge title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_judge');

}