<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
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


//=========================================================
// class keyword manage
//=========================================================
class KeywordManage extends BaseManage
{
    // handler, class
    public $_list;
    public $_convert;
    public $_system;

    public $_MODE             = RSSC_C_MODE_RSS;    // rss
    public $_REFRESH_INTERVAL = 3600;    // 1 hours

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
       parent::__construct();


        $helper = Helper::getInstance();
        $this->set_handler('LinkXml', RSSC_DIRNAME, 'rssc', $helper);
        $this->set_id_name('lid');
        $this->set_form_class(KeywordForm::class);
        $this->set_script('keyword_manage.php');
        $this->set_redirect('link_list.php', 'link_list.php?sortid=1');
        $this->set_title(_AM_RSSC_ADD_KEYWORD, _AM_RSSC_MOD_LINK, _AM_RSSC_DEL_LINK);
        $this->set_flag_execute_time(true);

        // handler, class
        $this->_convert = Happylinux\ConvertEncoding::getInstance();
        $this->_system  = Happylinux\System::getInstance();

        $this->_list_id = 1;
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
    // check enviroment
    //---------------------------------------------------------
    public function file_exists()
    {
        $language = $this->_system->get_language();

        if (file_exists(RSSC_ROOT_PATH . '/language/' . $language . '/site_list.php')) {
            require_once RSSC_ROOT_PATH . '/language/' . $language . '/site_list.php';
            if (class_exists('\rssc_site_list')) {
                $this->_list = \rssc_site_list::getInstance();
                return true;
            }
        }

        return false;
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
        $obj = $this->handler->create();
        $obj->setVar('uid', $this->_system->get_uid());
        $obj->setVar('mid', $this->_system->get_mid());
        $obj->setVar('mode', $this->_MODE);
        $obj->setVar('refresh', $this->_REFRESH_INTERVAL);
        $obj->setVar('ltype', RSSC_C_LINK_LTYPE_SEARCH);    // rss search site

        $this->_form->_show_add($obj);

        return true;
    }

    //---------------------------------------------------------
    // main_add_keyword()
    //---------------------------------------------------------
    public function main_add_keyword()
    {
        if (!$this->_check_token() || !$this->_check_add_keyword()) {
            $this->_print_add_keyword_preview();
            exit();
        }

        if ($this->_exec_add_keyword()) {
            redirect_header($this->_redirect_desc, 1, _AM_RSSC_DBUPDATED);
            exit();
        }
        $this->_print_add_keyword_db_error();
        exit();
    }

    public function _check_add_keyword()
    {
        $this->_clear_errors();

        // check fill
        $this->_check_fill_by_post('keyword', _RSSC_KEYWORD);

        return $this->returnExistError();
    }

    public function _exec_add_keyword()
    {
        $this->_clear_errors();

        foreach ($this->_list->get_site_list() as $site) {
            $obj = $this->handler->create();
            $obj->set_vars_keyword($site);
            $newid = $this->handler->insert($obj);
            if (!$newid) {
                $this->_set_errors($this->handler->getErrors());
            }
        }

        return $this->returnExistError();
    }

    public function _print_add_keyword_preview()
    {
        $this->_print_cp_header();
        $this->_print_bread_op(_AM_RSSC_ADD_KEYWORD, 'add_form');
        $this->_print_title(_AM_RSSC_ADD_KEYWORD);
        $this->_print_token_error(1);
        $this->_print_error(1);
        $this->_print_add_preview_form();
    }

    public function _print_add_keyword_db_error()
    {
        $this->_print_cp_header();
        $this->_print_bread_op(_AM_RSSC_ADD_KEYWORD, 'add_form');
        xoops_error('DB Error');
        $this->_print_error(1);
        $this->_print_cp_footer();
    }

    // --- class end ---
}
