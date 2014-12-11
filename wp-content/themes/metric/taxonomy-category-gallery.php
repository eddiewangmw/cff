<?php

/*

@name			    Gallery Taxonomy Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar

$sidebar = 'left';

// Content & Grid Classes
$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
$grid_class		= 'grid-tiles-sidebar';


get_header();
?>
    
    <?php gp_start('div', 'canvas'); ?>
				
		<div class="grid">
        
        	<?php
                        get_sidebar('gallery');
			?>
            
            <div class="content-gallery <?php echo $content_class; ?>" role="main">
            	
            	<div class="grid-gallery">

					<?php
                        global $post;
                        
                        // Counter
                        $post_count = 1;
                        
                        // Posts per Page
                        if (gp_option('gp_gallery_per_page')) {
                            $posts_per_page = gp_option('gp_gallery_per_page');
                        } else {
                            $posts_per_page = '-1';
                        }
                        
                        // Get Terms
                        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                        $term_slug = is_object($term) ? $term->slug : $term['slug'];
    
                        // Query
                        $gp_query_args = array(
                            'post_type'             => 'gallery',
                            'taxonomy'			    => 'category-gallery',
                            'term'                  => $term_slug,
                            'post_status'           => 'publish',
                            'order'				    => 'DESC',
                            'orderby'               => 'date',
                            'ignore_sticky_posts'   => 1,
                            'paged'                 => $paged,
                            'posts_per_page'        => $posts_per_page
                        );
    
                        query_posts($gp_query_args);
                        
                        // Loop
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                ?>      
                                            <?php if (has_post_thumbnail()) { ?>
            
                                                <div class="post-image award-overlay-back">
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                                        <?php the_post_thumbnail('medium-fixed'); ?>
														<span class="award-overlay" style="display: block;">
																<span class="post-title-container" style="display: table-cell;">
																	<h4><?php the_title();?></h4>
																</span>
														</span>
                                                    </a>
                                                    
                                                </div><!-- END // post-image -->
                                            
                                            <?php } ?>
    
                                <?php 
                            } //while
                        } else {
                        ?>
    
                            <div class="page-content">
                            
                                <p><?php _e('No galleries were found.', 'gp'); ?></p>
                                
                            </div><!-- END // page-content -->
    
                        <?php 
                        } //if
                    ?>

                </div><!-- END // grid classes -->
                
                <?php
                // Pagination
                if (function_exists('gp_pagination')) { gp_pagination(); }
                
                wp_reset_query();
                ?>
                
            </div><!-- END // content -->
            
            <?php
                if ($sidebar == 'right') {
                    if (get_terms('category-gallery') || is_active_sidebar('widget-area-gallery')) {
                        get_sidebar('gallery');
                    }
                }
			?>

        </div><!-- END // grid -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();