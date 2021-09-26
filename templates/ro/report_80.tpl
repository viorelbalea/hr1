{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>
            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>
            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>
            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>
            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>

        <p style="text-align:center; font-size:18px;"><strong>NOTA DE LICHIDARE</strong></p>
        <br/>
        <table width="100%" align="center" cellspacing="0" cellpadding="0">
            <tr style="line-height:7px;">
                <td width="50%">Numele: {$info.LastName|default:'..............................'}<br/><br/></td>
                <td width="50%" valign="top">Prenumele: {$info.FirstName|default:'..............................'}</td>
            </tr>
            <tr style="line-height:7px;">
                <td colspan="2">Functia: {$info.Function|default:'..............................'}<br/><br/></td>
            </tr>
            <tr style="line-height:7px;">
                <td colspan="2">Locul de munca: {$info.CompanyName|default:'..............................'}<br/><br/></td>
            </tr>
            <tr style="line-height:7px;">
                <td colspan="2">Motivul intocmirii notei de lichidare: ..............................<br/><br/></td>
            </tr>
        </table>

        <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr>
                <td width="25%">Natura debitului <sup>2</sup></td>
                <td width="25%">Titlu executor <sup>3</sup> (natura, numarul, data, emitentul)</td>
                <td width="25%">Suma datorata la data emiterii notei de lichidare</td>
                <td width="25%">Creditorul(numele si adresa)</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>

        <p style="text-align:right;">Contabil sef,.............................................</p>
        <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr>
                <td width="33%">Natura debitului</td>
                <td width="33%">Suma datorata</td>
                <td width="34%">Suma datorata la data emiterii notei de lichidare</td>
            </tr>
            <tr>
                <td>Avansuri spre decontare</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Echipament de protectie</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Obiecte de inventar</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>

        <p>Am primit urmatoarele documente la plecare:<br/>
            - Nota de lichidare<br/>
            - Decizie de incetare contract de munca
        </p>
        <br/>
        <table width="100%" align="center">
            <tr>
                <td width="50%">Data<br/><br/></td>
                <td width="50%" align="right">Semnatura</td>
            </tr>
            <tr>
                <td width="50%">..............................................</td>
                <td width="50%" align="right">..............................................</td>
            </tr>
        </table>

    </div>
{/if}