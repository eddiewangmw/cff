<?php

/*

@name 			    Recent Albums Widget
@package		    GPanel WordPress Framework
@since			    3.0.0
@author 		    Pavel RICHTER <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

/*
====================================================================================================
Widget Tweets
====================================================================================================
*/

class gp_Widget_Recent_Albums extends WP_Widget {
	
	function __construct() {
		
		$widget_options = array(
			'classname'								=> 'widget_recent_albums',
			'description'							=> __('Widget that displays recent albums.', 'gp')
		);
		
		$control_options = array(
			'id_base'								=> 'widget_recent_albums'
		);
		
		$this->WP_Widget('widget_recent_albums', __('Metric: Recent Albums', 'gp'), $widget_options, $control_options);
		
	}
	
	function widget($args, $instance) {
		
		extract($args);
		
		$widget_title								= apply_filters('widget_title', $instance[__('widget_title')]);
		$post_number								= $instance['post_number'];
		
		echo $before_widget;
		
		if ($widget_title) {
			echo $before_title . $widget_title . $after_title;
		}
		
		//Query
		$gp_query_args = array(
			'post_type'			=> 'album',
			'orderby'			=> 'date',
			'order'				=> 'DESC',
			'posts_per_page'	=> $post_number
		);
		query_posts($gp_query_args);

        if (have_posts()) {
            while (have_posts()) {
                the_post();
		?>
			
			<div class="post event">
            	
                <?php if (has_post_thumbnail()) { ?>
                                
                    <div class="post-image overlay">
                    
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail('medium-album'); ?>
                            <span class="overlay-block"><span class="overlay-icon"></span></span>
                        </a>
                        
                    </div><!-- END // post-image -->
                
                <?php } ?>
                
                <h5 class="post-title">
                	<a class="underline" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_title(); ?>
                    </a>
				</h5><!-- END // post-title -->
                
            	<div class="post-date">
					<?php get_template_part('date', 'album'); ?>
				</div><!-- END // post-date -->
                
            </div><!-- END // recent-album -->
				
		<?php
			} // while
		} // if
		wp_reset_query();
	
		echo $after_widget;
		
	}
	
	function update($new_instance, $old_instance) {
		
		$instance									= $old_instance;
		$instance									= $new_instance;
		
		$instance['widget_title']					= strip_tags($new_instance['widget_title']);
		$instance['post_number']					= strip_tags($new_instance['post_number']);
		
		return $instance;
		
	}
	
	function form($instance) {
		
		$defaults = array(
			'widget_title'							=> __('Recent Album', 'gp'),
			'post_number'							=> '1'
		);
		
		$instance									= wp_parse_args((array) $instance, $defaults);
		 
		$widget_title								= isset($instance['widget_title']) ? esc_attr($instance['widget_title']) : '';
		$post_number								= isset($instance['post_number']) ? esc_attr($instance['post_number']) : '';
		
		?>

            <p>
            
                <label for="<?php echo $this->get_field_id('widget_title'); ?>">
					<?php _e('Title:', 'gp'); ?>
				</label>
                
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" value="<?php echo $widget_title; ?>" />
                
            </p>
    
            <p>
            
                <label for="<?php echo $this->get_field_id('post_number'); ?>">
					<?php _e('Number of Albums:', 'gp'); ?>
                </label> 
                
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo $post_number; ?>" />
                
            </p>
        
		<?php
		
	}
	
}

?>