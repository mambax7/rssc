<?php

// $Id: rssc_xoopsheadline_handler.php,v 1.1 2011/12/29 14:37:17 ohwada Exp $

// 2007-10-10 K.OHWADA
// move from xoopsheadline100_to_rssc030.php

//=========================================================
// RSS Center Module
// 2006-07-10 K.OHWADA
//=========================================================

//=========================================================
// class rssc_xoopsheadline_handler
//=========================================================

/**
 * Class rssc_xoopsheadline_handler
 */
class rssc_xoopsheadline_handler extends happy_linux_basic_handler
{
    public $_DIRNAME_XOOPSHEADLINE = 'xoopsheadline';

    public $_system_uid;
    public $_mid_orig;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct($this->_DIRNAME_XOOPSHEADLINE);
        $this->set_table_full($this->db_prefix('xoopsheadline'));
        $this->set_id_name('headline_id');
        $this->set_debug_db_error(1);

        $system = happy_linux_system::getInstance();
        $this->system_uid = $system->get_uid();
        $this->_mid_orig = $system->get_mid_by_dirname($this->_DIRNAME_XOOPSHEADLINE);
    }

    /**
     * @return \happy_linux_basic_handler|\rssc_xoopsheadline_handler|static
     */
    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    //---------------------------------------------------------
    // public
    //---------------------------------------------------------

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function &get_objects_for_import($limit = 0, $offset = 0)
    {
        $rows = $this->get_rows($limit, $offset);

        $objs = [];
        foreach ($rows as $row) {
            $headline_id = $row['headline_id'];
            $headline_rssurl = $row['headline_rssurl'];

            // as block
            $headline = 0;
            if ($row['headline_asblock']) {
                $headline = $row['headline_weight'] + 1;
            }

            $row['title'] = $row['headline_name'];
            $row['url'] = $row['headline_url'];
            $row['encoding'] = $row['headline_encoding'];
            $row['refresh'] = $row['headline_cachetime'];
            $row['id'] = $headline_id;
            $row['p1'] = $headline_id;
            $row['headline'] = $headline;
            $row['uid'] = $this->system_uid;
            $row['mid'] = $this->_mid_orig;
            $row['mode'] = 2;    // rss
            $row['rss_url'] = $headline_rssurl;
            $row['orig_rss_url'] = $headline_rssurl;

            $obj = $this->create();
            if (is_object($obj)) {
                $obj->set_vars($row);
                $objs[] = &$obj;
                unset($obj);
            }
        }

        return $objs;
    }

    // --- class end ---
}
