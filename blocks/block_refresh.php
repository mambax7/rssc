<?php
// $Id: block_refresh.php,v 1.1 2011/12/29 14:37:05 ohwada Exp $

// 2009-02-20 K.OHWADA
// Rssc\Block.php

// 2007-10-10 K.OHWADA
// mode_date

// 2007-06-01 K.OHWADA
// api/refresh.php

// Rssc\XmlBasicHandlerHandler
// rssc_word_basicHandler

// 2006-09-20 K.OHWADA
// small change

// 2006-07-10 K.OHWADA
// use happy_linux module
// support podcast

// 2006-06-04 K.OHWADA
// merge api/block.php

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// --- block function begin ---
if (!function_exists('b_rssc_show_refresh')) {
    $RSSC_DIRNAME = basename(dirname(__DIR__));

    //---------------------------------------------------------
    // rssc
    //---------------------------------------------------------
    require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/api/view.php';
    require_once XOOPS_ROOT_PATH . '/modules/' . $RSSC_DIRNAME . '/api/refresh.php';

    //---------------------------------------------------------
    // show headline after refresh
    // $options
    // [0] module directory name (rssc)
    //---------------------------------------------------------
    function b_rssc_show_refresh($options)
    {
        $DIRNAME = empty($options[0]) ? basename(dirname(__DIR__)) : $options[0];

        //	require_once XOOPS_ROOT_PATH.'/modules/'. $DIRNAME .'/api/view.php';
        require_once XOOPS_ROOT_PATH . '/modules/' . $DIRNAME . '/api/refresh.php';
        require_once XOOPS_ROOT_PATH . '/modules/' . $DIRNAME . '/class/Rssc\Block.php';

        $headlineHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Headline', $DIRNAME);
        $confHandler     = \XoopsModules\Rssc\Helper::getInstance()->getHandler('ConfigBasic', $DIRNAME);
        $conf_data       = &$confHandler->get_conf();

        $link_limit = $conf_data['block_headline_links_perpage'];
        $link_start = 0;

        $headlineHandler->refresh_headline($link_limit, $link_start);

        $block_class = Rssc\Block::getInstance();

        return $block_class->show_headline($DIRNAME);
    }
    // --- block function begin ---
}
