<?php

use XoopsModules\Rssc\Admin;
use XoopsModules\Happylinux;

// $Id: create_config.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-10-10 K.OHWADA
// _HAPPYLINUX_CONF_CREATE_CONFIG

// 2006-09-20 K.OHWADA
// use rssc_admin_print_bread()

// 2006-07-10 K.OHWADA
// use happy_linux_config_file

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME

//================================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//================================================================

require __DIR__ . '/admin_header.php';
//require_once XOOPS_ROOT_PATH . '/modules/happylinux/class/config_file.php';

$confHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('ConfigBasic', RSSC_DIRNAME);
$config_file = Happylinux\ConfigFile::getInstance();

$DIR_CONFIG  = RSSC_ROOT_PATH . '/cache';
$FILE_CONFIG = $DIR_CONFIG . '/config.php';

xoops_cp_header();
rssc_admin_print_bread(_HAPPYLINUX_CONF_COMMAND_MANAGE, 'command_manage.php', _HAPPYLINUX_CONF_CREATE_CONFIG);
echo '<h3>' . _HAPPYLINUX_CONF_CREATE_CONFIG . "</h3>\n";
echo "Create config file for bin/refresh.php <br><br>\n";

$conf = &$confHandler->get_conf();
$pass = $conf['bin_pass'];
$url  = RSSC_URL . '/bin/refresh.php?pass=' . $pass . '&amp;limit=10';

if (is_writable($DIR_CONFIG)) {
    $config_file->_save_config($FILE_CONFIG);

    echo "<hr>\n";
    echo '<h4>' . _HAPPYLINUX_CREATED . "</h4>\n";
    echo '<a href="' . $url . '">' . _HAPPYLINUX_CONF_TEST_BIN . ": bin/refresh.php</a><br><br>\n";
} else {
    echo '<h3 style="color: #ff0000;">' . _HAPPYLINUX_CONF_NOT_WRITABLE . "</h3>\n";
    echo "$DIR_CONFIG <br><br>\n";
}

xoops_cp_footer();
exit();
