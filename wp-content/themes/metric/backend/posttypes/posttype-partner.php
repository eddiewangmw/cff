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

if (!function_exists('gp_register_partner')) {

	function gp_register_partner() {
		
		register_post_type('partner',
			array (
				'labels' => array(
					'name'					=> __('Partners', 'gp'),
					'menu_name'				=> __('Partners', 'gp'),
					'singular_name'			=> __('Partner', 'gp'),
					'all_items'				=> __('All Partners', 'gp'),
					'add_new'				=> __('Add New Partner', 'gp'),
					'add_new_item'			=> __('Add New Partner', 'gp'),
					'edit_item'				=> __('Edit Partner', 'gp'),
					'new_item'				=> __('New Partner', 'gp'),
					'view_item'				=> __('View Partner', 'gp'),
					'search_items'			=> __('Search Partner', 'gp'),
					'not_found'				=> __('No Partner', 'gp'),
					'not_found_in_trash'	=> __('No Partner Found in Trash', 'gp')
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
					'slug'					=> 'partner',
					'with_front'			=> true
				),
				'menu_position'			=> 46,
				'menu_icon'				=> 'dashicons-gpicons-partner',
				'supports'				=> array(
					'title',
					'editor',
					'thumbnail',
				)
			)
		);

	}
	
	add_action('init', 'gp_register_partner');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_partner')) {

	function gp_register_metabox_partner() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Partner Options
		--------------------------------------------------
		*/
		
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-partner-options',
			'title'				=> __('Award Options', 'gp'),
			'pages'				=> array('partner'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'=>array(array(
					'name'				=> __('Partner Website', 'gp'),
					'id'				=> GP_SHORTNAME . '_partner_website',
					'type'				=> 'input'
				),)
			
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_partner');
	
}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_partner')) {

	function gp_messages_partner($messages) {
		global $post, $post_ID;
		
		$messages['partner'] = array(
			0		=> '',
			1		=> sprintf(__('Partner updated. <a href="%s">View partner &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Partner updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Award restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Partner published. <a href="%s">View partner &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Partner saved.', 'gp'),
			8		=> sprintf(__('Partner submitted. <a target="_blank" href="%s">Preview partner &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Partner scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview partner &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Partner draft updated. <a target="_blank" href="%s">Preview partner &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_partner');

}
