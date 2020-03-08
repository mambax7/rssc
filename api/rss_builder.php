<?php
// $Id: rss_builder.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

// 2008-02-24 K.OHWADA
// cannot show feed in weblinks
// rssc_plugin.php

//=========================================================
// RSS Center Module
// 2008-01-18 K.OHWADA
//=========================================================

// dir name
$RSSC_DIRNAME = basename( dirname(__DIR__) );

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_viewer.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_builder.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_constant.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_rss_constant.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_get_handler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_plugin.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_view_param.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_viewHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_build_rssc.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/plugins/rssc_plugin_base.php';

?>
