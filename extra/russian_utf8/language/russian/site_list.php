<?php
// $Id: site_list.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2008-01-10 K.OHWADA
// for tranaslator

// 2007-06-01 K.OHWADA
// move from class/rssc_site_list.php

// 2006-04-17 K.OHWADA
// suppress notice : Only variable references should be returned by reference

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
// _LANGCODE: ru
// _CHARSET : utf-8
// Translator: Houston (Contour Design Studio https://www.cdesign.ru/)

//---------------------------------------------------------
// for tranaslator
//
// this file is for Keyword Manage
// please describe the RSS search site list
//
// RSS search site is such as following
// in English:  https://blogsearch.google.com/
// in Japanese: https://sf.livedoor.com/
//
// I dont know same site in other language
// Probably, Google or Yahoo will start the service in other language.
// If you know, please teach me
//---------------------------------------------------------

// === class begin ===
if (!class_exists('rssc_site_list')) {
    //=========================================================
    // class rssc_site_list
    //=========================================================
    class rssc_site_list
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            // dummy
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
        // public
        //---------------------------------------------------------
        public function get_site_list()
        {
            $site = [];

            $site[1]['title']    = 'google';
            $site[1]['url']      = 'https://blogsearch.google.com/blogsearch?hl=en&lr=lang_en&ie=utf-8&num=10&output=atom&q=';
            $site[1]['rss']      = 'https://blogsearch.google.com/blogsearch_feeds?hl=en&lr=lang_en&ie=utf-8&num=10&output=atom&q=';
            $site[1]['mode']     = RSSC_C_MODE_ATOM;
            $site[1]['code']     = 'UTF-8';
            $site[1]['encoding'] = 'UTF-8';

            return $site;
        }

        // --- class end ---
    }
    // === class end ===
}
