<?php
// $Id: rssc_plugin_base.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2009-02-20 K.OHWADA
// undefined variable

//=========================================================
// Rss Center Module
// 2008-01-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_plugin_base') ) 
{
    class rssc_plugin_base
    {
        public $_plural_vars = [];
        public $_single_vars = [];
        public $_param_vars  = [];
        public $_logs        = [];

        public $_DIRNAME;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct()
        {
            // dummy
        }

        //---------------------------------------------------------
        // interface
        //---------------------------------------------------------
        //---------------------------------------------------------
        // function: init
        // return value: none
        // note: reserve for future
        //---------------------------------------------------------
    public function init()
        {
            // dummy
        }

        //---------------------------------------------------------
        // function: description
        // return value:
        //    strings: plugin description in English
        //
        //  exsample:
        //	return "this is plugin description";
        //---------------------------------------------------------
    public function description()
        {
            return '';
        }

        //---------------------------------------------------------
        // function: usage
        // return value:
        //    strings: plugin usage in English
        //
        //  exsample:
        //	return "plugin_name ( param_1, param_2 )";
        //---------------------------------------------------------
    public function usage()
        {
            return '';
        }

        //---------------------------------------------------------
        // function: convert
        // return value:
        //    true:  replace converted value
        //    false: nothing to do
        //
        // exsample:
        //	$content = $this->get_item_by_key( 'content' );
        //	$converted = xxx;	// please write your proccess
        //	$this->set_item_by_key( 'content', $converted );
        //	return true;
        //---------------------------------------------------------
    public function convert()
        {
            return false;
        }

        //---------------------------------------------------------
        // function: reject
        // return value:
        //    true:  reject to save database
        //    false: nothing to do
        //
        // exsample:
        //	$content = $this->get_item_by_key( 'content' );
        //	$check = xxx;	// please write your proccess
        //	if ( $check ) {
        //		return true;
        //	} else {
        //		retrun false;
        //	}
        //---------------------------------------------------------
    public function reject()
        {
            return false;
        }

        //---------------------------------------------------------
        // function: execute
        // input value:
        //    array items
        // return value:
        //    array items
        //---------------------------------------------------------
    public function execute($items)
        {
            $arr = [];
            $this->init();

            foreach ($items as $input) {
                $this->set_item_array($input);

                $val = $input;
                list($ret1, $ret2) = $this->execute_single();
                if ($ret2) {
                    $val           = $input;
                    $val['reject'] = true;    // marking
                } elseif ($ret1) {
                    $val = $this->get_item_array();
                }

                // undefined variable
                $arr[] = $val;
            }

            return $arr;
        }

        //---------------------------------------------------------
        // function: execute_single
        // input value: none
        // return value:
        //    array return_of_convert, return_of_reject
        //---------------------------------------------------------
    public function execute_single()
        {
            $ret1 = $this->convert();
            $ret2 = $this->reject();
            if ($ret2) {
                $this->set_logs('reject by plugin: ' . $this->name());
            }
            return [$ret1, $ret2];
        }

        //---------------------------------------------------------
        // get name
        //---------------------------------------------------------
    public function name()
        {
            $name = get_class($this);
            $name = str_replace('rssc_plugin_', '', $class);
            return $name;
        }

        //---------------------------------------------------------
        // set & get param
        //---------------------------------------------------------
    public function set_param_array(&$arr)
        {
            if (is_array($arr)) {
                $this->_param_vars =& $arr;
            }
        }

    public function set_param_by_num($num, $value)
        {
            $this->_param_vars[$num] = $value;
        }

    public function get_param_array()
        {
            return $this->_param_vars;
        }

    public function get_param_by_num($num, $default = false)
        {
            if (isset($this->_param_vars[$num])) {
                return $this->_param_vars[$num];
            }
            return $default;
        }

        //---------------------------------------------------------
        // set & get value
        //---------------------------------------------------------
    public function clear_plural_item_array()
        {
            $this->_plural_vars = [];
        }

    public function set_plural_item_array($arr)
        {
            if (is_array($arr)) {
                $this->_plural_vars =& $arr;
            }
        }

    public function set_plural_item_by_num($num, $value)
        {
            $this->_plural_vars[$num] = $value;
        }

    public function add_plural_item($value)
        {
            $this->_plural_vars[] = $value;
        }

    public function &get_plural_item_array()
        {
            return $this->_plural_vars;
        }

    public function &get_plural_item_by_num($num, $default = false)
        {
            if (isset($this->_plural_vars[$num])) {
                return $this->_plural_vars[$num];
            }
            return $default;
        }

        //---------------------------------------------------------
        // set & get value
        //---------------------------------------------------------
    public function clear_item_array()
        {
            $this->_single_vars = [];
        }

    public function set_item_array($arr)
        {
            if (is_array($arr)) {
                $this->_single_vars =& $arr;
            }
        }

    public function set_item_by_key($key, $value)
        {
            $this->_single_vars[$key] = $value;
        }

    public function &get_item_array()
        {
            return $this->_single_vars;
        }

    public function &get_item_by_key($key, $default = false)
        {
            if (isset($this->_single_vars[$key])) {
                return $this->_single_vars[$key];
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
        // set & get dirname
        //---------------------------------------------------------
    public function set_dirname($val)
        {
            $this->_DIRNAME = $val;
        }

    public function get_dirname()
        {
            return $this->_DIRNAME;
        }

        public function &getHandler($name)
        {
            return rssc_getHandler($name, $this->_DIRNAME);
        }

        // --- class end ---
    }

// === class end ===
}


