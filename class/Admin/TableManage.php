<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: table_manage.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-11-24 K.OHWADA
// happy_linux_table_manage()

// 2007-11-01 K.OHWADA
// xoops block table check
// rssc_admin_print_footer()

// 2006-09-20 K.OHWADA
// this is new file

//================================================================
// RSS Center Module
// 2006-09-10 K.OHWADA
//================================================================

//================================================================
// class TableManage
//================================================================
class TableManage extends Happylinux\TableManage
{
    public $_linkHandler;

    public $_TITLE_LINK_CHECK = 'check link table';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct(RSSC_DIRNAME);

        $helper = \XoopsModules\Rssc\Helper::getInstance();
        $this->set_config_handler('Config', RSSC_DIRNAME, 'rssc', $helper);
        $this->set_config_define(Rssc\ConfigDefine::getInstance());
        $this->set_install_class(Rssc\Install::getInstance(RSSC_DIRNAME));
        $this->set_xoops_block_checker();

        $this->_linkHandler = $helper->getHandler('Link', RSSC_DIRNAME);
    }

    public static function getInstance($dirname = null)
    {
        static $instance;
        if (null === $instance) {
            $instance = new static($dirname);
        }

        return $instance;
    }

    //---------------------------------------------------------
    // check
    //---------------------------------------------------------
    public function menu()
    {
        rssc_admin_print_header();
        rssc_admin_print_menu();

        $this->print_title();

        // rssc table
        $this->print_table_check('config');
        $this->check_config_table();
        $this->_check_table_for_rssc('link');
        $this->_check_table_for_rssc('xml');
        $this->_check_table_for_rssc('feed');
        $this->_check_table_for_rssc('black');
        $this->_check_table_for_rssc('white');
        $this->_check_table_for_rssc('word');

        // xoops block table
        $this->check_xoops_block_table();
        $this->print_form_remove_xoops_block_table();

        // check link table
        echo '<h4>' . $this->_TITLE_LINK_CHECK . "</h4>\n";
        echo "check to overlap same RDF/RSS/ATOM url<br>\n";
        echo 'There are <b>' . $this->_linkHandler->getCount() . "</b> links <br>\n";

        $this->_print_form_link_start();
    }

    public function _check_table_for_rssc($table)
    {
        $helper = \XoopsModules\Rssc\Helper::getInstance();
        $this->print_table_check($table);
        $this->check_table_scheme_by_name($table, RSSC_DIRNAME, 'rssc', $helper);
    }

    //---------------------------------------------------------
    // action
    //---------------------------------------------------------
    public function check_link()
    {
        $total = $this->_linkHandler->getCount();

        $this->print_bread($this->_TITLE_LINK_CHECK);
        echo '<h4>' . $this->_TITLE_LINK_CHECK . "</h4>\n";
        echo 'There are <b>' . $total . "</b> links <br>\n";

        $max    = $this->get_max_record();
        $offset = $this->get_post_offset();
        $start  = $offset + 1;
        $end    = $this->calc_end($start, $total);

        echo 'check ' . $start . ' - ' . $end . " th record <br><br>\n";

        $count_more = 0;

        $objs = &$this->_linkHandler->get_objects_asc($max, $offset);
        foreach ($objs as $obj) {
            $this->_linkHandler->set_cache_by_obj($obj);
            $lid_1    = $obj->get('lid');
            $title_1  = $obj->get('title');
            $rdf_url  = $obj->get('rdf_url');
            $rss_url  = $obj->get('rss_url');
            $atom_url = $obj->get('atom_url');

            $lid_arr = &$this->_linkHandler->get_list_by_rssurl($rdf_url, $rss_url, $atom_url, $lid_1);
            if (is_array($lid_arr) && count($lid_arr)) {
                echo $this->_build_link_manage($lid_1, $title_1);
                echo " : <b>same links</b> <br>\n";
                $count_more++;

                foreach ($lid_arr as $lid_2) {
                    $obj_2 = &$this->_linkHandler->getCache($lid_2);
                    if (is_object($obj_2)) {
                        $title_2 = $obj_2->get('title');
                        echo ' --- ';
                        echo $this->_build_link_manage($lid_2, $title_2);
                        echo "<br>\n";
                    }
                }
            }
        }

        echo "<br>\n";

        if ($count_more) {
            echo 'There are ';
            echo $this->build_span_red_bold($count_more);
            echo " links which have same links <br>\n";
        } else {
            $this->print_blue('check OK');
        }

        if ($total > $end) {
            $this->_print_form_link_next($end, $total);
        } else {
            $this->print_finish();
        }
    }

    public function _build_link_manage($lid, $title)
    {
        $url   = 'link_manage.php?op=mod_form&amp;lid=' . $lid;
        $lid_s = sprintf('%03d', $lid);
        $text  = '<a href="' . $url . '" target="_blank">' . $lid_s . '</a>';
        $text  .= ' : ' . $this->sanitize_text($title);

        return $text;
    }

    //---------------------------------------------------------
    // print
    //---------------------------------------------------------
    public function _print_form_link_start()
    {
        $this->_print_form_link_common(_HAPPYLINUX_EXECUTE);
    }

    public function _print_form_link_next($end_prev, $total)
    {
        $start  = $end_prev + 1;
        $end    = $this->calc_end($start, $total);
        $step   = $end - $start + 1;
        $submit = 'GO next ' . $step . ' links';
        $desc   = 'check ' . $start . ' - ' . $end . ' th record';
        $next   = $end - 1;

        $this->_print_form_link_common($submit, $desc, $next);
    }

    public function _print_form_link_common($submit, $desc = null, $offset = 0)
    {
        echo "<br>\n";
        echo $this->_form->build_lib_box_limit_offset(
            $this->_TITLE_LINK_CHECK,
            $desc,
            0,
            $offset,
            'check_link',
            $submit
        );
    }

    // --- class end ---
}
