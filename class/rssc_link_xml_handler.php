<?php
// $Id: rssc_link_xmlHandler.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

//=========================================================
// Rss Center Module
// 2007-06-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_link_xmlHandler') ) 
{

//=========================================================
// class link handler
//=========================================================
    class rssc_link_xmlHandler extends rssc_linkHandler
    {
        public $_xmlHandler;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct($dirname)
        {
            rssc_linkHandler::__construct($dirname);

            $this->_xmlHandler =& rssc_getHandler('xml', $dirname);
        }

        //---------------------------------------------------------
        // basic function
        //---------------------------------------------------------
    public function insert(XoopsObject $obj, $force = false)
        {
            // link table
            $newid = parent::insert($obj, $force);
            if (!$newid) {
                return false;
            }

            // xml table
            $xml_obj =  $this->_xmlHandler->create();
            $xml_obj->set_vars_insert($newid);
            $xml_newid = $this->_xmlHandler->insert($xml_obj);
            if (!$xml_newid) {
                $this->_set_errors($this->_xmlHandler->getErrors());
                return false;
            }

            return $newid;
        }

        public function delete(XoopsObject $obj, $force = false)
        {
            // link table
            $ret = parent::delete($obj, $force);
            if (!$ret) {
                return false;
            }

            // xml table
            $ret = $this->_xmlHandler->delete_by_id($obj->get('lid'));
            if (!$ret) {
                $this->_set_errors($this->_xmlHandler->getErrors());
                return false;
            }

            return true;
        }

        // --- class end ---
    }

// === class end ===
}


