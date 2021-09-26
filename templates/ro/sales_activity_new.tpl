{include file="sales_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="event" onsubmit="return validateForm(this);" enctype="multipart/form-data">
    <table border="0" cellpadding="4" cellspacing="0" width="100%" class="screen">
        {if !empty($smarty.get.ActivityID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="sales_submenu_1.tpl"}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adauga activitate'}</span></td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {elseif !empty($smarty.post)}
            {*
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Activitatea a fost salvata!'}</td>
            </tr>
            *}
        {/if}

        {if !empty($activities)}
            <tr>
            <tr valign="top">
                <td class="celulaMenuSTDR" colspan="2" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px; border-bottom:none;">
                    <br>
                    <fieldset>
                        <legend>{translate label='Istoric activitati'}</legend>

                        <p style="padding-left: 4px;"><a href="#"
                                                         onclick="var status = document.getElementById('div_activities').style.display; if (status == 'none') Effect.SlideDown('div_activities'); else Effect.SlideUp('div_activities'); return false;"><b>{translate label='Istoric activitati'}</b></a>
                        </p>
                        <div id="div_activities" style="display:none;  background:#ccc; text-align:center;">
                            <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                                <tr>
                                    <td class="bkdTitleMenu"><b>{translate label='Responsabil'}</b></td>
                                    <td class="bkdTitleMenu"><b>{translate label='Persoana contact'}</b></td>
                                    <td class="bkdTitleMenu"><b>{translate label='Subiect'}</b></td>
                                    <td class="bkdTitleMenu"><b>{translate label='Status'}</b></td>
                                    <td class="bkdTitleMenu"><b>{translate label='Rezolutie'}</b></td>
                                    <td class="bkdTitleMenu"><b>{translate label='Apelat'}</b></td>
                                    <td class="bkdTitleMenu"><b>{translate label='De apelat'}</b></td>
                                    <td class="bkdTitleMenu"><b>{translate label='Necesar'}</b></td>
                                    <td class="bkdTitleMenu"><b>{translate label='Data creare'}</b></td>
                                    <td class="bkdTitleMenu"><b>{translate label='Editare'}</b></td>
                                    <td class="bkdTitleMenu"><b>{translate label='Sterge'}</b></td>
                                </tr>
                                {foreach from=$activities key=key item=item name=iter}
                                    <tr>
                                        <td class="celulaMenuST">{$item.FullName|default:'-'}</td>
                                        <td class="celulaMenuST">{$item.ContactName|default:''}<br/>{$item.ContactPhone}<br/>{$item.ContactEmail}<br/>{$item.ContactFunction}<br/>
                                        </td>
                                        <td class="celulaMenuST">{$activitySubject[$item.Subject]|default:'-'}</td>
                                        <td class="celulaMenuST">{$activityStatus[$item.Status]|default:'-'}</td>
                                        <td class="celulaMenuST">{$item.Comment|default:'-'}</td>
                                        <td class="celulaMenuST">{$item.Date|default:'-'}</td>
                                        <td class="celulaMenuST">{$item.NextDate|default:'-'}</td>
                                        <td class="celulaMenuST">{$item.Comment2|default:'-'}</td>
                                        <td class="celulaMenuST">{$item.CreateDate}</td>
                                        <td class="celulaMenuST">
                                            <div id="button_mod"><a
                                                        href="./?m=sales&o=edit_activity&ActivityDetID={$key}&ActivityID={$item.ActivityID}&CompanyID={$item.CompanyID}&ContactID={$item.ContactID}"
                                                        title="{translate label='Modifica activitate'}"><b>Mod</b></a>
                                        </td>
                                        <td class="celulaMenuSTDR">
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti acest eveniment?'}')) window.location.href='./?m=sales&o=del_activity_det&ActivityDetID={$key}'; return false;"
                                                                    title="{translate label='Sterge activitate'}"><b>Del</b></a></div>
                                        </td>
                                    </tr>
                                {/foreach}
                            </table>
                        </div>
                    </fieldset>
                </td>
            </tr>
        {/if}
        <tr>
        <tr valign="top">
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Detalii activitate'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr height="35">
                            <td>{translate label='Companie'}:*</td>
                            <td><select name="CompanyID" id="CompanyID" onchange="window.location='{$request_uri}&CompanyID='+document.getElementById('CompanyID').value;">
                                    <option value="-1">{translate label='- Selecteaza firma -'} </option>
                                    {foreach from=$companies key=key item=item}
                                        <option value="{$item.CompanyID}"
                                                {if $smarty.get.CompanyID!=''}
                                            {if $item.CompanyID==$smarty.get.CompanyID}
                                                selected="selected"
                                            {/if}
                                                {else}
                                            {if $item.CompanyID==$info.CompanyID}
                                                selected="selected"
                                            {/if}
                                                {/if}>{$item.CompanyName}</option>
                                    {/foreach}
                                </select>
                                {if $smarty.get.CompanyID > 0}
                                    <span id="button_mod"><a href='./?m=companies&o=edit&CompanyID={$smarty.get.CompanyID}'><b>Mod</b></a></span>
                                {/if}
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Contact'}:*</td>
                            <td><select name="ContactID" id="ContactID"
                                        onchange="window.location='{$request_uri}&ContactID='+document.getElementById('ContactID').value+'&ActivityID={$smarty.get.ActivityID}&ActivityDetID={$smarty.get.ActivityDetID}';">
                                    <option value="-1">{translate label='- Selecteaza contact -'} </option>
                                    {foreach from=$contacts key=key item=item}
                                        <option value="{$item.ContactID}"
                                                {if $smarty.get.ContactID!=''}
                                            {if $item.ContactID==$smarty.get.ContactID}
                                                selected="selected"
                                            {/if}
                                                {else}
                                            {if $item.ContactID==$info.ContactID}
                                                selected="selected"
                                            {/if}
                                                {/if}>{$item.ContactName}</option>
                                    {/foreach}
                                </select></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Telefon'}:</td>
                            <td><b>{$contact.ContactPhone|default:'-'}</b></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Email'}:</td>
                            <td><b>{$contact.ContactEmail|default:'-'}</b></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Functie'}:</td>
                            <td><b>{$contact.ContactFunction|default:'-'}</b></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Sursa'}:</td>
                            <td>

                                <script>{literal}
                                    function selecteazaSourceID(x) {
                                        $('CampaignID').hide();
                                        if (x == 2) $('CampaignID').show();
                                    }
                                    {/literal} </script>

                                <select name="SourceID" onchange="selecteazaSourceID(this.value)">
                                    {foreach from=$activitySource key=key item=item}
                                        <option value="{$item.SourceID}" {if $item.SourceID==$info.SourceID} selected="selected"{/if}>{$item.Name}</option>
                                    {/foreach}
                                </select></td>
                        </tr>
                        <tr height="35" id="CampaignID" style="{if $info.SourceID!=2}display:none;{/if}">
                            <td>{translate label='Campanie'}:</td>
                            <td><select name="CampaignID">
                                    <option value="0">None</option>
                                    {foreach from=$activityCampaign key=key item=item}
                                        <option value="{$item.CampaignID}" {if $item.CampaignID==$info.CampaignID} selected="selected"{/if}>{$item.CampaignName}</option>
                                    {/foreach}
                                </select></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Stadiu'}:</td>
                            <td><select name="StageID">
                                    {foreach from=$activityStage key=key item=item}
                                        <option value="{$item.StageID}" {if $item.StageID==$info.StageID} selected="selected"{/if}>{$item.Name}</option>
                                    {/foreach}
                                </select></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Subiect'}:</td>
                            <td><select name="Subject">
                                    {foreach from=$activitySubject key=key item=item}
                                        <option value="{$key}" {if $key==$info.Subject} selected="selected"{/if}>{$item}</option>
                                    {/foreach}
                                </select></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Status'}:</td>
                            <td><select name="Status" id="Status" onchange="
							if (document.getElementById('Status').value==1) document.getElementById('div_NextDate').style.visibility='hidden'; 
							if (document.getElementById('Status').value!=1) document.getElementById('div_NextDate').style.visibility='visible';">
                                    {foreach from=$activityStatus key=key item=item}
                                        <option value="{$key}" {if $key==$info.Status}selected="selected"{/if}>{$item}</option>
                                    {/foreach}
                                </select></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Apelat'}:</b></td>
                            <td>
                                <input type="text" name="Date" class="formstyle" value="{$info.Date|default:$smarty.now|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.event.Date,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="images/cal.png"
                                                                                                                                                              border="0"/></A>&nbsp;
                            </td>
                        </tr>

                        <tr height="35" id="div_NextDate">
                            <td>{translate label='De apelat'}:</b></td>
                            <td>
                                <input type="text" name="NextDate" class="formstyle" value="{$info.NextDate|default:''|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.event.NextDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="images/cal.png" border="0"/></A>&nbsp;
                            </td>
                        </tr>

                        <tr height="35">
                            <td>{translate label='Rezolutie'}:</td>
                            <td><textarea name="Comment" cols="50" rows="5" wrap="soft">{$info.Comment|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td>{translate label='Intalnire'}:</td>
                            <td>

                                <script>{literal}
                                    function selecteazaNewMeet(x) {
                                        $('layer_meeting').hide();
                                        if (x == 1 || x == 2)
                                            $('layer_meeting').show();
                                        $('layer_meeting_x').show();
                                    }
                                    {/literal} </script>

                                <select id="NewMeet" name="NewMeet" onchange="selecteazaNewMeet(this.value)">
                                    <option value="0" selected="selected">Tip intalnire</option>
                                    <option value="1">Intalnire noua</option>
                                    <option value="2">Intalnire revenire</option>
                                </select>

                                <div id="layer_meeting" class="layer" style="display:none">
                                    <div class="eticheta">
                                        {$eticheta}
                                    </div>
                                    <h3 class="layer">Detalii intalnire</h3>
                                    <div id="layer_meeting_content" class="layerContent">
                                        Data intalnire: <input type="text" name="MeetDate" class="formstyle" value="{$info.MeetDate|default:''|date_format:"%d.%m.%Y"}" size="10"
                                                               maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js2b">
                                            var cal2b = new CalendarPopup();
                                            cal2b.isShowNavigationDropdowns = true;
                                            cal2b.setYearSelectStartOffset(10);
                                            //writeSource("js2b");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal2.select(document.event.MeetDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                                    src="images/cal.png" align="absbottom" border="0" style="padding-bottom: 5px;"/></A>
                                        <br/>
                                        Interval intalnire:
                                        <select name="MeetHourStart">
                                            <option value="">-</option>{foreach from=$hours item=item}
                                            <option value="{$item}" {if !empty($info.MeetHourStart) && $info.MeetHourStart == $item}selected{/if}>{$item}</option>{/foreach}
                                        </select> :
                                        <select name="MeetHourStop">
                                            <option value="">-</option>{foreach from=$hours item=item}
                                            <option value="{$item}" {if !empty($info.MeetHourStop) && $info.MeetHourStop == $item}selected{/if}>{$item}</option>{/foreach}</select>
                                        <br/>
                                    </div>
                                    <hr style="1px solid #cccccc;"/>
                                    <div class="saveObservatii">
                                        <input type="button" onclick="$('layer_meeting').hide(); $('layer_meeting_x').hide();" style="text-align:center" value="Salveaza"
                                               style="cursor:pointer !important;"/>

                                    </div>
                                </div>
                                <div id="layer_meeting_x" class="butonX" style="display: none;" title="Inchide"
                                     onclick="document.getElementById('layer_meeting').style.display = 'none'; document.getElementById('layer_meeting_x').style.display = 'none'; window.location.reload();">
                                    x
                                </div>

                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Necesar'}:</td>
                            <td><textarea name="Comment2" cols="50" rows="5" wrap="soft">{$info.Comment2|default:''}</textarea></td>
                        </tr>
                        <tr height="35">
                            <td>&nbsp;</td>
                            {if !empty($smarty.get.ActivityID)}
                                <td><input type="submit" name="save" value="{translate label='Salveaza'}"></td>
                            {else}
                                <td><input type="submit" name="save" value="{translate label='Adauga activitate'}"></td>
                            {/if}
                        </tr>
                    </table>
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Detalii ofertare'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr height="35">
                            <td>{translate label='Proiect'}:</td>
                            <td>
                                <select name="ProjectID" onchange="if (this.value > 0) showInfo('ajax.php?o=project&ProjectID=' + this.value, 'project_info');">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$projects key=key item=item}
                                        <option value="{$key}" {if $key==$info.ProjectID} selected="selected"{/if}>{$item.Name}</option>
                                    {/foreach}
                                </select>
                                <div id="project_info"></div>
                                {if !empty($smarty.get.ActivityDetID) && !empty($info.ProjectID)}
                                    <script type="text/javascript">showInfo('ajax.php?o=project&ProjectID={$info.ProjectID}', 'project_info');</script>
                                {/if}
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Participare'}:</td>
                            <td>
                                <select name="ParticipationType">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$participation_types key=key item=item}
                                        <option value="{$key}" {if $key==$info.ParticipationType} selected="selected"{/if}>{translate label=$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>{translate label='Sursa de finantare'}:</td>
                            <td>
                                <select name="FinancialSource">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$financial_sources key=key item=item}
                                        <option value="{$key}" {if !empty($info.FinancialSource) && $info.FinancialSource==$key}selected{/if}>{translate label=$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Data cererii de oferta'}:</b></td>
                            <td>
                                <input type="text" name="RequestDate" class="formstyle"
                                       value="{if $info.RequestDate > '0000-00-00'}{$info.RequestDate|default:''|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3">
                                    var cal3 = new CalendarPopup();
                                    cal3.isShowNavigationDropdowns = true;
                                    cal3.setYearSelectStartOffset(10);
                                    //writeSource("js3");
                                </SCRIPT>
                                <A HREF="#" onClick="cal3.select(document.event.RequestDate,'anchor3','dd.MM.yyyy'); return false;" NAME="anchor3" ID="anchor3"><img
                                            src="images/cal.png" border="0"/></A>&nbsp;
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Termen limita de depunere a ofertei'}:</b></td>
                            <td>
                                <input type="text" name="Deadline" class="formstyle"
                                       value="{if $info.Deadline > '0000-00-00'}{$info.Deadline|default:''|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js4">
                                    var cal4 = new CalendarPopup();
                                    cal4.isShowNavigationDropdowns = true;
                                    cal4.setYearSelectStartOffset(10);
                                    //writeSource("js4");
                                </SCRIPT>
                                <A HREF="#" onClick="cal4.select(document.event.Deadline,'anchor4','dd.MM.yyyy'); return false;" NAME="anchor4" ID="anchor4"><img
                                            src="images/cal.png" border="0"/></A>&nbsp;
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Data ofertei'}:</b></td>
                            <td>
                                <input type="text" name="OfferDate" class="formstyle"
                                       value="{if $info.OfferDate > '0000-00-00'}{$info.OfferDate|default:''|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js5">
                                    var cal5 = new CalendarPopup();
                                    cal5.isShowNavigationDropdowns = true;
                                    cal5.setYearSelectStartOffset(10);
                                    //writeSource("js5");
                                </SCRIPT>
                                <A HREF="#" onClick="cal5.select(document.event.OfferDate,'anchor5','dd.MM.yyyy'); return false;" NAME="anchor5" ID="anchor5"><img
                                            src="images/cal.png" border="0"/></A>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>{translate label='Valoare oferta'}:</td>
                            <td><input type="text" name="OfferValue" value="{$info.OfferValue|default:''}" size="20" maxlength="20"></td>
                        </tr>
                        <tr>
                            <td>{translate label='Moneda'}:</td>
                            <td>
                                <select name="Coin">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$coins item=item}
                                        <option value="{$item}" {if $info.Coin == $item}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                {if !empty($smarty.get.ActivityDetID)}
                    <div id="layer_products" class="layer" style="display: none;">
                        <div class="eticheta">
                            {$eticheta}
                        </div>
                        <h3 class="layer">{translate label='Produse la oferta'}</h3>
                        <div id="layer_products_content" class="layerContent"></div>
                        <div class="saveObservatii">
                            <input align="" type="button" value="{translate label="Salveaza"}"
                                   onclick="window.location.href = '{$smarty.server.REQUEST_URI}'; document.getElementById('layer_products').style.display = 'none'; document.getElementById('layer_products_x').style.display = 'none'; return false;">
                        </div>
                    </div>
                    <div id="layer_products_x" class="butonX" style="display: none;" title="Inchide"
                         onclick="document.getElementById('layer_products').style.display = 'none'; document.getElementById('layer_products_x').style.display = 'none'; return false;">
                        x
                    </div>
                    <br>
                    <fieldset>
                        <legend>{translate label='Produse'}</legend>
                        {if !empty($products_offers)}
                            <table cellpadding="2">
                                <tr>
                                    <th>{translate label='Nr Oferta'}</th>
                                    <th>{translate label='Valoare oferta'}</th>
                                    <th>{translate label='Data oferta'}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                {foreach from=$products_offers item=item}
                                    <tr>
                                        <td>{$item.OfferIndex}</td>
                                        <td>{$item.OfferValue} Lei</td>
                                        <td>{$item.OfferDate|date_format:'%d.%m.%Y'}</td>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="showInfo('ajax.php?o=offer_products&ActivityDetID={$smarty.get.ActivityDetID}&OfferIndex={$item.OfferIndex}', 'layer_products_content'); document.getElementById('layer_products').style.display = 'block'; document.getElementById('layer_products_x').style.display = 'block'; return false;"><b>Mod</b></a>
                                            </div>
                                        </td>
                                        <td>{translate label='PDF'}</td>
                                        <td>{translate label='Proforma'}</td>
                                        <td>
                                            <div id="button_del"><a href="#" deleted="{$item.OfferIndex}" title="{translate label='Sterge document'}"><b>Del</b></a></div>
                                        </td>
                                    </tr>
                                {/foreach}
                            </table>
                        {/if}
                        <p><a href="#"
                              onclick="showInfo('ajax.php?o=offer_products&ActivityDetID={$smarty.get.ActivityDetID}&OfferIndex={$nextOfferIndex}', 'layer_products_content');  document.getElementById('layer_products').style.display = 'block'; document.getElementById('layer_products_x').style.display = 'block'; return false;">{translate label='Oferta Noua'}</a>
                        </p>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>{translate label='Documente'}</legend>
                        {if !empty($docs)}
                            <table cellspacing="0" cellpadding="4">
                                {foreach from=$docs key=docname item=doc}
                                    <tr>
                                        <td><a href="{$doc}" target="_blank" title="{translate label='vizualizeaza document'}">{$docname}</a></td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti acest document?'}')) window.location.href='{$smarty.server.REQUEST_URI}&del_doc=' + escape('{$doc}'); return false;"
                                                                    title="{translate label='Sterge document'}"><b>Del</b></a></div>
                                        </td>
                                    </tr>
                                {/foreach}
                            </table>
                        {/if}
                        <p>Incarca document: <input type="file" name="doc">&nbsp;<input type="submit" name="savedoc" value="{translate label='Salveaza'}"></p>
                    </fieldset>
                {/if}
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    if (document.getElementById('Status').value == 1) document.getElementById('div_NextDate').style.visibility = 'hidden';
    if (document.getElementById('Status').value != 1) document.getElementById('div_NextDate').style.visibility = 'visible';
    {*{if !empty($smarty.get.ActivityDetID)}showInfo('ajax.php?o=offer_products&ActivityDetID={$smarty.get.ActivityDetID}&OfferIndex={$item.OfferIndex}&CompanyID={$item.CompanyID}&ContactID={$item.ContactID}', 'layer_products_content');{/if}*}
    {literal}
    function getInfo(string, index) {
        // 0 -> ProductID
        // 1 -> Price
        // 2 -> MaxDiscount
        var info = string.split('|');
        return info[index];
    }

    jQuery('#button_del a').on('click', function () {
            var deleted_index = jQuery(this).attr('deleted');
            jQuery.confirm({
                'title': 'Confirmare stergere',
                'message': 'Sunteti sigur ca doriti stergerea acestui element?',
                'buttons': {
                    'Sterge': {
                        'class': 'blue',
                        'action': function () {
                            window.location.href = '{/literal}{$smarty.server.REQUEST_URI}{literal}&del_offer=' + deleted_index;
                            return false;
                        }
                    },
                    'Anuleaza': {
                        'class': 'gray',
                        'action': function () {
                        }	// Nothing to do in this case. You can as well omit the action property.
                    }
                }
            });

            return false;
        }
    );

    {/literal}
</script>