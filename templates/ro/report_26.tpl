{if !empty($smarty.get.PersonID)}
    <div style="width: 800px">

        <b>{translate label='Denumire angajator / institutie: '}</b>{$info.CompanyName|default:'.......................................................................................'}
        <br/>
        <b>{translate label='Sediu angajator / institutie: '}</b>{$info.CompanyAddress|default:'.....................................................................'}<br/>
        <b>{translate label='Nr. O.R.C.: '}</b>{$info.RegComert|default:'............................................'}<br/>
        <b>{translate label='Cod Fiscal: '}</b>{$info.CIF|default:'.....................................'}<br/>
        <b>{translate label='Telefon / fax: '}</b>{$info.PhoneNumberA|default:'......................................'}
        / {$info.FaxNumber|default:'........................................'}

        <h1 style="text-align: center;">{translate label='ADEVERINTA<'}/h1>
            <div style="text-align: center;"><b>nr ......... / {$smarty.now|date_format:'%d.%m.%Y'}</b></div>
            <br>

            {translate label=' '}Se adevereste prin prezenta ca {if $info.Sex == 'M'}domnul{else}doamna{/if} {$info.FullName},
            {translate label=' '}CNP {$info.CNP}, {if $info.Sex == 'M'}domiciliat{else}domiciliata{/if} in localitatea {$info.PersonCityName},
            {translate label=' '}str. {$info.PersonStreetName}, nr. {$info.PersonStreetNumber},{translate label=' '} bl. {$info.PersonBl},
            {translate label=' '} sc. {$info.PersonSc},{translate label=' '} et. {$info.PersonEt},{translate label=' '} ap. {$info.PersonAp},
            {translate label=' '}sector / judet {$info.PersonDistrictName},{translate label=' '} avand calitatea
            de {$info.Function|default:'..................................................................'}
            {translate label=' '}in institutia noastra de la data de {$info.StartDate|default:'.....................................'}.

            <h3>{translate label=' '}Referitor la indeplinirea conditiilor de acordare a concediului si indemnizatiei pentru cresterea copilului:</h3>
            {translate label=' '}- in perioada de la ....................... pana la .......................... a beneficiat de indemnizatie de maternitate;<br>
            {translate label=' '}- la data de ........................... se implinesc cele 42 de zile din concedul de lauzie;<br>
            {translate label=' '}- in perioada de la ....................... pana la .......................... a beneficiat de indemnizatie pentru cresterea copilului;<br>
            {translate label=' '}- incepand cu data de ......................... se aproba conceiul pentru cresterea copilului.<br>
            {translate label=' '}- a realizat venituri profesionale supuse impozitului pe venit, dupa cum urmeaza:<br>
            <ul>
                <li>{translate label=' '}de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
                <li>de la (zi/luna/an) ............................. pana la (zi/luna/an) ................................</li>
            </ul>
            <table cellpacing="0" cellpadding="0" border="0">
                <tr>
                    <td></td>
                </tr>
            </table>
    </div>
{/if}