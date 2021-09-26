{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>
            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>
            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>
            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>
            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>

        <p style="text-align:center"><strong>Declaratie</strong></p>

        <p>{if $info.Sex == 'M'}Subsemnatul{else}Subsemnata{/if} {$info.FullName},
            avand CNP <b>{$info.CNP|default:'................................'}</b>,
            {if $info.Sex == 'M'}angajat al{else}angajata a{/if} companiei {$info.CompanyName|default:'..............................'}
            declar ca sunt {if $info.Sex == 'M'}inscris{else}inscrisa{/if} la Casa de Asigurari de
            Sanatate {$health_companies[$info.HealthCompanyID]|default:'......................'}.</p>
        <br/>
        <br/>
        <br/>
        <table width="100%" align="center">
            <tr>
                <td width="50%">Data,</td>
                <td width="50%" align="right">Semnatura</td>
            </tr>
            <tr>
                <td width="50%">______________________</td>
                <td width="50%" align="right">______________________</td>
            </tr>
        </table>

    </div>
{/if}