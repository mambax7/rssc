<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: feed_list_class.php,v 1.2 2012/03/18 08:27:06 ohwada Exp $

// 2012-03-01 K.OHWADA
// url_feed_column_manage

// 2007-11-01 K.OHWADA
// set_flag_print_request_uri()
// set_flag_execute_time()

// 2007-07-01 K.OHWADA
// divid from feed_list.php

//=========================================================
// RSS Center Module
// 2007-05-26 K.OHWADA
//=========================================================

// require_once RSSC_ROOT_PATH . '/class/rssc_feed_basic_handler.php';
// require_once RSSC_ROOT_PATH . '/class/rssc_feed_handler.php';

//=========================================================
// class admin list feed
//=========================================================
class FeedList extends Happylinux\PageFrame
{
    public $_post;
    public $_strings;

    public $_total_non_act = 0;
    public $_url_feed_column_manage;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $helper = Helper::getInstance();
        $this->set_handler('Feed', RSSC_DIRNAME, '', $helper);
        $this->set_id_name('fid');
        $this->set_max_sortid(4);

        $this->set_lang_title(_AM_RSSC_LIST_FEED);
        $this->set_submit_colspan(0, 3, 3);
        $this->set_flag_form(true);

        $this->set_form_name(FeedForm::class);
        $this->set_action('feed_manage.php');
        $this->set_operation('mod_all');
        $this->set_flag_print_request_uri(true);
        $this->set_flag_execute_time(true);

        // class instance
        $this->_post    = Happylinux\Post::getInstance();
        $this->_strings = Happylinux\Strings::getInstance();

        $this->_url_feed_column_manage = RSSC_URL . '/admin/feed_column_manage.php';
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
    // Pre processing
    //---------------------------------------------------------
    public function _get_total()
    {
        $this->_total_non_act = $this->handler->get_count_non_act();
        switch ($this->_sortid) {
            case 2:
            case 3:
                $total = $this->_total_non_act;
                break;
            case 0:
            case 1:
            default:
                $total = $this->handler->getCount();
                break;
        }

        return $total;
    }

    //---------------------------------------------------------
    // items
    //---------------------------------------------------------
    // Notice: Only variables should be assigned by reference
    public function _get_table_header()
    {
        $arr = [
            $this->build_form_js_checkall(),
            _RSSC_FEED_ID,
            _HAPPYLINUX_VIEW_TITLE,
            _HAPPYLINUX_VIEW_SITE_TITLE,
            _HAPPYLINUX_VIEW_UPDATED,
            _HAPPYLINUX_VIEW_CONTENT,
        ];

        return $arr;
    }

    public function &_get_items($limit = 0, $start = 0)
    {
        switch ($this->_sortid) {
            case 1:
                $objs = $this->handler->get_objects_desc($limit, $start);
                break;
            case 2:
                $objs = $this->handler->get_objects_non_act_asc($limit, $start);
                break;
            case 3:
                $objs = $this->handler->get_objects_non_act_desc($limit, $start);
                break;
            case 0:
            default:
                $objs = $this->handler->get_objects_asc($limit, $start);
                break;
        }

        return $objs;
    }

    public function &_get_cols($obj)
    {
        $fid          = $obj->getVar('fid');
        $updated_unix = $obj->getVar('updated_unix', 'n');
        $content      = $obj->getVar('content', 'n');

        $jump = 'feed_manage.php?op=mod_form&amp;fid=';

        if ($content) {
            $content_html = $this->_strings->build_summary($content, 50, 's');
        } else {
            $content_html = '&nbsp;';
        }

        $url_view_fid = RSSC_URL . '/single_feed.php?fid=' . $fid;
        $url_text_gif = RSSC_URL . '/images/text.gif';
        $img_link     = $this->build_html_img_tag($url_text_gif, 0, 0, 0, 'link');
        $view_feed    = $this->build_html_a_href_name($url_view_fid, $img_link, '', false);
        $link_feed    = $this->_build_page_id_link_by_obj($obj, 'fid', $jump);

        $arr = [
            $this->build_form_js_checkbox($fid),
            $view_feed . '&nbsp;&nbsp;' . $link_feed,
            $this->_build_page_name_link_by_obj($obj, 'link', 'title', '_blank'),
            $this->_build_page_name_link_by_obj($obj, 'site_link', 'site_title', '_blank'),
            formatTimestamp($updated_unix, 'mysql'),
            $content_html,
        ];

        return $arr;
    }

    public function _get_col_class($obj)
    {
        if (0 == $obj->getVar('act')) {
            return 'odd';
        }

        return '';
    }

    //---------------------------------------------------------
    // print
    //---------------------------------------------------------
    public function _print_top()
    {
        echo '<h4>' . _AM_RSSC_LIST_FEED . "</h4>\n";
        printf(_RSSC_THEREARE, $this->_get_total_all());
        echo "<br><br>\n";

        $this->_print_sub();
        $this->_print_index();
        $this->_print_condition();
    }

    public function _print_sub()
    {
        // dummy
    }

    public function _print_index()
    {
        $title = _HAPPYLINUX_ID_ASC;
        switch ($this->_sortid) {
            case 2:
                $title = _AM_RSSC_NON_ACT_ASC;
                break;
            case 3:
                $title = _AM_RSSC_NON_ACT_DESC;
                break;
            case 1:
                $title = _HAPPYLINUX_ID_DESC;
                break;
            case 0:
            case 1:
            default:
                break;
        }

        $total_non_act = '(0)';
        if ($this->_total_non_act) {
            $total_non_act = '(<b>' . $this->_total_non_act . '</b>)';
        }

        echo '<table width="80%" border="0" cellspacing="1" class="outer">';
        echo '<tr class="odd"><td>';
        echo '<ul>';
        echo '<li><a href="' . $this->_get_script_sortid(0) . '">' . _HAPPYLINUX_ID_ASC . "</a></li>\n";
        echo '<li><a href="' . $this->_get_script_sortid(1) . '">' . _HAPPYLINUX_ID_DESC . "</a></li>\n";
        echo '<li><a href="' . $this->_get_script_sortid(2) . '">' . _AM_RSSC_NON_ACT_ASC . '</a> ' . $total_non_act . "</li>\n";
        echo '<li><a href="' . $this->_get_script_sortid(3) . '">' . _AM_RSSC_NON_ACT_DESC . '</a> ' . $total_non_act . "</li>\n";
        echo '</ul>';
        echo '<ul>';
        echo '<li><a href="' . $this->_url_feed_column_manage . '">' . _AM_RSSC_FEED_COLUMN_MANAGE . "</a></li>\n";
        echo '</ul>';
        echo "</td></tr></table>\n";

        echo '<h4>' . $title . "</h4>\n";
    }

    public function _print_condition()
    {
        $condition = $this->_get_condition();
        if ($condition) {
            $total = $this->_get_total();
            printf(_AM_RSSC_THERE_ARE_MATCH, $total);
            echo "<br>\n";
            echo _AM_RSSC_CONDITION . ': ' . $condition . "<br><br>\n";
        }
    }

    public function _get_condition()
    {
        $condition = '';
        switch ($this->_sortid) {
            case 2:
            case 3:
                $condition = 'act = 0';
                break;
            case 0:
            case 1:
            default:
                break;
        }

        return $condition;
    }

    //---------------------------------------------------------
    // form
    //---------------------------------------------------------
    public function _build_page_col_submit($name=null, $value=null, $colspan=1)
    {
        $text = $this->build_html_td_tag_begin($this->_SUBMIT_ALIGN, $this->_SUBMIT_VALIGN, $colspan, $this->_SUBMIT_ROWSPAN, $this->_SUBMIT_CLASS);
        $text .= $this->build_html_input_submit('del_all', _DELETE);
        $text .= $this->build_html_input_submit('mod_all', _RSSC_FEED_ACT_NON);
        $text .= $this->build_html_td_tag_end();

        return $text;
    }

    //---------------------------------------------------------
    // script
    //---------------------------------------------------------
    public function _get_script_sortid($sortid)
    {
        $script = $this->_get_script() . '?sortid=' . $sortid;

        return $script;
    }

    public function _get_script()
    {
        $script = xoops_getenv('PHP_SELF');

        return $script;
    }

    // --- class end ---
}
