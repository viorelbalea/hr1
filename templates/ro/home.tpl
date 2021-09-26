<table width="100%" cellspacing="0" cellpadding="0">
    {if !empty($news1) || !empty($news2) || !empty($news3)}
        <tr valign="top">
            <td width="30%" style="padding-top: 20px;">
                <form action="./" method="get">
                    <input type="text" name="keyword" value="{translate label='Cauta'}..." size="20" onclick="if (this.value == '{translate label='Cauta'}...') this.value = '';">
                    <input type="submit" value="{translate label='Cauta'}">
                </form>
            </td>
        </tr>
    {else}
        <tr valign="top">
            <td align="center" height="500" style="padding-top: 100px;">{translate label='Bine ati venit!'}</td>
        </tr>
    {/if}
    <tr valign="top">
        {if !empty($news1)}
            <td width="30%" style="padding-top: 10px; padding-right:10px; border-right:solid 1px #999;">
                <h2><h2>{$news_types.1}</h2></h2>
                <div style="height: 330px; padding-right:8px; overflow: auto;">
                    {foreach from=$news1 key=key item=item}
                        {if $key > 0}
                            <div align="justify" class="textcontent" style="padding-top: 20px;">
                                <i>{$item.data}</i> - <a href="{$request_uri}&o=view&NewsID={$item.NewsID}" class="blue"><strong>{$item.Title}</strong></a>
                                <br>
                                {if $item.Image}<img src="images/50/{$item.Image}" align="left" style="float:left; margin:5px 5px 5px 0; padding:1px; border:solid 1px #999;"
                                                     alt="" />{/if}
                                {$item.Content|truncate:350} <a href="{$request_uri}&o=view&NewsID={$item.NewsID}" class="blue"><b>&raquo;</b></a>
                            </div>
                            <br clear="left"/>
                        {/if}
                    {/foreach}
                </div>
            </td>
        {/if}
        {if !empty($news2)}
            <td width="30%" style="padding:10px 10px 0 10px; border-right:solid 1px #999;">
                <h2><h2>{$news_types.2}</h2></h2>
                <div style="height: 330px; padding-right:8px; overflow: auto;">
                    {foreach from=$news2 key=key item=item}
                        {if $key > 0}
                            <div align="justify" class="textcontent" style="padding-top: 20px;">
                                <i>{$item.data}</i> - <a href="{$request_uri}&o=view&NewsID={$item.NewsID}" class="blue"><strong>{$item.Title}</strong></a>
                                <br>
                                {if $item.Image}<img src="images/50/{$item.Image}" align="left" style="float:left; margin:5px 5px 5px 0; padding:1px; border:solid 1px #999;"
                                                     alt="" />{/if}
                                {$item.Content|truncate:350} <a href="{$request_uri}&o=view&NewsID={$item.NewsID}" class="blue"><b>&raquo;</b></a>
                            </div>
                            <br clear="left"/>
                        {/if}
                    {/foreach}
                </div>
            </td>
        {/if}
        {if !empty($news3)}
            <td width="30%" style="padding-top: 10px; padding-left:10px;">
                <h2><h2>{$news_types.3}</h2></h2>
                <div style="height:330px; padding-right:8px; overflow:auto;">
                    {foreach from=$news3 key=key item=item}
                        {if $key > 0}
                            <div align="justify" class="textcontent" style="padding-top: 20px;">
                                <i>{$item.data}</i> - <a href="{$request_uri}&o=view&NewsID={$item.NewsID}" class="blue"><strong>{$item.Title}</strong></a>
                                <br>
                                {if $item.Image}<img src="images/50/{$item.Image}" align="left" style="float:left; margin:5px 5px 5px 0; padding:1px; border:solid 1px #999;"
                                                     alt="" />{/if}
                                {$item.Content|truncate:350} <a href="{$request_uri}&o=view&NewsID={$item.NewsID}" class="blue"><b>&raquo;</b></a>
                            </div>
                            <br clear="left"/>
                        {/if}
                    {/foreach}
                </div>
            </td>
        {/if}
    </tr>
</table>
