<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_feed_basic_handler.php,v 1.1 2011/12/29 14:37:15 ohwada Exp $

// 2009-02-20 K.OHWADA
// geo_lat

// 2008-02-24 K.OHWADA
// long url

// 2008-01-20 K.OHWADA
// change refresh()

// 2007-10-10 K.OHWADA
// change refresh()

// 2007-06-01 K.OHWADA
// add act field
// add get_count_public_xxx()
// BUG: all clear when total = num

// 2006-09-20 K.OHWADA
// add _DEBUG_INSERT_EXEC
// add get_clear_num()

// 2006-07-10 K.OHWADA
// use happy_linux_basic happy_linux_basic_handler
// corresponding to podcast
// add enclosure

// 2006-06-04 K.OHWADA
// this is new file
// move from feedHandler

//=========================================================
// Rss Center Module
// 2006-06-04 K.OHWADA
//=========================================================


    //=========================================================
    // class FeedBasic
    //=========================================================
    class FeedBasic extends Happylinux\BasicObject
    {
        // constant
        public $_FLAG_SUBSUTUTE_DATE = true;

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
                'lid'              => 0,
                'uid'              => 0,
                'mid'              => 0,
                'p1'               => 0,
                'p2'               => 0,
                'p3'               => 0,
                'site_title'       => '',
                'site_link'        => '',
                'title'            => '',
                'link'             => '',
                'entry_id'         => '',
                'guid'             => '',
                'updated_unix'     => 0,
                'published_unix'   => 0,
                'category'         => '',
                'author_name'      => '',
                'author_uri'       => '',
                'author_email'     => '',
                'type_cont'        => '',
                'raws'             => '',
                'content'          => '',
                'search'           => '',
                'aux_int_1'        => 0,
                'aux_int_2'        => 0,
                'aux_text_1'       => '',
                'aux_text_2'       => '',

                // enclosure
                'enclosure_url'    => '',
                'enclosure_type'   => '',
                'enclosure_length' => 0,

                'act'                    => 1,    // active

                // geo
                'geo_lat'                => 0,
                'geo_long'               => 0,

                // media
                'media_content_url'      => '',
                'media_content_type'     => '',
                'media_content_medium'   => '',
                'media_content_filesize' => 0,
                'media_content_width'    => 0,
                'media_content_height'   => 0,
                'media_thumbnail_url'    => '',
                'media_thumbnail_width'  => 0,
                'media_thumbnail_height' => 0,
            ];
        }

        //---------------------------------------------------------
        // element
        //---------------------------------------------------------
        public function set_search()
        {
            $search = $this->get('title') . ' ' . $this->get('content');
            $search = $this->strip_control($search);
            $search = $this->strip_style_tag($search);
            $search = $this->add_space_after_tag($search);
            $search = strip_tags($search);

            $this->set('search', $search);
        }

        public function set_raws($item)
        {
            // atom
            if (isset($item['atom_content'])) {
                $item['atom_content'] = '';
            }

            // rss
            if (isset($item['content'])) {
                $item['content'] = '';
            }

            $this->getVarArray('raws', $item);
        }

        public function &get_raws()
        {
            $ret = &$this->getVarArray('raws');

            return $ret;
        }

        //---------------------------------------------------------
        // subsutute date
        // some feed have no date
        // subsutute by present time
        //---------------------------------------------------------
        public function subsutute_date()
        {
            // no action, if not flag
            if (!$this->_FLAG_SUBSUTUTE_DATE) {
                return;
            }

            $time = time();

            if (0 == $this->get('updated_unix')) {
                $this->set('updated_unix', $time);
            }

            if (0 == $this->get('published_unix')) {
                $this->set('published_unix', $time);
            }
        }

        // --- class end ---
    }
