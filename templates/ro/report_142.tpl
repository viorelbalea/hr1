{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        {if $info.CompanyID && $info.CompanyPhoto}
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr width="100%">
                    <td align="center"><img src="{$info.CompanyPhoto}"/></td>
                </tr>
            </table>
            <br clear="all"/>
        {/if}

        <p style="text-align:center; margin:0px;">
            <b>CONTRACT INDIVIDUAL DE MUNCA</b><br/>
            Incheiat si inregistrat sub nr. {$info.ContractNo|default:'......'}
            /{if !empty($info.ContractDate) && $info.ContractDate != '0000-00-00'}{$info.ContractDate|date_format:'%d.%m.%Y'}{else}...........................{/if} in registrul
            general de evidenta a salariatilor
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>A. Partile contractului</b>
        </p>
        <p style="text-indent:40px; text-align:justify; margin:0px;">
            Angajator - persoana juridica: <i>{$info.CompanyName|default:'...................'}</i> cu sediul in {$info.CityName|default:'..........................'},
            inregistrata la Registrul Comertului din Bucuresti sub nr. {$info.RegComert|default:'..............................'},
            CUI {$info.CIF|default:'..............................'},
            telefon {$info.PhoneNumberA|default:'........................'}, reprezentata legal prin <i>{$info.LegalFullName|default:'................................'}</i> in
            calitate de Director General;
        </p>
        <p style="text-indent:40px; text-align:left; margin:0px;">
            Si
        </p>
        <p style="text-indent:40px; text-align:justify; margin:0px;">
            {if $info.Sex == 'M'}Salariatul - Domnul{else}Salariata - Doamna{/if} {$info.FullName}, {if $info.Sex == 'M'}domiciliat{else}domiciliata{/if} in
            <b><i>{$info.PersonAddress|default:'......................'}</i></b>, {if $info.Sex == 'M'}posesor{else}posesoare{/if} a actului de identitate <b><i>CI</i></b>
            seria <b><i>{$info.BISerie|default:'.........'}, nr. {$info.BINumber|default:'...............'}</i></b>, eliberata
            de {$info.BIEmitent|default:'.......................'}
            la data de {$info.BIStartDate|date_format:'%d.%m.%Y'|default:'..................'}, <b><i>CNP {$info.CNP|default:'...........................................'}</i></b>.
        </p>
        <p style="text-indent:0px; text-align:justify; margin:0px;">
            Am incheiat prezentul contract individual de munca in urmatoarele conditii asupra carora am convenit:
        </p>
        <br/>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>B. Obiectul contractului: </b>Conform ART. 10 din LEGEA 53/2003 .......................
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>C. Durata contractului: </b>
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            a) {if $info.ContractType==2}<strong>{/if}nedeterminata{if $info.ContractType==2}</strong>{/if}, {if $info.Sex == 'M'}salariatul{else}salariata{/if} {$info.FullName}
            urmand sa inceapa activitatea la data de {if $info.ContractType==2}{$info.WorkStartDate|default:'.......................'}{else}.......................{/if};
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            b) {if $info.ContractType==1}<strong>{/if}determinata{if $info.ContractType==1}</strong>{/if}, de {$info.Months|default:'.....'} luni pe perioada cuprinsa intre data
            de {if $info.ContractType==1}{$info.WorkStartDate|default:'..............'}{else}..............{/if} si data
            de {if $info.ContractType==1}{$info.ContractExpDate|default:'..............'}{else}..............{/if} conform art. 12 alin. 2 din Codul Muncii.
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>D. Locul de munca</b>
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            1. Activitatea se desfasoara la {$info.CompanyName|default:'.......................'} - Departament {$info.Department|default:'..............................'}
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            2. In lipsa unui loc de munca fix salariatul va desfasura activitatea astfel: ........................
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>E. Felul muncii</b><br/>
            Functia/meseria <b>{$info.Function|default:'...............................'}</b> , conform Clasificarii Ocupatiilor din Romania (COD
            <b>COR {$info.COR|default:'..............'}</b>).
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>F. Atributiile postului</b><br/>
            Atributiile postului sunt prevazute in fisa postului, anexa la contractul individual de munca*)
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>G. Criteriile de evaluare a activitatii profesionale a salariatului:</b><br/>
            <span style="text-align:justify;">Capacitate de implementare, capacitatea de a rezolva eficient problemele, capacitatea de asumare
	a responsabilitatilor, capacitatea de autoperfectionare si de valorificare a experientei dobandite, capacitatea de analiza si sinteza, 
	creativitate si spirit de initiativa, capacitatea de planificare si de a actiona strategic, capacitatea de a lucra independent, 
	capacitatea de a lucra in echipa, competenta in gestionarea resurselor alocate.</span>
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>H. Conditii de munca</b>
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            1. Activitatea se desfasoara in conformitate cu prevederile Legii nr. 31/1991.
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            2. Activitatea prestata se desfasoara in conditii normale/deosebite speciale de munca, potrivit Legii nr. 19/2000
            privind sistemul public de pensii si alte drepturi de asigurari sociale, cu modificarile si completarile ulterioare.
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>I. Durata muncii</b>
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            <b><i>1. </i></b>O norma intreaga, durata timpului de lucru fiind de <b><i>{$info.WorkNorm|default:'............'}
                    ore/zi, {if !empty($info.WorkNorm)}{math equation="5*x" x=$info.WorkNorm}{else}.................{/if} ore/saptamana</i></b>.
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            a) Repartizarea programului de lucru se face dupa cum urmeaza:
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            b) Programul de lucru se poate modifica in conditiile regulamentului intern/contractului colectiv de munca aplicabil.
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            2. O fractiune de norma de ...... ore/zi (cel putin 2 ore/zi), ............
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            a) Repartizarea programului de lucru se face dupa cum urmeaza: ........... (ore zi/ore noapte)
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            b) Programul de lucru se poate modifica in conditiile regulamentului intern/contractului colectiv munca aplicabil.
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            c) Nu se vor efectua ore suplimentare, cu exceptia cazurilor de forta majora sau pentru alte lucrari urgente
            destinate prevenirii producerii unor accidente sau inlaturarii consecintelor acestora.
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>J. Concediul</b>
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            Durata concediului anual de odihna este de <b>{$info.ContractVacationDays|default:'.........'} zile lucratoare</b>, in raport cu durata muncii (norma intreaga,
            fractiune de norma).
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            De asemenea, beneficiaza de un concediu suplimentar de ...........
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>K. Salariul</b>
        </p>
        <p style="text-align:left; margin:0px 0px 0px 20px;">
            1. Salariul de baza lunar brut: <b><i>{$info.BrutSalary|default:'.......................'} LEI</i></b> <br/>
            2. Alte elemente constitutive: <br/>
            a. sporuri .....................; <br/>
            b. indemnizatii ....................; <br/>
            c. alte adaosuri: ..................................
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            3. Orele suplimentare prestate in afara programului normal de lucru sau in zilele in care nu se lucreaza ori in zilele
            de sarbatori legale se compenseaza cu ore libere platite sau se platesc cu un spor la salariu, conform contractului
            colectiv de munca aplicabil sau Legii nr. 53/2003 - Codul Muncii.
        </p>
        <p style="text-indent:20px; text-align:justify; margin:0px;">
            4. Data/datele la care se plateste salariul este/sunt: <i>..................................................................................</i>
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>L. Drepturi si obligatii ale partilor privind securitatea si sanatatea in munca:</b>
        </p>
        <p style="text-indent:0px; text-align:left; margin:0px;">
            a) Echipament individual de protectie: ........................<br/>
            b) Echipament individual de lucru: ..........................<br/>
            c) Materiale igienico-sanitare: .........................<br/>
            d) Alimentatie de protectie: .........................<br/>
            e) Alte drepturi si obligatii privind sanatatea si securitatea in munca: ................
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>M. Alte cauze:</b>
        </p>
        <p style="text-indent:0px; text-align:left; margin:0px;">
            a) perioada de proba este <b>{$info.ContractProbationPeriod|default:'......'} zile calendaristice</b>;<br/>
            b) perioada de preaviz in cazul concedierii este de <b>{$info.ContractDismissalPeriod|default:'.......'} zile lucratoare</b>, conform Legii nr. 53/2003 - Codul muncii
            sau contractului colectiv de munca,<br/>
            c) perioada de preaviz in cazul demisiei este de <b>{$info.ContractDismissalPeriod|default:'.......'} zile lucratoare</b>, conform Legii nr. 53/2003-Codul Muncii sau
            contractului colectiv de munca,<br/>
            d) in cazul in care salariatul urmeaza sa-si desfasoare activitatea in strainatate, informatiilor prevazute la art. 18, alin (1) din Legea nr. 53/2003 - Codul muncii se
            vor regasi si in contractul individual de munca,<br/>
            e) clauza de confidentialitate prevazuta in art. 26 din Codul Muncii. Sunt confidentiale urmatoarele informatii, date si documente de care salariatul a luat cunostinta
            sau incidental:
        </p>
        <p style="text-indent:0px; text-align:justify; margin:0px;">
        <ul style="margin:0px; padding:0px 0px 0px 20px;">
            <li style="margin-top:0px; padding-top:0px;">situatia financiara;</li>
            <li>proiectele si programele de afaceri si tot ceea ce este sinonim cu acestea;</li>
            <li>contractele individuale de munca;</li>
            <li>salarii;</li>
            <li>contracte clienti, identitatea clientilor;</li>
            <li>contracte furnizori, identitatea furnizorilor;</li>
            <li>bancile de date;</li>
            <li>orice informatii al caror continut, daca ar fi dezvaluit, sunt de natura sa aduca prejudicii societatii {$info.CompanyName|default:'.................'}
            <li>Salariatul/angajatul poate dezvalui informatii sau date, ori poate pune la dispozitie documente din domeniile mentionate anterior
                numai persoanelor implicate in executarea obligatiilor de serviciu care au legatura cu ele sau acelor persoane pentru care se da aprobare
                in scris de catre Administratorul Societatii;
            </li>
            <li>Salariatul/angajatul se obliga ca pe toata durata validitatii contractului individual de munca/conventiei civile de prestari servicii
                sa nu-si constituie o societate comerciala cu obiect de activitate identic sau asemanator cu cel al societatii angajatorului,
                sa nu devina asociat sau actionar intr-o asemenea societate ori sa-si asume functia de administrator, membru in consiliul de
                administratie sau cenzor intr-o alta societate comerciala cu obiect de activitate identic sau asemanator cu cel al societatii angajatorului.
            </li>
            <li>Salariatul/angajatul se obliga ca, timp de cel putin <b>1</b> an de la data incetarii contractului individual de munca sau a
                conventiei civile de prestari de servicii, sa pastreze confidentialitatea informatiilor, datelor si documentelor cu care a
                luat contact pe cale directa sau incidentala in cursul executarii acestora.
            </li>
            <li style="margin-bottom:0px; padding-bottom:0px;">In cazul in care angajatul, cu intentie sau din culpa, divulga informatii, date sau documente confidentiale se obliga
                sa despagubeasca societatea corespunzator prejudiciilor pe care i le-a produs.
            </li>
        </ul>
        </p>
        <p style="text-indent:0px; text-align:justify; margin:0px;">
            f) alte cauze.
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>N. Drepturi si obligatii generale ale partilor</b>
        </p>
        <p style="text-indent:0px; text-align:left; margin:0px;">
            1. <i>Salariatul</i> are, in principal, urmatoarele <i>drepturi:</i><br/>
            a) dreptul la salarizare pentru munca depusa;<br/>
            b) dreptul la repaus zilnic si saptamanal;<br/>
            c) dreptul la concediul de odihna anual;<br/>
            d) dreptul la egalitate de sanse si de tratament;<br/>
            e) dreptul la securitate si sanatate in munca;<br/>
            f) dreptul la formare profesionala, in conditiile actelor aditionale<br/>
            2. <i>Salariatului</i> ii revin, in principal, urmatoarele <i>obligatii:</i><br/>
            a) obligatia de a realiza norma de munca sau, dupa caz, de a indeplini atributiile ce ii revin conform fisei postului.<br/>
            b) Obligatia de a respecta disciplina muncii;<br/>
            c) Obligatia de fidelitate fata de angajator in executarea atributiilor de serviciu<br/>
            d) Obligatia de a respecta masurile de securitate si sanatate a muncii in unitate;<br/>
            e) Obligatia de a respecta secretul de serviciu.<br/>
            3. <i>Angajatorul</i> are, in principal, urmatoarele <i>drepturi:</i><br/>
            a) sa dea dispozitii cu caracter obligatoriu pentru salariat, sub rezerva legalitatii lor;<br/>
            b) sa exercite controlul asupra modului de indeplinire a sarcinilor de serviciu;<br/>
            c) sa constate savarsirea abaterilor disciplinare si sa aplice sanctiunile corespunzatoare, potrivit legii,
            contractului colectiv de munca aplicabil si regulamentului intern.<br/>
            4. <i>Angajatorului</i> ii revin, in principal, urmatoarele <i>obligatii:</i><br/>
            a) sa acorde salariatului toate drepturile ce decurg din contractele individuale de munca, din contractul colectiv de munca aplicabil si din lege;<br/>
            b) sa asigure permanent conditiile tehnice si organizatorice avute in vedere la elaborarea normelor de munca si conditiile corespunzatoare de munca;<br/>
            c) sa informeze salariatul asupra conditiilor de munca si asupra elementelor care privesc desfasurarea relatiilor de munca;<br/>
            d) sa elibereze, la cerere, toate documentele care atesta calitatea de salariat a solicitantului;<br/>
            e) sa asigure confidentialitatea datelor cu caracter personal ale salariatului.<br/>
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>O. Dispozitii finale </b>
        </p>
        <p style="text-indent:40px; text-align:justify; margin:0px;">
            Prevederile prezentului contract individual de munca se completeaza cu dispozitiile Legii nr. 53/2003 - Codul muncii si ale
            contractului colectiv de munca aplicabil incheiat la nivelul angajatorului / grupului de angajatori / ramuri / national,
            inregistrat sub nr. ...../.......... la Directia generala de munca si solidaritate sociala, a municipiului Bucuresti /
            Ministerul Muncii si Solidaritatii Sociale.
        </p>
        <p style="text-indent:40px; text-align:justify; margin:0px;">
            Orice modificare privind clauzele contractuale in timpul executarii contractului individual de munca impune incheierea
            unui act aditional la contract conform dispozitiilor legale.
        </p>
        <p style="text-indent:0px; text-align:left; margin:0px;">
            Prezentul contract individual de munca s-a incheiat in doua exemplare, cate unul pentru fiecare parte.
        </p>

        <p style="text-indent:40px; text-align:left; margin:0px;">
            <b>P.</b> Conflictele in legatura cu incheierea, executarea, modificarea, suspendarea sau incetarea prezentului
            contract individual de munca sunt solutionate de instanta judecatoreasca competenta material si teritorial, potrivit legii.
        </p>

        <br/>

        <table width="100%" align="center">
            <tr>
                <td width="50%"><b>ANGAJATOR</b></td>
                <td width="50%" align="right"><b>SALARIAT</b></td>
            </tr>
            <tr>
                <td width="50%">{$info.CompanyName|default:'.......................'}</td>
                <td width="50%" align="right">{$info.FullName}</td>
            </tr>
        </table>

        <br/>

        <table width="100%" align="center">
            <tr>
                <td width="50%"><b>REPREZENTANT LEGAL,</b></td>
                <td width="50%" align="right">&nbsp;</td>
            </tr>
            <tr>
                <td width="50%"><i>{$info.LegalFullName|default:'BADINA  MARIUS - DANIEL'}</i></td>
                <td width="50%" align="right">&nbsp;</td>
            </tr>
        </table>

        <br/>

        <p style="text-indent:0px; text-align:left; margin:0px;">
            Pe data de {if $info.WorkStopDate != '00.00.0000'}{$info.WorkStopDate}{else}.....................{/if} prezentul contract inceteaza in temeiul
            art. {if $info.WorkStopDate != '00.00.0000'}{$info.Law|default:'.......'}{else}.......{/if} din Legea nr. 53/2003 - Codul muncii in urma indeplinirii procedurii legale.
        </p>

    </div>
{/if}