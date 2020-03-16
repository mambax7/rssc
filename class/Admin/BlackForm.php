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


//require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/rss_parser.php';

//require_once RSSC_ROOT_PATH . '/admin/admin_manage_base_class.php';
//require_once RSSC_ROOT_PATH . '/admin/admin_form_black_white.php';


//=========================================================
// class BlackForm
//=========================================================
class BlackForm extends BlackWhiteForm
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
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
    // show black & white
    //---------------------------------------------------------
    public function _show($obj, $extra = null, $mode = 0)
    {
        $this->_id_name        = 'bid';
        $this->_form_title_add = _AM_RSSC_ADD_BLACK;
        $this->_form_title_mod = _AM_RSSC_MOD_BLACK;

        $this->_jump_feed = 'feed_list_bid.php?bid=' . $obj->get('bid');

        $this->_show_black_white($obj, $extra, $mode);
    }

    // --- class end ---
}
