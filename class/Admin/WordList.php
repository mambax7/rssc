<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: word_list.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-11-01 K.OHWADA
// BUG : dont work xoopsCheckAll
// WordSearchForm
// set_flag_print_request_uri()
// set_flag_execute_time()

//=========================================================
// RSS Center Module
// 2007-06-01 K.OHWADA
//=========================================================


//=========================================================
// class admin list word
//=========================================================
class WordList extends Happylinux\PageFrame
{
    public $_post;
    public $_search_word;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();


        $helper = Helper::getInstance();
        $this->set_handler('word', RSSC_DIRNAME, 'rssc', $helper);
        $this->set_id_name('sid');
        $this->set_max_sortid(9);

        $this->set_form_name('rssc_word');
        $this->set_action('word_manage.php');
        $this->set_operation('mod_all');
        $this->set_flag_form(true);
        $this->set_flag_print_sortid(true);
        $this->set_flag_print_request_uri(true);
        $this->set_submit_colspan(2, 1, 1);
        $this->set_flag_print_navi_pre(true);
        $this->set_flag_execute_time(true);

        $this->_post = Happylinux\Post::getInstance();
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
        $this->_search_word = $this->_post->get_get_text('word');

        switch ($this->_sortid) {
            case 8:
                $total = $this->handler->get_count_by_word_search($this->_search_word);
                break;
            case 0:
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            default:
                $total = $this->handler->getCount();
                break;
        }

        return $total;
    }

    //---------------------------------------------------------
    // function
    //---------------------------------------------------------
    public function &_get_table_header()
    {
        $arr = [
            $checkbox = $this->build_form_js_checkall(),
            _RSSC_WORD_ID,
            _RSSC_WORD_WORD,
            _RSSC_WORD_POINT,
            _RSSC_FREQ_COUNT,
        ];

        return $arr;
    }

    public function &_get_cols($obj)
    {
        $sid   = $obj->get('sid');
        $word  = $obj->get('word');
        $point = $obj->get('point');

        $jump = 'word_manage.php?op=mod_form&amp;sid=';

        $arr = [
            $this->build_form_js_checkbox($sid),
            $this->_build_page_id_link_by_obj($obj, 'sid', $jump),
            $this->build_html_input_text("word[$sid]", $word, 30),
            $this->build_html_input_text("point[$sid]", $point, 5),
            $this->_build_page_label_by_obj($obj, 'count'),
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
                $objs = $this->handler->get_objects_point_desc($limit, $start);
                break;
            case 3:
                $objs = $this->handler->get_objects_point_asc($limit, $start);
                break;
            case 4:
                $objs = $this->handler->get_objects_count_desc($limit, $start);
                break;
            case 5:
                $objs = $this->handler->get_objects_count_asc($limit, $start);
                break;
            case 6:
                $objs = $this->handler->get_objects_word_asc($limit, $start);
                break;
            case 7:
                $objs = $this->handler->get_objects_word_desc($limit, $start);
                break;
            case 8:
                $objs = $this->handler->get_objects_by_word_search($this->_search_word, $limit, $start);
                break;
            case 0:
            default:
                $objs = $this->handler->get_objects_asc($limit, $start);
                break;
        }

        return $objs;
    }

    //---------------------------------------------------------
    // print
    //---------------------------------------------------------
    public function _print_top()
    {
        $found = '';

        switch ($this->_sortid) {
            case 1:
                $title = _HAPPYLINUX_ID_DESC;
                break;
            case 2:
                $title = _AM_RSSC_POINT_DESC;
                break;
            case 3:
                $title = _AM_RSSC_POINT_ASC;
                break;
            case 4:
                $title = _AM_RSSC_COUNT_DESC;
                break;
            case 5:
                $title = _AM_RSSC_COUNT_ASC;
                break;
            case 6:
                $title = _AM_RSSC_WORD_ASC;
                break;
            case 7:
                $title = _AM_RSSC_WORD_DESC;
                break;
            case 8:
                $title = _HAPPYLINUX_ID_ASC;
                $found = sprintf(_SR_FOUND, $this->_get_total());
                break;
            case 0:
            default:
                $title = _HAPPYLINUX_ID_ASC;
                break;
        }

        echo '<h4>' . _AM_RSSC_LIST_WORD . "</h4>\n";
        printf(_RSSC_THEREARE, $this->_get_total_all());
        echo "<br><br>\n";

        echo "<table width='80%' border='0' cellspacing='1' class='outer'>";
        echo "<tr class='odd'><td>";
        echo "<li><a href='?sortid=0'>" . _HAPPYLINUX_ID_ASC . "</a></li>\n";
        echo "<li><a href='?sortid=1'>" . _HAPPYLINUX_ID_DESC . "</a></li>\n";
        echo "<li><a href='?sortid=2'>" . _AM_RSSC_POINT_DESC . "</a></li>\n";
        echo "<li><a href='?sortid=3'>" . _AM_RSSC_POINT_ASC . "</a></li>\n";
        echo "<li><a href='?sortid=4'>" . _AM_RSSC_COUNT_DESC . "</a></li>\n";
        echo "<li><a href='?sortid=5'>" . _AM_RSSC_COUNT_ASC . "</a></li>\n";
        echo "<li><a href='?sortid=6'>" . _AM_RSSC_WORD_ASC . "</a></li>\n";
        echo "<li><a href='?sortid=7'>" . _AM_RSSC_WORD_DESC . "</a></li>\n";
        echo "</td></tr></table>\n";

        echo '<h4>' . $title . "</h4>\n";

        $this->_print_search_form($found);
        echo $found . "<br>\n";
    }

    public function _build_page_submit($colspan1 = 1, $colspan2 = 2, $colspan3 = 0)
    {
        $text = '<tr>';
        $text .= $this->_build_page_col_submit('del_all', _DELETE, 2);
        $text .= $this->_build_page_col_submit('mod_all', _EDIT, 3);
        $text .= "</tr>\n";

        return $text;
    }

    public function _build_page_col_submit($name=null, $value=null, $colspan=1)
    {
        $text = $this->build_html_td_tag_begin($this->_SUBMIT_ALIGN, $this->_SUBMIT_VALIGN, $colspan, $this->_SUBMIT_ROWSPAN, $this->_SUBMIT_CLASS);
        $text .= $this->build_html_input_submit($name, $value);
        $text .= $this->build_html_td_tag_end();

        return $text;
    }

    public function _print_search_form()
    {
        // BUG : dont work xoopsCheckAll
        $form = WordSearchForm::getInstance();
        $form->print_search_form();
    }

    // --- class end ---
}
