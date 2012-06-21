<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
	<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
		<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'basically' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
		
		<div class="entry-meta">
			<?php basically_entry_meta(); ?>
		</div><!-- end #postmeta -->
		
		<div class="entry-content">
			<?php 
			if( is_home() && is_front_page() ): // only display full content for home page
				the_content( __( '阅读全文 <span class="meta-nav">&rarr;</span>', 'basically' ) );
			else :
				the_excerpt();
			endif; ?>
		</div><!-- end .entry -->
		
		<?php wp_link_pages( array( 'before' => '<div class="post-pages"><span>' . __( 'Pages:', 'basically' ) . '</span>', 'after' => '</div>', 'pagelink' => '<span>%</span>') ); ?>

	</div><!-- end post_class() -->
	
<?php endwhile; else: ?>
	<h2 class="center"><?php _e('Not Found', 'basically'); ?></h2>
	<p class="center"><?php _e('Sorry, but you are looking for something that isnt here.', 'basically'); ?></p>
<?php endif; ?>

<div class="navigation">
	<?php if(!function_exists('wp_pagenavi') || wp_pagenavi() ): ?>
		<div class="alignleft"><?php next_posts_link( __('&larr; 早期文章', 'basically') ); ?></div>
		<div class="alignright"><?php previous_posts_link( __('较新文章 &rarr;', 'basically') ); ?></div>
	<?php endif ?>
</div><!-- end .navigation -->