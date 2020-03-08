<?php
// $Id: manage.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

//================================================================
// RSS Center Module
// use for viewHandler.php
// 2007-06-01 K.OHWADA
//================================================================

// dir name
$RSSC_DIRNAME = basename( dirname(__DIR__) );

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/rss_constant.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/time.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/objectHandler.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_constant.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_rss_constant.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_get_handler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_error.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_config_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_link_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_linkHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_xmlHandler.php';

?>
