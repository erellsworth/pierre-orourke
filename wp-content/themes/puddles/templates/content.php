<article <?php post_class('col'); ?>>
	<div class="row">
		<header class="col">
		  <?php get_template_part('templates/entry-meta'); ?>
		</header>
		<div class="col-7 entry-summary">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		  <?php the_excerpt(); ?>
		</div>
	</div>
		<hr/>
</article>
