<?php

/*

@name			    WooCommerce Sidebar Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar Class
if (gp_option('gp_shop_sidebar')) {
    $sidebar = gp_option('gp_shop_sidebar');
} else {
    $sidebar = 'left';
}

?>

<div class="sidebar-shop sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">

    <?php dynamic_sidebar('widget-area-shop'); ?>
    
</div><!-- END // sidebar -->