<?php
// $Id: modinfo.php,v 1.1 2011/12/29 14:37:08 ohwada Exp $

// 2006-09-20 K.OHWADA
// show blog

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
// ͭ����������
//=========================================================

// --- define language begin ---
if( !defined('RSSC_LANG_MI_LOADED') ) 
{

define('RSSC_LANG_MI_LOADED', 1);

// The name of this module
define('_MI_RSSC_NAME','RSS���󥿡�');
define('_MI_RSSC_DESC','RDF/RSS/ATOM�����ε�����������ơ�DB�˳�Ǽ������������');

// Names of sub menu
define('_MI_RSSC_SMNAME_HEADLINE','�ʰץإåɥ饤��');

// Names of blocks
define('_MI_RSSC_BNAME_LATEST','�ǿ� RDF/RSS/ATOM ����');
define('_MI_RSSC_BNAME_HEADLINE','�ʰץإåɥ饤��');
define('_MI_RSSC_BNAME_REFRESH','�ʰץإåɥ饤��(��������)');

// 2006-09-20
define('_MI_RSSC_BNAME_BLOG','RSSC Blogɽ��');

// Names of admin menu
define('_MI_RSSC_ADMENU_CONFIG','�⥸�塼������');
define('_MI_RSSC_ADMENU_LINKLIST','��󥯰���');

// === 2009-02-20 ===
define('_MI_RSSC_BNAME_MAP','RSS Google�ޥå�');

}
// --- define language end ---

?>