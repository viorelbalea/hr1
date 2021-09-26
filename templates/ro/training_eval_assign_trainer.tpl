{include file="training_menu.tpl"}
<br>
<form action="{$request_uri}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Formular evaluare'}</span></td>
        </tr>
        <tr>
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
                    <legend>{translate label='Detalii formular'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0">
                        <tr>
                            <td>
                                <b>{translate label='Nume formular:'}</b>
                            </td>
                            <td>
                                <select name="EvalFormDraftID">
                                    {foreach from=$forms item=item key=key name=name}
                                        <option value="{$item.EvalFormDraftID}">{$item.FormName}</option>
                                    {/foreach}
                                </select>
                            </td>

                            <td style="padding-left: 10px;" width="250">
                                <b>{translate label='Data inceput*:'}</b> <input type="text" name="StartDate" id="StartDate" class="formstyle"
                                                                                 value="{$smarty.get.StartDate|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','yyyy-MM-dd'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="./images/cal.png" border="0"></A>&nbsp;
                            </td>
                            <td style="padding-left: 10px;" width="250">
                                <b>{translate label='Data sfarsit*:'}</b> <input type="text" name="EndDate" id="EndDate" class="formstyle"
                                                                                 value="{$smarty.get.EndDate|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.getElementById('EndDate'),'anchor2','yyyy-MM-dd'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="./images/cal.png" border="0"></A>&nbsp;
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td>
                <fieldset>
                    <legend>{translate label='Asignare persoane'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0">
                        <tr>
                            <td style="padding-left: 4px;" width="60">
                                <select id="TrainingID" name="TrainingID" class="cod"
                                        onchange="showInfo('ajax.php?o=personsbytraining&TrainingID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_Persons'); ">
                                    <option value="0"> {translate label='Selectati training'} </option>
                                    {foreach from=$trainings key=key item=item}
                                        <option value="{$item.TrainingID}"
                                                {if $item.TrainingID==$form.TrainingID}selected{/if}>{$item.TrainingName}{if $item.FullName} ({$item.FullName}){/if}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td>
                                <b>{translate label='Selectati persoana(e)*:'}</b>
                            </td>
                            <td style="padding-left: 4px;" width="150">
                                <div id="div_Persons">

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Asigneaza evaluare" class="formstyle">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">&nbsp;</span></td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    showInfo('ajax.php?o=personsbytraining&TrainingID=' + this.value + '&rand=' + parseInt(Math.random() * 999999999), 'div_Persons');
</script>