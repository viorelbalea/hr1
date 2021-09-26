<div class="submeniu">
    <a href="./?m=eval&o=forms" class="selected">{translate label='Lista evaluari'}</a>
    {if $smarty.session.USER_ID == 1 || $smarty.session.ACCESSEVAL == 1 || $smarty.session.ACCESSEVAL == 3}
        <a href="./?m=eval&o=formsDraft" class="unselected">{translate label='Formulare evaluare'}</a>
        <a href="./?m=eval&o=evalDraft&action=new" class="unselected">{translate label='Adauga formular evaluare'}</a>
        <a href="./?m=eval&o=evalAssign" class="unselected">{translate label='Asignare evaluare'}</a>
    {/if}
    <a href="./?m=eval&o=evalPersons" class="unselected">{translate label='Evaluari angajati'}</a>
</div>

<div id="layer_co" class="layer" style='display:none'>
    <div class="eticheta">
        {$eticheta}
    </div>
    <h3 class="layer">{translate label='Alegere tip view'}</h3>
    <div align='center' class="observatiiTextbox">
        <div style='display: inline-block; margin:0 auto'>
            <input id='radNormal' type="radio" name="viewType" value="Normal" checked="checked"><br>
            <img src="photos/companies/normal.png" style="border: 1px solid rgb(102, 102, 102); margin-left: 10px; padding: 2px;">
        </div>
        <div style='display: inline-block; margin: 0 auto'>
            <input id='radCEB' type="radio" name="viewType" value="CEB"><br>
            <img src="photos/companies/ceb.png" style="border: 1px solid rgb(102, 102, 102); margin-left: 10px; padding: 2px;">
        </div>
        <input id="EvalFormID" type='hidden' name='EvalFormID' value="">

    </div>

    <div class="saveObservatii">
        <input type="button" value="{translate label='Afiseaza'}" onclick="setPage();">
        <input type="button" value="{translate label='Anuleaza'}"
               onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
    </div>
</div>
<!---->
<div id="layer_co_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
</div>

<div class="filter">
    <label>{translate label='Cauta: '}</label>
    <select id="PersonID" name="PersonID" class="dropdown">
        <option value="0">{translate label='Persoane evaluate'}</option>
        {foreach from=$persons key=key item=item}
            {if $key>0}
                <option value="{$item.PersonID}"
                        {if $item.PersonID==$smarty.get.PersonID}selected{/if}>{$item.FullName}</option>
            {/if}
        {/foreach}
    </select>
    <td width="250">
        <label>{translate label='Status'}</label>
        <select id="Completed" name="Completed" class="dropdown">
            <option {if $smarty.get.Completed=='all'}selected{/if} value="all">{translate label='Status'}</option>
            <option {if $smarty.get.Completed=='0'}selected{/if} value="0">{translate label='neincheiate'}</option>
            <option {if $smarty.get.Completed=='1'}selected{/if} value="1">{translate label='incheiate'}</option>
        </select>
        <label>De la data de inceput</label>
        <input type="text" name="StartDate" id="StartDate" class="formstyle"
               value="{$smarty.get.StartDate|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10"/>
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <label><A HREF="#"
                  onClick="cal1.select(document.getElementById('StartDate'),'anchor1','yyyy-MM-dd'); return false;"
                  NAME="anchor1" ID="anchor1"><img src="./images/cal.png" border="0"></A></label>

        <label>pana la data de sfarsit</label>
        <input type="text" name="EndDate" id="EndDate" class="formstyle"
               value="{$smarty.get.EndDate|default:''|date_format:"%Y-%m-%d"}" size="10"
               maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <label><A HREF="#" onClick="cal1.select(document.getElementById('EndDate'),'anchor2','yyyy-MM-dd'); return false;"
                  NAME="anchor2" ID="anchor2"><img src="./images/cal.png" border="0"></A></label>
        <input type="button" value="Cauta" class="cod"
               onclick="window.location.href = './?m=eval&o=forms&PersonID=' + document.getElementById('PersonID').value + '&Completed=' + document.getElementById('Completed').value + '&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value + '&res_per_page=' + document.getElementById('res_per_page').value">
        <select id="res_per_page" nume="res_per_page" class="cod">
            {foreach from=$res_per_pages item=item}
                <option value="{$item}"
                        {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
            {/foreach}
        </select> <label>inregistrari</label><br/>

        <div class="outputZone outputZoneOne">
            <div>
                <ul>
                    <li class="header"><label>{translate label='Output'}</label></li>
                    <li>
                        <input type="button" class="cod exportFile" value="Export .xls"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
                    </li>
                    <li>
                        <input type="button" class="cod exportFile" value="Export .doc"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
                    </li>
                    <li>
                        <input type="button" class="cod printFile" value="Printeaza pagina"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                    </li>
                    <li>
                        <input type="button" class="cod printFile" value="Printeaza tot"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                    </li>
                </ul>
            </div>
        </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>

        <td class="bkdTitleMenu"
            colspan="2">{orderby label='Nume formular' request_uri=$request_uri order_by=FormName}</td>

        <td class="bkdTitleMenu">{orderby label='Persoana evaluata' request_uri=$request_uri order_by=FullName}</td>
        <td class="bkdTitleMenu">{orderby label='Functie evaluata' request_uri=$request_uri order_by=Function}</td>
        <td class="bkdTitleMenu">{orderby label='Functie interna' request_uri=$request_uri order_by=InternalFunction}</td>
        <td class="bkdTitleMenu">{orderby label='Data inceput' request_uri=$request_uri order_by=StartDate}</td>
        <td class="bkdTitleMenu">{orderby label='Data sfarsit' request_uri=$request_uri order_by=EndDate}</td>
        <td class="bkdTitleMenu">{orderby label='Status' request_uri=$request_uri order_by=Completed}</td>
        <td class="bkdTitleMenu">{orderby label='Status aprobare' request_uri=$request_uri order_by=Approved}</td>
        <td class="bkdTitleMenu">{orderby label='Status mediere' request_uri=$request_uri order_by=Mediated}</td>
        <td class="bkdTitleMenu">{orderby label='Calificativ autoevaluare' request_uri=$request_uri order_by=SelfWeighted}</td>
        <td class="bkdTitleMenu">{orderby label='Calificativ evaluator' request_uri=$request_uri order_by=ManagerWeighted}</td>

        <td class="bkdTitleMenu">{orderby label='Calificativ evaluator 2' request_uri=$request_uri order_by=ManagerWeighted2}</td>

        <td class="bkdTitleMenu">{orderby label='Calificativ mediator' request_uri=$request_uri order_by=MediatorWeighted}</td>
        {if $smarty.session.USER_ID == 1 || $smarty.session.ACCESSEVAL == 2 || $smarty.session.ACCESSEVAL == 3}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$evalForms key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$evalForms.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a onclick="setVisible({$item.EvalFormID})"
                                            class="blue"><b>{$item.FormName}</b></a></td>

                <td class="celulaMenuST"><a style="color:#000;" href='#'
                                            onclick="javascript:popUp('./?m=eval&o=graph_eval&DraftID={$item.EvalFormDraftID}&PersonID={$item.PersonID}{if !empty($smarty.get.StartDate)}&StartDate={$smarty.get.StartDate}{/if}{if !empty($smarty.get.EndDate)}&EndDate={$smarty.get.EndDate}{/if}','Evaluare',800,700); return false;"
                                            title='Vezi grafic'><img src='images/graph.png' align='absbottom'
                                                                     alt='Vezi grafic'></a></td>

                <td class="celulaMenuST">{$item.FullName|default:'-'}</td>
                <td class="celulaMenuST">{$item.Function|default:'-'}</td>
                <td class="celulaMenuST">{$item.InternalFunction|default:'-'}</td>
                <td class="celulaMenuST">{$item.StartDate}</td>
                <td class="celulaMenuST">{$item.EndDate}</td>
                <td class="celulaMenuST">{if $item.Completed==1}Incheiata{else}Neincheiata{/if}</td>
                <td class="celulaMenuST">{if $item.Approved==1}Aprobata{else}Neaprobata{/if}</td>
                <td class="celulaMenuST">
                    {if $item.Mediated==0}
                        {if ($smarty.session.ACCESSEVAL == 2 || $smarty.session.ACCESSEVAL == 3) && $item.Completed==1 && $item.Approved==1}
                            <input type="checkbox" id="SetMediation" value="1" {if $item.Mediated==1} checked{/if} />
                            <a href="#" class="blue"
                               onclick="window.location.href = '{$smarty.server.REQUEST_URI}&action=set_mediation&EvalFormID={$item.EvalFormID}&Status=' + (document.getElementById('SetMediation').checked ? 1 : 0); return false;">{translate label='Seteaza'}</a>
                        {else}
                            -
                        {/if}
                    {elseif $item.Mediated==1}
                        {if ($smarty.session.ACCESSEVAL == 2 || $smarty.session.ACCESSEVAL == 3) && $item.Completed==1 && $item.Approved==1}
                            <input type="checkbox" id="SetMediation" value="1" {if $item.Mediated==1} checked{/if} />
                            <a href="#" class="blue"
                               onclick="window.location.href = '{$smarty.server.REQUEST_URI}&action=set_mediation&EvalFormID={$item.EvalFormID}&Status=' + (document.getElementById('SetMediation').checked ? 1 : 0); return false;">{translate label='Seteaza'}</a>
                        {else}
                            {translate label='In curs de mediere'}
                        {/if}
                    {elseif $item.Mediated==2}
                        {translate label='Mediere incheiata'}
                    {/if}

                </td>

                <td class="celulaMenuST">{if $item.Approved==1}{$item.SelfWeighted|default:'-'}{else}{translate label='Indisponibil pana la '}
                        <br/>
                        {translate label='aprobare'}{/if}</td>
                <td class="celulaMenuST">{if $item.Approved==1}{$item.ManagerWeighted|default:'-'}{else}{translate label='Indisponibil pana la '}
                        <br/>
                        {translate label='aprobare'}{/if}</td>

                <td class="celulaMenuST">{if $item.Approved2==1}{$item.ManagerWeighted2|default:'-'}{else}{translate label='Indisponibil pana la '}
                        <br/>
                        {translate label='aprobare secundara'}{/if}</td>

                <td class="celulaMenuST">{if $item.Mediated==2}{$item.MediatorWeighted|default:'-'}{elseif $item.Mediated==1}{translate label=' '}In curs de mediere{elseif $item.Mediated==0}-{/if}</td>
                {if $smarty.session.USER_ID == 1 || $smarty.session.ACCESSEVAL == 2 || $smarty.session.ACCESSEVAL == 3}
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

{literal}
    <script type="text/javascript">
        function setPage() {
            if (document.getElementById('radNormal').checked) {
                var viewType = document.getElementById('radNormal').value;
            }

            if (document.getElementById('radCEB').checked) {
                var viewType = document.getElementById('radCEB').value;
            }

            var evalID = document.getElementById('EvalFormID').value;
            if (viewType === 'Normal') {
                window.location.href = './?m=eval&o=eval&EvalFormID=' + evalID + '&view=normal'
            } else {
                window.location.href = './?m=eval&o=eval&EvalFormID=' + evalID + '&view=CEB'
            }
        }

        function setVisible(EvalFormID) {
            document.getElementById('EvalFormID').value = EvalFormID;
            document.getElementById('layer_co').style.display = 'block';
            document.getElementById('layer_co_x').style.display = 'block';
        }

        <!---->
    </script>
{/literal}
