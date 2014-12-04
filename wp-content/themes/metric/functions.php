<?php

/*

@name			    Theme Functions
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/ 

/*
====================================================================================================
Frontend Setup
====================================================================================================
*/

if (!function_exists('gp_frontend_setup')) {

	function gp_frontend_setup() {

        // Add Semantic Markup Support
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
            )
        );

		// Add Post Thumbnails Support
		add_theme_support('post-thumbnails');

        // Thumbnails > Post Thumbnail Size
        set_post_thumbnail_size(1180, '');
		
		// Add Automatic Feed Links Support
		add_theme_support('automatic-feed-links');

        // Add Translation Support
        load_theme_textdomain('gp', trailingslashit(get_template_directory()) . 'languages');
		
		// Editor Stylesheet
		add_editor_style('backend/styles/editor.css');
		
		// WooCommerce Support
		add_theme_support('woocommerce');
		
		// WooCommerce Default Colors
		if (function_exists('woocommerce_compile_less_styles')) {
            
            $default_colors = get_option('woocommerce_frontend_css_colors');

            if (!$default_colors || !$default_colors['primary'] || $default_colors['primary'] == '#ad74a2') {
                
                update_option('woocommerce_frontend_css_colors', array(
                    'primary'           => get_theme_mod('gp_color_secondary'),
                    'secondary'         => get_theme_mod('gp_color_primary'),
                    'highlight'         => get_theme_mod('gp_color_secondary'),
                    'content_bg'        => get_background_color(),
                    'subtext'           => get_theme_mod('gp_color_text'),
                ));
                
                woocommerce_compile_less_styles();
                
            }
        }
		
	}
	
	add_action('after_setup_theme', 'gp_frontend_setup');

}

/*
====================================================================================================
Init GPanel
====================================================================================================
*/

get_template_part('backend/init', 'gpanel');

/*
====================================================================================================
Add Thumbnail Sizes
====================================================================================================
*/

// Thumbnails > Default
add_image_size('thumbnail', 120, '', true);
add_image_size('thumbnail-fixed', 120, 90, true);

add_image_size('small', 480, '', true);
add_image_size('small-fixed', 480, 240, true);
add_image_size('small-square', 480, 480, true);

add_image_size('medium', 750, '', true);
add_image_size('medium-fixed', 750, 425, true);
add_image_size('medium-square', 750, 750, true);

add_image_size('large', 1180, '', true);
add_image_size('large-fixed', 1180, 600, true);
add_image_size('large-wide', 1180, 300, true);
add_image_size('large-square', 1180, 300, true);

/*
====================================================================================================
Set Max Content Width
====================================================================================================
*/

if (!isset($content_width)) {
    $content_width = 1180;
}

/*
====================================================================================================
Frontend Scripts
====================================================================================================
*/

if (!function_exists('gp_frontend_scripts')) {

    function gp_frontend_scripts() {
        
        if (!is_admin()) {
        
            // jQuery
			wp_enqueue_script('jquery');
            
            // jQuery UI
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-tabs');
            
            // Homepage Scripts
            if (is_page_template('template-home.php')OR is_page_template('template-about-us-en.php') OR is_page_template('template-about-us-zh.php') ) {

				// jQuery Revolution Slider Plugins
				wp_register_script('gp-revolution-plugins', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.revolution.plugins.min.js', array('jquery'), '1.0.0', true);
				wp_enqueue_script('gp-revolution-plugins');

                // jQuery Revolution Slider
                wp_register_script('gp-revolution', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.revolution.min.js', array('jquery'), '4.1.2', true);
                wp_enqueue_script('gp-revolution');
            
            }
            
            // jQuery Isotope
            wp_register_script('gp-isotope', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.isotope.min.js', array('jquery'), '1.5.21', true);
            wp_enqueue_script('gp-isotope');
            
            // jQuery Image Loader
            wp_register_script('gp-loadimages', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.loadimages.min.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('gp-loadimages');
            
            // jQuery FitVids
            wp_register_script('gp-fitvids', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.fitvids.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('gp-fitvids');
            
            // jQuery jPlayer
            wp_register_script('gp-jplayer', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.jplayer.min.js', array('jquery'), '2.4.1', true);
            wp_enqueue_script('gp-jplayer');
            
            // jQuery jPlayer Playlist
            wp_register_script('gp-jplayer-playlist', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.jplayer.playlist.min.js', array('jquery', 'gp-jplayer'), '2.3.0', true);
            wp_enqueue_script('gp-jplayer-playlist');

            // jQuery Respond
            wp_register_script('gp-respond', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.respond.min.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('gp-respond');
            
            // jQuery Lightbox
            wp_register_script('gp-lightbox', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.touchtouch.min.js', array('jquery'), '1.1.1', true);
            wp_enqueue_script('gp-lightbox');
            
            // Contact Scripts
            if (is_page_template('template-contact.php')) {

                // jQuery Validate
                wp_register_script('gp-validate', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.validate.min.js', array('jquery'), '1.11.1', true);
                wp_enqueue_script('gp-validate');
            
            }
            
            // jQuery Frontend
            wp_register_script('gp-frontend', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.frontend.min.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('gp-frontend');
            
        }
        
        if (is_singular() && get_option('thread_comments') && comments_open()) { 
            
            // Comment Reply JavaScript
            wp_enqueue_script('comment-reply'); 
            
        }
        
    }
    
    add_action('wp_enqueue_scripts', 'gp_frontend_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Homepage
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_homepage_scripts')) {

    function gp_frontend_homepage_scripts() {
    
        if (is_page_template('template-home.php') OR is_page_template('template-about-us-en.php') OR is_page_template('template-about-us-zh.php') ) {
        
            // Variables
            if (gp_option('gp_slideshow_type') == 'fullwidth') {
                $full_width = 'on';
            } else {
                $full_width = 'off';
            }
            if (is_numeric(gp_option('gp_slideshow_delay'))) {
                $delay = gp_option('gp_slideshow_delay');
            } else {
                $delay = '5000';
            }
            if (gp_option('gp_slideshow_navigation')) {
				$navigation = gp_option('gp_slideshow_navigation');
			} else {
				$navigation = 'bullet';
			}
            if (gp_option('gp_slideshow_navigation_style')) {
				$navigation_style = gp_option('gp_slideshow_navigation_style');
			} else {
				$navigation_style = 'square';
			}
            if (gp_option('gp_slideshow_navigation_hide') != 'false') {
				$navigation_hide = '1';
			} else {
				$navigation_hide = '0';
			}
            if (gp_option('gp_slideshow_on_hover_stop') != 'false') {
				$on_hover_stop = 'on';
			} else {
				$on_hover_stop = 'off';
			}
            if (gp_option('gp_slideshow_touch_enabled') != 'false') {
				$touch_enabled = 'true';
			} else {
				$touch_enabled = 'false';
			}
            
            if (get_posts('post_type=slide')) {
            ?>
        
                <script type="text/javascript">
                
                    //<![CDATA[
                    
                        jQuery(document).ready(function () {
                            "use strict";
    
                            // Slideshow
                            jQuery('.slider-container').revolution({
                                delay: <?php echo $delay; ?>,
                                startwidth: 1180,
                                startheight: 600,

                                navigationType: '<?php echo $navigation; ?>',
                                navigationStyle: '<?php echo $navigation_style; ?>',
                                navigationArrows: 'solo',

                                hideThumbs: <?php echo $navigation_hide; ?>,
                                hideThumbsOnMobile: 'on',
								hideThumbsUnderResoluition: 800,

                                thumbWidth: 108,
                                thumbHeight: 50,
                                thumbAmount: 10,

                                navigationHOffset: 0,
                                navigationVOffset: 0,

                                touchenabled: '<?php echo $touch_enabled; ?>',
                                onHoverStop: '<?php echo $on_hover_stop; ?>',

                                stopAtSlide: -1,
                                stopAfterLoops: -1,

                                shadow: 0,
                                fullWidth: '<?php echo $full_width; ?>',
                                fullScreen: 'off',
                                videoJsPath: '<?php echo trailingslashit(get_template_directory_uri()) . 'javascripts/video'; ?>'
                            });
                            
                        });
                        
                    //]]>
                
                </script>

            <?php
            }

        }

    }
    
    add_action('wp_print_footer_scripts', 'gp_frontend_homepage_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Global
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_global_scripts')) {

	function gp_frontend_global_scripts() {
	?>
			
		<script type="text/javascript">
		
			//<![CDATA[
				
				// Load Images
				jQuery(document).ready(function() {
					"use strict";
					
					// Load Images
					jQuery(".canvas").loadImages();
	
					// Fit Videos
					jQuery(".canvas").fitVids();
				 
				});

			//]]>
			
		</script>
			
	<?php
	}
	
	add_action('wp_print_footer_scripts', 'gp_frontend_global_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Contact
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_contact_scripts')) {

	function gp_frontend_contact_scripts() {
			
		if (is_page_template('template-contact.php')) { 
		?>
	
			<script type="text/javascript">
				
				//<![CDATA[
				
					jQuery(document).ready(function() {
						"use strict";
						
						jQuery("#form-contact").validate({
							messages: {
                                contact_name: '<?php _e('Please fill your name.', 'gp'); ?>',
                                contact_email: {
                                    required: '<?php _e('Please fill your email address.', 'gp'); ?>',
                                    email: '<?php _e('Please fill the valid email address.', 'gp'); ?>'
                                },
                                contact_message: '<?php _e('Please fill your message.', 'gp'); ?>',
                                recaptcha_response_field: '<?php _e('Please fill the valid captcha.', 'gp'); ?>'
							}
						});
						
					});
				
				//]]>
				
			</script>
			
		<?php
		}
	}
	
	add_action('wp_print_footer_scripts', 'gp_frontend_contact_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Album
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_album_scripts')) {

	function gp_frontend_album_scripts() {
		global $post_id;
	
		if (have_posts()) { 
			while (have_posts()) { 
				the_post();
				
				// Get Files
				$files = gp_meta('gp_album_songs', 'type=upload_plupload');
				
				if ($files != NULL && get_post_type() == 'album' && is_single()) {
				?>
	
					<script type="text/javascript">
						
						//<![CDATA[
						
							jQuery(document).ready(function() {
								"use strict";
														
								var playList =  new jPlayerPlaylist({
									jPlayer: '.player-<?php the_ID(); ?>',
									cssSelectorAncestor: '.player-container-<?php the_ID(); ?>'
								}, [
									<?php
									$file_count = 1;
									foreach ($files as $file) {
										
										?>
										{
											title: '<?php echo $file['title']; ?>',
											mp3: '<?php echo $file['url']; ?>'
										}<?php if ($file_count != sizeof($files)) { ?>,<?php } ?>
										<?php
										$file_count++;
									}
									?>
								], {
									swfPath: '<?php echo get_template_directory_uri(); ?>/javascripts',
									supplied: 'mp3',
									solution: 'html, flash',
									volume: 0.8,
									cssSelector: {
										play: '.player-play',
										pause: '.player-pause',
										stop: '.player-stop',
										mute: '.player-mute',
										unmute: '.player-unmute',
										seekBar: '.player-seek-bar',
										playBar: '.player-play-bar',
										volumeBar: '.player-volume',
										volumeBarValue: '.player-volume-value',
										currentTime: ".player-current-time",
										duration: ".player-duration"
									}
								});
								
							});
						
						//]]>
						
					</script>
			
				<?php
				}
			}
		}
	}
	
	add_action('wp_print_footer_scripts', 'gp_frontend_album_scripts');

}

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Search
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_search_scripts')) {

	function gp_frontend_search_scripts() {
	?>
	
		<script type="text/javascript">
			
			//<![CDATA[
			
				jQuery(document).ready(function() {
		
					jQuery('input[name=s]').focus(function() {
						"use strict";
						
						if (jQuery(this).val() === '<?php _e('Search ...', 'gp'); ?>') {
							jQuery(this).val('');
						}
						
					});
					
					jQuery('input[name=s]').blur(function() {
						"use strict";
						
						if (jQuery(this).val() === '') {
							jQuery(this).val('<?php _e('Search ...', 'gp'); ?>'); 
						}
						
					});
				
				});
	
			//]]>
			
		</script>
			
	<?php
	}
	
	add_action('wp_print_footer_scripts', 'gp_frontend_search_scripts');

}

/*
====================================================================================================
Frontend Styles
====================================================================================================
*/

if (!function_exists('gp_frontend_styles')) {

	function gp_frontend_styles() {
			
		if (!is_admin()) {
			
			// Core Stylesheet
			wp_enqueue_style('gp-style', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array(), '', 'all');
			
			// Font Face Stylesheet [Google Font API]
			if (gp_option('gp_font_face') != '') {
				
				$font_face = gp_option('gp_font_face');
				$font_face = str_replace(' ', '+', $font_face);

                if (gp_option('gp_font_face_styles') != '') {
                    $font_face_styles = gp_option('gp_font_face_styles');
                    $font_face_styles = str_replace(' ', '', $font_face_styles);
                    $font_face_styles = ':' . $font_face_styles;
                } else {
                    $font_face_styles = '';
                }

                if (gp_option('gp_font_face_subsets') != '') {
                    $font_face_subsets = gp_option('gp_font_face_subsets');
                    $font_face_subsets = str_replace(' ', '', $font_face_subsets);
                    $font_face_subsets .= '&subset=' . $font_face_subsets;
                } else {
                    $font_face_subsets = '';
                }

                wp_enqueue_style('gp-style-font-' . strtolower($font_face), 'http://fonts.googleapis.com/css?family=' . $font_face . $font_face_styles . $font_face_subsets);

            } else {
			     
                // Oswald Stylesheet [Google Font API]
                wp_enqueue_style('gp-style-font-oswald', 'http://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext');
                
            }
			
			// Open Sans Stylesheet [Google Font API]
			wp_enqueue_style('gp-style-font-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700&subset=latin,cyrillic-ext,latin-ext,cyrillic');
			
		}
		
	}
	
	add_action('wp_enqueue_scripts', 'gp_frontend_styles');

}

/*
----------------------------------------------------------------------------------------------------
Init Dynamic Frontend Style
----------------------------------------------------------------------------------------------------
*/

get_template_part('style');

/*
====================================================================================================
Navigation
====================================================================================================
----------------------------------------------------------------------------------------------------
Primary Navigation
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_navigation')) {

	function gp_navigation() {
	
		wp_nav_menu(
			array(
				'theme_location'	=> 'primary_navigation',
				'menu_class'        => 'navigation-primary',
				'menu_id'           => 'navigation-primary',
				'container'         => false,
				'depth'				=> 3
			)
		);
		
	}

}

/*
----------------------------------------------------------------------------------------------------
Categories Navigation
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_categories')) {

    function gp_categories($type) {
	
		if (get_terms($type)) {
        ?>
                        
            <nav class="navigation-categories categories-<?php echo $type; ?> one-entire clearfix">
                <ul>
                    <?php
                        $gp_categories_args = array(
                            'taxonomy'            => $type,
                            'orderby'             => 'none',
                            'order'               => 'ASC',
                            'show_count'          => 0,
                            'pad_counts'          => 0,
                            'depth'               => 3,
                            'hide_empty'          => 0,
                            'use_desc_for_title'  => 0,
                            'title_li'            => '',
                            'show_option_none'    => ''
                        );
                        wp_list_categories($gp_categories_args);
                    ?>
                </ul>
            </nav>
            
        <?php 
        }
		
	}

}

/*
----------------------------------------------------------------------------------------------------
Remove current_page_item Class of Blog Page
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_current_page_item_remove')) {

	function gp_current_page_item_remove($classes, $item) {
	
		$post_type = get_query_var('post_type');
	
		if (get_post_type() == $post_type) {
			$classes = array_filter($classes, "get_current_value");
		}
		
		if (is_search()) {
			$classes = array_filter($classes, "get_current_value");
		}
	
		return $classes;
		
	}
	
	function get_current_value($element) {
		return ($element != "current_page_parent");
	}
	
	add_filter('nav_menu_css_class', 'gp_current_page_item_remove', 10, 2);

}

/*
----------------------------------------------------------------------------------------------------
Add current_page_item Class for CPT Menu Item
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_current_page_item_add')) {

	function gp_current_page_item_add($classes = array(), $menu_item = false){
	
		$post_type = get_post_type();
		$page_template = get_post_meta($menu_item->object_id, '_wp_page_template', true);
        
        if (is_single() && $post_type == 'album' && $page_template == 'template-album.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('category-album') && $page_template == 'template-album.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_single() && $post_type == 'event' && $page_template == 'template-event.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('category-event') && $page_template == 'template-event.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_single() && $post_type == 'gallery' && $page_template == 'template-gallery.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('category-gallery') && $page_template == 'template-gallery.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_single() && $post_type == 'video' && $page_template == 'template-video.php') {
			$classes[] = 'current_page_item';
		}
		
		if (is_tax('category-video') && $page_template == 'template-video.php') {
			$classes[] = 'current_page_item';
		}
		
		return $classes;
		
	}
	
	add_filter('nav_menu_css_class', 'gp_current_page_item_add', 10, 2);

}

/*
====================================================================================================
Layout
====================================================================================================
*/

if (!function_exists('gp_start')) {

	function gp_start($type, $class, $container = true) {
        
        if (is_array($class)) {
            $class_container = implode('-container ', $class);
            $class = implode(' ', $class);
        } else {
            $class_container = $class;
        }
        
        if (!$type) {
            $type = 'div';
        }
        ?>
        
            <<?php echo $type; ?> class="<?php echo $class; ?> clearfix">
                
                <?php if ($container == true) { ?>
                    <div class="<?php echo $class_container; ?>-container clearfix">
                <?php } ?>
        
        <?php
    }
    
}

if (!function_exists('gp_end')) {

	function gp_end($type, $class, $container = true) {
    
        if (is_array($class)) {
            $class_container = implode('-container ', $class);
            $class = implode(' ', $class);
        } else {
            $class_container = $class;
        }
        
        if (!$type) {
            $type = 'div';
        }
        ?>
            
                <?php if ($container == true) { ?>
                </div><!-- END // <?php echo $class_container; ?>-container -->
                <?php } ?>
        
            </<?php echo $type; ?>><!-- END // <?php echo $class; ?> -->
        
        <?php
    }
    
}

/*
====================================================================================================
Pagination
====================================================================================================
*/

if (!function_exists('gp_pagination')) {

	function gp_pagination() {
		global $wp_query;
	
		$big = 999999999;
		?>
		
            <div class="pagination clearfix">
                
                <?php
                    echo paginate_links(
                        array(
                            'base'		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format'	=> '?paged=%#%',
                            'current'	=> max(1, get_query_var('paged')),
                            'total'		=> $wp_query->max_num_pages
                        )
                    );
                ?>
            
            </div><!-- END // pagination -->
            
		<?php
	}

}

/*
====================================================================================================
Pagination for Posts
====================================================================================================
*/

if (!function_exists('gp_pagination_post')) {

	function gp_pagination_post($defaults) {
		
		$args = array(
			'before'		=> '<div class="pagination-post">',
			'after'			=> '</div><!-- END // pagination-post -->',
		);
		
		$r = wp_parse_args($args, $defaults);
		
		return $r;
		
	}
	
	add_filter('wp_link_pages_args', 'gp_pagination_post');

}

/*
====================================================================================================
Time
====================================================================================================
*/

if (!function_exists('gp_time_ago')) {

	function gp_time_ago() {
		global $post;
	
		$date = get_post_time('G', true, $post);
		$chunks = array(
			array(60 * 60 * 24 * 365, __('year', 'gp'), __('years', 'gp')),
			array(60 * 60 * 24 * 30, __('month', 'gp'), __('months', 'gp')),
			array(60 * 60 * 24 * 7, __('week', 'gp'), __('weeks', 'gp')),
			array(60 * 60 * 24, __('day', 'gp'), __('days', 'gp')),
			array(60 * 60, __('hour', 'gp'), __('hours', 'gp')),
			array(60, __('minute', 'gp'), __('minutes', 'gp')),
			array(1, __('second', 'gp'), __('seconds', 'gp'))
		);
	 
		if (!is_numeric($date)) {
			$time_chunks		= explode(':', str_replace(' ', ':', $date));
			$date_chunks		= explode('-', str_replace(' ', '-', $date));
			$date				= gmmktime((int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0]);
		}
	 
		$current_time		= current_time('mysql', $gmt = get_option('gmt_offset'));
		$newer_date			= strtotime($current_time);
		$since				= $newer_date - $date;
	 
		if ($since < 0) {
			return __('sometime', 'gp');
		}
	
		for ($i = 0, $j = count($chunks); $i < $j; $i++) {
			$seconds = $chunks[$i][0];
	 
			if (($count = floor($since / $seconds)) != 0) {
				break;
			}
		}
	
		$output = ($count == 1) ? '1 ' . $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
	
		if (!(int)trim($output)) {
			$output = '0 ' . __('seconds', 'gp');
		}
		
		$output .= __(' ago', 'gp');
	 
		return $output;
		
	}
	
	add_filter('the_time', 'gp_time_ago');

}

/*
====================================================================================================
Social Sharing
====================================================================================================
*/

if (!function_exists('gp_share')) {

	function gp_share($title_share = true, $container = 'post-share') {
		global $post_id;
		
		if ($container != 'post-share') {
            $class_container = $container . ' post-share';
        } else {
            $class_container = $container;
        }
		
		$title = get_the_title();
		$original_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		
		if (gp_option('gp_share_twitter') != 'false' || gp_option('gp_share_facebook') || 'false' && gp_option('gp_share_googleplus') != 'false' || gp_option('gp_share_pinterest') != 'false' || gp_option('gp_share_vk') != 'false') {
		?>
		
		<div class="<?php echo $class_container; ?>">
            
            <?php if ($title_share == true) { ?>
                
                <h4>
                    <?php _e('Share', 'gp'); ?>
                </h4>
                
			<?php } ?>
	
			<ul>
			
				<?php if (gp_option('gp_share_twitter') != 'false') { ?>
			
					<li class="share-twitter social-twitter">
						<a href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo str_replace(" ", "%20", $title); ?>" title="<?php _e('Tweet This', 'gp'); ?>" target="_blank"></a>
					</li>
				
				<?php } ?>
				
				<?php if (gp_option('gp_share_facebook') != 'false') { ?>
			
					<li class="share-facebook social-facebook">
						<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;title=<?php echo str_replace(" ", "%20", $title); ?>" title="<?php _e('Share on Facebook', 'gp'); ?>" target="_blank"></a>
					</li>
				
				<?php } ?>
				
				<?php if (gp_option('gp_share_googleplus') != 'false') { ?>
			
					<li class="share-googleplus social-googleplus">
						<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" title="<?php _e('Share on Google+', 'gp'); ?>" target="_blank"></a>
					</li>
				
				<?php } ?>
				
				<?php if (gp_option('gp_share_pinterest') != 'false') { ?>
			
					<li class="share-pinterest social-pinterest">
						<a href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());" title="<?php _e('Pin it', 'gp'); ?>" target="_blank"></a>
					</li>
				
				<?php } ?>
				
				<?php if (gp_option('gp_share_vk') != 'false') { ?>
			
					<li class="share-vk social-vk">
						<a href="http://vkontakte.ru/share.php?url=<?php the_permalink(); ?>" title="<?php _e('Share on VK', 'gp'); ?>" target="_blank"></a>
					</li>
				
				<?php } ?>
	
			</ul>
			
		</div>
		
		<?php
		}
		
	}

}

/*
====================================================================================================
Audio Player
====================================================================================================
*/

if (!function_exists('gp_player')) {

	function gp_player($playlist = false) {
        global $post_id;
        ?>

            <div class="player-<?php the_ID(); ?>"></div>
                                            
            <div class="player">
                <div class="player-container-<?php the_ID(); ?> player-container">
                    <div class="player-progress">
                        <div class="player-seek-bar">
                            <div class="player-play-bar"></div><!-- END // player-play-bar -->
                        </div><!-- END // player-seek-bar -->
                    </div><!-- END // player-progress -->

                    <div class="player-controls">
                        <ul>
                            <li><a href="javascript:;" class="player-play" tabindex="1">Play</a></li>
                            <li><a href="javascript:;" class="player-pause" tabindex="1">Pause</a></li>
                            <li><a href="javascript:;" class="player-stop" tabindex="1">Stop</a></li>
                            <li><a href="javascript:;" class="player-mute" tabindex="1">Mute</a></li>
                            <li><a href="javascript:;" class="player-unmute" tabindex="1">Unmute</a></li>
                        </ul><!-- END // player-controls -->
                        <div class="player-volume">
                            <div class="player-volume-container">
                                <div class="player-volume-value"></div><!-- END // player-volume-value -->
                            </div><!-- END // player-volume-container -->
                        </div><!-- END // player-volume -->
                    </div><!-- END // player-controls -->
                    
                    <?php if ($playlist == true) { ?>
                        <div class="jp-playlist player-playlist">
                            <ul>
                                <li></li>
                            </ul>
                        </div><!-- END // player-playlist -->
                    <?php } ?>
                </div><!-- END // player-container -->
            </div><!-- END // player -->

        <?php
	}

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
Title
====================================================================================================
*/

if (!function_exists('gp_title')) {

	function gp_title($title) {
		global $post_id;
		
		if (!gp_seo_third_party()){
			if (is_front_page() && get_bloginfo('description')) {
				return get_bloginfo('name') . ' &rsaquo; ' . get_bloginfo('description'); 
			} else if (is_front_page()) {
				return get_bloginfo('name'); 
			} else if (is_feed()) {
				return trim($title); 
			} else {
				return trim($title) . ' &lsaquo; ' . get_bloginfo('name'); 
			}
		}
	
		return $title;
	
	}
	
	add_filter('wp_title', 'gp_title');

}

/*
====================================================================================================
Add Custom Hooks
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Meta Head Hook
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_meta_head')) {

    function gp_meta_head() {
        do_action('gp_meta_head');
    }

}

/*
----------------------------------------------------------------------------------------------------
Footer Hook
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_footer')) {

    function gp_footer() {
        do_action('gp_footer');
    }

}

/*
----------------------------------------------------------------------------------------------------
Submit Before Hook
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_submit_before')) {

    function gp_submit_before() {
        do_action('gp_submit_before');
    }

}

/*
====================================================================================================
Add Meta
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Add Keywords
----------------------------------------------------------------------------------------------------
*/

if (!gp_seo_third_party()) {
	
	if (!function_exists('gp_meta_keywords')) {

		function gp_meta_keywords() {
			global $post_id, $wp_query;
            
            if ($wp_query->is_404 != true) {
                if (gp_meta('gp_page_keywords')) {
                ?>
                <meta name="keywords" content="<?php echo gp_meta('gp_page_keywords'); ?>" />
                <?php
                } else if (gp_option('gp_meta_keywords_default')) {
                ?>
                <meta name="keywords" content="<?php echo gp_option('gp_meta_keywords_default'); ?>" />
                <?php 
                }
            }
			
		}
		
		add_action('gp_meta_head', 'gp_meta_keywords');
        	
	}

}

/*
----------------------------------------------------------------------------------------------------
Add Description
----------------------------------------------------------------------------------------------------
*/

if (!gp_seo_third_party()) {
	
	if (!function_exists('gp_meta_description')) {

		function gp_meta_description() {
			global $post_id, $wp_query;
            
            if ($wp_query->is_404 != true) {
                if (gp_meta('gp_page_description') != '') {
                ?>
                <meta name="description" content="<?php echo gp_meta('gp_page_description'); ?>" />
                <?php
                } else if (gp_option('gp_meta_description_default') != '') {
                ?>
                <meta name="description" content="<?php echo gp_option('gp_meta_description_default'); ?>" />
                <?php 
                }
            }
			
		}
		
		add_action('gp_meta_head', 'gp_meta_description');
	
	}

}

/*
====================================================================================================
Footer Tracking
====================================================================================================
*/

if (!function_exists('gp_footer_tracking')) {

	function gp_footer_tracking() {
	
		if (gp_option('gp_tracking_code')) { 
			echo stripslashes(gp_option('gp_tracking_code'));
		}
		
	}
	
	add_action('gp_footer', 'gp_footer_tracking');

}

/*
====================================================================================================
Add Custom Icons
====================================================================================================
*/

// Browser Favicon 32x32
if (!function_exists('gp_favicon')) {

	function gp_favicon() {
			
		if (gp_option('gp_image_favicon')) { 
		?>
		<link rel="shortcut icon" href="<?php echo gp_option('gp_image_favicon'); ?>" />
		<?php } else { ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
		<?php 
		}
		
	}
	
	add_action('wp_head', 'gp_favicon');

}

// Apple Touch Icon 57x57 /  For non-retina iPhone, iPod Touch and Android 2.1+ devices
if (!function_exists('gp_touch_icon')) {

	function gp_touch_icon() {
			
		if (gp_option('gp_image_touch_icon')) { 
		?>
		<link rel="apple-touch-icon-precomposed" href="<?php echo gp_option('gp_image_touch_icon'); ?>" />
		<?php } else { ?>
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-precomposed.png" />
		<?php 
		}
		
	}
	
	add_action('wp_head', 'gp_touch_icon');

}

// Apple Touch Icon 72x72 / For first and second iPad generation
if (!function_exists('gp_touch_icon_72')) {

	function gp_touch_icon_72() {
			
		if (gp_option('gp_image_touch_icon_72')) { 
		?>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo gp_option('gp_image_touch_icon_72'); ?>" />
		<?php } else { ?>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-72x72-precomposed.png" />
		<?php 
		}
		
	}
	
	add_action('wp_head', 'gp_touch_icon_72');

}

// Apple Touch Icon 114x114 / For iPhone with high-resolution retina display
if (!function_exists('gp_touch_icon_114')) {

	function gp_touch_icon_114() {
			
		if (gp_option('gp_image_touch_icon_114')) { 
		?>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo gp_option('gp_image_touch_icon_114'); ?>" />
		<?php } else { ?>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-114x114-precomposed.png" />
		<?php 
		}
		
	}
	
	add_action('wp_head', 'gp_touch_icon_114');

}

// Apple Touch Icon 144x144 / For third iPad generation with high-resolution retina display
if (!function_exists('gp_touch_icon_144')) {

	function gp_touch_icon_144() {
			
		if (gp_option('gp_image_touch_icon_144')) { 
		?>
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo gp_option('gp_image_touch_icon_144'); ?>" />
		<?php } else { ?>
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-144x144-precomposed.png" />
		<?php 
		}
		
	}
	
	add_action('wp_head', 'gp_touch_icon_144');

}

/*
====================================================================================================
Custom Excerpt
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Remove Excerpt Metabox from WordPress
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_remove_excerpt_metabox')) {

	function gp_remove_excerpt_metabox() {
	
		remove_meta_box('postexcerpt', 'post', 'normal');
	
	}
	
	add_action('admin_menu', 'gp_remove_excerpt_metabox');

}

/*
----------------------------------------------------------------------------------------------------
Custom Excerpt
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_excerpt')) {

	function gp_excerpt($text) {
			global $post;
			
			if ($text == '') {
				$text = get_the_content('');
				$text = apply_filters('the_content', $text);
				$text = str_replace('\]\]\>', ']]&gt;', $text);
				$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
				$text = strip_tags($text, '<p>');
				$excerpt_length = 30;
				$words = explode(' ', $text, $excerpt_length + 1);
				if (count($words)> $excerpt_length) {
					array_pop($words);
					array_push($words, '...');
					$text = implode(' ', $words);
				}
			}
			
			return $text;
			
	}
	
	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'gp_excerpt');

}

/*
====================================================================================================
Add to RSS
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Add to RSS > Custom Post Types
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_add_posttypes_to_rss')) {

	function gp_add_posttypes_to_rss($qv) {
			
		if (isset($qv['feed']) && !isset($qv['post_type']) ) {
			$qv['post_type'] = array('post', 'album', 'event', 'gallery', 'video');
		}
		return $qv;
		
	}
	
	add_filter('request', 'gp_add_posttypes_to_rss');

}

/*
----------------------------------------------------------------------------------------------------
Add to RSS > Thumbnails
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_add_thumbnails_to_rss')) {

    function gp_add_thumbnails_to_rss($content) {
        global $post;

        if (has_post_thumbnail($post->ID)) {
            $content = '<p>' . get_the_post_thumbnail($post->ID, 'medium') . '</p>' . get_the_content();
        }

        return $content;

    }

    add_filter('the_excerpt_rss', 'gp_add_thumbnails_to_rss');
    add_filter('the_content_feed', 'gp_add_thumbnails_to_rss');

}

/*
====================================================================================================
Comments List
====================================================================================================
*/

if (!function_exists('gp_comments_list')) {

	function gp_comments_list($comment, $args, $depth) {
	   $globals['comment'] = $comment;
	?>

		<div <?php comment_class(); ?>>

			<div id="comment-<?php comment_ID(); ?>">

				<div class="comment-avatar float-left">
					<?php echo get_avatar($comment, $size='50'); ?>
				</div><!-- END // comment-avatar -->

				<div class="comment-body">

					<div class="comment-meta clearfix">

						<h5 class="float-left">
							<?php echo get_comment_author_link(); ?>
						</h5>

						<div class="comment-date float-right">
							<a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
								<?php comment_date(get_option('date_format')); ?>
								<?php _e(', ', 'gp'); ?>
								<?php comment_time(get_option('time_format')); ?>
							</a>
							<?php edit_comment_link(__('[edit]', 'gp'),'',''); ?>
						</div>

					</div><!-- END // comment-meta -->

					<?php if ($comment->comment_approved == '0') { ?>
						<div class="alert notice"><?php _e('Your comment is awaiting moderation.', 'gp'); ?></div>
					<?php } ?>

					<div class="comment-content">

						<div class="comment-text">
							<?php comment_text() ?>
						</div><!-- END // comment-text -->

						<div class="comment-reply button">
							<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
						</div><!-- END // comment-reply -->

					</div><!-- END // comment-content -->

				</div><!-- END // comment-body -->

			</div><!-- END // comment -->

	<?php
	}

}

pll_register_string('Subscription button','Submit your email');
pll_register_string('About Us Sidebar Title','About Us');