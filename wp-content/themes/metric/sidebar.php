<?php

/*

@name			    Page Sidebar Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar Class
if (gp_option('gp_page_sidebar')) {
    $sidebar = gp_option('gp_page_sidebar');
} else {
    $sidebar = 'left';
}

?>

<div class="sidebar-page sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">

    <?php dynamic_sidebar('widget-area-page'); ?>
    
</div><!-- END // sidebar -->