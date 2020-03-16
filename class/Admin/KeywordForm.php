<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: keyword_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-111-01 K.OHWADA
// set_flag_execute_time()
// _KEYWORD => _RSSC_KEYWORD

// 2007-06-01 K.OHWADA
// link_xmlHandler
// include file under local language

// 2006-09-18 K.OHWADA
// show bread crumb
// use _check_fill_by_post()

// 2006-07-10 K.OHWADA
// move class admin_manage_keyword from admin_manage_class.php
// use happy_linux_form happy_linux_convert_encoding
// change make_xxx to build_xxx

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class admin_form_keyword
//=========================================================
class KeywordForm extends Happylinux\Form
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
    // show keyword
    //---------------------------------------------------------
    public function _show($obj, $extra = null, $mode = 0)
    {
        $form_title = _AM_RSSC_ADD_KEYWORD;
        $op         = 'add_keyword';
        $button_val = _ADD;

        $this->set_obj($obj);

        // form start
        echo $this->build_form_begin('link_edit');
        echo $this->build_token();
        echo $this->build_html_input_hidden('op', $op);
        echo $this->build_html_input_hidden('ltype', $obj->get('ltype'));

        echo $this->build_form_table_begin();
        echo $this->build_form_table_title($form_title);

        echo $this->build_obj_table_text(_RSSC_USER_ID, 'uid');
        echo $this->build_obj_table_text(_RSSC_MOD_ID, 'mid');
        echo $this->build_obj_table_text('p1', 'p1');
        echo $this->build_obj_table_text('p2', 'p2');
        echo $this->build_obj_table_text('p3', 'p3');

        echo $this->build_obj_table_text(_RSSC_KEYWORD, 'keyword');
        echo $this->build_obj_table_text(_RSSC_REFRESH_INTERVAL, 'refresh');

        $ele_submit = $this->build_html_input_submit('submit', $button_val);
        echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

        echo $this->build_form_table_end();
        echo $this->build_form_end();
        // --- form end ---
    }

    // --- class end ---
}
