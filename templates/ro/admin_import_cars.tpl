{include file="admin_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    {if $smarty.get.msg==1}
        <tr height="30">
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele au fost importate cu succes!'}</td>
        </tr>
    {/if}
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
</table>
<form action="./?m=admin&o=import-cars" method="post" enctype="multipart/form-data" name="upload_cars">
    <input type="file" name="fisier"/>
    <input type="submit" name="upload" value="Incarca fisier" class="formstyle">
</form>

{if $uploaded!=1}
    <form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="cars">
        <table cellspacing="0" cellpadding="2" width="100%" class="grid">
            <tr>
                <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
                {foreach from=$carsHeader key=key item=item name=iter1}
                    {if $item!=''}
                        <td class="bkdTitleMenu"><span class="TitleBox">{$item}</span></td>
                    {/if}
                {/foreach}
                <td class="bkdTitleMenu">
                    {if $cars|@count >0}
                        <a href="#" onclick="checkAll(); return false;">{translate label='check all'}</a>
                        |
                        <a href="#" onclick="uncheckAll(); return false;">{translate label='uncheck all'}</a>
                    {/if}
                </td>
            </tr>
            {foreach from=$cars key=key item=item name=iter1}
                <tr height="30">
                    <td class="celulaMenuST">{math equation="x-y" x=$smarty.foreach.iter1.iteration y=0}</td>
                    {if $carsHeader.1!=''}
                        <td class="celulaMenuST">
                            <select name="car[{$key}][1]">
                                <option value="0">{translate label='Selecteaza'}</option>
                                {foreach from=$car_types item=item2 key=key2}
                                    <option value="{$key2}" {if $item2==$item.1} selected="selected"{/if}>{$item2}</option>
                                {/foreach}
                            </select>
                        </td>
                    {/if}
                    {if $carsHeader.2!=''}
                        <td class="celulaMenuST">
                            <select name="car[{$key}][2]">
                                <option value="0">{translate label='Selecteaza'}</option>
                                {foreach from=$car_brands item=item2 key=key2}
                                    <option value="{$key2}" {if $item2==$item.2} selected="selected"{/if}>{$item2}</option>
                                {/foreach}
                            </select>
                        </td>
                    {/if}
                    {if $carsHeader.3!=''}
                        <td class="celulaMenuST"><input type="text" name="car[{$key}][3]" value="{$item.3}" style="width:80px;"/></td>{/if}
                    {if $carsHeader.4!=''}
                        <td class="celulaMenuST"><input type="text" name="car[{$key}][4]" value="{$item.4}" style="width:80px;"/></td>{/if}
                    {if $carsHeader.5!=''}
                        <td class="celulaMenuST"><input type="text" name="car[{$key}][5]" value="{$item.5}" style="width:80px;"/></td>{/if}
                    {if $carsHeader.6!=''}
                        <td class="celulaMenuST"><input type="text" name="car[{$key}][6]" value="{$item.6}" style="width:80px;"/></td>{/if}
                    {if $carsHeader.7!=''}
                        <td class="celulaMenuST"><input type="text" name="car[{$key}][7]" value="{$item.7}" style="width:80px;"/></td>{/if}
                    {if $carsHeader.8!=''}
                        <td class="celulaMenuST"><input type="text" name="car[{$key}][8]" value="{$item.8}" style="width:80px;"/></td>{/if}
                    {if $carsHeader.9!=''}
                        <td class="celulaMenuST"><input type="text" name="car[{$key}][9]" value="{$item.9}" style="width:80px;"/></td>{/if}
                    {if $carsHeader.10!=''}
                        <td class="celulaMenuST">
                            <select name="car[{$key}][10]">
                                <option value="0">{translate label='Selecteaza'}</option>
                                {foreach from=$currencies item=item2 key=key2}
                                    <option value="{$item2}" {if $item2==$item.10} selected="selected"{/if}>{$item2}</option>
                                {/foreach}
                            </select>
                        </td>
                    {/if}
                    {if $carsHeader.11!=''}
                        <td class="celulaMenuST"><input type="text" name="car[{$key}][11]" value="{$item.11}"></td>{/if}
                    <td class="celulaMenuSTDR"><input type="checkbox" id="list_{$key}" name="car[{$key}][0]" checked="checked" value="1"/></td>
                </tr>
                {foreachelse}
                <tr height="30">
                    <td style="text-align:center;" colspan="100" class="celulaMenuSTDR">
                        <b>{translate label='Va rugam incarcati un fisier format .xls impreuna cu capetele de tabel.'} <br/>
                            <br/>{translate label=' Coloanele trebuie sa fie in ordine: Tip masina, Marca, Model, Numar inmatriculare, Data inmatricularii ,Kilometri,Serie/numar factura, Data factura, Valoare cu TVA, Moneda, Observatii'}
                            <br/><br/> {translate label='In cazul in care ati incarcat deja un fisier, acesta nu contine date pentru afisare.'}</b>
                    </td>
                </tr>
            {/foreach}
            {if $cars|@count >0}
                <tr>
                    <td class="bkdTitleMenu"></td>
                    <td class="bkdTitleMenu" align="center" colspan="{$carsHeader|@count}"><input type="submit" name="import" value="Importa datele selectate" class="formstyle">
                    </td>

                </tr>
            {/if}
        </table>
    </form>
{/if}

{literal}
<script language="javascript">
    function checkAll() {
        {/literal}
        {foreach from=$cars key=key item=item}
        document.getElementById('list_' + {$key}).checked = true;
        {/foreach}
        {literal}
    }

    function uncheckAll(type) {
        {/literal}
        {foreach from=$cars key=key item=item}
        document.getElementById('list_' + {$key}).checked = false;
        {/foreach}
        {literal}
    }
</script>
{/literal}