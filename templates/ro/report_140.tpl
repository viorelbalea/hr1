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
                Avand in vedere prevederile LEGII 31/1990 cu modificarile si completarile ulterioare cu privire la organizarea,
                functionarea si conducerea societatilor comerciale;
            </p>
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Avand in vedere cererea de demisie nr. {$info.ResignationDemandNo|default:'.........'} / {$info.StopDate|date_format:'%d.%m.%Y'|default:'....................'}
                a {if $info.Sex == 'M'}salariatului Domnul{else}salariatei Doamna{/if} {$info.FullName}
                angajat{if $info.Sex == 'F'}a{/if} in functia de {$info.Function|default:'...........................'}
            </p>
            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Vizand si dispozitiile art. 81 din Codul Muncii (LEGEA 53/2003);
            </p>

            <p style="text-align:center">
                <b>DECIDE:</b>
            </p>

            <p style="text-indent:40px; text-align:justify; margin:0px;">
                <b>Art. 1.</b> Incepand cu data de {$info.StopDate|date_format:'%d.%m.%Y'|default:'.........................'} inceteaza raporturile de munca a societatii cu
                angajatul {if $info.Sex == 'M'}Dl.{else}Dna.{/if} {$info.FullName},
                cu functia {$info.Function|default:'...........................'} la {$info.CompanyName|default:'.....................'}
                prin demisie in conformitate cu art. <b>81, alin. {$info.Law|default:'..........'}</b> din Codul Muncii (LEGEA 53/2003).
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