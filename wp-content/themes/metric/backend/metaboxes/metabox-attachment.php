<?php

/*

@name 			    Attachment Metabox
@package		    GPanel WordPress Framework
@since			    3.1.0
@author 		    Pavel RICHTER <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

/*
====================================================================================================
Attachment Metabox Register
====================================================================================================
*/

if (!function_exists('gp_register_metabox_attachment')) {

	function gp_register_metabox_attachment() {
		global $post;

		if (!class_exists('gp_Metabox')) {
			return;
        }

		$meta_boxes = array();
        $post_types = get_post_types();

		/*
		--------------------------------------------------
		Attachment Shortcodes
		--------------------------------------------------
		*/

		if (isset($_GET['post'])) {

			$current_post_id = $_GET['post'];
			$post_status = get_post_status($current_post_id);
			$post_mimetype = get_post_mime_type($current_post_id);
			$post_file = wp_get_attachment_url($current_post_id);

			if ($post_status == 'publish') {

				if ($post_mimetype == 'audio/mpeg') {

					$meta_boxes[] = array(
						'id'				=> 'gp-metabox-attachment-shortcodes',
						'title'				=> __('Shortcode', 'gp'),
						'pages'				=> array('attachment'),
						'context'			=> 'side',
						'priority'			=> 'default',
						'fields'			=> array(
							array(
								'id'				=> GP_SHORTNAME . '_attachment_shortcode',
								'type'				=> 'shortcode',
								'cnt'				=> '[audio mp3="' . $post_file . '"]'
							)
						)
					);

					foreach ($meta_boxes as $meta_box) {
						new gp_Metabox($meta_box);
					}

				}

			}

		}

	}

	add_action('admin_init', 'gp_register_metabox_attachment');

}