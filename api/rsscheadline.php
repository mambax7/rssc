<?php

use XoopsModules\Rssc;
use XoopsModules\Happylinux;

// $Id: rssc_headline.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

// 2007-06-01 K.OHWADA
// api/view.php api/refresh.php

// 2006-09-15 K.OHWADA
// not use Rssc\LinkExistHandler.php
// use happy_linux/include/version.php

// 2006-07-10 K.OHWADA
// this is new file

//=========================================================
// RSS Center Module
// API for rssc_hedline
// 2006-07-10 K.OHWADA
//=========================================================

// dir name
$RSSC_DIRNAME = basename(dirname(__DIR__));

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
if (!file_exists(XOOPS_ROOT_PATH . '/modules/happylinux/include/version.php')) {
    die('require happy_linux module');
}

require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/version.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/api/view.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/api/refresh.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/api/manage.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/api/lang_main.php';

require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/include/rssc_version.php';

// check happy_linux version
if (HAPPYLINUX_VERSION < RSSC_HAPPYLINUX_VERSION) {
    $msg = 'require happy_linux module v' . RSSC_HAPPYLINUX_VERSION . ' or later';
    die($msg);
}
