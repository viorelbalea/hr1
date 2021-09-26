{include file="dictionary_menu.tpl"}
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

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Aplicatii'}</span></td>
    </tr>
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Aplicatii'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                {foreach from=$applications key=key item=item}
                                    <tr>
                                        <td><input type="text" id="App_{$key}" name="App_{$key}" value="{$item}" size="25" maxlength="128"></td>
                                        {if $rw == 1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=applications&AppID={$key}&App=' + escape(document.getElementById('App_{$key}').value); return false;"
                                                                        title="{translate label='Modifica aplicatie'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Stergerea unei aplicatii implica stergerea tuturor modulelor si versiunilor aferente.\nSunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=applications&AppID={$key}&delApp=1'; return false;"
                                                                        title="{translate label='Sterge aplicatie'}"><b>Del</b></a></div>
                                            </td>
                                        {/if}
                                    </tr>
                                {/foreach}

                                {if $rw == 1}
                                    <tr>
                                        <td><input type="text" id="App_0" name="App_0" size="25" maxlength="128"></td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=applications&AppID=0&App=' + escape(document.getElementById('App_0').value); return false;"
                                                                    title="{translate label='Adauga aplicatie'}"><b>Add</b></a></div>
                                        </td>
                                    </tr>
                                {/if}
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>

        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
            <br/>
            <fieldset>
                <legend>{translate label='Module si Versiuni'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select name="applications" onchange="if (this.value>0) window.location.href='./?m=dictionary&o=applications&AppID=' + this.value">
                                <option value="">{translate label='alege aplicatia'}</option>
                                {foreach from=$applications key=key item=item}
                                    <option value="{$key}" {if $key == $smarty.get.AppID}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                </table>
                <br/>
                {if !empty($smarty.get.AppID)}
                    <fieldset>
                        <legend>{translate label='Module'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>Modul</td>
                                <td colspan="3">{translate label='Descriere'}</td>
                            </tr>

                            {foreach from=$app_modules key=key item=item}
                                <tr>
                                    <td><input type="text" id="Module_{$key}" name="Module_{$key}" value="{$item.Module}" size="20" maxlength="32"></td>
                                    <td><input type="text" id="Notes_{$key}" name="Notes_{$key}" value="{$item.Notes}" size="30" maxlength="255"></td>
                                    {if $rw == 1}
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=applications&AppID={$smarty.get.AppID}&ModuleID={$key}&Module=' + escape(document.getElementById('Module_{$key}').value) + '&Notes=' + escape(document.getElementById('Notes_{$key}').value); return false;"
                                                                    title="{translate label='Modifica modul'}"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=applications&AppID={$smarty.get.AppID}&ModuleID={$key}&delModule={$key}'; return false;"
                                                                    title="{translate label='Sterge modul'}"><b>Del</b></a></div>
                                        </td>
                                    {/if}
                                </tr>
                            {/foreach}

                            {if $rw == 1}
                                <tr>
                                    <td><input type="text" id="Module_0" name="Module_0" size="20" maxlength="32"></td>
                                    <td><input type="text" id="Notes_0" name="Notes_0" size="30" maxlength="255"></td>
                                    <td colspan="2">
                                        <div id="button_add"><a href="#"
                                                                onclick="window.location.href = './?m=dictionary&o=applications&AppID={$smarty.get.AppID}&ModuleID=0&Module=' + escape(document.getElementById('Module_0').value) + '&Notes=' + escape(document.getElementById('Notes_0').value); return false;"
                                                                title="{translate label='Adauga modul'}"><b>Add</b></a></div>
                                    </td>
                                </tr>
                            {/if}
                        </table>
                    </fieldset>
                    <br/>
                    <fieldset>
                        <legend>{translate label='Versiuni'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>{translate label='Versiune'}</td>
                                <td style="width:120px;">{translate label='Data Livrare'}</td>
                                <td style="width:70px;">{translate label='Descriere'}</td>
                                <td>{translate label='Activ'}</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            {foreach from=$app_versions key=key item=item}
                                <tr>
                                    <td><input type="text" id="VersionName_{$key}" name="VersionName_{$key}" value="{$item.VersionName}" style="width:100px;" maxlength="255"></td>
                                    <td>
                                        <input type="text" id="VersionLivrare_{$key}" class="formstyle"
                                               value="{if !empty($item.VersionLivrare) && $item.VersionLivrare != '0000-00-00'}{$item.VersionLivrare|date_format:"%d.%m.%Y"}{/if}"
                                               size="10" maxlength="10"/>
                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                            var cal1_{$key} = new CalendarPopup();
                                            cal1_{$key}.isShowNavigationDropdowns = true;
                                            cal1_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js1_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal1_{$key}.select(document.getElementById('VersionLivrare_{$key}'),'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                           NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                                    </td>

                                    <td>
                                        <input type="hidden" id="VersionDescription_{$key}" value="{$item.VersionDescription}"/>
                                        <span id="VersionDescription_{$key}_display"></span>
                                        [<a href="#" title="{$item.VersionDescription|escape:'javascript'}"
                                            onclick="getNotes('VersionDescription_{$key}'); return false;">{translate label='Editare'}</a>]
                                    </td>

                                    <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>

                                    {if $rw == 1}
                                        <td>
                                            <div id="button_mod">
                                                <a href="#" onclick="window.location.href = './?m=dictionary&o=applications&AppID={$smarty.get.AppID}&VersionID={$key}' +
                                                        '&VersionName=' + escape(document.getElementById('VersionName_{$key}').value) +
                                                        '&VersionLivrare=' + escape(document.getElementById('VersionLivrare_{$key}').value) +
                                                        '&VersionDescription=' + escape(document.getElementById('VersionDescription_{$key}').value) +
                                                        '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0);
                                                        return false;" title="{translate label='Modifica versiune aplicatie'}">
                                                    <b>Mod</b>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div id="button_del">
                                                <a href="#"
                                                   onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=applications&AppID={$smarty.get.AppID}&VersionID={$key}&delVersion=1'; return false;"
                                                   title="{translate label='Sterge versiunea aplicatiei'}">
                                                    <b>Del</b>
                                                </a>
                                            </div>
                                        </td>
                                    {/if}
                                </tr>
                            {/foreach}

                            {if $rw == 1}
                                <tr>
                                    <td><input type="text" id="VersionName_0" name="VersionName_0" value="" style="width:100px;" maxlength="255"></td>

                                    <td>
                                        <input type="text" id="VersionLivrare_0" class="formstyle" value="" size="10" maxlength="10"/>
                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                            var cal1_0 = new CalendarPopup();
                                            cal1_0.isShowNavigationDropdowns = true;
                                            cal1_0.setYearSelectStartOffset(10);
                                            //writeSource("js1_0");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal1_0.select(document.getElementById('VersionLivrare_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                           ID="anchor1_0"><img src="./images/cal.png" border="0"></A>
                                    </td>

                                    <td>
                                        <input type="hidden" id="VersionDescription_0" value=""/>
                                        <span id="VersionDescription_0_display"></span>
                                        [<a href="#" title="" onclick="getNotes('VersionDescription_0'); return false;">{translate label='Editare'}</a>]
                                    </td>

                                    <td>&nbsp;</td>

                                    <td colspan="2">
                                        <div id="button_add">
                                            <a href="#" onclick="window.location.href = './?m=dictionary&o=applications&AppID={$smarty.get.AppID}&VersionID=0' +
                                                    '&VersionName=' + escape(document.getElementById('VersionName_0').value) +
                                                    '&VersionLivrare=' + escape(document.getElementById('VersionLivrare_0').value) +
                                                    '&VersionDescription=' + escape(document.getElementById('VersionDescription_0').value);
                                                    return false;" title="{translate label='Adauga versiune aplicatie'}">
                                                <b>Add</b>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            {/if}
                        </table>
                    </fieldset>
                {/if}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='aplicatii flosite in firma'}</span></td>
    </tr>
</table>

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