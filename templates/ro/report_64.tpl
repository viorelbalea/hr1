{if !empty($smarty.get.PersonID)}
    <div style="width: 800px;  margin:0px;">
    <p><b>{$info.CompanyName|default:'.......................'}</b><br/>
        <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>
        <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>
        <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>
        <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>
    <p style="text-align:center"><strong>ACT ADITIONAL nr. ..............</strong></p>
    <p>La contractul individual de munca incheiat si inregistrat sub {if $info.ContractDate|@date_format:'%Y' != '2011'}nr. .......................... (ITM)
        si {/if}nr. {$info.ContractNo|default:'.......................'} (Revisal)</p>
    <p>Incheiat astazi, {$smarty.now|date_format:'%d.%m.%Y'}, intre:</p>
    <p>Angajator - persoana juridica <strong>{$info.CompanyName|default:'..............................'}</strong>, cu sediul in
        <strong>{$info.DistrictName|default:'.......................'}</strong>, inregistrata la Registrul Comertului din
        <strong>{$info.RegComertDistrict|default:'.......................'}</strong> sub nr. <strong>{$info.RegComert|default:'.......................'}</strong>, cod fiscal
        <strong>{$info.CIF|default:'.......................'}</strong>, telefon <strong>{$info.PhoneNumberA|default:'.......................'}</strong>, reprezentata legal prin
        <strong>{$info.LegalFullName|default:'........................................'}</strong>, in calitate de <strong>director general</strong>,</p>
    <p> si </p>
    <p>{if $info.Sex == 'M'}salariatul{else}salariata{/if} <b>{$info.FullName}</b>, domiciliat{if $info.Sex == 'F'}a{/if} in
        <b>{$info.PersonAddress|default:'.............................'}</b>, {if $info.Sex == 'M'}posesor al{else}posesoare a{/if} cartii de identitate
        <strong>seria {$info.BISerie|default:'............'} nr. {$info.BINumber|default:'.......................'}</strong>, eliberata de
        <b>{$info.BIEmitent|default:'.......................'}</b>, la data de <b>{$info.BIStartDate|default:'.......................'}</b>, CNP
        <b>{$info.CNP|default:'.......................'}</b>.</p>
    <p>In temeiul art. 17 (4) coroborat cu art. 41 (1) din Legea 53/2003, partile hotarasc:</p>
    <ol>
        <li>La Contractul Individual de Munca se adauga clauza pentru formarea profesionala, clauza privind stagiile de adaptare profesionala la cerintele postului si al locului de
            munca, <strong>conform art. 20 alin. 2 lit. a din Codul Muncii</strong>.
        </li>
    </ol>
    <p><strong>{if $info.Sex == 'M'}Salariatul{else}Salariata{/if} <b>{$info.FullName}</b> va urma cursurile ................................................ in perioada
            ............-.............. <br/>Valoarea acestor cursuri de formare profesionala este de ............ RON, intreaga valoare fiind suportata de angajator - persoana
            juridica {$info.CompanyName|default:'..............................'}.</strong></p>
    <p>Prin urmare, aceasta clauza va avea urmatoarele prevederi: </p>
    <i>
    <ol style="list-style-type:lower-latin">
    <li><strong>Incepand cu data de ........, pe o perioada de ......... luni, pana la data de
    ........., {if $info.Sex == 'M'}salariatul{else}salariata{/if} {$info.FullName are obligatia de a lucra si de a-si respecta responsabilitatile postului in cadrul {$info.CompanyName|default:'..............................'}, conform art. 195 alin. 2 din Codul Muncii. </strong></li>
<li><strong>In eventualitatea in care {if $info.Sex == 'M'}salariatul - domnul{else}salariata - doamna{/if} .................. decide plecarea din functia avuta in cadrul {$info.CompanyName} va avea obligatia de a plati suma de ............. RON, contravaloarea cursurilor ...................., conform art. 195 alin. 3 din Codul Muncii.</strong></li>
</ol>
</i>

<p>Prezentul act aditional a fost incheiat in doua exemplare, cate un exemplar pentru fiecare parte, urmand sa-si produca efectele incepand cu data de ....................</p>

<table width="100%" align="center">
<tr>
<td width="50%"><strong>ANGAJATOR</strong>,</td>
<td width="50%" align="right"><strong>ANGAJAT</strong>,</td>
</tr>
<tr>
<td width="50%"><strong>{$info.CompanyName|default:'.......................'}</strong></td>
<td width="50%" align="right">{$info.FullName}</td>
</tr>
</table>

</div>
{/if}