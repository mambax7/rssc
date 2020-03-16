<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: plugin_list.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

//=========================================================
// RSS Center Module
// 2008-01-20 K.OHWADA
//=========================================================


//=========================================================
// class admin_form_plugin_test
//=========================================================
class PluginFormTest extends Happylinux\FormLib
{
    public $_post;

    public $_DATA_ROWS = 10;
    public $_DATA_COLS = 50;

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
    // show form
    //---------------------------------------------------------
    public function show($data = null)
    {
        $plugins = $this->_post->get_post_text('plugins');

        if (empty($data)) {
            $data = $this->_post->get_post_text('data');
        }

        // --- form begin ---
        echo $this->build_form_begin();
        echo $this->build_token();
        echo $this->build_html_input_hidden('op', 'execute');

        echo $this->build_form_table_begin();
        echo $this->build_form_table_title(_AM_RSSC_PLUGIN_TEST);

        $cap_plugins = $this->build_form_caption(_AM_RSSC_PLUGIN, _AM_RSSC_PLUGIN_DESC_2);
        $ele_plugins = $this->build_html_textarea('plugins', $plugins);
        echo $this->build_form_table_line($cap_plugins, $ele_plugins);

        $cap_data = $this->build_form_caption(_AM_RSSC_PLUGIN_TESTDATA, _AM_RSSC_PLUGIN_TESTDATA_DESC);
        $ele_data = $this->build_html_textarea('data', $data, $this->_DATA_ROWS, $this->_DATA_COLS);
        echo $this->build_form_table_line($cap_data, $ele_data);

        $ele_submit = $this->build_html_input_submit('submit', _HAPPYLINUX_EXECUTE);
        echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

        echo $this->build_form_table_end();
        echo $this->build_form_end();
        // --- form end ---
    }

    // --- class end ---
}
