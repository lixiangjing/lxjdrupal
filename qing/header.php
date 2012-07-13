<?php
/**
 * @package WordPress
 * @subpackage Pink Touch 2
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) | !(IE 9)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'pinktouch' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="CMS资讯网博客社区" href="http://idc.wowcms.com/feed" />
<link href="http://idc.wowcms.com/webmaster/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta name="generator" content="WordPress" />
</head>

<body <?php body_class(); ?>>
	<div id="wrapper">
		<div id="navigation">
			<div class="wrapper clearfix">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => '', 'container_id' => 'nav-menu' ) ); ?>
				<?php get_search_form(); ?>
			</div>
		</div><!-- /#navigation -->
		<div id="navigation-frill"></div>

		<div id="header">
			<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

			<div id="description">
				<p><?php bloginfo( 'description' ); ?></p>
			</div>
		</div><!-- /#header -->

		<div id="content">