<?php
/**
 * @package WordPress
 * @subpackage Basically
 * @template Author Archive pages
 */
?>
<?php get_header(); ?>

	<div class="author-info">
		<?php the_post(); ?>
			
		<h1 class="page-title author"><?php printf( __( '作者专栏：%s', 'basically' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
		<div id="author-wrap"> 
			<div class="inner-author-wrap clearfix">
				<span class="author-photo"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 60); ?></span>
				<span class="author-desc"><?php the_author_meta( 'description' ); ?></span>
			</div>
		</div><!-- end .author-wrap -->
	</div><!-- end .author-info -->
		
	<?php 
	rewind_posts();
	get_template_part('loop'); ?>
	
<?php get_footer(); ?>