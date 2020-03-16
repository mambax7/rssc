<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: parse_rss.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2008-01-30 K.OHWADA
// main()
// bug: break xoops cache if not set template

// 2007-11-01 K.OHWADA
// PHP 5.2: Assigning the return value of new by reference
// rssc_admin_print_footer()

// 2007-06-01 K.OHWADA
// api/refresh.php
// link_basicHandler xml_basicHandler
// get_lang_items()

// 2006-11-08 K.OHWADA
// use xoops_error()

// 2006-07-10 K.OHWADA
// move class RssForm from admin_form_class.php
// use happy_linux_error happy_linux_form
// change make_xxx to build_xxx
// support podcast

// 2006-06-04 K.OHWADA
// change file name from view_rss.php to parse_rss.php
// change to contant RSSC_DIRNAME
// use new handler

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class RssParse
//=========================================================
class RssParse extends Happylinux\Error
{
    // handler
    public $_configHandler;
    public $_refreshHandler;
    public $_viewHandler;
    public $_link_basicHandler;
    public $_xml_basicHandler;
    public $_parser;
    public $_post;
    public $_form;

    public $TEMPLATE_RDF;
    public $TEMPLATE_RSS;
    public $TEMPLATE_ATOM;

    public $_template;
    public $_result;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->_confHandler       = \XoopsModules\Rssc\Helper::getInstance()->getHandler('ConfigBasic', RSSC_DIRNAME);
        $this->_link_basicHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('LinkBasic', RSSC_DIRNAME);
        $this->_xml_basicHandler  = \XoopsModules\Rssc\Helper::getInstance()->getHandler('XmlBasic', RSSC_DIRNAME);
        $this->_refreshHandler    = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Refresh', RSSC_DIRNAME);
        $this->_viewHandler       = \XoopsModules\Rssc\Helper::getInstance()->getHandler('View', RSSC_DIRNAME);
        $this->_parser            = Happylinux\RssParser::getInstance();
        $this->_utility           = Happylinux\RssUtility::getInstance();
        $this->_post              = Happylinux\Post::getInstance();
        $this->_form              = RssForm::getInstance();

        $this->TEMPLATE_RDF  = RSSC_ROOT_PATH . '/templates/xml/rssc_view_rdf.tpl';
        $this->TEMPLATE_RSS  = RSSC_ROOT_PATH . '/templates/xml/rssc_view_rss.tpl';
        $this->TEMPLATE_ATOM = RSSC_ROOT_PATH . '/templates/xml/rssc_view_atom.tpl';
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
    // main
    //---------------------------------------------------------
    public function main()
    {
        echo '<h3>' . _AM_RSSC_PARSE_RSS . "</h3>\n";
        echo "<a href='#option'>" . _AM_RSSC_VIEW_RSS_OPTION . "</a><br><br>\n";

        $op  = $this->get_post_op();
        $lid = $this->get_post_get_lid();

        $param = &$this->get_param();

        if ($lid > 0) {
            if ($this->exists_link($lid)) {
                if ('param' == $op) {
                    $param = &$_POST;
                } else {
                    $param = &$this->get_param($lid);
                }

                $ret = $this->get_result($lid, $param);
                if ($ret) {
                    $this->display_tpl($param);
                }
            } else {
                echo "<font color='red'>" . _NO_RECORD . "</font><br>\n";
            }
        } else {
            echo "<font color='red'>" . _AM_RSSC_NOT_SELECT_LINK . "</font><br><br>\n";
            echo _AM_RSSC_PLEASE_SELECT_LINK . "<br>\n";
        }

        echo "<br>\n";
        echo "<a name='option'><h4>" . _AM_RSSC_VIEW_RSS_OPTION . "</h4></a>\n";

        $this->show_rss($param);
    }

    //---------------------------------------------------------
    // get link
    //---------------------------------------------------------
    public function exists_link($lid)
    {
        $ret = $this->_link_basicHandler->exists_by_lid($lid);

        return $ret;
    }

    public function &get_link_by_lid($lid)
    {
        $ret = &$this->_link_basicHandler->get_link_by_lid($lid);

        return $ret;
    }

    //---------------------------------------------------------
    // get param
    //---------------------------------------------------------
    public function &get_param($lid = '')
    {
        $false     = false;
        $conf_data = &$this->_confHandler->get_conf();

        $title    = '';
        $rdf_url  = '';
        $rss_url  = '';
        $atom_url = '';
        $rss_mode = '';

        if ($lid) {
            $link = &$this->get_link_by_lid($lid);
            if (!is_array($link)) {
                return $false;
            }

            $title    = $link['title'];
            $rdf_url  = $link['rdf_url'];
            $rss_url  = $link['rss_url'];
            $atom_url = $link['atom_url'];
            $rss_mode = $link['mode'];
        }

        $data = [
            'lid'             => $lid,
            'title'           => $title,
            'rdf_url'         => $rdf_url,
            'rss_url'         => $rss_url,
            'atom_url'        => $atom_url,
            'rss_mode'        => $rss_mode,
            'rss_atom'        => $conf_data['basic_rss_atom'],
            //		'parser_rss'    => $conf_data['basic_parser_rss'],
            'xml_save'        => $conf_data['basic_xml_save'],
            'mode_view'       => 0,
            'feed_perpage'    => 10,
            'sanitize'        => 1,
            'title_html'      => 1,
            'content_html'    => 1,
            'max_title'       => -1,
            'max_content'     => -1,
            'max_summary'     => -1,
            'link_update'     => 1,
            'feed_update'     => 1,
            'force_discover'  => 0,
            'force_update'    => 0,
            'force_overwrite' => 0,
            'print_log'       => 0,
            'print_error'     => 1,
        ];

        return $data;
    }

    public function get_result($lid, $param)
    {
        $link_obj = &$this->_link_basicHandler->get_cache_object_by_id($lid);
        if (!is_object($link_obj)) {
            xoops_error('no link object');

            return false;
        }

        $link_xml = &$this->_xml_basicHandler->get_xml_by_lid($lid);
        if (empty($link_xml)) {
            xoops_error('no xml data');

            return false;
        }

        $mode     = $param['mode_view'];
        $rss_mode = $param['rss_mode'];

        $link_encoding = $link_obj->get('encoding');
        $xml_url       = $link_obj->get_rssurl_select_by_mode($rss_mode);

        //	$this->_template = $this->get_template( $rss_mode );

        $this->_refreshHandler->set_debug_parse(1, $xml_url, $link_encoding, $rss_mode);
        //	$this->_refreshHandler->setRssParser(          $param['parser_rss'] );
        $this->_refreshHandler->set_link_update($param['link_update']);
        $this->_refreshHandler->set_feed_update($param['feed_update']);
        $this->_refreshHandler->set_xml_save($param['xml_save']);
        $this->_refreshHandler->set_force_discover($param['force_discover']);
        $this->_refreshHandler->set_force_refresh($param['force_update']);
        $this->_refreshHandler->set_force_overwrite($param['force_overwrite']);
        $this->_refreshHandler->set_debug_print_log($param['print_log']);
        $this->_refreshHandler->set_debug_print_error($param['print_error']);

        $this->_viewHandler->setFlagSanitize($param['sanitize']);
        $this->_viewHandler->setFeedStart(0);
        $this->_viewHandler->setFeedLimit($param['feed_perpage']);
        $this->_viewHandler->set_title_html($param['title_html']);
        $this->_viewHandler->set_content_html($param['content_html']);
        $this->_viewHandler->set_max_title($param['max_title']);
        $this->_viewHandler->set_max_content($param['max_content']);
        $this->_viewHandler->set_max_summary($param['max_summary']);

        if (1 == $mode) {
            $result = &$this->get_sanitized_parse_by_lid($lid);
        } elseif (2 == $mode) {
            if (!$this->_refreshHandler->refresh($lid)) {
                $this->_set_errors($this->_refreshHandler->getErrors());
            }

            $result = &$this->_viewHandler->get_sanitized_store_by_lid($lid);
        } else {
            $this->_refreshHandler->set_link_update(0);
            $this->_refreshHandler->set_feed_update(0);
            $this->_refreshHandler->set_force_refresh(1);

            if (!$this->_refreshHandler->refresh($lid)) {
                $this->_set_errors($this->_refreshHandler->getErrors());
            }

            $data   = &$this->_refreshHandler->getData();
            $result = &$this->_viewHandler->view_format_sanitize($data);
        }

        if ($this->_error_flag) {
            xoops_error($this->getErrors(1));
        }

        $this->_result = $result;

        return true;
    }

    public function &get_sanitized_parse_by_lid($lid)
    {
        $false = false;

        $link = &$this->get_link_by_lid($lid);
        if (!is_array($link)) {
            return $false;
        }

        $xml = &$this->_xml_basicHandler->get_xml_by_lid($lid);
        if (empty($xml)) {
            return $false;
        }

        $encoding = $link['encoding'];

        $parse_obj = &$this->_parser->parse_by_xml($xml, $encoding);
        if (!is_object($parse_obj)) {
            $this->_set_errors($this->_parser->getErrors());

            return $false;
        }

        $data1 = &$parse_obj->get_vars();

        // sanitize
        $data2 = &$this->_viewHandler->view_sanitize($data1);

        return $data2;
    }

    public function get_template($mode)
    {
        switch ($mode) {
            case RSSC_C_MODE_RDF:
                $template = $this->TEMPLATE_RDF;
                break;
            case RSSC_C_MODE_ATOM:
                $template = $this->TEMPLATE_ATOM;
                break;
            case RSSC_C_MODE_RSS:
            default:
                $template = $this->TEMPLATE_RSS;
                break;
        }

        return $template;
    }

    public function display_tpl($param)
    {
        $result = $this->_result;
        if (!is_array($result) || !count($result)) {
            xoops_error('display_tpl: no result');

            return false;
        }

        $rss_mode = $param['rss_mode'];
        $template = $this->get_template($rss_mode);

        $tpl = new \XoopsTpl();

        // bug: break xoops cache if not set template
        // clear template in update script since v0.70
        //	$tpl->clear_compiled_tpl( $template );
        //	$tpl->clear_cache( $template );

        $tpl->assign('xoops_url', XOOPS_URL);
        $tpl->assign_by_ref('channel', $result['channel']);
        $tpl->assign_by_ref('image', $result['image']);
        $tpl->assign_by_ref('textinput', $result['textinput']);

        if (isset($result['items']) && is_array($result['items'])) {
            foreach ($result['items'] as $item) {
                $tpl->append('items', $item);
            }
        }

        $tpl->assign($this->_utility->get_lang_items());

        $tpl->display($template);
    }

    //---------------------------------------------------------
    // show form
    //---------------------------------------------------------
    public function show_rss($data)
    {
        $lid = 0;
        if (isset($data['lid'])) {
            $lid = (int)$data['lid'];
        }

        if ($lid) {
            $link = &$this->get_link_by_lid($lid);
            if (is_array($link)) {
                $data['title']    = $link['title_s'];
                $data['rdf_url']  = $link['rdf_url_s'];
                $data['rss_url']  = $link['rss_url_s'];
                $data['atom_url'] = $link['atom_url_s'];
            }
        }

        $this->_form->show_rss($data);
    }

    //---------------------------------------------------------
    // class post
    //---------------------------------------------------------
    public function get_post_op()
    {
        return $this->_post->get_post('op');
    }

    public function get_post_get_lid()
    {
        return $this->_post->get_post_get_int('lid');
    }

    // --- class end ---
}
