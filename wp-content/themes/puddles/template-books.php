<?php
/**
 * Template Name: Books page
 */
?>

<?php while (have_posts()) : the_post(); ?>
	<h3><?php the_title(); ?></h3>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
<hr/>
<div class="row">
<?php 
$args = array(
			'post_type' => 'books',
			'post_status' => 'publish',
			'posts_per_page' => 3
		);

$the_query = new WP_Query($args);

while ( $the_query->have_posts()) :  $the_query->the_post(); ?>
	<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile;
 wp_reset_postdata(); 
 ?>
 </div>

