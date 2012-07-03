<?php
/**
 * 老李DIY别人的Typecho主题，个人比较喜欢。
 * 
 * @package SimpleMe
 * @author 老李
 * @version 1.0
 * @link http://idc.wowcms.com/
 */
$this->need('header.php');
?>
<?php while($this->next()): ?>
	<section class="post">
		<header class="post_head">
			<p class="date"><?php $this->date('Y-m-d'); ?></p>
			<h2><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
		</header>
		<article class="post_artice">
			<?php $this->content('阅读更多...'); ?>
		</article>
		<p class="cate"><?php $this->category(','); ?></p>
	</section>
<?php endwhile; ?>
<?php $this->pageNav(); ?>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
