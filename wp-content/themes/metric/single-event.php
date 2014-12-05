<?php

/*

@name			    Single Event Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/ 

// Content & Grid Classes
$content_class	= 'content';

get_header();
?>

	<?php get_template_part('title'); ?>
    
	<?php gp_start('div', 'canvas'); ?>

    <?php
            if (get_terms('category-event') || is_active_sidebar('widget-area-event')) {
                get_sidebar('event');
            }
    ?>
        <div class="content-event content-sidebar <?php echo $content_class; ?>" role="main">
                            
            <?php 
                if (have_posts()) { 
                    while (have_posts()) {
                        the_post();

                        $event_time					= __(gp_meta('gp_event_time'));
                        $event_venue				= __(gp_meta('gp_event_venue'));
                        $event_venue_url			= __(gp_meta('gp_event_location_url'));
                        $event_location				= __(gp_meta('gp_event_location'));
                        $event_contact				= __(gp_meta('gp_event_contact'));
                        $event_price				= __(gp_meta('gp_event_price'));
						$event_custom_meta			= gp_meta('gp_event_custom_meta');
						$event_status				= __(gp_meta('gp_event_status'));
                        $event_buy_text_1			= __(gp_meta('gp_event_buy_text_1'));
                        $event_buy_url_1			= __(gp_meta('gp_event_buy_url_1'));
                        $event_buy_text_2			= __(gp_meta('gp_event_buy_text_2'));
                        $event_buy_url_2			= __(gp_meta('gp_event_buy_url_2'));
                        $event_facebook_text		= __(gp_meta('gp_event_facebook_text'));
                        $event_facebook_url			= __(gp_meta('gp_event_facebook_url'));
                        $event_vk_text		        = __(gp_meta('gp_event_vk_text'));
                        $event_vk_url			    = __(gp_meta('gp_event_vk_url'));
						$event_google_map_embed		= __(gp_meta('gp_event_googlemap_embed'));
                        $event_youtube_code			= gp_get_youtube_video_id(__(gp_meta('gp_event_youtube_code')));
                        $event_vimeo_code			= gp_get_vimeo_video_id(__(gp_meta('gp_event_vimeo_code')));

                        $original_image_url 		= wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        
                        $post_class = array('clearfix');
                        ?>
                
                            <article <?php post_class($post_class); ?>>
                                
                                <?php
                                    if (has_post_thumbnail() || !empty($event_youtube_code) || !empty($event_vimeo_code)) {
                                        $post_block_class = 'one-half';
                                    } else {
                                        $post_block_class = 'one-entire';
                                    }
                                ?>
                                <div class="single-post-block post-block <?php echo $post_block_class; ?>">
                                    
                                    <div class="single-post-meta clearfix">
                                        
                                        <ul>
                                            <li class="single-post-date">
                                                
                                                <h3><?php get_template_part('date', 'event'); ?></h3>
                                                
                                            </li>
                                            <li>
                                                
                                                <?php
                                                    if (!empty($event_venue)) {
                                                        if (!empty($event_venue_url)) {
                                                        ?>
                                                    
                                                            <h4 class="single-post-venue">
                                                        
                                                                <a  href="<?php echo $event_venue_url; ?>" title="<?php echo $event_venue; ?>" target="_blank">
                                                                    <?php echo $event_venue; ?>
                                                                </a>
                                                                
                                                            </h4><!-- END // post-venue -->
                                                            
                                                        <?php
                                                        } else {
                                                        ?>
                                                            
                                                            <h4 class="single-post-venue">
                                                                <?php echo $event_venue; ?>
                                                            </h4><!-- END // post-venue -->
                                                            
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                                
                                                <?php if (!empty($event_location)) { ?>
                                                    
                                                    <h4 class="single-post-location">
                                                        <?php echo $event_location; ?>
                                                    </h4><!-- END // post-location -->
                                                    
                                                <?php } ?>
                                                
                                            </li>
                                        </ul>
                                            
                                    </div><!-- END // post-meta-line -->
                                
                                    <div class="single-post-meta clearfix">
                                        
                                        <div class="single-post-meta-table">
                                            
                                            <?php if (!empty($event_time)) { ?>
                                                
                                                <div class="single-post-time row clearfix">
                                                    <div class="cell head"><?php _e('Time', 'gp'); ?></div>
                                                    <div class="cell"><?php echo $event_time; ?></div>
                                                </div><!-- END // post-time -->
                                                
                                            <?php } ?>
                                            
                                            <?php if (!empty($event_contact)) { ?>
                                                
                                                <div class="single-post-contact row clearfix">
                                                    <div class="cell head"><?php _e('Contact', 'gp'); ?></div>
                                                    <div class="cell"><?php echo $event_contact; ?></div>
                                                </div><!-- END // post-contact -->
                                                
                                            <?php } ?>
                                            
                                            <?php if (!empty($event_status)) { ?>
                                            
                                                <div class="single-post-status row clearfix">
                                                    <div class="cell head"><?php _e('Status', 'gp'); ?></div>
                                                    <div class="cell"><?php echo $event_status; ?></div>
                                                </div><!-- END // post-status -->
                                                
                                            <?php } ?>
                                            
                                            <?php if (!empty($event_price)) { ?>
                                            
                                                <div class="single-post-price row clearfix">
                                                    <div class="cell head"><?php _e('Price', 'gp'); ?></div>
                                                    <div class="cell"><?php echo $event_price; ?></div>
                                                </div><!-- END // post-price -->
                                                
                                            <?php } ?>

											<?php
											if (!empty($event_custom_meta)) {
												foreach ($event_custom_meta as $event_meta) {
													$event_meta_value = explode(':', __($event_meta));
													?>

													<div class="post-custom-meta row clearfix">
														<?php if (!empty($event_meta_value[0])) { ?>
															<div class="cell head"><div class="inner"><?php echo $event_meta_value[0]; ?></div></div>
														<?php
														} if (!empty($event_meta_value[1])) {
															?>
															<div class="cell"><div class="inner"><?php echo $event_meta_value[1]; ?></div></div>
														<?php } ?>
													</div><!-- END // post-custom-meta -->

												<?php
												}
											}
											?>
                                            
                                        </div><!-- END // single-post-meta-table -->
                                        
                                        <?php if (!empty($event_facebook_text) && !empty($event_facebook_url)) { ?>
                                            
                                            <div class="post-buy post-facebook button">
                                                <a href="<?php echo $event_facebook_url; ?>" title="<?php echo $event_facebook_text; ?>" target="_blank">
                                                    <?php echo $event_facebook_text; ?>
                                                </a>
                                            </div>
                                        
                                        <?php } ?>
                                        
                                        <?php if (!empty($event_vk_text) && !empty($event_vk_url)) { ?>
                                            
                                            <div class="post-buy post-vk button">
                                                <a href="<?php echo $event_vk_url; ?>" title="<?php echo $event_vk_text; ?>" target="_blank">
                                                    <?php echo $event_vk_text; ?>
                                                </a>
                                            </div>
                                        
                                        <?php } ?>
                                        
                                        <?php if (!empty($event_buy_text_1) && !empty($event_buy_url_1)) { ?>
                                            
                                            <div class="post-buy button">
                                                <a href="<?php echo $event_buy_url_1; ?>" title="<?php echo $event_buy_text_1; ?>" target="_blank">
                                                    <?php echo $event_buy_text_1; ?>
                                                </a>
                                            </div>
                                            
                                        <?php } ?>
                                        
                                        <?php if (!empty($event_buy_text_2) && !empty($event_buy_url_2)) { ?>
                                            
                                            <div class="post-buy button">
                                                <a href="<?php echo $event_buy_url_2; ?>" title="<?php echo $event_buy_text_2; ?>" target="_blank">
                                                    <?php echo $event_buy_text_2; ?>
                                                </a>
                                            </div>
                                            
                                        <?php } ?>
                                        
                                    </div><!-- END // single-post-meta -->
                                    
                                    <div class="single-post-content">
                                        <?php the_content(); ?>
                                    </div><!-- END // post-content -->
    
                                </div><!-- END // one-half | one-entire -->
                                
                                <?php
                                    if (has_post_thumbnail() || !empty($event_youtube_code) || !empty($event_vimeo_code)) {
                                        $post_block_class = 'one-half';
                                    } else {
                                        $post_block_class = 'one-entire';
                                    }
                                ?>
                                <div class="single-post-block post-block <?php echo $post_block_class; ?>">
                                    
                                    <?php if (has_post_thumbnail()) { ?>
                                    
                                        <div class="single-post-image post-image lightbox overlay clearfix">
                                            
                                            <a href="<?php echo $original_image_url[0]; ?>">
                                                <?php the_post_thumbnail('large'); ?>
                                                <span class="overlay-block"><span class="overlay-icon"></span></span>
                                            </a>
                                            
                                        </div><!-- END // post-image -->
                                        
                                    <?php } ?>
                                    
                                    <?php if (!empty($event_youtube_code)) { ?>

                                        <div class="single-post-video post-video">
                                            <iframe src="http://www.youtube.com/embed/<?php echo $event_youtube_code; ?>?wmode=opaque&amp;autoplay=0&amp;enablejsapi=1&modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=dark" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                                        </div><!-- END // post-video -->

                                    <?php } ?>

                                    <?php if (!empty($event_vimeo_code)) { ?>
                                    
                                        <div class="single-post-video post-video">
                                            <iframe src="http://player.vimeo.com/video/<?php echo $event_vimeo_code; ?>?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                        </div><!-- END // post-video -->
                                        
                                    <?php } ?>

									<?php if (!empty($event_google_map_embed)) { ?>
										<div class="post-map">
											<?php echo stripslashes($event_google_map_embed); ?>
										</div><!-- END // post-map -->
									<?php } ?>
                                    
                                </div><!-- END // one-half | one-entire -->
                                
                            </article><!-- END // post -->
                
                        <?php
                    } //while
                } //if
            wp_reset_query();
            ?>
            
                            
        </div><!-- END // content -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();