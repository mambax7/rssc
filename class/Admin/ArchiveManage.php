<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: archive_manage.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_flag_execute_time()
// _UPDATE => _HAPPYLINUX_EXECUTE

// 2007-06-01 K.OHWADA
// api/refresh.php
// learn_black()

// 2006-09-18 K.OHWADA
// use XoopsGTicket
// use build_lib_box_limit_offset()

// 2006-07-10 K.OHWADA
// move class admin_manage_archive from admin_form_class.php
// use happy_linux_form happy_linux_post
// change make_xxx to build_xxx

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME
// add check_token()

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================


//=========================================================
// class archive manage
//=========================================================
class ArchiveManage extends Happylinux\Manage
{
    public $_feedHandler;
    public $_blackHandler;
    public $_refreshHandler;

    public $_post;

    public $_conf_feed_limit = 1000;
    public $_conf_word_limit = 1000;

    public $_limit;
    public $_offset;
    public $_num;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct(RSSC_DIRNAME);

        $helper = Helper::getInstance();
        $this->set_handler('LinkBasic', RSSC_DIRNAME, 'rssc', $helper);
        $this->set_id_name('lid');
        $this->set_form_class(ArchiveForm::class);
        $this->set_script('archive_manage.php');
        $this->set_flag_execute_time(true);

        $this->_feedHandler    = \XoopsModules\Rssc\Helper::getInstance()->getHandler('FeedBasic', RSSC_DIRNAME);
        $this->_blackHandler   = \XoopsModules\Rssc\Helper::getInstance()->getHandler('BlackBasic', RSSC_DIRNAME);
        $this->_refreshHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('RefreshAll', RSSC_DIRNAME);
        $confHandler           = \XoopsModules\Rssc\Helper::getInstance()->getHandler('ConfigBasic', RSSC_DIRNAME);

        $this->_post = Happylinux\Post::getInstance();

        $conf_data              = &$confHandler->get_conf();
        $this->_conf_feed_limit = $conf_data['basic_feed_limit'];
        $this->_conf_word_limit = $conf_data['word_limit'];
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
    // POST
    //---------------------------------------------------------
    public function get_post_op()
    {
        return $this->_post->get_post_get('op');
    }

    public function get_post_limit()
    {
        $this->_limit = $this->_post->get_post_int('limit');
        if ($this->_limit < 0) {
            $this->_limit = 0;
        }

        return $this->_limit;
    }

    public function get_post_offset()
    {
        $this->_offset = $this->_post->get_post_int('offset');
        if ($this->_offset < 0) {
            $this->_offset = 0;
        }

        return $this->_offset;
    }

    public function get_post_num()
    {
        $this->_num = $this->_post->get_post_int('num', $this->_conf_feed_limit);

        return $this->_num;
    }

    //---------------------------------------------------------
    // main_form()
    //---------------------------------------------------------
    public function main_form()
    {
        $total_link = $this->handler->get_count_all();
        $total_feed = $this->_feedHandler->get_count_all();

        $this->_print_cp_header();
        $this->_print_bread_op(_AM_RSSC_ARCHIVE_MANAGE, 'main_form');
        rssc_admin_print_header();
        rssc_admin_print_menu();
        echo '<h3>' . _AM_RSSC_ARCHIVE_MANAGE . "</h3>\n";
        printf(_AM_RSSC_THERE_ARE_LINKS, $total_link);
        echo "<br>\n";
        printf(_AM_RSSC_THERE_ARE_FEEDS, $total_feed);
        echo "<br><br>\n";

        $this->_print_form();
        $this->_print_cp_footer();
    }

    public function _print_form()
    {
        $limit  = $this->get_post_limit();
        $offset = $this->get_post_offset();
        $num    = $this->get_post_num();

        echo "<a name='refresh'></a>";
        echo '<h4>' . _AM_RSSC_REFRESH . "</h4>\n";
        $this->_form->show_refresh($limit, $offset);

        echo "<a name='learn'></a>";
        echo '<h4>' . _AM_RSSC_LEAN_BLACK . "</h4>\n";
        echo _AM_RSSC_LEAN_BLACK_DESC . "<br><br>\n";
        $this->_form->show_learn($limit, $offset);

        echo "<a name='clear'></a>";
        echo '<h4>' . _AM_RSSC_FEED_CLEAR . "</h4>\n";
        $this->_form->show_clear_old($num);
    }

    //---------------------------------------------------------
    // refresh_archive()
    //---------------------------------------------------------
    public function refresh_archive()
    {
        $limit  = $this->get_post_limit();
        $offset = $this->get_post_offset();

        $total_link = $this->handler->get_count_all();

        $this->_print_cp_header();
        $this->_print_bread_op(_AM_RSSC_ARCHIVE_MANAGE, 'main_form', _AM_RSSC_REFRESH);

        if (!$this->_check_token()) {
            $this->_print_preview();
            exit();
        }

        $this->_refreshHandler->set_feed_limit($this->_conf_feed_limit);
        $this->_refreshHandler->set_word_limit($this->_conf_word_limit);
        $this->_refreshHandler->set_flag_chmod(true);

        $ret = $this->_refreshHandler->refresh($limit, $offset);
        if (!$ret) {
            echo $this->_feedHandler->getErrorCode();

            $this->_set_error_title('Refresh Error');
            $this->_set_errors($this->_refreshHandler->getErrors());
            $this->_print_error(1);
        }

        $next = $offset + $limit;
        if (($limit > 0) && ($next < $total_link)) {
            echo "<br>\n";
            $this->_form->show_refresh_next($limit, $next);
        } else {
            echo '<h4>' . _RSSC_REFRESH_LINK_FINISHED . "</h4>\n";
        }

        $this->_print_cp_footer();
    }

    public function _print_preview()
    {
        $this->_print_token_error(1);
        $this->_print_form();
        $this->_print_cp_footer();
    }

    //---------------------------------------------------------
    // learn_black()
    //---------------------------------------------------------
    public function learn_black()
    {
        $limit  = $this->get_post_limit();
        $offset = $this->get_post_offset();

        $total_link = $this->_blackHandler->get_count_all();

        $this->_print_cp_header();
        $this->_print_bread_op(_AM_RSSC_ARCHIVE_MANAGE, 'main_form', _AM_RSSC_LEAN_BLACK);

        if (!$this->_check_token()) {
            $this->_print_preview();
            exit();
        }

        $this->_refreshHandler->set_feed_limit($this->_conf_feed_limit);
        $this->_refreshHandler->set_word_limit($this->_conf_word_limit);
        $this->_refreshHandler->set_flag_chmod(true);

        $ret = $this->_refreshHandler->learn_black($limit, $offset);
        if (!$ret) {
            echo $this->_feedHandler->getErrorCode();

            $this->_set_error_title('Learning Error');
            $this->_set_errors($this->_refreshHandler->getErrors());
            $this->_print_error(1);
        }

        $next = $offset + $limit;
        if (($limit > 0) && ($next < $total_link)) {
            echo "<br>\n";
            $this->_form->show_learn_next($limit, $next);
        } else {
            echo '<h4>' . _RSSC_REFRESH_LINK_FINISHED . "</h4>\n";
        }

        $this->_print_cp_footer();
    }

    //---------------------------------------------------------
    // clear_old()
    //---------------------------------------------------------
    public function clear_old()
    {
        $num = $this->get_post_num();

        $this->_print_cp_header();
        $this->_print_bread_op(_AM_RSSC_ARCHIVE_MANAGE, 'main_form', _AM_RSSC_FEED_CLEAR);
        $this->_print_title(_AM_RSSC_FEED_CLEAR);

        if (!$this->_check_token()) {
            $this->_print_preview();
            exit();
        }

        $del = $this->_feedHandler->clear_over_num($num);
        if ($del) {
            echo '<h4>' . _AM_RSSC_NUM_FEED_CLEARED . "</h4>\n";
            echo $del . ' ' . _AM_RSSC_NUM_FEEDS . "<br>\n";
        } elseif (!$this->_feedHandler->returnExistError()) {
            $this->_set_error_title('DB Error');
            $this->_set_errors($this->_feedHandler->getErrors());
            $this->_print_error(1);
        } else {
            echo $this->_form->build_html_blue(_HAPPYLINUX_NO_ACTION);
        }

        $this->_print_cp_footer();
    }

    // --- class end ---
}
