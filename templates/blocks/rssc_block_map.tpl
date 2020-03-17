<{* $Id: rssc_block_map.html,v 1.3 2012/04/08 23:42:22 ohwada Exp $ *}>

<{if $block.show_map}>
    <script type="text/javascript">
        //<![CDATA[
        setTimeout('<{$block.map_func}>()', <{$block.map_timeout}>
        )
        ;
        //]]>
    </script>

    <div id="<{$block.map_div_id}>" style="width:100%; height:300px;">Loading ...</div>
<br>
    <a href="<{$xoops_url}>/modules/<{$block.dirname}>/map.php"><{$block.lang_more}></a>
    <{/if}>

<{if $block.error}>
    <span style="color:#ff0000;font-size:150%;font-weight: bold;"><{$block.error}></span>
    <{/if}>
