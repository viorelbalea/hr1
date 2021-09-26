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

        <p style="text-align:center">
            <b>DECIZIA</b><br/>
            <b>NR. .............. / {$smarty.now|date_format:'%d.%m.%Y'}</b><br/>
        </p>

        <br/>

        <div style="width:100%; margin:0px;  line-height:150%;">
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Subscrisa {$info.CompanyName|default:'..............................'} cu sediul in
                {if $info.DistrictName == 'Bucuresti'}Bucuresti{else}{$info.CityName|default:'..........................'}{/if},
                str. {$info.StreetName|default:'..........................'},
                nr. {$info.StreetNumber|default:'..............'}
                , {if $info.DistrictName == 'Bucuresti'}{$info.CityName|default:'sector ..............'}{else}judetul {$info.DistrictName|default:'..............'}{/if},
                inregistrata la Reg. Comertului cu nr.
                {$info.RegComert|default:'..............................'}, CUI {$info.CIF|default:'..............................'},
                prin reprezentantul sau reprezentantii legali, avand in vedere cererea nr. ......./ {$smarty.now|date_format:'%d.%m.%Y'}
                a {if $info.Sex == 'M'}Domnului{else}Doamnei{/if} {$info.FullName}
                prin care solicita intrarea in concediu de crestere copil pana la ....... an,
            </p>

            <p style="text-align:center">
                <b>DECIDE:</b>
            </p>

            <p style="text-indent:40px; text-align:justify; margin:0px;">
                <b>Art. 1.</b> Incepand cu data de {$info.StopDate|date_format:'%d.%m.%Y'|default:'....................'} se suspenda contractul individual de munca
                al {if $info.Sex == 'M'}Domnului{else}Doamnei{/if}
                {$info.FullName} conform prevederilor <b>art. 51, alin. 1, lit. a</b> din Codul Muncii.
            </p>
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                <b>Art. 2.</b> Ducerea la indeplinire a prezentei decizii se efectueaza de catre Compartimentul resurse umane - personal.
            </p>
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                <b>Art. 3.</b> Impotriva prezentei decizii de incetare a contractului de munca, subsemnatul se poate adresa cu contestatie la Tribunalul
                in a carui circumscriptie teritoriala se afla domiciliul angajatului in termen de 45 de zile de la comunicare.
            </p>

            <p style="text-align:left">
                <b>DIRECTOR GENERAL,<br/>
                    {$info.LegalFullName|default:'.......................................'}</b>
            </p>
        </div>
        <p style="text-align:right">
            Luat la cunostinta:<br/>
            Salariat: {$info.FullName}<br/>
            Semnatura:.....................<br/>
            Data: {$smarty.now|date_format:'%d.%m.%Y'}
        </p>

    </div>
{/if}