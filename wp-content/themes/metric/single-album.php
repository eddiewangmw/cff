<?php

/*

@name			    Single Album Template
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

// Content Classes
if (is_active_sidebar('widget_area_album')) {
	$content_class = 'content-sidebar content-sidebar-' . $sidebar;
} else {
	$content_class = 'content';
}

// Get Files
$files = gp_meta('gp_album_songs', 'type=upload_plupload');
$images = gp_meta('gp_album_images', 'type=upload_plupload');

get_header();
?>

	<?php get_template_part('title'); ?>
 
    <?php gp_start('div', 'canvas'); ?>

        <?php
            if ($sidebar == 'left') {
                if (is_active_sidebar('widget_area_album')) {
                    get_sidebar('album');
                }
            }
        ?>
        
        <div class="content-album single-album <?php echo $content_class; ?>" role="main">
                        
            <?php
                // Loop 
                if (have_posts()) { 
                    while (have_posts()) {
                        the_post();
                        
                        $album_artist				= __(gp_meta('gp_album_artist'));
                        $album_release_date			= gp_meta('gp_album_release_date');
                        $album_label				= __(gp_meta('gp_album_label'));
                        $album_catalog_number		= __(gp_meta('gp_album_catalog_number'));
						$album_custom_meta			= gp_meta('gp_album_custom_meta');
						$album_itunes_text			= __(gp_meta('gp_album_itunes_text'));
                        $album_itunes_url			= __(gp_meta('gp_album_itunes_url'));
                        $album_amazon_text			= __(gp_meta('gp_album_amazon_text'));
                        $album_amazon_url			= __(gp_meta('gp_album_amazon_url'));
                        $album_grooveshark_text		= __(gp_meta('gp_album_grooveshark_text'));
                        $album_grooveshark_url		= __(gp_meta('gp_album_grooveshark_url'));
                        $album_soundcloud_text		= __(gp_meta('gp_album_soundcloud_text'));
                        $album_soundcloud_url		= __(gp_meta('gp_album_soundcloud_url'));
                        $album_lastfm_text			= __(gp_meta('gp_album_lastfm_text'));
                        $album_lastfm_url			= __(gp_meta('gp_album_lastfm_url'));
                        $album_youtube_code			= gp_get_youtube_video_id(__(gp_meta('gp_album_youtube_code')));
                        $album_vimeo_code			= gp_get_vimeo_video_id(__(gp_meta('gp_album_vimeo_code')));
                        $album_content_left			= stripslashes(do_shortcode(__(gp_meta('gp_album_content_left'))));
                        $album_content_right		= stripslashes(do_shortcode(__(gp_meta('gp_album_content_right'))));
                        
                        $original_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        
                        $post_class = array('clearfix');
                        ?>
                
                            <article <?php post_class($post_class); ?>>
                                                        
                                <?php if (has_post_thumbnail() || !empty($album_content_left)) { ?>
                                
                                    <div class="one-fourth">
        
                                        <div class="post-image lightbox overlay">
                                            <a data-gallery="gallery-album" href="<?php echo $original_image_url[0]; ?>">
                                                <?php the_post_thumbnail('large'); ?>
                                                <span class="overlay-block"><span class="overlay-icon"></span></span>
                                            </a>
                                        </div><!-- END // post-image -->

                                        <div class="post-gallery grid grid-tiles-album-gallery">

                                            <?php foreach ($images as $image) { ?>

												<div class="tile lightbox overlay">
													<a data-gallery="gallery-album" href="<?php echo $image['image_full_url']; ?>" title="<?php echo $image['image_title']; ?>">
														<img src="<?php echo $image['image_url']; ?>" alt="<?php echo $image['image_alt']; ?>" />
														<span class="overlay-block"><span class="overlay-icon"></span></span>
													</a>
												</div><!-- END // one-half -->

											<?php } //foreach ?>

                                        </div>

                                        <?php if (!empty($album_content_left)) { ?>
                                    
                                            <div class="post-content-optional">
                                                <?php echo $album_content_left; ?>
                                            </div><!-- END // post-content-optional -->
                                        
                                        <?php } ?>
                                    
                                    </div><!-- END // one-fourth -->

                                <?php } ?>
                                
                                <?php if (has_post_thumbnail() || !empty($album_content_left)) { ?>
                                
                                <div class="three-fourth">
                                
                                <?php } else { ?>
                                
                                <div class="one-entire">
                                
                                <?php } ?>
                                
                                    <div class="col-1 two-third">
                                
                                        <?php if ($files != NULL) { ?>
        
                                            <div class="post-audio">
                                                <?php if (function_exists('gp_player')) { gp_player(true); } ?>
                                            </div><!-- END // post-audio -->
                                        
                                        <?php } ?>

                                        <?php if (!empty($album_youtube_code)) { ?>

                                            <div class="single-post-video margin-bottom">
                                                <iframe src="http://www.youtube.com/embed/<?php echo $album_youtube_code; ?>?wmode=opaque&amp;autoplay=0&amp;enablejsapi=1&modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=dark" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                                            </div><!-- END // post-video -->

                                        <?php } else if (!empty($album_vimeo_code)) { ?>

                                            <div class="single-post-video margin-bottom">
                                                <iframe src="http://player.vimeo.com/video/<?php echo $album_vimeo_code; ?>?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                            </div><!-- END // post-video -->

                                        <?php } ?>
        
                                        <div class="post-content">
                                            <?php the_content(); ?>
                                        </div><!-- END // post-content -->

                                    </div><!-- END // two-third -->
                                
                                    <div class="col-2 one-third">
                                
                                        <div class="single-post-meta clearfix">
                                        
                                            <?php if (!empty($album_itunes_text) && !empty($album_itunes_url)) { ?>
                                            
                                                <div class="post-buy button">
                                                    <a href="<?php echo $album_itunes_url; ?>" title="<?php echo $album_itunes_text; ?>" target="_blank">
                                                        <?php echo $album_itunes_text; ?>
                                                    </a>
                                                </div>
                                                
                                            <?php } ?>
                                            
                                            <?php if (!empty($album_amazon_text) && !empty($album_amazon_url)) { ?>
                                            
                                                <div class="post-buy button">
                                                    <a href="<?php echo $album_amazon_url; ?>" title="<?php echo $album_amazon_text; ?>" target="_blank">
                                                        <?php echo $album_amazon_text; ?>
                                                    </a>
                                                </div>
                                                
                                            <?php } ?>
                                            
                                            <?php if (!empty($album_grooveshark_text) && !empty($album_grooveshark_url)) { ?>
                                            
                                                <div class="post-buy button">
                                                    <a href="<?php echo $album_grooveshark_url; ?>" title="<?php echo $album_grooveshark_text; ?>" target="_blank">
                                                        <?php echo $album_grooveshark_text; ?>
                                                    </a>
                                                </div>
                                                
                                            <?php } ?>
                                            
                                            <?php if (!empty($album_soundcloud_text) && !empty($album_soundcloud_url)) { ?>
                                            
                                                <div class="post-buy button">
                                                    <a href="<?php echo $album_soundcloud_url; ?>" title="<?php echo $album_soundcloud_text; ?>" target="_blank">
                                                        <?php echo $album_soundcloud_text; ?>
                                                    </a>
                                                </div>
                                                
                                            <?php } ?>
                                            
                                            <?php if (!empty($album_lastfm_text) && !empty($album_lastfm_url)) { ?>
                                            
                                                <div class="post-buy button">
                                                    <a href="<?php echo $album_lastfm_url; ?>" title="<?php echo $album_lastfm_text; ?>" target="_blank">
                                                        <?php echo $album_lastfm_text; ?>
                                                    </a>
                                                </div>
                                                
                                            <?php } ?>
                                
                                            <div class="single-post-meta-table underline">
                                                    
                                                <?php if (!empty($album_artist)) { ?>
                                                    
                                                    <div class="post-artist row clearfix">
                                                        <div class="cell head"><div class="inner"><?php _e('Artist', 'gp'); ?></div></div>
                                                        <div class="cell"><div class="inner"><?php echo $album_artist; ?></div></div>
                                                    </div><!-- END // post-time -->
                                                    
                                                <?php } ?>
                                                
                                                <?php if (!empty($album_release_date)) { ?>
                                                    
                                                    <div class="post-release-date row clearfix">
                                                        <div class="cell head"><div class="inner"><?php _e('Release Date', 'gp'); ?></div></div>
                                                        <div class="cell"><div class="inner"><?php get_template_part('date', 'album'); ?></div></div>
                                                    </div><!-- END // post-location -->
                                                    
                                                <?php } ?>
                                                
                                                <?php if (!empty($album_label)) { ?>
                                                    
                                                    <div class="post-label row clearfix">
                                                        <div class="cell head"><div class="inner"><?php _e('Label', 'gp'); ?></div></div>
                                                        <div class="cell"><div class="inner"><?php echo $album_label; ?></div></div>
                                                    </div><!-- END // post-contact -->
                                                    
                                                <?php } ?>
                                                
                                                <?php if (!empty($album_catalog_number)) { ?>
                                                
                                                    <div class="post-catalog-number row clearfix">
                                                        <div class="cell head"><div class="inner"><?php _e('Catalog Number', 'gp'); ?></div></div>
                                                        <div class="cell"><div class="inner"><?php echo $album_catalog_number; ?></div></div>
                                                    </div><!-- END // post-status -->
                                                    
                                                <?php } ?>

												<?php
												if (!empty($album_custom_meta)) {
													foreach ($album_custom_meta as $album_meta) {
														$album_meta_value = explode(':', __($album_meta));
														?>

														<div class="post-custom-meta row clearfix">
															<?php if (!empty($album_meta_value[0])) { ?>
																<div class="cell head"><div class="inner"><?php echo $album_meta_value[0]; ?></div></div>
															<?php
															} if (!empty($album_meta_value[1])) {
																?>
																<div class="cell"><div class="inner"><?php echo $album_meta_value[1]; ?></div></div>
															<?php } ?>
														</div><!-- END // post-custom-meta -->

													<?php
													}
												}
												?>
                                                
                                            </div><!-- END // post-meta-table -->
                                            
                                        </div><!-- END // post-meta -->

                                        <?php if (!empty($album_content_right)) { ?>
                                    
                                            <div class="post-content-optional">
                                                <?php echo $album_content_right; ?>
                                            </div><!-- END // post-content-optional -->
                                        
                                        <?php } ?>
                                        
                                        <?php if (function_exists('gp_share')) { gp_share(); } ?>
                                        
                                    </div><!-- END // one-third -->
                                
                                </div><!-- END // three-fourth | one-entire -->
        
                            </article><!-- END // post -->
                        
                        <?php
                    } //while
                } //if
                wp_reset_query();
            ?>
            
            <?php
                if (comments_open()) {
                    comments_template();
                } 
            ?>
                            
        </div><!-- END // content -->
        
        <?php
            if ($sidebar == 'right') {
                if (is_active_sidebar('widget_area_album')) {
                    get_sidebar('album');
                }
            }
        ?>

	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();