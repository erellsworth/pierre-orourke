<?php
/**
 *
 * @package WordPress
 * @subpackage Pierre_ORourke
 * @since Pierre O'Rourke 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header id="site_header" class="container">
	<section class="row">
		<div class="col-sm-8"><?php PO_Theme::menu('header'); ?></div>

		<div class="col-sm-4 text-right"><?php WP_Geek::logo(); ?></div>
	</section>

	<section id="header_widgets" class="row">
		<div class="col-sm-4"><?php dynamic_sidebar('header-left'); ?></div>
		<div class="col-sm-4"><?php dynamic_sidebar('header-center'); ?></div>
		<div class="col-sm-4">Subscribe</div>
	</section>

</header>

<section id="page" class="container">
<div class="row">