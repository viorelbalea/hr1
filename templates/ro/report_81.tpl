{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>
            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>
            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>
            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>
            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>

        <p style="text-align:center; font-size:18px;"><strong>NOTA DE LICHIDARE</strong></p>
        <br/>
        <table width="100%" align="center" cellspacing="0" cellpadding="0">
            <tr style="line-height:7px;">
                <td colspan="2">Numele si prenumele: {$info.FullName|default:'..............................'}<br/><br/></td>
            </tr>
            <tr style="line-height:7px;">
                <td colspan="2">Functia: {$info.Function|default:'..............................'}<br/><br/></td>
            </tr>
            <tr style="line-height:7px;">
                <td colspan="2">Locul de munca: {$info.CompanyName|default:'..............................'}<br/><br/></td>
            </tr>
            <tr style="line-height:7px;">
                <td colspan="2">Motivul intocmirii notei de lichidare: <b>ART. {$info.Law|default:'................'} DIN LEGEA NR. 53/2003 </b>de la data
                    de {if !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.StopDate|date_format:'%d.%m.%Y'}{else}.............................{/if}<br/><br/></td>
            </tr>
        </table>
        <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr>
                <td width="25%">Natura debitului <sup>2</sup></td>
                <td width="25%">Titlu executor <sup>3</sup> (natura, numarul, data, emitentul)</td>
                <td width="25%">Suma datorata la data emiterii notei de lichidare</td>
                <td width="25%">Creditorul(numele si adresa)</td>
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
        <br/>
        <p style="text-align:right;">Contabil sef,.............................................</p>

        <p style="text-align:left;">Salariile brute incasate pe ultimele 12 luni (pentru calculul indemnizatiei de concediul de odihna):</p>
        <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr>
                <td>Anul</td>
                <td>Luna</td>
                <td>Suma</td>
                <td>Anul</td>
                <td>Luna</td>
                <td>Suma</td>
            </tr>
            <tr>
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
            </tr>
            <tr>
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
            </tr>
            <tr>
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
            </tr>
        </table>

        <p>
            I. Durata concediului de odihna este de {$info.TotalCO|default:'............'} zile, din care pe anul in curs a efectuat {$info.UsedCO|default:'............'} zile de
            concediu.
        </p>
        <p>
            II. Concedii medicale platite in ultimele 12 luni:
        </p>

        <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr>
                <td width="33%">Luna</td>
                <td width="34%">Anul</td>
                <td width="33%">Numar zile</td>
            </tr>
            {if !empty($info.VacationCM)}
                {foreach from=$info.VacationCM key=year item=yearvac}
                    {foreach from=$yearvac key=month item=days}
                        <tr>
                            <td>{$month}</td>
                            <td>{$year}</td>
                            <td>{$days}</td>
                        </tr>
                    {/foreach}
                {/foreach}
            {else}
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            {/if}
        </table>
        <br/>
        In cursul acestui an a avut concedii fara plata, absente nemotivate si invoiri care totalizeaza {$info.CFSDaysNo|default:'...........'} zile.
        <br/><br/>
        <table width="100%" align="center">
            <tr>
                <td width="50%">Data<br/><br/></td>
                <td width="50%" align="right">Semnatura</td>
            </tr>
            <tr>
                <td width="50%">{$smarty.now|date_format:'%d.%m.%Y'}</td>
                <td width="50%" align="right">..............................................</td>
            </tr>
        </table>

    </div>
{/if}