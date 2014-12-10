<?php

/*

@name			    Event Taxonomy Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// View Type

$view_type		= 'grid';

$sidebar        = 'left';

$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
$grid_class		= 'grid-tiles-sidebar';

get_header();
?>
    
	<?php gp_start('div', 'canvas'); ?>
        
        <?php
            get_sidebar('ticket'); 
        ?>
        
        <div class="content-ticket <?php echo $content_class; ?>" role="main">
            
               <div class="grid-ticket grid-event-upcoming clearfix">
                
            <?php
                global $post;
                
                // Counter
                $post_count = 1;
                
                // Posts per Page
                if (gp_option('gp_event_per_page')) {
                    $posts_per_page = gp_option('gp_event_per_page');
                } else {
                    $posts_per_page = '-1';
                }
                
                // Get Terms
                $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                $term_slug = is_object($term) ? $term->slug : $term['slug'];

                // Query
                $gp_query_args = array(
                    'post_type'             => 'ticket',
                    'taxonomy'			    => 'category-ticket',
                    'term'                  => $term_slug,
                    'order'				    => 'ASC',
                    'orderby'               => 'date',
                    'ignore_sticky_posts'   => 1,
                    'paged'                 => $paged,
                );

                query_posts($gp_query_args);
                
                // Loop
                if (have_posts()) {

                    while (have_posts()) {
                        the_post();
                
						$release_date = gp_meta('gp_ticket_release_date'); //电影上映日期
						$release_time = gp_meta('gp_ticket_release_time'); //电影上映时间
						$release_replace = gp_meta('gp_ticket_release_location'); //电影上映地点
						$price = gp_meta('gp_ticket_price'); //价钱
						$book = gp_meta('gp_ticket_book_contact'); //预约
						$proxy = gp_meta('gp_ticket_proxy_contact'); //代理
						$seal_date = gp_meta('gp_ticket_seal_date'); //售票开始
						$seal_time = gp_meta('gp_ticket_seal_time'); // 售票时间
																																										
						?>
						<div class="page-content">
						<div class="date-hr">
							<?php the_title()?>
						</div>
						<div class="content_1">

						<?php the_content(); ?>
						<ul>
							<?php if($release_date):?>
							<li><?php echo pll__('Release Date').' '.$release_date?></li>
							<?php endif;?>
							<?php if($release_time):?>
							<li><?php echo pll__('Release Time').' '.$release_time?></li>
							<?php endif;?>
							<?php if($release_replace):?>
							<li><?php echo pll__('Release Place').' '.$release_replace?></li>
							<?php endif;?>
							<?php if($price):?>
							<li><?php echo pll__('Ticket Price').' '.$price?></li>
							<?php endif;?>
							<?php if($book):?>
							<li><?php echo pll__('Ticket Book Contact').' '.$book?></li>
							<?php endif;?>
							<?php if($proxy):?>
							<li><?php echo pll__('Ticket Proxy Contact').' '.$proxy?></li>
							<?php endif;?>
							<?php if($seal_date):?>
							<li><?php echo pll__('Ticket Seal Date').' '.$seal_date?></li>
							<?php endif;?>
							<?php if($seal_time):?>
							<li><?php echo pll__('Ticket Seal Time').' '.$seal_time?></li>
							<?php endif;?>
							
						</ul>

						</div><!-- END // post-excerpt -->

		                </div>
                        
                        <?php
                        } //while
                    } else {
                    ?>
                        
                        <div class="page-content">
                        
                            <p><?php _e('No upcoming events were found.', 'gp'); ?></p>
                        
                        </div><!-- END // post-content -->

                    <?php 
                    } //if
                ?>
                
            </div><!-- END // grid-event-upcoming / list-event-upcoming -->
                
        </div><!-- END // content -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();