{include file="persons_menu.tpl"}
<div id="layer_co" class="layer" style="display: none;">
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
<div id="layer_co_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
</div>
<table border="0" cellpadding="4" cellspacing="0" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
    </tr>
</table>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    {if !empty($smarty.post) && $err->getErrors() == ""}
        <tr height="30">
            <td colspan="3" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
        </tr>
    {/if}
    {if $err->getErrors()}
        <tr>
            <td colspan="3" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding: 10px;" width="30%">
            <fieldset>
                <legend>{translate label='Fisa de aptitudini'}</legend>
                {foreach from=$medical.1 key=key item=item name=iter}
                    {if $medical.1|@count > 1 && $smarty.foreach.iter.first}
{*                        <p><a href="#"*}
{*                              onclick="var status = document.getElementById('div_1').style.display; if (status == 'none') Effect.SlideDown('div_1'); else Effect.SlideUp('div_1'); return false;"><b>{translate label='Istoric asigurare medicala'}</b></a>*}
{*                        </p>*}
                    {/if}
                    {if $medical.1|@count > 1 && $smarty.foreach.iter.iteration == 2}
{*                        <div id="div_1" style="display:none;">*}
                        <div id="div_1">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&MedicalID={$key}" method="post" name="f1_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}
                            <tr>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                        var cal1_{$key} = new CalendarPopup();
                                        cal1_{$key}.isShowNavigationDropdowns = true;
                                        cal1_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js1_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal1_{$key}.select(document.f1_{$key}.RegDate,'anchor1_{$key}','dd.MM.yyyy'); return false;" NAME="anchor1_{$key}"
                                       ID="anchor1_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js12_{$key}">
                                        var cal12_{$key} = new CalendarPopup();
                                        cal12_{$key}.isShowNavigationDropdowns = true;
                                        cal12_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js12_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal12_{$key}.select(document.f1_{$key}.EndDate,'anchor12_{$key}','dd.MM.yyyy'); return false;" NAME="anchor12_{$key}"
                                       ID="anchor12_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110px">
                                    <input name="Notes" type="hidden" id="Notes1_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes1_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}"
                                        onclick="getNotes('Notes1_{$key}','Comentarii'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="1">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $medical.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f1_{$key}.RegDate.value, 'Data')&&checkDate(document.f1_{$key}.EndDate.value, 'Data')) document.f1_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica adeverinta'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $medical.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&MedicalID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge adeverinta'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $medical.0.rw == 1}
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (checkDate(document.f1_{$key}.RegDate.value, 'Data')&&checkDate(document.f1_{$key}.EndDate.value, 'Data')) document.f1_{$key}.submit(); return false;"
                                                                    title="{translate label='Adauga adeverinta'}"><b>Add</b></a></div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $medical.1|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
            <p style="padding: 10px"><input type="button" value="{translate label='Anuleaza'}" onclick="window.location='./?m=persons'" class="formstyle"></p>
        </td>
        <td class="celulaMenuST" style="vertical-align: top; padding: 10px;" width="30%">
            <fieldset>
                <legend>SSM</legend>
                {foreach from=$medical.2 key=key item=item name=iter}
                    {if $medical.2|@count > 1 && $smarty.foreach.iter.first}
{*                        <p><a href="#"*}
{*                              onclick="var status = document.getElementById('div_2').style.display; if (status == 'none') Effect.SlideDown('div_2'); else Effect.SlideUp('div_2'); return false;"><b>Istoric*}
{*                                    analize medicale</b></a></p>*}
                    {/if}
                    {if $medical.2|@count > 1 && $smarty.foreach.iter.iteration == 2}
{*                        <div id="div_2" style="display:none;">*}
                        <div id="div_2">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&MedicalID={$key}" method="post" name="f2_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}

                            <tr>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                        var cal2_{$key} = new CalendarPopup();
                                        cal2_{$key}.isShowNavigationDropdowns = true;
                                        cal2_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js2_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal2_{$key}.select(document.f2_{$key}.RegDate,'anchor2_{$key}','dd.MM.yyyy'); return false;" NAME="anchor2_{$key}"
                                       ID="anchor2_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js22_{$key}">
                                        var cal22_{$key} = new CalendarPopup();
                                        cal22_{$key}.isShowNavigationDropdowns = true;
                                        cal22_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js22_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal22_{$key}.select(document.f2_{$key}.EndDate,'anchor22_{$key}','dd.MM.yyyy'); return false;" NAME="anchor22_{$key}"
                                       ID="anchor22_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110px">
                                    <input name="Notes" type="hidden" id="Notes2_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes2_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}"
                                        onclick="getNotes('Notes2_{$key}','Comentarii'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="2">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $medical.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f2_{$key}.RegDate.value, 'Data')) document.f2_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica analiza'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $medical.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&MedicalID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge analiza'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $medical.0.rw == 1}
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (checkDate(document.f2_{$key}.RegDate.value, 'Data')) document.f2_{$key}.submit(); return false;"
                                                                    title="{translate label='Adauga analiza'}"><b>Add</b></a></div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $medical.2|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
        </td>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;" width="30%">
            <fieldset>
                <legend>{translate label='PSI'}</legend>
                {foreach from=$medical.3 key=key item=item name=iter}
                    {if $medical.3|@count > 1 && $smarty.foreach.iter.first}
{*                        <p><a href="#"*}
{*                              onclick="var status = document.getElementById('div_3').style.display; if (status == 'none') Effect.SlideDown('div_3'); else Effect.SlideUp('div_3'); return false;"><b>{translate label='Istoric protectia muncii'}</b></a>*}
{*                        </p>*}
                    {/if}
                    {if $medical.3|@count > 1 && $smarty.foreach.iter.iteration == 2}
{*                        <div id="div_3" style="display:none;">*}
                        <div id="div_3">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&MedicalID={$key}" method="post" name="f3_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="110">{translate label='Traseu'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}

                            <tr>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js3_{$key}">
                                        var cal3_{$key} = new CalendarPopup();
                                        cal3_{$key}.isShowNavigationDropdowns = true;
                                        cal3_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js3_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal3_{$key}.select(document.f3_{$key}.RegDate,'anchor3_{$key}','dd.MM.yyyy'); return false;" NAME="anchor3_{$key}"
                                       ID="anchor3_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js32_{$key}">
                                        var cal32_{$key} = new CalendarPopup();
                                        cal32_{$key}.isShowNavigationDropdowns = true;
                                        cal32_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js32_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal32_{$key}.select(document.f3_{$key}.EndDate,'anchor32_{$key}','dd.MM.yyyy'); return false;" NAME="anchor32_{$key}"
                                       ID="anchor32_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110px">
                                    <input name="Notes" type="hidden" id="Notes3_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes3_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}"
                                        onclick="getNotes('Notes3_{$key}','Traseu de deplasare de/la serviciu'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="3">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $medical.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f3_{$key}.RegDate.value, 'Data')&&checkDate(document.f3_{$key}.EndDate.value, 'Data')) document.f3_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $medical.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&MedicalID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $medical.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f3_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $medical.3|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="3" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>

{literal}
    <script type="text/javascript">

        function getNotes(id, title) {
            document.getElementById('layer_co_notes').value = document.getElementById(id).value;
            document.getElementById('layer_co_notes_dest').value = id;
            document.getElementById('layer_co').style.display = 'block';
            document.getElementById('layer_co_x').style.display = 'block';
            document.getElementById('layer_title').innerHTML = title;
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