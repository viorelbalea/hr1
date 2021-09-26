{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>
            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>
            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>
            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>
            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>

        <p style="text-align:center; font-size:18px;"><strong>PROCES VERBAL DE PREDARE/PRIMIRE</strong></p>
        <br/>


        <p style="line-height:18px;">
            In perioada ......................, {if $info.Sex == 'M'}salariatul d-nul{else}salariata d-na{/if} <b>{$info.FullName}</b>, avand CNP
            <b>{$info.CNP|default:'...........................................'}</b>, a efectuat programul de lucru de {$info.WorkNorm|default:'........'} ore/zi in ............
            din cele ........... de zile lucratoare din luna.
            <br/><br/>
            {$info.CompanyName|default:'..............................'} a cumparat si a predat {if $info.Sex == 'M'}salariatului d-nul{else}salariatei d-na{/if} {$info.FullName}
            tichetele de masa in numar de .......... cu o valoare de {$info.VBonuriMasa|default:'.............'} Ron.
        </p>

        <p> Incheiat astazi, {$smarty.now|date_format:'%d.%m.%Y'}</p>
        <br/>


        <table width="100%" align="center">
            <tr>
                <td width="50%">Am predat</td>
                <td width="50%" align="right">Am primit,</td>
            </tr>
            <tr>
                <td width="50%">{$info.CompanyName|default:'.......................'}</td>
                <td width="50%" align="right">&nbsp;</td>
            </tr>
            <tr>
                <td width="50%">...............................</td>
                <td width="50%" align="right">.............................</td>
            </tr>
        </table>

    </div>
{/if}