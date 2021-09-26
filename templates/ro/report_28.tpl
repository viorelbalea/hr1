{if !empty($smarty.get.PersonID)}
    <div style="width: 800px">

        <b>Denumire angajator / institutie:</b> {$info.CompanyName}<br/>
        <b>Sediu angajator / institutie:</b> {$info.CompanyAddress|default:'..............................................'}<br/>
        <b>Nr. O.R.C.:</b> {$info.RegComert|default:'.......................................................................'}<br/>
        <b>Cod Fiscal:</b> {$info.CIF|default:'........................................................................'}<br/>
        <b>Telefon / fax:</b> {$info.PhoneNumberA|default:'.........................'} / {$info.FaxNumber|default:'..............................'}

        <h1 style="text-align: center;">ADEVERINTA</h1>
        <div style="text-align: center;"><b>nr ......... / {$smarty.now|date_format:'%d.%m.%Y'}</b></div>
        <br>

        <p>Se adevereste prin prezenta ca {if $info.Sex == 'M'}domnul{else}doamna{/if} {$info.FullName} cu CNP {$info.CNP},<br/>in functia
            de {$info.Function|default:'...........................................'} este {if $info.Sex == 'M'}salariat al{else}salariata a{/if} societatii din data
            de {$info.StartDate} pana in prezent.<br/></p>

        <p>Mentionam ca {if $info.Sex == 'M'}salariatul{else}salariata{/if} a realizat timp de 12 luni, de la data {$info.StartDate} pana la data<br/>
            {if !empty($info.StopDate) && $info.StopDate != '00.00.0000'}{$info.StopDate}{else}........................{/if} anterior nasterii copilului, venituri cu caracter
            salarial potrivit prevederilor Legii nr. 571/2003<br/>cu modificarile si completarile ulterioare si nu a avut intreruperi sau concedii fara plata.</p>

        <p>Stagiul avut in vedere la stabilirea dreptului acordat potrivit OUG 148/2005, cu modificarile si completarile<br/>ulterioare, privitor la concediul pentru cresterea
            copilului in varsta de 2 ani, respectiv 3 ani<br/>
            (copil cu handicap) este urmatorul:</p>

        <table width="100%" cellpacing="0" cellpadding="2" border="1">
            <tr>
                <td align="center" width="100"><b>LUNA</b></td>
                <td align="center" width="100"><b>ANUL</b></td>
                <td align="center" width="100"><b>Numar zile lucratoare in luna</b></td>
                <td align="center" width="100"><b>Numar zile lucrate efectiv</b></td>
                <td align="center"><b>OBSERVATII</b></td>
            </tr>
            <tr>
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
            </tr>
            <tr>
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
            </tr>
            <tr>
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
            </tr>
            <tr>
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
            </tr>
            <tr>
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
            </tr>
            <tr>
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
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>

        <p>In perioada {if !empty($info.StopDate) && $info.StopDate != '00.00.0000'}{$info.StopDate}{else}........................{/if} pana la .......................... a
            beneficiat de indemnizatie de maternitate / <br>
            indemnizatie pentru cresterea copilului.</p>

        <p>La data de .............................. se implinesc cele 42 de zile din concediul de lauzie.</p>

        <p>Prin cererea inregistrata cu nr. {$info.CICSuspensionDemandNo|default:'...........................'} i-a fost aprobata suspendarea activitatii incepand cu data<br>
            de {if !empty($info.StopDate) && $info.StopDate != '00.00.0000'}{$info.StopDate}{else}........................{/if}, ultima zi de plata a indemnizatiei de maternitate a
            fost .................................</p>

        <p>S-a eliberat prezenta pentru obtinerea indemnizatiei pentru cresterea copilului acordata in conformitate cu OUG 148/2005<br>
            modificata si completata de OUG 44/2006, privind sustinerea familiei in vederea cresterii copilului.</p>

        <p>{if $info.Sex == 'M'}Subsemnatul{else}Subsemnata{/if} {$info.FullName}, avand functia de {$info.Function|default:'...........................................'} declar ca
            datele cuprinse in prezenta adeverinta sunt reale.</p>

        <p style="text-align:right">
            Luat la cunostinta:<br/>
            Salariat: {$info.FullName}<br/>
            Semnatura:.....................<br/>
            Data: {$smarty.now|date_format:'%d.%m.%Y'}
        </p>

    </div>
{/if}