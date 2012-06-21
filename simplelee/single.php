<?php
/**
 * @package WordPress
 * @subpackage basically
 * The Template for displaying single posts.
 */

get_header(); ?>
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
			
			<h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'basically' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h1>
			
			<div class="entry-meta">
				<?php basically_entry_meta(); ?>
			</div>
			
			<?php get_template_part('includes/single-top-ads'); ?>
			
			<div class="entry-content">
				<?php 
					the_content();
					get_template_part('includes/single-bottom-ads'); 
				?>
			</div>
			
			<?php wp_link_pages( array( 'before' => '<div class="post-pages"><span>' . __( 'Pages:', 'basically' ) . '</span>', 'after' => '</div>', 'pagelink' => '<span>%</span>') ); ?>
		
			<p class="postmetadata">
				<!-- Baidu Button BEGIN -->
					<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
						<a class="bds_qzone"></a>
						<a class="bds_tsina"></a>
						<a class="bds_tqq"></a>
						<a class="bds_renren"></a>
						<a class="bds_t163"></a>
						<a class="bds_tsohu"></a>
						<a class="bds_tieba"></a>
						<a class="bds_kaixin001"></a>
						<a class="bds_douban"></a>
						<a class="bds_hi"></a>
						<span class="bds_more">更多</span>
						<a class="shareCount"></a>
					</div>
				<script type="text/javascript" id="bdshare_js" data="type=tools&amp;mini=1&amp;uid=330595" ></script>
				<script type="text/javascript" id="bdshell_js"></script>
				<script type="text/javascript">
					document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?t=" + new Date().getHours();
				</script>
				<!-- Baidu Button END -->
			</p>
			
		</div><!-- end post_class() -->
		
		<div class="post-nav clearfix">
			<span class="alignleft"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> %title', 'basically' ) ); ?></span>
			<span class="alignright"><?php next_post_link( '%link', __( '%title <span class="meta-nav">&rarr;</span>', 'basically' ) ); ?></span>
		</div>	
		
	<?php comments_template( '', true ); ?>
	
<?php endwhile; endif; ?>
	
<?php get_footer(); ?>