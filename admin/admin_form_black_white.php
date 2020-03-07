<?php
// $Id: admin_form_black_white.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2007-10-10 K.OHWADA
// add field cache ctime in black, white

// 2007-06-01 K.OHWADA
// add field act reg count

// 2006-09-10 K.OHWADA
// use XoopsGTicket

// 2006-07-18 K.OHWADA
// BUG 4145: 'blong link' jump always 'rssc' directory

// 2006-07-10 K.OHWADA
// this is new file
// move from admin_form_class
// use happy_linux_form
// change class name admin_form to admin_form_base
// change make_xxx to build_xxx

//=========================================================
// RSS Center Module
// 2006-07-10 K.OHWADA
//=========================================================
class admin_form_black_white extends happy_linux_form
{
    // class instance
    public $_feed_handler;

    // black & white
    public $_id_name;
    public $_form_title_add;
    public $_form_title_mod;
    public $_jump_feed;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        // class instance
        $this->_feed_handler = rssc_get_handler('feed', RSSC_DIRNAME);
    }

    public static function getInstance()
    {
        static $instance;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    //---------------------------------------------------------
    // show black & white
    //---------------------------------------------------------
    public function _show_black_white(&$obj, $extra = null, $mode = 0)
    {
        switch ($mode) {
            case HAPPY_LINUX_MODE_MOD:
            case HAPPY_LINUX_MODE_MOD_PREVIEW:
                $mode       = HAPPY_LINUX_MODE_MOD;
                $form_title = $this->_form_title_mod;
                $op         = 'mod_table';
                $button_val = _HAPPY_LINUX_MODIFY;
                break;

            case HAPPY_LINUX_MODE_ADD:
            case HAPPY_LINUX_MODE_ADD_PREVIEW:
            default:
                $form_title = $this->_form_title_add;
                $op         = 'add_bulk';
                $button_val = _ADD;
                break;
        }

        $this->set_obj($obj);

        $cache_value = $this->_obj->get('cache');
        $ctime_value = $this->_obj->get('ctime');

        if (1 == $mode) {
            $url        = $obj->get('url');
            $total_feed = $this->_feed_handler->get_count_by_link($url);

            $cache_value = $total_feed;
            $ctime_value = time();

            printf(_AM_RSSC_THERE_ARE_MATCH, $total_feed);
            echo "<br /><br />\n";
            echo $this->build_html_a_href_name($this->_jump_feed, _AM_RSSC_FEED_MATCH_LINK);
            echo "<br /><br />\n";
        }

        // form start
        echo $this->build_form_begin();
        echo $this->build_token();
        echo $this->build_html_input_hidden('op', $op);

        if (HAPPY_LINUX_MODE_MOD == $mode) {
            echo $this->build_html_input_hidden($this->_id_name, $obj->get($this->_id_name));
        }

        echo $this->build_form_table_begin();
        echo $this->build_form_table_title($form_title);

        if (HAPPY_LINUX_MODE_MOD == $mode) {
            echo $this->build_form_table_line('id', $obj->get($this->_id_name));
        }

        $act_opt = $this->get_act_option();
        $ele_act = $this->build_html_input_radio_select('act', $obj->get('act'), $act_opt);
        echo $this->build_form_table_line(_RSSC_ACT, $ele_act);

        echo $this->build_obj_table_text(_RSSC_LINK_ID, 'lid');
        echo $this->build_obj_table_text(_RSSC_USER_ID, 'uid');
        echo $this->build_obj_table_text(_RSSC_MOD_ID, 'mid');
        echo $this->build_obj_table_text('p1', 'p1');
        echo $this->build_obj_table_text('p2', 'p2');
        echo $this->build_obj_table_text('p3', 'p3');

        echo $this->build_obj_table_text(_RSSC_SITE_TITLE, 'title');

        $reg_opt = $this->get_reg_option();
        $ele_reg = $this->build_html_input_radio_select('reg', $obj->get('reg'), $reg_opt);
        echo $this->build_form_table_line(_RSSC_REG, $ele_reg);

        if (HAPPY_LINUX_MODE_MOD == $mode) {
            $ele_url = $this->build_edit_url_with_visit('url', $obj->get('url'));
            echo $this->build_form_table_line(_RSSC_SITE_LINK, $ele_url);
        } else {
            $ele_url = $this->build_edit_textarea_urllist('urllist', $obj->get('url'));
            echo $this->build_form_table_line(_RSSC_SITE_LINK, $ele_url);
        }

        echo $this->build_obj_table_textarea(_AM_RSSC_BLACK_MEMO, 'memo');
        echo $this->build_obj_table_text(_RSSC_FREQ_COUNT, 'count');

        $ele_cache = $this->build_html_input_text('cache', $cache_value);
        echo $this->build_form_table_line(_RSSC_BW_CACHE, $ele_cache);

        $ele_ctime = $this->build_html_input_text('ctime', $ctime_value);
        echo $this->build_form_table_line(_RSSC_BW_CTIME, $ele_ctime);

        $ele_submit = $this->build_html_input_submit('submit', $button_val);
        echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

        if (HAPPY_LINUX_MODE_MOD == $mode) {
            $ele_del    = $this->build_html_input_submit('del_table', _DELETE);
            $ele_cancel = $this->build_html_input_button_cancel('cancel', _CANCEL);
            echo $this->build_form_table_line('', $ele_del . '  ' . $ele_cancel, 'foot', 'foot');
        }

        echo $this->build_form_table_end();
        echo $this->build_form_end();
        // --- form end ---

    }

    public function get_act_option()
    {
        $opt = [
            _RSSC_ACT_NON => 0,
            _RSSC_ACT_ACT => 1,
        ];
        return $opt;
    }

    public function get_reg_option()
    {
        $opt = [
            _RSSC_REG_NORMAL => 0,
            _RSSC_REG_EXP    => 1,
        ];
        return $opt;
    }

    // --- class end ---
}


