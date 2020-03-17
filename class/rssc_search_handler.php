<?php

// $Id: rssc_search_handler.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2008-01-20 K.OHWADA
// _init_view_param()

// 2007-06-01 K.OHWADA
// use get_count_public_xxx

// 2006-09-01 K.OHWADA
// fuzzy search
// use check_build_sql_query_array()

// 2006-07-10 K.OHWADA
// use happy_linux_search

// 2006-06-04 K.OHWADA
// use view_format_sanitize_feeds
// suppress notice : Only variable references should be returned by reference

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('rssc_search_handler')) {
    //=========================================================
    // class rssc_search_handler
    //=========================================================

    /**
     * Class rssc_search_handler
     */
    class rssc_search_handler extends rssc_view_param
    {
        // class instance
        public $_search;
        public $_post;

        // result
        public $_feeds = [];
        public $_flag_parse_query = false;
        public $_where;
        public $_sql_query_array;

        public $_query = null;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------

        /**
         * rssc_search_handler constructor.
         * @param $dirname
         */
        public function __construct($dirname)
        {
            parent::__construct($dirname);
            $this->_init_view_param();

            $this->_search = happy_linux_search::getInstance();
            $this->_post = happy_linux_post::getInstance();

            $this->_search->set_lang_zenkaku(_HAPPY_LINUX_ZENKAKU);
            $this->_search->set_lang_hankaku(_HAPPY_LINUX_HANKAKU);
        }

        //--------------------------------------------------------
        // public
        //--------------------------------------------------------

        /**
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &get_feeds_for_rss($limit = 0, $start = 0)
        {
            $feeds = [];
            if ($this->_query) {
                if ($this->parseQuery()) {
                    if ($this->getSearchCount() > 0) {
                        $feeds = &$this->getSearchFeeds($limit, $start);
                    }
                }
            } else {
                $feeds = &$this->getLatest($limit, $start);
            }

            return $feeds;
        }

        //--------------------------------------------------------
        // search
        //--------------------------------------------------------

        /**
         * @return array
         */
        public function search()
        {
            $feeds = [];

            if (!$this->parseQuery()) {
                return $feeds;
            }

            $count = $this->_feed_handler->get_count_public_by_where($this->_where);

            if ($count > 0) {
                $feeds = &$this->_get_search_feeds($this->_feed_limit, $this->_feed_start);
            }

            return $feeds;
        }

        //--------------------------------------------------------
        // get count & object
        //--------------------------------------------------------

        /**
         * @return bool
         */
        public function getSearchCount()
        {
            $ret = false;

            if (!$this->_flag_parse_query) {
                $this->parseQuery();
            }

            if ($this->_where) {
                $ret = $this->_feed_handler->get_count_public_by_where($this->_where);
            }

            return $ret;
        }

        /**
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &getSearchFeeds($limit = 0, $start = 0)
        {
            // suppress notice : Only variable references should be returned by reference
            if (!$this->_flag_parse_query) {
                $this->parseQuery();
            }
            $ret = &$this->_get_search_feeds($limit, $start);

            return $ret;
        }

        // index.php

        /**
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &getLatest($limit = 0, $start = 0)
        {
            $rows = &$this->_feed_handler->get_rows_public_by_order($this->_feed_order, $limit, $start);
            $feeds = &$this->view_format_sanitize_feed_rows($rows, $this->_flag_sanitize);

            return $feeds;
        }

        // index.php

        /**
         * @return mixed
         */
        public function getTotal()
        {
            $ret = $this->_feed_handler->get_count_public();

            return $ret;
        }

        //--------------------------------------------------------
        // class search
        //--------------------------------------------------------

        /**
         * @param string $query
         * @param string $andor
         * @return bool
         */
        public function parseQuery($query = '', $andor = '')
        {
            $this->_flag_parse_query = true;
            $ret1 = $this->_search->parse_query($query, $andor);
            if (!$ret1) {
                return false;
            }

            $ret2 = $this->_search->check_build_sql_query_array();
            switch ($ret2) {
                case HAPPY_LINUX_SEARCH_CODE_SQL_NO_CAN:
                case HAPPY_LINUX_SEARCH_CODE_SQL_MERGE:
                    $sql_query_array = $this->_search->get_sql_query_array();
                    $sql_andor = $this->_search->get_sql_andor();
                    $this->_where = $this->_search->build_single_double_where('search', $sql_query_array, null, $sql_andor);
                    $this->_sql_query_array = $sql_query_array;
                    break;
                case HAPPY_LINUX_SEARCH_CODE_SQL_CAN:
                    $query_array = $this->_search->get_query_array();
                    $candidate_array = $this->_search->get_candidate_keyword_array();
                    $andor = $this->_search->get_andor();
                    $this->_where = $this->_search->build_single_double_where('search', $query_array, $candidate_array, $andor);
                    $this->_sql_query_array = $query_array;
                    break;
            }

            return true;
        }

        /**
         * @return string|string[]|null
         */
        public function get_post_get_action()
        {
            return $this->_search->get_post_get_action();
        }

        /**
         * @return string|string[]|null
         */
        public function get_post_get_andor()
        {
            return $this->_search->get_post_get_andor();
        }

        /**
         * @return string
         */
        public function get_post_get_query()
        {
            $this->_query = $this->_search->get_post_get_query();

            return $this->_query;
        }

        /**
         * @param $value
         */
        public function setMinKeyword($value)
        {
            $this->_search->set_min_keyword($value);
        }

        /**
         * @param $value
         */
        public function setQuery($value)
        {
            $this->_search->set_query($value);
        }

        /**
         * @param $value
         */
        public function setAndor($value)
        {
            $this->_search->set_andor($value);
        }

        /**
         * @return bool|string
         */
        public function &getQueryUrlencode()
        {
            $ret = $this->_search->get_query_urlencode();

            return $ret;
        }

        /**
         * @return bool|string
         */
        public function &getMergedUrlencode()
        {
            $ret = $this->_search->get_merged_urlencode();

            return $ret;
        }

        /**
         * @return mixed
         */
        public function getAndor()
        {
            return $this->_search->get_andor();
        }

        /**
         * @return mixed
         */
        public function getAnd()
        {
            return $this->_search->get_and();
        }

        /**
         * @return mixed
         */
        public function getOr()
        {
            return $this->_search->get_or();
        }

        /**
         * @return mixed
         */
        public function getExact()
        {
            return $this->_search->get_exact();
        }

        /**
         * @param string $format
         * @return array|bool|string|string[]|null
         */
        public function &get_query_array($format = 's')
        {
            $ret = &$this->_search->get_query_array($format);

            return $ret;
        }

        /**
         * @param string $format
         * @return array|bool|string|string[]|null
         */
        public function &get_ignore_array($format = 's')
        {
            $ret = &$this->_search->get_ignore_array($format);

            return $ret;
        }

        /**
         * @param string $format
         * @return array|bool|string|string[]|null
         */
        public function &get_candidate_array($format = 's')
        {
            $ret = &$this->_search->get_candidate_array($format);

            return $ret;
        }

        /**
         * @return bool|int
         */
        public function get_count_query_array()
        {
            return $this->_search->get_count_query_array();
        }

        /**
         * @return bool|int
         */
        public function get_count_ignore_array()
        {
            return $this->_search->get_count_ignore_array();
        }

        /**
         * @return bool|int
         */
        public function get_count_candidate_array()
        {
            return $this->_search->get_count_candidate_array();
        }

        //--------------------------------------------------------
        // set & get param
        //--------------------------------------------------------

        /**
         * @return array
         */
        public function &getFeeds()
        {
            return $this->_feeds;
        }

        //---------------------------------------------------------
        // class post
        //---------------------------------------------------------

        /**
         * @return int
         */
        public function get_get_start()
        {
            return $this->_post->get_get_int('start');
        }

        /**
         * @return int
         */
        public function get_get_limit()
        {
            return $this->_post->get_get_int('limit');
        }

        /**
         * @return string|string[]|null
         */
        public function get_get_rss_mode()
        {
            $mode = $this->_post->get_get_text('mode', 'rss');
            switch ($mode) {
                case 'rdf':
                case 'atom':
                    break;
                case 'rss':
                default:
                    $mode = 'rss';
                    break;
            }

            return $mode;
        }

        //=========================================================
        // Private
        //=========================================================
        //--------------------------------------------------------
        // get count & feeds by where
        //--------------------------------------------------------

        /**
         * @param int $limit
         * @param int $start
         * @return array
         */
        public function &_get_search_feeds($limit = 0, $start = 0)
        {
            $feeds = [];
            if ($this->_where) {
                $rows = &$this->_feed_handler->get_rows_public_by_where($this->_where, $this->_feed_order, $limit, $start);
                $this->set_keyword_array($this->_sql_query_array);
                $feeds = &$this->view_format_sanitize_feed_rows($rows, $this->_flag_sanitize);
            }

            return $feeds;
        }

        //----- class end -----
    }
    // === class end ===
}
