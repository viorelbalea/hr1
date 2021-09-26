{include file="candidates_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="candidates_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
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
                <legend>CV</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>{translate label='Nume'}:</td>
                        <td><b>{$info.FullName}</b></td>
                    </tr>
                    <tr>
                        <td>{translate label='Telefon'}:</td>
                        <td><b>{$info.Phone|default:'-'}</b></td>
                    </tr>
                    <tr>
                        <td>{translate label='Mobil'}:</td>
                        <td><b>{$info.Mobile|default:'-'}</b></td>
                    </tr>
                    <tr>
                        <td>{translate label='Email'}:</td>
                        <td><b>{$info.Email|default:'-'}</b></td>
                    </tr>
                    <tr>
                        <td>{translate label='Stare civila'}:</td>
                        <td><b>{$marital_status[$info.MaritalStatus]}</b></td>
                    </tr>
                    <tr>
                        <td>{translate label='Judet'}:</td>
                        <td><b>{$info.DistrictName}</b></td>
                    </tr>
                    <tr>
                        <td>{translate label='Localitate'}:</td>
                        <td><b>{$info.CityName}</b></td>
                    </tr>
                    <tr>
                        <td>{translate label='Adresa'}:</td>
                        <td><b>Cod postal: {$info.StreetCode}, Strada: {$info.StreetName}, Nr. {$info.StreetNumber}</b></td>
                    </tr>
                </table>
                <br>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr valign="top">
                        <td>
                            <fieldset>
                                <legend>{translate label='Experienta profesionala'}</legend>
                                <table border="0" cellpadding="4" cellspacing="0" width="100%">
                                    <tr>
                                        <td>{translate label='Data de inceput'}</td>
                                        <td>{translate label='Data de sfarsit'}</td>
                                        <td>{translate label='Companie'}</td>
                                        <td>{translate label='Domeniu'}</td>
                                        <td>{translate label='Functie'}</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    {foreach from=$prof_exp key=key item=item}
                                        <tr bgcolor="#efefef">
                                            <form action="{$smarty.server.REQUEST_URI}&action=edit_prof&ProfID={$key}" method="post" name="prof_{$key}">
                                                <td>
                                                    <input type="text" id="StartDate" name="StartDate" class="formstyle" value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10"
                                                           maxlength="10">
                                                    <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                        var cal1_{$key} = new CalendarPopup();
                                                        cal1_{$key}.isShowNavigationDropdowns = true;
                                                        cal1_{$key}.setYearSelectStartOffset(10);
                                                        //writeSource("js1_{$key}");
                                                    </SCRIPT>
                                                    <A HREF="#" onClick="cal1_{$key}.select(document.prof_{$key}.StartDate,'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                                       NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                                                </td>
                                                <td>
                                                    <input type="text" id="StopDate" name="StopDate" class="formstyle" value="{$item.StopDate|date_format:"%d.%m.%Y"}" size="10"
                                                           maxlength="10">
                                                    <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                                        var cal2_{$key} = new CalendarPopup();
                                                        cal2_{$key}.isShowNavigationDropdowns = true;
                                                        cal2_{$key}.setYearSelectStartOffset(10);
                                                        //writeSource("js2_{$key}");
                                                    </SCRIPT>
                                                    <A HREF="#" onClick="cal2_{$key}.select(document.prof_{$key}.StopDate,'anchor2_{$key}','dd.MM.yyyy'); return false;"
                                                       NAME="anchor2_{$key}" ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>
                                                </td>
                                                <td><input type="text" name="Company" value="{$item.Company}"/></td>
                                                <td><select name="DomainID" class="dropdown">
                                                        <option value="0">{translate label='alege domeniul'}</option>{foreach from=$jobdomains key=key2 item=item2}
                                                        <option value="{$key2}" {if $key2==$item.DomainID}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                                <td><select name="FunctionIDRecr" class="dropdown">
                                                        <option value="0">{translate label='alege functia'}</option>{foreach from=$functions_recr key=key2 item=item2}
                                                        <option value="{$key2}" {if $key2==$item.FunctionIDRecr}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                        </tr>
                                        <tr bgcolor="#efefef">
                                            <td colspan="7">
                                                {translate label='Localitate'} <input type="text" name="City" value="{$item.City|escape:'html'}" size="50" maxlength="64"
                                                                                      style="font-size: 10px;">
                                                &nbsp;&nbsp;&nbsp;
                                                {translate label='Tara'} <input type="text" name="Country" value="{$item.Country|escape:'html'}" size="50" maxlength="64"
                                                                                style="font-size: 10px;">
                                            </td>
                                        </tr>
                                        <tr bgcolor="#efefef">
                                            <td colspan="5"><textarea name="Responsabilities"
                                                                      style="width:900px; height: 50px; font-size: 10px;">{$item.Responsabilities|escape:'html'}</textarea></td>
                                            {if $info.rw==1}
                                                <td>
                                                    <div id="button_mod"><a href="#" onclick="if (document.prof_{$key}.StartDate.value &&
                                                                checkDate(document.prof_{$key}.StartDate.value, 'Data de inceput experienta profesionala') &&
                                                                (is_empty(document.prof_{$key}.StopDate.value) || checkDate(document.prof_{$key}.StopDate.value, 'Data de sfarsit experienta profesionala')) &&
                                                                !is_empty(document.prof_{$key}.Company.value) &&
                                                                document.prof_{$key}.DomainID.selectedIndex>0 &&
                                                                document.prof_{$key}.FunctionIDRecr.selectedIndex>0) document.prof_{$key}.submit(); else alert('{translate label='Completati Data de inceput, Compania, Domeniul si Functia! '}'); return false;"
                                                                            title="{translate label='Modifica experienta'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="{$smarty.server.REQUEST_URI}&action=del_prof&ProfID={$key}"
                                                                            onclick="return confirm('{translate label='Sunteti sigur(a)?'}');"
                                                                            title="{translate label='Sterge experienta'}"><b>Del</b></a></div>
                                                </td>
                                            {else}
                                                <td colspan="2">&nbsp;</td>
                                            {/if}
                                            </form>
                                        </tr>
                                        <tr>
                                            <td colspan="7"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="border-top: 1px dashed #cccccc;"><span style="font-size: 1px;">&nbsp;</span></td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <form action="{$smarty.server.REQUEST_URI}&action=new_prof" method="post" name="prof_0">
                                            <td>
                                                <input type="text" id="StartDate" name="StartDate" class="formstyle" value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                    var cal1_0 = new CalendarPopup();
                                                    cal1_0.isShowNavigationDropdowns = true;
                                                    cal1_0.setYearSelectStartOffset(10);
                                                    //writeSource("js1_0");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal1_0.select(document.prof_0.StartDate,'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                                   ID="anchor1_0"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="StopDate" name="StopDate" class="formstyle" value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                                    var cal2_0 = new CalendarPopup();
                                                    cal2_0.isShowNavigationDropdowns = true;
                                                    cal2_0.setYearSelectStartOffset(10);
                                                    //writeSource("js2_0");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal2_0.select(document.prof_0.StopDate,'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                                   ID="anchor2_0"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td><input type="text" name="Company" value=""/></td>
                                            <td><select name="DomainID" class="dropdown">
                                                    <option value="0">{translate label='alege domeniul'}</option>{foreach from=$jobdomains key=key item=item}
                                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                                            <td><select name="FunctionIDRecr" class="dropdown">
                                                    <option value="0">{translate label='alege functia'}</option>{foreach from=$functions_recr key=key item=item}
                                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            Localitate <input type="text" name="City" size="50" maxlength="64" style="font-size: 10px;">
                                            &nbsp;&nbsp;&nbsp;
                                            Tara <input type="text" name="Country" size="50" maxlength="64" style="font-size: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><textarea name="Responsabilities" style="width:900px; height: 50px; font-size: 10px;">Responsabilitati</textarea></td>
                                        <td>{if $info.rw==1}
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.prof_0.StartDate.value && checkDate(document.prof_0.StartDate.value, 'Data de inceput experienta profesionala') && (is_empty(document.prof_0.StopDate.value) || checkDate(document.prof_0.StopDate.value, 'Data de sfarsit experienta profesionala')) && !is_empty(document.prof_0.Company.value) && document.prof_0.DomainID.selectedIndex>0 && document.prof_0.FunctionIDRecr.selectedIndex>0) document.prof_0.submit(); else alert('{translate label='Completati Data de inceput, Compania, Domeniul si Functia!'}'); return false;"
                                                                        title="{translate label='Adauga experienta'}"><b>Add</b></a></div>{/if}</td>
                                        <td></td>
                                        </form>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <fieldset>
                                <legend>{translate label='Studii'}</legend>
                                <table border="0" cellpadding="4" cellspacing="0" width="100%">
                                    <tr>
                                        <td>{translate label='Data de inceput'}</td>
                                        <td>{translate label='Data de sfarsit'}</td>
                                        <td>{translate label='Institutie'}</td>
                                        <td>{translate label='Specializare'}</td>
                                        <td>{translate label='Domeniu'}</td>
                                        <td>{translate label='Diploma obtinuta'}</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    {foreach from=$std key=key item=item}
                                        <tr>
                                            <form action="{$smarty.server.REQUEST_URI}&action=edit_std&StdID={$key}" method="post" name="std_{$key}">
                                                <td>
                                                    <input type="text" id="StartDate" name="StartDate" class="formstyle" value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10"
                                                           maxlength="10">
                                                    <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                        var cal1_{$key} = new CalendarPopup();
                                                        cal1_{$key}.isShowNavigationDropdowns = true;
                                                        cal1_{$key}.setYearSelectStartOffset(10);
                                                        //writeSource("js1_{$key}");
                                                    </SCRIPT>
                                                    <A HREF="#" onClick="cal1_{$key}.select(document.std_{$key}.StartDate,'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                                       NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                                                </td>
                                                <td>
                                                    <input type="text" id="StopDate" name="StopDate" class="formstyle" value="{$item.StopDate|date_format:"%d.%m.%Y"}" size="10"
                                                           maxlength="10">
                                                    <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                                        var cal2_{$key} = new CalendarPopup();
                                                        cal2_{$key}.isShowNavigationDropdowns = true;
                                                        cal2_{$key}.setYearSelectStartOffset(10);
                                                        //writeSource("js2_{$key}");
                                                    </SCRIPT>
                                                    <A HREF="#" onClick="cal2_{$key}.select(document.std_{$key}.StopDate,'anchor2_{$key}','dd.MM.yyyy'); return false;"
                                                       NAME="anchor2_{$key}" ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>
                                                </td>
                                                <td><input type="text" name="Institution" value="{$item.Institution|escape:'html'}" size="20" maxlength="255"></td>
                                                <td><input type="text" name="Specialization" value="{$item.Specialization|escape:'html'}" size="20" maxlength="255"></td>
                                                <td><select name="DomainID" class="dropdown">
                                                        <option value="0">alege domeniul</option>{foreach from=$jobdomains key=key2 item=item2}
                                                        <option value="{$key2}" {if $key2==$item.DomainID}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                                <td><input type="text" name="Diploma" value="{$item.Diploma|escape:'html'}" size="20" maxlength="255"></td>
                                                {if $info.rw==1}
                                                    <td>
                                                        <div id="button_mod"><a href="#" onclick="if (document.std_{$key}.StartDate.value &&
                                                                    checkDate(document.std_{$key}.StartDate.value, 'Data de inceput studii') &&
                                                                    (is_empty(document.std_{$key}.StopDate.value) || checkDate(document.std_{$key}.StopDate.value, 'Data de sfarsit studii')) &&
                                                                    document.std_{$key}.Institution.value &&
                                                                    document.std_{$key}.Specialization.value &&
                                                                    document.std_{$key}.DomainID.selectedIndex>0) document.std_{$key}.submit(); else alert('{translate label='Completati Data de inceput, Institutia, Specializarea si Domeniul!'}'); return false;"
                                                                                title="{translate label='Modifica studiu'}"><b>Mod</b></a></div>
                                                    </td>
                                                    <td>
                                                        <div id="button_del"><a href="{$smarty.server.REQUEST_URI}&action=del_std&StdID={$key}"
                                                                                onclick="return confirm('{translate label='Sunteti sigur(a)?'}');"
                                                                                title="{translate label='Sterge studiu'}"><b>Del</b></a></div>
                                                    </td>
                                                {else}
                                                    <td colspan="2">&nbsp;</td>
                                                {/if}
                                            </form>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <form action="{$smarty.server.REQUEST_URI}&action=new_std" method="post" name="std_0">
                                            <td>
                                                <input type="text" id="StartDate" name="StartDate" class="formstyle" value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                    var cal1_0 = new CalendarPopup();
                                                    cal1_0.isShowNavigationDropdowns = true;
                                                    cal1_0.setYearSelectStartOffset(10);
                                                    //writeSource("js1_0");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal1_0.select(document.std_0.StartDate,'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                                   ID="anchor1_0"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="StopDate" name="StopDate" class="formstyle" value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                                    var cal2_0 = new CalendarPopup();
                                                    cal2_0.isShowNavigationDropdowns = true;
                                                    cal2_0.setYearSelectStartOffset(10);
                                                    //writeSource("js2_0");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal2_0.select(document.std_0.StopDate,'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                                   ID="anchor2_0"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td><input type="text" name="Institution" size="20" maxlength="255"></td>
                                            <td><input type="text" name="Specialization" size="20" maxlength="255"></td>
                                            <td><select name="DomainID" class="dropdown">
                                                    <option value="0">alege domeniul</option>{foreach from=$jobdomains key=key item=item}
                                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                                            <td><input type="text" name="Diploma" size="20" maxlength="255"></td>
                                            <td>{if $info.rw==1}
                                                    <div id="button_add"><a href="#"
                                                                            onclick="if (document.std_0.StartDate.value && checkDate(document.std_0.StartDate.value, 'Data de inceput studii') && (is_empty(document.std_0.StopDate.value) || checkDate(document.std_0.StopDate.value, 'Data de sfarsit studii')) && document.std_0.Institution.value && document.std_0.Specialization.value && document.std_0.DomainID.selectedIndex>0) document.std_0.submit(); else alert('{translate label='Completati Data de inceput, Institutia, Specializarea si Domeniul!'}'); return false;"
                                                                            title="{translate label='Adauga studiu'}"><b>Add</b></a></div>{/if}</td>
                                            <td></td>
                                        </form>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <fieldset>
                                <legend>{translate label='Limbii straine'}</legend>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Limba straina'}</td>
                                        <td>{translate label='Citit'}</td>
                                        <td>{translate label='Scris'}</td>
                                        <td>{translate label='Vorbit'}</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    {foreach from=$lang key=key item=item}
                                        <tr>
                                            <form action="{$smarty.server.REQUEST_URI}&action=edit_lang&LangID={$key}" method="post" name="lang_{$key}">
                                                <td><select name="Lang">
                                                        <option value="0">{translate label='alege limba'}</option>{foreach from=$languages key=key2 item=item2}
                                                        <option value="{$key2}" {if $key2==$item.Lang}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                                <td><select name="ReadLevel">
                                                        <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key2 item=item2}
                                                        <option value="{$key2}" {if $key2==$item.ReadLevel}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                                <td><select name="WriteLevel">
                                                        <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key2 item=item2}
                                                        <option value="{$key2}" {if $key2==$item.WriteLevel}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                                <td><select name="SpeakLevel">
                                                        <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key2 item=item2}
                                                        <option value="{$key2}" {if $key2==$item.SpeakLevel}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                                {if $info.rw==1}
                                                    <td>
                                                        <div id="button_mod"><a href="#"
                                                                                onclick="if (document.lang_{$key}.Lang.selectedIndex>0 && document.lang_{$key}.ReadLevel.selectedIndex>0 && document.lang_{$key}.WriteLevel.selectedIndex>0 && document.lang_{$key}.SpeakLevel.selectedIndex>0) document.lang_{$key}.submit(); else alert('{translate label='Alegeti Limba, nivelul pentru citit, scris si vorbit!'}'); return false;"
                                                                                title="{translate label='Modifica limba straina'}"><b>Mod</b></a></div>
                                                    </td>
                                                    <td>
                                                        <div id="button_del"><a href="{$smarty.server.REQUEST_URI}&action=del_lang&LangID={$key}"
                                                                                onclick="return confirm('{translate label='Sunteti sigur(a)?'}');"
                                                                                title="{translate label='Sterge limba straina'}"><b>Del</b></a></div>
                                                    </td>
                                                {else}
                                                    <td colspan="2">&nbsp;</td>
                                                {/if}
                                            </form>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <form action="{$smarty.server.REQUEST_URI}&action=new_lang" method="post" name="lang_0">
                                            <td><select name="Lang">
                                                    <option value="0">{translate label='alege limba'}</option>{foreach from=$languages key=key item=item}
                                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                                            <td><select name="ReadLevel">
                                                    <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key item=item}
                                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                                            <td><select name="WriteLevel">
                                                    <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key item=item}
                                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                                            <td><select name="SpeakLevel">
                                                    <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key item=item}
                                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                                            <td>{if $info.rw==1}
                                                    <div id="button_add"><a href="#"
                                                                            onclick="if (document.lang_0.Lang.selectedIndex>0 && document.lang_0.ReadLevel.selectedIndex>0 && document.lang_0.WriteLevel.selectedIndex>0 && document.lang_0.SpeakLevel.selectedIndex>0) document.lang_0.submit(); else alert('{translate label='Alegeti Limba, nivelul pentru citit, scris si vorbit!'}'); return false;"
                                                                            title="{translate label='Adauga limba straina'}"><b>Add</b></a></div>{/if}</td>
                                            <td></td>
                                        </form>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <fieldset>
                                <legend>{translate label='Pozitii de interes'}</legend>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    {foreach from=$func_recr key=key item=item}
                                        <tr>
                                            <form action="{$smarty.server.REQUEST_URI}&action=edit_func_recr&ID={$key}" method="post" name="func_{$key}">
                                                <td><select name="FunctionIDRecr">
                                                        <option value="0">{translate label='alege functia'}</option>{foreach from=$functions_recr key=key2 item=item2}
                                                        <option value="{$key2}" {if $key2==$item}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                                {if $info.rw==1}
                                                    <td>
                                                        <div id="button_mod"><a href="#"
                                                                                onclick="if (document.func_{$key}.FunctionIDRecr.selectedIndex>0) document.func_{$key}.submit(); else alert('{translate label='Alegeti functia!'}'); return false;"
                                                                                title="{translate label='Modifica functia'}"><b>Mod</b></a></div>
                                                    </td>
                                                    <td>
                                                        <div id="button_del"><a href="{$smarty.server.REQUEST_URI}&action=del_func_recr&ID={$key}"
                                                                                onclick="return confirm('{translate label='Sunteti sigur(a)?'}');"
                                                                                title="{translate label='Sterge functia'}"><b>Del</b></a></div>
                                                    </td>
                                                {else}
                                                    <td colspan="2">&nbsp;</td>
                                                {/if}
                                            </form>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <form action="{$smarty.server.REQUEST_URI}&action=new_func_recr" method="post" name="func_0">
                                            <td><select name="FunctionIDRecr">
                                                    <option value="0">{translate label='alege functia'}</option>{foreach from=$functions_recr key=key item=item}
                                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                                            <td>{if $info.rw==1}
                                                    <div id="button_add"><a href="#"
                                                                            onclick="if (document.func_0.FunctionIDRecr.selectedIndex>0) document.func_0.submit(); else alert('{translate label='Alegeti functia!'}'); return false;"
                                                                            title="{translate label='Adauga functie'}"><b>Add</b></a></div>{/if}</td>
                                            <td></td>
                                        </form>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <form action="{$smarty.server.REQUEST_URI}" method="post" name="cv">
                            <td>
                                <b>{translate label='Calificari relevante'}:</b>
                                <br>
                                <textarea name="CVQualifRel" rows="8" cols="120" wrap="soft">{$info.CVQualifRel}</textarea>
                            </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <b>{translate label='Cursuri'}:</b>
                            <br>
                            <textarea name="CVCourses" rows="8" cols="120" wrap="soft">{$info.CVCourses}</textarea>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <b>{translate label='Aptitudini'}:</b>
                            <br>
                            <textarea name="CVSkills" rows="8" cols="120" wrap="soft">{$info.CVSkills}</textarea>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <b>{translate label='Hobiuri'}:</b>
                            <br>
                            <textarea name="CVHobby" rows="4" cols="120" wrap="soft">{$info.CVHobby}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <br>
                            {if $info.rw==1}<input type="submit" value="{translate label='Salveaza'}">{/if}&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="button" value="{translate label='Printeaza'}" onclick="window.open('{$smarty.server.REQUEST_URI}&action=print', 'print')">
                            <input type="button" value="{translate label='Printeaza'} EuroPass"
                                   onclick="window.open('{$smarty.server.REQUEST_URI}&action=print_euro', 'print_euro')">&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="button" value="Export .doc" onclick="window.open('{$smarty.server.REQUEST_URI}&action=export', 'export')">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>
</form>

