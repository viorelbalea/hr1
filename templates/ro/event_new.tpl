{include file="event_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="event" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" width="100%" class="screen">
        {if !empty($smarty.get.EventID)}
            {if $info.EventType == 5 || $info.EventType == 6}
                {assign var="event_label" value="interviu"}
            {else}
                {assign var="event_label" value="eveniment"}
            {/if}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="event_submenu.tpl"}</span></td>
            </tr>
        {else}
            {if $smarty.get.o == 'new_interview'}
                {assign var="event_label" value="interviu"}
            {else}
                {assign var="event_label" value="eveniment"}
            {/if}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adauga'} {translate label=$event_label}</span></td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
        <tr valinn="top">
            <td class="celulaMenuST{if empty($smarty.get.EventID)}DR{/if}" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Detalii'} {translate label=$event_label}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr height="35">
                            <td>&nbsp;</td>
                            <td>{translate label='Programata'} <input type="radio" name="EventStatus" value="1"
                                                                      {if $info.EventStatus == 1}checked{/if}>&nbsp;{translate label='Neprogramata'} <input type="radio"
                                                                                                                                                            name="EventStatus"
                                                                                                                                                            value="0"
                                                                                                                                                            {if $info.EventStatus == 0}checked{/if}>
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Data'} {translate label=$event_label}*:</b></td>
                            <td>
                                <input type="text" name="EventData" class="formstyle" value="{$info.EventData|default:$smarty.now|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.event.EventData,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="./images/cal.png" border="0" alt="{translate label='selecteaza data'}"></A>&nbsp;
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Interval orar'}:</b></td>
                            <td>
                                <select name="EventHourStart">
                                    <option value="">-</option>{foreach from=$hours item=item}
                                    <option value="{$item}" {if !empty($info.EventHourStart) && $info.EventHourStart == $item}selected{/if}>{$item}</option>{/foreach}</select> :
                                <select name="EventHourStop">
                                    <option value="">-</option>{foreach from=$hours item=item}
                                    <option value="{$item}" {if !empty($info.EventHourStop) && $info.EventHourStop == $item}selected{/if}>{$item}</option>{/foreach}</select>
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Intre'}:</td>
                            <td>
                                {if $event_label == 'interviu'}
                                    <input type="hidden" name="EventRelation" value="2">
                                    {$eventRelation.2}
                                {else}
                                    <select name="EventRelation">
                                        {foreach from=$eventRelation key=key item=item}
                                            <option value="{$key}" {if $key==$info.EventRelation}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                {/if}
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Tip intalnire'}:</td>
                            <td>
                                <select name="EventType">
                                    {foreach from=$eventType key=key item=item}
                                        {if $event_label == 'interviu'}
                                            {if $key == 5 || $key == 6}
                                                <option value="{$key}" {if $key==$info.EventType}selected{/if}>{$item}</option>
                                            {/if}
                                        {else}
                                            {if $key != 5 && $key != 6}
                                                <option value="{$key}" {if $key==$info.EventType}selected{/if}>{$item}</option>
                                            {/if}
                                        {/if}
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Locatie'}*:</td>
                            <td>
                                <select name="RoomID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$rooms key=key item=item}
                                        <option value="{$key}" {if $key==$info.RoomID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Reprezentant companie'}*:</td>
                            <td>
                                <select name="ConsultantID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$consultants key=key item=item}
                                        <option value="{$key}" {if $key==$info.ConsultantID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Reprezentant companie 2'}:</td>
                            <td>
                                <select name="ConsultantID2">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$consultants key=key item=item}
                                        <option value="{$key}" {if $key==$info.ConsultantID2}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Reprezentant companie 3'}:</td>
                            <td>
                                <select name="ConsultantID3">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$consultants key=key item=item}
                                        <option value="{$key}" {if $key==$info.ConsultantID3}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Scop'}*:</td>
                            <td><input type="text" name="Scope" value="{$info.Scope|default:''}" size="50" maxlength="255"></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Detalii'}:</td>
                            <td><textarea name="Details" cols="50" rows="5" wrap="soft">{$info.Details|default:''}</textarea></td>
                        </tr>
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
                                {if !empty($info.ProjectID)}
                                    <script type="text/javascript">showInfo('ajax.php?o=project&ProjectID={$info.ProjectID}', 'project_info');</script>
                                {/if}
                            </td>
                        </tr>
                        {if !empty($customfields.CustomEvent1)}
                            <tr height="35">
                                <td>{$customfields.CustomEvent1}:</td>
                                <td><input type="text" name="CustomEvent1" value="{$info.CustomEvent1|default:''}" size="30" maxlength="255"></td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomEvent2)}
                            <tr height="35">
                                <td>{$customfields.CustomEvent2}:</td>
                                <td><input type="text" name="CustomEvent2" value="{$info.CustomEvent2|default:''}" size="30" maxlength="255"></td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomEvent3)}
                            <tr height="35">
                                <td>{$customfields.CustomEvent3}:</td>
                                <td>
                                    <input type="text" id="CustomEvent3" name="CustomEvent3" class="formstyle"
                                           value="{if !empty($info.CustomEvent3) && $info.CustomEvent3 != '0000-00-00 00:00:00'}{$info.CustomEvent3|date_format:"%d.%m.%Y"}{/if}"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomEvent3">
                                        var cal_CustomEvent3 = new CalendarPopup();
                                        cal_CustomEvent3.isShowNavigationDropdowns = true;
                                        cal_CustomEvent3.setYearSelectStartOffset(10);
                                        //writeSource("js_CustomEvent3");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomEvent3.select(document.getElementById('CustomEvent3'),'anchor_CustomEvent3','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomEvent3" ID="anchor_CustomEvent3"><img src="./images/cal.png" border="0" alt="{translate label='selecteaza data'}"></A>
                                </td>
                            </tr>
                        {/if}
                        <tr height="35">
                            <td>&nbsp;</td>
                            {if !empty($smarty.get.EventID)}
                                <td>{if $info.rw == 1  || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle"> <input type="button"
                                                                                                                                                                   value="{translate label='Anuleaza'}"
                                                                                                                                                                   onclick="window.location='./?m=events{if $info.EventType == 5 || $info.EventType == 6}&o=interview{/if}'"
                                                                                                                                                                   class="formstyle">{/if}
                                </td>
                            {else}
                                <td><input type="submit" value="{translate label='Adauga'} {translate label=$event_label}" class="formstyle"> <input type="button"
                                                                                                                                                     value="{translate label='Anuleaza'}"
                                                                                                                                                     onclick="window.location.href='./?m=events{if $event_label == 'interviu'}&o=interview{/if}'"
                                                                                                                                                     class="formstyle"></td>
                            {/if}
                        </tr>
                    </table>
                </fieldset>
            </td>
            {if !empty($smarty.get.EventID)}
                <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                    <br>
                    <fieldset>
                        <legend>{translate label='Personal'}/ {translate label='Candidati'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>{translate label='Alege tip'}</td>
                                <td><input name="PersonType" type="radio" checked="checked"
                                           onclick="document.getElementById('zonePersons').style.display='block'; document.getElementById('zoneCandidates').style.display='none';"/>{translate label='Personal'}
                                </td>
                                <td><input name="PersonType" type="radio"
                                           onclick="document.getElementById('zoneCandidates').style.display='block'; document.getElementById('zonePersons').style.display='none';"/>{translate label='Candidati'}
                                </td>
                            </tr>
                        </table>
                        <!-- Persons Zone -->
                        <table id="zonePersons" border="0" cellpadding="4" cellspacing="0" class="screen">
                            {foreach from=$event_persons item=item}
                                <tr>
                                    <td>
                                        <select id="persons_{$item}" name="persons[{$item}]">
                                            <option value="0">{translate label='alege personal'}</option>
                                            {foreach from=$persons key=key2 item=item2}
                                                <option value="{$key2}" {if $item==$key2}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                        {if $info.rw == 1 || !empty($smarty.post)}<a href="#"
                                                                                     onclick="if (confirm('{translate label='Sunteti sigur(a)?'}') && document.getElementById('persons_{$item}').value>0) window.location.href='./?m=events&o=edit&EventID={$smarty.get.EventID}&action=del&PersonID=' + document.getElementById('persons_{$item}').value; return false;">
                                                sterge</a>{/if}
                                    </td>
                                </tr>
                            {/foreach}
                            {if $info.rw == 1 || !empty($smarty.post)}
                                {if (($info.EventType!=3 || ($info.EventType==3 && count($event_persons)==0))) && (($info.EventType!=5 || ($info.EventType==5 && count($event_persons)==0)))}
                                    <tr>
                                        <td>
                                            <select id="persons_0" name="persons[0]">
                                                <option value="0">{translate label='alege personal'}</option>
                                                {foreach from=$persons key=key2 item=item2}
                                                    {if !in_array($key2, $event_persons)}
                                                        <option value="{$key2}">{$item2}</option>
                                                    {/if}
                                                {/foreach}
                                            </select>
                                            <a href="#"
                                               onclick="if (document.getElementById('persons_0').value>0) window.location.href='./?m=events&o=edit&EventID={$smarty.get.EventID}&action=add&PersonID=' + document.getElementById('persons_0').value; return false;">adauga</a>
                                        </td>
                                    </tr>
                                {/if}
                            {/if}
                        </table>

                        <!-- Candidates Zone -->
                        <table id="zoneCandidates" border="0" cellpadding="4" cellspacing="0" class="screen" style="display:none;">
                            {foreach from=$event_candidates item=item}
                                <tr>
                                    <td>
                                        <select id="candidates_{$item}" name="candidates[{$item}]">
                                            <option value="0">{translate label='alege candidat'}</option>
                                            {foreach from=$candidates key=key2 item=item2}
                                                <option value="{$key2}" {if $item==$key2}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                        {if $info.rw == 1 || !empty($smarty.post)}<a href="#"
                                                                                     onclick="if (confirm('{translate label='Sunteti sigur(a)?'}') && document.getElementById('candidates_{$item}').value>0) window.location.href='./?m=events&o=edit&EventID={$smarty.get.EventID}&action=del-candidate&PersonID=' + document.getElementById('candidates_{$item}').value; return false;">
                                                sterge</a>{/if}
                                    </td>
                                </tr>
                            {/foreach}
                            {if $info.rw == 1 || !empty($smarty.post)}
                                {if (($info.EventType!=3 || ($info.EventType==3 && count($event_candidates)==0))) && (($info.EventType!=5 || ($info.EventType==5 && count($event_candidates)==0)))}
                                    <tr>
                                        <td>
                                            <select id="candidates_0" name="candidates[0]">
                                                <option value="0">{translate label='alege candidat'}</option>
                                                {foreach from=$candidates key=key2 item=item2}
                                                    {if !in_array($key2, $event_candidates)}
                                                        <option value="{$key2}">{$item2}</option>
                                                    {/if}
                                                {/foreach}
                                            </select>
                                            <a href="#"
                                               onclick="if (document.getElementById('candidates_0').value>0) window.location.href='./?m=events&o=edit&EventID={$smarty.get.EventID}&action=add-candidate&PersonID=' + document.getElementById('candidates_0').value; return false;">adauga</a>
                                        </td>
                                    </tr>
                                {/if}
                            {/if}
                        </table>

                        {if $info.EventType==5}
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="4">
                                        <tr>
                                            <td>{translate label='Numar interviu: '}</td>
                                            <td><input type="text" name="InterviewNo" value="{$info.InterviewNo}" size="2" maxlength="2"></td>
                                        </tr>
                                        <tr>
                                            <td>{translate label='Candidatul s-a prezentat'}:</td>
                                            <td><input type="checkbox" name="InterviewPrezent" value="1" {if $info.InterviewPrezent==1}checked{/if}></td>
                                        </tr>
                                        <tr>
                                            <td>{translate label='Calificativ'}:</td>
                                            <td>
                                                <select name="InterviewQual">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$interviuQ key=key item=item}
                                                        <option value="{$key}" {if $info.InterviewQual==$key}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{translate label='Domeniu interviu'}:</td>
                                            <td><input type="text" name="InterviewDomain" value="{$info.InterviewDomain}" size="20" maxlength="64"></td>
                                        </tr>
                                        <tr>
                                            <td>{translate label='Job'}:</td>
                                            <td>
                                                <select name="InterviewJobID">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$jobs key=key item=item}
                                                        <optgroup label="{$item.0.CompanyName}">
                                                            {foreach from=$item key=key2 item=item2}
                                                                <option value="{$item2.JobID}"
                                                                        {if $item2.JobID == $info.InterviewJobID}selected{/if} {if $item2.JobStatus==0}style="color: #FF0000;"{/if}>{$item2.JobTitle}
                                                                    [ {$item2.PositionNo} pozitii ]{if $item2.JobStatus==0} [ job expirat ]{/if}</option>
                                                            {/foreach}
                                                        </optgroup>
                                                    {/foreach}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{translate label='Comentarii'}:</td>
                                            <td><textarea name="InterviewComment" cols="40" rows="5" wrap="soft">{$info.InterviewComment|default:''}</textarea></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            {/if}
                        </table>
                    </fieldset>
                    {if $info.EventType==5}
                        <br>
                        <fieldset>
                            <legend>FeedBack</legend>
                            {translate label='Tip FeedBack'}:
                            <select name="FeedBack">
                                <option value="">{translate label='alege...'}</option>
                                <option value="pozitiv" {if $info.FeedBack == 'pozitiv'}selected{/if}>{translate label='pozitiv'}</option>
                                <option value="negativ" {if $info.FeedBack == 'negativ'}selected{/if}>{translate label='negativ'}</option>
                            </select>
                            <select name="FeedBackType"
                                    onchange="if (this.value == 'personalizat') document.getElementById('div_FeedBackBody').style.display = 'block'; else document.getElementById('div_FeedBackBody').style.display = 'none';">
                                <option value="">{translate label='alege...'}</option>
                                <option value="standard" {if $info.FeedBackType == 'standard'}selected{/if}>{translate label='standard'}</option>
                                <option value="personalizat" {if $info.FeedBackType == 'personalizat'}selected{/if}>{translate label='personalizat'}</option>
                            </select>
                            <div id="div_FeedBackBody" style="display: none;"><br><textarea name="FeedBackBody" cols="60" rows="8"
                                                                                            wrap="soft">{$info.FeedBackBody|default:''}</textarea></div>
                            {if $info.FeedBackType == 'personalizat'}
                                <script type="text/javascript">document.getElementById('div_FeedBackBody').style.display = 'block';</script>
                            {/if}
                            <br><br>
                            {if !empty($info.FeedBackAlert) && $info.FeedBackAlert != '0000-00-00 00:00:00'}
                                Email trimis in data de {$info.FeedBackAlert|date_format:'%d.%m.%Y'}
                            {else}
                                {if $info.rw == 1  || !empty($smarty.post)}
                                    <input type="button" value="{translate label='Trimite Email'}"
                                           onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&mail=1'"
                                           class="formstyle">
                                {/if}
                            {/if}
                        </fieldset>
                    {/if}
                </td>
            {/if}
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>

{literal}
<script type="text/javascript">
    function validateForm(f) {
        return {/literal}checkDate(f.EventData.value, 'Data {$event_label} este obligatorie'){literal}{/literal}{if !empty($customfields.CustomEvent3)} && (is_empty(f.CustomEvent3.value) ? true : checkDate(f.CustomEvent3.value, '{$customfields.CustomEvent3}')){/if}{literal};
    }
</script>
{/literal}