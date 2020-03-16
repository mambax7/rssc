<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;// $Id: feed_list_bid.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-07-01 K.OHWADA
// divid from feed_list_class.php

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================


//=========================================================
// class admin list feed
//=========================================================
class FeedListBid extends FeedList
{
    public $_blackHandler;

    public $_bid        = 0;
    public $_total_link = 0;
    public $_link       = '';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->set_max_sortid(4);

        $this->_blackHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Black', RSSC_DIRNAME);
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
    // Pre processing
    //---------------------------------------------------------
    public function _init()
    {
        if (isset($_GET['bid'])) {
            $this->_bid  = $this->_post->get_get_int('bid');
            $black_obj   = $this->_blackHandler->get($this->_bid);
            $this->_link = $black_obj->get('url');
        }
    }

    public function _get_total()
    {
        $this->_total_link    = $this->handler->get_count_by_link($this->_link);
        $this->_total_non_act = $this->handler->get_count_by_link_non_act($this->_link);
        switch ($this->_sortid) {
            case 2:
            case 3:
                $total = $this->_total_non_act;
                break;
            case 0:
            case 1:
            default:
                $total = $this->_total_link;
                break;
        }

        return $total;
    }

    //---------------------------------------------------------
    // items
    //---------------------------------------------------------
    public function &_get_items($limit = 0, $start = 0)
    {
        switch ($this->_sortid) {
            case 1:
                $objs = $this->handler->get_objects_by_link_desc($this->_link, $limit, $start);
                break;
            case 2:
                $objs = $this->handler->get_objects_by_link_non_act_asc($this->_link, $limit, $start);
                break;
            case 3:
                $objs = $this->handler->get_objects_by_link_non_act_desc($this->_link, $limit, $start);
                break;
            case 0:
            default:
                $objs = $this->handler->get_objects_by_link_asc($this->_link, $limit, $start);
                break;
        }

        return $objs;
    }

    //---------------------------------------------------------
    // print
    //---------------------------------------------------------
    public function _print_sub()
    {
        $black_obj = $this->_blackHandler->get($this->_bid);
        if (is_object($black_obj)) {
            $title_s = $black_obj->getVar('title', 's');
            $link    = '<a href="black_manage.php?op=mod_form&bid=' . $this->_bid . '">' . $title_s . '</a>';
            printf(_AM_RSSC_THEREARE_TITLE, $link, $this->_total_link);
            echo "<br><br>\n";
        }
    }

    public function _get_condition()
    {
        $condition = 'link = ' . $this->_link;
        switch ($this->_sortid) {
            case 2:
            case 3:
                $condition .= ', act = 0';
                break;
            case 0:
            case 1:
            default:
                break;
        }

        return $condition;
    }

    //---------------------------------------------------------
    // script
    //---------------------------------------------------------
    public function _get_script_sortid($sortid)
    {
        $script = $this->_get_script() . '&amp;sortid=' . $sortid;

        return $script;
    }

    public function _get_script()
    {
        $script = xoops_getenv('PHP_SELF') . '?bid=' . $this->_bid;

        return $script;
    }

    // --- class end ---
}
