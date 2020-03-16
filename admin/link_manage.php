<?php

use XoopsModules\Rssc\Admin;
//use XoopsModules\Happylinux;

// $Id: link_manage.php,v 1.4 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// rssc_map

// 2012-03-31 K.OHWADA
// default.gif

// 2012-03-01 K.OHWADA
// webmap3_api_gicon

// 2009-02-20 K.OHWADA
// _build_ele_gicon()

// 2008-01-20 K.OHWADA
// post_plugin

// 2007-11-01 K.OHWADA
// enclosure censor plugin
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// link_xmlHandler, xmlHandler
// api/refresh.php
// use get_ltype_option()
// use feed_list_lid.php

// 2007-05-19 K.OHWADA
// BUG: dont show admin frame

// 2006-09-20 K.OHWADA
// show bread crumb
// use XoopsGTicket
// add _refresh_link_error() etc
// use rssc_xml_utlity : not use rssc_link_existHandler
// use build_lib_button_hidden_array()
// use _check_url_by_post()
// use RSSC_CODE_PARSE_NOT_READ_XML_URL

// 2006-07-18 K.OHWADA
// BUG 4145: 'blong link' jump always 'rssc' directory

// 2006-07-08 K.OHWADA
// move class admin_manage_link from admin_manage_class.php
// move class admin_form_link   from admin_form_class.php
// use happy_linux_form happy_linux_post
// change make_xxx to build_xxx
// link exist check
//   add check_exist_rssurl()

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

require __DIR__ . '/admin_header.php';

require_once RSSC_ROOT_PATH . '/api/refresh.php';


//=========================================================
// main
//=========================================================
$manage = Admin\LinkManage::getInstance();

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
    case 'addlink':
        $manage->main_addlink();
        break;
    case 'refresh_link':
        $manage->main_refresh_link();
        break;
    case 'view_channel':
        $manage->view_channel();
        break;
    case 'view_xml':
        $manage->view_xml();
        break;
    case 'add_form':
    default:
        $manage->main_add_form();
        break;
}

xoops_cp_footer();
exit();
// --- end of main ---
