<?php

/*

@name			    Movie Sidebar Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/
?>

<div class="sidebar-contact sidebar-left sidebar" role="complementary">
		<?php if(get_bloginfo('language') == 'en-AU'):?>
					<?php dynamic_sidebar('widget-movie-sidebar-en'); ?> 
		<?php else:?>
					<?php dynamic_sidebar('widget-movie-sidebar-zh'); ?> 
		<?php endif;?>
    <?php dynamic_sidebar('widget-area-movie'); ?>
    
</div><!-- END // sidebar -->