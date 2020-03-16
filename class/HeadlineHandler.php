<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_headline_handler.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2007-06-01 K.OHWADA
// link_basicHandler

// 2006-07-10 K.OHWADA
// use happy_linux_error

// 2006-06-29 K.OHWADA
// Fatal error: Call to a member function on a non-object

// 2006-06-04 K.OHWADA
// this is new file
// move from rssc_refresh_handler.php

//=========================================================
// Rss Center Module
// 2006-06-04 K.OHWADA
//=========================================================

//=========================================================
// class rssc_headlineHandler
//=========================================================
class HeadlineHandler extends Happylinux\Error
{
    // handler
    public $_linkHandler;
    public $_refreshHandler;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        parent::__construct();

        // handler
        $this->_linkHandler    = \XoopsModules\Rssc\Helper::getInstance()->getHandler('LinkBasic', $dirname);
        $this->_refreshHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Refresh', $dirname);
    }

    //---------------------------------------------------------
    // refresh headline links
    //---------------------------------------------------------
    public function refresh_headline($limit = 0, $start = 0)
    {
        $this->_clear_errors();

        $lid_arr = $this->_linkHandler->get_headline_lids($limit, $start);

        // refresh
        foreach ($lid_arr as $lid) {
            if (!$this->_refreshHandler->refresh($lid)) {
                // Fatal error: Call to a member function on a non-object
                $this->_set_errors($this->_refreshHandler->getErrors());
            }
        }

        return $this->returnExistError();
    }

    //---------------------------------------------------------
    // get headline links
    //---------------------------------------------------------
    public function &get_headline_links($limit = 0, $start = 0)
    {
        $links = &$this->_linkHandler->get_headlines($limit, $start);

        return $links;
    }

    // --- class end ---
}
// === class end ===

