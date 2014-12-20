<?php

/*

@name 			    Event Post Type
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

if (!function_exists('gp_register_ticket')) {

	function gp_register_ticket() {
		
		register_post_type('ticket',
			array (
				'labels' => array(
					'name'					=> __('Ticket', 'gp'),
					'menu_name'				=> __('Ticket', 'gp'),
					'singular_name'			=> __('Ticket', 'gp'),
					'all_items'				=> __('All Tickets', 'gp'),
					'add_new'				=> __('Add New Ticket', 'gp'),
					'add_new_item'			=> __('Add New Ticket', 'gp'),
					'edit_item'				=> __('Edit TicketTicket', 'gp'),
					'new_item'				=> __('New Ticket', 'gp'),
					'view_item'				=> __('View Ticket', 'gp'),
					'search_items'			=> __('Search Tickets', 'gp'),
					'not_found'				=> __('No Tickets', 'gp'),
					'not_found_in_trash'	=> __('No Tickets Found in Trash', 'gp')
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
					'slug'					=> 'ticket',
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
	
	add_action('init', 'gp_register_ticket');

}

/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_ticket')) {

	function gp_register_metabox_ticket() {
		
		if (!class_exists('gp_Metabox')) {
			return;
		}
	
		$meta_boxes = array();
		
		/*
		--------------------------------------------------
		Event Options
		--------------------------------------------------
		*/
		
		$current_date = date('Y/m/d');
		
		$meta_boxes[] = array(
			'id'				=> 'gp-metabox-posttype-ticket-options',
			'title'				=> __('Event Options', 'gp'),
			'pages'				=> array('ticket'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'fields'			=> array(
				array(
					'name'				=> __('Ticket Date', 'gp'),
					'desc'				=> __('Release date. eg: 2月8日 <br /> <strong class="highlight">电影上映日期</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_ticket_release_date',
					'type'				=> 'picker_date',
					'std'				=> $current_date
				),
				array(
					'name'				=> __('Relase Time', 'gp'),
					'desc'				=> __('Release Time. eg: 17点30分到20点 <br /> <strong class="highlight">电影上映时间</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_ticket_release_time',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Location', 'gp'),
					'desc'				=> __('Release location. eg: Hoyts Cinemas, Broadway Shopping Centre, Sydney, NSW<br /> <strong class="highlight">电影上映地点</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_ticket_release_location',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Ticket Price', 'gp'),
					'desc'				=> __('Fill the ticket ticket price (with currency symbol). eg: $25 免费 <br /> <strong class="highlight">票价</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_ticket_price',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Book contact', 'gp'),
					'desc'				=> __('For example:02 9114 0760 或者email：confucius.institute@sydney.edu.au <br /> <strong class="highlight">是否需要预定，如果需要，填预定联系方式</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_ticket_book_contact',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Proxy URL', 'gp'),
					'desc'				=> __('For example:澳洲团购网 http://www.groupgo.com.au/team/3051.html <br /> <strong class="highlight">独家票务代理</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_ticket_proxy_contact',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Seal Ticket Date', 'gp'),
					'desc'				=> __('For example: 1月15日开始 <br /> <strong class="highlight">售票开始日期</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_ticket_seal_date',
					'type'				=> 'input'
				),
				array(
					'name'				=> __('Seal Ticket Time', 'gp'),
					'desc'				=> __('For example: 上午10时至晚上10时 <br /> <strong class="highlight">售票时间</strong>', 'gp'),
					'id'				=> GP_SHORTNAME . '_ticket_seal_time',
					'type'				=> 'input'
				),
				
			)
		);
		
		foreach ($meta_boxes as $meta_box) {
			new gp_Metabox($meta_box);
		}
	
	}
	
	add_action('admin_init', 'gp_register_metabox_ticket');
	
}

/*
====================================================================================================
Post Type Custom Messages
====================================================================================================
*/

if (!function_exists('gp_messages_ticket')) {

	function gp_messages_ticket($messages) {
		global $post, $post_ID;
		
		$messages['ticket'] = array(
			0		=> '',
			1		=> sprintf(__('Event updated. <a href="%s">View ticket &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			2		=> __('Custom field updated.', 'gp'),
			3		=> __('Custom field deleted.', 'gp'),
			4		=> __('Event updated.', 'gp'),
			5		=> isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s', 'gp'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
			6		=> sprintf(__('Event published. <a href="%s">View ticket &rsaquo;</a>', 'gp'), esc_url(get_permalink($post_ID))),
			7		=> __('Event saved.', 'gp'),
			8		=> sprintf(__('Event submitted. <a target="_blank" href="%s">Preview ticket &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9		=> sprintf(__('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview ticket &rsaquo;</a>', 'gp'), date_i18n(__('M j, Y @ G:i', 'gp'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10		=> sprintf(__('Event draft updated. <a target="_blank" href="%s">Preview ticket &rsaquo;</a>', 'gp'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		);
		
		return $messages;
		
	}
	
	add_filter('post_updated_messages', 'gp_messages_ticket');

}