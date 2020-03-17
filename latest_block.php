<?php

// $Id: latest_block.php,v 1.1 2011/12/29 14:37:04 ohwada Exp $

//================================================================
// Rss center Module
// 2009-02-20 K.OHWADA
//================================================================

//---------------------------------------------------------
// system
//---------------------------------------------------------
include '../../mainfile.php';
include_once XOOPS_ROOT_PATH . '/class/template.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
$DIRNAME = basename(__DIR__);
$MODULE_DIR = XOOPS_ROOT_PATH . '/modules/' . $DIRNAME;
include_once $MODULE_DIR . '/blocks/block_latest.php';

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];
$file_lang = $MODULE_DIR . '/language/' . $XOOPS_LANGUAGE . '/blocks.php';
$file_eng = $MODULE_DIR . '/language/english/blocks.php';
if (file_exists($file_lang)) {
    include_once $file_lang;
} else {
    include_once $file_eng;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
$options = [$DIRNAME];
$block = b_rssc_show_latest($options);

$tmplate = 'db:' . $DIRNAME . '_block_latest.tpl';
$tpl = new XoopsTpl();
$tpl->assign('block', $block);
$latest = $tpl->fetch($tmplate);

echo "<html><head>\n";
echo '<meta http-equiv="Content-Type" content="text/html; charset=' . _CHARSET . '">' . "\n";
echo '<title>RSS latest</title>';
echo "</head>\n<body>\n";
echo $latest;
echo "</body></html>\n";
exit();
