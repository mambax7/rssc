<?php

namespace XoopsModules\Rssc;

use XoopsModules\Happylinux;

// $Id: Word.php,v 1.1 2011/12/29 14:37:16 ohwada Exp $

// 2007-11-24 K.OHWADA
// move create_table() to rssc_install.php

//=========================================================
// Rss Center Module
// this file contain 2 class
//   Word
//   WordHandler
// 2007-06-01 K.OHWADA
//=========================================================

    //=========================================================
    // class word
    //=========================================================
    class Word extends Happylinux\BaseObject
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            parent::__construct();

            $this->initVar('sid', XOBJ_DTYPE_INT, null, false);
            $this->initVar('word', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('reg', XOBJ_DTYPE_INT, 0);
            $this->initVar('point', XOBJ_DTYPE_INT, 0);
            $this->initVar('count', XOBJ_DTYPE_INT, 0);
            $this->initVar('aux_int_1', XOBJ_DTYPE_INT, 0);
            $this->initVar('aux_int_2', XOBJ_DTYPE_INT, 0);
            $this->initVar('aux_text_1', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('aux_text_2', XOBJ_DTYPE_TXTBOX, null, false, 255);
        }

        // --- class end ---
    }
