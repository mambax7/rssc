<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: white_manage.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-11-01 K.OHWADA
// jump_feed
// set_flag_execute_time()

// 2006-09-18 K.OHWADA
// show bread crumb
// use XoopsGTicket
// use _check_url_by_post()

// 2006-07-08 K.OHWADA
// move class admin_manage_white from admin_manage_class.php
// move class admin_form_white   from admin_form_class.php

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class white manage
//=========================================================
class WhiteManage extends BaseManage
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
       parent::__construct();
        $helper = Helper::getInstance();
        $this->set_handler('white', RSSC_DIRNAME, 'rssc', $helper);
        $this->set_id_name('wid');
        $this->set_form_class(WhiteForm::class);
        $this->set_script('white_manage.php');
        $this->set_redirect('white_list.php', 'white_list.php?sortid=1');
        $this->set_title(_AM_RSSC_ADD_WHITE, _AM_RSSC_MOD_WHITE, _AM_RSSC_DEL_WHITE);
        $this->set_flag_execute_time(true);
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
        $this->_check_url_by_post('url', _RSSC_SITE_LINK);

        return $this->returnExistError();
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

    // --- class end ---
}
