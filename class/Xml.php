<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_xml_handler.php,v 1.1 2011/12/29 14:37:17 ohwada Exp $

// 2007-11-24 K.OHWADA
// move create_table() to rssc_install.php

// 2007-11-01 K.OHWADA
// remove ; in tail of sql

// 2007-06-01 K.OHWADA
// divid from linkHandler

//=========================================================
// Rss Center Module
// this file contain 2 class
//   Xml
//   XmlHandler
// 2007-06-01 K.OHWADA
//=========================================================


    //=========================================================
    // class xml
    //=========================================================
    class Xml extends Happylinux\BaseObject
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            parent::__construct();

            $this->initVar('xid', XOBJ_DTYPE_INT, null, false);
            $this->initVar('lid', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('xml', XOBJ_DTYPE_TXTAREA);
            $this->initVar('aux_int_1', XOBJ_DTYPE_INT, 0);
            $this->initVar('aux_int_2', XOBJ_DTYPE_INT, 0);
            $this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);
        }

        //---------------------------------------------------------
        // set
        //---------------------------------------------------------
        public function set_vars_insert($lid)
        {
            $this->setVar('lid', $lid);
        }

        public function get_rawurldecode_xml()
        {
            $ret = false;
            $xml = $this->get('xml');
            if ($xml) {
                $ret = rawurldecode($xml);
            }

            return $ret;
        }

        // --- class end ---
    }
