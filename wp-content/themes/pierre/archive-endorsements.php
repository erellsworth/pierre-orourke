<?php
/**
 *
 * @package WordPress
 * @subpackage Pierre_ORourke
 * @since Pierre O'Rourke 1.0
 */

get_header();
 ?>

<main id="main" class="col-sm-8">
	<?php 
		if ( have_posts() ) { ?>
			<section class="loop-content">
			<?php
				$alignment = 'left';
				// Start the Loop.
				while ( have_posts() ) { the_post();
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
		<?php } else { ?>
			<h2>No posts found</h2>
		<?php }//end if
	?>
</main>

<?php
get_sidebar();
get_footer();
?>