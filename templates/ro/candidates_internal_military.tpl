{include file="candidates_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="candidates_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
    </tr>
</table>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
    {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 550px;">
            <br>
            <form action="{$smarty.server.REQUEST_URI}" method="post" name="pers" onsubmit="return validateForm(this);">
                <fieldset>
                    <legend>{translate label='Stagiu militar'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="120"><b>{translate label='Satisfacut'}:</b></td>
                            <td>
                                <input type="radio" name="MilStatus" value="Y" {if $info.MilStatus=='Y'}checked{/if}>{translate label='Da'}
                                <input type="radio" name="MilStatus" value="N" {if $info.MilStatus=='N'}checked{/if}> {translate label='Nu'}
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data inceput'}:</b></td>
                            <td nowrap='nowrap'>
                                <input type="text" name="StartDate" class="formstyle"
                                       value="{if !empty($info.StartDate) && $info.StartDate != '0000-00-00'}{$info.StartDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.pers.StartDate,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#"
                                                                                        onClick="document.pers.StartDate.value = ''; return false;">{translate label='Anuleaza'}</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data sfarsit'}:</b></td>
                            <td nowrap='nowrap'>
                                <input type="text" name="StopDate" class="formstyle"
                                       value="{if !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.StopDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.pers.StopDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#"
                                                                                        onClick="document.pers.StopDate.value = ''; return false;">{translate label='Anuleaza'}</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Stare militara'}:</b></td>
                            <td>
                                <select name="Type">
                                    <option value="0">{translate label=' '}alege...</option>
                                    <option value="1" {if $info.Type==1}selected{/if}>{translate label='apt combatant'}</option>
                                    <option value="2" {if $info.Type==2}selected{/if}>{translate label='apt necombatant'}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Pozitie'}:</b></td>
                            <td><input type="text" name="Position" value="{$info.Position|default:''}" size="40" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Livret militar'}:</b></td>
                            <td><input type="text" name="Livret" value="{$info.Livret|default:''}" size="40" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Grad'}:</b></td>
                            <td><input type="text" name="Grad" value="{$info.Grad|default:''}" size="40" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Arm'}:</b></td>
                            <td><input type="text" name="Arm" value="{$info.Arm|default:''}" size="40" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Observatii'}:</b></td>
                            <td><textarea name="Notes" rows="5" cols="31">{$info.Notes}</textarea></td>
                        </tr>
                        {if $info.rw == 1 || !empty($smarty.post)}
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" value="{translate label='Salveaza'}" class="formstyle"> <input type="button" value="{translate label='Inapoi'}"
                                                                                                                        onclick="window.location='./?m=candidates'"
                                                                                                                        class="formstyle"></td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
            </form>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-right: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Permis de port arma'}</legend>
                <table cellspacing="0" cellpadding="4">
                    <tr>
                        <td>{translate label='Emitent'}</td>
                        <td>{translate label='Serie'}</td>
                        <td>{translate label='Numar'}</td>
                        <td>{translate label='Data inceput'}</td>
                        <td>{translate label='Data sfarsit'}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    {foreach from=$permis key=key item=item}
                        <tr>
                            <td><input type="text" id="Emitent_{$key}" name="Emitent_{$key}" value="{$item.Emitent}" size="20" maxlength="128"></td>
                            <td><input type="text" id="Serie_{$key}" name="Serie_{$key}" value="{$item.Serie}" size="10" maxlength="16"></td>
                            <td><input type="text" id="No_{$key}" name="No_{$key}" value="{$item.No}" size="10" maxlength="16"></td>
                            <td nowrap='nowrap'>
                                <input type="text" id="StartDate_{$key}" name="StartDate_{$key}" value="{$item.StartDate|date_format:"%d.%m.%Y"}" class="formstyle" value=""
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                    var cal1_{$key} = new CalendarPopup();
                                    cal1_{$key}.isShowNavigationDropdowns = true;
                                    cal1_{$key}.setYearSelectStartOffset(10);
                                    //writeSource("js1_{$key}");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_{$key}.select(document.getElementById('StartDate_{$key}'),'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                   NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td nowrap='nowrap'>
                                <input type="text" id="StopDate_{$key}" name="StopDate_{$key}" value="{$item.StopDate|date_format:"%d.%m.%Y"}" class="formstyle" value="" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                    var cal2_{$key} = new CalendarPopup();
                                    cal2_{$key}.isShowNavigationDropdowns = true;
                                    cal2_{$key}.setYearSelectStartOffset(10);
                                    //writeSource("js2_{$key}");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2_{$key}.select(document.getElementById('StopDate_{$key}'),'anchor2_{$key}','dd.MM.yyyy'); return false;"
                                   NAME="anchor2_{$key}" ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td>{if $info.rw == 1}
                                    <div id="button_mod"><a href="#"
                                                            onclick="if (document.getElementById('Emitent_{$key}').value && document.getElementById('Serie_{$key}').value && document.getElementById('No_{$key}').value && document.getElementById('StartDate_{$key}').value && checkDate(document.getElementById('StartDate_{$key}').value, 'Data inceput') && document.getElementById('StopDate_{$key}').value && checkDate(document.getElementById('StopDate_{$key}').value, 'Data sfarsit')) window.location.href = './?m=candidates&o=military&PersonID={$smarty.get.PersonID}&action=edit&PermisID={$key}&Emitent=' + escape(document.getElementById('Emitent_{$key}').value) + '&Serie=' + escape(document.getElementById('Serie_{$key}').value) + '&No=' + escape(document.getElementById('No_{$key}').value) + '&StartDate=' + document.getElementById('StartDate_{$key}').value + '&StopDate=' + document.getElementById('StopDate_{$key}').value; else alert('{translate label='Completati Emitent, Serie, Numar, Data de inceput, Data de sfarsit!'}'); return false;"
                                                            title="{translate label='Modifica permis'}"><b>Mod</b></a></div>{/if}</td>
                            <td>{if $info.rw == 1}
                                    <div id="button_del"><a href="#"
                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=candidates&o=military&PersonID={$smarty.get.PersonID}&action=del&PermisID={$key}'; return false;"
                                                            title="{translate label='Sterge permis'}"><b>Del</b></a></div>{/if}</td>
                        </tr>
                    {/foreach}
                    <tr>
                        <td><input type="text" id="Emitent_0" name="Emitent_0" size="20" maxlength="128"></td>
                        <td><input type="text" id="Serie_0" name="Serie_0" size="10" maxlength="16"></td>
                        <td><input type="text" id="No_0" name="No_0" size="10" maxlength="16"></td>
                        <td nowrap='nowrap'>
                            <input type="text" id="StartDate_0" name="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                var cal1_0 = new CalendarPopup();
                                cal1_0.isShowNavigationDropdowns = true;
                                cal1_0.setYearSelectStartOffset(10);
                                //writeSource("js1_0");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td nowrap='nowrap'>
                            <input type="text" id="StopDate_0" name="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                var cal2_0 = new CalendarPopup();
                                cal2_0.isShowNavigationDropdowns = true;
                                cal2_0.setYearSelectStartOffset(10);
                                //writeSource("js2_0");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_0.select(document.getElementById('StopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0" ID="anchor2_0"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td colspan="2">{if $info.rw == 1}
                                <div id="button_add"><a href="#"
                                                        onclick="if (document.getElementById('Emitent_0').value && document.getElementById('Serie_0').value && document.getElementById('No_0').value && document.getElementById('StartDate_0').value && checkDate(document.getElementById('StartDate_0').value, 'Data inceput') && document.getElementById('StopDate_0').value && checkDate(document.getElementById('StopDate_0').value, 'Data sfarsit')) window.location.href = './?m=candidates&o=military&PersonID={$smarty.get.PersonID}&action=new&Emitent=' + escape(document.getElementById('Emitent_0').value) + '&Serie=' + escape(document.getElementById('Serie_0').value) + '&No=' + escape(document.getElementById('No_0').value) + '&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value; else alert('{translate label='Completati Emitent, Serie, Numar, Data de inceput, Data de sfarsit!'}'); return false;"
                                                        title="{translate label='Adauga permis'}"><b>Add</b></a></div>{/if}</td>
                    </tr>
                </table>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>

{literal}
    <script type="text/javascript">
        function validateForm(f) {
            if (!is_empty(f.StartDate.value)) {
                return checkDate(f.StartDate.value, 'Data inceput');
            }
            if (!is_empty(f.StopDate.value)) {
                return checkDate(f.StopDate.value, 'Data sfarsit');
            }
            return true;
        }
    </script>
{/literal}

