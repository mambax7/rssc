<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;
use XoopsModules\Rssc;

// $Id: LinkExistHandler.php,v 1.1 2011/12/29 14:37:17 ohwada Exp $

// 2006-09-01 K.OHWADA
// use RSSC_CODE_DISCOVER_FAILED
// add discover()

// 2006-07-10 K.OHWADA
// this is new file
// use happy_linux_error

//=========================================================
// Rss Center Module
// 2006-07-02 K.OHWADA
//=========================================================


    //=========================================================
    // class rssc_link_existHandler
    //=========================================================
    class LinkExistHandler extends Happylinux\Error
    {
        // class instance
        public $_linkHandler;
        public $_xml_utility;

        // result
        public $_xml_mode;
        public $_rdf_url;
        public $_rss_url;
        public $_atom_url;
        public $_rssurl_list;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct();

            // class instance
            $this->_linkHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Link', $dirname);
            $this->_xml_utility = XmlUtility::getInstance();
        }

        //---------------------------------------------------------
        // check_exist_rssurl
        // for admin/link_manage.php
        //---------------------------------------------------------
        public function discover($mode, $url, $rdf_url, $rss_url, $atom_url, $sel)
        {
            $ret_code = 0;

            // RSS auto discovery
            if (RSSC_C_MODE_AUTO == $mode) {
                $ret = $this->_xml_utility->discover($url, $sel);
                if ($ret) {
                    $ret_code      = RSSC_CODE_DISCOVER_SUCCEEDED;
                    $mode          = $this->_xml_utility->get_xml_mode();
                    $auto_rdf_url  = $this->_xml_utility->get_rdf_url();
                    $auto_rss_url  = $this->_xml_utility->get_rss_url();
                    $auto_atom_url = $this->_xml_utility->get_atom_url();

                    if ($auto_rdf_url) {
                        $rdf_url = $auto_rdf_url;
                    }

                    if ($auto_rss_url) {
                        $rss_url = $auto_rss_url;
                    }

                    if ($auto_atom_url) {
                        $atom_url = $auto_atom_url;
                    }
                } else {
                    // cannot discover xml link
                    $ret_code = RSSC_CODE_DISCOVER_FAILED;
                    $this->_set_errors('cannot discover xml link');
                    $this->_set_errors($this->_xml_utility->getErrors());
                }
            }

            $this->_xml_mode = $mode;
            $this->_rdf_url  = $rdf_url;
            $this->_rss_url  = $rss_url;
            $this->_atom_url = $atom_url;

            return $ret_code;
        }

        public function check_exist_rssurl($rdf_url, $rss_url, $atom_url, $lid = 0)
        {
            $ret                = false;
            $list               = &$this->_linkHandler->get_list_by_rssurl($rdf_url, $rss_url, $atom_url, $lid);
            $this->_rssurl_list = $list;
            if (is_array($list) && (count($list) > 0)) {
                $ret = true;
            }

            return $ret;
        }

        public function get_list_by_rssurl($rdf_url, $rss_url, $atom_url)
        {
            $list = &$this->_linkHandler->get_list_by_rssurl($rdf_url, $rss_url, $atom_url);

            return $list;
        }

        public function build_error_rssurl_list($list, $script)
        {
            $msg = '';
            if (is_array($list) && (count($list) > 0)) {
                $msg = '<ul>';

                foreach ($list as $lid) {
                    $msg .= $this->_build_error_rssurl_list_single($lid, $script);
                }

                $msg .= "</ul>\n";
                $this->_set_errors($msg);
            }

            return $msg;
        }

        public function _build_error_rssurl_list_single($lid, $script)
        {
            $obj = $this->_linkHandler->get($lid);
            if (!is_object($obj)) {
                return '';
            }

            $lid_p   = sprintf('%03d', $lid);
            $url_l   = $script . $lid;
            $title_s = $obj->getVar('title');
            $url_s   = $obj->getVar('url');

            $text = '<li>';
            $text .= '<a href="' . $url_l . '" target="_blank">' . $lid_p . '</a> : ';
            $text .= '<a href="' . $url_s . '" target="_blank">' . $title_s . '</a> ';
            $text .= "</li>\n";

            return $text;
        }

        public function get_xml_mode()
        {
            return $this->_xml_mode;
        }

        public function get_rdf_url()
        {
            return $this->_rdf_url;
        }

        public function get_rss_url()
        {
            return $this->_rss_url;
        }

        public function get_atom_url()
        {
            return $this->_atom_url;
        }

        public function get_rssurl_list()
        {
            return $this->_rssurl_list;
        }

        // --- class end ---
    }
    // === class end ===

