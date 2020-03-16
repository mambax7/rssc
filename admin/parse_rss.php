<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: parse_rss.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2008-01-30 K.OHWADA
// main()
// bug: break xoops cache if not set template

// 2007-11-01 K.OHWADA
// PHP 5.2: Assigning the return value of new by reference
// rssc_admin_print_footer()

// 2007-06-01 K.OHWADA
// api/refresh.php
// link_basicHandler xml_basicHandler
// get_lang_items()

// 2006-11-08 K.OHWADA
// use xoops_error()

// 2006-07-10 K.OHWADA
// move class admin_form_rss from admin_form_class.php
// use happy_linux_error happy_linux_form
// change make_xxx to build_xxx
// support podcast

// 2006-06-04 K.OHWADA
// change file name from view_rss.php to parse_rss.php
// change to contant RSSC_DIRNAME
// use new handler

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';

require_once XOOPS_ROOT_PATH . '/class/template.php';

require_once RSSC_ROOT_PATH . '/api/view.php';
require_once RSSC_ROOT_PATH . '/api/refresh.php';

//=========================================================
// main
//=========================================================
$parse = Admin\RssParse::getInstance();

xoops_cp_header();

rssc_admin_print_header();
rssc_admin_print_menu();

$parse->main();

rssc_admin_print_footer();
xoops_cp_footer();
exit();
// === main end ===
