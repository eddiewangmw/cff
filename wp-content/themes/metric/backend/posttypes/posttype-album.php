<?php

/*

@name 			    Album Post Type
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

if (!function_exists('gp_register_album')) {

	function gp_register_album() {
		
		register_post_type('album',
			array (
				'labels' => array(
					'name'					=> __('Albums', 'gp'),
					'menu_name'				=> __('Albums', 'gp'),
					'singular_name'			=> __('Albums', 'gp'),
					'all_items'				=> __('All Albums', 'gp'),
					'add_new'				=> __('Add New Album', 'gp'),
					'add_new_item'			=> __('Add New Album', 'gp'),
					'edit_item'				=> __('Edit Album', 'gp'),
					'new_item'				=> __('New Album', 'gp'),
					'view_item'				=> __('View Album', 'gp'),
					'search_items'			=> __('Search Albums', 'gp'),
					'not_found'				=> __('No Albums', 'gp'),
					'not_found_in_trash'	=> __('No Albums Found in Trash', 'gp')
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
					'slug'					=> 'album',
					'with_front'			=> false
				),
				'menu_position'			=> 47,
				'menu_icon'				=> 'dashicons-gpicons-album',
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
	
	add_action('init', 'gp_register_album');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_album')) {

	function gp_register_metabox_album($post) {
        global $post;
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Album Options
		--------------------------------------------------
		*/

		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-album-options',
			'title'				=> __('Album Options', 'gp'),
			'pages'				=> array('album'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Artist', 'gp'),
					'desc'				=> __('Fill the name of the artist.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_artist',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Release Date', 'gp'),
					'desc'				=> __('Select the release date of the album.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_release_date',
					'type'				=> 'picker_date',
					'std'				=> ''
				),
				array(
					'name'				=> __('Label', 'gp'),
					'desc'				=> __('Fill the label.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_label',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Catalog Number', 'gp'),
					'desc'				=> __('Fill the catalog number.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_catalog_number',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Custom Meta Data', 'gp'),
					'desc'				=> __('Fill the custom meta data. Required format: <code>Name: Value</code> per row.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_custom_meta',
					'type'				=> 'input',
					'clone'				=> true
				),
				array(
					'name'				=> __('iTunes Button Text', 'gp'),
					'desc'				=> __('Fill the iTunes button text. Example: Buy on iTunes.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_itunes_text',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('iTunes Button URL', 'gp'),
					'desc'				=> __('Fill the URL to the album on iTunes.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_itunes_url',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Amazon Button Text', 'gp'),
					'desc'				=> __('Fill the Amazon button text. Example: Buy on Amazon.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_amazon_text',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Amazon Button URL', 'gp'),
					'desc'				=> __('Fill the URL to the album on Amazon.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_amazon_url',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Grooveshark Button Text', 'gp'),
					'desc'				=> __('Fill the Amazon button text. Example: Buy on Grooveshark.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_grooveshark_text',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Grooveshark Button URL', 'gp'),
					'desc'				=> __('Fill the URL to the album on Grooveshark.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_grooveshark_url',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('SoundCloud Button Text', 'gp'),
					'desc'				=> __('Fill the SoundCloud button text. Example: Buy on SoundCloud.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_soundcloud_text',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('SoundCloud Button URL', 'gp'),
					'desc'				=> __('Fill the URL to the album on SoundCloud.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_soundcloud_url',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Last.fm Button Text', 'gp'),
					'desc'				=> __('Fill the Last.fm button text. Example: Buy on Last.fm.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_lastfm_text',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Last.fm Button URL', 'gp'),
					'desc'				=> __('Fill the URL to the album on Last.fm.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_lastfm_url',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('YouTube Video', 'gp'),
					'desc'				=> __('Add YouTube Video URL or CODE. For Example: URL <code>http://www.youtube.com/watch?v=12345abcdef</code> or just CODE <code>12345abcdef</code>.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_youtube_code',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Vimeo Video', 'gp'),
					'desc'				=> __('Add Vimeo Video URL or CODE. For Example: URL <code>http://vimeo.com/123456789</code> or just CODE <code>123456789</code>.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_vimeo_code',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Left Column Content', 'gp'),
					'desc'				=> __('Optionally you can add content to the left column of the single page. You can use HTML and shortcodes.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_content_left',
					'type'				=> 'textarea'
				),
				array(
					'name'				=> __('Right Column Content', 'gp'),
					'desc'				=> __('Optionally you can add content to the right column of the single page. You can use HTML and shortcodes.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_content_right',
					'type'				=> 'textarea'
				)
			)
		);
		
		/*
		--------------------------------------------------
		Album Songs
		--------------------------------------------------
		*/
	
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-album-songs',
			'title'				=> __('Album Songs', 'gp'),
			'pages'				=> array('album'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Upload Songs (*.mp3)', 'gp'),
					'desc'				=> __('Drop songs in *.mp3 format into the uploader or click to Select Files button.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_songs',
					'type'				=> 'upload_plupload',
					'filters'			=> 'mp3',
				)
			)
		);
		
		/*
		--------------------------------------------------
		Album Images
		--------------------------------------------------
		*/
	
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-album-images',
			'title'				=> __('Album Images', 'gp'),
			'pages'				=> array('album'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Upload Images', 'gp'),
					'desc'				=> __('Drop images into the uploader or click to Select Files button.', 'gp'),
					'id'				=> GP_SHORTNAME . '_album_images',
					'type'				=> 'upload_plupload'
				)
			)
		);

        /*
		--------------------------------------------------
		Album Shortcode
		--------------------------------------------------
		*/

		if (isset($_GET['post'])) {

			$current_post_id = $_GET['post'];
			$post_status = get_post_status($current_post_id);

			if ($post_status == 'publish') {

				$meta_boxes[] = array(
					'id'				=> 'gp-metabox-posttype-album-shortcodes',
					'title'				=> __('Shortcode', 'gp'),
					'pages'				=> array('album'),
					'context'			=> 'side',
					'priority'			=> 'default',
					'fields'			=> array(
						array(
							'id'				=> GP_SHORTNAME . '_album_shortcode',
							'type'				=> 'shortcode',
							'cnt'				=> '[album id="' . $current_post_id . '" player="yes" image="yes" info="yes"]'
						)
					)
				);

			}

		}
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_album');

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

if (!function_exists('gp_edit_columns_album')) {

	function gp_edit_columns_album($columns) {
		
		$columns = array(
			'cb'					=> "<input type=\"checkbox\" />",
			'title'					=> __('Album Title', 'gp'),
			'album_release_date'	=> __('Release Date', 'gp'),
			'album_artist'			=> __('Artist', 'gp'),
			'author'				=> __('Author', 'gp'),
			'date'					=> __('Date', 'gp'),
		);
		
		return $columns;
		
	}
	
	add_filter('manage_edit-album_columns', 'gp_edit_columns_album');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Content
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_content_album')) {

	function gp_edit_columns_content_album($column, $post_ID) {
	
		switch($column) {
			
			// Release Date
			case 'album_release_date':
	
				$album_release_date = gp_meta('gp_album_release_date');
				if (empty($album_release_date)) {
					echo __('/', 'gp');
				} else {
					printf('%s', $album_release_date);
				}
	
			break;
			
			// Artist
			case 'album_artist':
	
				$album_artist = gp_meta('gp_album_artist');
				if (empty($album_artist)) {
					echo __('/', 'gp');
				} else {
					printf('%s', $album_artist);
				}
	
			break;
			
		}
		
	}
	
	add_action('manage_album_posts_custom_column', 'gp_edit_columns_content_album', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Orderby
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_orderby_album')) {

	function gp_edit_columns_orderby_album($query) {
		  
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('album_release_date' == $orderby) {
			$query->set('meta_key', 'gp_album_release_date');
			$query->set('orderby', 'meta_value');
		}
		
	}
	
	add_action('pre_get_posts', 'gp_edit_columns_orderby_album');

}

/*
----------------------------------------------------------------------------------------------------
Post Type Columns Sorting
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_edit_columns_sorting_album')) {

	function gp_edit_columns_sorting_album($column) {
		
		return array(
			'title'						=> 'title',
			'album_release_date'		=> 'album_release_date',
			'album_artist'				=> 'album_artist',
			'author'					=> 'author',
			'date'						=> 'date'
		);
		
	}
	
	add_filter('manage_edit-album_sortable_columns', 'gp_edit_columns_sorting_album');

}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_album')) {

	function gp_messages_album($messages) {
		global $post, $post_ID;
		
		$messages['album'] = array(
			0		=> '',
			1		=> sprintf(__('Album updated. <a href="%s">View album &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Album updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Album restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Album published. <a href="%s">View album &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Album saved.', 'gp'),
			8		=> sprintf(__('Album submitted. <a target="_blank" href="%s">Preview album &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Album scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview album &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Album draft updated. <a target="_blank" href="%s">Preview album &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_album');

}

/*
====================================================================================================
Post Type Title Placeholder
====================================================================================================
*/

if (!function_exists('gp_title_placeholder_album')) {

	function gp_title_placeholder_album($title){
		
		$screen = get_current_screen();
		
		if ($screen->post_type == 'album') {
			$title = __('Enter album title', 'gp');
		}
		
		return $title;
		
	}
	
	add_filter('enter_title_here', 'gp_title_placeholder_album');

}