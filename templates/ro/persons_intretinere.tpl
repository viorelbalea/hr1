{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$persons.0.FullName}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="2" class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Persoane in intretinere'}</legend>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td>{translate label='Nume persoana'}</td>
                        <td>{translate label='Calitate'}</td>
                        <td>{translate label='CNP'}</td>
                        <td>{translate label='Data initiala'}</td>
                        <td>{translate label='Data finala'}</td>
                        <td>{translate label='Activ / Inactiv'}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    {foreach from=$persons key=key item=item}
                        {if $key > 0}
                            <tr>
                                <form action="{$smarty.server.REQUEST_URI}&action=edit_pers&ID={$key}" method="post" name="pers_{$key}">
                                    <td><input type="text" name="Nume" value="{$item.Nume}" size="30"></td>
                                    <td>
                                        <select name="Calitate">
                                            <option value="">{translate label='alege...'}</option>
                                            {foreach from=$quality key=key2 item=item2}
                                                <option value="{$key2}" {if $key2==$item.Calitate}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td><input type="text" name="CNP" value="{$item.CNP}" size="20"></td>
                                    <td>
                                        <input type="text" id="StartDate" name="StartDate" class="formstyle" value="{$item.DataIni}" size="10" maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                            var cal1_{$key} = new CalendarPopup();
                                            cal1_{$key}.isShowNavigationDropdowns = true;
                                            cal1_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js1_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal1_{$key}.select(document.pers_{$key}.StartDate,'anchor1_{$key}','dd.MM.yyyy'); return false;" NAME="anchor1_{$key}"
                                           ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate" name="StopDate" class="formstyle" value="{if $item.DataFin != '00-00-0000'}{$item.DataFin}{/if}" size="10"
                                               maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                            var cal2_{$key} = new CalendarPopup();
                                            cal2_{$key}.isShowNavigationDropdowns = true;
                                            cal2_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js2_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal2_{$key}.select(document.pers_{$key}.StopDate,'anchor2_{$key}','dd.MM.yyyy'); return false;" NAME="anchor2_{$key}"
                                           ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td align="center"><input type="checkbox" name="Active" {if $item.Active==1}checked{/if}></td>
                                    {if $persons.0.rw==1}
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (!is_empty(document.pers_{$key}.Nume.value) && !is_empty(document.pers_{$key}.Calitate.value) && !is_empty(document.pers_{$key}.CNP.value) && document.pers_{$key}.StartDate.value && checkDate(document.pers_{$key}.StartDate.value, 'Data initiala') && (is_empty(document.pers_{$key}.StopDate.value) || checkDate(document.pers_{$key}.StopDate.value, 'Data finala'))) document.pers_{$key}.submit(); else alert('{translate label='Completati Nume, Calitate, CNP, Data initiala ! '}'); return false;"
                                                                    title="{translate label='Modifica persoana'}"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="{$smarty.server.REQUEST_URI}&action=del_pers&ID={$key}"
                                                                    onclick="return confirm('{translate label='Sunteti sigur(a)?'}');"
                                                                    title="{translate label='Sterge persoana'}"><b>Del</b></a></div>
                                        </td>
                                    {else}
                                        <td colspan="2">&nbsp;</td>
                                    {/if}
                                </form>
                            </tr>
                        {/if}
                    {/foreach}
                    <tr>
                        <form action="{$smarty.server.REQUEST_URI}&action=new_pers" method="post" name="pers_0">
                            <td><input type="text" name="Nume" size="30"></td>
                            <td>
                                <select name="Calitate">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$quality key=key item=item}
                                        <option value="{$key}">{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td><input type="text" name="CNP" size="20"></td>
                            <td>
                                <input type="text" id="StartDate" name="StartDate" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.pers_0.StartDate,'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td>
                                <input type="text" id="StopDate" name="StopDate" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                    var cal2_0 = new CalendarPopup();
                                    cal2_0.isShowNavigationDropdowns = true;
                                    cal2_0.setYearSelectStartOffset(10);
                                    //writeSource("js2_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2_0.select(document.pers_0.StopDate,'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0" ID="anchor2_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td align="center">{if $persons.0.rw==1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (!is_empty(document.pers_0.Nume.value) && !is_empty(document.pers_0.Calitate.value) && !is_empty(document.pers_0.CNP.value) && document.pers_0.StartDate.value && checkDate(document.pers_0.StartDate.value, 'Data initiala') && (is_empty(document.pers_0.StopDate.value) || checkDate(document.pers_0.StopDate.value, 'Data finala'))) document.pers_0.submit(); else alert('Completati Nume, Calitate, CNP, Data initiala !'); return false;"
                                                            title="{translate label='Adauga persoana'}"><b>Add</b></a></div>{/if}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </form>
                    </tr>
                </table>
            </fieldset>
            <p style="padding: 10px"><input type="button" value="{translate label='Anuleaza'}" onclick="window.location='./?m=persons'" class="formstyle"></p>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>
</form>

