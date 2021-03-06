<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_feed_handler.php,v 1.3 2012/04/10 03:06:50 ohwada Exp $

// 2012-04-02 K.OHWADA
// site_link XOBJ_DTYPE_URL -> XOBJ_DTYPE_URL_AREA

// 2011-12-29 K.OHWADA
// PHP 5.3 : Assigning the return value of new by reference is now deprecated.

// 2009-02-20 K.OHWADA
// geo_lat

// 2008-02-24 K.OHWADA
// change varchar to text: link

// 2007-11-24 K.OHWADA
// move add_column_table_xxx() to rssc_install.php

// 2007-10-10 K.OHWADA
// match https://xxx/*https://yyy/

// 2007-07-01 K.OHWADA
// add act field
// add get_objects_non_act() etc

// 2006-09-01 K.OHWADA
// add get_objects_latest()   : remove get_latest()
// add get_objects_by_where() : remove get_feeds_by_where()
// add get_count_by_mid() get_objects_by_mid_order()
// remove get_feed_by_fid() get_feeds_by_lid()

// 2006-07-10 K.OHWADA
// use happy_linux_object happy_linux_object_handler
// use happy_linux_strings
// support podcast

// 2006-06-29 K.OHWADA
// get_objects_by_lid_desc
// get_objects_by_link_desc

// 2006-01-20 K.OHWADA
// small change

//=========================================================
// Rss Center Module
// class feed
// this file contain 2 class
//   Feed
//   FeedHandler
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class feed handler
//=========================================================
class FeedHandler extends Happylinux\BaseObjectHandler
{
    // class
    public $_strings;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        parent::__construct($dirname, 'feed', 'fid', Feed::class);

        $this->set_debug_db_sql(RSSC_DEBUG_FEED_SQL);
        $this->set_debug_db_error(RSSC_DEBUG_ERROR);

        // class
        $this->_strings = Happylinux\Strings::getInstance();
    }

    //=========================================================
    // Public
    //=========================================================
    //---------------------------------------------------------
    // basic function
    //---------------------------------------------------------

    // for future
    // now, admin cannot add feed record
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
        $sql .= 'site_title=' . $this->quote($site_title) . ', ';
        $sql .= 'site_link=' . $this->quote($site_link) . ', ';
        $sql .= 'title=' . $this->quote($title) . ', ';
        $sql .= 'link=' . $this->quote($link) . ', ';
        $sql .= 'entry_id=' . $this->quote($entry_id) . ', ';
        $sql .= 'guid=' . $this->quote($guid) . ', ';
        $sql .= 'updated_unix=' . (int)$updated_unix . ', ';
        $sql .= 'published_unix=' . (int)$published_unix . ', ';
        $sql .= 'category=' . $this->quote($category) . ', ';
        $sql .= 'author_name=' . $this->quote($author_name) . ', ';
        $sql .= 'author_uri=' . $this->quote($author_uri) . ', ';
        $sql .= 'author_email=' . $this->quote($author_email) . ', ';
        $sql .= 'type_cont=' . $this->quote($type_cont) . ', ';
        $sql .= 'raws=' . $this->quote($raws) . ', ';
        $sql .= 'content=' . $this->quote($content) . ', ';
        $sql .= 'search=' . $this->quote($search) . ', ';
        $sql .= 'aux_int_1=' . (int)$aux_int_1 . ', ';
        $sql .= 'aux_int_2=' . (int)$aux_int_2 . ', ';
        $sql .= 'aux_text_1=' . $this->quote($aux_text_1) . ', ';
        $sql .= 'aux_text_2=' . $this->quote($aux_text_2) . ', ';

        // enclosure
        $sql .= 'enclosure_url=' . $this->quote($enclosure_url) . ', ';
        $sql .= 'enclosure_type=' . $this->quote($enclosure_type) . ', ';
        $sql .= 'enclosure_length=' . (int)$enclosure_length . ', ';
        $sql .= 'act=' . (int)$act . ', ';

        // geo
        $sql .= 'geo_lat=' . (float)$geo_lat . ', ';
        $sql .= 'geo_long=' . (float)$geo_long . ', ';

        // media
        $sql .= 'media_content_url=' . $this->quote($media_content_url) . ', ';
        $sql .= 'media_content_type=' . $this->quote($media_content_type) . ', ';
        $sql .= 'media_content_medium=' . $this->quote($media_content_medium) . ', ';
        $sql .= 'media_content_filesize=' . (int)$media_content_filesize . ', ';
        $sql .= 'media_content_width=' . (int)$media_content_width . ', ';
        $sql .= 'media_content_height=' . (int)$media_content_height . ', ';
        $sql .= 'media_thumbnail_url=' . $this->quote($media_thumbnail_url) . ', ';
        $sql .= 'media_thumbnail_width=' . (int)$media_thumbnail_width . ', ';
        $sql .= 'media_thumbnail_height=' . (int)$media_thumbnail_height . ' ';

        $sql .= 'WHERE fid=' . (int)$fid;

        return $sql;
    }

    //---------------------------------------------------------
    // get count
    //---------------------------------------------------------
    public function get_total()
    {
        $ret = $this->getCount();

        return $ret;
    }

    public function get_count_by_lid($lid)
    {
        $ret = 0;
        if ($lid) {
            $criteria = new \CriteriaCompo();
            $criteria->add($this->get_addtion_by_lid($lid));
            $ret = $this->getCount($criteria);
        }

        return $ret;
    }

    public function get_count_by_lid_non_act($lid)
    {
        $ret = 0;
        if ($lid) {
            $criteria = new \CriteriaCompo();
            $criteria->add(new \Criteria('act', 0, '='));
            $criteria->add($this->get_addtion_by_lid($lid));
            $ret = $this->getCount($criteria);
        }

        return $ret;
    }

    public function get_count_by_link($link)
    {
        $ret = 0;
        if ($link) {
            $criteria = new \CriteriaCompo();
            $criteria->add($this->get_addtion_by_link($link));
            $ret = $this->getCount($criteria);
        }

        return $ret;
    }

    public function get_count_by_link_non_act($link)
    {
        $ret = 0;
        if ($link) {
            $criteria = new \CriteriaCompo();
            $criteria->add(new \Criteria('act', 0, '='));
            $criteria->add($this->get_addtion_by_link($link));
            $ret = $this->getCount($criteria);
        }

        return $ret;
    }

    public function &get_addtion_by_lid($lid)
    {
        $addtion = new \Criteria('lid', $lid, '=');

        return $addtion;
    }

    public function &get_addtion_by_link($link)
    {
        // match https://xxx/*https://yyy/
        $link    = '%' . $link . '%';
        $addtion = new \Criteria('link', $link, 'LIKE');

        return $addtion;
    }

    public function get_count_non_act()
    {
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('act', 0, '='));
        $ret = $this->getCount($criteria);

        return $ret;
    }

    //---------------------------------------------------------
    // get objects
    //---------------------------------------------------------
    public function &get_objects($limit = 0, $start = 0)
    {
        $criteria = new \CriteriaCompo();
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        $objs = &$this->getObjects($criteria);

        return $objs;
    }

    public function &get_objects_by_lid_asc($lid, $limit = 0, $start = 0)
    {
        $objs = &$this->get_objects_by_lid($lid, $limit, $start, 'fid ASC');

        return $objs;
    }

    public function &get_objects_by_lid_desc($lid, $limit = 0, $start = 0)
    {
        $objs = &$this->get_objects_by_lid($lid, $limit, $start, 'fid DESC');

        return $objs;
    }

    public function &get_objects_by_lid($lid, $limit = 0, $start = 0, $sort = 'fid ASC')
    {
        $objs = false;
        if ($lid) {
            $criteria = new \CriteriaCompo();
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $criteria->add($this->get_addtion_by_lid($lid));
            $criteria->setSort($sort);
            $objs = &$this->getObjects($criteria);
        }

        return $objs;
    }

    public function &get_objects_by_lid_non_act_asc($lid, $limit = 0, $start = 0)
    {
        $objs = &$this->get_objects_by_lid_non_act($lid, $limit, $start, 'fid ASC');

        return $objs;
    }

    public function &get_objects_by_lid_non_act_desc($lid, $limit = 0, $start = 0)
    {
        $objs = &$this->get_objects_by_lid_non_act($lid, $limit, $start, 'fid DESC');

        return $objs;
    }

    public function &get_objects_by_lid_non_act($lid, $limit = 0, $start = 0, $sort = 'fid ASC')
    {
        $objs = false;
        if ($lid) {
            $criteria = new \CriteriaCompo();
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $criteria->add(new \Criteria('act', 0, '='));
            $criteria->add($this->get_addtion_by_lid($lid));
            $criteria->setSort($sort);
            $objs = &$this->getObjects($criteria);
        }

        return $objs;
    }

    public function &get_objects_by_link_asc($link, $limit = 0, $start = 0)
    {
        $objs = &$this->get_objects_by_link($link, $limit, $start, 'fid ASC');

        return $objs;
    }

    public function &get_objects_by_link_desc($link, $limit = 0, $start = 0)
    {
        $objs = &$this->get_objects_by_link($link, $limit, $start, 'fid DESC');

        return $objs;
    }

    public function &get_objects_by_link($link, $limit = 0, $start = 0, $sort = 'fid ASC')
    {
        $objs = false;
        if ($link) {
            $criteria = new \CriteriaCompo();
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $criteria->add($this->get_addtion_by_link($link));
            $criteria->setSort($sort);
            $objs = &$this->getObjects($criteria);
        }

        return $objs;
    }

    public function &get_objects_by_link_non_act_asc($link, $limit = 0, $start = 0)
    {
        $objs = &$this->get_objects_by_link_non_act($link, $limit, $start, 'fid ASC');

        return $objs;
    }

    public function &get_objects_by_link_non_act_desc($link, $limit = 0, $start = 0)
    {
        $objs = &$this->get_objects_by_link_non_act($link, $limit, $start, 'fid DESC');

        return $objs;
    }

    public function &get_objects_by_link_non_act($link, $limit = 0, $start = 0, $sort = 'fid ASC')
    {
        $objs = false;
        if ($link) {
            $criteria = new \CriteriaCompo();
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $criteria->add(new \Criteria('act', 0, '='));
            $criteria->add($this->get_addtion_by_link($link));
            $criteria->setSort($sort);
            $objs = &$this->getObjects($criteria);
        }

        return $objs;
    }

    public function &get_objects_non_act_asc($limit = 0, $start = 0)
    {
        $objs = &$this->get_objects_non_act($limit, $start, 'fid ASC');

        return $objs;
    }

    public function &get_objects_non_act_desc($limit = 0, $start = 0)
    {
        $objs = &$this->get_objects_non_act($limit, $start, 'fid DESC');

        return $objs;
    }

    public function &get_objects_non_act($limit = 0, $start = 0, $sort = 'fid ASC')
    {
        $criteria = new \CriteriaCompo();
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        $criteria->add(new \Criteria('act', 0, '='));
        $criteria->setSort($sort);
        $objs = &$this->getObjects($criteria);

        return $objs;
    }

    // --- class end ---
}
// === class end ===

