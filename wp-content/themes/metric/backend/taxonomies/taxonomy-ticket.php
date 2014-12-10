<?php

/*

@name 			    Ticket Taxonomy
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

if (!function_exists('gp_register_taxonomy_ticket')) {

    function gp_register_taxonomy_ticket() {
        
        register_taxonomy('category-ticket', 'ticket',
            array(
                'labels' => array(
                    'name'                  => __('Ticket Area', 'gp'),
                    'singular_name'         => __('Ticket Area', 'gp'),
                    'search_items'          => __('Search Ticket Area', 'gp'),
                    'popular_items'         => __('Popular Ticket Areas', 'gp'),
                    'all_items'             => __('All Ticket Areas', 'gp'),
                    'parent_item'           => __('Parent Ticket Areas', 'gp'),
                    'parent_item_colon'     => __('Parent Ticket Areas:', 'gp'),
                    'edit_item'             => __('Edit Ticket Area', 'gp'),
                    'update_item'           => __('Update Ticket Area', 'gp'),
                    'add_new_item'          => __('Add New Ticket Area', 'gp'),
                    'new_item_name'         => __('New Ticket Area  Name', 'gp')
                ),
                'hierarchical'          => true,
                'rewrite'               => array(
                    'slug'                  => 'ticket-category',
                    'with_front'            => false
                ),
                'label'                 => __('Ticket Areas', 'gp'),
                'has_archive'           => true,
            )
        );

    }
    
    add_action('init', 'gp_register_taxonomy_Ticket');

}