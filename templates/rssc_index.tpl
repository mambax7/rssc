<{* $Id: rssc_index.tpl,v 1.1 2011/12/29 14:37:05 ohwada Exp $ *}>

&nbsp;
<a href="<{$xoops_url}>/"><{$lang_home}></a>
 &gt;&gt; 
<a href="<{$xoops_url}>/modules/<{$dirname}>/"><{$module_name}></a>
 &gt;&gt; 
<b><{$lang_main}></b>
<br><br>

<h3 align="center"><{$module_name}></h3>

<{if $index_desc != ''}>
  <{$index_desc}>
<{/if}>

<table class="outer" width="100%" cellspacing="0">
<tr><td class="even">
&nbsp;
<a href="<{$xoops_url}>/modules/<{$dirname}>/index.php"><{$lang_main}></a>
&nbsp;|&nbsp;
<{if $show_title_map }>
  <a href="<{$xoops_url}>/modules/<{$dirname}>/map.php"><{$lang_map}></a>
  &nbsp;|&nbsp;
<{/if}>
<a href="<{$xoops_url}>/modules/<{$dirname}>/headline.php"><{$lang_headline}></a>
&nbsp;
</td></tr></table>
<br>

<div align="center">
<form action="<{$xoops_url}>/modules/<{$dirname}>/index.php" method="get">
<input type="text" id="query" name="query" size="30" maxlength="255" value="<{$rssc_query}>">
<select id="andor" name="andor" size="1">
<option value="AND"   <{$rssc_and}>   ><{$lang_all}></option>
<option value="OR"    <{$rssc_or}>    ><{$lang_any}></option>
<option value="exact" <{$rssc_exact}> ><{$lang_exact}></option>
</select>
<input type="hidden" name="action" value="results">
<input type="submit" value="<{$lang_search}>">
</form>
</div><br>

<{$lang_total}><br><br>

<a href="<{$xoops_url}>/modules/<{$dirname}>/rss.php?mode=rdf&amp;query=<{$rssc_query_urlencode}>&amp;andor=<{$rssc_andor}>&amp;limit=<{$feed_limit}>&amp;start=<{$feed_start}>" target="_blink" >
<img src="<{$xoops_url}>/modules/<{$dirname}>/images/rdf.png" border="0" alt="rdf"></a> 
<a href="<{$xoops_url}>/modules/<{$dirname}>/rss.php?mode=rss&amp;query=<{$rssc_query_urlencode}>&amp;andor=<{$rssc_andor}>&amp;limit=<{$feed_limit}>&amp;start=<{$feed_start}>" target="_blink" >
<img src="<{$xoops_url}>/modules/<{$dirname}>/images/rss.png" border="0" alt="rss"></a> 
<a href="<{$xoops_url}>/modules/<{$dirname}>/rss.php?mode=atom&amp;query=<{$rssc_query_urlencode}>&amp;andor=<{$rssc_andor}>&amp;limit=<{$feed_limit}>&amp;start=<{$feed_start}>" target="_blink" >
<img src="<{$xoops_url}>/modules/<{$dirname}>/images/atom.png" border="0" alt="atom"></a> 
<br><br>

<{if $rssc_show == 1}>
  <h4><{$lang_latest}></h4>
  <{$feed_list}>
  <{if ($rssc_navi != '') }>
    <div align='center'><{$rssc_navi}></div>
  <{/if}>

<{elseif ($rssc_show == 2) || ($rssc_show == 3)}>

  <h4><{$lang_result}></h4>
  <{$lang_keyword}>
  <{foreach item=keyword from=$rssc_keywords}>
    <strong><{$keyword}></strong> 
  <{/foreach}>
  <br>

  <{if $rssc_show_candidate }>
    <br>
    <{$lang_candidate}>:<br>
    <{foreach item=candidate from=$rssc_candidates}>
      <strong><{$candidate.keyword}></strong>(<{$candidate.lang}>) 
    <{/foreach}>
    <br>
  <{/if}>

  <{if $rssc_show_ignore }>
    <br>
    <{$lang_ignore}><br>
    <{foreach item=ignore from=$rssc_ignores}>
    <strong><{$ignore}></strong> 
    <{/foreach}>
    <br>
  <{/if}>

  <{if $rssc_show == 2}>
    <br>
    <{$rssc_found}><br><br>
    <{$feed_list}>
    <{if ($rssc_navi != '') }>
      <div align='center'><{$rssc_navi}></div>
    <{/if}>

  <{else}>
    <font color="red"><{$rssc_reason}></font><br>

  <{/if}>

<{else}>
  <font color="red"><{$rssc_reason}></font><br>

<{/if}>

<{if ($icon_list != '') }>
  <div align="left"><{$icon_list}></div>
<{/if}>

<hr>
<div class="rssc_execution_time">execution time : <{$execution_time}> sec </div>
<{if $is_module_admin && ($memory_usage > 0)}>
	<div class="rssc_memory_usage">memory usage : <{$memory_usage}> MB </div>
<{/if}>

<{* this is NOT copyright. you can remove this. *}>
<div class="rssc_powered">
 <a href="<{$happy_linux_url}>" target="_blank">Powered by Happy Linux</a>
</div>

<{if $is_module_admin }>
  <a href="<{$xoops_url}>/modules/<{$dirname}>/admin/index.php">
  <{$lang_goto_admin}></a><br>
  <{if $rssc_error != '' }>
    <{$lang_error}><br>
    <font color="red"><{$rssc_error}></font><br>
  <{/if}>
<{/if}>
