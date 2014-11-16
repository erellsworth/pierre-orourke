<?php

// Register Custom Post Type
function appearances_post_type() {

	$labels = array(
		'name'                => _x( 'Appearances', 'Post Type General Name', 'pierre_orourke' ),
		'singular_name'       => _x( 'Appearance', 'Post Type Singular Name', 'pierre_orourke' ),
		'menu_name'           => __( 'Appearances', 'pierre_orourke' ),
		'parent_item_colon'   => __( 'Parent Appearance:', 'pierre_orourke' ),
		'all_items'           => __( 'All Appearances', 'pierre_orourke' ),
		'view_item'           => __( 'View Appearances', 'pierre_orourke' ),
		'add_new_item'        => __( 'Add New Appearance', 'pierre_orourke' ),
		'add_new'             => __( 'Add New', 'pierre_orourke' ),
		'edit_item'           => __( 'Edit Appearance', 'pierre_orourke' ),
		'update_item'         => __( 'Update Appearance', 'pierre_orourke' ),
		'search_items'        => __( 'Search Appearance', 'pierre_orourke' ),
		'not_found'           => __( 'Not found', 'pierre_orourke' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'pierre_orourke' ),
	);
	$rewrite = array(
		'slug'                => 'appearances',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'appearances', 'pierre_orourke' ),
		'description'         => __( 'Appearances', 'pierre_orourke' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
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
	register_post_type( 'appearances', $args );

}

// Hook into the 'init' action
add_action( 'init', 'appearances_post_type', 0 );

class po_appearance_meta extends WP_Geek_metabox
{
	public $args = array(
		'id' => 'po_appearance_settings',
		'title' => 'Options',
		'posttype' => 'appearances'
	);

	public function __construct(){
		parent::__construct($this->args);
	}//__construct

	public function box_content(){

		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css');		
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('wpg_admin');

		$fields = array(
			'date' => array(
				'label' => 'Date:',
				'type' => 'date'
			),
			'time' => array('label' => 'Time:'),
			'link' => array('label' => 'Link:')
		);

		foreach ($fields as $name => $field) {
			$this->add_field($field, $name);
		}

	}//box_content

}//po_appearance_meta

	$metabox = new po_appearance_meta();

	$meta = new WP_Geek_meta();

	$meta->add_box($metabox);

	$meta->init();

?>