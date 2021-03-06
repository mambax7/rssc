<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;


// $Id: admin_list_black_white.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-10-10 K.OHWADA
// divid from admin_list_black & admin_list_white

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
class BlackWhiteList extends Happylinux\PageFrame
{
    // class instance
    public $_feedHandler;

    // black & white
    public $_TITLE_BW    = null;
    public $_TILTE_ID_BW = null;

    public $_CACHE_TIME = 3600;    // 1 hour

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->set_max_sortid(4);

        // class instance
        $this->_feedHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Feed', RSSC_DIRNAME);
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
    // black & white
    //---------------------------------------------------------
    public function &_get_table_header()
    {
        $arr = [
            $this->_TILTE_ID_BW,
            _AM_RSSC_SHOW_FEED,
            _RSSC_SITE_LINK,
            _RSSC_SITE_TITLE,
            _RSSC_FREQ_COUNT,
        ];

        return $arr;
    }

    public function &_get_items($limit = 0, $start = 0)
    {
        switch ($this->_sortid) {
            case 1:
                $objs = $this->handler->get_objects_desc($limit, $start);
                break;
            case 2:
                $objs = $this->handler->get_objects_count_desc($limit, $start);
                break;
            case 3:
                $objs = $this->handler->get_objects_count_asc($limit, $start);
                break;
            case 0:
            default:
                $objs = $this->handler->get_objects_asc($limit, $start);
                break;
        }

        return $objs;
    }

    public function _print_top()
    {
        switch ($this->_sortid) {
            case 1:
                $title = _HAPPYLINUX_ID_DESC;
                break;
            case 2:
                $title = _AM_RSSC_COUNT_DESC;
                break;
            case 3:
                $title = _AM_RSSC_COUNT_ASC;
                break;
            case 0:
            default:
                $title = _HAPPYLINUX_ID_ASC;
                break;
        }

        echo '<h4>' . $this->_TITLE_BW . "</h4>\n";
        printf(_RSSC_THEREARE, $this->_get_total_all());
        echo "<br><br>\n";

        echo "<table width='80%' border='0' cellspacing='1' class='outer'>";
        echo "<tr class='odd'><td>";
        echo "<li><a href='?sortid=0'>" . _HAPPYLINUX_ID_ASC . "</a></li>\n";
        echo "<li><a href='?sortid=1'>" . _HAPPYLINUX_ID_DESC . "</a></li>\n";
        echo "<li><a href='?sortid=2'>" . _AM_RSSC_COUNT_DESC . "</a></li>\n";
        echo "<li><a href='?sortid=3'>" . _AM_RSSC_COUNT_ASC . "</a></li>\n";
        echo "</td></tr></table>\n";

        echo '<h4>' . $title . "</h4>\n";
    }

    public function _get_name_feed(&$obj)
    {
        $count = $this->_get_count($obj);
        if ($count) {
            $name = "FEED ($count)";
        } else {
            $name = 'FEED';
        }

        return $name;
    }

    public function _get_count(&$obj)
    {
        if (time() > ($obj->get('ctime') + $this->_CACHE_TIME)) {
            $count = $this->_feedHandler->get_count_by_link($obj->get('url'));
            if ($count) {
                $this->_update_cache($obj, $count);
            }
        } else {
            $count = $obj->get('cache');
        }

        return $count;
    }

    public function _update_cache(&$obj, $cache)
    {
        $obj->setVar('cache', $cache);
        $obj->setVar('ctime', time());

        return $this->handler->update($obj, true);
    }

    // --- class end ---
}
