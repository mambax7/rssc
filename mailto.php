<?php

use XoopsModules\Happylinux;

// $Id: mailto.php,v 1.1 2011/12/29 14:37:04 ohwada Exp $

//================================================================
// RSS Center Module
// 2008-01-20 K.OHWADA
//================================================================

require __DIR__ . '/header.php';

$rssc_plugin        = Rssc\Plugin::getInstance(RSSC_DIRNAME);
$happylinux_system = Happylinux\System::getInstance();

require XOOPS_ROOT_PATH . '/header.php';

// exit if not login
if (!$happylinux_system->is_user()) {
    xoops_error('you have no permission');
    require XOOPS_ROOT_PATH . '/footer.php';
    exit();
}

echo "<h4>plugin demo</h4>\n";
echo "mail latest 10 feeds to login user <br><br>\n";

$rssc_plugin->init_once();
$rssc_plugin->set_flag_print(true);

$mailto  = $happylinux_system->get_email();    // login user
$subject = $happylinux_system->get_sitename();
$subject .= ': latest 10 feeds';
$plugins = 'latest_feeds(10) | summary(100) | implode | ';
$plugins .= 'mail(' . $mailto . ',' . $subject . ') ';
$data    = null;

$ret = $rssc_plugin->execute($data, $plugins);
if ($ret) {
    echo "<h4>mail sended</h4>\n";
} else {
    echo "<h4>error</h4>\n";
}

require XOOPS_ROOT_PATH . '/footer.php';
exit();
