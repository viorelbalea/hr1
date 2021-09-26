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

        <p style="text-align:left; margin:0px;">
            {$info.CompanyName|default:'.......................'}<br/>
            {$info.CompanyAddress|default:'..............................................'}<br/>
            CUI: {$info.CIF|default:'......................................'}<br/>
            Nr. Reg. Com: {$info.RegComert|default:'........................'}<br/>
        </p>
        <br/>

        <p style="text-align:center; font-size:14pt;"><b>NOTA DE LICHIDARE</b> (ramane la societate)</p>

        <br/>

        <p style="text-indent:0px; text-align:left; margin:0px;">
            NUMELE SI PRENUMELE: {$info.FullName}<br/>
            FUNCTIA: {$info.Function|default:'........................'}<br/>
            NR. MARCA : {$info.ContractNo|default:'...........'}
            /{if !empty($info.ContractDate) && $info.ContractDate != '00.00.0000'}{$info.ContractDate}{else}..................{/if}<br/>
            MOTIVUL INTOCMIRII NOTEI DE LICHIDARE: <b>ART. {$info.Law|default:'................'} DIN LEGEA NR. 53/2003 </b>de la data
            de {if !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.StopDate|date_format:'%d.%m.%Y'}{else}.............................{/if}
        </p>

        <br/>

        <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr>
                <td colspan="4" align="center"><b>DEBITE NELICHIDATE</b></td>
            </tr>
            <tr>
                <td width="30%" align="center"><b>NATURA DEBITULUI</b></td>
                <td width="15%" align="center"><b>SUMA</b></td>
                <td width="30%" align="center"><b>RESPONSABIL</b></td>
                <td width="25%" align="center"><b>SEMNATURA</b></td>
            </tr>
            <tr>
                <td>Avansuri spre decontare</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Echipament de protectie</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Cazare</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Inventar materiale, unelte, echipamente</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Masina</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>SSM</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Resurse Umane - Personal</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Telefon</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Laptop</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>

        <br/><br/>

        <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr>
                <td width="25%" align="center"><b>NATURA<br/>DEBITULUI*</b></td>
                <td width="25%" align="center"><b>TITLU<br/>EXECUTOR**</b></td>
                <td width="25%" align="center"><b>SUMA</b></td>
                <td width="25%" align="center"><b>CREDITORUL</b></td>
            </tr>

            <tr>
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
            </tr>

            <tr>
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
            </tr>

        </table>

        <br/><br/>

        <table width="100%" align="center">
            <tr>
                <td width="65%">DIRECTOR GENERAL</td>
                <td width="35%" align="middle">DIRECTOR ECONOMIC</td>
            </tr>
            <tr>
                <td width="65%">{$info.LegalFullName|default:'.................'}</td>
                <td width="35%" align="middle">{$info.HRFullName|default:'.................'}</td>
            </tr>
        </table>

        <br/>

        <p style="font-size:10pt; text-align:left; margin:0px;">
            *) Imputatie, despagubire, suma datorata pentru marfuri cu plata in rate, suma datorata cu titlu de obligatie de intretinere<br/>
            **) Dispozitie de retinere, hotarare judecatoreasca, angajament<br/>
            ***) Se semneaza dupa completarea tuturor datelor
        </p>

        <br/>

        <p style="text-indent:0px; text-align:left; margin:0px;">
            Am primit urmatoarele documente la plecare:<br/>
            1. DECIZIE INCETARE CIM<br/>
            2. COPIE NOTA DE LICHIDARE <br/>
            3. ADEVERINTA VECHIME
        </p>

        <br/>

        <table width="100%" align="center">
            <tr>
                <td width="75%">DATA {$smarty.now|date_format:'%d.%m.%Y'}</td>
                <td width="25%" align="middle">SEMNATURA</td>
            </tr>
            <tr>
                <td width="75%">&nbsp;</td>
                <td width="25%" align="middle">..................................</td>
            </tr>
        </table>

    </div>
{/if}