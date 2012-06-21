<?php


################################################################################
// Enqueue Styles
################################################################################

function init_styles() {
	
	// register css style requirements for this theme, only!
	if( !is_admin()){

		wp_register_style('print', get_template_directory_uri() . '/style/print.css', '', '1.0.0', 'print');

		wp_enqueue_style('print');
		
	}
	
}    

if (!is_admin()){
	add_action('init', 'init_scripts', 0);
	add_action('init', 'init_styles', 0);
}


################################################################################
// IE Style
################################################################################
function ie_style() {?>
	<!--[if gte IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style/ie7.css" media="screen" />
	<![endif]-->
<?php }
add_action('wp_head', 'ie_style', 0);