{include file="training_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="training" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.TrainingID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="training_submenu.tpl"}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare training'}</span></td>
            </tr>
        {/if}
        {if $smarty.get.msg==1 && $err->getErrors() == ""}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele trainingului au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Informatii training'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Denumire training'}:*</b></td>
                            <td><input type="text" name="TrainingName" value="{$info.TrainingName|default:''}" size="50" style="width: 350px;" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Specializare'}:</b></td>
                            <td><textarea name="Description" cols="50" rows="5" style="width: 350px;">{$info.Description|default:''}</textarea></td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-top: 10px;"><b>{translate label='Companie'}:*</b></td>
                            <td>
                                <select name="CompanyID" id="CompanyID"
                                        {literal}onchange="if (this.value > 0) {if (document.getElementById('self_' + this.value).innerHTML == '1'){ document.getElementById('divType').style.display = 'block'; } else { document.getElementById('divType').style.display = 'none'; }   showInfo('./ajax.php?o=trainingtype&addtraining=1&CompanyID=' + this.value, 'div_TrainingTypeID'); showInfo('./ajax.php?o=trainingperson&CompanyID=' + this.value, 'div_TrainingPerson'); document.getElementById('Type').checked = false;}{/literal}">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$companies key=key item=item}
                                        <option value="{$key}" {if !empty($info.CompanyID) && $key == $info.CompanyID}selected{/if}>{$item.nume}</option>
                                    {/foreach}
                                </select>

                                <div style="display:none">
                                    {foreach from=$companies key=key item=item}
                                        <span id="self_{$key}">{$item.self}</span>
                                    {/foreach}
                                </div>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-top: 10px;"><b>{translate label='Tipul de training'}:*</b></td>
                            <td>
                                <div id="div_TrainingTypeID">
                                    <select name="TrainingTypeID">
                                        <option value="0">{translate label='alege...'}</option>
                                    </select>
                                </div>
                                {assign var='self' value='0'}
                                {foreach from=$companies key=key item=item}
                                    {if !empty($info.CompanyID) && $key == $info.CompanyID}
                                        {assign var='self' value=$item.self}
                                    {/if}
                                {/foreach}

                                <div {if $self == 0} style="display:none"{/if} id="divType">
                                    <input type="checkbox" name="Type" id="Type" value="1" {if $info.Type == 1}checked{/if}
                                           onclick="if (this.checked == true) showInfo('./ajax.php?o=trainingpersonintern&PersonID=' + document.getElementById('PersonID').value + '&CompanyID=' + document.getElementById('CompanyID').value, 'div_TrainingPerson'); else showInfo('./ajax.php?o=trainingperson&CompanyID=' + document.getElementById('CompanyID').value, 'div_TrainingPerson');">
                                    intern
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Trainer'}:*</b></td>
                            <td>
                                <div id="div_TrainingPerson">
                                    <select name="PersonID" id="PersonID">
                                        <option value="0">{translate label='alege...'}</option>
                                    </select>
                                </div>
                                {if !empty($info.CompanyID)}
                                    <script language="javascript">
                                        showInfo('./ajax.php?o=trainingtype&addtraining=1&CompanyID={$info.CompanyID}&TrainingTypeID={$info.TrainingTypeID}', 'div_TrainingTypeID');
                                        {if $info.Type == 1}
                                        showInfo('./ajax.php?o=trainingpersonintern&PersonID={$info.PersonID}&CompanyID={$info.CompanyID}', 'div_TrainingPerson');
                                        {else}
                                        showInfo('./ajax.php?o=trainingperson&CompanyID={$info.CompanyID}&PersonID={$info.PersonID}', 'div_TrainingPerson');
                                        {/if}
                                    </script>
                                {/if}
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data de inceput'}*:</b></td>
                            <td>
                                <input type="text" name="StartDate" class="formstyle" value="{$info.StartDate|default:$smarty.now|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.training.StartDate,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="./images/cal.png" border="0"/></A>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Valabil pana la'}*:</b></td>
                            <td>
                                <input type="text" name="StopDate" class="formstyle" value="{$info.StopDate|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.training.StopDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="./images/cal.png" border="0"/></A>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Judet'}:</b></td>
                            <td>
                                <select id="DistrictID" name="DistrictID"
                                        onchange="if (this.value > 0) showInfo('ajax.php?o=city&districtID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_CityID');">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$districts key=key item=item}
                                        <option value="{$key}" {if !empty($info.DistrictID) && $key == $info.DistrictID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-top: 10px;"><b>{translate label='Localitate'}:</b></td>
                            <td>
                                <div id="div_CityID">
                                    <select name="CityID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$cities key=key item=item}
                                            <option value="{$key}" {if !empty($info.CityID) && $key == $info.CityID}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                {if !empty($info.DistrictID)}
                                    <script language="javascript">showInfo('./ajax.php?o=city&districtID={$info.DistrictID}&CityID={$info.CityID}', 'div_CityID');</script>
                                {/if}
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Status training'}:*</b></td>
                            <td>
                                <select name="Status">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$status key=key item=item}
                                        <option value="{$key}" {if !empty($info.Status) && $key == $info.Status}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Cost training'}:</b></td>
                            <td><input type="text" name="Cost" value="{if $info.CostType=='total'}{$info.CostTotal}{else}{$info.Cost}{/if}" size="10" maxlength="10">

                                <select id="Currency" name="Currency">
                                    {foreach from=$currencies item=curr}
                                        <option value="{$curr}"
                                                {if (!empty($info.Currency) && ($curr == $info.Currency)) || (empty($info.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                    {/foreach}
                                </select>&nbsp;/
                                <select id="CostType" name="CostType">
                                    <option value="person" {if $info.CostType=='person'} selected="selected" {/if}>{translate label='persoana'}</option>
                                    <option value="total" {if $info.CostType=='total'} selected="selected" {/if}>{translate label='total'}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Perioda efectiva'}:</b></td>
                            <td><input type="text" name="Hours" value="{$info.Hours}" size="10" maxlength="10"> {translate label='(ore pe trainining)'}</td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                {if !empty($smarty.get.TrainingID)}
                    {if $info.rw == 1 || !empty($smarty.post)}
                        <div align="center">
                            <input type="submit" value="{translate label='Salveaza'}" class="formstyle">
                            <input type="button" value="{translate label='Anuleaza'}" onclick="history.back();" class="formstyle">
                        </div>
                    {/if}
                {else}
                    <div align="center">
                        <input type="submit" value="{translate label='Adauga training'}" class="formstyle">
                        <input type="button" value="{translate label='Anuleaza'}" onclick="history.back();" class="formstyle">
                    </div>
                {/if}
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 20px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Observatii'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Observatii'}:</b></td>
                            <td><textarea name="Notes" rows="8" cols="50">{$info.Notes|default:''}</textarea></td>
                        </tr>
                        {if !empty($customfields.CustomTraining1)}
                            <tr>
                                <td><b>{$customfields.CustomTraining1}:</b></td>
                                <td><input type="text" name="CustomTraining1" value="{$info.CustomTraining1|default:''}" size="30" maxlength="255"></td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomTraining2)}
                            <tr>
                                <td><b>{$customfields.CustomTraining2}:</b></td>
                                <td><input type="text" name="CustomTraining2" value="{$info.CustomTraining2|default:''}" size="30" maxlength="255"></td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomTraining3)}
                            <tr>
                                <td><b>{$customfields.CustomTraining3}:</b></td>
                                <td>
                                    <input type="text" id="CustomTraining3" name="CustomTraining3" class="formstyle"
                                           value="{if !empty($info.CustomTraining3) && $info.CustomTraining3 != '0000-00-00 00:00:00'}{$info.CustomTraining3|date_format:"%d.%m.%Y"}{/if}"
                                           size="10" msxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomTraining3">
                                        var cal_CustomTraining3 = new CalendarPopup();
                                        cal_CustomTraining3.isShowNavigationDropdowns = true;
                                        cal_CustomTraining3.setYearSelectStartOffset(10);
                                        //writeSource("js_CustomTraining3");
                                    </SCRIPT>
                                    <A HREF="#"
                                       onClick="cal_CustomTraining3.select(document.getElementById('CustomTraining3'),'anchor_CustomTraining3','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomTraining3" ID="anchor_CustomTraining3"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
                {if !empty($smarty.get.TrainingID)}
                    <br>
                    <fieldset>
                        <legend>{translate label='Angajati'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {foreach from=$training_persons item=item}
                                <tr>
                                    <td>
                                        <select id="persons_{$item}" name="persons[{$item}]">
                                            {foreach from=$persons key=key2 item=item2}
                                                <option value="{$key2}" {if $item==$key2}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                        {if $info.rw == 1 || !empty($smarty.post)}<a href="#"
                                                                                     onclick="if (confirm('{translate label='Sunteti sigur(a)?'}') && document.getElementById('persons_{$item}').value>0) window.location.href='./?m=training&o=edit&TrainingID={$smarty.get.TrainingID}&action=del&PersonID=' + document.getElementById('persons_{$item}').value; return false;">{translate label='sterge'}</a>{/if}
                                    </td>
                                </tr>
                            {/foreach}
                            {if $info.rw == 1 || !empty($smarty.post)}
                                <tr>
                                    <td>
                                        <select id="persons_0" name="persons[0]">
                                            <option value="0">{translate label='alege angajat'}</option>
                                            {foreach from=$persons key=key2 item=item2}
                                                {if !in_array($key2, $training_persons)}
                                                    <option value="{$key2}">{$item2}</option>
                                                {/if}
                                            {/foreach}
                                        </select>
                                        <a href="#"
                                           onclick="if (document.getElementById('persons_0').value>0) window.location.href='./?m=training&o=edit&TrainingID={$smarty.get.TrainingID}&action=add&PersonID=' + document.getElementById('persons_0').value; return false;">{translate label='adauga '}</a>
                                    </td>
                                </tr>
                            {/if}
                        </table>
                        <br>
                        {translate label='Cost Total'}: {$info.CostTotal}&nbsp;{$info.Currency}
                        <br/>
                        {translate label='Cost pe Persona'}: {$info.Cost}&nbsp;{$info.Currency}
                    </fieldset>
                {/if}
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>

{literal}
<script type="text/javascript">
    function validateForm(f) {
        return checkDate(f.StartDate.value, 'Data de inceput este obligatorie') &&
            checkDate(f.StopDate.value, 'Valabil pana la este obligatoriu')
                {/literal}{if !empty($customfields.CustomTraining3)} && (is_empty(f.CustomTraining3.value) ? true : checkDate(f.CustomTraining3.value, '{$customfields.CustomTraining3}')){/if}{literal}
            ;
    }
</script>
{/literal}