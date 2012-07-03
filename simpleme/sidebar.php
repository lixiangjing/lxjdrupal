<div id="sidebar">
    <div class="side_box side_1">
        <?php if (empty($this->options->sidebarBlock) || in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
	    <div class="widget">
			<h3><?php _e('最新文章'); ?></h3>
            <ul>
                <?php $this->widget('Widget_Contents_Post_Recent')
                ->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
            </ul>
	    </div>
        <?php endif; ?>
    </div>
	<div class="side_box side_2">
		        <?php if (empty($this->options->sidebarBlock) || in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
	    <div class="widget">
			<h3><?php _e('最近回复'); ?></h3>
            <ul>
            <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
            <?php while($comments->next()): ?>
                <li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(50, '...'); ?></li>
            <?php endwhile; ?>
            </ul>
	    </div>
        <?php endif; ?>
    </div>
    <div class="side_box side_3">
        <?php if (empty($this->options->sidebarBlock) || in_array('ShowCategory', $this->options->sidebarBlock)): ?>
        <div class="widget">
			<h3><?php _e('分类'); ?></h3>
            <ul>
                <?php $this->widget('Widget_Metas_Category_List')
                ->parse('<li><a href="{permalink}">{name}</a> ({count})</li>'); ?>
            </ul>
		</div>
        <?php endif; ?>
	    <ul class="side_4">
            <li>
                <?php if ($this->options->weibo): ?>
                    <div class="icon weibo"><a href="<?php $this->options->weibo() ?>" title="新浪微博" target="_blank"></a></div>
                <?php endif; ?>
                <?php if ($this->options->tqq): ?>
                    <div class="icon tqq"><a href="<?php $this->options->tqq() ?>" title="腾讯微博" target="_blank"></a></div>
                <?php endif; ?>
            </li>
            <li>
                <div class="rss">
                    <?php if ($this->options->rssUrl): ?>
                        <a href="<?php $this->options->rssUrl() ?>">文章RSS</a>
                    <?php else : ?>
                        <a href="<?php $this->options->feedUrl(); ?>">文章RSS</a>
                    <?php endif; ?>
                </div>
                <div class="rss"><a href="<?php $this->options->commentsFeedUrl(); ?>">评论RSS</a></div>
            </li>
        </ul>
    </div>
</div>
