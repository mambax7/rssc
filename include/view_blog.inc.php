<?php
// $Id: view_blog.inc.php,v 1.1 2011/12/29 14:37:05 ohwada Exp $

// 2006-09-20 K.OHWADA
// this is new file
// porting form weblinks atomfeed.inc.php

//=========================================================
// RSS Center Module
// view Blog(feed) called by custom block
// 2006-09-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// exsample for custom block
// type: php script
//---------------------------------------------------------
// require_once XOOPS_ROOT_PATH."/modules/rssc/include/view_blog.inc.php";
// echo rssc_view_blog( link_id [ , options ] );
//---------------------------------------------------------

$RSSC_DIRNAME = basename( dirname(__DIR__) );

// --- eval begin ---
eval( '

function '.$RSSC_DIRNAME.'_view_blog($lid=0, $options=null)
{
	return rssc_view_blog_base( "'.$RSSC_DIRNAME.'" ,$lid, $options);
}

' );
// --- eval end ---


// --- rssc_view_blog_base begin ---
if( !function_exists( 'rssc_view_blog_base' ) ) 
{

// system files
require_once XOOPS_ROOT_PATH.'/class/snoopy.php';

// happy_linux files
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/multibyte.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/system.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/highlight.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/post.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/remote_file.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/convert_encoding.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object.php';
require_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/objectHandler.php';

// rssc files
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_constant.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_get_handler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_config_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_link_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_feed_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_black_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_white_basicHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_xml_utility.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_xml_object.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_parseHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_refreshHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_view_param.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_viewHandler.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/magpie/rssc_magpie_parse.php';
require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/magpie/rssc_magpie_cache.php';

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];
if ( file_exists(XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/blocks.php') ) 
{
	require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/blocks.php';
}
else
{
	require_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/language/english/blocks.php';
}

//---------------------------------------------------------
// rssc_view_blog_base
//---------------------------------------------------------
function rssc_view_blog_base($DIRNAME, $lid=0, $options=null)
{
	if (0 == $lid)
	{
		$text = '<span style="color: #ff0000;">'._BL_RSSC_NO_LINK_ID."</span>\n";
		return $text;
	}

// default value
	$num_feed          = 10;
	$num_content       = 1;
	$flag_title_html   = false;
	$flag_content_html = true;
	$max_title         = -1;
	$max_content       = -1;
	$max_summary       = 200;
	$order             = 'updated_unix DESC, fid DESC';

	if ( isset($options['num_feed']) )
	{
		$num_feed = $options['num_feed'];
	}

	if ( isset($options['num_content']) )
	{
		$num_content = $options['num_content'];
	}

	if ( isset($options['flag_title_html']) )
	{
		$flag_title_html = $options['flag_title_html'];
	}

	if ( isset($options['flag_content_html']) )
	{
		$flag_content_html = $options['flag_content_html'];
	}

	if ( isset($options['max_title']) )
	{
		$max_content = $options['max_title'];
	}

	if ( isset($options['max_content']) )
	{
		$max_content = $options['max_content'];
	}

	if ( isset($options['max_summary']) )
	{
		$max_summary = $options['max_summary'];
	}

	if ( isset($options['order']) )
	{
		$order = $options['order'];
	}

	$url_sound_gif = XOOPS_URL.'/modules/'.$DIRNAME.'/images/sound2.gif';

	$refreshHandler =& rssc_getHandler('refresh', $DIRNAME);
	$viewHandler    =& rssc_getHandler('view',    $DIRNAME);

	$refreshHandler->refresh($lid);

	$viewHandler->setFlagSanitize( true );	// sanitize
	$viewHandler->setFeedStart(     0 );
	$viewHandler->set_title_html(   $flag_title_html );
	$viewHandler->set_content_html( $flag_content_html );
	$viewHandler->set_max_title(    $max_title );
	$viewHandler->set_max_content(  $max_content );
	$viewHandler->set_max_summary(  $max_summary );
	$viewHandler->setFeedLimit(     $num_feed );
	$viewHandler->setFeedOrder(     $order );

	$feeds =& $viewHandler->getFeeds( $lid );

	$count = count($feeds);

	if (0 == $count)
	{
		$text = '<span style="color: #ff0000;">'._BL_RSSC_NO_FEED."</span>\n";
		return $text;
	}

	$site_title = '---';
	$site_link  = '';

	if ( isset($feeds[0]['site_title']) )
	{
		$site_title = $feeds[0]['site_title'];
	}

	if ( isset($feeds[0]['site_link']) )
	{
		$site_link = $feeds[0]['site_link'];
	}

// text start
	$text = '';

	$text .= '<a href="'.$site_link.'" target="_blank">'.$site_title."</a>\n";
	$text .= "<ul>\n";

	for ($i=0; $i<$count; $i++)
	{
		$feed = $feeds[$i];

		$text .= "<li>\n";

		if ( isset($feed['link']) && isset($feed['title']) && $feed['link'] && $feed['title'] )
		{
			$text .= '<a href="'.$feed['link'].'" target="_blank">'.$feed['title'] . '</a> ';
		}
		elseif ( isset($feed['title']) && $feed['title'] )
		{
			$text .= $feed['title'] . ' ';
		}

		if ( isset($feed['updated_short']) && $feed['updated_short'] )
		{
			$text .= $feed['updated_short'] . ' ';
		}

		if ( isset($feed['enclosure_url']) && $feed['enclosure_url'] )
		{
			$text .= "<br>\n";
			$text .= '<a href="'.$feed['enclosure_url'].'" target="_blank">';
			$text .= '<img src="'.$url_sound_gif.'" border="0" alt="sound">';
			$text .= _BL_RSSC_PODCAST;
			$text .= '</a> : ';

			if ( isset($feed['enclosure_type']) && $feed['enclosure_type'] )
			{
				$text .= $feed['enclosure_type'];
			}
			if ( isset($feed['enclosure_length_kb']) && $feed['enclosure_length_kb'] )
			{
      			$text .= $feed['enclosure_length_kb'] . ' ';
      			$text .= BL_RSSC_UNIT_KB;
			}
		}

		if ($i < $num_content)
		{
			if ( isset($feed['content']) && $feed['content'] )
			{
				$text .= "<br>\n";
				$text .= $feed['content'];
   				$text .= "<br><br>\n";
			}
			elseif ( isset($feed['summary']) && $feed['summary'] )
			{
				$text .= "<br>\n";
				$text .= $feed['summary'];
   				$text .= "<br><br>\n";
			}
		}
		else
		{
			if ( isset($feed['summary']) && $feed['summary'] )
			{
				$text .= "<br>\n";
				$text .= $feed['summary'];
   				$text .= "<br><br>\n";
			}
		}

		$text .= "</li>\n";
	}

	return $text;
}

// --- rssc_view_blog_base end ---
}

?>
