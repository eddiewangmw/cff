<?php

/*

@name			    Video Post Format Content Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

global $view_type, $view_page, $post_count;

// Video Codes
$youtube_code	= gp_get_youtube_video_id(__(gp_meta('gp_post_youtube_code')));
$vimeo_code		= gp_get_vimeo_video_id(__(gp_meta('gp_post_vimeo_code')));

// !Single
if (!is_single()) {
    
    if ($view_type == 'grid') {
    ?>
    
    <?php if (has_post_thumbnail()) { ?>

		<div class="post-image overlay overlay-video">
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
    
        <div class="post-content">
            <h2 class="post-header">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?></a>
            </h2><!-- END // post-header -->
                                            
            <?php get_template_part('meta'); ?>
            
            <?php if (!empty($post->post_content)) { ?>
            
                <div class="post-excerpt">
                    <?php the_excerpt(); ?>
                </div><!-- END // post-excerpt -->
            
            <?php } ?>
    
            <div class="post-more">
                <a href="<?php the_permalink(); ?>" title="<?php _e('Read more ...', 'gp'); ?> <?php the_title(); ?>">
                    <?php _e('Read more ...', 'gp'); ?>
                </a>
            </div><!-- END // post-more -->
        
        </div><!-- END // post-content -->
    
    <?php
    } else if ($view_type == 'list') {
    ?>
    
        <?php if (has_post_thumbnail()) { ?>
    
			<div class="post-image overlay">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
					<?php the_post_thumbnail('large-wide'); ?>
					<span class="overlay-block"><span class="overlay-icon"></span></span>
				</a>
			</div><!-- END // post-image -->
    
		<?php } ?>
        
        <?php get_template_part('meta'); ?>

        <h2 class="post-header">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?></a>
        </h2><!-- END // post-header -->
        
        <?php if (!empty($post->post_content)) { ?>
        
            <div class="post-excerpt">
                <?php the_excerpt(); ?>
            </div><!-- END // post-excerpt -->
        
        <?php } ?>
        
        <div class="post-footer clearfix">
            <div class="post-taxonomies float-left two-third underline">
                <?php the_taxonomies(); ?>
            </div><!-- END // post-taxonomies -->
        
            <div class="post-more float-right one-third">
                <a href="<?php the_permalink(); ?>" title="<?php _e('Read more ...', 'gp'); ?> <?php the_title(); ?>">
                    <?php _e('Read more ...', 'gp'); ?></a>
            </div><!-- END // post-more -->
        </div><!-- END // post-footer -->
    
    <?php
    }
    
// Single
} else if (is_single()) {
?>

    <?php get_template_part('meta'); ?>

    <?php if (!empty($youtube_code)) { ?>
                            
        <div class="post-video">
            <iframe src="http://www.youtube.com/embed/<?php echo $youtube_code; ?>?wmode=opaque&amp;autoplay=0&amp;enablejsapi=1&modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=dark" width="560" height="315" frameborder="0" allowfullscreen></iframe>
        </div><!-- END // post-video -->
        
    <?php } else if (!empty($vimeo_code)) { ?>
    
        <div class="post-video">
            <iframe src="http://player.vimeo.com/video/<?php echo $vimeo_code; ?>?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        </div><!-- END // post-video -->
        
    <?php } ?>

    <?php if (!empty($post->post_content)) { ?>
        
        <div class="single-post-content">
            <?php the_content(); ?>
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