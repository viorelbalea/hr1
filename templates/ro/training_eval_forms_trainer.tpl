{include file="training_menu.tpl"}

<div class="filter">
    <label>{translate label='Cauta'}:</label>
    <select id="PersonID" name="PersonID" class="dropdown">
        <option value="0">{translate label='Persoane evaluate'}</option>
        {foreach from=$persons key=key item=item}
            {if $key>0}
                <option value="{$item.PersonID}" {if $item.PersonID==$smarty.get.PersonID}selected{/if}>{$item.FullName}</option>
            {/if}
        {/foreach}
    </select>
    <label>De la data de inceput</label>
    <input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10"/>
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','yyyy-MM-dd'); return false;" NAME="anchor1" ID="anchor1"><img src="./images/cal.png"
                                                                                                                                                          border="0"></A></label>
    <label>pana la data de sfarsit</label>
    <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('EndDate'),'anchor2','yyyy-MM-dd'); return false;" NAME="anchor2" ID="anchor2"><img src="./images/cal.png"
                                                                                                                                                        border="0"></A></label>

    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select><label>inregistrari</label>
    <input type="button" value="Cauta" class="cod" onclick="
		window.location.href = './?m=training&o=formsTrainer&PersonID=' + document.getElementById('PersonID').value + '&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value + '&res_per_page=' + document.getElementById('res_per_page').value
		">

    <br/>
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="{translate label='Export'} .xls" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
                </li>
                <li><input type="button" class="cod exportFile" value="{translate label='Export'} .doc"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
                </li>
                <li><input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                </li>
                <li><input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label='Nume formular' request_uri=$request_uri order_by=FormName}</td>
        <td class="bkdTitleMenu"><span class="TitleBox">Formulare</span>&nbsp;</td>
        <td class="bkdTitleMenu">{orderby label='Persoana evaluata' request_uri=$request_uri order_by=FullName}</td>
        <td class="bkdTitleMenu">{orderby label='Data inceput' request_uri=$request_uri order_by=StartDate}</td>
        <td class="bkdTitleMenu">{orderby label='Data sfarsit' request_uri=$request_uri order_by=EndDate}</td>
        <td class="bkdTitleMenu">{orderby label='Status' request_uri=$request_uri order_by=Completed}</td>
        <td class="bkdTitleMenu">{orderby label='Calificativ' request_uri=$request_uri order_by=SelfWeighted}</td>

        {if $smarty.session.USER_ID == 1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$evalForms key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$evalForms.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><b>{$item.FormName}</b></td>
                <td class="celulaMenuST">
                    {if $item.Evaluated}
                        <table cellspacing="0" cellpadding="2" width="100%">
                            <tr>
                                <td style="background-color:#F8F8F8;"><span class="TitleBox">{translate label='Formular'}</span></td>
                                <td style="background-color:#F8F8F8;"><span class="TitleBox">{translate label='Evaluator'}</span></td>
                                <td style="background-color:#F8F8F8;"><span class="TitleBox">{translate label='Status'}</span></td>
                                <td style="background-color:#F8F8F8;"><span class="TitleBox">{translate label='Calificativ'}</span></td>
                            </tr>
                            {foreach from=$item.Evaluated item=c name=iter2}
                                <tr>
                                    <td width="130" class="celulaMenuST"><a href="./?m=training&o=eval&EvalFormID={$c.EvalFormID}" class="blue"><b>deschide</b></a></td>
                                    <td width="130" class="celulaMenuST">{$c.FullName|default:'-'}</td>
                                    <td width="100" class="celulaMenuST">{if $c.Completed==1}{translate label='Incheiata'}{else}{translate label='Neincheiata'}{/if}</td>
                                    <td width="220"
                                        class="celulaMenuST">{if $c.Completed==1}{$c.SelfWeighted|default:'-'}{else}{translate label='Indisponibil pana la finalizare'}{/if}</td>
                                </tr>
                            {/foreach}
                        </table>
                    {else}
                        &nbsp;
                    {/if}
                </td>
                <td class="celulaMenuST">{$item.FullName|default:'-'}</td>
                <td class="celulaMenuST">{$item.StartDate}</td>
                <td class="celulaMenuST">{$item.EndDate}</td>
                <td class="celulaMenuST">{if $item.Completed==1}{translate label='Incheiata'}{else}{translate label='Neincheiata'}{/if}</td>
                <td class="celulaMenuST">{if $item.Completed==1}{$item.SelfWeighted|default:'-'}{else}{translate label='Indisponibil pana la finalizare'}{/if}</td>
                {if $smarty.session.USER_ID == 1 || $smarty.session.ACCESSCEVAL == 2 || $smarty.session.ACCESSCEVAL == 3}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest formular?'}')) window.location.href='{$smarty.server.REQUEST_URI}&EvalFormID={$item.EvalFormID}&action=delete'; return false;">{translate label='sterge'}</a>
                    </td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($evalForms)==1}
        <tr height="30">
            <td colspan="100" align="center" class="celulaMenuSTDR">{translate label='Nici un formular!'}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
