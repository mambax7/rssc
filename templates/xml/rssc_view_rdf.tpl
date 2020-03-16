<{* $Id: rssc_view_rdf.html,v 1.1 2011/12/29 14:37:06 ohwada Exp $ *}>

<h4>RDF</h4>
<table cellspacing="1" class="outer">
<tr><th colspan="2" align="left">
  <{if ($channel.title != "") && ($channel.link != "") }>
    <a href="<{$channel.link}>" target="_blank"><font color="white"><{$channel.title}></font></a>
  <{elseif $channel.link != ""}>
    <a href="<{$channel.link}>" target="_blank"><font color="white"><{$channel.link}></font></a>
  <{elseif $channel.title != ""}>
    <font color="white"><{$channel.title}></font>
  <{else}>
    <font color="white">No Site Title &amp; Link</font>
  <{/if}>
</th></tr>
<{if $image.url != ""}>
  <tr><th colspan="2" align="left">
  <{if ($image.width > 0) && ($image.height > 0) }>
    <img src="<{$image.url}>" alt="<{$image.title}>" width="<{$image.width}>" height="<{$image.height}>">
  <{else}>
    <img src="<{$image.url}>" alt="<{$image.title}>">
  <{/if}>
  </td></tr>
<{/if}>
<{if $channel.dc_date_long != ""}>
  <tr>
  <td valign="top" class="head"><{$lang_site_date}></td>
  <td class="odd"><{$channel.dc_date_long}></td>
  </tr>
<{/if}>
<{if $channel.description != ""}>
  <tr>
  <td valign="top" class="head"><{$lang_site_description}></td>
  <td class="odd"><{$channel.description}></td>
  </tr>
<{/if}>
<{if $channel.dc != ""}>
  <{foreach key=key item=item from=$channel.dc}>
    <tr>
    <td valign="top" class="even">dc:<{$key}></td>
    <td class="odd"><{$item}></td>
    </tr>
  <{/foreach}>
<{/if}>
<{if $textinput.show == 1}>
  <tr class="head"><td colspan="2">
    <{$lang_site_textinput}>
  </td></tr>
  <{foreach key=key item=item from=$textinput}>
    <tr>
    <td valign="top" class="even"><{$key}></td>
    <td class="odd"><{$item}></td>
    </tr>
  <{/foreach}>
<{/if}>
<{section name=i loop=$items}>
  <tr class="head"><td colspan="2">
    <{if ($items[i].title != "") && ($items[i].link != "") }>
      <a href="<{$items[i].link}>" target="_blank"><{$items[i].title}></a>
    <{elseif $items[i].link != ""}>
      <a href="<{$items[i].link}>" target="_blank"><{$items[i].link}></a>
    <{elseif $items[i].title != ""}>
      <{$items[i].title}>
    <{else}>
      No Title &amp; Link
    <{/if}>
  </td></tr>
  <{if $items[i].dc_date_long != ""}>
    <tr>
    <td class="even"><{$lang_date}></td>
    <td class="odd"><{$items[i].dc_date_long}></td>
    </tr>
  <{/if}>
  <{if $items[i].dc != ""}>
    <{foreach key=key item=item from=$items[i].dc}>
      <tr>
      <td class="even">dc:<{$key}></td>
      <td class="odd"><{$item}></td>
      </tr>
    <{/foreach}>
  <{/if}>
  <{if $items[i].summary != ""}>
    <tr>
    <td class="even"><{$lang_summary}></td>
    <td class="odd"><{$items[i].summary|wordwrap:140}></td>
    </tr>
  <{elseif $items[i].description != ""}>
    <tr>
    <td class="even"><{$lang_description}></td>
    <td class="odd"><{$items[i].description|wordwrap:140}></td>
    </tr>
  <{/if}>
  <{if $items[i].content != ""}>
    <tr>
    <td class="odd" colspan="2"><{$items[i].content|wordwrap:140}></td>
    </tr>
  <{elseif $items[i].content.encoded != ""}>
    <tr>
    <td class="odd" colspan="2"><{$items[i].content.encoded|wordwrap:140}></td>
    </tr>
  <{/if}>
<{/section}>
</table>
