<?php

/*

Template Name:	    Partners

@name			    Partners Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Content & Grid Classes
$content_class	= 'content-sidebar content-sidebar-left';
$grid_class		= 'grid-tiles-sidebar';
$sidebar = 'left';
get_header();
?>
    
	<?php gp_start('div', ''); ?>
        
		<div class="sidebar-gallery sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">
		    <h3 class="widget-title"><?php echo pll__('Partner');?></h3>
    
		</div><!-- END // sidebar -->
		
        <div class="content-partner <?php echo $content_class; ?>" role="main">
            
               <div class="grid-partner grid-partner-upcoming clearfix">
            <?php 
			
			?>
            <?php
                global $post;
                
                // Posts per Page
                $posts_per_page = '-1';
              
				// $terms = get_terms('category-partner' );
				$terms = get_categories(array('taxonomy' => 'category-partner', 'orderby' => 'term_group'));
				
				foreach($terms AS $term_id=>$term){
	                // Query
					// $term = get_term_by('id', $term_id, 'category-award');

	                $gp_query_args = array(
	                    'post_type'             => 'partner',
	                    'taxonomy'			    => 'category-partner',
	                    'term'                  => $term->slug,
	                    'order'				    => 'ASC',
	                    'orderby'               => 'meta_value',
	                    'ignore_sticky_posts'   => 1,
	                    'paged'                 => $paged,
	                    'posts_per_page'        => $posts_per_page
	                );

		                query_posts($gp_query_args);
						
		                if (have_posts()) {
							echo '<div class="date-hr title">'.strtoupper($term->name) . '</div>';
							// echo '<div>';
		                    while (have_posts()) {
		                        the_post();
								$url	= __(gp_meta('gp_partner_website'));
		                        ?>
                       		 		
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="post-image award-overlay-back">
											<a href="<?php echo $url;?>">
                                                <?php the_post_thumbnail(); ?>
												<span class="award-overlay" style="display: block;">
														<span class="post-title-container" style="display: table-cell;">
															<h4><?php the_title();?></h4>
														</span>
												</span>
											</a>
                                        </div>
                                    <?php } ?>

		                        <?php
		                        } //while
								// echo '</div>';
		                    } // Have post
					}// foreach
                wp_reset_query();
            ?>
                
        </div><!-- END // content -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();