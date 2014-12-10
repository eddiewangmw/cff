<?php

/*

@name			    Single News Template
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
	

        <div class="content-video single-video <?php echo $content_class; ?>" role="main">

            <?php //get_template_part('meta'); ?>

            <?php 
                if (have_posts()) { 
                    while (have_posts()) {
                        the_post();
                        ?>
				          <?php if (has_post_thumbnail()) { ?>
    
				  			<div class="post-image overlay">
				  				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				  					<?php
				  						if ($view_page == 'home') {
				  							the_post_thumbnail('small-fixed');
				  						} else {
				  							the_post_thumbnail('small');
				  						}
				  					?>
				  					<span class="overlay-block"><span class="overlay-icon"></span></span>
				  				</a>
				  			</div><!-- END // post-image -->
    
				  		<?php } ?>
						  
                            <div class="single-post-content">
                            
                                <?php the_content(); ?>
                            
                            </div><!-- END // single-post-content -->

                        <?php
                    } //while
                } //if
                wp_reset_query();
            ?>

           
            
        </div><!-- END // content -->

	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();