<?php

/*

Template Name:	    About us ZH

@name			    About uz ZH
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

get_header();

?>
	<!-- start left side -->
	<div class="sidebar-page sidebar-left sidebar">
		<h3 class="widget-title"><?php echo pll__('About Us');?></h3>
		<?php dynamic_sidebar('widget-about-us-sidebar-zh'); ?> 
	</div>
	<!-- End left side-->
	<!-- Start right side-->
	<div class="content-page content-sidebar content-sidebar-left">
		<!-- start slideshow -->
	<?php 
	global $post;
	// Query
	$gp_query_args = array(
		'post_type'              => 'slide',
		'posts_per_page'         => -1,
		'meta_key'    => 'gp_slide_page',
		'meta_query' => array(array('key' => 'gp_slide_page','value'=>get_the_ID()))
	);

	query_posts($gp_query_args);
	
	if (have_posts()) { ?>

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
								

								// Counter
								$slide_count = 1;
								

								// Loop
								// if (have_posts()) {
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
								// } //if
								// wp_reset_query();
							?>

						</ul>

					</div><!-- END // slider-container -->

				</div><!-- END // slider -->

			</div><!-- END // slideshow-container -->

		</div>

	<?php } ?>
	<!-- END // slideshow -->
	<!-- Start // page content -->
            <?php
			wp_reset_query();
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        
                        if (!empty($post->post_content)) {
                        ?>

                            <div class="page-content">

                                <?php the_content(); ?>

                            </div>

                        <?php 
                        }
                    } //while
                } //if
                wp_reset_query();
            ?>
	<!-- END // page-content -->
	<div class="ads ad-home-top">
		<?php dynamic_sidebar('widget-ad-normal-top-footer'); ?> 
	</div>
	<div class="ads ad-normal-footer">
		<?php dynamic_sidebar('widget-ad-normal-footer'); ?> 
	</div>
	</div>
    <!-- END // right side -->

<?php
get_footer();