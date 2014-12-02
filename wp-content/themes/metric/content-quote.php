<?php

/*

@name			    Quote Post Format Content Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

global $view_type, $view_page, $post_count;

// !Single
if (!is_single()) {
    
    if ($view_type == 'grid') {
    ?>
    
        <div class="post-content">
            <blockquote>
                <?php
                    if (gp_meta('gp_post_quote')) {
                        echo gp_meta('gp_post_quote');
                    } else {
                        the_content();
                    }
                ?>
            </blockquote>
            
            <h2 class="post-header">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?></a>
            </h2><!-- END // post-header -->
        </div><!-- END // post-content -->
    
    <?php
    } else if ($view_type == 'list') {
    ?>
    
        <blockquote>
            <?php
                if (gp_meta('gp_post_quote')) {
                    echo gp_meta('gp_post_quote');
                } else {
                    the_content();
                }
            ?>
        </blockquote>

        <h2 class="post-header">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?></a>
        </h2><!-- END // post-header -->
    
    <?php
    }
    
// Single
} else if (is_single()) {
?>

    <?php if (gp_meta('gp_post_quote')) { ?>
    
        <div class="single-post-content">
            <blockquote>
                <?php
                    if (gp_meta('gp_post_quote')) {
                        echo gp_meta('gp_post_quote');
                    } else {
                        the_content();
                    }
                ?>
            </blockquote>
        </div><!-- END // post-content -->
    
    <?php } ?>
    
    <?php if (has_tag()) { ?>
    
        <div class="post-tags">
            <?php the_tags('', '', ''); ?>
        </div><!-- END // post-tags -->
        
    <?php } ?>
    
    <?php if (function_exists('gp_share')) { gp_share(); } ?>

<?php
}