<?php

/*

@name 			    Album Taxonomy
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

if (!function_exists('gp_register_taxonomy_album')) {

    function gp_register_taxonomy_album() {
        
        register_taxonomy('category-album', 'album',
            array(
                'labels' => array(
                    'name'                  => __('Categories', 'gp'),
                    'singular_name'         => __('Album Category', 'gp'),
                    'search_items'          => __('Search Album Category', 'gp'),
                    'popular_items'         => __('Popular Album Categories', 'gp'),
                    'all_items'             => __('All Album Categories', 'gp'),
                    'parent_item'           => __('Parent Album Category', 'gp'),
                    'parent_item_colon'     => __('Parent Album Category:', 'gp'),
                    'edit_item'             => __('Edit Album Category', 'gp'),
                    'update_item'           => __('Update Album Category', 'gp'),
                    'add_new_item'          => __('Add New Album Category', 'gp'),
                    'new_item_name'         => __('New Album Category Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'album-category',
                    'with_front'            => false
                ),
                'label'                 => __('Album Categories', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_album');

}