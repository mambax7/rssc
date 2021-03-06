<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: white_list.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2007-11-01 K.OHWADA
// admin_list_black_white
// add field cache ctime in black, white
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// _AM_RSSC_COUNT_ASC

// 2006-09-10 K.OHWADA
// Notice: Only variables should be assigned by reference

// 2006-07-10 K.OHWADA
// use happy_linux_page_frame

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================


//=========================================================
// class admin list white
//=========================================================
class WhiteList extends BlackWhiteList
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $helper = Helper::getInstance();
        $this->set_handler('white', RSSC_DIRNAME, '', $helper);
        $this->set_id_name('wid');
        $this->set_flag_execute_time(true);

        $this->_TITLE_BW    = _AM_RSSC_LIST_WHITE;
        $this->_TITLE_ID_BW = _RSSC_WHITE_ID;
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
    // function
    //---------------------------------------------------------
    public function &_get_cols($obj)
    {
        $jump = 'white_manage.php?op=mod_form&amp;wid=';

        $jump_feed = 'feed_list_wid.php?wid=' . $obj->get('wid');
        $name_feed = $this->_get_name_feed($obj);

        $arr = [
            $this->_build_page_id_link_by_obj($obj, 'wid', $jump),
            $this->build_html_a_href_name($jump_feed, $name_feed),
            $this->_build_page_name_link_by_obj($obj, 'url'),
            $this->_build_page_label_by_obj($obj, 'title'),
            $this->_build_page_label_by_obj($obj, 'count'),
        ];

        return $arr;
    }

    // --- class end ---
}
