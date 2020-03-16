<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: black_list.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-11-01 K.OHWADA
// admin_list_black_white
// add field cache ctime in black, white
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// _AM_RSSC_COUNT_ASC
// use feed_list_bid.php

// 2006-09-10 K.OHWADA
// Notice: Only variables should be assigned by reference

// 2006-07-10 K.OHWADA
// use happy_linux_page_frame

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';


//=========================================================
// main
//=========================================================
xoops_cp_header();
rssc_admin_print_header();
rssc_admin_print_menu();

$list = Admin\BlackList::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---
