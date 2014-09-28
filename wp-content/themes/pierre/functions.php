<?php

class PO_Theme
{
	function __construct($argument='')
	{
		
	}

	public function init(){
		wp_register_style('bootstap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
		wp_register_style('gfonts', $this->font_url());
		wp_register_style( 'pierre-style',get_stylesheet_uri(), array('bootstap', 'gfonts') );

		add_action( 'wp_enqueue_scripts', array($this, 'enque_styles') );
		add_action( 'init',  array($this, 'register_menus') );
		add_action( 'widgets_init', array($this, 'register_widget_areas') );
	}

	public function font_url(){
		$query_args = array('family' => urlencode( 'Exo:400,500,700,500italic' ));

		return add_query_arg( $query_args, '//fonts.googleapis.com/css' );		
	}

	public function enque_styles(){
		wp_enqueue_style( 'pierre-style' );	
	}

	public function register_menus(){
		$menus = array(
			'header' => 'Header Menu'
			);

		register_nav_menus($menus);
	} //register_menus

	public function register_widget_areas(){
		
		$areas = array(
					array(
						'name'          => 'Header Left',
						'id'            => 'header-left',
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

	public static function loop($query, $args=array()){
		$defaults = array('content' => 'content');
		$args = array_merge($defaults, $args);
		$content = 'the_' . $args['content'];

		if ( $query->have_posts() ) { ?>
			<section class="loop-<?php echo $args['content']; ?>">
			<?php
				// Start the Loop.
				while ( $query->have_posts() ) { $query->the_post(); ?>
					<section class="post">
						<header class="post-header">
							<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</header>			
						<section class="<?php echo $args['content']; ?>">
							<?php $content(); ?>
						</section>
					</section>
				<?php }//end while
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

?>