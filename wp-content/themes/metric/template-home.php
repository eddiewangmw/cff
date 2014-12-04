<?php

/*

Template Name:	    Homepage

@name			    Homepage Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

get_header();
?>
	<div class="ads ad-home-top">
		<?php dynamic_sidebar('widget-ad-home-top'); ?> 
	</div>
	<?php if (get_posts('post_type=slide')) { ?>

		<?php
			if (gp_option('gp_slideshow_type')) {
				$slideshow_type = gp_option('gp_slideshow_type');
			} else {
				$slideshow_type = 'normal';
			}
		?>

		<div class="slideshow">

			<div class="slideshow-container <?php echo $slideshow_type; ?>">

				<div class="slider">

					<div class="slider-container">

						<ul>

							<?php
								global $post;

								// Counter
								$slide_count = 1;
								// Query
								$gp_query_args = array(
									'post_type'              => 'slide',
									'posts_per_page'         => -1,
									'exclude'=>get_the_ID()
								);
								query_posts($gp_query_args);

								// Loop
								if (have_posts()) {
									while (have_posts()) {
										the_post();

										$slide_image_helper	= get_template_directory_uri() . '/images/bg-helper-1180x600.png';

										$slide_title            = __(gp_meta('gp_slide_title'));
										$slide_caption          = __(gp_meta('gp_slide_caption'));
										$slide_url              = __(gp_meta('gp_slide_url'));
										$slide_youtube_code	    = gp_get_youtube_video_id(__(gp_meta('gp_slide_youtube_code')));
										$slide_vimeo_code       = gp_get_vimeo_video_id(__(gp_meta('gp_slide_vimeo_code')));
										$slide_video_full       = gp_meta('gp_slide_video_full');

										if (gp_meta('gp_slide_transition') != 'default') {
											$slide_transition = gp_meta('gp_slide_transition');
										} else if (gp_meta('gp_slide_transition') == 'default') {
											if (gp_option('gp_slideshow_transition_default')) {
												$slide_transition = gp_option('gp_slideshow_transition_default');
											} else {
												$slide_transition = 'papercut';
											}
										} else {
											$slide_transition = 'papercut';
										}

										if (gp_meta('gp_slide_transition_speed')) {
											$slide_transition_speed = gp_meta('gp_slide_transition_speed');
										} else {
											$slide_transition_speed = '300';
										}

										$slide_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large-fixed');

										/* Slide Class */
										if (has_post_thumbnail()) {
											$slide_class = 'slide' . ' slide-' . $slide_count;
										} else {
											$slide_class = 'slide' . ' slide-' . $slide_count . ' without-image';
										}

										if (!empty($slide_youtube_code)) {
										?>

											<li
												class="<?php echo $slide_class; ?>"
												data-transition="<?php echo $slide_transition; ?>"
												data-masterspeed="<?php echo $slide_transition_speed; ?>"
												data-slotamount="10">

												<img src="<?php if (has_post_thumbnail()) { echo $slide_image_url[0]; } else { echo $slide_image_helper; } ?>" alt="<?php echo $slide_title; ?>" />

												<?php
													if ($slide_video_full == '1') {
														$slide_video_class = ' fullscreenvideo';
													} else {
														$slide_video_class = ' video';
													}
												?>

												<div class="caption fade fadeout<?php echo $slide_video_class; ?>" data-speed="500" data-start="500" data-easing="easeOutBack">

													<iframe src="https://www.youtube.com/embed/<?php echo $slide_youtube_code; ?>?hd=1&amp;wmode=opaque&amp;controls=1&amp;showinfo=0" width="640" height="360"></iframe>

												</div>

												<?php if ($slide_video_full != '1') { ?>

													<div class="slide-caption caption lfl ltl" data-x="0" data-y="bottom" data-speed="500" data-start="500" data-easing="easeOutBack">

														<?php
															if ($slide_title != '0') {
																if (!empty($slide_url)) {
																?>

																	<h2 class="slide-title title">
																		<a href="<?php echo $slide_url; ?>" title="<?php the_title_attribute(); ?>">
																			<?php the_title(); ?>
																		</a>
																	</h2>

																<?php
																} else {
																?>

																	<h2 class="slide-title title without-link">
																		<?php the_title(); ?>
																	</h2>

																<?php
																}
															}
														?>

														<?php if (!empty($slide_caption)) { ?>

															<div class="slide-description">
																<?php echo $slide_caption; ?>
															</div>

														<?php } ?>

													</div><!-- END // slide-caption -->

												<?php } ?>

											</li><!-- END // slide -->

										<?php
										} else if (!empty($slide_vimeo_code)) {
										?>

											<li
												class="<?php echo $slide_class; ?>"
												data-transition="<?php echo $slide_transition; ?>"
												data-masterspeed="<?php echo $slide_transition_speed; ?>"
												data-slotamount="10">

												<img src="<?php if (has_post_thumbnail()) { echo $slide_image_url[0]; } else { echo $slide_image_helper; } ?>" alt="<?php echo $slide_title; ?>" />

												<?php
													if ($slide_video_full == '1') {
														$slide_video_class = ' fullscreenvideo';
													} else {
														$slide_video_class = ' video';
													}
												?>

												<div class="caption fade fadeout<?php echo $slide_video_class; ?>" data-speed="500" data-start="500" data-easing="easeOutBack">

													<iframe src="http://player.vimeo.com/video/<?php echo $slide_vimeo_code; ?>?title=0&amp;byline=0&amp;portrait=0;api=1" width="640" height="360"></iframe>

												</div>

												<?php if ($slide_video_full != '1') { ?>

													<div class="slide-caption caption lfl ltl" data-x="0" data-y="bottom" data-speed="500" data-start="500" data-easing="easeOutBack">

														<?php
															if ($slide_title != '0') {
																if (!empty($slide_url)) {
																?>

																	<h2 class="slide-title">
																		<a href="<?php echo $slide_url; ?>" title="<?php the_title_attribute(); ?>">
																			<?php the_title(); ?>
																		</a>
																	</h2>

																<?php
																} else {
																?>

																	<h2 class="slide-title without-link">
																		<?php the_title(); ?>
																	</h2>

																<?php
																}
															}
														?>

														<?php if (!empty($slide_caption)) { ?>

															<div class="slide-description">
																<?php echo $slide_caption; ?>
															</div>

														<?php } ?>

													</div><!-- END // slide-caption -->

												<?php } ?>

											</li><!-- END // slide -->

										<?php
										} else {
										?>

											<li
												class="<?php echo $slide_class; ?>"
												data-transition="<?php echo $slide_transition; ?>"
												data-masterspeed="<?php echo $slide_transition_speed; ?>"
												data-slotamount="10">

												<img src="<?php if (has_post_thumbnail()) { echo $slide_image_url[0]; } else { echo $slide_image_helper; } ?>" alt="<?php echo $slide_title; ?>" />

												<div class="slide-caption caption lfl ltl" data-x="0" data-y="bottom" data-speed="500" data-start="500" data-easing="easeOutBack">

													<?php
														if ($slide_title != '0') {
															if (!empty($slide_url)) {
															?>

																<h2 class="slide-title">
																	<a href="<?php echo $slide_url; ?>" title="<?php the_title_attribute(); ?>">
																		<?php the_title(); ?>
																	</a>
																</h2>

															<?php
															} else {
															?>

																<h2 class="slide-title without-link">
																	<?php the_title(); ?>
																</h2>

															<?php
															}
														}
													?>

													<?php if (!empty($slide_caption)) { ?>

														<div class="slide-description">
															<?php echo $slide_caption; ?>
														</div>

													<?php } ?>

												</div><!-- END // slide-caption -->

											</li><!-- END // slide -->

										<?php
										} //if

									$slide_count++;
									} //while
								} //if
								wp_reset_query();
							?>

						</ul>

					</div><!-- END // slider-container -->

				</div><!-- END // slider -->

			</div><!-- END // slideshow-container -->

		</div><!-- END // slideshow -->

	<?php } ?>

    <?php if (get_posts('post_type=callout') && gp_option('gp_callout_homepage') != 'false') { ?>

        <?php gp_start('div', array('canvas', 'canvas-dark')); ?>

            <?php
                if (wp_count_posts('callout')->publish == 1) {
                    $callout_number = 1;
                } else if (wp_count_posts('callout')->publish == 2) {
                    $callout_number = 2;
                } else if (wp_count_posts('callout')->publish == 3) {
                    $callout_number = 3;
                } else if (wp_count_posts('callout')->publish == 4) {
                    $callout_number = 4;
                } else if (wp_count_posts('callout')->publish > 4) {
                    $callout_number = 4;
                } else {
                    $callout_number = 4;
                }
            ?>

            <div class="grid-callout-home posts-no-<?php echo $callout_number; ?><?php if (!get_posts('post_type=slide')) { ?> no-slides<?php }?>">

                <?php
                    global $post;

                    // Counter
                    $callout_count = 1;

                    // Query
                    $gp_query_args = array(
                        'post_type'              => 'callout',
                        'posts_per_page'         => $callout_number
                    );

                    query_posts($gp_query_args);

                    // Loop
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();

                            if (has_post_thumbnail()) {
                                $class_thumbnail = 'has-post-thumbnail';
                            } else {
                                $class_thumbnail = 'no-post-thumbnail';
                            }

                            if (gp_meta('gp_callout_url')) {
                                $class_url = 'has-url';
                            } else {
                                $class_url = 'no-url';
                            }

                            $callout_title          = __(gp_meta('gp_callout_title'));
                            $callout_url            = __(gp_meta('gp_callout_url'));
                            $callout_description    = __(gp_meta('gp_callout_desc'));

                            $callout_class = array('post', 'post-no-' . $callout_count, $class_thumbnail, $class_url);
                            ?>

                                <article <?php post_class($callout_class); ?>>

                                    <?php if (has_post_thumbnail()) { ?>

                                        <div class="post-image overlay-back">

                                            <a href="<?php echo $callout_url; ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('small-fixed'); ?>
												
                                                <?php if ($callout_title != '0') { ?>

                                                    <span class="overlay-block">

                                                        <span class="post-title">
															
                                                            <span class="post-title-container">
																<h4><?php echo $callout_description;?></h4>
																<span></span>
                                                                <?php the_title(); ?>

                                                            </span>

                                                        </span>

                                                    </span><!-- END // post-header -->

                                                <?php } ?>

                                            </a>

                                        </div>

                                    <?php } ?>

                                </article><!-- END // post -->

                            <?php
                            $callout_count++;
                        } // while
                    } // if
                    wp_reset_query();
                ?>

            </div><!-- END // grid-callout-home -->

        <?php gp_end('div', array('canvas', 'canvas-dark')); ?>

    <?php } ?>


    <?php if (get_posts('post_type=event') && gp_option('gp_event_homepage') != 'false') { ?>

        <?php gp_start('div', array('canvas', 'border-bottom')); ?>

        <?php
        if (wp_count_posts('event')->publish == 1) {
            $event_number = 1;
        } else if (wp_count_posts('event')->publish == 2) {
            $event_number = 2;
        } else if (wp_count_posts('event')->publish == 3) {
            $event_number = 3;
        // } else if (wp_count_posts('event')->publish == 4) {
            // $event_number = 4;
        } else if (wp_count_posts('event')->publish > 3) {
            $event_number = 3;
        } else {
            $event_number = 3;
        }

        // Title
        if (gp_option('gp_event_homepage_title')) {
            $event_title = __(gp_option('gp_event_homepage_title'));
        } else {
            $event_title = __('Upcoming events', 'gp');
        }
        ?>

        <?php if (gp_option('gp_event_homepage_title_show') != 'false') { ?>

            <h2 class="title-home title">
                <?php echo $event_title; ?>
            </h2>

        <?php } ?>

        <div class="grid-post-home grid-event-home grid-event-upcoming grid-event posts-no-4">
			<?php $slide_image_helper	= get_template_directory_uri() . '/images/downsb.png';?>
			
			<article class="event type-event status-publish hentry event-upcoming post event-download">


			<div class="post-content">
				<img src="<?php echo $slide_image_helper;?>"></img>

			<div class="post-footer">
			<div class="post-buy button">
			<a href="http://cff.com/?event=aarons-tribute-rock-fest" target="_blank">
			READ MORE
			</a>
			</div>
			</div>

			</div><!-- END // post-content -->

			</article>
        <?php
        global $post;

		
        // Counter
        $event_count = 0;

        // Current Date
        $current_date = date('Y/m/d', current_time('timestamp'));

        // Query
        $gp_query_args = array(
            'post_type'             => 'event',
            'meta_key'              => 'gp_event_date',
            'meta_value'            => 'gp_event_date_end',
            'meta_compare'		    => '<',
            'meta_query'            => array(
                'relation'              => 'AND',
                array(
                    'key'               => 'gp_event_date',
                    'value'             => 'gp_event_date_end',
                    'compare'           => '<='
                ),
                array(
                    'key'               => 'gp_event_date_end',
                    'value'             => $current_date,
                    'compare'           => '>='
                )
            ),
            'order'				    => 'ASC',
            'orderby'               => 'meta_value',
            'ignore_sticky_posts'   => 1,
            'paged'                 => $paged,
            'posts_per_page'        => $event_number
        );

        query_posts($gp_query_args);

        // Loop
        if (have_posts()) {
            while (have_posts()) {
                the_post();

                $event_time					= __(gp_meta('gp_event_time'));
                $event_venue				= __(gp_meta('gp_event_venue'));
                $event_venue_url			= __(gp_meta('gp_event_location_url'));
                $event_location				= __(gp_meta('gp_event_location'));
                $event_status				= __(gp_meta('gp_event_status'));
                $event_buy_text_1			= __(gp_meta('gp_event_buy_text_1'));
                $event_buy_url_1			= __(gp_meta('gp_event_buy_url_1'));
                $event_buy_text_2			= __(gp_meta('gp_event_buy_text_2'));
                $event_buy_url_2			= __(gp_meta('gp_event_buy_url_2'));

                $original_image_url 		= wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');

                // Thumbnail Size
                if (gp_option('gp_event_homepage_thumbnail_crop') == 'false') {
                    $thumbnail_size = 'small';
                } else {
                    $thumbnail_size = 'small-fixed';
                }

                $post_class = array('event-upcoming', 'post', 'post-' . ($event_count+1));
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

                    <?php
                    if (gp_option('gp_event_thumbnail') != 'false') {
                        if (has_post_thumbnail()) {
                            ?>

                            <div class="post-image transition overlay">

                                <?php if (gp_option('gp_event_single') != 'false') { ?>

                                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail($thumbnail_size); ?>
                                        <span class="overlay-block"><span class="overlay-icon"></span></span>
                                    </a>

                                <?php } else if (gp_option('gp_event_single') == 'false' || gp_option('gp_event_single') == '' && has_post_thumbnail()) { ?>

                                    <span class="lightbox">
                                        <a href="<?php echo $original_image_url[0]; ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail($thumbnail_size); ?>
                                            <span class="overlay-block"><span class="overlay-icon"></span></span>
                                        </a>
                                    </span>

                                <?php } else { ?>

                                    <?php the_post_thumbnail($thumbnail_size); ?>
                                    <span class="overlay-block"><span class="overlay-icon"></span></span>

                                <?php } ?>

                            </div><!-- END // post-image -->

                        <?php
                        }
                    }
                    ?>

                    <div class="post-content">

                        <h3 class="post-date">

                            <?php get_template_part('date', 'event'); ?>

                                <small class="post-time">
                                    <?php echo $event_time ? $event_time : ''; ?>
                                </small><!-- END // post-time -->

                        </h3><!-- END // post-date -->

                        <h2 class="post-header">

                            <?php if (gp_option('gp_event_single') != 'false') { ?>

                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>

                            <?php } else { ?>

                                <?php the_title(); ?>

                            <?php } ?>

                        </h2><!-- END // post-header -->

                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div><!-- END // post-excerpt -->


                        <?php if (!empty($event_buy_text_1) && !empty($event_buy_url_1) || !empty($event_buy_text_2) && !empty($event_buy_url_2)) { ?>

                            <div class="post-footer">

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

                            </div><!-- END // post-footer -->

                        <?php } ?>
						 <div class="post-footer">
                        <div class="post-buy button">
                            <a href="<?php echo the_permalink(); ?>" target="_blank">
                               READ MORE
                            </a>
                        </div>
					</div>
						
                    </div><!-- END // post-content -->

                </article>

                <?php
                $event_count++;
            } // while
        } // if
        wp_reset_query();
        ?>

        </div><!-- END // grid-event-home -->
		
        <?php gp_end('div', array('canvas', 'border-bottom')); ?>

    <?php } ?>

<div class="ads ad-home-footer">
	<?php dynamic_sidebar('widget-ad-home-footer'); ?> 
</div>  

<?php
get_footer();