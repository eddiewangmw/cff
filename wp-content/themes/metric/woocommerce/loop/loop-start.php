<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
 
// Content Class
if (is_active_sidebar('widget_area_shop')) {
	$grid_class        = 'grid-tiles-sidebar';
} else {
	$grid_class        = 'grid-tiles';
}
?>

<div class="grid-shop grid-merge clearfix <?php echo $grid_class; ?>">