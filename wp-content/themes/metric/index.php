<?php

/*

@name			    Blog Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar
if (gp_option('gp_blog_sidebar')) {
	$sidebar		= gp_option('gp_blog_sidebar');
} else {
	$sidebar		= 'right';
}

// View Type
if (gp_option('gp_blog_view') == 'list') {
	$view_type		= 'list';
} else {
	$view_type		= 'grid';
}

// Content & Grid Classes
if (is_active_sidebar('widget-area-blog')) {
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
	$grid_class		= 'grid-tiles-sidebar';
} else {
	$content_class	= 'content';
	$grid_class		= 'grid-tiles';
}

get_header();
?>
    
    <?php gp_start('header', 'title'); ?>
    
        <?php if (is_front_page()) { ?>

            <h1>
                <?php _e('Recent posts', 'gp'); ?>
            </h1>
        
        <?php } else { ?>
            
            <?php $page = get_post(get_option('page_for_posts')); ?>
            <h1>
                <?php echo $page->post_title; ?>
            </h1>
    
        <?php } ?>
    
    <?php gp_end('header', 'title'); ?>
    
	<?php gp_start('div', 'canvas'); ?>
        
        <div class="grid">
        
        	<?php
                if ($sidebar == 'left') {
                    if (is_active_sidebar('widget-area-blog')) {
                        get_sidebar('blog');
                    }
                }
			?>
        
			<div class="content-blog <?php echo $content_class; ?>" role="main">

            	<?php if ($view_type == 'grid') { ?>
            	
                    <div class="grid-post grid-merge clearfix <?php echo $grid_class; ?>">
                    
                <?php } else if ($view_type == 'list') { ?>
                        
                    <div class="list-post clearfix">
                            
                <?php } ?>

					<?php
                        // Counter
                        $post_count = 1;
                        
                        // Loop
                        if (have_posts()) { 
                            while (have_posts()) { 
                                the_post();
                                
                                // Post View Type
                                if ($view_type == 'grid') {
                                    $post_view_type = 'tile';
                                } else {
                                    $post_view_type = 'list-item';
                                }
                                
                                // Post Class
                                if (has_post_thumbnail()) {
                                    $post_class = array('has-post-thumbnail', 'post', 'clearfix', $post_view_type);
                                } else {
                                    $post_class = array('post', 'clearfix', $post_view_type);
                                }
                                ?>
                            
                                    <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                                        
                                        <?php if ($view_type == 'grid') { ?>
                                        
                                            <div class="tile-block">
                                        
                                        <?php } ?>
                                        
                                        <?php
                                            if (!get_post_format()) {
                                                get_template_part('content', 'standard');
                                            } else {
                                                get_template_part('content', get_post_format());
                                            }
                                        ?>
                                            
                                        <?php if ($view_type == 'grid') { ?>
        
                                            </div><!-- END // tile-block -->
                                        
                                        <?php } ?>
                                    
                                    </article><!-- END // post -->
                                
                                <?php
                                $post_count++;
                            } //while
                        } //if
                        wp_reset_query();
                    ?>

				</div><!-- END // grid-blog / list-blog -->
            	
                <?php
                    // Pagination
                    if (function_exists('gp_pagination')) { gp_pagination(); }
                    
                    wp_reset_query();
                ?>
            
            </div><!-- END // content -->
            
            <?php
                if ($sidebar == 'right') {
                    if (is_active_sidebar('widget-area-blog')) {
                        get_sidebar('blog');
                    }
                }
			?>
            
        </div><!-- END // grid -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();