<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: black_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-11-01 K.OHWADA
// jump_feed
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// api/rss_parser.php

// 2006-09-18 K.OHWADA
// show bread crumb
// use XoopsGTicket
// use _check_url_by_post()

// 2006-07-08 K.OHWADA
// move class admin_manage_black from admin_manage_class.php
// move class admin_form_black   from admin_form_class.php

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/rss_parser.php';

//require_once RSSC_ROOT_PATH . '/admin/admin_manage_base_class.php';
//require_once RSSC_ROOT_PATH . '/admin/admin_form_black_white.php';

//=========================================================
// class black manage
//=========================================================
class BlackManage extends BaseManage
{
    // handler
    public $_parser;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $helper = Helper::getInstance();
        $this->set_handler('black', RSSC_DIRNAME, 'rssc', $helper);
        $this->set_id_name('bid');
        $this->set_form_class(BlackForm::class);
        $this->set_script('black_manage.php');
        $this->set_redirect('black_list.php', 'black_list.php?sortid=1');
        $this->set_title(_AM_RSSC_ADD_BLACK, _AM_RSSC_MOD_BLACK, _AM_RSSC_DEL_BLACK);
        $this->set_flag_execute_time(true);

        // handler
        $this->_parser = Happylinux\RssParser::getInstance();
    }

    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    //---------------------------------------------------------
    // main_add_form()
    //---------------------------------------------------------
    public function main_add_form()
    {
        $this->_main_add_form();
    }

    public function _print_add_form()
    {
        return $this->_print_add_form_black_white();
    }

    //---------------------------------------------------------
    // main_add_table()
    //---------------------------------------------------------
    public function main_add_table()
    {
        $this->_main_add_table(true);
    }

    //---------------------------------------------------------
    // main_mod_form()
    //---------------------------------------------------------
    public function main_mod_form()
    {
        $this->_main_mod_form();
    }

    //---------------------------------------------------------
    // main_mod_table()
    //---------------------------------------------------------
    public function main_mod_table()
    {
        $this->_main_mod_table(true);
    }

    public function _check_mod_table()
    {
        $this->_clear_errors();

        if ($this->_post->get_post_int('reg')) {
            $this->_check_fill_by_post('url', _RSSC_SITE_LINK);
        } else {
            $this->_check_url_by_post('url', _RSSC_SITE_LINK);
        }

        return $this->returnExistError();
    }

    public function _exec_mod_table()
    {
        $url1 = $this->_post->get_post_text('url');

        if ($this->_post->get_post_int('reg')) {
            $url2 = $this->_strings->prepare_text($url1, true);
        } else {
            $url2 = $this->_strings->prepare_url($url1, true);
        }

        $this->_modid = $this->_get_post_get_id();
        $this->_obj->assignVars($_POST);
        $this->_obj->set('url', $url2);

        if (!$this->handler->update($this->_obj)) {
            $this->_set_errors($this->_LANG_FAIL_MOD);
            $this->_set_errors($this->handler->getErrors());

            return false;
        }

        return true;
    }

    //---------------------------------------------------------
    // main_del_table()
    //---------------------------------------------------------
    public function main_del_table()
    {
        $this->_main_del_table(true);
    }

    //---------------------------------------------------------
    // main_add_bulk()
    //---------------------------------------------------------
    public function main_add_bulk()
    {
        $this->_main_add_bulk_black_white();
    }

    //---------------------------------------------------------
    // main_addlist()
    //---------------------------------------------------------
    public function main_addlist()
    {
        $this->_print_cp_header();
        $this->_print_menu();
        $this->_print_title(_AM_RSSC_ADD_BLACK);

        if (!$this->_print_add_list()) {
            $this->_print_error(1);
        }
    }

    public function _print_add_list()
    {
        $fid = $this->_post->get_get_int('fid');

        $feed = $this->_get_feed_by_fid($fid);
        if (!$feed) {
            return false;
        }

        $feed_title = $feed['title'];
        $feed_link  = $feed['link'];

        $parse_obj = &$this->_parser->discover_and_parse_by_html_url($feed_link);
        if (is_object($parse_obj)) {
            $title      = $parse_obj->get_channel_by_key('title');
            $link       = $parse_obj->get_channel_by_key('link');
            $site_title = $title;
            $site_link  = $link;
        } else {
            $title      = $feed_title;
            $link       = $feed_link;
            $site_title = '';
            $site_link  = '';
        }

        $memo = '';
        $memo .= $feed['site_title'] . "\n";
        $memo .= $feed['site_link'] . "\n";
        $memo .= $feed_title . "\n";
        $memo .= $feed_link . "\n";
        $memo .= $site_title . "\n";
        $memo .= $site_link . "\n";

        $obj = $this->handler->create();

        // set values just as enter
        $obj->assignVars($feed);

        $obj->set('url', $link);
        $obj->set('title', $title);
        $obj->set('memo', $memo);

        $this->_form->_show_add($obj);

        return true;
    }

    // --- class end ---
}
