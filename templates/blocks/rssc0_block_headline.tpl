<{* $Id: rssc0_block_headline.html,v 1.1 2011/12/29 14:37:05 ohwada Exp $ *}>

<div align="left">
<{foreach item=link from=$block.links}>
  <a href="<{$link.url_s}>" target="_blank" ><{$link.title_s}></a><br>
  <{$link.feed_list}>
  <br>
<{/foreach}>
</div>

<div align="right">
<a href="<{$xoops_url}>/modules/<{$block.dirname}>/headline.php"><{$block.lang_more}></a>
</div>
<br>
