<?php
// $Id: headline.php.\040ORIGINAL\0401.10.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2009-02-20 K.OHWADA
// rssc_map.php

// 2007-11-01 K.OHWADA
// happy_linux_get_memory_usage_mb()
// enclosure in link table

// 2007-08-01 K.OHWADA
// xoops_module_header
// Site Description

// 2007-06-01 K.OHWADA
// page navi
// use api/refresh.php

// 2007-05-20 K.OHWADA
// XOOPS 2.0.16: module name

// 2006-09-15 K.OHWADA
// use main_search_title_html

// 2006-07-10 K.OHWADA
// use happy_linux_post happy_linux_system
// support podcast
// bread crumb

// 2006-06-04 K.OHWADA
// use header.php
// suppress Notice Undefined offset: 0

// 2006-04-16 K.OHWADA
// BUG 3864: suppress Notice Undefined offset: 0

//================================================================
// Rss center Module
// 2006-01-01 K.OHWADA
//================================================================

require __DIR__ . '/header.php';

require_once RSSC_ROOT_PATH . '/api/refresh.php';
require_once RSSC_ROOT_PATH . '/class/rssc_headlineHandler.php';
require_once RSSC_ROOT_PATH . '/class/rssc_viewHandler.php';
require_once RSSC_ROOT_PATH . '/class/rssc_map.php';

$headlineHandler = &rssc_getHandler('headline', RSSC_DIRNAME);
$viewHandler = &rssc_getHandler('view', RSSC_DIRNAME);
$confHandler = &rssc_getHandler('config_basic', RSSC_DIRNAME);
$post = &happy_linux_post::getInstance();
$pagenavi = &happy_linux_pagenavi::getInstance();
$map_class = &rssc_map::getInstance();

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$GLOBALS['xoopsOption']['template_main'] = RSSC_DIRNAME . '_headline.html';
require XOOPS_ROOT_PATH . '/header.php';

$conf = &$confHandler->get_conf();
$link_limit = $conf['main_headline_links_perpage'];
$feed_limit = $conf['main_headline_feeds_perpage'];
$show_thumb = $conf['main_headline_show_thumb'];
$webmap_dirname = $conf['webmap_dirname'];

$lid_get = $post->get_get_int('lid');

$viewHandler->setFeedOrder($conf['main_headline_order']);
$viewHandler->setFutureDays($conf['basic_future_days']);
$viewHandler->setFlagSanitize(true);
$viewHandler->set_flag_ltype(true);
$viewHandler->set_flag_enclosure(true);
$viewHandler->set_title_html($conf['main_headline_title_html']);
$viewHandler->set_content_html($conf['main_headline_content_html']);
$viewHandler->set_max_title($conf['main_headline_max_title']);
$viewHandler->set_max_content($conf['main_headline_max_content']);
$viewHandler->set_max_summary($conf['main_headline_max_summary']);

$pagenavi->setPerpage($feed_limit);
$pagenavi->getGetPage();

$link_show = 0;
$feed_show = 0;
$lid = 0;
$channel = [];
$feeds = [];
$error = '';
$navi = '';
$feed_total = 0;
$feed_list = null;
$show_title_map = false;

$ret = $map_class->init($webmap_dirname);
if ($ret) {
    $show_title_map = true;
}

if (!$headlineHandler->refresh_headline($link_limit)) {
    $error = $headlineHandler->getErrors('s');
}

$links = &$headlineHandler->get_headline_links($link_limit);

if ($lid_get > 0) {
    $lid = $lid_get;
}
// suppress Notice Undefined offset: 0
elseif (isset($links[0]['lid'])) {
    $lid = $links[0]['lid'];
}

if ($viewHandler->exists_link($lid)) {
    foreach ($links as $link) {
        $xoopsTpl->append('links', $link);
    }

    $channel = &$viewHandler->get_link_by_lid($lid);

    if (is_array($channel) && (count($channel) > 0)) {
        $link_show = 1;
        $xoopsTpl->assign('channel', $channel);
    }

    $rss_channel = &$viewHandler->_linkHandler->get_channel_by_lid($lid);
    $xoopsTpl->assign('rss_channel', $rss_channel);

    $feed_total = $viewHandler->get_feed_count_by_lid($lid);

    $pagenavi->setTotal($feed_total);
    $feed_start = $pagenavi->calcStart();

    $feeds = &$viewHandler->get_feeds_by_lid($lid, $feed_limit, $feed_start);

    if (is_array($feeds) && count($feeds)) {
        $feed_show = 1;

        $param = [
            'feeds' => $feeds ,
            'show_thumb' => $show_thumb ,
            'show_icon' => false ,
            'show_site' => false ,
            'keywords' => null ,
        ];
        $feed_list = $viewHandler->fetch_tpl_feed_list($param);
    }

    $url = RSSC_URL . '/headline.php?lid=' . $lid;
    $navi = $pagenavi->build($url);
}

$xoopsTpl->assign($viewHandler->get_tpl_common_param());

$xoopsTpl->assign('lang_total', sprintf(_RSSC_THEREARE, $feed_total));

$xoopsTpl->assign('link_show', $link_show);
$xoopsTpl->assign('feed_show', $feed_show);
$xoopsTpl->assign('feed_list', $feed_list);
$xoopsTpl->assign('rssc_error', $error);
$xoopsTpl->assign('rssc_navi', $navi);
$xoopsTpl->assign('show_title_map', $show_title_map);

$xoopsTpl->assign('execution_time', happy_linux_get_execution_time());
$xoopsTpl->assign('memory_usage', happy_linux_get_memory_usage_mb());
require XOOPS_ROOT_PATH . '/footer.php';
exit();
// --- main end ---
