<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" />

	<?php gp_meta_head(); ?>

	<link rel="dns-prefetch" href="http://ajax.googleapis.com" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if (gp_option('gp_feedburner') != '') { echo gp_option('gp_feedburner'); } else { bloginfo('rss2_url'); } ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <title><?php wp_title(''); ?></title>

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
	<?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>

    <div class="body-background"></div>
	<div class="container">
    <?php
        if (gp_option('gp_search') != 'false') {
        ?>
            
            <div class="modal-search display-none">
                <div class="modal-search-inner">
                    <div class="modal-search-input">
                        <?php get_search_form(); ?>
                    </div>
                </div>

                <a href="javascript:;" title="<?php _e('Close', 'gp'); ?>" class="modal-search-close"></a>
            </div><!-- END // modal-search -->
            
        <?php
        }
	?>
    
    <?php
        // if (gp_option('gp_toolbar_header') != 'false') {
 //            gp_start('div', array('toolbar', 'toolbar-header'));
 //                get_template_part('toolbar', 'header');
 //            gp_end('div', array('toolbar', 'toolbar-header'));
 //        }
    ?>
    
    <div class="header">
    
        <div class="header-container">
                    
			<div class="logo logo-image float-left">

			<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
			    <img src="<?php echo gp_option('gp_image_logo'); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
			</a>

			</div><!-- END // logo-image -->
                
            <div class="float-right">
	            <div class="switchlang"><?php dynamic_sidebar('widget-area-subscription'); ?></div>
	            <nav id="navigation" class="navigation" role="navigation">
                
	                <div class="navigation-mobile-button"></div><!-- END // navigation-mobile-button -->
	                <div class="navigation-mobile"></div><!-- END // navigation-mobile -->
            
	                <?php gp_navigation(); ?>
                
	            </nav><!-- END // navigation -->
			</div>
        
        </div><!-- END // header-container -->
    
    </div><!-- END // header -->