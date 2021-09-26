{if !empty($smarty.get.PersonID)}
    <div style="width: 800px">
        {if $info.CompanyID}
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="400">&nbsp;</td>
                    <td align="right"><img src="{$info.CompanyPhoto}"/></td>
                </tr>
            </table>
            <br clear="all"/>
        {/if}

        <h3>Nr ........ Din .................</h3>
        <br>
        <h1 style="text-align: center;">ADEVERINTA</h1>
        <br>
        <p>Prin prezenta se adevereste ca d-l / d-na {$info.FullName} avand CNP {$info.CNP}, este salariat la <b>{$info.CompanyName}</b>, divizia <b>{$info.Division}</b> pe
            perioada {$info.ContractType}.</p>
        <p>Confirmam ca societatea noastra, in calitate de angajator, si-a indeplinit obligatiile la<br>
            constituirea Fondului asigurarior sociale in temeiul prevederior art. 53 alin.(1) si<br>
            alin.(2) din Legea nr. 145/1997 si nu are de achitat sume restante, reprezentand:
        <ul>
            <li>Contributia de 5.5%, raportata la fondul de salarii, datorata de angajator
            <li>Contributia de 5.5% aplicata veniturilor salariale brute realizate lunar de angajati
            <li>Contributia de 0.85% penru concedii si indemnizatii, raportata la fondul de salarii, datorata de angajator
        </ul>
        <p>Contributia a fost platita din contul societatii in contul Trezoreriei Brasov<br>RO40TREZ1315502XXXXXXXXX</p>
        <p>Am eliberat prezenta adverinta pentru a-i servi la spital.</p>
        <p>Mentionam ca d-l / d-na {$info.FullName} in ultimele 12 luni {if $info.cm_days>0}a beneficiat de {$info.cm_days|default:'.......'}{else}nu a beneficiat de{/if} zile de
            concediu medical.</p>
        <br>
        <p><b>Aprobat</b><br>
            Functie: Administrator<br>
            Nume si prenume:<br>
            Semnatura:<br>
            <br><br>
            <b>Intocmit</b><br>
            Functie:<br>
            Nume si prenume:<br>
            Semnatura:
        </p>
        <table cellpacing="0" cellpadding="0" border="0">
            <tr>
                <td></td>
            </tr>
        </table>
    </div>
{/if}