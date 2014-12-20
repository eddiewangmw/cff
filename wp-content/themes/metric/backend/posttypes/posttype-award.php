<?php

/*

@name 			    Award Post Type
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

if (!function_exists('gp_register_award')) {

	function gp_register_award() {
		
		register_post_type('award',
			array (
				'labels' => array(
					'name'					=> __('Award', 'gp'),
					'menu_name'				=> __('Awards', 'gp'),
					'singular_name'			=> __('Award', 'gp'),
					'all_items'				=> __('All Awards', 'gp'),
					'add_new'				=> __('Add New Award', 'gp'),
					'add_new_item'			=> __('Add New Award', 'gp'),
					'edit_item'				=> __('Edit Award', 'gp'),
					'new_item'				=> __('New Award', 'gp'),
					'view_item'				=> __('View Award', 'gp'),
					'search_items'			=> __('Search Award', 'gp'),
					'not_found'				=> __('No Award', 'gp'),
					'not_found_in_trash'	=> __('No Award Found in Trash', 'gp')
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
					'slug'					=> 'award',
					'with_front'			=> true
				),
				'menu_position'			=> 46,
				'menu_icon'				=> 'dashicons-gpicons-slide',
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
	
	add_action('init', 'gp_register_award');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_award')) {

	function gp_register_metabox_award() {
		
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
			'id'				=> 'gp-metabox-posttype-award-options',
			'title'				=> __('Award Options', 'gp'),
			'pages'				=> array('award'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Movie Title', 'gp'),
					'desc'				=> __('Name of the movie.<br /> <strong class="highlight">Required to display movie.</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_award_title',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Play Date', 'gp'),
					'desc'				=> __('Select play date of the movie.<br /> <strong class="highlight">Required to display movie.</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_award_date',
					'type'				=> 'picker_date',
					'std'				=> $current_date
				),
				array(
					'name'				=> __('Writer', 'gp'),
					'desc'				=> __('Fill the movie writer.', 'gp'),
					'id'				=> GP_SHORTNAME . '_award_writer',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Stars', 'gp'),
					'desc'				=> __('Fill the movie stars.', 'gp'),
					'id'				=> GP_SHORTNAME . '_award_stars',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Director', 'gp'),
					'desc'				=> __('Fill the movie director.', 'gp'),
					'id'				=> GP_SHORTNAME . '_movie_director',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('YouTube Video', 'gp'),
					'desc'				=> __('Add YouTube Video URL or CODE. For Example: URL <code>http://www.youtube.com/watch?v=12345abcdef</code> or just CODE <code>12345abcdef</code>.', 'gp'),
					'id'				=> GP_SHORTNAME . '_award_youtube_code',
					'type'				=> 'input'
				)
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_award');
	
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

if (!function_exists('gp_edit_columns_award')) {

	function gp_edit_columns_award($columns) {
		
		$columns = array(
			'cb'				=> "<input type=\"checkbox\" />",
			'title'				=> __('Award Title', 'gp'),
			'award_date'		=> __('Play Date', 'gp'),
			'author'			=> __('Author', 'gp'),
			'date'				=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-award_columns', 'gp_edit_columns_award');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_content_award')) {

	function gp_edit_columns_content_award($column, $post_ID) {
	
		switch($column) {
			
			// Start Date
			case 'award_date':
	
				$award_date = gp_meta('gp_award_date');
				if (empty($award_date)) {
					echo __('/', 'gp');
				} else {
					printf('%s', $award_date);
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_award_posts_custom_column', 'gp_edit_columns_content_award', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Orderby
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_orderby_award')) {

	function gp_edit_columns_orderby_award($query) {
		  
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('award_date' == $orderby) {
			$query->set('meta_key', 'gp_award_date');
			$query->set('orderby', 'meta_value');
		}
        if ('award_title' == $orderby) {
            $query->set('meta_key', 'gp_award_title');
            $query->set('orderby', 'meta_value');
        }
		
	}
	
	add_action('pre_get_posts', 'gp_edit_columns_orderby_award');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_sorting_award')) {

	function gp_edit_columns_sorting_award($column) {
		
		return array(
			'title'				=> 'title',
			'award_date'		=> 'award_date',
			'author'			=> 'author',
			'date'				=> 'date'
		);
		
	}
	
	add_filter('manage_edit-award_sortable_columns', 'gp_edit_columns_sorting_award');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_award')) {

	function gp_messages_award($messages) {
		global $post, $post_ID;
		
		$messages['award'] = array(
			0		=> '',
			1		=> sprintf(__('Award updated. <a href="%s">View award &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Award updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Award restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Award published. <a href="%s">View award &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Award saved.', 'gp'),
			8		=> sprintf(__('Award submitted. <a target="_blank" href="%s">Preview award &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Award scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview award &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Award draft updated. <a target="_blank" href="%s">Preview award &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_award');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_award')) {

	function gp_title_placeholder_award($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'award') {
			$title = __('Award award title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_award');

}