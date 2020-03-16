<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: feed_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2009-02-20 K.OHWADA
// geo_lat

// 2008-02-24 K.OHWADA
// _URL_SIZE

// 2007-11-01 K.OHWADA
// use php_self
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// main_mod_all()
// rssc_feed_basic_handler.php

// 2006-09-18 K.OHWADA
// show bread crumb
// use _check_url_by_post()

// 2006-07-08 K.OHWADA
// move class FeedManage from admin_manage_class.php
// move class admin_form_feed   from admin_form_class.php
// change make_xxx to build_xxx
// corresponding to podcast
//   add enclosure

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class feed manage
//=========================================================
class FeedManage extends BaseManage
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
       parent::__construct();


        $helper = Helper::getInstance();
        $this->set_handler('feed', RSSC_DIRNAME, 'rssc', $helper);
        $this->set_id_name('fid');
        $this->set_form_class(FeedForm::class);
        $this->set_script('feed_manage.php');
        $this->set_redirect('feed_list.php', 'feed_list.php?sortid=1');
        $this->set_title(_AM_RSSC_ADD_FEED, _AM_RSSC_MOD_FEED, _AM_RSSC_DEL_FEED);
        $this->set_list_id_name('rssc_feed_id');
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
        $obj = $this->handler->create();
        $obj->set('uid', $this->_system->get_uid());
        $obj->set('mid', $this->_system->get_mid());

        $this->_print_form($obj, null, $this->_MODE_INSERT);

        return true;
    }

    //---------------------------------------------------------
    // main_add_table()
    //---------------------------------------------------------
    public function main_add_table()
    {
        $this->_main_add_table(true);
    }

    public function _check_add_table()
    {
        $this->_clear_errors();
        $this->_check_add_mod();

        return $this->returnExistError();
    }

    public function _check_add_mod()
    {
        // check fill
        $this->_check_fill_by_post('site_title', _RSSC_SITE_TITLE);
        $this->_check_url_by_post('site_link', _RSSC_SITE_LINK);
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
        $this->_check_add_mod();

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
    // main_mod_all()
    //---------------------------------------------------------
    public function main_mod_all()
    {
        $del     = $this->_post->get_post('del_all');
        $mod     = $this->_post->get_post('mod_all');
        $request = $this->_post->get_post('request_uri');
        $url     = 'feed_list.php';

        if ($request) {
            $this->set_redirect_mod_all($request);
            $this->set_redirect_del_all($request);
        }

        if ($mod) {
            $this->_main_mod_all(true);
        } elseif ($del) {
            $this->_main_del_all(true);
        } else {
            redirect_header($url, 3, 'invalid submit name');
        }
    }

    public function &_get_obj_mod_all()
    {
        // set act = 0
        $this->_obj->setVar('act', 0);

        return $this->_obj;
    }

    //---------------------------------------------------------
    // main_del_all()
    //---------------------------------------------------------
    public function main_del_all()
    {
        $this->_main_del_all(true);
    }

    // --- class end ---
}
