<?php
/**
 *
 * Template Name: Upcoming Books
 * @package WordPress
 * @subpackage Pierre_ORourke
 * @since Pierre O'Rourke 1.0
 */

get_header();
$args = array (
	'post_type'              => 'books',
	'meta_query'             => array(
		array(
			'key'       => 'release',
			'value'     => '',
			'compare'   => '=='
		),
	),
);

// The Query
$query = new WP_Query( $args );
 ?>

<main id="main" class="col-sm-8">
	<?php PO_Theme::loop($query, array( 'content' => 'excerpt')); ?>
</main>

<?php
get_sidebar();
get_footer();
?>