<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_black_handler.php,v 1.1 2011/12/29 14:37:16 ohwada Exp $

// 2007-11-24 K.OHWADA
// move add_column_table_xxx() to rssc_install.php

// 2007-10-10 K.OHWADA
// add field cache ctime in black, white

// 2007-06-01 K.OHWADA
// add field act reg count

// 2006-07-10 K.OHWADA
// use happy_linux_object happy_linux_object_handler

// 2006-06-04 K.OHWADA
// suppress notice : Only variable references should be returned by reference

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// this file contain 2 class
//   rssc_black
//   rssc_blackHandler
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class black
//=========================================================
class Black extends Happylinux\BaseObject
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->initVar('bid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('lid', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('mid', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('p1', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('p2', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('p3', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('title', XOBJ_DTYPE_TXTBOX, null, false, 255);
        $this->initVar('url', XOBJ_DTYPE_URL, null, false, 255);
        $this->initVar('memo', XOBJ_DTYPE_TXTAREA);
        $this->initVar('aux_int_1', XOBJ_DTYPE_INT, 0);
        $this->initVar('aux_int_2', XOBJ_DTYPE_INT, 0);
        $this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
        $this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);
        $this->initVar('act', XOBJ_DTYPE_INT, 1);
        $this->initVar('reg', XOBJ_DTYPE_INT, 0);
        $this->initVar('count', XOBJ_DTYPE_INT, 0);

        $this->initVar('cache', XOBJ_DTYPE_INT, 0);
        $this->initVar('ctime', XOBJ_DTYPE_INT, 0);
    }

    // --- class end ---
}
