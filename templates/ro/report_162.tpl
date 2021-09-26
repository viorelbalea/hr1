{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        <p style="text-align:left; margin:0px;">
            ANEXA 1^1
            <br/><br/>
            Denumirea angajatorului {$info.CompanyName|default:'.......................'}<br/>
            Cod Fiscal (CUI/CNP angajator/persoana fizica): {$info.CIF|default:'......................................'}<br/>
            Nr. de inregistrare la registrul comertului: {$info.RegComert|default:'........................'}<br/>
            <b>Nr. ............. / {$smarty.now|date_format:'%d.%m.%Y'}</b>
        </p>
        <br/>

        <p style="text-align:center; font-size:14pt;"><b>ADEVERINTA</b></p>

        <br/>

        <p style="text-indent:0px; text-align:left; margin:0px;">
            Prin prezenta se certifica faptul ca {if $info.Sex == 'M'}domnul{else}doamna{/if} {$info.FullName}, cnp {$info.CNP|default:'................................'}, act
            de<br/>
            identitate seria {$info.BISerie|default:'.........'} nr. {$info.BINumber|default:'...............'}, eliberat de {$info.BIEmitent|default:'.......................'}
            la data de {$info.BIStartDate|date_format:'%d.%m.%Y'|default:'..................'}, cu domiciliul in<br/>
            {$info.PersonAddress|default:'......................'}, are calitatea de salariat si <b>i s-a retinut si virat lunar conributia pentru asigurari sociale de sanatate</b>,
            potrivit Legii nr. 95/2006 privind reforma in domeniul sanatatii, cu modificarile si completarile ulterioare.
        </p>
        <br/>
        <p style="text-indent:0px; text-align:left; margin:0px;">
            Persoana mai sus mentionata figureaza in evidentele noastre cu urmatorii coasigurati (sot/sotie, parinti, aflati in intretinere):<br/>
            {if !empty($info.Coasig)}
                {$info.Coasig}
            {else}
                .........................................................................................................................................................................
            {/if}
        </p>
        <br/>
        <p style="text-indent:0px; text-align:left; margin:0px;">
            Prezenta adeverinta are o valabilitate de 3 luni de la data emiterii. Sub sanctiunile aplicate faptei de fals in acte publice,<br/>
            declar ca datele din adeverinta sunt corecte si complete.
        </p>
        <br/>
        <p style="text-indent:0px; text-align:left; margin:0px;">
            <b>Numarul de zile de concediu medical</b> de care {if $info.Sex == 'M'}angajatul{else}angajata{/if} <b>a beneficiat in ultimele 12 luni</b> este<br/>
            de {$info.CM.0} zile, pana la data {$smarty.now|date_format:'%d.%m.%Y'} aferente fiecarei afectiuni in parte*, dupa cum urmeaza:
        </p>

        <br/>

        <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr>
                <td width="30%" align="center"><b>Cod indemnizatie</b></td>
                <td width="70%" align="center"><b>Numar zile concediu medical in ultimele 12 luni</b></td>
            </tr>
            {foreach from=$info.CM key=k item=cm}
                {if $k > 0}
                    <tr>
                        <td>{$cm.CodInd}</td>
                        <td>{$cm.DaysNo}</td>
                    </tr>
                {/if}
            {/foreach}
        </table>

        <br/><br/>

        <table width="100%" align="center">
            <tr>
                <td width="65%">Reprezentant legal<br/><br/></td>
            </tr>
            <tr>
                <td width="65%">{$info.LegalFullName|default:'.................'}<br/><br/>(semnatura si stampila)</td>
            </tr>
        </table>

        <br/>
        ------------
        <p style="text-indent:0px; text-align:left; margin:0px; font-size: 10px;">
            Anexa 1^1 a a fost introdusa de pct. 9 al art. I din ORDINUL nr. 903 din 19 noiembrie 2007, publicat in MONITORUL OFICIAL nr. 827 din 4 decembrie 2007.<br/>
            *Art.8, ORDINUL MS/CNAS nr. 130/351 din 9 februarie 2011 privind modificarea si completarea Normelor de aplicare a prevederilor Ordonantei de urgenta a Guvernului nr.
            158/2005
            privind concediile si indemnizatiile de asigurari sociale de sanatate, aprobate prin Ordinul ministrului sanatatii si presedintelui Casei nationale de Asigurari de
            Sanatate nr. 60/32/2006,
            publicat in MONITORUL OFICIAL nr. 141 din 24 februarie 2011
        </p>
    </div>
{/if}