<?php
// $Id: manage.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

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
require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/functions.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/rss_constant.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/time.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/error.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/strings.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/basic_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/object.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/object_handler.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/include/rssc_constant.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/include/rssc_rss_constant.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/include/rssc_get_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_error.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_config_basic_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_link_basic_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_link_handler.php';
//require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/class/rssc_xml_handler.php';
