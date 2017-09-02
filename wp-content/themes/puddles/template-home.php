<?php
/**
 * Template Name: Front Page
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<h3>Latest</h3>
<hr/>
<div class="row">
<?php 
$args = array('post_status' => 'publish', 'posts_per_page' => 3);

$the_query = new WP_Query($args);
while ( $the_query->have_posts()) :  $the_query->the_post(); ?>
	<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile;
 wp_reset_postdata(); 
 ?>
 </div>

