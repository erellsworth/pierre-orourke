<?php if ( has_post_thumbnail() ) { 
	$img = get_the_post_thumbnail_url(get_the_ID(), 'custom_thumb');
	?>
	<div class="text-center">
		<img src="<?php echo $img ?>" alt="<?php the_title(); ?>" />
		
	</div>
<?php } ?>

<time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time>
