<?php
// $Id: yahoo.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2008-01-20 K.OHWADA
// rssc_plugin_base

//=========================================================
// Rss Center Module
// 2007-10-10 K.OHWADA
//=========================================================

//---------------------------------------------------------
// name: yahoo
// description: convert the link to ordinary style from yahoo style
// param: none
//---------------------------------------------------------

//---------------------------------------------------------
//	convert link
//	https://xxx/*https://yyy/
//	https://xxx/*http%3A//yyy/
//	https://xxx/*-https://yyy/
//	https://xxx/*-http%3A//yyy/
//---------------------------------------------------------

// === class begin ===
if (!class_exists('rssc_plugin_yahoo')) {
    class rssc_plugin_yahoo extends rssc_plugin_base
    {
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
            return 'convert the link to ordinary style from yahoo style';
        }

        public function convert()
        {
            $link = $this->get_item_by_key('link');
            if ($link) {
                $this->set_item_by_key('link', $this->_convert_link($link));

                return true;
            }

            return false;
        }

        public function _convert_link($link)
        {
            $pattern1 = '|https://.*\*\-?(http\%3A//.*)|i';
            $pattern2 = '|https://.*\*\-?(https://.*)|i';

            if (preg_match($pattern1, $link, $matches1)) {
                return str_replace('http%3A//', 'https://', $matches1[1]);
            } elseif (preg_match($pattern2, $link, $matches2)) {
                return $matches2[1];
            }

            return $link;
        }

        // --- class end ---
    }
    // === class end ===
}
