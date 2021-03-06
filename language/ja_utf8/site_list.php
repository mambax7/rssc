<?php
// $Id: site_list.php,v 1.1 2011/12/29 14:37:07 ohwada Exp $

// 2007-06-01 K.OHWADA
// move from class/rssc_site_list.php
// add google ,yahoo
// remove bulkfeeds

// 2006-04-17 K.OHWADA
// suppress notice : Only variable references should be returned by reference

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

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
            $site[1]['url']      = 'https://blogsearch.google.co.jp/blogsearch?hl=ja&lr=lang_ja&ie=utf-8&num=10&output=atom&q=';
            $site[1]['rss']      = 'https://blogsearch.google.co.jp/blogsearch_feeds?hl=ja&lr=lang_ja&ie=utf-8&num=10&output=atom&q=';
            $site[1]['mode']     = RSSC_C_MODE_ATOM;
            $site[1]['code']     = 'UTF-8';
            $site[1]['encoding'] = 'UTF-8';

            $site[2]['title']    = 'yahoo';
            $site[2]['url']      = 'https://blog-search.yahoo.co.jp/search?ei=utf-8&p=';
            $site[2]['rss']      = 'https://blog-search.yahoo.co.jp/rss?ei=utf-8&p=';
            $site[2]['mode']     = RSSC_C_MODE_RSS;
            $site[2]['code']     = 'UTF-8';
            $site[2]['encoding'] = 'UTF-8';

            $site[3]['title']    = 'livedoor';
            $site[3]['url']      = 'https://sf.livedoor.com/search?sf=update_date&q=';
            $site[3]['rss']      = 'https://rss.sf.livedoor.com/search?sf=update_date&start=0&q=';
            $site[3]['mode']     = RSSC_C_MODE_RDF;
            $site[3]['code']     = 'EUC-JP';
            $site[3]['encoding'] = 'UTF-8';

            return $site;
        }

        // this site dont work
        public function get_site_bulkfeeds()
        {
            $arr = [
                'title'    => 'bulkfeeds',
                'url'      => 'https://bulkfeeds.net/app/search2?q=',
                'rss'      => 'https://bulkfeeds.net/app/search2.rdf?q=',
                'mode'     => RSSC_C_MODE_RDF,
                'code'     => 'UTF-8',
                'encoding' => 'UTF-8',
            ];

            return $arr;
        }

        // this site dont work
        public function get_site_feedback()
        {
            $arr = [
                'title'    => 'FeedBack',
                'url'      => 'https://naoya.dyndns.org/feedback/app/rss?keyword=',
                'rss'      => 'https://naoya.dyndns.org/feedback/app/rss?keyword=',
                'mode'     => RSSC_C_MODE_RDF,
                'code'     => 'EUC-JP',
                'encoding' => 'UTF-8',
            ];

            return $arr;
        }

        // --- class end ---
    }
    // === class end ===
}
