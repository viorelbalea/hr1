<table border="0" cellpadding="0" cellspacing="0">
    <tr align="center">
        <td width="100" align="left" class="TitleBoxDown">{translate label='Pagina'} {$pag_current}/{$nr_pages}</td>
        {if $nr_pages>1}
            {if $limit_jos==1}
                {if $pag_back>1}
                    <td width="22"><a href="{$url1}"><img src="./images/doublebackarrow.png" border="0"/></a></td>
                {/if}
                <td width="22"><a href="{$url_grup_jos}"><img src="./images/backarrow.png" border="0"/></a></td>
            {/if}

            {section name=tmp loop=$urls}
                {if $urls[tmp]!=''}
                    <td width="13" align="center" valign="middle">
                        <a href="{$urls[tmp]}" class="white">{$pages[tmp]}</a>
                    </td>
                    {if !$smarty.section.tmp.last}
                        <td width="1" align="center" style="color:#F8F9F8;">|</td>
                    {/if}
                {else}
                    <td width="13" align="center" valign="middle">
                        <span class="TitleBoxDown"><b>{$pages[tmp]}</b></span>
                    </td>
                    {if !$smarty.section.tmp.last}
                        <td width="1" align="center" style="color:#F8F9F8;">|</td>
                    {/if}
                {/if}
            {/section}
            {if $limit_sus==1}
                <td width="22"><a href="{$url_grup_sus}"><img src="./images/nextarrow.png" border="0"/></a></td>
                {if $nr_pages!=$pag_next}
                    <td width="22"><a href="{$urllast}"><img src="./images/doublenextarrow.png" border="0"/></a></td>
                {/if}
            {/if}
            <td class="TitleBoxDown">&nbsp;&nbsp;{translate label='Mergi la pagina'} :&nbsp;
                <input type="text" name="goto" id="goto" value="{if $smarty.get.page}{$smarty.get.page}{else}1{/if}" style="width:35px; text-align:center;"/>
                <input type="image" align="texttop" src="./images/go.png" onclick="
                        var page_nr=document.getElementById('goto').value;
                        if(isNaN(page_nr) || page_nr<1) alert('{translate label='Trebuie sa introduceti o valoare numerica pozitiva!'}');
                        else if(page_nr>{$nr_pages}) alert('{translate label='Valoarea introdusa este mai mare decat numarul de pagini (%s)!' values=$nr_pages}');
                        else window.location.href='{$smarty.server.REQUEST_URI}&page='+page_nr; return false;"/>
            </td>
        {/if}

    </tr>
</table>
