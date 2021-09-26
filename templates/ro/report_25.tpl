{if !empty($smarty.get.PersonID)}
    <div style="width: 800px">

        <h3>{translate label='Numar de inregistrare la angajator'} ........ {translate label='data'} .................</h3>

        <h1 style="text-align: center;">ADEVERINTA</h1>

        <h3>{translate label='A. Date de identificare a angajatorului'}:</h3>
        <p><b>{translate label='Denumire / nume'}
                :</b> {$info.CompanyName|default:'..................................................................................................................'}</p>
        <p><b>{translate label='Codul unic de inregistrare / codul fiscal'}:</b> {$info.RegComert|default:'............................................'}
            / {$info.CIF|default:'.....................................'}</p>
        <p><b>{translate label='Cod CAEN '}
                :</b> {$companydomains[$info.CompanyDomainID]|default:'............................................................................................'}</p>
        <p><b>{translate label='Adresa'}
                :</b> {$info.CompanyAddress|default:'.....................................................................................................................'}</p>
        <p><b>{translate label='Telefon / fax '}:</b> {$info.PhoneNumberA|default:'......................................'}
            / {$info.FaxNumber|default:'........................................'}</p>
        <p><b>{translate label='Email / pagina internet'}:</b> {$info.CompanyEmail|default:'......................................'}
            / {$info.CompanyWebsite|default:'........................................'}</p>

        <h3>{translate label='B. Date privind plata contributiilor la bugetul asigurarilor pentru somaj'}:</h3>
        <p style="padding-left: 40px;"><b>B.1.</b>Pentru {if $info.Sex == 'M'}domnul{else}doamna{/if} {$info.FullName|upper}</p>
        <p>{translate label='CNP'} {$info.CNP} {translate label='care se legitimeazacu BI / CI / Adeverinta Seria'} {$info.BISerie|default:'.......'} {translate label='numarul'} {$info.BINumber|default:'......................'}</p>
        <p>{translate label='salariat din data de '}{$info.StartDate} {translate label='in data de '}{$info.StopDate}, {translate label='in calitatea noastra de angajator, am'}</p>
        <p>{translate label='retinut si virat la bugetul asigurarilor pentru somaj sumele reprezentand contributia individuala in cota'}</p>
        <p>{translate label='de 0.5% si contributia datorata de angajator dupa cum urmeaza'}:</p>
        <table width="100%" cellspacing="0" cellpadding="2" border="1">
            <tr>
                <td><b>{translate label='Nr. Crt'}.</b></td>
                <td width="80" align="center"><b>{translate label='Luna si anul'}</b></td>
                <td width="50" align="center"><b>{translate label='Baza de calcul (BC)'}</b></td>
                <td align="center"><b>{translate label='Suma reprezentand contributia individuala'}</b></td>
                <td align="center"><b>{translate label='Instrument de plata numarul si data acestuia'}</b></td>
                <td align="center"><b>{translate label='Suma reprezentand contributia individuala datorata de angajator'}</b></td>
                <td align="center"><b>{translate label='Instrument de plata numarul si data acestuia'}</b></td>
                <td align="center">
                    <b>{translate label='Numarul si data inregistrarii la A.J.O.F.M./A.M.O.F.M a Declaratiei lunare privind evidenta nominala a asiguratilor si obligatiilor de plata la bugetul asigurarilor pentru somaj'}</b>
                </td>
            </tr>
            <tr>
                <td align="center"><b>1</b></td>
                <td align="center"><b>2</b></td>
                <td align="center"><b>3</b></td>
                <td align="center"><b>4</b></td>
                <td align="center"><b>5</b></td>
                <td align="center"><b>6</b></td>
                <td align="center"><b>7</b></td>
                <td align="center"><b>8</b></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
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
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>

        <p style="padding-left: 40px;"><b>B2.</b> {translate label='In calitatea noastra de angajator (se completeaza varianta corespunzatoare)'}:</p>
        <ul>
            <li>{translate label='Nu inregistram debite la Bugetul asigurarilor pentru somaj'}</li>
            <li>{translate label='Pentru perioada de ........................................... nu s-a retinut si virat contributia individuala in suma totala de'}<br>
                .................................. {translate label='si platit contributia datorata de angajator in suma de'} ..................................
            </li>
            <li>{translate label='Ne regasim in una din situatiile prevazute la art. 34 alin.(2) din Legea nr. 76/2002, cu modificarile si completarile ulterioare,'}<br>
                {translate label='respectiv'} ................................................... {translate label='perioada'} ............................................
            </li>
        </ul>

        <h3>C.{translate label='Date privind raporturile de munca sau de serviciu ale salariatului'}: </h3>
        <p>{translate label='Actul in baza caruia a fost incadrat in munca, numar si data '}{$info.ContractNo} / {$info.ContractDate}
            ,{translate label='data angajarii'}  {$info.StartDate}.</p>
        <p>{translate label='Data incetarii raporturilor de munca sau de serviciu'} {$info.StopDate}.</p>
        <p>{translate label='Perioade pentru care raporturile de munca sau de serviciu au fost suspendate'}:</p>
        - {translate label='data de suspendare'} ......................... {translate label='data incetarii suspendarii'} .............................
        <br>{translate label='motivul suspendarii'} ...............................................................................
        - {translate label='data de suspendare'} ......................... {translate label='data incetarii suspendarii'} .............................
        <br>{translate label='motivul suspendarii'} ...............................................................................
        - {translate label='data de suspendare'} ......................... {translate label='data incetarii suspendarii'} .............................
        <br>{translate label='motivul suspendarii'} ...............................................................................

        <p>{translate label='Sub sanctiunile aplicate falsului in acte publice, declar ca am examinat intreg continutul acestei adeverinte  si in conformitate'}<br>
            {translate label='cu informatiile furnizate, o declar corecta si completa.'}</p>
        <br><br>
        <table width="100%" cellspacing="0" cellpadding="2">
            <tr>
                <td width="50%">{translate label='Administrator / Director / Reprezentant legal'}<br/>{translate label='Nume si prenume, functia (in clar)'}
                    <br/><br/>{if $info.LegalFullName}{$info.LegalFullName}, {$info.LegalFunction}{else}.............................................................................{/if}
                    <br/><br/>.............................................................................
                </td>
                <td width="50%">{translate label='Departament resurse umane'}<br/>{translate label='Nume si prenume, functia (in clar)'}
                    <br/><br/>{if $info.HRFullName}{$info.HRFullName}, {$info.HRFunction}{else}..........................................................................{/if}
                    <br/><br/>.............................................................................
                </td>
            </tr>
        </table>

    </div>
{/if}