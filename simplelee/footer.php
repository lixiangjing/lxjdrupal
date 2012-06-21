	</div><!-- end #content & #full-width-content -->
	<?php 
	if(!is_attachment() && !is_page_template('full-width-page.php'))
	get_sidebar(); ?>
</div><!-- end #container -->

<?php
/**
 * @package WordPress
 * @subpackage Basically
 * The template for displaying the footer.
 */
?>
<div id="footer" class="clearfix">

	<?php get_sidebar('footer'); ?> <!-- call sidebar footer -->
	
	<div class="credits clearfix">
		<div id="footer-left">
			<p><?php _e('驱动平台：', 'basically'); ?> <a href="http://idc.wowcms.com/hi/" target="_blank" title="合租VPS主机">站长空间</a></p>
		</div>
		
		<div id="footer-right">
			<p>&copy;  Copyright <?php echo date('Y'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a></p>
		</div>
	</div>

</div><!-- end #footer -->

</div><!-- end #wrapper -->
<!-- http://weibo.com/xiangjingli -->
</body>
</html>