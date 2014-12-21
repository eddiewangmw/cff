<?php

/*

@name			    Event Taxonomy Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// View Type
if (gp_option('gp_event_view')) {
	$view_type		= gp_option('gp_event_view');
} else {
	$view_type		= 'grid';
}

// Content & Grid Classes
$content_class	= 'content-sidebar content-sidebar-left';
$grid_class		= 'grid-tiles-sidebar';

get_header();
?>

	<?php get_template_part('title'); ?>
    
	<?php gp_start('div', ''); ?>
        
		<?php  get_sidebar('award');?>
		
        <div class="content-event <?php echo $content_class; ?>" role="main">
             <?php  get_template_part('content', 'slider');?>
               <div class="grid-award grid-event-upcoming clearfix">
            <?php 
			
			?>
            <?php
                global $post;
                
                // Posts per Page
                $posts_per_page = '-1';
                
                // Get Terms
                $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

				$term_slug = is_object($term) ? $term->slug : $term['slug'];
				
				// $list_type = get_option( "tax_".$term->term_id);
				$list_type = 'awards';
				
				if( $list_type == 'awards'){
					$terms = get_term_children( $term->term_id, 'category-award' );

					foreach($terms AS $term_id){
		                // Query
						$term = get_term_by('id', $term_id, 'category-award');

		                $gp_query_args = array(
		                    'post_type'             => 'award',
		                    'taxonomy'			    => 'category-award',
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
		                    while (have_posts()) {
		                        the_post();
								
								$movie_title	= __(gp_meta('gp_award_title'));
								$youtube  = __(gp_meta('gp_award_youtube_code'));
								$director = __(gp_meta('gp_movie_director'));
								$writer = __(gp_meta('gp_award_writer'));
								$date = __(gp_meta('gp_award_date'));
								$stars = __(gp_meta('gp_award_stars'));
		                        ?>
                        
		                            <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?> >
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="post-image award-overlay-back">
                                            <?php if($youtube):?>
												<a href="http://www.youtube.com/watch?v=<?php echo $youtube; ?>" title="<?php the_title_attribute(); ?>">
	                                                <?php the_post_thumbnail(); ?>
													<span class="award-overlay" style="display: block;">
														<span class="post-title" style="display: table;">
															<span class="post-title-container" style="display: table-cell;">
																<h4><?php echo $movie_title;?></h4>
																<span>CHECK THE MOVIE</span>
																<i></i>
															</span>
														</span>
													</span>
	                                            </a>
											<?php else:?>
                                                <?php the_post_thumbnail(); ?>
												<span class="award-overlay" style="display: block;">
													<span class="post-title" style="display: table;">
														<span class="post-title-container" style="display: table-cell;">
															<h4><?php echo $movie_title;?></h4>
														</span>
													</span>
												</span>
											<?php endif;?>
                                        </div>
                                    <?php } ?>
		                                        <div class="post-content">                                        
		                                            <h3 class="post-date">                                                
		                                               <?php echo $movie_title;?>                                                
		                                            </h3>
													<ul>
														<?php if($director):?><li><b><?php echo pll__('Director:');?></b> <?php echo $director;?></li><?php endif;?>
														<?php if($writer):?><li><b><?php echo pll__('Writer:');?></b>  <?php echo $writer;?></li><?php endif;?>
														<?php if($stars):?><li><b><?php echo pll__('Stars:');?></b>  <?php echo $stars;?></li><?php endif;?>
														<?php if($date):?><li><b><?php echo pll__('Release Information:');?></b>  <?php echo $date;?></li><?php endif;?>
													</ul>                                        
		                                        </div>
		                            </article>

		                        <?php
		                        } //while
		                    } // Have post
					}// foreach
				}// if

				// For director display
				if($list_type == 'director'){
					
	                // Query
	                $gp_query_args = array(
	                    'post_type'             => 'award',
	                    'taxonomy'			    => 'category-award',
	                    'term'                  => $term->slug,
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
				}
                ?>
            </div><!-- END // grid-event-upcoming / list-event-upcoming -->
            
            <?php   
                wp_reset_query();
            ?>
                
        </div><!-- END // content -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();