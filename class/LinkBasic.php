<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_link_basic_handler.php,v 1.1 2011/12/29 14:37:15 ohwada Exp $

// 2008-01-30 K.OHWADA
// get_cache_post_plugin_by_lid()

// 2007-10-10 K.OHWADA
// enclosure

// 2007-06-01 K.OHWADA
// divid to xml_basicHandler
// get_link_by_lid() etc

// 2006-09-20 K.OHWADA
// small change

// 2006-07-10 K.OHWADA
// use happy_linux_basic happy_linux_basic_handler

// 2006-06-04 K.OHWADA
// this is new file
// move from linkHandler

//=========================================================
// Rss Center Module
// 2006-06-04 K.OHWADA
//=========================================================

    //=========================================================
    // class LinkBasic
    //=========================================================
    class LinkBasic extends Happylinux\BasicObject
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

        //---------------------------------------------------------
        // show
        //---------------------------------------------------------
        public function &get_show()
        {
            $time     = (int)$this->get('updated_unix');
            $title    = $this->get('title');
            $url      = $this->get('url');
            $rdf_url  = $this->get('rdf_url');
            $rss_url  = $this->get('rss_url');
            $atom_url = $this->get('atom_url');
            $encoding = $this->get('encoding');
            $url_xml  = $this->get_rssurl_by_mode();
            $icon     = $this->_get_rss_icon_by_mode($this->get('mode'));

            $arr = [
                'lid'            => (int)$this->get('lid'),
                'uid'            => (int)$this->get('uid'),
                'mid'            => (int)$this->get('mid'),
                'p1'             => (int)$this->get('p1'),
                'p2'             => (int)$this->get('p2'),
                'p3'             => (int)$this->get('p3'),
                'ltype'          => (int)$this->get('ltype'),
                'refresh'        => (int)$this->get('refresh'),
                'headline'       => (int)$this->get('headline'),
                'mode'           => (int)$this->get('mode'),
                'updated_unix'   => $time,
                'title'          => $title,
                'url'            => $url,
                'rdf_url'        => $rdf_url,
                'rss_url'        => $rss_url,
                'atom_url'       => $atom_url,
                'encoding'       => $encoding,
                'url_xml'        => $url_xml,
                'icon'           => $icon,
                'title_s'        => $this->sanitize_text($title),
                'url_s'          => $this->sanitize_url($url),
                'rdf_url_s'      => $this->sanitize_url($rdf_url),
                'rss_url_s'      => $this->sanitize_url($rss_url),
                'atom_url_s'     => $this->sanitize_url($atom_url),
                'encoding_s'     => $this->sanitize_text($encoding),
                'url_xml_s'      => $this->sanitize_url($url_xml),
                'icon_s'         => $this->sanitize_text($icon),
                'updated_long'   => formatTimestamp($time, 'l'),
                'updated_middle' => formatTimestamp($time, 'm'),
                'updated_short'  => formatTimestamp($time, 's'),
                'updated_mysql'  => formatTimestamp($time, 'mysql'),
            ];

            return $arr;
        }

        //---------------------------------------------------------
        // element
        //---------------------------------------------------------
        // refreshHandler
        public function get_rssurl_by_mode()
        {
            $mode     = $this->get('mode');
            $rdf_url  = $this->get('rdf_url');
            $rss_url  = $this->get('rss_url');
            $atom_url = $this->get('atom_url');
            $ret      = $this->_get_rssurl_by_mode_url($mode, $rdf_url, $rss_url, $atom_url);

            return $ret;
        }

        // admin/parse_rss.php
        public function get_rssurl_select_by_mode($mode)
        {
            $rdf_url  = $this->get('rdf_url');
            $rss_url  = $this->get('rss_url');
            $atom_url = $this->get('atom_url');
            $ret      = $this->_get_rssurl_by_mode_url($mode, $rdf_url, $rss_url, $atom_url);

            return $ret;
        }

        public function _get_rssurl_by_mode_url($mode, $rdf_url, $rss_url, $atom_url)
        {
            $val = false;
            switch ($mode) {
                case RSSC_C_MODE_RDF:
                    $val = $rdf_url;
                    break;
                case RSSC_C_MODE_RSS:
                    $val = $rss_url;
                    break;
                case RSSC_C_MODE_ATOM:
                    $val = $atom_url;
                    break;
            }

            return $val;
        }

        public function _get_rss_icon_by_mode($mode)
        {
            switch ($mode) {
                case RSSC_C_MODE_RDF:
                    return 'rdf.png';
                    break;
                case RSSC_C_MODE_RSS:
                    return 'rss.png';
                    break;
                case RSSC_C_MODE_ATOM:
                    return 'atom.png';
                    break;
            }

            return false;
        }

        public function refresh_expired()
        {
            if (time() > ($this->get('refresh') + $this->get('updated_unix'))) {
                return true;
            }

            return false;
        }

        public function &get_channel()
        {
            $ret = &$this->getVarArray('channel');

            return $ret;
        }

        // --- class end ---
    }
