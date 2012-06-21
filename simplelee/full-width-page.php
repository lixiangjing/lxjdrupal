<?php
/*
Template Name: Full Width Page
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link href="http://idc.wowcms.com/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<style type="text/css">
<!--
body{font:14px Verdana,Arial,Helvetica,sans-serif;background:#eee;margin:0;padding:0;color:#000}ul,ol,dl{padding:0;margin:0}h1,h2,h3,h4,h5,h6,p{margin-top:0;padding-right:15px;padding-left:15px}a img{border:none}a:link{color:#1982d1;text-decoration:underline}a:visited{color:#1982d1;text-decoration:underline}a:hover,a:active,a:focus{text-decoration:none}.container{width:960px;background:#FFF;margin:0 auto}.header{background:#e2e2e2;text-align:center;}.header span{font-size:28px;font-style:bold;padding-right:15px;padding-left:15px;font-weight:600;}.header a,.header a:visited{text-decoration:none;}.content{padding:10px 150px;width:660px;}.content ul,.content ol{list-style:none;padding:0 15px 15px 18px;}.content li{margin-bottom:5px;}.content p{line-height:24px;}.footer{padding:10px 0;background:#e2e2e2;position:relative;clear:both;text-align:center;}-->
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <span><a href="http://idc.wowcms.com/hi/" title="CMS资讯网博客社区">CMS资讯网博客社区</a></span>
    <!-- 页面头部区域 -->
  </div>
  <div class="content">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
         <h1><?php the_title(); ?></h1>
           <?php the_content(); ?>
      <?php endwhile; endif; ?>
    <!--页面主题内容-->
    <h2>老李唠叨</h2>
     <?php query_posts('showposts=10&cat=1'); ?>
		  <ul>
			 <?php while (have_posts()) : the_post(); ?>
			   <li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
			 <?php endwhile; ?>
		  </ul>
    <!-- 页面内容主题 -->
  </div>
  <div class="footer">
    <p>内容驱动平台：<a href="http://www.wowcms.com/"  target="_blank">CMS资讯网</a> © 2010-2012 <a href="http://www.miibeian.gov.cn" target="_blank" rel="nofollow">京ICP备11019381号</a></p>
      <!-- 页面底部内容  -->
  </div>
  <!-- 页面内容框架 -->
</div>
</body>
</html>