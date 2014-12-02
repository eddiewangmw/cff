<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<h1 itemprop="name" class="product_title title entry-title">

	<?php
    	the_title();

		if (is_user_logged_in()) {
			edit_post_link(__('[edit]', 'gp'), '<span class="edit-post-link">', '</span>'); 
		}

	?>
    
</h1>