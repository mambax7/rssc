<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: admin_function.php,v 1.2 2012/03/17 13:31:45 ohwada Exp $

// 2012-03-01 K.OHWADA
// map_manage.php

// 2008-01-20 K.OHWADA
// config_manage_3.php

// 2007-11-24 K.OHWADA
// _HAPPYLINUX_CONF_TABLE_MANAGE

// 2007-11-11 K.OHWADA
// happy_linux_admin_menu
// modules.php

// 2007-06-01 K.OHWADA
// menu: word_manage blocks

// 2006-09-20 K.OHWADA
// use build_html_menu_table()
// add table_manage
// add rssc_admin_print_bread()

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME
// remove rssc_admin_get_dirname()

// 2006-04-17 K.OHWADA
// suppress notice : Only variable references should be returned by reference

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
function rssc_admin_print_header()
{
    $menu = Happylinux\AdminMenu::getInstance();
    echo $menu->build_header(RSSC_DIRNAME, _MI_RSSC_DESC);
}

function rssc_admin_print_footer()
{
    $menu = Happylinux\AdminMenu::getInstance();
    echo $menu->build_footer();
}

function rssc_admin_print_powerdby()
{
    $menu = Happylinux\AdminMenu::getInstance();
    echo $menu->build_powerdby();
}

function rssc_admin_print_bread($name1, $url1 = '', $name2 = '')
{
    $system = Happylinux\System::getInstance();
    $form   = Happylinux\Form::getInstance();

    $arr = [
        [
            'name' => $system->get_module_name(),
            'url'  => 'index.php',
        ],
    ];

    if ($name1) {
        $arr[] = [
            'name' => $name1,
            'url'  => $url1,
        ];
    }

    if ($name2) {
        $arr[] = [
            'name' => $name2,
        ];
    }

    echo $form->build_html_bread_crumb($arr);
}

function rssc_admin_print_menu()
{
    $MAX_COL = 5;

    $linkHandler  = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Link', RSSC_DIRNAME);
    $blackHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Black', RSSC_DIRNAME);
    $whiteHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('White', RSSC_DIRNAME);
    $feedHandler  = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Feed', RSSC_DIRNAME);
    $wordHandler  = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Word', RSSC_DIRNAME);

    $total_link  = $linkHandler->getCount();
    $total_black = $blackHandler->getCount();
    $total_white = $whiteHandler->getCount();
    $total_feed  = $feedHandler->getCount();
    $total_word  = $wordHandler->getCount();

    $link_list  = _AM_RSSC_LIST_LINK . " ($total_link)";
    $black_list = _AM_RSSC_LIST_BLACK . " ($total_black)";
    $white_list = _AM_RSSC_LIST_WHITE . " ($total_white)";
    $feed_list  = _AM_RSSC_LIST_FEED . " ($total_feed)";
    $word_list  = _AM_RSSC_LIST_WORD . " ($total_word)";

    $menu_arr = [
        _MI_RSSC_ADMENU_CONFIG      => 'index.php',
        _AM_RSSC_FORM_FILTER        => 'config_manage_2.php',
        _AM_RSSC_FORM_HTMLOUT       => 'config_manage_3.php',
        _AM_RSSC_FORM_CUSTOM_PLUGIN => 'config_manage_4.php',
        _RSSC_PLUGIN_LIST           => 'plugin_list.php',

        $link_list  => 'link_list.php',
        $black_list => 'black_list.php',
        $white_list => 'white_list.php',
        $word_list  => 'word_list.php',
        $feed_list  => 'feed_list.php',

        _AM_RSSC_ADD_LINK    => 'link_manage.php',
        _AM_RSSC_ADD_BLACK   => 'black_manage.php',
        _AM_RSSC_ADD_WHITE   => 'white_manage.php',
        _AM_RSSC_ADD_WORD    => 'word_manage.php',
        _AM_RSSC_ADD_KEYWORD => 'keyword_manage.php',

        _HAPPYLINUX_CONF_COMMAND_MANAGE => 'command_manage.php',
        _AM_RSSC_UPDATE_MANAGE           => 'update_manage.php',
        _AM_RSSC_ARCHIVE_MANAGE          => 'archive_manage.php',
        _HAPPYLINUX_CONF_RSS_MANAGE     => 'build_menu.php',
        _AM_RSSC_PARSE_RSS               => 'parse_rss.php',

        _HAPPYLINUX_CONF_TABLE_MANAGE => 'table_manage.php',
        _HAPPYLINUX_AM_MODULE         => 'modules.php',
        _HAPPYLINUX_AM_BLOCK          => 'blocks.php',
        _AM_RSSC_MAP_MANAGE            => 'map_manage.php',
        _HAPPYLINUX_GOTO_MODULE       => '../index.php',
    ];

    $menu = Happylinux\AdminMenu::getInstance();
    echo $menu->build_menu_table($menu_arr, $MAX_COL);
}
