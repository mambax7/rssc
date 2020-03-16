<?php
// $Id: modinfo.php,v 1.1 2011/12/29 14:37:09 ohwada Exp $

// 2006-09-20 K.OHWADA
// show blog

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// --- define language begin ---
if (!defined('RSSC_LANG_MI_LOADED')) {
    define('RSSC_LANG_MI_LOADED', 1);

    // The name of this module
    define('_MI_RSSC_NAME', 'RSS Center');
    define('_MI_RSSC_DESC', 'This module collects RDF/RSS/ATOM feeds, saves them in the database, and searchs them.');

    // Names of sub menu
    define('_MI_RSSC_SMNAME_HEADLINE', 'Simple Headline');

    // Names of blocks
    define('_MI_RSSC_BNAME_LATEST', 'Latest RDF/RSS/ATOM feeds');
    define('_MI_RSSC_BNAME_HEADLINE', 'Simple Headline');
    define('_MI_RSSC_BNAME_REFRESH', 'Simple Headline (update)');

    // 2006-09-20
    define('_MI_RSSC_BNAME_BLOG', 'RSSC Blog');

    // Names of admin menu
    define('_MI_RSSC_ADMENU_CONFIG', 'Module Configration');
    define('_MI_RSSC_ADMENU_LINKLIST', 'Link List');

    // === 2009-02-20 ===
    define('_MI_RSSC_BNAME_MAP', 'RSS GoogleMap');

    //Menu
    define('_MI_RSSC_MENU_HOME', 'Home');
    define('_MI_RSSC_MENU_01', 'Admin');
    define('_MI_RSSC_MENU_ABOUT', 'About');


    //Config
    define('MI_RSSC_EDITOR_ADMIN', 'Editor: Admin');
    define('MI_RSSC_EDITOR_ADMIN_DESC', 'Select the Editor to use by the Admin');
    define('MI_RSSC_EDITOR_USER', 'Editor: User');
    define('MI_RSSC_EDITOR_USER_DESC', 'Select the Editor to use by the User');

    //Help
    define('_MI_RSSC_DIRNAME', basename(dirname(dirname(__DIR__))));
    define('_MI_RSSC_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
    define('_MI_RSSC_BACK_2_ADMIN', 'Back to Administration of ');
    define('_MI_RSSC_OVERVIEW', 'Overview');

    //define('_MI_RSSC_HELP_DIR', __DIR__);

    //help multi-page
    define('_MI_RSSC_DISCLAIMER', 'Disclaimer');
    define('_MI_RSSC_LICENSE', 'License');
    define('_MI_RSSC_SUPPORT', 'Support');
}
// --- define language end ---
