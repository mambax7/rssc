<?php
// $Id: modinfo.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2006-09-20 K.OHWADA
// show blog

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
// _LANGCODE: ru
// _CHARSET : cp1251
// Translator: Houston (Contour Design Studio http://www.cdesign.ru/)

// --- define language begin ---
if( !defined('RSSC_LANG_MI_LOADED') ) 
{

define('RSSC_LANG_MI_LOADED', 1);

// The name of this module
define('_MI_RSSC_NAME','RSS �����');
define('_MI_RSSC_DESC','������ ������ �������� RDF/RSS/ATOM ������, ��������� � ���� ������ � ���� ��.');

// Names of sub menu
define('_MI_RSSC_SMNAME_HEADLINE','������� ���������');

// Names of blocks
define('_MI_RSSC_BNAME_LATEST','��������� RDF/RSS/ATOM ������');
define('_MI_RSSC_BNAME_HEADLINE','������� ���������');
define('_MI_RSSC_BNAME_REFRESH','������� ��������� (����������)');

// 2006-09-20
define('_MI_RSSC_BNAME_BLOG','���� RSSC');

// Names of admin menu
define('_MI_RSSC_ADMENU_CONFIG','������������ ������');
define('_MI_RSSC_ADMENU_LINKLIST','������ ������');

// === 2009-02-20 ===
define('_MI_RSSC_BNAME_MAP','����� RSS Google');

}
// --- define language end ---

?>