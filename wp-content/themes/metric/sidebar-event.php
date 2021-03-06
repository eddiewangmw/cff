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
	<?php 
	$current_category = 0;
	if(is_single()){
		$terms = get_the_terms( get_the_ID(), 'category-event' );
		$category = current($terms);
		$current_category =  $category->term_id;
	}?>
    <?php gp_categories('category-event',$current_category,'term_group'); ?>

    <?php dynamic_sidebar('widget-area-event'); ?>
    
</div><!-- END // sidebar -->