<?php

/*

@name			    GPanel Plugins Init
@package		    GPanel WordPress Framework
@since			    3.1.0
@author			    Pavel RICHTER <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

/*
====================================================================================================
Init Plugins
====================================================================================================
*/

if (!function_exists('gp_register_required_plugins')) {

    function gp_register_required_plugins() {

        $plugins = array(

            array(
                'name'                  => 'Zilla Likes',
                'slug'                  => 'zilla-likes',
                'source'                => get_template_directory() . '/plugins/zilla-likes.zip',
                'required'              => false,
                'version'               => '1.1',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name' 		=> 'WooCommerce',
                'slug' 		=> 'woocommerce',
                'required' 	=> false,
            ),
            array(
                'name' 		=> 'W3 Total Cache',
                'slug' 		=> 'w3-total-cache',
                'required' 	=> false,
            ),
            array(
                'name' 		=> 'WP Smush.it',
                'slug' 		=> 'wp-smushit',
                'required' 	=> false,
            ),
            array(
                'name' 		=> 'Anti-spam',
                'slug' 		=> 'anti-spam',
                'required' 	=> false,
            ),
            array(
                'name' 		=> 'All In One SEO Pack',
                'slug' 		=> 'all-in-one-seo-pack',
                'required' 	=> false,
            ),
            array(
                'name' 		=> 'qTranslate',
                'slug' 		=> 'qtranslate',
                'required' 	=> false,
            ),
            array(
                'name' 		=> 'SoundCloud Shortcode',
                'slug' 		=> 'soundcloud-shortcode',
                'required' 	=> false,
            ),

        );

        $config = array(
            'domain'       		=> 'gp',         	            // Text domain - likely want to be the same as your theme.
            'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
            'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
            'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
            'menu'         		=> 'install-required-plugins', 	// Menu slug
            'has_notices'      	=> true,                       	// Show admin notices or not
            'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
            'message' 			=> '',							// Message to output right before the plugins table
            'strings'      		=> array(
                'page_title'                       			=> __('Install Required Plugins', 'gp'),
                'menu_title'                       			=> __('Install Plugins', 'gp'),
                'installing'                       			=> __('Installing Plugin: %s', 'gp'), // %1$s = plugin name
                'oops'                             			=> __('Something went wrong with the plugin API.', 'gp'),
                'notice_can_install_required'     			=> _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
                'notice_can_install_recommended'			=> _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
                'notice_cannot_install'  					=> _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
                'notice_can_activate_required'    			=> _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
                'notice_can_activate_recommended'			=> _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
                'notice_cannot_activate' 					=> _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
                'notice_ask_to_update' 						=> _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
                'notice_cannot_update' 						=> _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
                'install_link' 					  			=> _n_noop('Begin installing plugin', 'Begin installing plugins'),
                'activate_link' 				  			=> _n_noop('Activate installed plugin', 'Activate installed plugins'),
                'return'                           			=> __('Return to Required Plugins Installer', 'gp'),
                'plugin_activated'                 			=> __('Plugin activated successfully.', 'gp'),
                'complete' 									=> __('All plugins installed and activated successfully. %s', 'gp'), // %1$s = dashboard link
                'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );

        tgmpa($plugins, $config);

    }

    add_action('tgmpa_register', 'gp_register_required_plugins');

}