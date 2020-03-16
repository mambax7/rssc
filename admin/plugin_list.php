<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: plugin_list.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

//=========================================================
// RSS Center Module
// 2008-01-20 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';

//=========================================================
// main
//=========================================================
xoops_cp_header();

$list = Admin\PluginList::getInstance();

$op = $list->get_op();

switch ($op) {
    case 'execute':
        $list->execute();
        break;
    case 'form':
    default:
        rssc_admin_print_header();
        rssc_admin_print_menu();
        $list->show_list_form();
        break;
}

xoops_cp_footer();
exit();
// --- end of main ---
