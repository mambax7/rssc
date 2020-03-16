<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: XmlBasic.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2008-01-30 K.OHWADA
// bug: not save xml
// XmlBasic
// add_update_xml()

// 2007-06-01 K.OHWADA
// divid from link_basicHandler

//=========================================================
// Rss Center Module
// 2007-06-01 K.OHWADA
//=========================================================


    //=========================================================
    // class XmlBasic
    //=========================================================
    class XmlBasic extends Happylinux\BasicObject
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            parent::__construct();

            $this->init();
        }

        //---------------------------------------------------------
        // init
        //---------------------------------------------------------
        public function init()
        {
            $this->_vars = [
                'xid'        => 0,
                'lid'        => 0,
                'xml'        => '',
                'aux_int_1'  => 0,
                'aux_int_2'  => 0,
                'aux_text_1' => '',
                'aux_text_2' => '',
            ];
        }

        // --- class end ---
    }
