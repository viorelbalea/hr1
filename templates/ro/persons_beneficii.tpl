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

<table border="0" cellpadding="4" cellspacing="0" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
    </tr>
</table>
<br/>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    {if !empty($smarty.post) && $err->getErrors() == ""}
        <tr height="30">
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
        </tr>
    {/if}
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
            <fieldset>
                <legend>{translate label='Asigurari de sanatate'}</legend>
                {foreach from=$ben.1 key=key item=item name=iter}
                    {if $ben.1|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_1').style.display; if (status == 'none') Effect.SlideDown('div_1'); else Effect.SlideUp('div_1'); return false;"><b>{translate label='Istoric asigurari de sanatate '}</b></a>
                        </p>
                    {/if}
                    {if $ben.1|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_1" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f1_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}</td>
                                    <td width="100">{translate label='Moneda'}</td>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="250">{translate label='Firma asiguratoare'}</td>
                                    <td width="110">{translate label='Retinere salariu'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}
                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
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
                                <td width="250px;">
                                    <select name="CompanyID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110px;" align="center">
                                    <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                </td>
                                <td width="110px">
                                    <input name="Notes" type="hidden" id="Notes1_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes1_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes1_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="1">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f1_{$key}.RegDate.value, 'Data')) document.f1_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (checkDate(document.f1_{$key}.RegDate.value, 'Data')) document.f1_{$key}.submit(); return false;"
                                                                    title="{translate label='Adauga'}"><b>Add</b></a></div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.1|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
            <br/>
            <fieldset>
                <legend>{translate label='Asigurari de viata'}</legend>
                {foreach from=$ben.2 key=key item=item name=iter}
                    {if $ben.2|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_2').style.display; if (status == 'none') Effect.SlideDown('div_2'); else Effect.SlideUp('div_2'); return false;"><b>{translate label='Istoric asigurari de viata'}</b></a>
                        </p>
                    {/if}
                    {if $ben.2|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_2" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f2_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}</td>
                                    <td width="100">{translate label='Moneda'}</td>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="250">{translate label='Firma asiguratoare'}</td>
                                    <td width="110">{translate label='Retinere salariu'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
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
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes2_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes2_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes2_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="2">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f2_{$key}.RegDate.value, 'Data')) document.f2_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f2_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.2|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
            <br/>
            <fieldset>
                <legend>{translate label='Pensie privata'}</legend>
                {foreach from=$ben.3 key=key item=item name=iter}
                    {if $ben.3|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_3').style.display; if (status == 'none') Effect.SlideDown('div_3'); else Effect.SlideUp('div_3'); return false;"><b>{translate label='Istoric pensie privata'}</b></a>
                        </p>
                    {/if}
                    {if $ben.3|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_3" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f3_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}</td>
                                    <td width="100">{translate label='Moneda'}</td>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="250">{translate label='Firma asiguratoare'}</td>
                                    <td width="110">{translate label='Retinere salariu'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
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
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes3_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes3_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes3_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="3">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f3_{$key}.RegDate.value, 'Data')) document.f3_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f3_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.3|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
            <br/>
            <fieldset>
                <legend>{translate label='Bonuri de masa'}</legend>
                {foreach from=$ben.4 key=key item=item name=iter}
                    {if $ben.4|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_4').style.display; if (status == 'none') Effect.SlideDown('div_4'); else Effect.SlideUp('div_4'); return false;"><b>{translate label='Istoric bonuri de masa'}</b></a>
                        </p>
                    {/if}
                    {if $ben.4|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_4" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f4_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}</td>
                                    <td width="100">{translate label='Moneda'}</td>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="250">{translate label='Firma asiguratoare'}</td>
                                    <td width="110">{translate label='Retinere salariu'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js4_{$key}">
                                        var cal4_{$key} = new CalendarPopup();
                                        cal4_{$key}.isShowNavigationDropdowns = true;
                                        cal4_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js4_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal4_{$key}.select(document.f4_{$key}.RegDate,'anchor4_{$key}','dd.MM.yyyy'); return false;" NAME="anchor4_{$key}"
                                       ID="anchor4_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js42_{$key}">
                                        var cal42_{$key} = new CalendarPopup();
                                        cal42_{$key}.isShowNavigationDropdowns = true;
                                        cal42_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js42_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal42_{$key}.select(document.f4_{$key}.EndDate,'anchor42_{$key}','dd.MM.yyyy'); return false;" NAME="anchor42_{$key}"
                                       ID="anchor42_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes4_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes4_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes4_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="4">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f4_{$key}.RegDate.value, 'Data')) document.f4_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f4_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.4|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
            <br/>
            <fieldset>
                <legend>{translate label='Asigurare stomatologica'}</legend>
                {foreach from=$ben.5 key=key item=item name=iter}
                    {if $ben.5|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_5').style.display; if (status == 'none') Effect.SlideDown('div_5'); else Effect.SlideUp('div_5'); return false;"><b>{translate label='Istoric asigurare stomatologica'}</b></a>
                        </p>
                    {/if}
                    {if $ben.5|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_5" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f5_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}</td>
                                    <td width="100">{translate label='Moneda'}</td>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="250">{translate label='Firma asiguratoare'}</td>
                                    <td width="110">{translate label='Retinere salariu'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js5_{$key}">
                                        var cal5_{$key} = new CalendarPopup();
                                        cal5_{$key}.isShowNavigationDropdowns = true;
                                        cal5_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js5_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal5_{$key}.select(document.f5_{$key}.RegDate,'anchor5_{$key}','dd.MM.yyyy'); return false;" NAME="anchor5_{$key}"
                                       ID="anchor5_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js52_{$key}">
                                        var cal52_{$key} = new CalendarPopup();
                                        cal52_{$key}.isShowNavigationDropdowns = true;
                                        cal52_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js52_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal52_{$key}.select(document.f5_{$key}.EndDate,'anchor52_{$key}','dd.MM.yyyy'); return false;" NAME="anchor52_{$key}"
                                       ID="anchor52_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">alege...</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes5_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes5_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes5_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="5">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f5_{$key}.RegDate.value, 'Data')) document.f5_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f5_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.5|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
            <br/>
            <fieldset>
                <legend>{translate label='Tichete cadou'}</legend>
                {foreach from=$ben.6 key=key item=item name=iter}
                    {if $ben.6|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_6').style.display; if (status == 'none') Effect.SlideDown('div_6'); else Effect.SlideUp('div_6'); return false;"><b>Istoric
                                    tichete cadou</b></a></p>
                    {/if}
                    {if $ben.6|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_6" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f6_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js6_{$key}">
                                        var cal6_{$key} = new CalendarPopup();
                                        cal6_{$key}.isShowNavigationDropdowns = true;
                                        cal6_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js6_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal6_{$key}.select(document.f6_{$key}.RegDate,'anchor6_{$key}','dd.MM.yyyy'); return false;" NAME="anchor6_{$key}"
                                       ID="anchor6_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js62_{$key}">
                                        var cal62_{$key} = new CalendarPopup();
                                        cal62_{$key}.isShowNavigationDropdowns = true;
                                        cal62_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js62_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal62_{$key}.select(document.f6_{$key}.EndDate,'anchor62_{$key}','dd.MM.yyyy'); return false;" NAME="anchor62_{$key}"
                                       ID="anchor62_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">alege...</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes6_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes6_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes6_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="6">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f6_{$key}.RegDate.value, 'Data')) document.f6_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f6_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.6|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
            <br/>
            <fieldset>
                <legend>{translate label='Outplacement'}</legend>
                {foreach from=$ben.7 key=key item=item name=iter}
                    {if $ben.7|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_7').style.display; if (status == 'none') Effect.SlideDown('div_7'); else Effect.SlideUp('div_7'); return false;"><b>{translate label='Istoric outplacement'}</b></a>
                        </p>
                    {/if}
                    {if $ben.7|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_7" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f7_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}</td>
                                    <td width="100">{translate label='Moneda'}</td>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="250">{translate label='Firma asiguratoare'}</td>
                                    <td width="110">{translate label='Retinere salariu'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js7_{$key}">
                                        var cal7_{$key} = new CalendarPopup();
                                        cal7_{$key}.isShowNavigationDropdowns = true;
                                        cal7_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js7_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal7_{$key}.select(document.f7_{$key}.RegDate,'anchor7_{$key}','dd.MM.yyyy'); return false;" NAME="anchor7_{$key}"
                                       ID="anchor7_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js72_{$key}">
                                        var cal72_{$key} = new CalendarPopup();
                                        cal72_{$key}.isShowNavigationDropdowns = true;
                                        cal72_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js72_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal72_{$key}.select(document.f7_{$key}.EndDate,'anchor72_{$key}','dd.MM.yyyy'); return false;" NAME="anchor72_{$key}"
                                       ID="anchor72_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes7_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes7_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes7_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="7">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f7_{$key}.RegDate.value, 'Data')) document.f7_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f7_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.7|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
            <br/>
            <fieldset>
                <legend>{translate label='Traininguri'}</legend>
                {if $ben.8|@count >0}
                    <p><a href="#"
                          onclick="var status = document.getElementById('div_8').style.display; if (status == 'none') Effect.SlideDown('div_8'); else Effect.SlideUp('div_8'); return false;"><b>{translate label='Istoric Traininguri'}</b></a>
                    </p>
                {/if}
                <div id="div_8" style="display:none;">
                    {foreach from=$ben.8 key=key item=item name=iter}
                        <form action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f8_{$key}">
                            <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                                <tr>
                                    <td width="120">{translate label='Cost per training'}: <br/>
                                        <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10" readonly="true"
                                               style="background-color:#CCCCCC;">
                                    </td>
                                    <td width="100">{translate label='Moneda'}: <br/>
                                        <select id="Currency_{$item.SalaryID}" name="Currency">
                                            {foreach from=$currencies item=curr}
                                                <option value="{$curr}"
                                                        {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td width="110">{translate label='Data inceput'}: <br/>
                                        <input type="text" name="RegDate" class="formstyle"
                                               value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                               maxlength="10" readonly="true" style="background-color:#CCCCCC;">
                                        {*
                                        <SCRIPT LANGUAGE="JavaScript" ID="js8_{$key}">
                                            var cal8_{$key} = new CalendarPopup();
                                            cal8_{$key}.isShowNavigationDropdowns = true;
                                            cal8_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js8_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal8_{$key}.select(document.f8_{$key}.RegDate,'anchor8_{$key}','dd.MM.yyyy'); return false;" NAME="anchor8_{$key}" ID="anchor8_{$key}"><img border="0" src="./images/cal.png"></A>
                                        *}
                                    </td>
                                    <td width="110">{translate label='Data sfarsit'}:<br/>
                                        <input type="text" name="EndDate" class="formstyle"
                                               value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                               maxlength="10" readonly="true" style="background-color:#CCCCCC;">
                                        {*
                                        <SCRIPT LANGUAGE="JavaScript" ID="js82_{$key}">
                                            var cal82_{$key} = new CalendarPopup();
                                            cal82_{$key}.isShowNavigationDropdowns = true;
                                            cal82_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js82_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal82_{$key}.select(document.f8_{$key}.EndDate,'anchor82_{$key}','dd.MM.yyyy'); return false;" NAME="anchor82_{$key}" ID="anchor82_{$key}"><img border="0" src="./images/cal.png"></A>
                                        *}
                                    </td>
                                    <td> {translate label='Firma training'}: <br/>
                                        <select name="CompanyID" style="background-color:#CCCCCC; width:150px;">
                                            {foreach from=$companies_training[$item.CompanyID] key=key2 item=item2}
                                                <option value="{$item.CompanyID}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td align="center">{translate label='Retinere salariu'}: <br/>
                                        <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                    </td>
                                    <td colspan="3"
                                        {if $smarty.foreach.iter.iteration < $smarty.foreach.iter.total}style="padding-bottom: 6px; border-bottom: 1px solid #cccccc;"{/if}>
                                        <textarea name="Notes" rows="2" cols="40" wrap="soft" style="width: 100%;background-color:#CCCCCC;" readonly="true">{$item.Notes}</textarea>
                                        <input type="hidden" name="Type" value="8">
                                    </td>
                                    {if $key > 0}
                                        <td width="20">{if $ben.0.rw == 1}
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (checkDate(document.f8_{$key}.RegDate.value, 'Data')) document.f8_{$key}.submit(); return false;"
                                                                        title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    {else}
                                        <td width="20">&nbsp;</td>
                                    {/if}
                                </tr>
                            </table>
                        </form>
                    {/foreach}
                </div>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;">
            <fieldset>
                <legend>{translate label='Catering'}</legend>
                {foreach from=$ben.9 key=key item=item name=iter}
                    {if $ben.9|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_9').style.display; if (status == 'none') Effect.SlideDown('div_9'); else Effect.SlideUp('div_9'); return false;"><b>{translate label='Istoric catering'}</b></a>
                        </p>
                    {/if}
                    {if $ben.9|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_9" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f9_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}</td>
                                    <td width="100">{translate label='Moneda'}</td>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="250">{translate label='Firma asiguratoare'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}
                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js7_{$key}">
                                        var cal9_{$key} = new CalendarPopup();
                                        cal9_{$key}.isShowNavigationDropdowns = true;
                                        cal9_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js9_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal9_{$key}.select(document.f9_{$key}.RegDate,'anchor9_{$key}','dd.MM.yyyy'); return false;" NAME="anchor9_{$key}"
                                       ID="anchor9_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js92_{$key}">
                                        var cal92_{$key} = new CalendarPopup();
                                        cal92_{$key}.isShowNavigationDropdowns = true;
                                        cal92_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js92_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal92_{$key}.select(document.f9_{$key}.EndDate,'anchor92_{$key}','dd.MM.yyyy'); return false;" NAME="anchor92_{$key}"
                                       ID="anchor92_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes9_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes9_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes9_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="9">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f9_{$key}.RegDate.value, 'Data')) document.f9_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f9_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.9|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total - 1}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;">
            <fieldset>
                <legend>{translate label='Sportiv'}</legend>
                {foreach from=$ben.15 key=key item=item name=iter}
                    {if $ben.15|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_15').style.display; if (status == 'none') Effect.SlideDown('div_15'); else Effect.SlideUp('div_15'); return false;"><b>{translate label='Istoric sportiv'}</b></a>
                        </p>
                        <div id="div_15" style="display:none;">
                    {/if}
                    <form action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f15_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                            <tr>
                                <td style="padding-top: 10px;" width="120">{translate label='Cost lunar contract'}: <br/>
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td style="padding-top: 10px;" width="100">{translate label='Moneda'}: <br/>
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td style="padding-top: 10px;" width="110">{translate label='Data inceput'}: <br/>
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js15_{$key}">
                                        var cal15_{$key} = new CalendarPopup();
                                        cal15_{$key}.isShowNavigationDropdowns = true;
                                        cal15_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js15_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal15_{$key}.select(document.f15_{$key}.RegDate,'anchor15_{$key}','dd.MM.yyyy'); return false;" NAME="anchor15_{$key}"
                                       ID="anchor15_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td style="padding-top: 10px;" width="110">{translate label='Data sfarsit'}:<br/>
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js152_{$key}">
                                        var cal152_{$key} = new CalendarPopup();
                                        cal152_{$key}.isShowNavigationDropdowns = true;
                                        cal152_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js152_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal152_{$key}.select(document.f15_{$key}.EndDate,'anchor152_{$key}','dd.MM.yyyy'); return false;" NAME="anchor152_{$key}"
                                       ID="anchor152_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td style="padding-top: 10px;">{translate label='Firma'}: <br/>
                                    <select name="CompanyID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td colspan="3" {if $smarty.foreach.iter.iteration < $smarty.foreach.iter.total}style="padding-bottom: 6px; border-bottom: 1px solid #cccccc;"{/if}>
                                    <textarea name="Notes" rows="2" cols="40" wrap="soft" style="width: 100%">{$item.Notes}</textarea>
                                    <input type="hidden" name="Type" value="15">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f15_{$key}.RegDate.value, 'Data')) document.f15_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f15_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.15|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total - 1}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;">
            <fieldset>
                <legend>{translate label='Masina serviciu'}</legend>
                {if $ben.10|@count >0}
                    <p><a href="#"
                          onclick="var status = document.getElementById('div_10').style.display; if (status == 'none') Effect.SlideDown('div_10'); else Effect.SlideUp('div_10'); return false;"><b>{translate label='Istoric beneficii Masina serviciu'}</b></a>
                    </p>
                {/if}
                <div id="div_10" style="display:none;">
                    {foreach from=$ben.10 key=key item=item name=iter}
                        <form action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f10_{$key}">
                            <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}: <br/>
                                        <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10" readonly="true"
                                               style="background-color:#CCCCCC;">
                                    </td>
                                    <td width="100">{translate label='Moneda'}: <br/>
                                        <select id="Currency_{$item.SalaryID}" name="Currency">
                                            {foreach from=$currencies item=curr}
                                                <option value="{$curr}"
                                                        {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td width="110">{translate label='Data inceput'}: <br/>
                                        <input type="text" name="RegDate" class="formstyle"
                                               value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                               maxlength="10" readonly="true" style="background-color:#CCCCCC;">
                                        {*
                                        <SCRIPT LANGUAGE="JavaScript" ID="js10_{$key}">
                                            var cal10_{$key} = new CalendarPopup();
                                            cal10_{$key}.isShowNavigationDropdowns = true;
                                            cal10_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js10_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal10_{$key}.select(document.f10_{$key}.RegDate,'anchor10_{$key}','dd.MM.yyyy'); return false;" NAME="anchor8_{$key}" ID="anchor10_{$key}"><img border="0" src="./images/cal.png"></A>
                                        *}
                                    </td>
                                    <td width="110">{translate label='Data sfarsit'}:<br/>
                                        <input type="text" name="EndDate" class="formstyle"
                                               value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                               maxlength="10" readonly="true" style="background-color:#CCCCCC;">
                                        {*
                                        <SCRIPT LANGUAGE="JavaScript" ID="js102_{$key}">
                                            var cal102_{$key} = new CalendarPopup();
                                            cal102_{$key}.isShowNavigationDropdowns = true;
                                            cal102_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js102_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal102_{$key}.select(document.f10_{$key}.EndDate,'anchor102_{$key}','dd.MM.yyyy'); return false;" NAME="anchor102_{$key}" ID="anchor102_{$key}"><img border="0" src="./images/cal.png"></A>
                                        *}
                                    </td>
                                    <td> {translate label='Firma asiguratoare'}: <br/>
                                        <select name="CompanyID" style="background-color:#CCCCCC; width:150px;">
                                            {foreach from=$companies_training[$item.CompanyID] key=key2 item=item2}
                                                <option value="{$item.CompanyID}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td colspan="3"
                                        {if $smarty.foreach.iter.iteration < $smarty.foreach.iter.total}style="padding-bottom: 6px; border-bottom: 1px solid #cccccc;"{/if}>
                                        <textarea name="Notes" rows="2" cols="40" wrap="soft" style="width: 100%;background-color:#CCCCCC;" readonly="true">{$item.Notes}</textarea>
                                        <input type="hidden" name="Type" value="10">
                                    </td>
                                    {if $key > 0}
                                        <td width="20">{if $ben.0.rw == 1}
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (checkDate(document.f10_{$key}.RegDate.value, 'Data')) document.f10_{$key}.submit(); return false;"
                                                                        title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    {else}
                                        <td width="20">&nbsp;</td>
                                    {/if}
                                </tr>
                            </table>
                        </form>
                    {/foreach}
                </div>
            </fieldset>

            <br/>
            <fieldset>
                <legend>{translate label='Sportiv'}</legend>
                {foreach from=$ben.11 key=key item=item name=iter}
                    {if $ben.11|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_11').style.display; if (status == 'none') Effect.SlideDown('div_11'); else Effect.SlideUp('div_11'); return false;"><b>{translate label='Istoric sportiv'}</b></a>
                        </p>
                    {/if}
                    {if $ben.11|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_11" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f11_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}</td>
                                    <td width="100">{translate label='Moneda'}</td>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="250">{translate label='Firma asiguratoare'}</td>
                                    <td width="110">{translate label='Retinere salariu'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js11_{$key}">
                                        var cal11_{$key} = new CalendarPopup();
                                        cal11_{$key}.isShowNavigationDropdowns = true;
                                        cal11_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js11_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal11_{$key}.select(document.f11_{$key}.RegDate,'anchor11_{$key}','dd.MM.yyyy'); return false;" NAME="anchor11_{$key}"
                                       ID="anchor11_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js112_{$key}">
                                        var cal112_{$key} = new CalendarPopup();
                                        cal112_{$key}.isShowNavigationDropdowns = true;
                                        cal112_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js112_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal112_{$key}.select(document.f11_{$key}.EndDate,'anchor112_{$key}','dd.MM.yyyy'); return false;" NAME="anchor112_{$key}"
                                       ID="anchor112_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes11_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes11_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes11_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="11">
                                </td>
                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f11_{$key}.RegDate.value, 'Data')) document.f11_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f11_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.11|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
            <br/>
            <!-- Pensii facultative -->
            <fieldset>
                <legend>{translate label='Pensii facultative'}</legend>
                {foreach from=$ben.12 key=key item=item name=iter}
                    {if $ben.12|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_12').style.display; if (status == 'none') Effect.SlideDown('div_12'); else Effect.SlideUp('div_12'); return false;"><b>{translate label='Istoric pensii facultative'}</b></a>
                        </p>
                    {/if}
                    {if $ben.12|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_12" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f12_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}</td>
                                    <td width="100">{translate label='Moneda'}</td>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="250">{translate label='Firma asiguratoare'}</td>
                                    <td width="110">{translate label='Retinere salariu'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js12_{$key}">
                                        var cal12_{$key} = new CalendarPopup();
                                        cal12_{$key}.isShowNavigationDropdowns = true;
                                        cal12_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js12_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal12_{$key}.select(document.f12_{$key}.RegDate,'anchor12_{$key}','dd.MM.yyyy'); return false;" NAME="anchor12_{$key}"
                                       ID="anchor12_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js122_{$key}">
                                        var cal122_{$key} = new CalendarPopup();
                                        cal122_{$key}.isShowNavigationDropdowns = true;
                                        cal122_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js122_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal122_{$key}.select(document.f12_{$key}.EndDate,'anchor122_{$key}','dd.MM.yyyy'); return false;" NAME="anchor122_{$key}"
                                       ID="anchor122_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes12_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes12_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes12_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="12">
                                </td>

                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f12_{$key}.RegDate.value, 'Data')) document.f12_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f12_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.12|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>

            <!-- Avantaj natura -->
            <fieldset>
                <legend>{translate label='Avantaj natura'}</legend>
                {foreach from=$ben.13 key=key item=item name=iter}
                    {if $ben.13|@count > 1 && $smarty.foreach.iter.first}
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_13').style.display; if (status == 'none') Effect.SlideDown('div_13'); else Effect.SlideUp('div_13'); return false;"><b>{translate label='Istoric avantaj natura'}</b></a>
                        </p>
                    {/if}
                    {if $ben.13|@count > 1 && $smarty.foreach.iter.iteration == 2}
                        <div id="div_13" style="display:none;">
                    {/if}
                    <form style="margin-bottom:0px;" action="{$smarty.server.REQUEST_URI}&BenID={$key}" method="post" name="f13_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {if $smarty.foreach.iter.first}
                                <tr>
                                    <td width="120">{translate label='Cost lunar contract'}</td>
                                    <td width="100">{translate label='Moneda'}</td>
                                    <td width="110">{translate label='Data inceput'}</td>
                                    <td width="110">{translate label='Data sfarsit'}</td>
                                    <td width="250">{translate label='Firma asiguratoare'}</td>
                                    <td width="110">{translate label='Retinere salariu'}</td>
                                    <td width="110">{translate label='Comentarii'}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            {/if}

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="{$item.TotalCost}" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_{$item.SalaryID}" name="Currency">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}"
                                                    {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="{if !empty($item.RegDate) && $item.RegDate != '00-00-0000'}{$item.RegDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js13_{$key}">
                                        var cal13_{$key} = new CalendarPopup();
                                        cal13_{$key}.isShowNavigationDropdowns = true;
                                        cal13_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js13_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal13_{$key}.select(document.f13_{$key}.RegDate,'anchor13_{$key}','dd.MM.yyyy'); return false;" NAME="anchor13_{$key}"
                                       ID="anchor13_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="{if !empty($item.EndDate) && $item.EndDate != '00-00-0000'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js132_{$key}">
                                        var cal132_{$key} = new CalendarPopup();
                                        cal132_{$key}.isShowNavigationDropdowns = true;
                                        cal132_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js132_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal132_{$key}.select(document.f13_{$key}.EndDate,'anchor132_{$key}','dd.MM.yyyy'); return false;" NAME="anchor132_{$key}"
                                       ID="anchor132_{$key}"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$companies key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CompanyID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" {if $item.Retained==1} checked="checked"{/if}/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes13_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes13_{$key}_display"></span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes13_{$key}'); return false;">{translate label='Editare'}</a>]
                                    <input type="hidden" name="Type" value="13">
                                </td>

                                {if $key > 0}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f13_{$key}.RegDate.value, 'Data')) document.f13_{$key}.submit(); return false;"
                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&BenID={$key}&del=1'; return false;"
                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                {else}
                                    <td width="20">{if $ben.0.rw == 1}
                                            <div id="button_add"><a href="#" onclick="document.f13_{$key}.submit(); return false;" title="{translate label='Adauga'}"><b>Add</b></a>
                                            </div>{/if}</td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                    {if $ben.13|@count > 1 && $smarty.foreach.iter.iteration == $smarty.foreach.iter.total}
                        </div>
                    {/if}
                {/foreach}
            </fieldset>
            <p style="padding: 10px"><input type="button" value="{translate label='Anuleaza'}" onclick="window.location='./?m=persons'" class="formstyle"></p>
        </td>
    </tr>
    <tr>
        <td colspan="3" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
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
