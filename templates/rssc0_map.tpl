<{* $Id: rssc0_map.html,v 1.4 2012/04/08 23:42:21 ohwada Exp $ *}>

<{if $show_map}>
<script type="text/javascript">
//<![CDATA[
  window.onload = <{$map_func}>;
//]]>
</script>
<{/if}>

&nbsp;
<a href="<{$xoops_url}>/"><{$lang_home}></a>
 &gt;&gt; 
<a href="<{$xoops_url}>/modules/<{$dirname}>/"><{$module_name}></a>
 &gt;&gt; 
<b><{$lang_map}></b>
<br><br>

<h3 align="center"><{$module_name}></h3>

<table class="outer" width="100%" cellspacing="0">
<tr><td class="even">
&nbsp;
<a href="<{$xoops_url}>/modules/<{$dirname}>/index.php"><{$lang_main}></a>
&nbsp;|&nbsp;
<a href="<{$xoops_url}>/modules/<{$dirname}>/map.php"><{$lang_map}></a>
&nbsp;|&nbsp;
<a href="<{$xoops_url}>/modules/<{$dirname}>/headline.php"><{$lang_headline}></a>
&nbsp;
</td></tr></table>
<br>

<{if $show_map}>
  <div id="<{$map_div_id}>" class="rssc_map">Loading ...</div>
  <br>
<{/if}>

<a href="<{$xoops_url}>/modules/<{$dirname}>/rss.php?mode=rdf&amp;query=<{$rssc_query_urlencode}>&amp;andor=<{$rssc_andor}>&amp;limit=<{$feed_limit}>&amp;start=<{$feed_start}>" target="_blink" >
<img src="<{$xoops_url}>/modules/<{$dirname}>/images/rdf.png" border="0" alt="rdf"></a> 
<a href="<{$xoops_url}>/modules/<{$dirname}>/rss.php?mode=rss&amp;query=<{$rssc_query_urlencode}>&amp;andor=<{$rssc_andor}>&amp;limit=<{$feed_limit}>&amp;start=<{$feed_start}>" target="_blink" >
<img src="<{$xoops_url}>/modules/<{$dirname}>/images/rss.png" border="0" alt="rss"></a> 
<a href="<{$xoops_url}>/modules/<{$dirname}>/rss.php?mode=atom&amp;query=<{$rssc_query_urlencode}>&amp;andor=<{$rssc_andor}>&amp;limit=<{$feed_limit}>&amp;start=<{$feed_start}>" target="_blink" >
<img src="<{$xoops_url}>/modules/<{$dirname}>/images/atom.png" border="0" alt="atom"></a> 
<br><br>

<h4><{$lang_map}></h4>
<{$feed_list}>

<{if ($rssc_navi != '') }>
  <div align='center'><{$rssc_navi}></div>
<{/if}>

<{if ($icon_list != '') }>
  <div align="left"><{$icon_list}></div>
<{/if}>

<{if ($rssc_reason != '') }>
  <h3 style="color:#ff0000"><{$rssc_reason}></h3>
<{/if}>

<hr>
<div class="rssc_execution_time">execution time : <{$execution_time}> sec </div>
<{if $is_module_admin && ($memory_usage > 0)}>
	<div class="rssc_memory_usage">memory usage : <{$memory_usage}> MB </div>
<{/if}>

<{if $is_module_admin }>
  <a href="<{$xoops_url}>/modules/<{$dirname}>/admin/index.php">
  <{$lang_goto_admin}></a><br>
  <{if $rssc_error != '' }>
    <{$lang_error}><br>
    <font color="red"><{$rssc_error}></font><br>
  <{/if}>
<{/if}>
