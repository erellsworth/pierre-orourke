<?php

// Register Custom Post Type
function endorsements_post_type() {

	$labels = array(
		'name'                => _x( 'Endorsements', 'Post Type General Name', 'pierre_orourke' ),
		'singular_name'       => _x( 'Endorsement', 'Post Type Singular Name', 'pierre_orourke' ),
		'menu_name'           => __( 'Endorsements', 'pierre_orourke' ),
		'parent_item_colon'   => __( 'Parent Endorsement:', 'pierre_orourke' ),
		'all_items'           => __( 'All Endorsements', 'pierre_orourke' ),
		'view_item'           => __( 'View Endorsements', 'pierre_orourke' ),
		'add_new_item'        => __( 'Add New Endorsement', 'pierre_orourke' ),
		'add_new'             => __( 'Add New', 'pierre_orourke' ),
		'edit_item'           => __( 'Edit Endorsement', 'pierre_orourke' ),
		'update_item'         => __( 'Update Endorsement', 'pierre_orourke' ),
		'search_items'        => __( 'Search Endorsement', 'pierre_orourke' ),
		'not_found'           => __( 'Not found', 'pierre_orourke' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'pierre_orourke' ),
	);
	$rewrite = array(
		'slug'                => 'endorsements',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'endorsements', 'pierre_orourke' ),
		'description'         => __( 'Endorsements', 'pierre_orourke' ),
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
	register_post_type( 'endorsements', $args );

}

// Hook into the 'init' action
add_action( 'init', 'endorsements_post_type', 0 );

// Register Custom Taxonomy
function endorsement_types() {

	$labels = array(
		'name'                       => _x( 'Types', 'Taxonomy General Name', 'pierre_orourke' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'pierre_orourke' ),
		'menu_name'                  => __( 'Type', 'pierre_orourke' ),
		'all_items'                  => __( 'All Types', 'pierre_orourke' ),
		'parent_item'                => __( 'Parent Type', 'pierre_orourke' ),
		'parent_item_colon'          => __( 'Parent Type:', 'pierre_orourke' ),
		'new_item_name'              => __( 'New Type', 'pierre_orourke' ),
		'add_new_item'               => __( 'Add New Type', 'pierre_orourke' ),
		'edit_item'                  => __( 'Edit Type', 'pierre_orourke' ),
		'update_item'                => __( 'Update Type', 'pierre_orourke' ),
		'separate_items_with_commas' => __( 'Separate types with commas', 'pierre_orourke' ),
		'search_items'               => __( 'Search Types', 'pierre_orourke' ),
		'add_or_remove_items'        => __( 'Add or remove Types', 'pierre_orourke' ),
		'choose_from_most_used'      => __( 'Choose from the most used types', 'pierre_orourke' ),
		'not_found'                  => __( 'Not Found', 'pierre_orourke' ),
	);
	$rewrite = array(
		'slug'                       => 'types',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'type', array( 'endorsements' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'endorsement_types', 0 );

class po_endorsement_meta extends WP_Geek_metabox
{
	public $args = array(
		'id' => 'po_endorsement_settings',
		'title' => 'Options',
		'posttype' => 'endorsements'
	);

	public function __construct(){
		parent::__construct($this->args);
	}//__construct

	public function box_content(){
		wp_enqueue_media();
		wp_enqueue_script('wpg_media_uploader');

		$fields = array(
			'link' => array(
				'label' => 'link'
			),
			'info' => array(
				'label' => 'Info:',
				'type' => 'textarea'
			)
		);

		foreach ($fields as $name => $field) {
			$this->add_field($field, $name);
		}
	}//box_content

}//po_endorsement_meta

	$metabox = new po_endorsement_meta();

	$meta = new WP_Geek_meta();

	$meta->add_box($metabox);

	$meta->init();

function endorsement_list($atts, $content = null){

		$args = array(
			'post_type' => 'endorsements',
			'posts_per_page' => -1		
		); 
		 
		$query = new WP_Query($args);

		$return = '<div class="endorsement_list">';

		while ( $query->have_posts() ){ $query->the_post();
			$return .= apply_filters('the_content', get_the_content());
		} wp_reset_postdata();           

		$return .= "</div>";

		return $return;         			     
      
}//endorsement_list

add_shortcode( 'endorsement_list', 'endorsement_list' );	
?>