{if !empty($smarty.get.PersonID)}
    <div style="width: 800px">

        <br/>


        <p style="text-align:center"><strong>CONTRACT INDIVIDUAL DE MUNCA</strong><br/>

        <p style="text-align:center"><b>Tipul
                contractului:</b> {if $info.ContractType eq '2'} NORMA INTREAGA / PERIOADA NEDETERMINATA{elseif $info.ContractType eq '1'} PERIOADA DETERMINATA {elseif $info.ContractType eq '3'}SUSPENDAT{/if}
        </p>

        <p style="text-align:center">Incheiat si inregistrat sub nr. {$info.ContractNo|default:'.......................'}
            /{if !empty($info.ContractDate) && $info.ContractDate != '0000-00-00'}{$info.ContractDate|date_format:'%d.%m.%Y'}{else}...........................{/if} in registrul
            general de evidenta a salariatilor</p>


        <table width="100%" cellspacing="0" cellpadding="0" border="0">

            <tr>

                <td style="text-indent:-15px; padding-left:25px;">

                    A. <strong>Partile contractului</strong><br/>

                    Angajator - <strong>{$info.CompanyName|default:'..............................'}</strong>, cu sediul in localitatea
                    <strong>{$info.DistrictName|default:'.......................'}</strong>, <strong>{$info.CompanyAddress|default:'..............................'}</strong>,
                    inregistrata la Registrul Comertului sub nr. <strong>{$info.RegComert|default:'.......................'}</strong>, cod fiscal
                    <strong>{$info.CIF|default:'.......................'}</strong>, telefon <strong>{$info.PhoneNumberA|default:'..................................'}</strong>,
                    reprezentata legal prin <strong>{$info.LegalFullName|default:'.............................'}</strong>, in calitate de ADMINISTRATOR avand B.I./C.I. seria
                    <b>{$info.LegalBISerie|default:'....'}</b> nr. <b>{$info.LegalBINumber|default:'....'}</b>, eliberat de <b>{$info.LegalBIEmitent|default:'....'}</b> la data
                    <b>{$info.LegatBIStartDate|default:'.....'}</b><br/><br/>

                    si<br/><br/>

                    {if $info.Sex == 'M'}Salariatul{else}Salariata{/if}, {if $info.Sex == 'M'}domnul{else}doamna{/if}
                    <strong>{$info.FullName}</strong>, {if $info.Sex == 'M'}domiciliat{else}domiciliata{/if} in <b>{$info.PersonAddress|default:'......................'}</b>,
                    {if $info.Sex == 'M'}posesor al{else}posesoare a{/if} cartii de identitate / pasaport <strong>seria {$info.BISerie|default:'.........'}
                        nr. {$info.BINumber|default:'....................'}</strong>, eliberata de {$info.BIEmitent|default:'.......................'}, la data
                    de {$info.BIStartDate|default:'..................'}, CNP {$info.CNP|default:'.......................'}, autorizatie de munca / permis de sedere in scop de munca
                    seria / nr. {$info.ContractNo|default:'.......................'} din
                    data {if !empty($info.ContractDate) && $info.ContractDate != '0000-00-00'}{$info.ContractDate|date_format:'%d.%m.%Y'}{else}...........................{/if}<br/><br/>

                    am incheiat prezentul contract individual de munca in urmatoarele conditii asupra carora am convenit:<br/><br/>

                </td>

            </tr>


            <tr>

                <td style="text-indent:-15px; padding-left:25px;">B. <strong>Obiectul contractului:</strong> Promovare - vanzare produse ale firmei si celelalte activitati conform
                    fisei postului.

                    <br/>
                    <br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:-15px; padding-left:25px;">C. <strong>Durata contractului:</strong><br/>

                    <p style="text-indent:20px; text-align:justify; margin:0px;">
                        a) {if $info.ContractType==2}<strong>{/if}nedeterminata{if $info.ContractType==2}</strong>{/if}
                        , {if $info.Sex == 'M'}salariatul{else}salariata{/if} {$info.FullName} urmand sa inceapa activitatea la data
                        de {if $info.ContractType==2}{$info.WorkStartDate|default:'.......................'}{else}.......................{/if};
                    </p>
                    <p style="text-indent:20px; text-align:justify; margin:0px;">
                        b) {if $info.ContractType==1}<strong>{/if}determinata{if $info.ContractType==1}</strong>{/if}, de {$info.Months|default:'.....'} luni pe perioada cuprinsa
                        intre data de {if $info.ContractType==1}{$info.WorkStartDate|default:'..............'}{else}..............{/if} si data
                        de {if $info.ContractType==1}{$info.ContractExpDate|default:'..............'}{else}..............{/if}, pe perioada suspendarii contractul individual de
                        munca al titularului de post/potrivit Art. 83 lit... din Legea 53/2003 republicata.
                    </p>

                    <br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:-15px; padding-left:25px;">D. <strong>Locul de munca</strong><br/>

                    1. Activitatea se desfasoara la (sectie/atelier/birou/serviciu/compartiment etc): <strong>{$info.Division|default:'..............................'}
                        , {$info.Department|default:'..............................'}, din sediul social al
                        societatii {$info.CompanyName|default:'..................................'}.</strong><br/>

                    2.In lipsa unui loc de munca fix salariatul va desfasura activitatea astfel: .............

                    <br/>
                    <br/>

                </td>

            </tr>


            <tr>

                <td style="text-indent:-15px; padding-left:25px;">E. <strong>Felul muncii</strong><br/>

                    Functia/meseria - <b>{$info.Function|default:'...............................'}</b> in cadrul {$info.Department|default:'..............................'}
                    (conform nomenclatorului intern) - <b>{$info.Function|default:'...............................'}</b> (conform COR,
                    <b>cod {$info.COR|default:'..............'}</b>). <br/>
                    <br/>

                </td>

            </tr>


            <tr>

                <td style="text-indent:-15px; padding-left:25px;">F. <strong>Atributiile postului</strong><br/>

                    Atributiile postului sunt prevazute in fisa postului, care reprezinta Anexa 1 la contractul individual de munca.<br/><br/>


                    F1. <strong>Criteriile de evaluare a activitatii profesionale a salariatului</strong><br/>

                    Criteriile de evaluare a activitatii profesionale a salariatului <b>{$info.FullName|default:'.........'}</b> sunt prevazute in Anexa 2 la prezentul contract
                    individual de munca.

                    <br/>
                    <br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:-15px; padding-left:25px;">G. <strong>Conditii de munca</strong><br/>

                    1.Activitatea se desfasoara in conformitate cu prevederile Legii nr. 31/1991<br/>

                    2.Activitatea prestata se desfasoara in <strong>conditii normale de munca</strong>/deosebite/speciale, potrivit Legii nr. 263/2010 privind sistemul unitar de
                    pensii publice, cu modificarile si completarile ulterioare.

                    <br/>
                    <br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:-15px; padding-left:25px;">H. <strong>Durata muncii</strong><br/>

                    1.O norma intreaga, durata timpului de lucru fiind de <strong>{$info.WorkNorm|default:'............'}
                        ore/zi, {if !empty($info.WorkNorm)}{math equation="5*x" x=$info.WorkNorm}{else}.................{/if} ore/saptamana</strong>.<br/>

                    a)Repartizarea programului de lucru se face dupa cum urmeaza: de la 09:00 la 17:30 (ore zi / ore noapte / inegal).<br/>

                    b)Programul de lucru se poate modifica in conditiile regulamentului intern/contractului colectiv de munca aplicabil.</li><br/>

                    2. O fractiune de norma de ..... ore/zi), ore/saptamana......<br/>

                    a)Repartizarea programului se face dupa cum urmeaza ..... (ore zi/ore noapte)<br/>

                    b) Programul de lucru se poate modifica in conditiile regulamantului intern/contractului colectiv de munca aplicabil <br/>

                    c) Nu se vor efectua ore suplimentare, cu exceptia cazurilor de forta majora sau pentru alte lucrari urgente destinate prevenirii producerii unor accidente sau
                    inlaturarii consecintelor acestora.<br/><br/>

                    <br/>

                </td>

            </tr>


            <tr>

                <td style="text-indent:-15px; padding-left:25px;">I. <strong>Concediul</strong><br/>

                    Durata concediului anual de odihna este de <strong>{$info.ContractVacationDays|default:'..................'} zile lucratoare</strong>, in raport cu durata
                    muncii.</li>

                    De asemenea, beneficiaza de un concediu suplimentar de .................... .<br/><br/>

                    <br/>
                    <br/>
                </td>

            </tr>


            <tr>

                <td style="text-indent:-15px; padding-left:25px;">J. <strong>Salarizare:</strong><br/>

                    1. Salariul de baza lunar brut: <strong>{$info.BrutSalary|default:'.......................'} lei</strong><br/>

                    2. Alte elemente constitutive:<br/>

                    a) spor de conducere: ...................;<br/>

                    b) indemnizatii: ...............;<br/>

                    b1) prestatii suplimentare in bani........................;<br/>

                    b2) modalitatea prestatiilor suplimentare in natura.......;<br/>

                    c) alte adaosuri -<br/>

                    3. Orele suplimentare prestate in afara programului normal de lucru sau in zilele in care nu se lucreaza ori in zilele de sarbatori legale se compenseaza cu ore
                    libere platite in urmatoarele 60 de zile sau se platesc cu un spor la salariu, conform contractului colectiv de munca aplicabil sau Legii nr. 53/2003 - Codul
                    Muncii.<br/>

                    4. Data la care se plateste salariul este <strong>10</strong> ale lunii.

                    <br/>
                    <br/>
                </td>

            </tr>

            <tr>

                <td style="text-indent:-15px; padding-left:25px;">K. <strong>Drepturi si obligatii ale partilor privind securitatea si sanatatea in munca:</strong><br/>

                    a) echipament individual de protectie __________________________________;<br/>

                    b) echipament individual de lucru __________________________________;<br/>

                    c) materiale igienico-sanitare __________________________________;<br/>

                    d) alimentatie de protectie __________________________________;<br/>

                    e) alte drepturi si obligatii privind sanatatea si securitatea in munca _________________________.

                    <br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:-15px; padding-left:25px;">L. <strong>Alte clauze:</strong><br/>

                    a)perioada de proba: <strong>{$info.ContractProbationPeriod|default:'...............................'} zile calendaristice</strong>;<br/>

                    b)perioada de preaviz in cazul concedierii este de <strong>{$info.ContractDismissalPeriod|default:'...............................'} zile
                        lucratoare</strong>;<br/>

                    c)perioada de preaviz in cazul demisiei este de <strong>{$info.ContractDismissalPeriod|default:'...............................'} zile lucratoare</strong>,
                    conform Legii nr. 53/2003 - Codul Muncii, cu modificarile si completarile ulterioare sau Contractului colectiv de munca aplicabil;<br/>

                    d) in cazul in care salariatul urmeaza sa-si desfasoare activitatea in strainatate, informatiile prevazute la art. 18 alin. (1) din Legea nr. 53/2003 - Codul
                    Muncii, republicata, se vor regasi si in contractul individual de munca;<br/>

                    e)alte clauze:<br/>


                    <!--/*<strong>Obligatia de confidentialitate</strong>, cu urmatoarele prevederi:<br /><br />



                    <ol style="list-style-type:upper-roman; text-indent:0;">

                        <li>In cazul in care salariatul nu corespunde exigentei functiei in perioada de proba, contractul va inceta

                oricand pana la data expirarii perioadei de proba.</li>

                        <li>Salariul este confidential.</li>

                        <li>Salariatul sa respecte programul de lucru al bancii si sa foloseasca cu maxima eficienta timpul de munca

                pentru indeplinirea obligatiilor de serviciu.

                </li>

                        <li>Salariatul sa aiba un comportament corespunzator in relatiile cu ceilalti salariati ai bancii si persoanele din exteriorul bancii cu care intra in raporturi de serviciu.</li>

                        <li>Salariatul sa aiba o tinuta corespunzatoare si o comportare demna si cuviincioasa in relatiile cu partenerii din tara si strainatate, tratand problemele cu rabdare, calm si profesionalism, sa dea dovada de cinste si corectitudine, respectand intocmai regulile de comportare a salariatilor bancii inscrise in Codul de conduita.</li>

                        <li>Salariatul sa respecte secretul profesional si sa pastreze confidentialitatea cu privire la date, informatii, documente privind activitatea bancara sau a clientilor bancii.</li>

                        <li>Salariatul sa nu consume bauturi alcoolice in incinta bancii, atat in timpul programului de lucru cat si in afara acestuia si sa nu se prezinte in stare de ebrietate la program.</li>

                        <li>Salariatul este obligat sa respecte prevederile Regulamentului Intern si ale Fisei Postului</li><br />

                    </ol>*/ -->

                    <br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:-15px; padding-left:25px;">M. <strong>Drepturi si obligatii generale ale partilor:</strong><br/><br/>


                    <ol style="text-indent:0;">

                        <li>Salariatul are, in principal, urmatoarele drepturi:<br/>

                            <ol style="list-style-type:lower-latin; text-indent:0;">

                                <li>dreptul la salarizare pentru munca depusa;</li>

                                <li>dreptul la repaus zilnic si saptamanal;</li>

                                <li>dreptul la concediu de odihna anual;</li>

                                <li>dreptul la egalitate de sanse si de tratament;</li>

                                <li>dreptul la securitate si sanatate in munca;</li>

                                <li>dreptul la acces la formare profesionala, in conditiile actelor aditionale</li>

                            </ol>

                        </li>
                        <br/>


                        <li>Salariatului ii revin, in principal, urmatoarele obligatii:<br/>

                            <ol style="list-style-type:lower-latin; text-indent:0;">

                                <li>obligatia de a realiza norma de munca sau, dupa caz, de a indeplini atributiile ce ii revin conform fisei postului;</li>

                                <li>obligatia de a respecta disciplina muncii;</li>

                                <li>obligatia de fidelitate fata de angajator in executarea atributiilor de serviciu;</li>

                                <li>obligatia de a respecta masurile de securitate si sanatate a muncii in unitate;</li>

                                <li>obligatia de a respecta secretul de serviciu.</li>

                                <li>obligatia de a se supune obiectivelor de performanta individuala impuse conform responsabilitatilor stabilite prin fisa postului, precum si
                                    criteriilor de evaluare a realizarii acestora, asa cum sunt acestea descrise in "Procedura de evaluare a performantelor pentru angajatii RBL"-
                                    parte integranta a Regulamentului Intern RBL.
                                </li>

                            </ol>

                        </li>
                        <br/>


                        <li>Angajatorul are, in principal, urmatoarele drepturi:<br/>

                            <ol style="list-style-type:lower-latin; text-indent:0;">

                                <li>sa dea dispozitii cu caracter obligatoriu pentru salariatul, sub rezerva legalitatii lor;</li>

                                <li>sa exercite controlul asupra modului de indeplinire a sarcinilor de serviciu;</li>

                                <li>sa constate savarsirea abaterilor disciplinare si sa aplice sanctiunile corespunzatoare, potrivit legii, contractului colectiv de munca
                                    aplicabil si regulamentului intern;
                                </li>

                                <li>sa stabileasca obiectivele de performanta individuala ale salariatului.</li>

                            </ol>

                        </li>
                        <br/>


                        <li>Angajatorului ii revin, in principal, urmatoarele obligatii:<br/>

                            <ol style="list-style-type:lower-latin; text-indent:0;">

                                <li>sa inmaneze Salariatului un exemplar din contractul individual de munca anterior inceperii activitatii;</li>

                                <li>sa acorde salariatului toate drepturile ce decurg din contractele individuale de munca, din contractul colectiv de munca aplicabil si din
                                    lege;
                                </li>

                                <li>sa asigure permanent conditiile tehnice si organizatorice avute in vedere la elaborarea normelor de munca si conditiile corespunzatoare de
                                    munca;
                                </li>

                                <li>sa informeze Salariatul asupra conditiilor de munca si asupra elementelor care privesc desfasurarea relatiilor de munca;</li>

                                <li>sa elibereze, la cerere, toate documentele care atesta calitatea de salariat a solicitantului, respectiv activitatea desfasurata de acesta,
                                    durata activitatii, salariul, vechimea in munca, in meserie si in specialitate;
                                </li>

                                <li>sa asigure confidentialitatea datelor cu caracter personal ale Salariatului;</li>

                                <li>sa evalueze salariatul numai dupa obiectivele de performanta individuale impuse, precum si dupa criteriile de evaluare a realizarii acestora,
                                    asa cum sunt acestea descrise in "Procedura de evaluare a performantelor pentru angajatii RBL"- parte integranta a Regulamentului Intern RBL.
                                </li>

                            </ol>

                        </li>
                        <br/>

                    </ol>

                    <br/>
                    <br/>
                </td>

            </tr>


            <tr>

                <td style="text-indent:-15px; padding-left:25px;">N. <strong>Dispozitii finale</strong><br/>

                    Prevederile prezentului contract individual de munca se completeaza cu dispozitiile Legii nr. 53/2003 - Codul Muncii si ale contractului colectiv de munca
                    aplicabil incheiat la nivelul angajatorului/grupului de angajatori/ramuri/national, inregistrat sub nr. ............../.............. la Inspectoratul
                    teritorial de munca al judetului/municipiului ......../Ministerul Muncii si Solidaritatii Sociale.<br/>

                    Orice modificare privind clauzele contractuale in timpul executarii contractului individual de munca impune incheierea unui act aditional la contract, conform
                    dispozitiilor legale cu exceptia situatiilor in care o asemenea modificare este prevazuta in mod expres de lege.<br/>

                    Prezentul contract individual de munca s-a incheiat astazi, <strong>{$info.ContractDate|default:'................................'}</strong> in doua exemplare,
                    cate unul pentru fiecare parte.<br/>

                    <br/>

                </td>

            </tr>


            <tr>

                <td style="text-indent:-15px; padding-left:25px;">O. Conflictele in legatura cu incheierea, executarea, modificarea, suspendarea sau incetarea prezentului contract
                    individual de munca sunt solutionate de instanta judecatoreasca competenta material si teritorial, potrivit legii.</li>

                    </ol>


                    <br/><br/>


                    <table width="100%" align="center">

                        <tr>

                            <td width="70%" colspan="2">ANGAJATOR,</td>

                            <td width="30%" align="right">SALARIATUL,</td>

                        </tr>


                        <tr>

                            <td colspan="2"><strong>{$info.CompanyName|default:'.......................'}</strong></td>

                            <td align="right">&nbsp;</td>

                        </tr>

                        {*
                            <tr>

                                <td colspan="2" align="center">REPREZENTANT LEGAL,</td>

                                <td align="right">&nbsp;</td>

                            </tr>
                        *}
                        <tr>

                            <td colspan="2"><strong>Reprezentant Legal,<br/>{$info.LegalFullName|default:'............................'}        </strong></td>

                            {*<td ><strong>Sef Departament Resurse Umane,	<br />{$info.HRFullName|default:'...............'}</strong></td>*}

                            <td align="right"><strong>{$info.FullName}</strong></td>

                        </tr>

                        <tr>

                            <td colspan="2"><strong>.................................................</strong></td>

                            {*<td ><strong>.................................................</strong></td>*}

                            <td align="right"><strong>.................................................</strong></td>

                        </tr>

                    </table>


                    <br/><br/>


                    <p>Pe data
                        de {if !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.StopDate|date_format:'%d.%m.%Y'}{else}.......................................{/if}
                        prezentul contract inceteaza in temeiul
                        art. {if !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.Law|default:'................'}{else}................{/if} din Legea nr. 53/2003 -
                        Codul muncii, cu modificarile si completarile ulterioare in urma indeplinirii procedurii legale.</p>


                    <br/><br/>

                    {*
                    <p style="text-align:center">ANGAJATOR,</p>

                    <table width="100%" align="center">

                        <tr>

                                <td width="50%"><strong>Sef Departament Resurse Umane,	<br />{$info.HRFullName|default:'........................................'}</strong></td>

                        </tr>

                        <tr>

                                <td width="50%"><br  /><br />.................................................</td>

                        </tr>

                    </table>

                    <br /><br />
                *}
                    <br/>

    </div>
{/if}
