<?php

/*

@name 			    Event Taxonomy
@package		    GPanel WordPress Framework
@since			    3.0.3
@author 		    Pavel RICHTER <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

/*
====================================================================================================
Taxonomy Register
====================================================================================================
*/

if (!function_exists('gp_register_taxonomy_partner')) {

    function gp_register_taxonomy_partner() {
        
        register_taxonomy('category-partner', 'partner',
            array(
                'labels' => array(
                    'name'                  => __('Partner Categories', 'gp'),
                    'singular_name'         => __('Partner Category', 'gp'),
                    'search_items'          => __('Search Partner Category', 'gp'),
                    'popular_items'         => __('Popular Partner Categories', 'gp'),
                    'all_items'             => __('All Partner Categories', 'gp'),
                    'parent_item'           => __('Parent Partner Category', 'gp'),
                    'parent_item_colon'     => __('Parent Partner Category:', 'gp'),
                    'edit_item'             => __('Edit Partner Category', 'gp'),
                    'update_item'           => __('Update Partner Category', 'gp'),
                    'add_new_item'          => __('Add New Partner Category', 'gp'),
                    'new_item_name'         => __('New Partner Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'event-partner',
                    'with_front'            => false
                ),
                'label'                 => __('Partner Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_partner');

}

add_action('category-partner_edit_form', 'edit_partner_form_fields');
add_action('category-partner_add_form_fields','edit_partner_form_fields');

 
function edit_partner_form_fields ($tag) {
    $termid = $tag->term_id;

    $order = get_option( "porder_$termid");
?>
  <tr class="form-field">
            <th valign="top" scope="row">
                <label for="catpic"><?php _e('Order', ''); ?></label>
            </th>
            <td>
				<input type="text" name="order" value="<?php echo $order ? $order : 1;?>">
            </td>
        </tr>
        <?php
    }
add_action ( 'edited_category-partner', 'save_partner_extra_fileds');
// save extra category extra fields callback function

function save_partner_extra_fileds( $term_id ) {
	global $wpdb;
    if ( isset( $_POST['order'] ) ) {
        	$termid = $term_id;
        	$cat_meta = get_option( "porder_$termid");
			if ($cat_meta !== false ) {
				update_option(  "porder_$termid",$_POST['order']  );
			}else{
				add_option(  "porder_$termid",$_POST['order'] ,  '', 'yes'  );
			}
	        $wpdb->update($wpdb->terms, array('term_group' => $_POST['order']), array('term_id'=>$term_id));
    }
}