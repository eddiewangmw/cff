<?php

/*

@name			    Search Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar
if (gp_option('gp_page_sidebar')) {
	$sidebar        = gp_option('gp_page_sidebar');
} else {
	$sidebar        = 'left';
}

// Content & Grid Classes
if (is_active_sidebar('widget-area-page')) {
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
	$grid_class		= 'grid-tiles-sidebar';
} else {
	$content_class	= 'content';
	$grid_class		= 'grid-tiles';
}

get_header();
?>

    <?php
        global $query_string;
					
		$query_args = explode("&", $query_string);
		$search_query = array();
		
		foreach ($query_args as $key => $string) {
			$query_split = explode("=", $string);
			$search_query[$query_split[0]] = urldecode($query_split[1]);
		}
		
		$search = new WP_Query($search_query);
    ?>
    
    <?php gp_start('header', 'title'); ?>
    
	<?php
        if ($search->have_posts()) {
        ?>
        
            <h1>
                <?php
                global $wp_query;
                $total_results = $wp_query->found_posts;
                
                printf(__('%s results for \'%s\'', 'gp'), $total_results, get_search_query());
                ?>
            </h1>
        
        <?php
        } else {
        ?>
        
            <h1>
                <?php _e('Nothing Found', 'gp'); ?>
            </h1>
        
        <?php
        }
    ?>
    
    <?php gp_end('header', 'title'); ?>
    
	<?php gp_start('div', 'canvas'); ?>
    
    	<?php
            if ($search->have_posts()) {
            ?>

                <?php
                    if ($sidebar == 'left') {
                        if (is_active_sidebar('widget-area-page')) {
                            get_sidebar();
                        }
                    }
                ?>
                
                <div class="content-search <?php echo $content_class; ?>" role="main">
                    
                    <div class="grid-search <?php echo $grid_class; ?>">
        
                        <?php
                            while ($search->have_posts()) {
                                $search->the_post();
                            
                                $post_class = array('tile', 'post');
                                ?>
                            
                                <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                                
                                    <div class="tile-block">
                                        
                                        <h2 class="post-header">
                                            
                                            <a class="underline" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                
                                                <?php
                                                    $title = get_the_title();
                                                    $title_keys= explode(" ",$s);
                                                    $title = preg_replace('/('.implode('|', $title_keys) .')/iu', '<span class="highlight-title">\0</span>', $title);
                                                    echo $title; 
                                                ?>
                                                
                                            </a>
                                            
                                        </h2><!-- END // post-header -->
                                        
                                        <?php if (get_post_type() == 'event') { ?>
                                            
                                            <h5 class="post-date">
                                                
                                                <?php get_template_part('date', 'event'); ?>
                                                
                                                <?php if (!empty($event_time)) { ?>
                                                    <small class="block post-time">
                                                        <?php echo $event_time; ?>                             
                                                    </small><!-- END // post-time -->
                                                <?php } ?>
                                                
                                            </h5><!-- END // post-date -->
                                            
                                        <?php } else { ?>
                                        
                                            <div class="post-meta">
                                                
                                                <?php the_time(); ?>
                                                
                                            </div><!-- END // post-meta -->
                                        
                                        <?php } ?>
                                        
                                        <?php if (!empty($post->post_content)) { ?>
    
                                            <div class="post-excerpt">
                                                
                                                <?php
                                                    $excerpt = get_the_excerpt();
                                                    $excerpt_keys= explode(" ",$s);
                                                    $excerpt = preg_replace('/('.implode('|', $excerpt_keys) .')/iu', '<span class="highlight-excerpt">\0</span>', $excerpt);
                                                    echo $excerpt;
                                                ?>
                                                
                                            </div><!-- END // post-excerpt -->
                                        
                                        <?php } ?>
                                    
                                    </div><!-- END // tile-block -->
                                
                                </article><!-- END // tile -->
                            
                            <?php
                            } //while
                        wp_reset_query();
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
                        if (is_active_sidebar('widget-area-page')) {
                            get_sidebar();
                        }
                    }
                ?>
                
            <?php 
            } else {
            ?>
            
                <?php
                    if ($sidebar == 'left') {
                        if (is_active_sidebar('widget-area-page')) {
                            get_sidebar();
                        }
                    }
                ?>

                <div class="content-search <?php echo $content_class; ?>" role="main">
                    
                    <h3><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'gp'); ?></h3>
                    
                    <?php get_search_form(); ?>
                    
                </div><!-- END // content -->
                
                <?php
                    if ($sidebar == 'right') {
                        if (is_active_sidebar('widget-area-page')) {
                            get_sidebar();
                        }
                    }
                ?>
            
            <?php
            }
        ?>
        
	<?php gp_end('div', 'canvas'); ?>
        
<?php
get_footer();