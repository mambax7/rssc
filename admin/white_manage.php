<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: white_manage.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-11-01 K.OHWADA
// jump_feed
// set_flag_execute_time()

// 2006-09-18 K.OHWADA
// show bread crumb
// use XoopsGTicket
// use _check_url_by_post()

// 2006-07-08 K.OHWADA
// move class admin_manage_white from admin_manage_class.php
// move class admin_form_white   from admin_form_class.php

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
$manage = Admin\WhiteManage::getInstance();

$op = $manage->get_op();

switch ($op) {
    case 'add_table':
        $manage->main_add_table();
        break;
    case 'mod_form':
        $manage->main_mod_form();
        break;
    case 'mod_table':
        $manage->main_mod_table();
        break;
    case 'del_table':
        $manage->main_del_table();
        break;
    case 'add_bulk':
        $manage->main_add_bulk();
        break;
    case 'add_form':
    default:
        $manage->main_add_form();
        break;
}

xoops_cp_footer();

exit();
// --- end of main ---
