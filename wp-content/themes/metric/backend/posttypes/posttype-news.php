<?php

/*

@name 			    News Type
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

if (!function_exists('gp_register_news')) {

	function gp_register_news() {
		
		register_post_type('news',
			array (
				'labels' => array(
					'name'					=> __('News', 'gp'),
					'menu_name'				=> __('Newss', 'gp'),
					'singular_name'			=> __('News', 'gp'),
					'all_items'				=> __('All Newss', 'gp'),
					'add_new'				=> __('Add New News', 'gp'),
					'add_new_item'			=> __('Add New News', 'gp'),
					'edit_item'				=> __('Edit News', 'gp'),
					'new_item'				=> __('New News', 'gp'),
					'view_item'				=> __('View News', 'gp'),
					'search_items'			=> __('Search News', 'gp'),
					'not_found'				=> __('No News', 'gp'),
					'not_found_in_trash'	=> __('No News Found in Trash', 'gp')
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
					'slug'					=> 'news',
					'with_front'			=> true
				),
				'menu_position'			=> 46,
				'menu_icon'				=> 'dashicons-gpicons-news',
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
	
	add_action('init', 'gp_register_news');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_news')) {

	function gp_register_metabox_news() {
		
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
			'id'				=> 'gp-metabox-posttype-news-options',
			'title'				=> __('Award Options', 'gp'),
			'pages'				=> array('news'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'=>array()
			
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_news');
	
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

if (!function_exists('gp_edit_columns_news')) {

	function gp_edit_columns_news($columns) {
		
		$columns = array(
			'cb'				=> "<input type=\"checkbox\" />",
			'title'				=> __('News Title', 'gp'),
			'author'			=> __('Author', 'gp'),
			'date'				=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-news_columns', 'gp_edit_columns_news');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_news')) {

	function gp_messages_news($messages) {
		global $post, $post_ID;
		
		$messages['news'] = array(
			0		=> '',
			1		=> sprintf(__('News updated. <a href="%s">View news &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('News updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Award restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('News published. <a href="%s">View news &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('News saved.', 'gp'),
			8		=> sprintf(__('News submitted. <a target="_blank" href="%s">Preview news &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('News scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview news &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('News draft updated. <a target="_blank" href="%s">Preview news &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_news');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_news')) {

	function gp_title_placeholder_news($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'news') {
			$title = __('Award news title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_news');

}