<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: link_manage.php,v 1.4 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// rssc_map

// 2012-03-31 K.OHWADA
// default.gif

// 2012-03-01 K.OHWADA
// webmap3_api_gicon

// 2009-02-20 K.OHWADA
// _build_ele_gicon()

// 2008-01-20 K.OHWADA
// post_plugin

// 2007-11-01 K.OHWADA
// enclosure censor plugin
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// link_xmlHandler, xmlHandler
// api/refresh.php
// use get_ltype_option()
// use feed_list_lid.php

// 2007-05-19 K.OHWADA
// BUG: dont show admin frame

// 2006-09-20 K.OHWADA
// show bread crumb
// use XoopsGTicket
// add _refresh_link_error() etc
// use rssc_xml_utlity : not use rssc_link_existHandler
// use build_lib_button_hidden_array()
// use _check_url_by_post()
// use RSSC_CODE_PARSE_NOT_READ_XML_URL

// 2006-07-18 K.OHWADA
// BUG 4145: 'blong link' jump always 'rssc' directory

// 2006-07-08 K.OHWADA
// move class admin_manage_link from admin_manage_class.php
// move class admin_form_link   from admin_form_class.php
// use happy_linux_form happy_linux_post
// change make_xxx to build_xxx
// link exist check
//   add check_exist_rssurl()

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================


//=========================================================
// class link manage
//=========================================================
class LinkManage extends BaseManage
{
    public $_MODE             = RSSC_C_MODE_AUTO;    // auto discovery
    public $_REFRESH_INTERVAL = 86400;    // 24 hours
    public $_sel_rss_atom     = RSSC_C_SEL_ATOM;
    public $_HEADER           = 'Content-Type:text/xml; charset=utf-8';

    // handler
    public $_refreshHandler;
    public $_parser;
    public $_utility;

    // local
    public $_parse_result = '';

    // debug
    public $_FLAG_REFRESH_REDIRECT = true;
    public $_TIME_SUCCESS          = 1;
    public $_TIME_FAILED           = 5;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
       parent::__construct();

        $helper = Rssc\Helper::getInstance();
        $this->set_handler('LinkXml', RSSC_DIRNAME, 'rssc', $helper);
        $this->set_id_name('lid');
        $this->set_form_class(LinkForm::class);
        $this->set_script('link_manage.php');
        $this->set_redirect('link_list.php', 'link_list.php?sortid=1');
        $this->set_title(_AM_RSSC_ADD_LINK, _AM_RSSC_MOD_LINK, _AM_RSSC_DEL_LINK);
        $this->set_flag_execute_time(true);

        // handler

        $this->_refreshHandler = Helper::getInstance()->getHandler('Refresh', RSSC_DIRNAME);
        $this->_parser         = Happylinux\RssParser::getInstance();
        $this->_utility        = Happylinux\RssUtility::getInstance();
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
    // main_add_form()
    //---------------------------------------------------------
    public function main_add_form()
    {
        $this->_main_add_form();
    }

    public function _print_add_form()
    {
        $obj = $this->handler->create();
        $obj->set('uid', $this->_system->get_uid());
        $obj->set('mid', $this->_system->get_mid());
        $obj->set('mode', $this->_MODE);
        $obj->set('refresh', $this->_REFRESH_INTERVAL);

        $this->_form->_show_add($obj);

        return true;
    }

    //---------------------------------------------------------
    // main_add_table()
    //---------------------------------------------------------
    public function main_add_table()
    {
        $this->_clear_errors();

        if (!$this->_check_token() || !$this->_check_add_table()) {
            $this->_print_add_preview();
            exit();
        }

        if ($this->_exec_add_table()) {
            $this->_print_cp_header();
            $this->_print_bread_op(_AM_RSSC_ADD_LINK, 'add_form', _RSSC_REFRESH_LINK);
            $this->_print_title(_AM_RSSC_ADD_LINK);
            echo '<h4>' . _AM_RSSC_DBUPDATED . "</h4>\n";
            $this->_form->show_refresh_link($this->_newid, 0);

            // BUG: dont show admin frame
            $this->_print_cp_footer();

            exit();
        }
        $this->_print_add_db_error();
        exit();
    }

    public function _check_add_table()
    {
        $ret = $this->_check_add_mod();
        if (!$ret) {
            return false;
        }

        $ret = $this->_check_exist_rssurl();

        return $ret;
    }

    public function _check_add_mod()
    {
        $flag_rdf  = false;
        $flag_rss  = false;
        $flag_atom = false;

        $mode = $this->_post->get_post_int('mode');
        switch ($mode) {
            case RSSC_C_MODE_RDF:
                $flag_rdf = true;
                break;
            case RSSC_C_MODE_RSS:
                $flag_rss = true;
                break;
            case RSSC_C_MODE_ATOM:
                $flag_atom = true;
                break;
        }

        // check fill
        $this->_check_fill_by_post('title', _RSSC_SITE_TITLE);
        $this->_check_url_by_post('url', _RSSC_SITE_LINK);
        $this->_check_url_by_post('rdf_url', _RSSC_RDF_URL, $flag_rdf);
        $this->_check_url_by_post('rss_url', _RSSC_RSS_URL, $flag_rss);
        $this->_check_url_by_post('atom_url', _RSSC_ATOM_URL, $flag_atom);

        return $this->returnExistError();
    }

    public function _exec_add_table()
    {
        if ($this->_DEBUG_INSERT) {
            $obj = $this->handler->create();
            $obj->_set_vars_insert();
            $newid = $this->handler->insert($obj);
            if (!$newid) {
                $this->_set_errors($this->_LANG_FAIL_ADD);
                $this->_set_errors($this->handler->getErrors());

                return false;
            }

            $this->_newid = $newid;

            return true;
        }
        $this->_newid = $this - _DEBUG_NEWID;

        return true;
    }

    //---------------------------------------------------------
    // main_mod_form()
    //---------------------------------------------------------
    public function main_mod_form()
    {
        $this->_main_mod_form();
    }

    //---------------------------------------------------------
    // main_mod_table()
    //---------------------------------------------------------
    public function main_mod_table()
    {
        if (!$this->_get_obj()) {
            redirect_header($this->_redirect_asc, $this->_TIME_FAILED, $this->_LANG_ERR_NO_RECORD);
            exit();
        }

        if (!$this->_check_token() || !$this->_check_mod_table()) {
            $this->_print_mod_preview();
            exit();
        }

        // not need modfiy xml_table in _exec_mod_table()
        if ($this->_exec_mod_table()) {
            $this->_print_cp_header();
            $this->_print_bread_op(_AM_RSSC_MOD_LINK, 'mod_form', _RSSC_REFRESH_LINK);
            $this->_print_title(_AM_RSSC_MOD_LINK);
            echo '<h3>' . _AM_RSSC_DBUPDATED . "</h3>\n";
            $this->_form->show_refresh_link($this->_modid, 1);

            // BUG: dont show admin frame
            $this->_print_cp_footer();

            exit();
        }
        $this->_print_mod_db_error();
        exit();
    }

    public function _check_mod_table()
    {
        $this->_clear_errors();
        $this->_check_add_mod();

        return $this->returnExistError();
    }

    //---------------------------------------------------------
    // main_del_table()
    //---------------------------------------------------------
    public function main_del_table()
    {
        $this->_main_del_table(true);
    }

    //---------------------------------------------------------
    // main_addlink()
    //---------------------------------------------------------
    public function main_addlink()
    {
        $this->_print_cp_header();
        $this->_print_menu();
        $this->_print_title(_AM_RSSC_ADD_LINK);

        if (!$this->_print_add_link()) {
            $this->_print_error(1);
        }
    }

    public function _print_add_link()
    {
        $fid = $this->_post->get_get_int('fid');

        $feed = $this->_get_feed_by_fid($fid);
        if (!$feed) {
            return false;
        }

        $feed_title = $feed['title'];
        $feed_link  = $feed['link'];

        $parse_obj = &$this->_parser->discover_and_parse_by_html_url($feed_link);
        if (is_object($parse_obj)) {
            $title    = $parse_obj->get_channel_by_key('title');
            $url      = $parse_obj->get_channel_by_key('link');
            $xml_mode = $this->_parser->get_xml_mode();
            $rdf_url  = $this->_parser->get_rdf_url();
            $rss_url  = $this->_parser->get_rss_url();
            $atom_url = $this->_parser->get_atom_url();
            $encoding = $this->_parser->get_xml_encoding();
        } else {
            $title    = $feed_title;
            $url      = $feed_link;
            $xml_mode = $this->_MODE;
            $rdf_url  = '';
            $rss_url  = '';
            $atom_url = '';
            $encoding = '';
        }

        $obj = $this->handler->create();
        $obj->set('uid', $this->_system->get_uid());
        $obj->set('mid', $this->_system->get_mid());
        $obj->set('mode', (int)$xml_mode);
        $obj->set('refresh', $this->_REFRESH_INTERVAL);
        $obj->setVar('title', $title, true);
        $obj->setVar('url', $url, true);
        $obj->setVar('rdf_url', $rdf_url, true);
        $obj->setVar('rss_url', $rss_url, true);
        $obj->setVar('atom_url', $atom_url, true);
        $obj->setVar('encoding', $encoding, true);

        $this->_form->_show_add($obj);

        return true;
    }

    //---------------------------------------------------------
    // main_refresh_link()
    //---------------------------------------------------------
    public function main_refresh_link()
    {
        if ($this->_check_token() && $this->_exec_refresh_link()) {
            if ($this->_FLAG_REFRESH_REDIRECT) {
                $this->_refresh_link_redirect();
            }
            exit();
        }

        $this->_refresh_link_error();
    }

    public function _exec_refresh_link()
    {
        $lid = $this->_post->get_post_int('lid');
        $this->_refreshHandler->set_force_refresh(1);

        $ret = $this->_refreshHandler->refresh_link_for_add_link($lid);
        switch ($ret) {
            case 0:
                return true;
            case RSSC_CODE_PARSE_MSG:
                $this->_parse_result = $this->_refreshHandler->get_parse_result();

                return true;
            case RSSC_CODE_PARSE_NOT_READ_XML_URL:
                $this->_set_error_title(_RSSC_PARSE_NOT_READ_XML_URL);
                $this->_set_errors($this->_refreshHandler->getErrors());

                return false;
            case RSSC_CODE_PARSE_FAILED:
                $this->_set_error_title(_RSSC_PARSE_FAILED);
                $this->_set_errors($this->_refreshHandler->getErrors());

                return false;
            case RSSC_CODE_DB_ERROR:
                $this->_set_error_title(_RSSC_DB_ERROR);
                $this->_set_errors($this->_refreshHandler->getErrors());

                return false;
            case RSSC_CODE_REFRESH_ERROR:
            default:
                $this->_set_error_title(_RSSC_REFRESH_ERROR);
                $this->_set_errors($this->_refreshHandler->getErrors());

                return false;
        }

        return true;    // dummy
    }

    public function _refresh_link_redirect()
    {
        $op_mode = $this->_post->get_post_int('op_mode');

        if ($op_mode) {
            $redirect = $this->_redirect_asc;
        } else {
            $redirect = $this->_redirect_desc;
        }

        $time = $this->_TIME_SUCCESS;
        $msg  = _RSSC_REFRESH_LINK_FINISHED;

        if ($this->_parse_result) {
            $time = $this->_TIME_FAILED;
            $msg  .= '<br><br>';
            $msg  .= $this->_parse_result;
        }

        redirect_header($redirect, $time, $msg);
    }

    public function _refresh_link_error()
    {
        $op_mode = $this->_post->get_post_int('op_mode');

        if ($op_mode) {
            $title    = _AM_RSSC_MOD_LINK;
            $op       = 'mod_form';
            $redirect = $this->_redirect_asc;
        } else {
            $title    = _AM_RSSC_ADD_LINK;
            $op       = 'add_form';
            $redirect = $this->_redirect_desc;
        }

        $this->_print_cp_header();
        $this->_print_bread_op($title, $op);
        $this->_print_title($title);
        $this->_print_token_error(1);
        $this->_print_error(1);

        $lid = $this->_post->get_post_get_int('lid');
        $url = 'link_manage.php?op=mod_form&amp;lid=' . $lid;
        echo "<br><hr><br>\n";
        echo '- <a href="' . $redirect . '">' . _AM_RSSC_LIST_LINK . "</a><br>\n";
        echo '- <a href="' . $url . '">' . _AM_RSSC_MOD_LINK . "</a><br>\n";
    }

    //---------------------------------------------------------
    // check_exist_rssurl
    //---------------------------------------------------------
    public function _check_exist_rssurl()
    {
        // if force to add
        if ($this->_post->get_post('force')) {
            return true;
        }

        $mode     = $this->_post->get_post_int('mode');
        $url      = $this->_post->get_post_url('url');
        $rdf_url  = $this->_post->get_post_url('rdf_url');
        $rss_url  = $this->_post->get_post_url('rss_url');
        $atom_url = $this->_post->get_post_url('atom_url');

        $ret1 = $this->_utility->discover_for_manage($mode, $url, $rdf_url, $rss_url, $atom_url, $this->_sel_rss_atom);
        if (RSSC_CODE_DISCOVER_FAILED == $ret1) {
            $this->_set_error_title(_RSSC_DISCOVER_FAILED);
            $this->_set_errors($this->_utility->getErrors());
        }

        $mode     = $this->_utility->get_xml_mode();
        $rdf_url  = $this->_utility->get_rdf_url();
        $rss_url  = $this->_utility->get_rss_url();
        $atom_url = $this->_utility->get_atom_url();

        $list = $this->handler->get_list_by_rssurl($rdf_url, $rss_url, $atom_url);
        if (is_array($list) && count($list)) {
            $script = 'link_manage.php?op=mod_form&amp;lid=';
            $msg    = $this->handler->build_error_rssurl_list($list, $script);
            $err    = '<h4>' . _RSSC_LINK_ALREADY . "</h4>\n" . $msg;
            $this->_set_error_extra($err);

            return false;
        }

        $_POST['mode']     = $mode;
        $_POST['rdf_url']  = $rdf_url;
        $_POST['rss_url']  = $rss_url;
        $_POST['atom_url'] = $atom_url;

        return true;
    }

    //---------------------------------------------------------
    // view_channel()
    //---------------------------------------------------------
    public function view_channel()
    {
        if (!$this->_get_obj()) {
            redirect_header($this->_redirect_asc, $this->_TIME_FAILED, $this->_LANG_ERR_NO_RECORD);
            exit();
        }

        $this->_print_cp_header();
        $this->_print_bread_op($this->_LANG_TITLE_MOD, 'mod_form');
        $this->_print_title($this->_LANG_TITLE_MOD);
        $this->_form->show_channel($this->_obj);
        $this->_print_cp_footer();
    }

    public function view_xml()
    {
        if (!$this->_get_obj()) {
            redirect_header($this->_redirect_asc, $this->_TIME_FAILED, $this->_LANG_ERR_NO_RECORD);
            exit();
        }

        // xml file
        happy_linux_http_output('pass');
        header($this->_HEADER);
        echo $this->_form->get_xml($this->_obj);
        exit();
    }

    // --- class end ---
}
