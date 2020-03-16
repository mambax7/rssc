<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: keyword_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-111-01 K.OHWADA
// set_flag_execute_time()
// _KEYWORD => _RSSC_KEYWORD

// 2007-06-01 K.OHWADA
// link_xmlHandler
// include file under local language

// 2006-09-18 K.OHWADA
// show bread crumb
// use _check_fill_by_post()

// 2006-07-10 K.OHWADA
// move class admin_manage_keyword from admin_manage_class.php
// use happy_linux_form happy_linux_convert_encoding
// change make_xxx to build_xxx

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
$manage = Admin\KeywordManage::getInstance();

if (!$manage->file_exists()) {
    print_notice();
    exit();
}

$op = $manage->get_op();

switch ($op) {
    case 'add_keyword':
        $manage->main_add_keyword();
        break;
    default:
        $manage->main_add_form();
        break;
}

xoops_cp_footer();
exit();
// --- end of main ---

//---------------------------------------------------------
// function
//---------------------------------------------------------
function print_notice()
{
    xoops_cp_header();
    rssc_admin_print_header();
    rssc_admin_print_menu(); ?>
    <br>
    <font color='red'>NOT support in your language</font><br>
    <br>
    There are the RSS search site which carries out RSS feeds of the search results, such as <br>
    In English<br>
    - <a href="https://blogsearch.google.com/" target="_blank">https://blogsearch.google.com/</a><br>
    <br>
    In Japanese<br>
    - <a href="https://sf.livedoor.com/" target="_blank">https://sf.livedoor.com/</a><br>
    <br>
    I dont know same site in your language. <br>
    If you know, please teach me.<br>
    Webmaster of <a href="https://linux2.ohwada.net/" target="_blank">Happy Linux</a><br>
    <br>
    <?php

    xoops_cp_footer();
}

?>
