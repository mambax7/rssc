<?php

use XoopsModules\Happylinux;
use XoopsModules\Rssc;

// $Id: header.php,v 1.2 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// rssc_map.php

// 2009-02-20 K.OHWADA
// blocks.php

// 2008-01-20 K.OHWADA
// check happy_linux version in the beginning

// 2007-11-11 K.OHWADA
// memory.php

// 2007-06-01 K.OHWADA
// api/view.php

// 2006-09-10 K.OHWADA
// use RSSC_HAPPYLINUX_VERSION

// 2006-07-10 K.OHWADA
// require happy_linux module

// 2006-06-04 K.OHWADA
// this is new file

//================================================================
// Rss center Module
// 2006-06-04 K.OHWADA
//================================================================

// system files
require dirname(dirname(__DIR__)) . '/mainfile.php';
require XOOPS_ROOT_PATH . '/header.php';

$moduleDirName = basename(__DIR__);

/** @var \XoopsModules\Rssc\Helper $helper */
$helper = \XoopsModules\Rssc\Helper::getInstance();

$modulePath = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName;

$myts = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoTheme']) || !is_object($GLOBALS['xoTheme'])) {
    require $GLOBALS['xoops']->path('class/theme.php');
    $GLOBALS['xoTheme'] = new \xos_opal_Theme();
}

//Handlers
//$XXXHandler = xoops_getModuleHandler('XXX', $moduleDirName);

// Load language files
$helper->loadLanguage('main');
$helper->loadLanguage('global');
//$helper->loadLanguage('global','happylinux');
//$helper->loadLanguage('main','happylinux');

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
if (!defined('RSSC_DIRNAME')) {
    define('RSSC_DIRNAME', $xoopsModule->dirname());
}

if (!defined('RSSC_ROOT_PATH')) {
    define('RSSC_ROOT_PATH', XOOPS_ROOT_PATH . '/modules/' . RSSC_DIRNAME);
}

if (!defined('RSSC_URL')) {
    define('RSSC_URL', XOOPS_URL . '/modules/' . RSSC_DIRNAME);
}

require_once RSSC_ROOT_PATH . '/include/rssc_version.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
if (!file_exists(XOOPS_ROOT_PATH . '/modules/happylinux/include/version.php')) {
    require XOOPS_ROOT_PATH . '/header.php';
    xoops_error('require happy_linux module');
    require XOOPS_ROOT_PATH . '/footer.php';
    exit();
}

require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/version.php';

// check happy_linux version
if (HAPPYLINUX_VERSION < RSSC_HAPPYLINUX_VERSION) {
    $msg = 'require happy_linux module v' . RSSC_HAPPYLINUX_VERSION . ' or later';
    require XOOPS_ROOT_PATH . '/header.php';
    xoops_error($msg);
    require XOOPS_ROOT_PATH . '/footer.php';
    exit();
}

// start execution time
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/time.php';
$happy_linux_time = \XoopsModules\Happylinux\Time::getInstance(true);

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
require_once RSSC_ROOT_PATH . '/api/view.php';
// require_once RSSC_ROOT_PATH . '/class/rssc_icon.php';
// require_once RSSC_ROOT_PATH . '/class/Rssc\Block_map.php';
// require_once RSSC_ROOT_PATH . '/class/rssc_map.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/rss_builder.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/language.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/locate.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/multibyte.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/search.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/memory.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/highlight.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/post.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/remote_file.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/convert_encoding.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/pagenavi.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/search.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/image_size.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];

// system search
if (file_exists(XOOPS_ROOT_PATH . '/language/' . $XOOPS_LANGUAGE . '/search.php')) {
    require_once XOOPS_ROOT_PATH . '/language/' . $XOOPS_LANGUAGE . '/search.php';
} else {
    require_once XOOPS_ROOT_PATH . '/language/english/search.php';
}

// blocks.php
if (file_exists(RSSC_ROOT_PATH . '/language/' . $XOOPS_LANGUAGE . '/blocks.php')) {
    require_once RSSC_ROOT_PATH . '/language/' . $XOOPS_LANGUAGE . '/blocks.php';
} else {
    require_once RSSC_ROOT_PATH . '/language/english/blocks.php';
}

// compatible
require_once RSSC_ROOT_PATH . '/language/compatible.php';
