<?php
// $Id: rssc_black_basicHandler.php,v 1.1 2011/12/29 14:37:16 ohwada Exp $

// 2007-06-01 K.OHWADA
// get_rows_act() countup() add_link()

// 2006-09-20 K.OHWADA
// small change

// 2006-07-08 K.OHWADA
// use happy_linux_basicHandler

// 2006-06-04 K.OHWADA
// this is new file

//=========================================================
// Rss Center Module
// 2006-06-04 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_black_basicHandler') ) 
{

//=========================================================
// class black handler
// this class is used by command line
// this class handle MySQL table directly
// this class does not use another class
//=========================================================
    class rssc_black_basicHandler extends happy_linux_basicHandler
    {

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct($dirname)
        {
            parent::__construct($dirname);

            $this->set_table_name('black');
            $this->set_id_name('bid');

            $this->set_debug_db_sql(RSSC_DEBUG_BLACK_BASIC_SQL);
            $this->set_debug_db_error(RSSC_DEBUG_ERROR);
        }

        //---------------------------------------------------------
        // insert
        //---------------------------------------------------------
    public function insert_link($title, $url, $act = 0)
        {
            $sql = 'INSERT INTO ' . $this->_table . ' ( ';
            $sql .= 'title, url, act';
            $sql .= ' ) VALUES ( ';
            $sql .= $this->quote($title) . ', ';
            $sql .= $this->quote($url) . ', ';
            $sql .= (int)$act . ' ';
            $sql .= ' )';

            $ret = $this->query($sql);
            return $ret;
        }

        //---------------------------------------------------------
        // update
        //---------------------------------------------------------
    public function countup($bid)
        {
            $sql = 'UPDATE ' . $this->_table . ' SET count = count+1 WHERE bid=' . (int)$bid;
            $ret = $this->query($sql);
            return $ret;
        }

        //---------------------------------------------------------
        // select
        //---------------------------------------------------------
    public function exist_url($url)
        {
            $sql = 'SELECT count(*) FROM ' . $this->_table;
            $sql .= ' WHERE url=' . $this->quote($url);
            $ret = $this->get_count_by_sql($sql);
            return $ret;
        }

    public function &get_rows_act($limit = 0, $offset = 0)
        {
            $sql  = 'SELECT * FROM ' . $this->_table;
            $sql  .= " WHERE act=1 AND url<>'' ";
            $sql  .= ' ORDER BY bid ASC';
            $rows =& $this->get_rows_by_sql($sql, $limit, $offset);
            return $rows;
        }

        // refresh all
    public function &get_active_id_array($limit = 0, $offset = 0)
        {
            $sql  = 'SELECT bid FROM ' . $this->_table;
            $sql  .= " WHERE act=1 AND url<>'' ";
            $sql  .= ' ORDER BY bid ASC';
            $rows =& $this->get_first_row_by_sql($sql, $limit, $offset);
            return $rows;
        }

        //---------------------------------------------------------
        // add
        //---------------------------------------------------------
        public function add_link($title, $url)
        {
            // insert new record, if not exist
            if (!$this->exist_url($url)) {
                return $this->insert_link($title, $url);
            }
            return true;    // no action
        }

        // --- class end ---
    }

// === class end ===
}


