<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: map_manage.php,v 1.2 2012/04/08 23:42:20 ohwada Exp $

// 2012-034-02 K.OHWADA
// print_check_version()

//=========================================================
// RSS Center Module
// 2012-03-01 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';

//=========================================================
// main
//=========================================================
$manage = Admin\MapManage::getInstance(RSSC_DIRNAME);

$op = $manage->get_post_get_op();

if ('save' == $op) {
    if (!$manage->check_token()) {
        xoops_cp_header();
        $manage->print_xoops_token_error();
    } else {
        $manage->save();
        redirect_header('map_manage.php', 1, _HAPPYLINUX_UPDATED);
    }
} else {
    xoops_cp_header();
}

$manage->main();

xoops_cp_footer();
exit();
