<?php
// $Id: rssc_xmlHandler.php,v 1.1 2011/12/29 14:37:17 ohwada Exp $

// 2007-11-24 K.OHWADA
// move create_table() to rssc_install.php

// 2007-11-01 K.OHWADA
// remove ; in tail of sql

// 2007-06-01 K.OHWADA
// divid from linkHandler

//=========================================================
// Rss Center Module
// this file contain 2 class
//   rssc_xml
//   rssc_xmlHandler
// 2007-06-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_xmlHandler') ) 
{

//=========================================================
// class xml
//=========================================================
class rssc_xml extends happy_linux_object
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
public function __construct()
{
	parent::__construct();

	$this->initVar('xid', XOBJ_DTYPE_INT, null, false);
	$this->initVar('lid', XOBJ_DTYPE_INT, 0, false);
	$this->initVar('xml',        XOBJ_DTYPE_TXTAREA);
	$this->initVar('aux_int_1',  XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_int_2',  XOBJ_DTYPE_INT,   0);
	$this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
	$this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);
}

//---------------------------------------------------------
// set
//---------------------------------------------------------
public function set_vars_insert($lid)
{
	$this->setVar('lid', $lid);
}

public function get_rawurldecode_xml()
{
	$ret = false;
	$xml = $this->get('xml');
	if ($xml)
	{
		$ret = rawurldecode($xml);
	}
	return $ret;
}

// --- class end ---
}

//=========================================================
// class xml handler
//=========================================================
    class rssc_xmlHandler extends happy_linux_objectHandler
    {

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct($dirname)
        {
            parent::__construct($dirname, 'xml', 'lid', 'rssc_xml');

            $this->set_debug_db_sql(RSSC_DEBUG_XML_SQL);
            $this->set_debug_db_error(RSSC_DEBUG_ERROR);
        }

        //---------------------------------------------------------
        // basic function
        //---------------------------------------------------------
    public function _build_insert_sql($obj)
        {
            foreach ($obj->gets() as $k => $v) {
                ${$k} = $v;
            }

            $sql = 'INSERT INTO ' . $this->_table . ' (';
            $sql .= 'lid, ';
            $sql .= 'xml, ';
            $sql .= 'aux_int_1, ';
            $sql .= 'aux_int_2, ';
            $sql .= 'aux_text_1, ';
            $sql .= 'aux_text_2 ';
            $sql .= ') VALUES (';
            $sql .= (int)$lid . ', ';
            $sql .= $this->quote($xml) . ', ';
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
            $sql .= 'xml=' . $this->quote($xml) . ', ';
            $sql .= 'aux_int_1=' . (int)$aux_int_1 . ', ';
            $sql .= 'aux_int_2=' . (int)$aux_int_2 . ', ';
            $sql .= 'aux_text_1=' . $this->quote($aux_text_1) . ', ';
            $sql .= 'aux_text_2=' . $this->quote($aux_text_2) . ' ';
            $sql .= ' WHERE lid=' . (int)$lid;

            return $sql;
        }

        // --- class end ---
    }

// === class end ===
}


