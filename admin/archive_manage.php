<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: archive_manage.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_flag_execute_time()
// _UPDATE => _HAPPYLINUX_EXECUTE

// 2007-06-01 K.OHWADA
// api/refresh.php
// learn_black()

// 2006-09-18 K.OHWADA
// use XoopsGTicket
// use build_lib_box_limit_offset()

// 2006-07-10 K.OHWADA
// move class admin_manage_archive from admin_form_class.php
// use happy_linux_form happy_linux_post
// change make_xxx to build_xxx

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME
// add check_token()

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';

require_once RSSC_ROOT_PATH . '/api/refresh.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/bin_file.php';
//require_once RSSC_ROOT_PATH . '/class/rssc_RefreshAll_handler.php';

//=========================================================
// main
//=========================================================
$manage = Admin\ArchiveManage::getInstance();
$op     = $manage->get_post_op();

switch ($op) {
    case 'refresh':
        $manage->refresh_archive();
        break;
    case 'learn':
        $manage->learn_black();
        break;
    case 'clear_old':
        $manage->clear_old();
        break;
    default:
        $manage->main_form();
        break;
}

xoops_cp_footer();
exit();
// --- end of main ---
