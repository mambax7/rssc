<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: archive_manage.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_flag_execute_time()
// _UPDATE => _HAPPYLINUX_EXECUTE

// 2007-06-01 K.OHWADA
// api/refresh.php
// learn_black()

// 2006-09-18 K.OHWADA
// use XoopsGTicket
// use build_lib_box_limit_offset()

// 2006-07-10 K.OHWADA
// move class admin_manage_archive from admin_form_class.php
// use happy_linux_form happy_linux_post
// change make_xxx to build_xxx

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME
// add check_token()

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class admin_form_archive
//=========================================================
class ArchiveForm extends Happylinux\FormLib
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
    // show feed refresh
    //---------------------------------------------------------
    public function show_refresh($limit = 0, $offset = 0)
    {
        // form start
        echo $this->build_form_begin('refresh');
        echo $this->build_token();
        echo $this->build_html_input_hidden('op', 'refresh');
        echo $this->build_form_table_begin();
        echo $this->build_form_table_title(_AM_RSSC_REFRESH);
        $ele_limit = $this->build_html_input_text('limit', $limit);
        echo $this->build_form_table_line(_AM_RSSC_LINK_LIMIT, $ele_limit);
        $ele_offset = $this->build_html_input_text('offset', $offset);
        echo $this->build_form_table_line(_AM_RSSC_LINK_OFFSET, $ele_offset);
        $ele_submit = $this->build_html_input_submit('submit', _HAPPYLINUX_EXECUTE);
        echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');
        echo $this->build_form_table_end();
        echo $this->build_form_end();
    }

    public function show_refresh_next($limit = 0, $offset = 0)
    {
        // form start
        $desc   = '';
        $action = '';
        $submit = sprintf(_AM_RSSC_REFRESH_NEXT, $limit);

        $text = $this->build_lib_box_limit_offset(_AM_RSSC_REFRESH, $desc, $limit, $offset, 'refresh', $submit, $action);
        echo $text;
    }

    //---------------------------------------------------------
    // show learn black
    //---------------------------------------------------------
    public function show_learn($limit = 0, $offset = 0)
    {
        // form start
        echo $this->build_form_begin('learn');
        echo $this->build_token();
        echo $this->build_html_input_hidden('op', 'learn');
        echo $this->build_form_table_begin();
        echo $this->build_form_table_title(_AM_RSSC_LEAN_BLACK);
        $ele_limit = $this->build_html_input_text('limit', $limit);
        echo $this->build_form_table_line(_AM_RSSC_LINK_LIMIT, $ele_limit);
        $ele_offset = $this->build_html_input_text('offset', $offset);
        echo $this->build_form_table_line(_AM_RSSC_LINK_OFFSET, $ele_offset);
        $ele_submit = $this->build_html_input_submit('submit', _HAPPYLINUX_EXECUTE);
        echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');
        echo $this->build_form_table_end();
        echo $this->build_form_end();
    }

    public function show_learn_next($limit = 0, $offset = 0)
    {
        // form start
        $desc   = '';
        $action = '';
        $submit = sprintf(_AM_RSSC_REFRESH_NEXT, $limit);

        $text = $this->build_lib_box_limit_offset(_AM_RSSC_LEAN_BLACK, $desc, $limit, $offset, 'learn', $submit, $action);
        echo $text;
    }

    //---------------------------------------------------------
    // show feed clear
    //---------------------------------------------------------
    public function show_clear_old($num = 0)
    {
        // form start
        echo $this->build_form_begin('clear_old');
        echo $this->build_token();
        echo $this->build_html_input_hidden('op', 'clear_old');
        echo $this->build_form_table_begin();
        echo $this->build_form_table_title(_AM_RSSC_FEED_CLEAR_OLD);
        $ele_num = $this->build_html_input_text('num', $num);
        echo $this->build_form_table_line(_AM_RSSC_FEED_CLEAR_NUM, $ele_num);
        $ele_submit = $this->build_html_input_submit('submit', _HAPPYLINUX_CLEAR);
        echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');
        echo $this->build_form_table_end();
        echo $this->build_form_end();
    }

    // --- class end ---
}
