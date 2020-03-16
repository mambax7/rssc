<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;


// $Id: xoopsheadline100_to_rssc070.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-10-10 K.OHWADA
// rssc v0.70
// rssc_importHandler

// 2006-09-20 K.OHWADA
// use rssc_admin_print_bread()

// 2006-07-10 K.OHWADA
// use admin_import_base
// move from xoopsheadline100_to_rssc010

//================================================================
// RSS Center Module
// import from xoopshedline 1.00 to rssc 0.30
// 2006-07-10 K.OHWADA
//================================================================


//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
class ImportXoopsheadline100Rssc070 extends rssc_importHandler
{
    public $_DIRNAME_XOOPSHEADLINE = 'xoopsheadline';
    public $_xoopsheadlineHandler;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        rssc_importHandler::__construct(RSSC_DIRNAME);
        $this->set_mid_orig_by_dirname($this->_DIRNAME_XOOPSHEADLINE);

        $this->_xoopsheadlineHandler = Rssc\XoopsHeadlineHandler::getInstance($this->_DIRNAME_XOOPSHEADLINE);
    }

    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    //=========================================================
    // import from xoopsheadline
    //=========================================================
    public function hl_first_step()
    {
        $this->_hl_form_xoopsheadline();
    }

    public function hl_import_xoopsheadline()
    {
        echo "<h4>import link table</h4>\n";

        $offset = $this->get_post_offset();
        $next   = $this->calc_next();

        $total = $this->_xoopsheadlineHandler->get_count_all();
        $objs  = &$this->_xoopsheadlineHandler->get_objects_for_import($this->_LIMIT, $offset);

        echo 'There are <b>' . $total . "</b> xoopsheadline in XoopsHeadline<br>\n";
        echo 'Transfer ' . $offset . ' - ' . $next . " record <br><br>\n";

        foreach ($objs as $obj) {
            $rssc_lid = $this->import_link_common($obj);
        }

        if ($total > $next) {
            $this->_form_link($next);
        } else {
            $this->_print_finish();
        }
    }

    public function _hl_form_xoopsheadline()
    {
        $title  = 'import xoopsheadline';
        $op     = 'import_xoopsheadline';
        $submit = 'GO';

        $this->_print_form_next($title, $op, $submit);
    }

    // --- class end ---
}
