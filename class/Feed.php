<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_feed_handler.php,v 1.3 2012/04/10 03:06:50 ohwada Exp $

// 2012-04-02 K.OHWADA
// site_link XOBJ_DTYPE_URL -> XOBJ_DTYPE_URL_AREA

// 2011-12-29 K.OHWADA
// PHP 5.3 : Assigning the return value of new by reference is now deprecated.

// 2009-02-20 K.OHWADA
// geo_lat

// 2008-02-24 K.OHWADA
// change varchar to text: link

// 2007-11-24 K.OHWADA
// move add_column_table_xxx() to rssc_install.php

// 2007-10-10 K.OHWADA
// match https://xxx/*https://yyy/

// 2007-07-01 K.OHWADA
// add act field
// add get_objects_non_act() etc

// 2006-09-01 K.OHWADA
// add get_objects_latest()   : remove get_latest()
// add get_objects_by_where() : remove get_feeds_by_where()
// add get_count_by_mid() get_objects_by_mid_order()
// remove get_feed_by_fid() get_feeds_by_lid()

// 2006-07-10 K.OHWADA
// use happy_linux_object happy_linux_object_handler
// use happy_linux_strings
// support podcast

// 2006-06-29 K.OHWADA
// get_objects_by_lid_desc
// get_objects_by_link_desc

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// class feed
// this file contain 2 class
//   Feed
//   FeedHandler
// 2006-01-01 K.OHWADA
//=========================================================

    //=========================================================
    // class feed
    //=========================================================

    class Feed extends Happylinux\BaseObject
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            parent::__construct();

            $this->initVar('fid', XOBJ_DTYPE_INT, null, false);
            $this->initVar('lid', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('mid', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('p1', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('p2', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('p3', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('site_title', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('site_link', XOBJ_DTYPE_URL_AREA);
            $this->initVar('title', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('link', XOBJ_DTYPE_URL_AREA);
            $this->initVar('entry_id', XOBJ_DTYPE_URL_AREA);
            $this->initVar('guid', XOBJ_DTYPE_URL_AREA);
            $this->initVar('updated_unix', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('published_unix', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('category', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('author_name', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('author_uri', XOBJ_DTYPE_URL_AREA);
            $this->initVar('author_email', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('type_cont', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('raws', XOBJ_DTYPE_TXTAREA);
            $this->initVar('content', XOBJ_DTYPE_TXTAREA);
            $this->initVar('search', XOBJ_DTYPE_TXTAREA);
            $this->initVar('aux_int_1', XOBJ_DTYPE_INT, 0);
            $this->initVar('aux_int_2', XOBJ_DTYPE_INT, 0);
            $this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);

            // enclosure
            $this->initVar('enclosure_url', XOBJ_DTYPE_URL_AREA);
            $this->initVar('enclosure_type', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('enclosure_length', XOBJ_DTYPE_INT, 0);

            $this->initVar('act', XOBJ_DTYPE_INT, 1);

            // geo
            $this->initVar('geo_lat', XOBJ_DTYPE_FLOAT, 0);
            $this->initVar('geo_long', XOBJ_DTYPE_FLOAT, 0);
//            $this->initVar('geo_lat', XOBJ_DTYPE_DECIMAL, 0);
//            $this->initVar('geo_long', XOBJ_DTYPE_DECIMAL, 0);

            // media
            $this->initVar('media_content_url', XOBJ_DTYPE_URL_AREA);
            $this->initVar('media_content_type', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('media_content_medium', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('media_content_filesize', XOBJ_DTYPE_INT, 0);
            $this->initVar('media_content_width', XOBJ_DTYPE_INT, 0);
            $this->initVar('media_content_height', XOBJ_DTYPE_INT, 0);
            $this->initVar('media_thumbnail_url', XOBJ_DTYPE_URL_AREA);
            $this->initVar('media_thumbnail_width', XOBJ_DTYPE_INT, 0);
            $this->initVar('media_thumbnail_height', XOBJ_DTYPE_INT, 0);
        }

        //---------------------------------------------------------
        // function
        //---------------------------------------------------------
        public function &get_raws()
        {
            $ret = &$this->getVarArray('raws');

            return $ret;
        }

        public function &get_export_raws()
        {
            $raws = &$this->get_raws();
            $text = var_export($raws, true);
            $ret  = htmlspecialchars($text, ENT_QUOTES);

            return $ret;
        }

        public function get_act_option()
        {
            $opt = [
                _RSSC_FEED_ACT_NON  => 0,
                _RSSC_FEED_ACT_VIEW => 1,
            ];

            return $opt;
        }

        // --- class end ---
    }
