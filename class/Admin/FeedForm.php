<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: feed_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2009-02-20 K.OHWADA
// geo_lat

// 2008-02-24 K.OHWADA
// _URL_SIZE

// 2007-11-01 K.OHWADA
// use php_self
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// main_mod_all()
// rssc_feed_basic_handler.php

// 2006-09-18 K.OHWADA
// show bread crumb
// use _check_url_by_post()

// 2006-07-08 K.OHWADA
// move class FeedManage from admin_manage_class.php
// move class admin_form_feed   from admin_form_class.php
// change make_xxx to build_xxx
// corresponding to podcast
//   add enclosure

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class admin_form_feed
//=========================================================
class FeedForm extends Happylinux\Form
{
    public $_LENGTH_TEXT_SHORT = 500;
    public $_URL_SIZE          = 70;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }

    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    //---------------------------------------------------------
    // show feed
    //---------------------------------------------------------
    public function _show($obj, $extra = null, $mode = 0)
    {
        switch ($mode) {
            case HAPPYLINUX_MODE_MOD:
            case HAPPYLINUX_MODE_MOD_PREVIEW:
                $mode       = HAPPYLINUX_MODE_MOD;
                $form_title = _AM_RSSC_MOD_FEED;
                $op         = 'mod_table';
                $button_val = _HAPPYLINUX_MODIFY;
                break;
            case HAPPYLINUX_MODE_ADD:
            case HAPPYLINUX_MODE_ADD_PREVIEW:
            default:
                $form_title = _AM_RSSC_ADD_FEED;
                $op         = 'add_table';
                $button_val = _ADD;
                break;
        }

        $this->set_obj($obj);

        // form start
        echo $this->build_form_begin('feed_edit');
        echo $this->build_token();
        echo $this->build_html_input_hidden('op', $op);

        if (HAPPYLINUX_MODE_MOD == $mode) {
            echo $this->build_html_input_hidden('fid', $obj->get('fid'));
        }

        echo $this->build_form_table_begin();
        echo $this->build_form_table_title($form_title);

        if (HAPPYLINUX_MODE_MOD == $mode) {
            echo $this->build_form_table_line('feed id', $obj->get('fid'));
        }

        $act_opt = $obj->get_act_option();
        $ele_act = $this->build_html_input_radio_select('act', $obj->get('act'), $act_opt);
        echo $this->build_form_table_line(_RSSC_FEED_ACT, $ele_act);

        echo $this->build_obj_table_text(_RSSC_LINK_ID, 'lid');
        echo $this->build_obj_table_text(_RSSC_USER_ID, 'uid');
        echo $this->build_obj_table_text(_RSSC_MOD_ID, 'mid');
        echo $this->build_obj_table_text('p1', 'p1');
        echo $this->build_obj_table_text('p2', 'p2');
        echo $this->build_obj_table_text('p3', 'p3');

        echo $this->build_obj_table_text(_RSSC_SITE_TITLE, 'site_title');

        $ele_sitelink = $this->build_edit_url_with_visit(
            'site_link',
            $obj->get('site_link'),
            $this->_URL_SIZE
        );
        echo $this->build_form_table_line(_RSSC_SITE_LINK, $ele_sitelink);

        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_TITLE, 'title');

        $ele_link = $this->build_edit_url_with_visit(
            'link',
            $obj->get('link'),
            $this->_URL_SIZE,
            0
        );
        echo $this->build_form_table_line(_HAPPYLINUX_VIEW_LINK, $ele_link);

        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_ATOM_ID, 'entry_id');
        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_RSS_GUID, 'guid');
        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_PUBLISHED, 'published_unix');
        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_UPDATED, 'updated_unix');
        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_CATEGORY, 'category');
        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_AUTHOR_NAME, 'author_name');
        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_AUTHOR_URI, 'author_uri');
        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_AUTHOR_EMAIL, 'author_email');
        echo $this->build_obj_table_text(_RSSC_MODE_CONT, 'mode_cont');

        // enclosure
        $ele_enclosure_url = $this->build_edit_url_with_visit(
            'enclosure_url',
            $obj->get('enclosure_url'),
            $this->_URL_SIZE
        );
        echo $this->build_form_table_line(_HAPPYLINUX_VIEW_ENCLOSURE_URL, $ele_enclosure_url);

        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_ENCLOSURE_TYPE, 'enclosure_type');
        echo $this->build_obj_table_text(_HAPPYLINUX_VIEW_ENCLOSURE_LENGTH, 'enclosure_length');

        // geo
        echo $this->build_obj_table_text(_RSSC_FEED_GEO_LAT, 'geo_lat');
        echo $this->build_obj_table_text(_RSSC_FEED_GEO_LONG, 'geo_long');

        // media
        $ele_media_content_url = $this->build_edit_url_with_visit(
            'media_content_url',
            $obj->get('media_content_url'),
            $this->_URL_SIZE
        );
        echo $this->build_form_table_line(_RSSC_FEED_MEDIA_CONTENT_URL, $ele_media_content_url);

        echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_CONTENT_TYPE, 'media_content_type');
        echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_CONTENT_MEDIUM, 'media_content_medium');
        echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_CONTENT_WIDTH, 'media_content_width');
        echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_CONTENT_HEIGHT, 'media_content_height');

        $ele_media_thumbnail_url = $this->build_edit_url_with_visit(
            'media_thumbnail_url',
            $obj->get('media_thumbnail_url'),
            $this->_URL_SIZE
        );
        echo $this->build_form_table_line(_RSSC_FEED_MEDIA_THUMBNAIL_URL, $ele_media_thumbnail_url);

        echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_THUMBNAIL_WIDTH, 'media_thumbnail_width');
        echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_THUMBNAIL_HEIGHT, 'media_thumbnail_height');

        $val_rows = $obj->get_export_raws();
        $ele_raws = $this->sanitize_format_text_short($val_rows, 's', $this->_LENGTH_TEXT_SHORT);
        echo $this->build_form_table_line(_RSSC_RAWS, $ele_raws);

        $ele_content = $obj->get_var_text_short('content', 's', $this->_LENGTH_TEXT_SHORT);
        echo $this->build_form_table_line(_HAPPYLINUX_VIEW_CONTENT, $ele_content);

        $ele_search = $obj->get_var_text_short('search', 's', $this->_LENGTH_TEXT_SHORT);
        echo $this->build_form_table_line(_RSSC_SEARCH_FIELD, $ele_search);

        $ele_submit = $this->build_html_input_submit('submit', $button_val);
        echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

        if (HAPPYLINUX_MODE_MOD == $mode) {
            $ele_del    = $this->build_html_input_submit('del_table', _DELETE);
            $ele_cancel = $this->build_html_input_button_cancel('cancel', _CANCEL);
            echo $this->build_form_table_line('', $ele_del . '  ' . $ele_cancel, 'foot', 'foot');
        }

        echo $this->build_form_table_end();
        echo $this->build_form_end();
        // --- form end ---
    }

    // --- class end ---
}
