{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>
            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>
            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>
            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>
            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>

        <p style="text-align:center"><strong>Proces verbal nr. ............/ {$smarty.now|date_format:'%d.%m.%Y'}</strong></p>
        <br/>

        <p>
            Astazi, {$smarty.now|date_format:'%d.%m.%Y'}, a fost emis prezentul proces verbal in vederea inregistrarii semnaturii,
            {if $info.Sex == 'M'}salariatului d-nul{else}salariatei d-na{/if} <b>{$info.FullName}</b>, CNP <b>{$info.CNP|default:'...........................................'}</b>,
            {if $info.Sex == 'M'}angajat al{else}angajata a{/if} companiei {$info.CompanyName|default:'..............................'} in functia
            de {$info.Function|default:'...........................................'}, <br/><br/>care a luat la cunostinta de Instructiunile pentru Respectarea Securitatii si
            Sanatatii in Munca si cele pentru Situatiile de Urgenta.</p>
        <br/>
        <br/>

        <table width="100%" align="center">
            <tr>
                <td width="50%">Data</td>
                <td width="50%" align="right">Am luat la cunostinta,</td>
            </tr>
            <tr>
                <td width="50%">______________________</td>
                <td width="50%" align="right">______________________</td>
            </tr>
        </table>

    </div>
{/if}