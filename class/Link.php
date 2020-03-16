<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;
use XoopsModules\Happylinux\BaseObject;

// $Id: rssc_link_handler.php,v 1.2 2012/04/10 03:06:50 ohwada Exp $

// 2012-04-02 K.OHWADA
// url XOBJ_DTYPE_URL -> XOBJ_DTYPE_URL_AREA

// 2009-02-20 K.OHWADA
// gicon_id

// 2008-01-20 K.OHWADA
// post_plugin in link

// 2007-11-24 K.OHWADA
// move add_column_table_xxx() to rssc_install.php

// 2007-10-10 K.OHWADA
// enclosure censor plugin in link

// 2007-06-01 K.OHWADA
// divid to xmlHandler
// add get_ltype_option()
// use Rssc\LinkBasic

// 2006-09-18 K.OHWADA
// move build_error_rssurl_list() from rssc_link_existHandler
// change _build_insert_sql() get_list_by_rssurl()

// 2006-07-10 K.OHWADA
// use happy_linux_object happy_linux_object_handler

// 2006-06-04 K.OHWADA
// add build_show(), get_export_channel()
// move refreshExpired(), update_xml_url(), etc to link_basic
// move _sanitize_link(), etc to xml_object
// use get_cache()
// suppress notice : Only variable references should be returned by reference

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// this file contain 2 class
//   rssc_link
//   rssc_link_handler
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class link
//=========================================================
class Link extends Happylinux\BaseObject
{
    public $_charset = _CHARSET;
    public $_link_basic;

    //---------------------------------------------------------
    // ltype : 1 = rss search site
    //---------------------------------------------------------

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->initVar('lid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('mid', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('p1', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('p2', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('p3', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('title', XOBJ_DTYPE_TXTBOX, null, true, 255);
        $this->initVar('url', XOBJ_DTYPE_URL_AREA);
        $this->initVar('ltype', XOBJ_DTYPE_INT, RSSC_C_LINK_LTYPE_NORMAL, false);
        $this->initVar('refresh', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('headline', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('mode', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('rdf_url', XOBJ_DTYPE_URL_AREA);
        $this->initVar('rss_url', XOBJ_DTYPE_URL_AREA);
        $this->initVar('atom_url', XOBJ_DTYPE_URL_AREA);
        $this->initVar('encoding', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('updated_unix', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('channel', XOBJ_DTYPE_TXTAREA);
        $this->initVar('xml', XOBJ_DTYPE_TXTAREA);
        $this->initVar('enclosure', XOBJ_DTYPE_INT, 1);
        $this->initVar('censor', XOBJ_DTYPE_TXTAREA);
        $this->initVar('plugin', XOBJ_DTYPE_TXTAREA);
        $this->initVar('post_plugin', XOBJ_DTYPE_TXTAREA);
        $this->initVar('icon', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('gicon_id', XOBJ_DTYPE_INT, 0);
        $this->initVar('aux_int_1', XOBJ_DTYPE_INT, 0);
        $this->initVar('aux_int_2', XOBJ_DTYPE_INT, 0);
        $this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
        $this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);

        $this->_link_basic = LinkBasic::getInstance();
    }

    //---------------------------------------------------------
    // set
    //---------------------------------------------------------
    public function set_vars_keyword($site)
    {
        if (isset($_POST['keyword'])) {
            $key = $_POST['keyword'];
        } else {
            return false;
        }

        $convert = Happylinux\ConvertEncoding::getInstance();

        $key_conv   = $convert->convert($key, $site['code'], $this->_charset);
        $key_encode = urlencode($key_conv);

        $title   = $site['title'] . ': ' . $key;
        $url     = $site['url'] . $key_encode;
        $rss_url = $site['rss'] . $key_encode;

        $this->setVars($_POST);
        $this->setVar('title', $title);
        $this->setVar('url', $url);
        $this->setVar('encoding', $site['encoding']);

        switch ($site['mode']) {
            case RSSC_C_MODE_RDF:
                $this->setVar('mode', RSSC_C_MODE_RDF);
                $this->setVar('rdf_url', $rss_url);
                break;
            case RSSC_C_MODE_ATOM:
                $this->setVar('mode', RSSC_C_MODE_ATOM);
                $this->setVar('atom_url', $rss_url);
                break;
            case RSSC_C_MODE_RSS:
            default:
                $this->setVar('mode', RSSC_C_MODE_RSS);
                $this->setVar('rss_url', $rss_url);
                break;
        }
    }

    //---------------------------------------------------------
    // get
    //---------------------------------------------------------
    public function get_rssurl_by_mode($format = 'n')
    {
        $mode     = $this->get('mode');
        $rdf_url  = $this->get('rdf_url');
        $rss_url  = $this->get('rss_url');
        $atom_url = $this->get('atom_url');
        $val      = $this->_link_basic->_get_rssurl_by_mode_url($mode, $rdf_url, $rss_url, $atom_url);

        $val = $this->sanitize_format_url($val, $format);

        return $val;
    }

    public function get_rss_icon_by_mode()
    {
        $ret = $this->_link_basic->_get_rss_icon_by_mode($this->get('mode'));

        return $ret;
    }

    public function _format_time($unixtime, $format)
    {
        if ($unixtime) {
            $text = formatTimestamp($unixtime, $format);

            return $text;
        }

        return false;
    }

    public function &get_channel()
    {
        $ret = &$this->getVarArray('channel');

        return $ret;
    }

    public function get_mode_name()
    {
        $mode = $this->get('mode');
        $arr  = &$this->get_mode_array();
        if (isset($arr[$mode])) {
            return $arr[$mode];
        }

        return false;
    }

    public function &get_mode_array()
    {
        $arr = [
            RSSC_C_MODE_NON  => _RSSC_RSS_MODE_NON,
            RSSC_C_MODE_AUTO => _RSSC_RSS_MODE_AUTO,
            RSSC_C_MODE_RDF  => _RSSC_RSS_MODE_RDF,
            RSSC_C_MODE_RSS  => _RSSC_RSS_MODE_RSS,
            RSSC_C_MODE_ATOM => _RSSC_RSS_MODE_ATOM,
        ];

        return $arr;
    }

    public function &get_mode_option()
    {
        $arr = array_flip($this->get_mode_array());

        return $arr;
    }

    public function &get_ltype_option()
    {
        $arr = [
            _RSSC_LTYPE_NON    => RSSC_C_LINK_LTYPE_NON,
            _RSSC_LTYPE_SEARCH => RSSC_C_LINK_LTYPE_SEARCH,
            _RSSC_LTYPE_NORMAL => RSSC_C_LINK_LTYPE_NORMAL,
        ];

        return $arr;
    }

    public function &get_enclosure_option()
    {
        $arr = [
            _RSSC_LINK_ENCLOSURE_NON => RSSC_C_LINK_ENCLOSURE_NON,
            _RSSC_LINK_ENCLOSURE_POD => RSSC_C_LINK_ENCLOSURE_POD,
        ];

        return $arr;
    }

    // --- class end ---
}
