{if !empty($smarty.get.PersonID)}    <div style="width:800px; margin:0px;">        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>        <p style="text-align:center"><strong>CONTRACT INDIVIDUAL DE MUNCA</strong><br/>            incheiat si inregistrat sub nr. {$info.ContractNo|default:'.......................'}            /{if !empty($info.ContractDate) && $info.ContractDate != '00.00.0000'}{$info.ContractDate|date_format:'%d.%m.%Y'}{else}...........................{/if}            in registrul general de evidenta a salariatilor</p>        <table width="100%" cellspacing="0" cellpadding="0" border="0">            <tr>                <td style="text-indent:-15px; padding-left:25px;">                    A. <strong>Partile contractului</strong><br/>                    Angajator - persoana juridica <strong>{$info.CompanyName|default:'..............................'}</strong>, cu sediul in                    <strong>{$info.DistrictName|default:'.......................'}</strong>, inregistrata la Registrul Comertului sub nr.                    <strong>{$info.RegComert|default:'.......................'}</strong>, cod fiscal <strong>{$info.CIF|default:'.......................'}</strong>, telefon                    <strong>{$info.PhoneNumberA|default:'..................................'}</strong>, reprezentata legal prin                    <strong>{$info.LegalFullName|default:'........................................'}</strong>, in calitate de <strong>director general</strong>,<br/><br/>                    si<br/><br/>                    {if $info.Sex == 'M'}Salariatul{else}Salariata{/if} {$info.FullName}, domiciliat in                    <b>{$info.PersonAddress|default:'......................'}</b>, {if $info.Sex == 'M'}posesor al{else}posesoare a{/if} cartii de identitate                    <strong>seria {$info.BISerie|default:'.........'} nr. {$info.BINumber|default:'....................'}</strong>, eliberata de                    <b>{$info.BIEmitent|default:'.......................'}</b>, la data de <b>{$info.BIStartDate|default:'..................'}</b>, CNP                    <b>{$info.CNP|default:'.......................'}</b>,<br/><br/>                    am incheiat prezentul contract individual de munca in urmatoarele conditii asupra carora am convenit:                    <br/>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">B. <strong>Obiectul contractului: prestarea muncii si plata salariului</strong><br/><br/>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">C. <strong>Durata contractului:</strong><br/>                    a)                    <b>{if $info.ContractType==1}determinata{elseif $info.ContractType==2}nedeterminata{else}...............................{/if}</b>, {if $info.Sex == 'M'}salariatul{else}salariata{/if} {$info.FullName}                    , urmand sa inceapa activitatea la data de {$info.WorkStartDate|default:'..............................'}.<br/><br/>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">D. <strong>Locul de munca</strong><br/>                    1.Activitatea se desfasoara in <strong>departamentul {$info.Department|default:'..............................'} din sediul social al                        societatii, {$info.CompanyAddress|default:'.......................'}.</strong><br/>                    2.Tinand cont de natura atributiilor {if $info.Sex == 'M'}Salariatului{else}Salariatei{/if}, Partile convin                    ca {if $info.Sex == 'M'}Salariatul{else}Salariata{/if} sa-si desfasoare activitatea si in locatiile indicate din cand in cand de catre Angajator, in functie de                    necesitatile activitatii Angajatorului. In schimbul mobilitatii in desfasurarea activitatii sale, Salariatul va beneficia de un spor de 300 Ron care este inclus                    in salariul de baza.<br/><br/>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">E. <strong>Felul muncii</strong><br/>                    Functia/meseria <b>{$info.Function|default:'...............................'} (cod COR - {$info.COR|default:'..............'})</b> conform Clasificarii                    ocupatiilor din Romania<br/><br/>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">F. <strong>Atributiile postului</strong><br/>                    Atributiile postului sunt prevazute in fisa postului, Anexa 1 la prezentul contract individual de munca.<br/><br/>                    F1. <strong>Criteriile de evaluare ale postului</strong><br/>                    Criteriile de evaluare a activitatii profesionale a salariatului sunt enumerate in Anexa 2 la prezentul contract individual de munca.<br/><br/>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">G. <strong>Conditii de munca</strong><br/>                    1.Activitatea se desfasoara in conformitate cu prevederile Legii nr. 31/1991<br/>                    2.Activitatea prestata se desfasoara in <strong>conditii normale de munca</strong>, potrivit Legii nr. 263/2010 privind sistemul unitar de pensii publice, cu                    modificarile si completarile ulterioare.<br/><br/>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">H. <strong>Durata muncii</strong><br/>                    1. O norma intreaga, durata timpului de lucru fiind de <strong>{$info.WorkNorm|default:'............'}                        ore/zi, {if !empty($info.WorkNorm)}{math equation="5*x" x=$info.WorkNorm}{else}.................{/if} ore/saptamana</strong>.<br/>                    a) Repartizarea programului de lucru se face dupa cum urmeaza: <strong>{if !empty($info.WorkInterval)}{$info.WorkInterval}{else}................{/if} ore zi                        (pauza de masa {if !empty($info.LunchBreakInterval)}{$info.LunchBreakInterval}{else}........{/if} minute inclusa in program)</strong>.<br/>                    b) Programul de lucru se poate modifica in conditiile Regulamentului de Ordine Interioara aplicabil.<br/><br/></td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">I. <strong>Concediul</strong><br/>                    Durata concediului anual de odihna este de <strong>{$info.ContractVacationDays|default:'.........'} zile lucratoare</strong>, in raport cu durata                    muncii.<br/><br/>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">J. <strong>Salariul:</strong><br/>                    1. Salariul de baza lunar brut: <strong>{$info.BrutSalary|default:'.......................'} lei, include toate sporurile prevazute de legislatia in vigoare                        aplicabila</strong><br/>                    2. Alte elemente constitutive:<br/>                    a) sporuri: Sporul de vechime in munca este inclus in salariul de baza, sporul pentru orele suplimentare si pentru orele lucrate in zilele libere si in zilele                    de sarbatori legale este inclus in salariul de baza, sporul pentru clauza de mobilitate este inclus in salariul de baza;<br/>                    b) indemnizatii: -<br/>                    c) alte adaosuri: -<br/>                    3. Orele suplimentare prestate in afara programului normal de lucru sau in zilele in care nu se lucreaza ori in zilele de sarbatori legale se compenseaza cu ore                    libere platite sau se platesc cu un spor la salariu, conform Regulamentului de Ordine Interioara aplicabil, Legii nr. 53/2003 - Codul muncii sau Legii nr.                    40/2011 - Noul Cod al Muncii<br/>                    4. Datele la care se plateste salariul sunt <strong>................. ale lunii</strong>.<br/><br/>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">K. <strong>Drepturi si obligatii ale partilor privind securitatea si sanatatea in munca:</strong><br/>                    a) echipament individual de protectie __________________________________;<br/>                    b) echipament individual de lucru __________________________________;<br/>                    c) materiale igienico-sanitare __________________________________;<br/>                    d) alimentatie de protectie __________________________________;<br/>                    e) alte drepturi si obligatii privind sanatatea si securitatea in munca _________________________.<br/><br/>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">L. <strong>Alte clauze:</strong><br/>                    a)perioada de proba este de: <strong>{$info.ContractProbationPeriod|default:'................'} zile calendaristice</strong> - pe durata sau la sfarsitul                    perioadei de proba, contractul individual de munca poate inceta exclusiv printr-o notificare scrisa, fara preaviz la initiativa oricareia dintre parti;<br/>                    b)perioada de preaviz in cazul concedierii este de <strong>{$info.ContractDismissalPeriod|default:'................'} zile lucratoare</strong>, Legii nr.                    53/2003 - Codul muncii si Legii nr. 40/2011 - Noul Cod al Muncii;<br/>                    c)perioada de preaviz in cazul demisiei este de <strong>{$info.ContractDismissalPeriod|default:'............'} zile lucratoare</strong>, Legii nr. 53/2003 -                    Codul muncii si Legii nr. 40/2011 - Noul Cod al Muncii;<br/>                    d)alte clauze:<br/><br/>                    <strong>Obligatia de confidentialitate</strong>, cu urmatoarele prevederi:                    <ol style="text-indent:-5px; font-style:italic;">                        <li>Pe toata durata Contractului, precum si pe perioada nelimitata de la incetarea Contractului, indiferent de cauza incetarii, Salariatul                            - {if $info.Sex=='F'}doamna{elseif $info.Sex=='M'}domnul{else}domnul/ doamna{/if}                            <strong>{$info.FullName|default:'...........................................................................'}</strong> va pastra confidentialitatea                            absoluta si nu va dezvalui sau folosi, direct sau indirect, secrete profesionale si/sau informatii si/sau documente (fie acestea tehnice, stiintifice,                            comerciale sau de alta natura) confidentiale legate de activitatea si organizarea interna a Societatii, sistemul de salarizare, agentii, clientii,                            clientii potentiali sau furnizorii Societatii, afiliatii si/sau alte legaturi de afaceri ale Societatii la care Salariatul are acces sau de care ar                            putea avea cunostinta in decursul angajarii sale sau prin natura functiei.                        </li>                        <li>In sensul acestui articol, informatiile si/sau documente confidentiale includ orice informatie sau document care incorporeaza o informatie legata de                            structura interna a Societatii, de remunerarea salariatilor, activitatile comerciale si/sau financiare ale Societatii sau ale agentilor, clientilor,                            clientilor potentiali sau furnizorilor acestuia, incluzand in mod special:                        </li>                        <ol style="list-style-type:lower-latin;">                            <li>informatiile privind drepturile salariale (salariul de baza, indemnizatiile si sporurile cu caracter permanent, salariul net) si beneficiile                                permanente si ocazionale ale Salariatului - {if $info.Sex=='F'}doamna{elseif $info.Sex=='M'}domnul{else}domnul/ doamna{/if}                                <strong>{$info.FullName|default:'...........................................................................'}</strong>, precum si ale celorlalti                                salariati si de care Salariatul are cunostinta;                            </li>                            <li>informatiile privind datele cu caracter personal ale angajatilor si procedurile interne ale Societatii, daca Salariatul nu este autorizat sa ofere                                aceste informatii;                            </li>                            <li>informatiile si metodele de afaceri ale Societatii (inclusiv tarife si onorarii pentru clienti, dezvoltare de produse, programe de marketing si                                publicitate, evaluari de costuri, bugete, cifra de afaceri, volume de vanzari si alte informatii financiare);                            </li>                            <li>informatii legate de clientii Societatii, incluzand toate datele personale furnizate de clienti si informatii privind solvabilitatea lor sau alte                                informatii obtinute de la clienti sau pe alta cale;                            </li>                            <li>detalii si termeni ai contractelor Societatii cu clienti si detalii referitoare la executarea acestor contracte;</li>                            <li>informatii legate de activitatea desfasurata de catre Salariatul - {if $info.Sex=='F'}doamna{elseif $info.Sex=='M'}domnul{else}domnul/ doamna{/if}                                <strong>{$info.FullName|default:'...........................................................................'}</strong> in cadrul Societatii in                                vederea indeplinirii atributiilor stabilite in sarcina sa;                            </li>                            <li>informatii/date legate de materialele utilizate de catre Salariatul                                - {if $info.Sex=='F'}doamna{elseif $info.Sex=='M'}domnul{else}domnul/ doamna{/if}                                <strong>{$info.FullName|default:'...........................................................................'}</strong>. in desfasurarea activitatii                                sale in cadrul Societatii. In acest sens, Partile convin in mod expres ca Salariatul nu va putea sa copieze/reproduca sub orice forma niciun                                document pe care il utilizeaza sau de care are cunostinta in cadrul activitatii desfasurate de catre acesta in cadrul Societatii sau pentru                                indeplinirea atributiilor de serviciu;                            </li>                            <li>informatii/date legate de activitatea desfasurata de catre ceilalti salariati ai Societatii despre care Salariatul                                - {if $info.Sex=='F'}doamna{elseif $info.Sex=='M'}domnul{else}domnul/ doamna{/if}                                <strong>{$info.FullName|default:'...........................................................................'}</strong> are cunostinta, indiferent                                de conditiile in care acesta din urma a cunoscut datele/informatiile respective si indiferent daca acesta are sau nu dreptul de a utiliza astfel de                                informatii/date;                            </li>                            <li>orice alte informatii pe care Salariatul - {if $info.Sex=='F'}doamna{elseif $info.Sex=='M'}domnul{else}domnul/ doamna{/if}                                <strong>{$info.FullName|default:'...........................................................................'}</strong> le cunoaste sau despre care                                acesta ar putea avea cunostinta in timpul/in legatura cu activitatea desfasurata de catre acesta sau de catre orice alta persoana angajata/ care a                                fost angajata in cadrul Societatii.                            </li>                        </ol>                        <li>In vederea respectarii obligatiei de confidentialitate, Salariatul - {if $info.Sex=='F'}doamna{elseif $info.Sex=='M'}domnul{else}domnul/ doamna{/if}                            <strong>{$info.FullName|default:'...........................................................................'}</strong> are obligatia de a nu folosi in                            afara Societatii niciun fel de material/informatie/data ce apartine Societatii sau este legata de activitatea acesteia (indiferent sub ce forma se                            gasesc aceste materiale/informatii/date si indiferent de modalitatea in care acestea ar putea fi obtinute de catre Salariatul).                        </li>                        <li>Salariatul - {if $info.Sex=='F'}doamna{elseif $info.Sex=='M'}domnul{else}domnul/ doamna{/if}                            <strong>{$info.FullName|default:'...........................................................................'}</strong>, in cazul in care nu respecta                            obligatia de confidentialitate prevazuta mai sus, se face vinovata de comiterea unei abateri disciplinare. De asemenea, Salariatul poate fi obligat la                            plata de daune-interese catre Societate, in conformitate cu prevederile legale aplicabile pentru pagubele produse Societatii prin nerespectarea                            obligatiei sale de confidentialitate."                        </li>                        <li>Salariatul - {if $info.Sex=='F'}doamna{elseif $info.Sex=='M'}domnul{else}domnul/ doamna{/if}                            <strong>{$info.FullName|default:'...........................................................................'}</strong> se obliga sa returneze                            Societatii toate documentele proprietatea acesteia, incluzand dar fara a se limita la: desene, negative, rapoarte, manuale, corespondenta, liste de                            clienti, aplicatii informatice ori alte materiale, inclusiv copiile acestora, care relationeaza in orice fel cu activitatea Societatii, si care au fost                            produse sau obtinute de catre Salariatul in orice mod, pe durata derularii contractului individual de munca. De asemenea, Salariatul                            - {if $info.Sex=='F'}doamna{elseif $info.Sex=='M'}domnul{else}domnul/ doamna{/if}                            <strong>{$info.FullName|default:'...........................................................................'}</strong> se obliga sa nu pastreze copii,                            note sau rezumate ale documentelor mai sus mentionate.                        </li>                    </ol>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">M. <strong>Drepturi si obligatii generale ale partilor:</strong>                    <p style=" padding-left:30px; text-indent: 0;">1. Salariatul are, in principal, urmatoarele drepturi:<br/>                    <p style=" padding-left:60px; text-indent: 0;">                        a. dreptul la salarizare pentru munca depusa;<br/>                        b. dreptul la repaus zilnic si saptamanal;<br/>                        c. dreptul la concediu de odihna anual;<br/>                        d. dreptul la egalitate de sanse si de tratament;<br/>                        e. dreptul la securitate si sanatate in munca;<br/>                        f. dreptul la acces la formare profesionala.                    </p>                    </p>                    <p style=" padding-left:30px; text-indent: 0;">2. Salariatului ii revin, in principal, urmatoarele obligatii:<br/>                    <p style=" padding-left:60px; text-indent: 0;">                        a. obligatia de a realiza norma de munca sau, dupa caz, de a indeplini atributiile ce ii revin conform fisei postului;<br/>                        b. obligatia de a respecta disciplina muncii;<br/>                        c. obligatia de fidelitate fata de angajator in executarea atributiilor de serviciu;<br/>                        d. obligatia de a respecta masurile de securitate si sanatate a muncii in unitate;<br/>                        e. obligatia de a respecta secretul de serviciu.                    </p>                    </p>                    <p style=" padding-left:30px;text-indent: 0;">3. Angajatorul are, in principal, urmatoarele drepturi:<br/>                    <p style=" padding-left:60px; text-indent: 0;">                        a. sa dea dispozitii cu caracter obligatoriu pentru salariatul, sub rezerva legalitatii lor;<br/>                        b. sa exercite controlul asupra modului de indeplinire a sarcinilor de serviciu;<br/>                        c. sa constate savarsirea abaterilor disciplinare si sa aplice sanctiunile corespunzatoare, potrivit legii, si Regulamentului de Ordine Interioara                        aplicabil.                    </p>                    </p>                    <p style=" padding-left:30px; text-indent: 0;">4. Angajatorului ii revin, in principal, urmatoarele obligatii:<br/>                    <p style=" padding-left:60px; text-indent: 0;">                        a. sa inmaneze Salariatului un exemplar din contractul individual de munca anterior inceperii activitatii;<br/>                        b. sa acorde Salariatului toate drepturile ce decurg din contractele individuale de munca, din Regulamentul de Ordine Interioara aplicabil si din lege;<br/>                        c. sa asigure permanent conditiile tehnice si organizatorice avute in vedere la elaborarea normelor de munca si conditiile corespunzatoare de munca;<br/>                        d. sa informeze Salariatul asupra conditiilor de munca si asupra elementelor care privesc desfasurarea relatiilor de munca;<br/>                        e. sa elibereze, la cerere, toate documentele care atesta calitatea de salariat a solicitantului, respectiv activitatea desfasurata de acesta, durata                        activitatii, salariul, vechimea in munca, in meserie si in specialitate;<br/>                        f. sa asigure confidentialitatea datelor cu caracter personal ale Salariatului.<br/><br/>                    </p>                    </p>                </td>            </tr>            <tr>                <td style="text-indent:-15px; padding-left:25px;">N. <strong>Dispozitii finale</strong><br/>                    Prevederile prezentului contract individual de munca se completeaza cu dispozitiile Legii nr. 53/2003 - Codul muncii, Legii nr. 40/2011 - Noul Cod al Muncii si                    ale Regulamentului de Ordine Interioara aplicabil.<br/>                    Orice modificare privind clauzele contractuale in timpul executarii contractului individual de munca impune incheierea unui act aditional la contract, conform                    dispozitiilor legale, cu exceptia situatiilor in care o asemenea modificare este prevazuta in mod expres de lege.<br/>                    Prezentul contract individual de munca s-a incheiat in doua exemplare, cate unul pentru fiecare parte.<br/></p>            <tr>                <td style="text-indent:-15px; padding-left:25px;">O. Conflictele in legatura cu incheierea, executarea, modificarea, suspendarea sau incetarea prezentului contract                    individual de munca sunt solutionate de instanta judecatoreasca competenta material si teritorial, potrivit legii.                </td>            </tr>        </table>        <br/>        <table width="100%" align="center" style="margin-top:10px;">            <tr>                <td width="50%">ANGAJATOR,</td>                <td width="50%" align="right">SALARIATUL,</td>            </tr>            <tr>                <td width="50%"><strong>{$info.CompanyName|default:'.......................'}</strong></td>                <td width="50%" align="right">{$info.FullName}</td>            </tr>            <tr>                <td width="50%">REPREZENTANT LEGAL,</td>                <td width="50%" align="right"><strong>Semnatura __________________</strong></td>            </tr>            <tr>                <td width="50%"><strong>{$info.LegalFullName|default:'........................................'}</strong></td>                <td width="50%" align="right" style="padding-right: 72px"><strong>Data {$smarty.now|date_format:'%d.%m.%Y'}</strong></td>            </tr>        </table>        <br/>        <p>Pe data de {if !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.StopDate|date_format:'%d.%m.%Y'}{else}___________________________{/if} prezentul contract            inceteaza in temeiul            art. {if !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.Law|default:'________________________'}{else}__________________________{/if} din Legea nr.            53/2003 - Codul muncii si Legea nr. 40/2011 - Noul Cod al Muncii, in urma indeplinirii procedurii legale.</p>        <p style="text-align:center">ANGAJATOR,</p>        <p style="text-align:center">_________________________</p>    </div>{/if}