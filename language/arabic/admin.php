<?php
// $Id: admin.php,v 1.1 2011/12/29 14:37:08 ohwada Exp $

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

// --- define language begin ---
if (!defined('RSSC_LANG_AM_LOADED')) {
    define('RSSC_LANG_AM_LOADED', 1);

    // === menu ===
    define('_AM_RSSC_CONF', 'ÅÏÇÑÉ ãÑßÒ ÇáÚäÇæíä');
    define('_AM_RSSC_LIST_LINK', 'ÞÇÆãÉ ÇáÑæÇÈØ');
    define('_AM_RSSC_LIST_BLACK', 'ÇáÞÇÆãÉ ÇáÓæÏÇÁ');
    define('_AM_RSSC_LIST_WHITE', 'ÇáÞÇÆãÉ ÇáÈíÖÇÁ');
    define('_AM_RSSC_LIST_FEED', 'ÞÇÆãÉ Feed');
    define('_AM_RSSC_ADD_LINK', 'ÃÖÝ ÑÇÈØ');
    define('_AM_RSSC_ADD_BLACK', 'ÃÖÝ Çáí ÇáÞÇÆãÉ ÇáÓæÏÇÁ');
    define('_AM_RSSC_ADD_WHITE', 'ÃÖÝ Çáí ÇáÞÇÆãÉ ÇáÈíÖÇÁ');
    define('_AM_RSSC_ADD_KEYWORD', 'Add Keyword');
    define('_AM_RSSC_ARCHIVE_MANAGE', 'ÅÏÇÑÉ ÇáÃÑÔíÝ');

    //define('_AM_RSSC_COMMAND_MANAGE', 'Command Management');

    define('_AM_RSSC_UPDATE_MANAGE', 'ÅÏÇÑÉ ÇáÇÓÊíÑÇÏ');
    define('_AM_RSSC_VIEW_RSS', 'ÚÑÖ RDF/RSS/ATOM');

    //define('_AM_RSSC_GOTO_MODULE', 'Goto Module');

    // === index & config ===
    define('_AM_RSSC_FORM_BASIC', 'ÎíÇÑÇÊ ÃæáíÉ');
    define('_AM_RSSC_FORM_BASIC_DESC', 'ÎíÇÑÇÊ ÇáÈÑäÇãÌ ÇáÚÇãÉ');
    define('_AM_RSSC_FORM_MAIN', 'ÇáÕÝÍÉ ÇáÑÆíÓíÉ');
    define('_AM_RSSC_FORM_MAIN_DESC', 'íÓÊÎÏã Ýí ÕÝÍÉ ÇáÈÑäÇãÌ ÇáÑÆíÓíÉ');
    define('_AM_RSSC_FORM_BLOCK', 'ÎíÇÑ ÇáÕÝÍÉ ÇáÑÆíÓíÉ');
    define('_AM_RSSC_FORM_BLOCK_DESC', 'íÓÊÚãá áØÑíÞÉ ÇáÚÑÖ Ýí ÇáÈáæß');

    //define('_AM_RSSC_FORM_BIN', 'Command Config');
    //define('_AM_RSSC_FORM_BIN_DESC', 'It is used on bin command');
    //define('_AM_RSSC_INIT_NOT','The config table is not initialized');
    //define('_AM_RSSC_INIT_EXEC','Initialized the config table');
    //define('_AM_RSSC_VERSION_NOT','It is not version  %s');
    //define('_AM_RSSC_UPGRADE_EXEC','Upgrade the config table');
    //define('_AM_RSSC_WARNING_NOT_WRITABLE','Not writable the directory');
    //define('_AM_RSSC_CONF_NAME','Item');

    define('_AM_RSSC_DBUPDATED', 'Êã ÊÍÏíË ÞÇÚÏÉ ÇáÈíÇäÇÊ ÈäÌÇÍ !');
    define('_AM_RSSC_FAILUPDATE', 'ÎØÃ Ýí ÍÝÙ ÇáÈíÇäÇÊ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ');
    define('_AM_RSSC_FAILDELETE', 'ÎØÃ Ýí ÍÐÝ ÇáÈíÇäÇÊ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ');
    define('_AM_RSSC_THERE_ARE_LINKS', 'íæÌÏ <b>%s</b> ÑÇÈØ');
    define('_AM_RSSC_THERE_ARE_FEEDS', 'íæÌÏ <b>%s</b> Feeds');

    // === link manage ===
    define('_AM_RSSC_LINK_MANAGE', 'ÅÏÇÑÉ ÇáÑæÇÈØ');
    define('_AM_RSSC_MOD_LINK', 'ÊÚÏíá ÑÇÈØ');
    define('_AM_RSSC_DEL_LINK', 'ÍÐÝ ÑÇÈØ');
    define('_AM_RSSC_SHOW_RSS', 'ÚÑÖ RSS');
    define('_AM_RSSC_SHOW_FEED', 'ÚÑÖ Feed');
    define('_AM_RSSC_FEED_BELONG_LINK', 'Show feeds belonging to this link');
    define('_AM_RSSC_ERROR_FILL', 'Error: Enter %s');
    define('_AM_RSSC_ERROR_ILLEGAL', 'Error: Illegal %s');

    // === black list manage ===
    define('_AM_RSSC_BLACK_MANAGE', 'ÅÏÇÑÉ ÇáÞÇÆãÉ ÇáÓæÏÇÁ');
    define('_AM_RSSC_MOD_BLACK', 'ÊÚÏíá ÇáÞÇÆãÉ ÇáÓæÏÇÁ');
    define('_AM_RSSC_DEL_BLACK', 'ÍÐÝ ÇáÞÇÆãÉ ÇáÓæÏÇÁ');
    define('_AM_RSSC_FEED_MATCH_LINK', 'Show feeds which is matched with this list');

    // === white list manage ===
    define('_AM_RSSC_WHITE_MANAGE', 'ÅÏÇÑÉ ÇáÞÇÆãÉ ÇáÈíÖÇÁ');
    define('_AM_RSSC_MOD_WHITE', 'ÊÚÏíá ÇáÞÇÆãÉ ÇáÈíÖÇÁ');
    define('_AM_RSSC_DEL_WHITE', 'ÍÐÝ ÇáÞÇÆãÉ ÇáÈíÖÇÁ');

    // === feed list manage ===
    define('_AM_RSSC_ADD_FEED', 'ÃÖÝ Feed');
    define('_AM_RSSC_MOD_FEED', 'ÊÚÏíá Feed');
    define('_AM_RSSC_DEL_FEED', 'ÍÐÝ Feed');
    define('_AM_RSSC_THERE_ARE_MATCH', 'There are <b>%s</b> datas which is matched to with conditions');
    define('_AM_RSSC_CONDITION', 'Condition');

    // === archive manage ===
    define('_AM_RSSC_REFRESH', 'ÊÍÏíË ÇáÇÑÔíÝ');
    define('_AM_RSSC_REFRESH_NEXT', 'ÝÍÕ ÇáÊÇáí %s');
    define('_AM_RSSC_LINK_LIMIT', 'Link Limit');
    define('_AM_RSSC_LINK_OFFSET', 'LInk Offset');
    define('_AM_RSSC_FEED_CLEAR', 'ãÓÍ ÇáÇÑÔíÝ');
    define('_AM_RSSC_FEED_CLEAR_OLD', 'ãÓÍ ÇáÓÌáÇÊ ÇáÞÏíãÉ');
    define('_AM_RSSC_FEED_CLEAR_NUM', 'ãÓÍ ÇáÓÌáÇÊ ÇáÞÏíãÉ ÇÐÇ ßÇäÊ ÇßËÑ ãä ÇáÚÏÏ ÇáãÍÏÏ');

    // refresh result
    define('_AM_RSSC_NO_REFRESH', 'áÇ  íæÌÏ ÑÇÈØ ááÊÍÏíË');
    define('_AM_RSSC_TIME_START', 'ÅÈÊÏÇÁ ÇáæÞÊ');
    define('_AM_RSSC_TIME_END', 'ÅäÊåÇÁ ÇáæÞÊ');
    define('_AM_RSSC_TIME_ELAPSE', 'ãÖì æÞÊ');
    define('_AM_RSSC_MIN_SEC', '%s ÏÞíÞÉ %s ËÇäíÉ');
    define('_AM_RSSC_NUM_LINK_TOTAL', 'ãÌãæÚ ÇáÑæÇÈØ');
    define('_AM_RSSC_NUM_LINK_TARGET', 'ÚÏÏ ÇáÑæÇÈØ ÇáãÓÊåÏÝÉ');
    define('_AM_RSSC_NUM_LINK_BROKEN', 'ÚÏÏ ÇáÑæÇÈØ ÇáÊí áÇ ÊÚãá');
    define('_AM_RSSC_NUM_LINK_UPDATED', 'ÚÏÏ ÇáÑæÇÈØ ÇáãÍÏËÉ');
    define('_AM_RSSC_NUM_FEED_UPDATED', 'ÚÏÏ feeds ÇáãÍÏË');
    define('_AM_RSSC_NUM_FEED_CLEARED', 'ÚÏÏ feeds ÇáããÓæÍ');
    define('_AM_RSSC_NUM_LINKS', 'ÑæÇÈØ');
    define('_AM_RSSC_NUM_FEEDS', 'feeds');
    define('_AM_RSSC_FAILGET', 'áÇ íãßä ÌáÈ XML ãä %s');
    define('_AM_RSSC_GOTOTOP', 'ÇáÃÚáì');

    // === configuration ===
    // basic configuration
    define('_AM_RSSC_CONF_FEED_LIMIT', 'ÇáÚÏÏ ÇáÃÞÕì áÜ feeds');
    define('_AM_RSSC_CONF_FEED_LIMIT_DESC', 'ÃßÊÈ ÇÞÕì ÚÏÏ ãä feeds ÇáÊí ÊÎÒä Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ<br>ÓæÝ ÊãÓÍ ÇáÓÌáÇÊ ÇáÞÏíãÉ ÚäÏãÇ íßæä ÇßËÑ ãä åÐÇ ÇáÑÞã<br><b>0</b> ÛíÑ ãÍÏæÏ');
    define('_AM_RSSC_CONF_RSS_ATOM', 'ÃÎÊÑ RSS Ãæ ATOM');
    define('_AM_RSSC_CONF_RSS_ATOM_DESC', 'Select RSS or ATOM, when both RSS URL and ATOM URL are detected');
    define('_AM_RSSC_CONF_RSS_ATOM_SEL_ATOM', 'ATOM');
    define('_AM_RSSC_CONF_RSS_ATOM_SEL_RSS', 'RSS');
    define('_AM_RSSC_CONF_RSS_PARSER', 'Select RSS paser');
    define('_AM_RSSC_CONF_RSS_PARSER_SELF', 'RSSC parser');
    define('_AM_RSSC_CONF_RSS_PARSER_XOOPS', 'XOOPS RSS Parser');
    define('_AM_RSSC_CONF_ATOM_PARSER', 'select ATOM parser');
    define('_AM_RSSC_CONF_ATOM_PARSER_0', 'RSSC parser');
    define('_AM_RSSC_CONF_ATOM_PARSER_1', '');
    define('_AM_RSSC_CONF_RSS_MODE', 'Initial value of RSS mode');
    define('_AM_RSSC_CONF_XML_SAVE', 'ÍÝÙ XML');
    define('_AM_RSSC_CONF_XML_SAVE_DESC', 'ÍÝÙ ÑÇÈØ XML Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ');
    define('_AM_RSSC_CONF_FUTURE_DAYS', 'ÇáÃíÇã ÇáÞÇÏãÉ (ÇáãÓÊÞÈáíÉ)');
    define('_AM_RSSC_CONF_FUTURE_DAYS_DESC', "1 ÚÈÇÑÉ Úä íæã<br>Not show feed, if feed's date is rather than this days");

    // show configuration
    define('_AM_RSSC_CONF_SHOW_ORDER', 'ØÑíÞÉ ÇáÚÑÖ');
    //define('_AM_RSSC_CONF_SHOW_ORDER_DESC','');
    define('_AM_RSSC_CONF_SHOW_ORDER_UPDATED', 'ÂÎÑ ÊÍÏíË');
    define('_AM_RSSC_CONF_SHOW_ORDER_PUBLISHED', 'ÂÎÑ äÔÑ');
    define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE', 'ÑÇÈØ Ýí ßá ÕÝÍÉ');
    //define('_AM_RSSC_CONF_SHOW_LINKS_PER_PAGE_DESC','');
    define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE', 'Feeds Ýí ßá ÕÝÍÉ');
    //define('_AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE_DESC','');
    define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK', 'Feeds áßá ÑÇÈØ');
    //define('_AM_RSSC_CONF_SHOW_FEEDS_PER_LINK_DESC','');
    define('_AM_RSSC_CONF_SHOW_MAX_TITLE', 'ÇáÚÏÏ ÇáÃÞÕì ááÍÑÝ Ýí ÇáÚäæÇä');
    define('_AM_RSSC_CONF_SHOW_MAX_TITLE_DESC', 'ÇÒÇáÉ ÊÇÛ html ÚäÏãÇ íßæä ÇßËÑ ãä åÐÇ ÇáÚÏÏ <br><b>(-1)</b> ÛíÑ ãÍÏæÏ');
    define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY', 'ÃÞÕì ÚÏÏ ãä ÇáÍÑæÝ Ýí ÇáÎáÇÕÉ');
    define('_AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC', '<b>(-1)</b> ÛíÑ ãÍÏæÏ');

    // main configuration
    define('_AM_RSSC_CONF_MAIN_SEARCH_MIN', 'ÇÃÞá ÚÏÏ ãä ÇáÍÑæÝ Ýí ÇáÈÍË');
    //define('_AM_RSSC_CONF_MAIN_SEARCH_MIN_DESC','');

    // bin configuration
    //define('_AM_RSSC_CONF_BIN_PASS','Password');
    //define('_AM_RSSC_CONF_BIN_PASS_DESC','');
    //define('_AM_RSSC_CONF_BIN_SEND','Send Mail');
    //define('_AM_RSSC_CONF_BIN_SEND_DESC','');
    //define('_AM_RSSC_CONF_BIN_MAILTO','Email to send');
    //define('_AM_RSSC_CONF_BIN_MAILTO_DESC','');

    // === view rss ===
    define('_AM_RSSC_VIEW_RSS_OPTION', 'æÖÚ ÇáÎíÇÑÇÊ');
    define('_AM_RSSC_NOT_SELECT_LINK', 'ÇáÑÇÈØ ÛíÑ ãÍÏÏ');
    define('_AM_RSSC_PLEASE_SELECT_LINK', 'ÅÎÊÑ ãä ÞÇÆãÉ ÇáÑæÇÈØ Ãæ ÅÏÎá ÑÞã ÇáÑÇÈØ');
    define('_AM_RSSC_VIEW_PARSER', 'Parser Setting');
    define('_AM_RSSC_VIEW_SAVE_ETC', 'ÍÝÙ Ýí ÇáÌÏæá');
    define('_AM_RSSC_VIEW_MODE', 'ÚÑÖ ÇáäãØ');
    define('_AM_RSSC_VIEW_MODE_DESC', 'Dont save in table, when mode is 0');
    define('_AM_RSSC_VIEW_MODE_CURRENT', 'mode 0: getting XML data');
    define('_AM_RSSC_VIEW_MODE_LINK', 'mode 1: XML data saved in link table');
    define('_AM_RSSC_VIEW_MODE_FEED', 'mode 2: data saved in feed table');
    define('_AM_RSSC_VIEW_SANITIZE', 'HTML Sanitize');
    define('_AM_RSSC_VIEW_TITLE_HTML', 'ÚÑÖ ÊÇÛ HTML Ýí ÇáÚäæÇä');
    define('_AM_RSSC_VIEW_TITLE_HTML_DESC', 'äÚã", ÚÑÖ ÊÇÛ htm ãÚ ÇáÚäæÇä ÇÐÇ ßÇä ãæÌæÏ . <br>"áÇ"áÇÊÚÑÖ ÊÇÛ html ãÚ ÇáÚäæÇä. ');
    define('_AM_RSSC_VIEW_CONTENT_HTML', 'ÚÑÖ ÊÇÛ HTML Ýí ÇáãÍÊæì');
    define('_AM_RSSC_VIEW_CONTENT_HTML_DESC', 'äÚã", ÚÑÖ ÊÇÛ htm ãÚ ÇáãÍÊæì ÇÐÇ ßÇä ãæÌæÏ . <br>"áÇ", áÇÊÚÑÖ ÊÇÛ html ãÚ ÇáãÍÊæì. ');
    define('_AM_RSSC_VIEW_MAX_CONTENT', 'ÃÞÕì ÚÏÏ ãä ÇáÍÑæÝ Ýí ÇáãÍÊæì');
    define('_AM_RSSC_VIEW_MAX_CONTENT_DESC', 'ÅÒÇáÉ ÊÇÛ HTML ÚäÏãÇ íßæä ÃßËÑ ãä ÇáÚÏÏ<br><b>(-1)</b> ÛíÑ ãÍÏæÏ');
    define('_AM_RSSC_VIEW_LINK_UPDATE', 'ÊÍÏíË ÌÏæá ÇáÑæÇÈØ');
    define('_AM_RSSC_VIEW_FEED_UPDATE', 'ÊÍÏíË ÌÏæá Feed');
    define('_AM_RSSC_VIEW_FORCE_DISCOVER', 'Force to discover RSS URL');
    define('_AM_RSSC_VIEW_FORCE_DISCOVER_DESC', 'Overwrite RDF/RSS/ATOM URL, after detecting this URL not related to RSS mode');
    define('_AM_RSSC_VIEW_FORCE_UPDATE', 'ÊÌÏíÏ ÇáÃÑÔíÝ');
    define('_AM_RSSC_VIEW_FORCE_UPDATE_DESC', 'Overwrite Archive, after getting RDF/RSS/ATOM not related to Refresh Interval');
    define('_AM_RSSC_VIEW_FORCE_OVERWRITE', 'ÊÌÏíÏ Feed Ýí ÇáÌÏæá');
    define('_AM_RSSC_VIEW_FORCE_OVERWRITE_DESC', 'Overwrite Feed table, even if exists the the same data of RDF/RSS/ATOM URL');
    define('_AM_RSSC_VIEW_PRINT_LOG', 'ÚÑÖ ÇáÓÌá');
    define('_AM_RSSC_VIEW_PRINT_LOG_DESC', 'ÚÑÖ ÇáÓÌá ÈÔßá Âäí ÃËäÇÁ ÇáÊäÝíÐ');
    define('_AM_RSSC_VIEW_PRINT_ERROR', 'ÚÑÖ ÇáÃÎØÇÁ');
    define('_AM_RSSC_VIEW_PRINT_ERROR_DESC', 'ÚÑÖ ÇáÃÎØÇÁ ÈÔßá Âäí ÃËäÇÁ ÇáÊäÝíÐ');

    // === command manage ===
    //define('_AM_RSSC_CREATE_CONFIG', 'Create Config File');
    //define('_AM_RSSC_TEST_BIN_REFRESH', 'Test to execute bin/refresh.php');

    // === update manage ===
    define('_AM_RSSC_IMPORT_XOOPSHEADLINE', 'ÌáÈ ãä ÈÑäÇãÌ XoopsHeadline');
    define('_AM_RSSC_IMPORT_WEBLINKS', 'ÌáÈ ãä Ïáíá ÇáãæÇÞÚ');

    // === rename ===
    define('_AM_RSSC_VIEW_FEED_PERPAGE', _AM_RSSC_CONF_SHOW_FEEDS_PER_PAGE);
    define('_AM_RSSC_VIEW_MAX_TITLE', _AM_RSSC_CONF_SHOW_MAX_TITLE);
    define('_AM_RSSC_VIEW_MAX_TITLE_DESC', _AM_RSSC_CONF_SHOW_MAX_TITLE_DESC);
    define('_AM_RSSC_VIEW_MAX_SUMMARY', _AM_RSSC_CONF_SHOW_MAX_SUMMARY);
    define('_AM_RSSC_VIEW_MAX_SUMMARY_DESC', _AM_RSSC_CONF_SHOW_MAX_SUMMARY_DESC);
    define('_AM_RSSC_VIEW_XML_SAVE', _AM_RSSC_CONF_XML_SAVE);
    define('_AM_RSSC_VIEW_XML_SAVE_DESC', _AM_RSSC_CONF_XML_SAVE_DESC);

    // 2006-01-20
    define('_AM_RSSC_ID_ASC', 'ÊÕÇÚÏ');
    define('_AM_RSSC_ID_DESC', 'ÊäÇÒáí');

    // === 2006-06-04 ===
    // build rss
    //define('_AM_RSSC_BUILD', 'Build RDF/RSS/ATOM');
    //define('_AM_RSSC_BUILD_DSC',  'Build and show RDF/RSS/ATOM for debug');
    //define('_AM_RSSC_BUILD_RDF',  'Build RDF');
    //define('_AM_RSSC_BUILD_RSS',  'Build RSS');
    //define('_AM_RSSC_BUILD_ATOM', 'Build ATOM');

    // parse rss
    define('_AM_RSSC_PARSE_RSS', 'ÊÚÏíá ÎÇÕ Úáí RDF/RSS/ATOM');

    // refresh link
    //define('_AM_RSSC_REFRESH_LINK', 'Refresh RDF/RSS/ATOM feeds');
    //define('_AM_RSSC_REFRESH_LINK_DSC', 'Then, refresh RSS feeds <br>Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br>if they are not set up.');
    //define('_AM_RSSC_REFRESH_LINK_FINISHED', 'Refresh feeds finished');

    // === 2006-07-08 ===
    // description at main
    define('_AM_RSSC_CONF_INDEX_DESC', 'ÇáæÕÝ Ýí ÇáÕÝÍÉ ÇáÑÆíÓíÉ');
    define('_AM_RSSC_CONF_INDEX_DESC_DSC', 'ÇßÊÈ ãáÇÍÙÉ ÇáæÕÝ¡ ÚäÏãÇ ÊÑíÏ ÚÑÖåÇ Ýí ÇáÕÝÍÉ ÇáÑÆíÓíÉ.');
    define('_AM_RSSC_CONF_INDEX_DESC_DEFAULT', '<div align="center" style="color: #0000ff">Here are description note.<br>You can edit description note at "Module Configuration".<br></div><br>');

    // link table
    define('_AM_RSSC_LINK_DESC', 'Discover <b>RDF/RSS/ATOM URL</b> automatically and detect <b>Encoding</b> automatically, <br>when you dont fill, <br>if web site support "RSS Auto Discovery"');
    //define('_AM_RSSC_LINK_EXIST', 'Already exists this "RDF/RSS/ATOM URL"');
    //define('_AM_RSSC_LINK_EXIST_MORE','There are twe or more links which have same "RDF/RSS/ATOM URL" ');
    //define('_AM_RSSC_AUTO_FIND_FAILD','RSS Auto Discovery Faild');
    define('_AM_RSSC_LINK_FORCE', 'Froce to save');

    // black & white table
    define('_AM_RSSC_BLACK_MEMO', 'ÇáãÐßÑÉ');

    // === 2006-09-20 ===
    // show content with html
    define('_AM_RSSC_CONF_SHOW_TITLE_HTML', 'ÇÓÊÚãá ÊÇÛ HTML Ýí ÇáÚäæÇä');
    define('_AM_RSSC_CONF_SHOW_TITLE_HTML_DSC', '"äÚã", ÚÑÖ ÊÇÛ htm ãÚ ÇáÚäæÇä ÇÐÇ ßÇä ãæÌæÏ . <br>"áÇ"áÇÊÚÑÖ ÊÇÛ html ãÚ ÇáÚäæÇä. ');
    define('_AM_RSSC_CONF_SHOW_CONTENT_HTML', 'ÇÓÊÚãá ÊÇÛ HTML Ýí ÇáãÍÊæì');
    define('_AM_RSSC_CONF_SHOW_CONTENT_HTML_DSC', '"äÚã", ÚÑÖ ÊÇÛ htm ãÚ ÇáãÍÊæì ÇÐÇ ßÇä ãæÌæÏ . "áÇ", áÇÊÚÑÖ ÊÇÛ html ãÚ ÇáãÍÊæì.');
    define('_AM_RSSC_CONF_SHOW_MAX_CONTENT', 'ÇÞÕì ÚÏÏ ãä ÇáÍÑæÝ Ýí ÇáãÍÊæì');
    define('_AM_RSSC_CONF_SHOW_MAX_CONTENT_DSC', 'ÇÒÇáÉ ÊÇÛ html ÚäÏãÇ íßæä ÇßËÑ ãä åÐÇ ÇáÚÏÏ <br><b>(-1)</b> ÛíÑ ãÍÏæÏ');
    define('_AM_RSSC_CONF_SHOW_NUM_CONTENT', 'Maximum number of RSS/ATOM feeds displayed content');
    define('_AM_RSSC_CONF_SHOW_NUM_CONTENT_DSC', 'Enter the maximum number of RSS/ATOM feeds displayed content.');
    define('_AM_RSSC_CONF_SHOW_BLOG_LID', 'ÑÞã ÇáÑÇÈØ áÚÑÖ ÇáÈáæÞ');
    //define('_AM_RSSC_CONF_SHOW_BLOG_LID_DSC', 'Enter Link ID to be show blog.');

    define('_AM_RSSC_TABLE_MANAGE', 'ÅÏÇÑÉ ÞÇÚÏÉ ÇáÈíÇäÇÊ');

    // === 2006-11-08 ===
    // proxy server
    define('_AM_RSSC_FORM_PROXY', 'ÎíÇÑÇÊ ÓíÑÝÑ ÇáÈÑæßÓí');
    define('_AM_RSSC_CONF_PROXY_USE', 'ÇÓÊÚãá ÓíÑÝÑ ÇáÈÑæßÓí');
    define('_AM_RSSC_CONF_PROXY_HOST', 'ÈÑæßÓí ÇáãÖíÝ');
    define('_AM_RSSC_CONF_PROXY_PORT', 'ÈÑæßÓí ÈæÑÊ');
    define('_AM_RSSC_CONF_PROXY_USER', 'ÇÓã ãÓÊÎÏã ÇáÈÑæßÓí');
    define('_AM_RSSC_CONF_PROXY_USER_DESC', 'ÇßÊÈ ÇÓã ÇáãÓÊÎÏã ÇÐÇ ßÇä íÍÊÇÌ, <br>ÇÊÑßÉ ÝÇÑÛÇ ÇÐÇ áã íßä íÍÊÇÌ');
    define('_AM_RSSC_CONF_PROXY_PASS', 'ÇáÑÞã ÇáÓÑí ááÈÑæßÓí');
    define('_AM_RSSC_CONF_PROXY_PASS_DESC', 'ÇßÊÈ ÇáÑÞã ÇáÓÑí ÇÐÇ ßÇä íÍÊÇÌ,  <br>ÇÊÑßÉ ÝÇÑÛÇ ÇÐÇ áã íä íÍÊÇÌ');

    define('_AM_RSSC_CONF_HIGHLIGHT', 'Use Keyword Highlight');

    // === 2007-06-01 ===
    // word_list
    define('_AM_RSSC_LIST_WORD', 'ÞÇÆãÉ ÇáßáãÇÊ ÇáãÑÝæÖÉ');
    define('_AM_RSSC_WORD_MANAGE', 'ÅÏÇÑÉ ÇáßáãÇÊ ÇáãÑÝæÖÉ');
    define('_AM_RSSC_ADD_WORD', 'ÃÖÝ ßáãÉ');
    define('_AM_RSSC_MOD_WORD', 'ÊÚÏíá ßáãÉ');
    define('_AM_RSSC_DEL_WORD', 'ÍÐÝ ßáãÉ');
    define('_AM_RSSC_POINT_ASC', 'Little Point Order');
    define('_AM_RSSC_POINT_DESC', 'Much Point Order');
    define('_AM_RSSC_COUNT_ASC', 'Little Frequency Count Order');
    define('_AM_RSSC_COUNT_DESC', 'Much Frequency Count Order');
    define('_AM_RSSC_WORD_ASC', 'A-Z Order');
    define('_AM_RSSC_WORD_DESC', 'Z-A Order');
    define('_AM_RSSC_NON_ACT', 'áÇ ÊÚÑÖ ÇáÞÇÆãÉ ');
    define('_AM_RSSC_NON_ACT_ASC', 'áÇ ÊÚÑÖ ÇáÑÞã ÊÕÇÚÏí');
    define('_AM_RSSC_NON_ACT_DESC', 'áÇ ÊÚÑÖ ÇáÑÞã ÊäÇÒáí');
    define('_AM_RSSC_WORD_ALREADY', 'åÐå ÇáßáãÉ ãÓÌáÉ ãÓÈÞÇ');
    define('_AM_RSSC_WORD_SEARCH', 'ÈÍË ãÑÇÏÝ');

    // content filter
    define('_AM_RSSC_FORM_FILTER', 'ÎíÇÑÇÊ ÇáÝáÊÑ');
    define('_AM_RSSC_FORM_FILTER_DESC', 'åÐÇ ÇáÝáÊÑ íÞÑÑ íÍÝÙ Ãæ áÇ íÍÝÙ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ ÚäÏ ÌáÈ feeds Âáí');
    define('_AM_RSSC_CONF_LINK_USE', 'ÇÓÊÚãá ÑÇÈØ ÇáÌÏæá');
    define('_AM_RSSC_CONF_LINK_USE_DESC', 'ÇÓÊÚãá ÚäÏãÇ íßæä "äæÚ" ÚÇÏí');
    define('_AM_RSSC_CONF_WHITE_USE', 'ÇÓÊÚãá ÇáÞÇÆãÉ ÇáÈíÖÇÁ');
    define('_AM_RSSC_CONF_WHITE_USE_DESC', 'ÍÝÙ ÚäÏãÇ íßæä Ýí ÇáÞÇÆãÉ ÇáÈíÖÇÁ');
    define('_AM_RSSC_CONF_BLACK_USE', 'ÇÓÊÚãá ÇáÞÇÆãÉ ÇáÓæÏÇÁ');
    //define('_AM_RSSC_CONF_BLACK_USE_DESC','Not store when in black list');
    define('_AM_RSSC_CONF_BLACK_USE_DESC', 'Not store when in black list<br>When select "Use", interrupt filtering process, if judge black<br>When select "Learning", continue filtering process, for purpose extracting words, if judge black');
    define('_AM_RSSC_CONF_BLACK_USE_NO', 'áÇ ÊÓÊÚãá');
    define('_AM_RSSC_CONF_BLACK_USE_YES', 'ÇÓÊÚãá');
    define('_AM_RSSC_CONF_BLACK_USE_LEARN', 'ÊÚáã');
    define('_AM_RSSC_CONF_WORD_USE', 'ÇÓÊÚãÇá ÞÇÆãÉ ÇáßáãÇÊ ÇáãÑÝæÖÉ');
    define('_AM_RSSC_CONF_WORD_USE_DESC', 'áä íÊã ÇáÍÝÙ ÚäÏãÇ ÊÊÌÇæÒ äÞÇØ ÇáßáãÇÊ ÇáãÑÝæÖÉ ÇáÑÞã Ýí ãÓÊæì ÇáÑÝÖ');
    define('_AM_RSSC_CONF_WORD_LEVEL', 'ãÓÊæì ÇáÑÝÖ');
    define('_AM_RSSC_CONF_FEED_SAVE', 'ÍÝÙ Feed');
    define('_AM_RSSC_CONF_FEED_SAVE_DESC', 'Store or not into feed table when judge black.<br>When "Save", save in "not show" status.');
    define('_AM_RSSC_CONF_FEED_SAVE_NO', 'áÇ ÊÍÝÙ');
    define('_AM_RSSC_CONF_FEED_SAVE_YES', 'ÍÝÙ');
    define('_AM_RSSC_CONF_LOG_USE', 'ÇÓÊÚãÇá ÓÌá ÇáãáÝ');
    define('_AM_RSSC_CONF_LOG_USE_DESC', 'Write log file when judge black');
    define('_AM_RSSC_CONF_WHITE_COUNT', 'ÅÍÓÈ ÇáÞÇÆãÉ ÇáÈíÖÇÁ');
    define('_AM_RSSC_CONF_WHITE_COUNT_DESC', 'Count up the matching record when match with white list');
    define('_AM_RSSC_CONF_BLACK_COUNT', 'ÅÍÓÈ ÇáÞÇÆãÉ ÇáÓæÏÇÁ');
    define('_AM_RSSC_CONF_BLACK_COUNT_DESC', 'Count up the matching record when match with blck list');
    define('_AM_RSSC_CONF_WORD_COUNT', 'ÃÍÊÓÇÈ ÞÇÆãÉ ÇáßáãÇÊ ÇáãÑÝæÖÉ');
    define('_AM_RSSC_CONF_WORD_COUNT_DESC', 'Count up the matching record when match with reject word list');
    define('_AM_RSSC_CONF_BLACK_AUTO', 'ÃÖÝ Ýí ÇáÞÇÆãÉ ÇáÓæÏÇÁ');
    define('_AM_RSSC_CONF_BLACK_AUTO_DESC', 'Add URL in black list automatically when judge black<br><b>Notice</b> "status" is stored as "invalid"<br>Please change into "valid" when using');
    define('_AM_RSSC_CONF_WORD_AUTO', 'ÃÖÝ Çáì ÞÇÆãÉ ÇáßáãÇÊ ÇáãÑÝæÖÉ');
    define('_AM_RSSC_CONF_WORD_AUTO_DESC', 'Extract words in the content automatically, and add words in reject word list automatically, when judge black<br><b>Notice</b> "point" is stored as zero<br>Please change "point" when using');
    define('_AM_RSSC_CONF_WORD_AUTO_NON', 'áÇ ÊÖÝ');
    define('_AM_RSSC_CONF_WORD_AUTO_SYMBOL', 'Extract by the symbol pause');
    define('_AM_RSSC_CONF_WORD_AUTO_KAKASI', 'Extract by KAKASI: Japanese Only');

    // word extract
    define('_AM_RSSC_FORM_WORD', 'ÎíÇÑÇÊ ÇÓÊÎÑÇÌ ÇáßáãÉ');
    define('_AM_RSSC_CONF_JOIN_PREV', 'Word Join');
    define('_AM_RSSC_CONF_JOIN_PREV_DESC', 'join to forword and backword word, and make a phrase');
    define('_AM_RSSC_CONF_JOIN_GLUE', 'ãÓÇÝÉ ÇáßáãÉ');
    define('_AM_RSSC_CONF_JOIN_GLUE_DESC', 'in English set space<br>in Japanese set noting');
    define('_AM_RSSC_CONF_KAKASI_PATH', 'Command Path of KAKASI');
    define('_AM_RSSC_CONF_KAKASI_MODE', 'Mode of KAKASI');
    define('_AM_RSSC_CONF_KAKASI_MODE_FILE', 'ÅÓÊÚãá ãáÝ temporary');
    define('_AM_RSSC_CONF_KAKASI_MODE_PIPE', 'Use UNIX pipe');
    define('_AM_RSSC_CONF_CHAR_LENGTH', 'ÇÞá ÚÏÏ ãä ÇáÍÑæÝ');
    define('_AM_RSSC_CONF_CHAR_LENGTH_DESC', 'ÇÞá ÚÏÏ ãä ÇáÍÑæÝ áÇÓÊÎÑÇÌ ÇáßáãÉ');
    define('_AM_RSSC_CONF_WORD_LIMIT', 'ÇÞÕì ÚÏÏ ãä ÑÝÖ ÇáßáãÇÊ');
    define('_AM_RSSC_CONF_WORD_LIMIT_DESC', 'Enter the maximum number of word stored in word table<br>Clears the older records, when it becomes more than this value<br><b>0</b> ÛíÑ ãÍÏæÏ');
    define('_AM_RSSC_KAKASI_EXECUTABLE', 'Kakasi is executable');
    define('_AM_RSSC_KAKASI_NOT_EXECUTABLE', 'Kakasi is not executable');
    define('_AM_RSSC_CONF_HTML_GET', 'ÌáÈ HTML');
    define('_AM_RSSC_CONF_HTML_GET_DESC', 'get origin HTML data automatically, when judge with reject word list<br>When select "Use", the precision of the judgment is improved , but the execution time become long');
    define('_AM_RSSC_CONF_HTML_GET_NO', 'áÇ ÊÓÊÚãá');
    define('_AM_RSSC_CONF_HTML_GET_YES', 'ÇÓÊÚãá');
    define('_AM_RSSC_CONF_HTML_GET_BLACK', 'Use when jugde black');
    define('_AM_RSSC_CONF_HTML_LIMIT', 'ÇÞÕì ÚÏÏ ãä ÍÑæÝ HTML');
    define('_AM_RSSC_CONF_HTML_LIMIT_DESC', 'The maxmum number of HTML characters which get automatically<br>At some sites, HTML is the big data, and then the execution time become long');

    // archive manage
    define('_AM_RSSC_LEAN_BLACK', 'ÊÚáã ãä ÇáÞÇÆãÉ ÇáÓæÏÇÁ');
    define('_AM_RSSC_LEAN_BLACK_DESC', 'Patrol in blacklist, for purpose extracting words in the content automatically, and adding words in reject word list automatically');
    define('_AM_RSSC_NUM_FEED_ALL', 'ÚÏÏ ÌãíÚ feeds');
    define('_AM_RSSC_NUM_FEED_SKIP', 'ÚÏÏ ÇáãÎÒä ãä feeds');
    define('_AM_RSSC_NUM_FEED_REJECT', 'The number of judged black feeds');

    define('_AM_RSSC_THEREARE_TITLE', 'in related <b>%s</b> there are <b>%s</b>');

    // === 2007-10-10 ===
    // config
    define('_AM_RSSC_CONF_SHOW_MODE_DATE', 'äãØ ÇáÊÇÑíÎ');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_NON', 'áÇ ÊÚÑÖ');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_SHORT', 'ÞÕíÑ');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_MIDDLE', 'ãÊæÓØ');
    define('_AM_RSSC_CONF_SHOW_MODE_DATE_LONG', 'Øæíá');
    define('_AM_RSSC_CONF_SHOW_SITE', 'ãÚáæãÇÊ ÇáãæÞÚ');
    define('_AM_RSSC_CONF_SHOW_SITE_DSC', '"äÚã" ÊÚäí ¡ÚÑÖ ÇÓã ÇáãæÞÚ æÚäæÇäÉ');

    // link table
    define('_AM_RSSC_LINK_CENSOR_DESC', 'Separate each with <b>|</b><br>case sensitive');

    // === 2008-01-20 ===
    // menu
    define('_AM_RSSC_FORM_HTMLOUT', 'ÎíÇÑÇÊ äÇÊÌ HTML');
    define('_AM_RSSC_FORM_HTMLOUT_DESC', "The processing of content ,when 'Use of HTML tag of the content' is 'Yes'<br>All tags are removed ,when 'No' <br>it recommends to remove or replace JavaScript and the relation, to prevent XSS (Cross Site Scripting) ");
    define('_AM_RSSC_FORM_CUSTOM_PLUGIN', 'Custom Plugins');

    // html out
    define('_AM_RSSC_CONF_HTML_NON', 'áÇ ÊÚãá Ôí');
    define('_AM_RSSC_CONF_HTML_SHOW', 'Sanitize and show in HTML');
    define('_AM_RSSC_CONF_HTML_REMOVE', 'ÍÐÝ');
    define('_AM_RSSC_CONF_HTML_REPLACE', 'ÅÓÊÈÏÇá ÇáãÊÛíÑÇÊ');
    define('_AM_RSSC_CONF_HTML_SCRIPT', 'ÊÇÛ ÓßÑÈÊ');
    define('_AM_RSSC_CONF_HTML_SCRIPT_DESC', "The processing of '&lt;script&gt;...&lt;/script&gt;' ");
    define('_AM_RSSC_CONF_HTML_STYLE', 'style tag');
    define('_AM_RSSC_CONF_HTML_STYLE_DESC', "The processing of '&lt;style&gt;...&lt;/style&gt;' ");
    define('_AM_RSSC_CONF_HTML_LINK', 'link tag');
    define('_AM_RSSC_CONF_HTML_LINK_DESC', "The processing of '&lt;link ... &gt;' ");
    define('_AM_RSSC_CONF_HTML_COMMENT', 'comment mark');
    define('_AM_RSSC_CONF_HTML_COMMENT_DESC', "The processing of '&lt;!-- ... --&gt;' ");
    define('_AM_RSSC_CONF_HTML_CDATA', 'CDATA mark');
    define('_AM_RSSC_CONF_HTML_CDATA_DESC', "The processing of '&lt;![CDATA[ ... ]]&gt;' ");
    define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE', 'onMouse attribute');
    define('_AM_RSSC_CONF_HTML_ATTR_ONMOUSE_DESC', "The processing of 'onmouseover=\"...\"' or 'onclick=\"...\"' <br>replace as 'on_mouseover_=\"...\"', when 'Replace' ");
    define('_AM_RSSC_CONF_HTML_ATTR_STYLE', 'style attribute');
    define('_AM_RSSC_CONF_HTML_ATTR_STYLE_DESC', "The processing of 'style=\"...\"' or 'class=\"...\"' <br>replace as 'style_=\"...\"', when 'Replace' ");
    define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS', 'Remove other tags');
    define('_AM_RSSC_CONF_HTML_FLAG_OTHER_TAGS_DESC', "Rremove or not '&lt;img ... &gt;' '&lt;a ... &gt;' '&lt;link ... &gt;' etc ");
    define('_AM_RSSC_CONF_HTML_OTHER_TAGS', 'allow tags');
    define('_AM_RSSC_CONF_HTML_OTHER_TAGS_DESC', "Enter the tag not to remove, when 'Remove other tags' is 'Yes' <br> exsample: <img><a> ");
    define('_AM_RSSC_CONF_HTML_JAVASCRIPT', 'JavaScriprt stings');
    define('_AM_RSSC_CONF_HTML_JAVASCRIPT_DESC', "The processing of stings as 'JavaScriprt' <br>replace as 'java_script', when 'Replace' ");

    // plugin
    define('_AM_RSSC_PRE_PLUGIN_DESC', 'Execute before storing in the database');
    define('_AM_RSSC_POST_PLUGIN_DESC', 'Execute after reading in the database');
    define('_AM_RSSC_PLUGIN_DESC_2', 'Separate each with <b>|</b>, when specifying two or more plugins ');

    define('_AM_RSSC_PLUGIN_TEST', 'Test fo plugins');
    define('_AM_RSSC_PLUGIN', 'Plugins');
    define('_AM_RSSC_PLUGIN_TESTDATA', 'Test data');
    define('_AM_RSSC_PLUGIN_TESTDATA_DESC', 'Enter the form of associative array');
}
// --- define language begin ---
