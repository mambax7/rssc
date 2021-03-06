<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: admin_header.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2008-01-20 K.OHWADA
// Rssc\Plugin.php
// check happy_linux version in the beginning

// 2007-11-11 K.OHWADA
// memory.php

// 2007-06-01 K.OHWADA
// Rssc\Xml_handler.php rssc_word_handler.php

// 2006-09-10 K.OHWADA
// use RSSC_HAPPYLINUX_VERSION

// 2006-07-10 K.OHWADA
// require happy_linux module

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include dirname(__DIR__) . '/preloads/autoloader.php';

require  dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
//require $GLOBALS['xoops']->path('www/class/xoopsformloader.php');
require  dirname(__DIR__) . '/include/common.php';

$moduleDirName = basename(dirname(__DIR__));

/** @var \XoopsModules\Rssc\Helper $helper */
$helper = \XoopsModules\Rssc\Helper::getInstance();
// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
$helper->loadLanguage('common');

/** @var \Xmf\Module\Admin $adminObject */
$adminObject = \Xmf\Module\Admin::getInstance();

//---------------------------------------------------------
// system
//---------------------------------------------------------

// admin check
if (!is_object($xoopsUser)) {
    die('you must login');
}

if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
    die('you are not admin');
}

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
    xoops_cp_header();
    xoops_error('require happy_linux module');
    xoops_cp_footer();
    exit();
}

require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/version.php';

// check happy_linux version
if (HAPPYLINUX_VERSION < RSSC_HAPPYLINUX_VERSION) {
    $msg = 'require happy_linux module v' . RSSC_HAPPYLINUX_VERSION . ' or later';
    xoops_cp_header();
    xoops_error($msg);
    xoops_cp_footer();
    exit();
}

// start execution time
// require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/time.php';
$happy_linux_time = \XoopsModules\Happylinux\Time::getInstance();

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
require_once RSSC_ROOT_PATH . '/api/manage.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/multibyte.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/search.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/gtickets.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/memory.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/language.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/admin_menu.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/post.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/system.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/remote_file.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/convert_encoding.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/html.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/form.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/form_lib.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/search.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/pagenavi.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/page_frame.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/manage.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
//require_once RSSC_ROOT_PATH . '/class/rssc_link_handler.php';
//require_once RSSC_ROOT_PATH . '/class/rssc_xml_handler.php';
//require_once RSSC_ROOT_PATH . '/class/rssc_feed_handler.php';
//require_once RSSC_ROOT_PATH . '/class/rssc_black_handler.php';
//require_once RSSC_ROOT_PATH . '/class/rssc_white_handler.php';
//require_once RSSC_ROOT_PATH . '/class/rssc_word_handler.php';
//require_once RSSC_ROOT_PATH . '/class/rssc_plugin.php';
//require_once RSSC_ROOT_PATH . '/plugins/rssc_plugin_base.php';
require_once RSSC_ROOT_PATH . '/admin/admin_function.php';

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];

if (file_exists(RSSC_ROOT_PATH . '/language/' . $XOOPS_LANGUAGE . '/main.php')) {
    require_once RSSC_ROOT_PATH . '/language/' . $XOOPS_LANGUAGE . '/main.php';
} else {
    require_once RSSC_ROOT_PATH . '/language/english/main.php';
}

if (file_exists(RSSC_ROOT_PATH . '/language/' . $XOOPS_LANGUAGE . '/modinfo.php')) {
    require_once RSSC_ROOT_PATH . '/language/' . $XOOPS_LANGUAGE . '/modinfo.php';
} else {
    require_once RSSC_ROOT_PATH . '/language/english/modinfo.php';
}

// compatible
require_once RSSC_ROOT_PATH . '/language/compatible.php';
