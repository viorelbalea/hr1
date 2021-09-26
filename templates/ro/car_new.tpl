{include file="car_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="car" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.CarID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="car_submenu.tpl"}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare masina'}</span></td>
            </tr>
        {/if}
        {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #000000; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Adaugare masina'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Tip vehicul'}:*</b></td>
                            <td>
                                <select name="CarType">
                                    <option value="0"></option>
                                    {foreach from=$cartypes key=key item=item}
                                        <option value="{$key}" {if $key == $info.CarType}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Marca'}:*</b></td>
                            <td>
                                <select name="Brand">
                                    <option value="0"></option>
                                    {foreach from=$brands key=key item=item}
                                        <option value="{$key}" {if $key == $info.Brand}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Model'}:</b></td>
                            <td><input type="text" name="Model" value="{$info.Model|default:''}" size="20" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Numar inmatriculare'}:</b></td>
                            <td><input type="text" name="RegNo" value="{$info.RegNo|default:''}" size="20" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data inmatricularii'}:</b></td>
                            <td>
                                <input type="text" name="RegDate" class="formstyle"
                                       value="{if !empty($info.RegDate) && $info.RegDate != '0000-00-00'}{$info.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.car.RegDate,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1"
                                   ID="anchor1">{translate label='selecteaza data'}</A> | <A HREF="#"
                                                                                             onClick="document.car.RegDate.value = ''; return false;">{translate label='anuleaza'}</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Numar de omologare'}:</b></td>
                            <td><input type="text" name="ApprovalNo" value="{$info.ApprovalNo|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Numar de identificare'}:</b></td>
                            <td><input type="text" name="IdNo" value="{$info.IdNo|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Seria cartii de identitate'}:</b></td>
                            <td><input type="text" name="CardID" value="{$info.CardID|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Numarul certificatului'}:</b></td>
                            <td><input type="text" name="CertNo" value="{$info.CertNo|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Culoare'}:</b></td>
                            <td><input type="text" name="Color" value="{$info.Color|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='An fabricatie'}:</b></td>
                            <td><input type="text" name="Year" value="{$info.Year|default:''}" size="4" maxlength="4"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Tip combustibil'}:</b></td>
                            <td>
                                <select name="Fuel">
                                    <option value="0"></option>
                                    {foreach from=$fuels key=key item=item}
                                        <option value="{$key}" {if $key == $info.Fuel}selected{/if}>{translate label=$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Cilindree'}:</b></td>
                            <td><input type="text" name="Cylinders" value="{$info.Cylinders|default:''}" size="10" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Putere'}:</b></td>
                            <td><input type="text" name="Power" value="{$info.Power|default:''}" size="20" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Cutie viteze'}:</b></td>
                            <td>
                                <select name="Gear">
                                    <option value="0"></option>
                                    {foreach from=$gears key=key item=item}
                                        <option value="{$key}" {if $key == $info.Gear}selected{/if}>{translate label=$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Numar de usi'}:</b></td>
                            <td>
                                <select name="DoorsNo">
                                    <option value="0"></option>
                                    {foreach from=$doors key=key item=item}
                                        <option value="{$key}" {if $key == $info.DoorsNo}selected{/if}>{translate label=$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Dimensiune anvelope'}:</b></td>
                            <td><input type="text" name="TireSize" value="{$info.TireSize|default:''}" size="10" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Consum urban'} (L/100km):</b></td>
                            <td><input type="text" name="ConsumptionUrban" value="{$info.ConsumptionUrban|default:''}" size="10" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Consum extraurban'} (L/100km):</b></td>
                            <td><input type="text" name="ConsumptionExtraUrban" value="{$info.ConsumptionExtraUrban|default:''}" size="10" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Consum mixt'} (L/100km):</b></td>
                            <td><input type="text" name="ConsumptionCombined" value="{$info.ConsumptionCombined|default:''}" size="10" maxlength="32"></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <div align="center">
                    {if !empty($smarty.get.CarID)}
                        {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                    {else}
                        <input type="submit" value="{translate label='Adauga masina'}" class="formstyle">
                    {/if}
                </div>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Adaugare masina'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr valign="top">
                            <td><b>{translate label='Optiuni'}:</b></td>
                            <td>
                                <table cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            {foreach from=$options key=key item=item name=iter}
                                                {if $smarty.foreach.iter.iteration <= $options|@count / 2}
                                                    <p><input type="checkbox" name="Options[{$key}]" value="{$key}" {if isset($info.Options.$key)}checked{/if}> {$item}</p>
                                                {/if}
                                            {/foreach}
                                        </td>
                                        <td style="padding-left: 10px;">
                                            {foreach from=$options key=key item=item name=iter}
                                                {if $smarty.foreach.iter.iteration > $options|@count / 2}
                                                    <p><input type="checkbox" name="Options[{$key}]" value="{$key}" {if isset($info.Options.$key)}checked{/if}> {$item}</p>
                                                {/if}
                                            {/foreach}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Observatii'}:</b></td>
                            <td><textarea name="Notes" rows="10" cols="60">{$info.Notes|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Status'}:</b></td>
                            <td>
                                <select name="Status">
                                    <option value="1">{translate label='Activ'}</option>
                                    <option value="2" {if $info.Status==2}selected{/if}>{translate label='Inactiv'}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='In patrimoniu'}:</b></td>
                            <td>
                                <select name="Patrimony">
                                    <option value="1">{translate label='Da'}</option>
                                    <option value="2" {if $info.Patrimony==2}selected{/if}>{translate label='Nu'}</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>

                {if !empty($smarty.get.CarID)}
                    <br>
                    <div id="layer_co" style="display: none;">
                        <div class="eticheta">
                            {$eticheta}
                        </div>
                        <h3 class="layer">{translate label='Descriere'}</h3>
                        <div class="observatiiTextbox">
                            <textarea id="layer_co_notes"></textarea>
                            <input type="hidden" id="layer_co_notes_dest" value=""/>

                        </div>

                        <div class="saveObservatii" style="margin-top: 4px">
                            <input type="button" value="{translate label='Salveaza'}" onclick="setNotes();">
                            <input type="button" value="{translate label='Anuleaza'}"
                                   onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
                        </div>
                    </div>
                    <!---->
                    <div id="layer_co_x" style="display: none;" title="Inchide"
                         onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
                    </div>
                    <fieldset>
                        <legend>{translate label='Responsabili'}</legend>
                        <table cellspacing="0" cellpadding="4">
                            <tr>
                                <td>{translate label='Responsabil'}</td>
                                <td>{translate label='Data inceput'}</td>
                                <td>{translate label='Data sfarsit'}</td>
                                <td>{translate label='Observatii'}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            {foreach from=$resp key=key item=item}
                                <tr>
                                    <td>
                                        <select id="ObjID_{$key}">
                                            <option value="0">{translate label='alege...'}</option>
                                            {foreach from=$persons key=key2 item=item2}
                                                <option value="{$key2}" {if $key2==$item.PersonID}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td nowrap="nowrap">
                                        <input type="text" id="StartDate_{$key}" value="{$item.StartDate|date_format:"%d.%m.%Y"}" class="formstyle" value="" size="10"
                                               maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                            var cal1_{$key} = new CalendarPopup();
                                            cal1_{$key}.isShowNavigationDropdowns = true;
                                            cal1_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js1_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal1_{$key}.select(document.getElementById('StartDate_{$key}'),'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                           NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td nowrap="nowrap">
                                        <input type="text" id="StopDate_{$key}"
                                               value="{if !empty($item.StopDate) && $item.StopDate != '0000-00-00'}{$item.StopDate|date_format:"%d.%m.%Y"}{/if}" class="formstyle"
                                               value="" size="10" maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                            var cal2_{$key} = new CalendarPopup();
                                            cal2_{$key}.isShowNavigationDropdowns = true;
                                            cal2_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js2_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal2_{$key}.select(document.getElementById('StopDate_{$key}'),'anchor2_{$key}','dd.MM.yyyy'); return false;"
                                           NAME="anchor2_{$key}" ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td><input type="hidden" id="Notes_{$key}" value="{$item.Notes}"><span id="Notes_{$key}_display"></span> [<a href="#"
                                                                                                                                                 title="{$item.Notes|escape:'javascript'}"
                                                                                                                                                 onclick="getNotes('Notes_{$key}'); return false;">{translate label='Editare'}</a>]
                                    </td>
                                    <td>{if $info.Patrimony==1 && $info.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (document.getElementById('ObjID_{$key}').value > 0 && document.getElementById('StartDate_{$key}').value && checkDate(document.getElementById('StartDate_{$key}').value, '{translate label='Data inceput'}')) window.location.href = './?m=cars&o=edit&CarID={$smarty.get.CarID}&action=edit&ID={$key}&PersonID=' + document.getElementById('ObjID_{$key}').value + '&StartDate=' + document.getElementById('StartDate_{$key}').value + '&StopDate=' + document.getElementById('StopDate_{$key}').value + '&Notes=' + escape(document.getElementById('Notes_{$key}').value); else alert('{translate label='Completati Responsabil, Data inceput!'}'); return false;"
                                                                    title="{translate label='Modifica responsabil'}"><b>Mod</b></a></div>{/if}</td>
                                    <td>{if $info.Patrimony==1 && $info.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=cars&o=edit&CarID={$smarty.get.CarID}&action=del&ID={$key}'; return false;"
                                                                    title="{translate label='Sterge responsabil'}"><b>Del</b></a></div>{/if}</td>
                                </tr>
                            {/foreach}
                            {if $info.rw == 1 && $info.Patrimony==1}
                                <tr>
                                    <td>
                                        <select id="ObjID_0">
                                            <option value="0">alege...</option>
                                            {foreach from=$persons key=key item=item}
                                                <option value="{$key}">{$item}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td nowrap="nowrap">
                                        <input type="text" id="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                            var cal1_0 = new CalendarPopup();
                                            cal1_0.isShowNavigationDropdowns = true;
                                            cal1_0.setYearSelectStartOffset(10);
                                            //writeSource("js1_0");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                           ID="anchor1_0"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td nowrap="nowrap">
                                        <input type="text" id="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                            var cal2_0 = new CalendarPopup();
                                            cal2_0.isShowNavigationDropdowns = true;
                                            cal2_0.setYearSelectStartOffset(10);
                                            //writeSource("js2_0");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal2_0.select(document.getElementById('StopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                           ID="anchor2_0"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td><input type="hidden" id="Notes_0"><span id="Notes_0_display"></span> [<a href="#"
                                                                                                                 onclick="getNotes('Notes_0'); return false;">{translate label='Editare'}</a>]
                                    </td>
                                    <td colspan="2" nowrap="nowrap">{if $info.rw == 1}
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (document.getElementById('ObjID_0').value > 0 && document.getElementById('StartDate_0').value && checkDate(document.getElementById('StartDate_0').value, '{translate label='Data inceput'}')) window.location.href = './?m=cars&o=edit&CarID={$smarty.get.CarID}&action=new&ID=0&PersonID=' + document.getElementById('ObjID_0').value + '&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value + '&Notes=' + escape(document.getElementById('Notes_0').value); else alert('{translate label='Completati Responsabil, Data inceput!'}'); return false;"
                                                                    title="{translate label='Adauga responsabil'}"><b>Add</b></a></div>{/if}</td>
                                </tr>
                            {/if}
                        </table>
                    </fieldset>
                {/if}
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>

{literal}
<script type="text/javascript">
    function validateForm(f) {
        if (!is_empty(f.RegDate.value) && !checkDate(f.RegDate.value, '{/literal}{translate label='Data inmatricularii'}{literal}')) {
            return false;
        }
        return true;
    }

    function getNotes(id) {
        document.getElementById('layer_co_notes').value = document.getElementById(id).value;
        document.getElementById('layer_co_notes_dest').value = id;
        document.getElementById('layer_co').style.display = 'block';
        document.getElementById('layer_co_x').style.display = 'block';
    }

    function setNotes() {
        var id = document.getElementById('layer_co_notes_dest').value;
        document.getElementById(id).value = document.getElementById('layer_co_notes').value;
        //document.getElementById(id + '_display').innerHTML  	= document.getElementById('layer_co_notes').value.substring(0, 5) + '...';
        document.getElementById('layer_co').style.display = 'none';
        document.getElementById('layer_co_x').style.display = 'none';
    }
</script>
{/literal}