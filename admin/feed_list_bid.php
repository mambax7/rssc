<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: feed_list_bid.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-07-01 K.OHWADA
// divid from feed_list_class.php

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';
//require __DIR__ . '/feed_list_class.php';

//=========================================================
// main
//=========================================================
xoops_cp_header();
rssc_admin_print_header();
rssc_admin_print_menu();

$list = Admin\FeedListBid::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---
