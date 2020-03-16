<?php

use XoopsModules\Happylinux;
use XoopsModules\Rssc;

// $Id: single_feed.php,v 1.1 2011/12/29 14:37:04 ohwada Exp $

// 2007-11-01 K.OHWADA
// happylinux_get_memory_usage_mb()
// enclosure in link table

// 2007-08-01 K.OHWADA
// xoops_module_header

// 2007-06-10 K.OHWADA
// happy_linux_post
// edit button

// 2007-05-20 K.OHWADA
// XOOPS 2.0.16: module name

// 2006-11-08 K.OHWADA
// use basic_highlight

// 2006-09-15 K.OHWADA
// use main_search_title_html
// page title
// highlight_keyword

// 2006-07-10 K.OHWADA
// use happy_linux_post happy_linux_system
// support podcast
// bread crumb

// 2006-06-04 K.OHWADA
// rename file name single.php to single_link.php
// use header.php

//================================================================
// Rss center Module
// 2006-01-01 K.OHWADA
//================================================================

require __DIR__ . '/header.php';
// require_once RSSC_ROOT_PATH . '/class/rssc_view_handler.php';

$viewHandler = Rssc\Helper::getInstance()->getHandler('View', RSSC_DIRNAME);
$confHandler = Rssc\Helper::getInstance()->getHandler('ConfigBasic', RSSC_DIRNAME);
$post        = Happylinux\Post::getInstance();

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$GLOBALS['xoopsOption']['template_main'] = RSSC_DIRNAME . '_single_feed.tpl';
require XOOPS_ROOT_PATH . '/header.php';

$conf = &$confHandler->get_conf();

$fid           = $post->get_get_int('fid');
$keyword_array = $post->get_get_keyword_array();
$urlencode     = $post->get_urlencode_keywords();

$viewHandler->setFlagSanitize(true);    // sanitize
$viewHandler->set_flag_ltype(true);
$viewHandler->set_flag_enclosure(true);
$viewHandler->set_title_html($conf['main_single_title_html']);
$viewHandler->set_content_html($conf['main_single_content_html']);
$viewHandler->set_max_title($conf['main_single_max_title']);
$viewHandler->set_max_content($conf['main_single_max_content']);
$viewHandler->set_max_summary($conf['main_single_max_summary']);
$viewHandler->set_highlight($conf['basic_highlight']);
$viewHandler->set_keyword_array($keyword_array);

$feed  = [];
$link  = [];
$error = '';
$show  = 0;

if ($viewHandler->exists_feed($fid)) {
    $feed = &$viewHandler->get_feed_by_fid($fid);

    if (is_array($feed) && isset($feed['lid'])) {
        $show = 1;
        $link = &$viewHandler->get_link_by_lid($feed['lid']);
    }
}

$xoopsTpl->assign($viewHandler->get_tpl_common_param());

$xoopsTpl->assign('rssc_show', $show);
$xoopsTpl->assign('rssc_error', $error);
$xoopsTpl->assign('link', $link);
$xoopsTpl->assign('feed', $feed);
$xoopsTpl->assign('rssc_keywords', $urlencode);

// page title
$module_name_s = $viewHandler->get_module_name('s');
$xoopsTpl->assign('xoops_pagetitle', $module_name_s . ' - ' . $feed['title']);

$xoopsTpl->assign('execution_time', happylinux_get_execution_time());
$xoopsTpl->assign('memory_usage', happylinux_get_memory_usage_mb());
require XOOPS_ROOT_PATH . '/footer.php';
exit();
// --- main end ---
