<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_build_rssc.php,v 1.2 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// conf['basic_url']

// 2009-02-20 K.OHWADA
// geo_lat

// 2007-10-10 K.OHWADA
// build()
// _date_rfc822()

// 2006-09-01 K.OHWADA
// use happy_linux_build_rss

// 2006-07-10 K.OHWADA
// use happy_linux_system

// 2006-06-04 K.OHWADA
// suppress notice : Only variable references should be returned by reference

//=========================================================
// Rss Center Module
// class builder RDF/RSS/ATOM
// for rssc module
// 2006-01-01 K.OHWADA
//=========================================================


    //=========================================================
    // class BuildRssc
    //=========================================================
    class BuildRssc extends Happylinux\BuildRss
    {
        public $_DIRNAME;

        public $_configHandler;
        public $_searchHandler;

        public $_CACHE_ID_QUERY  = 'query';
        public $_URL_SINGLE_FEED = '';

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            $this->_DIRNAME = $dirname;

            parent::__construct();
            $this->set_generator('XOOPS rssc');
            $this->set_category('RSS Center');
            $this->set_rdf_title('RSS Center: RDF Feeds');
            $this->set_rss_title('RSS Center: RSS Feeds');
            $this->set_atom_title('RSS Center: ATOM Feeds');
            $this->set_flag_default_timezone(true);

            $DIR_XML = XOOPS_ROOT_PATH . '/modules/' . $dirname . '/templates/xml';

            $this->set_rdf_template($DIR_XML . '/rssc_build_rdf.tpl');
            $this->set_rss_template($DIR_XML . '/rssc_build_rss.tpl');
            $this->set_atom_template($DIR_XML . '/rssc_build_atom.tpl');

            $this->_URL_SINGLE_FEED = XOOPS_URL . '/modules/' . $dirname . '/single_feed.php?fid=';
        }

        public static function getInstance($dirname)
        {
            static $instance;
            if (null === $instance) {
                $instance = new static($dirname);
            }

            return $instance;
        }

        //---------------------------------------------------------
        // public
        //---------------------------------------------------------
        public function build()
        {
            $this->_init();

            // set cache_id, if query
            if ($this->_get_query()) {
                $this->set_cache_id_guest($this->_CACHE_ID_QUERY);
                $this->set_cache_id_user($this->_CACHE_ID_QUERY);
            } // set cache_time
            else {
                $this->set_cache_time_guest($this->_CACHE_TIME_ONE_HOUR);
            }

            $this->set_mode($this->_get_rss_mode());
            $this->build_rss();
        }

        public function view()
        {
            $this->_init();
            $this->set_mode($this->_get_rss_mode());
            $this->view_rss();
        }

        //---------------------------------------------------------
        // private
        //---------------------------------------------------------
        public function _init()
        {
            $this->_configHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('ConfigBasic', $this->_DIRNAME);
            $this->_searchHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Search', $this->_DIRNAME);

            $this->_conf = &$this->_configHandler->get_conf();
        }

        public function _get_query()
        {
            return $this->_searchHandler->get_post_get_query();
        }

        public function &_get_feeds()
        {
            $max_limit = $this->_conf['main_search_perpage'];

            $this->_searchHandler->setFeedLimit($max_limit);
            $this->_searchHandler->setMinKeyword($this->_conf['main_search_min']);
            $this->_searchHandler->setFeedOrder($this->_conf['main_search_order']);
            $this->_searchHandler->setFutureDays($this->_conf['basic_future_days']);
            $this->_searchHandler->setFlagSanitize(0);    // not sanitize

            $limit = $this->_searchHandler->get_get_limit();
            $start = $this->_searchHandler->get_get_start();

            if ($limit <= 0) {
                $limit = $max_limit;
            }

            $feeds = &$this->_searchHandler->get_feeds_for_rss($limit, $start);

            return $feeds;
        }

        public function _get_rss_mode()
        {
            $post = Happylinux\Post::getInstance();
            $mode = $post->get_get_text('mode', 'rss');

            switch ($mode) {
                case 'rdf':
                case 'atom':
                    break;
                case 'rss':
                default:
                    $mode = 'rss';
                    break;
            }

            return $mode;
        }

        //=========================================================
        // override into build_rss
        //=========================================================
        public function &_get_items()
        {
            return $this->_get_feeds();
        }

        //---------------------------------------------------------
        // RDF
        //---------------------------------------------------------
        public function _build_rdf_item($item)
        {
            $ret = $this->_build_common_item($item);

            return $ret;
        }

        //---------------------------------------------------------
        // RSS
        //---------------------------------------------------------
        public function _build_rss_item($item)
        {
            $arr = $this->_build_common_item($item);

            // guid
            if (empty($arr['guid'])) {
                $arr['guid'] = $arr['link'];
            }

            // date
            $arr['pubdate'] = $arr['date_rfc822'];

            return $arr;
        }

        //---------------------------------------------------------
        // ATOM
        //---------------------------------------------------------
        public function _build_atom_entry($entry)
        {
            $arr = $this->_build_common_item($entry);

            // title
            $arr['title'] = $this->_build_xml_title($entry['title'], 0, 0);

            // must content or summary
            if (empty($arr['content']) && empty($arr['summary'])) {
                $arr['summary'] = $arr['title'];
            }

            // must author_name
            if (empty($arr['author_name'])) {
                $arr['author_name']  = $this->_xml($this->_site_author_name);
                $arr['author_uri']   = '';
                $arr['author_email'] = '';
            }

            // atom id
            if ($arr['entry_id']) {
                $arr['id'] = $arr['entry_id'];
            } else {
                $atom_id   = 'tag:' . $this->_site_tag . ',' . $this->_site_year . '://1.1.' . $this->_count_line;
                $arr['id'] = $this->_xml($atom_id);
            }

            // date
            $arr['updated']   = $arr['updated_iso8601'];
            $arr['published'] = $arr['published_iso8601'];

            $this->_count_line++;

            return $arr;
        }

        //---------------------------------------------------------
        // common
        //---------------------------------------------------------
        public function _build_common_item($item)
        {
            // title content
            $title_xml   = $this->_build_xml_title($item['title']);
            $content_xml = $this->_build_xml_content($item['content']);
            $sum_xml     = $this->_build_xml_summary($item['content'], 0, 0);

            $category_xml    = $this->_xml($item['category']);
            $author_name_xml = $this->_xml($item['author_name']);

            $published_unix        = (int)$item['published_unix'];
            $updated_unix          = (int)$item['updated_unix'];
            $published_rfc822_xml  = $this->_xml($this->_date_rfc822($published_unix));
            $updated_rfc822_xml    = $this->_xml($this->_date_rfc822($updated_unix));
            $published_iso8601_xml = $this->_xml($this->_date_iso8601($published_unix));
            $updated_iso8601_xml   = $this->_xml($this->_date_iso8601($updated_unix));

            $item_geo_lat  = $item['geo_lat'];
            $item_geo_long = $item['geo_long'];
            $geo_lat       = '';
            $geo_long      = '';
            $georss_point  = '';

            if ((0 != $item_geo_lat) || (0 != $item_geo_long)) {
                $geo_lat      = $item_geo_lat;
                $geo_long     = $item_geo_long;
                $georss_point = $geo_lat . ' ' . $geo_long;
            }

            if ($this->_conf['basic_url']) {
                $link = $this->_URL_SINGLE_FEED . $item['fid'];
            } else {
                $link = $item['link'];
            }

            $ret = [
                'link'         => $this->_xml_url($link),
                'guid'         => $this->_xml_url($item['guid']),
                'entry_id'     => $this->_xml_url($item['entry_id']),
                'author_uri'   => $this->_xml_url($item['author_uri']),
                'author_email' => $this->_xml($item['author_email']),
                'author_name'  => $author_name_xml,
                'title'        => $title_xml,
                'summary'      => $sum_xml,
                'description'  => $sum_xml,
                'content'      => $content_xml,
                'category'     => $category_xml,

                'published_unix'    => $published_unix,  // unixtime
                'updated_unix'      => $updated_unix,    // unixtime
                'published_rfc822'  => $published_rfc822_xml,
                'date_rfc822'       => $published_rfc822_xml,
                'updated_rfc822'    => $updated_rfc822_xml,
                'published_iso8601' => $published_iso8601_xml,
                'date_iso8601'      => $published_iso8601_xml,
                'updated_iso8601'   => $updated_iso8601_xml,

                'dc_subject'             => $category_xml,
                'dc_creator'             => $author_name_xml,
                'dc_date'                => $published_iso8601_xml,
                'content_encoded'        => $content_xml,

                // geo
                'geo_lat'                => $geo_lat,
                'geo_long'               => $geo_long,
                'georss_point'           => $georss_point,

                // media
                'media_content_url'      => $this->_xml_url($item['media_content_url']),
                'media_content_type'     => $this->_xml($item['media_content_type']),
                'media_content_medium'   => $this->_xml($item['media_content_medium']),
                'media_content_filesize' => $item['media_content_filesize'],
                'media_content_width'    => $item['media_content_width'],
                'media_content_height'   => $item['media_content_height'],
                'media_thumbnail_url'    => $this->_xml_url($item['media_thumbnail_url']),
                'media_thumbnail_width'  => $item['media_thumbnail_width'],
                'media_thumbnail_height' => $item['media_thumbnail_height'],
            ];

            return $ret;
        }

        // --- class end ---
    }

