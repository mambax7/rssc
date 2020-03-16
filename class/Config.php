<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: rssc_config_handler.php,v 1.1 2011/12/29 14:37:17 ohwada Exp $

// 2006-09-01 K.OHWADA
// add check_version_040() add_column_table_040()

// 2006-07-08 K.OHWADA
// this file is renewal
// unify with weblinks
// use happy_linux_config_base happy_linux_config_base_handler

//================================================================
// RSS Center Module
// this file contain 2 class
//   Config
//   ConfigHandler
// porting form RSSC
// 2006-07-08 K.OHWADA
//================================================================

    //================================================================
    // class Config
    //================================================================
    class Config extends Happylinux\ConfigBase
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            parent::__construct();
        }

        // --- class end ---
    }
