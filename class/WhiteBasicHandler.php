<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: WhiteBasicHandler.php,v 1.1 2011/12/29 14:37:17 ohwada Exp $

// 2007-06-01 K.OHWADA
// get_rows_act() countup()

// 2006-09-20 K.OHWADA
// small change

// 2006-07-10 K.OHWADA
// use happy_linux_basic_handler

// 2006-06-04 K.OHWADA
// this is new file

//=========================================================
// Rss Center Module
// 2006-06-04 K.OHWADA
//=========================================================

    //=========================================================
    // class white handler
    // this class is used by command line
    // this class handle MySQL table directly
    // this class does not use another class
    //=========================================================
    class WhiteBasicHandler extends Happylinux\BasicHandler
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct($dirname);

            $this->set_table_name('white');
            $this->set_id_name('wid');

            $this->set_debug_db_sql(RSSC_DEBUG_WHITE_BASIC_SQL);
            $this->set_debug_db_error(RSSC_DEBUG_ERROR);
        }

        //---------------------------------------------------------
        // update
        //---------------------------------------------------------
        public function countup($wid)
        {
            $sql = 'UPDATE ' . $this->_table . ' SET count = count+1 WHERE wid=' . (int)$wid;
            $ret = $this->query($sql);

            return $ret;
        }

        //---------------------------------------------------------
        // select
        //---------------------------------------------------------
        public function &get_rows_act($limit = 0, $offset = 0)
        {
            $sql  = 'SELECT * FROM ' . $this->_table;
            $sql  .= " WHERE act=1 AND url<>'' ";
            $sql  .= ' ORDER BY wid ASC';
            $rows = &$this->get_rows_by_sql($sql, $limit, $offset);

            return $rows;
        }

        // --- class end ---
    }
    // === class end ===

