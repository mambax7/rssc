<?php

// $Id: rssc_icon.php.\040CDS\040Patch.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

//=========================================================
// Rss Center Module
// 2009-02-20 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('rssc_icon')) {
    //=========================================================
    // class rssc_icon
    //=========================================================

    /**
     * Class rssc_icon
     */
    class rssc_icon
    {
        public $_db;

        public $_ICON_COLS = 5;
        public $_ICON_DEFAULT = 'default.gif';

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            $this->_db = XoopsDatabaseFactory::getDatabaseConnection();
        }

        /**
         * @return static
         */
        public static function getInstance()
        {
            static $instance;
            if (null === $instance) {
                $instance = new static();
            }

            return $instance;
        }

        // --------------------------------------------------------
        // build icon list
        // --------------------------------------------------------

        /**
         * @param $dirname
         * @return mixed
         */
        public function build_template_icon_list($dirname)
        {
            $MODULE_DIR = XOOPS_ROOT_PATH . '/modules/' . $dirname;
            /* CDS Patch. RSS Center. 1.02. 3. BOF */ global $xoopsConfig;
            $dir_theme = XOOPS_THEME_PATH . '/' . $xoopsConfig['theme_set'] . '/modules/' . $dirname . '/parts';
            if (file_exists($dir_theme . '/rssc_icon_list.tpl')) {
                $template = $dir_theme . '/rssc_icon_list.tpl';
            } else {
                $template = $MODULE_DIR . '/templates/parts/rssc_icon_list.tpl';
            }
            /* CDS Patch. RSS Center. 1.02. 3. EOF */

            // build template
            $tpl = new XoopsTpl();
            $tpl->assign('xoops_url', XOOPS_URL);
            $tpl->assign('dirname', $dirname);
            $tpl->assign('icon_cols', $this->_ICON_COLS);
            $tpl->assign('icon_list', $this->build_icon_list($dirname));
            $ret = $tpl->fetch($template);

            return $ret;
        }

        /**
         * @param $dirname
         * @return array|bool
         */
        public function build_icon_list($dirname)
        {
            $conf = $this->get_config_row($dirname);
            if (!is_array($conf)) {
                return false;
            }

            $rows = $this->get_link_rows($dirname);
            if (!is_array($rows)) {
                return false;
            }

            $arr = [];
            foreach ($rows as $row) {
                if (empty($row['icon'])) {
                    continue;
                }

                $tmp['title'] = $this->sanitize($row['title']);
                $tmp['lid'] = $this->sanitize($row['lid']);
                $tmp['icon'] = $this->sanitize($row['icon']);
                $arr[] = $tmp;
            }

            /* CDS Patch. RSS Center. 1.02. 4. BOF */ //	$tmp['title'] = $this->sanitize( _BL_RSSC_LINK_ETC );
            //	$tmp['icon']  = $this->sanitize( $this->_ICON_DEFAULT );
            //	$arr[] = $tmp ;
            /* CDS Patch. RSS Center. 1.02. 4. EOF */

            return $arr;
        }

        /**
         * @param $dirname
         * @return array|bool
         */
        public function get_config_row($dirname)
        {
            $arr = [];

            $table_config = $this->_db->prefix($dirname . '_config');
            $sql = 'SELECT * FROM ' . $table_config . ' ORDER BY conf_id ASC';

            $res = $this->_db->query($sql, 0, 0);
            if (!$res) {
                return false;
            }

            while ($row = $this->_db->fetchArray($res)) {
                $arr[$row['conf_name']] = $row['conf_value'];
            }

            return $arr;
        }

        /**
         * @param $dirname
         * @return array|bool
         */
        public function get_link_rows($dirname)
        {
            $rows = [];

            $table_link = $this->_db->prefix($dirname . '_link');
            $sql = 'SELECT * FROM ' . $table_link . ' WHERE ltype<>0 ORDER BY lid ASC';

            $res = $this->_db->query($sql);
            if (!$res) {
                return false;
            }

            while ($row = $this->_db->fetchArray($res)) {
                $rows[] = $row;
            }

            return $rows;
        }

        /**
         * @param $str
         * @return string
         */
        public function sanitize($str)
        {
            return htmlspecialchars($str, ENT_QUOTES);
        }

        // --- class end ---
    }
    // === class end ===
}
