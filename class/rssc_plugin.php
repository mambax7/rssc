<?php
// $Id: rssc_plugin.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2008-01-20 K.OHWADA
// execute_single()

//=========================================================
// Rss Center Module
// 2007-10-10 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_plugin') ) 
{

//=========================================================
// class word
//=========================================================
    class rssc_plugin
    {
        public $_DIRNAME;
        public $_DIR_PLUGINS;
        public $_DIR_PLUGINS_DATA;
        public $_DIR_PLUGINS_LANG;

        public $_class_dir;
        public $_strings;
        public $_system;

        public $_flag_init  = false;
        public $_items      = null;
        public $_line_count = 0;
        public $_logs       = [];

        public $_class_name_array  = [];
        public $_class_obj_array   = [];
        public $_description_array = [];
        public $_usage_array       = [];

        public $_FLAG_PRINT = false;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct($dirname)
        {
            $this->_DIRNAME = $dirname;

            // PHP5.2: Non-static method
            $this->_class_dir =& happy_linux_get_singleton('dir');
            $this->_strings   =& happy_linux_get_singleton('strings');
            $this->_system    =& happy_linux_get_singleton('system');

            $this->_DIR_PLUGINS      = 'modules/' . $dirname . '/plugins';
            $this->_DIR_PLUGINS_DATA = $this->_DIR_PLUGINS . '/data';
            $this->_DIR_PLUGINS_LANG = $this->_DIR_PLUGINS . '/language/' . $this->_system->get_language();
        }

        public static function &getInstance($dirname)
        {
            static $instance;
            if (!isset($instance)) {
                $instance = new rssc_plugin($dirname);
            }
            return $instance;
        }

        //---------------------------------------------------------
        // public
        //---------------------------------------------------------
    public function init_once()
        {
            if (!$this->_flag_init) {
                $this->_init();
                $this->_flag_init = true;
            }
        }

    public function set_flag_print($val)
        {
            $this->_FLAG_PRINT = (bool)$val;
        }

    public function get_total_plugins()
        {
            return count($this->_class_name_array);
        }

    public function &get_name_list()
        {
            return $this->_class_name_array;
        }

    public function get_cached_description_by_name($name)
        {
            if (isset($this->_description_array[$name])) {
                return $this->_description_array[$name];
            }

            // get local laguage
            $desc = $this->_get_lang_description_by_name($name);
            if ($desc) {
                $this->_description_array[$name] = $desc;
                return $desc;
            }

            $class =& $this->get_cached_class_object_by_name($name);
            if (!$class) {
                return false;
            }

            // get plugin class definition
            $desc = $class->description();

            $this->_description_array[$name] = $desc;
            return $desc;
        }

    public function get_cached_usage_by_name($name)
        {
            if (isset($this->_usage_array[$name])) {
                return $this->_usage_array[$name];
            }

            $class =& $this->get_cached_class_object_by_name($name);
            if (!$class) {
                return false;
            }

            // get plugin class definition
            $usage = $class->usage();

            // set plugin_name if empty
            if (empty($usage)) {
                $usage = $name;
            }

            $this->_usage_array[$name] = $usage;
            return $usage;
        }

    public function &get_cached_class_object_by_name($name)
        {
            $false = false;
            if (isset($this->_class_obj_array[$name])) {
                return $this->_class_obj_array[$name];
            }
            $this->_print_msg('not exist plugin: ' . $name);
            return $false;
        }

    public function get_exsample_data($name = 'default')
        {
            $func = $this->_get_func_data_by_name($name);
            if ($func) {
                return $func();
            }
            return false;
        }

        //---------------------------------------------------------
        // execute
        //---------------------------------------------------------
    public function execute_single($item, $plugin_line)
        {
            $items = [$item];
            return $this->execute($items, $plugin_line);
        }

    public function execute($items, $plugin_line)
        {
            $this->_items = $items;
            $this->clear_logs();

            $plugin_arr =& $this->_parse_plugin_line($plugin_line);

            // no action, if no plugin_line
            if (!is_array($plugin_arr) || !count($plugin_arr)) {
                return true;
            }

            $temp = $items;

            foreach ($plugin_arr as $plugin) {
                $name   = $plugin['name'];
                $params = $plugin['params'];

                $this->_print_msg_name_params($name, $params);

                // continue, if not
                $class =& $this->get_cached_class_object_by_name($name);
                if (!$class) {
                    continue;
                }

                $class->set_dirname($this->_DIRNAME);
                $class->set_param_array($params);

                $ret  = $class->execute($temp);
                $logs = $class->get_logs();
                if (is_array($logs) && count($logs)) {
                    $this->_print_msg_logs($logs);
                    $this->set_logs($logs);
                }
                if (!$ret) {
                    $msg = 'plugin failed: ' . $name;
                    $this->_print_msg($msg);
                    $this->set_logs($msg);
                    return false;
                }

                $temp = $ret;
            }

            $this->_items = $temp;
            return true;
        }

    public function get_items()
        {
            return $this->_items;
        }

    public function get_item()
        {
            return $this->get_item_by_num(0);
        }

    public function get_item_by_num($num, $default = false)
        {
            if (isset($this->_items[$num])) {
                return $this->_items[$num];
            }
            return $default;
        }

        //---------------------------------------------------------
        // set & get log
        //---------------------------------------------------------
    public function clear_logs()
        {
            $this->_logs = [];
        }

    public function set_logs($arr)
        {
            if (is_array($arr)) {
                foreach ($arr as $text) {
                    $this->_logs[] = $text;
                }
            } else {
                $this->_logs[] = $arr;
            }
        }

    public function &get_logs()
        {
            return $this->_logs;
        }

        //---------------------------------------------------------
        // private
        //---------------------------------------------------------
    public function _init()
        {
            $this->_class_name_array = [];
            $this->_class_obj_array  = [];

            $files =& $this->_class_dir->get_files_in_dir($this->_DIR_PLUGINS, 'php');

            foreach ($files as $file) {
                $name = str_replace('.php', '', $file);
                $obj  =& $this->_get_class_obj_by_name($name);
                if (is_object($obj)) {
                    $this->_class_name_array[]     = $name;
                    $this->_class_obj_array[$name] =& $obj;
                }
            }
        }

    public function &_get_class_obj_by_name($name)
        {
            $file  = $this->_DIR_PLUGINS . '/' . $name . '.php';
            $class = 'rssc_plugin_' . $name;

            $flase = false;

            if (file_exists(XOOPS_ROOT_PATH . '/' . $file)) {
                include_once XOOPS_ROOT_PATH . '/' . $file;
            } else {
                return $false;
            }

            if (class_exists($class)) {
                $obj = new $class();
                return $obj;
            }

            return $false;
        }

    public function _get_lang_description_by_name($name)
        {
            $file = $this->_DIR_PLUGINS_LANG . '/' . $name . '.php';

            $rssc_plugin_description = '';

            if (file_exists(XOOPS_ROOT_PATH . '/' . $file)) {
                include_once XOOPS_ROOT_PATH . '/' . $file;
            } else {
                return false;
            }

            return $rssc_plugin_description;
        }

    public function _get_func_data_by_name($name)
        {
            $file = $this->_DIR_PLUGINS_DATA . '/' . $name . '.php';
            $func = 'rssc_plugin_data_' . $name;

            if (file_exists(XOOPS_ROOT_PATH . '/' . $file)) {
                include_once XOOPS_ROOT_PATH . '/' . $file;
            } else {
                return false;
            }

            if (function_exists($func)) {
                return $func;
            }

            return false;
        }

    public function _print_msg_name_params($name, $params)
        {
            $msg = 'plugin: ' . $name;
            if (is_array($params) && count($params)) {
                $msg .= ' : ' . implode(', ', $params);
            }
            $this->_print_msg($msg);
        }

    public function _print_msg_logs($logs)
        {
            if (is_array($logs) && count($logs)) {
                foreach ($logs as $msg) {
                    $this->_print_msg($msg);
                }
            }
        }

    public function _print_msg($msg)
        {
            if ($this->_FLAG_PRINT) {
                echo htmlspecialchars($msg, ENT_QUOTES) . "<br />\n";
            }
        }

        //---------------------------------------------------------
        // input value:
        //     foo | bar (a, b)
        // return value:
        //     Array
        //     (
        //       [0] => Array
        //         (
        //           ['name']   => foo
        //           ['params'] => Array()
        //         )
        //       [1] => Array
        //         (
        //           ['name']   => bar
        //           ['params'] => Array
        //             (
        //               [0] => a
        //               [1] => b
        //             )
        //         )
        //     )
        //---------------------------------------------------------
    public function &_parse_plugin_line($plugin_line)
        {
            $ret_arr = [];

            // foo | bar (a, b) ==> array( 'foo', 'bar (a, b)' )
            $plugin_arr =& $this->_strings->convert_string_to_array($plugin_line, '|');

            if (!is_array($plugin_arr) || !count($plugin_arr)) {
                return $ret_arr;
            }

            foreach ($plugin_arr as $plugin) {
                $ret_arr[] = $this->_parse_plugin_line_plugin($plugin);
            }

            return $ret_arr;
        }

    public function &_parse_plugin_line_plugin($plugin)
        {
            $name   = $plugin;
            $params = [];

            // bar (a, b) ==> array( 'bar ', 'a, b' )
            if (preg_match('/(.*)\((.*)\)/', $plugin, $matches)) {
                if (isset($matches[1])) {
                    // name = 'bar'
                    $name = trim($matches[1]);
                }

                if (isset($matches[2])) {
                    // 'a, b' ==> array( 'a', 'b' )
                    $params = $this->_parse_plugin_line_param($matches[2]);
                }
            }

            $ret = [
                'name'   => $name,
                'params' => $params,
            ];

            return $ret;
        }

    public function &_parse_plugin_line_param($param_list)
        {
            $arr = [];

            // 'a, b' ==> array( 'a', "b" )
            $param_arr =& $this->_strings->convert_string_to_array($param_list, ',');

            foreach ($param_arr as $param) {
                $val = $param;

                // "a" ==> a
                if (preg_match('/"(.*)"/', $param, $matches)) {
                    if (isset($matches[1])) {
                        $val = $matches[1];
                    }
                } // 'b' ==> b
                elseif (preg_match('/\'(.*)\'/', $param, $matches)) {
                    if (isset($matches[1])) {
                        $val = $matches[1];
                    }
                }

                $arr[] = $val;
            }

            return $arr;
        }

        //---------------------------------------------------------
        // plugin table
        //---------------------------------------------------------
    public function build_table()
        {
            $text = '<table class="outer" width="100%" cellpadding="4" cellspacing="1">' . "\n";
            $text .= '<tr>';
            $text .= '<th align="center">' . _RSSC_PLUGIN_NAME . '</th>';
            $text .= '<th align="center">' . _RSSC_PLUGIN_DESCRIPTION . '</th>';
            $text .= '<th align="center">' . _RSSC_PLUGIN_USAGE . '</th>';
            $text .= '</tr>' . "\n";

            $name_list =& $this->get_name_list();

            foreach ($name_list as $name) {
                $description = $this->get_cached_description_by_name($name);
                $usage       = $this->get_cached_usage_by_name($name);
                $class       = $this->_get_alternate_class();

                $text .= '<tr class="' . $class . '">';
                $text .= '<td>' . $name . '</td>';
                $text .= '<td>' . $description . '</td>';
                $text .= '<td>' . $usage . '</td>';
                $text .= '</tr>' . "\n";
            }

            $text .= '</table><br />' . "\n";
            return $text;
        }

        public function _get_alternate_class()
        {
            if (0 != $this->_line_count % 2) {
                $class = 'odd';
            } else {
                $class = 'even';
            }
            $this->_line_count++;
            return $class;
        }

        // --- class end ---
    }

// === class end ===
}


