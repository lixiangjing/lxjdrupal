<?php
################################################################################
// Breadcrumbs - http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
################################################################################

function Basically_breadcrumbs() {
 
  	$containerBefore = '<div id="breadcrumbs">';
	$containerAfter = '</div>';
	$containerCrumb = '<div class="crumbs">';
	$containerCrumbEnd = '</div>';
	$delimiter = ' &raquo; ';
	$name = '博客首页'; //text for the 'Home' link
	$blogname = 'CMS资讯网博客'; //text for the 'Blog' link
	$baseLink = '';
	$hierarchy = '';
	$currentLocation = '';
	$currentBefore = '<strong>';
	$currentAfter = '</strong>';
	$currentLocationLink = '';
	$crumbPagination = '';

	global $post;
 
	// Start of Container
    echo $containerBefore;
	// Start of Breadcrumbs
	echo $containerCrumb;

	// Output the Base Link	
	if ( is_front_page() ) {
		echo '<strong>' . $name . '</strong>';
	} else {
		$home = home_url('/');
		$baseLink =  '<a href="' . $home . '">' . $name . '</a>';
		echo $baseLink; 
	}
	// If static Page as Front Page, and on Blog Posts Index
	if ( is_home() && ( 'page' == get_option( 'show_on_front' ) ) ) {
		echo $delimiter . '<strong>' . $blogname . '</strong>';
	}
	// If static Page as Front Page, and on Blog, output Blog link
	if ( ! is_home() && ! is_page() && ! is_front_page() && ( 'page' == get_option( 'show_on_front' ) ) ) {
		$blogpageid = get_option( 'page_for_posts' );
		$bloglink = '<a href="' . get_permalink( $blogpageid ) . '">' . $blogname . '</a>';
		echo $delimiter . $bloglink;
	} 
    // Define Category Hierarchy Crumbs for Category Archive
	if ( is_category() ) { 
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();
		$thisCat = $cat_obj->term_id;
		$thisCat = get_category($thisCat);
		$parentCat = get_category($thisCat->parent);
		if ($thisCat->parent != 0) {
			$hierarchy = ( $delimiter . __( '分类归档：', 'basically' ) . get_category_parents( $parentCat, TRUE, $delimiter ) );
		} else {
			$hierarchy = $delimiter . __( '分类归档：', 'basically' );
		}
			// Set $currentLocation to the current category
			$currentLocation = single_cat_title( '' , FALSE ); 
	} 
	// Define Crumbs for Day/Year/Month Date-based Archives
	elseif ( is_date() ) { 
		// Define Year/Month Hierarchy Crumbs for Day Archive
		if  ( is_day() ) {
			$date_string = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ' . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ';
			$date_string .= $delimiter . ' ';
			$currentLocation = get_the_time('d'); 
		} 
		// Define Year Hierarchy Crumb for Month Archive
		elseif ( is_month() ) {
			$date_string = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ';
			$date_string .= $delimiter . ' ';
			$currentLocation = get_the_time('F'); 
		} 
		// Set CurrentLocation for Year Archive
		elseif ( is_year() ) {
			$date_string = '';
			$currentLocation = get_the_time('Y'); 
		}
		$hierarchy = $delimiter . sprintf( __( '发表日期： %s', 'basically' ), $date_string ); 
    } 
	// Define Category Hierarchy Crumbs for Single Posts
	elseif ( is_single() && !is_attachment() ) { 
		$cat = get_the_category(); 
		$cat = $cat[0];
		$hierarchy = $delimiter . get_category_parents( $cat, TRUE, $delimiter );
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title();	  
    } 
	// Define Category and Parent Post Crumbs for Post Attachments
	elseif ( is_attachment() ) { 
		$parent = get_post($post->post_parent);
		$cat_parents = '';
		if ( get_the_category($parent->ID) ) {
		$cat = get_the_category($parent->ID); 
		$cat = $cat[0];
		$cat_parents = get_category_parents( $cat, TRUE, $delimiter );
		}
		$hierarchy = $delimiter . $cat_parents . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter;
		// Note: Titles are forced for attachments; the
		// filename will be used if none is specified
		$currentLocation = get_the_title();  
    } 
	// Define Current Location for Parent Pages
	elseif ( ! is_front_page() && is_page() && ! $post->post_parent ) { 
		$hierarchy = $delimiter;
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title();	  
    } 
	// Define Parent Page Hierarchy Crumbs for Child Pages
	elseif ( ! is_front_page() && is_page() && $post->post_parent ) { 
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
		$page = get_page($parent_id);
		$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
		$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) {
		$hierarchy = $hierarchy . $delimiter . $crumb;
		}
		$hierarchy = $hierarchy . $delimiter;
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title(); 
    } 
	// Define current location for Search Results page
	elseif ( is_search() ) { 
		$hierarchy = $delimiter . __('搜索结果：', 'basically' ) . ' ';
		$currentLocation = get_search_query();	  
    } 
	// Define current location for Tag Archives
	elseif ( is_tag() ) {	  
		$hierarchy = $delimiter . __( 'Tag Archive:', 'basically' ) . ' ';
		$currentLocation = single_tag_title( '' , FALSE );  
    } 
	// Define current location for Author Archives
	elseif ( is_author() ) { 
		$hierarchy = $delimiter . __( '作者：', 'basically' ) . ' ';
		$currentLocation = get_the_author_meta( 'display_name', get_query_var( 'author' ) ); 
    } 
	// Define current location for 404 Error page
	elseif ( is_404() ) { 
		$hierarchy = $delimiter . __( 'Error 404:', 'basically' ) . ' ';
		$currentLocation = __( 'Page Not Found', 'basically' );	  
    } 
	// Define current location for Post Format Archives
	elseif ( get_post_format() && ! is_home() ) { 
		$hierarchy = $delimiter . __( 'Post Format Archive:', 'basically' ) . ' ';
		$currentLocation = get_post_format_string( get_post_format() ) . 's';
	}

	// Build the Current Location Link markup
		$currentLocationLink = $currentBefore . $currentLocation . $currentAfter; 
	 
	// Define breadcrumb pagination
	 
	// Define pagination for paged Archive pages
		if ( get_query_var('paged') && ! function_exists( 'wp_paginate' ) ) {
		  $crumbPagination = ' (Page ' . get_query_var('paged') . ')';
		}
	 
	 // Define pagination for Paged Posts and Pages
		if ( get_query_var('page') ) {
		  $crumbPagination = ' (Page ' . get_query_var('page') . ') ';
		}

	// Output the resulting Breadcrumbs
	
	echo $hierarchy; // Output Hierarchy	
	echo $currentLocationLink; // Output Current Location	
	echo $crumbPagination; // Output page number, if Post or Page is paginated	
	echo $containerCrumbEnd; // End of BreadCrumbs
 
    echo $containerAfter; // End of Container

} // end Basically_breadcrumbs()
?>