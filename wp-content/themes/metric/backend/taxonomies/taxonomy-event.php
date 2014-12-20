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

if (!function_exists('gp_register_taxonomy_event')) {

    function gp_register_taxonomy_event() {
        
        register_taxonomy('category-event', 'event',
            array(
                'labels' => array(
                    'name'                  => __('Categories', 'gp'),
                    'singular_name'         => __('Event Category', 'gp'),
                    'search_items'          => __('Search Event Category', 'gp'),
                    'popular_items'         => __('Popular Event Categories', 'gp'),
                    'all_items'             => __('All Event Categories', 'gp'),
                    'parent_item'           => __('Parent Event Category', 'gp'),
                    'parent_item_colon'     => __('Parent Event Category:', 'gp'),
                    'edit_item'             => __('Edit Event Category', 'gp'),
                    'update_item'           => __('Update Event Category', 'gp'),
                    'add_new_item'          => __('Add New Event Category', 'gp'),
                    'new_item_name'         => __('New Event Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'event-category',
                    'with_front'            => false
                ),
                'label'                 => __('Event Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_event');

}


add_action('category-event_edit_form', 'edit_event_form_fields');
add_action('category-event_add_form_fields','edit_event_form_fields');

 
function edit_event_form_fields ($tag) {
    $termid = $tag->term_id;

    $order = get_option( "eorder_$termid");
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
add_action ( 'edited_category-event', 'save_event_extra_fileds');
// save extra category extra fields callback function

function save_event_extra_fileds( $term_id ) {
	global $wpdb;
    if ( isset( $_POST['order'] ) ) {
        	$termid = $term_id;
        	$cat_meta = get_option( "eorder_$termid");
			if ($cat_meta !== false ) {
				update_option(  "eorder_$termid",$_POST['order']  );
			}else{
				add_option(  "eorder_$termid",$_POST['order'] ,  '', 'yes'  );
			}
	        $wpdb->update($wpdb->terms, array('term_group' => $_POST['order']), array('term_id'=>$term_id));
    }
}