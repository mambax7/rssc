<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: feed_column_manage.php,v 1.1 2012/03/31 04:46:34 ohwada Exp $

//=========================================================
// RSS Center Module
// 2012-03-01 K.OHWADA
//=========================================================

//=========================================================
// class FeedColumnManage
//=========================================================
class FeedColumnManage extends Happylinux\Error
{
    // handler
    public $_feed_basicHandler;
    public $_post;
    public $_form;

    public $_THIS_URL;

    public $_COLUMN_ARRAY = [
        'entry_id'            => 'varchar',
        'guid'                => 'varchar',
        'media_content_url'   => 'varchar',
        'media_thumbnail_url' => 'varchar',
        'content'             => 'text',
    ];

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->_feed_basicHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('FeedBasic', RSSC_DIRNAME);
        $this->_post_class        = Happylinux\Post::getInstance();
        $this->_form_class        = FeedColumnForm::getInstance();

        $this->_THIS_URL = RSSC_URL . '/admin/feed_column_manage.php';
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
    // main
    //---------------------------------------------------------
    public function get_op()
    {
        return $this->_post_class->get_post('op');
    }

    public function main()
    {
        $this->form();
    }

    public function update()
    {
        if (!$this->_form_class->check_token()) {
            $msg = $this->_form->get_token_error();
            redirect_header($this->_THIS_URL, 5, $msg);
            exit();
        }

        $feed_column_ids = $this->_post_class->get_post('feed_column_id');
        $fields          = $this->_post_class->get_post('field');
        $updates         = $this->_post_class->get_post('update');

        if (!is_array($feed_column_ids) || !count($feed_column_ids)) {
            redirect_header($this->_THIS_URL, 5, 'No Data');
            exit();
        }

        $arr = [];

        foreach ($feed_column_ids as $id) {
            $id = (int)$id;
            if (!isset($fields[$id])) {
                continue;
            }
            if (!isset($updates[$id])) {
                continue;
            }

            $arr[] = [
                'field' => $fields[$id],
                'type'  => $updates[$id],
            ];
        }

        $ret = $this->_feed_basicHandler->update_column_type($arr);
        if ($ret) {
            $msg  = _HAPPYLINUX_UPDATED;
            $time = 3;
        } else {
            $msg  = $this->_feed_basicHandler->getErrros(1);
            $time = 5;
        }

        redirect_header($this->_THIS_URL, $time, $msg);
    }

    public function form()
    {
        echo '<h3>' . _AM_RSSC_FEED_COLUMN_MANAGE . "</h3>\n";
        $rows = $this->_feed_basicHandler->get_columns();
        $keys = array_keys($this->_COLUMN_ARRAY);

        $arr = [];
        foreach ($rows as $row) {
            $field = $row['Field'];
            $type  = $row['Type'];

            if (!in_array($field, $keys)) {
                continue;
            }

            $type_orig = $this->_COLUMN_ARRAY[$field];

            $update = '';
            if (('varchar' == $type_orig) && preg_match('/^varchar/i', $type)) {
                $update = 'text';
            } elseif (('text' == $type_orig) && preg_match('/^text/i', $type)) {
                $update = 'mediumtext';
            }

            $arr[] = [
                'field'  => $field,
                'type'   => $type,
                'update' => $update,
            ];
        }

        $this->_form_class->print_form($arr);
    }

    // --- class end ---
}
