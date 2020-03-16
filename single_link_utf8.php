<?php

use XoopsModules\Happylinux;

// $Id: single_link_utf8.php,v 1.1 2011/12/29 14:37:04 ohwada Exp $

// 2007-10-10 K.OHWADA
// PHP 5.2: Assigning the return value of new by reference
// BUG: Call to undefined method happy_linux_convert_encoding::set_internal_encoding()

// 2007-06-01 K.OHWADA
// use api/rss_builder.php
// link_basicHandler, xml_basicHandler

// 2006-11-08 K.OHWADA
// use basic_highlight
// use main_link_title_html
// use happy_linux_http_output

// 2006-09-01 K.OHWADA
// use main_search_title_html
// highlight_keyword

// 2006-07-10 K.OHWADA
// use happy_linux_post happy_linux_system
// support podcast

// 2006-06-04 K.OHWADA
// this is new file

//================================================================
// Rss center Module
// 2006-06-04 K.OHWADA
//================================================================

require __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/class/template.php';
require_once XOOPS_ROOT_PATH . '/modules/happylinux/api/rss_parser.php';
// require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/object.php';
// require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/object_handler.php';

$single = rssc_single_link_utf8::getInstance();

// http start
happy_linux_http_output('pass');
header('Content-Type:text/html; charset=utf-8');

// template
$RSSC_TEMPLATE_NAME = 'db:' . RSSC_DIRNAME . '_single_link_utf8.tpl';
$xoopsTpl           = new \XoopsTpl();

$lid  = $single->get_get_lid();
$mode = $single->get_get_mode();

$single->set_keyword_by_request();
$urlencode = $single->get_keywords_urlencode();

$feed      = [];
$link      = [];
$error     = '';
$link_show = 0;
$feed_show = 0;

if ($single->exists_link($lid)) {
    $data = $single->get_sanitized_parse_by_lid($lid, $mode);

    $link  = $data['link'];
    $feeds = $data['items'];

    if (is_array($link) && count($link)) {
        $link_show = 1;
        $xoopsTpl->assign('link', $link);
    }

    if (is_array($feeds) && count($feeds)) {
        $feed_show = 1;

        foreach ($feeds as $feed) {
            $xoopsTpl->append('feeds', $feed);
        }
    }
}

$xoopsTpl->assign('xoops_url', XOOPS_URL);
$xoopsTpl->assign('xoops_charset', $single->get_encoding());
$xoopsTpl->assign('xoops_sitename', $single->get_sitename());
$xoopsTpl->assign('module_name', $single->get_module_name());
$xoopsTpl->assign('is_module_admin', $single->is_module_admin());
$xoopsTpl->assign('xoops_themecss', xoops_getcss());

$xoopsTpl->assign('lang_single_link', $single->convert(_RSSC_SINGLE_LINK));
$xoopsTpl->assign('lang_no_record', $single->convert(_HAPPYLINUX_NO_RECORD));
$xoopsTpl->assign('lang_no_feed', $single->convert(_RSSC_NO_FEED));
$xoopsTpl->assign('lang_single_link_utf8', $single->convert(_RSSC_SINGLE_LINK_UTF8));

// podcast
$xoopsTpl->assign('lang_podcast', $single->convert(_RSSC_PODCAST));
$xoopsTpl->assign('unit_kb', RSSC_UNIT_KB);

$xoopsTpl->assign('dirname', RSSC_DIRNAME);
$xoopsTpl->assign('link_show', $link_show);
$xoopsTpl->assign('feed_show', $feed_show);
$xoopsTpl->assign('rssc_error', $error);
$xoopsTpl->assign('lid', $lid);
$xoopsTpl->assign('mode', $mode);
$xoopsTpl->assign('link', $link);
$xoopsTpl->assign('feed', $feed);
$xoopsTpl->assign('rssc_keywords', $urlencode);

$xoopsTpl->display($RSSC_TEMPLATE_NAME);

exit();
// --- main end ---

//=========================================================
// class rssc_single_link_utf8
//=========================================================
class rssc_single_link_utf8
{
    public $_linkHandler;
    public $_xmlHandler;
    public $_confHandler;
    public $_parser;
    public $_viewer;
    public $_system;
    public $_convert;
    public $_post;
    public $_strings;

    public $ENCODING_LOCAL = _CHARSET;
    public $ENCODING_UTF8  = 'UTF-8';

    public $_lid;
    public $_mode;
    public $_link_obj;

    public $_flag_highlight = false;
    public $_keyword_array  = null;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_confHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('ConfigBasic', RSSC_DIRNAME);
        $this->_linkHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('LinkBasic', RSSC_DIRNAME);
        $this->_xmlHandler  = \XoopsModules\Rssc\Helper::getInstance()->getHandler('XmlBasic', RSSC_DIRNAME);

        $this->_parser  = Happylinux\RssParser::getInstance();
        $this->_viewer  = Happylinux\Rss_viewer::getInstance();
        $this->_post    = Happylinux\Post::getInstance();
        $this->_system  = Happylinux\System::getInstance();
        $this->_convert = Happylinux\ConvertEncoding::getInstance();
        $this->_strings = Happylinux\Strings::getInstance();
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
    // function
    //---------------------------------------------------------
    public function exists_link($lid)
    {
        $ret = $this->_linkHandler->exists_by_lid($lid);

        return $ret;
    }

    public function &get_sanitized_parse_by_lid($lid, $mode)
    {
        $false = false;

        // BUG: Call to undefined method happy_linux_convert_encoding::set_internal_encoding()
        happy_linux_internal_encoding($this->ENCODING_UTF8);

        $conf  = &$this->_confHandler->get_conf();
        $limit = $conf['main_link_feeds_perlink'];

        $link = &$this->_linkHandler->get_link_by_lid($lid);
        if (!is_array($link)) {
            return $false;
        }

        $xml = &$this->_xmlHandler->get_xml_by_lid($lid);
        if (empty($xml)) {
            return $false;
        }

        $encoding = $link['encoding'];
        $title_s  = $link['title_s'];

        $link['title_u'] = $this->convert($title_s);

        $this->_parser->set_local_encoding($this->ENCODING_UTF8);

        $parse_obj = &$this->_parser->parse_by_xml($xml, $encoding);
        if (!is_object($parse_obj)) {
            return $false;
        }

        // PHP 5.2: Assigning the return value of new by reference
        $view_obj = $this->_viewer->create();
        $view_obj->set_vars($parse_obj->get_vars());
        $view_obj->view_format();
        $view_obj->set_is_japanese($this->_system->is_japanese());
        $view_obj->set_title_html($conf['main_link_title_html']);
        $view_obj->set_max_title($conf['main_link_max_title']);
        $view_obj->set_content_html($conf['main_link_content_html']);
        $view_obj->set_max_content($conf['main_link_max_content']);
        $view_obj->set_max_summary($conf['main_link_max_summary']);
        $view_obj->set_flag_highlight($conf['basic_highlight']);
        $view_obj->set_keyword_array($this->_keyword_array);
        $view_obj->view_sanitize();

        $parse_data = &$view_obj->get_vars();
        $items      = $parse_data['items'];
        $arr        = [];

        if (is_array($items) && count($items)) {
            $max = count($items);
            if ($max > $limit) {
                $max = $limit;
            }

            for ($i = 0; $i < $max; $i++) {
                $arr[$i] = $items[$i];
            }
        }

        $ret          = [];
        $ret['link']  = $link;
        $ret['items'] = $arr;

        return $ret;
    }

    public function get_encoding()
    {
        return $this->ENCODING_UTF8;
    }

    public function &convert($text)
    {
        $ret = $this->_convert->convert($text, $this->ENCODING_UTF8, $this->ENCODING_LOCAL);

        return $ret;
    }

    //---------------------------------------------------------
    // parameter
    //---------------------------------------------------------
    public function set_highlight($value)
    {
        $this->_flag_highlight = (bool)$value;
    }

    public function set_keyword_array($arr)
    {
        if (is_array($arr) && count($arr)) {
            $this->_keyword_array = $arr;
        }
    }

    public function set_keyword_by_request()
    {
        $this->set_keyword_array($this->_post->get_get_keyword_array());
    }

    public function get_keywords_urlencode()
    {
        return $this->_strings->urlencode_from_array($this->_keyword_array);
    }

    //---------------------------------------------------------
    // class system
    //---------------------------------------------------------
    public function is_module_admin()
    {
        return $this->_system->is_module_admin();
    }

    public function get_module_name()
    {
        return $this->convert($this->_system->get_module_name('s'));
    }

    public function get_sitename()
    {
        return $this->convert($this->_system->get_sitename());
    }

    //---------------------------------------------------------
    // class post
    //---------------------------------------------------------
    public function get_get_lid()
    {
        return $this->_post->get_get_int('lid');
    }

    public function get_get_mode()
    {
        return $this->_post->get_get_int('mode');
    }

    // --- class end ---
}
