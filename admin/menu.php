<?php
// $Id: menu.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2006-01-20 K.OHWADA
// small changes

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

//$adminmenu[0]['title'] = _MI_RSSC_ADMENU_CONFIG;
//$adminmenu[0]['link']  = 'admin/index.php';
//$adminmenu[1]['title'] = _MI_RSSC_ADMENU_LINKLIST;
//$adminmenu[1]['link']  = 'admin/link_list.php';


include dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

/** @var \XoopsModules\Rssc\Helper $helper */
$helper = \XoopsModules\Rssc\Helper::getInstance();
$helper->loadLanguage('common');
$helper->loadLanguage('feedback');

$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
if (is_object($helper->getModule())) {
    //    $pathModIcon32 = $helper->getModule()->getInfo('modicons32');
    $pathModIcon32 = $helper->url($helper->getModule()->getInfo('modicons32'));
}

$adminmenu[] = [
    'title' => _MI_RSSC_MENU_HOME,
    'link' => 'admin/index.php',
    'icon' => $pathIcon32 . '/home.png',
];

$adminmenu[] = [
    'title' => _MI_RSSC_ADMENU_CONFIG,
    'link' => 'admin/main.php',
    'icon' => $pathIcon32 . '/manage.png',
];


$adminmenu[] = [
    'title' => _MI_RSSC_ADMENU_LINKLIST,
    'link' => 'admin/link_list.php',
    'icon' => $pathIcon32 . '/manage.png',
];


// Blocks Admin
$adminmenu[] = [
    'title' => constant('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS'),
    'link' => 'admin/blocksadmin.php',
    'icon' => $pathIcon32 . '/block.png',
];

//Feedback
$adminmenu[] = [
    'title' => constant('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_FEEDBACK'),
    'link'  => 'admin/feedback.php',
    'icon'  => $pathIcon32 . '/mail_foward.png',
];

if ($helper->getConfig('displayDeveloperTools')) {
    $adminmenu[] = [
        'title' => constant('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_MIGRATE'),
        'link' => 'admin/migrate.php',
        'icon' => $pathIcon32 . '/database_go.png',
    ];
}

$adminmenu[] = [
    'title' => _MI_RSSC_MENU_ABOUT,
    'link' => 'admin/about.php',
    'icon' => $pathIcon32 . '/about.png',
];
