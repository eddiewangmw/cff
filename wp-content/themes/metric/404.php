<?php

/*

@name			    404 Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/ 

get_header();
?>

	<?php gp_start('header', 'title'); ?>
    
        <h1>
            <?php _e('Page not Found', 'gp'); ?>
        </h1>
        
    <?php gp_end('header', 'title'); ?>
    
	<?php gp_start('div', 'canvas'); ?>
		
        <div class="content" role="main">
                            
			<?php 
                $blog_title = get_bloginfo('name'); 
                $blog_url = home_url();
            ?>
            
            <h2><?php _e('Sorry, this page was not found.', 'gp'); ?></h2>
            
            <p><?php printf(__('You can try to return to the <a title="%1$s homepage" href="%2$s">%1$s homepage</a> and start fresh.', 'gp'), $blog_title, $blog_url); ?></p>
            
		</div><!-- END // content -->
        
	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();