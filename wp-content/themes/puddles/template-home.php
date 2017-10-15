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
$args = array('post_status' => 'publish', 'posts_per_page' => 4);

$the_query = new WP_Query($args);
$count = 1;
while ( $the_query->have_posts()) :  $the_query->the_post(); ?>
	<?php get_template_part('templates/content', 'home'); ?>
<?php 
	//if($count % 2 == 0){ echo '<div class="w-100"></div>'; }
	$count++;
	endwhile;
 	wp_reset_postdata(); 
 ?>
 </div>

