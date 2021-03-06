<?php

use XoopsModules\Happylinux;

// $Id: map.php,v 1.3 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// remove rssc_map.php

// 2012-03-01 K.OHWADA
// Rssc\Map::getInstance( RSSC_DIRNAME )

// 2009-05-17 K.OHWADA
// Notice [PHP]: Undefined variable: feed_list

//================================================================
// Rss center Module
// 2009-02-20 K.OHWADA
//================================================================

require __DIR__ . '/header.php';
// require_once RSSC_ROOT_PATH . '/class/rssc_view_handler.php';
// require_once RSSC_ROOT_PATH . '/class/Rssc\Block_map.php';

$viewHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('View', RSSC_DIRNAME);
$confHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('ConfigBasic', RSSC_DIRNAME);
$map_class   = Rssc\Map::getInstance(RSSC_DIRNAME);
$icon_class  = rssc_icon::getInstance();
$post        = Happylinux\Post::getInstance();
$pagenavi    = Happylinux\Pagenavi::getInstance();

$map_div_id = RSSC_DIRNAME . '_map';
$map_func   = RSSC_DIRNAME . '_map_load';

// --- template start ---
// xoopsOption[template_main] should be defined before including header.php
$GLOBALS['xoopsOption']['template_main'] = RSSC_DIRNAME . '_map.tpl';
require XOOPS_ROOT_PATH . '/header.php';

$conf           = &$confHandler->get_conf();
$feed_limit     = $conf['main_map_perpage'];
$show_thumb     = $conf['main_map_show_thumb'];
$show_site      = $conf['main_map_show_site'];
$show_icon      = $conf['main_map_show_icon'];
$webmap_dirname = $conf['webmap_dirname'];

$link_show  = 0;
$feed_show  = 0;
$lid        = 0;
$channel    = [];
$feeds      = [];
$error      = '';
$reason     = '';
$navi       = '';
$feed_total = 0;
$show_map   = 0;
$map_js     = null;
$ele_id_map = null;
$feed_list  = null;
$icon_list  = null;

$ret = $map_class->init_map($webmap_dirname);
if ($ret) {
    $viewHandler->setFeedOrder($conf['main_map_order']);
    $viewHandler->setFutureDays($conf['basic_future_days']);
    $viewHandler->setFlagSanitize(true);
    $viewHandler->set_flag_ltype(true);
    $viewHandler->set_flag_enclosure(true);
    $viewHandler->set_title_html($conf['main_map_title_html']);
    $viewHandler->set_content_html($conf['main_map_content_html']);
    $viewHandler->set_max_title($conf['main_map_max_title']);
    $viewHandler->set_max_content($conf['main_map_max_content']);
    $viewHandler->set_max_summary($conf['main_map_max_summary']);

    $pagenavi->setPerpage($feed_limit);
    $pagenavi->getGetPage();

    $where = ' (( geo_lat != 0 ) OR ( geo_long != 0 )) ';

    $feed_total = $viewHandler->get_feed_count_by_where($where);

    $pagenavi->setTotal($feed_total);
    $feed_start = $pagenavi->calcStart();

    $feeds = $viewHandler->get_feeds_by_where($where, $feed_limit, $feed_start);

    if (is_array($feeds) && count($feeds)) {
        $feed_show = 1;

        $map_class->set_map_div_id($map_div_id);
        $map_class->set_map_func($map_func);

        $show_map = $map_class->fetch_map($feeds);

        $param     = [
            'feeds'      => $feeds,
            'show_thumb' => $show_thumb,
            'show_icon'  => $show_icon,
            'show_site'  => $show_site,
            'keywords'   => null,
        ];
        $feed_list = $viewHandler->fetch_tpl_feed_list($param);
    }

    $url  = RSSC_URL . '/map.php';
    $navi = $pagenavi->build($url);

    if ($show_icon) {
        $icon_list = $icon_class->build_template_icon_list(RSSC_DIRNAME);
    }
} else {
    $reason = 'NOT exist webmap module';
}

$xoopsTpl->assign('show_map', $show_map);
$xoopsTpl->assign('map_div_id', $map_div_id);
$xoopsTpl->assign('map_func', $map_func);

// Notice [PHP]: Undefined variable: feed_list
$xoopsTpl->assign('feed_list', $feed_list);

$xoopsTpl->assign('icon_list', $icon_list);

$xoopsTpl->assign($viewHandler->get_tpl_common_param());

$xoopsTpl->assign('lang_total', sprintf(_RSSC_THEREARE, $feed_total));

$xoopsTpl->assign('link_show', $link_show);
$xoopsTpl->assign('feed_show', $feed_show);
$xoopsTpl->assign('rssc_error', $error);
$xoopsTpl->assign('rssc_reason', $reason);
$xoopsTpl->assign('rssc_navi', $navi);

$xoopsTpl->assign('execution_time', happylinux_get_execution_time());
$xoopsTpl->assign('memory_usage', happylinux_get_memory_usage_mb());
require XOOPS_ROOT_PATH . '/footer.php';
exit();
// --- main end ---
