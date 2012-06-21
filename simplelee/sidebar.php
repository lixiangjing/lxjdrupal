<?php
/**
 * @package WordPress
 * @subpackage Basically
 * The template for displaying widget areas.
 */
 
$options = Basically_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'one-column' != $current_layout ) :
?>

<div id="sidebar" class="clearfix">

	<div class="sidebar-inner">
		<ul>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
			<?php endif; ?>
		</ul>
	</div>

	<div class="sidebar-inner">
	<ul>
		<li class="widget widget_recent_entries">		
		<div class="widget-title">老李唠叨</div>
			 <?php query_posts('showposts=10&cat=1'); ?>
			  <ul>
				 <?php while (have_posts()) : the_post(); ?>
				   <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>
			  </ul>
		</li>
		</ul>
	</div>

	<div class="sidebar-inner">
	<ul>
		<li class="widget widget_recent_entries">		
		<div class="widget-title">开源Linux</div>
			 <?php query_posts('showposts=10&cat=11'); ?>
			  <ul>
				 <?php while (have_posts()) : the_post(); ?>
				   <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>
			  </ul>
		</li>
		</ul>
	</div>

	<div class="sidebar-inner">
	<ul>
		<li class="widget widget_recent_entries">		
		<div class="widget-title">微软Windows</div>
			 <?php query_posts('showposts=10&cat=13'); ?>
			  <ul>
				 <?php while (have_posts()) : the_post(); ?>
				   <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>
			  </ul>
		</li>
		</ul>
	</div>

	<div class="sidebar-inner">
	<ul>
		<li class="widget widget_recent_entries">		
		<div class="widget-title">站长生活</div>
			 <?php query_posts('showposts=10&cat=3'); ?>
			  <ul>
				 <?php while (have_posts()) : the_post(); ?>
				   <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>
			  </ul>
		</li>
		</ul>
	</div>

	<div class="sidebar-inner">
	<ul>
		<li class="widget widget_recent_entries">		
		<div class="widget-title">硬件学堂</div>
			 <?php query_posts('showposts=10&cat=15'); ?>
			  <ul>
				 <?php while (have_posts()) : the_post(); ?>
				   <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				 <?php endwhile; ?>
			  </ul>
		</li>
		</ul>
	</div>
		
</div><!-- end #sidebar -->
<?php endif; ?>