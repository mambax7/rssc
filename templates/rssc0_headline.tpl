<{* $Id: rssc0_headline.html,v 1.1 2011/12/29 14:37:05 ohwada Exp $ *}>

&nbsp;
<a href="<{$xoops_url}>/"><{$lang_home}></a>
&gt;&gt;
<a href="<{$xoops_url}>/modules/<{$dirname}>/"><{$module_name}></a>
&gt;&gt;
<b><{$lang_headline}></b>
<br><br>

<h3 align="center"><{$module_name}></h3>

<table class="outer" width="100%" cellspacing="0">
    <tr>
        <td class="even">
            &nbsp;
            <a href="<{$xoops_url}>/modules/<{$dirname}>/index.php"><{$lang_main}></a>
            &nbsp;|&nbsp;
            <{if $show_title_map }>
            <a href="<{$xoops_url}>/modules/<{$dirname}>/map.php"><{$lang_map}></a>
            &nbsp;|&nbsp;
            <{/if}>
            <a href="<{$xoops_url}>/modules/<{$dirname}>/headline.php"><{$lang_headline}></a>
            &nbsp;
        </td>
    </tr>
</table>

<h3><{$lang_headline}></h3>

<{if ($link_show == 1) }>
    <{foreach item=link from=$links}>
    <div>
        <a href="<{$xoops_url}>/modules/<{$dirname}>/single_link.php?lid=<{$link.lid}>&amp;keywords=<{$rssc_keywords}>">
            <img src="<{$xoops_url}>/modules/<{$dirname}>/images/dir.gif" border="0" alt="link"/></a>
        <{if ($link.url_s != '') }>
        <a href="<{$link.url_s}>" target="_blank">
            <img src="<{$xoops_url}>/modules/<{$dirname}>/images/index.gif" border="0" alt="<{$link.title_s}>"/></a>
        <{/if}>
        <{if ($link.url_xml_s != "") && ($link.icon_s != "") }>
        <a href="<{$link.url_xml_s}>" target="_blank">
            <img src="<{$xoops_url}>/modules/<{$dirname}>/images/<{$link.icon_s}>" border="0" alt="<{$link.title_s}>"/></a>
        <{/if}>
        <a href="<{$xoops_url}>/modules/<{$dirname}>/headline.php?lid=<{$link.lid}>"><{$link.title_s}></a>
        (<{$link.updated_long}>)
    </div>
    <{/foreach}>
<br>

    <{if ($channel.url_s != '') }>
    <a href="<{$channel.url_s}>" target="_blank">
        <font size="+1"><{$channel.title_s}></font></a>
    <{else}>
    <font size="+1"><{$channel.title_s}></font>
    <{/if}>
&nbsp; <{$lang_lastupdate}> <{$channel.updated_long}>
<br><br>

    <{$rss_channel.channel.description}><br><br>

    <{$lang_total}><br><br>

    <{if ($feed_show == 1) }>
    <{$feed_list}>
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
