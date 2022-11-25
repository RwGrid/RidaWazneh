<?php

/**
 * Register Custom Post Types
 */

function cvio_register_portfolio() {
	register_post_type( 'portfolio', array(
		'label' => 'Portfolio',
		'description' => '',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'has_archive'  => true,
		'rewrite' => array( 'slug' => 'portfolio-archive', 'with_front' => true ),
		'query_var' => true,
		'supports' => array( 'title','editor','revisions','thumbnail','author','page-attributes' ),
		'taxonomies' => array( 'portfolio-categories','portfolio-tags' ),
		'menu_icon' => 'dashicons-images-alt2',
		'labels' => array(
			'name' => 'Portfolio',
			'singular_name' => 'Portfolio',
			'menu_name' => 'Portfolio',
			'add_new' => 'Add Portfolio',
			'add_new_item' => 'Add New Portfolio',
			'edit' => 'Edit',
			'edit_item' => 'Edit Portfolio',
			'new_item' => 'New Portfolio',
			'view' => 'View Portfolio',
			'view_item' => 'View Portfolio',
			'search_items' => 'Search Portfolio',
			'not_found' => 'No Portfolio Found',
			'not_found_in_trash' => 'No Portfolio Found in Trash',
				'parent' => 'Parent Portfolio',
			)
		) 
	);

	flush_rewrite_rules();
}
add_action( 'init', 'cvio_register_portfolio' );

function cvio_register_portfolio_categories() {
	register_taxonomy( 'portfolio_categories', array (
	  0 => 'portfolio',
	),
	array( 'hierarchical' => true,
			'label' => 'Portfolio categories',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => false,
			'labels' => array(
				'search_items' => '',
				'popular_items' => '',
				'all_items' => '',
				'parent_item' => '',
				'parent_item_colon' => '',
				'edit_item' => '',
				'update_item' => '',
				'add_new_item' => '',
				'new_item_name' => '',
				'separate_items_with_commas' => '',
				'add_or_remove_items' => '',
				'choose_from_most_used' => '',
			)
		) 
	); 			
}
add_action( 'init', 'cvio_register_portfolio_categories' );