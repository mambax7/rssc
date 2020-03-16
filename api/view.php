<?php
// $Id: view.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

// 2009-03-01 K.OHWADA
// image_size.php

// 2008-01-20 K.OHWADA
// rssc_plugin_base.php

//================================================================
// RSS Center Module
// use for view_handler.php
// 2007-06-01 K.OHWADA
//================================================================

// dir name
$RSSC_DIRNAME = basename(dirname(__DIR__));

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/rss_viewer.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/functions.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/basic_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/image_size.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/include/rssc_constant.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/include/rssc_rss_constant.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/include/rssc_get_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_config_basic_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_link_basic_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_feed_basic_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_plugin.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_view_param.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_view_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/plugins/rssc_plugin_base.php';
