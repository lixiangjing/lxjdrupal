<?php
/**
 * @package WordPress
 * @subpackage Basically
 * The template for displaying all pages.
 */
?>
<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php edit_post_link( __( '编辑页面', 'basically' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
			
		</div><!-- end post_class() -->
		
		<?php comments_template( '', true ); ?>
		
	<?php endwhile; endif; ?>

<?php get_footer(); ?>