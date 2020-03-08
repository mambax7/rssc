<?php
// $Id: rssc_blackHandler.php,v 1.1 2011/12/29 14:37:16 ohwada Exp $

// 2007-11-24 K.OHWADA
// move add_column_table_xxx() to rssc_install.php

// 2007-10-10 K.OHWADA
// add field cache ctime in black, white

// 2007-06-01 K.OHWADA
// add field act reg count

// 2006-07-10 K.OHWADA
// use happy_linux_object happy_linux_objectHandler

// 2006-06-04 K.OHWADA
// suppress notice : Only variable references should be returned by reference

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// this file contain 2 class
//   rssc_black
//   rssc_blackHandler
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_blackHandler') ) 
{

//=========================================================
// class black
//=========================================================
class rssc_black extends happy_linux_object
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
public function __construct()
{
	parent::__construct();

	$this->initVar('bid', XOBJ_DTYPE_INT, null, false);
	$this->initVar('lid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('mid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p1',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p2',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('p3',  XOBJ_DTYPE_INT, 0, false);
	$this->initVar('title', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('url',   XOBJ_DTYPE_URL,    null, false, 255);
	$this->initVar('memo',  XOBJ_DTYPE_TXTAREA);
	$this->initVar('aux_int_1',  XOBJ_DTYPE_INT, 0);
	$this->initVar('aux_int_2',  XOBJ_DTYPE_INT, 0);
	$this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('act',   XOBJ_DTYPE_INT, 1);
	$this->initVar('reg',   XOBJ_DTYPE_INT, 0);
	$this->initVar('count', XOBJ_DTYPE_INT, 0);

	$this->initVar('cache', XOBJ_DTYPE_INT, 0);
	$this->initVar('ctime', XOBJ_DTYPE_INT, 0);
}

// --- class end ---
}

//=========================================================
// class black handler
//=========================================================
    class rssc_blackHandler extends happy_linux_objectHandler
    {

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct($dirname)
        {
            parent::__construct($dirname, 'black', 'bid', 'rssc_black');

            $this->set_debug_db_sql(RSSC_DEBUG_BLACK_SQL);
            $this->set_debug_db_error(RSSC_DEBUG_ERROR);
        }

        //---------------------------------------------------------
        // function
        //---------------------------------------------------------
    public function _build_insert_sql($obj)
        {
            foreach ($obj->gets() as $k => $v) {
                ${$k} = $v;
            }

            $sql = 'INSERT INTO ' . $this->_table . ' (';
            $sql .= 'lid, ';
            $sql .= 'uid, ';
            $sql .= 'mid, ';
            $sql .= 'p1, ';
            $sql .= 'p2, ';
            $sql .= 'p3, ';
            $sql .= 'title, ';
            $sql .= 'url, ';
            $sql .= 'memo, ';
            $sql .= 'act, ';
            $sql .= 'reg, ';
            $sql .= 'count, ';

            $sql .= 'cache, ';
            $sql .= 'ctime, ';

            $sql .= 'aux_int_1, ';
            $sql .= 'aux_int_2, ';
            $sql .= 'aux_text_1, ';
            $sql .= 'aux_text_2 ';

            $sql .= ') VALUES (';

            $sql .= (int)$lid . ', ';
            $sql .= (int)$uid . ', ';
            $sql .= (int)$mid . ', ';
            $sql .= (int)$p1 . ', ';
            $sql .= (int)$p2 . ', ';
            $sql .= (int)$p3 . ', ';
            $sql .= $this->quote($title) . ', ';
            $sql .= $this->quote($url) . ', ';
            $sql .= $this->quote($memo) . ', ';
            $sql .= (int)$act . ', ';
            $sql .= (int)$reg . ', ';
            $sql .= (int)$count . ', ';

            $sql .= (int)$cache . ', ';
            $sql .= (int)$ctime . ', ';

            $sql .= (int)$aux_int_1 . ', ';
            $sql .= (int)$aux_int_2 . ', ';
            $sql .= $this->quote($aux_text_1) . ', ';
            $sql .= $this->quote($aux_text_2) . ' ';
            $sql .= ')';

            return $sql;
        }

    public function _build_update_sql($obj)
        {
            foreach ($obj->gets() as $k => $v) {
                ${$k} = $v;
            }

            $sql = 'UPDATE ' . $this->_table . ' SET ';
            $sql .= 'lid=' . (int)$lid . ', ';
            $sql .= 'uid=' . (int)$uid . ', ';
            $sql .= 'mid=' . (int)$mid . ', ';
            $sql .= 'p1=' . (int)$p1 . ', ';
            $sql .= 'p2=' . (int)$p2 . ', ';
            $sql .= 'p3=' . (int)$p3 . ', ';
            $sql .= 'title=' . $this->quote($title) . ', ';
            $sql .= 'url=' . $this->quote($url) . ', ';
            $sql .= 'memo=' . $this->quote($memo) . ', ';
            $sql .= 'act=' . (int)$act . ', ';
            $sql .= 'reg=' . (int)$reg . ', ';
            $sql .= 'count=' . (int)$count . ', ';

            $sql .= 'cache=' . (int)$cache . ', ';
            $sql .= 'ctime=' . (int)$ctime . ', ';

            $sql .= 'aux_int_1=' . (int)$aux_int_1 . ', ';
            $sql .= 'aux_int_2=' . (int)$aux_int_2 . ', ';
            $sql .= 'aux_text_1=' . $this->quote($aux_text_1) . ', ';
            $sql .= 'aux_text_2=' . $this->quote($aux_text_2) . ' ';
            $sql .= 'WHERE bid=' . (int)$bid;

            return $sql;
        }

        //---------------------------------------------------------
        // get
        //---------------------------------------------------------
    public function &get_objects_count_asc($limit = 0, $start = 0)
        {
            $sort     = 'count ASC, bid ASC';
            $criteria = new CriteriaCompo();
            $criteria->setSort($sort);
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs =& $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_count_desc($limit = 0, $start = 0)
        {
            $sort     = 'count DESC, bid ASC';
            $criteria = new CriteriaCompo();
            $criteria->setSort($sort);
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs =& $this->getObjects($criteria);
            return $objs;
        }

        // --- class end ---
    }

// === class end ===
}


