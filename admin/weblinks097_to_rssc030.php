<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: weblinks097_to_rssc030.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2006-09-20 K.OHWADA
// use rssc_admin_print_bread()

// 2006-07-10 K.OHWADA
// use admin_import_base
// move from weblinks096_to_rssc010.php

//================================================================
// RSS Center Module
// import from weblinks 0.97 to rssc 0.30
// 2006-07-10 K.OHWADA
//================================================================

// system files
require __DIR__ . '/admin_header.php';

// system files
require_once XOOPS_ROOT_PATH . '/class/snoopy.php';


//=========================================================
// main
//=========================================================
xoops_cp_header();

$import = Admin\ImportWeblinks097ToRssc030::getInstance();

$op = 'main';
if (isset($_POST['op'])) {
    $op = $_POST['op'];
}

rssc_admin_print_bread(_AM_RSSC_UPDATE_MANAGE, 'update_manage.php', 'weblinks');
echo '<h3>' . _AM_RSSC_IMPORT_WEBLINKS . "</h3>\n";
echo "Import DB weblinks 0.96 to rssc 0.30 <br><br>\n";

if (!$import->exist_module()) {
    xoops_error($import->get_msg_not_installed());
    xoops_cp_footer();
    exit();
}

switch ($op) {
    case 'import_site':
        if (!$import->check_token()) {
            xoops_error('Token Error');
        } else {
            $import->import_site();
        }
        break;
    case 'import_black':
        if (!$import->check_token()) {
            xoops_error('Token Error');
        } else {
            $import->import_black();
        }
        break;
    case 'import_white':
        if (!$import->check_token()) {
            xoops_error('Token Error');
        } else {
            $import->import_white();
        }
        break;
    case 'import_link':
        if (!$import->check_token()) {
            xoops_error('Token Error');
        } else {
            $import->import_link();
        }
        break;
    case 'import_feed':
        if (!$import->check_token()) {
            xoops_error('Token Error');
        } else {
            $import->import_feed();
        }
        break;
    case 'main':
    default:
        $import->first_step();
        break;
}

xoops_cp_footer();
exit();

?>
