<?php

// $Id: admin.php,v 1.4 2012/04/08 23:42:20 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

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
// ͭ����������
//=========================================================

// --- define language begin ---
if (!defined('RSSC_LANG_AM_LOADED')) {
    define('RSSC_LANG_AM_LOADED', 1);

    // === menu ===
    define('_AM_RSSC_CONF', 'RSS���󥿡�����');
    define('_AM_RSSC_LIST_LINK', '��󥯰���');
    define('_AM_RSSC_LIST_BLACK', '�֥�å��ꥹ�Ȱ���');
    define('_AM_RSSC_LIST_WHITE', '�ۥ磻�ȥꥹ�Ȱ���');
    define('_AM_RSSC_LIST_FEED', 'feed����');
    define('_AM_RSSC_ADD_LINK', '��󥯤��ɲ�');
    define('_AM_RSSC_ADD_BLACK', '�֥�å��ꥹ�Ȥ��ɲ�');
    define('_AM_RSSC_ADD_WHITE', '�ۥ磻�ȥꥹ�Ȥ��ɲ�');
    define('_AM_RSSC_ADD_KEYWORD', '������ɤ��ɲ�');
    define('_AM_RSSC_ARCHIVE_MANAGE', '���������ִ���');

    //define('_AM_RSSC_COMMAND_MANAGE', '���ޥ�ɴ���');

    define('_AM_RSSC_UPDATE_MANAGE', '����ݡ��ȴ���');
    define('_AM_RSSC_VIEW_RSS', 'RDF/RSS/ATOM ��ɽ��');

    //define('_AM_RSSC_GOTO_MODULE', '�⥸�塼���');

    // === index & config ===
    define('_AM_RSSC_FORM_BASIC', '��������');
    define('_AM_RSSC_FORM_BASIC_DESC', '���ƤΥ⥸�塼��Ƕ��̤˻��Ѥ��ޤ�');
    define('_AM_RSSC_FORM_MAIN', '�ᥤ��ɽ������');
    define('_AM_RSSC_FORM_MAIN_DESC', '���Υ⥸�塼��Υᥤ�󡦥ڡ����ǻ��Ѥ��ޤ�');
    define('_AM_RSSC_FORM_BLOCK', '�֥�å�ɽ������');
    define('_AM_RSSC_FORM_BLOCK_DESC', '���Υ⥸�塼��Υ֥�å��ǻ��Ѥ��ޤ�');

    //define('_AM_RSSC_FORM_BIN', '���ޥ������');
    //define('_AM_RSSC_FORM_BIN_DESC', 'bin ���ޥ�ɤǻ��Ѥ��ޤ�');
    //define('_AM_RSSC_INIT_NOT','����ơ��֥뤬���������Ƥ��ʤ�');
    //define('_AM_RSSC_INIT_EXEC','����ơ��֥����������');
    //define('_AM_RSSC_VERSION_NOT','�С������ %s �ǤϤʤ�');
    //define('_AM_RSSC_UPGRADE_EXEC','����ơ��֥�򥢥åץ��졼�ɤ���');
    //define('_AM_RSSC_WARNING_NOT_WRITABLE','�ǥ��쥯�ȥ�ν���ߵ��Ĥ��ʤ�');
    //define('_AM_RSSC_CONF_NAME','����');

    define('_AM_RSSC_DBUPDATED', '�ǡ����١����򹹿�����');
    define('_AM_RSSC_FAILUPDATE', '�ǡ����١�������¸���Ǥ��ޤ���Ǥ���');
    define('_AM_RSSC_FAILDELETE', '�ǡ����١����κ�����Ǥ��ޤ���Ǥ���');
    define('_AM_RSSC_THERE_ARE_LINKS', '�ǡ����١����ˤ� <b>%s</b> ��Υ�󥯤���Ͽ����Ƥ��ޤ���');
    define('_AM_RSSC_THERE_ARE_FEEDS', '�ǡ����١����ˤ� <b>%s</b> ��� feed ����Ͽ����Ƥ��ޤ���');

    // === link manage ===
    define('_AM_RSSC_LINK_MANAGE', '��󥯤δ���');
    define('_AM_RSSC_MOD_LINK', '��󥯤ν���');
    define('_AM_RSSC_DEL_LINK', '��󥯤κ��');
    define('_AM_RSSC_SHOW_RSS', 'RSSɽ��');
    define('_AM_RSSC_SHOW_FEED', 'feedɽ��');
    define('_AM_RSSC_FEED_BELONG_LINK', '���Υ�󥯤�°����feed��ɽ������');
    define('_AM_RSSC_ERROR_FILL', '���顼: %s �����Ϥ��Ʋ�����');
    define('_AM_RSSC_ERROR_ILLEGAL', '���顼: %s �η����������Ǥ�');

    // === black list manage ===
    define('_AM_RSSC_BLACK_MANAGE', '�֥�å��ꥹ�Ȥδ���');
    define('_AM_RSSC_MOD_BLACK', '�֥�å��ꥹ�Ȥν���');
    define('_AM_RSSC_DEL_BLACK', '�֥�å��ꥹ�Ȥκ��');
    define('_AM_RSSC_FEED_MATCH_LINK', '���Υꥹ�Ȥ˰��פ���feed��ɽ������');

    // === white list manage ===
    define('_AM_RSSC_WHITE_MANAGE', '�ۥ磻�ȥꥹ�Ȥδ���');
    define('_AM_RSSC_MOD_WHITE', '�ۥ磻�ȥꥹ�Ȥν���');
    define('_AM_RSSC_DEL_WHITE', '�ۥ磻�ȥꥹ�Ȥκ��');

    // === feed list manage ===
    define('_AM_RSSC_ADD_FEED', 'feed���ɲ�');
    define('_AM_RSSC_MOD_FEED', 'feed�ν���');
    define('_AM_RSSC_DEL_FEED', 'feed�κ��');
    define('_AM_RSSC_THERE_ARE_MATCH', '���˰��פ��� <b>%s</b> ��Υǡ���������ޤ�');
    define('_AM_RSSC_CONDITION', '���');

    // === archive manage ===
    define('_AM_RSSC_REFRESH', '���������֤ι���');
    define('_AM_RSSC_REFRESH_NEXT', '���� %s ��򹹿�����');
    define('_AM_RSSC_LINK_LIMIT', '��󥯿��ξ��(limit)');
    define('_AM_RSSC_LINK_OFFSET', '���ե��å�(offset)');
    define('_AM_RSSC_FEED_CLEAR', '���������֤Υ��ꥢ');
    define('_AM_RSSC_FEED_CLEAR_OLD', '���դθŤ���˥��ꥢ����');
    define('_AM_RSSC_FEED_CLEAR_NUM', '���ꤷ������ʾ�ʤ�С����դθŤ���˥��ꥢ����');

    // refresh result
    define('_AM_RSSC_NO_REFRESH', '���������󥯤��ʤ�');
    define('_AM_RSSC_TIME_START', '���ϻ���');
    define('_AM_RSSC_TIME_END', '��λ����');
    define('_AM_RSSC_TIME_ELAPSE', '�в����');
    define('_AM_RSSC_MIN_SEC', '%s ʬ %s ��');
    define('_AM_RSSC_NUM_LINK_TOTAL', '����󥯿�');
    define('_AM_RSSC_NUM_LINK_TARGET', '�оݤȤʤ��󥯿�');
    define('_AM_RSSC_NUM_LINK_BROKEN', '����ڤ�Υ�󥯿�');
    define('_AM_RSSC_NUM_LINK_UPDATED', '����������󥯿�');
    define('_AM_RSSC_NUM_FEED_UPDATED', '�������� FEED�ε�����');
    define('_AM_RSSC_NUM_FEED_CLEARED', '���ꥢ���� FEED�ε�����');
    define('_AM_RSSC_NUM_LINKS', '��');
    define('_AM_RSSC_NUM_FEEDS', '��');
    define('_AM_RSSC_FAILGET', '%s ����� XML �μ������Ǥ��ޤ���Ǥ�����');
    define('_AM_RSSC_GOTOTOP', '�ȥåפ����');

    // === configuration ===
    // basic configuration
    define('_AM_RSSC_CONF_FEED_LIMIT', 'FEED�����κ���η��');
    define('_AM_RSSC_CONF_FEED_LIMIT_DESC', 'feed �ơ��֥�˳�Ǽ����FEED�����κ���η������ꤹ��<br>�����ͤ�Ķ��������դθŤ������饯�ꥢ����롣<br><b>0</b> ��̵���¤������侩���ʤ���');
    define('_AM_RSSC_CONF_RSS_ATOM', 'RSS��ATOM������');
    define('_AM_RSSC_CONF_RSS_ATOM_DESC', 'RSS URL��ATOM URL��ξ�������Ф��줿�Ȥ��ˡ��ɤ������Ѥ��뤫���򤷤ޤ�');
    define('_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM', 'ATOM');
    define('_AM_RSSC_CONF_RSS_ATOM_SEL_RSS', 'RSS');
    define('_AM_RSSC_CONF_RSS_PARSER', 'RSS�ѡ�����������');
    define('_AM_RSSC_CONF_RSS_PARSER_SELF', '��¢');
    define('_AM_RSSC_CONF_RSS_PARSER_XOOPS', 'XOOPS RSS Parser');
    define('_AM_RSSC_CONF_ATOM_PARSER', 'ATOM�ѡ�����������');
    define('_AM_RSSC_CONF_ATOM_PARSER_0', '��¢');
    define('_AM_RSSC_CONF_ATOM_PARSER_1', '');
    define('_AM_RSSC_CONF_RSS_MODE', 'RSS �⡼�ɤν����');
    define('_AM_RSSC_CONF_XML_SAVE', 'XML����¸����');
    define('_AM_RSSC_CONF_XML_SAVE_DESC', '�ɤ߽Ф���XML�� link �ơ��֥����¸����');
    define('_AM_RSSC_CONF_FUTURE_DAYS', '̤������դ�');
    define('_AM_RSSC_CONF_FUTURE_DAYS_DESC', 'ñ�̤�����<br>������������̤��ε����Ǥ���С�ɽ�����ʤ�');

    // show configuration
    define('_AM_RSSC_CONF_SHOW_ORDER', 'ɽ���������');
    //define('_AM_RSSC_CONF_SHOW_ORDER_DESC','ɽ��������֤���ꤷ�Ƥ�������');
    define('_AM_RSSC_CONF_SHOW_ORDER_UPDATED', '������������ updated');
    define('_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED', '������ȯ���� published');
    define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE', '���ڡ�����ɽ�������󥯷��');
    //define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC','���ڡ����������ɽ���������������ꤷ�Ƥ�������');
    define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE', '���ڡ�����ɽ������feed���');
    //define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC','���ڡ����������ɽ���������������ꤷ�Ƥ�������');
    define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK', '��������ɽ������feed���');
    //define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK_DESC','����󥯤������ɽ���������������ꤷ�Ƥ�������');
    define('_AM_RSSC_CONF_SHOW_MAX_TITLE', '�����ȥ�κ���ʸ����');
    define('_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC', '����ʸ������Ķ�����Ȥ��ϡ�HTML�����Ϻ������ޤ�<br><b>-1</b> �ΤȤ��ϡ����¤ʤ��Ǥ�');
    define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY', '����κ���ʸ����');
    define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC', '<b>-1</b> �ΤȤ��ϡ����¤ʤ��Ǥ�');

    // main configuration
    define('_AM_RSSC_CONF_MAIN_SEARCH_MIN', '�����Υ�����ɺ���ʸ����');
    //define('_AM_RSSC_CONF_MAIN_SEARCH_MIN_DESC','������Ԥ��ݤ�ɬ�פʥ�����ɤκ���ʸ��������ꤷ�Ƥ�������');

    // bin configuration
    //define('_AM_RSSC_CONF_BIN_PASS','�ѥ����');
    //define('_AM_RSSC_CONF_BIN_PASS_DESC','�ѥ���ɤ���ꤷ�Ƥ�������');
    //define('_AM_RSSC_CONF_BIN_SEND','�᡼�������');
    //define('_AM_RSSC_CONF_BIN_SEND_DESC','��̤�᡼�����������Ȥ��ϡ֤Ϥ��פ���ꤷ�Ƥ�������');
    //define('_AM_RSSC_CONF_BIN_MAILTO','������Υ᡼�륢�ɥ쥹');
    //define('_AM_RSSC_CONF_BIN_MAILTO_DESC','������Υ᡼�륢�ɥ쥹����ꤷ�Ƥ�������');

    // === view rss ===
    define('_AM_RSSC_VIEW_RSS_OPTION', '���ץ��������');
    define('_AM_RSSC_NOT_SELECT_LINK', '��󥯤����򤵤�Ƥ��ޤ���');
    define('_AM_RSSC_PLEASE_SELECT_LINK', '��󥯰����������򤹤뤫��LINK ID �����Ϥ��Ƥ�������');
    define('_AM_RSSC_VIEW_PARSER', '�ѡ�����������');
    define('_AM_RSSC_VIEW_SAVE_ETC', '�ơ��֥��Ǽ�����ꡢ����¾');
    define('_AM_RSSC_VIEW_MODE', 'ɽ���⡼��');
    define('_AM_RSSC_VIEW_MODE_DESC', 'mode 0 �ΤȤ��ϡ��ơ��֥�˳�Ǽ���ʤ�');
    define('_AM_RSSC_VIEW_MODE_CURRENT', 'mode 0: �������� XML �ǡ���');
    define('_AM_RSSC_VIEW_MODE_LINK', 'mode 1: link �ơ��֥�˳�Ǽ���줿 XML �ǡ���');
    define('_AM_RSSC_VIEW_MODE_FEED', 'mode 2: feed �ơ��֥�˳�Ǽ���줿�ǡ���');
    define('_AM_RSSC_VIEW_SANITIZE', 'html ���˥���������');
    define('_AM_RSSC_VIEW_TITLE_HTML', '�����ȥ��HTML������ɽ��');
    define('_AM_RSSC_VIEW_TITLE_HTML_DESC', '�֤Ϥ��פ����򤹤�ȡ�HTML����������Ȥ��ϡ����Τޤ�ɽ�����롣<br>�֤������פ����򤹤�ȡ�HTML������������ɽ�����롣');
    define('_AM_RSSC_VIEW_CONTENT_HTML', '��ʸ��HTML������ɽ��');
    define('_AM_RSSC_VIEW_CONTENT_HTML_DESC', '�֤Ϥ��פ����򤹤�ȡ�HTML����������Ȥ��ϡ����Τޤ�ɽ�����롣<br>�֤������פ����򤹤�ȡ�HTML������������ɽ�����롣');
    define('_AM_RSSC_VIEW_MAX_CONTENT', '��ʸ�κ���ʸ����');
    define('_AM_RSSC_VIEW_MAX_CONTENT_DESC', '����ʸ������Ķ�����Ȥ��ϡ�HTML�����Ϻ������ޤ�<br><b>-1</b> �ΤȤ��ϡ����¤ʤ��Ǥ�');
    define('_AM_RSSC_VIEW_LINK_UPDATE', 'link �ơ��֥�ι���');
    define('_AM_RSSC_VIEW_FEED_UPDATE', 'feed �ơ��֥�ι���');
    define('_AM_RSSC_VIEW_FORCE_DISCOVER', 'RSS URL�ζ�������');
    define('_AM_RSSC_VIEW_FORCE_DISCOVER_DESC', 'RSS�⡼�ɤ˴ط��ʤ���RDF/RSS/ATOM URL �򸡽Ф���URL���񤭤ޤ��ޤ�');
    define('_AM_RSSC_VIEW_FORCE_UPDATE', '���������֤ζ�������');
    define('_AM_RSSC_VIEW_FORCE_UPDATE_DESC', '�����ֳ֤˴ط��ʤ���RDF/RSS/ATOM ���ɤ߽Ф������������֤��񤭤ޤ��ޤ�');
    define('_AM_RSSC_VIEW_FORCE_OVERWRITE', 'feed �ơ��֥�ζ�������');
    define('_AM_RSSC_VIEW_FORCE_OVERWRITE_DESC', 'Ʊ�� RDF/RSS/ATOM �Υǡ�����¸�ߤ��Ƥ��Ƥ⡢feed �ơ��֥���񤭤ޤ��ޤ�');
    define('_AM_RSSC_VIEW_PRINT_LOG', '����ɽ��');
    define('_AM_RSSC_VIEW_PRINT_LOG_DESC', '�¹Ի���Ʊ���˥���ɽ������');
    define('_AM_RSSC_VIEW_PRINT_ERROR', '���顼��ɽ��');
    define('_AM_RSSC_VIEW_PRINT_ERROR_DESC', '�¹Ի���Ʊ���˥��顼��ɽ������');

    // === command manage ===
    //define('_AM_RSSC_CREATE_CONFIG', '����ե����������');
    //define('_AM_RSSC_TEST_BIN_REFRESH', 'bin/refresh.php �Υƥ��ȼ¹�');

    // === update manage ===
    define('_AM_RSSC_IMPORT_XOOPSHEADLINE', 'XoopsHeadline ����Υǡ����ܹ�');
    define('_AM_RSSC_IMPORT_WEBLINKS', 'WebLinks ����Υǡ����ܹ�');

    // === rename ===
    define('_AM_RSSC_VIEW_FEED_PERPAGE', _AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE);
    define('_AM_RSSC_VIEW_MAX_TITLE', _AM_RSSC_CONF_SHOW_MAX_TITLE);
    define('_AM_RSSC_VIEW_MAX_TITLE_DESC', _AM_RSSC_CONF_SHOW_MAX_TITLE_DESC);
    define('_AM_RSSC_VIEW_MAX_SUMMARY', _AM_RSSC_CONF_SHOW_MAX_SUMMARY);
    define('_AM_RSSC_VIEW_MAX_SUMMARY_DESC', _AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC);
    define('_AM_RSSC_VIEW_XML_SAVE', _AM_RSSC_CONF_XML_SAVE);
    define('_AM_RSSC_VIEW_XML_SAVE_DESC', _AM_RSSC_CONF_XML_SAVE_DESC);

    // 2006-01-20
    define('_AM_RSSC_ID_ASC', 'ID ����');
    define('_AM_RSSC_ID_DESC', 'ID �ս�');

    // === 2006-06-04 ===
    // build rss
    //define('_AM_RSSC_BUILD', 'RDF/RSS/ATOM ������');
    //define('_AM_RSSC_BUILD_DSC',  '�ǥХå��Ѥ� RDF/RSS/ATOM ��������ɽ������');
    //define('_AM_RSSC_BUILD_RDF',  'RDF ������');
    //define('_AM_RSSC_BUILD_RSS',  'RSS ������');
    //define('_AM_RSSC_BUILD_ATOM', 'ATOM ������');

    // parse rss
    define('_AM_RSSC_PARSE_RSS', 'RDF/RSS/ATOM �β���');

    // refresh link
    //define('_AM_RSSC_REFRESH_LINK', 'feed �����ι���');
    //define('_AM_RSSC_REFRESH_LINK_DSC', '����³���ơ�RDF/RSS/ATOM �� feed �����򹹿����ޤ���<br>�⤷���ꤵ��Ƥ��ʤ���С�<br> <b>RDF/RSS/ATOM URL</b> �� <b>���󥳡���</b> ��ưŪ�˸��Ф��ޤ���');
    //define('_AM_RSSC_REFRESH_LINK_FINISHED', 'feed �����򹹿�����');

    // === 2006-07-08 ===
    // description at main
    define('_AM_RSSC_CONF_INDEX_DESC', '�ᥤ��ڡ���������');
    define('_AM_RSSC_CONF_INDEX_DESC_DSC', '�ᥤ��ڡ�����ɽ������Ȥ��ϡ�����ʸ����ꤷ�Ƥ���������');
    define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">�����ˤ�����ʸ��ɽ�����ޤ���<br>����ʸ�ϡ֥⥸�塼�������פˤ��Խ��Ǥ��ޤ���<br></div><br>');

    // link table
    define('_AM_RSSC_LINK_DESC', '��Ͽ����WEB�����Ȥ� RSS Auto Discovery (��ư����) ���б����Ƥ�����ϡ�<br><b>RDF/RSS/ATOM URL</b> �� <b>���󥳡���</b> �������ʤ��Ȥ⡢��ưŪ�����ꤵ��ޤ�');
    //define('_AM_RSSC_LINK_EXIST', '���Ρ�RDF/RSS/ATOM URL�פ���Ͽ�ѤߤǤ�');
    //define('_AM_RSSC_LINK_EXIST_MORE','Ʊ����RDF/RSS/ATOM URL�פ����ʣ���Υ�󥯤����Ĥ���ޤ���');
    //define('_AM_RSSC_AUTO_FIND_FAILD','RSS Auto Discovery  (��ư����) ������ޤ���Ǥ���');
    define('_AM_RSSC_LINK_FORCE', '������¸');

    // black & white table
    define('_AM_RSSC_BLACK_MEMO', '����');

    // === 2006-09-20 ===
    // show content with html
    define('_AM_RSSC_CONF_SHOW_TITLE_HTML', '�����ȥ��HTML������ɽ��');
    define('_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC', '�֤Ϥ��פ����򤹤�ȡ�HTML����������Ȥ��ϡ����Τޤ�ɽ�����롣<br>�֤������פ����򤹤�ȡ�HTML������������ɽ�����롣');
    define('_AM_RSSC_CONF_SHOW_CONTENT_HTML', '��ʸ��HTML������ɽ��');
    define('_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC', '�֤Ϥ��פ����򤹤�ȡ�HTML����������Ȥ��ϡ����Τޤ�ɽ�����롣<br>�֤������פ����򤹤�ȡ�HTML������������ɽ�����롣');
    define('_AM_RSSC_CONF_SHOW_MAX_CONTENT', '��ʸ�κ���ʸ����');
    define('_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC', '����ʸ������Ķ�����Ȥ��ϡ�HTML�����Ϻ������ޤ�<br><b>-1</b> �ΤȤ��ϡ����¤ʤ��Ǥ�');
    define('_AM_RSSC_CONF_SHOW_NUM_CONTENT', '��ʸ��ɽ������feed���');
    define('_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC', '��ʸ��ɽ���������������ꤷ�Ƥ�������');
    define('_AM_RSSC_CONF_SHOW_BLOG_LID', 'Bolg ��ɽ������ Link ID');
    //define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Bolg ��ɽ������ Link ID ����ꤷ�Ƥ�������');

    define('_AM_RSSC_TABLE_MANAGE', 'DB�ơ��֥����');

    // === 2006-11-08 ===
    // proxy server
    define('_AM_RSSC_FORM_PROXY', '�ץ����������С� ����');
    define('_AM_RSSC_CONF_PROXY_USE', '�ץ����������С�����Ѥ���');
    define('_AM_RSSC_CONF_PROXY_HOST', '�ץ������ۥ���̾');
    define('_AM_RSSC_CONF_PROXY_PORT', '�ץ������ݡ����ֹ�');
    define('_AM_RSSC_CONF_PROXY_USER', '�ץ������桼��̾');
    define('_AM_RSSC_CONF_PROXY_USER_DESC', '�ץ����������С���BASICǧ�ڤ�ɬ�פȤ�����ϡ��桼��̾�����Ϥ���<br>�����Ǥʤ���С�����Τޤޤˤ���');
    define('_AM_RSSC_CONF_PROXY_PASS', '�ץ������ѥ����');
    define('_AM_RSSC_CONF_PROXY_PASS_DESC', '�ץ����������С���BASICǧ�ڤ�ɬ�פȤ�����ϡ��ѥ���ɤ����Ϥ���<br>�����Ǥʤ���С�����Τޤޤˤ���');

    define('_AM_RSSC_CONF_HIGHLIGHT', '������ɤΥϥ��饤��ɽ������Ѥ���');

    // === 2007-06-01 ===
    // word_list
    define('_AM_RSSC_LIST_WORD', '�ػ߸�ΰ���');
    define('_AM_RSSC_WORD_MANAGE', '�ػ߸�δ���');
    define('_AM_RSSC_ADD_WORD', '�ػ߸���ɲ�');
    define('_AM_RSSC_MOD_WORD', '�ػ߸�ν���');
    define('_AM_RSSC_DEL_WORD', '�ػ߸�κ��');
    define('_AM_RSSC_POINT_ASC', '�����ξ��ʤ���');
    define('_AM_RSSC_POINT_DESC', '������¿����');
    define('_AM_RSSC_COUNT_ASC', '�и�����ξ��ʤ���');
    define('_AM_RSSC_COUNT_DESC', '�и������¿����');
    define('_AM_RSSC_WORD_ASC', 'ABC���������� ��');
    define('_AM_RSSC_WORD_DESC', 'ABC���������� �ս�');
    define('_AM_RSSC_NON_ACT', '��ɽ���ΰ���');
    define('_AM_RSSC_NON_ACT_ASC', '��ɽ�� ID����');
    define('_AM_RSSC_NON_ACT_DESC', '��ɽ�� ID�ս�');
    define('_AM_RSSC_WORD_ALREADY', '���ζػ߸����Ͽ����Ƥ���');
    define('_AM_RSSC_WORD_SEARCH', '����� ����');

    // content filter
    define('_AM_RSSC_FORM_FILTER', '�ե��륿����');
    define('_AM_RSSC_FORM_FILTER_DESC', 'feed ������ư��������Ȥ��ˡ��ǡ����١�������¸���뤷�ʤ���Ƚ�ꤹ����Ȥ�');
    define('_AM_RSSC_CONF_LINK_USE', '��󥯥ơ��֥�λ���');
    define('_AM_RSSC_CONF_LINK_USE_DESC', '��󥯥ơ��֥�Ρ֥����ספ����̾�פǤ���С���¸����');
    define('_AM_RSSC_CONF_WHITE_USE', '�ۥ磻�ȥꥹ�Ȥλ���');
    define('_AM_RSSC_CONF_WHITE_USE_DESC', '�ۥ磻�ȥꥹ�Ȥˤ���С���¸����');
    define('_AM_RSSC_CONF_BLACK_USE', '�֥�å��ꥹ�Ȥλ���');
    define('_AM_RSSC_CONF_BLACK_USE_DESC', '�֥�å��ꥹ�Ȥˤ���С���¸���ʤ�<br>���ѤǤϡ��֥�å���Ƚ�ꤹ��ȡ��ʹߤν��������Ǥ���<br>�ؽ��⡼�ɤǤϡ��ػ߸����Ф��뤿�ᡢ�������³����');
    define('_AM_RSSC_CONF_BLACK_USE_NO', '̤����');
    define('_AM_RSSC_CONF_BLACK_USE_YES', '����');
    define('_AM_RSSC_CONF_BLACK_USE_LEARN', '�ؽ��⡼��');
    define('_AM_RSSC_CONF_WORD_USE', '�ػ߸�ꥹ�Ȥλ���');
    define('_AM_RSSC_CONF_WORD_USE_DESC', '�ػ߸�ꥹ�Ȥι��������Ƚ���٥��Ķ����ȡ���¸���ʤ�');
    define('_AM_RSSC_CONF_WORD_LEVEL', 'Ƚ���٥�');
    define('_AM_RSSC_CONF_FEED_SAVE', 'feed ��������¸');
    define(
        '_AM_RSSC_CONF_FEED_SAVE_DESC',
        '�֥�å���Ƚ�ꤷ���Ȥ��ˡ�feed �ơ��֥����¸���뤫�ݤ���<br>
����¸����פǤϡ���ɽ���ξ��֤ˤ�����¸���ޤ���'
    );
    define('_AM_RSSC_CONF_FEED_SAVE_NO', '��¸���ʤ�');
    define('_AM_RSSC_CONF_FEED_SAVE_YES', '��¸����');
    define('_AM_RSSC_CONF_LOG_USE', '���ե�����λ���');
    define('_AM_RSSC_CONF_LOG_USE_DESC', '�֥�å���Ƚ�ꤷ���Ȥ��ˡ����ե��������¸����');
    define('_AM_RSSC_CONF_WHITE_COUNT', '�ۥ磻�ȥꥹ�ȤΥ������');
    define('_AM_RSSC_CONF_WHITE_COUNT_DESC', '�ۥ磻�ȥꥹ�Ȥ˹��פ����Ȥ��������ξ��򥫥���ȥ��åפ���');
    define('_AM_RSSC_CONF_BLACK_COUNT', '�֥�å��ꥹ�ȤΥ������');
    define('_AM_RSSC_CONF_BLACK_COUNT_DESC', '�֥�å��ꥹ�Ȥ˹��פ����Ȥ��������ξ��򥫥���ȥ��åפ���');
    define('_AM_RSSC_CONF_WORD_COUNT', '�ػ߸�ꥹ�ȤΥ������');
    define('_AM_RSSC_CONF_WORD_COUNT_DESC', '�ػ߸�ꥹ�Ȥ˹��פ����Ȥ��������ξ��򥫥���ȥ��åפ���');
    define('_AM_RSSC_CONF_BLACK_AUTO', '�֥�å��ꥹ�Ȥμ�ư��Ͽ');
    define('_AM_RSSC_CONF_BLACK_AUTO_DESC', '�֥�å���Ƚ�ꤵ�줿URL��֥�å��ꥹ�Ȥ˼�ưŪ����Ͽ����<br><b>���</b> ��̵���׾��֤���Ͽ���ޤ�<br>���Ѥ�����ϡ�ͭ���פ��ѹ����Ƥ�������');
    define('_AM_RSSC_CONF_WORD_AUTO', '�ػ߸�μ�ư��Ͽ');
    define('_AM_RSSC_CONF_WORD_AUTO_DESC', '�֥�å���Ƚ�ꤵ�줿����ƥ�Ĥ˴ޤޤ��ñ���ưŪ����Ф��ơ��ػ߸�ꥹ�Ȥ˼�ưŪ����Ͽ����<br><b>���</b> ��������=0 ����Ͽ���ޤ�<br>���Ѥ���������������ꤷ�Ƥ�������');
    define('_AM_RSSC_CONF_WORD_AUTO_NON', '��ư��Ͽ���ʤ�');
    define('_AM_RSSC_CONF_WORD_AUTO_SYMBOL', '����䵭��ˤ��ñ������');
    define('_AM_RSSC_CONF_WORD_AUTO_KAKASI', 'KAKASI�ˤ��ñ������');

    // word extract
    define('_AM_RSSC_FORM_WORD', 'ñ����Ф�����');
    define('_AM_RSSC_CONF_JOIN_PREV', 'ñ���Ϣ��');
    define('_AM_RSSC_CONF_JOIN_PREV_DESC', '�����ñ���Ϣ�뤷���ϸ����');
    define('_AM_RSSC_CONF_JOIN_GLUE', 'ñ���Ϣ���');
    define('_AM_RSSC_CONF_JOIN_GLUE_DESC', '���ܸ�Ǥϲ�����ꤷ�ʤ�<br>�Ѹ�Ǥ�Ⱦ�Ѷ������ꤹ��');
    define('_AM_RSSC_CONF_KAKASI_PATH', 'KAKASI�Υ��ޥ�ɥѥ�');
    define('_AM_RSSC_CONF_KAKASI_MODE', 'KAKASI�Υ⡼��');
    define('_AM_RSSC_CONF_KAKASI_MODE_FILE', '����ե��������Ѥ���');
    define('_AM_RSSC_CONF_KAKASI_MODE_PIPE', 'UNIX pipe ����Ѥ���');
    define('_AM_RSSC_CONF_CHAR_LENGTH', 'ñ��κǾ�ʸ����');
    define('_AM_RSSC_CONF_CHAR_LENGTH_DESC', '��Ф���ñ��κǾ���(Ⱦ��)ʸ����');
    define('_AM_RSSC_CONF_WORD_LIMIT', '�ػ߸�κ������Ͽ��');
    define('_AM_RSSC_CONF_WORD_LIMIT_DESC', 'word �ơ��֥�˳�Ǽ����ػ߸�κ������Ͽ������ꤹ��<br>�����ͤ�Ķ��������դθŤ������饯�ꥢ����롣<br><b>0</b> ��̵���¤������侩���ʤ���');
    define('_AM_RSSC_KAKASI_EXECUTABLE', 'kakasi ���¹Բ�ǽ�Ǥ�');
    define('_AM_RSSC_KAKASI_NOT_EXECUTABLE', 'kakasi ���¹ԤǤ��ޤ���');
    define('_AM_RSSC_CONF_HTML_GET', 'HTML�μ�ư����');
    define('_AM_RSSC_CONF_HTML_GET_DESC', '�ػ߸�ꥹ�Ȥ���Ѥ���Ƚ���Ԥ��Ȥ��ˡ�ȯ������HTML�ǡ�����ư�������ޤ�<br>HTML�ǡ������������ȡ�Ƚ������٤ϸ��夷�ޤ������¹Ի��֤��礭���ʤ�ޤ�');
    define('_AM_RSSC_CONF_HTML_GET_NO', '��ư�������ʤ�');
    define('_AM_RSSC_CONF_HTML_GET_YES', '��ư��������');
    define('_AM_RSSC_CONF_HTML_GET_BLACK', '�֥�å���Ƚ�ꤵ��Ȥ��˼�ư��������');
    define('_AM_RSSC_CONF_HTML_LIMIT', 'HTML�ǡ����κ����ʸ����');
    define('_AM_RSSC_CONF_HTML_LIMIT_DESC', '��ư��������HTML�ǡ����κ����ʸ����<br>�����Ȥˤ�äƤ��礭�ʥǡ����Ȥʤꡢ����ʬ �¹Ի��֤�Ĺ���ʤ�ޤ�');

    // archive manage
    define('_AM_RSSC_LEAN_BLACK', '�֥�å��ꥹ�Ȥγؽ�');
    define('_AM_RSSC_LEAN_BLACK_DESC', '�֥�å��ꥹ�Ȥ��󤷡�����ƥ�Ĥ˴ޤޤ��ñ���ưŪ����Ф��ơ��ػ߸�ꥹ�Ȥ˼�ưŪ����Ͽ����');
    define('_AM_RSSC_NUM_FEED_ALL', '���Ƥ�FEED�ε�����');
    define('_AM_RSSC_NUM_FEED_SKIP', '���Ǥ���¸����Ƥ���FEED�ε�����');
    define('_AM_RSSC_NUM_FEED_REJECT', '�֥�å���Ƚ�ꤵ�줿FEED�ε�����');

    define('_AM_RSSC_THEREARE_TITLE', '<b>%s</b> �˴ؤ���ǡ����� <b>%s</b> �Ǥ���');

    // === 2007-10-10 ===
    // config
    define('_AM_RSSC_CONF_SHOW_MODE_DATE', '���դμ���');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_NON', 'ɽ�����ʤ�');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT', 'short');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE', 'middle');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_LONG', 'long');
    define('_AM_RSSC_CONF_SHOW_SITE', '�����Ⱦ���');
    define('_AM_RSSC_CONF_SHOW_SITE_DSC', '������̾��URL��ɽ�����뤫');

    // link table
    define('_AM_RSSC_LINK_CENSOR_DESC', 'ʸ�����ʸ����δ֤� <b>|</b> �Ƕ��ڤ�ޤ�<br>��ʸ����ʸ���϶��̤��ޤ�');

    // === 2008-01-20 ===
    // menu
    define('_AM_RSSC_FORM_HTMLOUT', 'HTML��������');
    define('_AM_RSSC_FORM_HTMLOUT_DESC', '��ʸ��HTML������ɽ����֤Ϥ��פ����ꤷ���Ȥ��Ρ���ʸ�ν���<br>�֤������פΤȤ��ϡ����ƤΥ����Ϻ�������<br>XSS (���������ȥ�����ץƥ���) �ɻߤΤ���ˡ�JavaScript �ط��ε��ҤϺ�����뤫ʸ�����Ѵ����뤳�Ȥ򤪴��ᤷ�ޤ�');
    define('_AM_RSSC_FORM_CUSTOM_PLUGIN', '�������ࡦ�ץ饰����');

    // html out
    define('_AM_RSSC_CONF_HTML_NON', '���⤷�ʤ�');
    define('_AM_RSSC_CONF_HTML_SHOW', '���˥���������HTMLɽ������');
    define('_AM_RSSC_CONF_HTML_REMOVE', '�������');
    define('_AM_RSSC_CONF_HTML_REPLACE', 'ʸ������Ѵ�����');
    define('_AM_RSSC_CONF_HTML_SCRIPT', 'script ����');
    define('_AM_RSSC_CONF_HTML_SCRIPT_DESC', '&lt;script&gt;...&lt;/script&gt; �ν���');
    define('_AM_RSSC_CONF_HTML_STYLE', 'style ����');
    define('_AM_RSSC_CONF_HTML_STYLE_DESC', '&lt;style&gt;...&lt;/style&gt; �ν���');
    define('_AM_RSSC_CONF_HTML_LINK', 'link ����');
    define('_AM_RSSC_CONF_HTML_LINK_DESC', '&lt;link ... &gt; �ν���');
    define('_AM_RSSC_CONF_HTML_COMMENT', '�����ȵ���');
    define('_AM_RSSC_CONF_HTML_COMMENT_DESC', '&lt;!-- ... --&gt; �ν���');
    define('_AM_RSSC_CONF_HTML_CDATA', 'CDATA ����');
    define('_AM_RSSC_CONF_HTML_CDATA_DESC', '&lt;![CDATA[ ... ]]&gt; �ν���');
    define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE', 'onMouse °��');
    define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE_DESC', 'onmouseover="..." �� onclick="..." �ν���<br>���Ѵ��פΤȤ��� on_mouseover_="..." �Τ褦�ˤʤ�');
    define('_AM_RSSC_CONF_HTML_ATTR_STYLE', 'style °��');
    define('_AM_RSSC_CONF_HTML_ATTR_STYLE_DESC', 'style="..." �� class="..." �ν���<br>���Ѵ��פΤȤ��� style_="..." �Τ褦�ˤʤ�');
    define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS', '����¾�Υ����κ��');
    define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS_DESC', '&lt;img ... &gt; &lt;a ... &gt; &lt;link ... &gt; �ʤɤΥ����������뤫');
    define('_AM_RSSC_CONF_HTML_OTHER_TAGS', '������ʤ�����');
    define('_AM_RSSC_CONF_HTML_OTHER_TAGS_DESC', '�֤���¾�Υ����κ���פ��֤Ϥ��פΤȤ��ˡ�������ʤ�������������<br> ��: <img><a>');
    define('_AM_RSSC_CONF_HTML_JAVASCRIPT', 'JavaScriprt ʸ����');
    define('_AM_RSSC_CONF_HTML_JAVASCRIPT_DESC', 'JavaScriprt �Ȥ���ʸ������Ф������<br>���Ѵ��פΤȤ��� java_script �Ȥʤ�');

    // plugin
    define('_AM_RSSC_PRE_PLUGIN_DESC', '�ǡ����١����˳�Ǽ�������˼¹Ԥ����');
    define('_AM_RSSC_POST_PLUGIN_DESC', '�ǡ����١��������ɤ߽Ф�����˼¹Ԥ����');
    define('_AM_RSSC_PLUGIN_DESC_2', 'ʣ���Υץ饰�������ꤹ����� <b>|</b> �Ƕ��ڤ�ޤ�');

    define('_AM_RSSC_PLUGIN_TEST', '�ץ饰����Υƥ���');
    define('_AM_RSSC_PLUGIN', '�ץ饰����');
    define('_AM_RSSC_PLUGIN_TESTDATA', '�ƥ��ȥǡ���');
    define('_AM_RSSC_PLUGIN_TESTDATA_DESC', 'Ϣ������η����ǵ��Ҥ���');

    // === 2009-02-20 ===
    // map
    define('_AM_RSSC_FORM_MAP', 'Google �ޥå� ����');

    // config
    define('_AM_RSSC_CONF_WEBMAP_DIRNAME', 'webmap dirname');
    define('_AM_RSSC_CONF_WEBMAP_DIRNAME_DESC', 'webmap �⥸�塼��Υǥ��쥯�ȥ�̾�����ꤹ��');
    define('_AM_RSSC_CONF_SHOW_INFO_MAX', '�ޡ����������Τκ���ʸ����');
    define('_AM_RSSC_CONF_SHOW_INFO_MAX_DSC', 'HTML�����Ϻ������ޤ�<br><b>-1</b> �ΤȤ��ϡ����¤ʤ��Ǥ�');
    define('_AM_RSSC_CONF_SHOW_INFO_WIDTH', '�ޡ������Σ��Ԥκ���ʸ����');
    define('_AM_RSSC_CONF_SHOW_INFO_WIDTH_DSC', '����ʸ�����ʾ�ΤȤ��ϲ��Ԥ���ޤ�<br><b>-1</b> �ΤȤ��ϡ����¤ʤ��Ǥ�');
    define('_AM_RSSC_CONF_SHOW_ICON', '��������ɽ��');
    define('_AM_RSSC_CONF_SHOW_ICON_DSC', '���������ɽ�����뤫');
    define('_AM_RSSC_CONF_SHOW_THUMB', '����ɽ��');
    define('_AM_RSSC_CONF_SHOW_THUMB_DSC', '����ͥ��������ɽ�����뤫');

    // link form
    define('_AM_RSSC_LINK_ICON_SEL', '�������������');
    define('_AM_RSSC_LINK_GICON_SEL', 'Google�������������');

    // === 2012-03-01 ===
    define('_AM_RSSC_MAP_MANAGE', 'GoogleMap ����');
    define('_AM_RSSC_FEED_COLUMN_MANAGE', 'feed ��������');

    // config
    define('_AM_RSSC_CONF_WEBMAP_ADDRESS', '����');
    define('_AM_RSSC_CONF_WEBMAP_ADDRESS_DESC', '���١����٤ξ��򼨤����');
    define('_AM_RSSC_CONF_WEBMAP_LATITUDE', '����');
    define('_AM_RSSC_CONF_WEBMAP_LONGITUDE', '����');
    define('_AM_RSSC_CONF_WEBMAP_ZOOM', '������');

    // === 2012-04-02 ===
    define('_AM_RSSC_CONF_URL', 'URL������');
    define('_AM_RSSC_CONF_URL_DESC', '�����ȥ�Υϥ��ѡ����');
    define('_AM_RSSC_CONF_URL_0', '���Υ����Ȥ�URL');
    define('_AM_RSSC_CONF_URL_1', 'RSSC��singlefeed');
}
// --- define language begin ---
