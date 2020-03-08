<?php
// $Id: modules.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

//=========================================================
// RSS Center Module
// 2007-10-10 K.OHWADA
//=========================================================

require dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/admin.php';

//=========================================================
// main
//=========================================================
xoops_cp_header();

$admin = happy_linux_admin::getInstance();
$admin->print_modules();

xoops_cp_footer();
exit();
// --- end of main ---

?>
