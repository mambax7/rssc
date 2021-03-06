<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_xml_utility.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2007-06-01 K.OHWADA
// this file is interface to happy_linux_rss_utility

// 2006-12-02 K.OHWADA
// BUG 4389: cannot auto discovery RDF url

// 2006-11-08 K.OHWADA
// add set_proxy()

// 2006-09-20 K.OHWADA
// move discover_for_manage() from rssc_link_existHandler
// use set_error_code()

// 2006-07-10 K.OHWADA
// use happy_linux_error happy_linux_remote_file etc

// 2006-06-04 K.OHWADA
// add DEFAULT_ENCODINGS
// move get_unixtime_rfc822(), get_unixtime_w3cdtf() from parse_base
// move parse_by_url() to parseHandler
// suppress notice : Only variable references should be returned by reference

//=========================================================
// Rss Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
//---------------------------------------------------------
// define constant
//---------------------------------------------------------
define('RSSC_CODE_XML_ENCODINGS_DEFAULT', HAPPYLINUX_RSS_CODE_XML_ENCODINGS_DEFAULT);
define('RSSC_CODE_DISCOVER_SUCCEEDED', HAPPYLINUX_RSS_CODE_DISCOVER_SUCCEEDED);
define('RSSC_CODE_DISCOVER_FAILED', HAPPYLINUX_RSS_CODE_DISCOVER_FAILED);

//=========================================================
// class rssc_xml_utility
//=========================================================
class XmlUtility extends Happylinux\RssUtility
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

    //----- class end -----
}
// === class end ===

