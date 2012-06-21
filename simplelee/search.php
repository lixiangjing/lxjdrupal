<?php
/**
 * @package WordPress
 * @subpackage Basically
 * The template for displaying Search Results pages.
 */
?>
<?php get_header(); ?>

	<h1 class="page-title"><?php printf( __( '%s的搜索结果', 'basically' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		
	<?php get_template_part('loop'); ?>

<?php get_footer(); ?>