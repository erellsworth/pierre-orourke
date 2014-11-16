<?php

// Register Custom Post Type
function books_post_type() {

	$labels = array(
		'name'                => _x( 'Books', 'Post Type General Name', 'pierre_orourke' ),
		'singular_name'       => _x( 'Book', 'Post Type Singular Name', 'pierre_orourke' ),
		'menu_name'           => __( 'Books', 'pierre_orourke' ),
		'parent_item_colon'   => __( 'Parent Book:', 'pierre_orourke' ),
		'all_items'           => __( 'All Books', 'pierre_orourke' ),
		'view_item'           => __( 'View Book', 'pierre_orourke' ),
		'add_new_item'        => __( 'Add New Book', 'pierre_orourke' ),
		'add_new'             => __( 'Add New', 'pierre_orourke' ),
		'edit_item'           => __( 'Edit Book', 'pierre_orourke' ),
		'update_item'         => __( 'Update Book', 'pierre_orourke' ),
		'search_items'        => __( 'Search Book', 'pierre_orourke' ),
		'not_found'           => __( 'Not found', 'pierre_orourke' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'pierre_orourke' ),
	);
	$rewrite = array(
		'slug'                => 'books',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'books', 'pierre_orourke' ),
		'description'         => __( 'Books', 'pierre_orourke' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'books', $args );

}

// Hook into the 'init' action
add_action( 'init', 'books_post_type', 0 );

// Register Custom Taxonomy
function book_genres() {

	$labels = array(
		'name'                       => _x( 'Genres', 'Taxonomy General Name', 'pierre_orourke' ),
		'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', 'pierre_orourke' ),
		'menu_name'                  => __( 'Genre', 'pierre_orourke' ),
		'all_items'                  => __( 'All Genres', 'pierre_orourke' ),
		'parent_item'                => __( 'Parent Genre', 'pierre_orourke' ),
		'parent_item_colon'          => __( 'Parent Genre:', 'pierre_orourke' ),
		'new_item_name'              => __( 'New Genre', 'pierre_orourke' ),
		'add_new_item'               => __( 'Add New Genre', 'pierre_orourke' ),
		'edit_item'                  => __( 'Edit Genre', 'pierre_orourke' ),
		'update_item'                => __( 'Update Genre', 'pierre_orourke' ),
		'separate_items_with_commas' => __( 'Separate genres with commas', 'pierre_orourke' ),
		'search_items'               => __( 'Search Genres', 'pierre_orourke' ),
		'add_or_remove_items'        => __( 'Add or remove Genres', 'pierre_orourke' ),
		'choose_from_most_used'      => __( 'Choose from the most used genres', 'pierre_orourke' ),
		'not_found'                  => __( 'Not Found', 'pierre_orourke' ),
	);
	$rewrite = array(
		'slug'                       => 'genres',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'genre', array( 'books' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'book_genres', 0 );

class po_book_meta extends WP_Geek_metabox
{
	public $args = array(
		'id' => 'po_book_settings',
		'title' => 'Options',
		'posttype' => 'books'
	);

	public function __construct(){
		parent::__construct($this->args);
	}//__construct

	public function box_content(){

		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css');		
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('wpg_admin');

		$fields = array(
			'release' => array(
				'label' => 'Release Date:',
				'type' => 'date'
			)
		);

		foreach ($fields as $name => $field) {
			$this->add_field($field, $name);
		}
	}//box_content

}//po_book_meta

	$metabox = new po_book_meta();

	$meta = new WP_Geek_meta();

	$meta->add_box($metabox);

	$meta->init();

?>