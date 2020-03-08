<?php
// $Id: rssc_xml_basicHandler.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2008-01-30 K.OHWADA
// bug: not save xml
// rssc_xml_basic
// add_update_xml()

// 2007-06-01 K.OHWADA
// divid from link_basicHandler

//=========================================================
// Rss Center Module
// 2007-06-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_xml_basicHandler') ) 
{

//=========================================================
// class rssc_xml_basic
//=========================================================
class rssc_xml_basic extends happy_linux_basic
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
public function __construct()
{
	parent::__construct();

	$this->init();
}

//---------------------------------------------------------
// init
//---------------------------------------------------------
public function init()
{
	$this->_vars = [
		'xid' => 0,
		'lid' => 0,
		'xml' => '',
		'aux_int_1'  => 0,
		'aux_int_2'  => 0,
		'aux_text_1' => '',
		'aux_text_2' => '',
    ];

}

// --- class end ---
}


//=========================================================
// class rssc_xml_basicHandler
// this class is used by command line
// this class handle MySQL table directly
// this class does not use another class
//=========================================================
    class rssc_xml_basicHandler extends happy_linux_basicHandler
    {

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct($dirname)
        {
            parent::__construct($dirname);

            $this->set_table_name('xml');
            $this->set_id_name('lid');
            $this->set_class_name('rssc_xml_basic');

            $this->set_debug_db_sql(RSSC_DEBUG_XML_BASIC_SQL);
            $this->set_debug_db_error(RSSC_DEBUG_ERROR);
        }

        //---------------------------------------------------------
        // insert
        //---------------------------------------------------------
    public function insert($obj)
        {
            foreach ($obj->get_vars() as $k => $v) {
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

            if (!$this->query($sql)) {
                return false;
            }

            $newid = $this->_db->getInsertId();
            return $newid;
        }

        //---------------------------------------------------------
        // update
        //---------------------------------------------------------
    public function update($obj)
        {
            foreach ($obj->get_vars() as $k => $v) {
                ${$k} = $v;
            }

            $sql = 'UPDATE ' . $this->_table . ' SET ';
            $sql .= 'xml=' . $this->quote($xml) . ', ';
            $sql .= 'aux_int_1=' . (int)$aux_int_1 . ', ';
            $sql .= 'aux_int_2=' . (int)$aux_int_2 . ', ';
            $sql .= 'aux_text_1=' . $this->quote($aux_text_1) . ', ';
            $sql .= 'aux_text_2=' . $this->quote($aux_text_2) . ' ';
            $sql .= ' WHERE lid=' . (int)$lid;

            return $this->query($sql);
        }

        //---------------------------------------------------------
        // add & modify
        //---------------------------------------------------------
    public function add_update_xml($lid, $xml, $flag_xml = true)
        {
            if ($flag_xml) {
                $xml = rawurlencode($xml);
            }

            $obj =& $this->get_object_by_id($lid);
            if (is_object($obj)) {
                // update
                $obj->set('xml', $xml);
                return $this->update($obj);
            }

            // insert
            $obj = $this->create();
            $obj->set('lid', $lid);
            $obj->set('xml', $xml);
            return $this->insert($obj);
        }

        //---------------------------------------------------------
        // get
        //---------------------------------------------------------
        public function get_xml_by_lid($lid)
        {
            $ret = false;
            $row =& $this->get_row_by_id($lid);
            if (is_array($row) && $row['xml']) {
                $ret = rawurldecode($row['xml']);
            }
            return $ret;
        }

        // --- class end ---
    }

// === class end ===
}


