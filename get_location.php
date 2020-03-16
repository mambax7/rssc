<?php
// $Id: get_location.php,v 1.2 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// api_gat_loication.php -> api.php

//=========================================================
// Rss center Module
// 2012-03-01 K.OHWADA
//=========================================================

//---------------------------------------------------------
// xoops system files
//---------------------------------------------------------
require dirname(dirname(__DIR__)) . '/mainfile.php';
require_once XOOPS_ROOT_PATH . '/class/template.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/include/functions.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/strings.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/error.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/basic_handler.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
$RSSC_DIRNAME = $xoopsModule->dirname();
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/include/rssc_constant.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/include/rssc_get_handler.php';

//=========================================================
// class rssc_get_location
//=========================================================
class rssc_get_location
{
    public $_confHandler;
    public $_api_class;

    public $_conf;

    // rssc config
    public $_ELE_ID_PARENT_LATITUDE  = 'webmap_latitude';
    public $_ELE_ID_PARENT_LONGITUDE = 'webmap_longitude';
    public $_ELE_ID_PARENT_ZOOM      = 'webmap_zoom';
    public $_ELE_ID_PARENT_ADDRESS   = 'webmap_address';

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct($dirname)
    {
        $this->_confHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('ConfigBasic', $dirname);
        $this->_conf        = $this->_confHandler->get_conf();
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
    // main
    //---------------------------------------------------------
    public function main()
    {
        $webmap3_dirname = $this->_conf['webmap_dirname'];
        $latitude        = $this->_conf['webmap_latitude'];
        $longitude       = $this->_conf['webmap_longitude'];
        $zoom            = $this->_conf['webmap_zoom'];
        $address         = $this->_conf['webmap_address'];

        require XOOPS_ROOT_PATH . '/modules/' . $webmap3_dirname . '/include/api.php';
        if (!class_exists('webmap3_api_get_location')) {
            echo $this->error();

            return false;
        }

        $api_class = webmap3_api_get_location::getSingleton($webmap3_dirname);

        $api_class->set_latitude($latitude);
        $api_class->set_longitude($longitude);
        $api_class->set_zoom($zoom);
        $api_class->set_address($address);
        $api_class->set_ele_id_parent_latitude($this->_ELE_ID_PARENT_LATITUDE);
        $api_class->set_ele_id_parent_longitude($this->_ELE_ID_PARENT_LONGITUDE);
        $api_class->set_ele_id_parent_zoom($this->_ELE_ID_PARENT_ZOOM);
        $api_class->set_ele_id_parent_address($this->_ELE_ID_PARENT_ADDRESS);
        $api_class->display_get_location();

        return true;
    }

    public function error()
    {
        $text = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>get location</title>
</head>
<body>
<h3>get location</h3>
<h4 style="color: #ff0000;">require WEBMAP3 module</h4>
</body>
</html>
EOF;

        return $text;
    }

    // --- class end ---
}

//=========================================================
// main
//=========================================================
$manage = rssc_get_location::getInstance($RSSC_DIRNAME);
$manage->main();
exit();
