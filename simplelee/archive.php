<?php
/**
 * @package WordPress
 * @subpackage Basically
 * The template for displaying Archive, Category, Tag & Date Archive.
 */
?>
<?php get_header(); ?>

	<h1 class="page-title">
		<?php if ( is_day() ) : ?>
			<?php printf( __( 'Daily Archives: %s', 'basically' ), '<span>' . get_the_date() . '</span>' ); ?>
		<?php elseif ( is_month() ) : ?>
			<?php printf( __( 'Monthly Archives: %s', 'basically' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'basically' ) ) . '</span>' ); ?>
		<?php elseif ( is_year() ) : ?>
			<?php printf( __( 'Yearly Archives: %s', 'basically' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'basically' ) ) . '</span>' ); ?>
		<?php elseif ( is_category() ) : ?>
			<?php printf( __( '分类归档：%s', 'basically' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
		<?php elseif ( is_tag() ) : ?>
			<?php printf( __( 'Tag Archives: %s', 'basically' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
		<?php else : ?>
			<?php _e( 'Blog Archives', 'basically' ); ?>
		<?php endif; ?>
	</h1>

<?php get_template_part('loop'); ?>
	
<?php get_footer(); ?>