<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_error.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2006-07-10 K.OHWADA
// use happy_linux_error

//=========================================================
// Rss Center Module
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class Error
//=========================================================
class Error extends Happylinux\Error
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }

    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    // --- class end ---
}
// === class end ===

