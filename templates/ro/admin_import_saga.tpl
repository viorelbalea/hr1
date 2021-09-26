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
<form action="/index.php?m=admin&o=import_saga" method="post" enctype="multipart/form-data" name="upload_pers">
    <label>Companie SELF</label>
    <select name="CompanyID">
        {foreach from=$CompaniesSelf key=key item=item name=iter1}
            <option value="{$key}">{$item}</option>
        {/foreach}
    </select>
    <input type="file" name="fisier"/>
    <input type="submit" name="upload" value="Incarca fisier" class="formstyle">
</form>

{if $uploaded!=1}
    <form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers">
        <input type="hidden" name="CompanyID" value="{$smarty.post.CompanyID}"/>
        <table cellspacing="0" cellpadding="2" width="100%" class="grid">
            <tr>
                <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
                {foreach from=$personsHeader key=key item=item name=iter1}
                    {if !@in_array($key,Array(1,7,8,10,11,13,14,15,16,18,21,37,38,39,40,41,42,43,44,46,47,48,49,50,51,53,56,57,58,59,60,61,62,64,65,66,67,68,69,70,71,72,73,74,76,77,80,81,82,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106))}
                        {if $item!=''}
                            <td class="bkdTitleMenu"><span class="TitleBox">{$key}<br/>{$item}</span></td>
                        {/if}
                    {/if}
                {/foreach}
                <td class="bkdTitleMenu">
                    {if $persons|@count >0}
                        <a href="#" onclick="checkAll(); return false;">{translate label='check all'}</a>
                        |
                        <a href="#" onclick="uncheckAll(); return false;">{translate label='uncheck all'}</a>
                    {/if}
                </td>
            </tr>

            {foreach from=$persons key=key item=item name=iter1}
                <tr height="30">
                    <td class="celulaMenuST">{math equation="x-y" x=$smarty.foreach.iter1.iteration y=0}</td>
                    {foreach from=$persons[$key] key=key2 item=item2 name=iter2}
                        {if !@in_array($key2,Array(1,7,8,10,11,13,14,15,16,18,21,37,38,39,40,41,42,43,44,46,47,48,49,50,51,53,56,57,58,59,60,61,62,64,65,66,67,68,69,70,71,72,73,74,76,77,80,81,82,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106))}
                            {if $personsHeader.$key2!=''}
                                <td class="celulaMenuST"><input type="text" name="person[{$key}][{$key2}]" value="{$item.$key2}"/></td>{/if}
                        {/if}
                    {/foreach}
                    <td class="celulaMenuSTDR"><input type="checkbox" id="list_{$key}" name="person[{$key}][0]" checked="checked" value="1"/></td>
                </tr>
                {foreachelse}
                <tr height="30">
                    <td style="text-align:center;" colspan="100" class="celulaMenuSTDR">
                        <b>{translate label='Va rugam incarcati un fisier format .xls impreuna cu capetele de tabel.'} <br/>
                            <br/>{translate label=' Coloanele trebuie sa fie in ordinea exportului complet SAGA'}
                            <br/><br/> {translate label='In cazul in care ati incarcat deja un fisier, acesta nu contine date pentru afisare.'}</b>
                    </td>
                </tr>
            {/foreach}
            {if $persons|@count >0}
                <tr>
                    <td class="bkdTitleMenu"></td>
                    <td class="bkdTitleMenu" colspan="{$personsHeader|@count}"><input type="submit" name="import" value="Importa datele selectate" class="formstyle"></td>

                </tr>
            {/if}
        </table>
    </form>
{/if}

{literal}
<script language="javascript">
    function checkAll() {
        {/literal}
        {foreach from=$persons key=key item=item}
        document.getElementById('list_' + {$key}).checked = true;
        {/foreach}
        {literal}
    }

    function uncheckAll(type) {
        {/literal}
        {foreach from=$persons key=key item=item}
        document.getElementById('list_' + {$key}).checked = false;
        {/foreach}
        {literal}
    }
</script>
{/literal}