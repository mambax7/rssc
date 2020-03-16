<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: feed_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2009-02-20 K.OHWADA
// geo_lat

// 2008-02-24 K.OHWADA
// _URL_SIZE

// 2007-11-01 K.OHWADA
// use php_self
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// main_mod_all()
// rssc_feed_basic_handler.php

// 2006-09-18 K.OHWADA
// show bread crumb
// use _check_url_by_post()

// 2006-07-08 K.OHWADA
// move class admin_manage_feed from admin_manage_class.php
// move class admin_form_feed   from admin_form_class.php
// change make_xxx to build_xxx
// corresponding to podcast
//   add enclosure

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
$manage = Admin\FeedManage::getInstance();

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
    case 'add_form':
    default:
        $manage->main_add_form();
        break;
}

exit();
// --- end of main ---
