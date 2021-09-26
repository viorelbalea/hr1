{include file="performance_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="perf" onsubmit="return validForm(document.perf);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">Obiective</span>
                <select name="Year" onchange="window.location.href = './?m=performance&o=goals&PersonID={$smarty.session.PersonID}&Year=' + this.value;">
                    {foreach from=$years item=item}
                        <option value="{$item}" {if $item == $Year}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            </td>
            <td valign="top" class="bkdTitleMenu" align="right"><span class="TitleBox">{$FullName}</span></td>
        </tr>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="padding: 10px;">
                <fieldset>

                    {if !empty($smarty.get.action) && $smarty.get.action == 'new'}
                        <table cellspacing="0" cellpadding="4">
                            <tr>
                                <td width="100"><b>{translate label='Anul'}</b></td>
                                <td><b>{translate label='Dimeniunea HCM'}</b></td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <select name="Year">
                                        {foreach from=$years item=item}
                                            <option value="{$item}" {if $item == $Year}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <select name="DimensionID" class="cod">
                                        <option value="0">alege...</option>
                                        {foreach from=$dimensions key=key item=item}
                                            {if $item.Status == 1}
                                                <option value="{$key}">{$item.Dimension}</option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table cellspacing="0" cellpadding="4" border="0">
                            <tr valign="top">
                                <td>
                                    <b>{translate label='Actiune / Obiectiv'}</b>
                                    <br>
                                    <textarea name="Goal" wrap="soft" cols="60" rows="12"></textarea>
                                </td>
                                <td style="padding-left: 10px;">
                                    <table cellspacing="0" cellpadding="0">
                                        <tr valign="top">
                                            <td width="120"><b>{translate label='Pondere'}</b><br><input type="text" name="Pondere" size="5" maxlength="5"></td>
                                            <td align="center" width="120">
                                                <b>Termen</b>
                                                <br>
                                                <input type="text" name="Deadline" class="formstyle" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                                    var cal1 = new CalendarPopup();
                                                    cal1.isShowNavigationDropdowns = true;
                                                    cal1.setYearSelectStartOffset(10);
                                                    //writeSource("js1");
                                                </SCRIPT>

                                                <A HREF="#" onClick="cal1.select(document.perf.Deadline,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                                            src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td align="center" width="120">
                                                <b>{translate label='Status'}</b>
                                                <br>
                                                <select name="StatusID">
                                                    {foreach from=$status key=key item=item}
                                                        <option value="{$key}">{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td align="center" width="130">
                                                <b>{translate label='Data Actualizare'}</b>
                                                <br>
                                                <input type="text" name="StatusDate" class="formstyle" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                                    var cal2 = new CalendarPopup();
                                                    cal2.isShowNavigationDropdowns = true;
                                                    cal2.setYearSelectStartOffset(10);
                                                    //writeSource("js2");
                                                </SCRIPT>

                                                <A HREF="#" onClick="cal2.select(document.perf.StatusDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                                            src="./images/cal.png" border="0"></A>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="120" style="padding: 10px 0 0 0;"><b>{translate label='Indicator'}</b><br><input type="text" value="0" name="Indicator"
                                                                                                                                        size="10" maxlength="11"></td>
                                            <td width="120" style="padding: 10px 0 0 0;"><b>{translate label='Indicator Realizat'}</b><br><input type="text" value="0"
                                                                                                                                                 name="IndicatorRealizat" size="10"
                                                                                                                                                 maxlength="11"></td>
                                            <!--<td style="padding: 10px 0 0 10px;" colspan="3">
							<table>
								<tr align="center">
								<td><b>{translate label='Nota'}</b></td>
								{foreach from=$calif key=note item=detail}
								<td><a href="javascript:void();" title="{translate label=$detail}">{$note}</a></td>
								{/foreach}
								</tr>
								<tr align="center">
								<td>&nbsp;</td>
								{foreach from=$calif key=note item=detail}
								<td><input type="radio" name="Calif" value="{$note}"></td>
								{/foreach}
								</tr>
							</table>
						</td>	-->
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="padding: 10px 0 0 0;">
                                                <br><b>{translate label='Comentariu'}</b><br><textarea name="Comment" wrap="soft" cols="72" rows="3"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><br><b>{translate label='Nivel asteptat'}</b><br><input type="text" name="EspectedLevel" size="61" maxlength="64"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><br><b>{translate label='Comentariu final evaluare'}</b><br><textarea name="CommentEval" wrap="soft" cols="140" rows="3"></textarea>
                                </td>
                            </tr>
                            <!--
			{foreach from=$calif key=note item=detail}
				{assign var="fnote" value="Note"|cat:$note}
				<tr>
					<td colspan="3">{if $note == 1}<br><b>{translate label='Legenda'}</b><br><br>{/if}{translate label='Nota'} {$note} <input type="text" name="{$fnote}" value="{$goal.$fnote|default:$detail}" size="100" maxlength="255"></td>
				</tr>    
			{/foreach}
			-->
                            <tr>
                                <td colspan="3"><br><input type="submit" value="{translate label='Salveaza'}">&nbsp;&nbsp;<input type="button" value="{translate label='Inapoi'}"
                                                                                                                                 onclick="history.back();"></td>
                            </tr>
                        </table>
                    {elseif !empty($smarty.get.action) && $smarty.get.action == 'edit'}
                        <table cellspacing="0" cellpadding="4">
                            <tr>
                                <td width="100"><b>{translate label='Anul'}</b></td>
                                <td><b>{translate label='Dimeniunea HCM'}</b></td>
                            </tr>
                            <tr valign="top">
                                <td width="100">
                                    <select name="Year">
                                        {foreach from=$years item=item}
                                            <option value="{$item}" {if $item == $goal.Year}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <select name="DimensionID" class="cod">
                                        {foreach from=$dimensions key=key item=item}
                                            {if $item.Status == 1 || ($item.Status == 0 && $key==$goal.DimensionID)}
                                                <option value="{$key}" {if $key==$goal.DimensionID}selected{/if}>{$item.Dimension}</option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table cellspacing="0" cellpadding="4">
                            <tr valign="top">
                                <td>
                                    <b>{translate label='Actiune / Obiectiv'}</b>
                                    <br>
                                    <textarea name="Goal" wrap="soft" cols="60" rows="12">{$goal.Goal}</textarea>
                                </td>
                                <td style="padding-left: 10px;">
                                    <table cellspacing="0" cellpadding="0">
                                        <tr valign="top">
                                            <td width="120"><b>{translate label='Pondere'}</b><br><input type="text" name="Pondere" size="5" maxlength="5" value="{$goal.Pondere}">
                                            </td>
                                            <td align="center" width="120">
                                                <b>Termen</b>
                                                <br>
                                                <input type="text" name="Deadline" value="{if $goal.Deadline != '00-00-0000'}{$goal.Deadline}{/if}" class="formstyle" size="10"
                                                       maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                                    var cal1 = new CalendarPopup();
                                                    cal1.isShowNavigationDropdowns = true;
                                                    cal1.setYearSelectStartOffset(10);
                                                    //writeSource("js1");
                                                </SCRIPT>

                                                <A HREF="#" onClick="cal1.select(document.perf.Deadline,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                                            src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td align="center" width="120">
                                                <b>{translate label='Status'}</b>
                                                <br>
                                                <select name="StatusID">
                                                    {foreach from=$status key=key item=item}
                                                        <option value="{$key}" {if $key==$goal.StatusID}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td align="center" width="130">
                                                <b>{translate label='Data Actualizare'}</b>
                                                <br>
                                                <input type="text" name="StatusDate" value="{if $goal.StatusDate != '00-00-0000'}{$goal.StatusDate}{/if}" class="formstyle"
                                                       size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                                    var cal2 = new CalendarPopup();
                                                    cal2.isShowNavigationDropdowns = true;
                                                    cal2.setYearSelectStartOffset(10);
                                                    //writeSource("js2");
                                                </SCRIPT>

                                                <A HREF="#" onClick="cal2.select(document.perf.StatusDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                                            src="./images/cal.png" border="0"></A>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="120" style="padding: 10px 0 0 0;"><b>{translate label='Indicator'}</b><br><input type="text" name="Indicator" size="10"
                                                                                                                                        maxlength="11" value="{$goal.Indicator}">
                                            </td>
                                            <td width="120" style="padding: 10px 0 0 0;"><b>{translate label='Indicator Realizat'}</b><br><input type="text"
                                                                                                                                                 name="IndicatorRealizat" size="10"
                                                                                                                                                 maxlength="11"
                                                                                                                                                 value="{$goal.IndicatorRealizat}">
                                            </td>
                                            <!--<td style="padding: 10px 0 0 10px;" colspan="2">
							<table>
								<tr align="center">
								<td><b>{translate label='Nota'}</b></td>
								{foreach from=$calif key=note item=detail}
								{assign var="fnote" value="Note"|cat:$note}
								<td><a href="javascript:void();" title="{translate label=$goal.$fnote|default:$detail}">{$note}</a></td>
								{/foreach}
								</tr>
								<tr align="center">
								<td>&nbsp;</td>
								{foreach from=$calif key=note item=detail}
								<td><input type="radio" name="Calif" value="{$note}" {if $goal.Calif==$note}checked{/if}></td>
								{/foreach}
								</tr>
							</table>
							</td>
							-->
                                            <td style="padding: 10px 0 0 20px;">
                                                {if $smarty.session.USER_RIGHTS2.9.1 == 2}
                                                    {if $goal.Closed == 0}
                                                        <b>{translate label='inchide'} <input type="checkbox" name="Closed" value="1"></b>
                                                    {else}
                                                        <b>{translate label='obiectiv inchis'}</b>
                                                    {/if}
                                                {/if}
                                                {if $smarty.session.USER_RIGHTS2.9.1 == 3 || $smarty.session.USER_ID == 1}
                                                    <b>{translate label='inchide'} <input type="checkbox" name="Closed" value="1" {if $goal.Closed == 1}checked{/if}></b>
                                                {/if}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="padding: 10px 0 0 0;">
                                                <br><b>{translate label='Comentariu'}</b><br><textarea name="Comment" wrap="soft" cols="72" rows="3">{$goal.Comment}</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><br><b>{translate label='Nivel asteptat'}</b><br><input type="text" name="EspectedLevel" value="{$goal.EspectedLevel}" size="61"
                                                                                                        maxlength="64"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><br><b>{translate label='Comentariu final evaluare'}</b><br><textarea name="CommentEval" wrap="soft" cols="140"
                                                                                                                      rows="3">{$goal.CommentEval}</textarea></td>
                            </tr>
                            <!--
			{foreach from=$calif key=note item=detail}
			{assign var="fnote" value="Note"|cat:$note}
			<tr>
				<td colspan="3">{if $note == 1}<br><b>{translate label='Legenda'}</b><br><br>{/if}{translate label='Nota'} {$note} <input type="text" name="{$fnote}" value="{$goal.$fnote|default:$detail}" size="100" maxlength="255"></td>
			</tr>    
			{/foreach}
			-->
                            <tr>
                                <td colspan="3">{if $smarty.session.USER_ID != 1 && $smarty.session.USER_RIGHTS2.9.1 == 1 && $goal.StatusID > 1}{else}<br><input type="submit"
                                                                                                                                                                 value="{translate label='Salveaza'}">&nbsp;&nbsp;{/if}
                                    <input type="button" value="{translate label='Inapoi'}" onclick="history.back();"></td>
                            </tr>
                        </table>
                    {elseif !empty($smarty.get.action) && $smarty.get.action == 'history'}
                        <table width="100%" cellspacing="0" cellpadding="4">
                            <tr>
                                <td><b>{translate label='Dimeniunea HCM'}</b></td>
                                <td><b>{translate label='Actiune / Obiectiv'}</b></td>
                                <td align="center" width="120"><b>{translate label='Pondere'}</b></td>
                                <td align="center" width="120"><b>{translate label='Indicator'}</b></td>
                                <td align="center" width="120"><b>{translate label='Indicator Realizat'}</b></td>
                                <td align="center" width="90"><b>{translate label='Grad de indeplinire'}</b></td>
                                <td align="center" width="100"><b>{translate label='Nota finala'}</b></td>
                                <td align="center" width="120"><b>{translate label='Termen'}</b></td>
                                <td align="center" width="120"><b>{translate label='Status'}</b></td>
                                <td width="180"><b>{translate label='Comentariu'}</b></td>
                                <td>&nbsp;</td>
                            </tr>
                            {foreach from=$goal item=item}
                                <tr>
                                    <td width="220">{$dimensions[$item.DimensionID].Dimension}</td>
                                    <td width="300">{$item.Goal}</td>
                                    <td align="center" width="120">{$item.Pondere} %</td>
                                    <td align="center" width="120">{$item.Indicator}</td>
                                    <td align="center" width="120">{$item.IndicatorRealizat}</td>
                                    <td align="center" width="90">{$item.GradIndeplinire} %</td>
                                    <td align="center" width="100">{$item.NotaFinala}</td>
                                    <td align="center" width="120">{if $item.Deadline != '00-00-0000'}{$item.Deadline}{else}&nbsp;{/if}</td>
                                    <td align="center" width="120">{$status[$item.StatusID]}{if $item.StatusDate != '00-00-0000'}<br/>{$item.StatusDate}{else}&nbsp;{/if}</td>
                                    <td width="180">
                                        {if $smarty.session.USER_ID == 1 && !empty($smarty.get.DetailID) && $item.DetailID == $smarty.get.DetailID}
                                        <textarea name="Comment" wrap="soft" cols="21" rows="10">{$item.Comment}</textarea>
                                        <br>
                                        <input type="submit" value="{translate label='Salveaza'}">
                                        {else}
                                        {$item.Comment}
                                        {if !empty($item.Comment)}
                                            <br/>
                                        {/if}
                                        {if $smarty.session.USER_ID == 1}
                                        <div id="button_history" style="padding: 0px 0 0 30px;"><a href="#"
                                                                                                   onclick="window.location.href = './?m=performance&o=goals&action=history&PersonID={$smarty.session.PersonID}&PerfID={$item.PerfID}&DetailID={$item.DetailID}&Year={$Year}'"
                                                                                                   title="Modifica"><b>Mod</b></a></div>
                                    </td>
                                    {/if}
                                    {/if}
                                    </td>
                                    {if $smarty.session.USER_ID == 1}
                                        <td width="20">
                                            <div id="button_del"><a href=#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti aceasta inregistrare din istoric?'}')) window.location.href = './?m=performance&o=goals&action=delete_history&PersonID={$smarty.session.PersonID}&PerfID={$item.PerfID}&DetailID={$item.DetailID}&Year={$Year}'; return false;"
                                                                    title="Sterge"><b>Del</b></a></div>
                                        </td>
                                    {else}
                                        <td width="20">&nbsp;</td>
                                    {/if}
                                </tr>
                                <tr>
                                    <td colspan="9" style="border-top: 1px solid #cccccc;">&nbsp;</td>
                                </tr>
                            {/foreach}
                            <tr>
                                <td colspan="9">
                                    <input type="button" value="{translate label='Inapoi'}"
                                           onclick="window.location.href = './?m=performance&o=goals&PersonID={$smarty.session.PersonID}&Year={$smarty.get.Year}';">&nbsp;&nbsp;
                                    <input type="button" value="Printeaza" onclick="window.open('{$smarty.server.REQUEST_URI}&print_history=1', 'print');">
                                </td>
                            </tr>
                        </table>
                    {else}

                        {assign var="request_uri" value="./?m=performance&o=goals&PersonID="|cat:$smarty.session.PersonID|cat:'&Year='|cat:$smarty.get.Year}
                        <table width="100%" cellspacing="0" cellpadding="4">
                            <tr>
                                <td width="30">{orderby label='Ordine' request_uri=$request_uri order_by=Pos}</td>
                                <td width="290">{orderby label='Dimeniunea HCM' request_uri=$request_uri order_by=DimensionID}</td>
                                <td width="250">{orderby label='Actiune / Obiectiv' request_uri=$request_uri order_by=Goal}</td>
                                <td width="80">{orderby label='Pondere' request_uri=$request_uri order_by=Pondere}</td>
                                <td width="80">{orderby label='Indicator' request_uri=$request_uri order_by=Indicator}</td>
                                <td width="100">{orderby label='Indicator Realizat' request_uri=$request_uri order_by=IndicatorRealizat}</td>
                                <td width="80">{orderby label='Grad de indeplinire' request_uri=$request_uri order_by=GradIndeplinire}</td>
                                <td width="60">{orderby label='Nota finala' request_uri=$request_uri order_by=NotaFinala}</td>
                                <td width="90">{orderby label='Termen' request_uri=$request_uri order_by=Deadline}</td>
                                <td width="90">{orderby label='Status' request_uri=$request_uri order_by=StatusID}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            {assign var="totalP" value="0"}
                            {assign var="totalNF" value="0"}
                            {foreach from=$goals key=key item=item}
                                <tr valign="top">
                                    <td><input type="text" name="Pos[{$item.PerfID}]" value="{$item.Pos|default:0}" size="1" maxlength="3"></td>
                                    <td>{$dimensions[$item.DimensionID].Dimension}</td>
                                    <td>{$item.Goal}</td>
                                    <td align="center">{$item.Pondere} %</td>
                                    <td align="center">{$item.Indicator}</td>
                                    <td align="center">{$item.IndicatorRealizat}</td>
                                    <td align="center">{$item.GradIndeplinire} %</td>
                                    <td align="center">{$item.NotaFinala}</td>
                                    <td>{if $item.Deadline != '00-00-0000'}{$item.Deadline}{else}&nbsp;{/if}</td>
                                    <td>{$status[$item.StatusID]}<br>{if $item.StatusDate != '00-00-0000'}{$item.StatusDate}{else}&nbsp;{/if}<br>
                                        <div id="button_history" style="padding: 4px 0 0 20px;"><a href="#"
                                                                                                   onclick="window.location.href = './?m=performance&o=goals&action=history&PersonID={$smarty.session.PersonID}&PerfID={$item.PerfID}&Year={$Year}'"
                                                                                                   class="button_history" title="Istoric obiectiv"><b>His</b></a></div>
                                    </td>
                                    <td width="10" align="right">
                                        {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS2.9.1 == 3 || (($smarty.session.USER_RIGHTS2.9.1 == 2 || ($smarty.session.USER_RIGHTS2.9.1 == 1 && $item.StatusID == 1)) && $item.Closed == 0)}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=performance&o=goals&action=edit&PersonID={$smarty.session.PersonID}&PerfID={$item.PerfID}&Year={$Year}'"
                                                                    title="Modifica obiectiv"><b>Mod</b></a></div>
                                        {else}&nbsp;
                                        {/if}
                                    </td>
                                    <td width="10" align="right">
                                        {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS2.9.1 == 3 || (($smarty.session.USER_RIGHTS2.9.1 == 2 || ($smarty.session.USER_RIGHTS2.9.1 == 1 && $item.StatusID == 1)) && $item.Closed == 0)}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti acest obiectiv?'}')) window.location.href = './?m=performance&o=goals&action=delete&PersonID={$smarty.session.PersonID}&PerfID={$item.PerfID}&Year={$Year}'; return false;"
                                                                    title="Sterge obiectiv"><b>Del</b></a></div>
                                        {else}&nbsp;
                                        {/if}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="border-top: 1px solid #cccccc;">&nbsp;</td>
                                </tr>
                                {math equation="x+y" x=$totalP y=$item.Pondere assign="totalP"}
                                {math equation="x+y" x=$totalNF y=$item.NotaFinala assign="totalNF"}
                            {/foreach}
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="right"><b>TOTAL: </b></td>
                                <td align="center"><b>{$totalP} %</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="center"><b>{$totalNF}</b></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9">
                                    <input type="submit" value="{translate label='Salveaza ordine'}">&nbsp;&nbsp;
                                    <input type="button" value="{translate label='Obiectiv nou'}"
                                           onclick="window.location.href = './?m=performance&o=goals&action=new&PersonID={$smarty.session.PersonID}&Year={$Year}';">&nbsp;&nbsp;
                                    <input type="button" value="{translate label='Printeaza'}"
                                           onclick="window.open('./?m=performance&o=goals&PersonID={$smarty.session.PersonID}&Year={$Year}&print=1', 'print');">&nbsp;&nbsp;
                                    <input type="button" value="Export"
                                           onclick="window.location.href = './?m=performance&o=goals&PersonID={$smarty.session.PersonID}&Year={$Year}&export=1';">&nbsp;&nbsp;
                                    <input type="button" value="Export .doc"
                                           onclick="window.location.href = './?m=performance&o=goals&PersonID={$smarty.session.PersonID}&Year={$Year}&export_doc=1';">&nbsp;&nbsp;
                                    <input type="button" value="{translate label='Inapoi'}" onclick="window.location.href = './?m=performance&o=objective';">
                                </td>
                            </tr>
                        </table>
                    {/if}

                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="4" valign="top" class="bkdTitleMenu">&nbsp;</td>
        </tr>
    </table>
</form>

{literal}
    <script language="javascript">
        function validForm(f) {
            if (is_empty(f.Goal.value)) {
                alert('Nu ati completat actiunea!');
                return false;
            }
            return true;
        }
    </script>
{/literal}