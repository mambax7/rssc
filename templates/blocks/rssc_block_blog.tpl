<{* $Id: rssc_block_blog.html,v 1.1 2011/12/29 14:37:06 ohwada Exp $ *}>

<div align="left">
    <{if $block.feed_show == false}>
    <span style="color: #ff0000;"><{$block.lang_error}></span>

    <{else}>
    <a href="<{$block.site_link_s}>" target="_blank"><{$block.site_title_s}></a><br>
    <{$block.feed_list}>
<br>
    <{/if}>
</div>
