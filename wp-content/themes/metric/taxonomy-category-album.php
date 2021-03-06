<?php

/*

@name			    Album Taxonomy Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar
if (gp_option('gp_album_sidebar')) {
	$sidebar		= gp_option('gp_album_sidebar');
} else {
	$sidebar		= 'left';
}

// Content Class
if (get_terms('category-album') || is_active_sidebar('widget-area-album')) {
	$content_class  = 'content-sidebar content-sidebar-' . $sidebar;
	$grid_class     = 'grid-tiles-sidebar';
} else {
	$content_class  = 'content';
	$grid_class     = 'grid-tiles';
}

get_header();
?>

	<?php get_template_part('title'); ?>
    
	<?php gp_start('div', 'canvas'); ?>

        <?php
            if ($sidebar == 'left') {
                if (get_terms('category-album') || is_active_sidebar('widget-area-album')) {
                    get_sidebar('album');
                }
            }
        ?>
        
        <div class="content-album <?php echo $content_class; ?>" role="main">
            
            <?php
                if (term_description()) {
                ?>
                    
                    <div class="content-page">
                        
                        <?php echo term_description(); ?>
                        
                    </div>
                    
                <?php
                }
            ?>
            
            <div class="grid-album <?php echo $grid_class; ?>">

                <?php
                    global $post;
                    
                    // Counter
                    $post_count = 1;
                    
                    // Posts per Page
                    if (gp_option('gp_album_number')) {
                        $posts_per_page = gp_option('gp_album_number');
                    } else {
                        $posts_per_page = '-1';
                    }
                    
                    // Get Terms
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $term_slug = is_object($term) ? $term->slug : $term['slug'];

                    // Query
                    $gp_query_args = array(
                        'post_type'             => 'album',
                        'taxonomy'			    => 'category-album',
                        'term'                  => $term_slug,
                        'post_status'           => 'publish',
                        'order'	                => 'DESC',
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
                            
                            $album_artist				= __(gp_meta('gp_album_artist'));
                            $album_release_date	        = gp_meta('gp_album_release_date');
                            
                            $block_class 				= array('tile', 'post', 'post-' . $post_count);
                            ?>
                            
                                <article <?php post_class($block_class); ?>>
                                    
                                    <div class="tile-block">
                                    
                                        <?php if (has_post_thumbnail()) { ?>
                                    
                                            <div class="post-image overlay">
                                            
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                    <?php the_post_thumbnail('small-square'); ?>
                                                    <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                </a>
                                                
                                            </div><!-- END // post-image -->
                                        
                                        <?php } ?>
                                        
                                        <div class="post-content">
                                
                                            <h2 class="post-header">
                                                
                                                <a class="underline" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                                
                                            </h2><!-- END // post-header -->
                                            
                                            <?php if (!empty($album_artist)) { ?>
                                            
                                                <div class="post-artist">
                                                    
                                                    <strong><?php echo $album_artist; ?></strong>
                                                    
                                                </div><!-- END // post-artist -->
                                            
                                            <?php } ?>
                                            
                                            <?php if (!empty($album_release_date)) { ?>
                                                
                                                <div class="post-meta">
            
                                                    <?php get_template_part('date', 'album'); ?>
                                                
                                                </div><!-- END // post-meta -->
                                                
                                            <?php } ?>
                                            
                                            <?php if (function_exists('zilla_likes')) { ?>
                                                
                                                <div class="post-likes">
                                                    
                                                    <?php zilla_likes(); ?>
                                                    
                                                </div><!-- END // post-likes -->
                                                
                                            <?php } ?>
                                        
                                        </div><!-- END // post-content -->
                                        
                                    </div><!-- END // tile-block -->
    
                                </article><!-- END // tile -->

                            <?php
                            $post_count++; 
                        } //while
                    } else {
                    ?>

                        <div class="page-content">
                        
                            <p><?php _e('No albums were found.', 'gp'); ?></p>
                            
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
                if (get_terms('category-album') || is_active_sidebar('widget-area-album')) {
                    get_sidebar('album');
                }
            }
        ?>

	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();