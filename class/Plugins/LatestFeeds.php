<?php

namespace XoopsModules\Rssc\Plugins;

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
if (!class_exists(LatestFeeds::class)) {
    class LatestFeeds extends Base
    {
        public $_feedHandler;

        public $_FEED_ORDER  = RSSC_C_ORDER_TEXT_UPDATED;
        public $_DEFAULT_NUM = 10;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            base::__construct();
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

        public function execute($items)
        {
            $feedHandler = $this->getHandler('FeedBasic');

            $limit = (int)$this->get_param_by_num(0, $this->_DEFAULT_NUM);
            $rows  = &$feedHandler->get_rows_public_by_order($this->_FEED_ORDER, $limit);

            return $rows;
        }

        // --- class end ---
    }
    // === class end ===
}
