<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_import_handler.php,v 1.1 2011/12/29 14:37:15 ohwada Exp $

// 2007-10-10 K.OHWADA
// move from admin_import_base_class.php

// 2006-09-20 K.OHWADA
// use XoopsGTicket
// use build_lib_box_limit_offset() : remove admin_import_form

// 2006-07-10 K.OHWADA
// this is new file
// move from admin_import_class.php

//=========================================================
// RSS Center Module
// 2006-07-10 K.OHWADA
//=========================================================

//=========================================================
// class rssc_importHandler
//=========================================================
class ImportHandler extends Happylinux\Error
{
    public $_LIMIT            = 100;
    public $_FLAG_UPDATE_LINK = true;

    public $_linkHandler;
    public $_blackHandler;
    public $_whiteHandler;
    public $_feed_basicHandler;

    public $_form;
    public $_post;
    public $_system;
    public $_strings;
    public $_rss_parser;

    // local
    public $_exist_lid        = 0;
    public $_lid_list_by_p1   = [];
    public $_lid_list_by_url  = [];
    public $_link_objs_by_lid = [];
    public $_table_rssc_link;
    public $_table_rssc_feed;
    public $_table_rssc_black;
    public $_table_rssc_white;

    public $_dirname_orig;
    public $_mid_orig = 0;

    // post
    public $_op;
    public $_limit;
    public $_offset;
    public $_next;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        parent::__construct();

        $this->_system     = Happylinux\System::getInstance();
        $this->_strings    = Happylinux\Strings::getInstance();
        $this->_form       = Happylinux\FormLib::getInstance();
        $this->_post       = Happylinux\Post::getInstance();
        $this->_rss_parser = Happylinux\RssParser::getInstance();

        $this->_linkHandler       = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Link', $dirname);
        $this->_blackHandler      = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Black', $dirname);
        $this->_whiteHandler      = \XoopsModules\Rssc\Helper::getInstance()->getHandler('White', $dirname);
        $this->_feed_basicHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('FeedBasic', $dirname);
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
    // POST param
    //---------------------------------------------------------
    public function get_post_op()
    {
        $this->_op = $this->_post->get_post_get('op');

        return $this->_op;
    }

    public function get_post_limit()
    {
        $this->_limit = $this->_post->get_post_get_int('limit');

        return $this->_limit;
    }

    public function get_post_offset()
    {
        $this->_offset = $this->_post->get_post_get_int('offset');

        return $this->_offset;
    }

    public function calc_next($total = null)
    {
        $next = $this->_offset + $this->_LIMIT;
        if ($total & ($next > $total)) {
            $next = $total;
        }
        $this->_next = $next;

        return $next;
    }

    //---------------------------------------------------------
    // set param
    //---------------------------------------------------------
    public function set_mid_orig($mid)
    {
        $this->_mid_orig = (int)$mid;
    }

    public function get_mid_orig()
    {
        return $this->_mid_orig;
    }

    public function clear_num()
    {
        $this->_num = 0;
    }

    public function set_lid_list()
    {
        $this->_set_lid_list();
    }

    public function set_mid_orig_by_dirname($dirname)
    {
        $this->_dirname_orig = $dirname;
        $this->_mid_orig     = $this->_system->get_mid_by_dirname($dirname);
    }

    public function exist_module()
    {
        if ($this->_mid_orig) {
            return true;
        }

        return false;
    }

    public function get_msg_not_installed()
    {
        $msg = $this->_dirname_orig . " module is not installed \n";

        return $msg;
    }

    public function set_limit($limit)
    {
        $this->_LIMIT = (int)$limit;
    }

    //---------------------------------------------------------
    // import_site
    //---------------------------------------------------------
    public function import_site_weblinks($site_url)
    {
        $this->_num++;
        echo $this->_num . ': ' . htmlspecialchars($site_url);

        if ($this->_exist_url_in_rssc($site_url)) {
            echo " <b>skip</b> <br>\n";

            return false;
        }

        echo " <br>\n";
        $title = '';
        $link  = '';

        $parse_obj = $this->_rss_parser->parse_by_url($site_url);
        if (is_object($parse_obj)) {
            $title = $parse_obj->get_channel_by_key('title');
            $link  = $parse_obj->get_channel_by_key('link');
        }

        if (empty($title)) {
            $title = 'RSS site ' . $this->_num;
        }

        $url     = $link;
        $rss_url = $site_url;

        $link_obj = $this->_linkHandler->create();
        $link_obj->set('uid', 1);    // admin
        $link_obj->set('mid', $this->_mid_orig);
        $link_obj->set('ltype', RSSC_C_LINK_LTYPE_SERACH);
        $link_obj->set('mode', RSSC_C_MODE_RSS);
        $link_obj->set('refresh', 3600);    // 1 hour
        $link_obj->setVar('title', $title, true);
        $link_obj->setVar('url', $url, true);
        $link_obj->setVar('rss_url', $rss_url, true);
        $this->_linkHandler->insert($link_obj);

        unset($link_obj);

        return true;
    }

    //---------------------------------------------------------
    // import_black
    //---------------------------------------------------------
    public function import_black_weblinks($site_url)
    {
        $this->_num++;
        $title = null;

        $parse_obj = &$this->_rss_parser->discover_and_parse_by_html_url($site_url);
        if (is_object($parse_obj)) {
            $title = $parse_obj->get_channel_by_key('title');
        }

        if (empty($title)) {
            $title = 'Black ' . $this->_num;
        }

        $url = $site_url;

        echo $this->_num . ': ' . htmlspecialchars($url) . " <br>\n";

        $black_obj = $this->_blackHandler->create();

        $black_obj->set('uid', 1);    // admin
        $black_obj->set('mid', $this->_mid_orig);
        $black_obj->setVar('title', $title, true);
        $black_obj->setVar('url', $url, true);

        $this->_blackHandler->insert($black_obj);
        unset($black_obj);

        return true;
    }

    //---------------------------------------------------------
    // import_white
    //---------------------------------------------------------
    public function import_white_weblinks()
    {
        $this->_num++;
        $title = null;

        $parse_obj = &$this->_rss_parser->discover_and_parse_by_html_url($site_url);
        if (is_object($parse_obj)) {
            $title = $parse_obj->get_channel_by_key('title');
        }

        if (empty($title)) {
            $title = 'White ' . $this->_num;
        }

        $url = $site_url;

        echo $this->_num . ': ' . htmlspecialchars($url) . " <br>\n";

        $white_obj = $this->_whiteHandler->create();

        $white_obj->set('uid', 1);    // admin
        $white_obj->set('mid', $this->_mid_orig);
        $white_obj->setVar('title', $title, true);
        $white_obj->setVar('url', $url, true);

        $this->_whiteHandler->insert($white_obj);
        unset($white_obj);

        return true;
    }

    //---------------------------------------------------------
    // import_link
    //---------------------------------------------------------
    public function import_link_weblinks($weblinks_link_obj)
    {
        $weblinks_lid      = $weblinks_link_obj->get('lid');
        $weblinks_rss_flag = $weblinks_link_obj->get('rss_flag');
        $weblinks_rss_url  = $weblinks_link_obj->get('rss_url');

        $rss_url  = '';
        $atom_url = '';

        switch ($weblinks_rss_flag) {
            case 1:
                $mode    = 2;    // rss
                $rss_url = $weblinks_rss_url;
                break;
            case 2:
                $mode     = 3;    // atom
                $atom_url = $weblinks_rss_url;
                break;
            default:
                $mode = 4;    // auto
                break;
        }

        $orig_obj = new Happylinux\BasicObject();
        $orig_obj->set_vars($weblinks_link_obj->getVarAll());
        $orig_obj->set('id', $weblinks_lid);
        $orig_obj->set('p1', $weblinks_lid);    // store lid;
        $orig_obj->set('mid', $this->_mid_orig);
        $orig_obj->set('refresh', 86400);    // 24 hours
        $orig_obj->set('headline', 0);    // non
        $orig_obj->set('encoding', '');    // auto
        $orig_obj->set('mode', $mode);
        $orig_obj->set('rss_url', $rss_url);
        $orig_obj->set('atom_url', $atom_url);
        $orig_obj->set('orig_rss_url', $weblinks_rss_url);

        return $this->import_link_common($orig_obj);
    }

    public function import_link_common($orig_obj)
    {
        $id           = $orig_obj->get('id');
        $p1           = $orig_obj->get('p1');
        $mid          = $orig_obj->get('mid');
        $title        = $orig_obj->get('title');
        $uid          = $orig_obj->get('uid');
        $url          = $orig_obj->get('url');
        $refresh      = $orig_obj->get('refresh');
        $encoding     = $orig_obj->get('encoding');
        $headline     = $orig_obj->get('headline');
        $mode         = $orig_obj->get('mode');
        $rss_url      = $orig_obj->get('rss_url');
        $atom_url     = $orig_obj->get('atom_url');
        $orig_rss_url = $orig_obj->get('orig_rss_url');

        echo $id . ': ' . htmlspecialchars($title);

        // if exist same url
        if ($this->_exist_url($orig_rss_url)) {
            echo " <b>update</b> <br>\n";
            $rssc_lid = $this->_exist_lid;

            // overwrite data in rssc link table
            if ($this->_FLAG_UPDATE_LINK) {
                $link_obj = $this->_linkHandler->get($rssc_lid);
                if (is_object($link_obj)) {
                    $link_obj->set('mid', $mid);
                    $link_obj->set('p1', $p1);

                    $this->_linkHandler->update($link_obj);
                    unset($link_obj);
                }
            }
        } // if not exist same url
        else {
            echo " insert <br>\n";

            $link_obj = $this->_linkHandler->create();
            $link_obj->set('p1', $p1);
            $link_obj->set('uid', $uid);
            $link_obj->set('mid', $mid);
            $link_obj->set('mode', $mode);
            $link_obj->set('refresh', $refresh);
            $link_obj->set('headline', $headline);
            $link_obj->setVar('title', $title, true);
            $link_obj->setVar('url', $url, true);
            $link_obj->setVar('encoding', $encoding, true);
            $link_obj->setVar('rss_url', $rss_url, true);
            $link_obj->setVar('atom_url', $atom_url, true);

            $rssc_lid = $this->_linkHandler->insert($link_obj);
            unset($link_obj);
        }

        return $rssc_lid;
    }

    //---------------------------------------------------------
    // import_feed
    //---------------------------------------------------------
    public function import_feed_weblinks($weblinks_atomfeed_obj)
    {
        $aid   = $weblinks_atomfeed_obj->get('aid');
        $title = $weblinks_atomfeed_obj->get('title');
        $link  = $weblinks_atomfeed_obj->get('url');

        echo $aid . ': ' . htmlspecialchars($title);

        if ($this->_exist_feed($link)) {
            echo " <b>skip</b> <br>\n";

            return false;
        }

        echo " <br>\n";

        $lid            = $this->_get_feed_lid($weblinks_atomfeed_obj);
        $uid            = $this->_get_feed_uid($lid);
        $p1             = $this->_get_feed_p1($lid);
        $site_title     = $weblinks_atomfeed_obj->get('site_title');
        $site_link      = $weblinks_atomfeed_obj->get('site_url');
        $entry_id       = $weblinks_atomfeed_obj->get('entry_id');
        $guid           = $weblinks_atomfeed_obj->get('guid');
        $updated_unix   = $weblinks_atomfeed_obj->get('time_modified');
        $published_unix = $weblinks_atomfeed_obj->get('time_issued');
        $author_name    = $weblinks_atomfeed_obj->get('author_name');
        $author_uri     = $weblinks_atomfeed_obj->get('author_url');
        $author_email   = $weblinks_atomfeed_obj->get('author_email');
        $content        = $weblinks_atomfeed_obj->get('content');

        $feed_obj = $this->_feed_basicHandler->create();

        $feed_obj->set('lid', $lid);
        $feed_obj->set('uid', $uid);
        $feed_obj->set('mid', $this->_mid_orig);
        $feed_obj->set('p1', $p1);
        $feed_obj->set('updated_unix', $updated_unix);
        $feed_obj->set('published_unix', $published_unix);
        $feed_obj->setVar('site_title', $site_title, true);
        $feed_obj->setVar('site_link', $site_link, true);
        $feed_obj->setVar('title', $title, true);
        $feed_obj->setVar('link', $link, true);
        $feed_obj->setVar('entry_id', $entry_id, true);
        $feed_obj->setVar('guid', $guid, true);
        $feed_obj->setVar('author_name', $author_name, true);
        $feed_obj->setVar('author_uri', $author_uri, true);
        $feed_obj->setVar('author_email', $author_email, true);
        $feed_obj->setVar('content', $content, true);
        $feed_obj->set_search();

        $this->_feed_basicHandler->insert($feed_obj);
        unset($feed_obj);

        return true;
    }

    //---------------------------------------------------------
    // utility
    //---------------------------------------------------------
    public function _exist_url($url)
    {
        $this->_exist_lid = 0;
        $list             = &$this->_linkHandler->get_list_by_rssurl($url);
        if (is_array($list) && (count($list) > 0)) {
            $this->_exist_lid = $list[0];

            return true;
        }

        return false;
    }

    public function _set_lid_list()
    {
        $link_objs = &$this->_linkHandler->getObjects();

        $arr1 = [];
        $arr2 = [];
        $arr3 = [];

        foreach ($link_objs as $obj) {
            $lid = $obj->get('lid');
            $url = $obj->get('url');
            $p1  = $obj->get('p1');

            if ($p1) {
                $arr1[$p1] = $lid;
            }

            if ($url) {
                $arr2[$url] = $lid;
            }

            $arr3[$lid] = $obj;
        }

        $this->_lid_list_by_p1   = $arr1;
        $this->_lid_list_by_url  = $arr2;
        $this->_link_objs_by_lid = $arr3;
    }

    public function _get_feed_lid($obj)
    {
        $lid = $obj->get('lid');
        $url = $obj->get('site_url');

        if (isset($this->_lid_list_by_p1[$lid])) {
            $val = $this->_lid_list_by_p1[$lid];
        } elseif (isset($this->_lid_list_by_url[$url])) {
            $val = $this->_lid_list_by_url[$url];
        } else {
            $val = 0;
        }

        return $val;
    }

    public function _get_feed_uid($lid)
    {
        $ret = 0;
        $obj = &$this->_get_link_obj_by_lid($lid);
        if (is_object($obj)) {
            $ret = $obj->get('uid');
        }

        return $ret;
    }

    public function _get_feed_p1($lid)
    {
        $ret = 0;
        $obj = &$this->_get_link_obj_by_lid($lid);
        if (is_object($obj)) {
            $ret = $obj->get('p1');
        }

        return $ret;
    }

    public function &_get_link_obj_by_lid($lid)
    {
        $obj = false;
        if (isset($this->_link_objs_by_lid[$lid])) {
            $obj = $this->_link_objs_by_lid[$lid];
        }

        return $obj;
    }

    public function _exist_feed($link)
    {
        $count = &$this->_feed_basicHandler->get_count_by_link($link);
        if ($count) {
            return true;
        }

        return false;
    }

    //---------------------------------------------------------
    // print
    //---------------------------------------------------------
    public function _print_finish()
    {
        echo "<br><hr>\n";
        echo "<h4>FINISHED</h4>\n";
        echo "<a href='index.php'>GOTO Admin Menu</a><br>\n";
    }

    //---------------------------------------------------------
    // form
    //---------------------------------------------------------
    public function _print_form_next($title, $op, $submit, $offset = 0)
    {
        echo $this->build_form_next($title, $op, $submit, $offset, 'Import');
    }

    public function build_form_next($title, $op, $submit, $offset = 0, $sub = 'Import')
    {
        $text = "<br><hr>\n";
        $text .= '<h4>' . $title . "</h4>\n";

        if ($offset) {
            $next = $offset + $this->_LIMIT;
            $text .= $sub . ' ' . $offset . ' - ' . $next . " th record<br>\n";
        }

        // show form
        $limit  = 0;
        $desc   = '';
        $action = '';
        $text   = $this->_form->build_lib_box_limit_offset($title, $desc, $limit, $offset, $op, $submit, $action);

        return $text;
    }

    public function check_token()
    {
        return $this->_form->check_token();
    }

    // --- class end ---
}
