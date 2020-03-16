<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: map_manage.php,v 1.2 2012/04/08 23:42:20 ohwada Exp $

// 2012-034-02 K.OHWADA
// print_check_version()

//=========================================================
// RSS Center Module
// 2012-03-01 K.OHWADA
//=========================================================

//include_once 'admin_header_config.php';
//include_once RSSC_ROOT_PATH . '/class/rssc_block_map.php';
//include_once RSSC_ROOT_PATH . '/class/rssc_map.php';

//=========================================================
// class map manage
//=========================================================

/**
 * Class MapManage
 */
class MapManage
{
    public $_conf_handler;
    public $_config_form;
    public $_config_store;
    public $_map_class;

    public $_conf;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------

    /**
     * MapManage constructor.
     * @param $dirname
     */
    public function __construct($dirname)
    {
        $helper = Rssc\Helper::getInstance();
        $this->_conf_handler = $helper->getHandler('ConfigBasic', $dirname);
        $this->_config_form = ConfigForm::getInstance();
        $this->_config_store = ConfigStore::getInstance();
        $this->_map_class = Rssc\Map::getInstance($dirname);

        $this->_conf = &$this->_conf_handler->get_conf();
    }

    /**
     * @param $dirname
     * @return \MapManage
     */
    public static function getInstance($dirname = null)
    {
        static $instance;
        if (null === $instance) {
            $instance = new static($dirname);
        }

        return $instance;
    }

    /**
     * @return mixed
     */
    public function get_post_get_op()
    {
        return $this->_config_form->get_post_get_op();
    }

    /**
     * @return mixed
     */
    public function check_token()
    {
        return $this->_config_form->check_token();
    }

    public function print_xoops_token_error()
    {
        $this->_config_form->print_xoops_token_error();
    }

    public function save()
    {
        $this->_config_store->save();
    }

    /**
     * @return bool
     */
    public function main()
    {
        rssc_admin_print_header();
        rssc_admin_print_menu();

        echo '<h4>' . _AM_RSSC_MAP_MANAGE . "</h4>\n";
        $this->_config_form->init_form();

        $this->_map_class->print_check_version();
        $ret = $this->_map_class->init_html();
        if ($ret) {
            echo $this->_map_class->build_iframe();
        }

        echo '<h4>' . _AM_RSSC_FORM_MAP . "</h4>\n";
        $this->_config_form->set_form_title(_AM_RSSC_FORM_MAP);
        $this->_config_form->show_by_catid(18);

        rssc_admin_print_footer();

        return true;
    }

    // --- class end ---
}
