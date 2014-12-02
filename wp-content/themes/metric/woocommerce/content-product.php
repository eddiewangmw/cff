<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Ensure visibility
if ( ! $product->is_visible() )
	return;
	
// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes[] = 'tile';
?>
<div <?php post_class( $classes ); ?>>

    <div class="tile-block clearfix">
    
        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        
        <div class="product-image-container">
            <div class="product-image overlay">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
    
                    <?php
                    /**
                     * woocommerce_before_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                    ?>
                    
                    <span class="overlay-block">
                        <span class="overlay-icon"></span>
                    </span>
                
                </a>
            </div>
        </div>
        
        <div class="product-body inner clearfix">
        
            <h2><a class="underline" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            
            <div class="product-content clearfix">
            
                <?php
                    /**
                     * woocommerce_after_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                ?>
                
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            
            </div>
    
        </div>
    
    </div>

</div>