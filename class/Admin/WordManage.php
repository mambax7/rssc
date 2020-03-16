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
// class word manage
//=========================================================
class WordManage extends BaseManage
{
    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
       parent::__construct();

        $helper = Helper::getInstance();
        $this->set_handler('word', RSSC_DIRNAME, 'rssc', $helper);
        $this->set_id_name('sid');
        $this->set_form_class(WordForm::class);
        $this->set_script('word_manage.php');
        $this->set_redirect('word_list.php', 'word_list.php?sortid=1');
        $this->set_title(_AM_RSSC_ADD_WORD, _AM_RSSC_MOD_WORD, _AM_RSSC_DEL_WORD);
        $this->set_list_id_name('word_search_id');
        $this->set_flag_execute_time(true);
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
    // main_add_form()
    //---------------------------------------------------------
    public function main_add_form()
    {
        $this->_main_add_form();
    }

    //---------------------------------------------------------
    // main_add_table()
    //---------------------------------------------------------
    public function main_add_table()
    {
        $this->_main_add_table(true);
    }

    public function _check_add_table()
    {
        $ret = $this->_check_mod_table();
        if (!$ret) {
            return false;
        }

        $word = $this->_post->get_post_text('word');
        $objs = $this->handler->get_objects_by_word($word);
        if (is_array($objs) && count($objs)) {
            $script = 'word_manage.php?op=mod_form&amp;sid=';
            $msg    = $this->handler->build_error_list($objs, $script);
            $err    = '<h4>' . _AM_RSSC_WORD_ALREADY . "</h4>\n" . $msg;
            $this->_set_error_extra($err);

            return false;
        }

        return true;
    }

    //---------------------------------------------------------
    // main_mod_form()
    //---------------------------------------------------------
    public function main_mod_form()
    {
        $this->_main_mod_form();
    }

    //---------------------------------------------------------
    // main_mod_table()
    //---------------------------------------------------------
    public function main_mod_table()
    {
        $this->_main_mod_table(true);
    }

    public function _check_mod_table()
    {
        $this->_clear_errors();
        $this->_check_fill_by_post('word', _RSSC_WORD_WORD);

        return $this->returnExistError();
    }

    //---------------------------------------------------------
    // main_del_table()
    //---------------------------------------------------------
    public function main_del_table()
    {
        $this->_main_del_table(true);
    }

    //---------------------------------------------------------
    // modify point
    //---------------------------------------------------------
    public function main_mod_all()
    {
        $del     = $this->_post->get_post('del_all');
        $mod     = $this->_post->get_post('mod_all');
        $request = $this->_post->get_post('request_uri');
        $url     = 'word_list.php';

        if ($request) {
            $this->set_redirect_mod_all($request);
            $this->set_redirect_del_all($request);
        }

        if ($mod) {
            $this->_main_mod_all(true);
        } elseif ($del) {
            $this->_main_del_all(true);
        } else {
            redirect_header($url, 3, 'invalid submit name');
        }
    }

    public function _exec_mod_all()
    {
        $word_arr  = $this->_post->get_post('word');
        $point_arr = $this->_post->get_post('point');

        foreach ($point_arr as $k => $v) {
            $sid   = (int)$k;
            $point = (int)$v;
            $word  = $word_arr[$sid];

            $obj = $this->handler->get($sid);
            if (!is_object($obj)) {
                continue;
            }

            // skip if same value
            if (($point == $obj->get('point'))
                && ($word == $obj->get('word'))) {
                continue;
            }

            $obj->setVar('point', $point);
            $obj->setVar('word', $word);

            $ret = $this->handler->update($obj);
            if (!$ret) {
                $this->_set_error($this->handler->getErrors());
            }
        }

        return $this->returnExistError();
    }

    //---------------------------------------------------------
    // delete all
    //---------------------------------------------------------
    public function main_del_all()
    {
        $this->_main_del_all(true);
    }

    // --- class end ---
}
