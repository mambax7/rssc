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
// class admin word search
//=========================================================
class WordSearchForm extends Happylinux\Form
{
    public $_post;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

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
    // function
    //---------------------------------------------------------
    public function print_search_form()
    {
        $search_word = $this->_post->get_get_text('word');

        echo $this->build_form_begin('word_search', 'word_list.php', 'get');
        echo $this->build_html_input_text('word', $search_word);
        echo $this->build_html_input_hidden('sortid', 8);
        echo $this->build_html_input_submit('submit', _AM_RSSC_WORD_SEARCH);
        echo $this->build_form_end();
        echo "<br>\n";
    }

    // --- class end ---
}
