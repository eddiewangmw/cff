<?php

/*

@name			    Single Gallery Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar
if (gp_option('gp_gallery_sidebar')) {
	$sidebar        = gp_option('gp_gallery_sidebar');
} else {
	$sidebar        = 'right';
}

// Content & Grid Classes
if (is_active_sidebar('widget-area-gallery')) {
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
	$grid_class		= 'grid-tiles-sidebar';
} else {
	$content_class	= 'content';
	$grid_class		= 'grid-tiles';
}

// Get Images
$images = gp_meta('gp_gallery_images', 'type=upload_plupload');

get_header();
?>
    
    <?php get_template_part('title'); ?>
    
	<?php gp_start('div', 'canvas'); ?>

        <?php
            if ($sidebar == 'left') {
                if (is_active_sidebar('widget-area-gallery')) {
                    get_sidebar('gallery');
                }
            }
        ?>
        
        <div class="content-gallery <?php echo $content_class; ?>" role="main">
        
            <?php get_template_part('meta'); ?>

            <div class="single-gallery lightbox <?php echo $grid_class; ?>">
                        
                <?php 
                    if (have_posts()) { 
                        while (have_posts()) {
                            the_post();
                            
                            $block_class = 'tile';
                            ?>
                            
                            <?php
                                foreach ($images as $image) {
                                ?>
                                
                                    <div class="<?php echo $block_class; ?>">
                                    
                                        <div class="tile-block">
                                        
                                            <div class="post-image overlay">
    
                                                <a data-gallery="gallery" href="<?php echo $image['image_url']; ?>" title="<?php echo $image['image_title']; ?>">
                                                    <img src="<?php echo $image['image_url']; ?>" alt="<?php echo $image['image_title']; ?>" />
                                                    <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                </a>
                                            
                                            </div><!-- END // post-image -->
                                        
                                        </div>
    
                                    </div><!-- END // tile -->
                                        
                                <?php
                                } //foreach
                            ?>
                            
                            <?php
                        } //while
                    } //if
                    wp_reset_query();
                ?>
                
            </div><!-- END // grid classes -->

            <?php 
                if (have_posts()) { 
                    while (have_posts()) {
                        the_post();
                        ?>

                            <div class="single-post-content">
                                
                                <?php the_content(); ?>
                                
                            </div><!-- END // single-post-content --> 
                            
                        <?php
                    } //while
                } //if
                wp_reset_query();
            ?>

	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();