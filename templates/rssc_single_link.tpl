<{* $Id: rssc_single_link.html,v 1.2 2012/04/08 23:42:22 ohwada Exp $ *}>

&nbsp;
<a href="<{$xoops_url}>/"><{$lang_home}></a>
&gt;&gt;
<a href="<{$xoops_url}>/modules/<{$dirname}>/"><{$module_name}></a>
&gt;&gt;
<b><{$link.title_s}></b>
<br><br>

<h3 align="center"><{$module_name}></h3>

<table class="outer" width="100%" cellspacing="0">
    <tr>
        <td class="even">
            &nbsp;
            <a href="<{$xoops_url}>/modules/<{$dirname}>/index.php"><{$lang_main}></a>
            &nbsp;|&nbsp;
            <a href="<{$xoops_url}>/modules/<{$dirname}>/headline.php"><{$lang_headline}></a>
            &nbsp;
        </td>
    </tr>
</table>

<h3><{$lang_single_link}></h3>

<ul>
    <li><a href="single_link.php?lid=<{$link.lid}>&amp;keywords=<{$rssc_keywords}>"><{$lang_single_link}></a></li>
    <li><a href="single_link_utf8.php?lid=<{$link.lid}>&amp;keywords=<{$rssc_keywords}>"><{$lang_single_link_utf8}></a></li>
</ul>
<br>

<{if ($link_show == 1) }>
    <a href="<{$xoops_url}>/modules/<{$dirname}>/single_link.php?lid=<{$link.lid}>&amp;keywords=<{$rssc_keywords}>">
        <img src="<{$xoops_url}>/modules/<{$dirname}>/images/dir.gif" border="0" alt="link"/></a>
    <{if $is_module_admin}>
    <a href="<{$xoops_url}>/modules/<{$dirname}>/admin/link_manage.php?op=mod_form&amp;lid=<{$link.lid}>">
        <img src="<{$xoops_url}>/modules/<{$dirname}>/images/edit.gif" border="0" alt="edit link"/>
    </a>
    <{/if}>
    <{if ($link.url_xml_s != "") && ($link.icon_s != "") }>
    <a href="<{$link.url_xml_s}>" target="_blank">
        <img src="<{$xoops_url}>/modules/<{$dirname}>/images/<{$link.icon_s}>" border="0" alt="<{$link.title_s}>"/></a>
    <{/if}>
    <{if ($link.url_s != '') }>
    <a href="<{$link.url_s}>" target="_blank"><{$link.title_s}></a>
    <{else}>
    <{$link.title_s}>
    <{/if}>

    <{if ($link.updated_long != '') }>
    (<{$link.updated_long}>)
    <{/if}>
<br><br>

    <{$lang_total}><br><br>

    <{if ($feed_show == 1) }>
    <{foreach item=feed from=$feeds}>
    <div>
        <a href="<{$xoops_url}>/modules/<{$dirname}>/single_feed.php?fid=<{$feed.fid}>&amp;keywords=<{$rssc_keywords}>">
            <img src="<{$xoops_url}>/modules/<{$dirname}>/images/text.gif" border="0" alt="feed"/></a>
        <{if $is_module_admin}>
        <a href="<{$xoops_url}>/modules/<{$dirname}>/admin/feed_manage.php?op=mod_form&amp;fid=<{$feed.fid}>">
            <img src="<{$xoops_url}>/modules/<{$dirname}>/images/edit.gif" border="0" alt="edit feed"/>
        </a>
        <{if ($feed.ltype == 1)||($feed.lid == 0) }>
        <a href="<{$xoops_url}>/modules/<{$dirname}>/admin/link_manage.php?op=addlink&amp;fid=<{$feed.fid}>">
            <img src="<{$xoops_url}>/modules/<{$dirname}>/images/addlink.gif" border="0" alt="addlink"/></a>
        <a href="<{$xoops_url}>/modules/<{$dirname}>/admin/black_manage.php?op=addlist&amp;fid=<{$feed.fid}>">
            <img src="<{$xoops_url}>/modules/<{$dirname}>/images/blacklist.gif" border="0" alt="blacklist"/></a>
        <{/if}>
        <{/if}>

        <{if $conf_url == 1 }>
        <a href="<{$xoops_url}>/modules/<{$dirname}>/single_feed.php?fid=<{$feed.fid}>"><{$feed.title}></a>
        <{elseif ($feed.link != '') }>
        <a href="<{$feed.link}>" target="_blank"><{$feed.title}></a>
        <{else}>
        <{$feed.title}>
        <{/if}>

        <{if ($feed.updated_long != '') }>
        (<{$feed.updated_long}>)
        <{/if}>
        <{if (($feed.enclosure_mode == 1)&&($feed.enclosure_url != '')) }>
    <br>
        <a href="<{$feed.enclosure_url}>" target="_blank">
            <img src="<{$xoops_url}>/modules/<{$dirname}>/images/sound2.gif" border="0" alt="sound"/>
            <{$lang_podcast}></a> :
        <{if ($feed.enclosure_type != '') }>
        <{$feed.enclosure_type}>
        <{/if}>
        <{if ($feed.enclosure_length_kb != '') }>
        <{$feed.enclosure_length_kb}> <{$unit_kb}>
        <{/if}>
    <br>
        <{/if}>
        <{if ($feed.summary != '') }>
        <div class="rssc_summary"><{$feed.summary|wordwrap:160}></div>
        <{/if}>
        <{if ($feed.content != '') }>
        <div class="rssc_content"><{$feed.content|wordwrap:160}></div>
        <{/if}>
        <br>
    </div>
    <{/foreach}>

    <{if ($rssc_navi != '') }>
    <div align='center'><{$rssc_navi}></div>
    <{/if}>

    <{else}>
    <font color="blue"><{$lang_no_feed}></font><br>
    <{/if}>

    <{else}>
    <font color="red"><{$lang_no_record}></font><br>
    <{/if}>

<hr/>
<div class="rssc_execution_time">execution time : <{$execution_time}> sec</div>

<{if $is_module_admin }>
    <{if $memory_usage > 0}>
    <div class="rssc_memory_usage">memory usage : <{$memory_usage}> MB</div>
    <{/if}>
    <a href="<{$xoops_url}>/modules/<{$dirname}>/admin/index.php">
        <{$lang_goto_admin}></a><br>
    <{if $rssc_error != '' }>
    <{$lang_error}><br>
    <font color="red"><{$rssc_error}></font><br>
    <{/if}>
    <{/if}>
