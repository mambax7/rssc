<?php

// $Id: xoops_version.php,v 1.1 2011/12/29 14:37:04 ohwada Exp $

// 2009-02-20 K.OHWADA
// b_rssc_show_gmap

// 2007-11-11 K.OHWADA
// onInstall, onUpdate

// 2007-06-01 K.OHWADA
// table xml word

// 2006-09-20 K.OHWADA
// show blog

// 2006-06-04 K.OHWADA
// add template single_link.html

// 2006-01-20 K.OHWADA
// $name_ext

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

$RSSC_DIRNAME = basename(__DIR__);
$RSSC_MODULE_ROOT = XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME;
$RSSC_MODULE_URL = XOOPS_URL . '/modules/' . $RSSC_DIRNAME;

if (!preg_match('/^(\D+)(\d*)$/', $RSSC_DIRNAME, $regs)) {
    echo('invalid dirname: ' . htmlspecialchars($RSSC_DIRNAME, ENT_QUOTES | ENT_HTML5));
}
$RSSC_NUMBER = '' === $regs[2] ? '' : (int)$regs[2];

include_once $RSSC_MODULE_ROOT . '/include/rssc_version.php';

if ('rssc' == $regs[1]) {
    $name_ext = ' ' . $RSSC_NUMBER;
} else {
    $name_ext = ':' . $RSSC_DIRNAME;
}

$modversion['name'] = _MI_RSSC_NAME . $name_ext;
$modversion['description'] = _MI_RSSC_DESC;
$modversion['version'] = RSSC_VERSION;
$modversion['author'] = 'Kenichi OHWADA<br>( http://linux2.ohwada.net/ )';
$modversion['credits'] = '';
$modversion['help'] = '';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'images/' . $RSSC_DIRNAME . '_slogo.png';
$modversion['dirname'] = $RSSC_DIRNAME;

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = 'sql/' . $RSSC_DIRNAME . '.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = $RSSC_DIRNAME . '_config';
$modversion['tables'][1] = $RSSC_DIRNAME . '_link';
$modversion['tables'][2] = $RSSC_DIRNAME . '_feed';
$modversion['tables'][3] = $RSSC_DIRNAME . '_black';
$modversion['tables'][4] = $RSSC_DIRNAME . '_white';
$modversion['tables'][5] = $RSSC_DIRNAME . '_xml';
$modversion['tables'][6] = $RSSC_DIRNAME . '_word';

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Menu
$modversion['hasMain'] = 1;
$modversion['sub'][1]['name'] = _MI_RSSC_SMNAME_HEADLINE;
$modversion['sub'][1]['url'] = 'headline.php';

//  Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = $RSSC_DIRNAME . '_search';

// Blocks
$modversion['blocks'][1]['file'] = 'block_latest.php';
$modversion['blocks'][1]['name'] = _MI_RSSC_BNAME_LATEST . $name_ext;
$modversion['blocks'][1]['description'] = 'Shows latest feeds';
$modversion['blocks'][1]['show_func'] = 'b_rssc_show_latest';
$modversion['blocks'][1]['edit_func'] = '';
$modversion['blocks'][1]['options'] = $RSSC_DIRNAME;
$modversion['blocks'][1]['template'] = $RSSC_DIRNAME . '_block_latest.tpl';

$modversion['blocks'][2]['file'] = 'block_latest.php';
$modversion['blocks'][2]['name'] = _MI_RSSC_BNAME_HEADLINE . $name_ext;
$modversion['blocks'][2]['description'] = 'Shows headline';
$modversion['blocks'][2]['show_func'] = 'b_rssc_show_headline';
$modversion['blocks'][2]['edit_func'] = '';
$modversion['blocks'][2]['options'] = $RSSC_DIRNAME;
$modversion['blocks'][2]['template'] = $RSSC_DIRNAME . '_block_headline.tpl';

$modversion['blocks'][3]['file'] = 'block_refresh.php';
$modversion['blocks'][3]['name'] = _MI_RSSC_BNAME_REFRESH . $name_ext;
$modversion['blocks'][3]['description'] = 'Shows headline after refresh';
$modversion['blocks'][3]['show_func'] = 'b_rssc_show_refresh';
$modversion['blocks'][3]['edit_func'] = '';
$modversion['blocks'][3]['options'] = $RSSC_DIRNAME;
$modversion['blocks'][3]['template'] = $RSSC_DIRNAME . '_block_refresh.tpl';

$modversion['blocks'][4]['file'] = 'block_latest.php';
$modversion['blocks'][4]['name'] = _MI_RSSC_BNAME_BLOG . $name_ext;
$modversion['blocks'][4]['description'] = 'Shows blog';
$modversion['blocks'][4]['show_func'] = 'b_rssc_show_blog';
$modversion['blocks'][4]['edit_func'] = '';
$modversion['blocks'][4]['options'] = $RSSC_DIRNAME;
$modversion['blocks'][4]['template'] = $RSSC_DIRNAME . '_block_blog.tpl';

$modversion['blocks'][5]['file'] = 'block_latest.php';
$modversion['blocks'][5]['name'] = _MI_RSSC_BNAME_MAP . $name_ext;
$modversion['blocks'][5]['description'] = 'Shows google map';
$modversion['blocks'][5]['show_func'] = 'b_rssc_show_map';
$modversion['blocks'][5]['edit_func'] = '';
$modversion['blocks'][5]['options'] = $RSSC_DIRNAME;
$modversion['blocks'][5]['template'] = $RSSC_DIRNAME . '_block_map.tpl';

// Templates
$modversion['templates'][1]['file'] = $RSSC_DIRNAME . '_index.tpl';
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2]['file'] = $RSSC_DIRNAME . '_headline.tpl';
$modversion['templates'][2]['description'] = '';
$modversion['templates'][3]['file'] = $RSSC_DIRNAME . '_single_feed.tpl';
$modversion['templates'][3]['description'] = '';
$modversion['templates'][4]['file'] = $RSSC_DIRNAME . '_single_link.tpl';
$modversion['templates'][4]['description'] = '';
$modversion['templates'][5]['file'] = $RSSC_DIRNAME . '_single_link_utf8.tpl';
$modversion['templates'][5]['description'] = '';
$modversion['templates'][6]['file'] = $RSSC_DIRNAME . '_map.tpl';
$modversion['templates'][6]['description'] = '';

// onInstall, onUpdate, onUninstall
$modversion['onInstall'] = 'oninstall.php';
$modversion['onUpdate'] = 'oninstall.php';
