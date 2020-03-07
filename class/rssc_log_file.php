<?php
// $Id: rssc_log_file.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2007-10-10 K.OHWADA
// PHP5.2: Declaration of rssc_log_file::getInstance() should be compatible with that of happy_linux_file::getInstance() 

//=========================================================
// Rss Center Module
// 2007-06-10 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_log_file') ) 
{

//=========================================================
// class rssc_log_file
// this class is used by command line
//=========================================================
    class rssc_log_file extends happy_linux_file
    {
        public $_flag_log_use = false;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct($dirname)
        {
            parent::__construct();
            $this->_init($dirname);
        }

        // PHP5.2: Declaration of rssc_log_file::getInstance() should be compatible with that of happy_linux_file::getInstance()
        //public static function &getInstance( $dirname )

        //---------------------------------------------------------
        // log
        //---------------------------------------------------------
    public function _init($dirname)
        {
            $file_name = 'modules/' . $dirname . '/cache/log.txt';
            $this->set_file_name($file_name);
            $this->set_file_mode('a');
        }

    public function open_log()
        {
            if ($this->_flag_log_use) {
                $this->set_flag_write(true);
                $this->fopen();
            }
        }

    public function close_log($flag_chmod = false)
        {
            if ($this->_flag_log_use) {
                $this->fclose_chmod($flag_chmod);
            }
        }

    public function write_log($data)
        {
            if ($this->_flag_log_use) {
                $this->fwrite_with_date($data, true, true);
            }
        }

        public function set_flag_log_use($val)
        {
            $this->_flag_log_use = (bool)$val;
        }

        // --- class end ---
    }

// === class end ===
}


