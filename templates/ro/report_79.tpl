{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>
            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>
            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>
            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>
            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>

        <p style="text-align:right">Nr. Inregistrare ...........................................</p>
        <br/>

        <p style="text-align:center"><strong>DELEGATIE</strong></p>
        <br/>
        <p>
            Prin prezenta {$info.CompanyName|default:'.......................'}, cu sediul social
            in {$info.CompanyAddress|default:'..............................................................'}, inregistrata la Registrul Comertului sub
            nr. {$info.RegComert|default:'...................................'}, deleaga pe
            {if $info.Sex == 'M'}dl{else}dna{/if} <b>{$info.FullName}</b>, legitimat(a) cu C.I. <b>Seria {$info.BISerie|default:'.........'}
                nr. {$info.BINumber|default:'....................'}</b> eliberata de <b>{$info.BIEmitent|default:'.......................'}</b>, sa reprezinte interesele societatii
            in relatia cu .................................... .
        </p>
        <br/>
        <br/>

        <table width="100%" align="center">
            <tr>
                <td width="50%">{$info.CompanyName|default:'.......................'}</td>
                <td width="50%" align="right">Data</td>
            </tr>
            <tr>
                <td width="50%">______________________</td>
                <td width="50%" align="right">______________________</td>
            </tr>
        </table>

    </div>
{/if}