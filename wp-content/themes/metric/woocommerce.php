<?php

/*

@name			    WooCommerce Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

// Sidebar
if (gp_option('gp_shop_sidebar')) {
	$sidebar		= gp_option('gp_shop_sidebar');
} else {
	$sidebar		= 'left';
}

// Content Class
if (is_active_sidebar('widget-area-shop')) {
	$content_class	= 'content-shop content-sidebar content-sidebar-' . $sidebar;
} else {
	$content_class	= 'content-shop';
}

get_header();
?>

	<?php gp_start('div', 'canvas'); ?>

        <div class="clearfix"></div>

        <?php
            if ($sidebar == 'left') {
                if (is_active_sidebar('widget-area-shop')) {
                    get_sidebar('shop');
                }
            }
        ?>

        <div class="content <?php echo $content_class; ?>" role="main">

            <div class="woocommerce clearfix">

                <?php woocommerce_content(); ?>

            </div><!-- END // woocommerce -->

        </div><!-- END // content -->

        <?php
            if ($sidebar == 'right') {
                if (is_active_sidebar('widget-area-shop')) {
                    get_sidebar('shop');
                }
            }
        ?>

	<?php gp_end('div', 'canvas'); ?>

<?php
get_footer();