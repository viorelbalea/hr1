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

        <p style="text-align:center; margin-top:0px;">
            <b>DECIZIA</b><br/>
            <b>NR. .............. / {$smarty.now|date_format:'%d.%m.%Y'}</b><br/>
        </p>

        <div style="width:100%; margin:0px;  line-height:150%;">
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Subscrisa {$info.CompanyName|default:'..............................'} cu sediul social declarat in
                {if $info.DistrictName == 'Bucuresti'}Bucuresti{else}{$info.CityName|default:'..........................'}{/if},
                str. {$info.StreetName|default:'..........................'},
                nr. {$info.StreetNumber|default:'..............'}
                , {if $info.DistrictName == 'Bucuresti'}{$info.CityName|default:'sector ..............'}{else}judetul {$info.DistrictName|default:'..............'}{/if},
                inregistrata la Reg. Comertului cu nr.
                {$info.RegComert|default:'..............................'}, CUI: {$info.CIF|default:'..............................'},
                reprezentata
                prin {if $info.LegalFullName}{if $info.LegalSex == 'M'}domnul{else}doamna{/if} {$info.LegalFullName}{else}domnul .....................................................{/if}
                , Director General,
            </p>
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Avand in vedere prevederile Legii nr. 31/1990 cu modificarile si completarile ulterioare cu privire la organizarea,
                functionarea si conducerea societatilor comerciale;
            </p>
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Avand in vedere motivul in fapt al incetarii - expirarea termenului contractului individual de munca
                al {if $info.Sex == 'M'}Domnului{else}Doamnei{/if} {$info.FullName}
                incheiat pe durata {$info.ContractType|default:'......................'};
            </p>
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Avand in vedere dispozitiile art. 56 lit. a-k din Codul Muncii (Lg. 53/2003);
            </p>

            <p style="text-align:center">
                <b>DECIDE:</b>
            </p>

            <p style="text-indent:40px; text-align:justify; margin:0px;">
                <b>Art. 1.</b> Contractul de munca al {if $info.Sex == 'M'}Domnului{else}Doamnei{/if} {$info.FullName}, avand
                functia {$info.Function|default:'...........................'}
                la {$info.CompanyName|default:'.....................'} inceteaza de drept incepand cu data
                de {$info.StopDate|date_format:'%d.%m.%Y'|default:'..........................'} conform <b>art. 56 (1), lit. i </b>din Codul Muncii.
            </p>
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                <b>Art. 2.</b> Compartimentul resurse umane - personal si financiar contabil vor duce la indeplinire prezenta.
            </p>
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                <b>Art. 3.</b> Impotriva prezentei decizii de incetare a contractului de munca, subsemnatul se poate adresa cu contestatie la Tribunalul
                in a carui circumscriptie teritoriala se afla domiciliul angajatului in termen de 45 de zile de la comunicare.
            </p>

            <p style="text-align:left">
                <b>DIRECTOR GENERAL,<br/>
                    {$info.LegalFullName|default:'..............................'}</b>
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