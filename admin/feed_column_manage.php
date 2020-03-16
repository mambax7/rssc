<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: feed_column_manage.php,v 1.1 2012/03/31 04:46:34 ohwada Exp $

//=========================================================
// RSS Center Module
// 2012-03-01 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';

require_once XOOPS_ROOT_PATH . '/class/template.php';

require_once RSSC_ROOT_PATH . '/api/view.php';
require_once RSSC_ROOT_PATH . '/api/refresh.php';

//=========================================================
// main
//=========================================================
$manage = Admin\FeedColumnManage::getInstance();

$op = $manage->get_op();
switch ($op) {
    case 'update':
        $manage->update();
        exit();
        break;
    case 'form':
    default:
        break;
}

xoops_cp_header();

rssc_admin_print_header();
rssc_admin_print_menu();

$manage->main();

rssc_admin_print_footer();
xoops_cp_footer();
exit();
// === main end ===
