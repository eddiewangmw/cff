<?php

/*

@name			    Contact Sidebar Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar Class
if (gp_option('gp_contact_sidebar')) {
    $sidebar = gp_option('gp_contact_sidebar');
} else {
    $sidebar = 'left';
}

?>

<div class="sidebar-contact sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">

    <?php dynamic_sidebar('widget-area-contact'); ?>
    
</div><!-- END // sidebar -->