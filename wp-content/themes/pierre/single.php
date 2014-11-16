<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Pierre_ORourke
 * @since Pierre O'Rourke 1.0
 */

get_header();
global $wp_query;
 ?>

	<main id="main" class="col-sm-8">
		<?php PO_Theme::loop($wp_query, array('showdate' => false)); ?>
	</main>
	
<?php
get_sidebar();
get_footer();
