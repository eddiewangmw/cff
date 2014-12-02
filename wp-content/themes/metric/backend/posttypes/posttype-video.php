<?php

/*

@name 			    Video Post Type
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

if (!function_exists('gp_register_video')) {

	function gp_register_video() {
		
		register_post_type('video',
			array (
				'labels' => array(
					'name'					=> __('Videos', 'gp'),
					'menu_name'				=> __('Videos', 'gp'),
					'singular_name'			=> __('Video', 'gp'),
					'all_items'				=> __('All Videos', 'gp'),
					'add_new'				=> __('Add New Video', 'gp'),
					'add_new_item'			=> __('Add New Video', 'gp'),
					'edit_item'				=> __('Edit Video', 'gp'),
					'new_item'				=> __('New Video', 'gp'),
					'view_item'				=> __('View Video', 'gp'),
					'search_items'			=> __('Search Videos', 'gp'),
					'not_found'				=> __('No Videos', 'gp'),
					'not_found_in_trash'	=> __('No Videos Found in Trash', 'gp')
				),
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_nav_menus' 	=> true,
				'capability_type'		=> 'post',
				'hierarchical'			=> true,
				'exclude_from_search'	=> false,
				'publicly_queryable'	=> true,
				'query_var'				=> true,
				'rewrite'				=> array(
					'slug'					=> 'video',
					'with_front'			=> false
				),
				'menu_position'			=> 48,
				'menu_icon'				=> 'dashicons-gpicons-video',
				'supports'				=> array(
					'author',
					'title',
					'editor',
					'thumbnail',
					'comments',
					'revisions'
				)
			)
		);

	}
	
	add_action('init', 'gp_register_video');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_video')) {

	function gp_register_metabox_video() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Gallery Images
		--------------------------------------------------
		*/
	
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-video',
			'title'				=> __('Video Options', 'gp'),
			'pages'				=> array('video'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('YouTube Video', 'gp'),
					'desc'				=> __('Add YouTube Video URL or CODE. For Example: URL <code>http://www.youtube.com/watch?v=12345abcdef</code> or just CODE <code>12345abcdef</code>. <strong>Please note that Featured Image is required!</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_video_youtube_code',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Vimeo Video', 'gp'),
					'desc'				=> __('Add Vimeo Video URL or CODE. For Example: URL <code>http://vimeo.com/123456789</code> or just CODE <code>123456789</code>. <strong>Please note that Featured Image is required!</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_video_vimeo_code',
					'type'				=> 'input'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_video');

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

if (!function_exists('gp_columns_edit_video')) {

	function gp_columns_edit_video($columns) {
		
		$columns = array(
			'cb'				=> "<input type=\"checkbox\" />",
			'title'				=> __('Video Title', 'gp'),
			'author'			=> __('Author', 'gp'),
			'date'				=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-video_columns', 'gp_columns_edit_video');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_columns_edit_sorting_video')) {

	function gp_columns_edit_sorting_video($column) {
		
		return array(
			'title'				=> 'title',
			'author'			=> 'author',
			'date'				=> 'date'
		);
		
	}
	
	add_filter('manage_edit-video_sortable_columns', 'gp_columns_edit_sorting_video');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_video')) {

	function gp_messages_video($messages) {
		global $post, $post_ID;
		
		$messages['video'] = array(
			0		=> '',
			1		=> sprintf(__('Video updated. <a href="%s">View video &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Video updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Video restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Video published. <a href="%s">View video &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Video saved.', 'gp'),
			8		=> sprintf(__('Video submitted. <a target="_blank" href="%s">Preview Video &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Video scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview video &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Video draft updated. <a target="_blank" href="%s">Preview video &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_video');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_video')) {

	function gp_title_placeholder_video($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'video') {
			$title = __('Enter video title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_video');

}