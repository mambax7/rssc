<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: xoopsheadline100_to_rssc030.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2006-09-20 K.OHWADA
// use rssc_admin_print_bread()

// 2006-07-10 K.OHWADA
// use admin_import_base
// move from xoopsheadline100_to_rssc010

//================================================================
// RSS Center Module
// import from xoopshedline 1.00 to rssc 0.30
// 2006-07-10 K.OHWADA
//================================================================

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
class ImportXoopsheadline100Rssc030 extends admin_import_base
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        $this->admin_import_base();
        $this->set_dirname_orig('xoopsheadline');
        $this->set_debug_db_sql(0);
        $this->set_debug_db_error(1);

        $this->get_mid();
    }

    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    //=========================================================
    // import from xoopsheadline
    //=========================================================
    public function hl_first_step()
    {
        $this->_hl_form_xoopsheadline();
    }

    public function hl_import_xoopsheadline()
    {
        // === line table ===

        // --- xoopsheadline ---
        //  headline_id smallint(3)
        //  headline_name varchar(255)
        //  headline_url varchar(255)
        //  headline_rssurl varchar(255)
        //  headline_encoding varchar(15)
        //  headline_cachetime mediumint(8),
        //  headline_asblock tinyint(1)
        //  headline_display tinyint(1)
        //  headline_weight smallint(3)
        //  headline_mainfull tinyint(1)
        //  headline_mainimg tinyint(1)
        //  headline_mainmax tinyint(2)
        //  headline_blockimg tinyint(1)
        //  headline_blockmax tinyint(2)
        //  headline_xml text NULL,
        //  headline_updated int(10) NOT NULL default'0',

        // --- rssc ---
        //  lid int(11)
        //  uid int(11)
        //  mid int(11)
        //  p1  int(11)
        //  p2  int(11)
        //  p3  int(11)
        //  title  varchar(255)
        //  url    varchar(255)
        //  refresh   mediumint(8)
        //  headline  mediumint(8)
        //  mode      tinyint(3)
        //  rdf_url   varchar(255)
        //  rss_url   varchar(255)
        //  atom_url  varchar(255)
        //  encoding  varchar(15)
        //  updated_unix int(10)
        //  channel text
        //  xml  mediumtext
        //  aux_int_1 int(5)
        //  aux_int_2 int(5)
        //  aux_text_1 varchar(255)
        //  aux_text_2 varchar(255)

        echo "<h4>import link table</h4>\n";

        $offset = 0;
        if (isset($_POST['offset'])) {
            $offset = $_POST['offset'];
        }

        $next = $offset + $this->_LIMIT;

        $table_xoopsheadline = $this->db_prefix('xoopsheadline');

        $sql1 = 'SELECT count(*) FROM ' . $table_xoopsheadline;

        $res1  = &$this->query($sql1);
        $row1  = &$this->_db->fetchRow($res1);
        $total = $row1[0];

        echo 'There are <b>' . $total . "</b> xoopsheadline in XoopsHeadline<br>\n";
        echo 'Transfer ' . $offset . ' - ' . $next . " record <br><br>\n";

        $sql2 = 'SELECT * FROM ' . $table_xoopsheadline;
        $sql2 .= ' ORDER BY headline_id';
        $res2 = &$this->query($sql2, $this->_LIMIT, $offset);

        while (false !== ($row2 = $this->_db->fetchArray($res2))) {
            $id        = $row2['headline_id'];
            $url       = $row2['headline_url'];
            $rssurl    = $row2['headline_rssurl'];
            $name      = $row2['headline_name'];
            $encoding  = $row2['headline_encoding'];
            $cachetime = $row2['headline_cachetime'];
            $weight    = $row2['headline_weight'];
            $asblock   = $row2['headline_asblock'];
            $display   = $row2['headline_display'];

            echo $id . ': ' . htmlspecialchars($name);

            if ($this->_exist_url($url) || $this->_exist_url($rssurl)) {
                echo " <b>skip</b> <br>\n";
                continue;
            }

            echo " <br>\n";

            $title   = $name;
            $rss_url = $rssurl;
            $refresh = $cachetime;
            $p1      = $id;    // store lid;

            $headline = 0;

            // as block
            if ($asblock) {
                $headline = $weight + 1;
            }

            $link_obj = $this->_linkHandler->create();

            $link_obj->set('uid', 1);    // admin
            $link_obj->set('mid', $this->_mid);
            $link_obj->set('mode', RSSC_C_MODE_RSS);
            $link_obj->set('refresh', $refresh);
            $link_obj->set('headline', $headline);
            $link_obj->set('p1', $p1);
            $link_obj->setVar('title', $title, true);
            $link_obj->setVar('url', $url, true);
            $link_obj->setVar('rss_url', $rss_url, true);
            $link_obj->setVar('encoding', $encoding, true);

            $this->_linkHandler->insert($link_obj);
            unset($link_obj);
        }

        if ($total > $next) {
            $this->_form_link($next);
        } else {
            $this->_print_finish();
        }
    }

    public function _hl_form_xoopsheadline()
    {
        $title  = 'import xoopsheadline';
        $op     = 'import_xoopsheadline';
        $submit = 'GO';

        $this->_print_form_next($title, $op, $submit);
    }

    // --- class end ---
}
