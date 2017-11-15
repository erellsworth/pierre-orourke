<article <?php post_class('col'); ?>>
	<div class="row">
		<header class="col-lg-5">
		<?php if ( has_post_thumbnail() ) { 
			$img = get_the_post_thumbnail_url(get_the_ID(), 'book_cover_small');
			?>
			<div class="text-center">
				<a href="<?php the_permalink(); ?>">
				<img src="<?php echo $img ?>" alt="<?php the_title(); ?>" />
				</a>
			</div>
		<?php } ?>
		</header>
		<div class="col-lg-7 entry-summary">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		  <?php the_excerpt(); ?>
		</div>
	</div>
		<hr/>
</article>
