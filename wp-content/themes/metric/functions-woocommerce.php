<?php

/*

@name			    WooCommerce Functions
@since			    1.1.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/ 

/*
====================================================================================================
WooCommerce Styles
====================================================================================================
*/

if (!function_exists('gp_woocommerce_styles')) {

	function gp_woocommerce_styles() {

		if (!is_admin()) {

			wp_enqueue_style('gp-style-woocommerce', trailingslashit(get_template_directory_uri()) . 'style-woocommerce.css', array(), '', 'all');

		}

	}

	add_action('wp_enqueue_scripts', 'gp_woocommerce_styles');

}

/*
----------------------------------------------------------------------------------------------------
Init Dynamic WooCommerce Styles
----------------------------------------------------------------------------------------------------
*/

get_template_part('style', 'woocommerce');

/*
====================================================================================================
Remove WooCommerce Scripts
====================================================================================================
*/

if (!function_exists('gp_remove_woocommerce_scripts')) {

    function gp_remove_woocommerce_scripts() {
        
        remove_action('wp_head', array($GLOBALS['woocommerce'], 'generator'));

        if (is_front_page() || is_home()) {

            /* Scripts for Homepage */
            wp_dequeue_script('wc_price_slider');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-add-to-cart');
            wp_dequeue_script('wc-cart-fragments');
            wp_dequeue_script('wc-checkout');
            wp_dequeue_script('wc-add-to-cart-variation');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-cart');
            wp_dequeue_script('wc-chosen');
            wp_dequeue_script('woocommerce');
            wp_dequeue_script('prettyPhoto');
            wp_dequeue_script('prettyPhoto-init');
            wp_dequeue_script('jquery-blockui');
            wp_dequeue_script('jquery-placeholder');
            wp_dequeue_script('fancybox');
            wp_dequeue_script('jqueryui');
            
        } else {

            /* Scripts Everywhere */
            wp_dequeue_script('prettyPhoto');
            wp_dequeue_script('prettyPhoto-init');
            wp_dequeue_script('fancybox');
            
        }
    
    }
    
    add_action('wp_print_scripts', 'gp_remove_woocommerce_scripts', 100);
    
}

/*
====================================================================================================
Remove WooCommerce Styles
====================================================================================================
*/

if (!function_exists('gp_remove_woocommerce_styles')) {

    function gp_remove_woocommerce_styles($enqueue_styles) {

        if (version_compare(WOOCOMMERCE_VERSION, "2.1") >= 0) {
            add_filter('woocommerce_enqueue_styles', '__return_false');
        } else {
            define('WOOCOMMERCE_USE_CSS', false);
        }

    }

    add_filter('woocommerce_enqueue_styles', 'gp_remove_woocommerce_styles');

}

/*
====================================================================================================
Image Sizes
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Define image sizes
----------------------------------------------------------------------------------------------------
*/

function gp_woocommerce_image_dimensions() {
  	
  	$catalog = array(
		'width' 	=> '400',	// px
		'height'	=> '',	    // px
		'crop'		=> 1 		// true
	);
 
	$single = array(
		'width' 	=> '800',	// px
		'height'	=> '',	    // px
		'crop'		=> 1 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '250',	// px
		'height'	=> '250',	// px
		'crop'		=> 1 		// false
	);
 
	// Image sizes
	update_option('shop_catalog_image_size', $catalog); 		 // Product category thumbs
	update_option('shop_single_image_size', $single); 		     // Single product image
	update_option('shop_thumbnail_image_size', $thumbnail); 	 // Image gallery thumbs
	
}

global $pagenow;
if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
    add_action('init', 'gp_woocommerce_image_dimensions', 1);
}

/*
====================================================================================================
Add to Cart Fragments
====================================================================================================
*/

remove_action('add_to_cart_fragments', 'woocommerce_cart_link');
 
function gp_add_to_cart_fragments( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
    
    	<ul class="cart-mini">
                    
            <li class="cart">
                <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('Shopping cart', 'gp'); ?>">
                    <?php _e('Shopping cart', 'gp'); ?>
                    <strong><?php echo $woocommerce->cart->get_cart_total(); ?></strong>
                    <?php if (sizeof($woocommerce->cart->cart_contents) >= 1) { ?>
                        <span class="badge"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                    <?php } ?>
                </a>
            </li>
        
        </ul><!-- END // cart-mini -->
    
    <?php
	
	$fragments['ul.cart-mini'] = ob_get_clean();
	
	return $fragments;
	
}

add_filter('add_to_cart_fragments', 'gp_add_to_cart_fragments', 1);