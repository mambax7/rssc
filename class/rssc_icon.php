<?php
// $Id: rssc_icon.php,v 1.2 2012/03/31 04:42:39 ohwada Exp $

// 2012-03-31 K.OHWADA
// BUG: display accidentally, when NOT set icon

//=========================================================
// Rss Center Module
// 2009-02-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_icon') ) 
{

//=========================================================
// class rssc_icon
//=========================================================
    class rssc_icon
    {
        public $_db;

        public $_ICON_COLS    = 5;
        public $_ICON_DEFAULT = 'default.gif';

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
    public function __construct()
        {
            $this->_db =& Database::getInstance();
        }

        public static function &getInstance()
        {
            static $instance;
            if (!isset($instance)) {
                $instance = new rssc_icon();
            }
            return $instance;
        }

        // --------------------------------------------------------
        // build icon list
        // --------------------------------------------------------
    public function build_template_icon_list($dirname)
        {
            $MODULE_DIR = XOOPS_ROOT_PATH . '/modules/' . $dirname;
            $template   = $MODULE_DIR . '/templates/parts/rssc_icon_list.html';

            // build template
            $tpl = new XoopsTpl();
            $tpl->assign('xoops_url', XOOPS_URL);
            $tpl->assign('dirname', $dirname);
            $tpl->assign('icon_cols', $this->_ICON_COLS);
            $tpl->assign('icon_list', $this->build_icon_list($dirname));
            $ret = $tpl->fetch($template);
            return $ret;
        }

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
                // BUG: display accidentally, when NOT set icon
                if (($row['icon'] == '') || ($row['icon'] == '---')) {
                    continue;
                }

                $tmp['title'] = $this->sanitize($row['title']);
                $tmp['lid']   = $this->sanitize($row['lid']);
                $tmp['icon']  = $this->sanitize($row['icon']);
                $arr[]        = $tmp;
            }

            $tmp['title'] = $this->sanitize(_BL_RSSC_LINK_ETC);
            $tmp['icon']  = $this->sanitize($this->_ICON_DEFAULT);
            $arr[]        = $tmp;

            return $arr;
        }

    public function get_config_row($dirname)
        {
            $arr = [];

            $table_config = $this->_db->prefix($dirname . '_config');
            $sql          = 'SELECT * FROM ' . $table_config . ' ORDER BY conf_id ASC';

            $res = $this->_db->query($sql, 0, 0);
            if (!$res) {
                return false;
            }

            while ($row = $this->_db->fetchArray($res)) {
                $arr[$row['conf_name']] = $row['conf_value'];
            }
            return $arr;
        }

    public function get_link_rows($dirname)
        {
            $rows = [];

            $table_link = $this->_db->prefix($dirname . '_link');
            $sql        = 'SELECT * FROM ' . $table_link . ' WHERE ltype<>0 ORDER BY lid ASC';

            $res = $this->_db->query($sql);
            if (!$res) {
                return false;
            }

            while ($row = $this->_db->fetchArray($res)) {
                $rows[] = $row;
            }
            return $rows;
        }

        public function sanitize($str)
        {
            return htmlspecialchars($str, ENT_QUOTES);
        }

        // --- class end ---
    }

// === class end ===
}


