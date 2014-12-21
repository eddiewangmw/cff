<?php

/*

@name			    GPanel Widgets Init
@package		    GPanel WordPress Framework
@since			    3.0.0
@author			    Pavel RICHTER <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

/*
====================================================================================================
Register Widgets
====================================================================================================
*/

if (!function_exists('register_widgets')) {

	function register_widgets() {
		
		register_widget('gp_Widget_About');
		register_widget('gp_Widget_Categories_Album');
		register_widget('gp_Widget_Categories_Event');
		register_widget('gp_Widget_Categories_Gallery');
		register_widget('gp_Widget_Categories_Video');
		register_widget('gp_Widget_Recent_Albums');
		register_widget('gp_Widget_Recent_Events');
		register_widget('gp_Widget_Recent_Posts');
		register_widget('gp_Widget_Recent_Tweet');
		register_widget('gp_Widget_Recent_Videos');
		register_widget('gp_Widget_Subpages');
		register_widget('gp_Widget_Tweets');
		
	}
	
	add_action('widgets_init', 'register_widgets');

}

/*
====================================================================================================
Unregister Default WP Widgets
====================================================================================================
*/

if (!function_exists('unregister_wp_widgets')) {

	function unregister_wp_widgets(){
		
		unregister_widget('WP_Widget_Calendar');
	  
	}
	
	add_action('widgets_init', 'unregister_wp_widgets', 1);

}

/*
====================================================================================================
Register Widget Areas
====================================================================================================
*/

if (function_exists('register_sidebar')) {
	
	// Header > subscription
	register_sidebar(
		array(
			'name' 				=> __('Subscription', 'gp'),
			'description' 		=> __('Subscription widget area.', 'gp'),
			'id' 				=> 'widget-area-subscription',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title' => '<span style="display: none;">',
			'after_title' => '</span>',
		)
	);
	
	// Ad > home top 
	register_sidebar(
		array(
			'name' 				=> __('Ad home top', 'gp'),
			'description' 		=> __('Ad in home page top area.', 'gp'),
			'id' 				=> 'widget-ad-home-top',
			'before_widget' 	=> '<div id="%1$s" class=" %2$s slideshow-container clearfix">',
			'after_widget'  	=> '</div>',
			'before_title' => '<span style="display: none;">',
			'after_title' => '</span>',
		)
	);
	
	// Ad > home top 
	register_sidebar(
		array(
			'name' 				=> __('Ad home footer', 'gp'),
			'description' 		=> __('Ad in home page footer area.', 'gp'),
			'id' 				=> 'widget-ad-home-footer',
			'before_widget' 	=> '<div id="%1$s" class=" %2$s slideshow-container clearfix">',
			'after_widget'  	=> '</div>',
			'before_title' => '<span style="display: none;">',
			'after_title' => '</span>',
		)
	);
	
	// Ad > normal top-footer 
	register_sidebar(
		array(
			'name' 				=> __('Ad normal page top-footer', 'gp'),
			'description' 		=> __('Ad in normal page top-footer area.', 'gp'),
			'id' 				=> 'widget-ad-normal-top-footer',
			'before_widget' 	=> '<div id="%1$s" class=" %2$s slideshow-container clearfix">',
			'after_widget'  	=> '</div>',
			'before_title' => '<span style="display: none;">',
			'after_title' => '</span>',
		)
	);
	
	// Ad > normal footer 
	register_sidebar(
		array(
			'name' 				=> __('Ad normal page footer', 'gp'),
			'description' 		=> __('Ad in normal page footer area.', 'gp'),
			'id' 				=> 'widget-ad-normal-footer',
			'before_widget' 	=> '<div id="%1$s" class=" %2$s slideshow-container clearfix">',
			'after_widget'  	=> '</div>',
			'before_title' => '<span style="display: none;">',
			'after_title' => '</span>',
		)
	);
	
	// submenu News page
	register_sidebar(
		array(
			'name' 				=> __('News navigation ZH', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-news-sidebar-zh',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// submenu News page
	register_sidebar(
		array(
			'name' 				=> __('News navigation EN', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-news-sidebar-en',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// submenu News page
	register_sidebar(
		array(
			'name' 				=> __('News navigation ZH', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-news-sidebar-zh',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// submenu Movies page
	register_sidebar(
		array(
			'name' 				=> __('Movies navigation EN', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-movie-sidebar-en',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// submenu Movies page
	register_sidebar(
		array(
			'name' 				=> __('Movies navigation ZH', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-movie-sidebar-zh',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// submenu Events page
	register_sidebar(
		array(
			'name' 				=> __('Events navigation EN', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-events-sidebar-en',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// submenu Events page
	register_sidebar(
		array(
			'name' 				=> __('Events navigation ZH', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-events-sidebar-zh',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	// submenu about us page
	register_sidebar(
		array(
			'name' 				=> __('About navigation ZH', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-about-us-sidebar-zh',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// submenu about us page
	register_sidebar(
		array(
			'name' 				=> __('About navigation EN', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-about-us-sidebar-en',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// submenu Award page ZH
	register_sidebar(
		array(
			'name' 				=> __('Award Page Navigation ZH', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-award-sidebar-zh',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// submenu Award page EN
	register_sidebar(
		array(
			'name' 				=> __('Award Page Navigation EN', 'gp'),
			'description' 		=> __('Sidebar that appears on pages.', 'gp'),
			'id' 				=> 'widget-award-sidebar-en',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Page
	register_sidebar(
		array(
			'name' 				=> __('Page Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-page',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Blog
	register_sidebar(
		array(
			'name' 				=> __('Blog Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on blog pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-blog',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Album
	register_sidebar(
		array(
			'name' 				=> __('Albums Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on album pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-album',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Event
	register_sidebar(
		array(
			'name' 				=> __('Events Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on event pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-event',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Video
	register_sidebar(
		array(
			'name' 				=> __('Videos Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on video pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-video',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Gallery
	register_sidebar(
		array(
			'name' 				=> __('Galleries Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on gallery pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-gallery',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Contact
	register_sidebar(
		array(
			'name' 				=> __('Contact Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on contact page. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-contact',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) { // Check if WooCommerce is Active
        
        // Sidebar > Shop
        register_sidebar(
            array(
                'name' 				=> __('Shop Sidebar', 'gp'),
                'description' 		=> __('Sidebar that appears on shop pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
                'id' 				=> 'widget-area-shop',
                'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
                'after_widget'  	=> '</div>',
                'before_title'  	=> '<h3 class="widget-title">',
                'after_title'		=> '</h3>'
            )
        );
        
    }

	// Footer Sidebar > Full
	register_sidebar(
		array(
			'name' 				=> __('Footer [Full]', 'gp'),
			'description' 		=> __('Full width footer widget area appears on all pages. Area won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget-area-footer-full',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > First
	register_sidebar(
		array(
			'name' 				=> __('Footer [1st]', 'gp'),
			'description' 		=> __('1st footer widget area.', 'gp'),
			'id' 				=> 'widget-area-footer-first',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > Second
	register_sidebar(
		array(
			'name' 				=> __('Footer [2nd]', 'gp'),
			'description' 		=> __('2nd footer widget area.', 'gp'),
			'id' 				=> 'widget-area-footer-second',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > Third
	register_sidebar(
		array(
			'name' 				=> __('Footer [3rd]', 'gp'),
			'description' 		=> __('3rd footer widget area.', 'gp'),
			'id' 				=> 'widget-area-footer-third',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);

}