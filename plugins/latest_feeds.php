<?php
// $Id: latest_feeds.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

//=========================================================
// Rss Center Module
// 2008-01-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// name: latest_feeds
// description: get leatest feeds
// param:
//   0: number_of_feeds
//---------------------------------------------------------

// === class begin ===
if( !class_exists('rssc_plugin_latest_feeds') ) 
{
    class rssc_plugin_latest_feeds extends rssc_plugin_base
    {
        public $_feed_handler;

        public $_FEED_ORDER  = RSSC_C_ORDER_TEXT_UPDATED;
        public $_DEFAULT_NUM = 10;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            rssc_plugin_base::__construct();
        }

        //---------------------------------------------------------
        // function
        //---------------------------------------------------------
        public function description()
        {
            return 'get leatest feeds';
        }

        public function usage()
        {
            return 'latest_feeds ( [number_of_feeds] )';
        }

        public function execute(&$items)
        {
            $feed_handler =& $this->get_handler('feed_basic');

            $limit = intval($this->get_param_by_num(0, $this->_DEFAULT_NUM));
            $rows  =& $feed_handler->get_rows_public_by_order($this->_FEED_ORDER, $limit);
            return $rows;
        }

        // --- class end ---
    }

// === class end ===
}


