<{* $Id: rssc_view_rss.html,v 1.1 2011/12/29 14:37:06 ohwada Exp $ *}>

<h4>RSS</h4>
<table cellspacing="1" class="outer">
    <tr>
        <th colspan="2" align="left">
            <{if ($channel.title != "") && ($channel.link != "") }>
            <a href="<{$channel.link}>" target="_blank"><font color="white"><{$channel.title}></font></a>
            <{elseif $channel.link != ""}>
            <a href="<{$channel.link}>" target="_blank"><font color="white"><{$channel.link}></font></a>
            <{elseif $channel.title != ""}>
            <font color="white"><{$channel.title}></font>
            <{else}>
            <font color="white">No Site Title &amp; Link</font>
            <{/if}>
        </th>
    </tr>
    <{if $image.url != ""}>
    <tr>
        <th colspan="2" align="left">
            <{if ($image.width > 0) && ($image.height > 0) }>
        <img src="<{$image.url}>" alt="<{$image.title}>" width="<{$image.width}>" height="<{$image.height}>"/>
            <{else}>
        <img src="<{$image.url}>" alt="<{$image.title}>"/>
            <{/if}>
        </td></tr>
    <{/if}>
    <{if $channel.description != ""}>
    <tr>
        <td class="head"><{$lang_site_desc}></td>
        <td class="even"><{$channel.description}></td>
    </tr>
    <{/if}>
    <{if $channel.lastbuilddate_long != ""}>
    <tr>
        <td class="head"><{$lang_site_lastbuilddate}></td>
        <td class="odd"><{$channel.lastbuilddate_long}></td>
    </tr>
    <{elseif $channel.lastbuilddate != ""}>
    <tr>
        <td class="head"><{$lang_site_lastbuilddate}></td>
        <td class="odd"><{$channel.lastbuilddate}></td>
    </tr>
    <{/if}>
    <{if $channel.pubdate_long != ""}>
    <tr>
        <td class="head"><{$lang_site_pubdate}></td>
        <td class="odd"><{$channel.pubdate_long}></td>
    </tr>
    <{elseif $channel.pubdate != ""}>
    <tr>
        <td class="head"><{$lang_site_pubdate}></td>
        <td class="odd"><{$channel.pubdate}></td>
    </tr>
    <{/if}>
    <{if $channel.language != ""}>
    <tr>
        <td class="head"><{$lang_site_language}></td>
        <td class="even"><{$channel.language}></td>
    </tr>
    <{/if}>
    <{if $channel.copyright != ""}>
    <tr>
        <td class="head"><{$lang_site_copyright}></td>
        <td class="even"><{$channel.copyright}></td>
    </tr>
    <{/if}>
    <{if $channel.managingeditor != ""}>
    <tr>
        <td class="head"><{$lang_site_managingeditor}></td>
        <td class="even"><{$channel.managingeditor}></td>
    </tr>
    <{/if}>
    <{if $channel.webmaster != ""}>
    <tr>
        <td class="head"><{$lang_site_webmaster}></td>
        <td class="odd"><{$channel.webmaster}></td>
    </tr>
    <{/if}>
    <{if $channel.category != ""}>
    <tr>
        <td class="head"><{$lang_site_category}></td>
        <td class="even"><{$channel.category}></td>
    </tr>
    <{/if}>
    <{if $channel.generator != ""}>
    <tr>
        <td class="head"><{$lang_site_generator}></td>
        <td class="odd"><{$channel.generator}></td>
    </tr>
    <{/if}>
    <{if $channel.docs != ""}>
    <tr>
        <td class="head"><{$lang_site_docs}></td>
        <td class="even"><{$channel.docs}></td>
    </tr>
    <{/if}>
    <{if $channel.ttl != ""}>
    <tr>
        <td class="head"><{$lang_site_ttl}></td>
        <td class="even"><{$channel.ttl}></td>
    </tr>
    <{/if}>
    <{if $channel.rating != ""}>
    <tr>
        <td class="head"><{$lang_site_rating}></td>
        <td class="even"><{$channel.rating}></td>
    </tr>
    <{/if}>
    <{if $channel.cloud != ""}>
    <tr>
        <td class="head"><{$lang_site_cloud}></td>
        <td class="even"><{$channel.cloud}></td>
    </tr>
    <{/if}>
    <{if $channel.skipdays_day != ""}>
    <tr>
        <td class="head"><{$lang_site_skipdays}></td>
        <td class="odd"><{$channel.skipdays_day}></td>
    </tr>
    <{/if}>
    <{if $channel.skiphours_hour != ""}>
    <tr>
        <td class="head"><{$lang_site_skiphours}></td>
        <td class="odd"><{$channel.skiphours_hour}></td>
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
    <tr class="head">
        <td colspan="2">
            <{$lang_site_textinput}>
        </td>
    </tr>
    <{foreach key=key item=item from=$textinput}>
    <tr>
        <td valign="top" class="even"><{$key}></td>
        <td class="odd"><{$item}></td>
    </tr>
    <{/foreach}>
    <{/if}>
    <{section name=i loop=$items}>
    <tr class="head">
        <td colspan="2">
            <{if ($items[i].title != "") && ($items[i].link != "") }>
            <a href="<{$items[i].link}>" target="_blank"><{$items[i].title}></a>
            <{elseif $items[i].link != ""}>
            <a href="<{$items[i].link}>" target="_blank"><{$items[i].link}></a>
            <{elseif $items[i].title != ""}>
            <{$items[i].title}>
            <{else}>
            No Title &amp; Link
            <{/if}>
        </td>
    </tr>
    <{if $items[i].pubdate_long != ""}>
    <tr>
        <td class="even"><{$lang_pubdate}></td>
        <td class="odd"><{$items[i].pubdate_long}></td>
    </tr>
    <{elseif $items[i].pubdate != ""}>
    <tr>
        <td class="even"><{$lang_pubdate}></td>
        <td class="odd"><{$items[i].pubdate}></td>
    </tr>
    <{/if}>
    <{if $items[i].guid != ""}>
    <tr>
        <td class="even"><{$lang_guid}></td>
        <td class="odd"><{$items[i].guid}></td>
    </tr>
    <{/if}>
    <{if $items[i].author != ""}>
    <tr>
        <td class="even"><{$lang_author}></td>
        <td class="odd"><{$items[i].author}></td>
    </tr>
    <{/if}>
    <{if $items[i].category != ""}>
    <tr>
        <td class="even"><{$lang_category}></td>
        <td class="odd"><{$items[i].category}></td>
    </tr>
    <{/if}>
    <{if $items[i].comments != ""}>
    <tr>
        <td class="even"><{$lang_comments}></td>
        <td class="odd"><{$items[i].comments}></td>
    </tr>
    <{/if}>
    <{if $items[i].source != ""}>
    <tr>
        <td class="even"><{$lang_source}></td>
        <td class="odd"><{$items[i].source}></td>
    </tr>
    <{/if}>
    <{if $items[i].enclosure_url != ""}>
    <tr>
        <td class="even"><{$lang_enclosure_url}></td>
        <td class="odd"><{$items[i].enclosure_url}></td>
    </tr>
    <{/if}>
    <{if $items[i].enclosure_type != ""}>
    <tr>
        <td class="even"><{$lang_enclosure_type}></td>
        <td class="odd"><{$items[i].enclosure_type}></td>
    </tr>
    <{/if}>
    <{if $items[i].enclosure_length != ""}>
    <tr>
        <td class="even"><{$lang_enclosure_length}></td>
        <td class="odd"><{$items[i].enclosure_length}></td>
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
    <{if $items[i].geo != ""}>
    <{foreach key=key item=item from=$items[i].geo}>
    <tr>
        <td class="even">geo:<{$key}></td>
        <td class="odd"><{$item}></td>
    </tr>
    <{/foreach}>
    <{/if}>
    <{if $items[i].georss != ""}>
    <{foreach key=key item=item from=$items[i].georss}>
    <tr>
        <td class="even">georss:<{$key}></td>
        <td class="odd"><{$item}></td>
    </tr>
    <{/foreach}>
    <{/if}>
    <{if $items[i].media != ""}>
    <{foreach key=key1 item=item1 from=$items[i].media}>
    <{foreach key=key2 item=item2 from=$item1}>
    <{if is_array($item2) }>
    <{foreach key=key3 item=item3 from=$item2}>
    <tr>
        <td class="even">media:<{$key1}>:<{$key2}>:<{$key3}></td>
        <td class="odd"><{$item3}></td>
    </tr>
    <{/foreach}>
    <{else}>
    <tr>
        <td class="even">media:<{$key1}>:<{$key2}></td>
        <td class="odd"><{$item2}></td>
    </tr>
    <{/if}>
    <{/foreach}>
    <{/foreach}>
    <{/if}>
    <{if $items[i].summary != ""}>
    <tr>
        <td class="even"><{$lang_summary}></td>
        <td class="odd"><{$items[i].summary|wordwrap:160}></td>
    </tr>
    <{elseif $items[i].description != ""}>
    <tr>
        <td class="even"><{$lang_description}></td>
        <td class="odd"><{$items[i].description|wordwrap:160}></td>
    </tr>
    <{/if}>
    <{if $items[i].content != ""}>
    <tr>
        <td class="odd" colspan="2"><{$items[i].content|wordwrap:160}></td>
    </tr>
    <{elseif $items[i].content.encoded != ""}>
    <tr>
        <td class="odd" colspan="2"><{$items[i].content.encoded|wordwrap:160}></td>
    </tr>
    <{/if}>
    <{/section}>
</table>
