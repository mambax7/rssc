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
// class FeedColumnForm
//=========================================================
class FeedColumnForm extends Happylinux\Form
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

    public function print_form($fields)
    {
        // form start
        echo $this->build_form_begin('feed_column');
        echo $this->build_token();
        echo $this->build_html_input_hidden('op', 'update');

        echo $this->build_form_table_begin();

        $all = $this->build_form_js_checkall();

        echo '<tr>';
        echo '<th>' . $all . '</th>' . "\n";
        echo '<th>field</th>' . "\n";
        echo '<th>type</th>' . "\n";
        echo '<th>new type</th>' . "\n";
        echo '</tr>' . "\n";

        foreach ($fields as $k => $v) {
            $field  = $v['field'];
            $type   = $v['type'];
            $update = $v['update'];

            $js           = '';
            $field_hidden = '';
            $update_name  = '';

            if ($update) {
                $js            = $this->build_form_js_checkbox($k);
                $field_name    = 'field[' . $k . ']';
                $field_hidden  = $this->build_html_input_hidden($field_name, $field);
                $update_name   = 'update[' . $k . ']';
                $update_hidden = $this->build_html_input_hidden($update_name, $update);
            } else {
                $js     = '-';
                $update = '---';
            }

            echo '<tr>';
            echo '<td>' . $js . '</td>' . "\n";
            echo '<td>' . $field . $field_hidden . '</td>' . "\n";
            echo '<td>' . $type . '</td>' . "\n";
            echo '<td>' . $update . $update_hidden . '</td>' . "\n";
            echo '</tr>' . "\n";
        }

        $submit = $this->build_html_input_submit('submit', _HAPPYLINUX_UPDATE);

        echo '<tr>';
        echo $this->build_html_td_tag_begin('', '', 1, '', 'foot');
        echo '</td>';
        echo $this->build_html_td_tag_begin('', '', 3, '', 'foot');
        echo $submit . '</td>';
        echo '</tr>' . "\n";

        echo $this->build_form_table_end();
        echo $this->build_form_end();
    }

    // --- class end ---
}
