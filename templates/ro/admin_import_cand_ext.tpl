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
<form action="index.php?m=admin&o=import_cand_ext" method="POST" enctype="multipart/form-data" name="upload_cand_ext">

    <label>Sursa</label>
    <select name="SourceId">
        {foreach from=$sources key=key item=item}
            <option value="{$key}">{$item}</option>
        {/foreach}
    </select>

    <label>Post</label>
    <select name="PostId">
        {foreach from=$posts key=key item=item}
            <option value="{$key}">{$item}</option>
        {/foreach}
    </select>

    <input type="file" name="fisier"/>
    <input type="submit" name="upload" value="Incarca fisier" class="formstyle">
</form>

{if $uploaded!=1}
    <form action="{$smarty.server.REQUEST_URI}" method="POST" enctype="multipart/form-data" name="cand_ext">
        <input type="hidden" name="PostId" value="{$smarty.post.PostId}"/>
        <table cellspacing="0" cellpadding="2" width="100%" class="grid">
            <tr>
                <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
                {foreach from=$personsHeader key=key item=item name=iter1}
                    <td class="bkdTitleMenu"><span class="TitleBox">{$key}<br/>{$item}</span></td>
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
                        {if $personsHeader.$key2!=''}
                            <td class="celulaMenuST"><input type="text" name="person[{$key}][{$key2}]" value="{$item.$key2}"/></td>{/if}
                    {/foreach}
                    <td class="celulaMenuSTDR"><input type="checkbox" id="list_{$key}" name="person[{$key}][0]" checked="checked" value="1"/></td>
                </tr>
                {foreachelse}
                <tr height="30">
                    <td style="text-align:center;" colspan="100" class="celulaMenuSTDR">
                        <b>{translate label='Va rugam incarcati un fisier format .xls impreuna cu capetele de tabel.'} <br/>
                            <br/>Ordinea exportului:<br/>
                            0 - URL
                            1 - Nume
                            2 - Oras
                            3 - Sex
                            4 - Email
                            5 - Varsta
                            6 - Telefon <br/>
                            7 - Ultima companie
                            8 - Experienta
                            9 - Ultimul loc de munca
                            10 - Nivel studii
                            11 - Limba 1
                            12 - Nivel limba 1 <br/>
                            13 - Limba 2
                            14 - Nivel limba 2
                            15 - Limba 3
                            16 - Nivel limba 3
                            17 - Data aplicarii

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