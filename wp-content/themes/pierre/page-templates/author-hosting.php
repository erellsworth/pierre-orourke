<?php
/**
 *
 * Template Name: Author Hosting
 * @package WordPress
 * @subpackage Pierre_ORourke
 * @since Pierre O'Rourke 1.0
 */

get_header();
global $wp_query;

$args = array (
	'post_type' => 'endorsements',
	'type' => 'hosting'
	);

// The Query
$query = new WP_Query( $args );
 ?>

<main id="main" class="col-sm-8">
	<?php PO_Theme::loop($wp_query, array('showdate' => false)); ?>
	
	<section class="loop-content">
	<?php
		$alignment = 'left';
		// Start the Loop.
		while ( $query->have_posts() ) { $query->the_post();
			$meta = new WP_Geek_metabox();
            $meta->setdata();					
		 ?>
			<section class="post">
			<?php PO_Theme::thumbnail(get_the_ID(), $alignment, $meta->link, '_blank'); ?>
				<header class="post-header">
					<h2 class="post-title"><?php
						if($meta->link){ echo '<a href="' . $meta->link . '" target="_blank">'; }
						
						the_title();
						
						if($meta->link){ echo '</a>'; }
						?></h2>
					<div class="endorsement-info"><?php echo apply_filters('the_content', $meta->info); ?></div>
				</header>			
				<section class="content">
					<?php the_content(); ?>
				</section>
			</section>
		<?php
			if($alignment == 'left'){
				$alignment = 'right';
			} else {
				$alignment = 'left';
			}
		 }//end while
		 paging_nav();
	?>
	</section>		
</main>

<?php
get_sidebar();
get_footer();
?>