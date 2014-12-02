<?php

/*

@name			    GPanel Functions Init
@package		    GPanel WordPress Framework
@since			    3.0.1
@author			    Pavel RICHTER <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

/*
====================================================================================================
Backend Options
====================================================================================================
*/

if (!function_exists('gp_backend_init')) {

    function gp_backend_init() {
        
        // Get theme and framework info
        $data = get_option('gpanel_options');
        
        if (function_exists('wp_get_theme')) {
            
            if (is_child_theme()) {
                
                $temp_data  = wp_get_theme();
                $theme_data = wp_get_theme($temp_data->get('Template'));
                
            } else {
                
                $theme_data = wp_get_theme();
                   
            }
            
            $data['theme_name']     = $theme_data->get('Name');
            $data['theme_version']  = $theme_data->get('Version');
            
        }
    
        update_option('gpanel_options', $data);
        
        // Incase it is first install and option doesn't exist
        $gpanel_values = get_option('gpanel_values');
        
        if(!is_array($gpanel_values)) {
            
            update_option('gpanel_values', array());
            
        }
        
    }
    
    add_action('init', 'gp_backend_init', 2);

}

/*
====================================================================================================
Backend Scripts
====================================================================================================
*/

if (!function_exists('gp_backend_scripts')) {

	function gp_backend_scripts() {

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		
        // Enqueue Media
        if (!did_action('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        // Enqueue Upload
        wp_register_script('gp-upload', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.upload.min.js', array('jquery', 'media-upload', 'thickbox'), GP_VERSION, true);
        wp_enqueue_script('gp-upload');

		// Plupload
		wp_enqueue_script('plupload-all');

		// Color Picker
		wp_register_script('gp-colorpicker', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.colorpicker.min.js', 'jquery', GP_VERSION, true);
		wp_enqueue_script('gp-colorpicker');
		
		// Cookie
		wp_register_script('gp-cook', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.cook.min.js', 'jquery', GP_VERSION, true);
		wp_enqueue_script('gp-cook');
        
		// Custom
		wp_register_script('gp-backend', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.backend.min.js', 'jquery', GP_VERSION, true);
		wp_enqueue_script('gp-backend');
		
	}
	
	add_action('admin_enqueue_scripts', 'gp_backend_scripts');

}

// Datepicker Scripts for Event and Album
if (!function_exists('gp_backend_datepicker_scripts')) {

	function gp_backend_datepicker_scripts() {
		global $post_type;
		
		if (empty($post_type) && !empty($_GET['post'])) {
			$post = get_post($_GET['post']);
			$post_type = $post->post_type;
		}
	
		if ($post_type == 'album') {
		?>
		
			<script type="text/javascript">
                
                //<![CDATA[
                    
                    jQuery(document).ready(function() {
        
                        jQuery(".gp-datepicker").datepicker({ 
                            firstDay: 1,
                            dateFormat: "yy/mm/dd",
                            dayNames: [
                                '<?php _e('Sunday', 'gp'); ?>',
                                '<?php _e('Monday', 'gp'); ?>',
                                '<?php _e('Tuesday', 'gp'); ?>',
                                '<?php _e('Wednesday', 'gp'); ?>',
                                '<?php _e('Thursday', 'gp'); ?>',
                                '<?php _e('Friday', 'gp'); ?>',
                                '<?php _e('Saturday', 'gp'); ?>'
                            ],
                            dayNamesMin: [
                                '<?php _e('Su', 'gp'); ?>',
                                '<?php _e('Mo', 'gp'); ?>',
                                '<?php _e('Tu', 'gp'); ?>',
                                '<?php _e('We', 'gp'); ?>',
                                '<?php _e('Th', 'gp'); ?>',
                                '<?php _e('Fr', 'gp'); ?>',
                                '<?php _e('Sa', 'gp'); ?>'
                            ],
                            monthNames: [
                                '<?php _e('January', 'gp'); ?>',
                                '<?php _e('February', 'gp'); ?>',
                                '<?php _e('March', 'gp'); ?>',
                                '<?php _e('April', 'gp'); ?>',
                                '<?php _e('May', 'gp'); ?>',
                                '<?php _e('June', 'gp'); ?>',
                                '<?php _e('July', 'gp'); ?>',
                                '<?php _e('August', 'gp'); ?>',
                                '<?php _e('September', 'gp'); ?>',
                                '<?php _e('October', 'gp'); ?>',
                                '<?php _e('November', 'gp'); ?>',
                                '<?php _e('December', 'gp'); ?>'
                            ],
                            nextText: '<?php _e('Next', 'gp'); ?>',
                            prevText: '<?php _e('Prev', 'gp'); ?>'
                        });
                        
                    });
                    
                //]]>
                
			</script>
	
		<?php
		} else if ($post_type == 'event') {
		?>

            <script type="text/javascript">

                //<![CDATA[

                jQuery(document).ready(function() {

                    jQuery(".gp-datepicker#gp_event_date").datepicker({
                        firstDay: 1,
                        dateFormat: "yy/mm/dd",
                        defaultDate: "+1w",
                        onClose: function (selectedDate) {
                            jQuery(".gp-datepicker#gp_event_date_end").datepicker("option", "minDate", selectedDate);
                        },
                        onSelect: function(date){
                            var event_date = jQuery(this).datepicker('getDate');
                            event_date.setDate(event_date.getDate());
                            jQuery('.gp-datepicker#gp_event_date_end').datepicker('setDate', event_date);
                        },
                        dayNames: [
                            '<?php _e('Sunday', 'gp'); ?>',
                            '<?php _e('Monday', 'gp'); ?>',
                            '<?php _e('Tuesday', 'gp'); ?>',
                            '<?php _e('Wednesday', 'gp'); ?>',
                            '<?php _e('Thursday', 'gp'); ?>',
                            '<?php _e('Friday', 'gp'); ?>',
                            '<?php _e('Saturday', 'gp'); ?>'
                        ],
                        dayNamesMin: [
                            '<?php _e('Su', 'gp'); ?>',
                            '<?php _e('Mo', 'gp'); ?>',
                            '<?php _e('Tu', 'gp'); ?>',
                            '<?php _e('We', 'gp'); ?>',
                            '<?php _e('Th', 'gp'); ?>',
                            '<?php _e('Fr', 'gp'); ?>',
                            '<?php _e('Sa', 'gp'); ?>'
                        ],
                        monthNames: [
                            '<?php _e('January', 'gp'); ?>',
                            '<?php _e('February', 'gp'); ?>',
                            '<?php _e('March', 'gp'); ?>',
                            '<?php _e('April', 'gp'); ?>',
                            '<?php _e('May', 'gp'); ?>',
                            '<?php _e('June', 'gp'); ?>',
                            '<?php _e('July', 'gp'); ?>',
                            '<?php _e('August', 'gp'); ?>',
                            '<?php _e('September', 'gp'); ?>',
                            '<?php _e('October', 'gp'); ?>',
                            '<?php _e('November', 'gp'); ?>',
                            '<?php _e('December', 'gp'); ?>'
                        ],
                        nextText: '<?php _e('Next', 'gp'); ?>',
                        prevText: '<?php _e('Prev', 'gp'); ?>'
                    });

                    jQuery(".gp-datepicker#gp_event_date_end").datepicker({
                        firstDay: 1,
                        dateFormat: "yy/mm/dd",
                        defaultDate: "+1w",
                        onClose: function (selectedDate) {
                            jQuery(".gp-datepicker#gp_event_date").datepicker("option", "maxDate", selectedDate);
                        },
                        onClose: function () {
                            var event_date = jQuery('.gp-datepicker#gp_event_date').datepicker('getDate');
                            var event_date_end = jQuery(this).datepicker('getDate');
                            if (event_date_end <= event_date) {
                                var minDate = jQuery(this).datepicker('option', 'minDate');
                                jQuery(this).datepicker('setDate', minDate);
                            }
                        },
                        dayNames: [
                            '<?php _e('Sunday', 'gp'); ?>',
                            '<?php _e('Monday', 'gp'); ?>',
                            '<?php _e('Tuesday', 'gp'); ?>',
                            '<?php _e('Wednesday', 'gp'); ?>',
                            '<?php _e('Thursday', 'gp'); ?>',
                            '<?php _e('Friday', 'gp'); ?>',
                            '<?php _e('Saturday', 'gp'); ?>'
                        ],
                        dayNamesMin: [
                            '<?php _e('Su', 'gp'); ?>',
                            '<?php _e('Mo', 'gp'); ?>',
                            '<?php _e('Tu', 'gp'); ?>',
                            '<?php _e('We', 'gp'); ?>',
                            '<?php _e('Th', 'gp'); ?>',
                            '<?php _e('Fr', 'gp'); ?>',
                            '<?php _e('Sa', 'gp'); ?>'
                        ],
                        monthNames: [
                            '<?php _e('January', 'gp'); ?>',
                            '<?php _e('February', 'gp'); ?>',
                            '<?php _e('March', 'gp'); ?>',
                            '<?php _e('April', 'gp'); ?>',
                            '<?php _e('May', 'gp'); ?>',
                            '<?php _e('June', 'gp'); ?>',
                            '<?php _e('July', 'gp'); ?>',
                            '<?php _e('August', 'gp'); ?>',
                            '<?php _e('September', 'gp'); ?>',
                            '<?php _e('October', 'gp'); ?>',
                            '<?php _e('November', 'gp'); ?>',
                            '<?php _e('December', 'gp'); ?>'
                        ],
                        nextText: '<?php _e('Next', 'gp'); ?>',
                        prevText: '<?php _e('Prev', 'gp'); ?>'
                    });

                });

                //]]>

            </script>
        
        <?php
        }
		
	}
	
	add_action('admin_print_footer_scripts', 'gp_backend_datepicker_scripts');

}

/*
====================================================================================================
Backend Styles
====================================================================================================
*/

if (!function_exists('gp_backend_styles')) {

	function gp_backend_styles() {
		
		// Thickbox Stylesheet
		wp_enqueue_style('thickbox');
		
		// Backend Stylesheet
		wp_enqueue_style('gp-style', trailingslashit(get_template_directory_uri()) . 'backend/styles/backend.css');

	}
	
	add_action('admin_print_styles', 'gp_backend_styles');

}

/*
====================================================================================================
Theme Customizer
====================================================================================================
*/

if (!function_exists('gp_theme_customize_register')) {

	function gp_theme_customize_register($wp_customize) {
	
		/*
		--------------------------------------------------
		Add Sections
		--------------------------------------------------
		*/
		
		// Colors
		$wp_customize->add_section('colors', array(
			'title'			=> __('Colors', 'gp'),
			'priority'		=> 30
		));
		
		/*
		--------------------------------------------------
		Add Settings
		--------------------------------------------------
		*/
        
        // Background Color Light
        $wp_customize->add_setting('gp_color_background_light', array(
            'default'		=> '#ffffff',
            'transport'		=> 'refresh'
        ));
        
        // Background Color Dark
        $wp_customize->add_setting('gp_color_background_dark', array(
            'default'		=> '#0a0f14',
            'transport'		=> 'refresh'
        ));
        
        // Text Color Light
        $wp_customize->add_setting('gp_color_text_light', array(
            'default'		=> '#ffffff',
            'transport'		=> 'refresh'
        ));
        
        // Text Color Dark
        $wp_customize->add_setting('gp_color_text_dark', array(
            'default'		=> '#474b4f',
            'transport'		=> 'refresh'
        ));
        
        // Primary Color
        $wp_customize->add_setting('gp_color_primary', array(
            'default'		=> '#ebcd37',
            'transport'		=> 'refresh'
        ));
        
        // Secondary Color
        $wp_customize->add_setting('gp_color_secondary', array(
            'default'		=> '#28a5a5',
            'transport'		=> 'refresh'
        ));
		
		/*
		--------------------------------------------------
		Add Controls
		--------------------------------------------------
		*/
        
        // Background Color Light
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_backround_light', array(
                    'label'			=> __('Background Color Light', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_background_light',
                    'priority'		=> 1
                )
            )
        );
        
        // Background Color Dark
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_backround_dark', array(
                    'label'			=> __('Background Color Dark', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_background_dark',
                    'priority'		=> 1
                )
            )
        );
        
        // Text Color Light
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_text_light', array(
                    'label'			=> __('Text Color Light', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_text_light',
                    'priority'		=> 10
                )
            )
        );
        
        // Text Color Dark
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_text_dark', array(
                    'label'			=> __('Text Color Dark', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_text_dark',
                    'priority'		=> 10
                )
            )
        );
		
		// Primary Color
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_primary', array(
                    'label'			=> __('Primary Color', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_primary',
                    'priority'		=> 11
                )
            )
        );
		
		// Secondary Color
		$wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 'gp_color_secondary', array(
                    'label'			=> __('Secondary Color', 'gp'),
                    'section'		=> 'colors',
                    'settings'		=> 'gp_color_secondary',
                    'priority'		=> 12
                )
            )
        );
	
	}
	
	add_action('customize_register', 'gp_theme_customize_register');

}

/*
====================================================================================================
Convert Hexadecimal Color to RGB
====================================================================================================
*/

if (!function_exists('gp_hex_to_rgb')) {

    function gp_hex_to_rgb($hex) {
        
        $hex = str_replace('#', '', $hex);
        
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        
        $rgb = array($r, $g, $b);
        
        return implode(",", $rgb); // RGB separated by comma
        
    }

}

/*
====================================================================================================
Add Appearance Links
====================================================================================================
*/

// Add Support Link
if (!function_exists('gp_appearance_support_link')) {

	function gp_appearance_support_link() {
	
		add_theme_page( 
			esc_html__('Theme Support', 'gp'),
			esc_html__('Theme Support', 'gp'),
			'edit_theme_options',
			'gp-support',
			'gp_init_support'
		);
		
	}
	
	add_action('admin_menu', 'gp_appearance_support_link', 10);

}

// Add Documentation Link
if (!function_exists('gp_appearance_documentation_link')) {

	function gp_appearance_documentation_link() {
	
		add_theme_page( 
			esc_html__('Theme Docs', 'gp'),
			esc_html__('Theme Docs', 'gp'),
			'edit_theme_options',
			'gp-documentation',
			'gp_init_documentation'
		);
		
	}
	
	add_action('admin_menu', 'gp_appearance_documentation_link', 10);

}

/*
====================================================================================================
Add Featured Image Description
====================================================================================================
*/

if (!function_exists('gp_featured_image_description')) {

	function gp_featured_image_description($content) {
		
		$content .= '<p>';
		$content .= __('The Featured Image is an image that is chosen as the representative image for the post. Click the link above to upload the image for this post.', 'gp');
		$content .= '</p>';
		
		return $content;
		
	}
	
	add_filter('admin_post_thumbnail_html', 'gp_featured_image_description');

}

/*
====================================================================================================
Remove "View" Button for slides, callouts
====================================================================================================
*/

if (!function_exists('gp_posttype_admin_css')) {

    function gp_posttype_admin_css() {
        global $post_type;
        
        if ($post_type == 'slide' || $post_type == 'callout') {
            ?>
            <style type="text/css" media="screen">
                #view-post-btn, #preview-action .preview.button { display: none; }
            </style>
            <?php
        }
    
    }
    
    add_action('admin_head', 'gp_posttype_admin_css');

}

/*
====================================================================================================
Slug
====================================================================================================
*/

if (!function_exists('gp_slug')) {

    function gp_slug($str) {

        $str = strtolower(trim($str));
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);

        return $str;

    }

}

/*
====================================================================================================
Add WP Login Logo
====================================================================================================
*/

if (!function_exists('gp_custom_login_logo')) {

	function gp_custom_login_logo() {
	
		if (gp_option('gp_image_login_logo')) {
		?>
	
            <style type="text/css">
                #login h1 a {
                    background-image: url("<?php echo gp_option('gp_image_login_logo'); ?>") !important;
                }
            </style>
		
		<?php
		}

        if (gp_option('gp_image_login_logo_2x')) {
            ?>

            <style type="text/css">
                @media
                only screen and (-webkit-min-device-pixel-ratio: 2),
                only screen and (-o-min-device-pixel-ratio: 2/1),
                only screen and (min--moz-device-pixel-ratio: 2),
                only screen and (min-device-pixel-ratio: 2),
                only screen and (min-resolution: 192dpi),
                only screen and (min-resolution: 2dppx) {

                    #login h1 a {
                        background-image: url("<?php echo gp_option('gp_image_login_logo_2x'); ?>") !important;
                        -webkit-background-size: 80px 80px;
                        -moz-background-size: 80px 80px;
                        -o-background-size: 80px 80px;
                        background-size: 80px 80px;
                    }

                }
            </style>

        <?php
        }

	}
	
	add_action('login_head', 'gp_custom_login_logo');

}

/*
====================================================================================================
Remove WordPress Version to Increase Security
====================================================================================================
*/

if (!function_exists('gp_kill_wp_version')) {

	function gp_kill_wp_version() {
		
		return '';
		
	}
	
	add_filter('the_generator', 'gp_kill_wp_version');

}

/*
====================================================================================================
Browser Body Class
====================================================================================================
*/

if (!function_exists('gp_body_class')) {

	function gp_body_class($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
		if ($is_lynx) { 
			$classes[] = 'lynx';
		} else if ($is_gecko) {
			$classes[] = 'gecko';
		} else if ($is_opera) {
			$classes[] = 'opera';
		} else if ($is_NS4) {
			$classes[] = 'ns4';
		} else if ($is_safari) {
			$classes[] = 'safari';
		} else if ($is_chrome) {
			$classes[] = 'chrome';
		} else if ($is_IE) {
			$classes[] = 'ie';
		} else {
			$classes[] = 'unknown';
		}
		
		if ($is_iphone) {
			$classes[] = 'iphone';
		}
		
		return $classes;
		
	}
	
	add_filter('body_class', 'gp_body_class');

}

/*
====================================================================================================
Third Party SEO Plugins
====================================================================================================
*/

if (!function_exists('gp_seo_third_party')) {

    function gp_seo_third_party() {

        include_once(ABSPATH . 'wp-admin/includes/plugin.php');

        if (is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')) {
            return true;
        }

        if (is_plugin_active('wordpress-seo/wp-seo.php')) {
            return true;
        }

        return false;

    }

}

/*
====================================================================================================
Get YouTube Video ID
====================================================================================================
*/

if (!function_exists('gp_get_youtube_video_id')) {

    function gp_get_youtube_video_id($text) {

        if (preg_match('~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i', $text, $id)) {
            $result = $id[1];
        } else {
            $result = $text;
        }

        return $result;

    }

}

/*
====================================================================================================
Get Vimeo Video ID
====================================================================================================
*/

if (!function_exists('gp_get_vimeo_video_id')) {

    function gp_get_vimeo_video_id($text) {

        if (preg_match('/vimeo\.com\/(\w+\s*\/?)*([0-9]+)*$/i', $text, $id)) {
            $result = $id[1];
        } else {
            $result = $text;
        }

        return $result;

    }

}

/*
====================================================================================================
Flush Rewrite
====================================================================================================
*/

if (!function_exists('gp_rewrite_flush')) {

    function gp_rewrite_flush() {
        
        flush_rewrite_rules();
        
    }
    
    add_action('after_switch_theme', 'gp_rewrite_flush');
    
}