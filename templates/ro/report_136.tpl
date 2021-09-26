{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        {if $info.CompanyID && $info.CompanyPhoto}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0px;">
                <tr width="100%">
                    <td align="center"><img src="{$info.CompanyPhoto}"/></td>
                </tr>
            </table>
            <br style="height:0px;" clear="all"/>
        {/if}

        <div style="width:100%; margin:0px;  line-height:150%;">
            <p style="text-align:right; margin-top:0px;"><b>Nr. ........... /{$smarty.now|date_format:'%d.%m.%Y'}</b></p>

            <p style="text-align:center"><strong>ADEVERINTA</strong></p>

            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Prin prezenta se certifica faptul ca {if $info.Sex == 'M'}Domnul{else}Doamna{/if} <b>{$info.FullName}</b>,
                CNP {$info.CNP|default:'...........................................'},
                act de identitate C.I.: Seria {$info.BISerie|default:'.........'} nr. {$info.BINumber|default:'....................'},
                eliberat de {$info.BIEmitent|default:'.......................'} la data de {$info.BIStartDate|default:'..................'},
                cu domiciliul in {$info.PersonCity|default:'............................'}, str. {$info.PersonStreetName|default:'................................'}
                nr. {$info.PersonStreetNumber|default:'............'}, bl. {$info.PersonBl|default:'............'}, sc. {$info.PersonSc|default:'............'},
                et. {$info.PersonEt|default:'........'}, ap. {$info.PersonAp|default:'........'}, Judet {$info.PersonDistrict|default:'............'},
                are calitatea de salariat al societatii noastre din data de {$info.StartDate|default:'.............................'}
                in functia de {$info.Function|default:'...........................................'}, i s-a retinut si virat lunar contributia
                pentru asigurarile sociale de sanatate, potrivit Legii nr. 95/2006 privind reforma in domeniul sanatatii, cu modificarile si completarile ulterioare.
            </p>

            {if $info.lstIntretinere|@count > 0}
                <p style="text-indent:40px; text-align:justify; margin:0px;">
                    Persoana sus mentionata figureaza in evidentele noastre cu urmatorii coasigurati (sot/sotie, parinti, aflati in intretinere):
                </p>
                {assign var="idx" value="0"}
                {foreach from=$info.lstIntretinere item=pers_intretinere name=foreach_intretinere}
                    {assign var="idx" value=$idx+1}
                    <p style="text-indent:40px; text-align:justify; margin:0px;">
                        {$idx}. Nume, prenume {$pers_intretinere.Nume|default:'.........................................'},
                        CNP {$pers_intretinere.CNP|default:'...............................'}
                        - {$quality[$pers_intretinere.Calitate]}{if $pers_intretinere.Coasigurat == 1} - coasigurat{/if};
                    </p>
                {/foreach}
            {else}
                <p style="text-indent:40px; text-align:justify; margin:0px;">
                    Persoana sus mentionata nu figureaza in evidentele noastre cu niciun coasigurat (sot/sotie, parinti, aflati in intretinere).
                </p>
            {/if}

            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Mentionam ca in ultimele {if $info.FirmYearAge > 0}12{else}{$info.FirmMonthAge+1}{/if}
                lunii {if $info.TotalCM > 0}a beneficiat de {$info.TotalCM} zile de concediu medical{else}nu a beneficiat de concediu medical{/if}.
            </p>

            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Prezenta adeverinta are o perioada de valabilitate de 3 luni de la data emiterii.
            </p>

            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Sub sanctiunile aplicate faptei de fals in acte publice, declaram ca datele din adeverinta sunt corecte si complete.
            </p>

            <p style="text-indent:40px; text-align:justify; margin:0px;">
                Se elibereaza prezenta spre a-i servi la spital / medicul de familie / policlinica.
            </p>

            <br/><br/>

            <p style="text-align:left">
                <b>DIRECTOR GENERAL,<br/>
                    {$info.LegalFullName|default:'.......................................'}</b>
            </p>
        </div>
    </div>
{/if}