<?php if ( has_post_thumbnail() ) { ?>
	<div class="text-center">
		<?php the_post_thumbnail('homepage-thumb', ['class' => 'img-fluid']); ?>
	</div>
<?php } ?>

<time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time>
