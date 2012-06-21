<?php
/**
 * The template for displaying main functions
 *
 * @package WordPress
 * @subpackage Basically
 * @since Basically 1.0.3
 */
 
add_action( 'after_setup_theme', 'basically_setup' );
if ( ! function_exists( 'basically_setup' ) ):

function basically_setup() {
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	 if ( ! isset( $content_width ) ) $content_width = 620;
	
	/* Make Basically available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Basically, use a find and replace
	 * to change 'basically' to the name of your theme in all the template files.
	 */
	 load_theme_textdomain( 'basically', get_template_directory() . '/languages' );

		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
			
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style('style/editor-style.css');
	
	// Remove some bad info from head tag.
        remove_action('wp_head', 'feed_links',2 );
        remove_action('wp_head','feed_links_extra',3 );
        remove_action('wp_head','rsd_link');
        remove_action('wp_head','wlwmanifest_link');
        remove_action('wp_head','index_rel_link');
        remove_action('wp_head','parent_post_rel_link',10, 0);
        remove_action('wp_head','start_post_rel_link',10,0);
        remove_action('wp_head','adjacent_posts_rel_link_wp_head',10,0);
        remove_action('wp_head','rel_canonical');
        remove_action('wp_head','wp_print_styles', 8);
        remove_action('wp_head','wp_shortlink_wp_head', 10, 0); 
	
	// Add support for custom backgrounds
	add_custom_background();
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( 
		array(
			'primary' => __( 'Primary Navigation', 'basically' ),
			'secondary' => __( 'Secondary Navigation', 'basically' ) 
		) 
	);
	
	// This theme uses Featured Images (also known as post thumbnails)
	add_theme_support( 'post-thumbnails' );
	// Add custom image sizes
	add_image_size( '150px' , 150, 150, true ); // 150px thumbnail
	
	// Load the theme options
	require_once get_template_directory() . '/options/basically-theme-options.php';
	
	// Load the theme functions
	require_once get_template_directory() . '/functions/basically-theme-functions.php';
	
	// Add custom header image
	define('HEADER_TEXTCOLOR', '');
	
	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	define('HEADER_IMAGE', '');
	
	// The height and width of your custom header.
	// Add a filter to basically_header_image_width and rumputhijau_header_image_width to change these values.
	define('HEADER_IMAGE_WIDTH', apply_filters( 'basically_header_image_width', 950) );
	define('HEADER_IMAGE_HEIGHT', apply_filters( 'basically_header_image_height', 135) );
	
	// no text in the custom header
	define('NO_HEADER_TEXT', true );

	// Styles the header image
	function Basically_admin_header_style() { ?>
	<style type="text/css">
	#headimg {
		background:#fff url(<?php header_image() ?>) no-repeat center;  
		height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
		width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	}
	</style>
	<?php
	}
	function Basically_header_style() { ?>
	<style type="text/css">
		#header {
			background-image:url(<?php header_image(); ?>);
			background-repeat: no-repeat;
			background-position: center;
		}
	</style>
	<?php
	}
	if ( function_exists('add_custom_image_header') ) {
		add_custom_image_header('Basically_header_style', 'Basically_admin_header_style');
	}
	
}
endif; // end basically_setup


	
################################################################################
// Extra functions
################################################################################

require_once get_template_directory() . '/functions/basically-extensions.php'; // theme extensions
require_once get_template_directory() . '/functions/basically-theme-enqueue.php'; // theme enqueue


################################################################################
// Add theme sidebars
################################################################################

if (function_exists('register_sidebar'))
{
    register_sidebar(array(
		'id' 			=> 'sidebar-1',
		'name'			=> __( 'Sidebar', 'basically' ),
		'description' 	=> __( 'This sidebar appears on the right side of your site', 'basically' ),
		'before_title'	=> '<div class="widget-title">',
		'after_title'	=> '</div>',
    ));	
	
}


################################################################################
// Display entry meta when applicable
################################################################################

if ( ! function_exists( 'basically_entry_meta' ) ) :

function basically_entry_meta(){
    printf( __('<span class="author vcard">博主：%3$s</span> - <span class="published entry-date" datetime="%4$s" pubdate>%5$s</span>', 'basically'),
		get_author_posts_url( get_the_author_meta( 'ID' ) ),
		esc_attr( sprintf( __( '%s的所有文章', 'basically' ), get_the_author() ) ),
		get_the_author(),
		esc_attr( get_the_time( 'c' ) ),
		esc_html( get_the_date() ),
		'entry-utility-prep entry-utility-prep-cat-links',
		get_the_category_list(', '),
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( '%s', 'basically' ), the_title_attribute( 'echo=0' ) ) )
	); 
}
endif;

?>
