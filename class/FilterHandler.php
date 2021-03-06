<?php

namespace XoopsModules\Rssc;
// $Id: rssc_filter_handler.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2009-03-01 K.OHWADA
// replace_control_code()

// 2007-10-10 K.OHWADA
// rename rssc_filter to rssc_filterHandler
// judge_title()

//=========================================================
// Rss Center Module
// 2007-06-01 K.OHWADA
//=========================================================

    // minus value for reject
    define('RSSC_CODE_FILTER_NORMAL', 0);
    define('RSSC_CODE_FILTER_REJECT_BLACK', -1);
    define('RSSC_CODE_FILTER_REJECT_WORD', -2);
    define('RSSC_CODE_FILTER_WHITE', 11);
    define('RSSC_CODE_FILTER_PASS', 12);

    //=========================================================
    // class word
    //=========================================================
    class FilterHandler
    {
        public $_blackHandler;
        public $_whiteHandler;
        public $_wordHandler;

        public $_conf       = null;
        public $_black_list = [];
        public $_white_list = [];
        public $_word_list  = [];

        public $_flag_init   = false;
        public $_match_count = 0;
        public $_match_words = null;
        public $_log         = null;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            $this->_configHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('ConfigBasic', $dirname);
            $this->_blackHandler  = \XoopsModules\Rssc\Helper::getInstance()->getHandler('BlackBasic', $dirname);
            $this->_whiteHandler  = \XoopsModules\Rssc\Helper::getInstance()->getHandler('WhiteBasic', $dirname);
            $this->_wordHandler   = \XoopsModules\Rssc\Helper::getInstance()->getHandler('WordBasic', $dirname);
        }

        //---------------------------------------------------------
        // init
        //---------------------------------------------------------
        public function init_once()
        {
            if (!$this->_flag_init) {
                $this->_init();
                $this->_flag_init = true;
            }
        }

        public function _init()
        {
            $this->_conf = &$this->_configHandler->get_conf();
            if ($this->_conf['white_use']) {
                $this->_white_list = &$this->_init_list($this->_whiteHandler->get_rows_act(), 'wid', 'url');
            }
            if ($this->_conf['black_use']) {
                $this->_black_list = &$this->_init_list($this->_blackHandler->get_rows_act(), 'bid', 'url');
            }
            if ($this->_conf['word_use']) {
                $this->_word_list = &$this->_init_list($this->_wordHandler->get_rows_act(), 'sid', 'word');
            }
        }

        public function &_init_list($list, $id_name, $target_name)
        {
            $arr = [];
            foreach ($list as $row) {
                if ($row['reg']) {
                    $pat = '/' . str_replace('/', '\/', $row[$target_name]) . '/i';
                } else {
                    $pat = '/' . preg_quote($row[$target_name], '/') . '/i';
                }
                $temp                = &$row;
                $temp['pattern']     = $pat;
                $arr[$row[$id_name]] = $temp;
            }

            return $arr;
        }

        //---------------------------------------------------------
        // public
        //---------------------------------------------------------
        public function judge_title($censor, $title)
        {
            $censor = $this->replace_control_code($censor);

            if (empty($censor)) {
                return true;
            }

            $arr = explode('|', $censor);

            if (!is_array($arr) || !count($arr)) {
                return true;
            }

            foreach ($arr as $word) {
                $pattern = '/' . preg_quote($word) . '/';
                if (preg_match($pattern, $title)) {
                    $this->_log = 'reject title:' . $word;

                    return false;
                }
            }

            return true;
        }

        public function judge_cont($url, $content)
        {
            $this->_match_words = '';
            $this->_log         = '';
            $this->_word_match  = [];

            if ($this->_conf['white_use']) {
                // pass if white
                $wid = $this->_check_white($url);
                if ($wid) {
                    $this->_log = 'pass white:' . $wid . ' ' . $url;

                    return RSSC_CODE_FILTER_WHITE;
                }
            }

            $total = 0;
            if ($this->_conf['black_use']) {
                $bid = $this->_check_black($url);
                if ($bid) {
                    // reject if black
                    if (1 == $this->_conf['black_use']) {
                        $this->_log = 'reject black:' . $bid . ' ' . $url;

                        return RSSC_CODE_FILTER_REJECT_BLACK;
                    }

                    // learning
                    $total += $this->_conf['word_level'];
                }
            }

            if ($this->_conf['word_use']) {
                $total += $this->_check_word($content);
            }

            $log = 'word:' . $total . ' ' . $url . ' ' . $this->_match_count . ' ' . $this->_match_words;

            // pass if lower level
            if ($total < $this->_conf['word_level']) {
                $this->_log = 'pass ' . $log;

                return RSSC_CODE_FILTER_PASS;
            }

            $this->_log = 'reject ' . $log;

            return RSSC_CODE_FILTER_REJECT_WORD;
        }

        public function get_log()
        {
            return $this->_log;
        }

        //---------------------------------------------------------
        // private
        //---------------------------------------------------------
        public function _check_white($url)
        {
            if (0 == count($this->_white_list)) {
                return false;
            }

            foreach ($this->_white_list as $row) {
                if (preg_match($row['pattern'], $url)) {
                    if ($this->_conf['white_count']) {
                        $this->_whiteHandler->countup($row['wid']);
                    }

                    return $row['wid'];
                }
            }

            return false;
        }

        public function _check_black($url)
        {
            if (0 == count($this->_black_list)) {
                return false;
            }

            foreach ($this->_black_list as $row) {
                if (preg_match($row['pattern'], $url)) {
                    if ($this->_conf['black_count']) {
                        $this->_blackHandler->countup($row['bid']);
                    }

                    return $row['bid'];
                }
            }

            return false;
        }

        public function _check_word($content)
        {
            $total = 0;
            $count = 0;
            $words = '';

            foreach ($this->_word_list as $row) {
                if (preg_match($row['pattern'], $content)) {
                    $count++;
                    $total += $row['point'];
                    $words .= $row['sid'] . ':' . $row['point'] . ':' . $row['word'] . ' ';
                    if ($this->_conf['word_count']) {
                        $this->_wordHandler->countup($row['sid']);
                    }
                }
            }

            $this->_match_count = $count;
            $this->_match_words = $words;

            return $total;
        }

        public function replace_control_code($str, $replace = '')
        {
            $str = preg_replace('/[\x00-\x1F]/', $replace, $str);
            $str = preg_replace('/[\x7F]/', $replace, $str);

            return $str;
        }

        // --- class end ---
    }
    // === class end ===

