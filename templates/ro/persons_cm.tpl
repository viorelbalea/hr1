{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$cm.0.FullName}</span></td>
    </tr>
</table>
<table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
        <tr>
            <td>
                <form action="{$smarty.server.REQUEST_URI}&action=edit_payroll_cm&ID={$key}" method="post" enctype="multipart/form-data" name="pers"
                      onsubmit="return validateForm(this);">
                    <fieldset>
                        <legend>{translate label='Carte de munca'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="140" style="padding-top: 10px;"><b>Carte de munca:</b></td>
                                <td style="padding-top: 10px;">
                                    <select name="CM">
                                        <option value=""></option>
                                        <option value="Da" {if $cmPayroll.CM=='Da'}selected{/if}>{translate label='Da'}</option>
                                        <option value="Nu" {if $cmPayroll.CM=='Nu'}selected{/if}>{translate label='Nu'}</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Serie CM:</b></td>
                                <td><input type="text" name="CMSerie" value="{$cmPayroll.CMSerie|default:''}" size="20" maxlength="32"></td>
                            </tr>
                            <tr>
                                <td><b>Numar CM:</b></td>
                                <td><input type="text" name="CMNo" value="{$cmPayroll.CMNo|default:''}" size="20" maxlength="32"></td>
                            </tr>
                        </table>
                        <div style="text-align:left;">
                            {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                            <input type="button" value="{translate label='Anuleaza'}" onclick="window.location='./?m=persons'" class="formstyle">
                        </div>
                    </fieldset>
                </form>
            </td>
        </tr>
        <tr>
            <td class="" style="vertical-align: top; padding: 10px;">
                <fieldset>
                    <legend>{translate label='Vechime in munca'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0">
                        <tr>
                            <td>{translate label='Functie'}</td>
                            <td>{translate label='Companie'}</td>
                            <td>{translate label='Data initiala'}</td>
                            <td>{translate label='Data finala'}</td>
                            <td>{translate label='Numar zile'}</td>
                            <td>{translate label='Document'}</td>
                            <td>{translate label='Serie / Numar'}</td>
                            <td>{translate label='Vechime specialitate'}</td>
                            <td>{translate label='Perioada de scazut'}</td>
                            <td>{translate label='Non Vechime'}</td>
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
                                            <A HREF="#" onClick="cal1_{$key}.select(document.cm_{$key}.StartDate,'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_{$key}"
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
                                        <td><input type="text" name="NoDays" value="{$item.NoDays|escape:'html'}" size="2"/></td>
                                        <td>
                                            <select name="Document">
                                                <option value="">- alege -</option>
                                                {foreach from=$documents key=k item=doc}
                                                    <option value="{$k}" {if $item.Document == $k}selected{/if}>{$doc}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td><input type="text" name="SerieNo" value="{$item.SerieNo|escape:'html'}" size="10"/></td>
                                        <td><input type="checkbox" name="VechimeSpec" {if $item.VechimeSpec > 0}checked{/if} /></td>
                                        <td><input type="checkbox" name="PerioadaScazut" {if $item.PerioadaScazut > 0}checked{/if} /></td>
                                        <td><input type="checkbox" name="NonVechime" {if $item.NonVechime > 0}checked{/if} /></td>
                                        <td align="center">{$item.years} / {$item.months} / {$item.days}</td>
                                        {if $cm.0.rw==1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (!is_empty(document.cm_{$key}.Functie.value) && !is_empty(document.cm_{$key}.Companie.value)) document.cm_{$key}.submit(); else alert('{translate label='Completati Functie, Companie!'}'); return false;"
                                                                        title="{translate label='Modifica'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="{$smarty.server.REQUEST_URI}&action=del_cm&ID={$key}"
                                                                        onclick="return confirm('{translate label='Sunteti sigur(a)?'}');"
                                                                        title="{translate label='Sterge'}"><b>Del</b></a>
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
                                <td colspan="9" style="text-align:right;"><b>{translate label='Vechime in munca anterior locului de munca actual'}</b></td>
                                <td align="center">{$cm.0.cyears} / {$cm.0.cmonths} / {$cm.0.cdays}</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align:right;"><b>{translate label='Vechime totala in specialitate'}</b></td>
                                <td align="center">{$cm.0.cyearsS} / {$cm.0.cmonthsS} / {$cm.0.cdaysS}</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align:right;"><b>{translate label='Vechime scazuta anterior locului de munca actual'}</b></td>
                                <td align="center">{$cm.0.cyearsM} / {$cm.0.cmonthsM} / {$cm.0.cdaysM}</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>

                            <tr>
                                <td colspan="9" style="text-align:right;"><b>{translate label='Perioada care nu se considera vechime in munca'}</b></td>
                                <td align="center">{$cm.0.cyearsN} / {$cm.0.cmonthsN} / {$cm.0.cdaysN}</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align:right;"><b>{translate label='Vechime la locul actual de munca'}</b></td>
                                <td align="center">{$cm.0.curr_years} / {$cm.0.curr_months} / {$cm.0.curr_days}</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align:right;"><b>{translate label='Vechime totala in munca (include si actualul loc de munca)'}</b></td>
                                <td align="center">{$cm.0.ctyears} / {$cm.0.ctmonths} / {$cm.0.ctdays} <br/><!--({$cm.0.cfs} zile CFS deja scazute)--></td>
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
                                <td><input type="text" name="NoDays" size="2"/></td>
                                <td>
                                    <select name="Document">
                                        <option value="">- alege -</option>
                                        {foreach from=$documents key=key item=doc}
                                            <option value="{$key}">{$doc}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td><input type="text" name="SerieNo" value="" size="10"/></td>
                                <td><input type="checkbox" name="VechimeSpec"/></td>
                                <td><input type="checkbox" name="PerioadaScazut"/></td>
                                <td><input type="checkbox" name="NonVechime"/></td>
                                <td>&nbsp;</td>
                                <td align="center">{if $cm.0.rw==1}
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.cm_0.Functie.value) && !is_empty(document.cm_0.Companie.value)) document.cm_0.submit(); else alert('{translate label='Completati Functie, Calitate!'}'); return false;"
                                                                title="{translate label='Adauga'}"><b>Add</b></a></div>{/if}</td>
                                <td>&nbsp;</td>
                            </form>
                        </tr>
                        <tr>
                            <td colspan="12"><input type="button" value="{translate label='Anuleaza'}" onclick="window.location='./?m=persons'" class="formstyle"></td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>

