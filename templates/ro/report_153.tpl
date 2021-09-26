{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    <table cellspacing="0" cellpadding="2">
        <tr>

            <td style="padding-left: 2px;" width="125">
                {translate label='Data'}
                <input type="text" name="SelDate" id="SelDate" class="formstyle" value="{$smarty.get.SelDate|default:$smarty.now|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                    var cal1 = new CalendarPopup();
                    cal1.isShowNavigationDropdowns = true;
                    cal1.setYearSelectStartOffset(10);
                    writeSource("js1");
                </SCRIPT>
                <A HREF="#" onClick="cal1.select(document.getElementById('SelDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                   title="{translate label='Data'}"><img src="./images/cal.png" border="0" alt="{translate label='Data'}"></A>
            </td>
            {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
                <td style="padding-left: 2px;" width="75">
                    <select id="CompanyID" name="CompanyID" class="dropdown">
                        <option value="0">{translate label='Toate Companiile'}</option>
                        {foreach from=$self key=key item=item}
                            {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                                <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{translate label=$item}</option>
                            {/if}
                        {/foreach}
                    </select>
                </td>
                <td style="padding-left: 2px;" width="75">
                    <select id="DivisionID" name="DivisionID" class="dropdown">
                        <option value="0">{translate label='Divizie'}</option>
                        {foreach from=$divisions key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{translate label=$item}</option>
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

            <td>&nbsp;</td>
            <td><input type="button" value="{translate label='Afiseaza'}"
                       onclick="window.location.href = './?m=reports&rep=153&GroupID={$smarty.get.GroupID}&CompanyID=' + document.getElementById('CompanyID').value + '&SelDate=' + document.getElementById('SelDate').value + '&DivisionID=' + document.getElementById('DivisionID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value;">
            </td>
        </tr>
    </table>
    <br>
{/if}
<table width="100%" cellspacing="0" cellpadding="2" border="1">
    <!-- Fields -->
    <tr>
        <td><b>#</b></td>
        <td><b>{translate label='nume_sal'}</b></td>
        <td><b>{translate label='prenume_sal'}</b></td>
        <td><b>{translate label='luna'}</b></td>
        <td><b>{translate label='an'}</b></td>
        <td><b>{translate label='cod'}</b></td>
        <td><b>{translate label='nume'}</b></td>
        <td><b>{translate label='prenume'}</b></td>
        <td><b>{translate label='cnp'}</b></td>
        <td><b>{translate label='hg1'}</b></td>
        <td><b>{translate label='hg2'}</b></td>
        <td><b>{translate label='cota'}</b></td>
        <td><b>{translate label='ani'}</b></td>
        <td><b>{translate label='coasigurat'}</b></td>
        <td><b>{translate label='tip'}</b></td>
    </tr>

    <!-- Values -->
    {foreach from=$persons item=person name=iter}
        <tr>
            <td>{$smarty.foreach.iter.iteration}</td>
            <td>{$person.LastName|default:'&nbsp;'}</td>
            <td>{$person.FirstName|default:'&nbsp;'}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{$person.Nume|default:'&nbsp;'}</td>
            <td>{$person.Prenume|default:'&nbsp;'}</td>
            <td>{$person.CNP|default:'&nbsp;'}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{$person.Age|default:'&nbsp;'}</td>
            <td>{$quality[$person.Calitate]|default:'&nbsp;'}</td>
            <td>&nbsp;</td>
        </tr>
        {foreachelse}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu exista inregistrari!'}</td>
        </tr>
    {/foreach}

</table>