{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    <table cellspacing="0" cellpadding="2">
        <tr>
            <td>{translate label='An'}*:</td>
            <td>
                <select name="Year" id="Year">
                    <option value="0">{translate label='alege...'}</option>
                    {foreach from=$years key=key item=item}
                        <option value="{$item}" {if $smarty.get.Year == $item}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            </td>
            <td> &nbsp; &nbsp; {translate label='Luna'}*:
                <select name="Month" id="Month">
                    <option value="0">{translate label='alege...'}</option>
                    {foreach from=$months key=key item=item}
                        <option value="{$item}" {if $smarty.get.Month == $item}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            </td>
            <td>
                &nbsp;&nbsp;{translate label='Include lunile anterioare'}<input type="checkbox" name="PrevMonths" id="PrevMonths"
                                                                                value="1" {if $smarty.get.PrevMonths==1} checked="checked"{/if} />
            </td>

            {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
                <td style="padding-left: 2px;" width="75">
                    <select id="CompanyID" name="CompanyID" class="dropdown">
                        <option value="0">{translate label='Companie self'}</option>
                        {foreach from=$self key=key item=item}
                            {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                                <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{translate label=$item}</option>
                            {/if}
                        {/foreach}
                    </select>
                </td>
                <td style="padding-left: 2px;" width="75">
                    <select id="DepartmentID" name="DepartmentID" class="dropdown">
                        <option value="0">{translate label='Departament'}</option>
                        {foreach from=$departments key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{translate label=$item}</option>
                        {/foreach}
                    </select>
                </td>
            {/if}


            <td style="padding-left: 2px;" width="75">
                <select id="SalaryType" name="SalaryType" class="dropdown">
                    <option value="0">{translate label='Tip salariu'}</option>
                    {foreach from=$salary_types key=key item=item}
                        <option value="{$key}" {if $key==$smarty.get.SalaryType}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            </td>
            <td>&nbsp;</td>
            <td><input type="button" value="{translate label='Afiseaza'}"
                       onclick="window.location.href = './?m=reports&rep=117&GroupID={$smarty.get.GroupID}&CompanyID=' + document.getElementById('CompanyID').value +
                               '&Year=' + document.getElementById('Year').value +
                               '&Month=' + document.getElementById('Month').value +
                               '&DepartmentID=' + document.getElementById('DepartmentID').value +
                               '&SalaryType=' + document.getElementById('SalaryType').value +
                               '&showSalary=' + (document.getElementById('showSalary').checked == true ? '1' : '0') +
                               '&showBonus=' + (document.getElementById('showBonus').checked == true ? '1' : '0') +
                               '&showPrime=' + (document.getElementById('showPrime').checked == true ? '1' : '0') +
                               '&showOT=' + (document.getElementById('showOT').checked == true ? '1' : '0') +
                               '&showTotal=' + (document.getElementById('showTotal').checked == true ? '1' : '0')+
                               '&PrevMonths=' + (document.getElementById('PrevMonths').checked == true ? '1' : '0')
                               "></td>
        </tr>
        <tr>
            <td>{translate label='Afiseaza'}:</td>
            <td style="padding-left: 2px;" width="500" colspan="10">
                {translate label='Salariu'}<input type="checkbox" name="showSalary" id="showSalary"
                                                  value="1" {if $smarty.get.showSalary==1 || $smarty.get.showSalary=='' } checked="checked"{/if} />&nbsp;&nbsp;
                {translate label='Bonusuri'}<input type="checkbox" name="showBonus" id="showBonus"
                                                   value="1" {if $smarty.get.showBonus==1 || $smarty.get.showBonus=='' } checked="checked"{/if} />&nbsp;&nbsp;
                {translate label='Prime'}<input type="checkbox" name="showPrime" id="showPrime"
                                                value="1" {if $smarty.get.showPrime==1 || $smarty.get.showPrime=='' } checked="checked"{/if} />&nbsp;&nbsp;
                {translate label='Ore suplimentare'}<input type="checkbox" name="showOT" id="showOT"
                                                           value="1" {if $smarty.get.showOT==1 || $smarty.get.showOT=='' } checked="checked"{/if} />&nbsp;&nbsp;
                {translate label='Total lunar'}<input type="checkbox" name="showTotal" id="showTotal"
                                                      value="1" {if $smarty.get.showTotal==1 || $smarty.get.showTotal=='' } checked="checked"{/if} />
            </td>
        </tr>
    </table>
    <br>
{/if}

{assign var="colspan" value=0}
{if !empty($smarty.get.showSalary)} {assign var="colspan" value=$colspan+1} {/if}
{if !empty($smarty.get.showBonus)} {assign var="colspan" value=$colspan+1} {/if}
{if !empty($smarty.get.showPrime)} {assign var="colspan" value=$colspan+1} {/if}
{if !empty($smarty.get.showOT)} {assign var="colspan" value=$colspan+1} {/if}
{if !empty($smarty.get.showTotal)} {assign var="colspan" value=$colspan+1} {/if}

{if !empty($smarty.get.Year) && !empty($smarty.get.Month)}
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
            <td><b>#</b></td>
            <td align="center">{translate label='Departament'}</span></td>
            <td align="center">{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)}{translate label='Nume'}{else}{orderby label='Nume' request_uri=$request_uri order_by=FullName asc_or_desc=asc}{/if}</td>

            {foreach from=$months_list key=key item=item name=iter}
                <td align="center">
                    <table width="100%" cellspacing="0" cellpadding="2" border="0">
                        <tr>
                            <td align="center" colspan="{$colspan}" style="border:none;">{$item}</td>
                        </tr>
                        <tr>
                            {if !empty($smarty.get.showSalary)}
                                <td align="center" nowrap="nowrap"
                                    width="50"{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)} style="background-color: #00CCFF;"{/if}>{translate label='Salariu lunar'}</td>{/if}
                            {if !empty($smarty.get.showBonus)}
                                <td align="center" nowrap="nowrap"
                                    width="50"{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)} style="background-color: #00CCFF;"{/if}>{translate label='Bonusuri'}</td>{/if}
                            {if !empty($smarty.get.showPrime)}
                                <td align="center" nowrap="nowrap"
                                    width="50"{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)} style="background-color: #00CCFF;"{/if}>{translate label='Prime'}</td>{/if}
                            {if !empty($smarty.get.showOT)}
                                <td align="center" nowrap="nowrap"
                                    width="50"{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)} style="background-color: #00CCFF;"{/if}>{translate label='Valoare ore sup.'}</td>{/if}
                            {if !empty($smarty.get.showTotal)}
                                <td align="center" nowrap="nowrap"
                                    width="50"{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)} style="background-color: #00CCFF;"{/if}>{translate label='Total luna'}</td>{/if}
                        </tr>
                    </table>
                </td>
            {/foreach}
            {if !empty($smarty.get.showSalary)}
                <td align="left" nowrap="nowrap"
                    width="50"{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)} style="background-color: #00CCFF;"{/if}>{translate label='Salariu lunar'}</td>{/if}
            {if !empty($smarty.get.showBonus)}
                <td align="left" nowrap="nowrap"
                    width="50"{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)} style="background-color: #00CCFF;"{/if}>{translate label='Bonusuri'}</td>{/if}
            {if !empty($smarty.get.showPrime)}
                <td align="left" nowrap="nowrap"
                    width="50"{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)} style="background-color: #00CCFF;"{/if}>{translate label='Prime'}</td>{/if}
            {if !empty($smarty.get.showOT)}
                <td align="left" nowrap="nowrap"
                    width="50"{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)} style="background-color: #00CCFF;"{/if}>{translate label='Valoare ore suplimentare'}</td>{/if}
            {if !empty($smarty.get.showTotal)}
                <td align="left" nowrap="nowrap"
                    width="50"{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)} style="background-color: #00CCFF;"{/if}>{translate label='Total luna'}</td>{/if}

        </tr>
        {assign var="iteration" value=0}
        {foreach from=$persons key=key item=item name=iter}
            {assign var="iteration" value=$iteration+1}
            <tr height="30">
                <td>{$iteration}</td>
                <td align="left">{$item.Department|default:'&nbsp;'}</td>
                <td align="left">{$item.FullName|default:'&nbsp;'}</td>
                {foreach from=$months_list key=xkey item=xitem name=iter}
                    <td align="center">
                        <table width="100%" height="30" cellspacing="0" cellpadding="2" border="0">
                            <tr>
                                {if !empty($smarty.get.showSalary)}
                                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.0.$key.MonthSalary|default:'0'}</td>{/if}
                                {if !empty($smarty.get.showBonus)}
                                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.0.$key.SBonus|default:'0'}</td>{/if}
                                {if !empty($smarty.get.showPrime)}
                                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.0.$key.SPremium|default:'0'}</td>{/if}
                                {if !empty($smarty.get.showOT)}
                                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.0.$key.OT|default:'0'}</td>{/if}
                                {if !empty($smarty.get.showTotal)}
                                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.0.$key.FinancialBenefits|default:'0'}</td>{/if}
                            </tr>
                        </table>
                    </td>
                {/foreach}
                {if !empty($smarty.get.showSalary)}
                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$persons_totals.$key.MonthSalary|default:'0'}</td>{/if}
                {if !empty($smarty.get.showBonus)}
                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$persons_totals.$key.SBonus|default:'0'}</td>{/if}
                {if !empty($smarty.get.showPrime)}
                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$persons_totals.$key.SPremium|default:'0'}</td>{/if}
                {if !empty($smarty.get.showOT)}
                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$persons_totals.0.$key.OT|default:'0'}</td>{/if}
                {if !empty($smarty.get.showTotal)}
                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$persons_totals.$key.FinancialBenefits|default:'0'}</td>{/if}
            </tr>
        {/foreach}

        {if !empty($smarty.get.export)}
            <tr></tr>
        {/if}
        {if count($persons) > 0}
            {foreach from=$listed_departments key=key item=item}
                <tr>
                    <td align="center" colspan="3">{translate label=$item|default:'&nbsp;'}</td>
                    {foreach from=$months_list key=xkey item=xitem name=iter}
                        <td align="center">
                            <table width="100%" cellspacing="0" cellpadding="2" border="0">
                                <tr>
                                    {if !empty($smarty.get.showSalary)}
                                        <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.1.$key.MonthSalary|default:'&nbsp;'}</td>{/if}
                                    {if !empty($smarty.get.showBonus)}
                                        <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.1.$key.SBonus|default:'&nbsp;'}</td>{/if}
                                    {if !empty($smarty.get.showPrime)}
                                        <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.1.$key.SPremium|default:'&nbsp;'}</td>{/if}
                                    {if !empty($smarty.get.showOT)}
                                        <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.1.$key.OT|default:'&nbsp;'}</td>{/if}
                                    {if !empty($smarty.get.showTotal)}
                                        <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.1.$key.FinancialBenefits|default:'&nbsp;'}</td>{/if}
                                </tr>
                            </table>
                        </td>
                    {/foreach}
                    {if !empty($smarty.get.showSalary)}
                        <td align="left" width="50" style="border-right:solid 1px #CCC;">{$sums_totals.$key.MonthSalary|default:'&nbsp;'}</td>{/if}
                    {if !empty($smarty.get.showBonus)}
                        <td align="left" width="50" style="border-right:solid 1px #CCC;">{$sums_totals.$key.SBonus|default:'&nbsp;'}</td>{/if}
                    {if !empty($smarty.get.showPrime)}
                        <td align="left" width="50" style="border-right:solid 1px #CCC;">{$sums_totals.$key.SPremium|default:'&nbsp;'}</td>{/if}
                    {if !empty($smarty.get.showOT)}
                        <td align="left" width="50" style="border-right:solid 1px #CCC;">{$sums_totals.$key.OT|default:'&nbsp;'}</td>{/if}
                    {if !empty($smarty.get.showTotal)}
                        <td align="left" width="50" style="border-right:solid 1px #CCC;">{$sums_totals.$key.FinancialBenefits|default:'&nbsp;'}</td>{/if}
                </tr>
            {/foreach}
            <tr>
                <td align="center" colspan="3">{translate label='TOTAL'}</td>
                {foreach from=$months_list key=xkey item=xitem name=iter}
                    <td align="center">
                        <table width="100%" cellspacing="0" cellpadding="2" border="0">
                            <tr>
                                {if !empty($smarty.get.showSalary)}
                                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.2.MonthSalary}</td>{/if}
                                {if !empty($smarty.get.showBonus)}
                                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.2.SBonus|default:'&nbsp;'}</td>{/if}
                                {if !empty($smarty.get.showPrime)}
                                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.2.SPremium|default:'&nbsp;'}</td>{/if}
                                {if !empty($smarty.get.showOT)}
                                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.2.OT|default:'&nbsp;'}</td>{/if}
                                {if !empty($smarty.get.showTotal)}
                                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$results.$xitem.2.FinancialBenefits|default:'&nbsp;'}</td>{/if}
                            </tr>
                        </table>
                    </td>
                {/foreach}
                {if !empty($smarty.get.showSalary)}
                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$totals_totals.MonthSalary}</td>{/if}
                {if !empty($smarty.get.showBonus)}
                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$totals_totals.SBonus|default:'&nbsp;'}</td>{/if}
                {if !empty($smarty.get.showPrime)}
                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$totals_totals.SPremium|default:'&nbsp;'}</td>{/if}
                {if !empty($smarty.get.showOT)}
                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$totals_totals.OT|default:'&nbsp;'}</td>{/if}
                {if !empty($smarty.get.showTotal)}
                    <td align="left" width="50" style="border-right:solid 1px #CCC;">{$totals_totals.FinancialBenefits|default:'&nbsp;'}</td>{/if}
            </tr>
        {else}
            <tr height="30">
                <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
            </tr>
        {/if}
    </table>
{/if}