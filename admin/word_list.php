<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: word_list.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-11-01 K.OHWADA
// BUG : dont work xoopsCheckAll
// admin_word_search_form
// set_flag_print_request_uri()
// set_flag_execute_time()

//=========================================================
// RSS Center Module
// 2007-06-01 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];

// system search
if (file_exists(XOOPS_ROOT_PATH . '/language/' . $XOOPS_LANGUAGE . '/search.php')) {
    require_once XOOPS_ROOT_PATH . '/language/' . $XOOPS_LANGUAGE . '/search.php';
} else {
    require_once XOOPS_ROOT_PATH . '/language/english/search.php';
}

//=========================================================
// main
//=========================================================
xoops_cp_header();
rssc_admin_print_header();
rssc_admin_print_menu();

$list = Admin\WordList::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---
