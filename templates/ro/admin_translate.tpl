{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Traduceri'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <select onchange="if (this.value > '') window.location.href = './?m=admin&o=translate&lang=' + this.value;">
                        <option value="">{translate label='alege traducere'}</option>
                        {foreach from=$langs key=key item=item}
                            {if $key != 'ro'}
                                <option value="{$key}" {if $key == $smarty.get.lang}selected{/if}>Romana -> {$item}</option>
                            {/if}
                        {/foreach}
                    </select>
                    {if !empty($smarty.get.lang)}
                        {foreach from=$letters item=letter}
                            &nbsp;&nbsp;&nbsp;
                            <a href="./?m=admin&o=translate&lang={$smarty.get.lang}&letter={$letter}">{if $letter == $smarty.get.letter}<b>{$letter}</b>{else}{$letter}{/if}</a>
                        {/foreach}
                        &nbsp;&nbsp;&nbsp;
                        <a href="./?m=admin&o=translate&lang={$smarty.get.lang}&letter=Altele">{if $smarty.get.letter == 'Altele'}<b>Altele</b>{else}Altele{/if}</a>
                        &nbsp;&nbsp;&nbsp;
                        <input type="button" value="{translate label='Generare traducere'}"
                               onclick="window.location.href = './?m=admin&o=translate&lang={$smarty.get.lang}&generate=1';">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>
                                    {if $err->getErrors()}
                                        <font color="FF0000">{$err->getErrors()}</font>
                                        <br>
                                        <br>
                                    {/if}
                                </td>
                            </tr>
                            <tr>
                                <td><b>ro</b></td>
                                <td><b>{$smarty.get.lang}</b></td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="ro_0" size="60" maxlength="1000"></td>
                                <td><input type="text" id="lng_0" size="60" maxlength="1000"></td>
                                <td colspan="2">
                                    <div id="button_add"><a href="#"
                                                            onclick="window.location.href = './?m=admin&o=translate&lang={$smarty.get.lang}&letter={$smarty.get.letter}&ID=0&ro=' + escape(document.getElementById('ro_0').value) + '&lng=' + document.getElementById('lng_0').value; return false;"
                                                            title="Adauga traducere"><b>Add</b></a></div>
                                </td>
                            </tr>
                            {foreach from=$translates key=ID item=item}
                                <tr>
                                    <td><input type="text" id="ro_{$ID}" value="{$item.ro}" size="60" maxlength="1000"></td>
                                    <td><input type="text" id="lng_{$ID}" value="{$item[$smarty.get.lang]}" size="60" maxlength="1000"></td>
                                    <td>
                                        <div id="button_mod"><a href="#"
                                                                onclick="window.location.href = './?m=admin&o=translate&lang={$smarty.get.lang}&letter={$smarty.get.letter}&ID={$ID}&ro=' + escape(document.getElementById('ro_{$ID}').value) + '&lng=' + document.getElementById('lng_{$ID}').value; return false;"
                                                                title="Modifica traducere"><b>Mod</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=admin&o=translate&lang={$smarty.get.lang}&letter={$smarty.get.letter}&ID={$ID}&del=1'; return false;"
                                                                title="Sterge traducere"><b>Del</b></a></div>
                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                    {/if}
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista de labels care apar in aplicatie'}</span></td>
        </tr>
    </table>
</form>
