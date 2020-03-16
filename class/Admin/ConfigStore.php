<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;


// $Id: admin_config_class.php,v 1.3 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// remove print_check_webmap3_version()

// 2012-03-01 K.OHWADA
// build_conf_extra_webmpa3_dirname_list

// 2009-02-20 K.OHWADA
// main_map_xxx

// 2008-11-22 K.OHWADA
// BUG: typo

// 2007-11-11 K.OHWADA
// link table: enclosure
// coufig: block_latest_mode_date
// rss_cache_clear()
// Rssc\Install

// 2007-06-01 K.OHWADA
// create_table: xml word

// 2006-11-08 K.OHWADA
// proxy server
// use build_conf_table_xxx

// 2006-09-20 K.OHWADA
// use XoopsGTicket
// add check_version_config_040()
// add main_search_title_html
// use build_lib_box_button_style()
// show blog

// 2006-07-10 K.OHWADA
// use happy_linux_config_form happy_linux_config_storeHandler etc
// change make_xxx to build_xxx
// add check_version() for v0.30

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME

// 2006-04-17 K.OHWADA
// suppress notice : Only variable references should be returned by reference

//=========================================================
// RSS Center Module
// this file contain 2 class
//   ConfigForm
//   ConfigStore
// 2006-01-01 K.OHWADA
//=========================================================

class ConfigStore extends Happylinux\Error
{
    // handler
    public $_install;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        // config_storeHandler
        $define              = Rssc\ConfigDefine::getInstance();
        $this->_storeHandler = Happylinux\ConfigFormHandler::getInstance();
        $helper = Rssc\Helper::getInstance();
        $this->_storeHandler->set_handler('Config', RSSC_DIRNAME, 'rssc', $helper);
        $this->_storeHandler->set_define($define);

        $this->_install = Rssc\Install::getInstance(RSSC_DIRNAME);
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
    // init config
    //---------------------------------------------------------
    public function check_init()
    {
        return $this->_install->check_install();
    }

    public function init()
    {
        $this->_clear_errors();

        $ret = $this->_install->install();
        if (!$ret) {
            // BUG: typo
            $this->_set_errors($this->_install->get_message());
        }

        return $this->returnExistError();
    }

    //---------------------------------------------------------
    // upgrade config
    //---------------------------------------------------------
    public function check_version()
    {
        return $this->_install->check_update();
    }

    public function upgrade()
    {
        $this->_clear_errors();

        $ret = $this->_install->update();
        if (!$ret) {
            // BUG: typo
            $this->_set_errors($this->_install->get_message());
        }

        return $this->returnExistError();
    }

    //---------------------------------------------------------
    // save config
    //---------------------------------------------------------
    public function save()
    {
        $ret = $this->_storeHandler->save();
        if (!$ret) {
            $this->_set_errors($this->_storeHandler->getErrors());
        }

        return $ret;
    }

    //---------------------------------------------------------
    // rss cache clear
    //---------------------------------------------------------
    public function rss_cache_clear()
    {
        require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/rss_builder.php';
        // require_once RSSC_ROOT_PATH . '/class/rssc_build_rssc.php';

        $builder = Rssc\BuildRssc::getInstance(RSSC_DIRNAME);

        $builder->clear_all_guest_cache();
    }

    public function template_compiled_clear()
    {
        require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/module_install.php';
        // require_once RSSC_ROOT_PATH . '/class/rssc_install.php';

        $install = Rssc\Install::getInstance(RSSC_DIRNAME);
        $install->clear_all_template();
    }

    // --- class end ---

//    public function set_config_handler($name, $dirname, $prefix)
//    {
//        $this->_configHandler = Helper::getInstance()->getHandler(ucfirst($name), $dirname, $prefix);
//    }
}
