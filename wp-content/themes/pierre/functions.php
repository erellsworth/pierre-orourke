<?php

class PO_Theme
{
	public static $options;

	function __construct($argument='')
	{
		self::$options = get_option('po_theme_options');
		
	}

	public function init(){
		add_action( 'wp_enqueue_scripts', array($this, 'enque_styles') );
		add_action( 'init',  array($this, 'register_menus') );
		add_action( 'widgets_init', array($this, 'register_widget_areas') );
		add_action( 'before_wpg_sidebar', array($this, 'sidebar_buffer') );
		add_action( 'before_wpg_widgets', array($this, 'sidebar') );
		

		add_filter( 'wpg_sidebar_class', array( $this, 'sidebar_class' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 999 );
		add_filter('excerpt_more', array( $this, 'excerpt_more' ));

		add_theme_support( 'post-thumbnails' ); 

		//this would add an 600px x 400px cropped image size
		$args = array(
			'name' => 'Sidebar Thumbnail',
			'id' => 'sidebar_thumb',
			'width' => 260,
			'height' => 145
		);
		
		$size = new wpg_Image_Size($args);		
	}

	public static function option($option){
		return self::$options[$option];
	}//option

	public function font_url(){

		$query_args = array('family' => urlencode( 'Exo:400,500,700,500italic|Laila:400,700' ));

		return add_query_arg( $query_args, '//fonts.googleapis.com/css' );		
	}

	public function enque_styles(){
		wp_register_style('bootstap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
		wp_register_style('gfonts', $this->font_url());
		wp_register_style( 'pierre-style',get_stylesheet_uri(), array('bootstap', 'gfonts') );		
		wp_enqueue_style( 'pierre-style' );
		wp_enqueue_style('dashicons');
	
	}

	public function register_menus(){
		$menus = array(
			'header' => 'Header Menu'
			);

		register_nav_menus($menus);
	} //register_menus

	public function sidebar_class($class){
		$class[] = 'col-sm-3';
		return $class;
	}

	public function sidebar(){ ?>
		<div id="po_social">
			<a href="https://www.facebook.com/PierreORourkeAuthor" target="_blank">
			<img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="Pierre on Facebook" />
			</a>
			<a href="https://twitter.com/PierreORourke" target="_blank">
			<img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="Pierre on Twitter" />
			</a>	
		</div>	
	
	<?php }

	public function sidebar_buffer(){
		echo '<div class="col-sm-1"></div>';
	}

	public function register_widget_areas(){
		
		$areas = array(
					array(
						'name'          => 'Header Left',
						'id'            => 'header-left',
						'before_widget' => '<aside itemscope id="%1$s" class="widget %2$s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>'
					),
					array(
						'name'          => 'Header Center',
						'id'            => 'header-center',
						'before_widget' => '<aside itemscope id="%1$s" class="widget %2$s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>'
					),
					array(
						'name'          => 'Header Right',
						'id'            => 'header-right',
						'before_widget' => '<aside itemscope id="%1$s" class="widget %2$s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>'
					)
				);

		foreach($areas as $area){
			register_sidebar($area);			
		}

	}//register_widget_areas

	public function excerpt_length( $length ) {
		return 40;
	}	

	public function excerpt_more( $more ) {
		$return = '...<p class="readmore"><a href="' . get_permalink() . '">Read More</a></p>';
		return $return;
	}

	public static function thumbnail($id=false, $align="left", $link=false, $linktarget='_self'){
		global $post;
		if(!$id){ $id = $post->ID; } ?>
		<div class="post-thumb align<?php echo $align; ?>">
		<?php
		if($link){ echo '<a href="' . $link . '" target="' . $linktarget . '">'; }
		if(has_post_thumbnail($id)){ 
			echo get_the_post_thumbnail( $id, 'thumbnail' );
		} else { 
			echo wp_get_attachment_image( self::option('avatar'), 'thumbnail');
		}
		if($link){ echo '</a>'; }
		?>
		</div>
		<?php		
	}//thumbnail

	public static function date_link(){
		$date = get_the_date();
		$year = get_the_date('Y');
		$month = get_the_date('m');
		$day = get_the_date('d');

		echo '<p class="date"><a href="' . get_day_link($year, $month, $day) . '">' . $date . '</a></p>';
	}

	public static function loop($query, $args=array()){
		$defaults = array(
			'content' => 'content',
			'showdate' => true
		);

		$args = array_merge($defaults, $args);
		$content = 'the_' . $args['content'];

		if ( $query->have_posts() ) { ?>
			<section class="loop-<?php echo $args['content']; ?>">
			<?php
				// Start the Loop.
				while ( $query->have_posts() ) { $query->the_post(); ?>
					<section class="post">
					<?php self::thumbnail(); ?>
						<header class="post-header">
							<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php if($args['showdate']){ self::date_link(); } ?>
						</header>			
						<section class="<?php echo $args['content']; ?>">
							<?php $content(); ?>
						</section>
					</section>
				<?php }//end while
				paging_nav();
			?>
			</section>		
		<?php } else { ?>
			<h2>No posts found</h2>
		<?php }//end if

	}//loop

	public static function menu($location){
		$menu = array(
			'theme_location'  => $location,
			'container'       => 'nav'
		);		
		wp_nav_menu( $menu );		
	}//menu
}

$theme = new PO_Theme();
$theme->init();

class PO_theme_options extends WP_Geek_Option_Page{

	public $args=array(
			'menu_slug' => 'po_theme_options',
			'menu_type' => 'menu',
			'page_title' => 'Theme Options',
			'menu_title' => 'Theme Options',
			'data' => array( //include names of all fields here
				'avatar'
				),
			'options_name' => 'po_theme_options'
		);
	
	public function __construct(){
		parent::__construct($this->args);
		
	}//__construct		

	function fields(){
		parent::fields();
		wp_enqueue_media();
		wp_enqueue_script('wpg_media_uploader');				
							
		$avatar = array(
			'name' => 'avatar',
			'label' => 'Profile Photo: ',
			'type' => 'upload',
			'value' => $this->option('avatar')
		);	
		

			
		$fields = array($avatar);
		$formargs = array('fields' => $fields);
		$form = new WP_Geek_Form($formargs);
		
		$return = $form->fields();

	
		return $return;
	}			
					
}//PO_theme_options

$po_options = new PO_theme_options();

$po_options->add_actions();

function paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'twentyfourteen' ),
		'next_text' => __( 'Next &rarr;', 'twentyfourteen' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentyfourteen' ); ?></h1>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}


function query_filters($query){

	if(is_admin() || !$query->is_main_query()){
		return $query;
	}

	if(is_home()) {
		$query->set( 'post_type', array('post', 'appearances') );
	}

	if(is_post_type_archive( 'endorsements' )) {
		$query->set( 'posts_per_page', '-1' );
		$query->set('type', 'writing');
	}

	if(is_post_type_archive( 'books' )) {

		$meta_query = array(
			array(
				'key'       => 'release',
				'compare'   => '!=',
				'value' => ''
			),
		);
		
		$query->set( 'meta_query', $meta_query);
	}	

	return $query;
}
add_action( 'pre_get_posts', 'query_filters' );


include(TEMPLATEPATH . '/widgets/progress-bar.php');
include(TEMPLATEPATH . '/widgets/appearances.php');

include(TEMPLATEPATH . '/includes/appearances.php');
include(TEMPLATEPATH . '/includes/books.php');
include(TEMPLATEPATH . '/includes/endorsements.php');
?>