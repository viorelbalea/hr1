{include file="dictionary_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Biblioteca'}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; padding-top: 10px;"><font color="FF0000">{$err->getErrors()}</font></td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Categorii'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr>
                                    <td>{translate label='Nume'}</td>
                                    <td colspan="3">{translate label='Descriere'}</td>
                                </tr>
                                {foreach from=$cats key=key item=item}
                                    <tr>
                                        <td><input type="text" id="Name_{$key}" name="Name_{$key}" value="{$item.Name}" size="20" maxlength="128"></td>
                                        <td><input type="text" id="Descr_{$key}" name="Descr_{$key}" value="{$item.Descr}" size="60" maxlength="255"></td>
                                        {if $rw == 1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=library&CatID={$key}&Name=' + escape(document.getElementById('Name_{$key}').value) + '&Descr=' + escape(document.getElementById('Descr_{$key}').value); return false;"
                                                                        title="{translate label='Modifica categoria'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigura(a) ca vreti sa stergeti aceasta categorie?'}')) window.location.href = './?m=dictionary&o=library&CatID={$key}&delCat=1'; return false;"
                                                                        title="{translate label='Sterge categoria'}"><b>Del</b></a></div>
                                            </td>
                                        {/if}
                                    </tr>
                                {/foreach}
                                {if $rw == 1}
                                    <tr>
                                        <td><input type="text" id="Name_0" name="Name_0" size="20" maxlength="128"></td>
                                        <td><input type="text" id="Descr_0" name="Descr_0" size="60" maxlength="255"></td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=library&CatID=0&Name=' + escape(document.getElementById('Name_0').value) + '&Descr=' + escape(document.getElementById('Descr_0').value); return false;"
                                                                    title="{translate label='Adauga categorie'}"><b>Add</b></a></div>
                                        </td>
                                    </tr>
                                {/if}
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Subcategorii'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select name="cats" onchange="if (this.value>0) window.location.href='./?m=dictionary&o=library&CatID=' + this.value">
                                <option value="">{translate label='alege categoria'}</option>
                                {foreach from=$cats key=key item=item}
                                    <option value="{$key}" {if $key == $smarty.get.CatID}selected{/if}>{$item.Name}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                {if !empty($smarty.get.CatID)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>Nume</td>
                            <td colspan="3">{translate label='Descriere'}</td>
                        </tr>
                        {foreach from=$subcats key=key item=item}
                            <tr>
                                <td><input type="text" id="Name__{$key}" name="Name_{$key}" value="{$item.Name}" size="20" maxlength="128"></td>
                                <td><input type="text" id="Descr__{$key}" name="Descr_{$key}" value="{$item.Descr}" size="30" maxlength="255"></td>
                                {if $rw == 1}
                                    <td>
                                        <div id="button_mod"><a href="#"
                                                                onclick="window.location.href = './?m=dictionary&o=library&PCatID={$smarty.get.CatID}&CatID={$key}&Name=' + escape(document.getElementById('Name__{$key}').value) + '&Descr=' + escape(document.getElementById('Descr__{$key}').value); return false;"
                                                                title="{translate label='Modifica subcategoria'}"><b>Mod</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigura(a) ca vreti sa stergeti aceasta subcategorie?'}')) window.location.href = './?m=dictionary&o=library&PCatID={$smarty.get.CatID}&CatID={$key}&delCat=1'; return false;"
                                                                title="{translate label='Sterge subcategoria'}"><b>Del</b></a></div>
                                    </td>
                                {/if}
                            </tr>
                        {/foreach}
                        {if $rw == 1}
                            <tr>
                                <td><input type="text" id="Name__0" name="Name__0" size="20" maxlength="128"></td>
                                <td><input type="text" id="Descr__0" name="Descr__0" size="30" maxlength="255"></td>
                                <td colspan="2">
                                    <div id="button_add"><a href="#"
                                                            onclick="window.location.href = './?m=dictionary&o=library&PCatID={$smarty.get.CatID}&CatID=0&Name=' + escape(document.getElementById('Name__0').value) + '&Descr=' + escape(document.getElementById('Descr__0').value); return false;"
                                                            title="{translate label='Adauga subcategorie'}"><b>Add</b></a></div>
                                </td>
                            </tr>
                        {/if}
                    </table>
                {/if}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='categorii & subcategorii'}</span></td>
    </tr>
</table>
