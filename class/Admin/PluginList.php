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
// class admin list plugin
//=========================================================
class PluginList
{
    public $_plugin;
    public $_post;
    public $_test;
    public $_form;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_plugin = Rssc\Plugin::getInstance(RSSC_DIRNAME);

        $this->_post = Happylinux\Post::getInstance();
        $this->_test = PluginTest::getInstance();
        $this->_form = PluginFormTest::getInstance();
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
    // post
    //---------------------------------------------------------
    public function get_op()
    {
        return $this->_post->get_post_text('op');
    }

    //---------------------------------------------------------
    // form
    //---------------------------------------------------------
    public function show_list_form()
    {
        $this->_plugin->init_once();

        echo '<h4>' . _RSSC_PLUGIN_LIST . "</h4>\n";
        echo $this->_plugin->build_table();

        echo '<h4>' . _AM_RSSC_PLUGIN_TEST . "</h4>\n";
        $data        = null;
        $plugin_data = $this->_plugin->get_exsample_data();
        if (is_array($plugin_data)) {
            $data = var_export($plugin_data, true);
        }
        $this->_form->show($data);
    }

    //---------------------------------------------------------
    // excute
    //---------------------------------------------------------
    public function execute()
    {
        rssc_admin_print_bread(_RSSC_PLUGIN_LIST, 'plugin_list.php', _AM_RSSC_PLUGIN_TEST);
        echo '<h4>' . _AM_RSSC_PLUGIN_TEST . "</h4>\n";

        $this->_form->show();
        echo "<br><hr>\n";

        $this->_test->execute();

        echo "<hr><br>\n";
        echo '<a href="plugin_list.php"> - ' . _RSSC_PLUGIN_LIST . "</a>\n";
    }

    // --- class end ---
}
