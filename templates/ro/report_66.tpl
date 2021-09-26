{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>
            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>
            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>
            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>
            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>

        <p style="text-align:center"><strong>ACTUL ADITIONAL NR. .............</strong><br/>
            <strong>LA CONTRACTUL INDIVIDUAL DE MUNCA</strong>
            <strong>{if $info.ContractDate|@date_format:'%Y' != '2011'}NR. ................. (ITM) si {/if}NR. {$info.ContractNo|default:'.......................'}
                /{$info.ContractDate|default:'.......................'} (REVISAL)</strong></p>
        <p>Prezentul act aditional a fost incheiat la data de ............................ intre:</p>

        <ol style="margin-bottom:0px;">
            <li><strong>{$info.CompanyName|default:'..............................'}</strong>, societate inregistrata legal si care isi desfasoara activitatea in conformitate cu
                legile din Romania, cu sediul social in {$info.DistrictName|default:'.......................'}
                , {$info.CompanyAddress|default:'.....................................'}, inmatriculata la Registrul Comertului din Bucuresti sub
                nr. {$info.RegComert|default:'.......................'}, avand codul unic de inregistrare {$info.CIF|default:'.......................'}, legal reprezentata
                de {$info.LegalFullName|default:'........................................'}, in calitate de Director General (denumita in cele ce urmeaza
                "<strong>Societatea</strong>"); si
            </li>
            <li style="margin-bottom:0px;">{if $info.Sex == 'M'}Domnul{else}Doamna{/if} <b>{$info.FullName}</b>, domiciliat in
                <strong>{$info.PersonAddress|default:'.............................'}</strong>, {if $info.Sex == 'M'}posesor al{else}posesoare a{/if} cartii de identitate <strong>seria {$info.BISerie|default:'.........'}
                    nr. {$info.BINumber|default:'....................'}</strong>, eliberata de <b>{$info.BIEmitent|default:'.......................'}</b>, la data de
                <b>{$info.BIStartDate|default:'..................'}</b>, CNP <b>{$info.CNP|default:'.......................'}</b> (denumit in cele ce urmeaza
                "<strong>Salariatul</strong>"),
            </li>
        </ol>

        <span style="margin-top:0px;">Denumite in continuare individual "<strong>Partea</strong>" si colectiv "<strong>Partile</strong>".
</span>

        <p style="text-align:center"><strong>Avand in vedere:</strong></p>

        <ul>
            <li>Faptul ca Partile au incheiat la data de {$info.ContractDate|default:'.......................'} un contract individual de munca ("<strong>Contractul Individual de
                    Munca</strong>") inregistrat {if $info.ContractDate|@date_format:'%Y' != 2011}sub nr. ...................... (Inspectoratul Teritorial de Munca) si {/if}sub
                nr. {$info.ContractNo|default:'.......................'} (REVISAL)
            </li>
            <li>Faptul ca Partile doresc sa modifice anumite elemente ale Contractului Individual de Munca.</li>
        </ul>

        <p>In temeiul articolului 41 alineatul 1 din Legea 53/2003 si Legea 40/2011, Partile hotarasc modificarea Contractului Individual de Munca, dupa cum urmeaza:</p>

        <ol>
            <li>Articolul "<strong>J. Salariul</strong>" din Contractul Individual de Munca se modifica si va avea urmatorul continut:<br/></li>
            <ol><i>
                    <li>Incepand cu data de ................., salariul de baza lunar brut va fi de .................... <strong>lei</strong> si include toate sporurile prevazute
                        de legislatia in vigoare aplicabila.
                    </li>
                    <li>Alte elemente constitutive:</li>
                    <ol>
                        <li>Sporuri: sporul de vechime in munca este inclus in salariul de baza, sporul pentru orele suplimentare si pentru orele lucrate in zilele libere si in
                            zilele de sarbatori legale este inclus in salariul de baza, sporul pentru clauza de mobilitate este inclus in salariul de baza;
                        </li>
                        <li>Indemnizatii: -</li>
                        <li>Alte adaosuri: -</li>
                    </ol>
                    <li>Orele suplimentare prestate in afara programului normal de lucru sau in zilele in care nu se lucreaza ori in zilele de sarbatori legale se compenseaza cu
                        ore libere platite sau se platesc cu un spor la salariu (inclus in salariul de baza), conform prevederilor Contractului Colectiv de Munca aplicabil sau ale
                        Codului Muncii.
                    </li>
                    <li>Datele la care se plateste salariul sunt 15 si 30 ale lunii."</li>
                </i></ol>
        </ol>

        <table width="100%" align="center">
            <tr>
                <td width="50%"><strong>{$info.CompanyName|default:'.......................'}</strong></td>
                <td width="50%" align="right"><strong>ANGAJAT</strong></td>
            </tr>
            <tr>
                <td width="50%">Prin: {$info.LegalFullName|default:'........................................'}</td>
                <td width="50%" align="right">{$info.FullName}</td>
            </tr>
            <tr>
                <td width="50%">In calitate de Director general</td>
                <td width="50%" align="right">&nbsp;</td>
            </tr>
            <tr>
                <td width="50%">_______________________________</td>
                <td width="50%" align="right">_______________________________</td>
            </tr>
        </table>
    </div>
{/if}