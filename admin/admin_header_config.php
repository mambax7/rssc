<?php
// $Id: admin_header_config.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

//=========================================================
// RSS Center Module
// 2007-11-11 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
require_once XOOPS_ROOT_PATH . '/modules/happy_linux/class/config_base_handler.php';
require_once XOOPS_ROOT_PATH . '/modules/happy_linux/class/config_define_handler.php';
require_once XOOPS_ROOT_PATH . '/modules/happy_linux/class/config_store_handler.php';
require_once XOOPS_ROOT_PATH . '/modules/happy_linux/class/module_install.php';

//---------------------------------------------------------
// whatsnew
//---------------------------------------------------------
require_once RSSC_ROOT_PATH . '/class/rssc_config_define.php';
require_once RSSC_ROOT_PATH . '/class/rssc_config_handler.php';
require_once RSSC_ROOT_PATH . '/class/rssc_install.php';

//require_once RSSC_ROOT_PATH.'/admin/admin_table_class.php';
require_once RSSC_ROOT_PATH . '/admin/admin_config_class.php';
