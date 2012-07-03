<!DOCTYPE html>
<html>
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="content-type" content="text/html; charset=<?php $this->options->charset(); ?>" />
    <link rel="shortcut icon" href="http://idc.wowcms.com/hi/favicon.ico" />
    <title><?php $this->archiveTitle(' &raquo; ', '', ' - '); ?><?php $this->options->title(); ?></title>
    <link rel="stylesheet" type="text/css" media="all" href="<?php $this->options->themeUrl('style.css'); ?>" />
    <!--[if gte IE 7]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php $this->header(); ?>
</head>

<body>
<div id="wrap">
    <header id="header">

    </header>
	<div id="top">
		<a id="lnkBlogLogo"></a>
	    <div id="logo">
    	    <h1>
                <a href="<?php $this->options->siteUrl(); ?>">
                    <?php if ($this->options->logoUrl): ?>
                    <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" />
                    <?php else : ?>
                        <?php $this->options->title() ?>
                    <?php endif; ?>
                </a>
            </h1>
        </div>
    <nav id="nav">
        <ul id="menu">
            <li<?php if($this->is('index')): ?> class="current"<?php endif; ?>><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
			<?php while($pages->next()): ?>
			<li<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?>><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
			<?php endwhile; ?>
        </ul>
		<form id="search" method="post" action="<?php $this->options->siteUrl(); ?>">
            <input type="text" name="s" class="text" size="20" required />
            <button type="submit">搜索</button>
        </form>
    </nav>
	</div>