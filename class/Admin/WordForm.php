<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: word_manage.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-11-01 K.OHWADA
// BUG: dont work del_all
// main_del_all()
// set_flag_execute_time()

//=========================================================
// RSS Center Module
// 2007-06-01 K.OHWADA
//=========================================================

//=========================================================
// class WordForm
//=========================================================
class WordForm extends Happylinux\Form
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

    //---------------------------------------------------------
    // show word
    //---------------------------------------------------------
    public function _show($obj, $extra = null, $mode = 0)
    {
        switch ($mode) {
            case HAPPYLINUX_MODE_MOD:
            case HAPPYLINUX_MODE_MOD_PREVIEW:
                $mode       = HAPPYLINUX_MODE_MOD;
                $form_title = _AM_RSSC_MOD_WORD;
                $op         = 'mod_table';
                $button_val = _HAPPYLINUX_MODIFY;
                break;
            case HAPPYLINUX_MODE_ADD:
            case HAPPYLINUX_MODE_ADD_PREVIEW:
            default:
                $form_title = _AM_RSSC_ADD_WORD;
                $op         = 'add_table';
                $button_val = _ADD;
                break;
        }

        $this->set_obj($obj);

        // form start
        echo $this->build_form_begin();
        echo $this->build_token();
        echo $this->build_html_input_hidden('op', $op);

        if (HAPPYLINUX_MODE_MOD == $mode) {
            echo $this->build_html_input_hidden('sid', $obj->get('sid'));
        }

        echo $this->build_form_table_begin();
        echo $this->build_form_table_title($form_title);

        if (HAPPYLINUX_MODE_MOD == $mode) {
            echo $this->build_form_table_line(_RSSC_WORD_ID, $obj->get('sid'));
        }

        echo $this->build_obj_table_radio_yesno(_RSSC_REG_EXP, 'reg');
        echo $this->build_obj_table_text(_RSSC_WORD_WORD, 'word');
        echo $this->build_obj_table_text(_RSSC_WORD_POINT, 'point');
        echo $this->build_obj_table_text(_RSSC_FREQ_COUNT, 'count');

        echo $this->build_obj_table_textarea(_AM_RSSC_BLACK_MEMO, 'memo');

        $ele_submit = $this->build_html_input_submit('submit', $button_val);
        echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

        if (HAPPYLINUX_MODE_MOD == $mode) {
            $ele_del    = $this->build_html_input_submit('del_table', _DELETE);
            $ele_cancel = $this->build_html_input_button_cancel('cancel', _CANCEL);
            echo $this->build_form_table_line('', $ele_del . '  ' . $ele_cancel, 'foot', 'foot');
        }

        echo $this->build_form_table_end();
        echo $this->build_form_end();
        // --- form end ---
    }

    // --- class end ---
}
