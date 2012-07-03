<?php

function themeConfig($form) {

    $rssUrl = new Typecho_Widget_Helper_Form_Element_Text('rssUrl', NULL, NULL, _t('自定义RSS地址'), _t('在这里填入自定义的RSS地址，比如通过FeedSky烧录的地址以方便统计数据'));
    $form->addInput($rssUrl);

    $weibo = new Typecho_Widget_Helper_Form_Element_Text('weibo', NULL, NULL, _t('新浪微博地址'));
    $form->addInput($weibo);

    $tqq = new Typecho_Widget_Helper_Form_Element_Text('tqq', NULL, NULL, _t('腾讯微博地址'));
    $form->addInput($tqq);

}
