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

        <p style="text-align:right"><b>Nr. ........... /{$smarty.now|date_format:'%d.%m.%Y'}</b></p>

        <p style="text-align:center"><strong>ADEVERINTA</strong></p>
        <br/>
        <p style="text-indent:40px; text-align:justify; margin:0px;">
            Se adevereste prin prezenta ca {if $info.Sex == 'M'}Domnul{else}Doamna{/if} <b>{$info.FullName}</b>,
            CNP {$info.CNP|default:'...........................................'},
            este {if $info.Sex == 'M'}salariat al{else}salariata a{/if} companiei {$info.CompanyName|default:'..............................'}
            incepand cu data de {$info.StartDate|default:'.............................'}, in functia de {$info.Function|default:'...........................................'}
            si are achitata la zi contributia la Fondul de Asigurari Sociale de Sanatate.
        </p>

        <p style="text-indent:40px; text-align:justify; margin:0px;">
            Confirmam ca societatea noastra, in calitate de angajator, si-a indeplinit obligatiile la constituirea Fondului Asigurarilor Sociale de
            Sanatate in temeiul legal si nu are de achitat sume restante reprezentand:
        </p>
        <p style="text-indent:40px; text-align:justify; margin:0px;">
            - contributia in cota de 5.2%, raportata la fondul de salarii, datorata de angajator;
        </p>
        <p style="text-indent:40px; text-align:justify; margin:0px;">
            - contributia in cota de 5.5%, aplicata veniturilor salariale brute realizate lunar de angajati.
        </p>

        <p style="text-indent:40px; text-align:justify; margin:0px;">
            Mentionam ca asigurarea de sanatate suportata de salariat (5.5 %) si asigurarea de sanatate suportata de societate (5.2%)
            este platita catre Bugetul Asigurarilor Sociale de Sanatate in contul RO85TREZ7005502XXXXXXXXX Bugete
            Asigurari Sociale si Fonduri Speciale, deschis la Trezoreria Municipiului Bucuresti.
        </p>

        <p style="text-indent:40px; text-align:justify; margin:0px;">
            Precizam ca {if $info.Sex == 'M'}Domnul{else}Doamna{/if} <b>{$info.FullName}</b> figureaza pe listele de sanatate
            ale {$health_companies[$info.HealthCompanyID]|default:'CAS .....................................'}.
        </p>

        <p style="text-indent:40px; text-align:justify; margin:0px;">
            Mentionam ca in ultimele {if $info.FirmYearAge > 0}12{else}{$info.FirmMonthAge+1}{/if} luni {if $info.Sex == 'M'}Domnul{else}Doamna{/if}
            <b>{$info.FullName}</b> {if $info.TotalCM > 0}a beneficiat de un numar de
                {$info.TotalCM} zile calendaristice de concediu medical dupa cum urmeaza:{else}nu a beneficiat de concediu medical.{/if}
        </p>
        {foreach from=$info.DisplayCM item=item_an key=an}
            {foreach from=$item_an item=item_luna key=luna}
                <p style="margin:0px 0px 0px 40px; text-align:justify; ">
                    - luna {$luna} {$an} - {$item_luna.NrDays} zile de concediu medical -
                    {foreach from=$item_luna.detail item=cm_detail}
                        {$cm_detail.StartDate|@date_format:"%d.%m.%Y"} - {$cm_detail.StopDate|@date_format:"%d.%m.%Y"};
                    {/foreach}
                </p>
            {/foreach}
        {/foreach}

        <p style="text-indent:40px; text-align:justify;">
            Se elibereaza prezenta spre a-i servi la Spital/Medicul de familie/Policlinica.
        </p>

        <br/><br/>

        <p style="text-align:left">
            <b>DIRECTOR GENERAL,<br/>
                {$info.LegalFullName|default:'.......................................'}</b>
        </p>

    </div>
{/if}