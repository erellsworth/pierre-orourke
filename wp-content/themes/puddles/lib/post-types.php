<?php

namespace Roots\Sage\PostTypes;


// Register Book Post Type
function books() {

	$labels = array(
		'name'                  => _x( 'Books', 'Post Type General Name', 'puddles' ),
		'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'puddles' ),
		'menu_name'             => __( 'Books', 'puddles' ),
		'name_admin_bar'        => __( 'Books', 'puddles' ),
		'archives'              => __( 'Book Archives', 'puddles' ),
		'attributes'            => __( 'Book Attributes', 'puddles' ),
		'parent_item_colon'     => __( 'Parent Book:', 'puddles' ),
		'all_items'             => __( 'All Books', 'puddles' ),
		'add_new_item'          => __( 'Add New Book', 'puddles' ),
		'add_new'               => __( 'Add New Book', 'puddles' ),
		'new_item'              => __( 'New Book', 'puddles' ),
		'edit_item'             => __( 'Edit Book', 'puddles' ),
		'update_item'           => __( 'Update Book', 'puddles' ),
		'view_item'             => __( 'View Book', 'puddles' ),
		'view_items'            => __( 'View Books', 'puddles' ),
		'search_items'          => __( 'Search Books', 'puddles' ),
		'not_found'             => __( 'Not found', 'puddles' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'puddles' ),
		'featured_image'        => __( 'Featured Image', 'puddles' ),
		'set_featured_image'    => __( 'Set featured image', 'puddles' ),
		'remove_featured_image' => __( 'Remove featured image', 'puddles' ),
		'use_featured_image'    => __( 'Use as featured image', 'puddles' ),
		'insert_into_item'      => __( 'Insert into item', 'puddles' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Book', 'puddles' ),
		'items_list'            => __( 'Books list', 'puddles' ),
		'items_list_navigation' => __( 'Books list navigation', 'puddles' ),
		'filter_items_list'     => __( 'Filter book list', 'puddles' ),
	);
	$rewrite = array(
		'slug'                  => 'books',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Book', 'puddles' ),
		'description'           => __( 'Books', 'puddles' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'books',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'books', $args );

}

add_action( 'init',  __NAMESPACE__ . '\\books', 0 );

// Register Endorsement Post Type
function endorsements() {

	$labels = array(
		'name'                  => _x( 'Endorsements', 'Post Type General Name', 'puddles' ),
		'singular_name'         => _x( 'Endorsement', 'Post Type Singular Name', 'puddles' ),
		'menu_name'             => __( 'Endorsements', 'puddles' ),
		'name_admin_bar'        => __( 'Endorsements', 'puddles' ),
		'archives'              => __( 'Endorsement Archives', 'puddles' ),
		'attributes'            => __( 'Endorsement Attributes', 'puddles' ),
		'parent_item_colon'     => __( 'Parent Endorsement:', 'puddles' ),
		'all_items'             => __( 'All Endorsements', 'puddles' ),
		'add_new_item'          => __( 'Add New Endorsement', 'puddles' ),
		'add_new'               => __( 'Add New Endorsement', 'puddles' ),
		'new_item'              => __( 'New Endorsement', 'puddles' ),
		'edit_item'             => __( 'Edit Endorsement', 'puddles' ),
		'update_item'           => __( 'Update Endorsement', 'puddles' ),
		'view_item'             => __( 'View Endorsement', 'puddles' ),
		'view_items'            => __( 'View Endorsements', 'puddles' ),
		'search_items'          => __( 'Search Endorsements', 'puddles' ),
		'not_found'             => __( 'Not found', 'puddles' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'puddles' ),
		'featured_image'        => __( 'Featured Image', 'puddles' ),
		'set_featured_image'    => __( 'Set featured image', 'puddles' ),
		'remove_featured_image' => __( 'Remove featured image', 'puddles' ),
		'use_featured_image'    => __( 'Use as featured image', 'puddles' ),
		'insert_into_item'      => __( 'Insert into item', 'puddles' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Endorsement', 'puddles' ),
		'items_list'            => __( 'Endorsements list', 'puddles' ),
		'items_list_navigation' => __( 'Endorsements list navigation', 'puddles' ),
		'filter_items_list'     => __( 'Filter endorsement list', 'puddles' ),
	);
	$rewrite = array(
		'slug'                  => 'endorsements',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Endorsement', 'puddles' ),
		'description'           => __( 'Endorsements', 'puddles' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'endorsements',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'endorsements', $args );

}

add_action( 'init',  __NAMESPACE__ . '\\endorsements', 0 );