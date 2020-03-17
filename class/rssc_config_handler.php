<?php

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
//   rssc_config
//   rssc_config_handler
// porting form RSSC
// 2006-07-08 K.OHWADA
//================================================================

// === class begin ===
if (!class_exists('rssc_config_handler')) {
    //================================================================
    // class rssc_config
    //================================================================

    /**
     * Class rssc_config
     */
    class rssc_config extends happy_linux_config_base
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

    //=========================================================
    // class config handler
    //=========================================================

    /**
     * Class rssc_config_handler
     */
    class rssc_config_handler extends happy_linux_config_base_handler
    {
        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------

        /**
         * rssc_config_handler constructor.
         * @param $dirname
         */
        public function __construct($dirname)
        {
            parent::__construct($dirname, 'config', 'conf_id', 'rssc_config');

            $this->set_debug_db_sql(RSSC_DEBUG_CONFIG_SQL);
            $this->set_debug_db_error(RSSC_DEBUG_ERROR);
        }

        //=========================================================
        // add_column_table
        //=========================================================

        /**
         * @return bool
         */
        public function check_version_040()
        {
            $ret = $this->existsFieldName('conf_valuetype');

            return $ret;
        }

        /**
         * @return bool
         */
        public function add_column_table_040()
        {
            $sql = '
  ALTER TABLE ' . $this->_table . " ADD COLUMN (
  conf_valuetype varchar(255) NOT NULL default ''
)";

            $ret = $this->query($sql);

            return $ret;
        }

        // --- class end ---
    }
    // === class end ===
}
