<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: xoopsheadline100_to_rssc030.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2006-09-20 K.OHWADA
// use rssc_admin_print_bread()

// 2006-07-10 K.OHWADA
// use admin_import_base
// move from xoopsheadline100_to_rssc010

//================================================================
// RSS Center Module
// import from xoopshedline 1.00 to rssc 0.30
// 2006-07-10 K.OHWADA
//================================================================

// system files
require __DIR__ . '/admin_header.php';

// system files
require_once XOOPS_ROOT_PATH . '/class/snoopy.php';


//================================================================
// main
//================================================================

xoops_cp_header();

$import = Admin\ImportXoopsheadline100Rssc030::getInstance();

$op = 'main';
if (isset($_POST['op'])) {
    $op = $_POST['op'];
}

rssc_admin_print_bread(_AM_RSSC_UPDATE_MANAGE, 'update_manage.php', 'xoopshedline');
echo '<h3>' . _AM_RSSC_IMPORT_XOOPSHEADLINE . "</h3>\n";
echo "Import DB xoopshedline 1.00 to rssc 0.30 <br><br>\n";

if (!$import->exist_module()) {
    xoops_error($import->get_msg_not_installed());
    xoops_cp_footer();
    exit();
}

switch ($op) {
    case 'import_xoopsheadline':
        if (!$import->check_token()) {
            xoops_error('Token Error');
        } else {
            $import->hl_import_xoopsheadline();
        }
        break;
    case 'main':
    default:
        $import->hl_first_step();
        break;
}

xoops_cp_footer();
exit();
