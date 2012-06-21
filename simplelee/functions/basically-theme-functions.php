<?php
################################################################################
// Favicon Option
################################################################################

function Basically_favicon() {
	$options = Basically_get_theme_options();
	$favicon = isset($options['favicon'])? $options['favicon']: ''; 
	
	if ( $favicon != "" ): ?>
	<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
	<?php endif;
}
add_action('wp_head', 'Basically_favicon', 1);


################################################################################
// Font Stack Option
################################################################################

function Basically_add_font_stack() {
	$options = Basically_get_theme_options();
	$font_stack = isset($options['font_stack'])? $options['font_stack']: ''; ?>

	<style type="text/css">
		body,
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.entry,
		.comments-box .comments-heading,
		.commentlist p,
		#commentform input.txt,
		#commentform textarea,
		#commentform #submit {
			font-family: <?php 
				if ( 'Georgia' == $font_stack )
					echo 'Georgia, Palatino, "Palatino Linotype", Times, "Times New Roman", serif;'."\n";
				elseif ( 'Yahei' == $font_stack )
					echo 'Microsoft Yahei,Arial,Verdana;'."\n";
				elseif ( 'Arial' == $font_stack )
					echo 'Arial, "Helvetica Neue", Helvetica, sans-serif;'."\n";
				elseif ( 'Verdana' == $font_stack )
					echo 'Verdana, Geneva, Tahoma, sans-serif;'."\n";
				elseif ( 'Helvetica Neue' == $font_stack )
					echo '"Helvetica Neue", Arial, Helvetica, sans-serif;'."\n";
				elseif ( 'Tahoma' == $font_stack )
					echo 'Tahoma, Geneva, Verdana;'."\n";
				elseif ( 'Times New Roman' == $font_stack )
					echo 'Times, "Times New Roman", Georgia, serif;'."\n";
				elseif ( 'Trebuchet MS' == $font_stack )
					echo '"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;'."\n";
				?>
			}
	</style>

	<?php do_action( 'Basically_add_font_stack', $font_stack );
}
add_action('wp_head', 'Basically_add_font_stack');


################################################################################
// Header script option
################################################################################

function Basically_header_script() {
	$options = Basically_get_theme_options();
	$headerScript = isset($options['header-script'])? $options['header-script']: '';
	
	echo stripslashes($headerScript)."\n";
}
add_action('wp_head', 'Basically_header_script', 9);


################################################################################
// Color schemes option
################################################################################

function Basically_enqueue_color_scheme() {
	$options = Basically_get_theme_options();
	$color_scheme = isset($options['color_scheme'])? $options['color_scheme']: '';

	if ( 'Black' == $color_scheme )
		wp_enqueue_style( 'Black', get_template_directory_uri() . '/layout/black.css', array(), null );
	elseif ( 'Brown' == $color_scheme )
		wp_enqueue_style( 'Brown', get_template_directory_uri() . '/layout/brown.css', array(), null );
	elseif ( 'Green' == $color_scheme )
		wp_enqueue_style( 'Green', get_template_directory_uri() . '/layout/green.css', array(), null );
	elseif ( 'Grey' == $color_scheme )
		wp_enqueue_style( 'Grey', get_template_directory_uri() . '/layout/grey.css', array(), null );
	elseif ( 'Orange' == $color_scheme )
		wp_enqueue_style( 'Orange', get_template_directory_uri() . '/layout/orange.css', array(), null );
	elseif ( 'Pink' == $color_scheme )
		wp_enqueue_style( 'Pink', get_template_directory_uri() . '/layout/pink.css', array(), null );
	elseif ( 'Purple' == $color_scheme )
		wp_enqueue_style( 'Purple', get_template_directory_uri() . '/layout/purple.css', array(), null );
	elseif ( 'Red' == $color_scheme )
		wp_enqueue_style( 'Red', get_template_directory_uri() . '/layout/red.css', array(), null );
	
	do_action( 'Basically_enqueue_color_scheme', $color_scheme );
}
add_action( 'wp_enqueue_scripts', 'Basically_enqueue_color_scheme');


################################################################################
// Layout option
################################################################################

function Basically_layout_add_classes( $existing_classes ) {
	$options = Basically_get_theme_options();
	$current_layout = $options['theme_layout'];

	if ( in_array( $current_layout, array( 'right-sidebar', 'left-sidebar' ) ) )
		$classes = array( 'two-column' );
	else
		$classes = array( 'one-column' );

	if ( 'right-sidebar' == $current_layout )
		$classes[] = 'right-sidebar';
	elseif ( 'left-sidebar' == $current_layout )
		$classes[] = 'left-sidebar';
	else
		$classes[] = $current_layout;

	$classes = apply_filters( 'Basically_layout_add_classes', $classes, $current_layout );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'Basically_layout_add_classes' );


################################################################################
// Tracking code option
################################################################################

function Basically_tracking() {
	$options = Basically_get_theme_options();
	$footercode = isset($options['tracking-script'])? $options['tracking-script']: '';
	
	echo stripslashes($footercode)."\n";
}
add_action('wp_footer', 'Basically_tracking');


################################################################################
// Fixing the Read More in the Excerpts
// This removes the annoying [�] to a Read More link
################################################################################

function basically_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '&nbsp; <a href="'. get_permalink($post->ID) . '" title="Read more '.get_the_title($post->ID).'">Read more &raquo;</a>';
}
add_filter('excerpt_more', 'basically_excerpt_more');


################################################################################
// Remove gallery inline style
################################################################################

function basically_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'basically_remove_gallery_css' );


################################################################################
// Disabling Wp-Pagenavi Style
################################################################################

function my_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );