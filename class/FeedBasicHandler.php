<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_feed_basic_handler.php,v 1.1 2011/12/29 14:37:15 ohwada Exp $

// 2009-02-20 K.OHWADA
// geo_lat

// 2008-02-24 K.OHWADA
// long url

// 2008-01-20 K.OHWADA
// change refresh()

// 2007-10-10 K.OHWADA
// change refresh()

// 2007-06-01 K.OHWADA
// add act field
// add get_count_public_xxx()
// BUG: all clear when total = num

// 2006-09-20 K.OHWADA
// add _DEBUG_INSERT_EXEC
// add get_clear_num()

// 2006-07-10 K.OHWADA
// use happy_linux_basic happy_linux_basic_handler
// corresponding to podcast
// add enclosure

// 2006-06-04 K.OHWADA
// this is new file
// move from feedHandler

//=========================================================
// Rss Center Module
// 2006-06-04 K.OHWADA
//=========================================================



    //=========================================================
    // class FeedBasicHandler
    // this class is used by command line
    // this class handle MySQL table directly
    // this class does not use another class
    //=========================================================
    class FeedBasicHandler extends Happylinux\BasicHandler
    {
        // set false, if not insert
        public $_DEBUG_INSERT_EXEC = true;

        // input parameter
        public $_future_days = 3;    // 3 days

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct($dirname);

            $this->set_table_name('feed');
            $this->set_id_name('fid');
            $this->set_class_name(FeedBasic::class);

            $this->set_debug_db_sql(RSSC_DEBUG_FEED_BASIC_SQL);
            $this->set_debug_db_error(RSSC_DEBUG_ERROR);
        }

        //---------------------------------------------------------
        // insert
        //---------------------------------------------------------
        public function insert($obj)
        {
            if (!$this->_check_class($obj)) {
                $this->_set_errors('feed table: not match class');

                return false;
            }

            foreach ($obj->get_vars() as $k => $v) {
                ${$k} = $v;
            }

            $sql = 'INSERT INTO ' . $this->_table . ' (';
            $sql .= 'lid, ';
            $sql .= 'uid, ';
            $sql .= 'mid, ';
            $sql .= 'p1, ';
            $sql .= 'p2, ';
            $sql .= 'p3, ';
            $sql .= 'site_title, ';
            $sql .= 'site_link, ';
            $sql .= 'title, ';
            $sql .= 'link, ';
            $sql .= 'entry_id, ';
            $sql .= 'guid, ';
            $sql .= 'updated_unix, ';
            $sql .= 'published_unix, ';
            $sql .= 'category, ';
            $sql .= 'author_name, ';
            $sql .= 'author_uri, ';
            $sql .= 'author_email, ';
            $sql .= 'type_cont, ';
            $sql .= 'raws, ';
            $sql .= 'content, ';
            $sql .= 'search, ';
            $sql .= 'aux_int_1, ';
            $sql .= 'aux_int_2, ';
            $sql .= 'aux_text_1, ';
            $sql .= 'aux_text_2, ';

            // enclosure
            $sql .= 'enclosure_url, ';
            $sql .= 'enclosure_type, ';
            $sql .= 'enclosure_length, ';
            $sql .= 'act, ';

            // geo
            $sql .= 'geo_lat, ';
            $sql .= 'geo_long, ';

            // media
            $sql .= 'media_content_url, ';
            $sql .= 'media_content_type, ';
            $sql .= 'media_content_medium, ';
            $sql .= 'media_content_filesize, ';
            $sql .= 'media_content_width, ';
            $sql .= 'media_content_height, ';
            $sql .= 'media_thumbnail_url, ';
            $sql .= 'media_thumbnail_width, ';
            $sql .= 'media_thumbnail_height ';

            $sql .= ') VALUES (';
            $sql .= (int)$lid . ', ';
            $sql .= (int)$uid . ', ';
            $sql .= (int)$mid . ', ';
            $sql .= (int)$p1 . ', ';
            $sql .= (int)$p2 . ', ';
            $sql .= (int)$p3 . ', ';
            $sql .= $this->quote($site_title) . ', ';
            $sql .= $this->quote($site_link) . ', ';
            $sql .= $this->quote($title) . ', ';
            $sql .= $this->quote($link) . ', ';
            $sql .= $this->quote($entry_id) . ', ';
            $sql .= $this->quote($guid) . ', ';
            $sql .= (int)$updated_unix . ', ';
            $sql .= (int)$published_unix . ', ';
            $sql .= $this->quote($category) . ', ';
            $sql .= $this->quote($author_name) . ', ';
            $sql .= $this->quote($author_uri) . ', ';
            $sql .= $this->quote($author_email) . ', ';
            $sql .= $this->quote($type_cont) . ', ';
            $sql .= $this->quote($raws) . ', ';
            $sql .= $this->quote($content) . ', ';
            $sql .= $this->quote($search) . ', ';
            $sql .= (int)$aux_int_1 . ', ';
            $sql .= (int)$aux_int_2 . ', ';
            $sql .= $this->quote($aux_text_1) . ', ';
            $sql .= $this->quote($aux_text_2) . ', ';

            // enclosure
            $sql .= $this->quote($enclosure_url) . ', ';
            $sql .= $this->quote($enclosure_type) . ', ';
            $sql .= (int)$enclosure_length . ', ';
            $sql .= (int)$act . ', ';

            // geo
            $sql .= (float)$geo_lat . ', ';
            $sql .= (float)$geo_long . ', ';

            // media
            $sql .= $this->quote($media_content_url) . ', ';
            $sql .= $this->quote($media_content_type) . ', ';
            $sql .= $this->quote($media_content_medium) . ', ';
            $sql .= (int)$media_content_filesize . ', ';
            $sql .= (int)$media_content_width . ', ';
            $sql .= (int)$media_content_height . ', ';
            $sql .= $this->quote($media_thumbnail_url) . ', ';
            $sql .= (int)$media_thumbnail_width . ', ';
            $sql .= (int)$media_thumbnail_height . ' ';

            $sql .= ')';

            if (!$this->query($sql)) {
                return false;
            }

            $newid = $this->_db->getInsertId();

            return $newid;
        }

        //---------------------------------------------------------
        // delete
        //---------------------------------------------------------
        public function delete_by_link($link)
        {
            $sql = 'DELETE FROM ' . $this->_table . ' WHERE link=' . $this->quote($link);
            $ret = $this->query($sql);

            return $ret;
        }

        //---------------------------------------------------------
        // get count
        //---------------------------------------------------------
        // index.php
        public function &get_count_public()
        {
            $sql   = 'SELECT COUNT(*) FROM ' . $this->_table . ' WHERE ';
            $sql   .= $this->_get_where_public();
            $count = $this->get_count_by_sql($sql);

            return $count;
        }

        // single_link.php
        public function &get_count_public_by_lid($lid)
        {
            $future = $this->_get_future_time();

            $sql   = 'SELECT COUNT(*) FROM ' . $this->_table . ' WHERE ';
            $sql   .= $this->_get_where_public();
            $sql   .= ' AND lid=' . (int)$lid;
            $count = $this->get_count_by_sql($sql);

            return $count;
        }

        public function &get_count_public_by_mid($mid)
        {
            $ret = false;
            if ($mid) {
                $sql = 'SELECT COUNT(*) FROM ' . $this->_table . ' WHERE ';
                $sql .= $this->_get_where_public();
                $sql .= ' AND mid=' . (int)$mid;
                $ret = $this->get_count_by_sql($sql);
            }

            return $ret;
        }

        // search
        public function get_count_public_by_where($where)
        {
            $sql = 'SELECT COUNT(*) FROM ' . $this->_table . ' WHERE ';
            $sql .= $this->_get_where_public();
            $sql .= ' AND ' . $where;
            $ret = $this->get_count_by_sql($sql);

            return $ret;
        }

        // inactive or time not change
        public function get_count_by_link_time($link, $time)
        {
            $sql   = 'SELECT COUNT(*) FROM ' . $this->_table . ' WHERE ';
            $sql   .= ' link=' . $this->quote($link);
            $sql   .= ' AND ( act=0 OR ';
            $sql   .= ' updated_unix >= ' . (int)$time . ' )';
            $count = $this->get_count_by_sql($sql);

            return $count;
        }

        public function get_count_by_link($link)
        {
            $sql   = 'SELECT COUNT(*) FROM ' . $this->_table . ' WHERE ';
            $sql   .= ' act=1';
            $sql   .= ' AND link=' . $this->quote($link);
            $count = $this->get_count_by_sql($sql);

            return $count;
        }

        public function _get_where_public()
        {
            $future = $this->_get_future_time();

            $where = 'act=1';
            $where .= ' AND updated_unix<' . (int)$future;
            $where .= ' AND published_unix<' . (int)$future;

            return $where;
        }

        //---------------------------------------------------------
        // get row
        //---------------------------------------------------------
        // single_feed.php
        public function &get_cache_row_public_by_fid($fid)
        {
            $row = false;
            if (isset($this->_cached[$fid])) {
                $row = &$this->_cached[$fid];
            } else {
                $row = &$this->get_row_public_by_fid($fid);
                if (is_array($row) && count($row)) {
                    $this->_cached[$fid] = $row;
                }
            }

            return $row;
        }

        public function &get_row_public_by_fid($fid)
        {
            $sql = 'SELECT * FROM ' . $this->_table . ' WHERE ';
            $sql .= $this->_get_where_public();
            $sql .= ' AND fid=' . (int)$fid;
            $row = &$this->get_row_by_sql($sql);

            return $row;
        }

        //---------------------------------------------------------
        // get rows
        //---------------------------------------------------------
        // index.php
        public function &get_rows_public_by_order($order = 'updated_unix DESC, fid DESC', $limit = 0, $start = 0)
        {
            $sql  = 'SELECT * FROM ' . $this->_table . ' WHERE ';
            $sql  .= $this->_get_where_public();
            $sql  .= ' ORDER BY ' . $order;
            $rows = &$this->get_rows_by_sql($sql, $limit, $start);

            return $rows;
        }

        // single_link.php
        public function &get_rows_public_by_lid_order($lid, $order = 'updated_unix DESC, fid DESC', $limit = 0, $start = 0)
        {
            $future = $this->_get_future_time();

            $sql  = 'SELECT * FROM ' . $this->_table . ' WHERE ';
            $sql  .= $this->_get_where_public();
            $sql  .= ' AND lid=' . (int)$lid;
            $sql  .= ' ORDER BY ' . $order;
            $rows = &$this->get_rows_by_sql($sql, $limit, $start);

            return $rows;
        }

        public function &get_rows_public_by_mid_order($mid, $order = 'updated_unix DESC, fid DESC', $limit = 0, $start = 0)
        {
            $rows = false;
            if ($mid) {
                $sql  = 'SELECT * FROM ' . $this->_table . ' WHERE ';
                $sql  .= $this->_get_where_public();
                $sql  .= ' AND mid=' . (int)$mid;
                $sql  .= ' ORDER BY ' . $order;
                $rows = &$this->get_rows_by_sql($sql, $limit, $start);
            }

            return $rows;
        }

        // search
        public function &get_rows_public_by_where($where, $order = '', $limit = 0, $start = 0)
        {
            $sql = 'SELECT * FROM ' . $this->_table . ' WHERE ';
            $sql .= $this->_get_where_public();
            $sql .= ' AND ' . $where;

            if ($order) {
                $sql .= ' ORDER BY ' . $order;
            } else {
                $sql .= ' ORDER BY fid';
            }

            $rows = &$this->get_rows_by_sql($sql, $limit, $start);

            return $rows;
        }

        //---------------------------------------------------------
        // get_future_time
        // some feed have future date
        // supress at showing
        //---------------------------------------------------------
        public function _get_future_time()
        {
            $time = time() + 86400 * $this->_future_days;

            return $time;
        }

        //---------------------------------------------------------
        // get_fid array
        //---------------------------------------------------------
        public function &get_fid_array_older($limit = 0, $offset = 0)
        {
            $sql = 'SELECT fid FROM ' . $this->_table . ' ORDER BY updated_unix ASC';
            $arr = &$this->get_first_row_by_sql($sql, $limit, $offset);

            return $arr;
        }

        //---------------------------------------------------------
        // clear feed
        //---------------------------------------------------------
        public function clear_over_num($num)
        {
            if ($num <= 0) {
                return 0;    // no action
            }

            $total = $this->get_count_all();
            $limit = $total - $num;

            // BUG: all clear when total = num
            if ($limit <= 0) {
                return 0;    // no action
            }

            $fid_arr = $this->get_fid_array_older($limit);

            // exec
            foreach ($fid_arr as $fid) {
                $this->delete_by_id($fid);
            }

            return $limit;
        }

        //---------------------------------------------------------
        // refresh feed
        //---------------------------------------------------------
        public function refresh(&$item)
        {
            $this->_clear_errors();

            $link = $this->_get_item($item, 'link');

            // delete old, if exist
            $count_link = $this->get_count_by_link($link);
            if ($count_link) {
                $this->delete_by_link($link);
            }

            // add new
            $obj = $this->create();
            $obj->merge_vars($item);
            $obj->subsutute_date();
            $obj->set_search();

            if ($this->_DEBUG_INSERT_EXEC) {
                $this->insert($obj);
            }

            return $this->returnExistError();
        }

        public function _get_item($item, $key)
        {
            if (isset($item[$key])) {
                $ret = $item[$key];

                return $ret;
            }

            return null;
        }

        //---------------------------------------------------------
        // set and get property
        //---------------------------------------------------------
        public function set_future($value)
        {
            $this->_future_days = (int)$value;
        }

        // --- class end ---
    }
    // === class end ===

