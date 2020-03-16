<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: blocks.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

//=========================================================
// RSS Center Module
// 2007-06-01 K.OHWADA
//=========================================================

require dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/admin.php';

//=========================================================
// main
//=========================================================
xoops_cp_header();

$admin = Happylinux\Admin::getInstance();
$admin->print_blocks();

xoops_cp_footer();
exit();
// --- end of main ---
