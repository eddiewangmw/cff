<?php

/*

@name			    Album Sidebar Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar Class
if (gp_option('gp_album_sidebar')) {
    $sidebar = gp_option('gp_album_sidebar');
} else {
    $sidebar = 'left';
}

?>

<div class="sidebar-video sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">
    
    <?php gp_categories('category-album'); ?>
    
    <?php dynamic_sidebar('widget-area-album'); ?>
    
</div><!-- END // sidebar -->