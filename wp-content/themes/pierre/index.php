<?php
/**
 *
 * @package WordPress
 * @subpackage Pierre_ORourke
 * @since Pierre O'Rourke 1.0
 */

get_header(); ?>

<main>
	<?php
	if ( have_posts() ) { ?>
		<section class="loop">
		<?php
			// Start the Loop.
			while ( have_posts() ) { the_post(); ?>
				<header class="page-header">
					<h2 class="post-title"><?php the_title(); ?></h2>
				</header>			
				<section class="content">
				<?php the_content();?>
				</section>
			<?php }//end while
		?>
		</section>
	<?php } else { ?>
		<h2>No posts found</h2>
	<?php }//end if
	?>
</main>

<?php
get_footer();
?>