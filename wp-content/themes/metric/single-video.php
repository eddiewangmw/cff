<?php

/*

@name			    Single Video Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar
if (gp_option('gp_video_sidebar')) {
	$sidebar        = gp_option('gp_video_sidebar');
} else {
	$sidebar        = 'left';
}

// Content & Grid Classes
if (get_terms('category-video') || is_active_sidebar('widget-area-video')) {
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
} else {
	$content_class	= 'content';
}

get_header();
?>
    
    <?php get_template_part('title'); ?>
    
	<?php gp_start('div', 'canvas'); ?>
	
        <?php
            if ($sidebar == 'left') {
                if (get_terms('category-video') || is_active_sidebar('widget-area-video')) {
                    get_sidebar('video');
                }
            }
        ?>

        <div class="content-video single-video <?php echo $content_class; ?>" role="main">

            <?php get_template_part('meta'); ?>

            <?php 
                if (have_posts()) { 
                    while (have_posts()) {
                        the_post();
                        
                        $video_youtube_code			= gp_get_youtube_video_id(__(gp_meta('gp_video_youtube_code')));
                        $video_vimeo_code			= gp_get_vimeo_video_id(__(gp_meta('gp_video_vimeo_code')));
                        ?>

                            <?php if (!empty($video_youtube_code)) { ?>
                            
                                <div class="single-post-video">
                                
                                    <iframe src="http://www.youtube.com/embed/<?php echo $video_youtube_code; ?>?wmode=opaque&amp;autoplay=0&amp;enablejsapi=1&modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=dark" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                                
                                </div><!-- END // post-video -->
                                
                            <?php } else if (!empty($video_vimeo_code)) { ?>
                            
                                <div class="single-post-video">
                                
                                    <iframe src="http://player.vimeo.com/video/<?php echo $video_vimeo_code; ?>?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                
                                </div><!-- END // post-video -->
                                
                            <?php } ?>
                            
                            <div class="single-post-content">
                            
                                <?php the_content(); ?>
                            
                            </div><!-- END // single-post-content -->
                        
                            <?php if (function_exists('gp_share')) { gp_share(); } ?>

                        <?php
                    } //while
                } //if
                wp_reset_query();
            ?>

            <?php
                if (comments_open()) {
                    comments_template(); 
                } 
            ?>
            
        </div><!-- END // content -->
        
        <?php
            if ($sidebar == 'right') {
                if (get_terms('category-video') || is_active_sidebar('widget-area-video')) {
                    get_sidebar('video');
                }
            }
        ?>

	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();