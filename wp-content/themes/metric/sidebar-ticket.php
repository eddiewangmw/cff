<?php

/*

@name			    Gallery Sidebar Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar Class

$sidebar = 'left';

?>

<div class="sidebar-gallery sidebar-<?php echo $sidebar; ?> sidebar" role="complementary">
    <h3 class="widget-title"><?php echo pll__('Ticket');?></h3>
    <?php gp_categories('category-ticket',0); ?>
    
</div><!-- END // sidebar -->