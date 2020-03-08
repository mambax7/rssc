<?php
// $Id: rssc_viewHandler.php,v 1.1 2011/12/29 14:37:17 ohwada Exp $

// 2008-01-20 K.OHWADA
// _init_view_param()

// 2007-06-01 K.OHWADA
// link_basicHandler feed_basicHandler 
// get_count_public_xx()

// 2006-09-20 K.OHWADA
// add get_feed_count_by_mid() get_feed_list_by_mid()
// highlight_keyword

// 2006-07-08 K.OHWADA
// load image from channel
// change get_sanitized_store_by_lid()

// 2006-06-04 K.OHWADA
// add exists_link() exists_feed() getLatest()
// use view_format_sanitize()
// move getHeadlineLinks() to headline_handle
// suppress notice : Only variable references should be returned by reference

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_viewHandler') ) 
{

//=========================================================
// class rssc_viewHandler
//=========================================================
    class rssc_viewHandler extends rssc_view_param
    {

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct($dirname)
        {
            rssc_view_param::__construct($dirname);
            $this->_init_view_param();
        }

        //---------------------------------------------------------
        // link handler
        //---------------------------------------------------------
    public function exists_link($lid)
        {
            $ret = $this->_linkHandler->exists_by_lid($lid);
            return $ret;
        }

    public function &get_link_by_lid($lid)
        {
            $ret =& $this->_linkHandler->get_link_by_lid($lid);
            return $ret;
        }

        //---------------------------------------------------------
        // feed handler
        //---------------------------------------------------------
    public function exists_feed($fid)
        {
            $row =& $this->_feedHandler->get_cache_row_public_by_fid($fid);
            if (is_array($row)) {
                return true;
            }
            return false;
        }

    public function &get_feed_by_fid($fid)
        {
            $feed = false;
            $row  =& $this->_feedHandler->get_cache_row_public_by_fid($fid);
            if (is_array($row)) {
                $feed =& $this->view_format_sanitize_single_feed($row, $this->_flag_sanitize);
            }
            return $feed;
        }

    public function get_feed_count()
        {
            $ret = $this->_feedHandler->get_count_public();
            return $ret;
        }

    public function get_feed_count_all()
        {
            $ret = $this->_feedHandler->get_count_all();
            return $ret;
        }

    public function get_feed_count_by_lid($lid)
        {
            $ret = $this->_feedHandler->get_count_public_by_lid($lid);
            return $ret;
        }

    public function &get_feeds_by_lid($lid, $limit = 0, $start = 0)
        {
            $feeds     = false;
            $feed_rows =& $this->_feedHandler->get_rows_public_by_lid_order($lid, $this->_feed_order, $limit, $start);
            if (is_array($feed_rows) && count($feed_rows)) {
                foreach ($feed_rows as $row) {
                    $feed    =& $this->view_format_sanitize_single_feed($row, $this->_flag_sanitize);
                    $feeds[] = $feed;
                }
            }
            return $feeds;
        }

    public function get_feed_count_by_mid($mid)
        {
            $count = $this->_feedHandler->get_count_public_by_mid($mid);
            return $count;
        }

    public function &get_feed_list_by_mid($mid)
        {
            $feeds     = [];
            $feed_rows =& $this->_feedHandler->get_rows_public_by_mid_order($mid, $this->_feed_order, $this->_feed_limit, $this->_feed_start);
            $feeds     =& $this->view_format_sanitize_feed_rows($feed_rows);
            return $feeds;
        }

    public function get_feed_count_by_where($where)
        {
            $count = $this->_feedHandler->get_count_public_by_where($where);
            return $count;
        }

    public function &get_feeds_by_where($where, $limit = 0, $start = 0)
        {
            $feed_rows =& $this->_feedHandler->get_rows_public_by_where($where, $this->_feed_order, $limit, $start);
            $feeds     =& $this->view_format_sanitize_feed_rows($feed_rows);
            return $feeds;
        }

        //---------------------------------------------------------
        // for full channel headline
        //---------------------------------------------------------
    public function &get_sanitized_store_by_lid($lid)
        {
            $false = false;

            $channel =& $this->_linkHandler->get_channel_by_lid($lid);

            $feed_rows =& $this->_feedHandler->get_rows_public_by_lid_order($lid, $this->_feed_order, $this->_feed_limit, $this->_feed_start);
            $feeds     =& $this->view_format_sanitize_feed_rows($feed_rows);

            $arr = [];

            // load channel image textinput from channel field
            if (isset($channel['channel'])) {
                $arr['channel'] = $channel['channel'];
            }
            if (isset($channel['image'])) {
                $arr['image'] = $channel['image'];
            }
            if (isset($channel['textinput'])) {
                $arr['textinput'] = $channel['textinput'];
            }

            $arr['items'] = $feeds;

            // sanitize
            $data =& $this->view_sanitize($arr);
            return $data;
        }

        //---------------------------------------------------------
        // for block
        //---------------------------------------------------------
        public function &get_headline_links_feeds($link_limit = 0, $link_start = 0)
        {
            $lids  =& $this->_linkHandler->get_headline_lids($link_limit, $link_start);
            $links = [];

            foreach ($lids as $lid) {
                $link =& $this->get_link_by_lid($lid);

                $feed_rows =& $this->_feedHandler->get_rows_public_by_lid_order($lid, $this->_feed_order, $this->_feed_limit, $this->_feed_start);
                $feeds     =& $this->view_format_sanitize_feed_rows($feed_rows);

                $link['feeds'] =& $feeds;
                $links[]       =& $link;
            }

            return $links;
        }

        // --- class end ---
    }

// === class end ===
}


