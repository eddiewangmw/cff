<?php

/*

@name			WooCommerce Styles
@package		Muse
@since			1.3.1
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/ 

/*
====================================================================================================
WooCommerce Styles
====================================================================================================
*/

if (!function_exists('gp_frontend_woocommerce_styles_generate')) {

	function gp_frontend_woocommerce_styles_generate() {

        // Google Font Face
        if (gp_option('gp_font_face') != '') {
            $font_face = gp_option('gp_font_face');
        } else {
            $font_face = 'Oswald';
        }

        // Text Transform
        if (gp_option('gp_text_transform') == 'none') {
            $text_transform = 'none';
        } else {
            $text_transform = 'uppercase';
        }

        /*
        ----------------------------------------------------------------------------------------------------
        Colors
        ----------------------------------------------------------------------------------------------------
        */

        // Color Background Light
        if (get_theme_mod('gp_color_background_light')) { $color_background_light = get_theme_mod('gp_color_background_light'); } else { $color_background_light = '#ffffff'; }
        $color_background_light_rgb = gp_hex_to_rgb($color_background_light);

        // Color Background Dark
        if (get_theme_mod('gp_color_background_dark')) { $color_background_dark = get_theme_mod('gp_color_background_dark'); } else { $color_background_dark = '#0a0f14'; }
        $color_background_dark_rgb = gp_hex_to_rgb($color_background_dark);

        // Color Text Light
        if (get_theme_mod('gp_color_text_light')) { $color_text_light = get_theme_mod('gp_color_text_light'); } else { $color_text_light = '#ffffff'; }
        $color_text_light_rgb = gp_hex_to_rgb($color_text_light);

        // Color Text Dark
        if (get_theme_mod('gp_color_text_dark')) { $color_text_dark = get_theme_mod('gp_color_text_dark'); } else { $color_text_dark = '#474b4f'; }
        $color_text_dark_rgb = gp_hex_to_rgb($color_text_dark);

        // Color Primary
        if (get_theme_mod('gp_color_primary')) { $color_primary = get_theme_mod('gp_color_primary'); } else { $color_primary = '#ebcd37'; }
        $color_primary_rgb = gp_hex_to_rgb($color_primary);

        // Color Secondary
        if (get_theme_mod('gp_color_secondary')) { $color_secondary = get_theme_mod('gp_color_secondary'); } else { $color_secondary = '#28a5a5'; }
        $color_secondary_rgb = gp_hex_to_rgb($color_secondary);
		?>
	
		<style type="text/css">

        /* Global */
        .demo_store { background-color: <?php echo $color_secondary; ?>; }
        .woocommerce mark,
        .woocommerce-page mark { color: <?php echo $color_text_light; ?> !important; }
        .woocommerce .order-info mark,
        .woocommerce-page .order-info mark { color: <?php echo $color_primary; ?> !important; }

        .woocommerce-message a,
        .woocommerce-error a,
        .woocommerce-info a { color: <?php echo $color_primary; ?>; }
        
        .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button { color: <?php echo $color_text_light; ?> !important; background-color: <?php echo $color_secondary; ?> !important; text-transform: <?php echo $text_transform; ?>; }
        .woocommerce a.button:hover, .woocommerce-page a.button:hover, .woocommerce button.button:hover, .woocommerce-page button.button:hover, .woocommerce input.button:hover, .woocommerce-page input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page #content input.button:hover { background-color: <?php echo $color_primary; ?> !important; }
        .woocommerce a.button.alt,
        .woocommerce-page a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce-page button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce-page input.button.alt,
        .woocommerce #respond input#submit.alt,
        .woocommerce-page #respond input#submit.alt,
        .woocommerce #content input.button.alt,
        .woocommerce-page #content input.button.alt { color: <?php echo $color_text_light; ?> !important; background-color: <?php echo $color_primary; ?>; }
        .woocommerce a.button.alt:hover,
        .woocommerce-page a.button.alt:hover,
        .woocommerce button.button.alt:hover,
        .woocommerce-page button.button.alt:hover,
        .woocommerce input.button.alt:hover,
        .woocommerce-page input.button.alt:hover,
        .woocommerce #respond input#submit.alt:hover,
        .woocommerce-page #respond input#submit.alt:hover,
        .woocommerce #content input.button.alt:hover,
        .woocommerce-page #content input.button.alt:hover { color: <?php echo $color_text_light; ?> !important; background-color: <?php echo $color_secondary; ?>; }
        .woocommerce table,
        .woocommerce-page table { color: <?php echo $color_background_dark; ?>; }
        .woocommerce table.variations,
        .woocommerce-page table.variations { color: <?php echo $color_text_light; ?>; }
        .woocommerce table a,
        .woocommerce-page table a { color: <?php echo $color_primary; ?>; }
        
        /* Toolbar */
        .toolbar .account li a { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }
        .toolbar .account li a:hover { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_secondary; ?>; }

        /* Toolbar > Shop Mini Cart */
        .toolbar .cart-mini li.checkout a { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_secondary; ?>; }
        .toolbar .cart-mini li.checkout a:hover { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }
        .toolbar .cart-mini li.cart a { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_secondary; ?>; }
        .toolbar .cart-mini li.cart a:hover { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }
        .toolbar .cart-mini li.checkout a { background-color: <?php echo $color_secondary; ?>; }
        .toolbar .cart-mini li.checkout a:hover { background-color: <?php echo $color_primary; ?>; }
        .toolbar .cart-mini li.cart a span.badge { color: <?php echo $color_secondary; ?>; background-color: <?php echo $color_text_light; ?>; }
        .toolbar .cart-mini li.cart a:hover span.badge { color: <?php echo $color_primary; ?>; background-color: <?php echo $color_text_light; ?>; }
        
        /* Category */
        .woocommerce .grid-shop .product h2 a,
        .woocommerce-page .grid-shop .product h2 a { color: <?php echo $color_secondary; ?>; }
        .woocommerce .grid-shop .product h2 a:hover,
        .woocommerce-page .grid-shop .product h2 a:hover { color: <?php echo $color_primary; ?>; }
        .woocommerce .grid-shop a.button.add_to_cart_button,
        .woocommerce-page .grid-shop a.button.add_to_cart_button,
        .woocommerce .grid-shop a.button.product_type_variable,
        .woocommerce-page .grid-shop a.button.product_type_variable,
        .woocommerce .grid-shop a.button.product_type_grouped,
        .woocommerce-page .grid-shop a.button.product_type_grouped,
        .woocommerce .grid-shop .product .product-content .button,
        .woocommerce-page .grid-shop .product .product-content .button{ font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; color: <?php echo $color_text_light; ?> !important; background-color: <?php echo $color_background_dark; ?> !important; }
        .woocommerce .grid-shop a.button.add_to_cart_button:hover,
        .woocommerce-page .grid-shop a.button.add_to_cart_button:hover,
        .woocommerce .grid-shop a.button.product_type_variable:hover,
        .woocommerce-page .grid-shop a.button.product_type_variable:hover,
        .woocommerce .grid-shop a.button.product_type_grouped:hover,
        .woocommerce-page .grid-shop a.button.product_type_grouped:hover { background-color: <?php echo $color_primary; ?> !important; }
        .woocommerce .grid-shop a.added_to_cart,
        .woocommerce-page .grid-shop a.added_to_cart { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; color: <?php echo $color_text_light; ?> !important; background-color: <?php echo $color_secondary; ?> !important; }
        .woocommerce .grid-shop a.added_to_cart:hover,
        .woocommerce-page .grid-shop a.added_to_cart:hover { background-color: <?php echo $color_primary; ?> !important; }
        .woocommerce span.onsale,
        .woocommerce-page span.onsale { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }
        .woocommerce a.button.loading:before,
        .woocommerce-page a.button.loading:before,
        .woocommerce button.button.loading:before,
        .woocommerce-page button.button.loading:before,
        .woocommerce input.button.loading:before,
        .woocommerce-page input.button.loading:before,
        .woocommerce #respond input#submit.loading:before,
        .woocommerce-page #respond input#submit.loading:before,
        .woocommerce #content input.button.loading:before,
        .woocommerce-page #content input.button.loading:before { background-color: <?php echo $color_background_dark; ?> !important; }
        .woocommerce .grid-shop .product-category mark.count,
        .woocommerce-page .grid-shop .product-category mark.count { color: <?php echo $color_text_light; ?>; }
        
        /* Single */
        .woocommerce div.product div.summary .single_add_to_cart_button,
        .woocommerce-page div.product div.summary .single_add_to_cart_button,
        .woocommerce #content div.product div.summary .single_add_to_cart_button
        .woocommerce-page #content div.product div.summary .single_add_to_cart_button { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        .woocommerce div.product span.price,
        .woocommerce-page div.product span.price,
        .woocommerce #content div.product span.price,
        .woocommerce-page #content div.product span.price,
        .woocommerce div.product p.price,
        .woocommerce-page div.product p.price,
        .woocommerce #content div.product p.price,
        .woocommerce-page #content div.product p.price { color: <?php echo $color_text_dark; ?> !important; }
        .woocommerce div.product .stock,
        .woocommerce-page div.product .stock,
        .woocommerce #content div.product .stock,
        .woocommerce-page #content div.product .stock { color: <?php echo $color_text_dark; ?> !important; }
        .woocommerce div.product form.cart .variations label,
        .woocommerce-page div.product form.cart .variations label,
        .woocommerce #content div.product form.cart .variations label,
        .woocommerce-page #content div.product form.cart .variations label { color: <?php echo $color_secondary; ?>; }
            
        /* Cart */
        .woocommerce .button.button-checkout,
        .woocommerce-page .button.button-checkout,
        .woocommerce .button.checkout-button,
        .woocommerce-page .button.checkout-button { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; background-color: <?php echo $color_primary; ?> !important; }
        .woocommerce .button.button-checkout:hover,
        .woocommerce-page .button.button-checkout:hover,
        .woocommerce .button.checkout-button:hover,
        .woocommerce-page .button.checkout-button:hover { background-color: <?php echo $color_secondary; ?> !important; }
        .woocommerce table.shop_table thead th,
        .woocommerce-page table.shop_table thead th { background-color: <?php echo $color_background_dark; ?> !important; }
        .woocommerce td.product-name a,
        .woocommerce-page td.product-name a { color: <?php echo $color_secondary; ?>; }
        .woocommerce td.product-name a:hover,
        .woocommerce-page td.product-name a:hover { color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_secondary; ?>; }
        .woocommerce .cart-collaterals .cart_totals h2,
        .woocommerce-page .cart-collaterals .cart_totals h2,
        .woocommerce .cart-collaterals .shipping_calculator h2,
        .woocommerce-page .cart-collaterals .shipping_calculator h2,
        .woocommerce .cart-collaterals .cross-sells h2,
        .woocommerce-page .cart-collaterals .cross-sells h2 { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_background_dark; ?>; }
        .woocommerce .cart-collaterals .shipping_calculator h2 a,
        .woocommerce-page .cart-collaterals .shipping_calculator h2 a { color: <?php echo $color_text_light; ?>; }
        .woocommerce .cart-subtotal .amount,
        .woocommerce-page .cart-subtotal .amount,
        .woocommerce .total .amount,
        .woocommerce-page .total .amount { color: <?php echo $color_secondary; ?>; }
        .woocommerce .cart-collaterals .cart_totals .discount td,
        .woocommerce-page .cart-collaterals .cart_totals .discount td { color: <?php echo $color_secondary; ?>; }
        
        /* Order */
        .woocommerce #place_order,
        .woocommerce-page #place_order { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important;  background-color: <?php echo $color_primary; ?> !important; }
        .woocommerce #place_order:hover,
        .woocommerce-page #place_order:hover { background-color: <?php echo $color_secondary; ?> !important; }
        .woocommerce #order_review_heading,
        .woocommerce-page #order_review_heading { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }
        
        /* Tabs */
        .woocommerce div.product .woocommerce-tabs ul.tabs li a,
        .woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
        .woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
        .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_background_light; ?>; }
        .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
        .woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover,
        .woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover,
        .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
        .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,
        .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,
        .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover,
        .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a:hover,
        .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a:hover,
        .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a:hover { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_text_dark; ?>; }
        .woocommerce div.product .woocommerce-tabs .panel,
        .woocommerce-page div.product .woocommerce-tabs .panel,
        .woocommerce #content div.product .woocommerce-tabs .panel,
        .woocommerce-page #content div.product .woocommerce-tabs .panel { border-color: <?php echo $color_text_dark; ?>; color: <?php echo $color_text_dark; ?>; }
        .woocommerce div.product .woocommerce-tabs .panel a,
        .woocommerce-page div.product .woocommerce-tabs .panel a,
        .woocommerce #content div.product .woocommerce-tabs .panel a,
        .woocommerce-page #content div.product .woocommerce-tabs .panel a { color: <?php echo $color_secondary; ?>; }
        .woocommerce div.product .woocommerce-tabs .panel a:hover,
        .woocommerce-page div.product .woocommerce-tabs .panel a:hover,
        .woocommerce #content div.product .woocommerce-tabs .panel a:hover,
        .woocommerce-page #content div.product .woocommerce-tabs .panel a:hover { color: <?php echo $color_primary; ?>; }
        .woocommerce div.product .woocommerce-tabs .panel .button a,
        .woocommerce-page div.product .woocommerce-tabs .panel .button a,
        .woocommerce #content div.product .woocommerce-tabs .panel .button a,
        .woocommerce-page #content div.product .woocommerce-tabs .panel .button a { color: <?php echo $color_text_light; ?> !important; }
        
        /* Pagination */
        .woocommerce nav.woocommerce-pagination ul li a,
        .woocommerce-page nav.woocommerce-pagination ul li a,
        .woocommerce #content nav.woocommerce-pagination ul li a,
        .woocommerce-page #content nav.woocommerce-pagination ul li a,
        .woocommerce nav.woocommerce-pagination ul li span,
        .woocommerce-page nav.woocommerce-pagination ul li span,
        .woocommerce #content nav.woocommerce-pagination ul li span,
        .woocommerce-page #content nav.woocommerce-pagination ul li span { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?> !important; }
        .woocommerce nav.woocommerce-pagination ul li span.current,
        .woocommerce-page nav.woocommerce-pagination ul li span.current,
        .woocommerce #content nav.woocommerce-pagination ul li span.current,
        .woocommerce-page #content nav.woocommerce-pagination ul li span.current,
        .woocommerce nav.woocommerce-pagination ul li a:hover,
        .woocommerce-page nav.woocommerce-pagination ul li a:hover,
        .woocommerce #content nav.woocommerce-pagination ul li a:hover,
        .woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
        .woocommerce nav.woocommerce-pagination ul li a:focus,
        .woocommerce-page nav.woocommerce-pagination ul li a:focus,
        .woocommerce #content nav.woocommerce-pagination ul li a:focus,
        .woocommerce-page #content nav.woocommerce-pagination ul li a:focus { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_secondary; ?> !important; }
        
        /* Stars */
        .woocommerce .star-rating,
        .woocommerce-page .star-rating { color: <?php echo $color_secondary; ?>; }
        .woocommerce p.stars a:hover:before,
        .woocommerce-page p.stars a:hover:before,
        .woocommerce p.stars a:focus:before,
        .woocommerce-page p.stars a:focus:before { color: <?php echo $color_primary; ?>; }
        .woocommerce p.stars a.active:before,
        .woocommerce-page p.stars a.active:before { color: <?php echo $color_secondary; ?>; }
        
        /* Widgets */
        .woocommerce ul.cart_list li a,
        .woocommerce-page ul.cart_list li a,
        .woocommerce ul.product_list_widget li a,
        .woocommerce-page ul.product_list_widget li a { color: <?php echo $color_primary; ?>; }
        .woocommerce ul.cart_list li a:hover,
        .woocommerce-page ul.cart_list li a:hover,
        .woocommerce ul.product_list_widget li a:hover,
        .woocommerce-page ul.product_list_widget li a:hover { color: <?php echo $color_secondary; ?>; }
        
        .widget_product_categories li { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }
        .widget_product_categories li a { color: <?php echo $color_text_light; ?>; }
        .widget_product_categories li a:hover { color: <?php echo $color_text_light; ?>; }
        
        .widget_layered_nav ul li.chosen a { color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_secondary; ?>; }
            
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
        .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle { background-color: <?php echo $color_primary; ?> !important; }
        .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
        .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range { background-color: <?php echo $color_primary; ?> !important; }
        .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
        .woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content { background-color: <?php echo $color_background_dark; ?> !important; }
        
        .woocommerce .widget_layered_nav_filters ul li a,
        .woocommerce-page .widget_layered_nav_filters ul li a { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_secondary; ?>; }
        .woocommerce .widget_layered_nav_filters ul li a:hover,
        .woocommerce-page .widget_layered_nav_filters ul li a:hover { color: <?php echo $color_text_light; ?>; background-color: <?php echo $color_primary; ?>; }

		</style>
		
		<?php
		
	}
	
	add_action('wp_head', 'gp_frontend_woocommerce_styles_generate');

}