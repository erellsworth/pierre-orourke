<?php
/**
 *
 * @package WordPress
 * @subpackage Pierre_ORourke
 * @since Pierre O'Rourke 1.0
 */

get_header();
global $wp_query;
 ?>

<main>
	<?php PO_Theme::loop($wp_query, array( 'content' => 'excerpt')); ?>
</main>

<?php
get_sidebar();
get_footer();
?>