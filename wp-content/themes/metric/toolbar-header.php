<?php

/*

@name			    Header Toolbar Template
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

?>

<?php if (gp_option('gp_toolbar_header_left') != '') { ?>

    <?php gp_start('div', 'toolbar-left', false); ?>
        
        <?php echo stripslashes(gp_option('gp_toolbar_header_left')); ?>
        
    <?php gp_end('div', 'toolbar-left', false); ?>

<?php } ?>

<?php gp_start('div', 'toolbar-right', false); ?>

    <?php gp_start('div', 'row', false); ?>

        <?php if (gp_option('gp_toolbar_header_socials') != 'false') { ?>

            <?php get_template_part('socials'); ?>

        <?php } ?>

        <?php if (gp_option('gp_toolbar_header_search') != 'false') { ?>

            <ul class="modal-search-button">

                <li>
                    <a href="javascript:;" title="<?php _e('Search ...', 'gp'); ?>">
                        <?php _e('Search ...', 'gp'); ?>
                    </a>
                </li>

            </ul>

        <?php } ?>

        <?php if (gp_option('gp_toolbar_header_qtranslate') != 'false') { ?>

            <?php if (function_exists('qtrans_generateLanguageSelectCode')) { echo qtrans_generateLanguageSelectCode('image'); } ?>

        <?php } ?>

    <?php gp_end('div', 'row', false); ?>

    <?php if (gp_option('gp_toolbar_header_cart') != 'false') { ?>

        <?php
            if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                global $woo_options, $woocommerce;

                if (!is_user_logged_in()) {
                    ?>

                    <ul class="account">

                        <li class="login">
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Log in', 'gp'); ?>"><?php _e('Log in', 'gp'); ?></a>
                        </li>

                        <li class="signin">
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Sign in', 'gp'); ?>"><?php _e('Sign in', 'gp'); ?></a>
                        </li>

                    </ul><!-- END // account -->

                <?php
                } else {
                    global $current_user;
                    get_currentuserinfo();
                    ?>

                    <ul class="account">

                        <li class="loggedin">
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'gp'); ?>"><?php _e('My Account', 'gp'); ?></a>
                        </li>

                        <li class="logout">
                            <a href="<?php echo wp_logout_url(home_url()); ?>" title="<?php _e('Log out', 'gp'); ?>"><?php _e('Log out', 'gp'); ?></a>
                        </li>

                    </ul><!-- END // account -->

                <?php
                }
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
            }
        ?>

    <?php } ?>

<?php gp_end('div', 'toolbar-right', false); ?>