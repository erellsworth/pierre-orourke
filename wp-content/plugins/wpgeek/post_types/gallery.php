<?php
if(!class_exists('wpg_Gallery')){
	//PHP class to easily add image sizes
	class wpg_Gallery{
		
		public $post_type = 'wpg_gallery';

		public function __construct(){

		}

		public function init(){
			add_action( 'init', array($this, 'register'),0);
			add_filter('the_content', array($this, 'content'));
			//add_action( 'add_meta_boxes', array($this, 'add_meta_box') );
		}

		public function register(){
			$labels = array(
				'name'                => _x( 'Galleries', 'Post Type General Name', 'wp_geek' ),
				'singular_name'       => _x( 'Gallery', 'Post Type Singular Name', 'wp_geek' ),
				'menu_name'           => __( 'Gallery', 'wp_geek' ),
				'parent_item_colon'   => __( 'Parent Gallery:', 'wp_geek' ),
				'all_items'           => __( 'All Galleries', 'wp_geek' ),
				'view_item'           => __( 'View Gallery', 'wp_geek' ),
				'add_new_item'        => __( 'Add New Gallery', 'wp_geek' ),
				'add_new'             => __( 'Add New', 'wp_geek' ),
				'edit_item'           => __( 'Edit Gallery', 'wp_geek' ),
				'update_item'         => __( 'Update Gallery', 'wp_geek' ),
				'search_items'        => __( 'Search Galleries', 'wp_geek' ),
				'not_found'           => __( 'Not found', 'wp_geek' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'wp_geek' ),
			);
			$rewrite = array(
				'slug'                => 'gallery',
				'with_front'          => true,
				'pages'               => true,
				'feeds'               => true,
			);
			$args = array(
				'label'               => __( 'wpg_gallery', 'wp_geek' ),
				'description'         => __( 'Gallery of images', 'wp_geek' ),
				'labels'              => $labels,
				'supports'            => array( 'title', ),
				'taxonomies'          => array( 'gallery_category' ),
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

			register_post_type( $this->post_type, $args );
		}//register

		public function content($content){
			if ( $this->post_type == get_post_type() ){
				$content .= $this->display(false);
			}
			return $content;
		}

		public function display($echo=true){
			wp_enqueue_script('wpg_scripts');
			wp_enqueue_style('wpg_colorgox_styles');
			$meta = new WP_Geek_metabox();
            $meta->setdata();	
            $gallery = '<div class="wpg_gallery">';	
            $grid = 4;
            $count = 1;
            foreach (unserialize($meta->gallery_images) as $value){
            	//if($count == 0){ $gallery .= '<div class="row ' . $count . ' ' . $count % 3 . '">'; }
            	
				$thumb = wp_get_attachment_image( $value, 'medium');  
				$full = wp_get_attachment_image_src( $value, 'large');            	
            	$gallery .= '<div class="col-md-' . $grid . '"><a href="' . $full[0] . '" class="wpg_lightbox">';
            	$gallery .= $thumb;
            	$gallery .= '</a></div>';
            	if($count % 3 === 0){ $gallery .= '<hr/>';}
            	$count++;
            }	//foreach
            $gallery .= '</div>';
			if($echo){ echo $gallery; }
			return $gallery;
		}

	}//class wpg_Gallery{
	$gallery = new wpg_Gallery();
	$gallery->init();

	class wpg_gallery_meta extends WP_Geek_metabox
	{
		public $args = array(
			'id' => 'wpg_gallery_options',
			'title' => 'Options',
			'context' => 'normal'
		);

		public function __construct(){
			$gallery = new wpg_Gallery();
			$this->args['posttype'] =  $gallery->post_type;
			parent::__construct($this->args);
		}//__construct

		public function box_content(){
			$fields = array(
				'thumbnail' => array(
					'label' => 'Thumbnail',
					'type' => 'upload'
				),
				'gallery_images' => array(
					'label' => 'Gallery Images:',
					'type' => 'upload',
					'upload_type' => 'gallery'
				)
			);

			foreach ($fields as $name => $field) {
				$this->add_field($field, $name);
			}
		}//box_content

	}//wpg_gallery_meta

	$metabox = new wpg_gallery_meta();

	$meta = new WP_Geek_meta();

	$meta->add_box($metabox);

	$meta->init();		
}//if(!class_exists('wpg_Gallery')){

?>