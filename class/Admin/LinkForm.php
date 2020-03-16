<?php

namespace XoopsModules\Rssc\Admin;

use XoopsModules\Rssc;
use XoopsModules\Rssc\Helper;
use XoopsModules\Happylinux;

// $Id: link_manage.php,v 1.4 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// rssc_map

// 2012-03-31 K.OHWADA
// default.gif

// 2012-03-01 K.OHWADA
// webmap3_api_gicon

// 2009-02-20 K.OHWADA
// _build_ele_gicon()

// 2008-01-20 K.OHWADA
// post_plugin

// 2007-11-01 K.OHWADA
// enclosure censor plugin
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// link_xmlHandler, xmlHandler
// api/refresh.php
// use get_ltype_option()
// use feed_list_lid.php

// 2007-05-19 K.OHWADA
// BUG: dont show admin frame

// 2006-09-20 K.OHWADA
// show bread crumb
// use XoopsGTicket
// add _refresh_link_error() etc
// use rssc_xml_utlity : not use rssc_link_existHandler
// use build_lib_button_hidden_array()
// use _check_url_by_post()
// use RSSC_CODE_PARSE_NOT_READ_XML_URL

// 2006-07-18 K.OHWADA
// BUG 4145: 'blong link' jump always 'rssc' directory

// 2006-07-08 K.OHWADA
// move class admin_manage_link from admin_manage_class.php
// move class admin_form_link   from admin_form_class.php
// use happy_linux_form happy_linux_post
// change make_xxx to build_xxx
// link exist check
//   add check_exist_rssurl()

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

//=========================================================
// class LinkForm
//=========================================================
class LinkForm extends Happylinux\FormLib
{
    public $_linkHandler;
    public $_xmlHandler;
    public $_feedHandler;
    public $_post;
    public $_system;
    public $_html_class;
    public $_map_class;

    public $_conf;

    public $_SIZE_TINY         = 15;
    public $_LENGTH_TEXT_SHORT = 300;

    public $_CENSOR_ROWS = 4;
    public $_CENSOR_COLS = 50;

    // icon
    public $_DIR_ICON_REL = 'images/icons';
    public $_IMG_ID_ICON  = 'rssc_img_icon';
    public $_DIR_ICON;
    public $_URL_ICON;
    public $_URL_ICON_WHITE_DOT;

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->_linkHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Link', RSSC_DIRNAME);
        $this->_xmlHandler  = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Xml', RSSC_DIRNAME);
        $this->_feedHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('Feed', RSSC_DIRNAME);
        $this->_post        = Happylinux\Post::getInstance();
        $this->_system      = Happylinux\System::getInstance();
        $this->_map_class   = Rssc\Map::getInstance(RSSC_DIRNAME);

        $confHandler = \XoopsModules\Rssc\Helper::getInstance()->getHandler('ConfigBasic', RSSC_DIRNAME);
        $this->_conf = $confHandler->get_conf();

        // icon
        $this->_DIR_ICON           = RSSC_ROOT_PATH . '/' . $this->_DIR_ICON_REL;
        $this->_URL_ICON           = RSSC_URL . '/' . $this->_DIR_ICON_REL;
        $this->_URL_ICON_WHITE_DOT = RSSC_URL . '/images/white_dot.png';
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
    // show link
    //---------------------------------------------------------
    public function _show($obj, $extra = null, $show_mode = 0)
    {
        echo _AM_RSSC_LINK_DESC . "<br><br>\n";

        echo $this->_build_icon_js();

        $webmap3_flag = false;
        if ($this->_map_class->init_form()) {
            $webmap3_flag = true;
            echo $this->_map_class->build_form_js();
        }

        switch ($show_mode) {
            case HAPPYLINUX_MODE_MOD:
            case HAPPYLINUX_MODE_MOD_PREVIEW:
                $show_mode  = HAPPYLINUX_MODE_MOD;
                $form_title = _AM_RSSC_MOD_LINK;
                $op         = 'mod_table';
                $button_val = _HAPPYLINUX_MODIFY;
                break;
            case HAPPYLINUX_MODE_ADD:
            case HAPPYLINUX_MODE_ADD_PREVIEW:
            default:
                $form_title = _AM_RSSC_ADD_LINK;
                $op         = 'add_table';
                $button_val = _ADD;
                break;
        }

        $this->set_obj($obj);

        $lid      = $obj->get('lid');
        $rdf_url  = $obj->get('rdf_url');
        $rss_url  = $obj->get('rss_url');
        $atom_url = $obj->get('atom_url');

        if (HAPPYLINUX_MODE_MOD == $show_mode) {
            $list = &$this->_linkHandler->get_list_by_rssurl($rdf_url, $rss_url, $atom_url, $lid);
            if (is_array($list) && count($list)) {
                $script = 'link_manage.php?op=mod_form&amp;lid=';
                echo $this->build_html_highlight(_RSSC_LINK_EXIST_MORE);
                echo "<br><br>\n";
                echo $this->_linkHandler->build_error_rssurl_list($list, $script);
                echo "<br><br>\n";
            }

            $total_feed = $this->_feedHandler->get_count_by_lid($lid);

            // bug: always 'rssc' directory
            $url_feed = 'feed_list_lid.php?lid=' . $lid;

            printf(_AM_RSSC_THERE_ARE_MATCH, $total_feed);
            echo "<br><br>\n";
            echo $this->build_html_a_href_name($url_feed, _AM_RSSC_FEED_BELONG_LINK);
            echo "<br><br>\n";
        }

        // form start
        echo $this->build_form_begin('link_edit');
        echo $this->build_token();
        echo $this->build_html_input_hidden('op', $op);

        if (HAPPYLINUX_MODE_MOD == $show_mode) {
            echo $this->build_html_input_hidden('lid', $lid);
        }

        echo $this->build_form_table_begin();
        echo $this->build_form_table_title($form_title);

        if (HAPPYLINUX_MODE_MOD == $show_mode) {
            echo $this->build_form_table_line(_RSSC_LINK_ID, $lid);
        }

        $ele_uid = $this->build_obj_text('uid', $this->_SIZE_TINY);
        $ele_uid .= ' ';
        $ele_uid .= $this->build_lib_user_link_uname_by_uid($obj->get('uid'));
        echo $this->build_form_table_line(_RSSC_USER_ID, $ele_uid);

        $reg_href = '';
        $register = &$this->get_register($obj);
        if (is_array($register)) {
            $reg_dirname = $register['dirname'];
            $reg_name    = $register['name'];
            $reg_url     = $register['url'];
            $reg_href    = $this->build_html_a_href_name($reg_url, $reg_name, '_blank');
        }

        $ele_mid = $this->build_obj_text('mid', $this->_SIZE_TINY);
        $ele_mid .= ' ' . $reg_href;
        echo $this->build_form_table_line(_RSSC_MOD_ID, $ele_mid);

        echo $this->build_obj_table_text('p1', 'p1', $this->_SIZE_TINY);
        echo $this->build_obj_table_text('p2', 'p2', $this->_SIZE_TINY);
        echo $this->build_obj_table_text('p3', 'p3', $this->_SIZE_TINY);

        echo $this->build_form_table_line(
            _AM_RSSC_LINK_ICON_SEL,
            $this->_build_ele_icon()
        );

        if ($webmap3_flag) {
            echo $this->build_form_table_line(
                _AM_RSSC_LINK_GICON_SEL,
                $this->_build_ele_gicon()
            );
        }

        echo $this->build_obj_table_text(_RSSC_SITE_TITLE, 'title');

        $ele_url = $this->build_edit_url_with_visit('url', $obj->get('url'));
        echo $this->build_form_table_line(_RSSC_SITE_LINK, $ele_url);

        $ele_ltype = $this->build_html_input_radio_select('ltype', $obj->get('ltype'), $obj->get_ltype_option());
        echo $this->build_form_table_line(_RSSC_LTYPE, $ele_ltype);

        echo $this->build_obj_table_text(_RSSC_REFRESH_INTERVAL, 'refresh', $this->_SIZE_TINY);
        echo $this->build_obj_table_text(_RSSC_HEADLINE_ORDER, 'headline', $this->_SIZE_TINY);

        $ele_enclosure = $this->build_html_input_radio_select('enclosure', $obj->get('enclosure'), $obj->get_enclosure_option());
        echo $this->build_form_table_line(_RSSC_LINK_ENCLOSURE, $ele_enclosure);

        $cap_censor = $this->build_form_caption(_RSSC_LINK_CENSOR, _AM_RSSC_LINK_CENSOR_DESC);
        echo $this->build_obj_table_textarea($cap_censor, 'censor', $this->_CENSOR_ROWS, $this->_CENSOR_COLS);

        $ele_plugin_list = '<a href="' . RSSC_URL . '/plugin_popup.php" target="_blank">';
        $ele_plugin_list .= ' - ' . _RSSC_PLUGIN_LIST;
        $ele_plugin_list .= '</a>' . "<br>\n";
        echo $this->build_form_table_line('', $ele_plugin_list);

        $cap_pre_plugin = $this->build_form_caption(
            _RSSC_PRE_PLUGIN,
            _AM_RSSC_PRE_PLUGIN_DESC . '<br>' . _AM_RSSC_PLUGIN_DESC_2
        );
        echo $this->build_obj_table_textarea($cap_pre_plugin, 'plugin');

        $cap_post_plugin = $this->build_form_caption(
            _RSSC_POST_PLUGIN,
            _AM_RSSC_POST_PLUGIN_DESC . '<br>' . _AM_RSSC_PLUGIN_DESC_2
        );
        echo $this->build_obj_table_textarea($cap_post_plugin, 'post_plugin');

        $ele_mode = $this->build_html_input_radio_select('mode', $obj->get('mode'), $obj->get_mode_option());
        echo $this->build_form_table_line(_RSSC_RSS_MODE, $ele_mode);

        $ele_rdf_url = $this->build_edit_url_with_visit('rdf_url', $obj->get('rdf_url'));
        echo $this->build_form_table_line(_RSSC_RDF_URL, $ele_rdf_url);

        $ele_rss_url = $this->build_edit_url_with_visit('rss_url', $obj->get('rss_url'));
        echo $this->build_form_table_line(_RSSC_RSS_URL, $ele_rss_url);

        $ele_atom_url = $this->build_edit_url_with_visit('atom_url', $obj->get('atom_url'));
        echo $this->build_form_table_line(_RSSC_ATOM_URL, $ele_atom_url);

        echo $this->build_obj_table_text(_RSSC_ENCODING, 'encoding');

        if (HAPPYLINUX_MODE_MOD == $show_mode) {
            $ele_update = $this->build_obj_text('updated_unix', $this->_SIZE_TINY);
            $ele_update .= ' ';
            $ele_update .= formatTimestamp($obj->get('updated_unix'));
            echo $this->build_form_table_line(_RSSC_UPDATED, $ele_update);
        } else {
            echo $this->build_form_table_line(_RSSC_UPDATED, 0);
        }

        $ele_channel = '';
        $val_channel = $obj->get_channel();
        if ($val_channel) {
            $export_channel = var_export($val_channel, true);
            $url_channel    = 'link_manage.php?op=view_channel&amp;lid=' . $lid;
            $ele_channel    = $obj->sanitize_format_text_short($export_channel, 's', $this->_LENGTH_TEXT_SHORT);
            $ele_channel    .= $this->build_html_a_href_name($url_channel, _MORE, '_blank');
        }
        echo $this->build_form_table_line('channel', $ele_channel);

        $ele_xml = '';
        $xml_obj = $this->_xmlHandler->get($lid);
        if (is_object($xml_obj)) {
            $val_xml = $xml_obj->get_rawurldecode_xml();
            if ($val_xml) {
                $url_xml = 'link_manage.php?op=view_xml&amp;lid=' . $lid;
                $ele_xml = $xml_obj->sanitize_format_text_short($val_xml, 's', $this->_LENGTH_TEXT_SHORT);
                $ele_xml .= $this->build_html_a_href_name($url_xml, _MORE, '_blank');
            }
        }

        echo $this->build_form_table_line('xml', $ele_xml);

        if (0 == $show_mode) {
            $val_force = $this->_post->get_post_int('force');
            $ele_force = $this->build_form_radio_yesno('force', $val_force);
            echo $this->build_form_table_line(_AM_RSSC_LINK_FORCE, $ele_force);
        }

        $ele_submit = $this->build_html_input_submit('submit', $button_val);
        echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

        if (HAPPYLINUX_MODE_MOD == $show_mode) {
            $ele_del    = $this->build_html_input_submit('del_table', _DELETE);
            $ele_cancel = $this->build_html_input_button_cancel('cancel', _CANCEL);
            echo $this->build_form_table_line('', $ele_del . '  ' . $ele_cancel, 'foot', 'foot');
        }

        echo $this->build_form_table_end();
        echo $this->build_form_end();
        // --- form end ---
    }

    public function _build_ele_gicon()
    {
        $id = $this->_obj->getVar('gicon_id');

        return $this->_map_class->build_ele_gicon($id);
    }

    public function _build_icon_js()
    {
        $url_icon = $this->_URL_ICON;
        $url_none = $this->_URL_ICON_WHITE_DOT;
        $img_id   = $this->_IMG_ID_ICON;

        $text = <<< EOF
<script type="text/javascript">
//<![CDATA[
function rssc_icon_onchange( obj ) 
{
	var image = "$url_none";
	if ( obj != null ) {
		var index = obj.selectedIndex;
		if ( obj.options[index] != null ) {
			var id = obj.options[index].value;
			if ( id != '' ) {
				image = "$url_icon" + "/" + id;
			}
		}
	}
	var element = document.getElementById( "$img_id" );
	if ( element != null  ) {
		element.src = image;
	}
}
//]]>
</script>
EOF;

        return $text;
    }

    public function _build_ele_icon()
    {
        $name    = 'icon';
        $value   = $this->_obj->getVar($name, 'n');
        $options = $this->_system->get_img_list_as_array($this->_DIR_ICON);
        $extra   = 'onChange="rssc_icon_onchange(this)"';

        if (('' == $value) || ('---' == $value)) {
            $value = 'default.gif';
        }

        $file_icon = $this->_DIR_ICON . '/' . $value;
        $url_icon  = $this->_URL_ICON . '/' . $value;

        $img_src = '';

        if ($value && file_exists($file_icon)) {
            $img_src = $this->sanitize_url($url_icon);
        }

        $str = $this->build_icon_select($name, $value, $options, $extra);
        $str .= "<br>\n";
        $str .= $this->build_icon_img_tag($this->_IMG_ID_ICON, $img_src, 'icon');

        return $str;
    }

    public function build_icon_select($name, $value, $options, $extra)
    {
        $text = $this->build_html_select_tag_begin($name, '', false, $extra);

        foreach ($options as $opt_name => $opt_val) {
            $text .= $this->build_html_option_selected($opt_name, $opt_val, [$value]);
        }

        $text .= $this->build_html_select_tag_end();

        return $text;
    }

    public function build_icon_img_tag($id, $src, $alt)
    {
        // sanitize
        $id  = $this->sanitize_text($id);
        $src = $this->sanitize_url($src);
        $alt = $this->sanitize_text($alt);

        $text = '<img ';
        $text .= 'id="' . $id . '" ';
        $text .= 'src="' . $src . '" ';
        $text .= 'alt="' . $alt . '" ';
        $text .= 'border="0" ';
        $text .= ">\n";

        return $text;
    }

    public function show_refresh_link($lid, $op_mode = 0)
    {
        switch ($op_mode) {
            case 1:
                $location_url = 'link_list.php';
                break;
            case 0:
            default:
                $location_url = 'link_list.php?sortid=1';
                break;
        }

        $arr = [
            'op'       => 'refresh_link',
            'op_mode'  => $op_mode,
            'lid'      => $lid,
            'rssc_lid' => $lid,
        ];

        $form_name      = '';
        $action         = '';
        $submit_name    = 'submit';
        $submit_value   = _HAPPYLINUX_EXECUTE;
        $cancel_name    = '';
        $cancel_value   = '';
        $location_name  = 'cancel';
        $location_value = _CANCEL;

        $val  = $this->build_lib_button_hidden_array($arr, $form_name, $action, $submit_name, $submit_value, $cancel_name, $cancel_value, $location_name, $location_value, $location_url);
        $text = $this->build_lib_box_style(_RSSC_REFRESH_LINK, _RSSC_REFRESH_LINK_DSC, $val);
        echo $text;
    }

    public function &get_register($obj)
    {
        $false = false;
        $mid   = $obj->get('mid');
        $p1    = $obj->get('p1');

        if ($mid <= 0) {
            return $false;
        }

        $module = $this->_system->get_module_by_mid($mid);
        if (!is_object($module)) {
            return $false;
        }

        $dirname = $module->getVar('dirname', 'n');
        $name    = $module->getVar('name', 'n');

        $match = null;
        if (preg_match('/^rssc_headline/', $dirname)) {
            $match = 'rssc_headline';
        } elseif (preg_match('/^rssc/', $dirname)) {
            $match = 'rssc';
        } elseif (preg_match('/^weblinks/', $dirname)) {
            $match = 'weblinks';
        }

        switch ($match) {
            case 'rssc_headline':
                $url = XOOPS_URL . '/modules/' . $dirname . '/admin/index.php?op=edit&headline_id=' . $p1;
                break;
            case 'weblinks':
                $url = XOOPS_URL . '/modules/' . $dirname . '/admin/link_manage.php?op=mod_form&lid=' . $p1;
                break;
            default:
            case 'rssc':
                $url = '';
                break;
        }

        $arr = [
            'dirname' => $dirname,
            'name'    => $name,
            'url'     => $url,
        ];

        return $arr;
    }

    public function show_channel($obj)
    {
        $title_s = $obj->getVar('title', 's');
        $channel = $obj->get_channel();

        echo '<h4>' . $title_s . "</h4>\n";
        echo $this->build_form_table_by_array($channel);
        echo "<br>\n";
        echo $this->build_form_button_close_style();
    }

    public function get_xml($obj)
    {
        $lid     = $obj->get('lid');
        $xml     = false;
        $xml_obj = $this->_xmlHandler->get($lid);
        if (is_object($xml_obj)) {
            $xml = $xml_obj->get_rawurldecode_xml();
        }

        return $xml;
    }

    // --- class end ---
}
