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
// class PluginTest
//=========================================================
class PluginTest
{
    public $_plugin;
    public $_post;
    public $_form;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->_plugin = Rssc\Plugin::getInstance(RSSC_DIRNAME);
        $this->_post   = Happylinux\Post::getInstance();
        $this->_form   = PluginFormTest::getInstance();
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
    // excute
    //---------------------------------------------------------
    public function execute()
    {
        $plugins   = $this->_post->get_post_text('plugins');
        $post_data = $this->_post->get_post_text('data');

        if (empty($plugins)) {
            xoops_error('no plugins');
            echo "<br>\n";

            return false;
        }

        $this->_plugin->init_once();
        $this->_plugin->set_flag_print(true);
        $data = null;

        if ($post_data) {
            $str  = '$data = ' . $this->_add_semicolon_to_tail($post_data);
            $ret1 = eval($str);
            if (false === $ret1) {
                xoops_error('cannot eval data');
                echo "<br>\n";

                return false;
            }
        } else {
            $ret2 = $this->_plugin->get_exsample_data();
            if (empty($ret2)) {
                xoops_error('cannot get data');
                echo "<br>\n";

                return false;
            }
            $data = $ret2;
        }

        echo '<h4> plugins </h4>' . "\n";
        echo '<pre>';
        echo happy_linux_sanitize($plugins);
        echo '</pre>';

        echo '<h4> input </h4>' . "\n";
        echo '<pre>';
        echo happy_linux_sanitize_var_export($data);
        echo '</pre>' . "\n";

        echo '<h4> execute </h4>' . "\n";

        $ret = $this->_plugin->execute($data, $plugins);
        if (!$ret) {
            echo '<h4> failed </h4>' . "\n";

            return true;
        }

        $ret = &$this->_plugin->get_items();

        echo '<h4> output </h4>' . "\n";
        echo '<pre>';
        echo happy_linux_sanitize_var_export($ret);
        echo '</pre>' . "\n";

        return true;
    }

    public function _add_semicolon_to_tail($str)
    {
        if (';' != mb_substr(trim($str), -1, 1)) {
            $str .= ';';
        }

        return $str;
    }

    // --- class end ---
}
?>
