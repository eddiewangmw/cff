<?php

/*

@name			    Event Taxonomy Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// View Type

$view_type		= 'grid';

// Content & Grid Classes
$content_class	= 'content-sidebar content-sidebar-left';
$grid_class		= 'grid-tiles-sidebar';

get_header();
?>

	<?php get_template_part('title'); ?>
    
	<?php gp_start('div', ''); ?>
        
		<?php  get_sidebar('award');?>
		
        <div class="content-event <?php echo $content_class; ?>" role="main">
            
               <div class="grid-award grid-event-upcoming clearfix">
            <?php 
			
			?>
            <?php
                global $post;
                
                // Posts per Page
                $posts_per_page = '-1';
                
                // Get Terms				
	                // Query
	                $gp_query_args = array(
	                    'post_type'             => 'judge',
	                    'order'				    => 'ASC',
	                    'orderby'               => 'meta_value',
	                    'ignore_sticky_posts'   => 1,
	                    'paged'                 => $paged,
	                    'posts_per_page'        => $posts_per_page
	                );

	                query_posts($gp_query_args);
					
	                if (have_posts()) {
	                    while (have_posts()) {
	                        the_post();
	                        ?>
                    
	                            <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?> >
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="post-image award-overlay-back judge">
                                            <?php the_post_thumbnail(); ?>
											<span class="award-overlay" style="display: block;">
												<span class="post-title" style="display: table;">
													<span class="post-title-container" style="display: table-cell;">
														<h4><?php echo $movie_title;?></h4>
													</span>
												</span>
											</span>
                                    </div>
                                <?php } ?>
	                                        <div class="post-content">                                        
	                                            <h3 class="post-date">                                                
	                                               <?php echo the_title();?>                                                
	                                            </h3>
												<?php the_excerpt(); ?> 
	                                        </div>
	                            </article>

	                        <?php
	                        } //while
	                    } // Have post
                ?>
            </div><!-- END // grid-event-upcoming / list-event-upcoming -->
            
            <?php   
                wp_reset_query();
            ?>
                
        </div><!-- END // content -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();