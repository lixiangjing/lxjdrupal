<?php
/**
 * @package WordPress
 * @subpackage Pink Touch 2
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', get_post_format() ); ?>

	<div class="pagination">
		<p class="clearfix">
			<?php previous_post_link( '%link', __( '<span class="older"><span class="meta-nav">&larr;</span>%title</span>', 'pinktouch' ) ); ?>
			<?php next_post_link( '%link', __( '<span class="newer">%title<span class="meta-nav">&rarr;</span></span>', 'pinktouch' ) ); ?>
		</p>
	</div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>