<?php
/**
 * @package WordPress
 * @subpackage Basically
 * @template header
 */
 $options = Basically_get_theme_options();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width" />

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
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<link rel="alternate" type="application/rss+xml" title="CMS资讯网博客社区" href="http://idc.wowcms.com/feed" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed">

	<div id="header" class="clearfix">
	
		<div id="header-left">
			<?php
			$logo = isset($options['logo'])? $options['logo']: '';
			if ($logo == ""){
				$hidetitle = $options['hide_title'];
				
				if ($hidetitle == "No") {
				
					if(!is_home() || !is_front_page()) { ?>
						<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo('name'); ?></a></span>
						<div class="site-description">{大名："老李"，口号："技术崇拜者"，标签："站长，开源，Linux，系统"}</div>
					<?php } else { ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo('name'); ?></a></h1>
						<div class="site-description">{大名："老李"，口号："技术崇拜者"，标签："站长，开源，Linux，系统"}</div>
						
				<?php } }
				
			} else {
				echo '<div class="site-logo"><a href="'. esc_url( home_url( '/' ) ) .'">';
				echo '<img title="'. get_bloginfo('name') .'" src="' . $logo .'" />';
				echo '</a></div>';
			} ?>
		</div><!-- end #header-left -->
		
		<?php get_template_part('includes/header-ads'); ?>
		
	</div><!-- end #header -->

	<div id="primary-navigation" class="clearfix">
		
		<?php 
			$pagesNav = '';
			if (function_exists('wp_nav_menu')) {
				$pagesNav = wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav clearfix', 'echo' => false, 'fallback_cb' => '', 'container' => '' ) );};
			if ($pagesNav == '') { ?>
			<ul class="nav clearfix">
				<?php if ( is_home() ) { ?>
					<li class="first"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="nofollow"><?php _e('Home', 'basically'); ?></a></li>
				<?php } else { ?>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="nofollow"><?php _e('Home', 'basically'); ?></a></li>
				<?php } ?>
				<?php wp_list_pages('title_li='); ?>
			</ul>
		<?php }
		else 
			echo($pagesNav); 
		?>		
	
	</div><!-- end #nav_link -->
		
	<?php $secondary = $options['secondary_navigation'];
	if ($secondary == "Yes") { ?>
	
		<div id="secondary-navigation">
			
			<?php 
				$secondaryNav = '';
				if (function_exists('wp_nav_menu')) {
					$secondaryNav = wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'cat-nav clearfix', 'echo' => false, 'fallback_cb' => '', 'container' => '' ) );};
				if ($secondaryNav == '') { ?>
					<ul class="cat-nav clearfix">
						<?php if (is_page()) { $highlight = "page_item"; } else {$highlight = "page_item current_page_item"; } ?>
						<?php wp_list_categories('title_li='); ?>
					</ul>
			<?php }
			else 
				echo($secondaryNav); 
			?>
		</div><!-- end #secondary-navigation -->
		
	<?php } ?>

<div id="container" class="clearfix">
	
	<?php $customclass = (!is_attachment() && !is_page_template('full-width-page.php'))? 'content':'full-width-content'; ?>
	<div id="<?php echo $customclass; ?>">
	
	<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');
	} else {
		echo Basically_breadcrumbs(); 
	}?>