<?php

/*

Template Name:	    About us

@name			    About uz
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

get_header();

?>
	<!-- start left side -->
	<div class="sidebar-page sidebar-left sidebar">
		<h3 class="widget-title"><?php echo pll__('About Us');?></h3>
		<?php if(get_bloginfo('language') == 'en-AU'):?>
					<?php dynamic_sidebar('widget-about-us-sidebar-en'); ?> 
		<?php else:?>
					<?php dynamic_sidebar('widget-about-us-sidebar-zh'); ?> 
		<?php endif;?>

	</div>
	<!-- End left side-->
	<div class="content-page content-sidebar content-sidebar-left">
	<?php  get_template_part('content', 'slider');?>
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
								<div id="next_page"></div>
                            </div>

                        <?php 
                        }
                    } //while
                } //if
                wp_reset_query();
            ?>
	<!-- END // page-content -->
	<?php  get_template_part('content', 'ads');?>
	</div>
    <!-- END // right side -->

<?php
get_footer();