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
        <br/>

        <p style="text-align:center"><strong>ADEVERINTA</strong></p>
        <br/>
        <p style="text-indent:40px; text-align:justify;">
            Se adevereste prin prezenta ca {if $info.Sex == 'M'}Domnul{else}Doamna{/if} <b>{$info.FullName}</b>,
            CNP {$info.CNP|default:'...........................................'},
            este {if $info.Sex == 'M'}salariat{else}salariata{/if} la {$info.CompanyName|default:'..............................'}
            avand un contract de munca pe durata {$info.ContractType} din data de {$info.StartDate|default:'.............................'},
            in functia de {$info.Function|default:'...........................................'} .
        </p>

        <p style="text-indent:40px; text-align:justify;">
            Se elibereaza prezenta spre a-i servi la gradinita.
        </p>

        <br/><br/><br/>

        <p style="text-align:left">
            <b>DIRECTOR GENERAL,<br/>
                {$info.LegalFullName|@default:'.......................................................'}</b>
        </p>

    </div>
{/if}