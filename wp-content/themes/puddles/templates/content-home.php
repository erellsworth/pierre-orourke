<article <?php post_class('col-lg-6'); ?>>
		<header>
		  <?php get_template_part('templates/entry-meta', 'listing'); ?>
		</header>
		<div class="entry-summary">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		  <?php the_excerpt(); ?>
		</div>
		<hr/>
</article>
