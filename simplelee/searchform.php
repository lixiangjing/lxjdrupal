<?php
/**
 * @package WordPress
 * @subpackage Basically
 * The template for displaying search form.
 */
?>
<div class="search" class="clearfix">
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( '更多文章请搜索 ...', 'basically' ); ?>" />
		<input class="submit" type="image" src="<?php echo get_template_directory_uri(); ?>/images/icon_search.png" value="<?php esc_attr_e( 'Search', 'basically' ); ?>" />
	</form>
</div><!-- end #search -->