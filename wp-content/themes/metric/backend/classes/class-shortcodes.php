<?php

/*

@name			Shortcodes Classes
@package		GPanel WordPress Framework
@since			3.1.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Class Album Shortcode
====================================================================================================
*/

class gp_Album_Shortcode {

	static function init() {
		
		add_shortcode('album', array(__CLASS__, 'gp_shortcode_album'));
		
	}

	static function gp_shortcode_album($atts) {
		
		ob_start();
		
		extract(
            shortcode_atts(
                array(
                    'id'		    => '',
                    'player'        => 'yes',
                    'image'		    => 'yes',
                    'info'		    => 'yes'
                ), 
                $atts
            )
        );

        $files = get_post_meta($id, 'gp_album_songs', false);

        $post_thumbnail_id = get_post_thumbnail_id($id);
        $original_image_url = wp_get_attachment_image_src($post_thumbnail_id, 'full');
        
        $album_artist = __(get_post_meta($id, 'gp_album_artist', true));
        $album_release_date = get_post_meta($id, 'gp_album_release_date', true);

        if ($files != NULL) {
        ?>

            <div class="shortcode-album clearfix">
                
                <?php if ($image != 'no' || $info != 'no') { ?>
                    
                    <div class="one-third">
                        
                        <?php if ($image != 'no') { ?>
                        
                            <div class="post-image overlay">
                                                    
                                <a data-gallery="gallery-album" href="<?php echo get_permalink($id); ?>">
                                    <?php echo get_the_post_thumbnail($id, 'large'); ?>
                                    <span class="overlay-block"><span class="overlay-icon"></span></span>
                                </a>
                                
                            </div><!-- END // post-image -->
                        
                        <?php } ?>
                        
                        <?php if ($info != 'no') { ?>
                        
                            <h2 class="post-header entry-title">
                                <a class="underline" href="<?php echo get_permalink($id); ?>" rel="bookmark">
                                    <?php echo get_the_title($id); ?>
                                </a>
                            </h2><!-- END // post-header -->
                            
                            <?php if (!empty($album_artist)) { ?>
                                            
                                <div class="post-artist">
                                    <?php echo $album_artist; ?>
                                </div>
                            
                            <?php } ?>
                            
                            <?php if (!empty($album_release_date)) { ?>
                            
                                <div class="post-meta">
                                    <?php
                                        if (function_exists('gp_album_release_date')) {
                                            gp_album_release_date($album_release_date);
                                        }
                                    ?>
                                </div><!-- END // post-meta -->
                            
                            <?php } ?>
                        
                        <?php } ?>
                        
                    </div>
                    
                <?php } ?>
                
                <?php if ($player != 'no') { ?>
                
                    <?php if ($image != 'no' || $info != 'no') { ?>
                
                    <div class="two-third">
                                                            
                    <?php } ?>
                                                            
                        <div class="shortcode-player-<?php echo $id; ?> player-<?php echo $id; ?>"></div>
                        
                        <div class="shortcode-player player clearfix">
            
                            <div class="shortcode-player-container-<?php echo $id; ?> player-container-<?php echo $id; ?> shortcode-player-container player-container clearfix">
            
                                <div class="player-progress">
                                    <div class="player-seek-bar">
                                        <div class="player-play-bar"></div>
                                    </div>
                                </div><!-- END // player-progress -->
                                
                                <div class="player-controls shortcode-player-controls">
            
                                    <ul>
                                        <li><a href="javascript:;" class="player-play" tabindex="1">Play</a></li>
                                        <li><a href="javascript:;" class="player-pause" tabindex="1">Pause</a></li>
                                        <li><a href="javascript:;" class="player-stop" tabindex="1">Stop</a></li>
                                        <li><a href="javascript:;" class="player-mute" tabindex="1">Mute</a></li>
                                        <li><a href="javascript:;" class="player-unmute" tabindex="1">Unmute</a></li>
                                    </ul><!-- END // player-controls -->
                                    
                                    <div class="player-time">
                                        <span class="player-current-time"></span> / <span class="player-duration"></span>
                                    </div><!-- END // player-time -->
                                    
                                    <div class="player-volume">
                                        <div class="player-volume-container">
                                            <div class="player-volume-value"></div>
                                        </div>
                                    </div><!-- END // player-colume -->
                                    
                                </div><!-- END // player-bar -->
                                
                                <div class="jp-playlist player-playlist">
                                    <ul>
                                        <li></li>
                                    </ul>
                                </div><!-- END // player-playlist -->
                                
                            </div><!-- END // player-container -->
                                
                        </div><!-- END // player -->
                    
                    <?php if ($image != 'no' || $info != 'no') { ?>
                    
                    </div><!-- END // two-third -->
                
                    <?php } ?>
                    
                <?php } ?>
                
            </div><!-- END // shortcode-album -->

			<script type="text/javascript">

				//<![CDATA[

				jQuery(document).ready(function() {
					"use strict";

					var playList =  new jPlayerPlaylist({
						jPlayer: '.shortcode-player-<?php echo $id; ?>',
						cssSelectorAncestor: '.shortcode-player-container-<?php echo $id; ?>'
					}, [
						<?php
							$file_count = 1;
							foreach ($files as $file) {

								?>
						{
							title: '<?php echo get_the_title($file); ?>',
							mp3: '<?php echo wp_get_attachment_url($file); ?>'
						}<?php if ($file_count != sizeof($files)) { ?>,<?php } ?>
						<?php
						$file_count++;
					}
				?>
					], {
						swfPath: '<?php echo get_template_directory_uri(); ?>/javascripts',
						supplied: 'mp3',
						solution: 'html, flash',
						volume: 0.8,
						cssSelector: {
							play: '.player-play',
							pause: '.player-pause',
							stop: '.player-stop',
							mute: '.player-mute',
							unmute: '.player-unmute',
							seekBar: '.player-seek-bar',
							playBar: '.player-play-bar',
							volumeBar: '.player-volume',
							volumeBarValue: '.player-volume-value',
							currentTime: '.player-current-time',
							duration: '.player-duration'
						}
					});

				});

				//]]>

			</script>
                
        <?php
        }
        
        $result = ob_get_contents();
        
        ob_end_clean();
        
        return $result;

	}

}

gp_Album_Shortcode::init();

/*
====================================================================================================
Class Audio Shortcode
====================================================================================================
*/

class gp_Audio_Shortcode {

	static function init() {
		
		add_shortcode('audio', array(__CLASS__, 'gp_shortcode_audio'));
		
	}

	static function gp_shortcode_audio($atts) {
		
		ob_start();

		extract(
            shortcode_atts(
                array(
                    'mp3'		    => ''
                ), 
                $atts
            )
        );
        
        $id = uniqid();

        if (!empty($mp3)) {
        ?>

            <div class="shortcode-audio clearfix">
                     
                <div class="shortcode-player-<?php echo $id; ?> player-<?php echo $id; ?>"></div>
                
                <div class="shortcode-player player clearfix">
    
                    <div class="shortcode-player-container-<?php echo $id; ?> player-container-<?php echo $id; ?> shortcode-player-container player-container clearfix">
    
                        <div class="player-progress">
                            <div class="player-seek-bar">
                                <div class="player-play-bar"></div>
                            </div>
                        </div><!-- END // player-progress -->
                        
                        <div class="player-controls shortcode-player-controls">
    
                            <ul>
                                <li><a href="javascript:;" class="player-play" tabindex="1">Play</a></li>
                                <li><a href="javascript:;" class="player-pause" tabindex="1">Pause</a></li>
                                <li><a href="javascript:;" class="player-stop" tabindex="1">Stop</a></li>
                                <li><a href="javascript:;" class="player-mute" tabindex="1">Mute</a></li>
                                <li><a href="javascript:;" class="player-unmute" tabindex="1">Unmute</a></li>
                            </ul><!-- END // player-controls -->

                            <div class="player-time">
                                <span class="player-current-time"></span> / <span class="player-duration"></span>
                            </div><!-- END // player-time -->
                            
                            <div class="player-volume">
                                <div class="player-volume-container">
                                    <div class="player-volume-value"></div>
                                </div>
                            </div><!-- END // player-colume -->
                            
                        </div><!-- END // player-bar -->
                        
                    </div><!-- END // player-container -->
                        
                </div><!-- END // player -->
                
            </div><!-- END // shortcode-album -->

			<script type="text/javascript">

				//<![CDATA[

				jQuery(document).ready(function() {
					"use strict";

					jQuery('.shortcode-player-<?php echo $id; ?>').jPlayer({
						ready: function () {
							jQuery(this).jPlayer('setMedia', {
								mp3: '<?php echo $mp3; ?>'
							});
						},
						play: function() {
							jQuery(this).jPlayer('pauseOthers');
						},
						swfPath: '<?php echo get_template_directory_uri(); ?>/javascripts',
						supplied: 'mp3',
						solution: 'html, flash',
						volume: 0.8,
						cssSelectorAncestor: '.player-container-<?php echo $id; ?>',
						cssSelector: {
							play: '.player-play',
							pause: '.player-pause',
							stop: '.player-stop',
							mute: '.player-mute',
							unmute: '.player-unmute',
							seekBar: '.player-seek-bar',
							playBar: '.player-play-bar',
							volumeBar: '.player-volume',
							volumeBarValue: '.player-volume-value',
							currentTime: '.player-current-time',
							duration: '.player-duration'
						}
					});

				});

				//]]>

			</script>
                
        <?php
        }
        
        $result = ob_get_contents();
        
        ob_end_clean();
        
        return $result;

	}

}

gp_Audio_Shortcode::init();