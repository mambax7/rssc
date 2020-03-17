<?php

// $Id: admin.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

// 2008-01-10 K.OHWADA
// double definition : _AM_RSSC_CONF_BLACK_USE_DESC

// 2007-12-09 K.OHWADA
// remove _AM_RSSC_CREATE_CONFIG

// 2007-10-10 K.OHWADA
// censor in link table

// 2007-07-01 K.OHWADA
// word list, content filter

// 2006-11-08 K.OHWADA
// proxy server

// 2006-09-20 K.OHWWADA
// show content with html
// table manage

// 2006-07-08 K.OHWWADA
// description at main

// 2006-06-04 K.OHWADA
// _AM_RSSC_BUILD, etc

// 2006-01-20 K.OHWADA
// _AM_RSSC_ID_ASC

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
// _LANGCODE: ru
// _CHARSET : cp1251
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

// --- define language begin ---
if (!defined('RSSC_LANG_AM_LOADED')) {
    define('RSSC_LANG_AM_LOADED', 1);

    // === menu ===
    define('_AM_RSSC_CONF', '���������� RSS �������');
    define('_AM_RSSC_LIST_LINK', '������ ������');
    define('_AM_RSSC_LIST_BLACK', '������ ������� ������');
    define('_AM_RSSC_LIST_WHITE', '������ ������ ������');
    define('_AM_RSSC_LIST_FEED', '������ �������');
    define('_AM_RSSC_ADD_LINK', '�������� ������');
    define('_AM_RSSC_ADD_BLACK', '�������� ������ ������');
    define('_AM_RSSC_ADD_WHITE', '�������� ����� ������');
    define('_AM_RSSC_ADD_KEYWORD', '�������� �������� �����');
    define('_AM_RSSC_ARCHIVE_MANAGE', '���������� �������');

    //define('_AM_RSSC_COMMAND_MANAGE', 'Command Management');

    define('_AM_RSSC_UPDATE_MANAGE', '���������� ��������');
    define('_AM_RSSC_VIEW_RSS', '�������� RDF/RSS/ATOM');

    //define('_AM_RSSC_GOTO_MODULE', 'Goto Module');

    // === index & config ===
    define('_AM_RSSC_FORM_BASIC', '�������� ������������');
    define('_AM_RSSC_FORM_BASIC_DESC', '������������ ����� ��� ���� �������');
    define('_AM_RSSC_FORM_MAIN', '������������ ��������� ������� ��������');
    define('_AM_RSSC_FORM_MAIN_DESC', '������������ �� ������� �������� ����� ������');
    define('_AM_RSSC_FORM_BLOCK', '������������ ��������� ������');
    define('_AM_RSSC_FORM_BLOCK_DESC', '������������ � ������ ����� ������');

    //define('_AM_RSSC_FORM_BIN', 'Command Config');
    //define('_AM_RSSC_FORM_BIN_DESC', 'It is used on bin command');
    //define('_AM_RSSC_INIT_NOT','The config table is not initialized');
    //define('_AM_RSSC_INIT_EXEC','Initialized the config table');
    //define('_AM_RSSC_VERSION_NOT','It is not version  %s');
    //define('_AM_RSSC_UPGRADE_EXEC','Upgrade the config table');
    //define('_AM_RSSC_WARNING_NOT_WRITABLE','Not writable the directory');
    //define('_AM_RSSC_CONF_NAME','Item');

    define('_AM_RSSC_DBUPDATED', '���� ������ ��������� �������!');
    define('_AM_RSSC_FAILUPDATE', '������ ���������� ������ � ���� ������');
    define('_AM_RSSC_FAILDELETE', '������ �������� ������ �� ���� ������');
    define('_AM_RSSC_THERE_ARE_LINKS', '������������ <b>%s</b> ������ � ���� ������');
    define('_AM_RSSC_THERE_ARE_FEEDS', '������������ <b>%s</b> ������� � ���� ������');

    // === link manage ===
    define('_AM_RSSC_LINK_MANAGE', '���������� ��������');
    define('_AM_RSSC_MOD_LINK', '�������� ������');
    define('_AM_RSSC_DEL_LINK', '������� ������');
    define('_AM_RSSC_SHOW_RSS', '�������� RSS');
    define('_AM_RSSC_SHOW_FEED', '�������� �����');
    define('_AM_RSSC_FEED_BELONG_LINK', '�������� ������, ������������� ���� ������');
    define('_AM_RSSC_ERROR_FILL', '������: ������� %s');
    define('_AM_RSSC_ERROR_ILLEGAL', '������: ������������ %s');

    // === black list manage ===
    define('_AM_RSSC_BLACK_MANAGE', '���������� ������ �������');
    define('_AM_RSSC_MOD_BLACK', '�������� ������ ������');
    define('_AM_RSSC_DEL_BLACK', '������� ������ ������');
    define('_AM_RSSC_FEED_MATCH_LINK', '�������� ������, ������� ������������� ����� ������');

    // === white list manage ===
    define('_AM_RSSC_WHITE_MANAGE', '���������� ����� �������');
    define('_AM_RSSC_MOD_WHITE', '�������� ����� ������');
    define('_AM_RSSC_DEL_WHITE', '������� ����� ������');

    // === feed list manage ===
    define('_AM_RSSC_ADD_FEED', '�������� �����');
    define('_AM_RSSC_MOD_FEED', '�������� �����');
    define('_AM_RSSC_DEL_FEED', '������� �����');
    define('_AM_RSSC_THERE_ARE_MATCH', '������������ <b>%s</b>  ������, ������� ������������� ��������');
    define('_AM_RSSC_CONDITION', '�������');

    // === archive manage ===
    define('_AM_RSSC_REFRESH', '�������� �����');
    define('_AM_RSSC_REFRESH_NEXT', '��������� ��������� %s');
    define('_AM_RSSC_LINK_LIMIT', '������ ������');
    define('_AM_RSSC_LINK_OFFSET', '�������� ������');
    define('_AM_RSSC_FEED_CLEAR', '�������� �����');
    define('_AM_RSSC_FEED_CLEAR_OLD', '������� ������ ������');
    define('_AM_RSSC_FEED_CLEAR_NUM', '������� ������ ������, ���� ��� ���������� ������, ��� �������� �����');

    // refresh result
    define('_AM_RSSC_NO_REFRESH', '��� ������ ��� ����������');
    define('_AM_RSSC_TIME_START', '��������� �����');
    define('_AM_RSSC_TIME_END', '�������� �����');
    define('_AM_RSSC_TIME_ELAPSE', '����������� �����');
    define('_AM_RSSC_MIN_SEC', '%s ��� %s ���');
    define('_AM_RSSC_NUM_LINK_TOTAL', '����� ������');
    define('_AM_RSSC_NUM_LINK_TARGET', '���������� ������� ������');
    define('_AM_RSSC_NUM_LINK_BROKEN', '���������� ������������ ������');
    define('_AM_RSSC_NUM_LINK_UPDATED', '���������� ����������� ������');
    define('_AM_RSSC_NUM_FEED_UPDATED', '���������� ����������� �������');
    define('_AM_RSSC_NUM_FEED_CLEARED', '���������� ��������� �������');
    define('_AM_RSSC_NUM_LINKS', '������');
    define('_AM_RSSC_NUM_FEEDS', '������');
    define('_AM_RSSC_FAILGET', '���������� �������� XML �� %s');
    define('_AM_RSSC_GOTOTOP', '������� �����');

    // === configuration ===
    // basic configuration
    define('_AM_RSSC_CONF_FEED_LIMIT', '������������ ���������� �������');
    define('_AM_RSSC_CONF_FEED_LIMIT_DESC', '������� ������������ ���������� �������, ����������� � ������� �������<br>��������� ������ ������, ����� ��� ���������� ������, ��� ��� ��������<br><b>0</b> ������������');
    define('_AM_RSSC_CONF_RSS_ATOM', '����� RSS ��� ATOM');
    define('_AM_RSSC_CONF_RSS_ATOM_DESC', '������� RSS ��� ATOM, ����� ��� ������ RSS � ATOM ����������');
    define('_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM', 'ATOM');
    define('_AM_RSSC_CONF_RSS_ATOM_SEL_RSS', 'RSS');
    define('_AM_RSSC_CONF_RSS_PARSER', '����� RSS �����������');
    define('_AM_RSSC_CONF_RSS_PARSER_SELF', 'RSSC ����������');
    define('_AM_RSSC_CONF_RSS_PARSER_XOOPS', 'XOOPS RSS ����������');
    define('_AM_RSSC_CONF_ATOM_PARSER', '����� ATOM �����������');
    define('_AM_RSSC_CONF_ATOM_PARSER_0', 'RSSC ����������');
    define('_AM_RSSC_CONF_ATOM_PARSER_1', '');
    define('_AM_RSSC_CONF_RSS_MODE', '��������� �������� RSS ������');
    define('_AM_RSSC_CONF_XML_SAVE', '��������� XML');
    define('_AM_RSSC_CONF_XML_SAVE_DESC', '��������� ���������� XML � ������� ������');
    define('_AM_RSSC_CONF_FUTURE_DAYS', '������� ���');
    define('_AM_RSSC_CONF_FUTURE_DAYS_DESC', '���������� ����<br>�� ���������� �����, ���� ���� ������� ������, ��� ��� ���');

    // show configuration
    define('_AM_RSSC_CONF_SHOW_ORDER', '������� ������');
    //define('_AM_RSSC_CONF_SHOW_ORDER_DESC','');
    define('_AM_RSSC_CONF_SHOW_ORDER_UPDATED', '��������� ����������');
    define('_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED', '��������� ��������������');
    define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE', '������ �� ��������');
    //define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC','');
    define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE', '������� �� ��������');
    //define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC','');
    define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK', '������� �� ������');
    //define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK_DESC','');
    define('_AM_RSSC_CONF_SHOW_MAX_TITLE', '������������ ���������� �������� � ���������');
    define('_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC', 'HTML ���� ���������, ����� ������ ����� �����<br><b>-1</b> ������������');
    define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY', '������������ ���������� �������� � ��������');
    define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC', '<b>-1</b> ������������');

    // main configuration
    define('_AM_RSSC_CONF_MAIN_SEARCH_MIN', '����������� ���������� �������� � �������� ������ ������');
    //define('_AM_RSSC_CONF_MAIN_SEARCH_MIN_DESC','');

    // bin configuration
    //define('_AM_RSSC_CONF_BIN_PASS','Password');
    //define('_AM_RSSC_CONF_BIN_PASS_DESC','');
    //define('_AM_RSSC_CONF_BIN_SEND','Send Mail');
    //define('_AM_RSSC_CONF_BIN_SEND_DESC','');
    //define('_AM_RSSC_CONF_BIN_MAILTO','Email to send');
    //define('_AM_RSSC_CONF_BIN_MAILTO_DESC','');

    // === view rss ===
    define('_AM_RSSC_VIEW_RSS_OPTION', '��������� ����������');
    define('_AM_RSSC_NOT_SELECT_LINK', '������ �� �������');
    define('_AM_RSSC_PLEASE_SELECT_LINK', '�������� �� ������ ������ ��� ������� ID ������');
    define('_AM_RSSC_VIEW_PARSER', '��������� �����������');
    define('_AM_RSSC_VIEW_SAVE_ETC', '��������� � �������, � �.�.');
    define('_AM_RSSC_VIEW_MODE', '����� ���������');
    define('_AM_RSSC_VIEW_MODE_DESC', '�� ��������� � �������, ����� ����� 0');
    define('_AM_RSSC_VIEW_MODE_CURRENT', '����� 0: ��������� XML ������');
    define('_AM_RSSC_VIEW_MODE_LINK', '����� 1: XML ������, ����������� � ������� ������');
    define('_AM_RSSC_VIEW_MODE_FEED', '����� 2: ������, ����������� � ������� ������');
    define('_AM_RSSC_VIEW_SANITIZE', 'HTML �������');
    define('_AM_RSSC_VIEW_TITLE_HTML', '���������� HTML ���� � ���������');
    define('_AM_RSSC_VIEW_TITLE_HTML_DESC', '����� ������� ��, ���������� ��� ��� HTML ����. <br>����� ������� ���, ���������� ��� ����� �������� HTML �����. ');
    define('_AM_RSSC_VIEW_CONTENT_HTML', '���������� HTML ���� � ����������');
    define('_AM_RSSC_VIEW_CONTENT_HTML_DESC', '����� ������� ��, ���������� ��� ��� HTML ����. <br>����� ������� ���, ���������� ��� ����� �������� HTML �����. ');
    define('_AM_RSSC_VIEW_MAX_CONTENT', '������������ ���������� �������� � ����������');
    define('_AM_RSSC_VIEW_MAX_CONTENT_DESC', 'HTML ����� �������, ����� ������, ��� ��� �����<br><b>-1</b> ������������');
    define('_AM_RSSC_VIEW_LINK_UPDATE', '���������� ������� ������');
    define('_AM_RSSC_VIEW_FEED_UPDATE', '���������� ������� ������');
    define('_AM_RSSC_VIEW_FORCE_DISCOVER', '������������� ���������� ����� RSS');
    define('_AM_RSSC_VIEW_FORCE_DISCOVER_DESC', '������������ ����� RDF/RSS/ATOM, ����� ����������� ����� ������ �� ���������� � ������� RSS');
    define('_AM_RSSC_VIEW_FORCE_UPDATE', '������������� �������� �����');
    define('_AM_RSSC_VIEW_FORCE_UPDATE_DESC', '�������������� �����, ����� ��������� RDF/RSS/ATOM �� ���������� � ���������� ����������');
    define('_AM_RSSC_VIEW_FORCE_OVERWRITE', '������������� ��������� ������� ������');
    define('_AM_RSSC_VIEW_FORCE_OVERWRITE_DESC', '�������������� ������� ������, ���� ���� ���� �� �� ������ �� ������ RDF/RSS/ATOM');
    define('_AM_RSSC_VIEW_PRINT_LOG', '�������� ������');
    define('_AM_RSSC_VIEW_PRINT_LOG_DESC', '�������� ������� ������������ �� ����� ����������');
    define('_AM_RSSC_VIEW_PRINT_ERROR', '�������� ������');
    define('_AM_RSSC_VIEW_PRINT_ERROR_DESC', '�������� ������ ������������ �� ����� ����������');

    // === command manage ===
    //define('_AM_RSSC_CREATE_CONFIG', 'Create Config File');
    //define('_AM_RSSC_TEST_BIN_REFRESH', 'Test to execute bin/refresh.php');

    // === update manage ===
    define('_AM_RSSC_IMPORT_XOOPSHEADLINE', '������ �� XoopsHeadline');
    define('_AM_RSSC_IMPORT_WEBLINKS', '������ �� WebLinks');

    // === rename ===
    define('_AM_RSSC_VIEW_FEED_PERPAGE', _AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE);
    define('_AM_RSSC_VIEW_MAX_TITLE', _AM_RSSC_CONF_SHOW_MAX_TITLE);
    define('_AM_RSSC_VIEW_MAX_TITLE_DESC', _AM_RSSC_CONF_SHOW_MAX_TITLE_DESC);
    define('_AM_RSSC_VIEW_MAX_SUMMARY', _AM_RSSC_CONF_SHOW_MAX_SUMMARY);
    define('_AM_RSSC_VIEW_MAX_SUMMARY_DESC', _AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC);
    define('_AM_RSSC_VIEW_XML_SAVE', _AM_RSSC_CONF_XML_SAVE);
    define('_AM_RSSC_VIEW_XML_SAVE_DESC', _AM_RSSC_CONF_XML_SAVE_DESC);

    // 2006-01-20
    define('_AM_RSSC_ID_ASC', 'ID �� �����������');
    define('_AM_RSSC_ID_DESC', 'ID �� ��������');

    // === 2006-06-04 ===
    // build rss
    //define('_AM_RSSC_BUILD', 'Build RDF/RSS/ATOM');
    //define('_AM_RSSC_BUILD_DSC',  'Build and show RDF/RSS/ATOM for debug');
    //define('_AM_RSSC_BUILD_RDF',  'Build RDF');
    //define('_AM_RSSC_BUILD_RSS',  'Build RSS');
    //define('_AM_RSSC_BUILD_ATOM', 'Build ATOM');

    // parse rss
    define('_AM_RSSC_PARSE_RSS', '������������� RDF/RSS/ATOM');

    // refresh link
    //define('_AM_RSSC_REFRESH_LINK', 'Refresh RDF/RSS/ATOM feeds');
    //define('_AM_RSSC_REFRESH_LINK_DSC', 'Then, refresh RSS feeds <br>Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br>if they are not set up.');
    //define('_AM_RSSC_REFRESH_LINK_FINISHED', 'Refresh feeds finished');

    // === 2006-07-08 ===
    // description at main
    define('_AM_RSSC_CONF_INDEX_DESC', '�������� �� ������� ��������');
    define('_AM_RSSC_CONF_INDEX_DESC_DSC', '������� ��������, ���� �� ������ ����� ��� ������������ �� ������� ��������.');
    define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">����� ��������.<br>�� ������ ������������� �������� � "��������� ������".<br></div><br>');

    // link table
    define('_AM_RSSC_LINK_DESC', '������������ ������ <b>RDF/RSS/ATOM</b> ������������� � ���������� <b>���������</b> �������������, <br>����� �� �� ���������, <br>���� ���� ������������ "RSS ���������������"');
    //define('_AM_RSSC_LINK_EXIST', 'Already exists this "RDF/RSS/ATOM URL"');
    //define('_AM_RSSC_LINK_EXIST_MORE','There are twe or more links which have same "RDF/RSS/ATOM URL" ');
    //define('_AM_RSSC_AUTO_FIND_FAILD','RSS Auto Discovery Faild');
    define('_AM_RSSC_LINK_FORCE', '�������������� ����������');

    // black & white table
    define('_AM_RSSC_BLACK_MEMO', '�������');

    // === 2006-09-20 ===
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
    //define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Enter Link ID to be show blog.');

    define('_AM_RSSC_TABLE_MANAGE', '���������� ��������� ���� ������');

    // === 2006-11-08 ===
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

    // === 2007-06-01 ===
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
    //define('_AM_RSSC_CONF_BLACK_USE_DESC','Not store when in black list');
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

    // === 2007-10-10 ===
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

    // === 2008-01-20 ===
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

    // === 2009-02-20 ===
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
// --- define language begin ---
