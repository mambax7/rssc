<?php
// $Id: refresh.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

// 2008-01-20 K.OHWADA
// rssc_plugin_base.php

// 2007-10-10 K.OHWADA
// rssc_plugin.php

//================================================================
// RSS Center Module
// use for refresh.php
// 2007-06-01 K.OHWADA
//================================================================

// dir name
$RSSC_DIRNAME = basename( dirname(__DIR__) );

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_parser.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/extract_word.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/kakasi.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/file.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_constant.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_rss_constant.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_get_handler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_xml_utility.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_config_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_link_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_xml_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_feed_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_black_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_white_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_word_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_filterHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_log_file.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_plugin.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_refreshHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/plugins/rssc_plugin_base.php';

