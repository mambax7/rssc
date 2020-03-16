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
// class RssForm
//=========================================================
class RssForm extends Happylinux\Form
{
    public $_linkHandler;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->_linkHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Link', RSSC_DIRNAME);
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
    // show form
    //---------------------------------------------------------
    public function show_rss($data)
    {
        $this->set_datas($data);

        // form start
        echo $this->build_form_begin('rss');
        echo $this->build_xoops_token();
        echo $this->build_html_input_hidden('op', 'param');
        echo $this->build_form_table_begin();
        echo $this->build_form_table_title(_AM_RSSC_VIEW_RSS);

        echo $this->build_data_table_text(_RSSC_LINK_ID, 'lid');
        echo $this->build_data_table_label_hidden(_RSSC_SITE_TITLE, 'title');
        $this->_print_sel_mode();
        $this->_print_text('feed_perpage');
        $this->_print_yesno('sanitize');
        $this->_print_yesno('title_html');
        $this->_print_yesno('content_html');
        $this->_print_text('max_title');
        $this->_print_text('max_content');
        $this->_print_text('max_summary');

        echo $this->build_form_table_title(_AM_RSSC_VIEW_PARSER);
        echo $this->build_data_table_label_hidden(_RSSC_RDF_URL, 'rdf_url');
        echo $this->build_data_table_label_hidden(_RSSC_RSS_URL, 'rss_url');
        echo $this->build_data_table_label_hidden(_RSSC_ATOM_URL, 'atom_url');
        $this->_print_sel_rss_mode();
        //	$this->_print_sel_parser_rss();
        //	$this->_print_sel_parser_atom();
        $this->_print_yesno('force_discover');

        echo $this->build_form_table_title(_AM_RSSC_VIEW_SAVE_ETC);
        $this->_print_yesno('link_update');
        $this->_print_yesno('xml_save');
        $this->_print_yesno('feed_update');
        $this->_print_yesno('force_update');
        $this->_print_yesno('force_overwrite');
        $this->_print_yesno('print_log');
        $this->_print_yesno('print_error');

        $ele_submit = $this->build_html_input_submit('submit', _HAPPYLINUX_EXECUTE);
        echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

        echo $this->build_form_table_end();
        echo $this->build_form_end();
    }

    //---------------------------------------------------------
    // private
    //---------------------------------------------------------
    public function _print_label_hidden($name)
    {
        $cap = $this->_make_admin_caption($name);
        echo $this->build_data_table_label_hidden($cap, $name);
    }

    public function _print_text($name)
    {
        $cap = $this->_make_admin_caption($name);
        echo $this->build_data_table_text($cap, $name);
    }

    public function _print_yesno($name)
    {
        $cap = $this->_make_admin_caption($name);
        echo $this->build_data_table_radio_yesno($cap, $name);
    }

    public function _print_sel_mode()
    {
        $options = [
            _AM_RSSC_VIEW_MODE_CURRENT => RSSC_C_VIEW_CURRENT,
            _AM_RSSC_VIEW_MODE_LINK    => RSSC_C_VIEW_LINK,
            _AM_RSSC_VIEW_MODE_FEED    => RSSC_C_VIEW_FEED,
        ];

        $cap = $this->build_form_caption(_AM_RSSC_VIEW_MODE, _AM_RSSC_VIEW_MODE_DESC);
        $ele = $this->build_html_input_radio_select('mode_view', $this->_datas['mode_view'], $options, '<br>');
        echo $this->build_form_table_line($cap, $ele);
    }

    public function _print_sel_rss_atom()
    {
        $options = [
            _AM_RSSC_CONF_RSS_ATOM_SEL_RSS  => RSSC_C_SEL_RSS,
            _AM_RSSC_CONF_RSS_ATOM_SEL_ATOM => RSSC_C_SEL_ATOM,
        ];

        $cap = $this->build_form_caption(_AM_RSSC_CONF_RSS_ATOM, _AM_RSSC_CONF_RSS_ATOM_DESC);
        $ele = $this->build_html_input_radio_select('rss_atom', $this->_datas['rss_atom'], $options, '<br>');
        echo $this->build_form_table_line($cap, $ele);
    }

    //function _print_sel_parser_rss()
    //{
    //	$options = array(
    //		_AM_RSSC_CONF_RSS_PARSER_XOOPS => RSSC_C_PARSER_RSS_XOOPS,
    //		_AM_RSSC_CONF_RSS_PARSER_SELF  => RSSC_C_PARSER_RSS_SELF
    //		);
    //	$cap = $this->build_form_caption(_AM_RSSC_CONF_RSS_PARSER);
    //	$ele = $this->build_html_input_radio_select('parser_rss', $this->_datas['parser_rss'], $options, '<br>');
    //	echo $this->build_form_table_line($cap, $ele);
    //}

    public function _print_sel_rss_mode()
    {
        // PHP 5.2: Assigning the return value of new by reference
        $mode_opt = $this->_linkHandler->get_mode_option();
        $ele_mode = $this->build_html_input_radio_select('rss_mode', $this->_datas['rss_mode'], $mode_opt);
        echo $this->build_form_table_line(_RSSC_RSS_MODE, $ele_mode);
    }

    public function _make_admin_caption($keyword)
    {
        $const_title = '_AM_RSSC_VIEW_' . mb_strtoupper($keyword);
        $const_desc  = $const_title . '_DESC';
        $title       = '';
        $desc        = '';

        if (defined($const_title)) {
            $title = constant($const_title);
        } else {
            $title = $const_title;
        }

        if (defined($const_desc)) {
            $desc = constant($const_desc);
        }

        $ret = $this->build_form_caption($title, $desc);

        return $ret;
    }

    // --- class end ---
}
