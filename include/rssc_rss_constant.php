<?php
// $Id: rssc_rss_constant.php,v 1.1 2011/12/29 14:37:05 ohwada Exp $

// 2007-06-01 K.OHWADA
// this file is interface to happy_linux/rss_constant.php
// move from rssc_constant.php

//=========================================================
// Rss Center Module
// 2007-06-01 K.OHWADA
//=========================================================

// --- define constant begin ---
if (!defined('RSSC_RSS_CONSTANT_LOADED')) {
    define('RSSC_RSS_CONSTANT_LOADED', 1);

    define('RSSC_C_SEL_RSS', HAPPYLINUX_RSS_SEL_RSS);
    define('RSSC_C_SEL_RDF', HAPPYLINUX_RSS_SEL_RDF);
    define('RSSC_C_SEL_ATOM', HAPPYLINUX_RSS_SEL_ATOM);
    define('RSSC_C_SEL_OTHER', HAPPYLINUX_RSS_SEL_OTHER);
    define('RSSC_C_MODE_NON', HAPPYLINUX_RSS_MODE_NON);
    define('RSSC_C_MODE_RDF', HAPPYLINUX_RSS_MODE_RDF);
    define('RSSC_C_MODE_RSS', HAPPYLINUX_RSS_MODE_RSS);
    define('RSSC_C_MODE_ATOM', HAPPYLINUX_RSS_MODE_ATOM);
    define('RSSC_C_MODE_AUTO', HAPPYLINUX_RSS_MODE_AUTO);
}
// --- define constant end ---
