<?php

/*

@name 			    Slide Post Type
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

if (!function_exists('gp_register_slide')) {

	function gp_register_slide() {
		
		register_post_type('slide',
			array (
				'labels' => array(
					'name'					=> __('Slides', 'gp'),
					'menu_name'				=> __('Slides', 'gp'),
					'singular_name'			=> __('Slide', 'gp'),
					'all_items'				=> __('All Slides', 'gp'),
					'add_new'				=> __('Add New Slide', 'gp'),
					'add_new_item'			=> __('Add New Slide', 'gp'),
					'edit_item'				=> __('Edit Slide', 'gp'),
					'new_item'				=> __('New Slide', 'gp'),
					'view_item'				=> __('View Slide', 'gp'),
					'search_items'			=> __('Search Slides', 'gp'),
					'not_found'				=> __('No Slides', 'gp'),
					'not_found_in_trash'	=> __('No Slides Found in Trash', 'gp')
				),
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_nav_menus' 	=> false,
				'capability_type'		=> 'post',
				'hierarchical'			=> false,
				'exclude_from_search'	=> true,
				'publicly_queryable'	=> false,
				'query_var'				=> true,
				'rewrite'				=> array(
					'slug'					=> 'slide',
					'with_front'			=> false
				),
				'menu_position'			=> 44,
				'menu_icon'				=> 'dashicons-gpicons-slide',
				'supports'				=> array(
					'title',
					'thumbnail'
				)
			)
		);

	}
	
	add_action('init', 'gp_register_slide');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_slide')) {

	function gp_register_metabox_slide() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		$posts = query_posts(array('post_type'=>'page','posts_per_page'=>-1));
		foreach($posts AS $post){
			// var_dump($post->post_title);
			$pages[$post->ID]=$post->post_title;
		}

		wp_reset_query();
		/*
		--------------------------------------------------
		Slide Options
		--------------------------------------------------
		*/
	
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-slide',
			'title'				=> __('Slide Options', 'gp'),
			'pages'				=> array('slide'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Show Title', 'gp'),
					'id'				=> GP_SHORTNAME . '_slide_title',
					'type'				=> 'checkbox',
					'std'				=> '1'
				),
				array(
					'name'				=> __('Caption', 'gp'),
					'desc'				=> __('Add caption of the slide.', 'gp'),
					'id'				=> GP_SHORTNAME . '_slide_caption',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('The URL', 'gp'),
					'desc'				=> __('Insert the URL you wish to link to.', 'gp'),
					'id'				=> GP_SHORTNAME . '_slide_url',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('YouTube Video', 'gp'),
					'desc'				=> __('Add YouTube Video URL or CODE. For Example: URL <code>http://www.youtube.com/watch?v=12345abcdef</code> or just CODE <code>12345abcdef</code>. <strong>Please note that Featured Image is required!</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_slide_youtube_code',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Vimeo Video', 'gp'),
					'desc'				=> __('Add Vimeo Video URL or CODE. For Example: URL <code>http://vimeo.com/123456789</code> or just CODE <code>123456789</code>. <strong>Please note that Featured Image is required!</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_slide_vimeo_code',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Video Fullscreen', 'gp'),
					'desc'				=> __('Check if you want to show video in full width and height of slideshow container. Title and Caption will be hidden.', 'gp'),
			
					'id'				=> GP_SHORTNAME . '_slide_video_full',
					'type'				=> 'checkbox',
					'std'				=> '0'
				),
				array(
					'name'				=> __('Transition Effect', 'gp'),
					'desc'				=> __('Select an appearance transition of this slide. Demo of the transitions on <a href="http://www.themepunch.com/codecanyon/revolution/" target="_blank">http://www.themepunch.com/codecanyon/revolution</a>.<br /> Use Default = Default transition selected in Appearance > Theme Options > General Settings (tab) > Slideshow (section) > Default Transition', 'gp'),
					'id'				=> GP_SHORTNAME . '_slide_transition',
					'type'				=> 'select',
					'std'				=> 'default',
					'options'           => array(
                       'default'                => __('Use Default', 'gp'),
                       'boxslide'               => __('Boxslide', 'gp'),
                       'boxfade'                => __('Boxfade', 'gp'),
                       'slotzoom-horizontal'    => __('Slotzoom Horizontal', 'gp'),
                       'slotzoom-vertical'      => __('Slotzoom Vertical', 'gp'),
                       'slotslide-horizontal'   => __('Slotslide Horizontal', 'gp'),
                       'slotslide-vertical'     => __('Slotslide Vertical', 'gp'),
                       'slotfade-horizontal'    => __('Slotfade Vertical', 'gp'),
                       'curtain-1'              => __('Curtain 1', 'gp'),
                       'curtain-2'              => __('Curtain 2', 'gp'),
                       'curtain-3'              => __('Curtain 3', 'gp'),
                       'slideleft'              => __('Slideleft', 'gp'),
                       'slideright'             => __('Slideright', 'gp'),
                       'slideup'                => __('Slideup', 'gp'),
                       'slidedown'              => __('Slidedown', 'gp'),
                       'slidehorizontal'        => __('Slidehorizontal', 'gp'),
                       'slidevertical'          => __('Slidevertical', 'gp'),
                       'fade'                   => __('Fade', 'gp'),
                       'papercut'               => __('Papercut', 'gp'),
                       'flyin'                  => __('Flyin', 'gp'),
                       'turnoff'                => __('Turnoff', 'gp'),
                       'cube'                   => __('Cube', 'gp'),
                       '3dcurtain-vertical'     => __('3dcurtain Vertical', 'gp'),
                       '3dcurtain-horizontal'   => __('3dcurtain Horizontal', 'gp'),
                       'random'                 => __('Random', 'gp'),
                       'random-premium'         => __('Random Premium', 'gp')
					)
				),
				array(
					'name'=>__('Page','gp'),
					'desc'=>__('Slide dispalay page'),
					'id'=>GP_SHORTNAME . '_slide_page',
					'type'=>'select',
					'options'=>$pages
				),
				array(
					'name'				=> __('Speed of Transition', 'gp'),
					'desc'				=> __('Fill the speed of the selected transition. Default: 300', 'gp'),
					'id'				=> GP_SHORTNAME . '_slide_transition_speed',
					'type'				=> 'input',
					'std'				=> '300'
				),
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_slide');

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

if (!function_exists('gp_columns_edit_slide')) {

	function gp_columns_edit_slide($columns) {
		
		$columns = array(
			'cb'				=> "<input type=\"checkbox\" />",
			'title'				=> __('Slide Title', 'gp'),
			'slide_caption'		=> __('Caption', 'gp'),
			'slide_page'		=> __('Page', 'gp'),
			'slide_url'			=> __('URL', 'gp'),
			'author'			=> __('Author', 'gp'),
			'date'				=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-slide_columns', 'gp_columns_edit_slide');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_columns_edit_content_slide')) {

	function gp_columns_edit_content_slide($column, $post_ID) {
	
		switch($column) {
			
			// Caption
			case 'slide_caption':
	
				$slide_caption = gp_meta('gp_slide_caption');
				if (empty($slide_caption)) {
					echo __('/', 'gp');
				} else {
					printf('%s', $slide_caption);
				}
	
			break;
			
			// URL
			case 'slide_url':
	
				$slide_url = gp_meta('gp_slide_url');
				if (empty($slide_url)) {
					echo __('/', 'gp');
				} else {
					printf('%s', $slide_url);
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_slide_posts_custom_column', 'gp_columns_edit_content_slide', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_columns_edit_sorting_slide')) {

	function gp_columns_edit_sorting_slide($column) {
		
		return array(
			'title'				=> 'title',
			'slide_caption'		=> 'slide_caption',
			'slide_page'		=> 'slide_page',
			'slide_url'			=> 'slide_url',
			'author'			=> 'author',
			'date'				=> 'date'
		);
		
	}
	
	add_filter('manage_edit-slide_sortable_columns', 'gp_columns_edit_sorting_slide');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_slide')) {

	function gp_messages_slide($messages) {
		global $post, $post_ID;
		
		$messages['slide'] = array(
			0		=> '',
			1		=> __('Slide updated.', 'gp'),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Slide updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Slide restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> __('Slide published.', 'gp'),
			7		=> __('Slide saved.', 'gp'),
			8		=> __('Slide submitted.', 'gp'),
			9		=> sprintf(__('Slide scheduled for: <strong>%1$s</strong>.', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date))),
			10		=> __('Slide draft updated', 'gp'),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_slide');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_slide')) {

	function gp_title_placeholder_slide($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'slide') {
			$title = __('Enter slide title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_slide');

}