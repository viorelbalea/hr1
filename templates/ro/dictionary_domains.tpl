{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Domenii'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    {if $rw == 1}
                        <div style="padding: 10px; margin-bottom: 15px;">
                            <b>{translate label='Adauga domeniu nou'}:</b><br><br>
                            <div class="autosuggest">
                                <input autocomplete="off" type="text" id="Domain" name="Domain" value="" class="yui-ac-input" maxlength="255" style="width:600px;">
                                <div id="button_add" style="float: right; margin-top: 4px;"><a href="#"
                                                                                               onclick="window.location.href = './?m=dictionary&o=domains&JobDomainID=0&Caen=' + getCaen(); return false;"
                                                                                               title="{translate label='Adauga domeniu'}"><b>Add</b></a></div>
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
                                        <td>{translate label='Nume domeniu'}</td>
                                        <td>{translate label='Activ'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$domains key=key item=item}
                                        <tr>
                                            <td>{$item.Domain}</td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=domains&JobDomainID={$key}&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0); return false;"
                                                                            title="{translate label='Modifica status domeniu'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=domains&JobDomainID={$key}&delDomain=1'; return false;"
                                                                            title="{translate label='Sterge domeniu'}"><b>Del</b></a></div>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista de domenii care apar in aplicatie'}</span></td>
        </tr>
    </table>
</form>

{literal}
    <script type="text/javascript">
        function getCaen() {
            if (document.getElementById('Domain').value > '') {
                var elem = document.getElementById('Domain').value.split(' | ');
                return elem[1];
            } else {
                return '';
            }
        }

        $(document).ready(function () {
            $.fn.autosugguest({
                className: 'autosuggest',
                methodType: 'POST',
                minChars: 2,
                rtnIDs: true,
                dataFile: 'ajax.php?o=domain&rand=' + parseInt(Math.random() * 999999999)
            });
        });
    </script>
{/literal}