<?php

/*

@name			    Styles
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/ 

/*
====================================================================================================
Frontend Styles
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Frontend Output Styles from WordPress Customizer
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_styles_generate')) {

    function gp_frontend_styles_generate() {
        
        /*
        ----------------------------------------------------------------------------------------------------
        Typo
        ----------------------------------------------------------------------------------------------------
        */
        
        // Google Font Face
        if (gp_option('gp_font_face') != '') {
            $font_face = gp_option('gp_font_face');
        } else {
            $font_face = 'Oswald';
        }
        
        // Text Transform
        if (gp_option('gp_text_transform') == 'none') {
            $text_transform = 'none';
        } else {
            $text_transform = 'uppercase';
        }
        
        /*
        ----------------------------------------------------------------------------------------------------
        Colors
        ----------------------------------------------------------------------------------------------------
        */
        
        // Color Background Light
        if (get_theme_mod('gp_color_background_light')) { $color_background_light = get_theme_mod('gp_color_background_light'); } else { $color_background_light = '#ffffff'; }
        $color_background_light_rgb = gp_hex_to_rgb($color_background_light);
        
        // Color Background Dark
        if (get_theme_mod('gp_color_background_dark')) { $color_background_dark = get_theme_mod('gp_color_background_dark'); } else { $color_background_dark = '#0a0f14'; }
        $color_background_dark_rgb = gp_hex_to_rgb($color_background_dark);
        
        // Color Text Light
        if (get_theme_mod('gp_color_text_light')) { $color_text_light = get_theme_mod('gp_color_text_light'); } else { $color_text_light = '#c99a07'; }
        $color_text_light_rgb = gp_hex_to_rgb($color_text_light);
        
        // Color Text Dark
        if (get_theme_mod('gp_color_text_dark')) { $color_text_dark = get_theme_mod('gp_color_text_dark'); } else { $color_text_dark = '#474b4f'; }
        $color_text_dark_rgb = gp_hex_to_rgb($color_text_dark);
        
        // Color Primary
        if (get_theme_mod('gp_color_primary')) { $color_primary = get_theme_mod('gp_color_primary'); } else { $color_primary = '#ffffff'; }
        $color_primary_rgb = gp_hex_to_rgb($color_primary);
        
        // Color Secondary
        if (get_theme_mod('gp_color_secondary')) { $color_secondary = get_theme_mod('gp_color_secondary'); } else { $color_secondary = '#e50b18'; }
        // $color_secondary_rgb = gp_hex_to_rgb($color_secondary);
        $color_secondary_rgb = "#6e5504";
        
        /*
        ----------------------------------------------------------------------------------------------------
        Images
        ----------------------------------------------------------------------------------------------------
        */
        
        // Retina Logo
		if (gp_option('gp_image_logo_2x') != '') {
			$image_logo_2x = gp_option('gp_image_logo_2x');
        }

        ?>
    
        <style type="text/css">

        /* Typography */
        h1, h2, h3, h4, h5, h6 { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; text-transform: <?php echo $text_transform; ?>; }
        blockquote { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        
        /* Typography > Forms */
        label { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; text-transform: <?php echo $text_transform; ?>; }
        button, a.button, .button a, #submit, #comment-submit, input[type="submit"], button[type="submit"] { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; text-transform: <?php echo $text_transform; ?>; }
        button:hover, a.button:hover, .button a:hover, #submit:hover, #comment-submit:hover, input[type="submit"]:hover, button[type="submit"]:hover { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        
        /* Typography > Search */
        input.input-search[type="text"] { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        
        /* Typography > Navigation */
        .navigation,
        .navigation-mobile,
        .navigation-categories { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; text-transform: <?php echo $text_transform; ?>; }

        /* Typography > Slideshow */
        .slide-caption h2 { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; text-transform: <?php echo $text_transform; ?>; }
        
        /* Typography > Widgets */
        .widget_recent_tweet .tweet_text, .widget_pages li a, .widget_subpages li a, .widget_nav_menu li a, .widget_archive li a, .widget_categories li a, .widget_archive li li a, .widget_categories li li a { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; text-transform: <?php echo $text_transform; ?>; }
        .wa-footer-full .widget_recent_tweet .tweet-text { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; text-transform: <?php echo $text_transform; ?>; }
        
        /* Typography > Pagination */
        .pagination { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; text-transform: <?php echo $text_transform; ?>; }
        
        /* Typography > Callouts */
        .grid-callout-home .post .post-title-container { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; text-transform: <?php echo $text_transform; ?>; color:#ffffff;}
        
		<?php if (!empty($image_logo_2x)) { ?>
		/* Retina Logo */
		@media
        only screen and (-webkit-min-device-pixel-ratio: 2),
        only screen and (-o-min-device-pixel-ratio: 2/1),
        only screen and (min--moz-device-pixel-ratio: 2),
        only screen and (min-device-pixel-ratio: 2),
        only screen and (min-resolution: 192dpi),
        only screen and (min-resolution: 2dppx) {
            
            .header .logo-image {
                background-image: url("<?php echo $image_logo_2x; ?>");
                background-position: center center;
                background-repeat: no-repeat;
                -webkit-background-size: contain;
                -moz-background-size: contain;
                -o-background-size: contain;
                background-size: contain;
            }
            .header .logo-image img { visibility: hidden; }
            
        }
        <?php } ?>
        
        /* CSS Common > Selection */
        ::selection { background: <?php echo $color_secondary; ?>; }
        ::-moz-selection { background: <?php echo $color_secondary; ?>; }
        
        /* CSS Common > Links */
        a { color: <?php echo $color_secondary; ?>; }
        a:hover { color: #e50b18; }
        a.underline, .underline a { color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_secondary; ?>; }
        a.underline:hover, .underline a:hover { color: <?php echo $color_primary; ?>; border-color: <?php echo $color_primary; ?>; }
        
        /* Body */
        body { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_background_dark; ?>; }
        
        /* Typography */
        blockquote { color: <?php echo $color_primary; ?>; }
        blockquote cite { color: <?php echo $color_text_dark; ?>; }
        
        /* Forms */
        button, .button a, #submit, #comment-submit, input[type="submit"] { color: #fff !important; background-color: <?php echo $color_primary; ?>; border-color: <?php echo $color_text_light; ?>; }
        button:hover, .button a:hover, #submit:hover, #comment-submit:hover, input[type="submit"]:hover { background-color: rgb(138, 20, 20) !important; border-color: <?php echo $color_secondary; ?>; }
        
        /* Comments */
        .comments .comment-body { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_background_dark; ?>; }
        .comments .comment-body:before { border-top-color: <?php echo $color_background_dark; ?>; }
        .comments .comment-body .alert { color: <?php echo $color_primary; ?>; border-color: <?php echo $color_primary; ?>; }
        
        .comments .bypostauthor .comment-body { background-color: <?php echo $color_secondary; ?>; }
        .comments .bypostauthor .comment-body:before { border-top-color: <?php echo $color_secondary; ?>; }
        .comments .bypostauthor .comment-body h5  { color: <?php echo $color_text_light; ?>; }
        .comments .bypostauthor .comment-body a { color: <?php echo $color_text_light; ?>; }
        .comments .bypostauthor .comment-body a:hover { color: <?php echo $color_primary; ?>; }
        
        .comments .comment-content .comment-reply a { color: <?php echo $color_text_light; ?> !important; border-color: <?php echo $color_text_light; ?>; }
        .comments .comment-content .comment-reply a:hover { color: <?php echo $color_primary; ?> !important; border-color: <?php echo $color_primary; ?>; }
        
        .comments #cancel-comment-reply-link { color: <?php echo $color_secondary; ?>; }
        .comments #cancel-comment-reply-link:hover { color: <?php echo $color_primary; ?>; }
        .comments #reply-title { color: <?php echo $color_primary; ?>; }
        
        /* Toolbar > qTranslate Language Switcher */
        .toolbar .qtrans_language_chooser li a:hover { background-color: <?php echo $color_primary; ?>; }

        /* Toolbar > Search - Modal */
        .modal-search-button a:hover { background-color: <?php echo $color_secondary; ?>; }
        .modal-search-close { background-color: <?php echo $color_secondary; ?>; }
        .modal-search-close:hover { background-color: <?php echo $color_primary; ?>; }
        
        /* Navigation */
        .navigation-primary li,
        .navigation-primary li a { color: <?php echo $color_text_light; ?>; }
        .navigation-primary li:hover a,
        .navigation-primary li a:hover { color: <?php echo $color_primary; ?>; }
        .navigation-primary li.current-menu-item a,
        .navigation-primary li.current_page_item a { color: <?php echo $color_text_light; ?>; border-color: <?php echo $color_text_light; ?>; }
        .navigation-primary li.current-menu-item a:hover,
        .navigation-primary li.current_page_item a:hover,
        .navigation-primary li.current-menu-item:hover a,
        .navigation-primary li.current_page_item:hover a { color: <?php echo $color_primary; ?>; border-color: <?php echo $color_primary; ?>; }

        .navigation-primary li .sub-menu:before,
        .navigation-primary li .children:before { border-color: <?php echo $color_background_light; ?>; }
        
        .navigation-primary li li,
        .navigation-primary li li a { color: <?php echo $color_text_dark; ?> !important; background-color: <?php echo $color_background_light; ?>; }
        .navigation-primary li li a:hover { color: <?php echo $color_secondary; ?> !important; }
        
        /* Navigation - Mobile */
        .navigation-primary-mobile:before { border-color: <?php echo $color_background_light; ?>; }
        
        .navigation-primary-mobile li,
        .navigation-primary-mobile li a { color: <?php echo $color_text_dark; ?> !important; background-color: <?php echo $color_background_light; ?>; }
        .navigation-primary-mobile li a:hover { color: <?php echo $color_secondary; ?> !important; }
        
        /* Navigation - Categories */
        .navigation-categories ul li a { color: <?php echo $color_text_dark; ?>; border-color: rgba(<?php echo $color_background_dark_rgb; ?>,0.15); }
        .navigation-categories ul li a:hover { color: <?php echo $color_primary; ?>; }
        .navigation-categories ul li.current-cat a { color: <?php echo $color_secondary; ?>; }
        .navigation-categories ul li.current-cat a:hover { color: <?php echo $color_primary; ?>; }
        
        .navigation-categories ul li ul li a { color: <?php echo $color_secondary; ?>; } 
        .navigation-categories ul li ul li a:hover { color: <?php echo $color_primary; ?>; }
        .navigation-categories ul li ul li.current-cat a { color: <?php echo $color_text_light; ?>; } 
        .navigation-categories ul li ul li.current-cat ul li a { color: <?php echo $color_secondary; ?>; } 
        .navigation-categories ul li ul li.current-cat ul li a:hover { color: <?php echo $color_text_light; ?>; } 
        
        /* Canvas */
        .canvas { /*color: <?php //echo $color_text_dark; ?>;*/ background-color: <?php echo $color_background_light; ?>; }
        .canvas-dark { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_background_dark; ?>; }
        .canvas a { color: <?php echo $color_secondary; ?>; }
        .canvas a:hover { color: <?php echo $color_primary; ?>; }
        
        /* Content */
        .page-content h1, .single-content h1,
        .page-content h2, .single-content h2,
        .page-content h3, .single-content h3,
        .page-content h4, .single-content h4,
        .page-content h5, .single-content h5,
        .page-content h6, .single-content h6 { color: <?php echo $color_secondary; ?>; }
        
        /* Slideshow */
        .slide.without-image { background-color: rgba(<?php echo $color_background_light_rgb; ?>,0.05); }
        .slide-caption .slide-title,
        .slide-caption .slide-title a { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?> !important; }
        .slide-caption .slide-description { color:#ffffff;background-color: <?php echo $color_secondary; ?>; }
        
        .tp-bullets.tp-thumbs { background-color: <?php echo $color_background_dark; ?>; }
        
        /* Posts > Common */
        .post-header a { color: <?php echo $color_secondary; ?>; }
        .post-header a:hover { color: <?php echo $color_primary; ?>; border-color: <?php echo $color_primary; ?>; }
        
        .post-comments .icon-comment  { background-color: <?php echo $color_secondary; ?>; }
        .post-comments .icon-comment:after { border-color: <?php echo $color_secondary; ?>; }
        .post-comments a:hover .icon-comment { background-color: <?php echo $color_primary; ?>; }
        .post-comments a:hover .icon-comment:after { border-color: <?php echo $color_primary; ?>; }
        
        .post-share li a { background-color: <?php echo $color_primary; ?>; }
        .post-share li a:hover { background-color: <?php echo $color_secondary; ?>; }
        .post-buy.button a { color: #fff; background-color: red; }
        .post-buy.button a:hover { background-color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_text_light; ?>; }
        
        /* Posts > Callouts */
        .grid-callout-home .post-title,
        .grid-callout-home .post-title a { color: <?php echo $color_text_light; ?>; }
        
        /* Posts > Event Grid */
        .grid-event-upcoming .post-status { color: <?php echo $color_secondary; ?>; }
        
        /* Posts > Archive Grid */
        .grid-archives a { color: <?php echo $color_secondary; ?>; }
        .grid-archives a:hover { color: <?php echo $color_primary; ?>; }
        
        /* Posts > Search Grid */
        .grid-search .post-header a { color: <?php echo $color_text_dark; ?>; border-color: <?php echo $color_text_dark; ?>; }
        .grid-search .highlight-title,
        .grid-search .highlight-excerpt { border-color: <?php echo $color_primary; ?>; }
        
        /* Singles > Single Event */
        .single-event .single-post-date h3 { color: <?php echo $color_secondary; ?>; }
        
        /* Pagination */
        .pagination a,
        .pagination-post a { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_secondary; ?>; }
        .pagination a:hover,
        .pagination-post a:hover,
        .pagination span.current { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }
        
        /* Widget Archive, Categories [WordPress] */
        .widget_archive li,
        .widget_categories li { border-color: rgba(<?php echo $color_background_dark_rgb; ?>,0.15); }
        .widget_archive li a,
        .widget_categories li a { color: <?php echo $color_secondary; ?>; }
        
        /* Widget Tag Cloud & Tags [WordPress] */
        .post-tags a,
        .widget_tag_cloud a { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }
        .post-tags a:hover,
        .widget_tag_cloud a:hover { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_secondary; ?>; }
        
        /* Widget Links [WordPress] */
        .widget_links li a { color: <?php echo $color_primary; ?>; }
        .widget_links li a:hover { color: <?php echo $color_text_light; ?>; }
        
        /* Widget qTranslate [qTranslate] */
        .widget_qtranslate li a { background-color: <?php echo $color_primary; ?>; }
        .widget_qtranslate li a:hover { background-color: <?php echo $color_secondary; ?>; }

        /* Components > Slideshow */
        .gp-theme .rsPlayBtn .rsPlayBtnIcon { background-color: <?php echo $color_secondary; ?>; }
        .gp-theme .rsPlayBtn:hover .rsPlayBtnIcon { background-color: <?php echo $color_primary; ?>; }
        .gp-theme .rsCloseVideoIcn { background-color: <?php echo $color_secondary; ?>; }
        .gp-theme .rsCloseVideoIcn:hover { background-color: <?php echo $color_primary; ?>; }
        
        /* Components > Player */
        .player-progress { background-color: <?php echo $color_background_light; ?>; }
        .player-progress .player-seek-bar { background-color: <?php echo $color_background_dark; ?>; }
        .player-progress .player-play-bar { background-color: <?php echo $color_background_light; ?>; }
        .player-controls { background-color: <?php echo $color_background_dark; ?>; }
        .player-controls .player-volume-value { background-color: <?php echo $color_background_dark; ?>; }
        .player-controls .player-volume-container { background-color: <?php echo $color_background_light; ?>; }
        .player-controls .player-time { color: <?php echo $color_text_light; ?>; }
        
        .player-playlist ul li a { color: <?php echo $color_text_dark; ?>; background-color: rgba(<?php echo $color_background_dark_rgb; ?>,0.1); }
        .player-playlist ul li a:hover { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?> !important; }
        .player-playlist ul li.jp-playlist-current a { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_secondary; ?> !important; }
        
        /* Components > Lightbox */
        .lightbox-arrow-left,
        .lightbox-arrow-right { background-color: <?php echo $color_secondary; ?>; }
        .lightbox-arrow-left:hover,
        .lightbox-arrow-right:hover { background-color: <?php echo $color_primary; ?>; }
        .lightbox-close { background-color: <?php echo $color_secondary; ?>; }
        .lightbox-close:hover { background-color: <?php echo $color_primary; ?>; }
        .lightbox-title-container { background-color: <?php echo $color_secondary; ?>; }
        
        /* Components > Tabs */
        .ui-tabs .ui-tabs-nav li.ui-state-default a { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_background_light; ?>; }
        .ui-tabs .ui-tabs-nav li.ui-state-default a:hover { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }
        .ui-tabs .ui-tabs-nav li.ui-state-active a,
        .ui-tabs .ui-tabs-nav li.ui-state-active a:hover { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_text_dark; ?>; }
        .ui-tabs .ui-tabs-panel { border-color: <?php echo $color_text_dark; ?>; color: <?php echo $color_text_dark; ?>; }
        
        /* Components > Back to Top Button */
        .back-to-top { background-color: <?php echo $color_secondary; ?>; }
        .back-to-top:hover { background-color: <?php echo $color_primary; ?>; }

        /* reCaptcha */
        .input-captcha .rc-icon a { background-color: <?php echo $color_secondary; ?>; }
        .input-captcha .rc-icon a:hover { background-color: <?php echo $color_primary; ?>; }

        /* Components > Overlay */
        .overlay-back span.overlay-block { background-color: <?php echo $color_secondary_rgb; ?>; }

        <?php if (gp_option('gp_custom_css')) {	?>
        
        /* Custom CSS */
        <?php echo stripslashes(htmlspecialchars(gp_option('gp_custom_css'))); ?>
            
        <?php } ?>
        
        </style>
        
        <?php
        
    }
    
    add_action('wp_head', 'gp_frontend_styles_generate');

}

?>