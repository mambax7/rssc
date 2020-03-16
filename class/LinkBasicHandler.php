<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_link_basic_handler.php,v 1.1 2011/12/29 14:37:15 ohwada Exp $

// 2008-01-30 K.OHWADA
// get_cache_post_plugin_by_lid()

// 2007-10-10 K.OHWADA
// enclosure

// 2007-06-01 K.OHWADA
// divid to xml_basicHandler
// get_link_by_lid() etc

// 2006-09-20 K.OHWADA
// small change

// 2006-07-10 K.OHWADA
// use happy_linux_basic happy_linux_basic_handler

// 2006-06-04 K.OHWADA
// this is new file
// move from linkHandler

//=========================================================
// Rss Center Module
// 2006-06-04 K.OHWADA
//=========================================================



    //=========================================================
    // class LinkBasicHandler
    // this class is used by command line
    // this class handle MySQL table directly
    // this class does not use another class
    //=========================================================
    class LinkBasicHandler extends Happylinux\BasicHandler
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct($dirname);

            $this->set_table_name('link');
            $this->set_id_name('lid');
            $this->set_class_name(LinkBasic::class);

            $this->set_debug_db_sql(RSSC_DEBUG_LINK_BASIC_SQL);
            $this->set_debug_db_error(RSSC_DEBUG_ERROR);
        }

        //---------------------------------------------------------
        // update
        //---------------------------------------------------------
        public function update_xml_url($lid, $mode, $rdf_url, $rss_url, $atom_url)
        {
            $sql = 'UPDATE ' . $this->_table . ' SET ';
            $sql .= 'mode=' . (int)$mode . ', ';
            $sql .= 'rdf_url=' . $this->quote($rdf_url) . ', ';
            $sql .= 'rss_url=' . $this->quote($rss_url) . ', ';
            $sql .= 'atom_url=' . $this->quote($atom_url) . ' ';
            $sql .= 'WHERE lid=' . (int)$lid;

            $ret = $this->query($sql);

            return $ret;
        }

        public function update_encoding($lid, $encoding)
        {
            $sql = 'UPDATE ' . $this->_table . ' SET ';
            $sql .= 'encoding=' . $this->quote($encoding) . ' ';
            $sql .= 'WHERE lid=' . (int)$lid;

            $ret = $this->query($sql);

            return $ret;
        }

        public function update_channel($lid, $channel, $updated_unix = '', $flag_channel = true)
        {
            if ($flag_channel) {
                $channel = serialize($channel);
            }
            if (empty($updated_unix)) {
                $updated_unix = $time();
            }

            $sql = 'UPDATE ' . $this->_table . ' SET ';
            $sql .= 'channel=' . $this->quote($channel) . ', ';
            $sql .= 'updated_unix=' . (int)$updated_unix . ' ';
            $sql .= 'WHERE lid=' . (int)$lid;

            $ret = $this->query($sql);

            return $ret;
        }

        //---------------------------------------------------------
        // get
        //---------------------------------------------------------
        public function exists_by_lid($lid)
        {
            $row = &$this->get_cache_row($lid);
            if (is_array($row)) {
                return true;
            }

            return false;
        }

        public function &get_link_by_lid($lid)
        {
            $arr      = false;
            $link_obj = &$this->get_cache_object_by_id($lid);
            if (is_object($link_obj)) {
                $arr = &$link_obj->get_show();
            }

            return $arr;
        }

        public function &get_headline_lids($limit = 0, $start = 0)
        {
            $sql = 'SELECT lid FROM ' . $this->_table . ' WHERE ';
            $sql .= ' headline>0';
            $sql .= ' ORDER BY headline ASC';
            $arr = &$this->get_first_row_by_sql($sql, $limit, $start);

            return $arr;
        }

        public function &get_headline_rows($limit = 0, $start = 0)
        {
            $sql  = 'SELECT * FROM ' . $this->_table . ' WHERE ';
            $sql  .= ' headline>0';
            $sql  .= ' ORDER BY headline ASC';
            $rows = &$this->get_rows_by_sql($sql, $limit, $start);

            return $rows;
        }

        public function &get_headlines($limit = 0, $start = 0)
        {
            $links = false;
            $rows  = &$this->get_headline_rows($limit, $start);
            if (is_array($rows) && count($rows)) {
                $objs = &$this->get_objects_from_rows($rows);
                foreach ($objs as $obj) {
                    $links[] = &$obj->get_show();
                }
            }

            return $links;
        }

        // refresh all
        public function &get_active_id_array($limit = 0, $offset = 0)
        {
            // normal or search site
            $sql = 'SELECT lid FROM ' . $this->_table;
            $sql .= ' WHERE ltype<>0';
            $sql .= ' ORDER BY lid ASC';
            $arr = &$this->get_first_row_by_sql($sql, $limit, $offset);

            return $arr;
        }

        public function get_cache_post_plugin_by_lid($lid)
        {
            $row = &$this->get_cache_row($lid);
            if (!is_array($row)) {
                $this->_set_errors('Rssc\LinkHandler: no link record: lid = ' . $lid);

                return false;
            }

            return $row['post_plugin'];

            return false;
        }

        public function get_cache_ltype_by_lid($lid)
        {
            $row = &$this->get_cache_row($lid);
            if (!is_array($row)) {
                $this->_set_errors('Rssc\LinkHandler: no link record: lid = ' . $lid);

                return false;
            }

            return $row['ltype'];

            return false;
        }

        public function get_cache_enclosure_by_lid($lid)
        {
            $row = &$this->get_cache_row($lid);
            if (!is_array($row)) {
                $this->_set_errors('Rssc\LinkHandler: no link record: lid = ' . $lid);

                return false;
            }

            return $row['enclosure'];

            return false;
        }

        public function &get_channel_by_lid($lid)
        {
            $ret = false;
            $obj = &$this->get_cache_object_by_id($lid);
            if (!is_object($obj)) {
                $this->_set_errors("rssc_xmlHandler: no xml record: lid = $lid");

                return $ret;
            }
            $ret = &$obj->get_channel();

            return $ret;
        }

        // --- class end ---
    }
    // === class end ===

