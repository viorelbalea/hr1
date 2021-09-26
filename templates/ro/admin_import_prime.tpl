{include file="admin_menu.tpl"}
<br>
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
<form action="./?m=admin&o=import_prime" method="post" enctype="multipart/form-data" name="upload_pers">
    <input type="file" name="fisier"/>
    <input type="submit" name="upload" value="Incarca fisier" class="formstyle">
</form>

{if $uploaded!=1}
    <form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers">
        <table cellspacing="0" cellpadding="2" width="100%" class="grid">
            <tr>
                <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
                {foreach from=$personsHeader key=key item=item name=iter1}
                    {if $item!=''}
                        <td class="bkdTitleMenu"><span class="TitleBox">{$item}</span></td>
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
                    {if $personsHeader.1!=''}
                        <td class="celulaMenuST"><input type="text" name="person[{$key}][1]" value="{$item.1}"/></td>{/if}
                    {if $personsHeader.2!=''}
                        <td class="celulaMenuST"><input type="text" name="person[{$key}][2]" value="{$item.2}"/></td>{/if}
                    {if $personsHeader.3!=''}
                        <td class="celulaMenuST"><input type="text" name="person[{$key}][3]" value="{$item.3}"/></td>{/if}
                    <td class="celulaMenuSTDR"><input type="checkbox" id="list_{$key}" name="person[{$key}][0]" checked="checked" value="1"/></td>
                </tr>
                {foreachelse}
                <tr height="30">
                    <td style="text-align:center;" colspan="100" class="celulaMenuSTDR">
                        <b>{translate label='Va rugam incarcati un fisier format .xls impreuna cu capetele de tabel.'} <br/>
                            <br/>{translate label=' Coloanele trebuie sa fie in ordine: CNP/ Prima bruta/ Data (zz/ll/aaaa)'}
                            <br/><br/> {translate label='In cazul in care ati incarcat deja un fisier, acesta nu contine date pentru afisare.'}</b>
                    </td>
                </tr>
            {/foreach}
            {if $persons|@count >0}
                <tr>
                    <td class="bkdTitleMenu"></td>
                    <td class="bkdTitleMenu" align="center" colspan="{$personsHeader|@count}"><input type="submit" name="import" value="Importa datele selectate" class="formstyle">
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