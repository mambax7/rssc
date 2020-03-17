<?php

// $Id: main.php,v 1.1 2011/12/29 14:37:08 ohwada Exp $

// 2008-01-20 K.OHWADA
// post_plugin in link table

// 2007-10-10 K.OHWADA
// enclusure in link table

// 2007-06-01 K.OHWADA
// move RSS words to happy_linux module
// word table

// 2006-11-08 K.OHWADA
// not use _RSSC_SINGLE_SUMMARY

// 2006-09-20 K.OHWADA
// conflict with weblinks
// error message

// 2006-07-08 K.OHWADA
// corresponding to podcast
// link exist check

// 2006-06-04 K.OHWADA
// _RSSC_SINGLE_LINK, etc

// 2006-04-16 K.OHWADA
// BUG 3864: suppress Notice Undefined offset: 0
//   _RSSC_NO_HEADLINK

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
// ͭ����������
//=========================================================

// --- define language begin ---
if (!defined('RSSC_LANG_MB_LOADED')) {
    define('RSSC_LANG_MB_LOADED', 1);

    // global
    //define('_ADDED','�ɲä���');
    //define('_DELETED','�������');
    //define('_UPDATE', '����');
    //define('_UPDATED','��������');
    //define('_MODIFY',  '�ѹ�');
    //define('_MODIFIED','�ѹ�����');
    //define('_SAVE', '��¸');
    //define('_SAVED','��¸����');
    //define('_CLEAR',  '���ꥢ');
    //define('_CLEARED','���ꥢ����');
    //define('_EXECUTE', '�¹�');
    //define('_EXECUTED','�¹Ԥ���');
    //define('_CREATE', '����');
    //define('_CREATED','��������');
    //define('_VISIT','ˬ��');
    //define('_SHOW','ɽ��');
    //define('_KEYWORD','�������');
    //define('_NUM','��');
    //define('_NO_ACTION','���⤷�ʤ�');
    //define('_NO_RECORD','��������쥳���ɤ�¸�ߤ��ޤ���');

    // index & search
    //define('_RSSC_MAIN','�ᥤ��');

    define('_RSSC_SEARCH', '����');
    define('_RSSC_LATEST_FEEDS', '�ǿ� RDF/RSS/ATOM ����');
    define('_RSSC_THEREARE', '���ߥǡ����١����ˤ� <b>%s</b> ��Υǡ�������Ͽ����Ƥ��ޤ���');

    // headline
    define('_RSSC_HEADLINE', '�ʰץإåɥ饤��');
    define('_RSSC_LASTUPDATE', '�ǽ�������');

    // single
    define('_RSSC_SINGLE', 'FEED ñ��ɽ��');

    // common
    define('_RSSC_SITE_TITLE', '������̾');
    define('_RSSC_SITE_LINK', '������URL');

    //define('_RSSC_SITE_DESCRIPTION', '�����Ȥ�����');
    //define('_RSSC_SITE_PUBLISHED', '�����ȸ�����');
    //define('_RSSC_SITE_UPDATED',   '�����ȹ�����');
    //define('_RSSC_SITE_DATE',      '�����Ⱥ�����');
    //define('_RSSC_SITE_COPYRIGHT', '���������');
    //define('_RSSC_SITE_GENERATOR', '������������');
    //define('_RSSC_SITE_CATEGORY',  '�����ȡ����ƥ���');
    //define('_RSSC_SITE_WEBMASTER', '�����ȴ�����');
    //define('_RSSC_SITE_LANGUAGE',  '�����ȸ���');
    //define('_RSSC_TITLE', '�����ȥ�');
    //define('_RSSC_LINK',  'URL');
    //define('_RSSC_DESCRIPTION', '����');
    //define('_RSSC_SUMMARY', '����');
    //define('_RSSC_CONTENT', '����');
    //define('_RSSC_PUBLISHED', '������');

    define('_RSSC_UPDATED', '������');

    //define('_RSSC_CATEGORY',  '���ƥ���');
    //define('_RSSC_RIGHTS', '���');
    //define('_RSSC_SOURCE', '����');
    //define('_RSSC_AUTHOR_NAME', '���̾');
    //define('_RSSC_AUTHOR_URI',  '���URL');
    //define('_RSSC_AUTHOR_EMAIL','��ԥ᡼��');
    //define('_RSSC_IMAGE_TITLE',  '���������ȥ�');
    //define('_RSSC_IMAGE_URL',    '����URL');

    // RSS
    //define('_RSSC_RSS_SITE_TITLE', _RSSC_SITE_TITLE);
    //define('_RSSC_RSS_SITE_LINK',  _RSSC_SITE_LINK);
    //define('_RSSC_RSS_SITE_DESCRIPTION',   _RSSC_SITE_DESCRIPTION);
    //define('_RSSC_RSS_SITE_LASTBUILDDATE', _RSSC_SITE_UPDATED);
    //define('_RSSC_RSS_SITE_PUBDATE',       _RSSC_SITE_PUBLISHED);
    //define('_RSSC_RSS_SITE_GENERATOR', _RSSC_SITE_GENERATOR);
    //define('_RSSC_RSS_SITE_CATEGORY',  _RSSC_SITE_CATEGORY);
    //define('_RSSC_RSS_SITE_WEBMASTER', _RSSC_SITE_WEBMASTER);
    //define('_RSSC_RSS_SITE_LANGUAGE',  _RSSC_SITE_LANGUAGE);
    //define('_RSSC_RSS_SITE_COPYRIGHT', _RSSC_SITE_COPYRIGHT);
    //define('_RSSC_RSS_SITE_MANAGINGEDITOR', '�������Խ���');
    //define('_RSSC_RSS_SITE_DOCS','������ʸ��');
    //define('_RSSC_RSS_SITE_CLOUD', '�����ȡ����饦��');
    //define('_RSSC_RSS_SITE_TTL', '��������¸����');
    //define('_RSSC_RSS_SITE_RATING', '������ɾ��');
    //define('_RSSC_RSS_SITE_TEXTINPUT', '�����ȡ��ƥ���������');
    //define('_RSSC_RSS_SITE_SKIPHOURS', '�����ȡ������å׻���');
    //define('_RSSC_RSS_SITE_SKIPDAYS',  '�����ȡ������å�����');
    //define('_RSSC_RSS_IMAGE_TITLE',  _RSSC_IMAGE_TITLE);
    //define('_RSSC_RSS_IMAGE_URL',    _RSSC_IMAGE_URL);
    //define('_RSSC_RSS_IMAGE_WIDTH',  '��������');
    //define('_RSSC_RSS_IMAGE_HEIGHT', '�����ι⤵');
    //define('_RSSC_RSS_IMAGE_LINK',  _RSSC_SITE_LINK);
    //define('_RSSC_RSS_TITLE',_RSSC_TITLE);
    //define('_RSSC_RSS_LINK', _RSSC_LINK);
    //define('_RSSC_RSS_DESCRIPTION', _RSSC_DESCRIPTION);
    //define('_RSSC_RSS_PUBDATE',  _RSSC_PUBLISHED);
    //define('_RSSC_RSS_CATEGORY', _RSSC_CATEGORY);
    //define('_RSSC_RSS_SOURCE',   _RSSC_SOURCE);
    //define('_RSSC_RSS_GUID',   'RSS guid');
    //define('_RSSC_RSS_AUTHOR', '���');
    //define('_RSSC_RSS_COMMENTS','������');
    //define('_RSSC_RSS_ENCLOSURE', 'Ʊ��');

    // RDF
    //define('_RSSC_RDF_SITE_TITLE', _RSSC_SITE_TITLE);
    //define('_RSSC_RDF_SITE_LINK',  _RSSC_SITE_LINK);
    //define('_RSSC_RDF_SITE_DESCRIPTION', _RSSC_SITE_DESCRIPTION);
    //define('_RSSC_RDF_SITE_PUBLISHER',   _RSSC_SITE_WEBMASTER);
    //define('_RSSC_RDF_SITE_RIGHT', _RSSC_SITE_COPYRIGHT);
    //define('_RSSC_RDF_SITE_DATE',  _RSSC_SITE_PUBLISHED );
    //define('_RSSC_RDF_SITE_TEXTINPUT', '�����ȡ��ƥ���������');
    //define('_RSSC_RDF_SITE_IMAGE',  '�����Ȳ���');
    //define('_RSSC_RDF_IMAGE_TITLE', _RSSC_IMAGE_TITLE);
    //define('_RSSC_RDF_IMAGE_URL',   _RSSC_IMAGE_URL);
    //define('_RSSC_RDF_IMAGE_LINK',  _RSSC_SITE_LINK);
    //define('_RSSC_RDF_TITLE',_RSSC_TITLE);
    //define('_RSSC_RDF_LINK', _RSSC_LINK);
    //define('_RSSC_RDF_DESCRIPTION', _RSSC_DESCRIPTION);
    //define('_RSSC_RDF_TEXTINPUT', '�ƥ���������');

    // ATOM
    //define('_RSSC_ATOM_SITE_TITLE', _RSSC_SITE_TITLE);
    //define('_RSSC_ATOM_SITE_LINK',  _RSSC_SITE_LINK);
    //define('_RSSC_ATOM_SITE_PUBLISHED', _RSSC_SITE_PUBLISHED);
    //define('_RSSC_ATOM_SITE_UPDATED',   _RSSC_SITE_UPDATED);
    //define('_RSSC_ATOM_SITE_RIGHTS',    _RSSC_SITE_COPYRIGHT);
    //define('_RSSC_ATOM_SITE_GENERATOR', _RSSC_SITE_GENERATOR);
    //define('_RSSC_ATOM_SITE_CATEGORY',  _RSSC_SITE_CATEGORY);
    //define('_RSSC_ATOM_SITE_LINK_ALTERNATE', _RSSC_SITE_LINK);
    //define('_RSSC_ATOM_SITE_LINK_SELF', 'ATOM���Ȥ�URL');
    //define('_RSSC_ATOM_SITE_ID','������ID');
    //define('_RSSC_ATOM_SITE_CONTRIBUTOR','�����ȹ׸���');
    //define('_RSSC_ATOM_SITE_SUBTITLE','����������');
    //define('_RSSC_ATOM_SITE_ICON', '�����ȡ���������');
    //define('_RSSC_ATOM_SITE_LOGO', '�����ȡ���');
    //define('_RSSC_ATOM_SITE_SOURCE', '�����Ⱦ���');
    //define('_RSSC_ATOM_SITE_AUTHOR_NAME', _RSSC_SITE_WEBMASTER);
    //define('_RSSC_ATOM_SITE_AUTHOR_URI',  '������URL');
    //define('_RSSC_ATOM_SITE_AUTHOR_EMAIL','�����ԥ᡼��');
    //define('_RSSC_ATOM_TITLE', _RSSC_TITLE);
    //define('_RSSC_ATOM_LINK',  _RSSC_LINK);
    //define('_RSSC_ATOM_PUBLISHED', _RSSC_PUBLISHED);
    //define('_RSSC_ATOM_UPDATED',   _RSSC_UPDATED);
    //define('_RSSC_ATOM_SUMMARY',  _RSSC_SUMMARY);
    //define('_RSSC_ATOM_CONTENT',  _RSSC_CONTENT);
    //define('_RSSC_ATOM_CATEGORY', _RSSC_CATEGORY);
    //define('_RSSC_ATOM_RIGHTS',   _RSSC_RIGHTS);
    //define('_RSSC_ATOM_SOURCE',   _RSSC_SOURCE);
    //define('_RSSC_ATOM_ID','ATOM id');
    //define('_RSSC_ATOM_CONTRIBUTOR','�׸���');
    //define('_RSSC_ATOM_AUTHOR_NAME', _RSSC_AUTHOR_NAME);
    //define('_RSSC_ATOM_AUTHOR_URI',  _RSSC_AUTHOR_URI);
    //define('_RSSC_ATOM_AUTHOR_EMAIL',_RSSC_AUTHOR_EMAIL);

    // Dublin Core
    //define('_RSSC_DC_TITLE',_RSSC_TITLE);
    //define('_RSSC_DC_DESCRIPTION', _RSSC_DESCRIPTION);
    //define('_RSSC_DC_RIGHTS', _RSSC_RIGHTS);
    //define('_RSSC_DC_PUBLISHER', 'ȯ�Լ�');
    //define('_RSSC_DC_CREATOR', '����');
    //define('_RSSC_DC_DATE', '������');
    //define('_RSSC_DC_FORMAT', '����');
    //define('_RSSC_DC_RELATION', '�ط�');
    //define('_RSSC_DC_IDENTIFIER', 'ID');
    //define('_RSSC_DC_COVERAGE', '�ϰ�');
    //define('_RSSC_DC_AUDIENCE', '�ѵ�');
    //define('_RSSC_DC_SUBJECT', '����');
    //define('_RSSC_CONTENT_ENCODED', _RSSC_CONTENT);

    // link table item
    define('_RSSC_LINK_ID', '���ID');
    define('_RSSC_USER_ID', '�桼��ID');
    define('_RSSC_MOD_ID', '�⥸�塼��ID');
    define('_RSSC_LTYPE', '������');
    define('_RSSC_REFRESH_INTERVAL', '�����ֳ�');
    define('_RSSC_HEADLINE_ORDER', '�إåɥ饤����¤ӽ�');
    define('_RSSC_ENCODING', '���󥳡���');
    define('_RSSC_RDF_URL', 'RDF URL');
    define('_RSSC_RSS_URL', 'RSS URL');
    define('_RSSC_ATOM_URL', 'ATOM URL');
    define('_RSSC_RSS_MODE', 'RSS �⡼��');
    define('_RSSC_RSS_MODE_NON', '̤����');
    define('_RSSC_RSS_MODE_RDF', 'RDF����');
    define('_RSSC_RSS_MODE_RSS', 'RSS����');
    define('_RSSC_RSS_MODE_ATOM', 'ATOM����');
    define('_RSSC_RSS_MODE_AUTO', '��ư����');

    // feed table item
    define('_RSSC_FEED_ID', 'Feed ID');
    define('_RSSC_MODE_CONT', '���ƤΥ⡼��');
    define('_RSSC_RAWS', '���ǡ���');
    define('_RSSC_SEARCH_FIELD', '�������ꥢ');

    // black table item
    define('_RSSC_BLACK_ID', 'Black ID');
    define('_RSSC_WHITE_ID', 'White ID');

    // 2006-04-16 K.OHWADA
    define('_RSSC_NO_HEADLINK', '�إåɥ饤�󡦥�󥯤����򤵤�Ƥ��ʤ�');
    define('_RSSC_NO_FEED', 'feed�ǡ������ʤ�');

    // === 2006-06-04 ===
    // single link
    define('_RSSC_SINGLE_LINK', '��� ñ��ɽ��');
    define('_RSSC_SINGLE_LINK_UTF8', '��� ñ��ɽ�� UTF-8 ����');
    //define('_RSSC_SINGLE_SUMMARY', '����');
    //define('_RSSC_SINGLE_CONTENT', '��ʸ HTML���� ����');
    //define('_RSSC_UTF8_SUMMARY', '���� UTF-8 ����');
    //define('_RSSC_UTF8_CONTENT', '��ʸ HTML���� ���� UTF-8 ����');

    // detect encoding
    define('_RSSC_ASSUME_ENCODING', '���󥳡��ɤ�ưŪ�˸��ФǤ��ʤ��ä��Τǡ�<br>���󥳡��ɤ� %s �Ȳ��ꤷ����<br>');

    // rss item
    //define('_RSSC_CREATED', '������');
    //define('_RSSC_ATOM_CONTRIBUTOR_NAME', '�׸���');
    //define('_RSSC_ATOM_CONTRIBUTOR_URI',  '�׸���URL');
    //define('_RSSC_ATOM_CONTRIBUTOR_EMAIL','�׸��ԥ᡼��');

    // === 2006-07-08 ===
    // bread crumb
    //define('_HOME', '�ۡ���');

    // podcast
    define('_RSSC_PODCAST', '�ݥåɥ��㥹��');
    //define('_RSSC_ENCLOSURE_URL',    'Ʊ���ե����� Url');
    //define('_RSSC_ENCLOSURE_TYPE',   'Ʊ���ե����� Type');
    //define('_RSSC_ENCLOSURE_LENGTH', 'Ʊ���ե����� Length');

    // === 2006-09-01 ===
    // conflict with weblinks
    //if( !defined('_SAVE') )
    //{
    //	define('_HOME', '�ۡ���');
    //	define('_SAVE', '��¸');
    //	define('_SAVED','��¸����');
    //	define('_EXECUTE', '�¹�');
    //	define('_EXECUTED','�¹Ԥ���');
    //	define('_CREATE', '����');
    //	define('_CREATED','��������');
    //}

    // error message
    define('_RSSC_DB_ERROR', 'RSSC DB ���顼');
    define('_RSSC_DISCOVER_SUCCEEDED', 'RSS �μ�ư���Ф���������');
    define('_RSSC_DISCOVER_FAILED', 'RSS �μ�ư���� (Auto Discovery) ������ʤ��ä�');
    define('_RSSC_PARSE_MSG', 'RSS ���ϥ�å�����');
    define('_RSSC_PARSE_FAILED', 'RSS �β��Ϥ�����ʤ��ä�');
    define('_RSSC_PARSE_NOT_READ_XML_URL', 'RSS ���ϼ���: RSS URL ���ɤ߽Ф��ʤ��ä�');
    define('_RSSC_PARSE_NOT_FIND_ENCODING', 'RSS ���ϼ���: encoding �θ��Ф�����ʤ��ä�');
    define('_RSSC_REFRESH_ERROR', 'RSS �ι������顼');
    define('_RSSC_LINK_NOT_EXIST', 'RSSC�⥸�塼������б������󥯤�¸�ߤ��Ƥ��ʤ�');
    define('_RSSC_LINK_EXIST_MORE', 'Ʊ��"RDF/RSS/ATOM URL"�����ʣ���Υ�󥯤����Ĥ���ޤ���');
    define('_RSSC_LINK_ALREADY', '����"RDF/RSS/ATOM URL"����Ͽ�ѤߤǤ�');

    // for other module
    define('_RSSC_RSSC_LID', 'RSSC�⥸�塼��Υ��ID');
    define('_RSSC_RSSC_LID_UPDATE', 'RSSC�⥸�塼��Υ��ID���ѹ�����');
    define('_RSSC_GOTO_RSSC_ADMIN_LINK', 'RSSC�⥸�塼��δ������̤�');

    // refresh link
    define('_RSSC_REFRESH_LINK', 'feed �����ι���');
    define('_RSSC_REFRESH_LINK_DSC', '����³���ơ�RDF/RSS/ATOM �� feed �����򹹿����ޤ���<br>�⤷���ꤵ��Ƥ��ʤ���С�<br> <b>RDF/RSS/ATOM URL</b> �� <b>���󥳡���</b> ��ưŪ�˸��Ф��ޤ���');
    define('_RSSC_REFRESH_LINK_FINISHED', 'feed �����򹹿�����');

    // === 2007-06-01 ===
    // word table
    define('_RSSC_WORD_ID', 'Word ID');
    define('_RSSC_WORD_WORD', '�ػ߸�');
    define('_RSSC_WORD_POINT', '����');
    define('_RSSC_ACT', '����');
    define('_RSSC_ACT_NON', '̵��');
    define('_RSSC_ACT_ACT', 'ͭ��');
    define('_RSSC_REG', 'URL��ɽ��');
    define('_RSSC_REG_NORMAL', '�̾�');
    define('_RSSC_REG_EXP', '����ɽ��');
    define('_RSSC_FREQ_COUNT', '�и����');

    // feed table
    define('_RSSC_FEED_ACT', 'ɽ������');
    define('_RSSC_FEED_ACT_NON', '��ɽ��');
    define('_RSSC_FEED_ACT_VIEW', 'ɽ��');

    // link table
    define('_RSSC_LTYPE_NON', 'feed ��������ʤ�');
    define('_RSSC_LTYPE_SEARCH', '����������');
    define('_RSSC_LTYPE_NORMAL', '�̾�');

    define('_RSSC_XML_URL', 'RDF/RSS/ATOM URL');

    // === 2007-10-10 ===
    // link table
    define('_RSSC_LINK_ENCLOSURE', 'enclusure �����ΰ���');
    define('_RSSC_LINK_ENCLOSURE_NON', '̤����');
    define('_RSSC_LINK_ENCLOSURE_POD', 'PodCast�ȸ��ʤ�');
    define('_RSSC_LINK_CENSOR', '�����ȥ�ζػ��Ѹ�');
    //define('_RSSC_LINK_PLUGIN','�ץ饰����');

    // black & white table
    define('_RSSC_BW_CACHE', 'feed ������ȤΥ���å���');
    define('_RSSC_BW_CTIME', 'feed ������ȤΥ���å������');

    // keyword manage
    define('_RSSC_KEYWORD', '�������');

    // === 2008-01-20 ===
    // plugin list
    define('_RSSC_PLUGIN_LIST', '�ץ饰�������');
    define('_RSSC_PLUGIN_NAME', '�ץ饰����̾');
    define('_RSSC_PLUGIN_DESCRIPTION', '����');
    define('_RSSC_PLUGIN_USAGE', '�Ȥ���');

    // link table
    define('_RSSC_PRE_PLUGIN', '�������ץ饰����');
    define('_RSSC_POST_PLUGIN', '������ץ饰����');

    // === 2009-02-20 ===
    // map
    define('_RSSC_MAP', 'Google�ޥå�');

    // link table
    define('_RSSC_LINK_ICON', '��������');
    define('_RSSC_LINK_GICON_ID', 'Google���������ֹ�');

    // feed table
    define('_RSSC_FEED_GEO_LAT', '����');
    define('_RSSC_FEED_GEO_LONG', '����');
    define('_RSSC_FEED_MEDIA_CONTENT_URL', '����ƥ��URL');
    define('_RSSC_FEED_MEDIA_CONTENT_TYPE', '����ƥ�ȡ�������');
    define('_RSSC_FEED_MEDIA_CONTENT_MEDIUM', '����ƥ�ȡ���ǥ���');
    define('_RSSC_FEED_MEDIA_CONTENT_WIDTH', '����ƥ�Ȳ���');
    define('_RSSC_FEED_MEDIA_CONTENT_HEIGHT', '����ƥ�ȹ⤵');
    define('_RSSC_FEED_MEDIA_THUMBNAIL_URL', '����ͥ���URL');
    define('_RSSC_FEED_MEDIA_THUMBNAIL_WIDTH', '����ͥ��벣��');
    define('_RSSC_FEED_MEDIA_THUMBNAIL_HEIGHT', '����ͥ���⤵');
}
// --- define language end ---
