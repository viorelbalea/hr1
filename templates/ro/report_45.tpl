{if !empty($smarty.get.PersonID)}
    <div style="width: 800px">

        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>
            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>
            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>
            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>
            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>

        <p align="right">Exemplar I. Se inmaneaza persoanei incadrate</p>

        <h1 style="text-align: center;">Nota de lichidare</h1>
        <div style="text-align: center;"><b>nr ......... / {$smarty.now|date_format:'%d.%m.%Y'}</b></div>
        <br>

        <br>
        Nume si prenume <b>{$info.FullName}</b>
        <br>
        Nr. marca <b>{$info.EmpCode|default:'..........'}</b>,&nbsp;&nbsp;&nbsp;Functia <b>{$info.Function|default:'............................................'}</b>
        <br>
        Posesor al carnetului de munca: nr. {$info.ContractNo|default:'...............'}
        / {if !empty($info.ContractDate) && $info.ContractDate != '0000-00-00'}{$info.ContractDate|date_format:'%d.%m.%Y'}{else}................................{/if}
        <br>
        Motivul intocmirii notei de lichidare: incetare contract individual de munca cf. {$info.Law|default:'Art....... alin....... lit........'} *)
        de la data de <b>{if !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.StopDate|date_format:'%d.%m.%Y'}{else}...........................{/if}</b>
        <br><br>
        *) Se scrie motivul lichidarii: incetarea contractului individual de munca conform {$info.Law|default:'Art....... alin....... lit........'} din Codul Muncii.
        <br><br>
        <table cellpacing="0" cellpadding="4" border="1">
            <tr>
                <td><b>Natura debitului *)</b></td>
                <td><b>Titlul executor **)</b><br>(natura, numarul, data, emitentul)</td>
                <td><b>Suma datorata la data emiterii notei de lichidare</b></td>
                <td><b>Creditorul</b><br>(nume si prenume)</td>
            </tr>
            {foreach from=$info.inventar item=item}
                <tr>
                    <td><b>{$item}</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            {/foreach}
        </table>
        <br><br>
        <p align="center">________________________<br>Sef Compartiment Financiar-Contabil***)</p>

        _________________________________________________________________________________
        <br>
        *) imputatie, despagubire, suma datorata pentru marfuri cu plata in rate, suma datorata cu titlu de intretinere, imprumut C.A.R. etc.
        <br>
        **) dispozitie de intretinere, hotarare judecatoreasca, angajament. In cazul cand nu exista un titlu executor se va face mentiunea "in curs de obtinere"
        <br>
        ***) se semneaza dupa completarea datelor de pe verso.


    </div>
{/if}