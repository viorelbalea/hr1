{include file="candidates_menu.tpl"}
<br>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="candidates_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$cm.0.FullName}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="2" class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;">
            <fieldset>
                <legend>{translate label='Istoric CM'}</legend>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td>{translate label='Functie'}</td>
                        <td>{translate label='Companie'}</td>
                        <td>{translate label='Data initiala'}</td>
                        <td>{translate label='Data finala'}</td>
                        <td align="center">{translate label='Ani / Luni / Zile'}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    {foreach from=$cm key=key item=item}
                        {if $key > 0}
                            <tr>
                                <form action="{$smarty.server.REQUEST_URI}&action=edit_cm&ID={$key}" method="post" name="cm_{$key}">
                                    <td><input type="text" name="Functie" value="{$item.Functie|escape:'html'}" size="30"></td>
                                    <td><input type="text" name="Companie" value="{$item.Companie|escape:'html'}" size="30"></td>
                                    <td>
                                        <input type="text" id="StartDate" name="StartDate" class="formstyle" value="{$item.DataIni}" size="10" maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                            var cal1_{$key} = new CalendarPopup();
                                            cal1_{$key}.isShowNavigationDropdowns = true;
                                            cal1_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js1_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal1_{$key}.select(document.cm_{$key}.StartDate,'anchor1_{$key}','dd.MM.yyyy'); return false;" NAME="anchor1_{$key}"
                                           ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate" name="StopDate" class="formstyle" value="{$item.DataFin}" size="10" maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                            var cal2_{$key} = new CalendarPopup();
                                            cal2_{$key}.isShowNavigationDropdowns = true;
                                            cal2_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js2_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal2_{$key}.select(document.cm_{$key}.StopDate,'anchor2_{$key}','dd.MM.yyyy'); return false;" NAME="anchor2_{$key}"
                                           ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td align="center">{$item.years} / {$item.months} / {$item.days}</td>
                                    {if $cm.0.rw==1}
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (!is_empty(document.cm_{$key}.Functie.value) && !is_empty(document.cm_{$key}.Companie.value) && document.cm_{$key}.StartDate.value && checkDate(document.cm_{$key}.StartDate.value, 'Data initiala') && document.cm_{$key}.StopDate.value && checkDate(document.cm_{$key}.StopDate.value, 'Data finala')) document.cm_{$key}.submit(); else alert('{translate label='Completati Functie, Companie, Data initiala !'}'); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="{$smarty.server.REQUEST_URI}&action=del_cm&ID={$key}"
                                                                    onclick="return confirm('{translate label='Sunteti sigur(a)?'}');" title="{translate label='Sterge'}"><b>Del</b></a>
                                            </div>
                                        </td>
                                    {else}
                                        <td colspan="2">&nbsp;</td>
                                    {/if}
                                </form>
                            </tr>
                        {/if}
                    {/foreach}
                    {if count($cm) > 1}
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td align="center">{$cm.0.cyears} / {$cm.0.cmonths} / {$cm.0.cdays}</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    {/if}
                    <tr>
                        <form action="{$smarty.server.REQUEST_URI}&action=new_cm" method="post" name="cm_0">
                            <td><input type="text" name="Functie" size="30"></td>
                            <td><input type="text" name="Companie" size="30"></td>
                            <td>
                                <input type="text" id="StartDate" name="StartDate" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.cm_0.StartDate,'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
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
                                <A HREF="#" onClick="cal2_0.select(document.cm_0.StopDate,'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0" ID="anchor2_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td>&nbsp;</td>
                            <td align="center">{if $cm.0.rw==1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (!is_empty(document.cm_0.Functie.value) && !is_empty(document.cm_0.Companie.value) && document.cm_0.StartDate.value && checkDate(document.cm_0.StartDate.value, 'Data initiala') && document.cm_0.StopDate.value && checkDate(document.cm_0.StopDate.value, 'Data finala')) document.cm_0.submit(); else alert('{translate label='Completati Functie, Calitate, Data initiala, Data finala !'}'); return false;"
                                                            title="{translate label='Adauga'}"><b>Add</b></a></div>{/if}</td>
                            <td>&nbsp;</td>
                        </form>
                    </tr>
                    <tr>
                        <td colspan="7"><input type="button" value="{translate label='Inapoi'}" onclick="window.location='./?m=candidates'" class="formstyle"></td>
                    </tr>
                </table>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>

