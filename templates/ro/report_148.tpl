{if !empty($smarty.get.PersonID)}
    <div style="width: 800px; margin:0px;">


        {if $info.CompanyID && $info.CompanyPhoto}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0px;">

                <tr width="100%">

                    <td align="center"><img src="{$info.CompanyPhoto}"/></td>

                </tr>

            </table>
            <br style="height:0px;" clear="all"/>
        {/if}


        <table width="100%" align="center" style="margin-bottom:0px;">

            <tr>

                <td width="75%"><b>Numar de inregistrare la angajator {$info.ContractNo|default:'.......'} / {$smarty.now|date_format:'%d.%m.%Y'}</b></td>

                <td width="25%" align="center"><b>ANEXA</b></td>

            </tr>

            <tr>

                <td width="75%">&nbsp;</td>

                <td width="25%" align="center"><b>(Anexa nr. 26 la norme)</b></td>

            </tr>

        </table>


        <h2 style="text-align: center;"><i>ADEVERINTA</i></h2>


        <p style="text-indent:0px; text-align:justify; margin:0px;">

            <b>A. Date de identificare a angajatorului:</b>

        </p>

        <p style="text-align:left; margin:0px 0px 0px 40px;">

            <b>Denumire / nume: </b>{$info.CompanyName|default:'..............................'}<br/>
            <b>Codul unic de inregistrare / codul fiscal:</b> {$info.RegComert|default:'......................'} / {$info.CIF|default:'..............'}<br/>
            <b>Cod CAEN: </b>{$companydomains[$info.CompanyDomainID]|default:'..........................................'}<br/>
            <b>Adresa: </b>{$info.CompanyAddress|default:'..............................'}<br/>
            <b>Telefon / fax: </b>{$info.PhoneNumberA|default:'....................'} / {$info.FaxNumber|default:'....................'}<br/>
            <b>Email / pagina internet: </b>{$info.CompanyEmail|default:'...........................'} / {$info.CompanyWebsite|default:'.............................'}

        </p>

        <br/>


        <p style="text-indent:0px; text-align:justify; margin:0px;">

            <b>B. Date privind plata contributiilor la bugetul asigurarilor pentru somaj: </b>

        </p>

        <br/>

        <p style="text-indent:40px; text-align:justify; margin:0px;">

            <b>B.1.</b> Pentru {if $info.Sex == 'M'}domnul{else}doamna{/if} <b>{$info.FullName}</b>,

            CNP {$info.CNP|default:'...........................................'}, care se legitimeaza cu BI / CI

            Seria {$info.BISerie|default:'.......'}, numarul {$info.BINumber|default:'...............'} {if $info.Sex == 'M'}salariat{else}salariata{/if} din data de

            {$info.StartDate|default:'.............................'}, in data de {if $info.StopDate != '00.00.0000'}{$info.StopDate}{else}.............................{/if}, in
            calitatea noastra de angajator,

            am retinut si virat la bugetul asigurarilor pentru somaj sumele reprezentand contributia individuala in cota prevazuta de lege

            si contributia datorata de angajator dupa cum urmeaza:

        </p>

        <br/>


        <table width="100%" cellspacing="0" cellpadding="2" border="1">

            <tr>

                <td>{translate label='Nr. Crt'}</td>

                <td width="80" align="center">{translate label='Luna si anul'}</td>

                <td width="50" align="center">{translate label='Baza de calcul (BC)'}</td>

                <td align="center">{translate label='Suma reprezentand contributia individuala'}</td>

                <td align="center">{translate label='Instrument de plata, numarul si data acestuia'}</td>

                <td align="center">{translate label='Suma reprezentand contributia datorata de angajator'}</td>

                <td align="center">{translate label='Instrument de plata, numarul si data acestuia'}</td>

                <td align="center">{translate label='Numarul si data inregistrarii la A.J.O.F.M./A.M.O.F.M a Declaratiei lunare privind evidenta

							nominala a asiguratilor si obligatiilor de plata la bugetul asigurarilor pentru somaj'}

                </td>

            </tr>

            <tr>

                <td align="center">1</td>

                <td align="center">2</td>

                <td align="center">3</td>

                <td align="center">4</td>

                <td align="center">5</td>

                <td align="center">6</td>

                <td align="center">7</td>

                <td align="center">8</td>

            </tr>

            {assign var=thisyear value=$smarty.now|date_format:"%Y"}

            {assign var=year value=$thisyear-1}

            <tr>
                <td align="center">1</td>
                <td style="width:130px;"><b>DECEMBRIE {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">2</td>
                <td><b>NOIEMBRIE {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">3</td>
                <td><b>OCTOMBRIE {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">4</td>
                <td><b>SEPTEMBRIE {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">5</td>
                <td><b>AUGUST {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">6</td>
                <td><b>IULIE {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">7</td>
                <td><b>IUNIE {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">8</td>
                <td><b>MAI {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">9</td>
                <td><b>APRILIE {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">10</td>
                <td><b>MARTIE {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">11</td>
                <td><b>FEBRUARIE {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>

            <tr>
                <td align="center">12</td>
                <td><b>IANUARIE {$year}</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="center"><b>TRANSMIS ONLINE</b></td>
            </tr>


        </table>

        <br/>

        <p style="text-indent:0px; text-align:left; margin:0px;">

            NOTE:<br/>

            Se completeaza descrescator pentru maxim 12 luni de la data incetarii raporturilor de munca sau de serviciu pentru care angajatorul a virat la bugetul asigurarilor
            pentru somaj

            sumele reprezentand contributiile prevazute de lege.<br/>

            BC - baza lunara de calcul asupra careia se aplica contributia individuala in cota prevazuta de lege, determinata in conformitate cu dispozitiile

            titlului IX2 "Contributii sociale obligatorii" din Legea nr.571/2003 privind Codul fiscal, cu modificarile si completarile ulterioare.<br/>

            <b>Coloana 4</b> se completează cu suma rezultata prin aplicarea cotei contributiei individuale la bugetul asigurarilor pentru somaj prevazuta de

            lege asupra bazei de calcul prevazuta la coloana 3.<br/>

            <b>Coloana 6</b> se completeaza cu suma rezultata prin aplicarea cotei contributiei datorate de angajator, prevazuta de lege asupra

            sumei reprezentand baza de calcul a contributiei datorate de angajator la bugetul asigurarilor pentru somaj determinata in conformitate

            cu dispozitiile titlului IX2 "Contributii sociale obligatorii" din Legea nr.571/2003 privind Codul fiscal, cu modificarile si completarile ulterioare.<br/>

            Pentru lunile pentru care angajatorul a incasat de la A.J.O.F.M./A.M.O.F.M. diferenta dintre drepturile banesti cuvenite potrivit legii,

            ca urmare a conventiei incheiate si suma reprezentand contributia datorata de angajator, coloana 7 se completeaza cu numărul si data conventiei incheiate.

        </p>


        <p style="text-indent:0px; text-align:left; margin:0px;">

            <b>B.2.</b> In calitatea noastra de angajator (se completeaza varianta corespunzatoare):<br/>


        <ul style="margin-top:0px; margin-bottom:0px; padding-left:10px; list-style-type:square;">

            <li>nu inregistram debite la Bugetul asigurarilor pentru somaj</li>

            <li>pentru perioada.............................. nu s-a retinut si virat contributia individuala in suma totala de

                ....................... si platit contributia datorata de angajator in suma de ......................
            </li>

            <li>ne regasim in una din situatiile prevazute la art.34 alin.(2) din Legea nr.76/2002, cu modificarile si completarile ulterioare,

                respectiv ........................................................ perioada.................................
            </li>

        </ul>


        </p>


        <p style="text-indent:0px; text-align:left; margin:0px;">

            <b>C. Date privind raporturile de munca sau de serviciu ale salariatului:</b><br/>

            Actul in baza caruia a fost incadrat in munca, numar si data contractului individual de munca nr. {$info.ContractNo|default:'...................'}
            / {$info.ContractDate|default:'............................'}<br/>

            Data angajarii {$info.StartDate|default:'........................'}<br/>

            Data incetarii raporturilor de munca sau de serviciu {$info.StopDate|default:'........................'}<br/>

            Temeiul legal al incetarii raporturilor de munca sau de serviciu (articol si actul normativ)
            Art. {if $info.Status == 5 || $info.Status == 6}{$info.Law|default:'..........'}{else}.........{/if} din Legea nr. 53/2003<br/>

            Perioade pentru care raporturile de munca sau de serviciu au fost suspendate*:<br/>

            Data de suspendare ................... data de incetare a suspendarii ................ motivul suspendarii ** {$info.TCMDaysNo|default:'......'} zile calendaristice de
            concediu medical.<br/>

            Data de suspendare ................... data de incetare a suspendarii ................ motivul suspendarii ** ...... zile calendaristice de concediu medical.<br/>

            <br/>

            Sub sanctiunile aplicate falsului in acte publice, declar ca am examinat intreg continutul acestei adeverinte si in conformitate cu informatiile furnizate,

            o declar corecta si completa.

        </p>

        <br/>

        <table width="100%" align="center" style="margin-bottom:0px;">

            <tr>

                <td width="60%" align="center"><b>Administrator/Director/Reprezentant legal</b></td>

                <td width="40%" align="center"><b>Departament resurse umane</b></td>

            </tr>

            <tr>

                <td width="60%" align="center">Nume si prenume, functia (in clar)</td>

                <td width="40%" align="center">Nume si prenume, functia (in clar)</td>

            </tr>

            <tr>

                <td width="60%" align="center">{if $info.LegalFullName}{$info.LegalFullName}, {$info.LegalFunction}{else}...............................................{/if}</td>

                <td width="40%" align="center">{if $info.HRFullName}{$info.HRFullName}, {$info.HRFunction}{else}.........................................................{/if}</td>

            </tr>

            <tr>

                <td width="60%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----------------------------------------------------------</td>

                <td width="40%" align="center">--------------------------------------------------</td>

            </tr>

        </table>


        <p style="text-indent:0px; text-align:left; margin:0px;">

            *) se completeaza pentru fiecare perioada de suspendare<br/>

            **) in cazul suspendarii pentru incapacitate temporara de munca se va specifica numarul de zile de concediu medical.

        </p>


    </div>
{/if}