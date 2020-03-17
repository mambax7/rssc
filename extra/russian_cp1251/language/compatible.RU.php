<?php

// $Id: compatible.RU.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

// 2007-10-10 K.OHWADA
// enclusure in link table

// 2007-07-01 K.OHWADA
// word table

// 2006-11-08 K.OHWADA
// proxy server

// 2006-09-20 K.OHWWADA
// error message
// show content with html
// table manage

// 2006-07-08 K.OHWADA
// support podcast
// link exist check

// 2006-06-04 K.OHWADA
// this is new file

//=========================================================
// RSS Center Module
// 2006-06-04 K.OHWADA
//=========================================================
// _LANGCODE: ru
// _CHARSET : cp1251
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

//---------------------------------------------------------
// compatible for v1.0
//---------------------------------------------------------
if (!defined('_RSSC_MAP')) {
    // map
    define('_RSSC_MAP', '����� Google');

    // link table
    define('_RSSC_LINK_ICON', '������');
    define('_RSSC_LINK_GICON_ID', 'ID ������ ���� Google');

    // feed table
    define('_RSSC_FEED_GEO_LAT', '������');
    define('_RSSC_FEED_GEO_LONG', '�������');
    define('_RSSC_FEED_MEDIA_CONTENT_URL', '����� ����������');
    define('_RSSC_FEED_MEDIA_CONTENT_TYPE', '��� ����������');
    define('_RSSC_FEED_MEDIA_CONTENT_MEDIUM', '������� ����������');
    define('_RSSC_FEED_MEDIA_CONTENT_WIDTH', '������ ����������');
    define('_RSSC_FEED_MEDIA_CONTENT_HEIGHT', '������ ����������');
    define('_RSSC_FEED_MEDIA_THUMBNAIL_URL', '����� ���������');
    define('_RSSC_FEED_MEDIA_THUMBNAIL_WIDTH', '������ ���������');
    define('_RSSC_FEED_MEDIA_THUMBNAIL_HEIGHT', '������ ���������');
}

if (!defined('_AM_RSSC_FORM_MAP')) {
    // map
    define('_AM_RSSC_FORM_MAP', '��������� ���� Google');

    // config
    define('_AM_RSSC_CONF_WEBMAP_DIRNAME', '��� ���������� webmap');
    define('_AM_RSSC_CONF_WEBMAP_DIRNAME_DESC', '���������� ��� ���������������� webmap');
    define('_AM_RSSC_CONF_SHOW_INFO_MAX', '������������ ���������� �������� ������� ����������');
    define('_AM_RSSC_CONF_SHOW_INFO_MAX_DSC', 'HTML ���� ���������<br><b>-1</b> ������������');
    define('_AM_RSSC_CONF_SHOW_INFO_WIDTH', '������������ ���������� �������� ������� ���������� � ������');
    define('_AM_RSSC_CONF_SHOW_INFO_WIDTH_DSC', '�������� ����� ������, ����� ������, ��� ��� �����<br><b>-1</b> �� ����������');
    define('_AM_RSSC_CONF_SHOW_ICON', '�������� ������');
    define('_AM_RSSC_CONF_SHOW_ICON_DSC', '����� "��" - �������� ������');
    define('_AM_RSSC_CONF_SHOW_THUMB', '�������� �����������');
    define('_AM_RSSC_CONF_SHOW_THUMB_DSC', '����� "��" - �������� ��������� �����������');

    // link form
    define('_AM_RSSC_LINK_ICON_SEL', '����� ������');
    define('_AM_RSSC_LINK_GICON_SEL', '����� ������ ���� Google');
}

//---------------------------------------------------------
// compatible for v0.8
//---------------------------------------------------------
if (!defined('_RSSC_PLUGIN_LIST')) {
    // plugin list
    define('_RSSC_PLUGIN_LIST', '������ ��������');
    define('_RSSC_PLUGIN_NAME', '��� �������');
    define('_RSSC_PLUGIN_DESCRIPTION', '��������');
    define('_RSSC_PLUGIN_USAGE', '�������������');

    // link table
    define('_RSSC_PRE_PLUGIN', '������ ��������������� ���������');
    define('_RSSC_POST_PLUGIN', '������ ������������� ���������');
}

if (!defined('_AM_RSSC_FORM_HTMLOUT')) {
    // menu
    define('_AM_RSSC_FORM_HTMLOUT', '��������� ������ HTML');
    define(
        '_AM_RSSC_FORM_HTMLOUT_DESC',
        "��� ��������� �����������, ����� '������������ HTML ���� � ����������' - '��'<br>��� ���� ���������, ����� '���' <br>��� ������������� ��� �������� ��� ������ JavaScript � ������, ����� ������������� XSS (������������ �������� ����� - Cross Site Scripting) "
    );
    define('_AM_RSSC_FORM_CUSTOM_PLUGIN', '���������������� �������');

    // html out
    define('_AM_RSSC_CONF_HTML_NON', '��������, ����� �������');
    define('_AM_RSSC_CONF_HTML_SHOW', '�������� � �������� � HTML');
    define('_AM_RSSC_CONF_HTML_REMOVE', '��������');
    define('_AM_RSSC_CONF_HTML_REPLACE', '�������� ������');
    define('_AM_RSSC_CONF_HTML_SCRIPT', '��� �������');
    define('_AM_RSSC_CONF_HTML_SCRIPT_DESC', "��������� '&lt;script&gt;...&lt;/script&gt;' ");
    define('_AM_RSSC_CONF_HTML_STYLE', '��� �����');
    define('_AM_RSSC_CONF_HTML_STYLE_DESC', "��������� '&lt;style&gt;...&lt;/style&gt;' ");
    define('_AM_RSSC_CONF_HTML_LINK', '��� ������');
    define('_AM_RSSC_CONF_HTML_LINK_DESC', "��������� '&lt;link ... &gt;' ");
    define('_AM_RSSC_CONF_HTML_COMMENT', '����� �����������');
    define('_AM_RSSC_CONF_HTML_COMMENT_DESC', "��������� '&lt;!-- ... --&gt;' ");
    define('_AM_RSSC_CONF_HTML_CDATA', '����� CDATA');
    define('_AM_RSSC_CONF_HTML_CDATA_DESC', "��������� '&lt;![CDATA[ ... ]]&gt;' ");
    define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE', '�������� onMouse');
    define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE_DESC', "��������� 'onmouseover=\"...\"' ��� 'onclick=\"...\"' <br>�������� ��� 'on_mouseover_=\"...\"', ����� '��������' ");
    define('_AM_RSSC_CONF_HTML_ATTR_STYLE', '�������� �����');
    define('_AM_RSSC_CONF_HTML_ATTR_STYLE_DESC', "��������� 'style=\"...\"' ��� 'class=\"...\"' <br>�������� ��� 'style_=\"...\"', ����� '��������' ");
    define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS', '������� ������ ����');
    define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS_DESC', "������� ��� ��� '&lt;img ... &gt;' '&lt;a ... &gt;' '&lt;link ... &gt;' �.�. ");
    define('_AM_RSSC_CONF_HTML_OTHER_TAGS', '����������� ����');
    define('_AM_RSSC_CONF_HTML_OTHER_TAGS_DESC', "��������� ��� �� ��������, ����� 'R������� ������ ����' - '��' <br> ������: &lt;img&gt;&lt;a&gt; ");
    define('_AM_RSSC_CONF_HTML_JAVASCRIPT', '������ JavaScriprt');
    define('_AM_RSSC_CONF_HTML_JAVASCRIPT_DESC', "��������� ����� 'JavaScriprt' <br>���������� �� 'java_script', ����� '��������' ");

    // plugin
    define('_AM_RSSC_PRE_PLUGIN_DESC', '��������� ����� ����������� � ���� ������');
    define('_AM_RSSC_POST_PLUGIN_DESC', '��������� ����� ������ � ���� ������');
    define('_AM_RSSC_PLUGIN_DESC_2', '��������� ������ � ������� <b>|</b>, ����� ����������� ��� ��� ����� �������� ');

    define('_AM_RSSC_PLUGIN_TEST', '���� ��� ��������');
    define('_AM_RSSC_PLUGIN', '�������');
    define('_AM_RSSC_PLUGIN_TESTDATA', '������ ���������');
    define('_AM_RSSC_PLUGIN_TESTDATA_DESC', '������� ����� �������������� �������');
}

//---------------------------------------------------------
// compatible for v0.7
//---------------------------------------------------------
if (!defined('_RSSC_LINK_ENCLOSURE')) {
    // link table
    define('_RSSC_LINK_ENCLOSURE', '������������ ���������� ����');
    define('_RSSC_LINK_ENCLOSURE_NON', '�� ������������');
    define('_RSSC_LINK_ENCLOSURE_POD', '��������� �������');
    define('_RSSC_LINK_CENSOR', '������ ������� ����� � ���������');
    define('_RSSC_LINK_PLUGIN', '������');

    // black & white table
    define('_RSSC_BW_CACHE', '��� �������� ������');
    define('_RSSC_BW_CTIME', '����� ���� �������� ������');

    // keyword manage
    define('_RSSC_KEYWORD', '�������� �����');
}

if (!defined('_AM_RSSC_CONF_SHOW_MODE_DATE')) {
    // config
    define('_AM_RSSC_CONF_SHOW_MODE_DATE', '����� ����');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_NON', '�� ����������');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT', '��������');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE', '�������');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_LONG', '�������');
    define('_AM_RSSC_CONF_SHOW_SITE', '���������� � �����');
    define('_AM_RSSC_CONF_SHOW_SITE_DSC', '����� "��", ���������� ��������� ����� � �����');

    // link table
    define('_AM_RSSC_LINK_CENSOR_DESC', '��������� ������ � ������� <b>|</b><br>������������� � ��������');
}

//---------------------------------------------------------
// compatible for v0.6
//---------------------------------------------------------
if (!defined('_RSSC_WORD_ID')) {
    // word table
    define('_RSSC_WORD_ID', 'ID �����');
    define('_RSSC_WORD_WORD', '����������� �����');
    define('_RSSC_WORD_POINT', '�����');
    define('_RSSC_ACT', '������');
    define('_RSSC_ACT_NON', '��������');
    define('_RSSC_ACT_ACT', '������');
    define('_RSSC_REG', '��������� ������');
    define('_RSSC_REG_NORMAL', '����������');
    define('_RSSC_REG_EXP', '���������� ���������');
    define('_RSSC_FREQ_COUNT', '������� ����������������');

    // feed table
    define('_RSSC_FEED_ACT', '������');
    define('_RSSC_FEED_ACT_NON', '�� ����������');
    define('_RSSC_FEED_ACT_VIEW', '����������');

    // link table
    define('_RSSC_LTYPE_NON', '��� ����������� �������');
    define('_RSSC_LTYPE_SEARCH', '����� �� �����');
    define('_RSSC_LTYPE_NORMAL', '����������');

    define('_RSSC_XML_URL', '����� RDF/RSS/ATOM');
}

if (!defined('_AM_RSSC_LIST_WORD')) {
    // word_list
    define('_AM_RSSC_LIST_WORD', '������ ����������� ����');
    define('_AM_RSSC_WORD_MANAGE', '���������� ������������ �������');
    define('_AM_RSSC_ADD_WORD', '�������� ����������� �����');
    define('_AM_RSSC_MOD_WORD', '�������� ����������� �����');
    define('_AM_RSSC_DEL_WORD', '������� ����������� �����');
    define('_AM_RSSC_POINT_ASC', '����� ����� ����������');
    define('_AM_RSSC_POINT_DESC', '������� ����� ����������');
    define('_AM_RSSC_COUNT_ASC', '����� ������� ���������������� ����������');
    define('_AM_RSSC_COUNT_DESC', '������� ������� ���������������� ����������');
    define('_AM_RSSC_WORD_ASC', '�-� ����������');
    define('_AM_RSSC_WORD_DESC', '�-� ����������');
    define('_AM_RSSC_NON_ACT', '��� ������ ������');
    define('_AM_RSSC_NON_ACT_ASC', '��� ���������� ID �� �����������');
    define('_AM_RSSC_NON_ACT_DESC', '��� ���������� ID �� ��������');
    define('_AM_RSSC_WORD_ALREADY', '��� ����� ��� ����������������');
    define('_AM_RSSC_WORD_SEARCH', '���������� �����');

    // content filter
    define('_AM_RSSC_FORM_FILTER', '��������� �������');
    define('_AM_RSSC_FORM_FILTER_DESC', '���� ������ ������� ������� ��� ��� ������ � ���� ������ ��� �������������� �����');
    define('_AM_RSSC_CONF_LINK_USE', '������������ ������� ������');
    define('_AM_RSSC_CONF_LINK_USE_DESC', '���������, ����� "���" ������� ������ "����������"');
    define('_AM_RSSC_CONF_WHITE_USE', '������������ ����� ������');
    define('_AM_RSSC_CONF_WHITE_USE_DESC', '���������, ����� � ����� ������');
    define('_AM_RSSC_CONF_BLACK_USE', '������������ ������ ������');
    define('_AM_RSSC_CONF_BLACK_USE_DESC', '�� ���������, ����� � ������ ������<br>����� ������� "������������", ����������� ������� ����������, ���� ������� ������<br>����� ������� "��������", ���������� ������� ����������, � ����� ���������� ����, ���� ������� ������');
    define('_AM_RSSC_CONF_BLACK_USE_NO', '�� ������������');
    define('_AM_RSSC_CONF_BLACK_USE_YES', '������������');
    define('_AM_RSSC_CONF_BLACK_USE_LEARN', '��������');
    define('_AM_RSSC_CONF_WORD_USE', '������������ ������ ����������� ����');
    define('_AM_RSSC_CONF_WORD_USE_DESC', '�� ���������, ����� ����� ����� ������ ���� ��������� ������� ����������');
    define('_AM_RSSC_CONF_WORD_LEVEL', '������� ����������');
    define('_AM_RSSC_CONF_FEED_SAVE', '���������� ������');
    define('_AM_RSSC_CONF_FEED_SAVE_DESC', '��������� ��� ��� � ������� �������, ����� ��������� ������.<br>����� "���������", ����������� � ������� "�� ����������".');
    define('_AM_RSSC_CONF_FEED_SAVE_NO', '�� ���������');
    define('_AM_RSSC_CONF_FEED_SAVE_YES', '���������');
    define('_AM_RSSC_CONF_LOG_USE', '������������ ���� �������');
    define('_AM_RSSC_CONF_LOG_USE_DESC', '���������� ���� �������, ����� ��������� ������');
    define('_AM_RSSC_CONF_WHITE_COUNT', '������������ ����� ������');
    define('_AM_RSSC_CONF_WHITE_COUNT_DESC', '������������ ����������� ������, ����� ������������� ������ ������');
    define('_AM_RSSC_CONF_BLACK_COUNT', '������������ ������ ������');
    define('_AM_RSSC_CONF_BLACK_COUNT_DESC', '������������ ����������� ������, ����� ������������� ������� ������');
    define('_AM_RSSC_CONF_WORD_COUNT', '������������ ������ ����������� ����');
    define('_AM_RSSC_CONF_WORD_COUNT_DESC', '������������ ����������� ������, ����� ������������� ������ ����������� ����');
    define('_AM_RSSC_CONF_BLACK_AUTO', '��������� � ������ ������');
    define('_AM_RSSC_CONF_BLACK_AUTO_DESC', '��������� ����� � ������ �������������������, ����� ��������� ������<br><b>�����������</b> "������" �������� ��� "����������������"<br>����������, �������� �� "��������������" ��� �������������');
    define('_AM_RSSC_CONF_WORD_AUTO', '��������� � ������ ����������� ����');
    define('_AM_RSSC_CONF_WORD_AUTO_DESC', '���������� ���� � ���������� ������������� � ���������� ���� � ������ ����������� ���� �������������, ����� ��������� ������<br><b>�����������</b> "�����" �������� ��� ����<br>����������, �������� "�����" ��� ��������������');
    define('_AM_RSSC_CONF_WORD_AUTO_NON', '�� ���������');
    define('_AM_RSSC_CONF_WORD_AUTO_SYMBOL', '���������� �� ������� ��� �������');
    define('_AM_RSSC_CONF_WORD_AUTO_KAKASI', '���������� KAKASI: ������ �� �������� �����');

    // word extract
    define('_AM_RSSC_FORM_WORD', '��������� ���������� ����');
    define('_AM_RSSC_CONF_JOIN_PREV', '����������� ����');
    define('_AM_RSSC_CONF_JOIN_PREV_DESC', '�������������� ������ � �������� ����� � ������� ������');
    define('_AM_RSSC_CONF_JOIN_GLUE', '���������� ����');
    define('_AM_RSSC_CONF_JOIN_GLUE_DESC', '� ���������� ���������� ������<br>� �������� ������ �� ��������������');
    define('_AM_RSSC_CONF_KAKASI_PATH', '���� � �������� KAKASI');
    define('_AM_RSSC_CONF_KAKASI_MODE', '����� KAKASI');
    define('_AM_RSSC_CONF_KAKASI_MODE_FILE', '������������ ��������� ����');
    define('_AM_RSSC_CONF_KAKASI_MODE_PIPE', '������������ ����� UNIX');
    define('_AM_RSSC_CONF_CHAR_LENGTH', '����������� ���������� ��������');
    define('_AM_RSSC_CONF_CHAR_LENGTH_DESC', '����������� ���������� �������� ��� ���������� �����');
    define('_AM_RSSC_CONF_WORD_LIMIT', '������������ ���������� ����������� ����');
    define('_AM_RSSC_CONF_WORD_LIMIT_DESC', '������� ������������ ����� ���� �������� � ������� ����<br>��������� ������ ������, ����� ���������� ���������� ������, ��� ��� ��������<br><b>0</b> ������������');
    define('_AM_RSSC_KAKASI_EXECUTABLE', 'kakasi ����������');
    define('_AM_RSSC_KAKASI_NOT_EXECUTABLE', 'kakasi �� ����������');
    define('_AM_RSSC_CONF_HTML_GET', '�������� HTML');
    define('_AM_RSSC_CONF_HTML_GET_DESC', '�������� ������ ������������� HTML �������������, ����� ��������� ������� ����������� ����<br>����� ������� "������������", �������� ������� ���������� , �� ����� ���������� ���������� ������');
    define('_AM_RSSC_CONF_HTML_GET_NO', '�� ������������');
    define('_AM_RSSC_CONF_HTML_GET_YES', '������������');
    define('_AM_RSSC_CONF_HTML_GET_BLACK', '������������, ����� ��������� ������');
    define('_AM_RSSC_CONF_HTML_LIMIT', '������������ ���������� �������� HTML');
    define('_AM_RSSC_CONF_HTML_LIMIT_DESC', '������������ ���������� �������� HTML, ������� ���������� �������������<br>�� ��������� ������, HTML ������ �������, � ����� ���������� ���������� ������');

    // archive manage
    define('_AM_RSSC_LEAN_BLACK', '�������� � ������ ������');
    define('_AM_RSSC_LEAN_BLACK_DESC', '�������������� ������� ������, � ����� ���������� ���� � ���������� ������������� � ���������� ���� � ������ ����������� ���� �������������');
    define('_AM_RSSC_NUM_FEED_ALL', '����� ���� �������');
    define('_AM_RSSC_NUM_FEED_SKIP', '����� ��� ����������� �������');
    define('_AM_RSSC_NUM_FEED_REJECT', '����� �������, ����������� �������');

    define('_AM_RSSC_THEREARE_TITLE', '� ��������� <b>%s</b> ������������ <b>%s</b>');
}

//---------------------------------------------------------
// compatible for v0.4
//---------------------------------------------------------
if (!defined('_AM_RSSC_FORM_PROXY')) {
    // proxy server
    define('_AM_RSSC_FORM_PROXY', '������������ ������ �������');
    define('_AM_RSSC_CONF_PROXY_USE', '������������ ������ ������');
    define('_AM_RSSC_CONF_PROXY_HOST', '������ ������');
    define('_AM_RSSC_CONF_PROXY_PORT', '������ ����');
    define('_AM_RSSC_CONF_PROXY_USER', '������ ��� ������������');
    define('_AM_RSSC_CONF_PROXY_USER_DESC', '������� ��� ������������, ���� ��� ������ ������ ������� ������� �������� �����������, <br>� ��������� ������, ������� ������');
    define('_AM_RSSC_CONF_PROXY_PASS', '������ ������');
    define('_AM_RSSC_CONF_PROXY_PASS_DESC', '������� ������, ���� ��� ������ ������ ������� ������� �������� �����������, <br>� ��������� ������, ������� ������');

    define('_AM_RSSC_CONF_HIGHLIGHT', '������������ ��������� �������� ����');
}

//---------------------------------------------------------
// compatible for v0.3
//---------------------------------------------------------
if (!defined('_RSSC_DB_ERROR')) {
    // error message
    define('_RSSC_DB_ERROR', '������ ���� ������ RSSC');
    define('_RSSC_DISCOVER_SUCCEEDED', '��������������� RSS �������');
    define('_RSSC_DISCOVER_FAILED', '��������������� RSS ��������');
    define('_RSSC_PARSE_MSG', '��������� �������������� RSS');
    define('_RSSC_PARSE_FAILED', '��������� �������������� RSS');
    define('_RSSC_PARSE_NOT_READ_XML_URL', '��������� �������������� RSS: �� �������� ����� RSS');
    define('_RSSC_PARSE_NOT_FIND_ENCODING', '��������� �������������� RSS: �� ������� ���������');
    define('_RSSC_REFRESH_ERROR', '������ ���������� RSS');
    define('_RSSC_LINK_NOT_EXIST', '����������� ��������������� ������ � ������ RSSC');
    define('_RSSC_LINK_EXIST_MORE', '������������ ��� ��� ����� ������, ������� ����� ��� �� "����� RDF/RSS/ATOM"');
    define('_RSSC_LINK_ALREADY', '����� ������ ��� ����������, ������� ����� ��� �� "����� RDF/RSS/ATOM"');

    // refresh link
    define('_RSSC_REFRESH_LINK', '���������� RDF/RSS/ATOM �������');
    define('_RSSC_REFRESH_LINK_DSC', '����� ����������� RSS ������ <br>������������ ������ <b>RDF/RSS/ATOM</b> ������������� � ���������� <b>���������</b> �������������, <br>���� ��� �� �����������.');
    define('_RSSC_REFRESH_LINK_FINISHED', '���������� ������� ���������');

    // for other module
    define('_RSSC_RSSC_LID', 'ID ������ ������ RSSC');
    define('_RSSC_RSSC_LID_UPDATE', '���������� ID ������ ������ RSSC');
    define('_RSSC_GOTO_RSSC_ADMIN_LINK', '������� � �������� ����������������� ������ RSSC');
}

if (!defined('_AM_RSSC_CONF_SHOW_TITLE_HTML')) {
    // show content with html
    define('_AM_RSSC_CONF_SHOW_TITLE_HTML', '������������ HTML ���� � ���������');
    define('_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC', '����� ������� "��", ���������� ��������� � ������ HTML, ���� ��������� ����� HTML ����. <br>����� ������� "���", ���������� ��������� � ���������� HTML ������. ');
    define('_AM_RSSC_CONF_SHOW_CONTENT_HTML', '������������ HTML ���� � ����������');
    define('_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC', '����� ������� "��", ���������� ���������� � ������ HTML, ���� ���������� ����� HTML ����. <br>����� ������� "���", ���������� ���������� � ���������� HTML ������. ');
    define('_AM_RSSC_CONF_SHOW_MAX_CONTENT', '������������ ���������� �������� ����������');
    define('_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC', 'HTML ���� ���������, ����� ������, ��� ��� �����<br><b>-1</b> ������������');
    define('_AM_RSSC_CONF_SHOW_NUM_CONTENT', '������������ ���������� RSS/ATOM ������� ������������ ����������');
    define('_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC', '������� ������������ ����� RSS/ATOM ������� ������������ ����������.');
    define('_AM_RSSC_CONF_SHOW_BLOG_LID', 'ID ������ ��� ����������� �����');
    //	define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Enter Link ID to be show blog.');

    define('_AM_RSSC_TABLE_MANAGE', '���������� ��������� ���� ������');
}

//---------------------------------------------------------
// compatible for v0.2
//---------------------------------------------------------
// main
if (!defined('_RSSC_PODCAST')) {
    // bread crumb
    define('_HOME', '�������');

    // podcast
    define('_RSSC_PODCAST', '�������');
    define('_RSSC_ENCLOSURE_URL', '����� ����������');
    define('_RSSC_ENCLOSURE_TYPE', '��� ����������');
    define('_RSSC_ENCLOSURE_LENGTH', '����� ����������');
}

// admin
if (!defined('_AM_RSSC_CONF_INDEX_DESC')) {
    // description at main
    define('_AM_RSSC_CONF_INDEX_DESC', '�������� �� ������� ��������');
    define('_AM_RSSC_CONF_INDEX_DESC_DSC', '������� ��������, ���� �� ������ ����� ��� ������������ �� ������� ��������.');
    define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">����� ��������.<br>�� ������ ������������� �������� � "��������� ������".<br></div><br>');

    // link table
    define('_AM_RSSC_LINK_DESC', '������������ ������ <b>RDF/RSS/ATOM</b> ������������� � ���������� <b>���������</b> �������������, <br>����� �� �� ���������, <br>���� ���� ������������ "RSS ���������������"');
    define('_AM_RSSC_LINK_EXIST', '��� ���������� ���� "����� RDF/RSS/ATOM"');
    define('_AM_RSSC_LINK_EXIST_MORE', '������������ ��� ��� ��������� ������, ������� ����� ��� �� "����� RDF/RSS/ATOM" ');
    define('_AM_RSSC_AUTO_FIND_FAILD', 'RSS ��������������� ��������');
    define('_AM_RSSC_LINK_FORCE', '�������������� ����������');

    // black & white table
    define('_AM_RSSC_BLACK_MEMO', '�������');
}

//---------------------------------------------------------
// compatible for v0.1
//---------------------------------------------------------
// main
if (!defined('_RSSC_SINGLE_LINK')) {
    // single link
    define('_RSSC_SINGLE_LINK', '��������� ������');
    define('_RSSC_SINGLE_LINK_UTF8', '��������� ������ � ��������� UTF-8');
    define('_RSSC_SINGLE_SUMMARY', '��������');
    define('_RSSC_SINGLE_CONTENT', '���������� ��������� HTML ����');
    define('_RSSC_UTF8_SUMMARY', '�������� � UTF-8');
    define('_RSSC_UTF8_CONTENT', '���������� ��������� HTML ���� � UTF-8');

    // detect encoding
    define('_RSSC_ASSUME_ENCODING', '������������ xml ����������� %s ,<br>������ ��� ���������� ���������� ��������� �������������');

    // rss item
    define('_RSSC_CREATED', '���������');
    define('_RSSC_ATOM_CONTRIBUTOR_NAME', '��������');
    define('_RSSC_ATOM_CONTRIBUTOR_URI', '����� ���������');
    define('_RSSC_ATOM_CONTRIBUTOR_EMAIL', '����������� ����� ���������');

    // no data
    define('_RSSC_NO_HEADLINK', '������������ �� ��������� ��������� ������');
    define('_RSSC_NO_FEED', '����������� ������ ������');
}

// admin
if (!defined('_AM_RSSC_PARSE_RSS')) {
    // build rss
    //	define('_AM_RSSC_BUILD', 'Build RDF/RSS/ATOM');
    define('_AM_RSSC_BUILD_DSC', '������� � �������� RDF/RSS/ATOM ��� �������');
    //	define('_AM_RSSC_BUILD_RDF',  'Build RDF');
    //	define('_AM_RSSC_BUILD_RSS',  'Build RSS');
    //	define('_AM_RSSC_BUILD_ATOM', 'Build ATOM');

    // parse rss
    define('_AM_RSSC_PARSE_RSS', '������������� RDF/RSS/ATOM');

    // refresh link
    define('_AM_RSSC_REFRESH_LINK', '�������� RDF/RSS/ATOM ������');
    define('_AM_RSSC_REFRESH_LINK_DSC', '����� ����������� RSS ������ <br>������������ ����� RSS ������������� � ���������� ��������� RSS �������������, <br>���� ��� �� �����������.');
    define('_AM_RSSC_REFRESH_LINK_FINISHED', '���������� ������� ���������');
}

// execution
if (!defined('_RSSC_EXECUTION_TIME')) {
    define('_RSSC_EXECUTION_TIME', '����� ����������');
    define('_RSSC_MEMORY_USAGE', '������������� ������');
    define('_RSSC_SEC', '���');
    define('_RSSC_MB', '��');
}

// other
if (!defined('_RSSC_IN')) {
    define('_RSSC_IN', '�');
    define('_RSSC_MAP_LOADING', '�������� ...');
}
