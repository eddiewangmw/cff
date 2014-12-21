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
