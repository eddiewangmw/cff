<?php

/*

@name 			    Award Taxonomy
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

if (!function_exists('gp_register_taxonomy_award')) {

    function gp_register_taxonomy_award() {
        
        register_taxonomy('category-award', 'award',
            array(
                'labels' => array(
                    'name'                  => __('Award Categories', 'gp'),
                    'singular_name'         => __('Award Category', 'gp'),
                    'search_items'          => __('Search Award Category', 'gp'),
                    'popular_items'         => __('Popular Award Categories', 'gp'),
                    'all_items'             => __('All Award Categories', 'gp'),
                    'parent_item'           => __('Parent Award Category', 'gp'),
                    'parent_item_colon'     => __('Parent Award Category:', 'gp'),
                    'edit_item'             => __('Edit Award Category', 'gp'),
                    'update_item'           => __('Update Award Category', 'gp'),
                    'add_new_item'          => __('Add New Award Category', 'gp'),
                    'new_item_name'         => __('New Award Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'award-category',
                    'with_front'            => false
                ),
                'label'                 => __('Award Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_award');

}

add_action('category-award_edit_form_fields','edit_form_fields');
add_action('category-award_edit_form', 'edit_form');
add_action('category-award_add_form_fields','edit_form_fields');
add_action('category-award_add_form','edit_form');

function edit_form() {
// your desired code
}
 
function edit_form_fields ($tag) {
    $termid = $tag->term_id;

    $cat_meta = get_option( "tax_$termid");
?>
  <tr class="form-field">
            <th valign="top" scope="row">
                <label for="catpic"><?php _e('List type', ''); ?></label>
            </th>
            <td>
				<select name="list_type">
					<option value="">Not required field</option>
					<option value="awards" <?php echo $cat_meta == 'awards' ? 'selected':'';?>>Awards</option>
					<option value="director" <?php echo $cat_meta == 'director' ? 'selected':'';?>>Director</option>
				</select>
            </td>
        </tr>
        <?php
    }
add_action ( 'edited_category-award', 'save_extra_fileds');
add_action('created_category-award','save_extra_fileds');
// save extra category extra fields callback function

function save_extra_fileds( $term_id ) {

    if ( isset( $_POST['list_type'] ) ) {
        	$termid = $term_id;
        	$cat_meta = get_option( "tax_$termid");
			if ($cat_meta !== false ) {
				update_option(  "tax_$termid",$_POST['list_type']  );
			}else{
				add_option(  "tax_$termid",$_POST['list_type'] ,  '', 'yes'  );
			}
    }
}
	
add_filter('deleted_term_taxonomy', 'remove_tax_Extras');

function remove_tax_Extras($term_id) {
	$termid = $term_id;
	if($_POST['taxonomy'] == '{$taxonomy}'):
		if(get_option( "tax_$termid"))
			delete_option( "tax_$termid");
	endif;
}

add_filter( 'manage_edit-category-award_columns', 'taxonomy_columns_type');
add_filter( 'manage_category-award_custom_column', 'taxonomy_columns_type_manage', 10, 3);
 
	function taxonomy_columns_type($columns) {
	        $columns['keywords'] = __( 'List type', 'dd_tax' );

	        return $columns;
	    }
	function taxonomy_columns_type_manage( $out ,$column_name, $term) {
		global $wp_version;
	    $out =  get_option( "tax_$termid"); 
		if(((float)$wp_version)<3.1)
			return $out;
		else
			echo $out;		
	}
