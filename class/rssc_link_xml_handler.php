<?php
// $Id: rssc_link_xml_handler.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

//=========================================================
// Rss Center Module
// 2007-06-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_link_xml_handler') ) 
{

//=========================================================
// class link handler
//=========================================================
    class rssc_link_xml_handler extends rssc_link_handler
    {
        var $_xml_handler;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct($dirname)
        {
            rssc_link_handler::__construct($dirname);

            $this->_xml_handler =& rssc_get_handler('xml', $dirname);
        }

        //---------------------------------------------------------
        // basic function
        //---------------------------------------------------------
    public function insert(&$obj, $force = false)
        {
            // link table
            $newid = parent::insert($obj, $force);
            if (!$newid) {
                return false;
            }

            // xml table
            $xml_obj =& $this->_xml_handler->create();
            $xml_obj->set_vars_insert($newid);
            $xml_newid = $this->_xml_handler->insert($xml_obj);
            if (!$xml_newid) {
                $this->_set_errors($this->_xml_handler->getErrors());
                return false;
            }

            return $newid;
        }

        public function delete(&$obj, $force = false)
        {
            // link table
            $ret = parent::delete($obj, $force);
            if (!$ret) {
                return false;
            }

            // xml table
            $ret = $this->_xml_handler->delete_by_id($obj->get('lid'));
            if (!$ret) {
                $this->_set_errors($this->_xml_handler->getErrors());
                return false;
            }

            return true;
        }

        // --- class end ---
    }

// === class end ===
}

?>
