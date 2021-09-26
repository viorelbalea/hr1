{include file="persons_menu.tpl"}
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

<form action="{$smarty.server.REQUEST_URI}" method="post" name="pers">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$rights.FullName}</span></td>
        </tr>
        {if !empty($smarty.post) && $err->getErrors() == ""}
        <tr height="30">
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #000000; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
        </tr>
        {else}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Modul IT'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td width="120">&nbsp;</td>
                            <td>
                                <table cellspacing="0" cellpadding="2">
                                    <tr>
                                        <td width="120">&nbsp;</td>
                                        <td width="30" align="center"><b>{translate label='R/W'}</b></td>
                                        <td width="30" align="center"><b>{translate label='R'}</b></td>
                                        <td width="30" align="center"><b>{translate label='W'}</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {foreach from=$applications key=appid item=info}
                            {foreach from=$info key=moduleid item=item name=iter}
                                <tr>
                                    <td width="120">{if $smarty.foreach.iter.first}<b>{$item.Application}</b>{else}&nbsp;{/if}</td>
                                    <td>
                                        <table cellspacing="0" cellpadding="2">
                                            <tr>
                                                <td width="120"><b>{$item.Module}</b></td>
                                                <td width="30" align="center"><input type="radio" name="modulIT[{$appid}][{$moduleid}]" value="rw"
                                                                                     {if $rights.ModulIT.$appid.$moduleid == 'rw'}checked{/if}></td>
                                                <td width="30" align="center"><input type="radio" name="modulIT[{$appid}][{$moduleid}]" value="r"
                                                                                     {if $rights.ModulIT.$appid.$moduleid == 'r'}checked{/if}></td>
                                                <td width="30" align="center"><input type="radio" name="modulIT[{$appid}][{$moduleid}]" value="w"
                                                                                     {if $rights.ModulIT.$appid.$moduleid == 'w'}checked{/if}></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            {/foreach}
                            <tr>
                                <td colspan="2" style="border-top: 1px solid #CCCCCC;">&nbsp;</td>
                            </tr>
                        {/foreach}
                    </table>
                </fieldset>
                <br>
                {if $rights.rw==1}
                    <div align="center"><input type="submit" name="save" value="{translate label='Salveaza'}" class="formstyle"</div>{/if}
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Altele'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td width="100"><b>Hardware</b></td>
                            <td><input type="checkbox" name="others[1][1]" {if !empty($rights.ModulOthers.1.1)}checked{/if}>{translate label='PC'}</td>
                            <td><input type="checkbox" name="others[1][2]" {if !empty($rights.ModulOthers.1.2)}checked{/if}>{translate label='Laptop'}</td>
                            <td><input type="checkbox" name="others[1][3]" {if !empty($rights.ModulOthers.1.3)}checked{/if}>{translate label='Imprimanta'}</td>
                            <td><input type="checkbox" name="others[1][4]" {if !empty($rights.ModulOthers.1.4)}checked{/if}>{translate label='Altele'}</td>
                        </tr>
                        <tr>
                            <td><b>Internet</b></td>
                            <td><input type="checkbox" name="others[2][1]" {if !empty($rights.ModulOthers.2.1)}checked{/if}>{translate label='Internet full'}</td>
                            <td><input type="checkbox" name="others[2][2]" {if !empty($rights.ModulOthers.2.2)}checked{/if}>{translate label='Internet limitat'}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>eMail</b></td>
                            <td><input type="checkbox" name="others[3][1]" {if !empty($rights.ModulOthers.3.1)}checked{/if}>{translate label='eMail'}</td>
                            <td><input type="checkbox" name="others[3][2]" {if !empty($rights.ModulOthers.3.2)}checked{/if}>{translate label='webMail'}</td>
                            <td><input type="checkbox" name="others[3][3]" {if !empty($rights.ModulOthers.3.3)}checked{/if}>{translate label='mail extern'}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>IM</b></td>
                            <td><input type="checkbox" name="others[4][1]" {if !empty($rights.ModulOthers.4.1)}checked{/if}>Skype</td>
                            <td><input type="checkbox" name="others[4][2]" {if !empty($rights.ModulOthers.4.2)}checked{/if}>MSN</td>
                            <td><input type="checkbox" name="others[4][3]" {if !empty($rights.ModulOthers.4.3)}checked{/if}>Yahoo</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Observatii'}</b></td>
                            <td colspan="4"><textarea name="others[5]" rows="5" cols="60" wrap="soft">{$rights.ModulOthers.5}</textarea></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Obiecte de inventar'}</legend>
                    <table cellspacing="0" cellpadding="4">
                        <tr>
                            <td>{translate label='Obiect'}</td>
                            <td>{translate label='Data inceput'}</td>
                            <td width="120px">{translate label='Data sfarsit'}</td>
                            <td>{translate label='Observatii'}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        {foreach from=$person_inventar key=key item=item}
                            <tr>
                                <td>
                                    <select id="ObjID_{$key}">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$inventar key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.ObjID}selected{/if}>{$item2.ObjName}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td nowrap="nowrap">
                                    <input type="text" id="StartDate_{$key}" value="{$item.StartDate|date_format:"%d.%m.%Y"}" class="formstyle" value="" size="10" maxlength="10">
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
                                <td>
                                    <input type="hidden" id="Notes_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes_{$key}'); return false;">{translate label='Editare'}</a>]
                                </td>
                                <td>{if $rights.rw == 1}
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.getElementById('ObjID_{$key}').value > 0 && document.getElementById('StartDate_{$key}').value && checkDate(document.getElementById('StartDate_{$key}').value, '{translate label='Data inceput'}')) window.location.href = './?m=persons&o=modulIT&PersonID={$smarty.get.PersonID}&action=edit&ID={$key}&ObjID=' + document.getElementById('ObjID_{$key}').value + '&StartDate=' + document.getElementById('StartDate_{$key}').value + '&StopDate=' + document.getElementById('StopDate_{$key}').value + '&Notes=' + escape(document.getElementById('Notes_{$key}').value); else alert('{translate label='Completati Obiect, Data inceput!'}'); return false;"
                                                                title="{translate label='Modifica obiect de inventar'}"><b>Mod</b></a></div>{/if}</td>
                                <td>{if $rights.rw == 1}
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=modulIT&PersonID={$smarty.get.PersonID}&action=del&ID={$key}'; return false;"
                                                                title="{translate label='Sterge obiect de inventar'}"><b>Del</b></a></div>{/if}</td>
                            </tr>
                        {/foreach}
                        <tr>
                            <td>
                                <select id="ObjID_0">
                                    <option value="0">alege...</option>
                                    {foreach from=$inventar key=key item=item}
                                        <option value="{$key}">{$item.ObjName}</option>
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
                                <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>
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
                            <td>
                                <input type="hidden" id="Notes_0" value=""/>
                                <span id="Notes_0_display"></span>
                                [<a href="#" title="" onclick="getNotes('Notes_0'); return false;">{translate label='Editare'}</a>]
                            </td>
                            <td colspan="2" nowrap="nowrap">{if $rights.rw == 1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('ObjID_0').value > 0 && document.getElementById('StartDate_0').value && checkDate(document.getElementById('StartDate_0').value, '{translate label='Data inceput'}')) window.location.href = './?m=persons&o=modulIT&PersonID={$smarty.get.PersonID}&action=new&ID=0&ObjID=' + document.getElementById('ObjID_0').value + '&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value + '&Notes=' + escape(document.getElementById('Notes_0').value); else alert('{translate label='Completati Obiect, Data inceput!'}'); return false;"
                                                            title="{translate label='Adauga obiect de inventar'}"><b>Add</b></a></div>{/if}</td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        {/if}
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='drepturi pe aplicatiile firmei'}</span></td>
        </tr>
    </table>
</form>

{literal}
    <script type="text/javascript">

        function getNotes(id) {
            document.getElementById('layer_co_notes').value = document.getElementById(id).value;
            document.getElementById('layer_co_notes_dest').value = id;
            document.getElementById('layer_co').style.display = 'block';
            document.getElementById('layer_co_x').style.display = 'block';
        }

        function setNotes() {
            var id = document.getElementById('layer_co_notes_dest').value;
            document.getElementById(id).value = document.getElementById('layer_co_notes').value;
            document.getElementById(id + '_display').innerHTML = document.getElementById('layer_co_notes').value.substring(0, 5) + '...';
            document.getElementById('layer_co').style.display = 'none';
            document.getElementById('layer_co_x').style.display = 'none';
        }

    </script>
{/literal}