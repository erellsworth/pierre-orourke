<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Pierre_ORourke
 * @since Pierre O'Rourke 1.0
 */

get_header(); ?>

	<main>
		<section class="content">

			<header class="page-header">
				<h1 class="page-title">Page Not Found</h1>
			</header>
			
			<p>Site search</p>

				<?php get_search_form(); ?>

		</section><!-- .content -->
	</main>

<?php
get_footer();
