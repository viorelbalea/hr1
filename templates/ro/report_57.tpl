{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>
            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>
            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>
            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>
            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>

        <p style="text-align:right"><b>........... / {$smarty.now|date_format:'%d.%m.%Y'}</b></p>

        <p style="text-align:center"><strong>ADEVERINTA</strong></p>
        <br/>
        <p style="text-indent:20px;">Se adevereste prin prezenta ca {if $info.Sex == 'M'}dl{else}dna{/if} <b>{$info.FullName}</b>, avand
            CNP {$info.CNP|default:'...........................................'}, este {if $info.Sex == 'M'}salariat al{else}salariata a{/if}
            companiei {$info.CompanyName|default:'..............................'} in functia de {$info.Function|default:'...........................................'}, iar
            societatea declara pe propria raspundere ca are platite toate contributiile catre Casa de Asigurari de Sanatate in contul RO85TREZ7005502XXXXXXXXX, deschis la
            Trezoreria Operativa a Municipiului Bucuresti.</p>
        <p>{if $info.FirmAge>=1}In ultimele 12 luni{else}De cand se afla in evidenta noastra{/if} {if $info.Sex == 'M'}salariatul{else}salariata{/if} a beneficiat
            de {$info.cm_days|default:0} zile de concediu medical.</p>
        <p style="text-indent:20px;">Prezenta adeverinta se elibereaza pentru a-i servi la medicul de familie.</p>
        <br/>
        <br/>
        <table border="1" width="100%" align="center">
            <tr>
                <th>Cod de indemnizatie</th>
                <th>Numar zile concediu medical in ultimele 12 luni</th>
            </tr>
            {foreach from=$infoCM item=item key=key}
                <tr>
                    <td>{$item.CodInd}</td>
                    <td>{$item.Days}</td>
                </tr>
            {/foreach}
        </table>
        <table width="100%" align="center">
            <tr>
                <td width="50%"><strong>{$info.CompanyName|default:'.......................'}  </strong>,</td>
                <td width="50%" align="right">DATA</td>
            </tr>
            <tr>
                <td width="50%">______________________</td>
                <td width="50%" align="right">{$smarty.now|date_format:'%d.%m.%Y'}</td>
            </tr>
        </table>

    </div>
{/if}