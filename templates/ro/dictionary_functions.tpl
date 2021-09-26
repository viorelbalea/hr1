{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Coduri COR'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    {if $rw == 1}
                        <div style="padding: 10px; margin-bottom: 15px;">
                            <b>{translate label='Adauga functie noua'}:</b><br><br>
                            <div class="autosuggest">
                                <input autocomplete="off" type="text" id="Function" name="Function" value="" maxlength="255" style="width:600px;">
                                <div id="button_add" style="float: right; margin-top: 4px;"><a href="#"
                                                                                               onclick="window.location.href = './?m=dictionary&o=function&FunctionID=0&Cor=' + getCor(); return false;"
                                                                                               title="{translate label='Adauga functie'}"><b>Add</b></a></div>
                                <input type="hidden" name="nomID" id="nomID" autocomplete="off" disabled="disabled"/>
                            </div>

                        </div>
                    {/if}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                {if $err->getErrors()}
                                    <font color="FF0000">{$err->getErrors()}</font>
                                    <br>
                                    <br>
                                {/if}
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td><b>#</b></td>
                                        <td><b>{translate label='Functie'}</b></td>
                                        <td><b>{translate label='COR'}</b></td>
                                        <td><b>{translate label='Activa'}</b></td>
                                        <td>{translate label='Observatii'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$functions key=key item=item name=iter}
                                        <tr>
                                            <td>{$smarty.foreach.iter.iteration}</td>
                                            <td>{$item.Function}</td>
                                            <td>{$item.COR}</td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            <td align="center"><input type="text" id="FunctionObs_{$key}" name="FunctionObs_{$key}" value="{$item.FunctionObs}" size="40"
                                                                      maxlength="128" class="cod"/></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('Function_{$key}').value) || document.getElementById('GroupID_{$key}').selectedIndex == 0) alert('{translate label='Nu ati introdus Nume functie sau Grupa de functii!'}'); else window.location.href = './?m=dictionary&o=function_group&FunctionID={$key}&Function=' + escape(document.getElementById('Function_{$key}').value) + '&FunctionObs=' + escape(document.getElementById('FunctionObs_{$key}').value) + '&Status=' + (document.getElementById('Statusf_{$key}').checked ? 1 : 0) + '&GroupID=' + document.getElementById('GroupID_{$key}').value; return false;"
                                                                            title="{translate label='Modifica functie'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=function&FunctionID={$key}&delFunction=1'; return false;"
                                                                            title="{translate label='Sterge functie'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista functiilor care apar in aplicatie'}</span></td>
        </tr>
    </table>
</form>

{literal}
    <script type="text/javascript">
        $(document).ready(function () {
            $.fn.autosugguest({
                className: 'autosuggest',
                methodType: 'POST',
                minChars: 2,
                rtnIDs: true,
                dataFile: 'ajax.php?o=function&rand=' + parseInt(Math.random() * 999999999)
            });
        });

        function getCor() {
            if (document.getElementById('Function').value > '') {
                var elem = document.getElementById('Function').value.split(' | ');
                return elem[1];
            } else {
                return '';
            }
        }

    </script>
{/literal}
