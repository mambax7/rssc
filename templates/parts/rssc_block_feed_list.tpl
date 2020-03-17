<{* $Id: rssc_block_feed_list.html,v 1.3 2012/04/08 23:42:22 ohwada Exp $ *}>

<{if $show_li }>
<ul>
    <{/if}>
    <{foreach name=rss item=feed from=$feeds}>
    <{if $show_li }>
    <li>
    <{/if}>
    <{if $show_icon }>
    <a href="<{$xoops_url}>/modules/<{$dirname}>/single_link.php?lid=<{$feed.lid}>">
        <{if ($feed.icon == '') || ($feed.icon == '---') }>
    <img src="<{$xoops_url}>/modules/<{$dirname}>/images/icons/default.gif" border="0" alt="icon"/>
        <{else}>
    <img src="<{$xoops_url}>/modules/<{$dirname}>/images/icons/<{$feed.icon}>" border="0" alt="icon"/>
        <{/if}>
    </a>
    <{/if}>

    <{if $conf_url == 1 }>
    <a href="<{$xoops_url}>/modules/<{$dirname}>/single_feed.php?fid=<{$feed.fid}>"><{$feed.title}></a>
    <{elseif ($feed.link_s != '') }>
    <a href="<{$feed.link_s}>" target="_blank"><{$feed.title_s}></a>
    <{else}>
    <{$feed.title_s}>
    <{/if}>

    <{if $show_site && ($feed.site_link_s != '') && ($feed.site_title_s != '') }>
    in <a href="<{$feed.site_link_s}>" target="_blank"><{$feed.site_title_s}></a>
    <{/if}>
    <{if $show_short && ($feed.updated_short != '') }>
    (<{$feed.updated_short}>)
    <{/if}>
    <{if $show_middle && ($feed.updated_middle != '') }>
    (<{$feed.updated_middle}>)
    <{/if}>
    <{if $show_long && ($feed.updated_long != '') }>
    (<{$feed.updated_long}>)
    <{/if}>

    <{* $feed.updated_unix|formatTimestamp:"Y-m-d" *}>
    <{if (($feed.enclosure_mode == 1)&&($feed.enclosure_url_s != '')) }>
    <br>
    <a href="<{$feed.enclosure_url_s}>" target="_blank">
        <img src="<{$xoops_url}>/modules/<{$dirname}>/images/sound2.gif" border="0" alt="sound"/>
        <{$lang_podcast}></a> :
    <{if ($feed.enclosure_type_s != '') }>
    <{$feed.enclosure_type_s}>
    <{/if}>
    <{if ($feed.enclosure_length_kb != '') }>
    <{$feed.enclosure_length_kb}> <{$unit_kb}>
    <{/if}>
    <{/if}>

    <{* thumbnail content *}>
    <{if ( $num_content == -1 )||( $smarty.foreach.rss.iteration <= $num_content ) }>
    <{if ( $show_thumb && $feed.thumb_url_s ) || $feed.content_disp || $feed.summary_disp }>
    <table border="0">
        <tr>
            <{if $show_thumb && ($feed.thumb_url_s != '') }>
            <td valign="top">
                <a href="<{$feed.link_s}>" target="_blank">
                    <{if ($feed.thumb_width > 0) && ($feed.thumb_height > 0 ) }>
                <img src="<{$feed.thumb_url_s}>" width="<{$feed.thumb_width}>" height="<{$feed.thumb_height}>" border="0" alt="<{$feed.title_s}>"/>
                    <{else}>
                <img src="<{$feed.thumb_url_s}>" width="<{$max_width}>" border="0" alt="<{$feed.title_s}>"/>
                    <{/if}>
                </a>
            </td>
            <{/if}>
            <{if $feed.content_disp != ''}>
            <td valign="top">
                <{$feed.content_disp}>
            </td>
            <{elseif $feed.summary_disp != ''}>
            <td valign="top">
                <{$feed.summary_disp}>
            </td>
            <{/if}>
        </tr>
    </table>
    <{/if}>
    <{/if}>

    <{if $show_li }>
    </li>
    <{else}>
<br>
    <{/if}>
    <{/foreach}>
    <{if $show_li }>
</ul>
    <{/if}>
