<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_link_handler.php,v 1.2 2012/04/10 03:06:50 ohwada Exp $

// 2012-04-02 K.OHWADA
// url XOBJ_DTYPE_URL -> XOBJ_DTYPE_URL_AREA

// 2009-02-20 K.OHWADA
// gicon_id

// 2008-01-20 K.OHWADA
// post_plugin in link

// 2007-11-24 K.OHWADA
// move add_column_table_xxx() to rssc_install.php

// 2007-10-10 K.OHWADA
// enclosure censor plugin in link

// 2007-06-01 K.OHWADA
// divid to xmlHandler
// add get_ltype_option()
// use Rssc\LinkBasic

// 2006-09-18 K.OHWADA
// move build_error_rssurl_list() from rssc_link_existHandler
// change _build_insert_sql() get_list_by_rssurl()

// 2006-07-10 K.OHWADA
// use happy_linux_object happy_linux_object_handler

// 2006-06-04 K.OHWADA
// add build_show(), get_export_channel()
// move refreshExpired(), update_xml_url(), etc to link_basic
// move _sanitize_link(), etc to xml_object
// use get_cache()
// suppress notice : Only variable references should be returned by reference

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// this file contain 2 class
//   rssc_link
//   rssc_link_handler
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class link handler
//=========================================================
class LinkHandler extends Happylinux\BaseObjectHandler
{
    // link table
    public $_link_lid;
    public $_link_obj;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        parent::__construct($dirname, 'link', 'lid', Link::class);

        $this->set_debug_db_sql(RSSC_DEBUG_LINK_SQL);
        $this->set_debug_db_error(RSSC_DEBUG_ERROR);
    }

    //=========================================================
    // Public
    //=========================================================
    //---------------------------------------------------------
    // basic function
    //---------------------------------------------------------
    public function _build_insert_sql($obj)
    {
        foreach ($obj->gets() as $k => $v) {
            ${$k} = $v;
        }

        $sql = 'INSERT INTO ' . $this->_table . ' (';
        $sql .= 'uid, ';
        $sql .= 'mid, ';
        $sql .= 'p1, ';
        $sql .= 'p2, ';
        $sql .= 'p3, ';
        $sql .= 'title, ';
        $sql .= 'url, ';
        $sql .= 'ltype, ';
        $sql .= 'rdf_url, ';
        $sql .= 'rss_url, ';
        $sql .= 'atom_url, ';
        $sql .= 'mode, ';
        $sql .= 'encoding, ';
        $sql .= 'refresh, ';
        $sql .= 'headline, ';
        $sql .= 'updated_unix, ';
        $sql .= 'channel, ';
        $sql .= 'xml, ';

        $sql .= 'enclosure, ';
        $sql .= 'censor, ';
        $sql .= 'plugin, ';
        $sql .= 'post_plugin, ';
        $sql .= 'icon, ';
        $sql .= 'gicon_id, ';

        $sql .= 'aux_int_1, ';
        $sql .= 'aux_int_2, ';
        $sql .= 'aux_text_1, ';
        $sql .= 'aux_text_2 ';

        $sql .= ') VALUES (';
        $sql .= (int)$uid . ', ';
        $sql .= (int)$mid . ', ';
        $sql .= (int)$p1 . ', ';
        $sql .= (int)$p2 . ', ';
        $sql .= (int)$p3 . ', ';
        $sql .= $this->quote($title) . ', ';
        $sql .= $this->quote($url) . ', ';
        $sql .= (int)$ltype . ', ';
        $sql .= $this->quote($rdf_url) . ', ';
        $sql .= $this->quote($rss_url) . ', ';
        $sql .= $this->quote($atom_url) . ', ';
        $sql .= (int)$mode . ', ';
        $sql .= $this->quote($encoding) . ', ';
        $sql .= (int)$refresh . ', ';
        $sql .= (int)$headline . ', ';
        $sql .= (int)$updated_unix . ', ';
        $sql .= $this->quote($channel) . ', ';
        $sql .= $this->quote($xml) . ', ';

        $sql .= (int)$enclosure . ', ';
        $sql .= $this->quote($censor) . ', ';
        $sql .= $this->quote($plugin) . ', ';
        $sql .= $this->quote($post_plugin) . ', ';
        $sql .= $this->quote($icon) . ', ';
        $sql .= (int)$gicon_id . ', ';

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
        $sql .= 'uid=' . (int)$uid . ', ';
        $sql .= 'mid=' . (int)$mid . ', ';
        $sql .= 'p1=' . (int)$p1 . ', ';
        $sql .= 'p2=' . (int)$p2 . ', ';
        $sql .= 'p3=' . (int)$p3 . ', ';
        $sql .= 'title=' . $this->quote($title) . ', ';
        $sql .= 'url=' . $this->quote($url) . ', ';
        $sql .= 'ltype=' . (int)$ltype . ', ';
        $sql .= 'rdf_url=' . $this->quote($rdf_url) . ', ';
        $sql .= 'rss_url=' . $this->quote($rss_url) . ', ';
        $sql .= 'atom_url=' . $this->quote($atom_url) . ', ';
        $sql .= 'mode=' . (int)$mode . ', ';
        $sql .= 'encoding=' . $this->quote($encoding) . ', ';
        $sql .= 'refresh=' . (int)$refresh . ', ';
        $sql .= 'headline=' . (int)$headline . ', ';
        $sql .= 'updated_unix=' . (int)$updated_unix . ', ';
        $sql .= 'channel=' . $this->quote($channel) . ', ';
        $sql .= 'xml=' . $this->quote($xml) . ', ';

        $sql .= 'enclosure=' . (int)$enclosure . ', ';
        $sql .= 'censor=' . $this->quote($censor) . ', ';
        $sql .= 'plugin=' . $this->quote($plugin) . ', ';
        $sql .= 'post_plugin=' . $this->quote($post_plugin) . ', ';
        $sql .= 'icon=' . $this->quote($icon) . ', ';
        $sql .= 'gicon_id=' . (int)$gicon_id . ', ';

        $sql .= 'aux_int_1=' . (int)$aux_int_1 . ', ';
        $sql .= 'aux_int_2=' . (int)$aux_int_2 . ', ';
        $sql .= 'aux_text_1=' . $this->quote($aux_text_1) . ', ';
        $sql .= 'aux_text_2=' . $this->quote($aux_text_2) . ' ';
        $sql .= ' WHERE lid=' . (int)$lid;

        return $sql;
    }

    //---------------------------------------------------------
    // get same link list
    // for admin/link_manage.php
    //---------------------------------------------------------
    public function &get_list_by_rssurl($url1, $url2 = '', $url3 = '', $lid = 0)
    {
        $list   = false;
        $q_url1 = '';
        $q_url2 = '';
        $q_url3 = '';

        $sql1 = 'SELECT lid FROM ' . $this->_table . ' WHERE ';
        $sql2 = '';

        if ($url1 && ('https://' != $url1)) {
            $q_url1 = $this->quote($url1);
            $sql2   .= 'rdf_url=' . $q_url1 . ' OR ';
            $sql2   .= 'rss_url=' . $q_url1 . ' OR ';
            $sql2   .= 'atom_url=' . $q_url1;
        }

        if ($url2 && ('https://' != $url2)) {
            if ($q_url1) {
                $sql2 .= ' OR ';
            }

            $q_url2 = $this->quote($url2);
            $sql2   .= 'rdf_url=' . $q_url2 . ' OR ';
            $sql2   .= 'rss_url=' . $q_url2 . ' OR ';
            $sql2   .= 'atom_url=' . $q_url2;
        }

        if ($url3 && ('https://' != $url3)) {
            if ($q_url1 || $q_url2) {
                $sql2 .= ' OR ';
            }

            $q_url3 = $this->quote($url3);
            $sql2   .= 'rdf_url=' . $q_url3 . ' OR ';
            $sql2   .= 'rss_url=' . $q_url3 . ' OR ';
            $sql2   .= 'atom_url=' . $q_url3;
        }

        if ($sql2) {
            $sql = $sql1 . ' ( ' . $sql2 . ' ) ';

            if ($lid) {
                $sql .= 'AND lid != ' . (int)$lid;
            }

            $list = &$this->get_first_rows_by_sql($sql);
            if (!is_array($list) || !count($list)) {
                $list = false;
            }
        }

        return $list;
    }

    //---------------------------------------------------------
    // check_exist_rssurl
    // for admin/link_manage.php
    //---------------------------------------------------------
    public function build_error_rssurl_list($list, $script)
    {
        $msg = null;
        if (is_array($list) && (count($list) > 0)) {
            $msg = '<ul>';

            foreach ($list as $lid) {
                $msg .= $this->_build_error_rssurl_list_single($lid, $script);
            }

            $msg .= "</ul>\n";
        }

        return $msg;
    }

    public function _build_error_rssurl_list_single($lid, $script)
    {
        $text = null;
        $obj  = $this->getCache($lid);
        if (is_object($obj)) {
            $lid_s   = sprintf('%03d', $lid);
            $url_l   = $script . $lid;
            $title_s = $obj->getVar('title');
            $url_s   = $obj->getVar('url');

            $text = '<li>';
            $text .= '<a href="' . $url_l . '" target="_blank">' . $lid_s . '</a> : ';
            $text .= '<a href="' . $url_s . '" target="_blank">' . $title_s . '</a> ';
            $text .= "</li>\n";
        }

        return $text;
    }

    public function get_mode_option()
    {
        $obj = $this->create();

        return $obj->get_mode_option();
    }

    //=========================================================
    // private
    //=========================================================
    //---------------------------------------------------------
    // link object
    //---------------------------------------------------------
    public function _set_lid($lid)
    {
        $lid = (int)$lid;
        if ($lid < 0) {
            $this->_set_errors('LinkHandler: lid not above zero');

            return false;
        }

        $this->_link_lid = $lid;

        return true;
    }

    public function _get_link_obj($lid)
    {
        if (!$this->_set_lid($lid)) {
            $this->_set_errors('LinkHandler: lid not above zero');

            return false;
        }

        $obj = &$this->get($lid);

        if (!is_object($obj)) {
            $this->_set_errors('LinkHandler: link object not exist');

            return false;
        }

        $this->_link_obj = $obj;

        return $obj;
    }

    // --- class end ---
}
// === class end ===

