<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: word_manage.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-11-01 K.OHWADA
// BUG: dont work del_all
// main_del_all()
// set_flag_execute_time()

//=========================================================
// RSS Center Module
// 2007-06-01 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';


//=========================================================
// main
//=========================================================
$manage = Admin\WordManage::getInstance();

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
    case 'mod_all':
        $manage->main_mod_all();
        break;
    case 'del_all':
        $manage->main_del_all();
        break;
    case 'add_form':
    default:
        $manage->main_add_form();
        break;
}

xoops_cp_footer();

exit();
// --- end of main ---
