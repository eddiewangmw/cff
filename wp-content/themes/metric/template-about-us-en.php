<?php

/*

Template Name:	    About us EN

@name			    About uz EN
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

get_header();

?>

	<div class="sidebar-page sidebar-left sidebar">
		<h3 class="widget-title"><?php echo pll__('About Us');?></h3>
		<?php dynamic_sidebar('widget-about-us-sidebar-en'); ?> 
	</div>
	<div class="content-page content-sidebar content-sidebar-left">
        <div class="content" role="main">

            <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        
                        if (!empty($post->post_content)) {
                        ?>

                            <div class="page-content">

                                <?php the_content(); ?>

                            </div><!-- END // page-content -->

                        <?php 
                        }
                    } //while
                } //if
                wp_reset_query();
            ?>

        </div><!-- END // content -->
	</div>
        

<?php
get_footer();