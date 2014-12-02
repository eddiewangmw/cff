<?php

/*

@name			    Event Sidebar Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar Class
if (gp_option('gp_event_sidebar')) {
    $sidebar = gp_option('gp_event_sidebar');
} else {
    $sidebar = 'left';
}

?>

<div class="sidebar-contact sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">

    <?php gp_categories('category-event'); ?>

    <?php dynamic_sidebar('widget-area-event'); ?>
    
</div><!-- END // sidebar -->