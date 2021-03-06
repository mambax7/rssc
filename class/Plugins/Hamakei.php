<?php

namespace XoopsModules\Rssc\Plugins;

// $Id: hamakei.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

//=========================================================
// Rss Center Module
// 2009-02-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// name: hamakei
// description: georss and mediarss for hamakei
// param: none
//---------------------------------------------------------

// === class begin ===
if (!class_exists(Hamakei::class)) {
    class Hamakei extends Base
    {
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
            return 'georss and mediarss for hamakei';
        }

        public function convert()
        {
            $url       = $this->get_item_by_key('enclosure_url');
            $type      = $this->get_item_by_key('enclosure_type');
            $length    = $this->get_item_by_key('enclosure_length');
            $item_orig = $this->get_item_by_key('item_orig');

            // mediarss
            if ($url && ('image/jpeg' == $type)) {
                $this->set_item_by_key('media_content_url', $url);
                $this->set_item_by_key('media_content_type', $type);
                $this->set_item_by_key('media_content_filesize', $length);
                $this->set_item_by_key('media_content_medium', 'image');
            }

            // georss
            if (isset($item_orig['dc']['coverage'])) {
                $arr = explode(',', $item_orig['dc']['coverage']);
                if (isset($arr[0]) && isset($arr[1])) {
                    $long = (float)$arr[0];
                    $lat  = (float)$arr[1];
                    if ((0 != $lat) && (0 != $long)) {
                        $this->set_item_by_key('geo_lat', $lat);
                        $this->set_item_by_key('geo_long', $long);
                    }
                }
            }

            return true;
        }

        // --- class end ---
    }
    // === class end ===
}
