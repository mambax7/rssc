<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: table_manage.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-11-24 K.OHWADA
// happy_linux_table_manage()

// 2007-11-01 K.OHWADA
// xoops block table check
// rssc_admin_print_footer()

// 2006-09-20 K.OHWADA
// this is new file

//================================================================
// RSS Center Module
// 2006-09-10 K.OHWADA
//================================================================

require __DIR__ . '/admin_header.php';
require __DIR__ . '/admin_header.php';

//================================================================
// main
//================================================================

$manage = Admin\TableManage::getInstance();

$op = $manage->get_post_op();

switch ($op) {
    case 'renew_config':
        $manage->renew_config();
        break;
    case 'remove_block':
        xoops_cp_header();
        $manage->remove_block();
        break;
    case 'check_link':
        xoops_cp_header();
        $manage->check_link();
        break;
    case 'menu':
    default:
        xoops_cp_header();
        $manage->menu();
        break;
}

rssc_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---
